<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Role extends Model
{
    use SoftDeletes, Statusable, StatusToggleable, HasSlug;

    protected $table = "roles";

    protected $fillable = [
        'name',
        'guard_name',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('name')
        ->saveSlugsTo('slug');
    }

    public function users(){
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    /**
     * Get list
     */
    public function scopeGetRoles($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = Role::select('roles.id', 'roles.name', 'roles.status', 'roles.created_at')
        ->whereNotIn('id', [
            config('constants.roles.ADMIN.value')
        ])
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(roles.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "roles.name",
                "roles.created_at",
                "roles.status",
                ""
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('roles.id', 'desc');
        }

        // Set final limit and records
        if(!empty($limit))
        {
            $records = $records->skip($offset)->take($limit);
            return $records->get();
        }
        else
        {
            return $records->get()->count();
        }
    }

    /**
     * Save New Record
     */
    public function scopeSaveRecord($model, $request)
    {
        // dd($request->all());
        // Get user
        $authUser = auth()->user();
        //----------

        $requestArray = $request->all();

        $data = [
            'name' => $requestArray['name'],
            'guard_name' => 'web',
            'status' => $requestArray['status'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $authUser->id,
            'updated_by' => $authUser->id
        ];

        $record = $this->create($data);

        return $record;
    }

    /**
     * Update Record
     */
    public function scopeUpdateRecord($model, $request)
    {
        $authUser = auth()->user();
        $state = null;
        
        $requestArray = $request->all();
        // dd($requestArray);

        // Get User
        $roleData = Role::where('id', $requestArray['role_id'])->first();

        if(!empty($roleData))
        {
            $data = [
                'name' => $requestArray['name'],
                'status' => $requestArray['status'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $authUser->id
            ];

            $state = $roleData->update($data);
        }

        return $state;
    }

    /**
     * Update Record Permissions
     */
    public function scopeUpdatePermissions($model, $request)
    {
        $authUser = auth()->user();
        $role = null;
        
        $requestArray = $request->all();
        // dd($requestArray);

        if(!empty($request->permissions))
        {
            $role = SpatieRole::find($request->role_id);

            // $role->givePermissionTo($request->permissions);
            $role->syncPermissions($request->permissions);
        }

        return $role;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class Advertisment extends Model
{
    use HasFactory, SoftDeletes, StatusToggleable; // <-- Added SoftDeletes

    protected $table = 'advertisment';

    protected $fillable = [
        'start_date',
        'bussines_name',
        'type',
        'district',
        'category',
        'home_city',
        'image',
        'image_alt',
        'sub_type',
        'expiry_date',
        'status',
    ];

     /**
     * Get list
     */
    public function scopeGetadvertisment($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = Advertisment::select(
            'advertisment.id',
            'advertisment.bussines_name',
            'advertisment.start_date',
            'advertisment.status',
            'advertisment.created_at',
            'users.business_name as business_name',
            'districts.name as district_name',
            'advertisment.sub_type'
        )
        ->join('users', 'users.id', '=', 'advertisment.bussines_name')
        ->leftJoin('districts', 'districts.id', '=', 'advertisment.district')
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(users.business_name) LIKE \'%'.$search.'%\' OR lower(districts.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "advertisment.start_date",
                "advertisment.type",
                "users.business_name",
                "districts.name",
                "advertisment.created_at",
                "advertisment.status",
                "",
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('advertisment.id', 'desc');
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
            'start_date' => $requestArray['start_date'],
            'bussines_name' => $requestArray['vendor_user_id'],
            'type' => $requestArray['type'],
            'district' => $requestArray['district'] ?? 0,
            'category' => $requestArray['category'] ?? 0,
            'home_city' => $requestArray['home_city'],
            'status' => 1,
            'image_alt' => $requestArray['image_alt'],
            'sub_type' => $requestArray['sub_type'],
            'expiry_date' => $requestArray['expiry_date'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $authUser->id,
            'updated_by' => $authUser->id
        ];

        // Upload image
        if ($request->hasFile('image')) {

            $path = public_path('upload/district');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $filename);

            // Full URL save in DB
            $data['image'] = asset('public/upload/district/' . $filename);
        }


        $record = $this->create($data);

        return $record;
    }

    /**
     * Update Record
     */
    public function scopeUpdateRecord($model, $request)
    {
        $authUser = auth()->user();
        $district = null;
        
        $requestArray = $request->all();

        // Get User
        $addvertismentData = Advertisment::where('id', $requestArray['id'])->first();

        if(!empty($addvertismentData))
        {
            $data = [
                'start_date' => $requestArray['start_date'],
                'bussines_name' => $requestArray['vendor_user_id'],
                'type' => $requestArray['type'],
                'district' => $requestArray['district'],
                'category' => $requestArray['category'],
                'home_city' => $requestArray['home_city'],
                'status' => 1,
                'image_alt' => $requestArray['image_alt'],
                'sub_type' => $requestArray['sub_type'],
                'expiry_date' => $requestArray['expiry_date'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => $authUser->id,
                'updated_by' => $authUser->id
            ];
            
            // Upload image
            if ($request->hasFile('image')) {

                $path = public_path('upload/district');

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $file     = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $filename);

                // Full URL save in DB
                $data['image'] = asset('public/upload/district/' . $filename);
            }
            $addvertisment = $addvertismentData->update($data);
        }

        return $addvertisment;
    }
}


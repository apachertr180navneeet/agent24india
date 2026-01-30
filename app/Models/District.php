<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class District extends Model
{
    use SoftDeletes, Statusable, StatusToggleable;

    protected $fillable = [
        'state_id',
        'name',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get list
     */
    public function scopeGetDistricts($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = District::select('districts.id', 'districts.state_id', 'districts.name', 'districts.status', 'districts.created_at', 'states.name as state_name')
        ->join('states', 'states.id', '=', 'districts.state_id')
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(districts.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "districts.name",
                "states.name",
                "districts.created_at",
                "districts.status",
                ""
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('districts.id', 'desc');
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
            'state_id' => $requestArray['state_id'],
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
        $district = null;
        
        $requestArray = $request->all();
        // dd($requestArray);

        // Get User
        $districtData = District::where('id', $requestArray['state_id'])->first();

        if(!empty($districtData))
        {
            $data = [
                'name' => $requestArray['name'],
                'state_id' => $requestArray['state_id'],
                'status' => $requestArray['status'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $authUser->id
            ];

            $district = $districtData->update($data);
        }

        return $district;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class City extends Model
{
    use SoftDeletes, Statusable, StatusToggleable;

    protected $fillable = [
        'district_id',
        'state_id',
        'name',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get list
     */
    public function scopeGetCities($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = City::select('cities.id', 'cities.state_id', 'cities.district_id', 'cities.name', 'cities.status', 'cities.created_at', 'states.name as state_name')
        //->join('districts', 'districts.id', '=', 'cities.district_id')
        ->join('states', 'states.id', '=', 'cities.state_id')
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(cities.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "cities.name",
                //"districts.name",
                "states.name",
                "cities.created_at",
                "cities.status",
                ""
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('cities.id', 'desc');
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
            'district_id' => $requestArray['district_id'],
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
        $city = null;
        
        $requestArray = $request->all();
        // dd($requestArray);

        // Get User
        $cityData = City::where('id', $requestArray['city_id'])->first();

        if(!empty($cityData))
        {
            $data = [
                'name' => $requestArray['name'],
                'district_id' => $requestArray['district_id'],
                'state_id' => $requestArray['state_id'],
                'status' => $requestArray['status'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $authUser->id
            ];

            $city = $cityData->update($data);
        }

        return $city;
    }
}

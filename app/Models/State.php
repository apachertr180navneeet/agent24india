<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;

class State extends Model
{
    use SoftDeletes, Statusable, StatusToggleable;

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get states list
     */
    public function scopeGetStates($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $records = State::select('states.id', 'states.name', 'states.status', 'states.created_at')
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(states.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "states.name",
                "states.created_at",
                "states.status",
                ""
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('states.id', 'desc');
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
        $stateData = State::where('id', $requestArray['state_id'])->first();

        if(!empty($stateData))
        {
            $data = [
                'name' => $requestArray['name'],
                'status' => $requestArray['status'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $authUser->id
            ];

            $state = $stateData->update($data);
        }

        return $state;
    }
}

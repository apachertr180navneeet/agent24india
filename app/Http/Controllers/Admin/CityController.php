<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\District;
use App\Models\City;

class CityController extends Controller
{
    protected $pageTitle;

    public function __construct(){
        $this->pageTitle = 'City';
    }

    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'City' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        
        return view("admin.city.index")->with($this->viewData);
    }

    /**
     * Get list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function getCities(Request $request)
    {
        $authUser = auth()->user();

        // Ajax Post Parameters from table
        $draw = $request->get('draw');
        $start = $request->get('start');
        $limit = $request->get('length');
        $sort = $request->get('order')[0];
        $search = $request->get('search')['value'];
        
        // Filter Parameters
        $filter = array(
            // "filter_itr_status" => $request->filter_itr_status
        );

        // Get List
        $records_count = City::GetCities(null, null, $search, $filter, $sort);
        $records = City::GetCities($limit, $start, $search, $filter, $sort);

        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $name = 'N/A';
                $districtName = 'N/A';
                $stateName = 'N/A';
                $created = 'N/A';
                $status = '';
                $action = '';

                $name = $value->name ?? $name;
                $districtName = $value->district_name ?? $districtName;
                $stateName = $value->state_name ?? $stateName;
                $created = date("d-m-Y H:i", strtotime($value->created_at));

                if($value->status == 1){
                    $status = '<label class="badge badge-success">Active</label> &nbsp;';
                } 
                else{
                    $status = '<label class="badge badge-warning">Inactive</label> &nbsp;';
                }

                $action = '<div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="'.route('admin.city.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.city.deleteSingle', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';

                // Array Parent Data
                $arr_data[] = array(
                    "id" => $value->id,
                    "name" => $name,
                    "district_name" => $districtName,
                    "state_name" => $stateName,
                    "status" => $status,
                    "created" => $created,
                    "action" => $action
                );
            }
        }
        $totalRecords = $records_count;
        $totalDisplayRecord = $arr_data;

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $arr_data
        );

        return json_encode($response);
    }

    /**
     * View create.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function create()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'City' => route('admin.city.index'),
            'Create' => '',
        ];

        // Get districts
        $districts = District::where('status', 1)->get();

        // Get states
        $states = State::where('status', 1)->get();

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['districts'] = $districts;
        $this->viewData['states'] = $states;

        return view('admin.city.create')->with($this->viewData);
    }

    /**
     * Store Record.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function store(Request $request)
    {
        $authUser = auth()->user();
        $city = null;
        $errorMessage = null;
        $notification = [
            '_status' => false,
            '_message' => __('messages.record_creation_failed', ['record' => 'City']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.city.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create
        try {
            $city = City::saveRecord($request);

            DB::commit();

        }catch (\Exception $e) {
            $city = null;
            $errorMessage = $e->getMessage();
            DB::rollback();
            dd($e);
        }
        //------------

        if (!is_null($city)) 
        {
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_created', ['record' => 'City']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.city.index';
        }

        return redirect()->route($redirectRoute)->with(['notification' => $notification]);
    }

    /**
     * Edit.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Rajesh
     * @created 03-01-2026
     */
    public function edit(Request $request, $id)
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'City' => route('admin.city.index'),
            'Edit' => '',
        ];

        // Get states
        $states = State::where('status', 1)->get();

        // City to edit
        $city = City::where('cities.id', $id)->first();

        // Get districts
        $districts = District::where('status', 1)->where('state_id', $city->state_id)->get();
        
        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['districts'] = $districts;
        $this->viewData['states'] = $states;
        $this->viewData['city'] = $city;

        return view('admin.city.edit')->with($this->viewData);
    }

    /**
     * Update.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 03-01-2026
     */
    public function update(Request $request, $id)
    {
        $authUser = auth()->user();
        $city = null;
        $errorMessage = null;
        
        // Update
        DB::beginTransaction();
        try {
            $city = City::updateRecord($request);

            DB::commit();
        } 
        catch (\Exception $e) {
            $city = null;
            $errorMessage = $e->getMessage();
            DB::rollback();

            dd($e);
        }
        //------------

        if (!is_null($city)) 
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.records_updated', ['record' => 'City']),
                '_type' => 'success',
            ];
            //-----------------

            return redirect()->route('admin.city.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.records_updation_failed', ['record' => 'City']),
                '_type' => 'error',
            ];
            //-----------------

            return redirect()->route('admin.city.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }

    /**
     * Change status.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created 03-01-2026
     */
    public function changeStatus(Request $request)
    {
        $city = City::toggleStatus($request['ids']);

        // Set response
        if (!is_null($city))
        {
            $response = [
                '_status' => true,
                '_message' => __('messages.status_changed'),
                '_type' => 'success',
            ];
        } 
        else 
        {
            $response = [
                '_status' => false,
                '_message' => __('messages.status_change_failed'),
                '_type' => 'error',
            ];
        }
        //-------------
        
        return response()->json($response, 200);
    }

    /**
     * Destroy.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function destroy(Request $request)
    {
        $ids = $request['ids'];
        $city = City::whereIn('id', $ids)->get();

        // Delete child ifany
        if($city)
        {
            foreach($city as $key => $value)
            {
                // Delete record
                $city = City::where('id', $value->id)->delete();
            }
        }
        
        // Set response
        if ($city == true) 
        {
            $response = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'City']),
                '_type' => 'success',
            ];
        } 
        else 
        {
            $response = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'City']),
                '_type' => 'error',
            ];
        }
        //-------------
        
        return response()->json($response, 200);
    }

    /**
     * Delete Single.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function deleteSingle(Request $request, $id)
    {
        $city = City::where('id', $id)->first();
        
        // Delete
        if($city)
        {
            // Delete
            $city = City::where('id', $id)->delete();
        }
        
        // Set notification
        if (!is_null($city))
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'City']),
                '_type' => 'success',
            ];
            //---------------

            return redirect()->route('admin.city.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'City']),
                '_type' => 'error',
            ];
            //---------------

            return redirect()->route('admin.city.index')->with(['notification' => $notification]);
        }
        //-------------

        return response()->json($response, 200);
    }

    /**
     * Check name.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function checkName(Request $request)
    {
        $status = false;

        if (!is_null($request->name)) 
        {
            $city = City::where('name', $request['name'])
            ->where('district_id', $request->district_id)
            ->where('state_id', $request->state_id)
            ->first();

            if (!is_null($city)) 
            {
                // dd($city, $request->all());
                if ($request->filled('city_id') && $city->id == $request['city_id']) {
                    $status = true;
                } else {
                    $status = false;
                }
            } 
            else {
                $status = true;
            }
        }

        return response()->json($status, 200);
    }

    /**
     * Get districts by state.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function getDistrictsByState(Request $request)
    {
        $response = [
            'status' => false,
            'message' => 'Records not found.',
            'data' => null
        ];
        $html = null;

        if (!empty($request->state_id)) 
        {
            $districts = District::where('state_id', $request['state_id'])
            ->where('status', 1)
            ->get();

            if($districts->count() > 0) 
            {
                $html = view('admin.city.districts_list')->with([
                    'districts' => $districts
                ])->render();

                $response['status'] = true;
                $response['message'] = 'Records found successfully.';
                $response['data'] = $html;
            }
        }

        return response()->json($response, 200);
    }
}

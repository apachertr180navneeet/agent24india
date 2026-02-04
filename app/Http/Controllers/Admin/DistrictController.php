<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\District;

class DistrictController extends Controller
{
    protected $pageTitle;

    public function __construct(){
        $this->pageTitle = 'District';
    }

    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'District' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        
        return view("admin.district.index")->with($this->viewData);
    }

    /**
     * Get list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function getDistricts(Request $request)
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
        $records_count = District::GetDistricts(null, null, $search, $filter, $sort);
        $records = District::GetDistricts($limit, $start, $search, $filter, $sort);

        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $name = 'N/A';
                $stateName = 'N/A';
                $created = 'N/A';
                $status = '';
                $homepage = '';
                $action = '';

                $name = $value->name ?? $name;
                $stateName = $value->state_name ?? $stateName;
                $created = date("d-m-Y H:i", strtotime($value->created_at));

                if($value->status == 1){
                    $status = '<label class="badge badge-success">Active</label> &nbsp;';
                } 
                else{
                    $status = '<label class="badge badge-warning">Inactive</label> &nbsp;';
                }

                $homeChecked = $value->is_home ? 'checked' : '';
                $homepage .= '<div class="form-check form-switch d-inline-block">
                                <input class="form-check-input dt-toggle-home" type="checkbox" data-url="'.route('admin.district.addToHome').'" data-id="'.$value->id.'" '.$homeChecked.'>
                                <label class="form-check-label">Add to Home</label>
                            </div>';

                $action = '<div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="'.route('admin.district.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.district.deleteSingle', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';

                // Array Parent Data
                $arr_data[] = array(
                    "id" => $value->id,
                    "name" => $name,
                    "state_name" => $stateName,
                    "status" => $status,
                    "created" => $created,
                    'homepage' => $homepage,
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
            'District' => route('admin.district.index'),
            'Create' => '',
        ];

        // Get states
        $states = State::where('status', 1)->get();

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['states'] = $states;

        return view('admin.district.create')->with($this->viewData);
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
        $district = null;
        $errorMessage = null;
        $notification = [
            '_status' => false,
            '_message' => __('messages.record_creation_failed', ['record' => 'District']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.district.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create
        try {
            $district = District::saveRecord($request);

            DB::commit();

        }catch (\Exception $e) {
            $district = null;
            $errorMessage = $e->getMessage();
            DB::rollback();
            dd($e);
        }
        //------------

        if (!is_null($district)) 
        {
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_created', ['record' => 'District']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.district.index';
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
            'District' => route('admin.district.index'),
            'Edit' => '',
        ];

        // Get states
        $states = State::where('status', 1)->get();

        // District to edit
        $district = District::where('districts.id', $id)->first();
        
        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['states'] = $states;
        $this->viewData['district'] = $district;

        return view('admin.district.edit')->with($this->viewData);
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
        $district = null;
        $errorMessage = null;
        
        // Update
        DB::beginTransaction();
        try {
            $district = District::updateRecord($request);

            DB::commit();
        } 
        catch (\Exception $e) {
            $district = null;
            $errorMessage = $e->getMessage();
            DB::rollback();

            dd($e);
        }
        //------------

        if (!is_null($district)) 
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.records_updated', ['record' => 'District']),
                '_type' => 'success',
            ];
            //-----------------

            return redirect()->route('admin.district.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.records_updation_failed', ['record' => 'District']),
                '_type' => 'error',
            ];
            //-----------------

            return redirect()->route('admin.district.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
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
        $district = District::toggleStatus($request['ids']);

        // Set response
        if (!is_null($district))
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
        $district = District::whereIn('id', $ids)->get();

        // Delete child ifany
        if($district)
        {
            foreach($district as $key => $value)
            {
                // Delete record
                $district = District::where('id', $value->id)->delete();
            }
        }
        
        // Set response
        if ($district == true) 
        {
            $response = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'District']),
                '_type' => 'success',
            ];
        } 
        else 
        {
            $response = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'District']),
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
        $district = District::where('id', $id)->first();
        
        // Delete
        if($district)
        {
            // Delete
            $district = District::where('id', $id)->delete();
        }
        
        // Set notification
        if (!is_null($district))
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'District']),
                '_type' => 'success',
            ];
            //---------------

            return redirect()->route('admin.district.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'District']),
                '_type' => 'error',
            ];
            //---------------

            return redirect()->route('admin.district.index')->with(['notification' => $notification]);
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
            $district = District::where('name', $request['name'])
            ->where('state_id', $request->state_id)
            ->first();
            // dd($district, $request->all());

            if (!is_null($district)) 
            {
                // dd($district, $request->all());
                if ($request->filled('district_id') && $district->id == $request['district_id']) {
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
     * Add district to home page.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 2024-10-10
     */
    public function addToHome(Request $request)
    {
        $district = District::where('id', $request->id)->first();

        if (!$district) {
            return response()->json([
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'District']),
                '_type' => 'error',
            ], 200);
        }

        // Count how many districts are already set as home
        $homeCount = District::where('is_home', 1)->count();

        if ($request->is_home && $homeCount >= 10) {
            return response()->json([
                '_status' => false,
                '_message' => 'Maximum of 10 districts can be set as home.',
                '_type' => 'error',
            ], 200);
        }

        $district->is_home = $request->is_home;
        $district->save();

        return response()->json([
            '_status' => true,
            '_message' => __('messages.record_updated', ['record' => 'District']),
            '_type' => 'success',
        ], 200);
    }


    /**     * Get districts by state.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author Rajesh
     * @created_at 2024-10-15
     */
    public function listHomeDistricts(Request $request){

        $districts = District::where('is_home', 1)
            ->where('status', 1)
            ->select('id', 'name')
            ->get();

        $pageTitle = 'Home Page Districts';
        return view("admin.district.homepage", compact('districts', 'pageTitle'));
    }


    /**
     * Get Sort order.
     */
    public function updateOrder(Request $request)
    {
        foreach ($request->order as $item) {
            District::where('id', $item['id'])
                ->update(['district_order' => $item['position']]);
        }

        return response()->json(['status' => true]);
    }
}

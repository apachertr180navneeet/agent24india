<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\State;

class StateController extends Controller
{
    protected $pageTitle;

    public function __construct(){
        $this->pageTitle = 'State';
    }

    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'State' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        
        return view("admin.state.index")->with($this->viewData);
    }

    /**
     * Get States list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function getStates(Request $request)
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
        $records_count = State::GetStates(null, null, $search, $filter, $sort);
        $records = State::GetStates($limit, $start, $search, $filter, $sort);

        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $name = 'N/A';
                $created = 'N/A';
                $status = '';
                $action = '';

                $name = $value->name ?? $name;
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
                    <a class="dropdown-item" href="'.route('admin.state.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.state.deleteSingle', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';

                // Array Parent Data
                $arr_data[] = array(
                    "id" => $value->id,
                    "name" => $name,
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
            'State' => route('admin.state.index'),
            'Create' => '',
        ];

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;

        return view('admin.state.create')->with($this->viewData);
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
        $state = null;
        $errorMessage = null;
        $notification = [
            '_status' => false,
            '_message' => __('messages.record_creation_failed', ['record' => 'State']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.state.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create
        try {
            $state = State::saveRecord($request);

            DB::commit();

        } catch (\Exception $e) {
            $state = null;
            $errorMessage = $e->getMessage();
            DB::rollback();
            dd($e);
        }
        //------------

        if (!is_null($state)) 
        {
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_created', ['record' => 'State']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.state.index';
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
            'State' => route('admin.state.index'),
            'Edit' => '',
        ];

        // State to edit
        $state = State::where('states.id', $id)->first();
        
        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['state'] = $state;

        return view('admin.state.edit')->with($this->viewData);
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
        $state = null;
        $errorMessage = null;
        
        // Update
        DB::beginTransaction();
        try {
            $state = State::updateRecord($request);

            DB::commit();
        } 
        catch (\Exception $e) {
            $state = null;
            $errorMessage = $e->getMessage();
            DB::rollback();

            dd($e);
        }
        //------------

        if (!is_null($state)) 
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.records_updated', ['record' => 'State']),
                '_type' => 'success',
            ];
            //-----------------

            return redirect()->route('admin.state.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.records_updation_failed', ['record' => 'State']),
                '_type' => 'error',
            ];
            //-----------------

            return redirect()->route('admin.state.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
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
        $state = State::toggleStatus($request['ids']);

        // Set response
        if (!is_null($state))
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
        $state = State::whereIn('id', $ids)->get();

        // Delete child ifany
        if($state)
        {
            foreach($state as $key => $value)
            {
                // Delete record
                $state = State::where('id', $value->id)->delete();
            }
        }
        
        // Set response
        if ($state == true) 
        {
            $response = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'State']),
                '_type' => 'success',
            ];
        } 
        else 
        {
            $response = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'State']),
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
        $state = State::where('id', $id)->first();
        
        // Delete State
        if($state)
        {
            // Delete State
            $state = State::where('id', $id)->delete();
        }
        
        // Set notification
        if (!is_null($state))
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'State']),
                '_type' => 'success',
            ];
            //---------------

            return redirect()->route('admin.state.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'State']),
                '_type' => 'error',
            ];
            //---------------

            return redirect()->route('admin.state.index')->with(['notification' => $notification]);
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
            $state = State::where('name', $request['name'])->first();

            if (!is_null($state)) 
            {
                if ($request->filled('state_id') && $state->id == $request['state_id']) {
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
}

<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Banner' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = 'Banner';
        $this->viewData['breadcrumb'] = $breadcrumb;
        
        return view("admin.banner.index")->with($this->viewData);
    }

    /**
     * Get Categories list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function getBanners(Request $request)
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

        // Get Categories List
        $records_count = Banner::GetCategories(null, null, $search, $filter, $sort);
        $records = Banner::GetCategories($limit, $start, $search, $filter, $sort);

        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $name = 'N/A';
                $parentBannerName = 'N/A';
                $created = 'N/A';
                $status = '';
                $action = '';

                $name = $value->title ?? $name;
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
                    <a class="dropdown-item" href="'.route('admin.banner.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.banner.deleteSingle', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
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
     * View create banner.
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
            'Banner' => route('admin.banner.index'),
            'Create' => '',
        ];

        // Send view data
        $this->viewData['pageTitle'] = 'Banner';
        $this->viewData['breadcrumb'] = $breadcrumb;

        return view('admin.banner.create')->with($this->viewData);
    }

    /**
     * Store banner.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function store(Request $request)
    {
        $authUser = auth()->user();
        $user = null;
        $errorMessage = null;
        $notification = [
            '_status' => false,
            '_message' => __('messages.record_creation_failed', ['record' => 'Banner']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.banner.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create User
        try {
            $user = Banner::saveRecord($request);

            DB::commit();

        } catch (\Exception $e) {
            $user = null;
            $errorMessage = $e->getMessage();
            DB::rollback();
            dd($e);
        }
        //------------

        if (!is_null($user)) 
        {
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_created', ['record' => 'Banner']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.banner.index';
        }

        return redirect()->route($redirectRoute)->with(['notification' => $notification]);
    }

    /**
     * Edit banner.
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
            'Banner' => route('admin.banner.index'),
            'Edit' => '',
        ];

        // Banner to edit
        $banner = Banner::where('banners.id', $id)->first();
        
        // Send view data
        $this->viewData['pageTitle'] = 'Banner';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['banner'] = $banner;

        return view('admin.banner.edit')->with($this->viewData);
    }

    /**
     * Update banner.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 03-01-2026
     */
    public function update(Request $request, $id)
    {
        $authUser = auth()->user();
        $Banner = null;
        $errorMessage = null;
        
        // Update Banner
        DB::beginTransaction();
        try {
            $Banner = Banner::updateRecord($request);

            DB::commit();
        } 
        catch (\Exception $e) {
            $Banner = null;
            $errorMessage = $e->getMessage();
            DB::rollback();

            dd($e);
        }
        //------------

        if (!is_null($Banner)) 
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.records_updated', ['record' => 'Banner']),
                '_type' => 'success',
            ];
            //-----------------

            return redirect()->route('admin.banner.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.records_updation_failed', ['record' => 'Banner']),
                '_type' => 'error',
            ];
            //-----------------

            return redirect()->route('admin.banner.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
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
        $Banner = Banner::toggleStatus($request['ids']);

        // Set response
        if (!is_null($Banner))
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
        $Banner = Banner::whereIn('id', $ids)->get();

        // Delete child or sub categories if any
        if($Banner)
        {
            foreach($Banner as $key => $value)
            {
                // Delete Banner
                $Banner = Banner::where('id', $value->id)->delete();
            }
        }
        
        // Set response
        if ($Banner == true) 
        {
            $response = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'Banner']),
                '_type' => 'success',
            ];
        } 
        else 
        {
            $response = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'Banner']),
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
        $Banner = Banner::where('id', $id)->first();
        
        // Delete Banner
        if($Banner)
        {
            // Delete Banner
            $Banner = Banner::where('id', $id)->delete();
        }
        
        // Set notification
        if (!is_null($Banner))
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'Banner']),
                '_type' => 'success',
            ];
            //---------------

            return redirect()->route('admin.banner.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'Banner']),
                '_type' => 'error',
            ];
            //---------------

            return redirect()->route('admin.banner.index')->with(['notification' => $notification]);
        }
        //-------------

        return response()->json($response, 200);
    }

    /**
     * Check Banner mobile.
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
            $Banner = Banner::where('title', $request['name'])->first();

            if (!is_null($Banner)) 
            {
                if ($request->filled('Banner_id') && $Banner->id == $request['Banner_id']) {
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

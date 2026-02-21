<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Advertisment;
use App\Models\Category;
use App\Models\District;
use App\Models\User;

class AdvertismentController extends Controller
{
    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Advertisment' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = 'Advertisment';
        $this->viewData['breadcrumb'] = $breadcrumb;

        
        return view("admin.advertisment.index")->with($this->viewData);
    }

    /**
     * Get Categories list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function getAdvertisments(Request $request)
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
        $records_count = Advertisment::Getadvertisment(null, null, $search, $filter, $sort);
        $records = Advertisment::Getadvertisment($limit, $start, $search, $filter, $sort);


        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $start_date = 'N/A';
                $business_name = 'N/A';
                $district = 'N/A';
                $type = '';
                $created = 'N/A';
                $status = '';
                $action = '';

                $start_date = $value->start_date ?? $start_date;
                $business_name = $value->business_name ?? $business_name;
                $district = $value->district_name ?? $district;
                $created = date("d-m-Y", strtotime("+1 month", strtotime($value->created_at)));
                $type = $value->sub_type ?? $type;

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
                    <a class="dropdown-item" href="'.route('admin.advertisment.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.advertisment.deleteSingle', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';

                // Array Parent Data
                $arr_data[] = array(
                    "id" => $value->id,
                    "start_date" => $start_date,
                    "business_name" => $business_name,
                    "district" => $district,
                    "type" => $type,
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
     * View create category.
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
            'Advertisment' => route('admin.advertisment.index'),
            'Create' => '',
        ];

        // Get Parent Category
        $parentCategories = Category::select('id', 'name')
        ->where(function($query){
            $query->whereNull('parent_id');
        })
        ->get();

        $districts = District::select('id', 'name')
        ->where('status', 1)
        ->get();


        $vendoruser = User::where('role_id', config('constants.roles.VENDOR.value'))->where('status', 1)->where('is_approved', 1)->get();

        // Send view data
        $this->viewData['pageTitle'] = 'Advertisment';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['parentCategories'] = $parentCategories;
        $this->viewData['districts'] = $districts;
        $this->viewData['vendoruser'] = $vendoruser;

        return view('admin.advertisment.create')->with($this->viewData);
    }

    /**
     * Store Category.
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
            '_message' => __('messages.record_creation_failed', ['record' => 'Advertisment']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.advertisment.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create User
        try {
            $user = Advertisment::saveRecord($request);

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
                '_message' => __('messages.record_created', ['record' => 'Advertisment']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.advertisment.index';
        }

        return redirect()->route($redirectRoute)->with(['notification' => $notification]);
    }

    /**
     * Edit Category.
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
            'Category' => route('admin.category.index'),
            'Edit' => '',
        ];

        // Get Parent Category
        $parentCategories = Category::select('id', 'name')
        ->where(function($query){
            $query->whereNull('parent_id');
        })
        ->get();

        $districts = District::select('id', 'name')
        ->where('status', 1)
        ->get();


        $vendoruser = User::where('role_id', config('constants.roles.VENDOR.value'))->where('status', 1)->where('is_approved', 1)->get();

        // Category to edit
        $advertismentdata = Advertisment::where('advertisment.id', $id)->first();
        
        // Send view data
        $this->viewData['pageTitle'] = 'Advertisment';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['parentCategories'] = $parentCategories;
        $this->viewData['advertismentdata'] = $advertismentdata;
        $this->viewData['districts'] = $districts;
        $this->viewData['vendoruser'] = $vendoruser;

        return view('admin.advertisment.edit')->with($this->viewData);
    }

    /**
     * Update Category.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 03-01-2026
     */
    public function update(Request $request, $id)
    {
        $authUser = auth()->user();
        $category = null;
        $errorMessage = null;
        
        // Update Category
        DB::beginTransaction();
        try {
            $category = Advertisment::updateRecord($request);

            DB::commit();
        } 
        catch (\Exception $e) {
            $category = null;
            $errorMessage = $e->getMessage();
            DB::rollback();

            dd($e);
        }
        //------------

        if (!is_null($category)) 
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.records_updated', ['record' => 'Category']),
                '_type' => 'success',
            ];
            //-----------------

            return redirect()->route('admin.advertisment.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.records_updation_failed', ['record' => 'Category']),
                '_type' => 'error',
            ];
            //-----------------

            return redirect()->route('admin.advertisment.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
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
        $category = Advertisment::toggleStatus($request['ids']);

        // Set response
        if (!is_null($category))
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
        $category = Advertisment::whereIn('id', $ids)->get();

        // Delete child or sub categories if any
        if($category)
        {
            foreach($category as $key => $value)
            {
                // Delete Category
                $category = Advertisment::where('id', $value->id)->delete();
            }
        }
        
        // Set response
        if ($category == true) 
        {
            $response = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'Category']),
                '_type' => 'success',
            ];
        } 
        else 
        {
            $response = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'Category']),
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
        $category = Advertisment::where('id', $id)->first();

        dd($category);
        
        // Delete Category
        if($category)
        {
            // Delete Category
            $category = Advertisment::where('id', $id)->delete();
        }
        
        // Set notification
        if (!is_null($category))
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'Category']),
                '_type' => 'success',
            ];
            //---------------

            return redirect()->route('admin.category.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'Category']),
                '_type' => 'error',
            ];
            //---------------

            return redirect()->route('admin.category.index')->with(['notification' => $notification]);
        }
        //-------------

        return response()->json($response, 200);
    }

    /**
     * Check category mobile.
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
            $category = Advertisment::where('name', $request['name'])->first();

            if (!is_null($category)) 
            {
                if ($request->filled('category_id') && $category->id == $request['category_id']) {
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



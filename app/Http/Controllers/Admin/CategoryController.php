<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Category' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = 'Category';
        $this->viewData['breadcrumb'] = $breadcrumb;
        
        return view("admin.category.index")->with($this->viewData);
    }

    /**
     * Get Categories list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 03-01-2026
     */
    public function getCategories(Request $request)
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
        $records_count = Category::GetCategories(null, null, $search, $filter, $sort);
        $records = Category::GetCategories($limit, $start, $search, $filter, $sort);

        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $name = 'N/A';
                $parentCategoryName = 'N/A';
                $created = 'N/A';
                $status = '';
                $action = '';

                $name = $value->name ?? $name;
                $parentCategoryName = $value->parentCategory->name ?? $parentCategoryName;
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
                    <a class="dropdown-item" href="'.route('admin.category.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.category.deleteSingle', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';

                // Array Parent Data
                $arr_data[] = array(
                    "id" => $value->id,
                    "name" => $name,
                    "parent_category_name" => $parentCategoryName,
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
            'Category' => route('admin.category.index'),
            'Create' => '',
        ];

        // Get Parent Category
        $parentCategories = Category::select('id', 'name')
        ->where(function($query){
            $query->whereNull('parent_id');
            $query->orWhere('parent_id', 0);
        })
        ->get();

        // Send view data
        $this->viewData['pageTitle'] = 'Category';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['parentCategories'] = $parentCategories;

        return view('admin.category.create')->with($this->viewData);
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
            '_message' => __('messages.record_creation_failed', ['record' => 'Category']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.category.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create User
        try {
            $user = Category::saveRecord($request);

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
                '_message' => __('messages.record_created', ['record' => 'Category']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.category.index';
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
            $query->orWhere('parent_id', 0);
        })
        ->where('id', '!=', $id)
        ->get();

        // Category to edit
        $category = Category::where('categories.id', $id)->first();
        
        // Send view data
        $this->viewData['pageTitle'] = 'Category';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['parentCategories'] = $parentCategories;
        $this->viewData['category'] = $category;

        return view('admin.category.edit')->with($this->viewData);
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
            $category = Category::updateRecord($request);

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

            return redirect()->route('admin.category.index')->with(['notification' => $notification]);
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

            return redirect()->route('admin.category.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
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
        $category = Category::toggleStatus($request['ids']);

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
        $category = Category::whereIn('id', $ids)->get();

        // Delete child or sub categories if any
        if($category)
        {
            foreach($category as $key => $value)
            {
                // Delete Category
                $category = Category::where('id', $value->id)->delete();
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
        $category = Category::where('id', $id)->first();
        
        // Delete Category
        if($category)
        {
            // Delete Category
            $category = Category::where('id', $id)->delete();
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
            $category = Category::where('name', $request['name'])->first();

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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Category;

class UserController extends Controller
{
    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'User' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = 'User';
        $this->viewData['breadcrumb'] = $breadcrumb;
        
        return view("admin.users.index")->with($this->viewData);
    }

    /**
     * Get Users list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 04-08-2025
     */
    public function getUsers(Request $request)
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
            "filter_itr_status" => $request->filter_itr_status
        );

        // Get Users List
        $records_count = User::GetUsers(null, null, $search, $filter, $sort);
        $records = User::GetUsers($limit, $start, $search, $filter, $sort);

        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $name = 'N/A';
                $roleName = 'N/A';
                $email = 'N/A';
                $mobile = 'N/A';
                $created = 'N/A';
                $status = '';
                $action = '';

                $name = $value->name ?? $name;
                $roleName = $value->role_name ?? $roleName;
                $email = $value->email ?? $email;
                $mobile = $value->mobile ?? $mobile;
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
                            <a class="dropdown-item" href="'.route('admin.users.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                            <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.users.deleteSingle', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                          </div>
                        </div>';

                // Array Parent Data
                $arr_data[] = array(
                    "id" => $value->id,
                    "name" => $name,
                    "role_name" => $roleName,
                    "email" => $email,
                    "mobile" => $mobile,
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
     * View create Users.
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
            'User' => route('admin.users.index'),
            'Create' => '',
        ];

        // Get Roles list
        $roles = Role::select('id', 'name')
            ->whereNotIn('slug', ['admin'])
            ->get();

        // Send view data
        $this->viewData['pageTitle'] = 'User';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['roles'] = $roles;

        dd( $this->viewData);

        return view('admin.users.create')->with($this->viewData);
    }

    /**
     * Store User.
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
            '_message' => __('messages.record_creation_failed', ['record' => 'User']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.users.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create User
        try {
            $user = User::saveUser($request);

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
                '_message' => __('messages.record_created', ['record' => 'User']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.users.index';
        }

        return redirect()->route($redirectRoute)->with(['notification' => $notification]);
    }

    /**
     * Edit Customer.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function edit(Request $request, $id)
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'User' => route('admin.users.index'),
            'Edit' => '',
        ];

        // User to edit
        $user = User::where('users.id', $id)->first();

        // Get Roles list
        $roles = Role::select('id', 'name')
        ->whereNotIn('id', [
            config('constants.roles.ADMIN.value'),
            config('constants.roles.VENDOR.value')
        ])
        ->get();
        
        // Send view data
        $this->viewData['pageTitle'] = 'User';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['roles'] = $roles;
        $this->viewData['user'] = $user;

        return view('admin.users.edit')->with($this->viewData);
    }

    /**
     * Update Users.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function update(Request $request, $id)
    {
        $authUser = auth()->user();
        $user = null;
        $errorMessage = null;
        
        // Update User
        DB::beginTransaction();
        try {
            $user = User::updateUser($request);

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
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.records_updated', ['record' => 'User']),
                '_type' => 'success',
            ];
            //-----------------

            return redirect()->route('admin.users.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.records_updation_failed', ['record' => 'User']),
                '_type' => 'error',
            ];
            //-----------------

            return redirect()->route('admin.users.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }

    /**
     * Change status.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function changeStatus(Request $request)
    {
        $customer = User::toggleStatus($request['ids']);

        // Set response
        if (!is_null($customer))
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
     * @created_at 05-08-2025
     */
    public function destroy(Request $request)
    {
        $ids = $request['ids'];
        $user = User::whereIn('id', $ids)->get();

        // Delete child or sub categories if any
        if($user)
        {
            foreach($user as $key => $value)
            {
                // Delete User
                $user = User::where('id', $value->id)->delete();
            }
        }
        
        // Set response
        if ($user == true) 
        {
            $response = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'User']),
                '_type' => 'success',
            ];
        } 
        else 
        {
            $response = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'User']),
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
     * @created_at 05-08-2025
     */
    public function deleteSingle(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        
        // Delete User
        if($user)
        {
            // Delete User
            $user = User::where('id', $id)->delete();
        }
        
        // Set notification
        if (!is_null($user))
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'User']),
                '_type' => 'success',
            ];
            //---------------

            return redirect()->route('admin.users.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'User']),
                '_type' => 'error',
            ];
            //---------------

            return redirect()->route('admin.users.index')->with(['notification' => $notification]);
        }
        //-------------

        return response()->json($response, 200);
    }

    /**
     * Check user mobile.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 05-08-2025
     */
    public function checkUserMobile(Request $request)
    {
        $status = false;

        if (!is_null($request->mobile)) 
        {
            $user = User::where('mobile', $request['mobile'])->first();

            if (!is_null($user)) 
            {
                if ($request->filled('user_id') && $user->id == $request['user_id']) {
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
     * Check user email.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 05-08-2025
     */
    public function checkUserEmail(Request $request)
    {
        $status = false;

        if (!is_null($request->email)) 
        {
            $user = User::where('email', $request['email'])->first();

            if (!is_null($user)) 
            {
                if ($request->filled('user_id') && $user->id == $request['user_id']) {
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
     * View vendors list
     */
    public function vendors()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Agent' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = 'Agent';
        $this->viewData['breadcrumb'] = $breadcrumb;
        
        return view("admin.vendors.index")->with($this->viewData);
    }

    /**
     * Get Vendors list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 04-08-2025
     */
    public function getVendors(Request $request)
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

        // Get Vendors List
        $records_count = User::GetVendors(null, null, $search, $filter, $sort);
        $records = User::GetVendors($limit, $start, $search, $filter, $sort);

        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $businessName = 'N/A';
                $businessCategoryName = 'N/A';
                $email = 'N/A';
                $mobile = 'N/A';
                $stateName = 'N/A';
                $districtName = 'N/A';
                $cityName = 'N/A';
                $created = 'N/A';
                $status = '';
                $action = '';

                $businessName = $value->name ?? $businessName;
                $businessCategoryName = $value->business_category_name ?? $businessCategoryName;
                $email = $value->email ?? $email;
                $mobile = $value->mobile ?? $mobile;
                $stateName = $value->state_name ?? $stateName;
                $districtName = $value->district_name ?? $districtName;
                $cityName = $value->city_name ?? $cityName;
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
                            <a class="dropdown-item" href="'.route('admin.vendors.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                            <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.vendors.deleteSingleVendor', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                          </div>
                        </div>';

                // Array Parent Data
                $arr_data[] = array(
                    "id" => $value->id,
                    "business_name" => $businessName,
                    "business_category_name" => $businessCategoryName,
                    "email" => $email,
                    "mobile" => $mobile,
                    "state_name" => $stateName,
                    "district_name" => $districtName,
                    "city_name" => $cityName,
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
     * View create Users.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function createVendor()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Agent' => route('admin.vendors.index'),
            'Create' => '',
        ];

        // States
        $states = State::where('status', 1)->get();

        // Category
        $categories = Category::where('status', 1)->whereNull('parent_id')->get();

        // Send view data
        $this->viewData['pageTitle'] = 'Agent';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['states'] = $states;
        $this->viewData['categories'] = $categories;

        return view('admin.vendors.create')->with($this->viewData);
    }

    /**
     * Store User.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function storeVendor(Request $request)
    {
        // dd($request->all());
        $authUser = auth()->user();
        $user = null;
        $errorMessage = null;
        $notification = [
            '_status' => false,
            '_message' => __('messages.record_creation_failed', ['record' => 'Agent']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.vendors.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create User
        try {
            $user = User::saveVendor($request);

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
                '_message' => __('messages.record_created', ['record' => 'Agent']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.vendors.index';
        }

        return redirect()->route($redirectRoute)->with(['notification' => $notification]);
    }

    /**
     * Edit Vendor.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function editVendor(Request $request, $id)
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Agent' => route('admin.vendors.index'),
            'Edit' => '',
        ];

        // User to edit
        $user = User::where('users.id', $id)->first();

        // States
        $states = State::where('status', 1)->get();

        // Districts
        $districts = District::where('status', 1)->where('state_id', $user->state_id)->get();

        // Cities
        $cities = City::where('status', 1)
        ->where('state_id', $user->state_id)
        ->get();

        // Category
        $categories = Category::where('status', 1)->get();

        // Category
        $subCategories = Category::where('status', 1)->where('parent_id', $user->business_category_id)->get();

        // dd($user, $states, $districts, $cities);
        
        // Send view data
        $this->viewData['pageTitle'] = 'Agent';
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['user'] = $user;
        $this->viewData['states'] = $states;
        $this->viewData['districts'] = $districts;
        $this->viewData['cities'] = $cities;
        $this->viewData['categories'] = $categories;
        $this->viewData['subCategories'] = $subCategories;

        return view('admin.vendors.edit')->with($this->viewData);
    }

    /**
     * Update Vendors.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function updateVendor(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($request->user_id);

            // ---------- Image Upload ----------
            $imagePath = $user->profile_photo; // keep old image

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('upload/user_profile'), $imageName);
                $imagePath = 'upload/user_profile/'.$imageName;

                // full URL
                $profileImageUrl = asset('public/upload/user_profile/' . $imageName);
            }

            // ---------- Update Data ----------
            $data = [
                'name'            => $request->business_name,
                'business_name'   => $request->business_name,
                'mobile'          => $request->mobile,
                'email'           => $request->email,
                'state_id'        => $request->state_id,
                'district_id'     => $request->district_id,
                'city_id'         => $request->city_id,
                'address'         => $request->address,
                'pincode'         => $request->pincode,
                'category_id'     => $request->category_id,
                'business_sub_category_id' => $request->sub_category_id,
                'description'     => $request->description,
                'pick_your_location'    => $request->pick_your_location,
                'status'          => $request->status,
                'is_approved'     => $request->is_approved,
                'profile_photo'  => $profileImageUrl ?? $imagePath,
            ];

            $user->update($data);

            DB::commit();

            return redirect()
                ->route('admin.vendors.index')
                ->with('notification', [
                    '_status'  => true,
                    '_message' => 'Vendor updated successfully',
                    '_type'    => 'success',
                ]);

        } catch (\Exception $e) {
            DB::rollback();

            return back()
                ->withInput()
                ->with('notification', [
                    '_status'  => false,
                    '_message' => $e->getMessage(),
                    '_type'    => 'error',
                ]);
        }
    }

    /**
     * Check business name.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 05-08-2025
     */
    public function checkBusinessName(Request $request)
    {
        $status = false;

        if (!is_null($request->business_name)) 
        {
            $user = User::where('business_name', $request['business_name'])->first();

            if (!is_null($user)) 
            {
                if ($request->filled('user_id') && $user->id == $request['user_id']) {
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
     * Get states by district.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 05-08-2025
     */
    public function getDistrictsByState(Request $request)
    {
        $status = false;
        $message = "States not found.";
        $data = null;

        if($request->state_id){
            // Get States
            $districts = District::where('state_id', $request->state_id)->get();

            if($districts->count() > 0){
                $status = true;
                $message = "States found successfully.";
                $data = view('admin.vendors.get_districts')->with(['districts' => $districts])->render();
            }
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    /**
     * Get cities by district.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 05-08-2025
     */
    public function getCitiesByDistrict(Request $request)
    {
        $status = false;
        $message = "Cities not found.";
        $data = null;

        if($request->district_id){
            // Get States
            $cities = City::where('district_id', $request->district_id)->get();

            if($cities->count() > 0){
                $status = true;
                $message = "Cities found successfully.";
                $data = view('admin.vendors.get_cities')->with(['cities' => $cities])->render();
            }
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    /**
     * Get sub categories.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 05-08-2025
     */
    public function getSubCategories(Request $request)
    {
        $status = false;
        $message = "Sub categories not found.";
        $data = null;

        if($request->category_id){
            // Get States
            $categories = Category::where('parent_id', $request->category_id)->get();

            if($categories->count() > 0){
                $status = true;
                $message = "Categories found successfully.";
                $data = view('admin.vendors.get_sub_categories')->with(['subCategories' => $categories])->render();
            }
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    /**
     * Destroy.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 05-08-2025
     */
    public function destroyVendors(Request $request)
    {
        $ids = $request['ids'];
        $user = User::whereIn('id', $ids)->get();

        // Delete child or sub categories if any
        if($user)
        {
            foreach($user as $key => $value)
            {
                // Delete User
                $user = User::where('id', $value->id)->delete();
            }
        }
        
        // Set response
        if ($user == true) 
        {
            $response = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'Agent']),
                '_type' => 'success',
            ];
        } 
        else 
        {
            $response = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'Agent']),
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
     * @created_at 05-08-2025
     */
    public function deleteSingleVendor(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        
        // Delete User
        if($user)
        {
            // Delete User
            $user = User::where('id', $id)->delete();
        }
        
        // Set notification
        if (!is_null($user))
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'Agent']),
                '_type' => 'success',
            ];
            //---------------

            return redirect()->route('admin.vendors.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'Agent']),
                '_type' => 'error',
            ];
            //---------------

            return redirect()->route('admin.vendors.index')->with(['notification' => $notification]);
        }
        //-------------

        return response()->json($response, 200);
    }
}

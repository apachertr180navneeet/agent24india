<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Models\User;
use App\Models\Role;
use App\Models\Advertisment;
use Auth;

class RoleController extends Controller
{
    protected $pageTitle;

    public function __construct(){
        $this->pageTitle = 'Role';
    }
    
    public function index()
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Role' => ''
        ];

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        
        return view("admin.role.index")->with($this->viewData);
    }

    /**
     * Get list.
     *
     * @return response
     *
     * @author Rajesh
     * @created_at 14-01-2026
     */
    public function getRoles(Request $request)
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

        // Get List
        $records_count = Role::GetRoles(null, null, $search, $filter, $sort);
        $records = Role::GetRoles($limit, $start, $search, $filter, $sort);

        $arr_data = array();

        if(count($records) > 0)
        {
            foreach($records as $key => $value)
            {
                $name = 'N/A';
                $created = 'N/A';
                $status = '';
                $action = '-';

                $name = $value->name ?? $name;
                $created = date("d-m-Y H:i", strtotime($value->created_at));

                if($value->status == 1){
                    $status = '<label class="badge badge-success">Active</label> &nbsp;';
                } 
                else{
                    $status = '<label class="badge badge-warning">Inactive</label> &nbsp;';
                }

                $isRef = checkRecordReferenceByTable([
                    'main_table' => 'roles',
                    'conditions' => [
                        'roles.id = '.$value->id,
                    ],
                    'ref_tables' => [
                        'users' => [
                            'conditions' => [
                                'users.deleted_at is null'
                            ],
                        ],
                    ],
                ]);

                $action = '<div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu">';
                    if($isRef == 0){
                        $action .= '<a class="dropdown-item" href="'.route('admin.role.edit', ['id' => $value->id]).'"><i class="fa fa-pencil-alt"></i> Edit</a>
                    
                        <a class="dropdown-item text-danger dt-delete-single" data-url="'.route('admin.role.deleteSingle', ['id' => $value->id]).'" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>';
                    }
                    
                    $action .= '<a href="'.route('admin.role.permissions', ['id' => $value->id]).'" class="dropdown-item" href="javascript:;"><i class="fa fa-door"></i> Permissions</a>
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
            'Role' => route('admin.role.index'),
            'Create' => '',
        ];

        $user = Auth::user();

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;

        return view('admin.role.create')->with($this->viewData);
    }

    /**
     * Store.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function store(Request $request)
    {
        $authUser = auth()->user();
        $role = null;
        $errorMessage = null;
        $notification = [
            '_status' => false,
            '_message' => __('messages.record_creation_failed', ['record' => 'Role']),
            '_type' => 'error',
        ];
        $redirectRoute = 'admin.role.create';
        
        // Begin Transaction
        DB::beginTransaction();
        
        // Create User
        try {
            $user = Role::saveRecord($request);

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
                '_message' => __('messages.record_created', ['record' => 'Role']),
                '_type' => 'success',
            ];
            $redirectRoute = 'admin.role.index';
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
            'Role' => route('admin.role.index'),
            'Edit' => '',
        ];

        // User to edit
        $role = Role::where('roles.id', $id)->first();
        
        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['role'] = $role;


        return view('admin.role.edit')->with($this->viewData);
    }

    /**
     * Update.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function update(Request $request, $id)
    {
        $authUser = auth()->user();
        $role = null;
        $errorMessage = null;
        
        // Update User
        DB::beginTransaction();
        try {
            $role = Role::updateRecord($request);

            DB::commit();
        } catch (\Exception $e) {
            $role = null;
            $errorMessage = $e->getMessage();
            DB::rollback();

            dd($e);
        }
        //------------

        if (!is_null($role)) 
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.records_updated', ['record' => 'Role']),
                '_type' => 'success',
            ];
            //-----------------

            return redirect()->route('admin.role.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.records_updation_failed', ['record' => 'Role']),
                '_type' => 'error',
            ];
            //-----------------

            return redirect()->route('admin.role.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
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
        $role = Role::toggleStatus($request['ids']);

        // Set response
        if (!is_null($role))
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
        $roles = Role::whereIn('id', $ids)->get();

        $deleted = [];
        $notDeleted = [];

        if ($roles) {
            foreach ($roles as $value) {
                // If any user is assigned to this role, skip deletion
                $hasUsers = User::where('role_id', $value->id)->whereNull('deleted_at')->exists();

                if ($hasUsers) {
                    $notDeleted[] = $value->name ?? $value->id;
                    continue;
                }

                $res = Role::where('id', $value->id)->delete();
                if ($res) {
                    $deleted[] = $value->id;
                } else {
                    $notDeleted[] = $value->name ?? $value->id;
                }
            }
        }

        // Set response
        if (count($notDeleted) == 0 && count($deleted) > 0) {
            $response = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'Role']),
                '_type' => 'success',
            ];
        } elseif (count($deleted) > 0 && count($notDeleted) > 0) {
            $response = [
                '_status' => false,
                '_message' => 'Some roles were not deleted because they are assigned to users: ' . implode(', ', $notDeleted),
                '_type' => 'warning',
            ];
        } else {
            $response = [
                '_status' => false,
                '_message' => 'Roles could not be deleted. The following roles are assigned to users: ' . implode(', ', $notDeleted),
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
        $role = Role::where('id', $id)->first();
        
        // Delete
        if ($role) {
            $hasUsers = User::where('role_id', $role->id)->whereNull('deleted_at')->exists();

            if ($hasUsers) {
                $notification = [
                    '_status' => false,
                    '_message' => 'Role cannot be deleted because it is assigned to one or more users.',
                    '_type' => 'error',
                ];

                return redirect()->route('admin.role.index')->with(['notification' => $notification]);
            }

            // Delete 
            $role = Role::where('id', $id)->delete();
        }
        
        // Set notification
        if (!is_null($role))
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.record_deleted', ['record' => 'Role']),
                '_type' => 'success',
            ];
            //---------------

            return redirect()->route('admin.role.index')->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.record_failed', ['record' => 'Role']),
                '_type' => 'error',
            ];
            //---------------

            return redirect()->route('admin.role.index')->with(['notification' => $notification]);
        }
        //-------------

        return response()->json($response, 200);
    }

    /**
     * Check Name.
     *
     * @return boolean
     *
     * @author Rajesh
     * @created_at 05-08-2025
     */
    public function checkName(Request $request)
    {
        $status = false;

        if (!is_null($request->name)) 
        {
            $role = Role::where('name', $request['name'])->first();

            if (!is_null($role)) 
            {
                if ($request->filled('user_id') && $role->id == $request['role_id']) {
                    $status = true;
                } 
                else {
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
     * View Permissions.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Rajesh
     * @created 05-08-2025
     */
    public function permissions($roleId)
    {
        // Adding breadcrumb array
        $breadcrumb = [
            'Dashboard' => route('admin.dashboard'),
            'Role' => route('admin.role.index'),
            'Permission' => '',
        ];

        $user = Auth::user();
        $role = SpatieRole::find($roleId);
        // $permissions = $user->getAllPermissions();
        $permissions = SpatiePermission::get();
        $modules = $permissions->unique('module_name')->pluck('module_name');

        // Send view data
        $this->viewData['pageTitle'] = $this->pageTitle;
        $this->viewData['breadcrumb'] = $breadcrumb;
        $this->viewData['role'] = $role;
        $this->viewData['permissions'] = $permissions;
        $this->viewData['modules'] = $modules;

        return view('admin.role.permission')->with($this->viewData);
    }

    /**
     * Update permission.
     *
     * @return mixed
     *
     * @author Rajesh
     * @created 18-01-2026
     */
    public function updatePermissions(Request $request)
    {
        $authUser = auth()->user();
        $permission = null;
        $errorMessage = null;
        // dd($request->all());
        
        // Update User
        DB::beginTransaction();
        try {
            $roleId = $request->role_id;
            $permission = Role::updatePermissions($request);

            DB::commit();
        } catch (\Exception $e) {
            $permission = null;
            $errorMessage = $e->getMessage();
            DB::rollback();

            dd($e);
        }
        //------------

        if (!is_null($permission)) 
        {
            // Set notification
            $notification = [
                '_status' => true,
                '_message' => __('messages.records_updated', ['record' => 'Permission(s)']),
                '_type' => 'success',
            ];
            //-----------------

            return redirect()->route('admin.role.permissions', ['id' => $roleId])->withInput()->with(['notification' => $notification]);
        } 
        else 
        {
            // Set notification
            $notification = [
                '_status' => false,
                '_message' => __('messages.records_updation_failed', ['record' => 'Permission(s)']),
                '_type' => 'error',
            ];
            //-----------------

            // return redirect()->route('admin.role.permissions', ['id' => $id])->withInput()->with(['notification' => $notification]);
            return redirect()->route('admin.role.permissions', ['id' => $roleId])->withInput()->with(['notification' => $notification]);
        }
    }
}

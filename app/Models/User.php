<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\Contracts\OAuthenticatable;
use Laravel\Passport\HasApiTokens;
use App\Http\Traits\Orderable;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\UploadImage;
use App\Http\Traits\UploadFile;

class User extends Authenticatable implements OAuthenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes, Statusable, StatusToggleable, HasApiTokens, UploadImage, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'mobile',
        'gender',
        'username',
        'password',
        'address',
        'profile_photo',
        'status',
        'address',
        'business_name',
        'business_address',
        'business_category_id',
        'business_sub_category_id',
        'state_id',
        'district_id',
        'city_id',
        'email_verification_otp',
        'terms_agree',
        'is_approved',
        'pincode',
        'vendor_image',
        'description',
        'pick_your_location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function account_detail(){
        return $this->hasOne(UserAccountDetail::class, 'user_id', 'id');
    }

    public function businessCategory(){
        return $this->belongsTo(Category::class, 'business_category_id', 'id');
    }
    
    public function state(){
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    
    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    
    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * Get users list
     */
    public function scopeGetUsers($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $notInRoles = [
            config('constants.roles.ADMIN.value'),
            config('constants.roles.VENDOR.value')
        ];

        $records = User::select('users.id', 'users.role_id', 'users.name', 'users.email', 'users.mobile', 'users.gender', 'users.status', 'users.created_at', 'roles.name as role_name')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->where(function($query) use($notInRoles){
            $query->whereNotIn('users.role_id', $notInRoles);
            $query->whereNotNull('users.role_id');
        })
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(users.name) LIKE \'%'.$search.'%\' or lower(users.email) LIKE \'%'.$search.'%\' or lower(users.mobile) LIKE \'%'.$search.'%\'  or lower(roles.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "users.name",
                "roles.name",
                "users.email",
                "users.mobile",
                "users.created_at",
                "users.status",
                ""
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('users.id', 'desc');
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

    public function scopeSaveUser($model, $request)
    {
        // dd($request->all());
        // Get user
        $authUser = auth()->user();
        //----------

        $requestArray = $request->all();

        // Prepare data
        $data = [
            'role_id' => $requestArray['role_id'],
            'name' => $requestArray['name'],
            'mobile' => $requestArray['mobile'],
            'email' => $requestArray['email'],
            'address' => $requestArray['address'] ?? null,
            'password' => Hash::make($requestArray['password']),
            'status' => $requestArray['status'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $authUser->id,
            'updated_by' => $authUser->id
        ];
        $user = $this->create($data);

        if($user){
            $roleDetail = Role::find($request['role_id']);

            $user->assignRole($roleDetail->name);
        }

        return $user;
    }

    /**
     * Update user
     */
    public function scopeUpdateUser($model, $request)
    {
        $authUser = auth()->user();
        $user = null;
        
        $requestArray = $request->all();
        // dd($requestArray);

        // Get User
        $userData = User::where('id', $requestArray['user_id'])->first();

        if(!empty($userData))
        {
            // Prepare data
            $data = [
                'role_id' => $requestArray['role_id'],
                'name' => $requestArray['name'],
                'mobile' => $requestArray['mobile'],
                'email' => $requestArray['email'],
                'address' => $requestArray['address'] ?? null,
                'status' => $requestArray['status'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $authUser->id
            ];

            if(!empty($request["password"])){
                $data['password'] = Hash::make($requestArray['password']);
            }
            
            $user = $userData->update($data);
        }

        return $user;
    }

    /**
     * Get vendors list
     */
    public function scopeGetVendors($model, $limit = null, $offset = null, $search = null, $filter = array(), $sort = array())
    {
        $inRoles = [
            2, // Vendor
        ];

        $records = User::select('users.id', 'users.role_id', 'users.name', 'users.email', 'users.mobile', 'users.gender', 'users.status', 'users.created_at', 'users.business_category_id', 'roles.name as role_name', 'states.name as state_name', 'districts.name as district_name', 'cities.name as city_name', 'categories.name as business_category_name')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->join('states', 'states.id', '=', 'users.state_id')
        ->join('districts', 'districts.id', '=', 'users.district_id')
        ->join('cities', 'cities.id', '=', 'users.city_id')
        ->join('categories', 'categories.id', '=', 'users.business_category_id')
        ->where(function($query) use($inRoles){
            $query->whereIn('users.role_id', $inRoles);
        })
        ->where(function($query) use($search, $filter, $sort){
            // Search
            if(!(empty($search)))
            {
                $search = strtolower($search);
                $query->whereRaw('( lower(users.name) LIKE \'%'.$search.'%\' or lower(users.email) LIKE \'%'.$search.'%\' or lower(users.mobile) LIKE \'%'.$search.'%\'  or lower(roles.name) LIKE \'%'.$search.'%\' )');
            }
        });
        
        // Sort Columns Conditions
        if((!(empty($sort)) && $sort['column'] > 0) || !empty($search))
        {
            $arr_fields = array(
                "", 
                "users.business_name",
                "categories.name",
                "users.email",
                "users.mobile",
                "states.name",
                "districts.name",
                "cities.name",
                "users.created_at",
                "users.status",
                ""
            );

            if($arr_fields[$sort['column']] != "")
            {
                $records->orderBy($arr_fields[$sort['column']], $sort['dir']);
            }
        }
        else
        {
            $records->orderBy('users.id', 'desc');
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

    public function scopeSaveVendor($model, $request)
    {
        // dd($request->all());
        // Get user
        $authUser = auth()->user();
        //----------

        $requestArray = $request->all();

        // Prepare data
        $data = [
            'name' => $requestArray['business_name'],
            'business_name' => $requestArray['business_name'],
            'business_address' => $requestArray['address'],
            'business_category_id' => $requestArray['category_id'],
            'business_sub_category_id' => $requestArray['sub_category_id'],
            'pick_your_location' => $requestArray['pick_your_location'],
            'description' => $requestArray['description'],
            'state_id' => $requestArray['state_id'],
            'district_id' => $requestArray['district_id'],
            'city_id' => $requestArray['city_id'],
            'pincode' => $requestArray['pincode'],
            'is_approved' => $requestArray['is_approved'],
            'mobile' => $requestArray['mobile'],
            'email' => $requestArray['email'],
            'address' => $requestArray['address'] ?? null,
            'status' => $requestArray['status'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $authUser->id,
            'updated_by' => $authUser->id,
            'role_id' => '2', // Vendor
            'password' => Hash::make($requestArray['password']),
        ];

        // Upload image and add to data array
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            // Create folder if not exists
            $path = public_path('upload/user_profile');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Generate unique name
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Move image to public folder
            $image->move($path, $imageName);

            // Store FULL URL in DB
            $data['profile_photo'] = url('public/upload/user_profile/' . $imageName);
        }

        $user = $this->create($data);

        return $user;
    }

    public function scopeUpdateVendor($model, $request)
    {
        // dd($request->all());
        // Get user
        $authUser = auth()->user();
        //----------

        $requestArray = $request->all();

        // Get User
        $userData = User::where('id', $requestArray['user_id'])->first();

        if(!empty($userData))
        {
            // dd($requestArray);
            // Prepare data
            $data = [
                'name' => $requestArray['business_name'],
                'business_name' => $requestArray['business_name'],
                'business_address' => $requestArray['address'],
                'business_category_id' => $requestArray['category_id'],
                'business_sub_category_id' => $requestArray['sub_category_id'],
                'state_id' => $requestArray['state_id'],
                'district_id' => $requestArray['district_id'],
                'city_id' => $requestArray['city_id'],
                'pincode' => $requestArray['pincode'],
                'is_approved' => $requestArray['is_approved'],
                'mobile' => $requestArray['mobile'],
                'email' => $requestArray['email'],
                'address' => $requestArray['address'] ?? null,
                'status' => $requestArray['status'],
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $authUser->id
            ];

            // Upload image and add to data array
            if ($request->hasFile('image'))
            {
                if(!file_exists(storage_path("app/public/images/vendor/"))){
                    mkdir(storage_path("app/public/images/vendor/"), 0777, true);
                }
                else
                {
                    chmod(storage_path("app/public/images/vendor/"), 0777);
                }

                $image = $this->uploadImage($request->file('image'), "images/vendor/", 70, null);

                if ($image['_status']) 
                {
                    $imageName = $image['_data'];
                    $data['vendor_image'] = $imageName;
                }
            }

            $user = $userData->update($data);
        }
        
        return $user;
    }
}

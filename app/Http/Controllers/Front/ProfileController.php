<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Auth;
use DB;
use App\Models\OneTimePassword;
use App\Models\BusinessListing;
use App\Models\BusinessCategory;
use App\Models\District;
use App\Models\City;
use App\Models\State;
use App\Models\Category;
use App\Http\Traits\UploadImage;
use App\Http\Traits\UploadFile;
use App\Models\PaidListing;

class ProfileController extends Controller
{
    use UploadImage;

    function __construct(){
        //
    }

    public function index(){
        $user = Auth::user();

        $districts = District::where('status', 1)->get();

        $parentCategories = Category::where('status', 1)->whereNull('parent_id')->get();

        $subCategories = Category::where('status', 1)->where('parent_id', $user->business_category_id)->get();

        // Send view data
        $this->viewData['user'] = $user;
        $this->viewData['pageTitle'] = 'Profile';
        $this->viewData['parentCategories'] = $parentCategories;
        $this->viewData['subCategories'] = $subCategories;
        $this->viewData['districts'] = $districts;
        
        return view("front.profile")->with($this->viewData);
    }

    public function updateProfile(Request $request){
        
        $statename = ucfirst(strtolower($request->state_id));
        $state = State::where('name', $statename)->first();

        if(!$state){
            $state = State::create([
                'name' => $statename
            ]);
        }

        $state_id = $state->id;
        
        $cityname = ucfirst(strtolower($request->city_id));
        $city = City::where('name', $cityname)->where('state_id', $state_id)->first();
        
        if(!$city){
            $city = City::create([
                'name' => $cityname,
                'state_id' => $state_id
            ]);
        }
        $city_id = $city->id;

        $districtname = ucfirst(strtolower($request->district_id));

        $district = District::where('name', $districtname)->where('state_id', $state_id)->first();
        if(!$district){
            $district = District::create([
                'name' => $districtname,
                'state_id' => $state_id
            ]);
        }

        $district_id = $district->id;

        $user = Auth::user();
        

        // ===== FILE UPLOAD =====
        $profileImageUrl = $user->profile_photo; // keep old image if not uploaded
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // store in public/upload/user_profile
            $file->move(public_path('upload/user_profile'), $filename);

            // full URL
            $profileImageUrl = asset('public/upload/user_profile/' . $filename);
        }

        DB::beginTransaction();
        try{
            // Create User
            $data = [
                // 'role_id' => config('constants.roles.VENDOR.value'),
                'business_category_id' => $request->business_category_id,
                'name' => $request->business_name,
                'business_name' => $request->business_name,
                'mobile' => $request->contact_number,
                'business_address' => $request->business_address,
                'district_id' => $district_id,
                'city_id' => $city_id,
                'state_id' => $state_id,
                'pincode' => $request->pincode,
                'profile_photo' => $profileImageUrl,
                'description' => $request->description,
            ];

            
            $isUpdate = $user->update($data);

            if($user){
                DB::commit();
                return redirect()->route('front.profile')->with('profile_update_status', true);
            }

            return redirect()->route('front.profile')->with('profile_update_status', false);
        }
        catch(\Exception $e){
            DB::rollback();
            // dd($e);
        }
    }

    public function sendOtp(Request $request){
        // dd($request->all());

        $user = Auth::user();
        $status = false;
        $message = "Oops! Some error occurred, OTP cannot be sent";
        $data = null;

        DB::beginTransaction();
        try{
            $isExists = BusinessListing::where('contact_number', $request['contact_number'])
            ->where('full_name', $request['full_name'])
            ->where('user_id', $user->id)
            ->first();

            if($isExists){
                // Error show
                $message = "Oops! the entered 'Full Name' and 'Contact No.' already exists.";
            }
            else{
                // Store user
                $oneTimePassword = OneTimePassword::updateOrCreate([
                    'mobile_number'     => $request['contact_number'],
                ], [
                    'user_id'           => 1,
                    'one_time_password' => rand(1000, 9999),
                    'type'              => 'VERIFICATION',
                    'request_token'     => (string) Str::uuid(),
                    'expires_at'        => Carbon::now()->addMinutes(5)
                ]);
                //------------------------

                // Send SMS
                if (!empty($oneTimePassword)) {
                    // $this->sendSMS($oneTimePassword);
                    $status = true;
                    $data = $oneTimePassword->one_time_password;
                    $message = "OTP sent successfully.";
                }

                DB::commit();
            }
        }
        catch(\Exception $e){
            dd($e);
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
    }

    public function saveListing(Request $request){
        // dd($request->all());

        $user = Auth::user();
        $status = false;
        $message = "Oops! Some error occurred, listing cannot be saved.";
        $data = null;

        DB::beginTransaction();
        try{
            $userOtp = OneTimePassword::where('mobile_number',$request['contact_number'])->where('one_time_password',$request['otp'])->first();

            if(empty($userOtp) && $request['type'] == 'F'){
                $message = "Please enter a valid otp.";
            }
            else{
                $bannerImage = null;
                if($request['type'] == 'B'){
                    // Upload image and add to data array
                    if ($request->hasFile('banner_image'))
                    {
                        if(!file_exists(storage_path("app/public/images/banner/"))){
                            mkdir(storage_path("app/public/images/banner/"), 0777, true);
                        }
                        else
                        {
                            chmod(storage_path("app/public/images/banner/"), 0777);
                        }

                        $image = $this->uploadImage($request->file('banner_image'), "images/banner/", 70, null);

                        if ($image['_status']) 
                        {
                            $bannerImage = $image['_data'];
                        }
                    }
                }

                BusinessListing::create([
                    'user_id' => $user->id,
                    'full_name' => isset($request['full_name']) ? $request['full_name'] : null,
                    'home_city' => isset($request['home_city']) ? $request['home_city'] : null,
                    'contact_number' => isset($request['contact_number']) ? $request['contact_number'] : null,
                    'company_name' => isset($request['company_name']) ? $request['company_name'] : null,
                    'email' => isset($request['email']) ? $request['email'] : null,
                    'banner_title' => isset($request['banner_title']) ? $request['banner_title'] : null,
                    'banner_image' => $bannerImage,
                    'banner_target_url' => isset($request['banner_target_url']) ? $request['banner_target_url'] : null,
                    'type' => $request['type'],
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);

                DB::commit();

                $status = true;
                $message = "Listing saved successfully.";
            }
        }
        catch(\Exception $e){
            dd($e);
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
    }

    public function updateCategory(Request $request)
    {
        try {
            $user = Auth::user();

            // array ko comma separated string me convert karo
            $user->business_sub_category_id = is_array($request->business_sub_category_id)
                ? implode(',', $request->business_sub_category_id)
                : $request->business_category_id;

            $user->save();

            // categories fetch (multiple parent ids ke liye)
            $categoryIds = explode(',', $user->business_category_id);

            $categories = Category::whereIn('parent_id', $categoryIds)->get();

           
           return redirect()->back();
           
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update category'
            ]);
        }
    }


    public function freeListing(Request $request){
        $user = Auth::user();
        $status = false;
        $message = "Oops! Some error occurred, listing cannot be saved.";
        $data = null;

        DB::beginTransaction();
        try{
            PaidListing::create([
                'bussines_id' => $user->id,
                'home_city' => isset($request['home_city']) ? $request['home_city'] : null,
                'phone' => isset($request['contact_number']) ? $request['contact_number'] : null,
                'company_name' => isset($request['company_name']) ? $request['company_name'] : null,
                'type' => '1',
                'paid_type' => 'free',
            ]);

            $user->vendor_type = 'free';
            $user->save();

            DB::commit();

            
            return redirect()->back()->with('success', 'Free listing created successfully.');
            
        }
        catch(\Exception $e){
            dd($e);
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
    }


    public function paidListing(Request $request){

        dd($request->all());
        $user = Auth::user();
        $status = false;
        $message = "Oops! Some error occurred, listing cannot be saved.";
        $data = null;

        DB::beginTransaction();
        try{
            PaidListing::create([
                'bussines_id' => $user->id,
                'home_city' => isset($request['home_city']) ? $request['home_city'] : null,
                'phone' => isset($request['contact_number']) ? $request['contact_number'] : null,
                'company_name' => isset($request['company_name']) ? $request['company_name'] : null,
                'type' => '1',
                'paid_type' => 'free',
            ]);

            $user->vendor_type = 'free';
            $user->save();

            DB::commit();

            
            return redirect()->back()->with('success', 'Free listing created successfully.');
            
        }
        catch(\Exception $e){
            dd($e);
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\BusinessCategory;
use App\Models\District;
use App\Models\City;
use App\Models\State;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Advertisment;

class HomeController extends Controller
{
    function __construct(){
        //
    }

    public function index(){
        // Send view data
        $this->viewData['pageTitle'] = 'Home';

        $vendoruser = User::where('role_id', config('constants.roles.VENDOR.value'))->where('status', 1)->where('is_approved', 1)->get();

        $banner = Banner::where('status', 1)->get();

        $category = Category::where('status', 1)->whereNull('parent_id')->get();

        $district = District::where('status', 1)->get();


        $this->viewData['banner'] = $banner;
        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;
        $this->viewData['district'] = $district;
        
        return view("front.index")->with($this->viewData);
    }


    public function aboutus(){
        // Send view data
        $this->viewData['pageTitle'] = 'About Us';

        return view("front.about")->with($this->viewData);
    }


    public function termsAndConditions(){
        // Send view data
        $this->viewData['pageTitle'] = 'Terms & Conditions';

        return view("front.termsAndConditions")->with($this->viewData);
    }


    public function privacyPolicy(){
        // Send view data
        $this->viewData['pageTitle'] = 'Privacy Policy';

        return view("front.privacypolicy")->with($this->viewData);
    }


    public function contactus(){
        // Send view data
        $this->viewData['pageTitle'] = 'Contact Us';

        return view("front.contactus")->with($this->viewData);
    }


    public function vendorlist(){
        // Send view data
        $this->viewData['pageTitle'] = 'Vendor List';

        $vendoruser = User::where('role_id', config('constants.roles.VENDOR.value'))->where('status', 1)->where('is_approved', 1)->paginate(12);

        $category = Category::where('status', 1)->whereNull('parent_id')->get();

        $topadvertisments = Advertisment::where('status', 1)
                        ->where('sub_type', 'top')
                        ->get();

        $sideadvertisments = Advertisment::where('status', 1)
                ->where('sub_type', 'side')
                ->get();

        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;
        $this->viewData['topadvertisments'] = $topadvertisments;
        $this->viewData['sideadvertisments'] = $sideadvertisments;
        
        return view("front.vendorlist")->with($this->viewData);
    }


    public function vendorlistByLocation($location){
        // Send view data
        $this->viewData['pageTitle'] = 'Vendor List';

        $vendoruser = User::where('role_id', config('constants.roles.VENDOR.value'))->where('status', 1)->where('is_approved', 1)->where('district_id', $location)->paginate(12);
        $category = Category::where('status', 1)->whereNull('parent_id')->get();

        $topadvertisments = Advertisment::where('status', 1)
                ->where('sub_type', 'top')
                ->where('district', $location)
                ->get();

        $sideadvertisments = Advertisment::where('status', 1)
                ->where('sub_type', 'side')
                ->where('district', $location)
                ->get();

        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;
        $this->viewData['topadvertisments'] = $topadvertisments;
        $this->viewData['sideadvertisments'] = $sideadvertisments;
        
        return view("front.vendorlist")->with($this->viewData);
    }

    public function vendorlistByCategory($category){
        // Send view data
        $this->viewData['pageTitle'] = 'Vendor List';

        $vendoruser = User::where('role_id', config('constants.roles.VENDOR.value'))->where('status', 1)->where('is_approved', 1)->where('business_category_id', $category)->paginate(12);
        $categories = Category::where('status', 1)->whereNull('parent_id')->get();

        $topadvertisments = Advertisment::where('status', 1)
            ->where('sub_type', 'top')
            ->where('category', $category)
            ->get();

        $sideadvertisments = Advertisment::where('status', 1)
            ->where('sub_type', 'side')
            ->where('category', $category)
            ->get();

        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $categories;
        $this->viewData['topadvertisments'] = $topadvertisments;
        $this->viewData['sideadvertisments'] = $sideadvertisments;


        
        return view("front.vendorlist")->with($this->viewData);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('front.index');
    }

    public function signup(Request $request){

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
                'state_id' => $state_id,
                'city_id' => $city_id
            ]);
        }

        $district_id = $district->id;

        DB::beginTransaction();
        try{
            // Create User
            $data = [
                'role_id' => config('constants.roles.VENDOR.value'),
                'business_category_id' => $request->business_category_id,
                'name' => $request->business_name,
                'business_name' => $request->business_name,
                'email' => $request->email,
                'mobile' => $request->contact_number,
                'business_address' => $request->business_address,
                // 'district_id' => $request->district_id,
                // 'city_id' => $request->city_id,
                // 'state_id' => $request->state_id,
                'district_id' => $district_id,
                'city_id' => $city_id,
                'state_id' => $state_id,
                'pincode' => $request->pincode,
                'password' => Hash::make($request->password),
                // 'terms_agree' => $request->terms_agree,
                'terms_agree' => true,
            ];

            $user = User::create($data);
            // dd($user);

            if($user){
                DB::commit();
                return redirect()->route('front.index')->with('signup_status', true);
            }

            return redirect()->route('front.index')->with('signup_status', false);
        }
        catch(\Exception $e){
            DB::rollback();
            // dd($e);
        }
    }
}

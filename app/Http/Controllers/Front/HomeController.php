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
use App\Models\Cms;

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

        $districthome = District::where('status', 1)->where('is_home', 1)->orderBy('district_order', 'asc')->get();

        $district = District::where('status', 1)->get();


        $this->viewData['banner'] = $banner;
        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;
        $this->viewData['district'] = $district;
        $this->viewData['districthome'] = $districthome;
        
        return view("front.index")->with($this->viewData);
    }


    public function aboutus(){
        // Send view data
        $this->viewData['pageTitle'] = 'About Us';

        $this->viewData['about'] = Cms::where('id', '1')->first();

        return view("front.about")->with($this->viewData);
    }


    public function termsAndConditions(){
        // Send view data
        $this->viewData['pageTitle'] = 'Terms & Conditions';

        $this->viewData['termsAndConditions'] = Cms::where('id', '2')->first();

        return view("front.termsAndConditions")->with($this->viewData);
    }


    public function privacyPolicy(){
        // Send view data
        $this->viewData['pageTitle'] = 'Privacy Policy';

        $this->viewData['privacyPolicy'] = Cms::where('id', '3')->first();

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

        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;
        
        return view("front.vendordistrict")->with($this->viewData);
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

        $state_id = $request->state_id;
        
        
        $city_id = $request->city_id;

        
        $district_id = $request->district_id;

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

    public function getDistricts(Request $request)
    {
        return District::where('state_id', $request->state_id)
                        ->select('id', 'name')
                        ->get();
    }

    public function getCities(Request $request)
    {
        return City::where('district_id', $request->district_id)
                   ->select('id', 'name')
                   ->get();
    }


    public function vendordetail($id)
    {
        $this->viewData['pageTitle'] = 'Vendor Details';

        $vendoruser = User::select(
                'users.*',
                'bc.name as business_category_name',
                DB::raw('GROUP_CONCAT(bsc.name ORDER BY bsc.name SEPARATOR ", ") as business_sub_category_names'),
                'states.name as state_name',
                'districts.name as district_name',
                'cities.name as city_name'
            )
            ->leftJoin('categories as bc', 'bc.id', '=', 'users.business_category_id')
            ->leftJoin(
                'categories as bsc',
                DB::raw('FIND_IN_SET(bsc.id, users.business_sub_category_id)'),
                '>',
                DB::raw('0')
            )
            ->leftJoin('states', 'states.id', '=', 'users.state_id')
            ->leftJoin('districts', 'districts.id', '=', 'users.district_id')
            ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
            ->where('users.id', $id)
            ->groupBy('users.id')
            ->first();

        $category = Category::where('status', 1)
            ->whereNull('parent_id')
            ->get();

        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;

        return view('front.vendordetail')->with($this->viewData);
    }
}

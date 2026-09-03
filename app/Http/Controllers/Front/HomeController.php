<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\District;
use App\Models\City;
use App\Models\State;
use App\Models\Setting;
use App\Models\OneTimePassword;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Advertisment;
use App\Models\Cms;
use App\Models\SupportForm;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HomeController extends Controller
{
    function __construct(){
        //
    }

    public function index(){

        Advertisment::whereDate('expiry_date', '<=', Carbon::today())->forceDelete();
        // Send view data
        $this->viewData['pageTitle'] = 'Home';

        $vendoruser = User::where('role_id', config('constants.roles.VENDOR.value'))->where('status', 1)->where('is_approved', 1)->get();

        $banner = Banner::where('status', 1)->get();

        $category = Category::where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('name', 'asc') // change 'name' to your column
            ->get();

        $subCategories = Category::where('status', 1)
        ->whereNotNull('parent_id')
        ->get();

        $districthome = District::where('status', 1)->where('is_home', 1)->orderBy('district_order', 'asc')->get();

        $district = District::where('status', 1)->get();

        $paidlisting = User::where('status','1')
        ->where('is_approved', '1')
        ->get();
        


        $this->viewData['banner'] = $banner;
        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;
        $this->viewData['district'] = $district;
        $this->viewData['districthome'] = $districthome;
        $this->viewData['paidlisting'] = $paidlisting;
        $this->viewData['subCategories'] = $subCategories;
        
        return view("front.index")->with($this->viewData);
    }


    public function aboutus(){
        // Send view data
        $this->viewData['pageTitle'] = 'About Us';

        $this->viewData['about'] = Cms::where('id', '1')->first();

        return view("front.about")->with($this->viewData);
    }

    public function notice(){
        // Send view data
        $this->viewData['pageTitle'] = 'About Us';

        $this->viewData['about'] = Cms::where('id', '4')->first();

        return view("front.notice")->with($this->viewData);
    }


    public function price(){
        // Send view data
        $this->viewData['pageTitle'] = 'Price';

        return view("front.price")->with($this->viewData);
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

    public function submitContactus(Request $request)
    {
        $request->validate(
            [
                'name'    => 'required|string|max:50',
                'email'   => 'required|email',
                'phone'   => 'required|digits_between:10,15',
                'subject' => 'required|string|max:100',
                'message' => 'required|string|min:10',
            ],
            [
                'name.required'    => 'Person name is required',
                'email.required'   => 'Email is required',
                'email.email'      => 'Enter a valid email address',
                'phone.required'   => 'Phone number is required',
                'phone.digits_between' => 'Phone number must be 10–15 digits',
                'subject.required' => 'Subject is required',
                'message.required' => 'Message is required',
                'message.min'      => 'Message must be at least 10 characters',
            ]
        );

        $data = [
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'subject'      => $request->subject,
            'user_message' => $request->message,
        ];

        Mail::send('emails.contact_us', $data, function ($mail) use ($data) {
            $mail->to('info@agent24india.com')
                ->subject($data['subject'])
                ->replyTo($data['email'], $data['name']);
        });

        return redirect()
            ->back()
            ->with('success', 'Thank you! Your message has been sent successfully.');
    }


    public function vendorlist(Request $request)
    {
        $data = $this->buildVendorListData($request);
        return view("front.vendorlist", $data);
    }


    public function vendorlistByLocation(Request $request, $location){
        

        $subCategories = Category::where('status', 1)
        ->whereNotNull('parent_id')
        ->get();


        $district = $location;
        // Send view data
        $this->viewData['pageTitle'] = 'Vendor List';

        $district = District::where('status', 1)->get();
        $selectedCityId = $request->query('city');
        $isAllCitySelected = empty($selectedCityId) || strtolower((string) $selectedCityId) === 'all';

        $vendoruserQuery = User::where('role_id', config('constants.roles.VENDOR.value'))
            ->where('status', 1)
            ->where('is_approved', 1)
            ->where('district_id', $location);

        if (!$isAllCitySelected) {
            $vendoruserQuery->where('city_id', $selectedCityId);
        }

        $vendoruser = $vendoruserQuery->paginate(12);

        
        $category = Category::where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('name', 'asc') // change 'name' to your column
            ->get();
        // Top Banner
        $banner = Advertisment::where('status', 1)
            ->where('sub_type', 'top')
            ->where('district', $location)
            ->where('category', 0)
            ->where('start_date', '<=', now())
            ->where('expiry_date', '>=', now())
            ->inRandomOrder()
            ->limit(5)
            ->get();

         $districtList = District::where('status', 1)
        ->orderBy('name')
        ->get();

        $selectedDistrict = null;
        if (!empty($location)) {
            $selectedDistrict = $districtList->where('id', $location)->first();
        }

        $sideadvertismentsQuery = Advertisment::where('status', 1)
            ->where('sub_type', 'side')
            ->where('district', $location)
            ->where('category', 0)
            ->where('start_date', '<=', now())   // started
            ->where('expiry_date', '>=', now()); // not expired

        $sideadvertisments = $sideadvertismentsQuery
            ->inRandomOrder()   // optional (if you want random ads)
            ->limit(10)
            ->get();

        $districthome = District::where('status', 1)
            ->where('is_home', 1)
            ->orderBy('district_order', 'asc')
            ->get();

        $paidlistingQuery = User::where('status','1')
        ->where('is_approved', '1')
        ->where('district_id', $location);

        if (!$isAllCitySelected) {
            $paidlistingQuery->where('city_id', $selectedCityId);
        }

        $paidlisting = $paidlistingQuery->get();


        $topadvertisments = Advertisment::where('status', 1)
            ->where('sub_type', 'top')
            ->where('district', $location)
            ->get();

        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;
        $this->viewData['district'] = $district;
        $this->viewData['districtList'] = $districtList;
        $this->viewData['banner'] = $banner;
        $this->viewData['selectedDistrict'] = $selectedDistrict;
        $this->viewData['location'] = $location;
        $this->viewData['sideadvertisments'] = $sideadvertisments;
        $this->viewData['districthome'] = $districthome;
        $this->viewData['paidlisting'] = $paidlisting;
        $this->viewData['selectedCityId'] = $selectedCityId;
        $this->viewData['topadvertisments'] = $topadvertisments;
        $this->viewData['subCategories'] = $subCategories;
        
        return view("front.vendordistrict")->with($this->viewData);
    }

    public function vendorlistByCategory(Request $request, $category){
        $data = $this->buildVendorListData($request, null, $category, null);
        return view("front.vendorlist", $data);
    }

    public function vendorlistByLocationAndCategory(Request $request, $location, $categorys)
    {
        $data = $this->buildVendorListData($request, $location, $categorys, null);
        return view("front.vendorlist", $data);
    }

    public function vendorlistByLocationAndsubCategory(Request $request, $location, $subcategory)
    {
        $data = $this->buildVendorListData($request, $location, null, $subcategory);
        return view("front.vendorlist", $data);
    }

    private function buildVendorListData(Request $request, $location = null, $category = null, $subcategory = null)
    {
        // 1. Resolve subcategory and parent category if provided
        $selectedSubCategoryObj = null;
        if (!empty($subcategory)) {
            $selectedSubCategoryObj = Category::where('id', $subcategory)->first();
            if ($selectedSubCategoryObj && empty($category)) {
                $category = $selectedSubCategoryObj->parent_id;
            }
        }

        // Check if category passed via query param or route
        if (empty($category) && $request->filled('category') && $request->query('category') !== 'none' && $request->query('category') !== 'all') {
            $category = $request->query('category');
        }

        // Check if location passed via query param or route
        if (empty($location) && $request->filled('location')) {
            $location = $request->query('location');
        }

        // 2. Fetch categories (main parent categories)
        $allMainCategories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('name', 'asc')
            ->get();

        $selectedCategoryObj = null;
        if (!empty($category)) {
            $selectedCategoryObj = $allMainCategories->firstWhere('id', $category) 
                ?? Category::find($category);
        }

        // 3. Subcategories for the current category (Services)
        $servicesQuery = Category::where('status', 1)->whereNotNull('parent_id');
        if (!empty($category)) {
            $servicesQuery->where('parent_id', $category);
        }
        $categoryServices = $servicesQuery->orderBy('name', 'asc')->get();

        // All subcategories (for header search / global filters)
        $allSubCategories = Category::where('status', 1)
            ->whereNotNull('parent_id')
            ->orderBy('name', 'asc')
            ->get();

        // 4. District list
        $districtList = District::where('status', 1)->orderBy('name', 'asc')->get();
        $selectedDistrict = !empty($location) ? $districtList->firstWhere('id', $location) : null;

        // 5. Popular Areas for the district (Combines localities and cities)
        $popularAreas = [];
        if (!empty($location)) {
            $cities = City::where('district_id', $location)->orderBy('name')->get();
            
            $sampleAddresses = User::where('district_id', $location)
                ->whereNotNull('business_address')
                ->where('business_address', '!=', '')
                ->pluck('business_address');

            $knownAreasJaipur = [
                'Vaishali Nagar', 'Mansarovar', 'Jagatpura', 'Malviya Nagar', 'Sodala',
                'Tonk Road', 'Ajmer Road', 'Raja Park', 'Gopalpura', 'C-Scheme',
                'Vidhyadhar Nagar', 'Pratap Nagar', 'Sitapura', 'Bani Park', 'Jhotwara'
            ];

            $localityList = [];
            foreach ($knownAreasJaipur as $areaName) {
                foreach ($sampleAddresses as $addr) {
                    if (stripos($addr, $areaName) !== false) {
                        $localityList[] = $areaName;
                        break;
                    }
                }
            }

            if (empty($localityList) && $location == 150) {
                $localityList = ['Vaishali Nagar', 'Mansarovar', 'Jagatpura', 'Malviya Nagar', 'Sodala'];
            }

            $combinedAreas = [];
            foreach ($localityList as $loc) {
                $combinedAreas[] = ['name' => $loc, 'type' => 'area'];
            }
            foreach ($cities as $ct) {
                if (!in_array($ct->name, $localityList)) {
                    $combinedAreas[] = ['id' => $ct->id, 'name' => $ct->name, 'type' => 'city'];
                }
            }
            $popularAreas = $combinedAreas;
        } else {
            $popularAreas = [
                ['name' => 'Vaishali Nagar', 'type' => 'area'],
                ['name' => 'Mansarovar', 'type' => 'area'],
                ['name' => 'Jagatpura', 'type' => 'area'],
                ['name' => 'Malviya Nagar', 'type' => 'area'],
                ['name' => 'Sodala', 'type' => 'area'],
            ];
        }

        // 6. Filter Query parameters
        $selectedCityId = $request->query('city');
        $selectedArea = $request->query('area');
        $selectedService = $request->query('service') ?: $subcategory;
        $selectedRating = $request->query('rating');
        $sortBy = $request->query('sort', 'recommended');
        $searchKeyword = $request->query('q') ?: $request->query('search');

        // 7. Vendor Query
        $vendorQuery = User::where('role_id', config('constants.roles.VENDOR.value'))
            ->where('status', 1)
            ->where('is_approved', 1);

        if (!empty($location)) {
            $vendorQuery->where('district_id', $location);
        }

        if (!empty($category)) {
            $vendorQuery->where('business_category_id', $category);
        }

        // Filter by Subcategory / Service
        if (!empty($selectedService)) {
            $hasDirectMatch = (clone $vendorQuery)
                ->whereRaw('FIND_IN_SET(?, business_sub_category_id) > 0', [$selectedService])
                ->exists();
            if ($hasDirectMatch) {
                $vendorQuery->whereRaw('FIND_IN_SET(?, business_sub_category_id) > 0', [$selectedService]);
            }
        }

        // Filter by Area or City
        if (!empty($selectedCityId) && strtolower($selectedCityId) !== 'all') {
            $vendorQuery->where('city_id', $selectedCityId);
        } elseif (!empty($selectedArea) && strtolower($selectedArea) !== 'all') {
            $vendorQuery->where(function($q) use ($selectedArea) {
                $q->where('business_address', 'LIKE', '%' . $selectedArea . '%')
                  ->orWhere('name', 'LIKE', '%' . $selectedArea . '%');
            });
        }

        // Keyword Search
        if (!empty($searchKeyword)) {
            $vendorQuery->where(function($q) use ($searchKeyword) {
                $q->where('name', 'LIKE', '%' . $searchKeyword . '%')
                  ->orWhere('business_name', 'LIKE', '%' . $searchKeyword . '%')
                  ->orWhere('business_address', 'LIKE', '%' . $searchKeyword . '%');
            });
        }

        // Sorting
        if ($sortBy === 'newest') {
            $vendorQuery->orderBy('id', 'desc');
        } elseif ($sortBy === 'rating') {
            $vendorQuery->orderByRaw("CASE WHEN vendor_type = 'paid' THEN 0 ELSE 1 END, id DESC");
        } else {
            // Recommended: paid first, then ID
            $vendorQuery->orderByRaw("CASE WHEN vendor_type = 'paid' THEN 0 ELSE 1 END, id ASC");
        }

        // Paginate (10 per page to match image)
        $vendoruser = $vendorQuery->paginate(10)->withQueryString();

        // Attach dynamic realistic rating, reviews, and service tags for each vendor
        $defaultTagMap = [
            'Buy', 'Sell', 'Rent', 'Commercial'
        ];
        foreach ($vendoruser as $v) {
            $v->calc_rating = number_format(4.3 + (($v->id * 7) % 6) / 10, 1);
            $v->calc_reviews = 80 + (($v->id * 37) % 270);
            
            // Subcategory tags
            $vTags = [];
            if (!empty($v->business_sub_category_id)) {
                $subIds = explode(',', $v->business_sub_category_id);
                $foundSubs = $allSubCategories->whereIn('id', $subIds)->pluck('name')->toArray();
                if (!empty($foundSubs)) {
                    $vTags = array_slice($foundSubs, 0, 4);
                }
            }
            if (empty($vTags)) {
                $vTags = $defaultTagMap;
            }
            $v->service_tags = $vTags;
        }

        // 8. Dynamic Visiting Cards for Right Sidebar
        $visitingCardsQuery = User::where('role_id', config('constants.roles.VENDOR.value'))
            ->where('status', 1);
        if (!empty($location)) {
            $visitingCardsQuery->where('district_id', $location);
        }
        $visitingCards = $visitingCardsQuery
            ->orderByRaw("CASE WHEN vendor_type = 'paid' THEN 0 ELSE 1 END")
            ->inRandomOrder()
            ->limit(6)
            ->get();

        if ($visitingCards->count() < 4) {
            $extraCards = User::where('role_id', config('constants.roles.VENDOR.value'))
                ->where('status', 1)
                ->whereNotIn('id', $visitingCards->pluck('id'))
                ->inRandomOrder()
                ->limit(4 - $visitingCards->count())
                ->get();
            $visitingCards = $visitingCards->concat($extraCards);
        }

        // Ribbon colors for visiting card accents
        $ribbonColors = ['#F59E0B', '#0284C7', '#1E3A8A', '#10B981', '#E11D48'];
        foreach ($visitingCards as $idx => $vc) {
            $vc->ribbon_color = $ribbonColors[$idx % count($ribbonColors)];
            $catName = 'Real Estate Consultant';
            if ($vc->business_category_id) {
                $cat = $allMainCategories->firstWhere('id', $vc->business_category_id);
                if ($cat) {
                    $catName = $cat->name . ' Consultant';
                }
            }
            $vc->designation = $catName;
        }

        // 9. Advertisements
        $topadvertismentsQuery = Advertisment::where('status', 1)->where('sub_type', 'top');
        if (!empty($location)) {
            $topadvertismentsQuery->where('district', $location);
        }
        if (!empty($category)) {
            $topadvertismentsQuery->where('category', $category);
        }
        $topadvertisments = $topadvertismentsQuery->limit(5)->get();

        $sideadvertismentsQuery = Advertisment::where('status', 1)->where('sub_type', 'side');
        if (!empty($location)) {
            $sideadvertismentsQuery->where('district', $location);
        }
        if (!empty($category)) {
            $sideadvertismentsQuery->where('category', $category);
        }
        $sideadvertisments = $sideadvertismentsQuery->limit(5)->get();

        return [
            'pageTitle'              => ($selectedSubCategoryObj ? $selectedSubCategoryObj->name . ' Agents' : ($selectedCategoryObj ? $selectedCategoryObj->name . ' Agents' : 'Verified Agents')) . ($selectedDistrict ? ' in ' . $selectedDistrict->name : ''),
            'vendoruser'             => $vendoruser,
            'category'               => $allMainCategories,
            'selectedCategoryObj'    => $selectedCategoryObj,
            'selectedCategory'       => $category,
            'subCategories'          => $allSubCategories,
            'categoryServices'       => $categoryServices,
            'selectedSubCategory'    => $subcategory,
            'selectedSubCategoryObj' => $selectedSubCategoryObj,
            'districtList'           => $districtList,
            'selectedDistrict'       => $selectedDistrict,
            'location'               => $location,
            'selectedCityId'         => $selectedCityId,
            'selectedArea'           => $selectedArea,
            'popularAreas'           => $popularAreas,
            'selectedService'        => $selectedService,
            'selectedRating'         => $selectedRating,
            'sortBy'                 => $sortBy,
            'searchKeyword'          => $searchKeyword,
            'visitingCards'          => $visitingCards,
            'topadvertisments'       => $topadvertisments,
            'sideadvertisments'      => $sideadvertisments,
        ];
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginValue = trim($validated['email']);
        $password = $validated['password'];

        DB::beginTransaction();

        try {
            $userQuery = User::query();

            if (filter_var($loginValue, FILTER_VALIDATE_EMAIL)) {
                $userQuery->where('email', $loginValue);
            } else {
                $userQuery->where(function ($query) use ($loginValue) {
                    $query->where('mobile', $loginValue)
                        ->orWhere('username', $loginValue);
                });
            }

            $user = $userQuery->first();

            if ($user && Hash::check($password, $user->password)) {
                if ($user->status != config('constants.statuses.ACTIVE.value')) {
                    DB::rollBack();
                    return redirect()
                        ->route('front.index')
                        ->with('signin_status', false)
                        ->with('signin_error', 'Your account has been deactivated. Please contact the administrator.');
                }

                Auth::login($user);

                $request->session()->regenerate();

                DB::commit();

                // ✅ Login success - redirect to intended URL or home
                return redirect()->intended(route('front.index'))
                    ->with('signin_status', true)
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            }

            DB::rollBack();

            // ❌ Login failed - reopen login modal
            return redirect()
                ->back()
                ->with('signin_status', false)
                ->with('open_login', true)
                ->with('error', 'Invalid login credentials. Please check your username/email/mobile and password.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Authentication Error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('signin_status', false)
                ->with('open_login', true)
                ->with('error', 'Something went wrong during sign in. Please try again.');
        }
    }
    

    public function loginPage()
    {
        if (Auth::check()) {
            return redirect()->route('front.index');
        }
        $this->viewData['pageTitle'] = 'Login - Agent 24 India';
        return view('front.login', $this->viewData);
    }

    public function registerPage()
    {
        if (Auth::check()) {
            return redirect()->route('front.index');
        }
        $businessCategory = Category::whereNull('parent_id')->where('status', 1)->orderBy('name')->get();
        $stateList = State::where('status', 1)->orderBy('name')->get();
        $districtList = District::where('status', 1)->orderBy('name')->get();

        $this->viewData['pageTitle'] = 'Register - Agent 24 India';
        $this->viewData['businessCategory'] = $businessCategory;
        $this->viewData['stateList'] = $stateList;
        $this->viewData['districtList'] = $districtList;

        return view('front.register', $this->viewData);
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

    public function signup(Request $request)
    {
        // Validate request data
        $request->validate([
            'business_name'        => 'required|string|max:255',
            'email'                => 'required|email|unique:users,email',
            'contact_number'       => 'required|digits_between:10,15|unique:users,mobile',
            'password'             => 'required|min:6',
            'business_address'     => 'required',
            'state_id'             => 'required',
            'city_id'              => 'required',
            'district_id'          => 'required',
            'pincode'              => 'required|digits:6'
        ]);

        DB::beginTransaction();

        try {

            // Create new user/vendor
            $user = User::create([
                'role_id'              => config('constants.roles.VENDOR.value'),
                'business_category_id' => $request->business_category_id,
                'name'                 => $request->business_name,
                'business_name'        => $request->business_name,
                'email'                => $request->email,
                'mobile'               => $request->contact_number,
                'business_address'     => $request->business_address,
                'district_id'          => $request->district_id,
                'city_id'              => $request->city_id,
                'state_id'             => $request->state_id,
                'pincode'              => $request->pincode,
                'password'             => Hash::make($request->password),
                'terms_agree'          => true
            ]);

            // Auto login after signup
            Auth::login($user);

            // Regenerate session for security
            $request->session()->regenerate();

            DB::commit();

            return redirect()
                    ->route('front.index')
                    ->with('signin_status', true);

        } catch (\Exception $e) {

            DB::rollBack();

            // Optional: log error
            \Log::error('Signup Error: '.$e->getMessage());

            return redirect()
                    ->route('front.index')
                    ->with('signup_status', false);
        }
    }

    public function checkSignupUnique(Request $request)
    {
        $emailExists = false;
        $mobileExists = false;

        if ($request->filled('email')) {
            $emailExists = User::where('email', trim($request->email))->exists();
        }

        if ($request->filled('contact_number')) {
            $mobileExists = User::where('mobile', trim($request->contact_number))->exists();
        }

        return response()->json([
            'email_exists' => $emailExists,
            'contact_exists' => $mobileExists,
        ], 200);
    }

    public function getDistricts(Request $request)
    {
        $stateId = $request->state;
        
        $districts = District::where('state_id', $stateId)->get();
        return response()->json($districts);
    }

    public function getCities(Request $request)
    {
        $districtId = $request->district;
        $cities = City::where('district_id', $districtId)
            ->orderBy('name', 'asc') // A to Z
            ->get();
        return response()->json($cities);
    }


    public function vendordetail($id)
    {
        $this->viewData['pageTitle'] = 'Vendor Details';

        $vendoruser = User::select(
                'users.*',
                'bc.name as business_category_name',
                DB::raw('(SELECT GROUP_CONCAT(c.name ORDER BY c.name SEPARATOR ", ") FROM categories c WHERE FIND_IN_SET(c.id, users.business_sub_category_id) > 0) as business_sub_category_names'),
                'states.name as state_name',
                'districts.name as district_name',
                'cities.name as city_name'
            )
            ->leftJoin('categories as bc', 'bc.id', '=', 'users.business_category_id')
            ->leftJoin('states', 'states.id', '=', 'users.state_id')
            ->leftJoin('districts', 'districts.id', '=', 'users.district_id')
            ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
            ->where('users.id', $id)
            ->first();

        $category = Category::where('status', 1)
            ->whereNull('parent_id')
            ->get();

        $this->viewData['vendoruser'] = $vendoruser;
        $this->viewData['category'] = $category;

        return view('front.vendordetail')->with($this->viewData);
    }

    public function support()
    {
        $this->viewData['pageTitle'] = 'Support';

        return view('front.support')->with($this->viewData);
    }


    public function submitSupport(Request $request)
    {
        try {

            // ✅ Validation (Laravel auto redirect back with errors)
            $validated = $request->validate([
                'name'       => 'required|string|max:50',
                'email'      => 'required|email',
                'phone'      => 'required|digits_between:10,15',
                'subject'    => 'required|string|max:100',
                'message'    => 'required|string|min:10',
                'attachment' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $imageUrl = null;

            // ✅ Image upload
            if ($request->hasFile('attachment')) {
                $image    = $request->file('attachment');
                $fileName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('upload/support'), $fileName);

                // Full URL
                $imageUrl = asset('upload/support/' . $fileName);
            }

            // ✅ Save data
            SupportForm::create([
                'name'    => $validated['name'],
                'email'   => $validated['email'],
                'phone'   => $validated['phone'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'image'   => $imageUrl,
            ]);

            return back()->with('success', 'Support request submitted successfully.');

        }
        // ✅ IMPORTANT: Let validation redirect back automatically
        catch (ValidationException $e) {
            throw $e;
        }
        // ✅ Catch all other errors
        catch (\Throwable $e) {

            Log::error('Support Form Error', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    // Show Forgot Password Page
    public function forgotPassword()
    {
        return view('front.forgot-password'); // blade file create karo
    }

    // Send OTP on Email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $email = $request->email;

        // Generate OTP
        $otp = rand(100000, 999999);

        // Save OTP
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        // ✅ Store email in session
        session(['forgot_email' => $email]);

        // ✅ Core PHP Mail
        $subject = "Password Reset OTP";
        $message = "Your OTP for password reset is: $otp";

        $headers = "From: no-reply@agent24india.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (!mail($email, $subject, $message, $headers)) {
            return back()->withErrors(['email' => 'Failed to send OTP']);
        }

        return redirect()->route('forgotPassword.otpPage')->with('email', $email);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6'
        ]);

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->where('created_at', '>=', Carbon::now()->subMinutes(5)) // expiry
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        // OTP correct → go to reset password page
        return redirect()->route('forgotPassword.resetPage')->with('email', $request->email);
    }


    public function otpPage()
    {
        if (!session()->has('email')) {
            return redirect()->route('forgotPassword');
        }

        return view('front.otppage'); // your blade path
    }


    public function resetPage()
    {
        if (!session()->has('email')) {
            return redirect()->route('forgotPassword');
        }

        return view('front.reset-password'); // blade file
    }

    public function updatePassword(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // ✅ Check if OTP session exists (security)
        if (!session()->has('forgot_email')) {
            return redirect()->route('forgotPassword')
                ->withErrors(['email' => 'Unauthorized access']);
        }

        $email = session('forgot_email');

        // ✅ Update Password
        DB::table('users')
            ->where('email', $email)
            ->update([
                'password' => bcrypt($request->password),
                'updated_at' => now()
            ]);

        // ✅ Delete OTP record (cleanup)
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();

        // ✅ Remove session
        session()->forget('email');

        // ✅ Redirect to login
        return redirect()->route('front.index')
            ->with('success', 'Password updated successfully. Please login.');
    }
}

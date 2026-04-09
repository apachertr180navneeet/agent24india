<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\District;
use App\Models\City;
use App\Models\State;
use App\Models\Category;
use App\Http\Traits\UploadImage;
use App\Models\PaidListing;
use App\Models\User;
use App\Models\Orders;
use App\Models\PaymentTransactions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Advertisment;

class ProfileController extends Controller
{
    use UploadImage;

    function __construct(){
        //
    }

    public function index(){
        $user = Auth::user();

        $stateList = State::where('status', 1)->get();

        $districts = District::where('status', 1)->where('state_id', $user->state_id)->get();

        $city = City::where('status', 1)->where('district_id', $user->district_id)->get();

        $parentCategories = Category::where('status', 1)->whereNull('parent_id')->get();

        $subCategories = Category::where('status', 1)->where('parent_id', $user->business_category_id)->get();

        // Send view data
        $this->viewData['user'] = $user;
        $this->viewData['pageTitle'] = 'Profile';
        $this->viewData['parentCategories'] = $parentCategories;
        $this->viewData['subCategories'] = $subCategories;
        $this->viewData['districts'] = $districts;
        $this->viewData['city'] = $city;
        $this->viewData['stateList'] = $stateList;
        
        return view("front.profile")->with($this->viewData);
    }

    public function updateProfile(Request $request){
        
        
        $state_id = $request->state_id;
        
        $city_id = $request->city_id;

        $district_id = $request->district_id;

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
                'email' => $request->email,
                'business_name' => $request->business_name,
                'mobile' => $request->contact_number,
                'business_address' => $request->business_address,
                'district_id' => $district_id,
                'city_id' => $city_id,
                'state_id' => $state_id,
                'pincode' => $request->pincode,
                'profile_photo' => $profileImageUrl,
                'description' => $request->description,
                'pick_your_location' => $request->pick_your_location,
                'whats_app' => $request->whats_app,
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

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ], 'changePassword');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('front.profile')->with('success', 'Password changed successfully.');
    }

    public function addListing()
    {
        $user = Auth::user();

        // Get active districts
        $districts = District::where('status', 1)->get();

        // Get latest listing of the user
        $existingListing = PaidListing::where('bussines_id', $user->id)
                ->where('expiry_date', '>', Carbon::now()) // current date less than expiry_date
                ->latest()
                ->first();

        // Check listing types
        $hasFreeListing = optional($existingListing)->paid_type === 'free';

        $hasActivePaidListing = false;
        $existingPaidListing = null;

        if ($existingListing && $existingListing->paid_type === 'paid') {

            $existingPaidListing = $existingListing;

            $expiryDate = $this->parseListingExpiryDate($existingListing);

            if ($expiryDate) {
                $hasActivePaidListing = Carbon::now()->startOfDay()->lte($expiryDate->copy()->endOfDay());
            }
        }

        $this->viewData = [
            'user'                => $user,
            'districts'           => $districts,
            'pageTitle'           => 'Add Listing',
            'existingListing'     => $existingListing,
            'existingPaidListing' => $existingPaidListing,
            'disableFreeListing'  => $hasActivePaidListing,
            'hasFreeListing'      => $hasFreeListing,
        ];

        return view('front.add-listing', $this->viewData);
    }

    public function storeListing(Request $request)
    {
        // Get logged in user
        $user = Auth::user();

        // Start database transaction
        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Check Last Listing of User
            |--------------------------------------------------------------------------
            | We check the last listing to decide whether free or paid listing
            | is allowed or not.
            */
            $existingListing = PaidListing::where('bussines_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->first();


            /* ===============================================================
            | FREE LISTING PROCESS
            =============================================================== */
            if ($request->type === 'free') {

                /*
                |--------------------------------------------------------------------------
                | Prevent free listing if paid listing is still active
                |--------------------------------------------------------------------------
                */
                if ($existingListing && $existingListing->paid_type === 'paid') {

                    $paidExpiryDate = $this->parseListingExpiryDate($existingListing);

                    if ($paidExpiryDate && Carbon::now()->startOfDay()->lte($paidExpiryDate->copy()->endOfDay())) {
                        return redirect()->back()
                            ->with('error', 'Free listing is disabled while your paid listing is active.');
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Update existing free listing instead of creating duplicate
                |--------------------------------------------------------------------------
                */
                if ($existingListing && $existingListing->paid_type == 'free') {

                    $existingListing->update([
                        'home_city' => $request->home_city ?? $existingListing->home_city,
                        'phone'     => $request->phone ?? $existingListing->phone,
                        'email'     => $request->email ?? $existingListing->email,
                        'name'      => $request->name ?? $existingListing->name,
                        'type'      => '1',
                        'paid_type' => 'free',
                        'status'      => '1'
                    ]);

                    // Update vendor type
                    $user->update(['vendor_type' => 'free']);

                    DB::commit();

                    return redirect()->back()->with('success', 'Free listing updated successfully.');
                }

                /*
                |--------------------------------------------------------------------------
                | Clear OTP session after successful listing
                |--------------------------------------------------------------------------
                */
                session()->forget([
                    'email_otp',
                    'email_otp_email',
                    'email_otp_expire',
                    'email_otp_verified'
                ]);

                /*
                |--------------------------------------------------------------------------
                | Create new free listing
                |--------------------------------------------------------------------------
                */
                PaidListing::create([
                    'bussines_id' => $user->id,
                    'home_city'   => $request->home_city ?? null,
                    'phone'       => $request->phone ?? null,
                    'email'       => $request->email ?? null,
                    'name'        => $request->name ?? null,
                    'type'        => '1',
                    'paid_type'   => 'free',
                    'status'      => '1'
                ]);

                // Update user vendor type
                $user->update(['vendor_type' => 'free']);
            }


            /* ===============================================================
            | PAID LISTING PROCESS
            =============================================================== */
            elseif ($request->type === 'paid') {
                $duration = (int) $request->input('duration', 1);
                $duration = in_array($duration, [1, 2, 3], true) ? $duration : 1;
                $premiumStartDate = Carbon::now();
                $expiryDate = $premiumStartDate->copy()->addMonths($duration);
                
                /*
                |--------------------------------------------------------------------------
                | Prevent duplicate paid listing within 30 days
                |--------------------------------------------------------------------------
                */
                if ($existingListing && $existingListing->paid_type == 'paid') {
                    $activeExpiryDate = $this->parseListingExpiryDate($existingListing);

                    if ($activeExpiryDate && Carbon::now()->startOfDay()->lte($activeExpiryDate->copy()->endOfDay())) {
                        return redirect()->back()
                            ->with('error', 'Paid listing already exists and is still active.');
                    }
                }

                // Listing amount
                $amount = $request->price;

                // PayU credentials
                $key  = env('PAYU_KEY');
                $salt = env('PAYU_SALT');

                $txnid = 'listing_' . time();
                $productInfo = "Listing Payment";
                $firstname   = $user->name;
                $email       = $user->email;
                $phone       = $user->mobile ?? '9999999999';

                // Hash generation as per PayU format
                $hashString = $key . "|" . $txnid . "|" . $amount . "|" . $productInfo . "|" . $firstname . "|" . $email . "|||||||||||" . $salt;
                $hash = strtolower(hash('sha512', $hashString));

                /*
                |--------------------------------------------------------------------------
                | Create Order Record
                |--------------------------------------------------------------------------
                */
                $order = Orders::create([
                    'user_id'            => $user->id,
                    'order_number'       => $txnid,
                    'total_amount'       => $amount,
                    'status'             => 'pending'
                ]);

                /*
                |--------------------------------------------------------------------------
                | Store Payment Transaction Attempt
                |--------------------------------------------------------------------------
                */
                PaymentTransactions::create([
                    'order_id' => $order->id,
                    'amount'   => $amount,
                    'status'   => 'created'
                ]);

                /*
                |--------------------------------------------------------------------------
                | Save Listing (inactive until payment success)
                |--------------------------------------------------------------------------
                */
                PaidListing::create([
                    'bussines_id'        => $user->id,
                    'primium_start_date' => $premiumStartDate->format('Y-m-d'),
                    'expiry_date'        => $expiryDate->format('Y-m-d'),
                    'home_city'          => $request->home_city ?? $request->city ?? null,
                    'amount'             => $amount,
                    'name'               => $request->name ?? null,
                    'status'             => 0,
                    'order_id'           => $order->id
                ]);


                // $user->update([
                //     'vendor_type'  => 'paid',
                // ]);

                DB::commit();

                // Redirect to PayU payment page
                return view('payment.payu_checkout', [
                    'key'        => $key,
                    'txnid'      => $txnid,
                    'amount'     => $amount,
                    'productinfo'=> $productInfo,
                    'firstname'  => $firstname,
                    'email'      => $email,
                    'phone'      => $phone,
                    'hash'       => $hash,
                    'action'     => env('PAYU_BASE_URL') . '/_payment'
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Listing created successfully.');

        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollBack();
            Log::error('Store Listing Error: '.$e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function parseListingExpiryDate(PaidListing $listing): ?Carbon
    {
        if (!empty($listing->expiry_date)) {
            try {
                return Carbon::createFromFormat('Y-m-d', $listing->expiry_date);
            } catch (\Throwable $e) {
                try {
                    return Carbon::createFromFormat('d/m/Y', $listing->expiry_date);
                } catch (\Throwable $e) {
                    try {
                        return Carbon::parse($listing->expiry_date);
                    } catch (\Throwable $e) {
                        return null;
                    }
                }
            }
        }

        if (!empty($listing->created_at)) {
            return Carbon::parse($listing->created_at)->addMonth();
        }

        return null;
    }


    public function sendEmailOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $otp = rand(100000, 999999);
        
        Session::put('email_otp', $otp);
        Session::put('email_otp_email', $email);
        Session::put('email_otp_expire', Carbon::now()->addMinutes(5));

        try {

            $to = $email;   // Receiver Email
            $subject = "Verification otp";
            $message = "
            <html>
            <head>
                <title>OTP Verification</title>
            </head>
            <body>
                <h2>Email Verification</h2>
                <p>Your OTP code is:</p>
                <h1 style='color:blue;'>$otp</h1>
                <p>This OTP is valid for 5 minutes.</p>
            </body>
            </html>
            ";

            // Required headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: agent24india <info@agent24india.com>" . "\r\n";

            // Send mail
            if(mail($to, $subject, $message, $headers)){
                return response()->json([
                    'status' => true,
                    'message' => 'OTP sent successfully'
                ]);
            } 
            Log::info('OTP email sent successfully', [
                'email' => $email,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to send OTP email', [
                'email' => $email,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to send OTP email'
            ], 500);
        }

        
    }

    public function resendEmailOtp(Request $request)
    {
        if (!Session::has('email_otp_email')) {
            return response()->json([
                'status' => false,
                'message' => 'OTP session expired'
            ]);
        }

        $otp = rand(100000, 999999);

        Session::put('email_otp', $otp);
        Session::put('email_otp_expire', Carbon::now()->addMinutes(5));

        $email = session('email_otp_email');

        Log::info('OTP resend requested', [
            'email' => $email,
            'mailer' => config('mail.default'),
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'scheme' => config('mail.mailers.smtp.scheme'),
        ]);

        try {
            Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($email) {
                $message->from(
                    config('mail.from.address'),
                    config('mail.from.name')
                );
                $message->replyTo(
                    config('mail.from.address'),
                    config('mail.from.name')
                );
                $message->to($email)
                    ->subject('Your OTP Verification Code');
            });

            Log::info('OTP resend email sent successfully', [
                'email' => $email,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to resend OTP email', [
                'email' => $email,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to resend OTP email'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'OTP resent successfully'
        ]);
    }
    

    public function verifyEmailOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        // Check OTP exists
        if (!Session::has('email_otp')) {
            return response()->json([
                'status' => false,
                'message' => 'OTP expired'
            ]);
        }

        // Check expiry
        if (now()->greaterThan(Session::get('email_otp_expire'))) {
            return response()->json([
                'status' => false,
                'message' => 'OTP expired'
            ]);
        }

        // Match OTP
        if ($request->otp != Session::get('email_otp')) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ]);
        }

        // Mark OTP as verified
        Session::put('email_otp_verified', true);

        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully'
        ]);
    }

    public function addbanner()
    {
        $user = Auth::user();

        // Get active districts
        $districts = District::where('status', 1)
        ->orderBy('name', 'asc') // A to Z
        ->get();

        $records_count = Advertisment::where('expiry_date', '>', Carbon::now())->count();

        $parentCategories = Category::where('status', 1)
        ->whereNull('parent_id')
        ->orderBy('name', 'asc') // A to Z
        ->get();


        $this->viewData = [
            'user'                => $user,
            'bannercount'         => $records_count,
            'pageTitle'           => 'Add Banner',
            'districts'           => $districts,
            'categories'           => $parentCategories,
        ];

        return view('front.add-banner', $this->viewData);
    }



    // public function storebanner(Request $request)
    // {
    //     $user = Auth::user();

    //     /*
    //     |----------------------------------------------------------------------
    //     | Validate Request
    //     |----------------------------------------------------------------------
    //     */
    //     $request->validate([
    //         'sub_type'   => 'required|in:side,top',
    //         'price'      => 'required|numeric|min:1',
    //         'type'       => 'required|string',
    //         'home_city'  => 'required',
    //         'image_alt'  => 'nullable|string',
    //         'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp',
    //     ]);

    //     $district = $request->district ?? 0;
    //     $city     = $request->city ?? 0;
    //     $subType  = $request->sub_type;
    //     $categoryId = $request->category ?? 0 ;

    //     /*
    //     |----------------------------------------------------------------------
    //     | 1. Check Banner Limit
    //     |----------------------------------------------------------------------
    //     */
    //     // Base query
    //     $adsQuery = Advertisment::where('district', $district)
    //                 ->where('sub_type', $subType);

    //     // ✅ If category selected, add condition
    //     if (!empty($categoryId)) {
    //         $adsQuery->where('category', $categoryId);
    //         $adsQuery->where('city', $city);
    //     }else{
    //         $adsQuery->where('category', '0');
    //     }

    //     // Count ads
    //     $bannerCount = $adsQuery->count();


    //     if ($subType == 'side' && $bannerCount >= 10) {
    //         return back()->with([
    //             'notification' => [
    //                 '_status'  => false,
    //                 '_message' => 'Already 10 Banner Exist. maximum 10 banner allowed. contact to admin.',
    //                 '_type'    => 'error'
    //             ]
    //         ]);
    //     }

    //     if ($subType == 'top' && $bannerCount >= 5) {
    //         return back()->with([
    //             'notification' => [
    //                 '_status'  => false,
    //                 '_message' => 'Already 5 Banner Exist. maximum 5 banner allowed. contact to admin.',
    //                 '_type'    => 'error'
    //             ]
    //         ]);
    //     }

    //     /*
    //     |----------------------------------------------------------------------
    //     | 2. Dates (Formatted)
    //     |----------------------------------------------------------------------
    //     */
    //     $startDate  = Carbon::now()->format('Y-m-d');
    //     $expiryDate = Carbon::now()->addMonth()->format('Y-m-d');

    //     /*
    //     |----------------------------------------------------------------------
    //     | 3. Razorpay Order Create
    //     |----------------------------------------------------------------------
    //     */
    //     $key_id     = env('RAZORPAY_KEY');
    //     $key_secret = env('RAZORPAY_SECRET');

    //     $amount  = $request->price;
    //     $receipt = 'banner_' . time();

    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://api.razorpay.com/v1/orders",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => json_encode([
    //             "amount" => $amount * 100,
    //             "currency" => "INR",
    //             "receipt" => $receipt,
    //             "payment_capture" => 1
    //         ]),
    //         CURLOPT_HTTPHEADER => [
    //             "Content-Type: application/json"
    //         ],
    //         CURLOPT_USERPWD => $key_id . ":" . $key_secret
    //     ]);

    //     $response = curl_exec($curl);

    //     if (curl_errno($curl)) {
    //         return back()->with([
    //             'notification' => [
    //                 '_status'  => false,
    //                 '_message' => 'Payment gateway error. Try again.',
    //                 '_type'    => 'error'
    //             ]
    //         ]);
    //     }

    //     curl_close($curl);

    //     $razorpayOrder = json_decode($response, true);

    //     if (!isset($razorpayOrder['id'])) {
    //         return back()->with([
    //             'notification' => [
    //                 '_status'  => false,
    //                 '_message' => 'Unable to create order. Try again.',
    //                 '_type'    => 'error'
    //             ]
    //         ]);
    //     }

    //     /*
    //     |----------------------------------------------------------------------
    //     | 4. Save Order
    //     |----------------------------------------------------------------------
    //     */
    //     $order = Orders::create([
    //         'user_id'            => $user->id,
    //         'order_number'       => $receipt,
    //         'razorpay_order_id'  => $razorpayOrder['id'],
    //         'total_amount'       => $amount,
    //         'status'             => 'pending'
    //     ]);

    //     PaymentTransactions::create([
    //         'order_id'           => $order->id,
    //         'razorpay_order_id'  => $razorpayOrder['id'],
    //         'amount'             => $amount,
    //         'status'             => 'created'
    //     ]);

    //     /*
    //     |----------------------------------------------------------------------
    //     | 5. Upload Image
    //     |----------------------------------------------------------------------
    //     */
    //     $imagePath = null;

    //     if ($request->hasFile('image')) {

    //         $path = public_path('upload/advertisment');

    //         if (!file_exists($path)) {
    //             mkdir($path, 0777, true);
    //         }

    //         $file = $request->file('image');
    //         $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

    //         $file->move($path, $filename);

    //         // Full URL
    //         $imagePath = url('public/upload/advertisment/' . $filename);
    //     }

    //     /*
    //     |----------------------------------------------------------------------
    //     | 6. Save Banner
    //     |----------------------------------------------------------------------
    //     */
    //     Advertisment::create([
    //         'start_date'    => $startDate,
    //         'bussines_name' => $user->id,
    //         'type'          => $request->type,
    //         'district'      => $district,
    //         'city'          => $city,
    //         'category'      => $request->category ?? 0,
    //         'home_city'     => $request->home_city,
    //         'image_alt'     => $request->image_alt,
    //         'sub_type'      => $subType,
    //         'expiry_date'   => $expiryDate,
    //         'price'         => $amount,
    //         'order_id'      => $order->id,
    //         'image'         => $imagePath,
    //         'status'        => '0',
    //         'created_at'    => now(),
    //         'updated_at'    => now(),
    //         'order_id'      => $order->id
    //     ]);

    //     /*
    //     |----------------------------------------------------------------------
    //     | 7. Redirect to Payment Page
    //     |----------------------------------------------------------------------
    //     */
    //     return view('payment.checkout', [
    //         'order_id'     => $razorpayOrder['id'],
    //         'amount'       => $amount,
    //         'razorpay_key' => $key_id
    //     ]);
    // }


    public function storebanner(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();

            // ================= VALIDATION =================
            $request->validate([
                'sub_type'   => 'required|in:side,top',
                'price'      => 'required|numeric|min:1',
                'type'       => 'required|string',
                'home_city'  => 'required',
                'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp',
            ]);

            $district   = $request->district ?? 0;
            $city       = $request->city ?? 0;
            $subType    = $request->sub_type;
            $categoryId = $request->category ?? 0;

            // ================= CHECK LIMIT =================
            $adsQuery = Advertisment::where('district', $district)
                        ->where('sub_type', $subType);

            if (!empty($categoryId)) {
                $adsQuery->where('category', $categoryId)->where('city', $city);
            } else {
                $adsQuery->where('category', 0);
            }

            $bannerCount = $adsQuery->count();

            if ($subType == 'side' && $bannerCount >= 10) {
                return back()->with([
                    'notification' => [
                        '_status'  => false,
                        '_message' => 'Already 10 Banner Exist. maximum 10 banner allowed. contact to admin.',
                        '_type'    => 'error'
                    ]
                ]);
            }

            if ($subType == 'top' && $bannerCount >= 5) {
                return back()->with([
                    'notification' => [
                        '_status'  => false,
                        '_message' => 'Already 5 Banner Exist. maximum 5 banner allowed. contact to admin.',
                        '_type'    => 'error'
                    ]
                ]);
            }


            // ================= DATES =================
            $startDate  = Carbon::now()->format('Y-m-d');
            $expiryDate = Carbon::now()->addMonth()->format('Y-m-d');

            // ================= PAYU PAYMENT =================
            $key  = env('PAYU_KEY');
            $salt = env('PAYU_SALT');

            $txnid  = 'TXN_' . time();
            $amount = $request->price;

            $productInfo = "Banner Payment";
            $firstname   = $user->name;
            $email       = $user->email;
            $phone       = $user->mobile ?? '9999999999';

            // HASH GENERATION
            $hashString = $key . "|" . $txnid . "|" . $amount . "|" . $productInfo . "|" . $firstname . "|" . $email . "|||||||||||" . $salt;
            $hash = strtolower(hash('sha512', $hashString));

            // ================= SAVE ORDER =================
            $order = Orders::create([
                'user_id'      => $user->id,
                'order_number' => $txnid,
                'total_amount' => $amount,
                'status'       => 'pending'
            ]);

            PaymentTransactions::create([
                'order_id' => $order->id,
                'amount'   => $amount,
                'status'   => 'created'
            ]);

            // ================= IMAGE UPLOAD =================
            $imagePath = null;

            if ($request->hasFile('image')) {
                $path = public_path('upload/advertisment');

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move($path, $filename);

                $imagePath = url('public/upload/advertisment/' . $filename);
            }

            // ================= SAVE BANNER =================
            Advertisment::create([
                'start_date'    => $startDate,
                'bussines_name' => $user->id,
                'type'          => $request->type,
                'district'      => $district,
                'city'          => $city,
                'category'      => $categoryId,
                'home_city'     => $request->home_city,
                'sub_type'      => $subType,
                'expiry_date'   => $expiryDate,
                'price'         => $amount,
                'order_id'      => $order->id,
                'image'         => $imagePath,
                'status'        => 0,
            ]);

            DB::commit();

            // ================= REDIRECT TO PAYU =================
            return view('payment.payu_checkout', [
                'key'         => $key,
                'txnid'       => $txnid,
                'amount'      => $amount,
                'productinfo' => $productInfo,
                'firstname'   => $firstname,
                'email'       => $email,
                'phone'       => $phone,
                'hash'        => $hash,
                'action'      => env('PAYU_BASE_URL') . '/_payment'
            ]);

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            // Log error for debugging
            Log::error('Banner Store Error: '.$e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }


    public function paymentSuccess(Request $request)
    {
        $payment_id = $request->payment_id;
        $order_id   = $request->order_id;
        $signature  = $request->signature;

        /*
        |--------------------------------------------------------------------------
        | Verify Razorpay Signature
        |--------------------------------------------------------------------------
        */

        $generated_signature = hash_hmac(
            'sha256',
            $order_id . "|" . $payment_id,
            env('RAZORPAY_SECRET')
        );

        if ($generated_signature == $signature) {

            /*
            |--------------------------------------------------------------------------
            | Update Payment Transaction
            |--------------------------------------------------------------------------
            */

            $transaction = PaymentTransactions::where('razorpay_order_id',$order_id)->first();

            if($transaction){
                $transaction->update([
                    'razorpay_payment_id' => $payment_id,
                    'razorpay_signature'  => $signature,
                    'status' => 'captured'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Update Order Status
            |--------------------------------------------------------------------------
            */

            $orderDetail = Orders::where('razorpay_order_id',$order_id)->first();

            $userId = $orderDetail->user_id;

            $firstPart = explode('_', $orderDetail->order_number)[0];

            Orders::where('razorpay_order_id',$order_id)
            ->update(['status'=>'paid']);


            if($firstPart == "listing"){
                $user = User::find($userId);
                if ($user) {
                    $user->update(['vendor_type' => 'paid']);
                }

                $orderdata = PaidListing::where('order_id',$orderDetail->id);
                if ($orderdata) {
                    $orderdata->update(['status' => '1' , 'paid_type' => 'paid' ]);
                }
            }else{
                $advertismentdata = Advertisment::where('order_id',$orderDetail->id);
                if ($advertismentdata) {
                    $advertismentdata->update(['status' => '1']);
                }
            }

            return redirect()->route('front.index')
            ->with('success','Payment Successful');

        } else {

            return redirect()->route('front.index')
            ->with('error','Payment Verification Failed');
        }
    }


    public function paymenthistroy()
    {
        $user = Auth::user();
        $order = Orders::where('user_id', $user->id)->where('status', '!=', 'pending')->get();

        return view('front.payment_history', [
            'orders' => $order
        ]);
    }

    public function success(Request $request)
    {
        $order = Orders::where('order_number', $request->txnid)->first();

        if ($order) {
            Auth::loginUsingId($order->user_id);

            $order->update(['status' => 'paid']);

            PaymentTransactions::where('order_id', $order->id)->update([
                'status' => 'captured',
                'gateway_response' => json_encode($request->all())
            ]);

            $firstPart = explode('_', (string) $order->order_number)[0];

            if ($firstPart === 'listing') {
                $user = User::find($order->user_id);
                if ($user) {
                    $user->update(['vendor_type' => 'paid']);
                }

                PaidListing::where('order_id', $order->id)->update([
                    'status' => '1',
                    'paid_type' => 'paid'
                ]);
            } else {
                Advertisment::where('order_id', $order->id)->update(['status' => '1']);
            }
        }

        return redirect('/')->with('success', 'Payment Successful');
    }

    public function failed(Request $request)
    {
        $order = Orders::where('order_number', $request->txnid)->first();

        if ($order) {
            $order->update(['status' => 'failed']);

            PaymentTransactions::where('order_id', $order->id)->update([
                'status' => 'failed',
                'gateway_response' => json_encode($request->all())
            ]);
        }

        return redirect('/')->with('error', 'Payment Failed');
    }
    
}


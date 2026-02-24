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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

    public function addListing(){
    
        $user = Auth::user();

        $districts = District::where('status', 1)->get();

        $this->viewData['user'] = $user;
        $this->viewData['districts'] = $districts;
        $this->viewData['pageTitle'] = 'Add Listing';
        
        return view("front.add-listing")->with($this->viewData);
    }

    public function storeListing(Request $request)
    {
        $user = Auth::user();

        DB::beginTransaction();
        try {

            // 🔍 Check Existing Listing
            $existingListing = PaidListing::where('bussines_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->first();

            /* ================= FREE LISTING ================= */
            if ($request->type === 'free') {

                // Agar already free listing exist karti hai
                if ($existingListing && $existingListing->paid_type == 'free') {
                    return redirect()->back()
                        ->with('error', 'Free listing already exists.');
                }

                // Clear OTP Session
                session()->forget([
                    'email_otp',
                    'email_otp_email',
                    'email_otp_expire',
                    'email_otp_verified'
                ]);

                PaidListing::create([
                    'bussines_id' => $user->id,
                    'home_city'   => $request->home_city ?? null,
                    'phone'       => $request->phone ?? null,
                    'email'       => $request->email ?? null,
                    'name'        => $request->name ?? null,
                    'type'        => '1',
                    'paid_type'   => 'free',
                ]);

                $user->update(['vendor_type' => 'free']);
            }

            /* ================= PAID LISTING ================= */
            elseif ($request->type === 'paid') {

                if ($existingListing && $existingListing->paid_type == 'paid') {

                    $createdDate = Carbon::parse($existingListing->created_at);
                    $expiryDate  = $createdDate->copy()->addMonth();

                    // Agar 1 month complete nahi hua
                    if (Carbon::now()->lt($expiryDate)) {
                        return redirect()->back()
                            ->with('error', 'Paid listing already exists and is still active.');
                    }
                }

                $districtIds = isset($request->district_ids)
                    ? implode(',', $request->district_ids)
                    : null;

                PaidListing::create([
                    'bussines_id' => $user->id,
                    'paid_type'   => 'paid',
                    'type'        => $request->district_type ?? null,
                    'district'    => $districtIds,
                    'amount'      => $request->price ?? null,
                    'name'        => $request->name ?? null,
                ]);

                $user->update(['vendor_type' => 'paid']);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Listing created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
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
    
}

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteTitle ?? '' }} | @yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Jost:wght@400;500;600;700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/assets/css/prototype-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/front/assets/css/prototype-style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .tab-buttons .btn {
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            margin-right: 10px;
            transition: all 0.3s;
        }

        .tab-buttons .btn.active {
            background-color: #3b82f6;
            color: white;
        }

        .form-container {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-container .form-label {
            font-weight: 600;
        }

        .form-control:disabled {
            background-color: #e9ecef;
        }

        .confirm-btn,
        .send-otp-btn {
            background-color: #3b82f6;
            color: white;
            border-radius: 30px !important;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .confirm-btn:hover,
        .send-otp-btn:hover {
            background-color: #2563eb;
            color: white;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 45px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .toggle-password:hover {
            color: #000;
        }

        /* Auth Popup Modal Styles */
        .auth-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 25, 72, 0.7);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99999;
        }

        .auth-popup {
            background: #fff;
            border-radius: 16px;
            width: 520px;
            max-width: 92%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 32px 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            position: relative;
            text-align: center;
            animation: popupFadeIn 0.3s ease;
        }

        @keyframes popupFadeIn {
            from { opacity: 0; transform: translateY(-20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .close-btn1 {
            position: absolute;
            top: 14px;
            right: 18px;
            font-size: 26px;
            color: #64748B;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
        }

        .close-btn1:hover {
            color: #0F172A;
        }

        .auth-header .logo {
            max-height: 50px;
            margin-bottom: 16px;
        }

        .auth-tabs {
            display: flex;
            background: #F1F5F9;
            border-radius: 30px;
            padding: 4px;
            margin-bottom: 20px;
        }

        .auth-tabs .tab {
            flex: 1;
            padding: 9px 18px;
            border: none;
            background: transparent;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.25s;
        }

        .auth-tabs .tab.active {
            background: #004BEE;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0, 75, 238, 0.3);
        }

        .auth-form {
            display: none;
            text-align: left;
        }

        .auth-form.active {
            display: block;
        }

        .auth-form input,
        .auth-form select {
            width: 100%;
            height: 46px;
            padding: 10px 14px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            margin-bottom: 14px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
        }

        .auth-form input:focus,
        .auth-form select:focus {
            border-color: #004BEE;
            box-shadow: 0 0 0 3px rgba(0, 75, 238, 0.1);
        }

        .auth-form a {
            color: #004BEE;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 14px;
        }

        .auth-form a:hover {
            text-decoration: underline;
        }

        .auth-form button[type="submit"] {
            width: 100%;
            height: 48px;
            background: #004BEE;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 6px;
        }

        .auth-form button[type="submit"]:hover {
            background: #0036B8;
        }

        .or-login {
            text-align: center;
            font-size: 13px;
            color: #64748B;
            margin: 18px 0 10px;
        }

        .btn-secondary {
            width: 100%;
            padding: 10px;
            border: 1.5px solid #CBD5E1;
            background: #fff;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #1E293B;
            cursor: pointer;
            text-align: center;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #475569;
            margin: 10px 0 14px;
            cursor: pointer;
        }

        .custom-checkbox input {
            width: auto;
            height: auto;
            margin-bottom: 0;
        }
    </style>

    @stack('styles')
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9918904470832571"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    @php
        $categoryModel = new \App\Models\Category();
        $districtModel = new \App\Models\District();
        $cityModel = new \App\Models\City();
        $stateModel = new \App\Models\State();
        $businessCategory = $categoryModel->select('id', 'name')->whereNull('parent_id')->where('status', 1)->get();
        $districtList = $districtModel->select('id', 'name')->where('status', 1)->get();
        $cityList = $cityModel->select('id', 'name')->where('status', 1)->get();
        $stateList = $stateModel->select('id', 'name')->where('status', 1)->get();
    @endphp

    <!-- Start Header Area -->
    @include('front.layout.header')

    <div class="auth-overlay" id="authOverlay">
        <div class="auth-popup">
            <span class="close-btn1">&times;</span>
            <div class="auth-header">
                <img src="{{ asset('public/front/assets/images/logo/agent-india-logo2.png') }}" alt="Logo"
                    class="logo" />
            </div>

            <div class="auth-tabs">
                <button class="tab active" data-tab="signin">Sign In</button>
                <button class="tab" data-tab="signup">Sign Up</button>
            </div>
            <div class="auth-form active" id="signin">
                <form action="{{ route('front.login') }}" method="post" id="signin-form"
                    onsubmit="return validateSignin();">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="text" name="email" id="email" placeholder="Email or Mobile or Username" />
                    <div class="password-wrapper">
                        <input type="password" name="password" id="signin_password" placeholder="Password" />
                        
                        <span class="toggle-password" toggle="#signin_password">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                    <a href="{{ route('forgotPassword') }}">Forgot your password?</a>
                    <button type="submit" id="btn-signin">Sign In</button>
                </form>

                <div class="or-login">Already have an a account? </div>
                <button type="button" data-tab="signup" class="tab btn-secondary">
                    Sign Up
                </button>
            </div>
            <div class="auth-form" id="signup">
                <form action="{{ route('front.signup') }}" method="post" id="signup-form"
                    onsubmit="return validateSignup();">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- From your image -->
                    <div class="row d-flex">
                        <div class="col-lg-6">
                            <select name="business_category_id" id="business_category_id">
                                <option value="">Select Business Category</option>
                                @foreach ($businessCategory as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="business_name" id="business_name" placeholder="Business Name">
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col-lg-6">
                            <input type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="col-lg-6">
                            <input type="number" name="contact_number" id="contact_number"
                                placeholder="Contact Number">
                        </div>
                    </div>
                    <input type="text" name="business_address" id="business_address"
                        placeholder="Business Address">
                    <div class="row d-flex">
                        <div class="col-lg-6">
                            <select name="state_id" id="state_id">
                                <option value="">Select State</option>
                                @foreach ($stateList as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <select name="district_id" id="district_id">
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col-lg-6">
                            <select name="city_id" id="city_id">
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="pincode" id="pincode" placeholder="Pin Code">
                        </div>
                    </div>
                    <!-- <button type="submit" class="my-3 w-50">Email Verify OTP</button> -->
                    <div class="row d-flex">
                        <!-- <div class="col-lg-6">
                                <input type="text" name="otp" placeholder="OTP">
                            </div> -->
                        <div class="col-lg-6">
                            <div class="password-wrapper">
                                <input type="password" name="password" id="signup_password" placeholder="Password">

                                <span class="toggle-password" toggle="#signup_password">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="password-wrapper">
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">

                                <span class="toggle-password" toggle="#confirm_password">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <label class="custom-checkbox">
                        <input type="checkbox" id="terms_agree" name="terms_agree" required>
                        I Agree to
                        <a href="{{ route('front.termsAndConditions') }}" target="_blank"
                            style="padding-bottom: 0px;">Terms and Conditions</a>
                    </label>
                    <button type="submit" id="btn-submit-signup">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @if (session()->has('signin_status'))
        @if (session('signin_status') === true)
            <script>
                alert('Login successful');
            </script>
        @elseif(session('signin_status') === false)
            <script>
                alert('Invalid email or password');
            </script>
        @endif
    @endif

    @if (session('signup_status'))
        @if (session('signup_status') == true)
            <script>
                alert('Signup Successfully.');
            </script>
        @else
            <script>
                alert('Signup Failed.');
            </script>
        @endif
    @endif

    @if (session('profile_update_status'))
        @if (session('profile_update_status') == true)
            <script>
                alert('Profile updated successfully.');
            </script>
        @else
            <script>
                alert('Profile cannot be updated.');
            </script>
        @endif
    @endif

    @yield('content')

    <!-- Start Footer Area -->
    @include('front.layout.footer')
    <script src="{{ asset('public/front/assets/js/prototype-script.js') }}"></script>
    <script>
        $(document).on('click', '.toggle-password', function() {

            let input = $($(this).attr("toggle"));
            let icon = $(this).find("i");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }

        });
    </script>
    @stack('scripts')
</body>

</html>

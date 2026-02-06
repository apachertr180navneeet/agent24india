<!DOCTYPE html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$siteTitle ?? ''}} | @yield('title')</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/favicon.png" />

        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('public/front/assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/front/assets/css/LineIcons.2.0.css')}}" />
        <link rel="stylesheet" href="{{asset('public/front/assets/css/animate.css')}}" />
        <link rel="stylesheet" href="{{asset('public/front/assets/css/tiny-slider.css')}}" />
        <link rel="stylesheet" href="{{asset('public/front/assets/css/glightbox.min.css')}}" />
        <link rel="stylesheet" href="{{asset('public/front/assets/css/main.css')}}" />
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
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                margin-top: 20px;
            }
            .form-container .form-label {
                font-weight: 600;
            }
            .form-control:disabled {
                background-color: #e9ecef;
            }
            .confirm-btn, .send-otp-btn {
                background-color: #3b82f6;
                color: white;
                border-radius: 30px !important;
                padding: 8px 20px;
                font-weight: 500;
                transition: all 0.3s;
            }
            .confirm-btn:hover, .send-otp-btn:hover {
                background-color: #2563eb;
                color: white;
            }
        </style>

        @stack('styles')
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
                <img src="{{asset('public/front/assets/images/logo/agent-india-logo2.png')}}" alt="Logo" class="logo" />
            </div>

            <div class="auth-tabs">
                <button class="tab active" data-tab="signin">Sign In</button>
                <button class="tab" data-tab="signup">Sign Up</button>
            </div>
            <div class="auth-form active" id="signin">
                <form action="{{route('front.login')}}" method="post" id="signin-form" onsubmit="return validateSignin();">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <input type="text" name="email" id="email" placeholder="Username" />
                    <input type="password" name="password" id="password" placeholder="Password" />
                    <a href="#">Forgot your password?</a>
                    <button type="submit" id="btn-signin">Sign In</button>
                </form>
                
                <div class="or-login">Already have an a account? </div>
                    <button type="button" data-tab="signup" class="tab btn-secondary">
                        Sign Up
                    </button>
                </div>
                <div class="auth-form" id="signup">
                    <form action="{{route('front.signup')}}" method="post" id="signup-form" onsubmit="return validateSignup();">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- From your image -->
                        <div class="row d-flex">
                            <div class="col-lg-6">
                                <select name="business_category_id" id="business_category_id">
                                    <option value="">Select Business Category</option>
                                    @foreach($businessCategory as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
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
                                <input type="tel" name="contact_number" id="contact_number" placeholder="Contact Number">
                            </div>
                        </div>
                        <input type="text" name="business_address" id="business_address" placeholder="Business Address">
                        <div class="row d-flex">
                            <div class="col-lg-6">
                                <select name="state_id" id="state_id">
                                    <option value="">Select State</option>
                                    @foreach($stateList as $value)
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
                                <input type="password" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="col-lg-6">
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <label class="custom-checkbox">
                            <input type="checkbox" id="terms_agree" name="terms_agree"> I Agree to Terms and Conditions
                        </label>
                        <button type="submit" id="btn-submit-signup">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        @if(session('signup_status'))
            @if(session('signup_status') == true)
                <script>
                alert('Signup Successfully.');
                </script>
            @else
                <script>
                alert('Signup Failed.');
                </script>
            @endif
        @endif

        @if(session('profile_update_status'))
            @if(session('profile_update_status') == true)
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

        @stack('scripts')

        <script>
            const locationEl = document.getElementById('location');
            if (locationEl) {
                locationEl.addEventListener('change', function () {
                    let locationId = this.value;
                    if (locationId !== 'none') {
                        let url = "{{ route('front.vendorlist.location', ':id') }}";
                        url = url.replace(':id', locationId);
                        window.location.href = url;
                    }
                });
            }

            const categoryEl = document.getElementById('category');
            if (categoryEl) {
                categoryEl.addEventListener('change', function () {
                    let categoryId = this.value;
                    if (categoryId !== 'none') {
                        let url = "{{ route('front.vendorlist.category', ':id') }}";
                        url = url.replace(':id', categoryId);
                        window.location.href = url;
                    }
                });
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function () {

                // STATE CHANGE → DISTRICT LOAD
                $('#state_id').on('change', function () {
                    let state_id = $(this).val();

                    $('#district_id').html('<option value="">Loading...</option>');
                    $('#city_id').html('<option value="">Select City</option>');

                    if (state_id) {
                        $.ajax({
                            url: "{{ route('get.districts') }}",
                            type: "GET",
                            data: { state_id: state_id },
                            success: function (data) {
                                $('#district_id').html('<option value="">Select District</option>');
                                $.each(data, function (key, value) {
                                    $('#district_id').append(
                                        '<option value="'+value.id+'">'+value.name+'</option>'
                                    );
                                });
                            }
                        });
                    } else {
                        $('#district_id').html('<option value="">Select District</option>');
                    }
                });

                // DISTRICT CHANGE → CITY LOAD
                $('#district_id').on('change', function () {
                    let district_id = $(this).val();

                    $('#city_id').html('<option value="">Loading...</option>');

                    if (district_id) {
                        $.ajax({
                            url: "{{ route('get.cities') }}",
                            type: "GET",
                            data: { district_id: district_id },
                            success: function (data) {
                                $('#city_id').html('<option value="">Select City</option>');
                                $.each(data, function (key, value) {
                                    $('#city_id').append(
                                        '<option value="'+value.id+'">'+value.name+'</option>'
                                    );
                                });
                            }
                        });
                    } else {
                        $('#city_id').html('<option value="">Select City</option>');
                    }
                });

            });
        </script>
    </body>
</html>
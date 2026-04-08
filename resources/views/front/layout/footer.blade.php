@php
    $cmsModel = new \App\Models\Cms();
    $privacy = $cmsModel->where('id', 3)->first();
    $trem = $cmsModel->where('id', 2)->first();
    $about = $cmsModel->where('id', 1)->first();
@endphp

<footer class="footer">
    <!-- Start Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12 footer-logo1">
                        <img src="{{asset('public/front/assets/images/logo/agent-india-logo2.png')}}" alt="" class="footer-logo">
                                        </div>
                
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="single-footer f-link">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="{{route('front.index')}}">Home</a></li>
                            @if($about->status == 1)
                            <li><a href="{{route('front.aboutus')}}">About Us</a></li>
                            @endif
                            <li><a href="{{route('front.contactus')}}">Contact Us</a></li>
                            @if(\Auth::check())
                            <li><a href="{{route('front.profile')}}">Profile</a></li>
                            @endif

                            <li><a href="{{route('front.price')}}">Price</a></li>
                        </ul>
                    </div>
                </div>

                    <div class="col-lg-3 col-md-4 col-12">
                    <div class="single-footer f-link">
                        <h3>Support Links</h3>
                        <ul>
                            <li><a href="{{route('front.support')}}">Help & Support</a></li>
                            @if($trem->status == 1)
                            <li><a href="{{route('front.termsAndConditions')}}">Terms & Conditions</a></li>
                            @endif

                            @if($privacy->status == 1)
                            <li><a href="{{route('front.privacyPolicy')}}">Privacy Policy</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-12">
                    <div class="single-footer f-contact">
                        <h3>Contact</h3>
                        <ul>
                            <li>
                                <strong>AGENT 24 INDIA</strong><br>
                                Advertising Agency<br>
                                Jodhpur, Rajasthan
                            </li>

                            <li>
                                Email:<br>
                                info@agent24india.com<br>
                                contact@agent24india.com<br>
                                support@agent24india.com
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="inner">
                <div class="row d-flex">
                    <div class="col-lg-6 col-12">
                        <div class="content">
                           <p class="copyright-text">
                                © 2026 Agent 24 India. All Rights Reserved. <br>
                                Designed and Developed by 
                                <a href="https://syspoly.com/" rel="nofollow" target="_blank">
                                    SYSPOLY
                                </a>
                            </p>
                            </div>
                            </div>

                            <div class="col-lg-6 col-12">
                            <ul class="footer-social">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-youtube"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

</footer>

<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
</a>

<!-- jQuery -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>

{{--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  --}}

<!-- ========================= JS here ========================= -->
<script src="{{asset('public/front/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/front/assets/js/wow.min.js')}}"></script>
<script src="{{asset('public/front/assets/js/tiny-slider.js')}}"></script>
<script src="{{asset('public/front/assets/js/glightbox.min.js')}}"></script>
<script src="{{asset('public/front/assets/js/main.js')}}"></script>

<script type="text/javascript">
    function validateSignin()
    {
        var loginInput = $("#signin-form").find('#email').val();
        var password = $("#signin-form").find('#password').val();
        // var validEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if(!loginInput){
            alert("Please enter email, mobile, or username.");
            return false;
        }
        // else if(email && validEmail.test(email)){
        //     alert("Please enter valid email.");
        //     return false;
        // }
        else if(!password){
            alert("Please enter password.");
            return false;
        }

        return true;
    }

    function validateSignup() {

        let form = $("#signup-form");

        let businessCategoryId = form.find('#business_category_id').val();
        let businessName = form.find('#business_name').val().trim();
        let email = form.find('#email').val().trim();
        let contactNumber = form.find('#contact_number').val().trim();
        let businessAddress = form.find('#business_address').val().trim();
        let district = form.find('#district_id').val();
        let city = form.find('#city_id').val();
        let state = form.find('#state_id').val();
        let pincode = form.find('#pincode').val().trim();
        let password = form.find('#password').val();
        let confirmPassword = form.find('#confirm_password').val();

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Strong password regex
        let strongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

        if (!businessCategoryId) {
            alert("Select business category");
            return false;
        }

        if (!businessName) {
            alert("Enter business name");
            return false;
        }

        if (!email || !emailRegex.test(email)) {
            alert("Enter valid email");
            return false;
        }

        if (!contactNumber || !/^\d{10,15}$/.test(contactNumber)) {
            alert("Enter valid contact number (10-15 digits)");
            return false;
        }

        if (!businessAddress) {
            alert("Enter business address");
            return false;
        }

        if (!state) {
            alert("Select state");
            return false;
        }

        if (!district) {
            alert("Select district");
            return false;
        }

        if (!city) {
            alert("Select city");
            return false;
        }

        if (!pincode || !/^\d{6}$/.test(pincode)) {
            alert("Enter valid 6-digit pincode");
            return false;
        }

        if (!password) {
            alert("Enter password");
            return false;
        }

        if (!strongPassword.test(password)) {
            alert("Password must contain:\n- 8 characters\n- 1 uppercase\n- 1 lowercase\n- 1 number\n- 1 special character");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match");
            return false;
        }

        // AJAX UNIQUE CHECK
        let isValid = true;

        $.ajax({
            url: "{{ route('front.signup.checkUnique') }}",
            type: "POST",
            async: false,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: email,
                contact_number: contactNumber
            },
            success: function (res) {
                if (res.email_exists) {
                    alert("Email already exists");
                    isValid = false;
                }
                if (res.contact_exists) {
                    alert("Contact number already exists");
                    isValid = false;
                }
            },
            error: function () {
                alert("Server error. Try again.");
                isValid = false;
            }
        });

        return isValid;
    }
</script>

<script>
    $(document).ready(function () {

        // STATE → DISTRICT
        $('#state_id').change(function () {
            let stateId = $(this).val();
            $('#district_id').html('<option value="">Loading...</option>');
            $('#city_id').html('<option value="">Select City</option>');

            if (stateId) {
                $.ajax({
                    url: "{{ route('get.districts', ['state' => '__STATE__']) }}".replace('__STATE__', stateId),
                    type: 'GET',
                    success: function (data) {
                        let options = '<option value="">Select District</option>';
                        $.each(data, function (key, value) {
                            options += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('#district_id').html(options);
                    }
                });
            } else {
                $('#district_id').html('<option value="">Select District</option>');
            }
        });

        // DISTRICT → CITY
        $('#district_id').change(function () {
            let districtId = $(this).val();
            $('#city_id').html('<option value="">Loading...</option>');

            if (districtId) {
                $.ajax({
                    url: "{{ route('get.cities', ['district' => '__DISTRICT__']) }}".replace('__DISTRICT__', districtId),
                    type: 'GET',
                    success: function (data) {
                        let options = '<option value="">Select City</option>';
                        $.each(data, function (key, value) {
                            options += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('#city_id').html(options);
                    }
                });
            } else {
                $('#city_id').html('<option value="">Select City</option>');
            }
        });

    });
</script>

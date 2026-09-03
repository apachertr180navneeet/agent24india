@php
    $cmsModel = new \App\Models\Cms();
    $settingModel = new \App\Models\Setting();
    $privacy = $cmsModel->where('id', 3)->first();
    $trem = $cmsModel->where('id', 2)->first();
    $about = $cmsModel->where('id', 1)->first();
    $setting = $settingModel->orderBy('id', 'asc')->first();

    $dynamicLogo = null;
    if ($setting && !empty($setting->logo_image)) {
        $val = $setting->logo_image;
        $fn = basename(parse_url($val, PHP_URL_PATH) ?? $val);
        if ($fn && file_exists(public_path('upload/setting/' . $fn))) {
            $dynamicLogo = asset('public/upload/setting/' . $fn);
        } elseif (filter_var($val, FILTER_VALIDATE_URL)) {
            $dynamicLogo = $val;
        } else {
            $cleanPath = ltrim($val, '/');
            if (file_exists(public_path($cleanPath))) {
                $dynamicLogo = asset('public/' . $cleanPath);
            } else {
                $dynamicLogo = asset($cleanPath);
            }
        }
    }
    if (empty($dynamicLogo)) {
        $latestSettingLogo = glob(public_path('upload/setting/*.*'));
        if (!empty($latestSettingLogo)) {
            usort($latestSettingLogo, function($a, $b) {
                return filemtime($b) - filemtime($a);
            });
            $dynamicLogo = asset('public/upload/setting/' . basename($latestSettingLogo[0]));
        }
    }
@endphp

<!-- Footer Start -->
<footer class="site-footer">
    <div class="section-container">
        <div class="footer-grid">

            <!-- Brand Info Column -->
            <div class="footer-col brand-col">
                <a href="{{route('front.index')}}" class="brand-logo" style="text-decoration: none;" title="{{ $setting->logo_title ?? 'Agent 24 India' }}">
                    @if(!empty($dynamicLogo))
                        <div class="footer-logo-wrapper" style="background: #ffffff; padding: 6px 14px; border-radius: 8px; display: inline-flex; align-items: center; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                            <img src="{{ $dynamicLogo }}" alt="{{ $setting->logo_title ?? 'Agent 24 India' }}" style="height: 36px; max-width: 180px; object-fit: contain;">
                        </div>
                    @else
                        <div class="logo-icon-wrapper">
                            <svg width="38" height="38" viewBox="0 0 50 50" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 40L24 10L36 40H28L24 29L20 40H12Z" fill="#0066FF" />
                                <path d="M18.5 33H29.5L24 19L18.5 33Z" fill="#FFFFFF" />
                                <circle cx="28" cy="11" r="4.5" fill="#FFB800" />
                            </svg>
                        </div>
                        <div class="logo-text-group">
                            <div class="brand-name">
                                <span class="white-text">{{ $setting->logo_title ?? 'AGENT 24 INDIA' }}</span>
                            </div>
                            <span class="brand-tagline light-tagline">Sahi Agent, Sahi Connection</span>
                        </div>
                    @endif
                </a>
                <p class="footer-desc">Bharat ka sabse trusted aur verified Agent Directory platform. Aapki zarurat,
                    aapke city ka sahi agent!</p>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{route('front.index')}}">Home</a></li>
                    @if($about && $about->status == 1)
                        <li><a href="{{route('front.aboutus')}}">About Us</a></li>
                    @endif
                    <li><a href="#verifiedAgents">Top Agents</a></li>
                    <li><a href="#rajasthanDistricts">Capital Districts</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    @if($trem && $trem->status == 1)
                        <li><a href="{{route('front.price')}}">Price Plans</a></li>
                    @endif
                </ul>
            </div>

            <!-- Categories -->
            <div class="footer-col">
                <h4 class="footer-heading">Popular Categories</h4>
                <ul class="footer-links">
                    <li><a href="{{route('front.vendorlist')}}">Real Estate Agents</a></li>
                    <li><a href="{{route('front.vendorlist')}}">Automobile Agents</a></li>
                    <li><a href="{{route('front.vendorlist')}}">RTO Service Agents</a></li>
                    <li><a href="{{route('front.vendorlist')}}">Insurance Advisors</a></li>
                    <li><a href="{{route('front.vendorlist')}}">Legal Consultants</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-col">
                <h4 class="footer-heading">Contact Support</h4>
                <ul class="footer-contact-list">
                    <li>📍 Jodhpur & Jaipur, Rajasthan, India</li>
                    <li>📞 +91 98765 43210</li>
                    <li>✉️ agent24india@gmail.com</li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© {{ date('Y') }} {{ $setting->logo_title ?? 'AGENT 24 INDIA' }}. All rights reserved. Sahi Agent, Sahi Connection.</p>
        </div>
    </div>
</footer>
<!-- Footer End -->

<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
</a>

<!-- jQuery -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
<!-- Select2 JS -->
<script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

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
        var password = $("#signin-form").find('#signin_password').val();
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
        let password = form.find('#signup_password').val();
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

        // Initialize Select2 in Auth Popup Modal
        function initModalSelect2() {
            if ($('#authOverlay').length && $.fn.select2) {
                $('#business_category_id, #state_id, #district_id, #city_id').select2({
                    dropdownParent: $('#authOverlay .auth-popup'),
                    width: '100%'
                });
            }
        }

        initModalSelect2();

        // Re-initialize or adjust Select2 when modal / tabs opened
        $(document).on('click', '.open-signin, .open-signup, .tab', function() {
            setTimeout(function() {
                initModalSelect2();
            }, 100);
        });

        // Initialize general select2 on any elements with .select2 or select-styled
        if ($.fn.select2) {
            $('select.select2').select2({
                width: '100%'
            });
        }

        // STATE → DISTRICT
        $('#state_id').change(function () {
            let stateId = $(this).val();
            $('#district_id').html('<option value="">Loading...</option>').trigger('change.select2');
            $('#city_id').html('<option value="">Select City</option>').trigger('change.select2');

            if (stateId) {
                $.ajax({
                    url: "{{ route('get.districts', ['state' => '__STATE__']) }}".replace('__STATE__', stateId),
                    type: 'GET',
                    success: function (data) {
                        let options = '<option value="">Select District</option>';
                        $.each(data, function (key, value) {
                            options += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('#district_id').html(options).trigger('change.select2');
                    }
                });
            } else {
                $('#district_id').html('<option value="">Select District</option>').trigger('change.select2');
            }
        });

        // DISTRICT → CITY
        $('#district_id').change(function () {
            let districtId = $(this).val();
            $('#city_id').html('<option value="">Loading...</option>').trigger('change.select2');

            if (districtId) {
                $.ajax({
                    url: "{{ route('get.cities', ['district' => '__DISTRICT__']) }}".replace('__DISTRICT__', districtId),
                    type: 'GET',
                    success: function (data) {
                        let options = '<option value="">Select City</option>';
                        $.each(data, function (key, value) {
                            options += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('#city_id').html(options).trigger('change.select2');
                    }
                });
            } else {
                $('#city_id').html('<option value="">Select City</option>').trigger('change.select2');
            }
        });

    });
</script>

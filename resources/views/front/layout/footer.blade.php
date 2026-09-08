@php
    $privacy = $sitePrivacy ?? null;
    $trem = $siteTerms ?? null;
    $about = $siteAbout ?? null;
    $setting = $siteSetting ?? null;
    $dynamicLogo = $siteLogo ?? null;
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
                    <li><a href="#rajasthanDistricts">Important Cities</a></li>
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

<!-- Mobile Bottom Navigation Bar Start -->
<div class="mobile-bottom-nav" id="mobileBottomNav">
    <!-- 1. Home -->
    <a href="{{ route('front.home') }}" class="mob-nav-item {{ request()->routeIs('front.home') || request()->routeIs('front.index') ? 'active' : '' }}">
        <div class="mob-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </div>
        <span class="mob-nav-label">Home</span>
    </a>

    <!-- 2. Special Offers -->
    <a href="{{ route('front.price') }}" class="mob-nav-item {{ request()->routeIs('front.price') ? 'active' : '' }}">
        <div class="mob-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.65-.5-.65C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1h-2.22l.8-1.08C13.84 4.37 14.39 4 15 4zM9 4c.61 0 1.16.37 1.42.92L11.22 6H9c-.55 0-1-.45-1-1s.45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76V14h2V8.76L15.38 12 17 10.83 14.92 8H20v6z"/>
            </svg>
        </div>
        <span class="mob-nav-label">Special Offers</span>
    </a>

    <!-- 3. Direct Agent -->
    <a href="{{ route('front.vendorlist') }}" class="mob-nav-item {{ request()->routeIs('front.vendorlist*') && !request()->has('type') ? 'active' : '' }}">
        <div class="mob-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
        </div>
        <span class="mob-nav-label">Direct Agent</span>
    </a>

    <!-- 4. Area Agent (Highlighted Pill Card) -->
    <a href="{{ route('front.vendorlist') }}" class="mob-nav-item mob-nav-pill-btn">
        <div class="mob-nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
        </div>
        <span class="mob-nav-label">Area Agent</span>
    </a>
</div>

<style>
    /* Mobile Bottom Navigation Styles */
    .mobile-bottom-nav {
        display: none;
    }

    @media (max-width: 991px) {
        body {
            padding-bottom: 68px !important;
        }

        .mobile-bottom-nav {
            display: flex;
            align-items: center;
            justify-content: space-around;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: #FFFFFF;
            border-top: 1px solid #E2E8F0;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.08);
            z-index: 9999;
            padding: 4px 8px;
        }

        .mob-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #475569;
            gap: 2px;
            flex: 1;
            padding: 4px 6px;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-align: center;
        }

        .mob-nav-item .mob-nav-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            color: inherit;
        }

        .mob-nav-item .mob-nav-label {
            font-size: 11px;
            font-weight: 600;
            line-height: 1.1;
            color: inherit;
            white-space: nowrap;
        }

        .mob-nav-item:hover,
        .mob-nav-item.active {
            color: #004BEE;
        }

        /* Highlighted Area Agent Blue Pill Button */
        .mob-nav-item.mob-nav-pill-btn {
            background: #004BEE;
            color: #FFFFFF !important;
            border-radius: 12px;
            padding: 6px 12px;
            flex: 0 0 auto;
            min-width: 76px;
            box-shadow: 0 4px 12px rgba(0, 75, 238, 0.35);
        }

        .mob-nav-item.mob-nav-pill-btn .mob-nav-label {
            color: #FFFFFF !important;
            font-weight: 700;
            font-size: 11.5px;
        }

        .mob-nav-item.mob-nav-pill-btn .mob-nav-icon {
            color: #FFFFFF !important;
        }

        .mob-nav-item.mob-nav-pill-btn:hover {
            background: #0036B8;
            transform: translateY(-1px);
        }
    }
</style>
<!-- Mobile Bottom Navigation Bar End -->

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

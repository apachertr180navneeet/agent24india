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
                            <li>23 New Design Str,<br> Jodhpur, Rajasthan</li>
                            <li>Tel. +91 91193 36617 <br> Mail. info@agent24india.com, support@agent24india.com</li>
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
                            <p class="copyright-text">Designed and Developed by <a href="https://syspoly.com/"
                                    rel="nofollow" target="_blank">SYSPOLY</a>
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

    function validateSignup()
    {
        var businessCategoryId = $("#signup-form").find('#business_category_id').val();
        var businessName = $("#signup-form").find('#business_name').val();
        var email = $("#signup-form").find('#email').val();
        var contactNumber = $("#signup-form").find('#contact_number').val();
        var businessAddress = $("#signup-form").find('#business_address').val();
        var district = $("#signup-form").find('#district_id').val();
        var city = $("#signup-form").find('#city_id').val();
        var state = $("#signup-form").find('#state_id').val();
        var pincode = $("#signup-form").find('#pincode').val();
        var password = $("#signup-form").find('#password').val();
        var confirmPassword = $("#signup-form").find('#confirm_password').val();
        // var validEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if(!businessCategoryId){
            alert("Please select the business category.");
            return false;
        }
        else if(!businessName){
            alert("Please enter the business name.");
            return false;
        }
        else if(!email){
            alert("Please enter the email.");
            return false;
        }
        else if(!contactNumber){
            alert("Please enter the contact number.");
            return false;
        }
        else if(!businessAddress){
            alert("Please enter the business address.");
            return false;
        }
        else if(!district){
            alert("Please enter the district.");
            return false;
        }
        else if(!city){
            alert("Please enter the city.");
            return false;
        }
        else if(!state){
            alert("Please enter the state.");
            return false;
        }
        else if(!pincode){
            alert("Please enter the pincode.");
            return false;
        }
        else if(!password){
            alert("Please enter password.");
            return false;
        }
        else if(!confirmPassword){
            alert("Please enter confirm password.");
            return false;
        }
        else if(password.length < 6){
            alert("Password must be at least 6 characters long.");
            return false;
        }
        else if(password !== confirmPassword){
            alert("Password and confirm password must be same.");
            return false;
        }

        return true;
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

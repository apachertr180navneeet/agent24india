@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<style>
    img#previewImage {
        width: 50% !important;
    }
</style>
@endpush

@section('content')
@php
        $categoryModel = new \App\Models\Category();
        $businessCategory = $categoryModel->select('id', 'name')->where('status', 1)->get();
        @endphp
    <!-- profile -->
    <div class="profile-wrapper">
        <form id="update-profile-form" action="{{route('front.updateProfile')}}" method="post" enctype="multipart/form-data" onsubmit="return validateProfileUpdate();">
            @csrf()
            <div class="profile-card">
                <!-- Left Image Upload -->
                <div class="profile-left">
                    <div class="profile-image">
                        <img id="previewImage"
                            src="{{ $user->profile_photo ? $user->profile_photo : asset('public/images/images.png') }}"
                            alt="Profile Image">
                    </div>
                    <label class="upload-btn">
                        Upload Image
                        <input type="file" accept="image/*" name="profile_image" onchange="previewFile(this)" hidden>
                    </label>
                </div>
                <!-- Right Form -->
                <div class="profile-right">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Business Category *</label>
                            {{-- <input type="text" id="business_category_id" name="business_category_id" placeholder="Business Category" value="{{$user->businessCategory->name}}"> --}}
                            <select name="business_category_id" id="business_category_id">
                                <option value="">Select Business Category</option>
                                @foreach($businessCategory as $key => $value)
                                    <option value="{{$value->id}}" {{$user->business_category_id == $value->id ? 'selected' :''}}>{{$value->name}}</option>
                                @endforeach
                                <!-- Add more categories as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Contact Number *</label>
                            <input type="text" id="contact_number" name="contact_number" placeholder="Contact Number" value="{{$user->mobile}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Business Name *</label>
                            <input type="text" id="business_name" name="business_name" placeholder="Business Name" value="{{$user->business_name}}">
                        </div>
                        <div class="form-group">
                            <label>District *</label>
                            <input type="text" id="district_id" name="district_id" placeholder="District" value="{{$user->district->name}}">
                        </div>
                    </div>
                    <div class="form-group full">
                        <label>Address *</label>
                        <input type="text" id="business_address" name="business_address" placeholder="Address" value="{{$user->business_address}}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>City *</label>
                            <input type="text" id="city_id" name="city_id" placeholder="City" value="{{$user->city->name}}">
                        </div>
                        <div class="form-group">
                            <label>State *</label>
                            <input type="text" id="state_id" name="state_id" placeholder="State" value="{{$user->state->name}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Pincode *</label>
                            <input type="text" id="pincode" name="pincode" placeholder="Pincode" value="{{$user->pincode}}">
                        </div>
                        <div class="form-group">
                            <label>Pick Your Location *</label>
                            <input type="text" placeholder="Pick Your Location">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="btn-update-profile">Update Profile</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="tags-box">
            <h4 class="tags-title">Tags</h4>
            <div class="tags-row">
                <div class="tag-field">
                    <label>Category:</label>
                    <select>
                        <option>Travel</option>
                        <option>RTO</option>
                        <option>Food</option>
                    </select>
                </div>

                <div class="tag-field">
                    <label>Sub Category:</label>
                    <select>
                        <option>Car Travel</option>
                        <option>Bike Travel</option>
                        <option>Bus Travel</option>
                    </select>
                </div>
            </div>

            <div class="selected-tags">
                <span class="tag-pill">
                    Car Travel <span class="remove">&times;</span>
                </span>
                <span class="tag-pill">
                    Bike Travel <span class="remove">&times;</span>
                </span>
                <span class="tag-pill">
                    Bus Travel <span class="remove">&times;</span>
                </span>
            </div>
        </div>

        <div class="desc-box">
            <h4 class="desc-title">DESCRIPTION</h4>
            <textarea class="desc-textarea" placeholder="Enter description here..." ></textarea>
        </div>
    </div>


    <div class="container">
        <!-- Tab Buttons -->
        <div class="tab-buttons mb-3">
            <button class="btn active" id="tab-btn-free" data-target="free">Free Listing Ad</button>
            <button class="btn" id="tab-btn-paid" data-target="paid">Paid Listing Ad</button>
            <button class="btn" id="tab-btn-banner" data-target="banner">Banner Ad</button>
        </div>

        <!-- Forms -->
        <div class="form-container">
            <!-- Free Listing Ad Form -->
            <form id="free" class="ad-form" method="post">
                @csrf

                <input type="hidden" name="type" value="F" />

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter Your Name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Home City</label>
                        <input type="text" class="form-control" id="home_city" name="home_city" placeholder="City">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Phone Number">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">OTP</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="otp" name="otp" placeholder="OTP" disabled>
                        <button type="submit" class="btn send-otp-btn" data-send-otp-url="{{route('front.sendOtp')}}">Send OTP</button>
                        <button type="submit" class="btn confirm-btn d-none" data-save-listing-url="{{route('front.saveListing')}}">Confirm</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Paid Listing Ad Form -->
            <form id="paid" class="ad-form d-none" method="post">
                @csrf
                <!-- Hidden -->
                <input type="hidden" name="type" value="P">
                <!-- Hidden -->

                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Phone Number">
                </div>

                <button type="submit" class="btn confirm-btn" data-save-listing-url="{{route('front.saveListing')}}">Submit Paid Ad</button>
            </form>

            <!-- Banner Ad Form -->
            <form id="banner" class="ad-form d-none" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Hidden -->
                <input type="hidden" name="type" value="B">
                <!-- Hidden -->

                <div class="mb-3">
                    <label class="form-label">Banner Title</label>
                    <input type="text" class="form-control" id="banner_title" name="banner_title" placeholder="Enter Banner Title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" id="banner_image" name="banner_image" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Target URL</label>
                    <input type="url" class="form-control" id="banner_target_url" name="banner_target_url"  placeholder="Enter URL">
                </div>
                
                <button type="submit" class="btn confirm-btn" data-save-listing-url="{{route('front.saveListing')}}">Submit Banner Ad</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include the jQuery Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

<!-- Include additional methods (optional, for more validation rules) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    function previewFile(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    }
    
    document.querySelectorAll('.remove').forEach(btn => {
        btn.onclick = function () {
            this.parentElement.remove();
        };
    });
    
    const buttons = document.querySelectorAll('.tab-buttons .btn');
    const forms = document.querySelectorAll('.ad-form');

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        // Remove active class from all buttons
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Show selected form
        forms.forEach(f => f.classList.add('d-none'));
        document.getElementById(btn.dataset.target).classList.remove('d-none');
      });
    });

    /**
     * Form submissions
     */
    var validationForm = validationForm = $("#free").validate({
        errorClass: "text-danger",
        // validClass: "success",
        errorElement: "span",
        rules: {
            full_name:{
                required: true
            },
            home_city:{
                required: true
            },
            contact_number: {
                required: true
            },
            otp: {
                required: {
                    depends: function(element){
                        if(!$(element).prop("disabled")){
                            return true;
                        }
                        return false;
                    }
                }
            }
        },
        messages: {
            full_name:{
                required: "This field is required."
            },
            home_city:{
                required: "This field is required."
            },
            contact_number: {
                required: "This field is required."
            },
            otp: {
                required: "This field is required."
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        invalidHandler: function(event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
            var message = errors == 1
                ? 'You missed 1 field. It has been highlighted'
                : 'You missed ' + errors + ' fields. They have been highlighted';
            $("div.error span").html(message);
            $("div.error").show();
            } else {
            $("div.error").hide();
            }
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            // $(form).ajaxSubmit();

            if(!$("#free").find(".send-otp-btn").hasClass("d-none")){
                sendFreeListingOtp();
            }
            else{
                saveFreeListing();
            }
        },
    });

    $("#tab-btn-free").on('click', function(){
        if($("#tab-btn-free").hasClass('active')){
            if(validationForm){
                validationForm.destroy();
            }

            validationForm = $("#free").validate({
                errorClass: "text-danger",
                // validClass: "success",
                errorElement: "span",
                rules: {
                    full_name:{
                        required: true
                    },
                    home_city:{
                        required: true
                    },
                    contact_number: {
                        required: true
                    },
                    otp: {
                        required: {
                            depends: function(element){
                                if(!$(element).prop("disabled")){
                                    return true;
                                }
                                return false;
                            }
                        }
                    }
                },
                messages: {
                    full_name:{
                        required: "This field is required."
                    },
                    home_city:{
                        required: "This field is required."
                    },
                    contact_number: {
                        required: "This field is required."
                    },
                    otp: {
                        required: "This field is required."
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                invalidHandler: function(event, validator) {
                    // 'this' refers to the form
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                    var message = errors == 1
                        ? 'You missed 1 field. It has been highlighted'
                        : 'You missed ' + errors + ' fields. They have been highlighted';
                    $("div.error span").html(message);
                    $("div.error").show();
                    } else {
                    $("div.error").hide();
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // $(form).ajaxSubmit();

                    if(!$("#free").find(".send-otp-btn").hasClass("d-none")){
                        sendFreeListingOtp();
                    }
                    else{
                        saveFreeListing();
                    }
                },
            });
        }
    });

    function sendFreeListingOtp(){
        $.ajax({
            url:$(".send-otp-btn").data('send-otp-url'),
            method:"POST",
            data:$("#free").serialize(),
            beforeSend: function(xhr, settings){
                console.log('before', xhr, settings);
            },
            success: function(response, textStatus, xhr){
                console.log('success', response, textStatus, xhr);
                if(response.status){
                    $("#free").find("#full_name").prop('readonly', true);
                    $("#free").find("#home_city").prop('readonly', true);
                    $("#free").find("#contact_number").prop('readonly', true);
                    $("#free").find("#otp").prop('disabled', false);

                    $("#free").find(".send-otp-btn").addClass("d-none");

                    $("#free").find(".confirm-btn").removeClass("d-none");

                    toastr.success(response.message);
                }
                else{
                    toastr.error(response.message);
                }
            },
            complete: function(xhr, textStatus){
                console.log('complete', xhr, textStatus);
            },
            error: function(xhr, textStatus, error){
                console.log('error', xhr, textStatus, error);
            }
        });
    }

    function saveFreeListing(){
        console.log($("#free").serialize());
        // return false;
        
        $.ajax({
            url: $("#free").find(".confirm-btn").data('save-listing-url'),
            method:"POST",
            data:$("#free").serialize(),
            beforeSend: function(xhr, settings){
                console.log('before', xhr, settings);
            },
            success: function(response, textStatus, xhr){
                // console.log('success', response, textStatus, xhr);
                if(response.status){
                    $("#free").find("#full_name").val('').prop('readonly', false);
                    $("#free").find("#home_city").val('').prop('readonly', false);
                    $("#free").find("#contact_number").val('').prop('readonly', false);
                    $("#free").find("#otp").val('').prop('disabled', true);

                    $("#free").find(".send-otp-btn").removeClass("d-none");
                    $("#free").find(".confirm-btn").addClass("d-none");

                    toastr.success(response.message);
                }
                else{
                    toastr.error(response.message);
                }
            },
            complete: function(xhr, textStatus){
                console.log('complete', xhr, textStatus);
            },
            error: function(xhr, textStatus, error){
                console.log('error', xhr, textStatus, error);
            }
        });
    }

    /**
     * Form submissions paid
     */
    $("#tab-btn-paid").on('click', function(){
        if($(this).hasClass('active'))
        {
            if(validationForm){
                validationForm.destroy();
            }

            validationForm = $("#paid").validate({
                errorClass: "text-danger",
                // validClass: "success",
                errorElement: "span",
                rules: {
                    company_name:{
                        required: true
                    },
                    email:{
                        required: true,
                        email: true
                    },
                    contact_number: {
                        required: true
                    }
                },
                messages: {
                    company_name:{
                        required: "This field is required."
                    },
                    email:{
                        required: "This field is required.",
                        email: "Please enter a valid email."
                    },
                    contact_number: {
                        required: "This field is required."
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                invalidHandler: function(event, validator) {
                    // 'this' refers to the form
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                    var message = errors == 1
                        ? 'You missed 1 field. It has been highlighted'
                        : 'You missed ' + errors + ' fields. They have been highlighted';
                    $("div.error span").html(message);
                    $("div.error").show();
                    } else {
                    $("div.error").hide();
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // $(form).ajaxSubmit();
    
                    savePaidListing();
                },
            });
        }
    });

    function savePaidListing(){
        $.ajax({
            url: $("#paid").find(".confirm-btn").data('save-listing-url'),
            method:"POST",
            data:$("#paid").serialize(),
            beforeSend: function(xhr, settings){
                console.log('before', xhr, settings);
            },
            success: function(response, textStatus, xhr){
                // console.log('success', response, textStatus, xhr);
                if(response.status){
                    $("#paid").find("#company_name").val('').prop('readonly', false);
                    $("#paid").find("#email").val('').prop('readonly', false);
                    $("#paid").find("#contact_number").val('').prop('readonly', false);

                    toastr.success(response.message);
                }
                else{
                    toastr.error(response.message);
                }
            },
            complete: function(xhr, textStatus){
                console.log('complete', xhr, textStatus);
            },
            error: function(xhr, textStatus, error){
                console.log('error', xhr, textStatus, error);
            }
        });
    }

    /**
     * Form submissions banner
     */
    $("#tab-btn-banner").on('click', function(){
        if($(this).hasClass('active'))
        {
            if(validationForm){
                validationForm.destroy();
            }

            validationForm = $("#banner").validate({
                errorClass: "text-danger",
                // validClass: "success",
                errorElement: "span",
                rules: {
                    banner_title:{
                        required: true
                    },
                    banner_target_url:{
                        required: true
                    },
                    banner_image: {
                        required: true
                    }
                },
                messages: {
                    banner_title:{
                        required: "This field is required."
                    },
                    banner_target_url:{
                        required: "This field is required."
                    },
                    banner_image: {
                        required: "This field is required."
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                invalidHandler: function(event, validator) {
                    // 'this' refers to the form
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                    var message = errors == 1
                        ? 'You missed 1 field. It has been highlighted'
                        : 'You missed ' + errors + ' fields. They have been highlighted';
                    $("div.error span").html(message);
                    $("div.error").show();
                    } else {
                    $("div.error").hide();
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // $(form).ajaxSubmit();
    
                    saveBannerListing();
                },
            });
        }
    });

    function saveBannerListing(){
        var formData = new FormData($("#banner")[0]);
        
        $.ajax({
            url: $("#banner").find(".confirm-btn").data('save-listing-url'),
            method:"POST",
            data:formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr, settings){
                console.log('before', xhr, settings);
            },
            success: function(response, textStatus, xhr){
                // console.log('success', response, textStatus, xhr);
                if(response.status){
                    $("#banner")[0].reset();
                    toastr.success(response.message);
                }
                else{
                    toastr.error(response.message);
                }
            },
            complete: function(xhr, textStatus){
                console.log('complete', xhr, textStatus);
            },
            error: function(xhr, textStatus, error){
                console.log('error', xhr, textStatus, error);
            }
        });
    }
</script>
@endpush
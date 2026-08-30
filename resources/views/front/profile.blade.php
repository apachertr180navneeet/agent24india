@extends('front.layout.main')
@section('title', $pageTitle ?? 'My Profile')

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<style>
    .profile-page-container {
        max-width: 1140px;
        margin: 36px auto 60px auto;
        padding: 0 20px;
    }

    .profile-page-header {
        margin-bottom: 28px;
    }

    .profile-page-title {
        font-size: 24px;
        font-weight: 800;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 6px;
    }

    .profile-page-subtitle {
        font-size: 14px;
        font-weight: 500;
        color: #64748B;
        margin: 0;
    }

    /* Universal Modern Card */
    .profile-section-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        padding: 32px;
        margin-bottom: 30px;
    }

    .card-header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 16px;
        margin-bottom: 24px;
        border-bottom: 2px solid #F1F5F9;
    }

    .card-header-title {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    /* Profile Card 2-Col Layout */
    .profile-card-layout {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 36px;
        align-items: flex-start;
    }

    /* Left Photo Upload Box */
    .profile-avatar-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: #F8FAFC;
        border: 1.5px dashed #CBD5E1;
        border-radius: 16px;
        padding: 24px 16px;
    }

    .avatar-preview-wrap {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #FFFFFF;
        box-shadow: 0 6px 20px rgba(0, 75, 238, 0.12);
        margin-bottom: 16px;
        background: #E2E8F0;
        position: relative;
    }

    .avatar-preview-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-user-name {
        font-size: 16px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 4px;
    }

    .avatar-user-role {
        font-size: 12px;
        font-weight: 700;
        color: #004BEE;
        background: #EFF6FF;
        padding: 3px 10px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-upload-photo {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #FFFFFF;
        border: 1.5px solid #CBD5E1;
        color: #334155;
        font-size: 13.5px;
        font-weight: 700;
        padding: 8px 18px;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    .btn-upload-photo:hover {
        border-color: #004BEE;
        color: #004BEE;
        background: #EFF6FF;
    }

    /* Form Grids & Inputs */
    .profile-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px 24px;
    }

    .profile-form-grid.grid-3col {
        grid-template-columns: repeat(3, 1fr);
    }

    .form-group-full {
        grid-column: 1 / -1;
    }

    .custom-form-group {
        display: flex;
        flex-direction: column;
    }

    .custom-form-label {
        font-size: 13.5px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .custom-form-label .req {
        color: #EF4444;
    }

    .custom-input {
        width: 100%;
        height: 46px;
        padding: 10px 14px;
        border: 1.5px solid #CBD5E1;
        border-radius: 10px;
        font-size: 14.5px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
        transition: all 0.2s ease;
    }

    .custom-input:focus {
        border-color: #004BEE;
        box-shadow: 0 0 0 3px rgba(0, 75, 238, 0.12);
    }

    .custom-textarea {
        width: 100%;
        min-height: 100px;
        padding: 12px 14px;
        border: 1.5px solid #CBD5E1;
        border-radius: 10px;
        font-size: 14.5px;
        color: #0F172A;
        background: #FFFFFF;
        outline: none;
        resize: vertical;
        transition: all 0.2s ease;
    }

    .custom-textarea:focus {
        border-color: #004BEE;
        box-shadow: 0 0 0 3px rgba(0, 75, 238, 0.12);
    }

    /* Buttons */
    .btn-profile-save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #004BEE;
        color: #FFFFFF;
        border: none;
        border-radius: 10px;
        padding: 12px 32px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 14px rgba(0, 75, 238, 0.25);
    }

    .btn-profile-save:hover {
        background: #0036B8;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 75, 238, 0.35);
        color: #FFFFFF;
    }

    .card-actions-row {
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        justify-content: flex-end;
    }

    /* Select2 Tuning */
    .select2-container--default .select2-selection--single {
        height: 46px !important;
        border: 1.5px solid #CBD5E1 !important;
        border-radius: 10px !important;
        display: flex !important;
        align-items: center !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 14px !important;
        font-size: 14.5px !important;
        color: #0F172A !important;
    }

    .select2-container--default .select2-selection--multiple {
        min-height: 46px !important;
        border: 1.5px solid #CBD5E1 !important;
        border-radius: 10px !important;
        padding: 4px 8px !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #004BEE !important;
        box-shadow: 0 0 0 3px rgba(0, 75, 238, 0.12) !important;
    }

    .error-text {
        color: #EF4444;
        font-size: 12.5px;
        font-weight: 600;
        margin-top: 6px;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .profile-card-layout {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        .profile-avatar-box {
            max-width: 320px;
            margin: 0 auto;
        }
    }

    @media (max-width: 640px) {
        .profile-page-container {
            padding: 0 14px;
            margin: 20px auto 40px auto;
        }
        .profile-section-card {
            padding: 20px 16px;
            border-radius: 16px;
            margin-bottom: 20px;
        }
        .profile-form-grid,
        .profile-form-grid.grid-3col {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .btn-profile-save {
            width: 100%;
        }
        .card-actions-row {
            justify-content: stretch;
        }
    }
</style>
@endpush

@section('content')
@php
    $categoryModel = new \App\Models\Category();
    $businessCategory = $categoryModel->select('id', 'name')->whereNull('parent_id')->where('status', 1)->orderBy('name')->get();
@endphp

    <div class="profile-page-container">
        
        <!-- Page Title Header -->
        <div class="profile-page-header">
            <h1 class="profile-page-title">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Vendor Profile & Settings</span>
            </h1>
            <p class="profile-page-subtitle">Manage your personal details, business info, service categories, and security.</p>
        </div>

        <!-- 1. Profile Details Card -->
        <div class="profile-section-card">
            <div class="card-header-bar">
                <h3 class="card-header-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                    <span>Business & Contact Information</span>
                </h3>
            </div>

            <form id="profile-form" action="{{route('front.updateProfile')}}" method="post" enctype="multipart/form-data" onsubmit="return validateProfileUpdate();">
                @csrf()
                <div class="profile-card-layout">
                    
                    <!-- Left Photo Upload Box -->
                    <div class="profile-avatar-box">
                        <div class="avatar-preview-wrap">
                            <img id="previewImage"
                                src="{{ $user->profile_photo_url }}"
                                alt="{{ $user->business_name ?? 'Profile Photo' }}"
                                onerror="this.onerror=null; this.src='{{ asset('images/images.png') }}';">
                        </div>
                        <div class="avatar-user-name">{{ $user->business_name ?? 'Vendor Account' }}</div>
                        <span class="avatar-user-role">
                            @if($user->is_approved == '1')
                                 Verified Agent
                            @else
                                 Pending Verification
                            @endif
                        </span>
                        <label class="btn-upload-photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                            <span>Change Photo</span>
                            <input type="file" accept="image/*" name="profile_image" onchange="previewFile(this)" hidden>
                        </label>
                    </div>

                    <!-- Right Form Grid -->
                    <div>
                        <div class="profile-form-grid">
                            
                            <div class="custom-form-group">
                                <label class="custom-form-label">Business Name <span class="req">*</span></label>
                                <input type="text" id="business_name" name="business_name" class="custom-input" placeholder="Enter Business Name" value="{{$user->business_name}}" required>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-form-label">Business Category <span class="req">*</span></label>
                                <select name="business_category_id" id="business_category_id" class="select2" required>
                                    <option value="">Select Business Category</option>
                                    @foreach($businessCategory as $key => $value)
                                        <option value="{{$value->id}}" {{$user->business_category_id == $value->id ? 'selected' :''}}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-form-label">Contact Number <span class="req">*</span></label>
                                <input type="text" id="contact_number" name="contact_number" class="custom-input" placeholder="10 Digit Mobile Number" value="{{$user->mobile}}" required>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-form-label">WhatsApp Number <span style="font-weight: normal; color: #64748B; font-size: 12px;">(Optional)</span></label>
                                <input type="text" id="whats_app" name="whats_app" class="custom-input" placeholder="WhatsApp Number (Optional)" value="{{$user->whats_app}}">
                            </div>

                            <div class="custom-form-group form-group-full">
                                <label class="custom-form-label">Email Address <span class="req">*</span></label>
                                <input type="email" id="email" name="email" class="custom-input" placeholder="you@example.com" value="{{$user->email}}" required>
                            </div>

                            <div class="custom-form-group form-group-full">
                                <label class="custom-form-label">Full Business Address <span class="req">*</span></label>
                                <input type="text" id="business_address" name="business_address" class="custom-input" placeholder="Street, landmark, locality" value="{{$user->business_address}}" required>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-form-label">State <span class="req">*</span></label>
                                <select name="state_id" id="state_id" class="select2" required>
                                    <option value="">Select State</option>
                                    @foreach($stateList as $value)
                                        <option value="{{ $value->id }}" {{ $user->state_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-form-label">District <span class="req">*</span></label>
                                <select name="district_id" id="district_id" class="select2" required>
                                    <option value="">Select District</option>
                                    @foreach($districts as $value)
                                        <option value="{{ $value->id }}" {{ $user->district_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-form-label">City <span class="req">*</span></label>
                                <select name="city_id" id="city_id" class="select2" required>
                                    <option value="">Select City</option>
                                    @foreach($city as $value)
                                        <option value="{{ $value->id }}" {{ $user->city_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-form-label">Pincode <span class="req">*</span></label>
                                <input type="text" id="pincode" name="pincode" class="custom-input" placeholder="6 Digit Pincode" value="{{$user->pincode}}" required>
                            </div>

                            <div class="custom-form-group form-group-full">
                                <label class="custom-form-label">About Business / Description</label>
                                <textarea name="description" class="custom-textarea" placeholder="Tell customers about your business, experience, and services offered...">{{$user->description}}</textarea>
                            </div>

                        </div>

                        <div class="card-actions-row">
                            <button type="submit" id="btn-update-profile" class="btn-profile-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                <span>Save Profile Details</span>
                            </button>
                        </div>

                    </div>

                </div>
            </form>
        </div>

        <!-- 2. Sub Categories & Tags Card -->
        <div class="profile-section-card">
            <div class="card-header-bar">
                <h3 class="card-header-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                    <span>Business Sub-Categories & Services</span>
                </h3>
            </div>

            <form action="{{ route('front.updateCategory') }}" method="post">
                @csrf
                <div class="profile-form-grid">
                    <div class="custom-form-group">
                        <label class="custom-form-label">Primary Category</label>
                        <select name="business_category_id" class="select2" disabled>
                            @foreach($parentCategories as $category)
                                <option value="{{$category->id}}" @if($user->business_category_id == $category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    @php
                        $selectedSubCategories = $user->business_sub_category_id
                            ? explode(',', $user->business_sub_category_id)
                            : [];
                    @endphp

                    <div class="custom-form-group form-group-full">
                        <label class="custom-form-label">Sub Categories (Select multiple tags)</label>
                        <select name="business_sub_category_id[]" id="business_sub_category_id" class="select2" multiple>
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}"
                                    {{ in_array($subCategory->id, $selectedSubCategories) ? 'selected' : '' }}>
                                    {{ $subCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-actions-row">
                    <button type="submit" name="type" value="Sub Category" class="btn-profile-save">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Update Sub-Categories</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- 3. Change Password Card -->
        <div class="profile-section-card">
            <div class="card-header-bar">
                <h3 class="card-header-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>Security & Password</span>
                </h3>
            </div>

            <form action="{{ route('front.changePassword') }}" method="post">
                @csrf
                <div class="profile-form-grid grid-3col">
                    <div class="custom-form-group">
                        <label class="custom-form-label">Current Password <span class="req">*</span></label>
                        <input type="password" name="current_password" class="custom-input" placeholder="••••••••" required>
                        @if ($errors->changePassword->has('current_password'))
                            <span class="error-text">{{ $errors->changePassword->first('current_password') }}</span>
                        @endif
                    </div>

                    <div class="custom-form-group">
                        <label class="custom-form-label">New Password <span class="req">*</span></label>
                        <input type="password" name="password" class="custom-input" placeholder="••••••••" required>
                        @if ($errors->changePassword->has('password'))
                            <span class="error-text">{{ $errors->changePassword->first('password') }}</span>
                        @endif
                    </div>

                    <div class="custom-form-group">
                        <label class="custom-form-label">Confirm New Password <span class="req">*</span></label>
                        <input type="password" name="password_confirmation" class="custom-input" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="card-actions-row">
                    <button type="submit" class="btn-profile-save">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                        </svg>
                        <span>Change Password</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection

@push('scripts')
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



<!-- Include the jQuery Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

<!-- Include additional methods (optional, for more validation rules) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
$(document).ready(function () {
    /* SINGLE SELECTS */
    $('#business_category_id, #state_id, #district_id, #city_id').select2({
        width: '100%'
    });

    /* MULTIPLE SELECT */
    $('#business_sub_category_id').select2({
        width: '100%',
        placeholder: 'Select Sub Categories'
    });
});
</script>

<script>
    function validateProfileUpdate() {
        return true;
    }

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

    function updateCategory(categoryId) {
        $.ajax({
            url: "{{ route('front.updateCategory') }}", // Update this route as per your application
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                business_category_id: categoryId
            },
            beforeSend: function(xhr, settings) {
                console.log('Updating category:', categoryId);
            },
            success: function(response, textStatus, xhr) {
                console.log('Category updated successfully:', response);
                if(response.status) {
                    toastr.success(response.message);
                    location.reload(); // Reload the page to reflect changes
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, textStatus, error) {
                console.log('Error updating category:', error);
                toastr.error('Failed to update category');
            }
        });
    }
</script>

<script>
    $(document).ready(function () {

        // 1 District Click
        $('#oneDistrict').on('click', function () {
            $('#price').val(250);
            $('#type').val(1);
            $('#priceText').text('250 Rs');

            $(this).addClass('active btn-outline-dark')
                .removeClass('btn-primary');

            $('#fourDistrict').removeClass('active btn-outline-dark')
                            .addClass('btn-primary');
        });

        // 4 District Click
        $('#fourDistrict').on('click', function () {
            $('#price').val(500);
            $('#type').val(4);
            $('#priceText').text('500 Rs');

            $(this).addClass('active btn-outline-dark')
                .removeClass('btn-primary');

            $('#oneDistrict').removeClass('active btn-outline-dark')
                            .addClass('btn-primary');
        });

    });
</script>

<script>
$(document).ready(function () {
    const $profileForm = $('#profile-form');
    const $state = $profileForm.find('select[name="state_id"]');
    const $district = $profileForm.find('select[name="district_id"]');
    const $city = $profileForm.find('select[name="city_id"]');

    function loadDistricts(stateId, selectedDistrict = null) {
        if (!stateId) return;

        $district.html('<option value="">Loading...</option>');

        $.ajax({
            url: "{{ route('get.districts', ['state' => '__STATE__']) }}".replace('__STATE__', stateId),
            type: 'GET',
            success: function (data) {
                let options = '<option value="">Select District</option>';
                $.each(data, function (key, value) {
                    let selected = selectedDistrict == value.id ? 'selected' : '';
                    options += `<option value="${value.id}" ${selected}>${value.name}</option>`;
                });
                $district.html(options);
                $district.trigger('change.select2');
            }
        });
    }

    // ON CHANGE
    $state.change(function () {
        loadDistricts($(this).val());
        $city.html('<option value="">Select City</option>');
    });

    // ON PAGE LOAD
    let stateId = $state.val();
    let districtId = "{{ $user->district_id }}";

    if (stateId) {
        loadDistricts(stateId, districtId);
    }

});
</script>
<script>
$(document).ready(function () {
    const $profileForm = $('#profile-form');
    const $district = $profileForm.find('select[name="district_id"]');
    const $city = $profileForm.find('select[name="city_id"]');

    function loadCities(districtId, selectedCity = null) {
        if (!districtId) return;

        $city.html('<option value="">Loading...</option>');

        $.ajax({
            url: "{{ route('get.cities', ['district' => '__DISTRICT__']) }}".replace('__DISTRICT__', districtId),
            type: 'GET',
            success: function (data) {
                let options = '<option value="">Select City</option>';
                $.each(data, function (key, value) {
                    let selected = selectedCity == value.id ? 'selected' : '';
                    options += `<option value="${value.id}" ${selected}>${value.name}</option>`;
                });
                $city.html(options);
                $city.trigger('change.select2');
            }
        });
    }

    // ON CHANGE
    $district.change(function () {
        loadCities($(this).val());
    });

    // ON PAGE LOAD
    let districtId = "{{ $user->district_id }}";
    let cityId = "{{ $user->city_id }}";

    if (districtId) {
        loadCities(districtId, cityId);
    }

});
</script>




@endpush

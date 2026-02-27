@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<style>
    img#previewImage {
        width: 50%;
    }

    /* ===== SELECT2 FIX ===== */
    .select2-container--default .select2-selection--single {
        height: 44px;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
        padding-left: 12px;
        padding-right: 30px;
        line-height: normal;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
        height: 100%;
        right: 8px;
    }

    /* Multiple select */
    .select2-container--default .select2-selection--multiple {
        min-height: 44px;
        padding: 5px 8px;
    }
</style>
@endpush

@section('content')
@php
    $categoryModel = new \App\Models\Category();
    $businessCategory = $categoryModel->select('id', 'name')->whereNull('parent_id')->where('status', 1)->get();
@endphp
    <!-- profile -->
    <div class="profile-wrapper">
        <form id="profile-form" action="{{route('front.updateProfile')}}" method="post" enctype="multipart/form-data" onsubmit="return validateProfileUpdate();">
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
                        <div class="form-group">
                            <label>Whats APP Number *</label>
                            <input type="text" id="whats_app" name="whats_app" placeholder="Whats APP Number" value="{{$user->whats_app}}">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="text" id="email" name="email" placeholder="email" value="{{$user->email}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Business Name *</label>
                            <input type="text" id="business_name" name="business_name" placeholder="Business Name" value="{{$user->business_name}}">
                        </div>
                        <div class="form-group">
                            <label>Pick Your Location *</label>
                            <input type="text" placeholder="Pick Your Location" name="pick_your_location" id="pick_your_location" value="{{$user->pick_your_location}}">
                        </div>
                    </div>
                    <div class="form-group full">
                        <label>Address *</label>
                        <input type="text" id="business_address" name="business_address" placeholder="Address" value="{{$user->business_address}}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>State *</label>
                            <select name="state_id" id="state_id">
                                <option value="">Select State</option>
                                @foreach($stateList as $value)
                                    <option value="{{ $value->id }}" {{ $user->state_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>District *</label>
                            <select name="district_id" id="district_id">
                                <option value="">Select District</option>
                                @foreach($districts as $value)
                                    <option value="{{ $value->id }}" {{ $user->district_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>City *</label>
                            <select name="city_id" id="city_id">
                                <option value="">Select City</option>
                                @foreach($city as $value)
                                    <option value="{{ $value->id }}" {{ $user->city_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pincode *</label>
                            <input type="text" id="pincode" name="pincode" placeholder="Pincode" value="{{$user->pincode}}">
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <textarea name="description" placeholder="Enter description here..." >{{$user->description}}</textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="btn-update-profile">Update Profile</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="tags-box">
            <h4 class="tags-title">Tags</h4>
            <form action="{{ route('front.updateCategory') }}" method="post">
            @csrf
                <div class="tags-row">
                    <div class="tag-field">
                        <label>Category:</label>
                        <select name="business_category_id" id="" disabled>
                            @foreach($parentCategories as $category)
                                <option value="{{$category->id}}" @if($user->business_category_id == $category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    @php
                        // Comma separated IDs ko array me convert karo
                        $selectedSubCategories = $user->business_sub_category_id
                            ? explode(',', $user->business_sub_category_id)
                            : [];
                    @endphp

                    <div class="tag-field">
                        <label>Sub Category:</label>
                        <select name="business_sub_category_id[]" id="business_sub_category_id" multiple>
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}"
                                    {{ in_array($subCategory->id, $selectedSubCategories) ? 'selected' : '' }}>
                                    {{ $subCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="tag-feild">
                        <input type="submit" name="type" value="Sub Category" class="btn btn-primary mt-3" />
                    </div>
                </div>

                <div class="selected-tags">
                    @foreach($selectedSubCategories as $selectedSubCategory)
                        @php
                            $subCategory = $subCategories->where('id', $selectedSubCategory)->first();
                        @endphp
                        @if($subCategory)
                            <span class="tag-pill">
                                {{ $subCategory->name }} <span class="remove">&times;</span>
                            </span>
                        @endif
                    @endforeach
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

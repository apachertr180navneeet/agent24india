@extends('admin.layout.main_app')
@section('title', $pageTitle)

@push('styles')
<link href="{{ asset('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/plugins/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('public/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

<style>
.bootstrap-select.btn-group > .dropdown-toggle{
    padding: 8px 10px !important;
}
</style>
@endpush

@section('content')
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">

<div class="card">
<div class="card-header">
    <h3 class="card-title">Edit Advertisement</h3>
</div>

<form action="{{ route('admin.advertisment.update', $advertismentdata->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
<input type="hidden" name="id" value="{{ $advertismentdata->id }}">

<div class="card-body">

{{-- START DATE + BUSINESS --}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Start Date</label>
            <input type="date"
                   name="start_date"
                   class="form-control"
                   value="{{ old('start_date', $advertismentdata->start_date) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Business Name</label>
            <select name="vendor_user_id" id="vendor_user_id" class="form-control select2">
                <option value="">-Select-</option>
                @foreach($vendoruser as $value)
                    <option value="{{ $value->id }}"
                        {{ old('vendor_user_id', $advertismentdata->bussines_name) == $value->id ? 'selected' : '' }}>
                        {{ $value->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

{{-- TYPE RADIO --}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Type</label>
            <div class="mt-2">

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio"
                           id="type_category"
                           name="type"
                           value="listing_page"
                           class="custom-control-input"
                           {{ old('type', $advertismentdata->type) == 'listing_page' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="type_category">Category</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio"
                           id="type_district"
                           name="type"
                           value="district_page"
                           class="custom-control-input"
                           {{ old('type', $advertismentdata->type) == 'district_page' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="type_district">District</label>
                </div>

            </div>
        </div>
    </div>

    {{-- DISTRICT --}}
    <div class="col-md-6" id="district-col">
        <div class="form-group">
            <label>District</label>
            <select name="district"
                    id="district"
                    class="form-control select2"
                    data-get-cities-url="{{ route('admin.advertisment.getCitiesByDistrict') }}">
                <option value="">-Select-</option>
                @foreach($districts as $value)
                    <option value="{{ $value->id }}"
                        {{ old('district', $advertismentdata->district) == $value->id ? 'selected' : '' }}>
                        {{ $value->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

{{-- CATEGORY + CITY --}}
<div class="row">
    <div class="col-md-6" id="category-col">
        <div class="form-group">
            <label>Category</label>
            <select name="category" id="category" class="form-control select2">
                <option value="">-Select-</option>
                @foreach($parentCategories as $value)
                    <option value="{{ $value->id }}"
                        {{ old('category', $advertismentdata->category) == $value->id ? 'selected' : '' }}>
                        {{ $value->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>City</label>
            <select name="city"
                    id="city"
                    class="form-control select2"
                    data-old-city="{{ old('city', $advertismentdata->city) }}">
                <option value="">-Select-</option>
                @if(isset($cities) && count($cities) > 0)
                    @foreach($cities as $value)
                        <option value="{{ $value->id }}"
                            {{ old('city', $advertismentdata->city) == $value->id ? 'selected' : '' }}>
                            {{ $value->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

{{-- HOME CITY --}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Home City</label>
            <input type="text"
                   name="home_city"
                   class="form-control"
                   value="{{ old('home_city', $advertismentdata->home_city) }}">
        </div>
    </div>
</div>

{{-- IMAGE PREVIEW --}}
@php
    $image = '';
    if(!empty($advertismentdata->image)){
        $image = $advertismentdata->image;
    }
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Image (Top :- 2060 × 741 px , side :- 364 × 208 px)</label>
            <input type="file"
                   name="image"
                   class="dropify"
                   data-default-file="{{ $image }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Image ALT</label>
            <input type="text"
                   name="image_alt"
                   class="form-control"
                   value="{{ old('image_alt', $advertismentdata->image_alt) }}">
        </div>
    </div>
</div>

{{-- SUB TYPE + EXPIRY --}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Sub Type</label>
            <select name="sub_type" id="sub_type" class="form-control select2">
                <option value="">-Select-</option>
                <option value="top"
                    {{ old('sub_type', $advertismentdata->sub_type) == 'top' ? 'selected' : '' }}>
                    Top
                </option>
                <option value="side"
                    {{ old('sub_type', $advertismentdata->sub_type) == 'side' ? 'selected' : '' }}>
                    Side
                </option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Expiry Date</label>
            <input type="date"
                   name="expiry_date"
                   class="form-control"
                   value="{{ old('expiry_date', $advertismentdata->expiry_date) }}" readonly>
        </div>
    </div>
</div>

</div>

<div class="card-footer text-right">
    <button type="submit" class="btn btn-primary">Update</button>
</div>

</form>
</div>

</div>
</div>
</div>
</section>
@endsection


@push('scripts')
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/plugins/dropify/dropify.min.js') }}"></script>

<script>
$(document).ready(function () {

    // Dropify Init
    $('.dropify').dropify();
    $('.select2').select2({
        width: '100%'
    });

    let $district = $("#district");
    let $city = $("#city");

    function loadCitiesByDistrict(selectedCity) {
        let districtId = $district.val();

        if (!districtId) {
            $city.html('<option value="">-Select-</option>');
            return;
        }

        $.ajax({
            type: "POST",
            url: $district.data("get-cities-url"),
            data: {
                district_id: districtId,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                $city.html(response.data || '<option value="">-Select-</option>');

                if (selectedCity !== undefined && selectedCity !== null && String(selectedCity) !== '') {
                    $city.val(String(selectedCity));
                }

                $city.trigger("change.select2");
            }
        });
    }

    function toggleFields() {
        let selectedType = $("input[name='type']:checked").val();

        if (selectedType === 'district_page') {
            $("#category-col").hide();
        } else {
            $("#category-col").show();
        }

        $("#district-col").show();
    }

    toggleFields();

    $("input[name='type']").change(function () {
        toggleFields();
    });

    $district.on("change", function () {
        loadCitiesByDistrict("");
    });

    if ($district.val() && $city.find("option").length <= 1) {
        loadCitiesByDistrict($city.data("old-city"));
    }

});
</script>
@endpush

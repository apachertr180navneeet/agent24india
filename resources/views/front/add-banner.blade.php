@extends('front.layout.main')
@section('title', $pageTitle)

@push('styles')
<style>
    .card {
        border-radius: 10px;
    }

    .card-header {
        background: #f8f9fa;
        font-weight: 600;
    }

    #preview {
        max-height: 80px;
        margin-top: 10px;
        display: none;
    }

</style>
@endpush


@section('content')

<div class="container my-4">
    @php
            $user = auth()->user();
        @endphp
        @if($user->is_approved == '1')
            <div class="card shadow-sm">

                <div class="card-header">
                    Banner Ad
                </div>

                @if(session('notification'))

                    <div class="alert alert-{{ session('notification._type') == 'success' ? 'success' : 'danger' }} alert-dismissible fade show">

                        {{ session('notification._message') }}

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                    </div>

                @endif

                <form action="{{ route('front.addbanner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="row g-3">

                            {{-- TYPE --}}
                            <div class="col-md-6">

                                <label class="form-label">Type</label>

                                <div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input type-radio" type="radio" name="type" value="listing_page" {{ old('type','listing_page')=='listing_page'?'checked':'' }}>

                                        <label class="form-check-label">
                                            Category
                                        </label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input type-radio" type="radio" name="type" value="district_page" {{ old('type')=='district_page'?'checked':'' }}>

                                        <label class="form-check-label">
                                            District
                                        </label>

                                    </div>

                                </div>

                            </div>


                            {{-- DISTRICT --}}
                            <div class="col-md-6" id="district-col">

                                <label class="form-label">District</label>

                                <select class="form-select" id="district" name="district" data-get-cities-url="{{ route('get.cities',':id') }}">

                                    <option value="">Select District</option>

                                    @if(isset($districts))

                                    @foreach ($districts as $value)

                                    <option value="{{ $value->id }}" {{ old('district')==$value->id?'selected':'' }}>

                                        {{ $value->name }}

                                    </option>

                                    @endforeach

                                    @endif

                                </select>

                            </div>


                            {{-- CATEGORY --}}
                            <div class="col-md-6" id="category-col">

                                <label class="form-label">Category</label>

                                <select class="form-select" name="category">

                                    <option value="">Select Category</option>

                                    @if(isset($categories))

                                    @foreach ($categories as $value)

                                    <option value="{{ $value->id }}" {{ old('category')==$value->id?'selected':'' }}>

                                        {{ $value->name }}

                                    </option>

                                    @endforeach

                                    @endif

                                </select>

                            </div>


                            {{-- CITY --}}
                            <div class="col-md-6">

                                <label class="form-label">City</label>

                                <select class="form-select" id="city" name="city" data-old-city="{{ old('city') }}">

                                    <option value="">Select City</option>

                                </select>

                            </div>


                            {{-- HOME CITY --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Home City
                                </label>

                                <input type="text" class="form-control" name="home_city" value="{{ old('home_city') }}" placeholder="Enter Home City">

                            </div>


                            {{-- IMAGE --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Image (Top :- 2060 × 741 px , side :- 364 × 208 px)
                                </label>

                                <input type="file" class="form-control" name="image" id="image">

                                <img id="preview">

                            </div>


                            {{-- IMAGE ALT --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Image ALT
                                </label>

                                <input type="text" class="form-control" name="image_alt" value="{{ old('image_alt') }}" placeholder="Enter Image ALT">

                            </div>


                            {{-- SUB TYPE --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Sub Type
                                </label>

                                <select class="form-select" name="sub_type">

                                    <option value="">Select</option>

                                    <option value="top" {{ old('sub_type')=='top'?'selected':'' }}>
                                        Top
                                    </option>

                                    <option value="side" {{ old('sub_type')=='side'?'selected':'' }}>
                                        Side
                                    </option>

                                </select>

                            </div>


                            {{-- PRICE --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Price
                                </label>

                                <input type="text" class="form-control" name="price" value="100" readonly>

                            </div>

                        </div>

                    </div>


                    <div class="card-footer text-end">

                        <button type="submit" class="btn btn-primary px-4">

                            Submit

                        </button>

                    </div>

                </form>

            </div>
        @else
            <h3 style="font-weight:bold; text-align:center;">
                After admin approval, you can add it to the listing.
            </h3>
        @endif

</div>

@endsection


@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        /* TYPE TOGGLE */

        function toggleFields() {

            let type = $('input[name="type"]:checked').val();

            if (type === 'listing_page') {

                $('#district-col').show();
                $('#category-col').show();

            } else {

                $('#district-col').show();
                $('#category-col').hide();

            }

        }

        toggleFields();

        $('.type-radio').change(function() {
            toggleFields();
        });


        /* DISTRICT → CITY */

        $('#district').on('change', function() {

            let districtId = $(this).val();
            let url = $(this).data('get-cities-url');

            if (!districtId) {

                $('#city').html('<option value="">Select City</option>');
                return;

            }

            url = url.replace(':id', districtId);

            $('#city').html('<option>Loading...</option>');

            $.ajax({

                url: url
                , type: 'GET',

                success: function(res) {

                    let html = '<option value="">Select City</option>';

                    $.each(res, function(key, val) {

                        html += `<option value="${val.id}">${val.name}</option>`;

                    });

                    $('#city').html(html);

                },

                error: function() {

                    alert('Failed to load cities');

                }

            });

        });


        /* OLD CITY LOAD */

        let oldCity = $('#city').data('old-city');

        if (oldCity) {

            $('#district').trigger('change');

            setTimeout(function() {

                $('#city').val(oldCity);

            }, 500);

        }


        /* IMAGE PREVIEW */

        $('#image').change(function() {

            let reader = new FileReader();

            reader.onload = function(e) {

                $('#preview').attr('src', e.target.result).show();

            }

            reader.readAsDataURL(this.files[0]);

        });

    });

</script>

@endpush

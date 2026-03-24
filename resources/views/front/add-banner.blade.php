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

    .required-mark {
        color: #dc3545;
    }

    .type-group.is-invalid {
        border: 1px solid #dc3545;
        border-radius: 6px;
        padding: 10px 12px;
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

                <form action="{{ route('front.addbanner.store') }}" method="POST" enctype="multipart/form-data" id="banner-form">
                    @csrf

                    <div class="card-body">

                        <div class="row g-3">

                            {{-- TYPE --}}
                            <div class="col-md-6">

                                <label class="form-label">Type <span class="required-mark">*</span></label>

                                <div class="type-group {{ $errors->has('type') ? 'is-invalid' : '' }}">

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input type-radio" type="radio" name="type" value="listing_page" {{ old('type','listing_page')=='listing_page'?'checked':'' }} required>

                                        <label class="form-check-label">
                                            Category
                                        </label>

                                    </div>

                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input type-radio" type="radio" name="type" value="district_page" {{ old('type')=='district_page'?'checked':'' }} required>

                                        <label class="form-check-label">
                                            District
                                        </label>

                                    </div>

                                </div>

                                @error('type')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror

                            </div>


                            {{-- DISTRICT --}}
                            <div class="col-md-6" id="district-col">

                                <label class="form-label">District <span class="required-mark">*</span></label>

                                <select class="form-select @error('district') is-invalid @enderror" id="district" name="district" data-get-cities-url="{{ route('get.cities',':id') }}" required>

                                    <option value="">Select District</option>

                                    @if(isset($districts))

                                    @foreach ($districts as $value)

                                    <option value="{{ $value->id }}" {{ old('district')==$value->id?'selected':'' }}>

                                        {{ $value->name }}

                                    </option>

                                    @endforeach

                                    @endif

                                </select>

                                @error('district')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror

                            </div>


                            {{-- CATEGORY --}}
                            <div class="col-md-6" id="category-col">

                                <label class="form-label">Category <span class="required-mark">*</span></label>

                                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">

                                    <option value="">Select Category</option>

                                    @if(isset($categories))

                                    @foreach ($categories as $value)

                                    <option value="{{ $value->id }}" {{ old('category')==$value->id?'selected':'' }}>

                                        {{ $value->name }}

                                    </option>

                                    @endforeach

                                    @endif

                                </select>

                                @error('category')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror

                            </div>


                            {{-- CITY --}}
                            <div class="col-md-6">

                                <label class="form-label">City <span class="required-mark">*</span></label>

                                <select class="form-select @error('city') is-invalid @enderror" id="city" name="city" data-old-city="{{ old('city') }}" required>

                                    <option value="">Select City</option>

                                </select>

                                @error('city')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror

                            </div>


                            {{-- HOME CITY --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Home City <span class="required-mark">*</span>
                                </label>

                                <input type="text" class="form-control @error('home_city') is-invalid @enderror" name="home_city" value="{{ old('home_city') }}" placeholder="Enter Home City" required>

                                @error('home_city')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror

                            </div>


                            {{-- IMAGE --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Image (Top :- 2060 × 741 px , side :- 364 × 208 px)
                                </label>

                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required>

                                <img id="preview">

                                @error('image')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror

                            </div>


                            {{-- IMAGE ALT --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Image ALT <span class="required-mark">*</span>
                                </label>

                                <input type="text" class="form-control @error('image_alt') is-invalid @enderror" name="image_alt" value="{{ old('image_alt') }}" placeholder="Enter Image ALT" required>

                                @error('image_alt')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror

                            </div>


                            {{-- SUB TYPE --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Sub Type <span class="required-mark">*</span>
                                </label>

                                <select class="form-select @error('sub_type') is-invalid @enderror" name="sub_type" required>

                                    <option value="">Select</option>

                                    <option value="top" {{ old('sub_type')=='top'?'selected':'' }}>
                                        Top
                                    </option>

                                    <option value="side" {{ old('sub_type')=='side'?'selected':'' }}>
                                        Side
                                    </option>

                                </select>

                                @error('sub_type')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror

                            </div>


                            {{-- PRICE --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Price
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="price"
                                    id="price"
                                    value="{{ old('sub_type') == 'top' ? '590' : (old('sub_type') == 'side' ? '118' : '') }}"
                                    data-top-price="500"
                                    data-side-price="100"
                                    readonly
                                >
                                <small class="text-muted d-block mt-1" id="price-note"></small>

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
            let isListingPage = type === 'listing_page';

            $('#category').prop('required', isListingPage);

            if (isListingPage) {

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
            $('.type-group').removeClass('is-invalid');
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

            if (!this.files.length) {
                $(this).addClass('is-invalid');
                $('#preview').hide();
                return;
            }

            $(this).removeClass('is-invalid');

            let reader = new FileReader();

            reader.onload = function(e) {

                $('#preview').attr('src', e.target.result).show();

            }

            reader.readAsDataURL(this.files[0]);

        });

        /* SUB TYPE -> PRICE */

        function updatePrice() {
            let subType = $('select[name="sub_type"]').val();
            let priceField = $('#price');
            let priceNote = $('#price-note');
            let basePrice = 0;

            if (subType === 'top') {
                basePrice = Number(priceField.data('top-price'));
            } else if (subType === 'side') {
                basePrice = Number(priceField.data('side-price'));
            }

            if (!basePrice) {
                priceField.val('');
                priceNote.text('');
                return;
            }

            let totalPrice = (basePrice * 1.18).toFixed(0);

            priceField.val(totalPrice);
            priceNote.text(`Base price Rs. ${basePrice} + 18% GST = Rs. ${totalPrice}`);
        }

        $('select[name="sub_type"]').on('change', updatePrice);
        updatePrice();

        $('#banner-form').on('submit', function() {
            $(this).find('input[required], select[required]').each(function() {
                $(this).toggleClass('is-invalid', !this.checkValidity());
            });

            $('.type-group').toggleClass('is-invalid', $('input[name="type"]:checked').length === 0);
        });

        $('#banner-form').on('input change', 'input, select', function() {
            if ($(this).attr('type') !== 'radio' && this.checkValidity()) {
                $(this).removeClass('is-invalid');
            }
        });

    });

</script>

@endpush

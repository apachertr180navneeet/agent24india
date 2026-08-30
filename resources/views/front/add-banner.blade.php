@extends('front.layout.main')
@section('title', $pageTitle ?? 'Banner Ad')

@push('styles')
<style>
    .banner-card-box {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        padding: 32px;
        margin-bottom: 40px;
    }

    .banner-card-header {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 24px;
        border-bottom: 2px solid #F1F5F9;
        padding-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .custom-form-label {
        font-size: 14px;
        font-weight: 600;
        color: #1E293B;
        margin-bottom: 8px;
        display: block;
    }

    .custom-form-input {
        width: 100%;
        height: 48px;
        padding: 10px 14px;
        border: 1.5px solid #CBD5E1;
        border-radius: 10px;
        font-size: 14.5px;
        background: #FFFFFF;
        outline: none;
        transition: border-color 0.2s;
    }

    .custom-form-input:focus {
        border-color: #004BEE;
        box-shadow: 0 0 0 3px rgba(0, 75, 238, 0.1);
    }

    .custom-form-input:read-only {
        background: #F8FAFC;
        color: #64748B;
    }

    .type-pill-group {
        display: flex;
        gap: 16px;
        background: #F8FAFC;
        padding: 8px 16px;
        border-radius: 10px;
        border: 1.5px solid #E2E8F0;
        min-height: 48px;
        align-items: center;
    }

    .type-pill-group label {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        cursor: pointer;
    }

    #preview {
        max-height: 100px;
        margin-top: 10px;
        display: none;
        border-radius: 8px;
        border: 1px solid #CBD5E1;
    }

    .required-mark {
        color: #EF4444;
    }

    @media (max-width: 640px) {
        .banner-card-box {
            padding: 20px 14px !important;
            border-radius: 14px !important;
            margin-bottom: 24px !important;
        }
        .type-pill-group {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Hero Banner -->
    <section class="price-hero-banner-section">
        <div class="price-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/price_hero_banner.png') }}" alt="Banner Ad - Agent 24 India" class="price-hero-banner-img">
        </div>
    </section>

    <div class="section-container" style="max-width: 1040px; margin: 30px auto; padding: 0 24px;">
        @php
            $user = auth()->user();
        @endphp
        @if($user && $user->is_approved == '1')
            <div class="banner-card-box">
                <div class="banner-card-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                    <span>Banner Ad Booking</span>
                </div>

                @if(session('notification'))
                    <div style="background: {{ session('notification._type') == 'success' ? '#DCFCE7' : '#FEE2E2' }}; border: 1px solid {{ session('notification._type') == 'success' ? '#86EFAC' : '#FCA5A5' }}; color: {{ session('notification._type') == 'success' ? '#166534' : '#991B1B' }}; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;">
                        {{ session('notification._message') }}
                    </div>
                @endif

                <form action="{{ route('front.addbanner.store') }}" method="POST" enctype="multipart/form-data" id="banner-form">
                    @csrf

                    <div class="row g-4">
                        {{-- TYPE --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Type <span class="required-mark">*</span></label>
                            <div class="type-pill-group {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input type-radio" type="radio" name="type" id="typeCategory" value="listing_page" {{ old('type','listing_page')=='listing_page'?'checked':'' }} required>
                                    <label class="form-check-label" for="typeCategory">Category Page</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input type-radio" type="radio" name="type" id="typeDistrict" value="district_page" {{ old('type')=='district_page'?'checked':'' }} required>
                                    <label class="form-check-label" for="typeDistrict">District Page</label>
                                </div>
                            </div>
                            @error('type')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- DISTRICT --}}
                        <div class="col-md-6" id="district-col">
                            <label class="custom-form-label">District <span class="required-mark">*</span></label>
                            <select class="select2 custom-form-input @error('district') is-invalid @enderror" id="district" name="district" data-get-cities-url="{{ route('get.cities',':id') }}" required>
                                <option value="">Select District</option>
                                @if(isset($districts))
                                    @foreach ($districts as $value)
                                        <option value="{{ $value->id }}" {{ old('district')==$value->id?'selected':'' }}>{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('district')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- CATEGORY --}}
                        <div class="col-md-6" id="category-col">
                            <label class="custom-form-label">Category <span class="required-mark">*</span></label>
                            <select class="select2 custom-form-input @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">Select Category</option>
                                @if(isset($categories))
                                    @foreach ($categories as $value)
                                        <option value="{{ $value->id }}" {{ old('category')==$value->id?'selected':'' }}>{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('category')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- CITY --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">City <span class="required-mark">*</span></label>
                            <select class="select2 custom-form-input @error('city') is-invalid @enderror" id="city" name="city" data-old-city="{{ old('city') }}" required>
                                <option value="">Select City</option>
                            </select>
                            @error('city')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- HOME CITY --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Home City <span class="required-mark">*</span></label>
                            <input type="text" class="custom-form-input @error('home_city') is-invalid @enderror" name="home_city" value="{{ old('home_city') }}" placeholder="Enter Home City" required>
                            @error('home_city')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- IMAGE --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Image (Top: 2060×741 px, Side: 364×208 px) <span class="required-mark">*</span></label>
                            <input type="file" class="custom-form-input @error('image') is-invalid @enderror" name="image" id="image" accept="image/*" required style="padding: 8px;">
                            <img id="preview">
                            @error('image')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- IMAGE ALT --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Image ALT <span class="required-mark">*</span></label>
                            <input type="text" class="custom-form-input @error('image_alt') is-invalid @enderror" name="image_alt" value="{{ old('image_alt') }}" placeholder="Enter Image ALT text" required>
                            @error('image_alt')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- SUB TYPE --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Banner Position / Sub Type <span class="required-mark">*</span></label>
                            <select class="select2 custom-form-input @error('sub_type') is-invalid @enderror" name="sub_type" id="sub_type" required>
                                <option value="">Select Position</option>
                                <option value="top" {{ old('sub_type')=='top'?'selected':'' }}>Top Banner</option>
                                <option value="side" {{ old('sub_type')=='side'?'selected':'' }}>Visiting Card / Side Banner</option>
                            </select>
                            @error('sub_type')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- PRICE --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Total Price (Inc. 18% GST)</label>
                            <input type="text" class="custom-form-input" name="price" id="price" value="{{ old('sub_type') == 'top' ? '590' : (old('sub_type') == 'side' ? '118' : '') }}" data-top-price="500" data-side-price="100" readonly>
                            <small style="color: #64748B; font-size: 13px;" id="price-note"></small>
                        </div>
                    </div>

                    <div style="margin-top: 32px; border-top: 1.5px solid #F1F5F9; padding-top: 20px; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-send-message" style="width: auto; padding: 12px 36px; font-size: 15px; border-radius: 10px;">
                            <span>Submit Banner</span>
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 40px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                <div style="width: 64px; height: 64px; border-radius: 50%; background: #FEF3C7; color: #D97706; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px;">
                    ⏳
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 8px;">Account Verification In Progress</h3>
                <p style="font-size: 14.5px; color: #64748B; max-width: 500px; margin: 0 auto;">
                    After admin approval, you will be able to book banners. Our team is reviewing your profile.
                </p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if ($.fn.select2) {
            $('#district, #category, #city, #sub_type').select2({
                width: '100%'
            });
        }

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
            $('.type-pill-group').removeClass('is-invalid');
        });

        /* DISTRICT → CITY */
        $('#district').on('change', function() {
            let districtId = $(this).val();
            let url = $(this).data('get-cities-url');

            if (!districtId) {
                $('#city').html('<option value="">Select City</option>').trigger('change.select2');
                return;
            }

            url = url.replace(':id', districtId);
            $('#city').html('<option>Loading...</option>').trigger('change.select2');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(res) {
                    let html = '<option value="">Select City</option>';
                    $.each(res, function(key, val) {
                        html += `<option value="${val.id}">${val.name}</option>`;
                    });
                    $('#city').html(html).trigger('change.select2');
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
                $('#city').val(oldCity).trigger('change.select2');
            }, 600);
        }

        /* IMAGE PREVIEW */
        $('#image').change(function() {
            if (!this.files.length) {
                $('#preview').hide();
                return;
            }
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        /* SUB TYPE -> PRICE */
        function updatePrice() {
            let subType = $('#sub_type').val();
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

        $('#sub_type').on('change', updatePrice);
        updatePrice();
    });
</script>
@endpush

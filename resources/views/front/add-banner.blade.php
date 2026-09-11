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
            $reqPlan = request('plan');
            $reqSubType = request('sub_type');
            if ($reqPlan == 'visiting_card' || $reqSubType == 'side') {
                $selectedSubType = 'side';
                $defaultPrice = 249;
            } elseif ($reqPlan == 'paid_listing' || $reqSubType == 'paid_listing') {
                $selectedSubType = 'paid_listing';
                $defaultPrice = 499;
            } elseif ($reqPlan == 'banner_ad' || $reqSubType == 'top') {
                $selectedSubType = 'top';
                $defaultPrice = 999;
            } else {
                $selectedSubType = old('sub_type', 'top');
                $defaultPrice = $selectedSubType == 'side' ? 249 : ($selectedSubType == 'paid_listing' ? 499 : 999);
            }
        @endphp
        @if($user)
            <div class="banner-card-box">
                <div class="banner-card-header">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                    <span>Ad & Banner Booking (1 Month Plan)</span>
                </div>

                @if(session('notification'))
                    <div style="background: {{ session('notification._type') == 'success' ? '#DCFCE7' : '#FEE2E2' }}; border: 1px solid {{ session('notification._type') == 'success' ? '#86EFAC' : '#FCA5A5' }}; color: {{ session('notification._type') == 'success' ? '#166534' : '#991B1B' }}; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;">
                        {{ session('notification._message') }}
                    </div>
                @endif
                @if(session('error'))
                    <div style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('front.addbanner.store') }}" method="POST" enctype="multipart/form-data" id="banner-form">
                    @csrf

                    <div class="row g-4">
                        {{-- SUB TYPE / AD PLAN --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Ad Plan / Type <span class="required-mark">*</span></label>
                            <select class="select2 custom-form-input @error('sub_type') is-invalid @enderror" name="sub_type" id="sub_type" required>
                                <option value="">Select Ad Plan</option>
                                <option value="top" data-price="999" data-dim="Recommended Size: 2060×741 px" {{ old('sub_type', $selectedSubType)=='top'?'selected':'' }}>Banner Ad (Top Position) - ₹999 / 1 Month</option>
                                <option value="paid_listing" data-price="499" data-dim="Recommended Size: 600×400 px" {{ old('sub_type', $selectedSubType)=='paid_listing'?'selected':'' }}>Paid Listing / Special Offer Ad - ₹499 / 1 Month</option>
                                <option value="side" data-price="249" data-dim="Recommended Size: 364×208 px" {{ old('sub_type', $selectedSubType)=='side'?'selected':'' }}>Visiting Card / Area Agent Ad - ₹249 / 1 Month</option>
                            </select>
                            @error('sub_type')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- TYPE --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Page Placement <span class="required-mark">*</span></label>
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
                            <label class="custom-form-label">Home City / Location <span class="required-mark">*</span></label>
                            <input type="text" class="custom-form-input @error('home_city') is-invalid @enderror" name="home_city" value="{{ old('home_city', $user->city ?? '') }}" placeholder="Enter Home City" required>
                            @error('home_city')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- IMAGE --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">
                                Ad Image (Post Banner / Offer) <span class="required-mark">*</span>
                                <span id="image-hint" style="font-size: 12px; color: #004BEE; font-weight: 600; display: block;"></span>
                            </label>
                            <input type="file" class="custom-form-input @error('image') is-invalid @enderror" name="image" id="image" accept="image/*" required style="padding: 8px;">
                            <img id="preview">
                            @error('image')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- IMAGE ALT / TITLE --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Ad Title / Business Name <span class="required-mark">*</span></label>
                            <input type="text" class="custom-form-input @error('image_alt') is-invalid @enderror" name="image_alt" value="{{ old('image_alt', $user->business_name ?? $user->name) }}" placeholder="Enter Ad Title / Business Name" required>
                            @error('image_alt')
                                <small style="color: #EF4444; font-size: 12px;" class="d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- PRICE --}}
                        <div class="col-md-6">
                            <label class="custom-form-label">Plan Price (Valid for 1 Month)</label>
                            <input type="text" class="custom-form-input" name="price" id="price" value="{{ old('price', $defaultPrice) }}" readonly style="font-weight: 700; color: #004BEE; font-size: 16px;">
                            <small style="color: #64748B; font-size: 13px;" id="price-note">Plan Duration: 1 Month</small>
                        </div>
                    </div>

                    <div style="margin-top: 32px; border-top: 1.5px solid #F1F5F9; padding-top: 20px; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-send-message" style="width: auto; padding: 13px 40px; font-size: 15.5px; border-radius: 12px; background: linear-gradient(135deg, #004BEE, #0036A8); color: #FFF; font-weight: 800; border: none; cursor: pointer; box-shadow: 0 4px 16px rgba(0,75,238,0.3);">
                            <span>Proceed to Payment &rarr;</span>
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 40px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                <div style="width: 64px; height: 64px; border-radius: 50%; background: #DBEAFE; color: #004BEE; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px;">
                    🔒
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 8px;">Please Login to Continue</h3>
                <p style="font-size: 14.5px; color: #64748B; max-width: 500px; margin: 0 auto 20px;">
                    You need to log in to your account to upload your advertisement image and complete the payment.
                </p>
                <a href="javascript:void(0)" class="open-signin" style="display: inline-block; padding: 11px 28px; background: #004BEE; color: #FFFFFF; border-radius: 10px; font-weight: 700; text-decoration: none;">Login Now</a>
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

        /* SUB TYPE -> PRICE & DIMENSION HINT */
        function updatePrice() {
            let selectedOpt = $('#sub_type option:selected');
            let priceField = $('#price');
            let priceNote = $('#price-note');
            let imageHint = $('#image-hint');

            let price = selectedOpt.data('price');
            let dim = selectedOpt.data('dim');

            if (price) {
                priceField.val(price);
                priceNote.text(`1 Month Plan Fee: ₹${price}`);
            } else {
                priceField.val('');
                priceNote.text('');
            }

            if (dim) {
                imageHint.text(`(${dim})`);
            } else {
                imageHint.text('');
            }
        }

        $('#sub_type').on('change', updatePrice);
        updatePrice();
    });
</script>
@endpush

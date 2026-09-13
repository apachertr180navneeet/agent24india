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

    /* Hero Section (Same as Pricing Section) */
    .price-hero-section {
        background: linear-gradient(135deg, #EFF4FF 0%, #E0EAFF 50%, #F5F3FF 100%);
        position: relative;
        overflow: hidden;
        padding: 40px 0 50px 0;
        border-bottom: 1px solid rgba(0, 75, 238, 0.08);
    }
    
    .price-hero-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        position: relative;
        z-index: 2;
    }
    
    .price-hero-left {
        flex: 1;
        max-width: 620px;
    }
    
    .price-hero-title {
        font-size: 38px;
        font-weight: 900;
        color: #004BEE;
        margin: 0 0 10px 0;
        line-height: 1.15;
        letter-spacing: -0.5px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    
    .price-hero-subtitle {
        font-size: 19px;
        font-weight: 700;
        color: #0F172A;
        margin: 0 0 8px 0;
        line-height: 1.45;
    }
    
    .price-hero-desc {
        font-size: 15px;
        font-weight: 500;
        color: #475569;
        margin: 0 0 24px 0;
        line-height: 1.5;
    }
    
    /* Toggle Pill Wrap */
    .price-toggle-wrap {
        display: inline-flex;
        background: #FFFFFF;
        border-radius: 50px;
        padding: 4px;
        box-shadow: 0 4px 18px rgba(0, 75, 238, 0.1);
        border: 1px solid #E2E8F0;
        gap: 4px;
    }
    
    .price-toggle-btn {
        padding: 8px 22px;
        border-radius: 50px;
        border: none;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s ease;
        background: transparent;
        color: #004BEE;
    }
    
    .price-toggle-btn.active {
        background: #004BEE;
        color: #FFFFFF;
        box-shadow: 0 4px 14px rgba(0, 75, 238, 0.35);
    }
    
    .price-hero-right {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .price-hero-illustration {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 991px) {
        .price-hero-container {
            flex-direction: column;
            text-align: center;
            gap: 30px;
        }
        .price-hero-left {
            max-width: 100%;
        }
        .price-hero-title {
            font-size: 30px;
        }
        .price-hero-subtitle {
            font-size: 17px;
        }
        .price-toggle-wrap {
            margin: 0 auto;
        }
    }
</style>
@endpush

@section('content')
    <!-- Pricing Hero Section Start -->
    <section class="price-hero-section">
        <div class="price-hero-container">
            <!-- Left Content -->
            <div class="price-hero-left">
                <h1 class="price-hero-title">Pricing Plans</h1>
                <p class="price-hero-subtitle">अपने बिज़नेस को दें सही Visibility और अधिक Customers</p>
                <p class="price-hero-desc">Affordable Plans के साथ पाएँ ज्यादा Visibility और भरोसेमंद Customers।</p>
                
                <!-- Monthly / 1 Month Duration Badge -->
                <div class="price-toggle-wrap">
                    <button class="price-toggle-btn active" id="toggleMonthly" style="cursor: default;">1 Month Plans</button>
                </div>
            </div>
            
            <!-- Right Illustration -->
            <div class="price-hero-right">
                <div class="price-hero-illustration">
                    <!-- Browser / Tablet Card Mockup with Shield, Coins & Plant -->
                    <svg width="340" height="210" viewBox="0 0 260 170" fill="none" xmlns="http://www.w3.org/2000/svg" style="max-width: 100%; filter: drop-shadow(0 15px 30px rgba(0,75,238,0.15));">
                        <!-- City Background Silhouette -->
                        <path d="M10 140V100H25V80H35V140H50V60H65V140H80V90H95V140H110V50H125V140H140V75H155V140H170V110H185V140H200V85H215V140H230V65H245V140" fill="#E2E8F0" opacity="0.6"/>
                        <path d="M25 140V90H40V140H75V70H90V140H130V60H145V140H180V95H195V140H220V75H235V140" fill="#CBD5E1" opacity="0.5"/>

                        <!-- Tablet / Browser Window -->
                        <rect x="20" y="15" width="200" height="135" rx="10" fill="#FFFFFF" stroke="#2563EB" stroke-width="2.5"/>
                        <!-- Top Bar -->
                        <line x1="20" y1="36" x2="220" y2="36" stroke="#E2E8F0" stroke-width="1.5"/>
                        <!-- Logo & Dots -->
                        <circle cx="30" cy="25" r="4" fill="#004BEE"/>
                        <text x="38" y="28" fill="#004BEE" font-size="7" font-weight="900" font-family="sans-serif">AGENT 24 INDIA</text>
                        <circle cx="195" cy="25" r="2" fill="#94A3B8"/>
                        <circle cx="203" cy="25" r="2" fill="#94A3B8"/>
                        <circle cx="211" cy="25" r="2" fill="#94A3B8"/>
                        <!-- Inner Mockup Elements -->
                        <rect x="32" y="44" width="70" height="10" rx="3" fill="#DBEAFE"/>
                        <rect x="32" y="60" width="80" height="35" rx="5" fill="#F8FAFC" stroke="#E2E8F0"/>
                        <rect x="40" y="68" width="16" height="16" rx="8" fill="#E2E8F0"/>
                        <rect x="62" y="70" width="40" height="4" rx="2" fill="#CBD5E1"/>
                        <rect x="62" y="78" width="30" height="4" rx="2" fill="#E2E8F0"/>

                        <rect x="32" y="102" width="80" height="35" rx="5" fill="#F8FAFC" stroke="#E2E8F0"/>
                        <rect x="40" y="110" width="16" height="16" rx="8" fill="#E2E8F0"/>
                        <rect x="62" y="112" width="40" height="4" rx="2" fill="#CBD5E1"/>
                        <rect x="62" y="120" width="30" height="4" rx="2" fill="#E2E8F0"/>

                        <!-- Shield Badge with Checkmark -->
                        <g filter="drop-shadow(0 8px 16px rgba(0,75,238,0.3))">
                            <path d="M175 42L145 54V80C145 98 158 114 175 119C192 114 205 98 205 80V54L175 42Z" fill="#1D4ED8"/>
                            <path d="M175 46L149 57V80C149 95 160 109 175 114C190 109 201 95 201 80V57L175 46Z" fill="#2563EB"/>
                            <path d="M164 80L171 87L186 71" stroke="#FFFFFF" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>

                        <!-- Gold Coins Stack -->
                        <g>
                            <ellipse cx="140" cy="138" rx="16" ry="6" fill="#D97706"/>
                            <rect x="124" y="132" width="32" height="6" fill="#F59E0B"/>
                            <ellipse cx="140" cy="132" rx="16" ry="6" fill="#FCD34D"/>

                            <ellipse cx="140" cy="128" rx="16" ry="6" fill="#D97706"/>
                            <rect x="124" y="122" width="32" height="6" fill="#F59E0B"/>
                            <ellipse cx="140" cy="122" rx="16" ry="6" fill="#FDE68A"/>

                            <ellipse cx="140" cy="118" rx="16" ry="6" fill="#D97706"/>
                            <rect x="124" y="112" width="32" height="6" fill="#F59E0B"/>
                            <ellipse cx="140" cy="112" rx="16" ry="6" fill="#FEF08A"/>

                            <!-- Coin on the side -->
                            <ellipse cx="160" cy="136" rx="12" ry="5" fill="#D97706"/>
                            <rect x="148" y="131" width="24" height="5" fill="#F59E0B"/>
                            <ellipse cx="160" cy="131" rx="12" ry="5" fill="#FDE68A"/>
                        </g>

                        <!-- Potted Plant on Right -->
                        <g>
                            <!-- Pot -->
                            <path d="M225 125L228 145H242L245 125H225Z" fill="#E2E8F0" stroke="#94A3B8" stroke-width="1.5"/>
                            <!-- Leaves -->
                            <path d="M235 125C235 110 248 100 248 100C248 100 248 115 235 125Z" fill="#16A34A"/>
                            <path d="M235 125C235 112 222 105 222 105C222 105 224 118 235 125Z" fill="#22C55E"/>
                            <path d="M235 125C235 105 238 90 238 90C238 90 244 105 235 125Z" fill="#15803D"/>
                        </g>
                    </svg>
                </div>
            </div>
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

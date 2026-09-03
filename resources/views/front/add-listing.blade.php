@extends('front.layout.main')
@section('title', $pageTitle ?? 'Listing Management')

@push('styles')
    <style>
        .listing-card-box {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.05);
            padding: 36px 32px;
            margin-bottom: 40px;
        }

        .listing-tabs-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1.5px solid #F1F5F9;
        }

        .listing-tabs {
            display: inline-flex;
            background: #F1F5F9;
            border-radius: 35px;
            padding: 5px;
            gap: 6px;
            border: 1px solid #E2E8F0;
        }

        .listing-tabs .tab-btn {
            background: transparent;
            border: none;
            padding: 10px 26px;
            font-weight: 700;
            font-size: 14.5px;
            color: #475569;
            border-radius: 28px;
            cursor: pointer;
            transition: all 0.25s ease;
            outline: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .listing-tabs .tab-btn.active {
            background: #004BEE;
            color: #FFFFFF;
            box-shadow: 0 4px 14px rgba(0, 75, 238, 0.35);
        }

        .listing-tabs .tab-btn:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        /* Essential Tab Pane Hiding & Animation */
        .tab-content > .tab-pane {
            display: none !important;
        }

        .tab-content > .tab-pane.active {
            display: block !important;
            animation: tabFadeIn 0.28s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes tabFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .custom-form-label {
            font-size: 14px;
            font-weight: 700;
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
            transition: all 0.2s ease;
        }

        .custom-form-input:focus {
            border-color: #004BEE;
            box-shadow: 0 0 0 3px rgba(0, 75, 238, 0.12);
        }

        .custom-form-input:read-only {
            background: #F8FAFC;
            color: #64748B;
        }

        .btn-submit-listing {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #004BEE;
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

        .btn-submit-listing:hover {
            background-color: #0036B8;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 75, 238, 0.35);
            color: #FFFFFF;
        }

        .listing-price-summary {
            background: #EFF6FF;
            border: 1.5px solid #BFDBFE;
            border-radius: 14px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .listing-price-summary .price-text {
            font-size: 15px;
            font-weight: 700;
            color: #1E3A8A;
        }

        .listing-price-summary .price-amount {
            font-size: 26px;
            font-weight: 800;
            color: #004BEE;
            line-height: 1.1;
            margin-top: 2px;
        }

        @media (max-width: 640px) {
            .listing-card-box {
                padding: 20px 14px !important;
                border-radius: 16px !important;
                margin-bottom: 24px !important;
            }
            .listing-tabs-wrapper {
                margin-bottom: 20px;
                padding-bottom: 12px;
            }
            .listing-tabs {
                width: 100%;
                display: flex;
            }
            .listing-tabs .tab-btn {
                flex: 1;
                justify-content: center;
                padding: 9px 12px;
                font-size: 13.5px;
            }
            .listing-price-summary {
                padding: 16px 14px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .listing-price-summary .price-amount {
                font-size: 22px;
            }
            .btn-submit-listing {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Banner -->
    <section class="price-hero-banner-section">
        <div class="price-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/price_hero_banner.png') }}" alt="Listing Plans - Agent 24 India" class="price-hero-banner-img">
        </div>
    </section>

    <div class="section-container" style="max-width: 1040px; margin: 30px auto; padding: 0 24px;">
        @if(!empty($existingListing) && $existingListing->paid_type == 'paid')
            <div style="background: #FEF3C7; border: 1px solid #FCD34D; color: #92400E; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600;">
                Free listing is disabled because your paid listing is already active.
            </div>
        @else
            @php
                $user = auth()->user();
            @endphp
            @if($user && $user->is_approved == '1')
                <div class="listing-card-box">
                    
                    <!-- Segmented Pill Tabs -->
                    <div class="listing-tabs-wrapper">
                        <div class="listing-tabs" role="tablist">
                            <button type="button" class="tab-btn {{ !empty($disableFreeListing) ? '' : 'active' }}" data-target="#free" @if (!empty($disableFreeListing)) disabled @endif>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6L9 17l-5-5"/>
                                </svg>
                                <span>Free Listing</span>
                            </button>

                            <button type="button" class="tab-btn {{ !empty($disableFreeListing) ? 'active' : '' }}" data-target="#paid">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 6v12M15 9.5a3.5 3.5 0 0 0-7 0c0 2.5 3.5 3 3.5 5.5a3.5 3.5 0 0 1-7 0"/>
                                </svg>
                                <span>Paid Listing</span>
                            </button>
                        </div>
                    </div>

                    <div class="tab-content">
                        <!-- FREE LISTING -->
                        <div class="tab-pane {{ !empty($disableFreeListing) ? '' : 'active' }}" id="free">
                            @if (!empty($disableFreeListing))
                                <div style="background: #FEF3C7; border: 1px solid #FCD34D; color: #92400E; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px;">
                                    Free listing is disabled because your paid listing is active.
                                </div>
                            @endif

                            @if (session('success'))
                                <div style="background: #DCFCE7; border: 1px solid #86EFAC; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px;">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px;">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('front.addListing.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="free">

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="custom-form-label">Business Name</label>
                                        <input type="text" name="name" class="custom-form-input" value="{{ $user->business_name }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="custom-form-label">Registered Email</label>
                                        <input type="email" name="email" class="custom-form-input" value="{{ old('email', $user->email) }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="custom-form-label">WhatsApp Number (From Profile)</label>
                                        <input type="text" name="phone" class="custom-form-input" value="{{ old('phone', $user->whats_app) }}" readonly>
                                    </div>
                                </div>

                                <div class="form-action-wrap" style="margin-top: 32px;">
                                    <button type="submit" class="btn-submit-listing">
                                        <span>Submit Free Listing</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- PAID LISTING -->
                        <div class="tab-pane {{ !empty($disableFreeListing) ? 'active' : '' }}" id="paid">
                            <form action="{{ route('front.addListing.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="paid">

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="custom-form-label">Contact / Business Name <span style="color: #EF4444;">*</span></label>
                                        <input type="text" name="name" class="custom-form-input" value="{{ old('name', $existingPaidListing->name ?? $user->business_name) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="custom-form-label">Home City <span style="color: #EF4444;">*</span></label>
                                        <input type="text" name="home_city" class="custom-form-input" value="{{ old('home_city', $existingPaidListing->home_city ?? '') }}" placeholder="Enter City" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="custom-form-label">Plan Duration <span style="color: #EF4444;">*</span></label>
                                        <select class="select2 custom-form-input" name="duration" id="paid_duration" required>
                                            <option value="1" {{ old('duration', '1') == '1' ? 'selected' : '' }}>1 Month</option>
                                            <option value="2" {{ old('duration') == '2' ? 'selected' : '' }}>2 Months</option>
                                            <option value="3" {{ old('duration') == '3' ? 'selected' : '' }}>3 Months</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="listing-price-summary" style="margin-top: 32px;">
                                    <div>
                                        <span class="price-text" id="paid_price_label">1 Month Price</span>
                                        <div class="price-amount" id="paid_price_display">
                                             {{ old('duration', '1') == '2' ? '443 Rs' : (old('duration') == '3' ? '590 Rs' : '1 Rs') }}
                                        </div>
                                        <small style="color: #64748B; font-size: 13px;" id="paid_price_note">Test price Rs. 1</small>
                                        <input type="hidden" name="price" id="paid_price" value="{{ old('duration', '1') == '2' ? '443' : (old('duration') == '3' ? '590' : '1') }}">
                                    </div>

                                    <button type="submit" class="btn-submit-listing">
                                        <span>Confirm & Pay</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 40px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                    <div style="width: 64px; height: 64px; border-radius: 50%; background: #FEF3C7; color: #D97706; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px;">
                        ⏳
                    </div>
                    <h3 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 8px;">Account Verification In Progress</h3>
                    <p style="font-size: 14.5px; color: #64748B; max-width: 500px; margin: 0 auto;">
                        After admin approval, you will be able to create free and paid listings. Our team is reviewing your profile.
                    </p>
                </div>
            @endif
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tab switching handler
            $(document).on('click', '.listing-tabs .tab-btn', function(e) {
                e.preventDefault();
                if ($(this).prop('disabled') || $(this).attr('disabled')) return;

                var target = $(this).data('target');
                $('.listing-tabs .tab-btn').removeClass('active');
                $(this).addClass('active');

                $('.tab-content > .tab-pane').removeClass('active');
                $(target).addClass('active');
            });

            if ($.fn.select2) {
                $('#paid_duration').select2({
                    width: '100%'
                });
            }

            function updatePaidListingPrice() {
                let duration = $('#paid_duration').val();
                let basePrice = 0;
                let label = '1 Month Price';
                let totalPrice = 1;

                if (duration === '2') {
                    basePrice = 375;
                    label = '2 Month Price';
                    totalPrice = (basePrice * 1.18).toFixed(0);
                    $('#paid_price_note').text(`Base price Rs. ${basePrice} + 18% GST = Rs. ${totalPrice}`);
                } else if (duration === '3') {
                    basePrice = 500;
                    label = '3 Month Price';
                    totalPrice = (basePrice * 1.18).toFixed(0);
                    $('#paid_price_note').text(`Base price Rs. ${basePrice} + 18% GST = Rs. ${totalPrice}`);
                } else {
                    basePrice = 1;
                    totalPrice = 1;
                    $('#paid_price_note').text('Test price Rs. 1');
                }

                $('#paid_price_label').text(label);
                $('#paid_price_display').text(`${totalPrice} Rs`);
                $('#paid_price').val(totalPrice);
            }

            $('#paid_duration').on('change', updatePaidListingPrice);
            updatePaidListingPrice();
        });
    </script>
@endpush

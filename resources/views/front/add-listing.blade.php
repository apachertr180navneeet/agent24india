@extends('front.layout.main')
@section('title', $pageTitle ?? 'Listing Management')

@push('styles')
    <style>
        .listing-card-box {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 32px;
            margin-bottom: 40px;
        }

        .listing-tabs {
            display: flex;
            gap: 12px;
            border-bottom: 2px solid #F1F5F9;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }

        .listing-tabs .tab-btn {
            background: transparent;
            border: none;
            padding: 10px 24px;
            font-weight: 700;
            font-size: 15px;
            color: #64748B;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .listing-tabs .tab-btn.active {
            background: #004BEE;
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(0, 75, 238, 0.25);
        }

        .listing-tabs .tab-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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

        .listing-price-summary {
            background: #EFF6FF;
            border: 1.5px solid #BFDBFE;
            border-radius: 12px;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .listing-price-summary .price-text {
            font-size: 15px;
            font-weight: 600;
            color: #1E3A8A;
        }

        .listing-price-summary .price-amount {
            font-size: 24px;
            font-weight: 800;
            color: #004BEE;
        }

        @media (max-width: 640px) {
            .listing-card-box {
                padding: 20px 14px !important;
                border-radius: 14px !important;
                margin-bottom: 24px !important;
            }
            .listing-tabs {
                overflow-x: auto;
                gap: 8px;
                padding-bottom: 8px;
            }
            .listing-tabs .tab-btn {
                padding: 8px 16px;
                font-size: 13.5px;
                white-space: nowrap;
            }
            .listing-price-summary {
                padding: 14px 16px;
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            .listing-price-summary .price-amount {
                font-size: 20px;
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
                    
                    <!-- Nav Tabs -->
                    <div class="listing-tabs" role="tablist">
                        <button class="tab-btn {{ !empty($disableFreeListing) ? '' : 'active' }}" id="free-tab" data-bs-toggle="tab"
                            data-bs-target="#free" type="button" role="tab" @if (!empty($disableFreeListing)) disabled @endif>
                            Free Listing
                        </button>

                        <button class="tab-btn {{ !empty($disableFreeListing) ? 'active' : '' }}" id="paid-tab"
                            data-bs-toggle="tab" data-bs-target="#paid" type="button" role="tab">
                            Paid Listing
                        </button>
                    </div>

                    <div class="tab-content">
                        <!-- FREE LISTING -->
                        <div class="tab-pane fade {{ !empty($disableFreeListing) ? '' : 'show active' }}" id="free">
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

                                <div class="row g-3 mb-3">
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

                                <button type="submit" class="btn-send-message" style="width: auto; padding: 12px 32px; font-size: 15px; border-radius: 10px;">
                                    <span>Submit Free Listing</span>
                                </button>
                            </form>
                        </div>

                        <!-- PAID LISTING -->
                        <div class="tab-pane fade {{ !empty($disableFreeListing) ? 'show active' : '' }}" id="paid">
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

                                <div class="listing-price-summary">
                                    <div>
                                        <span class="price-text" id="paid_price_label">1 Month Price</span>
                                        <div class="price-amount" id="paid_price_display">
                                            {{ old('duration', '1') == '2' ? '443 Rs' : (old('duration') == '3' ? '590 Rs' : '295 Rs') }}
                                        </div>
                                        <small style="color: #64748B; font-size: 13px;" id="paid_price_note"></small>
                                        <input type="hidden" name="price" id="paid_price" value="{{ old('duration', '1') == '2' ? '443' : (old('duration') == '3' ? '590' : '295') }}">
                                    </div>

                                    <button type="submit" class="btn-send-message" style="width: auto; padding: 12px 36px; font-size: 15px; border-radius: 10px;">
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
            if ($.fn.select2) {
                $('#paid_duration').select2({
                    width: '100%'
                });
            }

            function updatePaidListingPrice() {
                let duration = $('#paid_duration').val();
                let basePrice = 0;
                let label = '1 Month Price';

                if (duration === '2') {
                    basePrice = 375;
                    label = '2 Month Price';
                } else if (duration === '3') {
                    basePrice = 500;
                    label = '3 Month Price';
                } else {
                    basePrice = 250;
                }

                let totalPrice = (basePrice * 1.18).toFixed(0);

                $('#paid_price_label').text(label);
                $('#paid_price_display').text(`${totalPrice} Rs`);
                $('#paid_price_note').text(`Base price Rs. ${basePrice} + 18% GST = Rs. ${totalPrice}`);
                $('#paid_price').val(totalPrice);
            }

            $('#paid_duration').on('change', updatePaidListingPrice);
            updatePaidListingPrice();
        });
    </script>
@endpush

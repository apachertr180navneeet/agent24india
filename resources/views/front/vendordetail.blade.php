@extends('front.layout.main')
@section('title', $pageTitle ?? ($vendoruser->business_name . ' - Agent Profile'))

@push('styles')
<style>
    .vendor-detail-page {
        background-color: #F8FAFC;
        padding: 30px 0 60px 0;
    }

    .vd-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Breadcrumbs */
    .vd-breadcrumbs {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        color: #64748B;
        margin-bottom: 24px;
    }

    .vd-breadcrumbs a {
        color: #64748B;
        text-decoration: none;
        transition: color 0.2s;
    }

    .vd-breadcrumbs a:hover {
        color: #004BEE;
    }

    .vd-breadcrumbs span.active {
        color: #0F172A;
        font-weight: 700;
    }

    /* Main Profile Card */
    .vd-profile-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        padding: 36px;
        margin-bottom: 30px;
    }

    .vd-profile-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 36px;
        align-items: start;
    }

    @media (max-width: 991px) {
        .vd-profile-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Left Photo Box */
    .vd-photo-column {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .vd-image-wrap {
        width: 100%;
        height: 280px;
        border-radius: 16px;
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .vd-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vd-trust-box {
        background: #EFF6FF;
        border: 1px solid #BFDBFE;
        border-radius: 14px;
        padding: 16px;
        text-align: center;
    }

    .vd-trust-title {
        font-size: 14px;
        font-weight: 800;
        color: #004BEE;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .vd-trust-desc {
        font-size: 12px;
        color: #475569;
        line-height: 1.4;
    }

    /* Right Details Box */
    .vd-details-column {
        display: flex;
        flex-direction: column;
    }

    .vd-badges-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        flex-wrap: wrap;
    }

    .badge-pill-verified {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #DCFCE7;
        color: #166534;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .badge-pill-premium {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #EFF6FF;
        color: #004BEE;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .badge-pill-category {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #F1F5F9;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .vd-business-title {
        font-size: 28px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 10px;
        line-height: 1.25;
    }

    .vd-address-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14.5px;
        color: #64748B;
        margin-bottom: 24px;
    }

    .vd-address-row svg {
        color: #004BEE;
        flex-shrink: 0;
    }

    /* Action Buttons */
    .vd-actions-row {
        display: flex;
        gap: 12px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .vd-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 26px;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .vd-btn-call {
        background: #004BEE;
        color: #FFFFFF !important;
        box-shadow: 0 6px 18px rgba(0, 75, 238, 0.25);
    }

    .vd-btn-call:hover {
        background: #0036B8;
        transform: translateY(-2px);
    }

    .vd-btn-whatsapp {
        background: #16A34A;
        color: #FFFFFF !important;
        box-shadow: 0 6px 18px rgba(22, 163, 74, 0.25);
    }

    .vd-btn-whatsapp:hover {
        background: #15803D;
        transform: translateY(-2px);
    }

    .vd-btn-email {
        background: #EFF6FF;
        color: #004BEE !important;
        border: 1.5px solid #BFDBFE;
    }

    .vd-btn-email:hover {
        background: #004BEE;
        color: #FFFFFF !important;
        border-color: #004BEE;
    }

    /* Key Specs Grid */
    .vd-specs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 28px;
    }

    @media (max-width: 767px) {
        .vd-specs-grid {
            grid-template-columns: 1fr;
        }
    }

    .vd-spec-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .vd-spec-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .vd-spec-val {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
    }

    /* Description Card */
    .vd-section-box {
        margin-bottom: 24px;
    }

    .vd-section-heading {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 12px;
        border-bottom: 2px solid #F1F5F9;
        padding-bottom: 8px;
    }

    .vd-desc-text {
        font-size: 14.5px;
        color: #334155;
        line-height: 1.7;
    }

    /* Share Section */
    .vd-share-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-top: 18px;
        border-top: 1px solid #F1F5F9;
    }

    .vd-share-label {
        font-size: 13.5px;
        font-weight: 700;
        color: #64748B;
    }
</style>
@endpush

@section('content')
<div class="vendor-detail-page">
    <div class="vd-container">

        <!-- Breadcrumbs -->
        <nav class="vd-breadcrumbs">
            <a href="{{ route('front.index') }}">Home</a>
            <span>/</span>
            <a href="{{ route('front.vendorlist') }}">Verified Agents</a>
            <span>/</span>
            <span class="active">{{ $vendoruser->business_name }}</span>
        </nav>

        <!-- Main Profile Card -->
        <div class="vd-profile-card">
            <div class="vd-profile-grid">
                
                <!-- Left Column: Photo & Trust Badge -->
                <div class="vd-photo-column">
                    <div class="vd-image-wrap">
                        <img src="{{ $vendoruser->profile_photo ? $vendoruser->profile_photo : asset('images/images.png') }}" alt="{{ $vendoruser->business_name }}" onerror="this.onerror=null; this.src='{{ asset('images/images.png') }}';">
                    </div>

                    <div class="vd-trust-box">
                        <div class="vd-trust-title">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <polyline points="9 12 11 14 15 10"></polyline>
                            </svg>
                            <span>100% Verified Profile</span>
                        </div>
                        <p class="vd-trust-desc">Agent identity & business credentials verified by Agent 24 India.</p>
                    </div>
                </div>

                <!-- Right Column: Business Info & Actions -->
                <div class="vd-details-column">
                    
                    <!-- Badges -->
                    <div class="vd-badges-row">
                        <span class="badge-pill-verified">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span>Verified Agent</span>
                        </span>

                        @if($vendoruser->vendor_type == 'paid')
                            <span class="badge-pill-premium">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                <span>AI Verified</span>
                            </span>
                        @endif

                        @if(!empty($vendoruser->business_category_name))
                            <span class="badge-pill-category">
                                {{ $vendoruser->business_category_name }}
                            </span>
                        @endif
                    </div>

                    <!-- Business Name -->
                    <h1 class="vd-business-title">{{ $vendoruser->business_name }}</h1>

                    <!-- Location Address -->
                    <div class="vd-address-row">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>{{ $vendoruser->business_address }}, {{ $vendoruser->city_name }} ({{ $vendoruser->district_name }})</span>
                    </div>

                    @php
                        $cleanMobile = !empty($vendoruser->mobile) ? preg_replace('/[^0-9+]/', '', $vendoruser->mobile) : (!empty($vendoruser->whats_app) ? preg_replace('/[^0-9+]/', '', $vendoruser->whats_app) : '');
                        $waNum = '';
                        if (!empty($vendoruser->whats_app)) {
                            $waNum = preg_replace('/[^0-9]/', '', $vendoruser->whats_app);
                            if (strlen($waNum) == 10) {
                                $waNum = '91' . $waNum;
                            }
                        }
                    @endphp

                    <!-- Contact Action Buttons -->
                    <div class="vd-actions-row">
                        @if(!empty($cleanMobile))
                            <a href="tel:{{ $cleanMobile }}" class="vd-action-btn vd-btn-call" onclick="if(!/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)){ event.preventDefault(); alert('Phone Number: {{ $cleanMobile }}'); }">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>Call Now</span>
                            </a>
                        @endif

                        @if($vendoruser->vendor_type == 'paid' && !empty($waNum))
                            <a href="https://wa.me/{{ $waNum }}" class="vd-action-btn vd-btn-whatsapp" target="_blank">
                                <i class="fa-brands fa-whatsapp" style="font-size: 18px;"></i>
                                <span>WhatsApp</span>
                            </a>
                        @endif

                        @if(!empty($vendoruser->email))
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $vendoruser->email }}" class="vd-action-btn vd-btn-email" target="_blank">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span>Send Enquiry</span>
                            </a>
                        @endif
                    </div>

                    <!-- Key Details Grid -->
                    <div class="vd-specs-grid">
                        <div class="vd-spec-item">
                            <span class="vd-spec-label">District</span>
                            <span class="vd-spec-val">{{ $vendoruser->district_name ?? '-' }}</span>
                        </div>

                        <div class="vd-spec-item">
                            <span class="vd-spec-label">City</span>
                            <span class="vd-spec-val">{{ $vendoruser->city_name ?? '-' }}</span>
                        </div>

                        <div class="vd-spec-item">
                            <span class="vd-spec-label">State</span>
                            <span class="vd-spec-val">{{ $vendoruser->state_name ?? 'Rajasthan' }}</span>
                        </div>

                        <div class="vd-spec-item">
                            <span class="vd-spec-label">Pincode</span>
                            <span class="vd-spec-val">{{ $vendoruser->pincode ?? '-' }}</span>
                        </div>

                        <div class="vd-spec-item">
                            <span class="vd-spec-label">Speciality</span>
                            <span class="vd-spec-val">{{ $vendoruser->business_sub_category_names ?? $vendoruser->business_category_name ?? '-' }}</span>
                        </div>

                        <div class="vd-spec-item">
                            <span class="vd-spec-label">Location Landmark</span>
                            <span class="vd-spec-val">{{ $vendoruser->pick_your_location ?? $vendoruser->business_address ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- About / Description -->
                    <div class="vd-section-box">
                        <h2 class="vd-section-heading">About Business & Services</h2>
                        <p class="vd-desc-text">
                            {{ $vendoruser->description ?? 'No business description provided by the agent. For inquiries regarding services and rates, please call or connect via WhatsApp directly.' }}
                        </p>
                    </div>

                    <!-- Share Profile -->
                    <div class="vd-share-wrap">
                        <span class="vd-share-label">Share Profile:</span>
                        <div class="a2a_kit a2a_kit_size_28 a2a_default_style">
                            <a class="a2a_button_whatsapp"></a>
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_x"></a>
                            <a class="a2a_button_email"></a>
                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        </div>
                        <script defer src="https://static.addtoany.com/menu/page.js"></script>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
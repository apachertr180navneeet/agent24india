@extends('front.layout.main')
@section('title', $pageTitle ?? (($vendoruser->business_name ?? 'Vendor') . ' - Agent Profile'))

@section('content')
@php
    $bizName = $vendoruser->business_name ?? $vendoruser->name ?? 'Verified Agent';
    $phone = !empty($vendoruser->mobile) ? $vendoruser->mobile : ($vendoruser->whats_app ?? '');
    $cleanPhone = preg_replace('/[^0-9+]/', '', $phone);
    if(strlen($cleanPhone) == 10) {
        $displayPhone = '+91 ' . substr($cleanPhone, 0, 5) . ' ' . substr($cleanPhone, 5);
    } else {
        $displayPhone = $phone ?: '+91 98290 12345';
    }

    $waNum = preg_replace('/[^0-9]/', '', $vendoruser->whats_app ?: $vendoruser->mobile);
    if (strlen($waNum) == 10) {
        $waNum = '91' . $waNum;
    }

    $email = $vendoruser->email ?? 'info@shreebalajiproperties.com';
    $state = $vendoruser->state_name ?? 'Rajasthan';
    $district = $vendoruser->district_name ?? 'Jaipur';
    $city = $vendoruser->city_name ?? 'Jaipur';
    $pincode = $vendoruser->pincode ?? '302021';
    $address = $vendoruser->business_address ?? 'Vaishali Nagar, Jaipur, Rajasthan - 302021';
    $categoryName = $vendoruser->business_category_name ?? 'Real Estate Agent';
    $subCategories = $vendoruser->business_sub_category_names ?? 'Buy | Sell | Rent | Commercial | Property Consultant';
    $description = $vendoruser->description ?: ($bizName . ' ' . $city . ' mein ek bharosemand Real Estate Consultant hai. Hum Residential, Commercial, Rental aur Investment Properties mein visheshagyata rakhte hai. Humara uddeshya pardarshita, imandari aur grahak santushti hai.');
@endphp

<div class="vd-page-wrapper">
    <div class="vd-container">

        <!-- Breadcrumbs Navigation -->
        <nav class="vd-breadcrumbs" aria-label="Breadcrumb">
            <a href="{{ route('front.index') }}">Home</a>
            <span class="vd-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <a href="{{ route('front.vendorlist') }}">{{ $state }}</a>
            <span class="vd-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <a href="{{ route('front.vendorlist') }}">{{ $district }}</a>
            <span class="vd-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <span>{{ $categoryName }}</span>
            <span class="vd-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <span class="active">{{ $bizName }}</span>
        </nav>

        <!-- Main 2-Column Grid Layout -->
        <div class="vd-layout-grid">

            <!-- LEFT MAIN COLUMN -->
            <div class="vd-main-content">

                <!-- 1. Top Vendor Profile Hero Card -->
                <div class="vd-hero-card">
                    <div class="vd-hero-inner">
                        
                        <!-- Left: Square Logo Box with Verified Badge -->
                        <div class="vd-logo-box">
                            @if(!empty($vendoruser->profile_photo) && file_exists(public_path($vendoruser->profile_photo)))
                                <img src="{{ asset($vendoruser->profile_photo) }}" alt="{{ $bizName }}" class="vd-logo-img">
                            @elseif(!empty($vendoruser->vendor_image) && file_exists(public_path($vendoruser->vendor_image)))
                                <img src="{{ asset($vendoruser->vendor_image) }}" alt="{{ $bizName }}" class="vd-logo-img">
                            @else
                                <div class="vd-logo-placeholder">
                                    <div class="vd-placeholder-icon">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 21h18"></path>
                                            <path d="M5 21V7l8-4v18"></path>
                                            <path d="M19 21V11l-6-4"></path>
                                            <path d="M9 9h1"></path>
                                            <path d="M9 13h1"></path>
                                            <path d="M9 17h1"></path>
                                        </svg>
                                    </div>
                                    <span class="vd-placeholder-name">{{ $bizName }}</span>
                                    <span class="vd-placeholder-tag">— PROPERTIES —</span>
                                </div>
                            @endif

                            <!-- Verified Agent Green Pill -->
                            <div class="vd-verified-pill">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED AGENT</span>
                            </div>
                        </div>

                        <!-- Right: Vendor Details & Key Metrics -->
                        <div class="vd-hero-info">
                            <!-- Title & Blue Verified Tick -->
                            <div class="vd-title-row">
                                <h1 class="vd-biz-name">{{ $bizName }}</h1>
                                <span class="vd-blue-badge" title="Agent 24 India Verified">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#004BEE">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="#004BEE"/>
                                        <path d="M10 14.17l-3.59-3.58L5 12l5 5 9-9-1.41-1.41L10 14.17z" fill="#FFFFFF"/>
                                    </svg>
                                </span>
                            </div>

                            <!-- Rating & Reviews -->
                            <div class="vd-rating-row">
                                <span class="vd-rating-num">4.8</span>
                                <div class="vd-stars-wrap">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                </div>
                                <span class="vd-reviews-count">(128 Reviews)</span>
                            </div>

                            <!-- Categories / Services Tags -->
                            <div class="vd-tags-row">
                                <span>{{ $subCategories }}</span>
                            </div>

                            <!-- Address & Map Link -->
                            <div class="vd-address-row">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span class="vd-address-text">{{ $address }}</span>
                                <a href="#officeMapCard" class="vd-view-map-link">View on Map</a>
                            </div>

                            <!-- 4 Key Stat Badges Row -->
                            <div class="vd-metrics-strip">
                                <div class="vd-metric-item">
                                    <div class="vd-metric-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </div>
                                    <div class="vd-metric-texts">
                                        <span class="vd-metric-val">5+</span>
                                        <span class="vd-metric-lbl">Years in Business</span>
                                    </div>
                                </div>

                                <div class="vd-metric-item">
                                    <div class="vd-metric-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </div>
                                    <div class="vd-metric-texts">
                                        <span class="vd-metric-val">128+</span>
                                        <span class="vd-metric-lbl">Happy Clients</span>
                                    </div>
                                </div>

                                <div class="vd-metric-item">
                                    <div class="vd-metric-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </div>
                                    <div class="vd-metric-texts">
                                        <span class="vd-metric-val">500+</span>
                                        <span class="vd-metric-lbl">Properties Sold</span>
                                    </div>
                                </div>

                                <div class="vd-metric-item">
                                    <div class="vd-metric-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                        </svg>
                                    </div>
                                    <div class="vd-metric-texts">
                                        <span class="vd-metric-val">24/7</span>
                                        <span class="vd-metric-lbl">Support Available</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 2. Interactive Navigation Tabs -->
                <div class="vd-tabs-nav-wrap">
                    <ul class="vd-tabs-nav" id="vendorTabs">
                        <li class="vd-tab-item active" data-tab="overview">Overview</li>
                        <li class="vd-tab-item" data-tab="properties">Properties (45)</li>
                        <li class="vd-tab-item" data-tab="services">Services</li>
                        <li class="vd-tab-item" data-tab="reviews">Reviews (128)</li>
                        <li class="vd-tab-item" data-tab="about">About Us</li>
                        <li class="vd-tab-item" data-tab="contact">Contact</li>
                    </ul>
                </div>

                <!-- 3. Tab Panes -->
                <div class="vd-tabs-content">

                    <!-- TAB PANE 1: OVERVIEW -->
                    <div class="vd-tab-pane active" id="pane-overview">

                        <!-- About Section Card -->
                        <div class="vd-section-card">
                            <h2 class="vd-card-title">About {{ $bizName }}</h2>
                            <p class="vd-about-desc">{{ $description }}</p>

                            <!-- 5 Trust Highlight Pills -->
                            <div class="vd-feature-pills">
                                <span class="vd-pill">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    </svg>
                                    <span>Trusted Service</span>
                                </span>

                                <span class="vd-pill">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                    </svg>
                                    <span>Legal Support</span>
                                </span>

                                <span class="vd-pill">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                    </svg>
                                    <span>Best Market Price</span>
                                </span>

                                <span class="vd-pill">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>Personalized Advice</span>
                                </span>

                                <span class="vd-pill">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                    </svg>
                                    <span>End to End Support</span>
                                </span>
                            </div>
                        </div>

                        <!-- Our Office & Team Photo Gallery -->
                        <div class="vd-section-card">
                            <h2 class="vd-card-title">Our Office & Team</h2>
                            <div class="vd-gallery-grid">
                                <div class="vd-gallery-item">
                                    <img src="{{ asset('public/front/assets/images/office_reception.jpg') }}" alt="Office Reception" class="vd-gallery-img">
                                    <div class="vd-gallery-caption">Office Reception</div>
                                </div>
                                <div class="vd-gallery-item">
                                    <img src="{{ asset('public/front/assets/images/office_conference.jpg') }}" alt="Conference Meeting Room" class="vd-gallery-img">
                                    <div class="vd-gallery-caption">Conference Room</div>
                                </div>
                                <div class="vd-gallery-item">
                                    <img src="{{ asset('public/front/assets/images/office_team.jpg') }}" alt="Real Estate Agent Team" class="vd-gallery-img">
                                    <div class="vd-gallery-caption">Professional Team</div>
                                </div>
                                <div class="vd-gallery-item">
                                    <img src="{{ asset('public/front/assets/images/office_building.jpg') }}" alt="Commercial Office Building" class="vd-gallery-img">
                                    <div class="vd-gallery-caption">Office Building</div>
                                </div>
                            </div>
                        </div>

                        <!-- Why Choose Us? Section -->
                        <div class="vd-section-card">
                            <h2 class="vd-card-title">Why Choose Us?</h2>
                            <div class="vd-why-grid">
                                
                                <div class="vd-why-col">
                                    <div class="vd-why-icon-box">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                            <polyline points="9 12 11 14 15 10"></polyline>
                                        </svg>
                                    </div>
                                    <div class="vd-why-texts">
                                        <h4 class="vd-why-title">Verified Agents</h4>
                                        <p class="vd-why-desc">Sabhi Agents ka Background Check kiya gaya hai</p>
                                    </div>
                                </div>

                                <div class="vd-why-col">
                                    <div class="vd-why-icon-box">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="18" cy="5" r="3"></circle>
                                            <circle cx="6" cy="12" r="3"></circle>
                                            <circle cx="18" cy="19" r="3"></circle>
                                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                        </svg>
                                    </div>
                                    <div class="vd-why-texts">
                                        <h4 class="vd-why-title">Wide Network</h4>
                                        <p class="vd-why-desc">{{ $city }} ke sabhi pramukh Locations mein network</p>
                                    </div>
                                </div>

                                <div class="vd-why-col">
                                    <div class="vd-why-icon-box">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                        </svg>
                                    </div>
                                    <div class="vd-why-texts">
                                        <h4 class="vd-why-title">Best Deals</h4>
                                        <p class="vd-why-desc">Kifayati daamon mein Best Deals ki guarantee</p>
                                    </div>
                                </div>

                                <div class="vd-why-col">
                                    <div class="vd-why-icon-box">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                    </div>
                                    <div class="vd-why-texts">
                                        <h4 class="vd-why-title">100% Transparent</h4>
                                        <p class="vd-why-desc">Koi chhupe hue charge nahi, poori pardarshita</p>
                                    </div>
                                </div>

                                <div class="vd-why-col">
                                    <div class="vd-why-icon-box">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                        </svg>
                                    </div>
                                    <div class="vd-why-texts">
                                        <h4 class="vd-why-title">Happy Clients</h4>
                                        <p class="vd-why-desc">Hazaron khush grahakon ka vishwas</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Royal Blue CTA Banner Strip -->
                        <div class="vd-cta-banner">
                            <div class="vd-cta-left">
                                <div class="vd-cta-icon-circle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </div>
                                <div class="vd-cta-text-wrap">
                                    <h3 class="vd-cta-title">Looking to Buy, Sell or Rent Property?</h3>
                                    <p class="vd-cta-sub">Hum aapki madad ke liye taiyar hai</p>
                                </div>
                            </div>
                            <div class="vd-cta-right">
                                <button type="button" class="btn-cta-enquire" onclick="openEnquiryModal()">
                                    <span>Enquire Now</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- TAB PANE 2: PROPERTIES -->
                    <div class="vd-tab-pane" id="pane-properties">
                        <div class="vd-section-card">
                            <div class="vd-pane-header">
                                <h2 class="vd-card-title">Available Properties by {{ $bizName }} (45)</h2>
                                <span class="vd-prop-filter-badge">All Properties ({{ $city }})</span>
                            </div>
                            
                            <div class="vd-prop-grid">
                                <div class="vd-prop-card">
                                    <div class="vd-prop-img-wrap">
                                        <img src="{{ asset('public/front/assets/images/district_jaipur.jpg') }}" alt="Luxury Flat">
                                        <span class="vd-prop-tag for-sale">For Sale</span>
                                        <span class="vd-prop-price">₹ 75 Lakh</span>
                                    </div>
                                    <div class="vd-prop-body">
                                        <h4 class="vd-prop-name">3 BHK Luxury Apartment</h4>
                                        <p class="vd-prop-loc"><i class="fa-solid fa-location-dot"></i> Vaishali Nagar, {{ $city }}</p>
                                        <div class="vd-prop-amenities">
                                            <span><i class="fa-solid fa-bed"></i> 3 Beds</span>
                                            <span><i class="fa-solid fa-bath"></i> 3 Baths</span>
                                            <span><i class="fa-solid fa-chart-area"></i> 1850 sq.ft</span>
                                        </div>
                                        <button class="btn-prop-enq" onclick="openEnquiryModal('3 BHK Luxury Apartment - Vaishali Nagar')">Enquire Now</button>
                                    </div>
                                </div>

                                <div class="vd-prop-card">
                                    <div class="vd-prop-img-wrap">
                                        <img src="{{ asset('public/front/assets/images/office_building.jpg') }}" alt="Commercial Space">
                                        <span class="vd-prop-tag for-rent">For Rent</span>
                                        <span class="vd-prop-price">₹ 45,000 / mo</span>
                                    </div>
                                    <div class="vd-prop-body">
                                        <h4 class="vd-prop-name">Commercial Office Space</h4>
                                        <p class="vd-prop-loc"><i class="fa-solid fa-location-dot"></i> Mansarovar, {{ $city }}</p>
                                        <div class="vd-prop-amenities">
                                            <span><i class="fa-solid fa-building"></i> Commercial</span>
                                            <span><i class="fa-solid fa-chart-area"></i> 1200 sq.ft</span>
                                            <span><i class="fa-solid fa-car"></i> Parking</span>
                                        </div>
                                        <button class="btn-prop-enq" onclick="openEnquiryModal('Commercial Office Space - Mansarovar')">Enquire Now</button>
                                    </div>
                                </div>

                                <div class="vd-prop-card">
                                    <div class="vd-prop-img-wrap">
                                        <img src="{{ asset('public/front/assets/images/office_reception.jpg') }}" alt="Villa">
                                        <span class="vd-prop-tag for-sale">For Sale</span>
                                        <span class="vd-prop-price">₹ 1.45 Cr</span>
                                    </div>
                                    <div class="vd-prop-body">
                                        <h4 class="vd-prop-name">4 BHK Independent Villa</h4>
                                        <p class="vd-prop-loc"><i class="fa-solid fa-location-dot"></i> Ajmer Road, {{ $city }}</p>
                                        <div class="vd-prop-amenities">
                                            <span><i class="fa-solid fa-bed"></i> 4 Beds</span>
                                            <span><i class="fa-solid fa-bath"></i> 4 Baths</span>
                                            <span><i class="fa-solid fa-chart-area"></i> 2600 sq.ft</span>
                                        </div>
                                        <button class="btn-prop-enq" onclick="openEnquiryModal('4 BHK Independent Villa - Ajmer Road')">Enquire Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB PANE 3: SERVICES -->
                    <div class="vd-tab-pane" id="pane-services">
                        <div class="vd-section-card">
                            <h2 class="vd-card-title">Professional Real Estate Services</h2>
                            <div class="vd-services-grid">
                                <div class="vd-service-box">
                                    <div class="vd-service-icon"><i class="fa-solid fa-house-chimney"></i></div>
                                    <h4 class="vd-service-title">Residential Property Buy & Sale</h4>
                                    <p class="vd-service-desc">Verified apartments, villas, builder floors, and residential plots across prime localities in {{ $city }}.</p>
                                </div>
                                <div class="vd-service-box">
                                    <div class="vd-service-icon"><i class="fa-solid fa-briefcase"></i></div>
                                    <h4 class="vd-service-title">Commercial Real Estate</h4>
                                    <p class="vd-service-desc">Retail showrooms, corporate office spaces, warehouses, and industrial land leasing with high ROI.</p>
                                </div>
                                <div class="vd-service-box">
                                    <div class="vd-service-icon"><i class="fa-solid fa-key"></i></div>
                                    <h4 class="vd-service-title">Rental & Leasing Management</h4>
                                    <p class="vd-service-desc">Tenant verification, registered lease agreements, rent collection assistance, and property care.</p>
                                </div>
                                <div class="vd-service-box">
                                    <div class="vd-service-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                                    <h4 class="vd-service-title">Legal & Document Verification</h4>
                                    <p class="vd-service-desc">Title deeds check, registry assistance, mutation, map approval, and transparent ownership transfer.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB PANE 4: REVIEWS -->
                    <div class="vd-tab-pane" id="pane-reviews">
                        <div class="vd-section-card">
                            <div class="vd-reviews-header">
                                <div>
                                    <h2 class="vd-card-title">Client Reviews & Ratings</h2>
                                    <p class="vd-reviews-sub">Overall Rating based on 128 verified customer experiences</p>
                                </div>
                                <div class="vd-score-badge">
                                    <span class="vd-score-huge">4.8</span>
                                    <div class="vd-stars-gold">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star-half-stroke"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="vd-reviews-list">
                                <div class="vd-single-review">
                                    <div class="vd-reviewer-head">
                                        <div class="vd-avatar-circle" style="background:#FEE2E2; color:#DC2626;">R</div>
                                        <div>
                                            <h4 class="vd-reviewer-name">Rohit Sharma</h4>
                                            <span class="vd-review-date">2 weeks ago</span>
                                        </div>
                                        <div class="vd-rev-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                                    </div>
                                    <p class="vd-rev-comment">Bahut hi professional aur bharosemand team hai! {{ $city }} mein hume behtareen property dilayi. Negotiation aur registry paper kaam sab smooth raha. Highly Recommended!</p>
                                </div>

                                <div class="vd-single-review">
                                    <div class="vd-reviewer-head">
                                        <div class="vd-avatar-circle" style="background:#EFF6FF; color:#004BEE;">A</div>
                                        <div>
                                            <h4 class="vd-reviewer-name">Anil Meena</h4>
                                            <span class="vd-review-date">1 month ago</span>
                                        </div>
                                        <div class="vd-rev-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                                    </div>
                                    <p class="vd-rev-comment">Commercial property deal finalize karwayi. Bilkul transparent pricing aur koi hidden charges nahi the. Bahut satisfied hu services se.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB PANE 5: ABOUT US -->
                    <div class="vd-tab-pane" id="pane-about">
                        <div class="vd-section-card">
                            <h2 class="vd-card-title">Detailed Profile of {{ $bizName }}</h2>
                            <p class="vd-about-desc">{{ $description }}</p>
                            
                            <div class="vd-about-specs-table">
                                <div class="vd-spec-row">
                                    <span class="vd-spec-k">Business Type</span>
                                    <span class="vd-spec-v">{{ $categoryName }}</span>
                                </div>
                                <div class="vd-spec-row">
                                    <span class="vd-spec-k">Operating City</span>
                                    <span class="vd-spec-v">{{ $city }}, {{ $district }}, {{ $state }}</span>
                                </div>
                                <div class="vd-spec-row">
                                    <span class="vd-spec-k">Pincode</span>
                                    <span class="vd-spec-v">{{ $pincode }}</span>
                                </div>
                                <div class="vd-spec-row">
                                    <span class="vd-spec-k">Verification Status</span>
                                    <span class="vd-spec-v" style="color: #16A34A; font-weight: 700;"><i class="fa-solid fa-circle-check"></i> Government ID & Business Verified</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB PANE 6: CONTACT -->
                    <div class="vd-tab-pane" id="pane-contact">
                        <div class="vd-section-card">
                            <h2 class="vd-card-title">Send Inquiry Directly to {{ $bizName }}</h2>
                            <form class="vd-direct-form" onsubmit="event.preventDefault(); alert('Aapki enquiry bhej di gayi hai! Agent jald hi aapse sampark karenge.');">
                                <div class="vd-form-row">
                                    <div class="vd-form-group">
                                        <label>Aapka Naam *</label>
                                        <input type="text" class="vd-input" placeholder="Enter your name" required>
                                    </div>
                                    <div class="vd-form-group">
                                        <label>Mobile Number *</label>
                                        <input type="tel" class="vd-input" placeholder="10-digit mobile number" required>
                                    </div>
                                </div>
                                <div class="vd-form-group">
                                    <label>Aapki Requirement (Buy / Sell / Rent)</label>
                                    <input type="text" class="vd-input" placeholder="e.g. Looking for 3 BHK flat in Vaishali Nagar">
                                </div>
                                <div class="vd-form-group">
                                    <label>Message (Optional)</label>
                                    <textarea class="vd-textarea" rows="4" placeholder="Apna message yahan likhe..."></textarea>
                                </div>
                                <button type="submit" class="btn-submit-enq">Send Inquiry Now</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

            <!-- RIGHT SIDEBAR COLUMN -->
            <aside class="vd-sidebar-content">

                <!-- 1. Contact Us Card -->
                <div class="vd-side-card">
                    <h3 class="vd-side-title">Contact Us</h3>

                    <!-- Call Now Blue Button -->
                    @if(!empty($cleanPhone))
                        <a href="tel:{{ $cleanPhone }}" class="vd-btn-side vd-btn-call" onclick="if(!/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)){ event.preventDefault(); alert('Phone: {{ $cleanPhone }}'); }">
                            <span class="vd-btn-left">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>Call Now</span>
                            </span>
                            <span class="vd-btn-right">{{ $displayPhone }}</span>
                        </a>
                    @else
                        <a href="tel:+919829012345" class="vd-btn-side vd-btn-call">
                            <span class="vd-btn-left">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>Call Now</span>
                            </span>
                            <span class="vd-btn-right">+91 98290 12345</span>
                        </a>
                    @endif

                    <!-- WhatsApp Green Button -->
                    @if(!empty($waNum))
                        <a href="https://wa.me/{{ $waNum }}?text={{ urlencode('Namaste! Mujhe ' . $bizName . ' ki services ke baare mein jankari chahiye.') }}" class="vd-btn-side vd-btn-wa" target="_blank">
                            <span class="vd-btn-left">
                                <i class="fa-brands fa-whatsapp" style="font-size: 19px;"></i>
                                <span>WhatsApp</span>
                            </span>
                            <span class="vd-btn-right">Chat on WhatsApp</span>
                        </a>
                    @else
                        <a href="https://wa.me/919829012345?text={{ urlencode('Namaste! Mujhe ' . $bizName . ' ki services ke baare mein jankari chahiye.') }}" class="vd-btn-side vd-btn-wa" target="_blank">
                            <span class="vd-btn-left">
                                <i class="fa-brands fa-whatsapp" style="font-size: 19px;"></i>
                                <span>WhatsApp</span>
                            </span>
                            <span class="vd-btn-right">Chat on WhatsApp</span>
                        </a>
                    @endif

                    <!-- Send Email White Outline Button -->
                    @if(!empty($email))
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $email }}" class="vd-btn-side vd-btn-email" target="_blank">
                            <span class="vd-btn-left">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span>Send Email</span>
                            </span>
                            <span class="vd-btn-right vd-truncate-email">{{ $email }}</span>
                        </a>
                    @endif

                    <!-- Verified & Trusted Agent Green Box -->
                    <div class="vd-side-trust-box">
                        <div class="vd-trust-icon-green">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <polyline points="9 12 11 14 15 10"></polyline>
                            </svg>
                        </div>
                        <div class="vd-trust-texts">
                            <h5 class="vd-trust-head">Verified & Trusted Agent</h5>
                            <p class="vd-trust-sub">Agent 24 India द्वारा Verified</p>
                        </div>
                    </div>
                </div>

                <!-- 2. Working Hours Card -->
                <div class="vd-side-card">
                    <div class="vd-hours-head">
                        <div class="vd-hours-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <h4 class="vd-side-subtitle">Working Hours</h4>
                    </div>
                    <div class="vd-hours-row">
                        <span class="vd-hours-days">Mon - Sun</span>
                        <span class="vd-hours-time">10:00 AM - 08:00 PM</span>
                    </div>
                </div>

                <!-- 3. Our Office & Map Card -->
                <div class="vd-side-card" id="officeMapCard">
                    <h3 class="vd-side-title">Our Office</h3>
                    <div class="vd-office-split">
                        <div class="vd-office-address-wrap">
                            <p class="vd-office-line1"><strong>G-12, Vaishali Nagar,</strong></p>
                            <p class="vd-office-line2">Opp. Amrapali Circle,</p>
                            <p class="vd-office-line3">{{ $city }}, {{ $state }} - {{ $pincode }}</p>
                            <a href="https://maps.google.com/?q={{ urlencode($address) }}" target="_blank" class="vd-office-map-link">View on Map</a>
                        </div>
                        <div class="vd-map-preview-wrap">
                            <!-- Stylized Interactive / Image Map Preview -->
                            <div class="vd-map-box">
                                <svg width="100%" height="100%" viewBox="0 0 160 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="vd-map-svg">
                                    <rect width="160" height="100" rx="8" fill="#E2E8F0"/>
                                    <!-- Map Roads / Grid Lines -->
                                    <path d="M-10 30H170" stroke="#CBD5E1" stroke-width="6"/>
                                    <path d="M-10 70H170" stroke="#CBD5E1" stroke-width="4"/>
                                    <path d="M50 -10V110" stroke="#CBD5E1" stroke-width="5"/>
                                    <path d="M110 -10V110" stroke="#CBD5E1" stroke-width="6"/>
                                    <path d="M0 0L160 100" stroke="#E2E8F0" stroke-width="4"/>
                                    <rect x="58" y="38" width="44" height="24" rx="4" fill="#F1F5F9" stroke="#94A3B8" stroke-dasharray="2 2"/>
                                    <!-- Red Location Pin Marker -->
                                    <circle cx="80" cy="50" r="14" fill="#EF4444" fill-opacity="0.2"/>
                                    <circle cx="80" cy="50" r="8" fill="#EF4444"/>
                                    <circle cx="80" cy="50" r="3" fill="#FFFFFF"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. What Our Clients Say (Review Testimonial Widget) -->
                <div class="vd-side-card">
                    <div class="vd-side-rev-header">
                        <h3 class="vd-side-title" style="margin-bottom:0;">What Our Clients Say</h3>
                        <a href="javascript:void(0)" onclick="switchTab('reviews')" class="vd-side-all-link">View All Reviews</a>
                    </div>

                    <div class="vd-client-review-box">
                        <div class="vd-cr-user-row">
                            <div class="vd-cr-avatar">R</div>
                            <div class="vd-cr-meta">
                                <h5 class="vd-cr-name">Rohit Sharma</h5>
                                <div class="vd-cr-rating">
                                    <div class="vd-stars-mini">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <span class="vd-cr-score">5.0</span>
                                </div>
                            </div>
                            <span class="vd-cr-time">2 weeks ago</span>
                        </div>

                        <p class="vd-cr-quote">
                            "Bahut hi professional aur bharosemand team hai! Behtareen Property dilayi. Highly Recommended!"
                        </p>

                        <!-- Carousel Indicators -->
                        <div class="vd-cr-dots">
                            <span class="vd-dot active"></span>
                            <span class="vd-dot"></span>
                            <span class="vd-dot"></span>
                            <span class="vd-dot"></span>
                        </div>
                    </div>
                </div>

            </aside>

        </div>

    </div>
</div>

<!-- Quick Inquiry Modal -->
<div class="vd-modal-overlay" id="enquiryModal" onclick="closeEnquiryModal(event)">
    <div class="vd-modal-card">
        <button type="button" class="vd-modal-close" onclick="closeEnquiryModal()">&times;</button>
        <div class="vd-modal-head">
            <h3 class="vd-modal-title">Enquire with {{ $bizName }}</h3>
            <p class="vd-modal-sub">Apni property requirement share kare, agent turant call karega.</p>
        </div>
        <form class="vd-modal-form" onsubmit="handleEnquirySubmit(event)">
            <div class="vd-form-group">
                <label>Aapka Naam *</label>
                <input type="text" class="vd-input" placeholder="Enter your full name" required>
            </div>
            <div class="vd-form-group">
                <label>Mobile Number *</label>
                <input type="tel" class="vd-input" placeholder="Enter 10-digit mobile number" required>
            </div>
            <div class="vd-form-group">
                <label>Requirement / Property Name</label>
                <input type="text" class="vd-input" id="modalReqField" placeholder="e.g. 3 BHK Buy / Rent in Vaishali Nagar">
            </div>
            <div class="vd-form-group">
                <label>Message (Optional)</label>
                <textarea class="vd-textarea" rows="3" placeholder="Requirement details..."></textarea>
            </div>
            <button type="submit" class="btn-submit-enq" style="width: 100%;">Submit Inquiry</button>
        </form>
    </div>
</div>

<script>
    // Tab switching logic
    function switchTab(tabKey) {
        document.querySelectorAll('.vd-tab-item').forEach(tab => {
            tab.classList.toggle('active', tab.getAttribute('data-tab') === tabKey);
        });
        document.querySelectorAll('.vd-tab-pane').forEach(pane => {
            pane.classList.toggle('active', pane.id === 'pane-' + tabKey);
        });
        const tabsNav = document.getElementById('vendorTabs');
        if (tabsNav) {
            tabsNav.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    document.querySelectorAll('.vd-tab-item').forEach(item => {
        item.addEventListener('click', function() {
            const tabKey = this.getAttribute('data-tab');
            switchTab(tabKey);
        });
    });

    // Inquiry modal logic
    function openEnquiryModal(propTitle = '') {
        const modal = document.getElementById('enquiryModal');
        if (modal) {
            modal.style.display = 'flex';
            if (propTitle) {
                const reqField = document.getElementById('modalReqField');
                if (reqField) reqField.value = propTitle;
            }
        }
    }

    function closeEnquiryModal(e) {
        if (!e || e.target === document.getElementById('enquiryModal') || e.target.classList.contains('vd-modal-close')) {
            const modal = document.getElementById('enquiryModal');
            if (modal) modal.style.display = 'none';
        }
    }

    function handleEnquirySubmit(e) {
        e.preventDefault();
        alert('Aapki enquiry safaltapoorvak bhej di gayi hai! Agent 24 India dwara jald aapse sampark kiya jayega.');
        closeEnquiryModal();
    }
</script>
@endsection
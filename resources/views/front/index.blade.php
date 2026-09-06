@extends('front.layout.main')
@section('title', $pageTitle ?? 'Sahi Agent, Sahi Connection')

@push('styles')
<style>
    .form-field.has-error .input-with-icon,
    .form-field.has-error .select2-container--default .select2-selection--single {
        border-color: #EF4444 !important;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.18) !important;
    }
    .search-field-error {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #EF4444;
        font-size: 11.5px;
        font-weight: 600;
        margin-top: 5px;
        line-height: 1.2;
    }
    @media (max-width: 768px) {
        .index-hero-banner-section {
            padding: 8px 12px 0 12px !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
        .index-hero-banner-container {
            padding: 0 !important;
            width: 100% !important;
            border-radius: 12px !important;
            overflow: hidden !important;
        }
        .index-hero-banner-img {
            width: 100% !important;
            max-width: 100% !important;
            min-height: 130px !important;
            max-height: 220px !important;
            height: auto !important;
            object-fit: cover !important;
            object-position: center !important;
            margin: 0 auto !important;
            border-radius: 12px !important;
            display: block !important;
        }
    }
</style>
@endpush

@section('content')

    <!-- Main Hero Banner Section Start -->
    <section class="index-hero-banner-section">
        <!-- Desktop Hero Banner -->
        <div class="index-hero-banner-container d-none-mobile">
            <img src="{{ asset('front/assets/images/index_hero_banner.png') }}" alt="Agent Sahi Yahi Milega! - Agent 24 India" class="index-hero-banner-img">
        </div>

        <!-- Mobile Hero Vector & Headline (Visible on Mobile < 768px) -->
        <div class="mobile-hero-wrapper d-block-mobile">
            <!-- Trust Capsule Badge -->
            <div class="mobile-hero-badge">
                <span>India's Most Trusted Platform</span>
            </div>

            <!-- Main Hindi Headline -->
            <h1 class="mobile-hero-title">
                काम कोई भी हो...<br>
                <span class="highlight-blue">सही AGENT</span><br>
                यहीं मिलेगा!
            </h1>

            <!-- Subtitle -->
            <p class="mobile-hero-subtitle">
                अपने शहर / जिले में अपनी जरूरत के अनुसार <strong>Agent</strong> खोजें और सीधे संपर्क करें
            </p>

            <!-- Phone Map Illustration Vector -->
            <div class="mobile-hero-illustration">
                <div class="skyline-silhouette"></div>
                <div class="phone-map-mockup">
                    <div class="phone-screen-inner">
                        <div class="map-grid-lines"></div>
                        <div class="map-route-line"></div>
                        <div class="map-location-pin">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="#FFFFFF">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <span class="map-dot dot-green"></span>
                        <span class="map-dot dot-orange"></span>
                        <span class="map-dot dot-purple"></span>
                    </div>
                </div>
            </div>

            <!-- Trust Features Strip -->
            <div class="mobile-trust-strip">
                <span class="trust-pill-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="#004BEE">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Verified Agents
                </span>
                <span class="trust-pill-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="#004BEE">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Secure & Safe
                </span>
                <span class="trust-pill-item">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="#16A34A">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    100% Trusted
                </span>
            </div>
        </div>
    </section>
    <!-- Main Hero Banner Section End -->

    <!-- Search & Features Section Start -->
    <section class="index-search-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 16px;">
            <!-- Overlapping White / Blue Search Card -->
            <div class="search-card-container">
                <div class="search-card-header">
                    <svg class="search-title-icon" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span class="d-none-mobile">What kind of Agent are you looking for?</span>
                    <span class="d-block-mobile">अपनी जरूरत का Agent खोजें</span>
                </div>

                <form class="search-card-form" id="agentSearchForm" novalidate>
                    <div class="form-grid">

                        <!-- Input 1: Category Selection (या क्या खोज रहे हैं) -->
                        <div class="form-field" id="categoryField">
                            <label class="field-label">
                                <span class="d-none-mobile">Select Category <span style="color: #EF4444;">*</span></span>
                                <span class="d-block-mobile">आप क्या खोज रहे हैं?</span>
                            </label>
                            <div class="input-with-icon">
                                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <select class="select2 custom-select" id="categorySelect" name="category">
                                    <option value="" selected>जैसे: Real Estate Agent</option>
                                    @if(isset($category) && count($category) > 0)
                                        @foreach($category->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <span class="search-field-error" id="categoryError" style="display: none;">Please select a category</span>
                        </div>

                        <!-- Input 2: Select District / City -->
                        <div class="form-field" id="districtField">
                            <label class="field-label">
                                <span class="d-none-mobile">Select District <span style="color: #EF4444;">*</span></span>
                                <span class="d-block-mobile">शहर / जिला चुनें</span>
                            </label>
                            <div class="input-with-icon">
                                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <select class="select2 custom-select" id="districtSelect" name="district">
                                    <option value="" selected>अपना शहर चुनें</option>
                                    @if(isset($district) && count($district) > 0)
                                        @foreach($district->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="150">Jaipur</option>
                                        <option value="155">Jodhpur</option>
                                    @endif
                                </select>
                            </div>
                            <span class="search-field-error" id="districtError" style="display: none;">Please select a district</span>
                        </div>

                        <!-- Input 3: Select City / Sub-category -->
                        <div class="form-field" id="cityField">
                            <label class="field-label">
                                <span class="d-none-mobile">Select City <span style="color: #EF4444;">*</span></span>
                                <span class="d-block-mobile">कैटेगरी चुनें</span>
                            </label>
                            <div class="input-with-icon">
                                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                                <select class="select2 custom-select" id="citySelect" name="city">
                                    <option value="" selected>सभी कैटेगरी</option>
                                    @if(isset($initialCities) && count($initialCities) > 0)
                                        @foreach($initialCities->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <span class="search-field-error" id="cityError" style="display: none;">Please select a city</span>
                        </div>

                        <!-- Search Button -->
                        <div class="form-field btn-field">
                            <button type="submit" class="btn-search-agent" id="searchAgentBtn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <span class="d-none-mobile">Find Agents</span>
                                <span class="d-block-mobile">Agent खोजें</span>
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- Bottom Stats Metrics Bar (Screenshot 2 Match) -->
            <div class="hero-stats-bar">
                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">10,000+</span>
                        <span class="stat-label">Verified Agents</span>
                    </div>
                </div>

                <div class="stat-divider"></div>

                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Cities Covered</span>
                    </div>
                </div>

                <div class="stat-divider"></div>

                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Categories</span>
                    </div>
                </div>

                <div class="stat-divider"></div>

                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">1L+</span>
                        <span class="stat-label">Happy Customers</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Search & Features Section End -->

    <!-- Popular Categories Section Start (Screenshot 2 Match) -->
    <section class="categories-section">
        <div class="section-container">

            <!-- Section Header -->
            <div class="section-header categories-header-flex">
                <h2 class="section-title">
                    <span class="d-none-mobile">Popular Categories</span>
                    <span class="d-block-mobile">लोकप्रिय कैटेगरी</span>
                </h2>
                <a href="{{ route('front.vendorlist') }}" class="view-all-header-link">
                    <span>सभी देखें →</span>
                </a>
            </div>

            <!-- Categories Grid (4 Columns on Mobile) -->
            <div class="categories-grid" id="homepageCategoriesGrid">
                @php
                    $categoryStyles = [
                        ['icon' => 'icon-orange', 'color' => '#F97316', 'sub' => 'Buy / Sell / Rent', 'svg' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>'],
                        ['icon' => 'icon-blue', 'color' => '#2563EB', 'sub' => 'Car, Bike & More', 'svg' => '<path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle>'],
                        ['icon' => 'icon-green', 'color' => '#16A34A', 'sub' => 'RTO Related Services', 'svg' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>'],
                        ['icon' => 'icon-purple', 'color' => '#9333EA', 'sub' => 'Life, Health, General', 'svg' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path>'],
                        ['icon' => 'icon-rupee', 'color' => '#EA580C', 'sub' => 'Loan & Finance', 'svg' => '<circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M8 9h8M8 15h6"></path>'],
                        ['icon' => 'icon-scale', 'color' => '#059669', 'sub' => 'All Legal Services', 'svg' => '<path d="M12 3v18M3 7l9-4 9 4M5 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7M15 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7"></path>'],
                        ['icon' => 'icon-red', 'color' => '#DC2626', 'sub' => 'Transport & Logistics', 'svg' => '<rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle>'],
                        ['icon' => 'icon-teal', 'color' => '#0D9488', 'sub' => 'Tours & Travels', 'svg' => '<circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>'],
                    ];
                @endphp

                @if(isset($category) && count($category) > 0)
                    @foreach($category as $index => $cat)
                        @php
                            $style = $categoryStyles[$index % count($categoryStyles)];
                            $isExtra = $index >= 7;
                        @endphp
                        <a href="{{ route('front.vendorlist.category', $cat->id) }}"
                           class="category-card {{ $isExtra ? 'category-card-extra' : '' }}"
                           style="{{ $isExtra ? 'display: none;' : '' }}"
                           title="{{ $cat->name }}">
                            <div class="category-icon-box {{ $style['icon'] }}">
                                @if(!empty($cat->image) && file_exists(public_path('upload/category/'.$cat->image)))
                                    <img src="{{ asset('upload/category/'.$cat->image) }}" alt="{{ $cat->name }}" style="width: 32px; height: 32px; object-fit: contain;">
                                @else
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="{{ $style['color'] }}" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        {!! $style['svg'] !!}
                                    </svg>
                                @endif
                            </div>
                            <h3 class="category-title">{{ $cat->name }}</h3>
                            <p class="category-subtitle d-none-mobile">{{ $cat->description ? \Illuminate\Support\Str::limit($cat->description, 22) : $style['sub'] }}</p>
                        </a>
                    @endforeach

                    <!-- Card 8: More Categories Trigger -->
                    <a href="{{ route('front.vendorlist') }}" class="category-card card-more" id="cardMoreCategories" title="Click to view all categories">
                        <div class="category-icon-box icon-dots">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9"></circle>
                                <circle cx="8" cy="12" r="1.5" fill="#2563EB"></circle>
                                <circle cx="12" cy="12" r="1.5" fill="#2563EB"></circle>
                                <circle cx="16" cy="12" r="1.5" fill="#2563EB"></circle>
                            </svg>
                        </div>
                        <h3 class="category-title">
                            <span class="d-none-mobile">More</span>
                            <span class="d-block-mobile">और भी बहुत कुछ</span>
                        </h3>
                        <p class="category-subtitle highlight-subtitle d-none-mobile">All Categories</p>
                    </a>
                @endif
            </div>

            @if(isset($category) && count($category) > 7)
                <!-- View All Categories Button -->
                <div class="view-all-wrapper d-none-mobile">
                    <a href="javascript:void(0)" class="btn-view-all" id="btnToggleAllCategories">
                        <span id="btnViewAllText">View All Categories</span>
                        <svg id="btnViewAllIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                </div>
            @endif

        </div>
    </section>
    <!-- Popular Categories Section End -->

    <!-- Why Choose Agent 24 India Banner Section Start (Screenshot 2 & 3 Match) -->
    <section class="why-choose-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 16px;">
            
            <div class="custom-why-choose-banner">
                <!-- Top Header: Left aligned with 3-Layer Icon -->
                <div class="custom-why-header">
                    <h2 class="custom-why-title">
                        <svg class="why-title-badge-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        <span class="d-none-mobile">Why Choose Agent 24 India?</span>
                        <span class="d-block-mobile">Agent 24 India क्यों चुनें?</span>
                    </h2>
                </div>

                <!-- Main Content Row -->
                <div class="custom-why-main-row">
                    
                    <!-- 5 Feature Columns Group -->
                    <div class="custom-why-features-grid">
                        
                        <!-- Feature 1 -->
                        <div class="custom-why-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" fill="#3B82F6"/>
                                    <path d="M9 12l2 2 4-4" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">100% Verified & Trusted Agents</h3>
                                <p class="custom-why-sub">
                                    <span class="d-none-mobile">Listing only after thorough verification</span>
                                    <span class="d-block-mobile">हर Agent की जांच के बाद ही Listing</span>
                                </p>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="custom-why-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">Direct Contact With Agent</h3>
                                <p class="custom-why-sub">
                                    <span class="d-none-mobile">No middleman or third-party commission</span>
                                    <span class="d-block-mobile">बीच में कोई Third Party नहीं</span>
                                </p>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="custom-why-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">Sahi Jankari, Sahi Faisla</h3>
                                <p class="custom-why-sub">
                                    <span class="d-none-mobile">Choose certified agents with transparent info</span>
                                    <span class="d-block-mobile">पूरी जानकारी के साथ सही Agent चुनें</span>
                                </p>
                            </div>
                        </div>

                        <!-- Feature 4 -->
                        <div class="custom-why-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="9.5"></circle>
                                    <path d="M8.5 7.5h7M8.5 10.5h4.5a2 2 0 0 1 0 4H8.5m0-4v6m0-6h2.5a2 2 0 0 1 2 2v0a2 2 0 0 1-2 2H8.5l4 4"></path>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">Save Time & Money</h3>
                                <p class="custom-why-sub">
                                    <span class="d-none-mobile">Fast completion and cost-effective services</span>
                                    <span class="d-block-mobile">सही Agent से समय और पैसे की बचत</span>
                                </p>
                            </div>
                        </div>

                        <!-- Feature 5 -->
                        <div class="custom-why-col last-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">24×7 Support Team</h3>
                                <p class="custom-why-sub">
                                    <span class="d-none-mobile">Dedicated support team always ready to help</span>
                                    <span class="d-block-mobile">हमेशा आपकी मदद के लिए तैयार</span>
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Right Side Customer Photo (Desktop Only) -->
                    <div class="custom-why-photo-wrap d-none-mobile">
                        <div class="custom-why-speech-bubble">
                            <span class="custom-bubble-title">Happy Customers,<br>Our Priority!</span>
                            <div class="custom-bubble-stars">★★★★★</div>
                        </div>
                        <div class="custom-woman-photo-frame">
                            <img src="{{ asset('front/assets/images/woman_pointing.jpg') }}" alt="Happy Customer - Agent 24 India" class="custom-woman-img">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- Why Choose Agent 24 India Banner Section End -->

    <!-- How it Works (Agent Kaise Khoje?) Section Start (Screenshot 3 Match) -->
    <section class="how-it-works-section">
        <div class="section-container">

            <!-- Section Header -->
            <div class="section-header">
                <span class="header-line"></span>
                <h2 class="section-title">
                    <span class="d-none-mobile">Agent Kaise Khoje?</span>
                    <span class="d-block-mobile">Agent कैसे खोजें?</span>
                </h2>
                <span class="header-line"></span>
            </div>

            <!-- Steps Flow Container (Numbered Circle Steps) -->
            <div class="steps-flow-wrapper">

                <!-- Step 1 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <span class="step-number-badge badge-blue">1</span>
                        <div class="step-icon-circle circle-blue">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="7.5"></circle>
                                <line x1="21" y1="21" x2="16.5" y2="16.5"></line>
                            </svg>
                        </div>
                    </div>
                    <h3 class="step-title">
                        <span class="d-none-mobile">Apni Zaroorat Bataye</span>
                        <span class="d-block-mobile">अपनी<br>जरूरत बताएं</span>
                    </h3>
                    <p class="step-desc d-none-mobile">Shahar, Category aur Service chune</p>
                </div>

                <!-- Connecting Arrow 1 -->
                <div class="step-arrow">
                    <svg width="14" height="10" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="13 6 19 12 13 18"></polyline>
                    </svg>
                </div>

                <!-- Step 2 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <span class="step-number-badge badge-orange">2</span>
                        <div class="step-icon-circle circle-orange">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#EA580C"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="4" y="3" width="16" height="18" rx="2"></rect>
                                <line x1="8" y1="8" x2="16" y2="8"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                                <line x1="8" y1="16" x2="13" y2="16"></line>
                            </svg>
                        </div>
                    </div>
                    <h3 class="step-title">
                        <span class="d-none-mobile">Best Agents Dekhe</span>
                        <span class="d-block-mobile">Best<br>Agents देखें</span>
                    </h3>
                    <p class="step-desc d-none-mobile">Top Verified Agents ki list dekhe aur compare kare</p>
                </div>

                <!-- Connecting Arrow 2 -->
                <div class="step-arrow">
                    <svg width="14" height="10" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="13 6 19 12 13 18"></polyline>
                    </svg>
                </div>

                <!-- Step 3 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <span class="step-number-badge badge-green">3</span>
                        <div class="step-icon-circle circle-green">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="step-title">
                        <span class="d-none-mobile">Seedha Sampark Kare</span>
                        <span class="d-block-mobile">सीधा संपर्क<br>करें</span>
                    </h3>
                    <p class="step-desc d-none-mobile">Agent se call ya message karke baat kare</p>
                </div>

                <!-- Connecting Arrow 3 -->
                <div class="step-arrow">
                    <svg width="14" height="10" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="13 6 19 12 13 18"></polyline>
                    </svg>
                </div>

                <!-- Step 4 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <span class="step-number-badge badge-purple">4</span>
                        <div class="step-icon-circle circle-purple">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333EA"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="step-title">
                        <span class="d-none-mobile">Kaam Shuru Kare</span>
                        <span class="d-block-mobile">काम शुरू<br>करें</span>
                    </h3>
                    <p class="step-desc d-none-mobile">Vishwas ke saath apna kaam pura kare</p>
                </div>

            </div>

        </div>
    </section>
    <!-- How it Works Section End -->

    <!-- Top Verified Agents Section Start (Screenshot 3 Match) -->
    <section class="verified-agents-section" id="verifiedAgents">
        <div class="section-container">
            <div class="verified-agents-card">

                <!-- Section Header -->
                <div class="verified-agents-header">
                    <h2 class="verified-title">Top Verified Agents</h2>
                    <a href="{{ route('front.vendorlist') }}" class="view-all-link">
                        <span class="d-none-mobile">View All</span>
                        <span class="d-block-mobile">सभी देखें →</span>
                        <svg class="d-none-mobile" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>

                <!-- Carousel Slider Wrapper -->
                <div class="carousel-relative-wrapper">
                    <!-- Left Arrow Control -->
                    <button class="slider-btn prev-btn" id="agentPrevBtn" aria-label="Previous Agents">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>

                    <!-- Cards Container (Scrollable track) -->
                    <div class="agents-slider-track" id="agentsSliderTrack">

                        @php
                            $defaultAgentAvatars = [
                                'agent_sharma.jpg',
                                'agent_krishna.jpg',
                                'agent_rto.jpg',
                                'agent_insurance.jpg',
                                'agent_legal.jpg',
                                'agent_travel.jpg'
                            ];
                        @endphp

                        @if(isset($vendoruser) && count($vendoruser) > 0)
                            @foreach($vendoruser as $key => $vendor)
                                @php
                                    $avatar = !empty($vendor->profile_image) && file_exists(public_path('upload/profile/'.$vendor->profile_image)) 
                                        ? asset('upload/profile/'.$vendor->profile_image) 
                                        : asset('front/assets/images/' . $defaultAgentAvatars[$key % count($defaultAgentAvatars)]);
                                @endphp
                                <div class="agent-card">
                                    <div class="verified-badge">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span>VERIFIED</span>
                                    </div>
                                    <div class="agent-card-top-content">
                                        <div class="agent-avatar-wrapper">
                                            <img src="{{ $avatar }}" alt="{{ $vendor->name }}" class="agent-avatar-img">
                                        </div>
                                        <div class="agent-info-wrapper">
                                            <h3 class="agent-name">{{ \Illuminate\Support\Str::limit($vendor->name, 18) }}</h3>
                                            <p class="agent-category">{{ $vendor->business_category_name ?? 'Real Estate Agent' }}</p>
                                            <p class="agent-location">{{ $vendor->district->name ?? 'Jaipur' }}, Rajasthan</p>
                                            <div class="agent-rating-row">
                                                <div class="rating-stars">★★★★★</div>
                                                <span class="rating-score">4.8 <span class="rating-count">({{ rand(80, 200) }})</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="agent-card-actions">
                                        <a href="{{ route('front.vendor.details', $vendor->id) }}" class="btn-agent-outlined">View Profile</a>
                                        <a href="tel:{{ $vendor->mobile ?? '+919876543210' }}" class="btn-agent-filled">Call Now</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback Mockup Agent Cards -->
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-card-top-content">
                                    <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_sharma.jpg') }}" alt="Sharma Property Consultant" class="agent-avatar-img"></div>
                                    <div class="agent-info-wrapper">
                                        <h3 class="agent-name">Sharma Proper...</h3>
                                        <p class="agent-category">Real Estate Agent</p>
                                        <p class="agent-location">Jaipur, Rajasthan</p>
                                        <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.8 <span class="rating-count">(120)</span></span></div>
                                    </div>
                                </div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543210" class="btn-agent-filled">Call Now</a></div>
                            </div>
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-card-top-content">
                                    <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_krishna.jpg') }}" alt="Krishna Motors" class="agent-avatar-img"></div>
                                    <div class="agent-info-wrapper">
                                        <h3 class="agent-name">Krishna Motors</h3>
                                        <p class="agent-category">Automobile Agent</p>
                                        <p class="agent-location">Jodhpur, Rajasthan</p>
                                        <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.7 <span class="rating-count">(98)</span></span></div>
                                    </div>
                                </div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543211" class="btn-agent-filled">Call Now</a></div>
                            </div>
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-card-top-content">
                                    <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_rto.jpg') }}" alt="RTO Solution Point" class="agent-avatar-img"></div>
                                    <div class="agent-info-wrapper">
                                        <h3 class="agent-name">RTO Solution Point</h3>
                                        <p class="agent-category">RTO Agent</p>
                                        <p class="agent-location">Ajmer, Rajasthan</p>
                                        <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.9 <span class="rating-count">(155)</span></span></div>
                                    </div>
                                </div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543212" class="btn-agent-filled">Call Now</a></div>
                            </div>
                        @endif

                    </div>

                    <!-- Right Arrow Control -->
                    <button class="slider-btn next-btn" id="agentNextBtn" aria-label="Next Agents">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </section>
    <!-- Top Verified Agents Section End -->

    <!-- Rajasthan Districts Section Start (Screenshot 3 & 4 Match) -->
    <section class="districts-section" id="rajasthanDistricts">
        <div class="section-container">

            <!-- Styled Decorative Header -->
            <div class="district-header categories-header-flex">
                <h2 class="district-section-title">
                    <span class="d-none-mobile">Important Cities</span>
                    <span class="d-block-mobile">Rajasthan के Capital District</span>
                </h2>
                <a href="{{ route('front.vendorlist') }}" class="view-all-header-link">
                    <span class="d-block-mobile">सभी जिले देखें →</span>
                </a>
            </div>

            <!-- District Grid (2 Columns on Mobile matching Screenshots 3 & 4) -->
            <div class="districts-mobile-grid">
                @php
                    $allDistricts = (isset($districthome) && count($districthome) > 0) ? $districthome : (isset($district) ? $district : []);
                    $distPhotos = [
                        'Jaipur' => asset('front/assets/images/jal-mahal-jaipur-9175.jpg'),
                        'Jodhpur' => asset('front/assets/images/jodhpur.jpg'),
                        'Udaipur' => asset('front/assets/images/jal-mahal-jaipur-9175.jpg'),
                        'Kota' => asset('front/assets/images/jodhpur.jpg'),
                        'Bikaner' => asset('front/assets/images/jal-mahal-jaipur-9175.jpg'),
                        'Ajmer' => asset('front/assets/images/jodhpur.jpg')
                    ];
                    $distCounts = [
                        'Jaipur' => '12,500+ Agents',
                        'Jodhpur' => '8,200+ Agents',
                        'Udaipur' => '6,800+ Agents',
                        'Kota' => '5,100+ Agents',
                        'Bikaner' => '4,300+ Agents',
                        'Ajmer' => '3,900+ Agents'
                    ];
                    $mockDistricts = [
                        ['name' => 'Jaipur', 'count' => '12,500+ Agents', 'img' => asset('front/assets/images/jal-mahal-jaipur-9175.jpg')],
                        ['name' => 'Jodhpur', 'count' => '8,200+ Agents', 'img' => asset('front/assets/images/jodhpur.jpg')],
                        ['name' => 'Udaipur', 'count' => '6,800+ Agents', 'img' => asset('front/assets/images/jal-mahal-jaipur-9175.jpg')],
                        ['name' => 'Kota', 'count' => '5,100+ Agents', 'img' => asset('front/assets/images/jodhpur.jpg')],
                        ['name' => 'Bikaner', 'count' => '4,300+ Agents', 'img' => asset('front/assets/images/jal-mahal-jaipur-9175.jpg')],
                        ['name' => 'Ajmer', 'count' => '3,900+ Agents', 'img' => asset('front/assets/images/jodhpur.jpg')]
                    ];
                @endphp

                @if(count($allDistricts) > 0)
                    @foreach($allDistricts->take(6) as $dist)
                        @php
                            $imgSrc = $distPhotos[$dist->name] ?? asset('front/assets/images/jal-mahal-jaipur-9175.jpg');
                            $cnt = $distCounts[$dist->name] ?? rand(3, 10).','.rand(100, 900).'+ Agents';
                        @endphp
                        <a href="{{ route('front.vendorlist.location', $dist->id) }}" class="district-photo-card" title="{{ $dist->name }}">
                            <div class="district-photo-box">
                                <img src="{{ $imgSrc }}" alt="{{ $dist->name }}" class="district-cover-img">
                            </div>
                            <div class="district-meta-box">
                                <h4 class="district-card-name">{{ $dist->name }}</h4>
                                <span class="district-card-count">{{ $cnt }}</span>
                            </div>
                        </a>
                    @endforeach
                @else
                    @foreach($mockDistricts as $md)
                        <a href="{{ route('front.vendorlist') }}" class="district-photo-card" title="{{ $md['name'] }}">
                            <div class="district-photo-box">
                                <img src="{{ $md['img'] }}" alt="{{ $md['name'] }}" class="district-cover-img">
                            </div>
                            <div class="district-meta-box">
                                <h4 class="district-card-name">{{ $md['name'] }}</h4>
                                <span class="district-card-count">{{ $md['count'] }}</span>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>

            <!-- View All Districts Button -->
            <div class="view-all-districts-wrapper" style="margin-top: 18px; text-align: center;">
                <a href="{{ route('front.vendorlist') }}" class="btn-all-districts-pill">
                    <span>सभी जिले देखें →</span>
                </a>
            </div>

        </div>
    </section>
    <!-- Rajasthan Districts Section End -->

    <!-- Agent Registration Banner Section Start (Screenshot 4 Match) -->
    <section class="agent-cta-section" id="agentRegisterCta">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 16px;">
            <div class="agent-cta-card">

                <!-- Heading & Subtitle -->
                <div class="cta-mobile-header">
                    <h3 class="cta-main-title">क्या आप भी Agent हैं?</h3>
                    <p class="cta-subtitle">अपनी Profile बनाएं, अपनी Services Promote करें और नए Customers तक पहुँचें।</p>
                </div>

                <!-- Checkmark Feature List -->
                <div class="cta-features-col">
                    <ul class="cta-feature-list">
                        <li class="cta-feature-item">
                            <span class="check-circle-green">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#16A34A">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </span>
                            <span>Free Listing Option</span>
                        </li>

                        <li class="cta-feature-item">
                            <span class="check-circle-green">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#16A34A">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </span>
                            <span>Affordable Paid Plans</span>
                        </li>

                        <li class="cta-feature-item">
                            <span class="check-circle-green">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#16A34A">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </span>
                            <span>All India Visibility</span>
                        </li>

                        <li class="cta-feature-item">
                            <span class="check-circle-green">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#16A34A">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </span>
                            <span>Business Growth</span>
                        </li>
                    </ul>
                </div>

                <!-- White Pill CTA Button -->
                <div class="cta-btn-wrapper" style="margin-top: 16px;">
                    @if(\Auth::check())
                        <a href="{{ route('front.addListing') }}" class="btn-register-white-pill">
                            <span>Register As Agent →</span>
                        </a>
                    @else
                        <a href="{{ route('front.register') }}" class="btn-register-white-pill">
                            <span>Register As Agent →</span>
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!-- Agent Registration Banner Section End -->

    <!-- Welcome Back Promo Banner (Screenshot 5 Match) -->
    <section class="welcome-promo-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 16px;">
            <div class="welcome-promo-card">
                <div class="welcome-promo-text">
                    <span class="welcome-tag">Welcome Back!</span>
                    <h4 class="welcome-promo-head">Login to your Agent 24 India account</h4>
                    <p class="welcome-promo-sub">Access your dashboard, manage your listings and grow your business.</p>
                </div>
                <div class="welcome-promo-action">
                    @if(\Auth::check())
                        <a href="{{ route('front.profile') }}" class="btn-promo-login">My Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-promo-login">Login Now</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Why We Are Best Section Start (Screenshot 5 Match) -->
    <section class="why-best-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 16px;">
            
            <h2 class="why-best-title">हम क्यों हैं सबसे बेहतर?</h2>

            <div class="why-best-card">
                <!-- Item 1 -->
                <div class="why-best-item">
                    <div class="why-best-icon icon-bg-blue">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#004BEE">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div class="why-best-text">
                        <h4 class="why-best-head">Trusted Platform</h4>
                        <p class="why-best-desc">भारत का भरोसेमंद Agent Directory</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="why-best-item">
                    <div class="why-best-icon icon-bg-blue">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#004BEE">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                        </svg>
                    </div>
                    <div class="why-best-text">
                        <h4 class="why-best-head">Safe & Secure</h4>
                        <p class="why-best-desc">आपकी जानकारी 100% सुरक्षित</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="why-best-item">
                    <div class="why-best-icon icon-bg-blue">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#004BEE">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <div class="why-best-text">
                        <h4 class="why-best-head">All India Network</h4>
                        <p class="why-best-desc">हर शहर, हर जिला, आपके साथ</p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="why-best-item">
                    <div class="why-best-icon icon-bg-blue">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#004BEE">
                            <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/>
                        </svg>
                    </div>
                    <div class="why-best-text">
                        <h4 class="why-best-head">Affordable Plans</h4>
                        <p class="why-best-desc">हर Agent के लिए Best Plans</p>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="why-best-item">
                    <div class="why-best-icon icon-bg-gold">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#FFB000">
                            <path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V18H8v2h8v-2h-3v-2.1c2.14-.46 3.78-2.14 4.39-4.34C19.08 11.37 21 9.29 21 6.74V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z"/>
                        </svg>
                    </div>
                    <div class="why-best-text">
                        <h4 class="why-best-head">Grow Your Business</h4>
                        <p class="why-best-desc">ज्यादा Visibility, ज्यादा Customers</p>
                    </div>
                </div>
            </div>

            <!-- Stats Bar 2 (Light Blue Container matching Screenshot 5) -->
            <div class="light-stats-strip" style="margin-top: 20px;">
                <div class="lstat-item">
                    <div class="lstat-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg></div>
                    <span class="lstat-num">10,000+</span>
                    <span class="lstat-lbl">Verified Agents</span>
                </div>
                <div class="lstat-item">
                    <div class="lstat-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                    <span class="lstat-num">500+</span>
                    <span class="lstat-lbl">Cities Covered</span>
                </div>
                <div class="lstat-item">
                    <div class="lstat-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></div>
                    <span class="lstat-num">50+</span>
                    <span class="lstat-lbl">Categories</span>
                </div>
                <div class="lstat-item">
                    <div class="lstat-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path></svg></div>
                    <span class="lstat-num">24×7</span>
                    <span class="lstat-lbl">Support</span>
                </div>
            </div>

            <!-- About Us Section (Screenshot 5 Match) -->
            <div class="homepage-about-box" style="margin-top: 24px;">
                <h3 class="about-box-title">हमारे बारे में</h3>
                <p class="about-box-text">
                    Agent 24 India एक ऐसा Platform है जो Agents और Businesses को एक साथ जोड़ता है। हमारा मिशन है - सही Agent को सही Customers तक पहुँचाना और Business Growth को आसान बनाना।
                </p>
                <div class="about-box-action">
                    <a href="{{ route('front.aboutus') }}" class="btn-about-pill">और पढ़ें →</a>
                </div>
            </div>

        </div>
    </section>
    <!-- Why We Are Best Section End -->

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        if ($.fn.select2) {
            $('#categorySelect').select2({
                placeholder: "Select Category",
                allowClear: true,
                width: '100%'
            });

            $('#districtSelect').select2({
                placeholder: "Select District",
                allowClear: true,
                width: '100%'
            });

            $('#citySelect').select2({
                placeholder: "Select City",
                allowClear: true,
                width: '100%'
            });
        }

        // Live validation clearing
        $('#categorySelect').on('change', function () {
            if ($(this).val()) {
                $('#categoryField').removeClass('has-error');
                $('#categoryError').hide();
            }
        });

        // Fetch Cities when District Changes
        $('#districtSelect').on('change', function () {
            var districtId = $(this).val();
            if (districtId) {
                $('#districtField').removeClass('has-error');
                $('#districtError').hide();
            }

            var $citySelect = $('#citySelect');
            $citySelect.empty().append('<option value="">Select City</option>');
            $('#cityField').removeClass('has-error');
            $('#cityError').hide();

            if (districtId) {
                var url = "{{ route('get.cities', ':id') }}".replace(':id', districtId);
                $.get(url, function (cities) {
                    if (Array.isArray(cities) && cities.length > 0) {
                        cities.forEach(function (ct) {
                            $citySelect.append(`<option value="${ct.id}">${ct.name}</option>`);
                        });
                    }
                    $citySelect.trigger('change.select2');
                });
            } else {
                $citySelect.trigger('change.select2');
            }
        });

        $('#citySelect').on('change', function () {
            if ($(this).val()) {
                $('#cityField').removeClass('has-error');
                $('#cityError').hide();
            }
        });

        // Search Form Submission Redirection with strict validation on all 3 fields
        $('#agentSearchForm').on('submit', function (e) {
            e.preventDefault();

            var category = $('#categorySelect').val();
            var district = $('#districtSelect').val();
            var city = $('#citySelect').val();

            var isValid = true;
            var firstInvalidField = null;

            if (!category) {
                $('#categoryField').addClass('has-error');
                $('#categoryError').show();
                isValid = false;
                if (!firstInvalidField) firstInvalidField = '#categorySelect';
            } else {
                $('#categoryField').removeClass('has-error');
                $('#categoryError').hide();
            }

            if (!district) {
                $('#districtField').addClass('has-error');
                $('#districtError').show();
                isValid = false;
                if (!firstInvalidField) firstInvalidField = '#districtSelect';
            } else {
                $('#districtField').removeClass('has-error');
                $('#districtError').hide();
            }

            if (!city) {
                $('#cityField').addClass('has-error');
                $('#cityError').show();
                isValid = false;
                if (!firstInvalidField) firstInvalidField = '#citySelect';
            } else {
                $('#cityField').removeClass('has-error');
                $('#cityError').hide();
            }

            // Bina teeno search box fill kiye submit nhi kar paaye
            if (!isValid) {
                if (firstInvalidField && $.fn.select2) {
                    $(firstInvalidField).select2('open');
                }
                return false;
            }

            var searchBtn = $('#searchAgentBtn');
            var originalBtnHtml = searchBtn.html();

            searchBtn.html(`
                <svg class="spin-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="2" x2="12" y2="6"></line>
                    <line x1="12" y1="18" x2="12" y2="22"></line>
                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                    <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                    <line x1="2" y1="12" x2="6" y2="12"></line>
                    <line x1="18" y1="12" x2="22" y2="12"></line>
                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                    <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                </svg>
                <span>Searching Agents...</span>
            `);

            setTimeout(function () {
                var template = "{{ route('front.vendorlist.location.category', ['location' => 'LOC_ID', 'category' => 'CAT_ID']) }}";
                var redirectUrl = template.replace('LOC_ID', encodeURIComponent(district)).replace('CAT_ID', encodeURIComponent(category));

                if (city) {
                    redirectUrl += (redirectUrl.indexOf('?') !== -1 ? '&' : '?') + 'city=' + encodeURIComponent(city);
                }

                window.location.href = redirectUrl;
            }, 300);
        });

        // Toggle All Categories in Popular Categories Section
        $('#btnToggleAllCategories, #cardMoreCategories').on('click', function (e) {
            e.preventDefault();
            var $extraCards = $('.category-card-extra');
            var $cardMore = $('#cardMoreCategories');
            var $btnText = $('#btnViewAllText');
            var $btnIcon = $('#btnViewAllIcon');
            var isExpanded = $('#btnToggleAllCategories').data('expanded') || false;

            if (!isExpanded) {
                $cardMore.hide();
                $extraCards.fadeIn(300);
                $btnText.text('Show Less Categories');
                $btnIcon.css('transform', 'rotate(180deg)');
                $('#btnToggleAllCategories').data('expanded', true);
            } else {
                $extraCards.fadeOut(200, function () {
                    $cardMore.fadeIn(200);
                });
                $btnText.text('View All Categories');
                $btnIcon.css('transform', 'rotate(0deg)');
                $('#btnToggleAllCategories').data('expanded', false);

                var $catSection = $('.categories-section');
                if ($catSection.length) {
                    $('html, body').animate({
                        scrollTop: $catSection.offset().top - 80
                    }, 400);
                }
            }
        });

        // Top Verified Agents Carousel Controls
        const agentsSliderTrack = document.getElementById('agentsSliderTrack');
        const agentPrevBtn = document.getElementById('agentPrevBtn');
        const agentNextBtn = document.getElementById('agentNextBtn');

        if (agentsSliderTrack && agentPrevBtn && agentNextBtn) {
            agentPrevBtn.addEventListener('click', function () {
                const cardWidth = agentsSliderTrack.querySelector('.agent-card')?.offsetWidth || 230;
                agentsSliderTrack.scrollBy({
                    left: -(cardWidth * 2),
                    behavior: 'smooth'
                });
            });

            agentNextBtn.addEventListener('click', function () {
                const cardWidth = agentsSliderTrack.querySelector('.agent-card')?.offsetWidth || 230;
                agentsSliderTrack.scrollBy({
                    left: cardWidth * 2,
                    behavior: 'smooth'
                });
            });
        }

        // Rajasthan Districts Carousel Controls
        const districtSliderTrack = document.getElementById('districtSliderTrack');
        const districtPrevBtn = document.getElementById('districtPrevBtn');
        const districtNextBtn = document.getElementById('districtNextBtn');

        if (districtSliderTrack && districtPrevBtn && districtNextBtn) {
            districtPrevBtn.addEventListener('click', function () {
                const cardWidth = districtSliderTrack.querySelector('.district-card')?.offsetWidth || 210;
                districtSliderTrack.scrollBy({
                    left: -(cardWidth * 2),
                    behavior: 'smooth'
                });
            });

            districtNextBtn.addEventListener('click', function () {
                const cardWidth = districtSliderTrack.querySelector('.district-card')?.offsetWidth || 210;
                districtSliderTrack.scrollBy({
                    left: cardWidth * 2,
                    behavior: 'smooth'
                });
            });
        }

        // Testimonials Carousel Controls
        const testimonialSliderTrack = document.getElementById('testimonialSliderTrack');
        const testimonialPrevBtn = document.getElementById('testimonialPrevBtn');
        const testimonialNextBtn = document.getElementById('testimonialNextBtn');

        if (testimonialSliderTrack && testimonialPrevBtn && testimonialNextBtn) {
            testimonialPrevBtn.addEventListener('click', function () {
                const cardWidth = testimonialSliderTrack.querySelector('.testimonial-card')?.offsetWidth || 320;
                testimonialSliderTrack.scrollBy({
                    left: -cardWidth,
                    behavior: 'smooth'
                });
            });

        // Mobile Header Search Button Scroll Trigger
        $('#mobileHeaderSearchBtn').on('click', function (e) {
            e.preventDefault();
            var $searchForm = $('#agentSearchForm');
            if ($searchForm.length) {
                $('html, body').animate({
                    scrollTop: $searchForm.offset().top - 70
                }, 400, function () {
                    if ($.fn.select2) {
                        $('#categorySelect').select2('open');
                    }
                });
            }
        });
    });
</script>
@endpush

@extends('front.layout.main')
@section('title', $pageTitle ?? 'Price Plans')

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
    <!-- Pricing Hero Section End -->

    <!-- Pricing Page Main Content Area Start -->
    <main class="price-page-main" id="priceMainContent">
        
        <!-- Pricing Cards Section Start -->
        <section class="pricing-cards-section">
            <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 10px 24px 15px 24px;">
                
                <!-- 4 Cards Grid -->
                <div class="pricing-cards-grid">
                    
                    <!-- Card 1: FREE LISTING -->
                    <div class="pricing-card green-card">
                        <div class="pricing-card-top">
                            <!-- Top Badge -->
                            <div class="pricing-badge badge-green">FREE LISTING</div>
                            
                            <!-- Icon Circle -->
                            <div class="pricing-icon-circle icon-bg-green">
                                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" y="4" width="14" height="17" rx="3" fill="#DCFCE7" stroke="#00A83E" stroke-width="2"/>
                                    <path d="M9 3H15V6H9V3Z" fill="#00A83E" stroke="#00A83E" stroke-width="1"/>
                                    <line x1="8" y1="10" x2="16" y2="10" stroke="#00A83E" stroke-width="2" stroke-linecap="round"/>
                                    <line x1="8" y1="14" x2="13" y2="14" stroke="#00A83E" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="16" cy="16" r="4" fill="#00A83E"/>
                                    <path d="M14.5 16L15.5 17L17.5 15" stroke="#FFFFFF" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <!-- Price Tag -->
                            <div class="pricing-price-wrap">
                                <div class="price-amount text-green">₹0</div>
                                <div class="price-duration">/ 1 Month</div>
                                <div class="price-subtag-green">(बिल्कुल फ्री)</div>
                            </div>

                            <!-- Divider line -->
                            <div class="pricing-divider"></div>

                            <!-- Features List -->
                            <ul class="pricing-feature-list">
                                <li>
                                    <span class="check-icon check-green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Business Listing</span>
                                </li>
                                <li>
                                    <span class="check-icon check-green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Basic Details</span>
                                </li>
                                <li>
                                    <span class="check-icon check-green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>District Page पर Limited</span>
                                </li>
                                <li>
                                    <span class="check-icon check-green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>City Page पर List</span>
                                </li>
                                <li>
                                    <span class="check-icon check-green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Limited Visibility</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Action Button -->
                        <div class="pricing-action-wrap">
                            @if(\Auth::check())
                                <a href="{{ route('front.addListing') }}" class="pricing-btn btn-outline-green">Start For Free</a>
                            @else
                                <a href="javascript:void(0)" class="pricing-btn btn-outline-green open-signin" onclick="$('.tab[data-tab=signup]').trigger('click');">Start For Free</a>
                            @endif
                        </div>
                    </div>

                    <!-- Card 2: VISITING CARD AD -->
                    <div class="pricing-card blue-card">
                        <div class="pricing-card-top">
                            <!-- Top Badge -->
                            <div class="pricing-badge badge-blue">VISITING CARD AD</div>
                            
                            <!-- Icon Circle -->
                            <div class="pricing-icon-circle icon-bg-blue">
                                <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="5" width="18" height="14" rx="3" fill="#DBEAFE" stroke="#0052FF" stroke-width="2"/>
                                    <circle cx="8.5" cy="11" r="2.5" fill="#0052FF"/>
                                    <path d="M5.5 16C5.5 14 7 13.5 8.5 13.5C10 13.5 11.5 14 11.5 16" stroke="#0052FF" stroke-width="1.8"/>
                                    <line x1="13.5" y1="10" x2="18.5" y2="10" stroke="#0052FF" stroke-width="2" stroke-linecap="round"/>
                                    <line x1="13.5" y1="13" x2="17" y2="13" stroke="#0052FF" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>

                            <!-- Price Tag -->
                            <div class="pricing-price-wrap">
                                <div class="price-amount text-blue">₹249</div>
                                <div class="price-duration">/ 1 Month</div>
                            </div>

                            <!-- Divider line -->
                            <div class="pricing-divider"></div>

                            <!-- Features List -->
                            <ul class="pricing-feature-list">
                                <li>
                                    <span class="check-icon check-blue">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Visiting Card Ad</span>
                                </li>
                                <li>
                                    <span class="check-icon check-blue">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Business Listing</span>
                                </li>
                                <li>
                                    <span class="check-icon check-blue">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>City Page पर Show</span>
                                </li>
                                <li>
                                    <span class="check-icon check-blue">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Better Visibility</span>
                                </li>
                                <li>
                                    <span class="check-icon check-blue">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Contact Details Show</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Action Button -->
                        <div class="pricing-action-wrap">
                            @if(\Auth::check())
                                <a href="{{ route('front.addbanner', ['plan' => 'visiting_card', 'sub_type' => 'side', 'price' => 249]) }}" class="pricing-btn btn-solid-blue">Choose Plan</a>
                            @else
                                <a href="javascript:void(0)" class="pricing-btn btn-solid-blue open-signin">Choose Plan</a>
                            @endif
                        </div>
                    </div>

                    <!-- Card 3: PAID LISTING AD -->
                    <div class="pricing-card orange-card">
                        <div class="pricing-card-top">
                            <!-- Top Badge -->
                            <div class="pricing-badge badge-orange">PAID LISTING AD</div>
                            
                            <!-- Icon Circle -->
                            <div class="pricing-icon-circle icon-bg-orange">
                                <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 10V20C4 20.6 4.4 21 5 21H19C19.6 21 20 20.6 20 20V10" fill="#FFEDD5" stroke="#FF6B00" stroke-width="2"/>
                                    <path d="M3 6L5 10H19L21 6H3Z" fill="#FF6B00" stroke="#FF6B00" stroke-width="1"/>
                                    <path d="M9 21V15H15V21" stroke="#FF6B00" stroke-width="2"/>
                                    <polygon points="12 11 12.8 12.6 14.5 12.9 13.3 14.1 13.6 15.8 12 15 10.4 15.8 10.7 14.1 9.5 12.9 11.2 12.6" fill="#FF6B00"/>
                                </svg>
                            </div>

                            <!-- Price Tag -->
                            <div class="pricing-price-wrap">
                                <div class="price-amount text-orange">₹499</div>
                                <div class="price-duration">/ 1 Month</div>
                            </div>

                            <!-- Divider line -->
                            <div class="pricing-divider"></div>

                            <!-- Features List -->
                            <ul class="pricing-feature-list">
                                <li>
                                    <span class="check-icon check-orange">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Business Listing</span>
                                </li>
                                <li>
                                    <span class="check-icon check-orange">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Highlighted Listing</span>
                                </li>
                                <li>
                                    <span class="check-icon check-orange">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>City Page पर Highlight</span>
                                </li>
                                <li>
                                    <span class="check-icon check-orange">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Priority in Search</span>
                                </li>
                                <li>
                                    <span class="check-icon check-orange">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>More Visibility</span>
                                </li>
                                <li>
                                    <span class="check-icon check-orange">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Contact Details Show</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Action Button -->
                        <div class="pricing-action-wrap">
                            @if(\Auth::check())
                                <a href="{{ route('front.addbanner', ['plan' => 'paid_listing', 'sub_type' => 'paid_listing', 'price' => 499]) }}" class="pricing-btn btn-solid-orange">Choose Plan</a>
                            @else
                                <a href="javascript:void(0)" class="pricing-btn btn-solid-orange open-signin">Choose Plan</a>
                            @endif
                        </div>
                    </div>

                    <!-- Card 4: BANNER AD -->
                    <div class="pricing-card purple-card">
                        <div class="pricing-card-top">
                            <!-- Top Badge -->
                            <div class="pricing-badge badge-purple">BANNER AD</div>
                            
                            <!-- Icon Circle -->
                            <div class="pricing-icon-circle icon-bg-purple">
                                <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="4" y="4" width="16" height="11" rx="2" fill="#F3E8FF" stroke="#5B21B6" stroke-width="2"/>
                                    <path d="M8 19L10 15H14L16 19" stroke="#5B21B6" stroke-width="2" stroke-linecap="round"/>
                                    <text x="7" y="12" fill="#5B21B6" font-size="7" font-weight="900" font-family="sans-serif">AD</text>
                                </svg>
                            </div>

                            <!-- Price Tag -->
                            <div class="pricing-price-wrap">
                                <div class="price-amount text-purple">₹999</div>
                                <div class="price-duration">/ 1 Month</div>
                            </div>

                            <!-- Divider line -->
                            <div class="pricing-divider"></div>

                            <!-- Features List -->
                            <ul class="pricing-feature-list">
                                <li>
                                    <span class="check-icon check-purple">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Banner Ad Display</span>
                                </li>
                                <li>
                                    <span class="check-icon check-purple">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Top Position on District Page</span>
                                </li>
                                <li>
                                    <span class="check-icon check-purple">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Maximum Visibility</span>
                                </li>
                                <li>
                                    <span class="check-icon check-purple">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Premium Placement</span>
                                </li>
                                <li>
                                    <span class="check-icon check-purple">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Business Listing Included</span>
                                </li>
                                <li>
                                    <span class="check-icon check-purple">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>More Leads & Exposure</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Card Action Button -->
                        <div class="pricing-action-wrap">
                            @if(\Auth::check())
                                <a href="{{ route('front.addbanner', ['plan' => 'banner_ad', 'sub_type' => 'top', 'price' => 999]) }}" class="pricing-btn btn-solid-purple">Choose Plan</a>
                            @else
                                <a href="javascript:void(0)" class="pricing-btn btn-solid-purple open-signin">Choose Plan</a>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- Pricing Cards Section End -->

        <!-- Price Features White Card Banner Section Start -->
        <section class="price-features-banner-section">
            <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px 15px 24px;">
                
                <div class="price-features-white-card">
                    <div class="pf-features-grid">
                        
                        <!-- Col 1: Trusted Platform -->
                        <div class="pf-feature-col">
                            <div class="pf-icon-wrap">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <path d="M9 12l2 2 4-4"></path>
                                </svg>
                            </div>
                            <div class="pf-text-wrap">
                                <h3 class="pf-title">Trusted Platform</h3>
                                <p class="pf-subtitle">100% Verified & Secure</p>
                            </div>
                        </div>

                        <!-- Col 2: All India Visibility -->
                        <div class="pf-feature-col">
                            <div class="pf-icon-wrap">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <div class="pf-text-wrap">
                                <h3 class="pf-title">All India Visibility</h3>
                                <p class="pf-subtitle">Reach Every City, Every District</p>
                            </div>
                        </div>

                        <!-- Col 3: Affordable Plans -->
                        <div class="pf-feature-col">
                            <div class="pf-icon-wrap">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                </svg>
                            </div>
                            <div class="pf-text-wrap">
                                <h3 class="pf-title">Affordable Plans</h3>
                                <p class="pf-subtitle">Maximum Value at Best Prices</p>
                            </div>
                        </div>

                        <!-- Col 4: Grow Your Business -->
                        <div class="pf-feature-col">
                            <div class="pf-icon-wrap">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="20" x2="18" y2="10"></line>
                                    <line x1="12" y1="20" x2="12" y2="4"></line>
                                    <line x1="6" y1="20" x2="6" y2="14"></line>
                                    <polyline points="3 8 9 2 13 6 21 2"></polyline>
                                </svg>
                            </div>
                            <div class="pf-text-wrap">
                                <h3 class="pf-title">Grow Your Business</h3>
                                <p class="pf-subtitle">More Visibility, More Customers</p>
                            </div>
                        </div>

                        <!-- Col 5: Full Support -->
                        <div class="pf-feature-col pf-last-col">
                            <div class="pf-icon-wrap">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                </svg>
                            </div>
                            <div class="pf-text-wrap">
                                <h3 class="pf-title">Call Support Available</h3>
                                <p class="pf-subtitle">Always Here to Support You</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- Price Features White Card Banner Section End -->

        <!-- Why Join Agent 24 Cream CTA Banner Section Start -->
        <section class="price-why-join-section">
            <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px 15px 24px;">
                
                <div class="price-why-join-card">
                    
                    <!-- Left Column: Yellow People Icon -->
                    <div class="why-join-left">
                        <div class="why-join-icon-circle">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Middle Column: Heading + 4 Inline Checkmark Features -->
                    <div class="why-join-middle">
                        <h2 class="why-join-heading">Why Join Agent 24 India?</h2>
                        
                        <div class="why-join-features-row">
                            <!-- Feature 1 -->
                            <div class="wj-feature-item">
                                <span class="wj-check-icon">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                                <span>High Visibility</span>
                            </div>

                            <!-- Feature 2 -->
                            <div class="wj-feature-item">
                                <span class="wj-check-icon">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                                <span>Trusted Platform</span>
                            </div>

                            <!-- Feature 3 -->
                            <div class="wj-feature-item">
                                <span class="wj-check-icon">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                                <span>Quality Leads</span>
                            </div>

                            <!-- Feature 4 -->
                            <div class="wj-feature-item">
                                <span class="wj-check-icon">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </span>
                                <span>Business Growth</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Yellow Register CTA Button -->
                    <div class="why-join-right">
                        @if(\Auth::check())
                            <a href="{{ route('front.addListing') }}" class="btn-why-join-register">
                                <span>Register Now</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        @else
                            <a href="javascript:void(0)" class="btn-why-join-register open-signin" onclick="$('.tab[data-tab=signup]').trigger('click');">
                                <span>Register Now</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        @endif
                    </div>

                </div>

            </div>
        </section>
        <!-- Why Join Agent 24 Cream CTA Banner Section End -->

        <!-- Ready to Grow Your Business CTA Section Start -->
        <section class="price-ready-grow-section">
            <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px 15px 24px;">
                
                <div class="price-ready-grow-card">
                    <!-- Left: Dashboard Image Mockup -->
                    <div class="ready-grow-img-wrap">
                        <div class="ready-grow-mockup">
                            <svg width="180" height="130" viewBox="0 0 180 130" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Laptop frame -->
                                <rect x="10" y="5" width="160" height="100" rx="8" fill="#1E293B" stroke="#475569" stroke-width="2"/>
                                <rect x="18" y="13" width="144" height="80" rx="4" fill="#F8FAFC"/>
                                <!-- Screen content -->
                                <rect x="24" y="20" width="40" height="6" rx="2" fill="#004BEE"/>
                                <rect x="24" y="30" width="55" height="4" rx="2" fill="#CBD5E1"/>
                                <rect x="24" y="38" width="45" height="4" rx="2" fill="#CBD5E1"/>
                                <!-- Chart bars -->
                                <rect x="24" y="70" width="12" height="18" rx="2" fill="#3B82F6"/>
                                <rect x="40" y="60" width="12" height="28" rx="2" fill="#60A5FA"/>
                                <rect x="56" y="50" width="12" height="38" rx="2" fill="#2563EB"/>
                                <rect x="72" y="55" width="12" height="33" rx="2" fill="#93C5FD"/>
                                <!-- Pie chart -->
                                <circle cx="125" cy="55" r="22" fill="#DBEAFE" stroke="#3B82F6" stroke-width="2"/>
                                <path d="M125 33A22 22 0 0 1 147 55H125V33Z" fill="#004BEE"/>
                                <path d="M125 55A22 22 0 0 1 110 73L125 55Z" fill="#60A5FA"/>
                                <!-- Laptop base -->
                                <path d="M0 105H180L170 120H10L0 105Z" fill="#1E293B"/>
                                <rect x="60" y="105" width="60" height="4" rx="2" fill="#334155"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Middle: Text Content -->
                    <div class="ready-grow-text-wrap">
                        <h2 class="ready-grow-title">Ready to Grow Your Business?</h2>
                        <p class="ready-grow-desc">Thousands of Agents are joining us to give their Business a new identity and get Quality Customers.</p>
                        @if(\Auth::check())
                            <a href="{{ route('front.addListing') }}" class="ready-grow-btn">
                                <span>Choose a Plan Now</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        @else
                            <a href="javascript:void(0)" class="ready-grow-btn open-signin" onclick="$('.tab[data-tab=signup]').trigger('click');">
                                <span>Choose a Plan Now</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        @endif
                    </div>

                    <!-- Right: Trust Badge -->
                    <div class="ready-grow-badge-wrap">
                        <div class="ready-grow-trust-badge">
                            <div class="trust-badge-stars">★★★★★</div>
                            <div class="trust-badge-number">10,000+</div>
                            <div class="trust-badge-text">Agents Trust<br>Agent 24 India</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Ready to Grow Your Business CTA Section End -->

        <!-- White 5-Stat Metrics Banner & Privacy Guarantee Section Start -->
        <section class="price-white-stats-section">
            <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px 35px 24px;">
                
                <!-- White 5-Stat Card -->
                <div class="price-white-stats-card">
                    
                    <!-- Stat 1: 10,000+ Verified Agents -->
                    <div class="pws-col">
                        <div class="pws-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="pws-text">
                            <span class="pws-number">10,000+</span>
                            <span class="pws-label">Verified Agents</span>
                        </div>
                    </div>

                    <div class="pws-divider"></div>

                    <!-- Stat 2: 2500+ Cities Covered -->
                    <div class="pws-col">
                        <div class="pws-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="pws-text">
                            <span class="pws-number">2500+</span>
                            <span class="pws-label">Cities Covered</span>
                        </div>
                    </div>

                    <div class="pws-divider"></div>

                    <!-- Stat 3: 50+ Categories -->
                    <div class="pws-col">
                        <div class="pws-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </div>
                        <div class="pws-text">
                            <span class="pws-number">50+</span>
                            <span class="pws-label">Categories</span>
                        </div>
                    </div>

                    <div class="pws-divider"></div>

                    <!-- Stat 4: 1L+ Happy Customers -->
                    <div class="pws-col">
                        <div class="pws-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </div>
                        <div class="pws-text">
                            <span class="pws-number">1L+</span>
                            <span class="pws-label">Happy Customers</span>
                        </div>
                    </div>

                    <div class="pws-divider"></div>

                    <!-- Stat 5: Full Support Available -->
                    <div class="pws-col">
                        <div class="pws-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                            </svg>
                        </div>
                        <div class="pws-text">
                            <span class="pws-number">Full</span>
                            <span class="pws-label">Support Available</span>
                        </div>
                    </div>

                </div>

                <!-- Bottom Privacy Guarantee Note -->
                <div class="price-privacy-guarantee-note">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0B1948" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="M9 12l2 2 4-4"></path>
                    </svg>
                    <span><strong>Our Guarantee:</strong> Your Privacy and Data are completely protected.</span>
                </div>

            </div>
        </section>
        <!-- White 5-Stat Metrics Banner & Privacy Guarantee Section End -->

    </main>
    <!-- Pricing Page Main Content Area End -->

    <style>
        /* ============================================================
           PRICING PAGE FULL STYLING
           ============================================================ */
        
        /* Hero Section */
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
        
        .price-toggle-btn:hover:not(.active) {
            background: #F1F5F9;
            color: #004BEE;
        }
        
        /* Hero Right Illustration */
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
        
        /* Pricing Cards Section */
        .pricing-cards-section {
            margin-top: 25px;
            position: relative;
            z-index: 5;
        }
        
        .pricing-cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        
        .pricing-card {
            background: #FFFFFF;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1.5px solid #F1F5F9;
            position: relative;
        }
        
        .pricing-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(0, 75, 238, 0.12);
        }
        
        .pricing-card.green-card { border-top: 4px solid #16A34A; }
        .pricing-card.blue-card { border-top: 4px solid #004BEE; }
        .pricing-card.orange-card { border-top: 4px solid #F97316; }
        .pricing-card.purple-card { border-top: 4px solid #7C3AED; }
        
        .pricing-card-top {
            padding: 22px 18px 16px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        /* Badge */
        .pricing-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 50px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .badge-green { background: #16A34A; color: #FFFFFF; }
        .badge-blue { background: #004BEE; color: #FFFFFF; }
        .badge-orange { background: #F97316; color: #FFFFFF; }
        .badge-purple { background: #7C3AED; color: #FFFFFF; }
        
        /* Icon Circle */
        .pricing-icon-circle {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .icon-bg-green { background: #DCFCE7; }
        .icon-bg-blue { background: #DBEAFE; }
        .icon-bg-orange { background: #FFEDD5; }
        .icon-bg-purple { background: #F3E8FF; }
        
        /* Price Display */
        .pricing-price-wrap {
            margin-bottom: 12px;
        }
        .price-amount {
            font-size: 38px;
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -0.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .text-green { color: #16A34A; }
        .text-blue { color: #004BEE; }
        .text-orange { color: #F97316; }
        .text-purple { color: #7C3AED; }
        
        .price-duration {
            font-size: 13.5px;
            font-weight: 600;
            color: #64748B;
            margin-top: 2px;
        }
        .price-subtag-green {
            font-size: 12.5px;
            font-weight: 700;
            color: #16A34A;
            margin-top: 3px;
        }
        
        /* Divider */
        .pricing-divider {
            width: 100%;
            height: 1px;
            background: #F1F5F9;
            margin: 4px 0 14px 0;
        }
        
        /* Feature List */
        .pricing-feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            text-align: left;
        }
        .pricing-feature-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 0;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            line-height: 1.4;
        }
        .check-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .check-green { background: #16A34A; }
        .check-blue { background: #004BEE; }
        .check-orange { background: #F97316; }
        .check-purple { background: #7C3AED; }
        
        /* Card Action Button */
        .pricing-action-wrap {
            padding: 14px 18px 20px 18px;
        }
        .pricing-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 11px 16px;
            border-radius: 12px;
            font-size: 14.5px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.25s ease;
            cursor: pointer;
        }
        .btn-outline-green {
            background: #DCFCE7;
            color: #16A34A;
            border: 2px solid #16A34A;
        }
        .btn-outline-green:hover {
            background: #16A34A;
            color: #FFFFFF;
            box-shadow: 0 6px 18px rgba(22,163,74,0.3);
            transform: translateY(-2px);
        }
        .btn-solid-blue {
            background: #004BEE;
            color: #FFFFFF;
            border: 2px solid #004BEE;
        }
        .btn-solid-blue:hover {
            background: #0036A8;
            border-color: #0036A8;
            color: #FFFFFF;
            box-shadow: 0 6px 18px rgba(0,75,238,0.3);
            transform: translateY(-2px);
        }
        .btn-solid-orange {
            background: #F97316;
            color: #FFFFFF;
            border: 2px solid #F97316;
        }
        .btn-solid-orange:hover {
            background: #EA580C;
            border-color: #EA580C;
            color: #FFFFFF;
            box-shadow: 0 6px 18px rgba(249,115,22,0.3);
            transform: translateY(-2px);
        }
        .btn-solid-purple {
            background: #7C3AED;
            color: #FFFFFF;
            border: 2px solid #7C3AED;
        }
        .btn-solid-purple:hover {
            background: #6D28D9;
            border-color: #6D28D9;
            color: #FFFFFF;
            box-shadow: 0 6px 18px rgba(124,58,237,0.3);
            transform: translateY(-2px);
        }
        
        /* Features White Banner */
        .price-features-white-card {
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.05);
            padding: 22px 28px;
            border: 1px solid #F1F5F9;
        }
        .pf-features-grid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .pf-feature-col {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 170px;
            border-right: 1px solid #E2E8F0;
            padding-right: 16px;
        }
        .pf-feature-col.pf-last-col,
        .pf-feature-col:last-child {
            border-right: none;
            padding-right: 0;
        }
        .pf-icon-wrap {
            width: 44px;
            height: 44px;
            background: #EEF2FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .pf-text-wrap {
            flex: 1;
        }
        .pf-title {
            font-size: 13.5px;
            font-weight: 800;
            color: #1E293B;
            margin: 0 0 2px 0;
            line-height: 1.3;
        }
        .pf-subtitle {
            font-size: 11.5px;
            font-weight: 500;
            color: #64748B;
            margin: 0;
            line-height: 1.3;
        }
        
        /* Why Join CTA */
        .price-why-join-card {
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
            border-radius: 18px;
            padding: 26px 32px;
            display: flex;
            align-items: center;
            gap: 24px;
            border: 1px solid #FDE68A;
            box-shadow: 0 2px 16px rgba(234,179,8,0.08);
        }
        .why-join-left { flex-shrink: 0; }
        .why-join-icon-circle {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #F59E0B, #D97706);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(245,158,11,0.3);
        }
        .why-join-middle { flex: 1; }
        .why-join-heading {
            font-size: 20px;
            font-weight: 800;
            color: #1E293B;
            margin: 0 0 10px 0;
            line-height: 1.3;
        }
        .why-join-features-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }
        .wj-feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
        }
        .wj-check-icon {
            width: 18px;
            height: 18px;
            background: #16A34A;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .why-join-right { flex-shrink: 0; }
        .btn-why-join-register {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 26px;
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: #FFFFFF;
            border-radius: 12px;
            font-size: 14.5px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(245,158,11,0.3);
            transition: all 0.25s ease;
            white-space: nowrap;
        }
        .btn-why-join-register:hover {
            background: linear-gradient(135deg, #D97706, #B45309);
            transform: translateY(-2px);
            color: #FFFFFF;
        }
        
        /* Ready Grow Card */
        .price-ready-grow-card {
            background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 50%, #1E40AF 100%);
            border-radius: 20px;
            padding: 32px 36px;
            display: flex;
            align-items: center;
            gap: 32px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 8px 30px rgba(15,23,42,0.25);
        }
        .ready-grow-img-wrap { flex-shrink: 0; width: 180px; }
        .ready-grow-mockup {
            background: rgba(255,255,255,0.05);
            border-radius: 14px;
            padding: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .ready-grow-text-wrap { flex: 1; }
        .ready-grow-title {
            font-size: 24px;
            font-weight: 900;
            color: #FFFFFF;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }
        .ready-grow-desc {
            font-size: 13.5px;
            font-weight: 500;
            color: #94A3B8;
            margin: 0 0 18px 0;
            line-height: 1.5;
        }
        .ready-grow-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 24px;
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: #FFFFFF;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(245,158,11,0.3);
            transition: all 0.25s ease;
            white-space: nowrap;
        }
        .ready-grow-btn:hover {
            background: linear-gradient(135deg, #D97706, #B45309);
            transform: translateY(-2px);
            color: #FFFFFF;
        }
        .ready-grow-badge-wrap { flex-shrink: 0; }
        .ready-grow-trust-badge {
            background: linear-gradient(135deg, #1E3A5F, #1E40AF);
            border: 2px solid rgba(59,130,246,0.3);
            border-radius: 16px;
            padding: 18px 22px;
            text-align: center;
            min-width: 130px;
        }
        .trust-badge-stars {
            font-size: 15px;
            color: #FBBF24;
            margin-bottom: 3px;
            letter-spacing: 2px;
        }
        .trust-badge-number {
            font-size: 28px;
            font-weight: 900;
            color: #FFFFFF;
            line-height: 1.1;
            margin-bottom: 3px;
        }
        .trust-badge-text {
            font-size: 11.5px;
            font-weight: 600;
            color: #94A3B8;
            line-height: 1.35;
        }
        
        /* White 5-Stats */
        .price-white-stats-card {
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.05);
            padding: 22px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border: 1px solid #F1F5F9;
            flex-wrap: wrap;
        }
        .pws-col {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 140px;
            justify-content: center;
        }
        .pws-icon {
            width: 44px;
            height: 44px;
            background: #EEF2FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .pws-text {
            display: flex;
            flex-direction: column;
        }
        .pws-number {
            font-size: 19px;
            font-weight: 900;
            color: #0F172A;
            line-height: 1.2;
        }
        .pws-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748B;
        }
        .pws-divider {
            width: 1px;
            height: 38px;
            background: #E2E8F0;
        }
        .price-privacy-guarantee-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            font-size: 13.5px;
            color: #475569;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .pricing-cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .price-hero-container {
                flex-direction: column;
                text-align: center;
                gap: 24px;
            }
            .price-hero-left {
                max-width: 100%;
            }
            .price-hero-title {
                font-size: 30px;
            }
            .pricing-cards-grid {
                grid-template-columns: 1fr;
            }
            .price-why-join-card {
                flex-direction: column;
                text-align: center;
            }
            .why-join-features-row {
                justify-content: center;
            }
            .price-ready-grow-card {
                flex-direction: column;
                text-align: center;
            }
            .price-white-stats-card {
                flex-direction: column;
                gap: 18px;
            }
            .pws-divider {
                display: none;
            }
        }
    </style>

@endsection
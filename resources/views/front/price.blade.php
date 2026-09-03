@extends('front.layout.main')
@section('title', $pageTitle ?? 'Price Plans')

@section('content')
    <!-- Pricing Hero Section Start -->
    <section class="price-hero-section">
        <div class="price-hero-container">
            <!-- Left Content -->
            <div class="price-hero-left">
                <h1 class="price-hero-title">Pricing Plans</h1>
                <p class="price-hero-subtitle">Give Your Business the Right Visibility and More Customers</p>
                <p class="price-hero-desc">Get more Visibility and Trusted Customers with our Affordable Plans!</p>
                
                <!-- Monthly / 3 Months Toggle -->
                <div class="price-toggle-wrap">
                    <button class="price-toggle-btn" id="toggleMonthly">Monthly</button>
                    <button class="price-toggle-btn active" id="toggle3Months">3 Months (Best Value)</button>
                </div>
            </div>
            
            <!-- Right Illustration -->
            <div class="price-hero-right">
                <div class="price-hero-illustration">
                    <!-- Shield with checkmark -->
                    <div class="price-shield-wrap">
                        <svg width="120" height="140" viewBox="0 0 120 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M60 10L15 30V65C15 95 37.5 122.5 60 130C82.5 122.5 105 95 105 65V30L60 10Z" fill="#004BEE" stroke="#0036A8" stroke-width="3"/>
                            <path d="M42 70L55 83L80 55" stroke="#FFFFFF" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <!-- Floating badge -->
                        <div class="price-hero-badge">
                            <span class="badge-logo-text">AGENT 24 INDIA</span>
                        </div>
                    </div>
                    <!-- Decorative elements -->
                    <div class="price-hero-deco deco-1"></div>
                    <div class="price-hero-deco deco-2"></div>
                    <div class="price-hero-deco deco-3"></div>
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
                                <div class="price-duration">/ 3 Months</div>
                                <div class="price-subtag-green">(Completely Free)</div>
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
                                    <span>Limited on District Page</span>
                                </li>
                                <li>
                                    <span class="check-icon check-green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </span>
                                    <span>Listed on City Page</span>
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
                                <div class="price-duration">/ 3 Months</div>
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
                                    <span>Listed on City Page</span>
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
                                <a href="{{ route('front.addbanner') }}" class="pricing-btn btn-solid-blue">Choose Plan</a>
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
                                <div class="price-duration">/ 3 Months</div>
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
                                    <span>Highlighted on City Page</span>
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
                                <a href="{{ route('front.addListing') }}" class="pricing-btn btn-solid-orange">Choose Plan</a>
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
                                <div class="price-duration">/ 3 Months</div>
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
                                <a href="{{ route('front.addbanner') }}" class="pricing-btn btn-solid-purple">Choose Plan</a>
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

                        <!-- Col 5: 24x7 Support -->
                        <div class="pf-feature-col pf-last-col">
                            <div class="pf-icon-wrap">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                </svg>
                            </div>
                            <div class="pf-text-wrap">
                                <h3 class="pf-title">24x7 Support</h3>
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

                    <!-- Stat 2: 500+ Cities Covered -->
                    <div class="pws-col">
                        <div class="pws-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="pws-text">
                            <span class="pws-number">500+</span>
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

                    <!-- Stat 5: 24x7 Support Available -->
                    <div class="pws-col">
                        <div class="pws-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path>
                            </svg>
                        </div>
                        <div class="pws-text">
                            <span class="pws-number">24x7</span>
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
@endsection
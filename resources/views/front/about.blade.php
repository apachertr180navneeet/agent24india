@extends('front.layout.main')
@section('title', $pageTitle ?? 'About Us')

@section('content')
    <!-- About Us Hero Banner Section Start -->
    <section class="about-hero-banner-section">
        <div class="about-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/about_hero_banner.png') }}" alt="About Us - Agent 24 India, Sahi Agent, Sahi Connection" class="about-hero-banner-img">
        </div>
    </section>
    <!-- About Us Hero Banner Section End -->

    <!-- Dynamic CMS Story Section (If Description Exists) -->
    @if(!empty($about) && !empty($about->description))
    <section class="about-cms-section" style="padding: 30px 0 10px 0;">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px;">
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <h3 style="font-size: 24px; font-weight: 800; color: #0F172A; margin-bottom: 16px; text-align: center;">{!! $about->title ?? 'About Agent 24 India' !!}</h3>
                <div style="font-size: 15px; color: #475569; line-height: 1.8;">
                    {!! $about->description !!}
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Our Mission Section Start -->
    <section class="our-goal-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 10px 24px 10px 24px;">
            
            <!-- Section Header -->
            <div class="our-goal-header">
                <div class="goal-tagline">
                    <span class="goal-line"></span>
                    <span class="goal-tag-text">Our Mission</span>
                    <span class="goal-line"></span>
                </div>
                <h2 class="goal-main-title">
                    <span class="goal-subline"></span>
                    Connecting every individual with the right agent, saving time, money, and effort.
                    <span class="goal-subline"></span>
                </h2>
            </div>

            <!-- 4 Cards Grid -->
            <div class="our-goal-cards-grid">
                
                <!-- Card 1 -->
                <div class="goal-card">
                    <div class="goal-icon-circle blue-circle">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="goal-card-title">Find the Right Agent</h3>
                    <p class="goal-card-desc">Connect with top verified professionals tailored to your exact needs.</p>
                </div>

                <!-- Card 2 -->
                <div class="goal-card">
                    <div class="goal-icon-circle blue-circle">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 12 11 14 15 10"></polyline>
                        </svg>
                    </div>
                    <h3 class="goal-card-title">Trust & Transparency</h3>
                    <p class="goal-card-desc">Every agent on our platform is authenticated and trustworthy.</p>
                </div>

                <!-- Card 3 -->
                <div class="goal-card">
                    <div class="goal-icon-circle blue-circle">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h3 class="goal-card-title">Save Time & Effort</h3>
                    <p class="goal-card-desc">All verified details in one unified place for quick decisions.</p>
                </div>

                <!-- Card 4 -->
                <div class="goal-card">
                    <div class="goal-icon-circle green-circle">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 3h12M6 8h12M6 13h12M9 13c0 3 2.5 5 6 5s6-2 6-5M12 18v3"></path>
                            <circle cx="12" cy="12" r="9" stroke="#16A34A"></circle>
                        </svg>
                    </div>
                    <h3 class="goal-card-title">Affordable & Value-Driven</h3>
                    <p class="goal-card-desc">Cost-effective plans delivering superior reach and visibility.</p>
                </div>

            </div>

        </div>
    </section>
    <!-- Our Goal Section End -->

    <!-- Why Choose Agent 24 India Blue Banner Section Start -->
    <section class="why-choose-blue-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 10px 24px 10px 24px;">
            
            <div class="blue-why-banner-card">
                <!-- Banner Title -->
                <h2 class="blue-banner-title">Why Choose Agent 24 India?</h2>

                <!-- 4 Columns Grid -->
                <div class="blue-banner-grid">
                    
                    <!-- Column 1 -->
                    <div class="blue-banner-col">
                        <div class="blue-banner-icon-wrap">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="blue-banner-info">
                            <h3 class="blue-banner-head">All India Network</h3>
                            <p class="blue-banner-sub">Pan-India coverage across all districts</p>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="blue-banner-col">
                        <div class="blue-banner-icon-wrap">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <path d="M12 8v4l3 3"></path>
                            </svg>
                        </div>
                        <div class="blue-banner-info">
                            <h3 class="blue-banner-head">Affordable Plans</h3>
                            <p class="blue-banner-sub">High-value growth subscription plans</p>
                        </div>
                    </div>

                    <!-- Column 3 -->
                    <div class="blue-banner-col">
                        <div class="blue-banner-icon-wrap trophy-icon-wrap">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFB800" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                                <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                                <path d="M4 22h16"></path>
                                <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                                <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                                <path d="M18 2H6v7a6 6 0 0 0 12 0V2z"></path>
                            </svg>
                        </div>
                        <div class="blue-banner-info">
                            <h3 class="blue-banner-head">Grow Your Business</h3>
                            <p class="blue-banner-sub">Enhanced visibility and verified leads</p>
                        </div>
                    </div>

                    <!-- Column 4 -->
                    <div class="blue-banner-col last-blue-col">
                        <div class="blue-banner-icon-wrap">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                            </svg>
                        </div>
                        <div class="blue-banner-info">
                            <h3 class="blue-banner-head">24x7 Support</h3>
                            <p class="blue-banner-sub">Dedicated support team always available</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Register Call-To-Action Section Start -->
    <section class="about-cta-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 10px 24px 10px 24px; text-align: center;">
            
            <h2 class="about-cta-title">
                <span class="cta-line"></span>
                Partner with us and take your business to new heights.
                <span class="cta-line"></span>
            </h2>

            <div class="about-cta-btn-wrap">
                @if(\Auth::check())
                    <a href="{{ route('front.addListing') }}" class="btn-yellow-cta">
                        <span>Create Free Listing</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('front.register') }}" class="btn-yellow-cta">
                        <span>Register Now</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                @endif
            </div>

        </div>
    </section>

    <!-- Happy Customers Section Start -->
    <section class="happy-customers-banner-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 10px 24px 10px 24px;">
            
            <!-- Outer Light Blue Border Container Box -->
            <div class="happy-customers-outer-box">
                
                <!-- Header Title -->
                <div class="happy-customers-header">
                    <span class="hc-dash-line"></span>
                    <h2 class="happy-customers-title">
                        <span class="hc-text-blue">What Our</span>
                        <span class="hc-text-navy">Happy Customers Say</span>
                    </h2>
                    <span class="hc-dash-line"></span>
                </div>

                <!-- 3 Cards Grid -->
                <div class="happy-customers-grid">
                    
                    <!-- Card 1 -->
                    <div class="hc-card">
                        <div class="hc-card-body">
                            <div class="hc-avatar-wrap">
                                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="50" cy="50" r="48" fill="#DBEAFE" stroke="#3B82F6" stroke-width="3" />
                                    <path d="M20 100C20 78 32 70 50 70C68 70 80 78 80 100H20Z" fill="#1E3A8A" />
                                    <path d="M42 70L50 86L58 70" fill="#FFFFFF" />
                                    <path d="M46 70L50 88L54 70" fill="#2563EB" />
                                    <path d="M43 56V70H57V56H43Z" fill="#E2A687" />
                                    <path d="M34 42C34 54 41 62 50 62C59 62 66 54 66 42C66 30 59 24 50 24C41 24 34 30 34 42Z" fill="#F0B89A" />
                                    <path d="M30 40C30 22 38 12 50 12C62 12 70 22 70 40C70 54 66 67 62 74C60 66 63 50 60 36C56 26 52 23 50 23C48 23 44 26 40 36C37 50 40 66 38 74C34 67 30 54 30 40Z" fill="#1E1B4B" />
                                    <circle cx="44" cy="40" r="2.5" fill="#1E1B4B" />
                                    <circle cx="56" cy="40" r="2.5" fill="#1E1B4B" />
                                    <path d="M44 50C47 54 53 54 56 50" stroke="#1E1B4B" stroke-width="2" stroke-linecap="round" fill="#FFFFFF" />
                                </svg>
                            </div>
                            <div class="hc-content">
                                <div class="hc-stars">★★★★★</div>
                                <p class="hc-quote">"With Agent 24 India, I found the perfect Real Estate Consultant in Jaipur in no time. Extremely smooth and reliable platform!"</p>
                            </div>
                        </div>
                        <div class="hc-author">Neha Sharma, Jaipur</div>
                    </div>

                    <!-- Card 2 -->
                    <div class="hc-card">
                        <div class="hc-card-body">
                            <div class="hc-avatar-wrap">
                                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="50" cy="50" r="48" fill="#FCE7F3" stroke="#EC4899" stroke-width="3" />
                                    <path d="M22 45C22 25 32 14 50 14C68 14 78 25 78 45C78 68 74 85 70 100H30C26 85 22 68 22 45Z" fill="#0F172A" />
                                    <path d="M20 100C20 80 32 72 50 72C68 72 80 80 80 100H20Z" fill="#1E293B" />
                                    <path d="M42 72L50 88L58 72" fill="#FFFFFF" />
                                    <path d="M44 56V72H56V56H44Z" fill="#D99B75" />
                                    <path d="M34 40C34 52 41 60 50 60C59 60 66 52 66 40C66 28 59 22 50 22C41 22 34 28 34 40Z" fill="#E2A687" />
                                    <circle cx="44" cy="38" r="2.5" fill="#0F172A" />
                                    <circle cx="56" cy="38" r="2.5" fill="#0F172A" />
                                    <path d="M45 48C48 52 52 52 55 48" fill="#FFFFFF" stroke="#0F172A" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="hc-content">
                                <div class="hc-stars">★★★★★</div>
                                <p class="hc-quote">"Their agent search feature is truly remarkable. Our customer base and verified leads have grown substantially!"</p>
                            </div>
                        </div>
                        <div class="hc-author">Suresh Choudhary, Jodhpur</div>
                    </div>

                    <!-- Card 3 -->
                    <div class="hc-card">
                        <div class="hc-card-body">
                            <div class="hc-avatar-wrap">
                                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="50" cy="50" r="48" fill="#FEF3C7" stroke="#F59E0B" stroke-width="3" />
                                    <path d="M20 100C20 78 32 70 50 70C68 70 80 78 80 100H20Z" fill="#2563EB" />
                                    <path d="M42 70L50 86L58 70" fill="#FFFFFF" />
                                    <path d="M46 70L50 88L54 70" fill="#1E3A8A" />
                                    <path d="M43 56V70H57V56H43Z" fill="#E8B496" />
                                    <path d="M34 40C34 52 41 60 50 60C59 60 66 52 66 40C66 28 59 22 50 22C41 22 34 30 34 42Z" fill="#F0C3AA" />
                                    <path d="M32 32C32 20 40 14 50 14C68 20 68 32C68 35 63 24 50 24C37 24 32 35 32 32Z" fill="#0F172A" />
                                    <circle cx="44" cy="38" r="2.5" fill="#0F172A" />
                                    <circle cx="56" cy="38" r="2.5" fill="#0F172A" />
                                    <path d="M45 48C48 52 52 52 55 48" fill="#FFFFFF" stroke="#0F172A" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="hc-content">
                                <div class="hc-stars">★★★★★</div>
                                <p class="hc-quote">"Listing my business on Agent 24 India gave me immense exposure. I receive authentic client inquiries every single day!"</p>
                            </div>
                        </div>
                        <div class="hc-author">Rahul Mehta, Udaipur</div>
                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- Happy Customers Section End -->

    <!-- Dark Blue Metrics Stats Bar Section Start -->
    <section class="about-stats-bar-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 10px 24px 35px 24px;">
            <div class="dark-stats-card">
                
                <!-- Stat 1: 10,000+ Verified Agents -->
                <div class="dark-stat-col">
                    <div class="dark-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="dark-stat-text">
                        <span class="dark-stat-number">10,000+</span>
                        <span class="dark-stat-label">Verified Agents</span>
                    </div>
                </div>

                <div class="dark-stat-divider"></div>

                <!-- Stat 2: 500+ Cities Covered -->
                <div class="dark-stat-col">
                    <div class="dark-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div class="dark-stat-text">
                        <span class="dark-stat-number">500+</span>
                        <span class="dark-stat-label">Cities Covered</span>
                    </div>
                </div>

                <div class="dark-stat-divider"></div>

                <!-- Stat 3: 50+ Categories -->
                <div class="dark-stat-col">
                    <div class="dark-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </div>
                    <div class="dark-stat-text">
                        <span class="dark-stat-number">50+</span>
                        <span class="dark-stat-label">Categories</span>
                    </div>
                </div>

                <div class="dark-stat-divider"></div>

                <!-- Stat 4: 1L+ Happy Customers -->
                <div class="dark-stat-col">
                    <div class="dark-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                        </svg>
                    </div>
                    <div class="dark-stat-text">
                        <span class="dark-stat-number">1L+</span>
                        <span class="dark-stat-label">Happy Customers</span>
                    </div>
                </div>

                <div class="dark-stat-divider"></div>

                <!-- Stat 5: 24x7 Support Available -->
                <div class="dark-stat-col">
                    <div class="dark-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                        </svg>
                    </div>
                    <div class="dark-stat-text">
                        <span class="dark-stat-number">24x7</span>
                        <span class="dark-stat-label">Support Available</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Dark Blue Metrics Stats Bar Section End -->
@endsection
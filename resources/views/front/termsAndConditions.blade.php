@extends('front.layout.main')
@section('title', $pageTitle ?? 'Terms & Conditions')

@section('content')
    <!-- Terms & Conditions Main Content Area Start -->
    <main class="terms-page-main" id="termsMainContent">
        
        <!-- Terms Hero Banner Section Start -->
        <section class="terms-hero-banner-section">
            <div class="terms-hero-banner-container">
                <img src="{{ asset('public/front/assets/images/terms_hero_banner.png') }}" alt="Terms & Conditions - Agent 24 India" class="terms-hero-banner-img">
            </div>
        </section>
        <!-- Terms Hero Banner Section End -->

        <!-- Terms & Conditions Content Section Start -->
        <section class="terms-content-section">
            <div class="section-container" style="max-width: 1040px; margin: 0 auto; padding: 25px 24px 50px 24px;">
                
                <div class="terms-card">
                    
                    @if(!empty($termsAndConditions) && !empty($termsAndConditions->description))
                        <div class="terms-block">
                            <h2 class="terms-heading" style="text-align: center; margin-bottom: 20px;">{!! $termsAndConditions->title ?? 'Terms & Conditions' !!}</h2>
                            <div class="terms-text" style="line-height: 1.8; color: #334155;">
                                {!! $termsAndConditions->description !!}
                            </div>
                        </div>
                    @else
                        <!-- Default Sections from Prototype -->
                        <div class="terms-block">
                            <h2 class="terms-heading">1. सामान्य नियम</h2>
                            <p class="terms-text">
                                Agent 24 India एक ऑनलाइन प्लेटफॉर्म है जो Agents और Businesses को एक-दूसरे से जोड़ने का काम करता है। हम किसी भी प्रकार की सेवाएं प्रदान नहीं करते, केवल जानकारी उपलब्ध कराते हैं।
                            </p>
                        </div>

                        <div class="terms-block">
                            <h2 class="terms-heading">2. अकाउंट और जानकारी</h2>
                            <ul class="terms-list">
                                <li>यूजर को सही और सटीक जानकारी प्रदान करनी होगी।</li>
                                <li>गलत जानकारी देने पर अकाउंट सस्पेंड या बंद किया जा सकता है।</li>
                                <li>यूजर अपने अकाउंट की सुरक्षा के लिए स्वयं जिम्मेदार होगा।</li>
                            </ul>
                        </div>

                        <div class="terms-block">
                            <h2 class="terms-heading">3. भुगतान और रिफंड</h2>
                            <ul class="terms-list">
                                <li>सभी भुगतान हमारे द्वारा निर्धारित प्लान के अनुसार होंगे।</li>
                                <li>एक बार किया गया भुगतान नॉन-रिफंडेबल होगा।</li>
                                <li>प्लान और कीमतें बिना पूर्व सूचना के बदली जा सकती हैं।</li>
                            </ul>
                        </div>

                        <div class="terms-block">
                            <h2 class="terms-heading">4. लिस्टिंग और कंटेंट</h2>
                            <ul class="terms-list">
                                <li>सभी लिस्टिंग और कंटेंट की जिम्मेदारी यूजर की होगी।</li>
                                <li>हम किसी भी गलत, भ्रामक या अवैध कंटेंट के लिए जिम्मेदार नहीं हैं।</li>
                                <li>हम किसी भी समय किसी भी लिस्टिंग को हटाने का अधिकार रखते हैं।</li>
                            </ul>
                        </div>

                        <div class="terms-block">
                            <h2 class="terms-heading">5. दायित्व की सीमा</h2>
                            <p class="terms-text">
                                हम प्लेटफॉर्म पर उपलब्ध जानकारी की सत्यता की गारंटी नहीं देते। किसी भी प्रकार के नुकसान या विवाद के लिए Agent 24 India जिम्मेदार नहीं होगा।
                            </p>
                        </div>

                        <div class="terms-block">
                            <h2 class="terms-heading">6. नियमों में परिवर्तन</h2>
                            <p class="terms-text">
                                हम इन नियम और शर्तों को किसी भी समय बदल सकते हैं। बदलाव के बाद जो वेबसाइट पर अपडेट हो जाएंगे।
                            </p>
                        </div>

                        <div class="terms-block">
                            <h2 class="terms-heading">7. संपर्क</h2>
                            <p class="terms-text">
                                किसी भी प्रश्न के लिए कृपया हमसे संपर्क करें: <a href="mailto:support@agent24india.com" class="terms-email-link">support@agent24india.com</a>
                            </p>
                        </div>
                    @endif

                    <!-- Bottom Action Bar (Checkbox & I Agree Button) -->
                    <div class="terms-action-bar">
                        <label class="terms-checkbox-label">
                            <input type="checkbox" id="termsCheck" class="terms-checkbox" checked>
                            <span>मैंने नियम और शर्तों को पढ़ा और सहमति देता/देती हूँ।</span>
                        </label>
                        
                        <a href="{{ route('front.index') }}" class="btn-terms-agree">मैं सहमत हूँ</a>
                    </div>

                </div>

            </div>
        </section>
        <!-- Terms & Conditions Content Section End -->

        <!-- Dark Blue Metrics Stats Bar Section Start -->
        <section class="terms-stats-bar-section">
            <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px 35px 24px;">
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

    </main>
@endsection
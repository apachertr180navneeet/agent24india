@extends('front.layout.main')
@section('title', $pageTitle ?? 'Sahi Agent, Sahi Connection')

@push('styles')
<style>
    /* Ensure clean separation of mobile and desktop views */
    @media (min-width: 769px) {
        .mobile-only {
            display: none !important;
        }
        .desktop-only {
            display: block;
        }
    }
    @media (max-width: 768px) {
        .desktop-only {
            display: none !important;
        }
        .mobile-only {
            display: block;
        }
    }

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

    /* Mobile How It Works Styles matching Screenshot */
    .m-steps-flow {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 2px;
        background-color: #FFFFFF;
        border: 1.5px solid #E2E8F0;
        border-radius: 16px;
        padding: 16px 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }
    .m-step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex: 1;
    }
    .m-step-badge {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
    }
    .m-step-badge.step-1 { background-color: #004BEE; }
    .m-step-badge.step-2 { background-color: #F97316; }
    .m-step-badge.step-3 { background-color: #16A34A; }
    .m-step-badge.step-4 { background-color: #9333EA; }

    .m-step-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
    }
    .bg-blue-light   { background-color: #EFF6FF; }
    .bg-orange-light { background-color: #FFF7ED; }
    .bg-green-light  { background-color: #F0FDF4; }
    .bg-purple-light { background-color: #FAF5FF; }

    .m-step-text {
        font-size: 10.5px;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.25;
        text-align: center;
    }
    .m-step-arrow {
        color: #94A3B8;
        font-size: 13px;
        margin-top: 32px;
        font-weight: 700;
    }

    /* Mobile Top Verified Agents Slider Styles */
    .m-top-agents-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }
    .m-top-agents-title {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        margin: 0;
    }
    .m-top-agents-link {
        font-size: 13.5px;
        font-weight: 700;
        color: #004BEE;
        text-decoration: none;
    }
    .m-agent-carousel-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        width: 100%;
    }
    .m-carousel-arrow {
        background-color: #FFFFFF;
        border: 1.5px solid #CBD5E1;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        transition: all 0.2s ease;
        padding: 0;
        z-index: 5;
    }
    .m-carousel-arrow:active {
        transform: scale(0.92);
        background-color: #F1F5F9;
    }
    .m-agent-slider-track {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        gap: 12px;
        flex: 1;
        min-width: 0;
        -ms-overflow-style: none;
        scrollbar-width: none;
        padding: 4px 2px;
    }
    .m-agent-slider-track::-webkit-scrollbar {
        display: none;
    }
    .m-agent-slide-card {
        flex: 0 0 100%;
        min-width: 100%;
        scroll-snap-align: center;
        background-color: #FFFFFF;
        border: 1.5px solid #E2E8F0;
        border-radius: 16px;
        padding: 16px 14px 14px 14px;
        position: relative;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
    }
    .m-verified-pill {
        position: absolute;
        top: 0;
        left: 0;
        background-color: #16A34A;
        color: #FFFFFF;
        font-size: 8.5px;
        font-weight: 800;
        padding: 3px 8px;
        border-top-left-radius: 14px;
        border-bottom-right-radius: 8px;
        line-height: 1.2;
        letter-spacing: 0.3px;
        z-index: 2;
    }
    .m-agent-card-body {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-top: 4px;
    }
    .m-agent-avatar-wrap {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        border: 2px solid #E2E8F0;
    }
    .m-agent-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .m-agent-info-wrap {
        flex: 1;
        min-width: 0;
    }
    .m-agent-card-name {
        font-size: 15px;
        font-weight: 800;
        color: #0F172A;
        margin: 0 0 2px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .m-agent-card-type {
        display: block;
        font-size: 11.5px;
        color: #475569;
        margin-bottom: 2px;
    }
    .m-agent-card-loc {
        display: block;
        font-size: 11.5px;
        color: #64748B;
        margin-bottom: 4px;
    }
    .m-agent-card-stars {
        font-size: 11.5px;
        color: #F59E0B;
    }
    .m-star-score {
        font-weight: 800;
        color: #0F172A;
        margin-left: 2px;
    }
    .m-star-count {
        color: #64748B;
    }
    .m-agent-card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid #F1F5F9;
    }
    .m-btn-view-profile {
        border: 1.5px solid #CBD5E1;
        background-color: #FFFFFF;
        color: #0F172A;
        font-size: 13px;
        font-weight: 700;
        border-radius: 8px;
        padding: 8px 0;
        text-align: center;
        text-decoration: none;
        display: block;
    }
    .m-btn-call-now {
        background-color: #004BEE;
        color: #FFFFFF;
        font-size: 13px;
        font-weight: 700;
        border-radius: 8px;
        padding: 8px 0;
        text-align: center;
        text-decoration: none;
        display: block;
    }
</style>
@endpush

@section('content')

<!-- =========================================================================
     MOBILE ONLY HOME PAGE SECTION (Matches agent2 mobile screenshot design)
     ========================================================================= -->
<div class="mobile-home-wrapper mobile-only">
    
    <!-- Mobile Hero Header Section -->
    <section class="m-hero-section">
        <div class="m-hero-badge">India's Most Trusted Platform</div>
        
        <h1 class="m-hero-headline">
            काम कोई भी हो...<br>
            <span class="m-hero-blue-text">सही AGENT</span><br>
            यहीं मिलेगा!
        </h1>
        
        <p class="m-hero-subtext">
            अपने शहर / जिले में अपनी जरूरत के अनुसार<br>
            <strong>Agent</strong> खोजें और सीधे संपर्क करें
        </p>

        <!-- Mobile Hero Phone Illustration -->
        <div class="m-hero-illustration-box">
            <svg width="100%" height="200" viewBox="0 0 340 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Soft Glow -->
                <circle cx="240" cy="100" r="90" fill="#E0EDFF" opacity="0.6"/>
                
                <!-- City Skyline Backdrop -->
                <path d="M10 175H330V195H10V175Z" fill="#CBD5E1"/>
                <path d="M20 175V125H45V175H20Z" fill="#94A3B8" opacity="0.5"/>
                <path d="M50 175V105H80V175H50Z" fill="#94A3B8" opacity="0.4"/>
                <path d="M85 175V135H110V175H85Z" fill="#94A3B8" opacity="0.6"/>
                <path d="M115 175V95H150V175H115Z" fill="#94A3B8" opacity="0.3"/>
                <path d="M155 175V115H185V175H155Z" fill="#94A3B8" opacity="0.5"/>
                <path d="M190 175V85H230V175H190Z" fill="#94A3B8" opacity="0.4"/>
                <path d="M235 175V130H265V175H235Z" fill="#94A3B8" opacity="0.6"/>
                <path d="M270 175V110H300V175H270Z" fill="#94A3B8" opacity="0.5"/>

                <!-- Angled Smartphone Container -->
                <g transform="translate(130, 20) rotate(-12) scale(0.82)">
                    <rect x="0" y="0" width="140" height="225" rx="22" fill="#0F172A"/>
                    <rect x="4" y="4" width="132" height="217" rx="18" fill="#1E293B"/>
                    <rect x="8" y="14" width="124" height="197" rx="14" fill="#FFFFFF"/>
                    <path d="M8 50H132M8 90H132M8 130H132M8 170H132" stroke="#F1F5F9" stroke-width="2"/>
                    <path d="M40 14V211M80 14V211M110 14V211" stroke="#F1F5F9" stroke-width="2"/>
                    <path d="M8 80C50 80 60 120 132 120" stroke="#DBEAFE" stroke-width="8" stroke-linecap="round"/>
                    <path d="M45 14V211" stroke="#E2E8F0" stroke-width="6"/>
                    <circle cx="35" cy="65" r="5" fill="#22C55E"/>
                    <circle cx="105" cy="150" r="5" fill="#F97316"/>
                    <circle cx="85" cy="180" r="5" fill="#A855F7"/>
                </g>

                <!-- Prominent 3D Blue Pin Floating -->
                <g transform="translate(180, 10)">
                    <ellipse cx="32" cy="92" rx="20" ry="6" fill="#000000" opacity="0.15"/>
                    <path d="M32 10C16 10 4 22 4 38C4 62 32 90 32 90C32 90 60 62 60 38C60 22 48 10 32 10Z" fill="url(#pin_blue_grad)" stroke="#FFFFFF" stroke-width="2"/>
                    <circle cx="32" cy="38" r="16" fill="#FFFFFF"/>
                    <path d="M32 30A5 5 0 1 0 32 40A5 5 0 1 0 32 30Z" fill="#004BEE"/>
                    <path d="M24 48C24 43.5 27.5 41 32 41C36.5 41 40 43.5 40 48" fill="#004BEE"/>
                </g>

                <defs>
                    <linearGradient id="pin_blue_grad" x1="4" y1="10" x2="60" y2="90" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#0066FF"/>
                        <stop offset="1" stop-color="#0038A8"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <!-- Trust Badges Row -->
        <div class="m-trust-row">
            <div class="m-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="#004BEE"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                <span>Verified Agents</span>
            </div>
            <div class="m-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="#004BEE"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                <span>Secure & Safe</span>
            </div>
            <div class="m-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="#16A34A"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                <span>100% Trusted</span>
            </div>
        </div>
    </section>

    <!-- Mobile Search Card -->
    <section class="m-search-card-section">
        <div class="m-search-card">
            <h2 class="m-search-card-title">अपनी जरूरत का Agent खोजें</h2>

            <form action="{{ route('front.vendorlist') }}" method="GET">
                <!-- Field 1 -->
                <div class="m-field-group">
                    <label class="m-field-label">आप क्या खोज रहे हैं?</label>
                    <div class="m-input-wrap">
                        <input type="text" name="search" class="m-input-text" placeholder="जैसे: Real Estate Agent" value="{{ request('search') }}">
                        <svg class="m-field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                </div>

                <!-- Field 2 -->
                <div class="m-field-group">
                    <label class="m-field-label">शहर / जिला चुनें</label>
                    <div class="m-input-wrap">
                        <select name="district" class="m-select-box">
                            <option value="">अपना शहर / जिला चुनें</option>
                            @if(isset($district))
                                @foreach($district as $d)
                                    <option value="{{ $d->id }}" {{ request('district') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            @else
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jodhpur">Jodhpur</option>
                                <option value="Udaipur">Udaipur</option>
                                <option value="Kota">Kota</option>
                            @endif
                        </select>
                        <svg class="m-field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    </div>
                </div>

                <!-- Field 3 -->
                <div class="m-field-group">
                    <label class="m-field-label">कैटेगरी चुनें</label>
                    <div class="m-input-wrap">
                        <select name="category" class="m-select-box">
                            <option value="">सभी कैटेगरी</option>
                            @if(isset($category))
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            @else
                                <option value="real_estate">Real Estate Agent</option>
                                <option value="automobile">Automobile Agent</option>
                                <option value="rto">RTO Agent</option>
                                <option value="insurance">Insurance Agent</option>
                                <option value="finance">Financial Advisor</option>
                            @endif
                        </select>
                        <svg class="m-field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0F172A" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
                    </div>
                </div>

                <!-- Search Agent Button -->
                <button type="submit" class="m-btn-submit-search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <span>Agent खोजें</span>
                </button>
            </form>
        </div>
    </section>

    <!-- Mobile Stats Bar -->
    <section class="m-stats-section">
        <div class="m-stats-grid">
            <div class="m-stat-box">
                <div class="m-stat-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <span class="m-stat-val">10,000+</span>
                <span class="m-stat-lbl">Verified<br>Agents</span>
            </div>
            <div class="m-stat-box">
                <div class="m-stat-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <span class="m-stat-val">500+</span>
                <span class="m-stat-lbl">Cities<br>Covered</span>
            </div>
            <div class="m-stat-box">
                <div class="m-stat-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </div>
                <span class="m-stat-val">50+</span>
                <span class="m-stat-lbl">Categories</span>
            </div>
            <div class="m-stat-box">
                <div class="m-stat-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                </div>
                <span class="m-stat-val">1L+</span>
                <span class="m-stat-lbl">Happy<br>Customers</span>
            </div>
        </div>
    </section>

    <!-- Mobile Popular Categories Section -->
    <section class="m-popular-cat-section">
        <div class="m-pop-cat-header">
            <h2 class="m-pop-cat-title">लोकप्रिय कैटेगरी</h2>
            <a href="{{ route('front.vendorlist') }}" class="m-pop-cat-link">सभी देखें &rarr;</a>
        </div>
        <div class="m-pop-cat-grid">
            <!-- Card 1 -->
            <a href="{{ route('front.vendorlist') }}?search=Real+Estate" class="m-cat-card">
                <div class="m-cat-icon-container bg-orange">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </div>
                <span class="m-cat-label">Real Estate<br>Agent</span>
            </a>
            <!-- Card 2 -->
            <a href="{{ route('front.vendorlist') }}?search=Automobile" class="m-cat-card">
                <div class="m-cat-icon-container bg-blue">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle></svg>
                </div>
                <span class="m-cat-label">Automobile<br>Agent</span>
            </a>
            <!-- Card 3 -->
            <a href="{{ route('front.vendorlist') }}?search=RTO" class="m-cat-card">
                <div class="m-cat-icon-container bg-green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                </div>
                <span class="m-cat-label">RTO<br>Agent</span>
            </a>
            <!-- Card 4 -->
            <a href="{{ route('front.vendorlist') }}?search=Insurance" class="m-cat-card">
                <div class="m-cat-icon-container bg-purple">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333EA" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
                </div>
                <span class="m-cat-label">Insurance<br>Agent</span>
            </a>
            <!-- Card 5 -->
            <a href="{{ route('front.vendorlist') }}?search=Finance" class="m-cat-card">
                <div class="m-cat-icon-container bg-rupee">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#EA580C" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M8 9h8M8 15h6"></path></svg>
                </div>
                <span class="m-cat-label">Finance<br>Agent</span>
            </a>
            <!-- Card 6 -->
            <a href="{{ route('front.vendorlist') }}?search=Legal" class="m-cat-card">
                <div class="m-cat-icon-container bg-scale">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2"><path d="M12 3v18M3 7l9-4 9 4M5 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7M15 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7"></path></svg>
                </div>
                <span class="m-cat-label">Legal<br>Agent</span>
            </a>
            <!-- Card 7 -->
            <a href="{{ route('front.vendorlist') }}?search=Transport" class="m-cat-card">
                <div class="m-cat-icon-container bg-truck">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                </div>
                <span class="m-cat-label">Transport<br>Agent</span>
            </a>
            <!-- Card 8 -->
            <a href="{{ route('front.vendorlist') }}" class="m-cat-card">
                <div class="m-cat-icon-container bg-dots">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><circle cx="19" cy="12" r="2"></circle><circle cx="5" cy="12" r="2"></circle></svg>
                </div>
                <span class="m-cat-label">और भी<br>बहुत कुछ</span>
            </a>
        </div>
    </section>

    <!-- Mobile Why Choose Agent 24 Section -->
    <section class="m-why-choose-section">
        <div class="m-why-choose-card">
            <div class="m-why-header">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                <h3 class="m-why-title">Agent 24 India क्यों चुनें?</h3>
            </div>
            
            <div class="m-why-list">
                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">100% Verified & Trusted Agents</h4>
                        <p class="m-why-item-desc">हर Agent की जांच के बाद ही Listing</p>
                    </div>
                </div>

                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">Direct Contact With Agent</h4>
                        <p class="m-why-item-desc">बीच में कोई Third Party नहीं</p>
                    </div>
                </div>

                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">Sahi Jankari, Sahi Faisla</h4>
                        <p class="m-why-item-desc">पूरी जानकारी के साथ सही Agent चुनें</p>
                    </div>
                </div>

                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M8 9h8M8 15h6"></path></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">Save Time & Money</h4>
                        <p class="m-why-item-desc">सही Agent से समय और पैसे की बचत</p>
                    </div>
                </div>

                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">24x7 Support Team</h4>
                        <p class="m-why-item-desc">हमेशा आपकी मदद के लिए तैयार</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile How It Works 4-Step Flow -->
    <section class="m-how-it-works-section">
        <div class="m-how-header">
            <span class="m-line"></span>
            <h2 class="m-how-title">Agent कैसे खोजें?</h2>
            <span class="m-line"></span>
        </div>

        <div class="m-steps-flow">
            <div class="m-step-item">
                <span class="m-step-badge step-1">1</span>
                <div class="m-step-icon-box bg-blue-light">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <span class="m-step-text">अपनी जरूरत बताएं</span>
            </div>

            <span class="m-step-arrow">&rarr;</span>

            <div class="m-step-item">
                <span class="m-step-badge step-2">2</span>
                <div class="m-step-icon-box bg-orange-light">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2.5"><rect x="3" y="4" width="18" height="16" rx="2"></rect><circle cx="9" cy="10" r="2.5"></circle><path d="M15 8h2M15 12h2M7 16h10"></path></svg>
                </div>
                <span class="m-step-text">Best Agents देखें</span>
            </div>

            <span class="m-step-arrow">&rarr;</span>

            <div class="m-step-item">
                <span class="m-step-badge step-3">3</span>
                <div class="m-step-icon-box bg-green-light">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </div>
                <span class="m-step-text">सीधा संपर्क करें</span>
            </div>

            <span class="m-step-arrow">&rarr;</span>

            <div class="m-step-item">
                <span class="m-step-badge step-4">4</span>
                <div class="m-step-icon-box bg-purple-light">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9333EA" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                </div>
                <span class="m-step-text">काम शुरू करें</span>
            </div>
        </div>
    </section>

    <!-- Mobile Top Verified Agents Carousel Section -->
    <section class="m-top-agents-section">
        <div class="m-top-agents-header">
            <h2 class="m-top-agents-title">Top Verified Agents</h2>
            <a href="{{ route('front.vendorlist') }}" class="m-top-agents-link">सभी देखें &rarr;</a>
        </div>

        <div class="m-agent-carousel-wrapper">
            <button type="button" class="m-carousel-arrow left" id="mAgentPrevBtn" aria-label="Previous Agent">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            
            <div class="m-agent-slider-track" id="mAgentSliderTrack">
                @if(isset($vendoruser) && count($vendoruser) > 0)
                    @foreach($vendoruser as $vendor)
                        <div class="m-agent-slide-card">
                            <span class="m-verified-pill">&#10004; VERIFIED</span>
                            <div class="m-agent-card-body">
                                <div class="m-agent-avatar-wrap">
                                    <img src="{{ !empty($vendor->profile_image) ? asset($vendor->profile_image) : asset('front/assets/images/agent_sharma.jpg') }}" alt="{{ $vendor->name }}" class="m-agent-avatar-img">
                                </div>
                                <div class="m-agent-info-wrap">
                                    <h3 class="m-agent-card-name">{{ $vendor->company_name ?? $vendor->name }}</h3>
                                    <span class="m-agent-card-type">{{ $vendor->category->name ?? 'Real Estate Agent' }}</span>
                                    <span class="m-agent-card-loc">{{ $vendor->district->name ?? 'Jaipur' }}, Rajasthan</span>
                                    <div class="m-agent-card-stars">
                                        <span class="stars-gold">★★★★★</span> <span class="m-star-score">4.8</span> <span class="m-star-count">(120)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="m-agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}?search={{ urlencode($vendor->name ?? '') }}" class="m-btn-view-profile">View Profile</a>
                                <a href="tel:{{ $vendor->phone ?? '+919876543210' }}" class="m-btn-call-now">Call Now</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="m-agent-slide-card">
                        <span class="m-verified-pill">&#10004; VERIFIED</span>
                        <div class="m-agent-card-body">
                            <div class="m-agent-avatar-wrap">
                                <img src="{{ asset('front/assets/images/agent_sharma.jpg') }}" alt="Sharma Property Consultant" class="m-agent-avatar-img">
                            </div>
                            <div class="m-agent-info-wrap">
                                <h3 class="m-agent-card-name">Sharma Property Consultant</h3>
                                <span class="m-agent-card-type">Real Estate Agent</span>
                                <span class="m-agent-card-loc">Jaipur, Rajasthan</span>
                                <div class="m-agent-card-stars">
                                    <span class="stars-gold">★★★★★</span> <span class="m-star-score">4.8</span> <span class="m-star-count">(120)</span>
                                </div>
                            </div>
                        </div>

                        <div class="m-agent-card-actions">
                            <a href="{{ route('front.vendorlist') }}" class="m-btn-view-profile">View Profile</a>
                            <a href="tel:+919876543210" class="m-btn-call-now">Call Now</a>
                        </div>
                    </div>

                    <div class="m-agent-slide-card">
                        <span class="m-verified-pill">&#10004; VERIFIED</span>
                        <div class="m-agent-card-body">
                            <div class="m-agent-avatar-wrap">
                                <img src="{{ asset('front/assets/images/agent_krishna.jpg') }}" alt="Krishna Motors" class="m-agent-avatar-img">
                            </div>
                            <div class="m-agent-info-wrap">
                                <h3 class="m-agent-card-name">Krishna Motors</h3>
                                <span class="m-agent-card-type">Automobile Agent</span>
                                <span class="m-agent-card-loc">Jodhpur, Rajasthan</span>
                                <div class="m-agent-card-stars">
                                    <span class="stars-gold">★★★★★</span> <span class="m-star-score">4.7</span> <span class="m-star-count">(98)</span>
                                </div>
                            </div>
                        </div>

                        <div class="m-agent-card-actions">
                            <a href="{{ route('front.vendorlist') }}" class="m-btn-view-profile">View Profile</a>
                            <a href="tel:+919876543211" class="m-btn-call-now">Call Now</a>
                        </div>
                    </div>

                    <div class="m-agent-slide-card">
                        <span class="m-verified-pill">&#10004; VERIFIED</span>
                        <div class="m-agent-card-body">
                            <div class="m-agent-avatar-wrap">
                                <img src="{{ asset('front/assets/images/agent_rto.jpg') }}" alt="RTO Solution Point" class="m-agent-avatar-img">
                            </div>
                            <div class="m-agent-info-wrap">
                                <h3 class="m-agent-card-name">RTO Solution Point</h3>
                                <span class="m-agent-card-type">RTO Agent</span>
                                <span class="m-agent-card-loc">Ajmer, Rajasthan</span>
                                <div class="m-agent-card-stars">
                                    <span class="stars-gold">★★★★★</span> <span class="m-star-score">4.9</span> <span class="m-star-count">(155)</span>
                                </div>
                            </div>
                        </div>

                        <div class="m-agent-card-actions">
                            <a href="{{ route('front.vendorlist') }}" class="m-btn-view-profile">View Profile</a>
                            <a href="tel:+919876543212" class="m-btn-call-now">Call Now</a>
                        </div>
                    </div>
                @endif
            </div>

            <button type="button" class="m-carousel-arrow right" id="mAgentNextBtn" aria-label="Next Agent">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </div>
    </section>

    <!-- Mobile District Cards Grid Section -->
    <section class="m-district-section">
        <div class="m-district-header">
            <h2 class="m-district-title">Rajasthan के Capital District</h2>
            <a href="{{ route('front.vendorlist') }}" class="m-district-link">सभी जिले देखें &rarr;</a>
        </div>

        <div class="m-district-grid">
            <a href="{{ route('front.vendorlist') }}?search=Jaipur" class="m-district-card">
                <img src="{{ asset('front/assets/images/jal-mahal-jaipur-9175.jpg') }}" alt="Jaipur" class="m-district-img">
                <div class="m-district-info">
                    <h3 class="m-district-name">Jaipur</h3>
                    <span class="m-district-agents">12,500+ Agents</span>
                </div>
            </a>

            <a href="{{ route('front.vendorlist') }}?search=Jodhpur" class="m-district-card">
                <img src="{{ asset('front/assets/images/jodhpur.jpg') }}" alt="Jodhpur" class="m-district-img">
                <div class="m-district-info">
                    <h3 class="m-district-name">Jodhpur</h3>
                    <span class="m-district-agents">8,200+ Agents</span>
                </div>
            </a>
        </div>

        <div class="m-district-btn-wrap">
            <a href="{{ route('front.vendorlist') }}" class="m-btn-see-all-districts">सभी जिले देखें &rarr;</a>
        </div>
    </section>

    <!-- Mobile Join As Agent CTA Banner Section -->
    <section class="m-agent-cta-section">
        <div class="m-agent-cta-card">
            <div class="m-agent-cta-body">
                <div class="m-agent-cta-text">
                    <h2 class="m-cta-title">क्या आप भी Agent हैं?</h2>
                    <p class="m-cta-subtext">
                        अपनी Profile बनाएं, अपनी Services Promote करें और नए Customers तक पहुँचें।
                    </p>

                    <div class="m-cta-checklist">
                        <div class="m-check-item">
                            <span class="m-check-icon">&#10004;</span>
                            <span>Free Listing Option</span>
                        </div>
                        <div class="m-check-item">
                            <span class="m-check-icon">&#10004;</span>
                            <span>Affordable Paid Plans</span>
                        </div>
                        <div class="m-check-item">
                            <span class="m-check-icon">&#10004;</span>
                            <span>All India Visibility</span>
                        </div>
                        <div class="m-check-item">
                            <span class="m-check-icon">&#10004;</span>
                            <span>Business Growth</span>
                        </div>
                    </div>

                    <div class="m-cta-btn-wrap">
                        <a href="{{ route('front.register') }}" class="m-btn-register-agent">Register As Agent &rarr;</a>
                    </div>
                </div>

                <div class="m-agent-cta-graphic">
                    <img src="{{ asset('front/assets/images/login_hero_banner.png') }}" alt="Agent Dashboard App" class="m-cta-phone-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile Why Best Feature List Section -->
    <section class="m-why-best-section">
        <h2 class="m-why-best-title">हम क्यों हैं सबसे बेहतर?</h2>

        <div class="m-why-best-list">
            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="#004BEE"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">Trusted Platform</h3>
                    <p class="m-best-item-desc">भारत का भरोसेमंद Agent Directory</p>
                </div>
            </div>

            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">Safe & Secure</h3>
                    <p class="m-best-item-desc">आपकी जानकारी 100% सुरक्षित</p>
                </div>
            </div>

            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">All India Network</h3>
                    <p class="m-best-item-desc">हर शहर, हर जिला, आपके साथ</p>
                </div>
            </div>

            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">Affordable Plans</h3>
                    <p class="m-best-item-desc">हर Agent के लिए Best Plans</p>
                </div>
            </div>

            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2.2"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.45 1-1 1H7v4h10v-4h-2c-.55 0-1-.45-1-1v-2.34"></path><path d="M18 4H6v7a6 6 0 0 0 12 0V4z"></path></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">Grow Your Business</h3>
                    <p class="m-best-item-desc">ज्यादा Visibility, ज्यादा Customers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile Metrics Light Blue Card -->
    <section class="m-metrics-summary-section">
        <div class="m-metrics-box">
            <div class="m-metric-col">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                <span class="m-mval">10,000+</span>
                <span class="m-mlbl">Verified Agents</span>
            </div>
            <div class="m-metric-col">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span class="m-mval">500+</span>
                <span class="m-mlbl">Cities Covered</span>
            </div>
            <div class="m-metric-col">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <span class="m-mval">50+</span>
                <span class="m-mlbl">Categories</span>
            </div>
            <div class="m-metric-col">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path></svg>
                <span class="m-mval">24x7</span>
                <span class="m-mlbl">Support</span>
            </div>
        </div>
    </section>

    <!-- Mobile About Us Section -->
    <section class="m-about-section">
        <h2 class="m-about-title">हमारे बारे में</h2>
        <p class="m-about-text">
            Agent 24 India एक ऐसा Platform है जो Agents और Businesses को एक साथ जोड़ता है। हमारा मिशन है - सही Agent को सही Customers तक पहुँचाना और Business Growth को आसान बनाना।
        </p>
        <a href="{{ route('front.aboutus') }}" class="m-btn-about-more">और पढ़ें &rarr;</a>
    </section>

    <!-- Mobile Newsletter Box Section -->
    <section class="m-newsletter-section">
        <div class="m-newsletter-card">
            <h2 class="m-news-title">हमसे जुड़े रहें</h2>
            <p class="m-news-subtext">नए अपडेट और ऑफर्स के लिए हमारे साथ जुड़ें।</p>

            <form class="m-news-form" onsubmit="event.preventDefault(); alert('Subscribed successfully!');">
                <input type="email" class="m-news-input" placeholder="अपना Email Address" required>
                <button type="submit" class="m-news-btn" aria-label="Subscribe">&rarr;</button>
            </form>
        </div>
    </section>

</div>

<!-- =========================================================================
     DESKTOP ONLY HOME PAGE SECTIONS (Matches agent2 desktop design)
     ========================================================================= -->

<!-- Main Hero Banner Section Start (DESKTOP ONLY) -->
<section class="index-hero-banner-section desktop-only">
    <div class="index-hero-banner-container">
        <img src="{{ asset('front/assets/images/index_hero_banner.png') }}" alt="काम कोई भी हो... Agent Sahi Yahi Milega! - Agent 24 India" class="index-hero-banner-img">
    </div>
</section>
<!-- Main Hero Banner Section End -->

<!-- Search & Features Section Start -->
<section class="index-search-section desktop-only">
    <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px;">
        <!-- Overlapping Dark Blue Search Card -->
        <div class="search-card-container">
            <div class="search-card-header">
                <svg class="search-title-icon" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <span>आपको किस काम के लिए Agent चाहिए?</span>
            </div>

            <form class="search-card-form" id="agentSearchForm" action="{{ route('front.vendorlist') }}" method="GET">
                <div class="form-grid">

                    <!-- Input 1: Aap kya khoj rahe hain -->
                    <div class="form-field">
                        <label class="field-label">आप क्या खोज रहे हैं?</label>
                        <div class="input-with-icon">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <input type="text" name="search" class="custom-input" placeholder="Search by name, service or keyword" value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Input 2: Aapka shahar / jila chunen -->
                    <div class="form-field">
                        <label class="field-label">आपका शहर / जिला चुनें</label>
                        <div class="input-with-icon">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <select class="custom-select" name="district" id="cityInput">
                                <option value="">Select City / District</option>
                                @if(isset($district))
                                    @foreach($district as $d)
                                        <option value="{{ $d->id }}" {{ request('district') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                    @endforeach
                                @else
                                    <option value="Jaipur">Jaipur, Rajasthan</option>
                                    <option value="Jodhpur">Jodhpur, Rajasthan</option>
                                    <option value="Udaipur">Udaipur, Rajasthan</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Input 3: Category chunen -->
                    <div class="form-field">
                        <label class="field-label">Category चुनें</label>
                        <div class="input-with-icon">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            <select class="custom-select" name="category" id="categorySelect">
                                <option value="">All Categories</option>
                                @if(isset($category))
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                @else
                                    <option value="property">Property & Housing</option>
                                    <option value="loans">Loans & Finance</option>
                                    <option value="life_insurance">Life & Health Insurance</option>
                                    <option value="tour">Tours & Visas</option>
                                    <option value="law">Law & Registration</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="form-field btn-field">
                        <button type="submit" class="btn-search-agent" id="searchAgentBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <span>Agent खोजें</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <!-- Bottom Stats Metrics Bar -->
        <div class="hero-stats-bar">
            <div class="stat-item">
                <div class="stat-icon-wrapper">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
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

            <div class="stat-divider"></div>

            <div class="stat-item">
                <div class="stat-icon-wrapper">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path>
                    </svg>
                </div>
                <div class="stat-text-group">
                    <span class="stat-number">24x7</span>
                    <span class="stat-label">Support</span>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Main Hero Banner Section End -->

<!-- Popular Categories Section Start -->
<section class="categories-section desktop-only">
    <div class="section-container">

        <!-- Section Header -->
        <div class="section-header">
            <span class="header-line"></span>
            <h2 class="section-title">लोकप्रिय Categories</h2>
            <span class="header-line"></span>
        </div>

        <!-- Categories Grid -->
        <div class="categories-grid">

            <!-- Card 1: Real Estate -->
            <a href="{{ route('front.vendorlist') }}?search=Real+Estate" class="category-card">
                <div class="category-icon-box icon-orange">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </div>
                <h3 class="category-title">Real Estate Agent</h3>
                <p class="category-subtitle">Buy / Sell / Rent</p>
            </a>

            <!-- Card 2: Automobile -->
            <a href="{{ route('front.vendorlist') }}?search=Automobile" class="category-card">
                <div class="category-icon-box icon-blue">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <circle cx="17" cy="17" r="2"></circle>
                    </svg>
                </div>
                <h3 class="category-title">Automobile Agent</h3>
                <p class="category-subtitle">Car, Bike & More</p>
            </a>

            <!-- Card 3: RTO Agent -->
            <a href="{{ route('front.vendorlist') }}?search=RTO" class="category-card">
                <div class="category-icon-box icon-green">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
                <h3 class="category-title">RTO Agent</h3>
                <p class="category-subtitle">RTO Related Services</p>
            </a>

            <!-- Card 4: Insurance Agent -->
            <a href="{{ route('front.vendorlist') }}?search=Insurance" class="category-card">
                <div class="category-icon-box icon-purple">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9333EA" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="M9 12l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="category-title">Insurance Agent</h3>
                <p class="category-subtitle">Life, Health, General</p>
            </a>

            <!-- Card 5: Finance Agent -->
            <a href="{{ route('front.vendorlist') }}?search=Finance" class="category-card">
                <div class="category-icon-box icon-rupee">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#EA580C" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v12M8 9h8M8 15h6"></path>
                    </svg>
                </div>
                <h3 class="category-title">Finance Agent</h3>
                <p class="category-subtitle">Loan & Finance</p>
            </a>

            <!-- Card 6: Legal Agent -->
            <a href="{{ route('front.vendorlist') }}?search=Legal" class="category-card">
                <div class="category-icon-box icon-scale">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3v18M3 7l9-4 9 4M5 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7M15 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7"></path>
                    </svg>
                </div>
                <h3 class="category-title">Legal Agent</h3>
                <p class="category-subtitle">All Legal Services</p>
            </a>

            <!-- Card 7: Transport Agent -->
            <a href="{{ route('front.vendorlist') }}?search=Transport" class="category-card">
                <div class="category-icon-box icon-red">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                </div>
                <h3 class="category-title">Transport Agent</h3>
                <p class="category-subtitle">Transport & Logistics</p>
            </a>

            <!-- Card 8: More Categories -->
            <a href="{{ route('front.vendorlist') }}" class="category-card card-more">
                <div class="category-icon-box icon-dots">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"></circle>
                        <circle cx="8" cy="12" r="1" fill="#2563EB"></circle>
                        <circle cx="12" cy="12" r="1" fill="#2563EB"></circle>
                        <circle cx="16" cy="12" r="1" fill="#2563EB"></circle>
                    </svg>
                </div>
                <h3 class="category-title">और भी बहुत कुछ</h3>
                <p class="category-subtitle highlight-subtitle">18+ Categories</p>
            </a>

        </div>

        <!-- View All Categories Button -->
        <div class="view-all-wrapper">
            <a href="{{ route('front.vendorlist') }}" class="btn-view-all">
                <span>सभी Categories देखें</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

    </div>
</section>
<!-- Popular Categories Section End -->

<!-- Why Choose Agent 24 India Banner Section Start -->
<section class="why-choose-section desktop-only">
    <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px;">
        
        <div class="custom-why-choose-banner">
            <!-- Top Center Title Header -->
            <div class="custom-why-header">
                <span class="custom-why-line"></span>
                <h2 class="custom-why-title">Agent 24 India क्यों चुनें?</h2>
                <span class="custom-why-line"></span>
            </div>

            <!-- Main Content Row -->
            <div class="custom-why-main-row">
                
                <!-- 5 Feature Columns Group -->
                <div class="custom-why-features-grid">
                    
                    <!-- Feature 1 -->
                    <div class="custom-why-col">
                        <div class="custom-why-icon-wrap">
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                <path d="M22 9L12 13.5V21C12 27.6 16.3 33.7 22 35C27.7 33.7 32 27.6 32 21V13.5L22 9Z" fill="#004BEE" stroke="#FFFFFF" stroke-width="1.5"/>
                                <path d="M17.5 21L20.5 24L26.5 18" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="custom-why-text">
                            <h3 class="custom-why-head">100% Verified & Trusted</h3>
                            <p class="custom-why-sub">हर Agent की जांच के बाद ही Listing</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="custom-why-col">
                        <div class="custom-why-icon-wrap">
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                <path d="M26 27V25.5C26 23.5 23.5 22 20.5 22C17.5 22 15 23.5 15 25.5V27" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="20.5" cy="16.5" r="3.5" stroke="#FFFFFF" stroke-width="2"/>
                                <path d="M30 27V25.5C30 24.2 28.8 23 27 22.4" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                <path d="M26 13.2C27.8 13.8 29 15.3 29 16.5" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="custom-why-text">
                            <h3 class="custom-why-head">Direct Contact With Agent</h3>
                            <p class="custom-why-sub">बीच में कोई Third Party नहीं</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="custom-why-col">
                        <div class="custom-why-icon-wrap">
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                <path d="M26 12H15C13.9 12 13 12.9 13 14V30C13 31.1 13.9 32 15 32H27C28.1 32 29 31.1 29 30V15L26 12Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 20H25M17 24H25M17 28H21" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="custom-why-text">
                            <h3 class="custom-why-head">Sahi Jankari, Sahi Faisla</h3>
                            <p class="custom-why-sub">सही जानकारी के साथ सही Agent चुनें</p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="custom-why-col">
                        <div class="custom-why-icon-wrap">
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                <circle cx="22" cy="22" r="10" stroke="#FFFFFF" stroke-width="2"/>
                                <path d="M22 16V28M19 19H25M19 23H24" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="custom-why-text">
                            <h3 class="custom-why-head">Save Time & Money</h3>
                            <p class="custom-why-sub">सही Agent से काम, समय और पैसों की बचत</p>
                        </div>
                    </div>

                    <!-- Feature 5 -->
                    <div class="custom-why-col last-col">
                        <div class="custom-why-icon-wrap">
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                <path d="M14 27V22C14 17.6 17.6 14 22 14C26.4 14 30 17.6 30 22V27" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                <rect x="12" y="24" width="4" height="7" rx="2" fill="#FFFFFF"/>
                                <rect x="28" y="24" width="4" height="7" rx="2" fill="#FFFFFF"/>
                            </svg>
                        </div>
                        <div class="custom-why-text">
                            <h3 class="custom-why-head">24x7 Support Team</h3>
                            <p class="custom-why-sub">हमेशा आपकी मदद के लिए तैयार</p>
                        </div>
                    </div>

                </div>

                <!-- Right Side Customer Photo & Floating Badge -->
                <div class="custom-why-photo-wrap">
                    <!-- Floating Speech Bubble Callout -->
                    <div class="custom-why-speech-bubble">
                        <span class="custom-bubble-title">Happy Customers,<br>Our Priority!</span>
                        <div class="custom-bubble-stars">★★★★★</div>
                    </div>

                    <!-- Woman Photo Image Frame -->
                    <div class="custom-woman-photo-frame">
                        <img src="{{ asset('front/assets/images/woman_pointing.jpg') }}" alt="Happy Customer - Agent 24 India" class="custom-woman-img">
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- Why Choose Agent 24 India Banner Section End -->

<!-- How it Works (Agent Kaise Khoje?) Section Start -->
<section class="how-it-works-section desktop-only">
    <div class="section-container">

        <!-- Section Header -->
        <div class="section-header">
            <span class="header-line"></span>
            <h2 class="section-title">Agent Kaise Khoje?</h2>
            <span class="header-line"></span>
        </div>

        <!-- Steps Flow Container -->
        <div class="steps-flow-wrapper">

            <!-- Step 1 -->
            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number-badge badge-blue">1</span>
                    <div class="step-icon-circle circle-blue">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                </div>
                <h3 class="step-title title-blue">Apni Zaroorat Bataye</h3>
                <p class="step-desc">Shahar, Category aur Service chune</p>
            </div>

            <!-- Connecting Arrow 1 -->
            <div class="step-arrow">
                <svg width="48" height="16" viewBox="0 0 48 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 8H40" stroke="#94A3B8" stroke-width="2" stroke-dasharray="4 4" />
                    <path d="M36 3L43 8L36 13" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>

            <!-- Step 2 -->
            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number-badge badge-orange">2</span>
                    <div class="step-icon-circle circle-orange">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#EA580C"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                            <circle cx="9" cy="10" r="2.5"></circle>
                            <path d="M15 8h2M15 12h2M7 16h10"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="step-title title-orange">Best Agents Dekhe</h3>
                <p class="step-desc">Top Verified Agents ki list dekhe aur compare kare</p>
            </div>

            <!-- Connecting Arrow 2 -->
            <div class="step-arrow">
                <svg width="48" height="16" viewBox="0 0 48 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 8H40" stroke="#94A3B8" stroke-width="2" stroke-dasharray="4 4" />
                    <path d="M36 3L43 8L36 13" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>

            <!-- Step 3 -->
            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number-badge badge-green">3</span>
                    <div class="step-icon-circle circle-green">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg>
                    </div>
                </div>
                <h3 class="step-title title-green">Seedha Sampark Kare</h3>
                <p class="step-desc">Agent se call ya message karke baat kare</p>
            </div>

            <!-- Connecting Arrow 3 -->
            <div class="step-arrow">
                <svg width="48" height="16" viewBox="0 0 48 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 8H40" stroke="#94A3B8" stroke-width="2" stroke-dasharray="4 4" />
                    <path d="M36 3L43 8L36 13" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>

            <!-- Step 4 -->
            <div class="step-card">
                <div class="step-icon-wrapper">
                    <span class="step-number-badge badge-purple">4</span>
                    <div class="step-icon-circle circle-purple">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#9333EA"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"></path>
                            <path
                                d="m7 21 1.6-1.4c.4-.4.4-1 0-1.4l-2.2-2.2c-.4-.4-1-.4-1.4 0L2.6 17.4c-.8.8-.8 2 0 2.8l1.6 1.6c.8.8 2 .8 2.8 0Z">
                            </path>
                            <path d="m14.5 12.5 2.2-2.2c.4-.4 1-.4 1.4 0l1.4 1.4c.4.4.4 1 0 1.4l-2.2 2.2"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="step-title title-purple">Kaam Shuru Kare</h3>
                <p class="step-desc">Vishwas ke saath apna kaam pura kare</p>
            </div>

        </div>

    </div>
</section>
<!-- How it Works Section End -->

<!-- Top Verified Agents Section Start -->
<section class="verified-agents-section desktop-only" id="verifiedAgents">
    <div class="section-container">
        <div class="verified-agents-card">

            <!-- Section Header -->
            <div class="verified-agents-header">
                <h2 class="verified-title">Top Verified Agents</h2>
                <a href="{{ route('front.vendorlist') }}" class="view-all-link">
                    <span>सभी देखें</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
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

                    @if(isset($vendoruser) && count($vendoruser) > 0)
                        @foreach($vendoruser as $vendor)
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-avatar-wrapper">
                                    <img src="{{ !empty($vendor->profile_image) ? asset($vendor->profile_image) : asset('front/assets/images/agent_sharma.jpg') }}" alt="{{ $vendor->name }}" class="agent-avatar-img">
                                </div>
                                <h3 class="agent-name">{{ $vendor->company_name ?? $vendor->name }}</h3>
                                <p class="agent-category">{{ $vendor->category->name ?? 'Agent' }}</p>
                                <p class="agent-location">{{ $vendor->district->name ?? 'Jaipur' }}, Rajasthan</p>
                                <div class="agent-rating-row">
                                    <div class="rating-stars">★★★★★</div>
                                    <span class="rating-score">4.8 <span class="rating-count">(120)</span></span>
                                </div>
                                <div class="agent-card-actions">
                                    <a href="{{ route('front.vendorlist') }}?search={{ urlencode($vendor->name ?? '') }}" class="btn-agent-outlined">View Profile</a>
                                    <a href="tel:{{ $vendor->phone ?? '+919876543210' }}" class="btn-agent-filled">Call Now</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback Card 1 -->
                        <div class="agent-card">
                            <div class="verified-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED</span>
                            </div>
                            <div class="agent-avatar-wrapper">
                                <img src="{{ asset('front/assets/images/agent_sharma.jpg') }}" alt="Sharma Property Consultant" class="agent-avatar-img">
                            </div>
                            <h3 class="agent-name">Sharma Property Consultant</h3>
                            <p class="agent-category">Real Estate Agent</p>
                            <p class="agent-location">Jaipur, Rajasthan</p>
                            <div class="agent-rating-row">
                                <div class="rating-stars">★★★★★</div>
                                <span class="rating-score">4.8 <span class="rating-count">(120)</span></span>
                            </div>
                            <div class="agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a>
                                <a href="tel:+919876543210" class="btn-agent-filled">Call Now</a>
                            </div>
                        </div>

                        <!-- Fallback Card 2 -->
                        <div class="agent-card">
                            <div class="verified-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED</span>
                            </div>
                            <div class="agent-avatar-wrapper">
                                <img src="{{ asset('front/assets/images/agent_krishna.jpg') }}" alt="Krishna Motors" class="agent-avatar-img">
                            </div>
                            <h3 class="agent-name">Krishna Motors</h3>
                            <p class="agent-category">Automobile Agent</p>
                            <p class="agent-location">Jodhpur, Rajasthan</p>
                            <div class="agent-rating-row">
                                <div class="rating-stars">★★★★★</div>
                                <span class="rating-score">4.7 <span class="rating-count">(98)</span></span>
                            </div>
                            <div class="agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a>
                                <a href="tel:+919876543211" class="btn-agent-filled">Call Now</a>
                            </div>
                        </div>

                        <!-- Fallback Card 3 -->
                        <div class="agent-card">
                            <div class="verified-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED</span>
                            </div>
                            <div class="agent-avatar-wrapper">
                                <img src="{{ asset('front/assets/images/agent_rto.jpg') }}" alt="RTO Solution Point" class="agent-avatar-img">
                            </div>
                            <h3 class="agent-name">RTO Solution Point</h3>
                            <p class="agent-category">RTO Agent</p>
                            <p class="agent-location">Ajmer, Rajasthan</p>
                            <div class="agent-rating-row">
                                <div class="rating-stars">★★★★★</div>
                                <span class="rating-score">4.9 <span class="rating-count">(155)</span></span>
                            </div>
                            <div class="agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a>
                                <a href="tel:+919876543212" class="btn-agent-filled">Call Now</a>
                            </div>
                        </div>

                        <!-- Fallback Card 4 -->
                        <div class="agent-card">
                            <div class="verified-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED</span>
                            </div>
                            <div class="agent-avatar-wrapper">
                                <img src="{{ asset('front/assets/images/agent_insurance.jpg') }}" alt="Secure Life Insurance" class="agent-avatar-img">
                            </div>
                            <h3 class="agent-name">Secure Life Insurance</h3>
                            <p class="agent-category">Insurance Agent</p>
                            <p class="agent-location">Udaipur, Rajasthan</p>
                            <div class="agent-rating-row">
                                <div class="rating-stars">★★★★★</div>
                                <span class="rating-score">4.8 <span class="rating-count">(112)</span></span>
                            </div>
                            <div class="agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a>
                                <a href="tel:+919876543213" class="btn-agent-filled">Call Now</a>
                            </div>
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

<!-- Rajasthan Districts Section Start -->
<section class="districts-section desktop-only" id="rajasthanDistricts">
    <!-- Heritage Background Line-Art Watermarks -->
    <div class="heritage-bg-art heritage-left">
        <svg viewBox="0 0 160 360" fill="none" stroke="#004BEE" stroke-width="1.2" stroke-linecap="round"
            opacity="0.15">
            <path d="M0 360V220H25V180H45V140C45 130 55 120 65 120C75 120 85 130 85 140V180H105V220H130V360" />
            <path d="M65 120V70C65 70 50 60 50 45C50 30 65 15 65 15C65 15 80 30 80 45C80 60 65 70 65 70Z" />
            <path d="M25 220C25 200 35 190 35 190C35 190 45 200 45 220" />
            <path d="M85 220C85 200 95 190 95 190C95 190 105 200 105 220" />
            <path d="M130 360V260H160V360" />
        </svg>
    </div>
    <div class="heritage-bg-art heritage-right">
        <svg viewBox="0 0 160 360" fill="none" stroke="#004BEE" stroke-width="1.2" stroke-linecap="round"
            opacity="0.15">
            <path d="M160 360V220H135V180H115V140C115 130 105 120 95 120C85 120 75 130 75 140V180H55V220H30V360" />
            <path d="M95 120V70C95 70 110 60 110 45C110 30 95 15 95 15C95 15 80 30 80 45C80 60 95 70 95 70Z" />
            <path d="M135 220C135 200 125 190 125 190C125 190 115 200 115 220" />
            <path d="M75 220C75 200 65 190 65 190C65 190 55 200 55 220" />
            <path d="M30 360V260H0V360" />
        </svg>
    </div>

    <div class="section-container">

        <!-- Styled Decorative Header -->
        <div class="district-header">
            <div class="header-accent-line">
                <span class="line-start"></span>
                <span class="line-dot"></span>
            </div>
            <h2 class="district-section-title">Rajasthan Ke Capital District</h2>
            <div class="header-accent-line">
                <span class="line-dot"></span>
                <span class="line-end"></span>
            </div>
        </div>

        <!-- Carousel Slider Wrapper -->
        <div class="district-carousel-wrapper">
            <!-- Left Control Button -->
            <button class="slider-btn prev-btn" id="districtPrevBtn" aria-label="Previous Districts">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <!-- Scrollable Track -->
            <div class="district-slider-track" id="districtSliderTrack">

                <!-- Card 1: Jaipur -->
                <div class="district-card">
                    <div class="district-image-wrapper">
                        <img src="{{ asset('front/assets/images/jal-mahal-jaipur-9175.jpg') }}" alt="Jaipur Jal Mahal" class="district-img">
                    </div>
                    <div class="district-info-body">
                        <div class="district-meta-row">
                            <h3 class="district-name">Jaipur</h3>
                            <span class="district-agents-count">12,500+ Agents</span>
                        </div>
                        <a href="{{ route('front.vendorlist') }}?search=Jaipur" class="btn-explore-district">
                            <span>Explore</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Jodhpur -->
                <div class="district-card">
                    <div class="district-image-wrapper">
                        <img src="{{ asset('front/assets/images/jodhpur.jpg') }}" alt="Jodhpur Mehrangarh Fort" class="district-img">
                    </div>
                    <div class="district-info-body">
                        <div class="district-meta-row">
                            <h3 class="district-name">Jodhpur</h3>
                            <span class="district-agents-count">8,200+ Agents</span>
                        </div>
                        <a href="{{ route('front.vendorlist') }}?search=Jodhpur" class="btn-explore-district">
                            <span>Explore</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card 3: Udaipur -->
                <div class="district-card">
                    <div class="district-image-wrapper">
                        <img src="{{ asset('front/assets/images/district_udaipur.jpg') }}" onerror="this.onerror=null; this.src='{{ asset('front/assets/images/udaipur.png') }}';" alt="Udaipur Lake Palace" class="district-img">
                    </div>
                    <div class="district-info-body">
                        <div class="district-meta-row">
                            <h3 class="district-name">Udaipur</h3>
                            <span class="district-agents-count">6,800+ Agents</span>
                        </div>
                        <a href="{{ route('front.vendorlist') }}?search=Udaipur" class="btn-explore-district">
                            <span>Explore</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card 4: Kota -->
                <div class="district-card">
                    <div class="district-image-wrapper">
                        <img src="{{ asset('front/assets/images/district_jaipur.jpg') }}" alt="Kota" class="district-img">
                    </div>
                    <div class="district-info-body">
                        <div class="district-meta-row">
                            <h3 class="district-name">Kota</h3>
                            <span class="district-agents-count">5,100+ Agents</span>
                        </div>
                        <a href="{{ route('front.vendorlist') }}?search=Kota" class="btn-explore-district">
                            <span>Explore</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card 5: Bikaner -->
                <div class="district-card">
                    <div class="district-image-wrapper">
                        <img src="{{ asset('front/assets/images/district_jodhpur.jpg') }}" alt="Bikaner" class="district-img">
                    </div>
                    <div class="district-info-body">
                        <div class="district-meta-row">
                            <h3 class="district-name">Bikaner</h3>
                            <span class="district-agents-count">4,300+ Agents</span>
                        </div>
                        <a href="{{ route('front.vendorlist') }}?search=Bikaner" class="btn-explore-district">
                            <span>Explore</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card 6: Ajmer -->
                <div class="district-card">
                    <div class="district-image-wrapper">
                        <img src="{{ asset('front/assets/images/district_ajmer.jpg') }}" alt="Ajmer" class="district-img">
                    </div>
                    <div class="district-info-body">
                        <div class="district-meta-row">
                            <h3 class="district-name">Ajmer</h3>
                            <span class="district-agents-count">3,900+ Agents</span>
                        </div>
                        <a href="{{ route('front.vendorlist') }}?search=Ajmer" class="btn-explore-district">
                            <span>Explore</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Right Control Button -->
            <button class="slider-btn next-btn" id="districtNextBtn" aria-label="Next Districts">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>

    </div>
</section>
<!-- Rajasthan Districts Section End -->

<!-- View All Districts Button Wrapper -->
<div class="view-all-districts-wrapper desktop-only">
    <a href="{{ route('front.vendorlist') }}" class="btn-all-districts">
        <span>सभी जिलों को देखें</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
    </a>
</div>

<!-- Happy Customers Testimonials Section Start -->
<section class="testimonials-section desktop-only" id="testimonials">
    <div class="section-container">

        <!-- Section Header -->
        <div class="testimonials-header">
            <div class="header-arrow-line left-line">
                <svg width="50" height="12" viewBox="0 0 50 12" fill="none">
                    <line x1="0" y1="6" x2="42" y2="6" stroke="#004BEE" stroke-width="2" />
                    <path d="M36 1L43 6L36 11" stroke="#004BEE" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
            <h2 class="testimonials-title">हमारे Happy Customers क्या कहते हैं?</h2>
            <div class="header-arrow-line right-line">
                <svg width="50" height="12" viewBox="0 0 50 12" fill="none">
                    <line x1="8" y1="6" x2="50" y2="6" stroke="#004BEE" stroke-width="2" />
                    <path d="M14 1L7 6L14 11" stroke="#004BEE" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <!-- Testimonials Carousel Slider Wrapper -->
        <div class="testimonials-carousel-wrapper">
            <!-- Left Arrow Control -->
            <button class="slider-btn prev-btn" id="testimonialPrevBtn" aria-label="Previous Testimonial">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <!-- Slider Track -->
            <div class="testimonials-slider-track" id="testimonialSliderTrack">

                <!-- Testimonial Card 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" fill="#F1F5F9" />
                            <path d="M15 100C15 76 30 68 50 68C70 68 85 76 85 100H15Z" fill="#1E293B" />
                            <path d="M40 68L50 86L60 68" fill="#FFFFFF" />
                            <path d="M46 68L50 88L54 68" fill="#004BEE" />
                            <path d="M44 54V68H56V54H44Z" fill="#E2A687" />
                            <path d="M34 40C34 52 41 60 50 60C59 60 66 52 66 40C66 28 59 22 50 22C41 22 34 28 34 40Z" fill="#F0B89A" />
                            <path d="M30 38C30 20 38 10 50 10C62 10 70 20 70 38C70 52 66 65 62 72C60 64 63 48 60 34C56 24 52 21 50 21C48 21 44 24 40 34C37 48 40 64 38 72C34 65 30 52 30 38Z" fill="#0F172A" />
                            <circle cx="45" cy="39" r="2" fill="#0F172A" />
                            <circle cx="55" cy="39" r="2" fill="#0F172A" />
                            <path d="M44 48C47 52 53 52 56 48" stroke="#0F172A" stroke-width="1.5" fill="#FFFFFF" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"Agent 24 India की मदद से हमें Jaipur में भरोसेमंद Property Consultant बहुत जल्दी मिल गया। अब घर लेना आसान हो गया!"</p>
                        <h4 class="testimonial-author">Neha Sharma, Jaipur</h4>
                    </div>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" fill="#E0F2FE" />
                            <path d="M15 100C15 76 30 68 50 68C70 68 85 76 85 100H15Z" fill="#3B82F6" />
                            <path d="M40 68L50 84L60 68" fill="#FFFFFF" />
                            <path d="M44 54V68H56V54H44Z" fill="#D99B75" />
                            <path d="M34 38C34 50 41 58 50 58C59 58 66 50 66 38C66 26 59 20 50 20C41 20 34 26 34 38Z" fill="#E2A687" />
                            <circle cx="44" cy="36" r="2" fill="#111827" />
                            <circle cx="56" cy="36" r="2" fill="#111827" />
                            <path d="M45 46C48 49 52 49 55 46" fill="#FFFFFF" stroke="#111827" stroke-width="1.2" />
                        </svg>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"RTO का काम महीनों से अटका था, यहाँ सही Agent मिला और 2 दिन में काम पूरा हो गया!"</p>
                        <h4 class="testimonial-author">Rahul Mehta, Udaipur</h4>
                    </div>
                </div>

                <!-- Testimonial Card 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-avatar">
                        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" fill="#FEF3C7" />
                            <path d="M15 100C15 76 30 68 50 68C70 68 85 76 85 100H15Z" fill="#475569" />
                            <path d="M40 68L50 84L60 68" fill="#FFFFFF" />
                            <path d="M44 54V68H56V54H44Z" fill="#E8B496" />
                            <path d="M34 38C34 50 41 58 50 58C59 58 66 50 66 38C66 26 59 20 50 20C41 20 34 26 34 38Z" fill="#F0C3AA" />
                            <circle cx="44" cy="36" r="2" fill="#0F172A" />
                            <circle cx="56" cy="36" r="2" fill="#0F172A" />
                            <path d="M45 46C48 49 52 49 55 46" fill="#FFFFFF" stroke="#0F172A" stroke-width="1.2" />
                        </svg>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"Insurance Agent यहाँ से खोजकर सही प्लान लिया। शानदार प्लेटफॉर्म है!"</p>
                        <h4 class="testimonial-author">Suresh Choudhary, Jodhpur</h4>
                    </div>
                </div>

            </div>

            <!-- Right Arrow Control -->
            <button class="slider-btn next-btn" id="testimonialNextBtn" aria-label="Next Testimonial">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>

    </div>
</section>
<!-- Happy Customers Section End -->

<!-- Agent Registration Banner Section Start -->
<section class="agent-cta-section desktop-only" id="agentRegisterCta">
    <div class="section-container">
        <div class="agent-cta-card">

            <!-- Left Column: Laptop Graphic with Dashboard & Houseplants -->
            <div class="cta-graphic-col">
                <div class="laptop-illustration-wrapper">
                    <!-- Left Plant -->
                    <div class="plant-left">
                        <svg width="40" height="60" viewBox="0 0 40 60" fill="none">
                            <path d="M15 60V42C15 42 5 35 5 25C5 15 15 10 20 5C25 10 35 15 35 25C35 35 25 42 25 42V60H15Z" fill="#16A34A" />
                            <path d="M20 5V60" stroke="#15803D" stroke-width="2" />
                            <ellipse cx="20" cy="54" rx="10" ry="6" fill="#15803D" />
                        </svg>
                    </div>

                    <!-- SVG Laptop with Analytics Dashboard -->
                    <div class="laptop-device">
                        <svg viewBox="0 0 280 180" fill="none" xmlns="http://www.w3.org/2000/svg" class="laptop-svg">
                            <rect x="25" y="10" width="230" height="140" rx="10" fill="#0F172A" />
                            <rect x="32" y="18" width="216" height="124" rx="4" fill="#FFFFFF" />
                            <rect x="32" y="18" width="216" height="22" fill="#004BEE" />
                            <circle cx="44" cy="29" r="4" fill="#60A5FA" />
                            <rect x="54" y="26" width="40" height="6" rx="3" fill="#FFFFFF" />
                            <rect x="200" y="24" width="36" height="10" rx="3" fill="#FFB000" />
                            <rect x="32" y="40" width="36" height="102" fill="#F1F5F9" />
                            <rect x="76" y="48" width="48" height="26" rx="4" fill="#EFF6FF" />
                            <rect x="130" y="48" width="48" height="26" rx="4" fill="#F0FDF4" />
                            <rect x="184" y="48" width="56" height="26" rx="4" fill="#FEF3C7" />
                            <rect x="76" y="82" width="104" height="52" rx="4" fill="#F8FAFC" stroke="#E2E8F0" />
                            <rect x="86" y="112" width="10" height="16" rx="2" fill="#60A5FA" />
                            <rect x="102" y="98" width="10" height="30" rx="2" fill="#004BEE" />
                            <rect x="118" y="104" width="10" height="24" rx="2" fill="#60A5FA" />
                            <rect x="134" y="92" width="10" height="36" rx="2" fill="#004BEE" />
                            <rect x="150" y="116" width="10" height="12" rx="2" fill="#60A5FA" />
                            <rect x="166" y="88" width="10" height="40" rx="2" fill="#22C55E" />
                            <circle cx="213" cy="108" r="18" fill="#004BEE" />
                            <path d="M213 108L231 108A18 18 0 0 1 213 126Z" fill="#FFB000" />
                            <path d="M10 150H270L255 165H25L10 150Z" fill="#CBD5E1" />
                        </svg>
                    </div>

                    <!-- Right Plant -->
                    <div class="plant-right">
                        <svg width="40" height="60" viewBox="0 0 40 60" fill="none">
                            <path d="M15 60V42C15 42 5 35 5 25C5 15 15 10 20 5C25 10 35 15 35 25C35 35 25 42 25 42V60H15Z" fill="#16A34A" />
                            <path d="M20 5V60" stroke="#15803D" stroke-width="2" />
                            <ellipse cx="20" cy="54" rx="10" ry="6" fill="#15803D" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Middle Column: Heading & Yellow CTA Button -->
            <div class="cta-content-col">
                <h3 class="cta-main-title">क्या आप भी एक Agent हैं?</h3>
                <p class="cta-subtitle">अपनी Profile बनाएं, अपनी services promote करें और नए customers तक पहुँचें।</p>

                <a href="{{ route('front.register') }}" class="btn-register-yellow">
                    <span>अभी Register करें</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>

            <!-- Right Column: Checkmark Feature List -->
            <div class="cta-features-col">
                <ul class="cta-feature-list">
                    <li class="cta-feature-item">
                        <span class="check-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                        <span>Free Listing Option</span>
                    </li>

                    <li class="cta-feature-item">
                        <span class="check-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                        <span>Affordable Paid Plans</span>
                    </li>

                    <li class="cta-feature-item">
                        <span class="check-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                        <span>All India Visibility</span>
                    </li>

                    <li class="cta-feature-item">
                        <span class="check-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                        <span>Business Growth</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>
<!-- Agent Registration Banner Section End -->

<!-- Trust Features Bar Section Start -->
<section class="trust-features-section desktop-only" id="trustFeatures">
    <div class="section-container">
        <div class="trust-features-card">

            <!-- Feature 1: Trusted Platform -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-blue-shield">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" />
                        <polygon points="12 6 13.8 9.6 17.7 10.2 14.9 12.9 15.6 16.8 12 14.9 8.4 16.8 9.1 12.9 6.3 10.2 10.2 9.6" fill="#FFB000" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">Trusted Platform</h4>
                    <p class="trust-subtitle">भारत का भरोसेमंद Agent Directory</p>
                </div>
            </div>

            <div class="trust-divider"></div>

            <!-- Feature 2: Safe & Secure -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-blue-lock">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">Safe & Secure</h4>
                    <p class="trust-subtitle">आपकी जानकारी है 100% Secure</p>
                </div>
            </div>

            <div class="trust-divider"></div>

            <!-- Feature 3: All India Network -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-blue-pin">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">All India Network</h4>
                    <p class="trust-subtitle">हर शहर, हर जिला हमारे साथ</p>
                </div>
            </div>

            <div class="trust-divider"></div>

            <!-- Feature 4: Affordable Plans -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-blue-tag">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">Affordable Plans</h4>
                    <p class="trust-subtitle">हर Agent के लिए Best Plans</p>
                </div>
            </div>

            <div class="trust-divider"></div>

            <!-- Feature 5: Grow Your Business -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-gold-trophy">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#FFB000" stroke="none">
                        <path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V18H8v2h8v-2h-3v-2.1c2.14-.46 3.78-2.14 4.39-4.34C19.08 11.37 21 9.29 21 6.74V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">Grow Your Business</h4>
                    <p class="trust-subtitle">ज्यादा Visibility, ज्यादा Customers</p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Trust Features Bar Section End -->

<!-- Dark Blue Stats Metrics Bar Section Start -->
<section class="dark-stats-section desktop-only" id="darkStats">
    <div class="section-container">
        <div class="dark-stats-card">

            <!-- Stat 1: 10,000+ Verified Agents -->
            <div class="dark-stat-col">
                <div class="dark-stat-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
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
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
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
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                        <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                        <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                        <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
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
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
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
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path>
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
<!-- Dark Blue Stats Metrics Bar Section End -->

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Carousel logic for Mobile Top Verified Agents
    const mAgentTrack = document.getElementById('mAgentSliderTrack');
    const mAgentPrev = document.getElementById('mAgentPrevBtn');
    const mAgentNext = document.getElementById('mAgentNextBtn');

    if (mAgentTrack && mAgentPrev && mAgentNext) {
        mAgentPrev.addEventListener('click', () => {
            const card = mAgentTrack.querySelector('.m-agent-slide-card');
            const step = card ? card.offsetWidth + 12 : 280;
            mAgentTrack.scrollBy({ left: -step, behavior: 'smooth' });
        });
        mAgentNext.addEventListener('click', () => {
            const card = mAgentTrack.querySelector('.m-agent-slide-card');
            const step = card ? card.offsetWidth + 12 : 280;
            mAgentTrack.scrollBy({ left: step, behavior: 'smooth' });
        });
    }

    // Carousel logic for Top Verified Agents (Desktop)
    const agentTrack = document.getElementById('agentsSliderTrack');
    const agentPrev = document.getElementById('agentPrevBtn');
    const agentNext = document.getElementById('agentNextBtn');

    if (agentTrack && agentPrev && agentNext) {
        agentPrev.addEventListener('click', () => {
            agentTrack.scrollBy({ left: -320, behavior: 'smooth' });
        });
        agentNext.addEventListener('click', () => {
            agentTrack.scrollBy({ left: 320, behavior: 'smooth' });
        });
    }

    // Carousel logic for Districts (Desktop)
    const districtTrack = document.getElementById('districtSliderTrack');
    const districtPrev = document.getElementById('districtPrevBtn');
    const districtNext = document.getElementById('districtNextBtn');

    if (districtTrack && districtPrev && districtNext) {
        districtPrev.addEventListener('click', () => {
            districtTrack.scrollBy({ left: -300, behavior: 'smooth' });
        });
        districtNext.addEventListener('click', () => {
            districtTrack.scrollBy({ left: 300, behavior: 'smooth' });
        });
    }

    // Carousel logic for Testimonials (Desktop)
    const testTrack = document.getElementById('testimonialSliderTrack');
    const testPrev = document.getElementById('testimonialPrevBtn');
    const testNext = document.getElementById('testimonialNextBtn');

    if (testTrack && testPrev && testNext) {
        testPrev.addEventListener('click', () => {
            testTrack.scrollBy({ left: -340, behavior: 'smooth' });
        });
        testNext.addEventListener('click', () => {
            testTrack.scrollBy({ left: 340, behavior: 'smooth' });
        });
    }
});
</script>
@endpush

@php
    $privacy = $sitePrivacy ?? null;
    $trem = $siteTerms ?? null;
    $about = $siteAbout ?? null;
    $setting = $siteSetting ?? null;
    $districtList = (!empty($siteDistricts) && ($siteDistricts instanceof \Illuminate\Support\Collection || is_array($siteDistricts))) 
        ? $siteDistricts 
        : \App\Models\District::select('id', 'name')->where('status', 1)->orderBy('name')->get();
    $categoryList = (!empty($siteCategories) && ($siteCategories instanceof \Illuminate\Support\Collection || is_array($siteCategories)))
        ? $siteCategories
        : \App\Models\Category::select('id', 'name')->whereNull('parent_id')->where('status', 1)->orderBy('name')->get();
    $dynamicLogo = $siteLogo ?? null;
@endphp

<style>
    .site-header-logo-img {
        height: 46px;
        max-height: 48px;
        width: auto;
        max-width: 240px;
        object-fit: contain;
        display: block;
        transition: transform 0.2s ease;
    }
    .site-header-logo-img:hover {
        transform: scale(1.02);
    }
    @media (max-width: 640px) {
        .site-header-logo-img {
            height: 36px;
            max-height: 38px;
            max-width: 170px;
        }
    }
    .header-search-capsule {
        display: flex;
        align-items: center;
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 40px;
        padding: 4px 6px 4px 16px;
        max-width: 520px;
        width: 100%;
        margin: 0 16px;
        transition: all 0.2s ease;
    }
    .header-search-capsule:focus-within {
        border-color: #004BEE;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.12);
        background: #FFFFFF;
    }
    .hsc-field {
        display: flex;
        align-items: center;
        gap: 7px;
        flex: 1;
        min-width: 0;
    }
    .hsc-select {
        border: none;
        background: transparent;
        font-size: 13.5px;
        font-weight: 600;
        color: #1E293B;
        width: 100%;
        outline: none;
        cursor: pointer;
        padding: 6px 2px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
    .hsc-divider {
        width: 1px;
        height: 22px;
        background: #CBD5E1;
        margin: 0 8px;
        flex-shrink: 0;
    }
    .hsc-search-btn {
        background: #004BEE;
        color: #FFFFFF;
        border: none;
        border-radius: 30px;
        padding: 7px 20px;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
        flex-shrink: 0;
    }
    .hsc-search-btn:hover {
        background: #0036B8;
    }
        @media (max-width: 991px) {
        .header-search-capsule {
            display: none;
        }
    }

    /* Side Drawer Menu Redesign */
    .right-drawer-menu {
        position: fixed;
        top: 0;
        right: 0;
        width: 320px;
        max-width: 88vw;
        height: 100vh;
        background-color: #FFFFFF;
        box-shadow: -10px 0 35px rgba(0, 0, 0, 0.12);
        z-index: 2100;
        transform: translateX(100%);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        padding: 16px 18px 20px;
        overflow-y: auto;
        overscroll-behavior: contain;
    }
    .right-drawer-menu.active {
        transform: translateX(0);
    }
    .drawer-top-bar {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-bottom: 4px;
    }
    .drawer-close-btn {
        background: none;
        border: none;
        font-size: 26px;
        line-height: 1;
        color: #1E293B;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    .drawer-close-btn:hover {
        background-color: #F1F5F9;
        color: #004BEE;
    }
    .drawer-brand-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-bottom: 20px;
    }
    .drawer-tagline-wrap {
        margin-top: 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .drawer-tagline-text {
        font-size: 13.5px;
        font-weight: 700;
        font-style: italic;
        color: #0F172A;
        letter-spacing: -0.2px;
    }
    .drawer-swoosh-svg {
        width: 140px;
        height: 8px;
        margin-top: 2px;
    }
    .drawer-cards-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }
    .drawer-menu-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #FFFFFF;
        border: 1.5px solid #E5EAF2;
        border-radius: 12px;
        padding: 10px 14px;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03);
    }
    .drawer-menu-card:hover {
        border-color: #004BEE;
        background: #F8FAFF;
        transform: translateX(-2px);
        box-shadow: 0 4px 12px rgba(0, 75, 238, 0.08);
    }
    .drawer-menu-card.active-card {
        border-color: #004BEE;
        background: #EFF6FF;
    }
    .drawer-card-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }
    .drawer-card-icon {
        width: 22px;
        height: 22px;
        color: #193CB8;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .drawer-card-text {
        font-size: 14.5px;
        font-weight: 600;
        color: #0F172A;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .drawer-card-arrow {
        color: #64748B;
        flex-shrink: 0;
        transition: transform 0.2s ease, color 0.2s ease;
    }
    .drawer-menu-card:hover .drawer-card-arrow {
        color: #004BEE;
        transform: translateX(2px);
    }
    .drawer-footer-promo {
        margin-top: 24px;
        padding: 16px 12px 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: linear-gradient(180deg, rgba(239, 246, 255, 0) 0%, #EFF6FF 100%);
        border-radius: 16px;
        position: relative;
    }
    .drawer-promo-text {
        font-size: 18px;
        font-weight: 800;
        font-style: italic;
        color: #004BEE;
        line-height: 1.25;
        letter-spacing: -0.3px;
    }
</style>

<!-- Header Start -->
<header class="site-header" id="siteHeader">
    <div class="header-container">

        <!-- Logo Section -->
        <a href="{{route('front.index')}}" class="brand-logo" title="{{ $setting->logo_title ?? 'Agent 24 India' }}">
            @if(!empty($dynamicLogo))
                <img src="{{ $dynamicLogo }}" 
                     alt="{{ $setting->logo_title ?? 'Agent 24 India' }}" 
                     class="site-header-logo-img"
                     onerror="this.style.display='none'; var fb = document.getElementById('headerLogoFallback'); if(fb){ fb.style.display='flex'; }">
                <div id="headerLogoFallback" class="logo-fallback-wrapper" style="display: none; align-items: center; gap: 12px;">
                    <div class="logo-icon-wrapper">
                        <svg width="42" height="42" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Blue A shape -->
                            <path d="M12 40L24 10L36 40H28L24 29L20 40H12Z" fill="url(#blue-grad-fallback)" />
                            <path d="M18.5 33H29.5L24 19L18.5 33Z" fill="#004BEE" />
                            <!-- Curved swoosh under A -->
                            <path d="M6 38C14 34 26 38 42 30C34 38 20 44 6 38Z" fill="#0F172A" />
                            <!-- Golden yellow accent figure -->
                            <circle cx="28" cy="11" r="4.5" fill="#FFB800" />
                            <defs>
                                <linearGradient id="blue-grad-fallback" x1="12" y1="10" x2="36" y2="40"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0066FF" />
                                    <stop offset="1" stop-color="#0038A8" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="logo-text-group">
                        <div class="brand-name">
                            <span class="navy-text">{{ $setting->logo_title ?? 'AGENT 24 INDIA' }}</span>
                        </div>
                        <span class="brand-tagline">Sahi Agent, Sahi Connection</span>
                    </div>
                </div>
            @else
                <div class="logo-icon-wrapper">
                    <svg width="42" height="42" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Blue A shape -->
                        <path d="M12 40L24 10L36 40H28L24 29L20 40H12Z" fill="url(#blue-grad)" />
                        <path d="M18.5 33H29.5L24 19L18.5 33Z" fill="#004BEE" />
                        <!-- Curved swoosh under A -->
                        <path d="M6 38C14 34 26 38 42 30C34 38 20 44 6 38Z" fill="#0F172A" />
                        <!-- Golden yellow accent figure -->
                        <circle cx="28" cy="11" r="4.5" fill="#FFB800" />
                        <defs>
                            <linearGradient id="blue-grad" x1="12" y1="10" x2="36" y2="40"
                                gradientUnits="userSpaceOnUse">
                                <stop stop-color="#0066FF" />
                                <stop offset="1" stop-color="#0038A8" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <div class="logo-text-group">
                    <div class="brand-name">
                        <span class="navy-text">{{ $setting->logo_title ?? 'AGENT 24 INDIA' }}</span>
                    </div>
                    <span class="brand-tagline">Sahi Agent, Sahi Connection</span>
                </div>
            @endif
        </a>

        @if(request()->routeIs('front.vendorlist*'))
            <!-- Central Search Capsule Bar in Header -->
            <div class="header-search-capsule" id="headerSearchCapsule">
                <div class="hsc-field hsc-category">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <select id="hscCategorySelect" class="hsc-select">
                        <option value="">All Categories</option>
                        @foreach($categoryList as $cat)
                            <option value="{{ $cat->id }}" {{ (isset($selectedCategory) && $selectedCategory == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="hsc-divider"></div>
                <div class="hsc-field hsc-location">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <select id="hscDistrictSelect" class="hsc-select">
                        <option value="" {{ empty($location) ? 'selected' : '' }}>Search district</option>
                        @foreach($districtList as $dist)
                            <option value="{{ $dist->id }}" {{ (isset($location) && $location == $dist->id) ? 'selected' : '' }}>
                                {{ $dist->name }}, Rajasthan
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="button" id="hscSearchBtn" class="hsc-search-btn">
                    <span>Search</span>
                </button>
            </div>
        @else
            <!-- Navigation Links -->
            <nav class="main-nav" id="mainNav">
                <ul class="nav-list">
                    <li class="nav-item {{ request()->routeIs('front.price*') ? 'active' : '' }}">
                        <a href="#" class="nav-link">Special offers</a>
                        @if(request()->routeIs('front.price*'))
                            <span class="active-bar"></span>
                        @endif
                    </li>

                    <li class="nav-item {{ request()->routeIs('front.vendorlist*') ? 'active' : '' }}">
                        <a href="#" class="nav-link">Direct Agent</a>
                        @if(request()->routeIs('front.vendorlist*'))
                            <span class="active-bar"></span>
                        @endif
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">Area Agent</a>
                    </li>
                </ul>
            </nav>
        @endif

        <!-- Right Action Items -->
        <div class="header-actions">
            <!-- Mobile Search Icon Button (visible only on mobile) -->
            <a href="javascript:void(0)" class="action-btn mobile-header-search-btn" id="mobileHeaderSearchBtn" title="Search Agents" aria-label="Search Agents">
                <svg class="action-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </a>

            <!-- Saved Item -->
            <a href="javascript:void(0)" class="action-btn saved-btn" id="headerSavedBtn" title="Saved Items">
                <svg class="action-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
                <span>Saved</span>
            </a>

            <!-- Login / Logout Item -->
            @if(\Auth::check())
                <a href="{{route('front.logout')}}" class="action-btn login-btn" title="Logout" onclick="return confirm('Are you sure you want to logout?')">
                    <svg class="action-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout</span>
                </a>
                <a href="{{ route('front.profile') }}" class="btn-register">Profile</a>
            @else
                <a href="{{ route('login') }}" class="action-btn login-btn {{ request()->routeIs('login') ? 'active-action' : '' }}" title="Login">
                    <svg class="action-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span>Login</span>
                </a>
                <!-- Register Button -->
                <a href="{{ route('front.register') }}" class="btn-register" style="background:#004BEE; color:#fff !important; font-weight:700;">Register</a>
            @endif

            <!-- Right Side Menu Toggle Button (Desktop & Tablet) -->
            <button class="header-menu-drawer-btn" id="headerMenuBtn" title="Menu" aria-label="Menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <!-- Mobile Hamburger Toggle (Mobile < 768px) -->
            <button class="hamburger-menu" id="hamburgerBtn" aria-label="Toggle navigation">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>

    </div>
</header>
<!-- Header End -->

<!-- Mobile Header Search Sheet Modal -->
<div class="mobile-search-sheet" id="mobileSearchSheet" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(15,23,42,0.6); z-index:2200; align-items:flex-start; justify-content:center; padding:16px;">
    <div style="background:#FFFFFF; border-radius:16px; padding:20px; width:100%; max-width:480px; box-shadow:0 10px 30px rgba(0,0,0,0.2); animation:slideDown 0.25s ease-out; margin-top:40px;">
        <div style="display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #E2E8F0; padding-bottom:12px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <h3 style="font-size:16.5px; font-weight:800; color:#0F172A; margin:0;">Search Agents / एजेंट खोजें</h3>
            </div>
            <button type="button" id="mobileSearchCloseBtn" style="background:none; border:none; font-size:26px; line-height:1; color:#64748B; cursor:pointer; padding:2px 8px;">&times;</button>
        </div>
        <form action="{{ route('front.vendorlist') }}" method="GET" id="mobileHeaderSearchForm" style="margin-top:16px;">
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:12.5px; font-weight:700; color:#334155; margin-bottom:6px;">District / जिला</label>
                <select name="district" id="mHeaderDistrictSelect" style="width:100%; height:44px; border:1.5px solid #CBD5E1; border-radius:10px; padding:0 12px; font-size:13.5px; font-weight:600; color:#0F172A; background:#fff; outline:none;">
                    <option value="">Search district</option>
                    @foreach($districtList as $dist)
                        <option value="{{ $dist->id }}" {{ (isset($location) && $location == $dist->id) ? 'selected' : '' }}>
                            {{ $dist->name }}, Rajasthan
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:12.5px; font-weight:700; color:#334155; margin-bottom:6px;">Category / कैटेगरी</label>
                <select name="category" id="mHeaderCategorySelect" style="width:100%; height:44px; border:1.5px solid #CBD5E1; border-radius:10px; padding:0 12px; font-size:13.5px; font-weight:600; color:#0F172A; background:#fff; outline:none;">
                    <option value="">All Categories</option>
                    @foreach($categoryList as $cat)
                        <option value="{{ $cat->id }}" {{ (isset($selectedCategory) && $selectedCategory == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="width:100%; height:46px; background:#004BEE; color:#fff; font-size:15px; font-weight:700; border:none; border-radius:10px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; box-shadow:0 4px 12px rgba(0,75,238,0.25);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <span>Agent खोजें</span>
            </button>
        </form>
    </div>
</div>

<!-- Right Side Offcanvas Drawer Menu Overlay -->
<div class="right-drawer-overlay" id="rightDrawerOverlay"></div>

<!-- Right Side Offcanvas Drawer Menu -->
<aside class="right-drawer-menu" id="rightDrawerMenu">
    <!-- Top Close Button -->
    <div class="drawer-top-bar">
        <button class="drawer-close-btn" id="drawerCloseBtn" aria-label="Close menu">&times;</button>
    </div>

    <!-- Center Brand Logo & Tagline -->
    <div class="drawer-brand-center">
        @if(!empty($dynamicLogo))
            <img src="{{ $dynamicLogo }}" alt="{{ $setting->logo_title ?? 'AGENT 24 INDIA' }}" style="height: 42px; max-width: 170px; object-fit: contain;">
        @else
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="36" height="36" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 40L24 10L36 40H28L24 29L20 40H12Z" fill="#004BEE" />
                    <path d="M18.5 33H29.5L24 19L18.5 33Z" fill="#004BEE" />
                    <path d="M6 38C14 34 26 38 42 30C34 38 20 44 6 38Z" fill="#0F172A" />
                    <circle cx="28" cy="11" r="4.5" fill="#FFB800" />
                </svg>
                <span style="font-weight: 800; color: #0B1948; font-size: 17px; letter-spacing: -0.3px;">AGENT 24 INDIA</span>
            </div>
        @endif
        <div class="drawer-tagline-wrap">
            <span class="drawer-tagline-text">Apke Sapno ka Sahi Saathi !</span>
            <svg class="drawer-swoosh-svg" viewBox="0 0 160 10" fill="none">
                <path d="M2 6C45 1 120 1 158 7C110 9.5 50 9.5 2 6Z" fill="#22C55E" />
            </svg>
        </div>
    </div>

    <!-- Menu Cards List -->
    <ul class="drawer-cards-list">
        <!-- 1. My Profile -->
        <li>
            <a href="{{ \Auth::check() ? route('front.profile') : route('login') }}" class="drawer-menu-card {{ request()->routeIs('front.profile') ? 'active-card' : '' }}">
                <div class="drawer-card-left">
                    <div class="drawer-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <span class="drawer-card-text">My Profile</span>
                </div>
                <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </a>
        </li>

        <!-- 2. Price & Plan -->
        <li>
            <a href="{{ route('front.price') }}" class="drawer-menu-card {{ request()->routeIs('front.price') ? 'active-card' : '' }}">
                <div class="drawer-card-left">
                    <div class="drawer-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/>
                        </svg>
                    </div>
                    <span class="drawer-card-text">Price & Plan</span>
                </div>
                <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </a>
        </li>

        <!-- 3. DBM Form -->
        <li>
            <a href="{{ \Auth::check() ? route('front.addListing') : route('login') }}" class="drawer-menu-card {{ request()->routeIs('front.addListing') ? 'active-card' : '' }}">
                <div class="drawer-card-left">
                    <div class="drawer-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                    </div>
                    <span class="drawer-card-text">DBM Form</span>
                </div>
                <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </a>
        </li>

        <!-- 4. Terms & Condition -->
        <li>
            <a href="{{ route('front.termsAndConditions') }}" class="drawer-menu-card {{ request()->routeIs('front.termsAndConditions') ? 'active-card' : '' }}">
                <div class="drawer-card-left">
                    <div class="drawer-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                    </div>
                    <span class="drawer-card-text">Terms & Condition</span>
                </div>
                <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </a>
        </li>

        <!-- 5. Support & Help -->
        <li>
            <a href="{{ route('front.support') }}" class="drawer-menu-card {{ request()->routeIs('front.support') ? 'active-card' : '' }}">
                <div class="drawer-card-left">
                    <div class="drawer-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1a9 9 0 0 0-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h3c1.66 0 3-1.34 3-3v-7a9 9 0 0 0-9-9z"/>
                        </svg>
                    </div>
                    <span class="drawer-card-text">Support & Help</span>
                </div>
                <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </a>
        </li>

        <!-- 6. About Us -->
        <li>
            <a href="{{ route('front.aboutus') }}" class="drawer-menu-card {{ request()->routeIs('front.aboutus') ? 'active-card' : '' }}">
                <div class="drawer-card-left">
                    <div class="drawer-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                    </div>
                    <span class="drawer-card-text">About Us</span>
                </div>
                <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </a>
        </li>

        <!-- 7. Contact Us -->
        <li>
            <a href="{{ route('front.contactus') }}" class="drawer-menu-card {{ request()->routeIs('front.contactus') ? 'active-card' : '' }}">
                <div class="drawer-card-left">
                    <div class="drawer-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 0 0-1.01.24l-2.2 2.2a15.053 15.053 0 0 1-6.59-6.59l2.2-2.21a.96.96 0 0 0 .25-1A11.36 11.36 0 0 1 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-.99-1.12z"/>
                        </svg>
                    </div>
                    <span class="drawer-card-text">Contact Us</span>
                </div>
                <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </a>
        </li>

        <!-- 8. Login / Logout -->
        <li>
            @if(\Auth::check())
                <a href="{{ route('front.logout') }}" onclick="return confirm('Are you sure you want to logout?')" class="drawer-menu-card" style="border-color: #FEE2E2;">
                    <div class="drawer-card-left">
                        <div class="drawer-card-icon" style="color: #DC2626;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </div>
                        <span class="drawer-card-text" style="color: #DC2626;">Logout</span>
                    </div>
                    <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="drawer-menu-card {{ request()->routeIs('login') ? 'active-card' : '' }}">
                    <div class="drawer-card-left">
                        <div class="drawer-card-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10 17v-3H3v-4h7V7l5 5-5 5zm10-14H4c-1.1 0-2 .9-2 2v4h2V5h16v14H4v-4H2v4c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                            </svg>
                        </div>
                        <span class="drawer-card-text">Login</span>
                    </div>
                    <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </a>
            @endif
        </li>

        <!-- 9. Register -->
        @if(!\Auth::check())
            <li>
                <a href="{{ route('front.register') }}" class="drawer-menu-card {{ request()->routeIs('front.register') ? 'active-card' : '' }}">
                    <div class="drawer-card-left">
                        <div class="drawer-card-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <span class="drawer-card-text">Register</span>
                    </div>
                    <svg class="drawer-card-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </a>
            </li>
        @endif
    </ul>

    <!-- Bottom Slogan Promo -->
    <div class="drawer-footer-promo">
        <div class="drawer-promo-text">
            Saath Hai<br>Toh Sambhav Hai !
        </div>
        <svg class="drawer-swoosh-svg" viewBox="0 0 160 10" fill="none">
            <path d="M2 6C45 1 120 1 158 7C110 9.5 50 9.5 2 6Z" fill="#22C55E" />
        </svg>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var drawer = document.getElementById('rightDrawerMenu');
        var overlay = document.getElementById('rightDrawerOverlay');
        var openBtns = [document.getElementById('headerMenuBtn'), document.getElementById('hamburgerBtn')];
        var closeBtn = document.getElementById('drawerCloseBtn');

        function openDrawer() {
            if (drawer) drawer.classList.add('active');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            if (drawer) drawer.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        openBtns.forEach(function(btn) {
            if (btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    openDrawer();
                });
            }
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                closeDrawer();
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function() {
                closeDrawer();
            });
        }

        // Mobile Header Search Sheet Modal logic
        var searchSheet = document.getElementById('mobileSearchSheet');
        var searchBtn = document.getElementById('mobileHeaderSearchBtn');
        var searchCloseBtn = document.getElementById('mobileSearchCloseBtn');
        var mHeaderSearchForm = document.getElementById('mobileHeaderSearchForm');

        function openSearchSheet() {
            if (searchSheet) {
                searchSheet.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeSearchSheet() {
            if (searchSheet) {
                searchSheet.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        if (searchBtn) {
            searchBtn.addEventListener('click', function(e) {
                e.preventDefault();
                openSearchSheet();
            });
        }

        if (searchCloseBtn) {
            searchCloseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                closeSearchSheet();
            });
        }

        if (searchSheet) {
            searchSheet.addEventListener('click', function(e) {
                if (e.target === searchSheet) {
                    closeSearchSheet();
                }
            });
        }

        if (mHeaderSearchForm) {
            mHeaderSearchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var dist = document.getElementById('mHeaderDistrictSelect') ? document.getElementById('mHeaderDistrictSelect').value.trim() : '';
                var cat = document.getElementById('mHeaderCategorySelect') ? document.getElementById('mHeaderCategorySelect').value.trim() : '';

                var targetUrl = "{{ route('front.vendorlist') }}";
                if (dist && cat) {
                    targetUrl = "{{ url('/vendorlist') }}/" + encodeURIComponent(dist) + "/" + encodeURIComponent(cat);
                } else if (dist) {
                    targetUrl = "{{ url('/vendorlist') }}/" + encodeURIComponent(dist);
                } else if (cat) {
                    targetUrl = "{{ url('/category/vendorlist') }}/" + encodeURIComponent(cat);
                }
                window.location.href = targetUrl;
            });
        }
    });
</script>

<!-- Mobile Bottom Navigation Bar Start -->
<div class="mobile-bottom-nav" id="mobileBottomNav">
    <!-- 1. Special Offers -->
    <a href="{{ route('front.price') }}" class="mob-nav-item {{ request()->routeIs('front.price') ? 'active' : '' }}">
        <div class="mob-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.65-.5-.65C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1h-2.22l.8-1.08C13.84 4.37 14.39 4 15 4zM9 4c.61 0 1.16.37 1.42.92L11.22 6H9c-.55 0-1-.45-1-1s.45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76V14h2V8.76L15.38 12 17 10.83 14.92 8H20v6z"/>
            </svg>
        </div>
        <span class="mob-nav-label">Special Offers</span>
    </a>

    <!-- 2. Direct Agent -->
    <a href="{{ route('front.vendorlist') }}" class="mob-nav-item {{ request()->routeIs('front.vendorlist*') && !request()->has('type') ? 'active' : '' }}">
        <div class="mob-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
        </div>
        <span class="mob-nav-label">Direct Agent</span>
    </a>

    <!-- 3. Area Agent (Highlighted Pill Card) -->
    <a href="{{ route('front.vendorlist') }}" class="mob-nav-item mob-nav-pill-btn">
        <div class="mob-nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
        </div>
        <span class="mob-nav-label">Area Agent</span>
    </a>

    <!-- 4. Home -->
    <a href="{{ route('front.index') }}" class="mob-nav-item {{ request()->routeIs('front.index') ? 'active' : '' }}">
        <div class="mob-nav-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
        </div>
        <span class="mob-nav-label">Home</span>
    </a>
</div>

<style>
    /* Mobile Bottom Navigation Styles */
    .mobile-bottom-nav {
        display: none;
    }

    @media (max-width: 991px) {
        body {
            padding-bottom: 68px !important;
        }

        .mobile-bottom-nav {
            display: flex;
            align-items: center;
            justify-content: space-around;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: #FFFFFF;
            border-top: 1px solid #E2E8F0;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.08);
            z-index: 9999;
            padding: 4px 8px;
        }

        .mob-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #475569;
            gap: 2px;
            flex: 1;
            padding: 4px 6px;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-align: center;
        }

        .mob-nav-item .mob-nav-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            color: inherit;
        }

        .mob-nav-item .mob-nav-label {
            font-size: 11px;
            font-weight: 600;
            line-height: 1.1;
            color: inherit;
            white-space: nowrap;
        }

        .mob-nav-item:hover,
        .mob-nav-item.active {
            color: #004BEE;
        }

        /* Highlighted Area Agent Blue Pill Button */
        .mob-nav-item.mob-nav-pill-btn {
            background: #004BEE;
            color: #FFFFFF !important;
            border-radius: 12px;
            padding: 6px 12px;
            flex: 0 0 auto;
            min-width: 76px;
            box-shadow: 0 4px 12px rgba(0, 75, 238, 0.35);
        }

        .mob-nav-item.mob-nav-pill-btn .mob-nav-label {
            color: #FFFFFF !important;
            font-weight: 700;
            font-size: 11.5px;
        }

        .mob-nav-item.mob-nav-pill-btn .mob-nav-icon {
            color: #FFFFFF !important;
        }

        .mob-nav-item.mob-nav-pill-btn:hover {
            background: #0036B8;
            transform: translateY(-1px);
        }
    }
</style>

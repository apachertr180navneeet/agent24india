@php
    $cmsModel = new \App\Models\Cms();
    $districtModel = new \App\Models\District();
    $settingModel = new \App\Models\Setting();
    $privacy = $cmsModel->where('id', 3)->first();
    $trem = $cmsModel->where('id', 2)->first();
    $about = $cmsModel->where('id', 1)->first();
    $setting = $settingModel->orderBy('id', 'asc')->first();
    $districtList = $districtModel->select('id', 'name')->where('status', 1)->orderBy('name')->get();

    $dynamicLogo = null;
    if ($setting && !empty($setting->logo_image)) {
        $val = $setting->logo_image;
        $fn = basename(parse_url($val, PHP_URL_PATH) ?? $val);
        if ($fn && file_exists(public_path('upload/setting/' . $fn))) {
            $dynamicLogo = asset('public/upload/setting/' . $fn);
        } elseif (filter_var($val, FILTER_VALIDATE_URL)) {
            $dynamicLogo = $val;
        } else {
            $cleanPath = ltrim($val, '/');
            if (file_exists(public_path($cleanPath))) {
                $dynamicLogo = asset('public/' . $cleanPath);
            } else {
                $dynamicLogo = asset($cleanPath);
            }
        }
    }
    if (empty($dynamicLogo)) {
        $latestSettingLogo = glob(public_path('upload/setting/*.*'));
        if (!empty($latestSettingLogo)) {
            usort($latestSettingLogo, function($a, $b) {
                return filemtime($b) - filemtime($a);
            });
            $dynamicLogo = asset('public/upload/setting/' . basename($latestSettingLogo[0]));
        }
    }
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
                        @foreach(($category ?? \App\Models\Category::whereNull('parent_id')->where('status', 1)->get()) as $cat)
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
                        @foreach(($districtList ?? \App\Models\District::where('status', 1)->orderBy('name')->get()) as $dist)
                            <option value="{{ $dist->id }}" {{ (isset($location) && $location == $dist->id) || ($dist->name == 'Jaipur' && empty($location)) ? 'selected' : '' }}>
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
                    <li class="nav-item {{ request()->routeIs('front.index') ? 'active' : '' }}">
                        <a href="{{route('front.index')}}" class="nav-link">Home</a>
                        @if(request()->routeIs('front.index'))
                            <span class="active-bar"></span>
                        @endif
                    </li>

                    <li class="nav-item {{ request()->routeIs('front.addListing') ? 'active' : '' }}">
                        <a href="{{ \Auth::check() ? route('front.addListing') : route('login') }}" class="nav-link">Free Listing</a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('front.addbanner') ? 'active' : '' }}">
                        <a href="{{ \Auth::check() ? route('front.addbanner') : route('login') }}" class="nav-link">Banner Ad</a>
                    </li>

                    <li class="nav-item dropdown-item">
                        <a href="javascript:void(0)" class="nav-link">
                            Policies
                            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </a>
                        <div class="dropdown-menu">
                            @if($privacy && $privacy->status == 1)
                                <a href="{{route('front.privacyPolicy')}}" class="dropdown-link">Privacy Policy</a>
                            @endif
                            @if($trem && $trem->status == 1)
                                <a href="{{route('front.termsAndConditions')}}" class="dropdown-link">Terms & Conditions</a>
                            @endif
                        </div>
                    </li>

                    <li class="nav-item {{ request()->routeIs('front.support') ? 'active' : '' }}">
                        <a href="{{route('front.support')}}" class="nav-link">Support & Help</a>
                    </li>
                </ul>
            </nav>
        @endif

        <!-- Right Action Items -->
        <div class="header-actions">
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
                <a href="{{ route('front.register') }}" class="btn-register" style="background:#004BEE; color:#fff !important; font-weight:700;">Become an Agent</a>
            @endif

            <!-- Right Side Menu Toggle Button -->
            <button class="header-menu-drawer-btn" id="headerMenuBtn" title="Menu" aria-label="Menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <!-- Mobile Hamburger Toggle -->
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

<!-- Right Side Offcanvas Drawer Menu Overlay -->
<div class="right-drawer-overlay" id="rightDrawerOverlay"></div>

<!-- Right Side Offcanvas Drawer Menu -->
<aside class="right-drawer-menu" id="rightDrawerMenu">
    <div class="drawer-header">
        @if(\Auth::check())
            <div style="font-weight: 700; color: #0B1948; font-size: 15px;">{{ auth()->user()->name }}</div>
        @else
            @if(!empty($dynamicLogo))
                <img src="{{ $dynamicLogo }}" alt="{{ $setting->logo_title ?? 'AGENT 24 INDIA' }}" style="height: 32px; max-width: 140px; object-fit: contain;">
            @else
                <div style="font-weight: 700; color: #0B1948; font-size: 15px;">{{ $setting->logo_title ?? 'AGENT 24 INDIA' }}</div>
            @endif
        @endif
        <button class="drawer-close-btn" id="drawerCloseBtn" aria-label="Close menu">&times;</button>
    </div>
    <ul class="drawer-nav-list">
        <li class="drawer-nav-item {{ request()->routeIs('front.index') ? 'active' : '' }}">
            <a href="{{route('front.index')}}" class="drawer-nav-link">Home</a>
        </li>
        @if(\Auth::check())
            <li class="drawer-nav-item"><a href="{{route('front.profile')}}" class="drawer-nav-link">My Profile</a></li>
            <li class="drawer-nav-item"><a href="{{route('front.addListing')}}" class="drawer-nav-link">My Listing</a></li>
            <li class="drawer-nav-item"><a href="{{route('front.addbanner')}}" class="drawer-nav-link">Banner Ad</a></li>
            <li class="drawer-nav-item"><a href="{{route('payment.histroy')}}" class="drawer-nav-link">Payment History</a></li>
        @else
            <li class="drawer-nav-item"><a href="{{route('login')}}" class="drawer-nav-link">Sign In / Register</a></li>
        @endif
        @if($about && $about->status == 1)
            <li class="drawer-nav-item"><a href="{{route('front.aboutus')}}" class="drawer-nav-link">About Us</a></li>
        @endif
        <li class="drawer-nav-item"><a href="{{route('front.contactus')}}" class="drawer-nav-link">Contact Us</a></li>
        @if($trem && $trem->status == 1)
            <li class="drawer-nav-item"><a href="{{route('front.price')}}" class="drawer-nav-link">Price</a></li>
        @endif
        <li class="drawer-nav-item"><a href="{{route('front.support')}}" class="drawer-nav-link">Support & Help</a></li>
        @if($trem && $trem->status == 1)
            <li class="drawer-nav-item"><a href="{{route('front.termsAndConditions')}}" class="drawer-nav-link">Terms & Conditions</a></li>
        @endif
        @if($privacy && $privacy->status == 1)
            <li class="drawer-nav-item"><a href="{{route('front.privacyPolicy')}}" class="drawer-nav-link">Privacy Policy</a></li>
        @endif
        @if(\Auth::check())
            <li class="drawer-nav-item"><a href="{{route('front.logout')}}" class="drawer-nav-link" style="color:#DC2626;" onclick="return confirm('Are you sure you want to logout?')">Logout</a></li>
        @endif
    </ul>
</aside>

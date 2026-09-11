@extends('front.layout.main')
@section('title', 'Privacy Policy - Agent 24 India')

@section('content')
    <!-- Privacy Policy Main Content Area Start -->
    <main class="terms-page-main" id="privacyMainContent">
        
        <!-- Privacy Hero Banner Section Start -->
        <section class="terms-hero-banner-section">
            <div class="terms-hero-banner-container">
                <div class="terms-hero-flex">
                    <div class="terms-hero-text">
                        <h1 class="terms-hero-title">Privacy Policy</h1>
                        <p class="terms-hero-subtitle">Your privacy and data security are paramount to us. Please read how Agent 24 India collects, protects, and handles your information.</p>
                    </div>
                    <div class="terms-hero-illustration">
                        <svg width="220" height="180" viewBox="0 0 220 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Subtle background skyline -->
                            <rect x="15" y="75" width="18" height="45" fill="#DBEAFE" rx="2" />
                            <rect x="37" y="55" width="22" height="65" fill="#BFDBFE" rx="2" opacity="0.7" />
                            <rect x="165" y="60" width="20" height="60" fill="#DBEAFE" rx="2" />
                            <rect x="189" y="50" width="22" height="70" fill="#BFDBFE" rx="2" opacity="0.7" />

                            <!-- Safe Box / Privacy Vault Base -->
                            <rect x="50" y="22" width="120" height="145" rx="16" fill="#FFFFFF" stroke="#004BEE" stroke-width="3" />
                            <rect x="58" y="30" width="104" height="129" rx="10" fill="#F8FAFC" />

                            <!-- Concentric Lock Dial Graphic -->
                            <circle cx="110" cy="80" r="32" fill="#EFF6FF" stroke="#004BEE" stroke-width="2.5" stroke-dasharray="4 3" />
                            <circle cx="110" cy="80" r="22" fill="#004BEE" />
                            
                            <!-- Keyhole in Center -->
                            <circle cx="110" cy="76" r="5" fill="#FFFFFF" />
                            <polygon points="107,77 113,77 115,87 105,87" fill="#FFFFFF" />

                            <!-- Data Privacy Nodes & Lines -->
                            <rect x="70" y="124" width="80" height="6" rx="3" fill="#CBD5E1" />
                            <rect x="80" y="136" width="60" height="6" rx="3" fill="#94A3B8" />

                            <!-- Shield Badge Overlap Bottom Right -->
                            <g filter="url(#shield-shadow-pp)">
                                <path d="M142 98 C142 86, 172 78, 172 78 C172 78, 202 86, 202 98 C202 126, 172 144, 172 144 C172 144, 142 126, 142 98 Z" fill="url(#blue-shield-grad-pp)" stroke="#60A5FA" stroke-width="2" />
                                <path d="M161 110 L168 117 L184 101" stroke="#FFFFFF" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>

                            <defs>
                                <linearGradient id="blue-shield-grad-pp" x1="142" y1="78" x2="202" y2="144" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#2563EB" />
                                    <stop offset="1" stop-color="#0038A8" />
                                </linearGradient>
                                <filter id="shield-shadow-pp" x="134" y="72" width="76" height="82" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feDropShadow dx="0" dy="4" stdDeviation="4" flood-color="#0038A8" flood-opacity="0.3" />
                                </filter>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <!-- Privacy Hero Banner Section End -->

        <!-- Privacy Policy Content Section Start -->
        <section class="terms-content-section">
            <div class="section-container" style="max-width: 1040px; margin: 0 auto; padding: 25px 24px 45px 24px;">
                
                <div class="terms-card">
                    
                    @if(!empty($privacyPolicy) && !empty($privacyPolicy->description))
                        <div class="terms-block">
                            <h2 class="terms-heading" style="margin-bottom: 16px;">{{ $privacyPolicy->title ?? 'Privacy Policy & Data Security' }}</h2>
                            <div class="terms-text" style="line-height: 1.8; color: #334155;">
                                {!! $privacyPolicy->description !!}
                            </div>
                        </div>
                    @else
                        <!-- 1. Introduction -->
                        <div class="terms-block">
                            <h2 class="terms-heading">1. Introduction & Scope</h2>
                            <p class="terms-text">
                                At Agent 24 India, accessible from our official website, one of our main priorities is the privacy of our visitors and registered agents. This Privacy Policy document outlines the types of personal and business information that is collected and recorded by Agent 24 India and how we utilize it.
                            </p>
                        </div>

                        <!-- 2. Information We Collect -->
                        <div class="terms-block">
                            <h2 class="terms-heading">2. Information We Collect</h2>
                            <ul class="terms-list">
                                <li><strong>Personal Details:</strong> Name, contact number, email address, and profile photographs provided voluntarily during registration.</li>
                                <li><strong>Business & Listing Information:</strong> Business name, services offered, office address, city, district, state, and relevant operational information.</li>
                                <li><strong>Log Files & Technical Data:</strong> Internet Protocol (IP) addresses, browser type, Internet Service Provider (ISP), date/time stamps, referring/exit pages, and click interactions to analyze trends and administer the site.</li>
                            </ul>
                        </div>

                        <!-- 3. How We Use Your Information -->
                        <div class="terms-block">
                            <h2 class="terms-heading">3. How We Use Your Information</h2>
                            <ul class="terms-list">
                                <li>Provide, operate, and maintain our agent directory and connectivity services.</li>
                                <li>Connect prospective clients and customers with registered, verified agents in their area.</li>
                                <li>Improve, personalize, and expand platform tools and features.</li>
                                <li>Send notifications, updates, OTP verifications, and customer support communications.</li>
                                <li>Prevent fraudulent activities, unauthorized listings, and protect platform security.</li>
                            </ul>
                        </div>

                        <!-- 4. Data Protection & Security -->
                        <div class="terms-block">
                            <h2 class="terms-heading">4. Data Protection & Security</h2>
                            <p class="terms-text">
                                We employ industry-standard encryption protocols, secure servers, and strict access controls to safeguard your sensitive information against unauthorized access, alteration, disclosure, or destruction.
                            </p>
                        </div>

                        <!-- 5. Third-Party Services & Cookies -->
                        <div class="terms-block">
                            <h2 class="terms-heading">5. Third-Party Services & Cookies</h2>
                            <p class="terms-text">
                                Agent 24 India uses standard cookies to store information including visitors' preferences and the pages on the website that the visitor accessed. We do not sell, rent, or trade your personal identifiable information to third-party marketing companies without explicit consent.
                            </p>
                        </div>

                        <!-- 6. User Rights & Data Control -->
                        <div class="terms-block">
                            <h2 class="terms-heading">6. User Rights & Data Control</h2>
                            <p class="terms-text">
                                Every registered user and agent has the right to access, update, rectify, or request deletion of their profile details directly via their profile dashboard or by contacting our support team.
                            </p>
                        </div>

                        <!-- 7. Contact Us -->
                        <div class="terms-block">
                            <h2 class="terms-heading">7. Contact Us</h2>
                            <p class="terms-text">
                                If you have additional questions or require more information about our Privacy Policy, please feel free to reach us at: <a href="mailto:{{ $setting->email ?? 'support@agent24india.com' }}" class="terms-email-link">{{ $setting->email ?? 'support@agent24india.com' }}</a>
                            </p>
                        </div>
                    @endif

                    <!-- Bottom Action Bar (Checkbox & I Agree Button) -->
                    <div class="terms-action-bar">
                        <label class="terms-checkbox-label" for="privacyCheck">
                            <input type="checkbox" id="privacyCheck" class="terms-checkbox" checked>
                            <span>I have read and agree to the Privacy Policy.</span>
                        </label>
                        
                        <a href="{{ route('front.index') }}" class="btn-terms-agree" id="btnPrivacyAgree">I Agree</a>
                    </div>

                </div>

            </div>
        </section>
        <!-- Privacy Policy Content Section End -->

        <!-- Dark Blue Metrics Stats Bar Section Start -->
        <section class="terms-stats-bar-section">
            <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px 40px 24px;">
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
                            <span class="dark-stat-number">2500+</span>
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

                    <!-- Stat 5: Full Support Available -->
                    <div class="dark-stat-col">
                        <div class="dark-stat-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                            </svg>
                        </div>
                        <div class="dark-stat-text">
                            <span class="dark-stat-number">Full</span>
                            <span class="dark-stat-label">Support Available</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Dark Blue Metrics Stats Bar Section End -->

    </main>

    <style>
        .terms-page-main {
            background-color: #F8FAFC;
        }
        .terms-hero-banner-section {
            padding: 24px 0;
            width: 100%;
            background: linear-gradient(180deg, #F0F6FF 0%, #E8F0FE 100%);
            border-bottom: 1px solid #E2E8F0;
        }
        .terms-hero-banner-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }
        .terms-hero-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }
        .terms-hero-title {
            font-size: 36px;
            font-weight: 800;
            color: #004BEE;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }
        .terms-hero-subtitle {
            font-size: 15px;
            font-weight: 500;
            color: #334155;
            margin: 0;
            line-height: 1.6;
            max-width: 600px;
        }
        .terms-hero-illustration {
            flex-shrink: 0;
            line-height: 0;
        }
        .terms-card {
            background-color: #FFFFFF;
            border: 1.5px solid #E2E8F0;
            border-radius: 16px;
            padding: 36px 42px;
            box-shadow: 0 4px 20px rgba(0, 75, 238, 0.04);
        }
        .terms-block {
            margin-bottom: 24px;
        }
        .terms-block:last-of-type {
            margin-bottom: 28px;
        }
        .terms-heading {
            font-size: 17.5px;
            font-weight: 800;
            color: #004BEE;
            margin-bottom: 8px;
            letter-spacing: -0.2px;
        }
        .terms-text {
            font-size: 15px;
            font-weight: 500;
            color: #334155;
            line-height: 1.7;
            margin: 0;
        }
        .terms-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .terms-list li {
            position: relative;
            padding-left: 20px;
            font-size: 15px;
            font-weight: 500;
            color: #334155;
            line-height: 1.7;
            margin-bottom: 6px;
        }
        .terms-list li::before {
            content: "•";
            position: absolute;
            left: 5px;
            top: 0;
            color: #0F172A;
            font-weight: 900;
            font-size: 16px;
        }
        .terms-email-link {
            color: #004BEE;
            font-weight: 700;
            text-decoration: none;
        }
        .terms-email-link:hover {
            text-decoration: underline;
        }
        .terms-action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1.5px solid #E2E8F0;
            flex-wrap: wrap;
        }
        .terms-checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14.5px;
            font-weight: 700;
            color: #0F172A;
            cursor: pointer;
            user-select: none;
        }
        .terms-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #004BEE;
            cursor: pointer;
        }
        .btn-terms-agree {
            background-color: #004BEE;
            color: #FFFFFF;
            font-size: 15.5px;
            font-weight: 700;
            padding: 11px 34px;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(0, 75, 238, 0.25);
            transition: all 0.25s ease;
            display: inline-block;
            border: none;
        }
        .btn-terms-agree:hover {
            background-color: #0036A8;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(0, 75, 238, 0.35);
            color: #FFFFFF;
        }
        @media (max-width: 768px) {
            .terms-hero-flex {
                flex-direction: column;
                text-align: center;
                align-items: center;
            }
            .terms-hero-title {
                font-size: 28px;
            }
            .terms-card {
                padding: 24px 20px;
                border-radius: 14px;
            }
            .terms-heading {
                font-size: 16px;
            }
            .terms-text,
            .terms-list li {
                font-size: 14px;
            }
            .terms-action-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .btn-terms-agree {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var privacyCheck = document.getElementById('privacyCheck');
            var btnPrivacyAgree = document.getElementById('btnPrivacyAgree');
            if (privacyCheck && btnPrivacyAgree) {
                privacyCheck.addEventListener('change', function() {
                    if (this.checked) {
                        btnPrivacyAgree.style.opacity = '1';
                        btnPrivacyAgree.style.pointerEvents = 'auto';
                    } else {
                        btnPrivacyAgree.style.opacity = '0.5';
                        btnPrivacyAgree.style.pointerEvents = 'none';
                    }
                });
            }
        });
    </script>
@endsection
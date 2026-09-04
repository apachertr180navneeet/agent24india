@extends('front.layout.main')
@section('title', 'Terms & Conditions - Agent 24 India')

@section('content')
    <!-- Terms & Conditions Main Content Area Start -->
    <main class="terms-page-main" id="termsMainContent">
        
        <!-- Terms Hero Banner Section Start -->
        <section class="terms-hero-banner-section">
            <div class="terms-hero-banner-container">
                <div class="terms-hero-flex">
                    <div class="terms-hero-text">
                        <h1 class="terms-hero-title">Terms & Conditions</h1>
                        <p class="terms-hero-subtitle">Please read these terms and conditions carefully before using the Agent 24 India platform.</p>
                    </div>
                    <div class="terms-hero-illustration">
                        <svg width="220" height="180" viewBox="0 0 220 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Subtle background skyline -->
                            <rect x="10" y="70" width="16" height="50" fill="#DBEAFE" rx="2" />
                            <rect x="30" y="55" width="20" height="65" fill="#BFDBFE" rx="2" opacity="0.7" />
                            <rect x="54" y="65" width="16" height="55" fill="#DBEAFE" rx="2" />
                            <rect x="170" y="60" width="18" height="60" fill="#DBEAFE" rx="2" />
                            <rect x="192" y="50" width="22" height="70" fill="#BFDBFE" rx="2" opacity="0.7" />

                            <!-- Clipboard Board -->
                            <rect x="45" y="15" width="125" height="155" rx="14" fill="#FFFFFF" stroke="#3B82F6" stroke-width="3.5" />
                            <!-- Clip at top -->
                            <rect x="80" y="8" width="55" height="16" rx="5" fill="#475569" />
                            <circle cx="107.5" cy="16" r="3.5" fill="#FFFFFF" />

                            <!-- Checklist items -->
                            <!-- Item 1 -->
                            <path d="M62 48l6 6 12-12" stroke="#16A34A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            <rect x="86" y="46" width="65" height="6" rx="3" fill="#CBD5E1" />

                            <!-- Item 2 -->
                            <path d="M62 76l6 6 12-12" stroke="#16A34A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            <rect x="86" y="74" width="58" height="6" rx="3" fill="#CBD5E1" />

                            <!-- Item 3 -->
                            <path d="M62 104l6 6 12-12" stroke="#16A34A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            <rect x="86" y="102" width="62" height="6" rx="3" fill="#CBD5E1" />

                            <!-- Item 4 (Checked Box) -->
                            <rect x="62" y="128" width="16" height="16" rx="3" fill="#EFF6FF" stroke="#004BEE" stroke-width="2" />
                            <path d="M66 136l3 3 6-6" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                            <rect x="86" y="133" width="50" height="6" rx="3" fill="#CBD5E1" />

                            <!-- Security Shield with Checkmark (Overlaying Bottom Right) -->
                            <g filter="url(#shield-shadow)">
                                <path d="M142 98 C142 86, 172 78, 172 78 C172 78, 202 86, 202 98 C202 126, 172 144, 172 144 C172 144, 142 126, 142 98 Z" fill="url(#blue-shield-grad)" stroke="#60A5FA" stroke-width="2" />
                                <path d="M161 110 L168 117 L184 101" stroke="#FFFFFF" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>

                            <defs>
                                <linearGradient id="blue-shield-grad" x1="142" y1="78" x2="202" y2="144" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#2563EB" />
                                    <stop offset="1" stop-color="#0038A8" />
                                </linearGradient>
                                <filter id="shield-shadow" x="134" y="72" width="76" height="82" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feDropShadow dx="0" dy="4" stdDeviation="4" flood-color="#0038A8" flood-opacity="0.3" />
                                </filter>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <!-- Terms Hero Banner Section End -->

        <!-- Terms & Conditions Content Section Start -->
        <section class="terms-content-section">
            <div class="section-container" style="max-width: 1040px; margin: 0 auto; padding: 25px 24px 45px 24px;">
                
                <div class="terms-card">
                    
                    <!-- 1. General Terms -->
                    <div class="terms-block">
                        <h2 class="terms-heading">1. General Terms</h2>
                        <p class="terms-text">
                            Agent 24 India is an online platform that connects verified Agents and Businesses. We do not provide agency services directly; our platform exclusively provides business listing, discovery, and verified connectivity services.
                        </p>
                    </div>

                    <!-- 2. Account & Information -->
                    <div class="terms-block">
                        <h2 class="terms-heading">2. Account & Information</h2>
                        <ul class="terms-list">
                            <li>Users must provide accurate, complete, and authentic information during registration and listing creation.</li>
                            <li>Providing false, misleading, or fraudulent information may result in immediate account suspension or termination.</li>
                            <li>Users are solely responsible for maintaining the security and confidentiality of their account credentials.</li>
                        </ul>
                    </div>

                    <!-- 3. Payments & Refunds -->
                    <div class="terms-block">
                        <h2 class="terms-heading">3. Payments & Refunds</h2>
                        <ul class="terms-list">
                            <li>All payments must be made in accordance with our designated growth and subscription plans.</li>
                            <li>Payments once processed and completed are non-refundable.</li>
                            <li>Subscription plans, features, and pricing are subject to change without prior notice.</li>
                        </ul>
                    </div>

                    <!-- 4. Listings & Content -->
                    <div class="terms-block">
                        <h2 class="terms-heading">4. Listings & Content</h2>
                        <ul class="terms-list">
                            <li>Users assume full responsibility for all content, images, and details published on their listings.</li>
                            <li>We are not liable for any inaccurate, misleading, or unauthorized third-party content.</li>
                            <li>We reserve the right to review, edit, or remove any listing at any time at our sole discretion.</li>
                        </ul>
                    </div>

                    <!-- 5. Limitation of Liability -->
                    <div class="terms-block">
                        <h2 class="terms-heading">5. Limitation of Liability</h2>
                        <p class="terms-text">
                            While we strive for excellence, we do not guarantee the completeness or accuracy of user-provided information. Agent 24 India shall not be held liable for any direct, indirect, or incidental disputes, losses, or damages arising from connections established through the platform.
                        </p>
                    </div>

                    <!-- 6. Changes to Terms -->
                    <div class="terms-block">
                        <h2 class="terms-heading">6. Changes to Terms</h2>
                        <p class="terms-text">
                            We reserve the right to update or modify these Terms & Conditions at any time. Any revisions will become effective immediately upon being posted on this website.
                        </p>
                    </div>

                    <!-- 7. Contact Us -->
                    <div class="terms-block">
                        <h2 class="terms-heading">7. Contact Us</h2>
                        <p class="terms-text">
                            If you have any questions, inquiries, or concerns regarding these terms, please contact us at: <a href="mailto:{{ $setting->email ?? 'support@agent24india.com' }}" class="terms-email-link">{{ $setting->email ?? 'support@agent24india.com' }}</a>
                        </p>
                    </div>

                    <!-- Bottom Action Bar (Checkbox & I Agree Button) -->
                    <div class="terms-action-bar">
                        <label class="terms-checkbox-label" for="termsCheck">
                            <input type="checkbox" id="termsCheck" class="terms-checkbox" checked>
                            <span>I have read and agree to the Terms & Conditions.</span>
                        </label>
                        
                        <a href="{{ route('front.index') }}" class="btn-terms-agree" id="btnTermsAgree">I Agree</a>
                    </div>

                </div>

            </div>
        </section>
        <!-- Terms & Conditions Content Section End -->

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
            var termsCheck = document.getElementById('termsCheck');
            var btnTermsAgree = document.getElementById('btnTermsAgree');
            if (termsCheck && btnTermsAgree) {
                termsCheck.addEventListener('change', function() {
                    if (this.checked) {
                        btnTermsAgree.style.opacity = '1';
                        btnTermsAgree.style.pointerEvents = 'auto';
                    } else {
                        btnTermsAgree.style.opacity = '0.5';
                        btnTermsAgree.style.pointerEvents = 'none';
                    }
                });
            }
        });
    </script>
@endsection
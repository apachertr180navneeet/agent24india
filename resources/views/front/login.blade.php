@extends('front.layout.main')
@section('title', 'Login - Agent 24 India')

@push('styles')
<style>
    .login-page-main {
        background-color: #F8FAFC;
        padding-bottom: 50px;
    }

    /* Hero Banner */
    .login-hero-banner-section {
        padding: 0;
        width: 100%;
        background-color: #EEF5FE;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-hero-banner-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0;
        width: 100%;
    }

    .login-hero-banner-img {
        width: 100%;
        height: auto;
        max-height: 250px;
        object-fit: contain;
        object-position: center;
        display: block;
    }

    /* Main Section Container */
    .login-content-section {
        padding: 32px 0 0 0;
    }

    .login-main-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* Split Grid */
    .login-split-grid {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 30px;
        align-items: stretch;
    }

    /* Left Card: Login Form */
    .login-card {
        background: #FFFFFF;
        border: 1.5px solid #E2E8F0;
        border-radius: 18px;
        padding: 36px 40px;
        box-shadow: 0 4px 20px rgba(0, 75, 238, 0.04);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-card-header {
        text-align: center;
        margin-bottom: 24px;
    }

    .user-avatar-circle {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background-color: #EEF4FE;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px auto;
        color: #004BEE;
    }

    .login-title {
        font-size: 24px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 6px;
        letter-spacing: -0.3px;
    }

    .login-subtitle {
        font-size: 14px;
        color: #64748B;
        margin: 0;
    }

    /* Form Fields */
    .form-field-group {
        margin-bottom: 18px;
    }

    .input-field-label {
        display: block;
        font-size: 13.5px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 7px;
    }

    .input-icon-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon-wrapper .field-icon {
        position: absolute;
        left: 14px;
        color: #94A3B8;
        pointer-events: none;
        z-index: 2;
    }

    .styled-login-input {
        width: 100%;
        height: 48px;
        border: 1.5px solid #CBD5E1;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        color: #0F172A;
        background-color: #FFFFFF;
        padding-left: 42px;
        padding-right: 42px;
        outline: none;
        transition: all 0.2s ease;
    }

    .styled-login-input:focus {
        border-color: #004BEE;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.12);
    }

    .styled-login-input::placeholder {
        color: #94A3B8;
        font-weight: 400;
    }

    .password-toggle-btn {
        position: absolute;
        right: 12px;
        background: transparent;
        border: none;
        cursor: pointer;
        color: #94A3B8;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
    }

    .password-toggle-btn:hover {
        color: #004BEE;
    }

    /* Options Row */
    .auth-options-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .remember-checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        font-weight: 600;
        color: #1E293B;
        cursor: pointer;
        user-select: none;
    }

    .remember-checkbox-label input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #004BEE;
        cursor: pointer;
    }

    .forgot-pass-link {
        font-size: 13.5px;
        font-weight: 700;
        color: #004BEE;
        text-decoration: none;
        transition: color 0.2s;
    }

    .forgot-pass-link:hover {
        color: #0036B8;
        text-decoration: underline;
    }

    /* Submit Button */
    .btn-login-submit {
        width: 100%;
        height: 48px;
        background-color: #004BEE;
        color: #FFFFFF;
        border: none;
        border-radius: 10px;
        font-size: 15.5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(0, 75, 238, 0.25);
    }

    .btn-login-submit:hover {
        background-color: #0038A8;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(0, 75, 238, 0.35);
    }

    /* Divider */
    .auth-divider-wrap {
        display: flex;
        align-items: center;
        margin: 22px 0;
        gap: 12px;
    }

    .auth-divider-line {
        flex: 1;
        height: 1px;
        background-color: #E2E8F0;
    }

    .auth-divider-text {
        font-size: 12.5px;
        color: #94A3B8;
        font-weight: 500;
    }

    /* Social Buttons */
    .social-login-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 22px;
    }

    .btn-social-login {
        height: 44px;
        background: #FFFFFF;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #1E293B;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0 10px;
    }

    .btn-social-login:hover {
        background-color: #F8FAFC;
        border-color: #CBD5E1;
    }

    .login-card-footer {
        text-align: center;
        font-size: 13.5px;
        color: #64748B;
        font-weight: 500;
    }

    .login-card-footer a {
        color: #004BEE;
        font-weight: 700;
        text-decoration: none;
        margin-left: 4px;
    }

    .login-card-footer a:hover {
        text-decoration: underline;
    }

    /* Right Card: Why Agent 24 India */
    .why-agent-card {
        background: #FFFFFF;
        border: 1.5px solid #E2E8F0;
        border-radius: 18px;
        padding: 32px 28px 0 28px;
        box-shadow: 0 4px 20px rgba(0, 75, 238, 0.04);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        position: relative;
    }

    .why-agent-title {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        text-align: center;
        margin-bottom: 24px;
        letter-spacing: -0.2px;
    }

    .why-features-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 20px;
    }

    .why-feature-item {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .why-feature-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background-color: #EFF6FF;
        border: 1px solid #DBEAFE;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #004BEE;
    }

    .why-feature-heading {
        font-size: 14.5px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 2px;
    }

    .why-feature-desc {
        font-size: 12.5px;
        color: #64748B;
        line-height: 1.35;
        margin: 0;
    }

    /* India Gate Landmark Graphic at bottom of Why card */
    .why-agent-landmark-wrap {
        margin-top: 10px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        line-height: 0;
    }

    .why-agent-landmark-wrap svg {
        width: 100%;
        max-width: 320px;
        height: auto;
    }

    /* Middle Banner: Secure Login. Safe Business. */
    .secure-login-banner {
        background: linear-gradient(90deg, #091A46 0%, #0D266E 50%, #07173D 100%);
        border-radius: 16px;
        padding: 22px 36px;
        margin: 32px 0 28px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #FFFFFF;
        box-shadow: 0 10px 30px rgba(9, 26, 70, 0.25);
    }

    .sl-left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .sl-badge-icon {
        position: relative;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sl-title {
        font-size: 18px;
        font-weight: 800;
        color: #FFFFFF;
        margin-bottom: 3px;
        letter-spacing: -0.2px;
    }

    .sl-desc {
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.82);
        margin: 0;
    }

    .sl-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .sl-lock-badge {
        width: 42px;
        height: 42px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #60A5FA;
    }

    .sl-tagline {
        font-size: 14px;
        font-weight: 700;
        color: #FFFFFF;
        line-height: 1.4;
    }

    /* White Metrics Stats Bar */
    .white-stats-card {
        background: #FFFFFF;
        border: 1.5px solid #E2E8F0;
        border-radius: 16px;
        padding: 22px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 20px rgba(0, 75, 238, 0.03);
    }

    .ws-col {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        justify-content: center;
    }

    .ws-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #004BEE;
        flex-shrink: 0;
    }

    .ws-number {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1.15;
    }

    .ws-label {
        font-size: 12.5px;
        font-weight: 600;
        color: #64748B;
        white-space: nowrap;
    }

    .ws-divider {
        width: 1px;
        height: 38px;
        background-color: #E2E8F0;
    }

    @media (max-width: 991px) {
        .login-split-grid {
            grid-template-columns: 1fr;
        }
        .secure-login-banner {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            padding: 20px 24px;
        }
        .white-stats-card {
            flex-wrap: wrap;
            gap: 16px;
            padding: 20px;
        }
        .ws-col {
            min-width: 45%;
            justify-content: flex-start;
        }
        .ws-divider {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .login-card {
            padding: 26px 18px;
            border-radius: 14px;
        }
        .why-agent-card {
            padding: 24px 18px 0 18px;
            border-radius: 14px;
        }
        .social-login-grid {
            grid-template-columns: 1fr;
        }
        .white-stats-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        .ws-col {
            min-width: unset;
        }
        .login-hero-banner-img {
            max-height: 180px;
        }
    }
</style>
@endpush

@section('content')
<main class="login-page-main" id="loginPageMain">

    <!-- Hero Banner Section -->
    <section class="login-hero-banner-section">
        <div class="login-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/login_hero_banner.png') }}" alt="Welcome Back! - Login to your Agent 24 India account" class="login-hero-banner-img" onerror="this.onerror=null; this.src='{{ asset('front/assets/images/login_hero_banner.png') }}';">
        </div>
    </section>

    <!-- Main Login Content Section -->
    <section class="login-content-section">
        <div class="login-main-container">
            
            <div class="login-split-grid">

                <!-- Left Column: Login Card -->
                <div class="login-card">
                    <div class="login-card-header">
                        <div class="user-avatar-circle">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h1 class="login-title">Login to Your Account</h1>
                        <p class="login-subtitle">Enter your credentials to continue</p>
                    </div>

                    @if(session('error'))
                        <div style="background: #FEE2E2; color: #991B1B; padding: 12px 16px; border-radius: 10px; font-size: 13.5px; font-weight: 600; margin-bottom: 20px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div style="background: #DCFCE7; color: #166534; padding: 12px 16px; border-radius: 10px; font-size: 13.5px; font-weight: 600; margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('front.login') }}" method="POST" id="loginForm">
                        @csrf

                        <!-- Email Address / Mobile Number -->
                        <div class="form-field-group">
                            <label class="input-field-label">Email Address / Mobile Number</label>
                            <div class="input-icon-wrapper">
                                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <input type="text" name="email" id="loginEmail" class="styled-login-input" placeholder="Enter email address or mobile number" required autofocus value="{{ old('email') }}">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-field-group">
                            <label class="input-field-label">Password</label>
                            <div class="input-icon-wrapper">
                                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input type="password" name="password" id="loginPassword" class="styled-login-input" placeholder="Enter your password" required>
                                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('loginPassword', 'eyeIconLogin')" aria-label="Toggle Password">
                                    <svg id="eyeIconLogin" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Options Row -->
                        <div class="auth-options-row">
                            <label class="remember-checkbox-label">
                                <input type="checkbox" name="remember" id="rememberMe" checked>
                                <span>Remember Me</span>
                            </label>
                            <a href="{{ route('forgotPassword') }}" class="forgot-pass-link">Forgot Password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-login-submit">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                <polyline points="10 17 15 12 10 7"></polyline>
                                <line x1="15" y1="12" x2="3" y2="12"></line>
                            </svg>
                            <span>Login</span>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="auth-divider-wrap">
                        <span class="auth-divider-line"></span>
                        <span class="auth-divider-text">or continue with</span>
                        <span class="auth-divider-line"></span>
                    </div>

                    <!-- Social / Alternative Login Buttons -->
                    <div class="social-login-grid">
                        <button type="button" class="btn-social-login" onclick="alert('Google login will be available soon!');">
                            <svg width="18" height="18" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                            </svg>
                            <span>Login with Google</span>
                        </button>
                        <button type="button" class="btn-social-login" onclick="alert('Mobile OTP login will be available soon!');">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <span>Login with Mobile OTP</span>
                        </button>
                    </div>

                    <!-- Footer Link -->
                    <div class="login-card-footer">
                        <span>Don't have an account?</span>
                        <a href="{{ route('front.register') }}">Register Now</a>
                    </div>
                </div>

                <!-- Right Column: Why Agent 24 India? -->
                <div class="why-agent-card">
                    <div>
                        <h2 class="why-agent-title">Why Agent 24 India?</h2>

                        <div class="why-features-list">
                            <!-- Feature 1 -->
                            <div class="why-feature-item">
                                <div class="why-feature-icon-box">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                        <polyline points="9 12 11 14 15 10"/>
                                    </svg>
                                </div>
                                <div class="why-feature-text">
                                    <h4 class="why-feature-heading">Trusted & Secure Platform</h4>
                                    <p class="why-feature-desc">100% Safe and Secure for your Business.</p>
                                </div>
                            </div>

                            <!-- Feature 2 -->
                            <div class="why-feature-item">
                                <div class="why-feature-icon-box">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="why-feature-text">
                                    <h4 class="why-feature-heading">All India Visibility</h4>
                                    <p class="why-feature-desc">Get visibility in 500+ Cities across India.</p>
                                </div>
                            </div>

                            <!-- Feature 3 -->
                            <div class="why-feature-item">
                                <div class="why-feature-icon-box">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                        <text x="11.5" y="14.5" font-size="7.5" font-weight="bold" fill="#004BEE" stroke="none" text-anchor="middle">₹</text>
                                    </svg>
                                </div>
                                <div class="why-feature-text">
                                    <h4 class="why-feature-heading">Affordable Plans</h4>
                                    <p class="why-feature-desc">Low Cost Plans for every Agent and Business.</p>
                                </div>
                            </div>

                            <!-- Feature 4 -->
                            <div class="why-feature-item">
                                <div class="why-feature-icon-box">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="20" x2="18" y2="10"></line>
                                        <line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                        <polyline points="3 8 10 3 14 6 21 1"></polyline>
                                    </svg>
                                </div>
                                <div class="why-feature-text">
                                    <h4 class="why-feature-heading">Grow Your Business</h4>
                                    <p class="why-feature-desc">More visibility, more leads and more customers.</p>
                                </div>
                            </div>

                            <!-- Feature 5 -->
                            <div class="why-feature-item">
                                <div class="why-feature-icon-box">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                    </svg>
                                </div>
                                <div class="why-feature-text">
                                    <h4 class="why-feature-heading">24x7 Support</h4>
                                    <p class="why-feature-desc">Our support team is always here to help you.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Landmark Illustration at Bottom of Why Card -->
                    <div class="why-agent-landmark-wrap">
                        <svg viewBox="0 0 400 130" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Background City Skyline Silhouette -->
                            <rect x="25" y="55" width="22" height="65" fill="#E2E8F0" rx="2" />
                            <rect x="52" y="42" width="28" height="78" fill="#DBEAFE" rx="2" />
                            <rect x="85" y="60" width="20" height="60" fill="#E2E8F0" rx="2" />
                            <rect x="295" y="58" width="22" height="62" fill="#E2E8F0" rx="2" />
                            <rect x="322" y="40" width="28" height="80" fill="#DBEAFE" rx="2" />
                            <rect x="355" y="52" width="24" height="68" fill="#E2E8F0" rx="2" />
                            
                            <!-- Green Trees / Shrubs -->
                            <circle cx="115" cy="108" r="14" fill="#84CC16" opacity="0.85" />
                            <circle cx="132" cy="112" r="11" fill="#65A30D" opacity="0.9" />
                            <circle cx="268" cy="112" r="11" fill="#65A30D" opacity="0.9" />
                            <circle cx="285" cy="108" r="14" fill="#84CC16" opacity="0.85" />
                            <path d="M0 126 C120 120, 280 120, 400 126 L400 130 L0 130 Z" fill="#94A3B8" opacity="0.3" />

                            <!-- India Gate / Monument Base and Columns -->
                            <!-- Base Steps -->
                            <rect x="145" y="116" width="110" height="6" fill="#D4A373" rx="1" />
                            <rect x="152" y="112" width="96" height="4" fill="#E5B887" rx="1" />
                            
                            <!-- Main Left & Right Pylons -->
                            <rect x="160" y="42" width="22" height="70" fill="#E5B887" />
                            <rect x="164" y="46" width="14" height="66" fill="#D4A373" />
                            <rect x="218" y="42" width="22" height="70" fill="#E5B887" />
                            <rect x="222" y="46" width="14" height="66" fill="#D4A373" />

                            <!-- Central Arch -->
                            <path d="M182 82 Q200 66 218 82 L218 112 L182 112 Z" fill="#78350F" opacity="0.85" />
                            <path d="M184 84 Q200 70 216 84 L216 112 L184 112 Z" fill="#451A03" />

                            <!-- Horizontal Cornices / Entablature -->
                            <rect x="156" y="38" width="88" height="5" fill="#C59363" rx="1" />
                            <rect x="154" y="28" width="92" height="10" fill="#E5B887" rx="1" />
                            <!-- Relief Text line on Attic -->
                            <rect x="165" y="31" width="70" height="3.5" fill="#B27E4E" rx="1" />

                            <!-- Top Dome / Finial / Crown -->
                            <rect x="170" y="24" width="60" height="4" fill="#C59363" rx="1" />
                            <rect x="180" y="20" width="40" height="4" fill="#E5B887" rx="1" />
                            <ellipse cx="200" cy="18" rx="10" ry="3" fill="#B27E4E" />
                        </svg>
                    </div>
                </div>

            </div>

            <!-- Middle Banner: Secure Login. Safe Business. -->
            <div class="secure-login-banner">
                <div class="sl-left">
                    <div class="sl-badge-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" fill="#1D4ED8" stroke="#3B82F6" stroke-width="1.8" />
                            <path d="M9 12l2 2 4-4" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <!-- Small green verified badge -->
                        <span style="position: absolute; bottom: 0; right: 0; width: 18px; height: 18px; background: #16A34A; border: 2px solid #091A46; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                    </div>
                    <div>
                        <h3 class="sl-title">Secure Login. Safe Business.</h3>
                        <p class="sl-desc">We protect your data and privacy with top level security.</p>
                    </div>
                </div>

                <div class="sl-right">
                    <div class="sl-lock-badge">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            <circle cx="12" cy="16" r="1"></circle>
                        </svg>
                    </div>
                    <div class="sl-tagline">
                        Your information is<br>100% safe with us.
                    </div>
                </div>
            </div>

            <!-- White Metrics Stats Bar -->
            <div class="white-stats-card">
                <!-- 10,000+ Verified Agents -->
                <div class="ws-col">
                    <div class="ws-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="ws-text">
                        <div class="ws-number">10,000+</div>
                        <div class="ws-label">Verified Agents</div>
                    </div>
                </div>

                <div class="ws-divider"></div>

                <!-- 500+ Cities Covered -->
                <div class="ws-col">
                    <div class="ws-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div class="ws-text">
                        <div class="ws-number">500+</div>
                        <div class="ws-label">Cities Covered</div>
                    </div>
                </div>

                <div class="ws-divider"></div>

                <!-- 50+ Categories -->
                <div class="ws-col">
                    <div class="ws-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </div>
                    <div class="ws-text">
                        <div class="ws-number">50+</div>
                        <div class="ws-label">Categories</div>
                    </div>
                </div>

                <div class="ws-divider"></div>

                <!-- 1L+ Happy Customers -->
                <div class="ws-col">
                    <div class="ws-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                        </svg>
                    </div>
                    <div class="ws-text">
                        <div class="ws-number">1L+</div>
                        <div class="ws-label">Happy Customers</div>
                    </div>
                </div>

                <div class="ws-divider"></div>

                <!-- 24x7 Support Available -->
                <div class="ws-col">
                    <div class="ws-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                        </svg>
                    </div>
                    <div class="ws-text">
                        <div class="ws-number">24x7</div>
                        <div class="ws-label">Support Available</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>
@endsection

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, iconId) {
        var input = document.getElementById(inputId);
        var icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    }
</script>
@endpush

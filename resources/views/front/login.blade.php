@extends('front.layout.main')
@section('title', 'Login - Agent 24 India')

@push('styles')
<style>
    .login-hero-banner-section {
        padding: 16px 0 0 0;
        background-color: #F8FAFC;
    }

    .login-hero-banner-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .login-hero-banner-img {
        width: 100%;
        height: auto;
        border-radius: 16px;
        display: block;
        box-shadow: 0 6px 20px rgba(0, 75, 238, 0.08);
    }

    .auth-page-section {
        padding: 36px 0 60px 0;
        background-color: #F8FAFC;
    }

    .login-split-wrapper {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 32px;
        align-items: start;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media (max-width: 991px) {
        .login-split-wrapper {
            grid-template-columns: 1fr;
        }
    }

    /* Left Login Card */
    .auth-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        padding: 40px;
    }

    .auth-card-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .user-avatar-circle {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background-color: #EFF6FF;
        border: 2px solid #BFDBFE;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px auto;
        color: #004BEE;
    }

    .auth-title {
        font-size: 24px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 6px;
    }

    .auth-subtitle {
        font-size: 14px;
        color: #64748B;
    }

    .form-field-group {
        margin-bottom: 20px;
    }

    .input-field-label {
        display: block;
        font-size: 13.5px;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 8px;
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

    .styled-contact-input {
        width: 100%;
        height: 48px;
        border: 1.5px solid #CBD5E1;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #0F172A;
        background-color: #FFFFFF;
        outline: none;
        transition: all 0.2s ease;
    }

    .styled-contact-input.icon-input {
        padding-left: 42px;
        padding-right: 42px;
    }

    .styled-contact-input:focus {
        border-color: #004BEE;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.12);
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

    .auth-options-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .remember-checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        font-weight: 600;
        color: #475569;
        cursor: pointer;
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

    .auth-submit-btn {
        width: 100%;
        height: 48px;
        background-color: #004BEE;
        color: #FFFFFF;
        border: none;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(0, 75, 238, 0.25);
    }

    .auth-submit-btn:hover {
        background-color: #0036B8;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 75, 238, 0.35);
    }

    .auth-card-footer {
        text-align: center;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #E2E8F0;
        font-size: 14px;
        color: #64748B;
        font-weight: 500;
    }

    .auth-switch-link {
        color: #004BEE;
        font-weight: 700;
        text-decoration: none;
        margin-left: 6px;
    }

    .auth-switch-link:hover {
        text-decoration: underline;
    }

    /* Right Why Agent 24 India Card */
    .why-agent-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 32px 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    }

    .why-agent-header {
        margin-bottom: 24px;
    }

    .why-agent-title {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 8px;
    }

    .why-agent-underline {
        display: block;
        width: 40px;
        height: 3px;
        background-color: #004BEE;
        border-radius: 2px;
    }

    .why-features-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .why-feature-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .why-feature-icon-box {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background-color: #EFF6FF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #004BEE;
    }

    .why-feature-heading {
        font-size: 14px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 2px;
    }

    .why-feature-desc {
        font-size: 12.5px;
        color: #64748B;
        line-height: 1.4;
        margin: 0;
    }
</style>
@endpush

@section('content')
<div class="login-hero-banner-section">
    <div class="login-hero-banner-container">
        <img src="{{ asset('public/front/assets/images/login_hero_banner.png') }}" alt="Login - Agent 24 India" class="login-hero-banner-img" onerror="this.onerror=null; this.src='{{ asset('front/assets/images/login_hero_banner.png') }}';">
    </div>
</div>

<div class="auth-page-section">
    <div class="login-split-wrapper">
        
        <!-- Left: Login Form -->
        <div class="auth-card">
            
            <div class="auth-card-header">
                <div class="user-avatar-circle">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h1 class="auth-title">Login to Your Account</h1>
                <p class="auth-subtitle">Enter your registered email, mobile or username</p>
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

                <!-- Email / Mobile / Username -->
                <div class="form-field-group">
                    <label class="input-field-label">Email Address / Mobile Number / Username</label>
                    <div class="input-icon-wrapper">
                        <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input type="text" name="email" id="loginEmail" class="styled-contact-input icon-input" placeholder="Enter email, mobile or username" required autofocus value="{{ old('email') }}">
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
                        <input type="password" name="password" id="loginPassword" class="styled-contact-input icon-input" placeholder="Enter your password" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('loginPassword', 'eyeIconLogin')" aria-label="Toggle Password">
                            <svg id="eyeIconLogin" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="auth-options-row">
                    <label class="remember-checkbox-label">
                        <input type="checkbox" name="remember" id="rememberMe" checked>
                        <span>Remember Me</span>
                    </label>
                    <a href="{{ route('forgotPassword') }}" class="forgot-pass-link">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="auth-submit-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                    <span>Login to Account</span>
                </button>
            </form>

            <div class="auth-card-footer">
                <span>Don't have an account?</span>
                <a href="{{ route('front.register') }}" class="auth-switch-link">Register Now</a>
            </div>

        </div>

        <!-- Right: Why Agent 24 India -->
        <div class="why-agent-card">
            <div class="why-agent-header">
                <h3 class="why-agent-title">Why Agent 24 India?</h3>
                <span class="why-agent-underline"></span>
            </div>

            <div class="why-features-list">
                <div class="why-feature-item">
                    <div class="why-feature-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <polyline points="9 12 11 14 15 10"/>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4 class="why-feature-heading">100% Verified Profiles</h4>
                        <p class="why-feature-desc">All agents and service providers are verified for high trust.</p>
                    </div>
                </div>

                <div class="why-feature-item">
                    <div class="why-feature-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4 class="why-feature-heading">Pan-India Visibility</h4>
                        <p class="why-feature-desc">Connect with verified clients and agents in 500+ cities.</p>
                    </div>
                </div>

                <div class="why-feature-item">
                    <div class="why-feature-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4 class="why-feature-heading">Direct Customer Leads</h4>
                        <p class="why-feature-desc">Receive phone calls and WhatsApp messages directly.</p>
                    </div>
                </div>

                <div class="why-feature-item">
                    <div class="why-feature-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4 class="why-feature-heading">AI Verified Badge</h4>
                        <p class="why-feature-desc">Boost customer conversions with verified blue badges.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
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

@extends('front.layout.main')
@section('title', 'Forgot Password')

@section('content')
    <!-- Forgot Password Hero Banner -->
    <section class="login-hero-banner-section">
        <div class="login-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/login_hero_banner.png') }}" alt="Forgot Password - Agent 24 India" class="login-hero-banner-img">
        </div>
    </section>

    <!-- Forgot Password Main Section -->
    <section class="auth-page-section" style="padding: 40px 0 60px 0;">
        <div class="section-container" style="max-width: 520px; margin: 0 auto; padding: 0 20px;">
            <div class="auth-card" style="background: #fff; border-radius: 16px; padding: 36px 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid #E2E8F0;">
                
                <div class="auth-card-header" style="text-align: center; margin-bottom: 24px;">
                    <div class="user-avatar-circle" style="width: 60px; height: 60px; border-radius: 50%; background: #EFF6FF; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                    <h1 class="auth-title" style="font-size: 22px; font-weight: 800; color: #0F172A; margin-bottom: 6px;">Forgot Password</h1>
                    <p class="auth-subtitle" style="font-size: 14px; color: #64748B;">Enter your registered email address to receive OTP</p>
                </div>

                @if(session('success'))
                    <div style="background: #DCFCE7; border: 1px solid #86EFAC; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center;">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center;">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('forgotPassword.sendOtp') }}">
                    @csrf

                    <div class="form-field-group" style="margin-bottom: 20px;">
                        <label class="input-field-label" style="display: block; font-size: 13.5px; font-weight: 600; color: #1E293B; margin-bottom: 8px;">Registered Email Address</label>
                        <input type="email" name="email" class="styled-contact-input" placeholder="Enter your email" value="{{ old('email') }}" required style="width: 100%; height: 48px; padding: 10px 14px; border: 1.5px solid #CBD5E1; border-radius: 10px; font-size: 14.5px; outline: none;">
                        @error('email')
                            <small style="color: #EF4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn-send-message" style="width: 100%; height: 48px; background: #004BEE; color: #fff; border: none; border-radius: 10px; font-weight: 700; font-size: 15px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span>Send OTP</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

                <div style="text-align: center; margin-top: 24px;">
                    <a href="javascript:void(0)" class="open-signin" style="color: #004BEE; font-size: 14px; font-weight: 600; text-decoration: none;">← Back to Sign In</a>
                </div>

            </div>
        </div>
    </section>
@endsection
@extends('front.layout.main')
@section('title', 'Verify OTP')

@section('content')
    <!-- Verify OTP Hero Banner -->
    <section class="login-hero-banner-section">
        <div class="login-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/login_hero_banner.png') }}" alt="Verify OTP - Agent 24 India" class="login-hero-banner-img">
        </div>
    </section>

    <!-- Verify OTP Main Section -->
    <section class="auth-page-section" style="padding: 40px 0 60px 0;">
        <div class="section-container" style="max-width: 520px; margin: 0 auto; padding: 0 20px;">
            <div class="auth-card" style="background: #fff; border-radius: 16px; padding: 36px 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid #E2E8F0;">
                
                <div class="auth-card-header" style="text-align: center; margin-bottom: 24px;">
                    <div class="user-avatar-circle" style="width: 60px; height: 60px; border-radius: 50%; background: #EFF6FF; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 12 11 14 15 10"></polyline>
                        </svg>
                    </div>
                    <h1 class="auth-title" style="font-size: 22px; font-weight: 800; color: #0F172A; margin-bottom: 6px;">Verify OTP</h1>
                    <p class="auth-subtitle" style="font-size: 14px; color: #64748B;">Enter the OTP sent to {{ session('email') ?? 'your email' }}</p>
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

                <form method="POST" action="{{ route('forgotPassword.verifyOtp') }}">
                    @csrf

                    <input type="hidden" name="email" value="{{ session('email') }}">

                    <div class="form-field-group" style="margin-bottom: 20px;">
                        <label class="input-field-label" style="display: block; font-size: 13.5px; font-weight: 600; color: #1E293B; margin-bottom: 8px;">6-Digit OTP Code</label>
                        <input type="text" name="otp" class="styled-contact-input" placeholder="Enter 6-digit OTP" required style="width: 100%; height: 48px; padding: 10px 14px; border: 1.5px solid #CBD5E1; border-radius: 10px; font-size: 16px; letter-spacing: 2px; text-align: center; outline: none;">
                        @error('otp')
                            <small style="color: #EF4444; font-size: 12px; margin-top: 4px; display: block; text-align: center;">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn-send-message" style="width: 100%; height: 48px; background: #004BEE; color: #fff; border: none; border-radius: 10px; font-weight: 700; font-size: 15px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span>Verify & Continue</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

                <div style="text-align: center; margin-top: 24px;">
                    <a href="{{ route('forgotPassword') }}" style="color: #004BEE; font-size: 14px; font-weight: 600; text-decoration: none;">← Resend OTP / Change Email</a>
                </div>

            </div>
        </div>
    </section>
@endsection
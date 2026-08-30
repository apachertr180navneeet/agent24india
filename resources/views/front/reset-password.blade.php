@extends('front.layout.main')
@section('title', 'Reset Password')

@section('content')
    <!-- Reset Password Hero Banner -->
    <section class="login-hero-banner-section">
        <div class="login-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/login_hero_banner.png') }}" alt="Reset Password - Agent 24 India" class="login-hero-banner-img">
        </div>
    </section>

    <!-- Reset Password Main Section -->
    <section class="auth-page-section" style="padding: 40px 0 60px 0;">
        <div class="section-container" style="max-width: 520px; margin: 0 auto; padding: 0 20px;">
            <div class="auth-card" style="background: #fff; border-radius: 16px; padding: 36px 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid #E2E8F0;">
                
                <div class="auth-card-header" style="text-align: center; margin-bottom: 24px;">
                    <div class="user-avatar-circle" style="width: 60px; height: 60px; border-radius: 50%; background: #EFF6FF; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 2l-2 2m-1.5 1.5L10 13l-4 4-2-2-4 4 4 4 4-4-2-2 7.5-7.5M16 5l3 3"/>
                        </svg>
                    </div>
                    <h1 class="auth-title" style="font-size: 22px; font-weight: 800; color: #0F172A; margin-bottom: 6px;">Create New Password</h1>
                    <p class="auth-subtitle" style="font-size: 14px; color: #64748B;">Enter your new strong password below</p>
                </div>

                @if(session('error'))
                    <div style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center;">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('forgotPassword.updatePassword') }}">
                    @csrf

                    <input type="hidden" name="email" value="{{ session('email') }}">

                    <div class="form-field-group" style="margin-bottom: 18px;">
                        <label class="input-field-label" style="display: block; font-size: 13.5px; font-weight: 600; color: #1E293B; margin-bottom: 8px;">New Password</label>
                        <div class="password-wrapper" style="position: relative;">
                            <input type="password" name="password" id="reset_password" class="styled-contact-input" placeholder="Enter new password" required style="width: 100%; height: 48px; padding: 10px 42px 10px 14px; border: 1.5px solid #CBD5E1; border-radius: 10px; font-size: 14.5px; outline: none;">
                            <span class="toggle-password" toggle="#reset_password" style="position: absolute; top: 50%; right: 14px; transform: translateY(-50%); cursor: pointer; color: #64748B;">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <small style="color: #EF4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-field-group" style="margin-bottom: 24px;">
                        <label class="input-field-label" style="display: block; font-size: 13.5px; font-weight: 600; color: #1E293B; margin-bottom: 8px;">Confirm New Password</label>
                        <div class="password-wrapper" style="position: relative;">
                            <input type="password" name="password_confirmation" id="reset_confirm_password" class="styled-contact-input" placeholder="Confirm new password" required style="width: 100%; height: 48px; padding: 10px 42px 10px 14px; border: 1.5px solid #CBD5E1; border-radius: 10px; font-size: 14.5px; outline: none;">
                            <span class="toggle-password" toggle="#reset_confirm_password" style="position: absolute; top: 50%; right: 14px; transform: translateY(-50%); cursor: pointer; color: #64748B;">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-send-message" style="width: 100%; height: 48px; background: #004BEE; color: #fff; border: none; border-radius: 10px; font-weight: 700; font-size: 15px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span>Update Password</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>

            </div>
        </div>
    </section>
@endsection
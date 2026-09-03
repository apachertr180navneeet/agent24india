@extends('front.layout.main')
@section('title', 'Register - Agent 24 India')

@push('styles')
<style>
    .reg-hero-banner-section {
        padding: 16px 0 0 0;
        background-color: #F8FAFC;
    }

    .reg-hero-banner-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .reg-hero-banner-img {
        width: 100%;
        height: auto;
        border-radius: 16px;
        display: block;
        box-shadow: 0 6px 20px rgba(0, 75, 238, 0.08);
    }

    .reg-page-section {
        padding: 36px 0 60px 0;
        background-color: #F8FAFC;
    }

    .reg-split-wrapper {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        align-items: start;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    @media (max-width: 991px) {
        .reg-split-wrapper {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .reg-hero-banner-container,
        .reg-split-wrapper {
            padding: 0 12px;
        }
        .reg-form-card {
            padding: 22px 14px !important;
            border-radius: 16px !important;
        }
        .reg-card-title {
            font-size: 19px !important;
        }
        .why-reg-card {
            padding: 20px 16px !important;
            border-radius: 16px !important;
        }
    }

    /* Left Registration Card */
    .reg-form-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        padding: 36px;
    }

    .reg-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
        padding-bottom: 18px;
        border-bottom: 1.5px solid #F1F5F9;
    }

    .reg-header-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background-color: #EFF6FF;
        color: #004BEE;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .reg-card-title {
        font-size: 22px;
        font-weight: 800;
        color: #0F172A;
    }

    .reg-section-divider {
        margin: 24px 0 18px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .reg-section-divider span {
        font-size: 13.5px;
        font-weight: 800;
        color: #004BEE;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .reg-section-divider::after {
        content: "";
        flex: 1;
        height: 1.5px;
        background-color: #E2E8F0;
    }

    .reg-fields-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .reg-field-full {
        grid-column: span 2;
    }

    @media (max-width: 640px) {
        .reg-fields-grid {
            grid-template-columns: 1fr;
        }
        .reg-field-full {
            grid-column: span 1;
        }
    }

    .reg-field-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .reg-label {
        font-size: 13.5px;
        font-weight: 700;
        color: #1E293B;
    }

    .reg-req {
        color: #EF4444;
    }

    .reg-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .reg-input-wrap .field-icon {
        position: absolute;
        left: 14px;
        color: #94A3B8;
        pointer-events: none;
        z-index: 2;
    }

    .reg-input {
        width: 100%;
        height: 48px;
        padding: 0 16px;
        border: 1.5px solid #CBD5E1;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #0F172A;
        background-color: #FFFFFF;
        outline: none;
        transition: all 0.2s ease;
    }

    .reg-input.has-icon {
        padding-left: 42px;
        padding-right: 42px;
    }

    .reg-input:focus {
        border-color: #004BEE;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.12);
    }

    .reg-input-wrap .select2-container {
        width: 100% !important;
    }

    .reg-input-wrap .select2-container--default .select2-selection--single {
        height: 48px !important;
        border: 1.5px solid #CBD5E1 !important;
        border-radius: 10px !important;
        padding-left: 12px !important;
        display: flex !important;
        align-items: center !important;
    }

    .reg-input-wrap .select2-container--default.select2-container--open .select2-selection--single,
    .reg-input-wrap .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #004BEE !important;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.12) !important;
    }

    .reg-pwd-toggle {
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

    .reg-pwd-toggle:hover {
        color: #004BEE;
    }

    .reg-terms-row {
        margin: 24px 0;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .reg-terms-row input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #004BEE;
        margin-top: 2px;
        cursor: pointer;
    }

    .reg-terms-label {
        font-size: 13.5px;
        color: #475569;
        font-weight: 500;
        line-height: 1.4;
    }

    .reg-terms-label a {
        color: #004BEE;
        font-weight: 700;
        text-decoration: none;
    }

    .reg-terms-label a:hover {
        text-decoration: underline;
    }

    .reg-submit-btn {
        width: 100%;
        height: 50px;
        background-color: #004BEE;
        color: #FFFFFF;
        border: none;
        border-radius: 30px;
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

    .reg-submit-btn:hover {
        background-color: #0036B8;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 75, 238, 0.35);
    }

    .reg-card-footer {
        text-align: center;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #E2E8F0;
        font-size: 14px;
        color: #64748B;
    }

    .reg-switch-link {
        color: #004BEE;
        font-weight: 700;
        text-decoration: none;
        margin-left: 6px;
    }

    .reg-switch-link:hover {
        text-decoration: underline;
    }

    /* Right Why Card */
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
<div class="reg-hero-banner-section">
    <div class="reg-hero-banner-container">
        <img src="{{ asset('public/front/assets/images/register_hero_banner.png') }}" alt="Register - Agent 24 India" class="reg-hero-banner-img" onerror="this.onerror=null; this.src='{{ asset('front/assets/images/register_hero_banner.png') }}';">
    </div>
</div>

<div class="reg-page-section">
    <div class="reg-split-wrapper">
        
        <!-- Left: Registration Form Card -->
        <div class="reg-form-card">
            
            <div class="reg-card-header">
                <div class="reg-header-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                </div>
                <div>
                    <h1 class="reg-card-title">Registration Form</h1>
                    <p style="font-size: 13.5px; color: #64748B; margin: 0;">Join India's largest agent & verified service network</p>
                </div>
            </div>

            @if ($errors->any())
                <div style="background: #FEE2E2; color: #991B1B; padding: 14px 18px; border-radius: 10px; font-size: 13.5px; font-weight: 600; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('front.signup') }}" method="POST" id="signupForm" onsubmit="return validateSignupForm();">
                @csrf

                <!-- Section 1: Personal & Account Information -->
                <div class="reg-section-divider">
                    <span>1. Personal & Account Information</span>
                </div>

                <div class="reg-fields-grid">
                    <!-- Business / Full Name -->
                    <div class="reg-field-group reg-field-full">
                        <label class="reg-label">Business / Agent Full Name <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <input type="text" name="business_name" id="business_name" class="reg-input" placeholder="e.g. Sharma Property Consultant or Rahul Sharma" required value="{{ old('business_name') }}">
                        </div>
                    </div>

                    <!-- Contact Mobile -->
                    <div class="reg-field-group">
                        <label class="reg-label">Mobile Number <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <input type="tel" name="contact_number" id="contact_number" class="reg-input has-icon" placeholder="10 Digit Mobile Number" required pattern="[0-9]{10}" maxlength="10" value="{{ old('contact_number') }}">
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="reg-field-group">
                        <label class="reg-label">Email Address <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <input type="email" name="email" id="signup_email" class="reg-input has-icon" placeholder="name@example.com" required value="{{ old('email') }}">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="reg-field-group">
                        <label class="reg-label">Password <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input type="password" name="password" id="signup_password" class="reg-input has-icon" placeholder="Create strong password" required minlength="6">
                            <button type="button" class="reg-pwd-toggle" onclick="togglePasswordVisibility('signup_password', 'eyeIconReg1')">
                                <svg id="eyeIconReg1" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="reg-field-group">
                        <label class="reg-label">Confirm Password <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input type="password" name="confirm_password" id="confirm_password" class="reg-input has-icon" placeholder="Confirm your password" required minlength="6">
                            <button type="button" class="reg-pwd-toggle" onclick="togglePasswordVisibility('confirm_password', 'eyeIconReg2')">
                                <svg id="eyeIconReg2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Business & Location Details -->
                <div class="reg-section-divider">
                    <span>2. Business Category & Location</span>
                </div>

                <div class="reg-fields-grid">
                    <!-- Business Category -->
                    <div class="reg-field-group reg-field-full">
                        <label class="reg-label">Business Category <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <select name="business_category_id" id="business_category_id" class="select2" required>
                                <option value="">Select Business Category</option>
                                @foreach($businessCategory as $cat)
                                    <option value="{{ $cat->id }}" {{ old('business_category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- State -->
                    <div class="reg-field-group">
                        <label class="reg-label">State <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <select name="state_id" id="state_id" class="select2" required>
                                <option value="">Select State</option>
                                @foreach($stateList as $state)
                                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- District -->
                    <div class="reg-field-group">
                        <label class="reg-label">District <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <select name="district_id" id="district_id" class="select2" required>
                                <option value="">Select District</option>
                                @foreach($districtList as $district)
                                    <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- City -->
                    <div class="reg-field-group">
                        <label class="reg-label">City <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <select name="city_id" id="city_id" class="select2" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pincode -->
                    <div class="reg-field-group">
                        <label class="reg-label">Pincode <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <input type="text" name="pincode" id="pincode" class="reg-input" placeholder="6 Digit Pincode" required pattern="[0-9]{6}" maxlength="6" value="{{ old('pincode') }}">
                        </div>
                    </div>

                    <!-- Business Address -->
                    <div class="reg-field-group reg-field-full">
                        <label class="reg-label">Complete Business / Office Address <span class="reg-req">*</span></label>
                        <div class="reg-input-wrap">
                            <input type="text" name="business_address" id="business_address" class="reg-input" placeholder="Shop / Office No, Building, Street, Landmark" required value="{{ old('business_address') }}">
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="reg-terms-row">
                    <input type="checkbox" name="terms_agree" id="termsAgree" checked required>
                    <label for="termsAgree" class="reg-terms-label">
                        I agree to the <a href="{{ route('front.termsAndConditions') }}" target="_blank">Terms & Conditions</a> and <a href="{{ route('front.privacyPolicy') }}" target="_blank">Privacy Policy</a> of Agent 24 India.
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="reg-submit-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <polyline points="17 11 19 13 23 9"></polyline>
                    </svg>
                    <span>Create Free Account</span>
                </button>
            </form>

            <div class="reg-card-footer">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}" class="reg-switch-link">Login Here</a>
            </div>

        </div>

        <!-- Right: Why Agent 24 India Card -->
        <div class="why-agent-card">
            <div class="why-agent-header">
                <h3 class="why-agent-title">Why Join Agent 24 India?</h3>
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
                        <h4 class="why-feature-heading">Verified Business Listing</h4>
                        <p class="why-feature-desc">Establish your trusted presence with verified badges.</p>
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
                        <h4 class="why-feature-heading">Pan-India Reach</h4>
                        <p class="why-feature-desc">Reach customers looking for agents in your local area.</p>
                    </div>
                </div>

                <div class="why-feature-item">
                    <div class="why-feature-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4 class="why-feature-heading">Direct Inquiries</h4>
                        <p class="why-feature-desc">Zero commissions. Receive 100% direct customer leads.</p>
                    </div>
                </div>

                <div class="why-feature-item">
                    <div class="why-feature-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4 class="why-feature-heading">Fast AI Verification</h4>
                        <p class="why-feature-desc">Get your account approved quickly and start receiving business.</p>
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

    function validateSignupForm() {
        var password = $('#signup_password').val();
        var confirmPassword = $('#confirm_password').val();

        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
        }
        return true;
    }

    $(document).ready(function() {
        if ($.fn.select2) {
            $('#business_category_id, #state_id, #district_id, #city_id').select2({
                width: '100%'
            });
        }

        // STATE -> DISTRICT
        $('#state_id').on('change', function() {
            var stateId = $(this).val();
            $('#district_id').html('<option value="">Loading...</option>').trigger('change.select2');
            $('#city_id').html('<option value="">Select City</option>').trigger('change.select2');

            if (stateId) {
                $.get("{{ route('get.districts', ['state' => '__STATE__']) }}".replace('__STATE__', stateId), function(data) {
                    var options = '<option value="">Select District</option>';
                    $.each(data, function(key, value) {
                        options += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#district_id').html(options).trigger('change.select2');
                });
            } else {
                $('#district_id').html('<option value="">Select District</option>').trigger('change.select2');
            }
        });

        // DISTRICT -> CITY
        $('#district_id').on('change', function() {
            var districtId = $(this).val();
            $('#city_id').html('<option value="">Loading...</option>').trigger('change.select2');

            if (districtId) {
                $.get("{{ route('get.cities', ['district' => '__DISTRICT__']) }}".replace('__DISTRICT__', districtId), function(data) {
                    var options = '<option value="">Select City</option>';
                    $.each(data, function(key, value) {
                        options += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#city_id').html(options).trigger('change.select2');
                });
            } else {
                $('#city_id').html('<option value="">Select City</option>').trigger('change.select2');
            }
        });
    });
</script>
@endpush

@extends('front.layout.main')
@section('title', $pageTitle ?? 'Contact Us')

@push('styles')
<style>
    /* Contact Us Page Scope Styles - Matching Reference Design Exactly */
    .contact-page-wrapper {
        background-color: #F3F7FC;
        padding: 24px 0 60px 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .contact-container {
        max-width: 1040px;
        margin: 0 auto;
        padding: 0 16px;
    }

    /* 1. Hero Banner */
    .contact-banner-card {
        width: 100%;
        background: #EBF4FE;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0, 75, 238, 0.05);
        border: 1px solid #E2E8F0;
    }

    .contact-banner-card img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    /* 2. Middle Grid: Info Card & Form Card */
    .contact-middle-grid {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 20px;
        margin-bottom: 24px;
        align-items: stretch;
    }

    .contact-card-box {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
    }

    /* Left Card: Talk to Us */
    .contact-talk-card {
        padding: 28px 24px;
        display: flex;
        flex-direction: column;
    }

    .contact-box-title {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 24px;
        letter-spacing: -0.2px;
    }

    .contact-info-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .contact-info-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .contact-icon-bubble {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #FFFFFF;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    }

    .contact-icon-bubble.blue {
        background-color: #004BEE;
    }

    .contact-icon-bubble.green {
        background-color: #25D366;
    }

    .contact-detail-text {
        display: flex;
        flex-direction: column;
    }

    .contact-detail-label {
        font-size: 13px;
        font-weight: 600;
        color: #64748B;
        margin-bottom: 3px;
    }

    .contact-detail-val {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.35;
        text-decoration: none;
    }

    .contact-detail-val:hover {
        color: #004BEE;
    }

    .contact-detail-sub {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        line-height: 1.45;
    }

    /* Right Card: Message Form */
    .contact-message-card {
        padding: 28px 32px;
    }

    .contact-form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .contact-form-group {
        margin-bottom: 16px;
        display: flex;
        flex-direction: column;
    }

    .contact-field-label {
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
    }

    .req-star {
        color: #EF4444;
    }

    .contact-input-control,
    .contact-select-control,
    .contact-textarea-control {
        width: 100%;
        padding: 11px 14px;
        background: #FFFFFF;
        border: 1px solid #D8E2ED;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #0F172A;
        outline: none;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .contact-input-control:focus,
    .contact-select-control:focus,
    .contact-textarea-control:focus {
        border-color: #004BEE;
        box-shadow: 0 0 0 3px rgba(0, 75, 238, 0.1);
    }

    .contact-input-control::placeholder,
    .contact-textarea-control::placeholder {
        color: #94A3B8;
        font-size: 13.5px;
    }

    .contact-select-wrap {
        position: relative;
    }

    .contact-select-control {
        appearance: none;
        -webkit-appearance: none;
        padding-right: 36px;
        cursor: pointer;
        background-color: #FFFFFF;
    }

    .contact-select-arrow {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #64748B;
    }

    .btn-submit-message {
        background: #004BEE;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 13px 24px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        box-shadow: 0 4px 12px rgba(0, 75, 238, 0.2);
        transition: all 0.2s ease;
        margin-top: 4px;
    }

    .btn-submit-message:hover {
        background: #003ECC;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 75, 238, 0.3);
    }

    /* 3. Office Location Card */
    .contact-office-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        padding: 24px 28px;
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 24px;
        align-items: center;
        margin-bottom: 32px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
    }

    .office-info-left {
        display: flex;
        flex-direction: column;
    }

    .office-title {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 12px;
        letter-spacing: -0.2px;
    }

    .office-company-name {
        font-size: 15.5px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 6px;
    }

    .office-address-p {
        font-size: 13.5px;
        color: #475569;
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .btn-directions {
        display: inline-block;
        padding: 8px 22px;
        border: 1.5px solid #004BEE;
        border-radius: 8px;
        color: #004BEE;
        font-size: 13.5px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s ease;
        align-self: flex-start;
        background: #FFFFFF;
    }

    .btn-directions:hover {
        background: #004BEE;
        color: #FFFFFF;
        box-shadow: 0 4px 12px rgba(0, 75, 238, 0.2);
    }

    .office-map-right {
        width: 100%;
        height: 180px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .office-map-right iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    /* 4. Trust Promise Section */
    .trust-promise-wrap {
        text-align: center;
    }

    .trust-promise-header {
        margin-bottom: 24px;
    }

    .trust-header-title {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        font-size: 18px;
        font-weight: 800;
        color: #004BEE;
        margin-bottom: 6px;
    }

    .trust-line {
        display: inline-block;
        width: 32px;
        height: 2px;
        background: #93C5FD;
        border-radius: 2px;
    }

    .trust-subtitle-p {
        font-size: 13.5px;
        color: #475569;
        font-weight: 500;
    }

    .trust-badges-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .trust-badge-pill {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 16px 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
        text-align: left;
    }

    .trust-badge-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #EEF4FF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #004BEE;
    }

    .trust-badge-info {
        display: flex;
        flex-direction: column;
    }

    .trust-badge-heading {
        font-size: 13.5px;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 2px;
    }

    .trust-badge-desc {
        font-size: 11.5px;
        font-weight: 500;
        color: #64748B;
        line-height: 1.25;
    }

    /* Responsive Breakpoints */
    @media (max-width: 900px) {
        .contact-middle-grid {
            grid-template-columns: 1fr;
        }

        .contact-office-card {
            grid-template-columns: 1fr;
        }

        .trust-badges-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 540px) {
        .contact-form-grid-2 {
            grid-template-columns: 1fr;
        }

        .trust-badges-row {
            grid-template-columns: 1fr;
        }

        .contact-message-card {
            padding: 24px 18px;
        }

        .contact-talk-card {
            padding: 24px 18px;
        }

        .contact-office-card {
            padding: 20px 18px;
        }
    }
</style>
@endpush

@section('content')
<div class="contact-page-wrapper">
    <div class="contact-container">

        <!-- 1. Hero Banner (Matches Reference Exactly) -->
        <div class="contact-banner-card">
            <img src="{{ asset('front/assets/images/contact_hero_banner.png') }}" 
                 alt="Contact Us - हमसे संपर्क करें" 
                 onerror="this.onerror=null; this.src='{{ asset('public/front/assets/images/contact_hero_banner.png') }}';">
        </div>

        <!-- 2. Middle Section: Talk To Us & Send Message Form -->
        <div class="contact-middle-grid">
            
            <!-- Left Card: हमसे बात करें -->
            <div class="contact-card-box contact-talk-card">
                <h2 class="contact-box-title">हमसे बात करें</h2>
                
                <div class="contact-info-list">
                    <!-- Item 1: Phone -->
                    <div class="contact-info-row">
                        <div class="contact-icon-bubble blue">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact-detail-text">
                            <span class="contact-detail-label">Phone Number</span>
                            <a href="tel:+917878242424" class="contact-detail-val">+91 7878 24 24 24</a>
                        </div>
                    </div>

                    <!-- Item 2: WhatsApp -->
                    <div class="contact-info-row">
                        <div class="contact-icon-bubble green">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                            </svg>
                        </div>
                        <div class="contact-detail-text">
                            <span class="contact-detail-label">WhatsApp</span>
                            <a href="https://wa.me/917878242424" target="_blank" class="contact-detail-val">+91 7878 24 24 24</a>
                        </div>
                    </div>

                    <!-- Item 3: Email -->
                    <div class="contact-info-row">
                        <div class="contact-icon-bubble blue">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div class="contact-detail-text">
                            <span class="contact-detail-label">Email Address</span>
                            <a href="mailto:support@agent24india.com" class="contact-detail-val">support@agent24india.com</a>
                        </div>
                    </div>

                    <!-- Item 4: Working Hours -->
                    <div class="contact-info-row">
                        <div class="contact-icon-bubble blue">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="contact-detail-text">
                            <span class="contact-detail-label">Working Hours</span>
                            <span class="contact-detail-sub">सोमवार - शनिवार : 10:00 AM - 6:00 PM</span>
                            <span class="contact-detail-sub">रविवार : अवकाश</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Card: हमें मैसेज भेजें -->
            <div class="contact-card-box contact-message-card">
                <h2 class="contact-box-title">हमें मैसेज भेजें</h2>

                @if(session('success'))
                    <div style="background: #DCFCE7; border: 1px solid #86EFAC; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; font-weight: 600;">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; font-weight: 600;">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('front.contactus.submit') }}">
                    @csrf

                    <!-- Row 1: Name & Mobile -->
                    <div class="contact-form-grid-2">
                        <div class="contact-form-group">
                            <label class="contact-field-label">आपका नाम <span class="req-star">*</span></label>
                            <input type="text" name="name" class="contact-input-control" placeholder="अपना नाम लिखें" value="{{ old('name') }}" required>
                            @error('name') <small style="color: #EF4444; font-size: 12px; margin-top: 4px;">{{ $message }}</small> @enderror
                        </div>

                        <div class="contact-form-group">
                            <label class="contact-field-label">मोबाइल नंबर <span class="req-star">*</span></label>
                            <input type="tel" name="phone" class="contact-input-control" placeholder="मोबाइल नंबर लिखें" value="{{ old('phone') }}" required>
                            @error('phone') <small style="color: #EF4444; font-size: 12px; margin-top: 4px;">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <!-- Row 2: Email -->
                    <div class="contact-form-group">
                        <label class="contact-field-label">ईमेल आईडी</label>
                        <input type="email" name="email" class="contact-input-control" placeholder="ईमेल आईडी लिखें" value="{{ old('email') }}" required>
                        @error('email') <small style="color: #EF4444; font-size: 12px; margin-top: 4px;">{{ $message }}</small> @enderror
                    </div>

                    <!-- Row 3: Subject Dropdown -->
                    <div class="contact-form-group">
                        <label class="contact-field-label">विषय <span class="req-star">*</span></label>
                        <div class="contact-select-wrap">
                            <select name="subject" class="contact-select-control" required>
                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>विषय चुनें</option>
                                <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                <option value="Agent Registration" {{ old('subject') == 'Agent Registration' ? 'selected' : '' }}>Agent Registration</option>
                                <option value="Customer Support" {{ old('subject') == 'Customer Support' ? 'selected' : '' }}>Customer Support</option>
                                <option value="Banner Ad Inquiry" {{ old('subject') == 'Banner Ad Inquiry' ? 'selected' : '' }}>Banner Ad Inquiry</option>
                                <option value="Feedback / Complaint" {{ old('subject') == 'Feedback / Complaint' ? 'selected' : '' }}>Feedback / Complaint</option>
                            </select>
                            <svg class="contact-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        @error('subject') <small style="color: #EF4444; font-size: 12px; margin-top: 4px;">{{ $message }}</small> @enderror
                    </div>

                    <!-- Row 4: Message Textarea -->
                    <div class="contact-form-group">
                        <label class="contact-field-label">आपका संदेश <span class="req-star">*</span></label>
                        <textarea name="message" class="contact-textarea-control" placeholder="अपना संदेश लिखें..." rows="4" required>{{ old('message') }}</textarea>
                        @error('message') <small style="color: #EF4444; font-size: 12px; margin-top: 4px;">{{ $message }}</small> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit-message">
                        <span>मैसेज भेजें</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>
            </div>

        </div>

        <!-- 3. Office Location & Map Card -->
        <div class="contact-office-card">
            <!-- Left: Office Details -->
            <div class="office-info-left">
                <h2 class="office-title">हमारा ऑफिस</h2>
                <div class="office-company-name">Agent 24 India</div>
                <p class="office-address-p">
                    F-208, 2nd Floor, Shyam Nagar,<br>
                    Jaipur, Rajasthan - 302019, India
                </p>
                <a href="https://maps.google.com/?q=Shyam+Nagar+Jaipur+Rajasthan" target="_blank" class="btn-directions">
                    Get Directions
                </a>
            </div>

            <!-- Right: Interactive Google Map -->
            <div class="office-map-right">
                <iframe 
                    src="https://maps.google.com/maps?q=Shyam+Nagar,+Jaipur,+Rajasthan+302019&t=&z=14&ie=UTF8&iwloc=&output=embed" 
                    loading="lazy" 
                    allowfullscreen="" 
                    referrerpolicy="no-referrer-when-downgrade" 
                    title="Agent 24 India Office Location">
                </iframe>
            </div>
        </div>

        <!-- 4. Trust Promise & 4 Guarantee Badges -->
        <div class="trust-promise-wrap">
            <div class="trust-promise-header">
                <div class="trust-header-title">
                    <span class="trust-line"></span>
                    <span>जल्द जवाब का वादा</span>
                    <span class="trust-line"></span>
                </div>
                <p class="trust-subtitle-p">हम आपकी सभी पूछताछ का 24 घंटे के भीतर जवाब देने की पूरी कोशिश करते हैं।</p>
            </div>

            <div class="trust-badges-row">
                <!-- Badge 1: Quick Response -->
                <div class="trust-badge-pill">
                    <div class="trust-badge-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="trust-badge-info">
                        <h4 class="trust-badge-heading">जल्द जवाब</h4>
                        <span class="trust-badge-desc">24 घंटे के भीतर</span>
                    </div>
                </div>

                <!-- Badge 2: 100% Support -->
                <div class="trust-badge-pill">
                    <div class="trust-badge-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="trust-badge-info">
                        <h4 class="trust-badge-heading">100% सहायता</h4>
                        <span class="trust-badge-desc">हमेशा आपकी मदद के लिए</span>
                    </div>
                </div>

                <!-- Badge 3: Trust & Security -->
                <div class="trust-badge-pill">
                    <div class="trust-badge-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                    <div class="trust-badge-info">
                        <h4 class="trust-badge-heading">भरोसा और सुरक्षा</h4>
                        <span class="trust-badge-desc">आपकी जानकारी सुरक्षित</span>
                    </div>
                </div>

                <!-- Badge 4: Dedicated Team -->
                <div class="trust-badge-pill">
                    <div class="trust-badge-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="trust-badge-info">
                        <h4 class="trust-badge-heading">समर्पित सपोर्ट टीम</h4>
                        <span class="trust-badge-desc">Best समाधान हमारा लक्ष्य</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
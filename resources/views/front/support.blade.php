@extends('front.layout.main')
@section('title', $pageTitle ?? 'Support & Help')

@section('content')
    <!-- Support Hero Banner Section Start -->
    <section class="contact-hero-banner-section">
        <div class="contact-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/contact_hero_banner.png') }}" alt="Support & Help - Agent 24 India" class="contact-hero-banner-img">
        </div>
    </section>
    <!-- Support Hero Banner Section End -->

    <!-- Support Main Content Section Start -->
    <section class="contact-main-section">
        <div class="section-container">
            <div class="contact-grid-wrapper">
                
                <!-- Left Card: Talk to Us & Official Support Notice -->
                <div class="contact-info-card">
                    <h2 class="card-title-blue">Dedicated Support</h2>
                    
                    <div style="background: #EFF6FF; border-left: 4px solid #004BEE; padding: 18px 20px; border-radius: 10px; margin-bottom: 24px;">
                        <h4 style="font-size: 16px; font-weight: 700; color: #004BEE; margin-bottom: 8px;">Support Instructions</h4>
                        <p style="font-size: 13.5px; color: #334155; line-height: 1.6; margin-bottom: 10px;">
                            For help and support, please fill out the form. Our team will contact you by phone or email after receiving your request (within <strong>1 to 3 business days</strong>).
                        </p>
                        <p style="font-size: 13px; color: #64748B; margin-bottom: 6px;">
                            <strong>Timings:</strong> 10:00 AM to 6:00 PM (Monday - Saturday)
                        </p>
                        <p style="font-size: 13px; color: #DC2626; font-weight: 600; margin-top: 10px;">
                            ⚠ Please do not share sensitive credentials or OTPs with anyone. Our verified team will connect officially.
                        </p>
                    </div>

                    <div class="contact-items-list">
                        <!-- Item 1: Phone -->
                        <div class="contact-info-item">
                            <div class="contact-icon-circle bg-blue">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </div>
                            <div class="contact-text-block">
                                <span class="contact-label">Official Support Number</span>
                                <h4 class="contact-val">+91 91193 36617</h4>
                            </div>
                        </div>

                        <!-- Item 2: WhatsApp -->
                        <div class="contact-info-item">
                            <div class="contact-icon-circle bg-green">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                </svg>
                            </div>
                            <div class="contact-text-block">
                                <span class="contact-label">WhatsApp Helpline</span>
                                <h4 class="contact-val">+91 91193 36617</h4>
                            </div>
                        </div>

                        <!-- Item 3: Email -->
                        <div class="contact-info-item">
                            <div class="contact-icon-circle bg-blue">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </div>
                            <div class="contact-text-block">
                                <span class="contact-label">Support Email</span>
                                <h4 class="contact-val">support@agent24india.com</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Card: Support Form -->
                <div class="contact-form-card">
                    <h2 class="card-title-blue">Submit Support Request</h2>

                    @if (session('success'))
                        <div style="background: #DCFCE7; border: 1px solid #86EFAC; color: #166534; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-weight: 500;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-weight: 500;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('front.support.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Row 1: Name & Mobile -->
                        <div class="form-grid-2col">
                            <div class="form-field-group">
                                <label class="input-field-label">Your Name <span class="req-star">*</span></label>
                                <input type="text" name="name" class="styled-contact-input" placeholder="Enter your name" value="{{ old('name') }}" required>
                                @error('name') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-field-group">
                                <label class="input-field-label">Phone Number <span class="req-star">*</span></label>
                                <input type="tel" name="phone" class="styled-contact-input" placeholder="Enter contact number" value="{{ old('phone') }}" required>
                                @error('phone') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Row 2: Email -->
                        <div class="form-field-group">
                            <label class="input-field-label">Email Address <span class="req-star">*</span></label>
                            <input type="email" name="email" class="styled-contact-input" placeholder="Enter your email address" value="{{ old('email') }}" required>
                            @error('email') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        <!-- Row 3: Subject Dropdown (Enhanced with Select2) -->
                        <div class="form-field-group">
                            <label class="input-field-label">Subject / Issue Type <span class="req-star">*</span></label>
                            <select name="subject" id="supportSubject" class="select2 styled-contact-select" required>
                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select Subject</option>
                                <option value="Account Login / Registration Issue" {{ old('subject') == 'Account Login / Registration Issue' ? 'selected' : '' }}>Account Login / Registration Issue</option>
                                <option value="Listing Approval & Verification" {{ old('subject') == 'Listing Approval & Verification' ? 'selected' : '' }}>Listing Approval & Verification</option>
                                <option value="Banner Advertisement Support" {{ old('subject') == 'Banner Advertisement Support' ? 'selected' : '' }}>Banner Advertisement Support</option>
                                <option value="Payment & Plan Inquiry" {{ old('subject') == 'Payment & Plan Inquiry' ? 'selected' : '' }}>Payment & Plan Inquiry</option>
                                <option value="Profile Edit & Update Request" {{ old('subject') == 'Profile Edit & Update Request' ? 'selected' : '' }}>Profile Edit & Update Request</option>
                                <option value="Other Assistance" {{ old('subject') == 'Other Assistance' ? 'selected' : '' }}>Other Assistance</option>
                            </select>
                            @error('subject') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        <!-- Row 4: Attachment Screenshot Upload -->
                        <div class="form-field-group">
                            <label class="input-field-label">Attachment / Screenshot (Optional)</label>
                            <div style="border: 1.5px dashed #CBD5E1; border-radius: 10px; padding: 14px; text-align: center; background: #F8FAFC;">
                                <input type="file" name="image" accept="image/*" style="display: block; margin: 0 auto; font-size: 13px;">
                                <span style="display: block; font-size: 12px; color: #94A3B8; margin-top: 4px;">PNG, JPG up to 2MB</span>
                            </div>
                            @error('image') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        <!-- Row 5: Message Textarea -->
                        <div class="form-field-group">
                            <label class="input-field-label">Message Details <span class="req-star">*</span></label>
                            <textarea name="message" class="styled-contact-textarea" placeholder="Explain your query or issue in detail..." rows="4" required>{{ old('message') }}</textarea>
                            @error('message') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-send-message">
                            <span>Submit Message</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- Support Main Content Section End -->
@endsection
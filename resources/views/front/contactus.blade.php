@extends('front.layout.main')
@section('title', $pageTitle ?? 'Contact Us')

@section('content')
    <!-- Contact Us Hero Banner Section Start -->
    <section class="contact-hero-banner-section">
        <div class="contact-hero-banner-container">
            <img src="{{ asset('public/front/assets/images/contact_hero_banner.png') }}" alt="Contact Us - हमसे संपर्क करें" class="contact-hero-banner-img">
        </div>
    </section>
    <!-- Contact Us Hero Banner Section End -->

    <!-- Contact Info & Message Form Section Start -->
    <section class="contact-main-section">
        <div class="section-container">
            <div class="contact-grid-wrapper">
                
                <!-- Left Card: Talk to Us (हमसे बात करें) -->
                <div class="contact-info-card">
                    <h2 class="card-title-blue">हमसे बात करें</h2>
                    
                    <div class="contact-items-list">
                        <!-- Item 1: Phone -->
                        <div class="contact-info-item">
                            <div class="contact-icon-circle bg-blue">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </div>
                            <div class="contact-text-block">
                                <span class="contact-label">Phone Number</span>
                                <h4 class="contact-val">+91 7878 24 24 24</h4>
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
                                <span class="contact-label">WhatsApp</span>
                                <h4 class="contact-val">+91 7878 24 24 24</h4>
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
                                <span class="contact-label">Email Address</span>
                                <h4 class="contact-val">support@agent24india.com</h4>
                            </div>
                        </div>

                        <!-- Item 4: Working Hours -->
                        <div class="contact-info-item">
                            <div class="contact-icon-circle bg-blue">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                            <div class="contact-text-block">
                                <span class="contact-label">Working Hours</span>
                                <h4 class="contact-val sub-time">सोमवार - शनिवार : 10:00 AM - 6:00 PM</h4>
                                <h4 class="contact-val sub-time">रविवार : अवकाश</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Card: Send Us a Message (हमें मैसेज भेजें) -->
                <div class="contact-form-card">
                    <h2 class="card-title-blue">हमें मैसेज भेजें</h2>

                    @if(session('success'))
                        <div style="background: #DCFCE7; border: 1px solid #86EFAC; color: #166534; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-weight: 500;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div style="background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-weight: 500;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('front.contactus.submit') }}">
                        @csrf

                        <!-- Row 1: Name & Mobile -->
                        <div class="form-grid-2col">
                            <div class="form-field-group">
                                <label class="input-field-label">आपका नाम <span class="req-star">*</span></label>
                                <input type="text" name="name" class="styled-contact-input" placeholder="अपना नाम लिखें" value="{{ old('name') }}" required>
                                @error('name') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-field-group">
                                <label class="input-field-label">मोबाइल नंबर <span class="req-star">*</span></label>
                                <input type="tel" name="phone" class="styled-contact-input" placeholder="मोबाइल नंबर लिखें" value="{{ old('phone') }}" required>
                                @error('phone') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Row 2: Email -->
                        <div class="form-field-group">
                            <label class="input-field-label">ईमेल आईडी <span class="req-star">*</span></label>
                            <input type="email" name="email" class="styled-contact-input" placeholder="ईमेल आईडी लिखें" value="{{ old('email') }}" required>
                            @error('email') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        <!-- Row 3: Subject Dropdown (Enhanced with Select2) -->
                        <div class="form-field-group">
                            <label class="input-field-label">विषय <span class="req-star">*</span></label>
                            <select name="subject" id="contactSubject" class="select2 styled-contact-select" required>
                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>विषय चुनें</option>
                                <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                <option value="Agent Registration" {{ old('subject') == 'Agent Registration' ? 'selected' : '' }}>Agent Registration</option>
                                <option value="Customer Support" {{ old('subject') == 'Customer Support' ? 'selected' : '' }}>Customer Support</option>
                                <option value="Banner Ad Inquiry" {{ old('subject') == 'Banner Ad Inquiry' ? 'selected' : '' }}>Banner Ad Inquiry</option>
                                <option value="Feedback / Complaint" {{ old('subject') == 'Feedback / Complaint' ? 'selected' : '' }}>Feedback / Complaint</option>
                            </select>
                            @error('subject') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        <!-- Row 4: Message Textarea -->
                        <div class="form-field-group">
                            <label class="input-field-label">आपका संदेश <span class="req-star">*</span></label>
                            <textarea name="message" class="styled-contact-textarea" placeholder="अपना संदेश लिखें..." rows="4" required>{{ old('message') }}</textarea>
                            @error('message') <small style="color: #EF4444; font-size: 12px;">{{ $message }}</small> @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-send-message">
                            <span>मैसेज भेजें</span>
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
    <!-- Contact Info & Message Form Section End -->

    <!-- Office Location & Map Section Start -->
    <section class="office-location-section">
        <div class="section-container">
            <div class="office-location-card">
                <!-- Left Details Column -->
                <div class="office-info-col">
                    <h2 class="office-heading">हमारा ऑफिस</h2>
                    
                    <div class="office-address-block">
                        <h4 class="office-brand">Agent 24 India</h4>
                        <p class="office-address-lines">
                            F-208, 2nd Floor, Shyam Nagar,<br>
                            Jaipur, Rajasthan - 302019, India
                        </p>
                    </div>

                    <a href="https://maps.google.com" target="_blank" class="btn-get-directions">Get Directions</a>
                </div>

                <!-- Right Vector Map Container -->
                <div class="office-map-col">
                    <div class="vector-map-wrapper">
                        <!-- Custom Map Background SVG -->
                        <svg width="100%" height="100%" viewBox="0 0 600 300" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="600" height="300" fill="#F4F1EA"/>
                            <rect x="20" y="20" width="140" height="90" fill="#E8ECE1" rx="8"/>
                            <rect x="180" y="20" width="160" height="70" fill="#EBF0E6" rx="8"/>
                            <rect x="360" y="20" width="220" height="110" fill="#FAF5E8" rx="8"/>
                            <rect x="20" y="140" width="120" height="140" fill="#FAF5E8" rx="8"/>
                            <rect x="160" y="115" width="130" height="165" fill="#FFFBEA" rx="8"/>
                            <rect x="310" y="150" width="140" height="130" fill="#E8ECE1" rx="8"/>
                            <rect x="470" y="150" width="110" height="130" fill="#FAF5E8" rx="8"/>

                            <path d="M0 130L600 130" stroke="#FFFFFF" stroke-width="18"/>
                            <path d="M0 130L600 130" stroke="#E2DCD0" stroke-width="12"/>
                            
                            <path d="M165 0L165 300" stroke="#FFFFFF" stroke-width="16"/>
                            <path d="M165 0L165 300" stroke="#E2DCD0" stroke-width="10"/>

                            <path d="M300 0L300 300" stroke="#FFFFFF" stroke-width="18"/>
                            <path d="M300 0L300 300" stroke="#FDE68A" stroke-width="12"/>

                            <path d="M460 0L460 300" stroke="#FFFFFF" stroke-width="14"/>
                            <path d="M460 0L460 300" stroke="#E2DCD0" stroke-width="8"/>

                            <path d="M0 270L600 270" stroke="#FFFFFF" stroke-width="14"/>
                            <path d="M0 270L600 270" stroke="#E2DCD0" stroke-width="8"/>

                            <path d="M0 30L600 250" stroke="#FFFFFF" stroke-width="16"/>
                            <path d="M0 30L600 250" stroke="#E2DCD0" stroke-width="10"/>

                            <text x="310" y="90" font-size="10" fill="#A8A29E" font-family="sans-serif" font-weight="600">Shyam Nagar Road</text>
                            <text x="180" y="240" font-size="10" fill="#A8A29E" font-family="sans-serif" font-weight="600">Ajmer Road Exn</text>
                        </svg>

                        <div class="map-location-pin">
                            <svg width="40" height="48" viewBox="0 0 38 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 0C8.50659 0 0 8.50659 0 19C0 31.5 19 46 19 46C19 46 38 31.5 38 19C38 8.50659 29.4934 0 19 0Z" fill="#EF4444"/>
                                <path d="M19 2C9.61116 2 2 9.61116 2 19C2 30.2 17.6 43 19 44.2C20.4 43 36 30.2 36 19C36 9.61116 28.3888 2 19 2Z" fill="#DC2626"/>
                                <circle cx="19" cy="18" r="7" fill="#FFFFFF"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Office Location & Map Section End -->

    <!-- Promise & Dark Stats Section Start -->
    <section class="trust-stats-section">
        <div class="section-container" style="max-width: 1280px; margin: 0 auto;">

            <div class="promise-header-block">
                <div class="promise-subheading-wrapper">
                    <span class="accent-dash left"></span>
                    <h3 class="promise-sub-text">जल्द जवाब का वादा</h3>
                    <span class="accent-dash right"></span>
                </div>
                <p class="promise-sub-desc">हम आपकी सभी पूछताछ का 24 घंटे के भीतर जवाब देने की पूरी कोशिश करते हैं।</p>
            </div>

            <div class="trust-cards-grid">
                <div class="trust-card-item">
                    <div class="trust-card-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="trust-card-text">
                        <h4 class="trust-card-title">जल्द जवाब</h4>
                        <span class="trust-card-sub">24 घंटे के भीतर</span>
                    </div>
                </div>

                <div class="trust-card-item">
                    <div class="trust-card-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div class="trust-card-text">
                        <h4 class="trust-card-title">100% सहायता</h4>
                        <span class="trust-card-sub">हमेशा आपकी मदद के लिए</span>
                    </div>
                </div>

                <div class="trust-card-item">
                    <div class="trust-card-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <polyline points="9 12 11 14 15 10"/>
                        </svg>
                    </div>
                    <div class="trust-card-text">
                        <h4 class="trust-card-title">भरोसा और सुरक्षा</h4>
                        <span class="trust-card-sub">आपकी जानकारी सुरक्षित</span>
                    </div>
                </div>

                <div class="trust-card-item">
                    <div class="trust-card-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </div>
                    <div class="trust-card-text">
                        <h4 class="trust-card-title">समर्पित सपोर्ट टीम</h4>
                        <span class="trust-card-sub">Best समाधान हमारा लक्ष्य</span>
                    </div>
                </div>
            </div>

            <!-- Dark Blue Stats Bar -->
            <div class="dark-stats-card">
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
    <!-- Promise & Dark Stats Section End -->
@endsection
@extends('front.layout.main')
@section('title', $pageTitle ?? 'Sahi Agent, Sahi Connection')

@section('content')

    <!-- Main Hero Banner Section Start -->
    <section class="index-hero-banner-section">
        <div class="index-hero-banner-container">
            <img src="{{ asset('front/assets/images/index_hero_banner.png') }}" alt="Agent Sahi Yahi Milega! - Agent 24 India" class="index-hero-banner-img">
        </div>
    </section>
    <!-- Main Hero Banner Section End -->

    <!-- Search & Features Section Start -->
    <section class="index-search-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px;">
            <!-- Overlapping Dark Blue Search Card -->
            <div class="search-card-container">
                <div class="search-card-header">
                    <svg class="search-title-icon" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <span>आपको किस काम के लिए Agent चाहिए?</span>
                </div>

                <form class="search-card-form" id="agentSearchForm">
                    <div class="form-grid">

                        <!-- Input 1: Aap kya khoj rahe hain (Subcategory / Speciality) -->
                        <div class="form-field">
                            <label class="field-label">आप क्या खोज रहे हैं?</label>
                            <div class="input-with-icon">
                                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <select class="select2 custom-select" id="agentTypeSelect">
                                    <option value="" selected>सभी Agent Services</option>
                                    @if(isset($subCategories) && count($subCategories) > 0)
                                        @foreach($subCategories as $subCat)
                                            <option value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="real_estate">Real Estate Agent</option>
                                        <option value="financial">Financial Advisor</option>
                                        <option value="insurance">Insurance Agent</option>
                                        <option value="travel">Travel & Tour Agent</option>
                                        <option value="legal">Legal Consultant</option>
                                        <option value="education">Education Consultant</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Input 2: Aapka shahar / jila chunen -->
                        <div class="form-field">
                            <label class="field-label">आपका शहर / जिला चुनें</label>
                            <div class="input-with-icon">
                                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <select class="select2 custom-select" id="cityInput">
                                    <option value="">Select District / City</option>
                                    @if(isset($district) && count($district) > 0)
                                        @foreach($district as $d)
                                            <option value="{{ $d->id }}" {{ $d->name == 'Jaipur' ? 'selected' : '' }}>{{ $d->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="Jaipur" selected>Jaipur, Rajasthan</option>
                                        <option value="Jodhpur">Jodhpur, Rajasthan</option>
                                        <option value="Udaipur">Udaipur, Rajasthan</option>
                                        <option value="Kota">Kota, Rajasthan</option>
                                        <option value="Bikaner">Bikaner, Rajasthan</option>
                                        <option value="Ajmer">Ajmer, Rajasthan</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Input 3: Category chunen -->
                        <div class="form-field">
                            <label class="field-label">Category चुनें</label>
                            <div class="input-with-icon">
                                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                                <select class="select2 custom-select" id="categorySelect">
                                    <option value="" selected>All Categories</option>
                                    @if(isset($category) && count($category) > 0)
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="property">Property & Housing</option>
                                        <option value="loans">Loans & Finance</option>
                                        <option value="life_insurance">Life & Health Insurance</option>
                                        <option value="tour">Tours & Visas</option>
                                        <option value="law">Law & Registration</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="form-field btn-field">
                            <button type="submit" class="btn-search-agent" id="searchAgentBtn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <span>Agent खोजें</span>
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- Bottom Stats Metrics Bar -->
            <div class="hero-stats-bar">
                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">10,000+</span>
                        <span class="stat-label">Verified Agents</span>
                    </div>
                </div>

                <div class="stat-divider"></div>

                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Cities Covered</span>
                    </div>
                </div>

                <div class="stat-divider"></div>

                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Categories</span>
                    </div>
                </div>

                <div class="stat-divider"></div>

                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">1L+</span>
                        <span class="stat-label">Happy Customers</span>
                    </div>
                </div>

                <div class="stat-divider"></div>

                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path
                                d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z">
                            </path>
                        </svg>
                    </div>
                    <div class="stat-text-group">
                        <span class="stat-number">24x7</span>
                        <span class="stat-label">Support</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Search & Features Section End -->

    <!-- Popular Categories Section Start -->
    <section class="categories-section">
        <div class="section-container">

            <!-- Section Header -->
            <div class="section-header">
                <span class="header-line"></span>
                <h2 class="section-title">लोकप्रिय Categories</h2>
                <span class="header-line"></span>
            </div>

            <!-- Categories Grid -->
            <div class="categories-grid">
                @php
                    $categoryStyles = [
                        ['icon' => 'icon-orange', 'color' => '#F97316', 'sub' => 'Buy / Sell / Rent', 'svg' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>'],
                        ['icon' => 'icon-blue', 'color' => '#2563EB', 'sub' => 'Car, Bike & More', 'svg' => '<path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle>'],
                        ['icon' => 'icon-green', 'color' => '#16A34A', 'sub' => 'RTO Related Services', 'svg' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>'],
                        ['icon' => 'icon-purple', 'color' => '#9333EA', 'sub' => 'Life, Health, General', 'svg' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path>'],
                        ['icon' => 'icon-rupee', 'color' => '#EA580C', 'sub' => 'Loan & Finance', 'svg' => '<circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M8 9h8M8 15h6"></path>'],
                        ['icon' => 'icon-scale', 'color' => '#059669', 'sub' => 'All Legal Services', 'svg' => '<path d="M12 3v18M3 7l9-4 9 4M5 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7M15 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7"></path>'],
                        ['icon' => 'icon-red', 'color' => '#DC2626', 'sub' => 'Transport & Logistics', 'svg' => '<rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle>']
                    ];
                @endphp

                @if(isset($category) && count($category) > 0)
                    @foreach($category->take(7) as $index => $cat)
                        @php
                            $style = $categoryStyles[$index % count($categoryStyles)];
                        @endphp
                        <a href="{{ route('front.vendorlist.category', $cat->id) }}" class="category-card">
                            <div class="category-icon-box {{ $style['icon'] }}">
                                @if(!empty($cat->image) && file_exists(public_path('upload/category/'.$cat->image)))
                                    <img src="{{ asset('upload/category/'.$cat->image) }}" alt="{{ $cat->name }}" style="width: 32px; height: 32px; object-fit: contain;">
                                @else
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="{{ $style['color'] }}" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        {!! $style['svg'] !!}
                                    </svg>
                                @endif
                            </div>
                            <h3 class="category-title">{{ $cat->name }}</h3>
                            <p class="category-subtitle">{{ $cat->description ? \Illuminate\Support\Str::limit($cat->description, 22) : $style['sub'] }}</p>
                        </a>
                    @endforeach
                @else
                    <!-- Fallback default categories -->
                    <a href="{{ route('front.vendorlist') }}" class="category-card">
                        <div class="category-icon-box icon-orange">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <h3 class="category-title">Real Estate Agent</h3>
                        <p class="category-subtitle">Buy / Sell / Rent</p>
                    </a>
                    <a href="{{ route('front.vendorlist') }}" class="category-card">
                        <div class="category-icon-box icon-blue">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle>
                            </svg>
                        </div>
                        <h3 class="category-title">Automobile Agent</h3>
                        <p class="category-subtitle">Car, Bike & More</p>
                    </a>
                    <a href="{{ route('front.vendorlist') }}" class="category-card">
                        <div class="category-icon-box icon-green">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>
                            </svg>
                        </div>
                        <h3 class="category-title">RTO Agent</h3>
                        <p class="category-subtitle">RTO Related Services</p>
                    </a>
                    <a href="{{ route('front.vendorlist') }}" class="category-card">
                        <div class="category-icon-box icon-purple">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9333EA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="category-title">Insurance Agent</h3>
                        <p class="category-subtitle">Life, Health, General</p>
                    </a>
                    <a href="{{ route('front.vendorlist') }}" class="category-card">
                        <div class="category-icon-box icon-rupee">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#EA580C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M8 9h8M8 15h6"></path>
                            </svg>
                        </div>
                        <h3 class="category-title">Finance Agent</h3>
                        <p class="category-subtitle">Loan & Finance</p>
                    </a>
                    <a href="{{ route('front.vendorlist') }}" class="category-card">
                        <div class="category-icon-box icon-scale">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3v18M3 7l9-4 9 4M5 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7M15 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7"></path>
                            </svg>
                        </div>
                        <h3 class="category-title">Legal Agent</h3>
                        <p class="category-subtitle">All Legal Services</p>
                    </a>
                    <a href="{{ route('front.vendorlist') }}" class="category-card">
                        <div class="category-icon-box icon-red">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                        <h3 class="category-title">Transport Agent</h3>
                        <p class="category-subtitle">Transport & Logistics</p>
                    </a>
                @endif

                <!-- Card 8: More Categories -->
                <a href="{{ route('front.vendorlist') }}" class="category-card card-more">
                    <div class="category-icon-box icon-dots">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9"></circle>
                            <circle cx="8" cy="12" r="1" fill="#2563EB"></circle>
                            <circle cx="12" cy="12" r="1" fill="#2563EB"></circle>
                            <circle cx="16" cy="12" r="1" fill="#2563EB"></circle>
                        </svg>
                    </div>
                    <h3 class="category-title">और भी बहुत कुछ</h3>
                    <p class="category-subtitle highlight-subtitle">18+ Categories</p>
                </a>

            </div>

            <!-- View All Categories Button -->
            <div class="view-all-wrapper">
                <a href="{{ route('front.vendorlist') }}" class="btn-view-all">
                    <span>सभी Categories देखें</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>

        </div>
    </section>
    <!-- Popular Categories Section End -->

    <!-- Why Choose Agent 24 India Banner Section Start -->
    <section class="why-choose-section">
        <div class="section-container" style="max-width: 1240px; margin: 0 auto; padding: 0 24px;">
            
            <div class="custom-why-choose-banner">
                <!-- Top Center Title Header -->
                <div class="custom-why-header">
                    <span class="custom-why-line"></span>
                    <h2 class="custom-why-title">Agent 24 India क्यों चुनें?</h2>
                    <span class="custom-why-line"></span>
                </div>

                <!-- Main Content Row -->
                <div class="custom-why-main-row">
                    
                    <!-- 5 Feature Columns Group -->
                    <div class="custom-why-features-grid">
                        
                        <!-- Feature 1 -->
                        <div class="custom-why-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                    <path d="M22 9L12 13.5V21C12 27.6 16.3 33.7 22 35C27.7 33.7 32 27.6 32 21V13.5L22 9Z" fill="#004BEE" stroke="#FFFFFF" stroke-width="1.5"/>
                                    <path d="M17.5 21L20.5 24L26.5 18" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">100% Verified & Trusted</h3>
                                <p class="custom-why-sub">हर Agent की जांच के बाद ही Listing</p>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="custom-why-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                    <path d="M26 27V25.5C26 23.5 23.5 22 20.5 22C17.5 22 15 23.5 15 25.5V27" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="20.5" cy="16.5" r="3.5" stroke="#FFFFFF" stroke-width="2"/>
                                    <path d="M30 27V25.5C30 24.2 28.8 23 27 22.4" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M26 13.2C27.8 13.8 29 15.3 29 16.5" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">Direct Contact With Agent</h3>
                                <p class="custom-why-sub">बीच में कोई Third Party नहीं</p>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="custom-why-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                    <path d="M26 12H15C13.9 12 13 12.9 13 14V30C13 31.1 13.9 32 15 32H27C28.1 32 29 31.1 29 30V15L26 12Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17 20H25M17 24H25M17 28H21" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">Sahi Jankari, Sahi Faisla</h3>
                                <p class="custom-why-sub">सही जानकारी के साथ सही Agent चुनें</p>
                            </div>
                        </div>

                        <!-- Feature 4 -->
                        <div class="custom-why-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                    <circle cx="22" cy="22" r="10" stroke="#FFFFFF" stroke-width="2"/>
                                    <path d="M22 16V28M19 19H25M19 23H24" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">Save Time & Money</h3>
                                <p class="custom-why-sub">सही Agent से काम, समय और पैसों की बचत</p>
                            </div>
                        </div>

                        <!-- Feature 5 -->
                        <div class="custom-why-col last-col">
                            <div class="custom-why-icon-wrap">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <circle cx="22" cy="22" r="20" fill="rgba(0, 75, 238, 0.4)" stroke="#3B82F6" stroke-width="1.5"/>
                                    <path d="M14 27V22C14 17.6 17.6 14 22 14C26.4 14 30 17.6 30 22V27" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                    <rect x="12" y="24" width="4" height="7" rx="2" fill="#FFFFFF"/>
                                    <rect x="28" y="24" width="4" height="7" rx="2" fill="#FFFFFF"/>
                                </svg>
                            </div>
                            <div class="custom-why-text">
                                <h3 class="custom-why-head">24x7 Support Team</h3>
                                <p class="custom-why-sub">हमेशा आपकी मदद के लिए तैयार</p>
                            </div>
                        </div>

                    </div>

                    <!-- Right Side Customer Photo & Floating Badge -->
                    <div class="custom-why-photo-wrap">
                        <!-- Floating Speech Bubble Callout -->
                        <div class="custom-why-speech-bubble">
                            <span class="custom-bubble-title">Happy Customers,<br>Our Priority!</span>
                            <div class="custom-bubble-stars">★★★★★</div>
                        </div>

                        <!-- Woman Photo Image Frame -->
                        <div class="custom-woman-photo-frame">
                            <img src="{{ asset('front/assets/images/woman_pointing.jpg') }}" alt="Happy Customer - Agent 24 India" class="custom-woman-img">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- Why Choose Agent 24 India Banner Section End -->

    <!-- How it Works (Agent Kaise Khoje?) Section Start -->
    <section class="how-it-works-section">
        <div class="section-container">

            <!-- Section Header -->
            <div class="section-header">
                <span class="header-line"></span>
                <h2 class="section-title">Agent Kaise Khoje?</h2>
                <span class="header-line"></span>
            </div>

            <!-- Steps Flow Container -->
            <div class="steps-flow-wrapper">

                <!-- Step 1 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <span class="step-number-badge badge-blue">1</span>
                        <div class="step-icon-circle circle-blue">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#004BEE"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                    </div>
                    <h3 class="step-title title-blue">Apni Zaroorat Bataye</h3>
                    <p class="step-desc">Shahar, Category aur Service chune</p>
                </div>

                <!-- Connecting Arrow 1 -->
                <div class="step-arrow">
                    <svg width="48" height="16" viewBox="0 0 48 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 8H40" stroke="#94A3B8" stroke-width="2" stroke-dasharray="4 4" />
                        <path d="M36 3L43 8L36 13" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Step 2 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <span class="step-number-badge badge-orange">2</span>
                        <div class="step-icon-circle circle-orange">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#EA580C"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                <circle cx="9" cy="10" r="2.5"></circle>
                                <path d="M15 8h2M15 12h2M7 16h10"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="step-title title-orange">Best Agents Dekhe</h3>
                    <p class="step-desc">Top Verified Agents ki list dekhe aur compare kare</p>
                </div>

                <!-- Connecting Arrow 2 -->
                <div class="step-arrow">
                    <svg width="48" height="16" viewBox="0 0 48 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 8H40" stroke="#94A3B8" stroke-width="2" stroke-dasharray="4 4" />
                        <path d="M36 3L43 8L36 13" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Step 3 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <span class="step-number-badge badge-green">3</span>
                        <div class="step-icon-circle circle-green">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="step-title title-green">Seedha Sampark Kare</h3>
                    <p class="step-desc">Agent se call ya message karke baat kare</p>
                </div>

                <!-- Connecting Arrow 3 -->
                <div class="step-arrow">
                    <svg width="48" height="16" viewBox="0 0 48 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 8H40" stroke="#94A3B8" stroke-width="2" stroke-dasharray="4 4" />
                        <path d="M36 3L43 8L36 13" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>

                <!-- Step 4 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <span class="step-number-badge badge-purple">4</span>
                        <div class="step-icon-circle circle-purple">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#9333EA"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"></path>
                                <path
                                    d="m7 21 1.6-1.4c.4-.4.4-1 0-1.4l-2.2-2.2c-.4-.4-1-.4-1.4 0L2.6 17.4c-.8.8-.8 2 0 2.8l1.6 1.6c.8.8 2 .8 2.8 0Z">
                                </path>
                                <path d="m14.5 12.5 2.2-2.2c.4-.4 1-.4 1.4 0l1.4 1.4c.4.4.4 1 0 1.4l-2.2 2.2"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="step-title title-purple">Kaam Shuru Kare</h3>
                    <p class="step-desc">Vishwas ke saath apna kaam pura kare</p>
                </div>

            </div>

        </div>
    </section>
    <!-- How it Works Section End -->

    <!-- Top Verified Agents Section Start -->
    <section class="verified-agents-section" id="verifiedAgents">
        <div class="section-container">
            <div class="verified-agents-card">

                <!-- Section Header -->
                <div class="verified-agents-header">
                    <h2 class="verified-title">Top Verified Agents</h2>
                    <a href="{{ route('front.vendorlist') }}" class="view-all-link">
                        <span>सभी देखें</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>

                <!-- Carousel Slider Wrapper -->
                <div class="carousel-relative-wrapper">
                    <!-- Left Arrow Control -->
                    <button class="slider-btn prev-btn" id="agentPrevBtn" aria-label="Previous Agents">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>

                    <!-- Cards Container (Scrollable track) -->
                    <div class="agents-slider-track" id="agentsSliderTrack">

                        @php
                            $defaultAgentAvatars = [
                                'agent_sharma.jpg',
                                'agent_krishna.jpg',
                                'agent_rto.jpg',
                                'agent_insurance.jpg',
                                'agent_legal.jpg',
                                'agent_travel.jpg'
                            ];
                        @endphp

                        @if(isset($vendoruser) && count($vendoruser) > 0)
                            @foreach($vendoruser as $key => $vendor)
                                @php
                                    $avatar = !empty($vendor->profile_image) && file_exists(public_path('upload/profile/'.$vendor->profile_image)) 
                                        ? asset('upload/profile/'.$vendor->profile_image) 
                                        : asset('front/assets/images/' . $defaultAgentAvatars[$key % count($defaultAgentAvatars)]);
                                @endphp
                                <div class="agent-card">
                                    <div class="verified-badge">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span>VERIFIED</span>
                                    </div>
                                    <div class="agent-avatar-wrapper">
                                        <img src="{{ $avatar }}" alt="{{ $vendor->name }}" class="agent-avatar-img">
                                    </div>
                                    <h3 class="agent-name">{{ $vendor->name }}</h3>
                                    <p class="agent-category">{{ $vendor->business_category_name ?? 'Consultant Agent' }}</p>
                                    <p class="agent-location">{{ $vendor->district->name ?? 'Rajasthan' }}</p>
                                    <div class="agent-rating-row">
                                        <div class="rating-stars">★★★★★</div>
                                        <span class="rating-score">4.8 <span class="rating-count">({{ rand(80, 200) }})</span></span>
                                    </div>
                                    <div class="agent-card-actions">
                                        <a href="{{ route('front.vendor.details', $vendor->id) }}" class="btn-agent-outlined">View Profile</a>
                                        <a href="tel:{{ $vendor->mobile ?? '+919876543210' }}" class="btn-agent-filled">Call Now</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback Mockup Agent Cards -->
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_sharma.jpg') }}" alt="Sharma Property Consultant" class="agent-avatar-img"></div>
                                <h3 class="agent-name">Sharma Property Consultant</h3>
                                <p class="agent-category">Real Estate Agent</p>
                                <p class="agent-location">Jaipur, Rajasthan</p>
                                <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.8 <span class="rating-count">(120)</span></span></div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543210" class="btn-agent-filled">Call Now</a></div>
                            </div>
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_krishna.jpg') }}" alt="Krishna Motors" class="agent-avatar-img"></div>
                                <h3 class="agent-name">Krishna Motors</h3>
                                <p class="agent-category">Automobile Agent</p>
                                <p class="agent-location">Jodhpur, Rajasthan</p>
                                <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.7 <span class="rating-count">(98)</span></span></div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543211" class="btn-agent-filled">Call Now</a></div>
                            </div>
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_rto.jpg') }}" alt="RTO Solution Point" class="agent-avatar-img"></div>
                                <h3 class="agent-name">RTO Solution Point</h3>
                                <p class="agent-category">RTO Agent</p>
                                <p class="agent-location">Ajmer, Rajasthan</p>
                                <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.9 <span class="rating-count">(155)</span></span></div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543212" class="btn-agent-filled">Call Now</a></div>
                            </div>
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_insurance.jpg') }}" alt="Secure Life Insurance" class="agent-avatar-img"></div>
                                <h3 class="agent-name">Secure Life Insurance</h3>
                                <p class="agent-category">Insurance Agent</p>
                                <p class="agent-location">Udaipur, Rajasthan</p>
                                <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.8 <span class="rating-count">(112)</span></span></div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543213" class="btn-agent-filled">Call Now</a></div>
                            </div>
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_legal.jpg') }}" alt="Legal Expert Associates" class="agent-avatar-img"></div>
                                <h3 class="agent-name">Legal Expert Associates</h3>
                                <p class="agent-category">Legal Agent</p>
                                <p class="agent-location">Bikaner, Rajasthan</p>
                                <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.7 <span class="rating-count">(88)</span></span></div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543214" class="btn-agent-filled">Call Now</a></div>
                            </div>
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-avatar-wrapper"><img src="{{ asset('front/assets/images/agent_travel.jpg') }}" alt="Rajputana Travels" class="agent-avatar-img"></div>
                                <h3 class="agent-name">Rajputana Travels</h3>
                                <p class="agent-category">Travel & Tour Agent</p>
                                <p class="agent-location">Kota, Rajasthan</p>
                                <div class="agent-rating-row"><div class="rating-stars">★★★★★</div><span class="rating-score">4.9 <span class="rating-count">(142)</span></span></div>
                                <div class="agent-card-actions"><a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a><a href="tel:+919876543215" class="btn-agent-filled">Call Now</a></div>
                            </div>
                        @endif

                    </div>

                    <!-- Right Arrow Control -->
                    <button class="slider-btn next-btn" id="agentNextBtn" aria-label="Next Agents">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </section>
    <!-- Top Verified Agents Section End -->

    <!-- Rajasthan Districts Section Start -->
    <section class="districts-section" id="rajasthanDistricts">
        <!-- Heritage Background Line-Art Watermarks -->
        <div class="heritage-bg-art heritage-left">
            <svg viewBox="0 0 160 360" fill="none" stroke="#004BEE" stroke-width="1.2" stroke-linecap="round"
                opacity="0.15">
                <path d="M0 360V220H25V180H45V140C45 130 55 120 65 120C75 120 85 130 85 140V180H105V220H130V360" />
                <path d="M65 120V70C65 70 50 60 50 45C50 30 65 15 65 15C65 15 80 30 80 45C80 60 65 70 65 70Z" />
                <path d="M25 220C25 200 35 190 35 190C35 190 45 200 45 220" />
                <path d="M85 220C85 200 95 190 95 190C95 190 105 200 105 220" />
                <path d="M130 360V260H160V360" />
            </svg>
        </div>
        <div class="heritage-bg-art heritage-right">
            <svg viewBox="0 0 160 360" fill="none" stroke="#004BEE" stroke-width="1.2" stroke-linecap="round"
                opacity="0.15">
                <path d="M160 360V220H135V180H115V140C115 130 105 120 95 120C85 120 75 130 75 140V180H55V220H30V360" />
                <path d="M95 120V70C95 70 110 60 110 45C110 30 95 15 95 15C95 15 80 30 80 45C80 60 95 70 95 70Z" />
                <path d="M135 220C135 200 125 190 125 190C125 190 115 200 115 220" />
                <path d="M75 220C75 200 65 190 65 190C65 190 55 200 55 220" />
                <path d="M30 360V260H0V360" />
            </svg>
        </div>

        <div class="section-container">

            <!-- Styled Decorative Header -->
            <div class="district-header">
                <div class="header-accent-line">
                    <span class="line-start"></span>
                    <span class="line-dot"></span>
                </div>
                <h2 class="district-section-title">Rajasthan Ke Capital District</h2>
                <div class="header-accent-line">
                    <span class="line-dot"></span>
                    <span class="line-end"></span>
                </div>
            </div>

            <!-- Carousel Slider Wrapper -->
            <div class="district-carousel-wrapper">
                <!-- Left Control Button -->
                <button class="slider-btn prev-btn" id="districtPrevBtn" aria-label="Previous Districts">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>

                <!-- Scrollable Track -->
                <div class="district-slider-track" id="districtSliderTrack">

                    @php
                        $districtsToDisplay = (isset($districthome) && count($districthome) > 0) ? $districthome : (isset($district) ? $district : []);
                    @endphp

                    @if(count($districtsToDisplay) > 0)
                        @foreach($districtsToDisplay as $index => $dist)
                            @php
                                $dName = strtolower(trim($dist->name));
                            @endphp
                            <div class="district-card">
                                <div class="district-image-wrapper">
                                    @if(str_contains($dName, 'jaipur'))
                                        <img src="{{ asset('front/assets/images/jal-mahal-jaipur-9175.jpg') }}" alt="{{ $dist->name }}" class="district-img">
                                    @elseif(str_contains($dName, 'jodhpur'))
                                        <img src="{{ asset('front/assets/images/jodhpur.jpg') }}" alt="{{ $dist->name }}" class="district-img">
                                    @elseif(str_contains($dName, 'udaipur'))
                                        <svg viewBox="0 0 300 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="landmark-svg">
                                            <rect width="300" height="160" fill="url(#udaipur-sky)" />
                                            <rect y="105" width="300" height="55" fill="url(#lake-water)" />
                                            <path d="M40 105V50H80V35H130V50H170V30H210V50H260V105H40Z" fill="#F8FAFC" />
                                            <path d="M50 105V58H85V42H125V58H165V38H205V58H250V105H50Z" fill="#FFFFFF" />
                                            <path d="M95 35C95 20 102 12 107 12C112 12 120 20 120 35H95Z" fill="#F1F5F9" />
                                            <path d="M175 30C175 15 182 8 187 8C192 8 200 15 200 30H175Z" fill="#F1F5F9" />
                                            <defs>
                                                <linearGradient id="udaipur-sky" x1="0" y1="0" x2="0" y2="160" gradientUnits="userSpaceOnUse"><stop stop-color="#0284C7" /><stop offset="0.65" stop-color="#E0F2FE" /></linearGradient>
                                                <linearGradient id="lake-water" x1="0" y1="105" x2="0" y2="160" gradientUnits="userSpaceOnUse"><stop stop-color="#0284C7" /><stop offset="1" stop-color="#0369A1" /></linearGradient>
                                            </defs>
                                        </svg>
                                    @elseif(str_contains($dName, 'kota'))
                                        <svg viewBox="0 0 300 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="landmark-svg">
                                            <rect width="300" height="160" fill="url(#kota-sky)" />
                                            <rect y="110" width="300" height="50" fill="#0284C7" />
                                            <path d="M30 110V50H90V30H130V50H170V110H30Z" fill="#9A3412" />
                                            <path d="M40 110V58H85V38H125V58H160V110H40Z" fill="#C2410C" />
                                            <defs><linearGradient id="kota-sky" x1="0" y1="0" x2="0" y2="160" gradientUnits="userSpaceOnUse"><stop stop-color="#38BDF8" /><stop offset="0.7" stop-color="#E0F2FE" /></linearGradient></defs>
                                        </svg>
                                    @elseif(str_contains($dName, 'bikaner'))
                                        <svg viewBox="0 0 300 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="landmark-svg">
                                            <rect width="300" height="160" fill="url(#bikaner-sky)" />
                                            <path d="M40 135V45H90V25H140V45H190V30H230V45H260V135H40Z" fill="#991B1B" />
                                            <path d="M50 135V52H85V32H135V52H185V38H225V52H250V135H50Z" fill="#B91C1C" />
                                            <defs><linearGradient id="bikaner-sky" x1="0" y1="0" x2="0" y2="160" gradientUnits="userSpaceOnUse"><stop stop-color="#F97316" /><stop offset="0.6" stop-color="#FFEDD5" /></linearGradient></defs>
                                        </svg>
                                    @else
                                        <svg viewBox="0 0 300 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="landmark-svg">
                                            <rect width="300" height="160" fill="url(#ajmer-sky)" />
                                            <rect y="120" width="300" height="40" fill="#0284C7" />
                                            <path d="M50 120V70H250V120H50Z" fill="#F8FAFC" />
                                            <path d="M105 70C105 35 125 15 150 15C175 15 195 35 195 70H105Z" fill="#FFFFFF" />
                                            <defs><linearGradient id="ajmer-sky" x1="0" y1="0" x2="0" y2="160" gradientUnits="userSpaceOnUse"><stop stop-color="#0284C7" /><stop offset="0.75" stop-color="#BAE6FD" /></linearGradient></defs>
                                        </svg>
                                    @endif
                                </div>
                                <div class="district-info-body">
                                    <div class="district-meta-row">
                                        <h3 class="district-name">{{ $dist->name }}</h3>
                                        <span class="district-agents-count">{{ rand(3, 12) }},{{ rand(100, 900) }}+ Agents</span>
                                    </div>
                                    <a href="{{ route('front.vendorlist.location', $dist->id) }}" class="btn-explore-district">
                                        <span>Explore</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback Sample Districts -->
                        <div class="district-card">
                            <div class="district-image-wrapper">
                                <img src="{{ asset('front/assets/images/jal-mahal-jaipur-9175.jpg') }}" alt="Jaipur Jal Mahal" class="district-img">
                            </div>
                            <div class="district-info-body">
                                <div class="district-meta-row">
                                    <h3 class="district-name">Jaipur</h3>
                                    <span class="district-agents-count">12,500+ Agents</span>
                                </div>
                                <a href="{{ route('front.vendorlist') }}" class="btn-explore-district">
                                    <span>Explore</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                            </div>
                        </div>
                        <div class="district-card">
                            <div class="district-image-wrapper">
                                <img src="{{ asset('front/assets/images/jodhpur.jpg') }}" alt="Jodhpur Mehrangarh Fort" class="district-img">
                            </div>
                            <div class="district-info-body">
                                <div class="district-meta-row">
                                    <h3 class="district-name">Jodhpur</h3>
                                    <span class="district-agents-count">8,200+ Agents</span>
                                </div>
                                <a href="{{ route('front.vendorlist') }}" class="btn-explore-district">
                                    <span>Explore</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Right Control Button -->
                <button class="slider-btn next-btn" id="districtNextBtn" aria-label="Next Districts">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>

        </div>
    </section>
    <!-- Rajasthan Districts Section End -->

    <!-- View All Districts Button Wrapper -->
    <div class="view-all-districts-wrapper">
        <a href="{{ route('front.vendorlist') }}" class="btn-all-districts">
            <span>सभी जिलों को देखें</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>

    <!-- Happy Customers Testimonials Section Start -->
    <section class="testimonials-section" id="testimonials">
        <div class="section-container">

            <!-- Section Header -->
            <div class="testimonials-header">
                <div class="header-arrow-line left-line">
                    <svg width="50" height="12" viewBox="0 0 50 12" fill="none">
                        <line x1="0" y1="6" x2="42" y2="6" stroke="#004BEE" stroke-width="2" />
                        <path d="M36 1L43 6L36 11" stroke="#004BEE" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <h2 class="testimonials-title">हमारे Happy Customers क्या कहते हैं?</h2>
                <div class="header-arrow-line right-line">
                    <svg width="50" height="12" viewBox="0 0 50 12" fill="none">
                        <line x1="8" y1="6" x2="50" y2="6" stroke="#004BEE" stroke-width="2" />
                        <path d="M14 1L7 6L14 11" stroke="#004BEE" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <!-- Testimonials Carousel Slider Wrapper -->
            <div class="testimonials-carousel-wrapper">
                <!-- Left Arrow Control -->
                <button class="slider-btn prev-btn" id="testimonialPrevBtn" aria-label="Previous Testimonial">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>

                <!-- Slider Track -->
                <div class="testimonials-slider-track" id="testimonialSliderTrack">

                    <!-- Testimonial Card 1 -->
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="50" fill="#F1F5F9" />
                                <path d="M15 100C15 76 30 68 50 68C70 68 85 76 85 100H15Z" fill="#1E293B" />
                                <path d="M40 68L50 86L60 68" fill="#FFFFFF" />
                                <path d="M46 68L50 88L54 68" fill="#004BEE" />
                                <path d="M44 54V68H56V54H44Z" fill="#E2A687" />
                                <path
                                    d="M34 40C34 52 41 60 50 60C59 60 66 52 66 40C66 28 59 22 50 22C41 22 34 28 34 40Z"
                                    fill="#F0B89A" />
                                <path
                                    d="M30 38C30 20 38 10 50 10C62 10 70 20 70 38C70 52 66 65 62 72C60 64 63 48 60 34C56 24 52 21 50 21C48 21 44 24 40 34C37 48 40 64 38 72C34 65 30 52 30 38Z"
                                    fill="#0F172A" />
                                <circle cx="45" cy="39" r="2" fill="#0F172A" />
                                <circle cx="55" cy="39" r="2" fill="#0F172A" />
                                <path d="M44 48C47 52 53 52 56 48" stroke="#0F172A" stroke-width="1.5" fill="#FFFFFF"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="testimonial-content">
                            <div class="testimonial-stars">★★★★★</div>
                            <p class="testimonial-quote">"Agent 24 India की मदद से हमें Jaipur में भरोसेमंद Property
                                Consultant बहुत जल्दी मिल गया। अब घर लेना आसान हो गया!"</p>
                            <h4 class="testimonial-author">Neha Sharma, Jaipur</h4>
                        </div>
                    </div>

                    <!-- Testimonial Card 2 -->
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="50" fill="#E0F2FE" />
                                <path d="M15 100C15 76 30 68 50 68C70 68 85 76 85 100H15Z" fill="#3B82F6" />
                                <path d="M40 68L50 84L60 68" fill="#FFFFFF" />
                                <path d="M44 54V68H56V54H44Z" fill="#D99B75" />
                                <path
                                    d="M34 38C34 50 41 58 50 58C59 58 66 50 66 38C66 26 59 20 50 20C41 20 34 26 34 38Z"
                                    fill="#E2A687" />
                                <circle cx="44" cy="36" r="2" fill="#111827" />
                                <circle cx="56" cy="36" r="2" fill="#111827" />
                                <path d="M45 46C48 49 52 49 55 46" fill="#FFFFFF" stroke="#111827" stroke-width="1.2" />
                            </svg>
                        </div>
                        <div class="testimonial-content">
                            <div class="testimonial-stars">★★★★★</div>
                            <p class="testimonial-quote">"RTO का काम महीनों से अटका था, यहाँ सही Agent मिला और 2 दिन में
                                काम पूरा हो गया!"</p>
                            <h4 class="testimonial-author">Rahul Mehta, Udaipur</h4>
                        </div>
                    </div>

                    <!-- Testimonial Card 3 -->
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="50" fill="#FEF3C7" />
                                <path d="M15 100C15 76 30 68 50 68C70 68 85 76 85 100H15Z" fill="#475569" />
                                <path d="M40 68L50 84L60 68" fill="#FFFFFF" />
                                <path d="M44 54V68H56V54H44Z" fill="#E8B496" />
                                <path
                                    d="M34 38C34 50 41 58 50 58C59 58 66 50 66 38C66 26 59 20 50 20C41 20 34 26 34 38Z"
                                    fill="#F0C3AA" />
                                <circle cx="44" cy="36" r="2" fill="#0F172A" />
                                <circle cx="56" cy="36" r="2" fill="#0F172A" />
                                <path d="M45 46C48 49 52 49 55 46" fill="#FFFFFF" stroke="#0F172A" stroke-width="1.2" />
                            </svg>
                        </div>
                        <div class="testimonial-content">
                            <div class="testimonial-stars">★★★★★</div>
                            <p class="testimonial-quote">"Insurance Agent यहाँ से खोजकर सही प्लान लिया। शानदार
                                प्लेटफॉर्म है!"</p>
                            <h4 class="testimonial-author">Suresh Choudhary, Jodhpur</h4>
                        </div>
                    </div>

                </div>

                <!-- Right Arrow Control -->
                <button class="slider-btn next-btn" id="testimonialNextBtn" aria-label="Next Testimonial">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>

        </div>
    </section>
    <!-- Happy Customers Section End -->

    <!-- Agent Registration Banner Section Start -->
    <section class="agent-cta-section" id="agentRegisterCta">
        <div class="section-container">
            <div class="agent-cta-card">

                <!-- Left Column: Laptop Graphic with Dashboard & Houseplants -->
                <div class="cta-graphic-col">
                    <div class="laptop-illustration-wrapper">
                        <!-- Left Plant -->
                        <div class="plant-left">
                            <svg width="40" height="60" viewBox="0 0 40 60" fill="none">
                                <path
                                    d="M15 60V42C15 42 5 35 5 25C5 15 15 10 20 5C25 10 35 15 35 25C35 35 25 42 25 42V60H15Z"
                                    fill="#16A34A" />
                                <path d="M20 5V60" stroke="#15803D" stroke-width="2" />
                                <ellipse cx="20" cy="54" rx="10" ry="6" fill="#15803D" />
                            </svg>
                        </div>

                        <!-- SVG Laptop with Analytics Dashboard -->
                        <div class="laptop-device">
                            <svg viewBox="0 0 280 180" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="laptop-svg">
                                <!-- Screen Bezel -->
                                <rect x="25" y="10" width="230" height="140" rx="10" fill="#0F172A" />
                                <rect x="32" y="18" width="216" height="124" rx="4" fill="#FFFFFF" />

                                <!-- Header bar of dashboard -->
                                <rect x="32" y="18" width="216" height="22" fill="#004BEE" />
                                <circle cx="44" cy="29" r="4" fill="#60A5FA" />
                                <rect x="54" y="26" width="40" height="6" rx="3" fill="#FFFFFF" />
                                <rect x="200" y="24" width="36" height="10" rx="3" fill="#FFB000" />

                                <!-- Left Sidebar -->
                                <rect x="32" y="40" width="36" height="102" fill="#F1F5F9" />
                                <rect x="40" y="48" width="20" height="4" rx="2" fill="#94A3B8" />
                                <rect x="40" y="58" width="20" height="4" rx="2" fill="#004BEE" />
                                <rect x="40" y="68" width="20" height="4" rx="2" fill="#94A3B8" />
                                <rect x="40" y="78" width="20" height="4" rx="2" fill="#94A3B8" />

                                <!-- Main Dashboard Content -->
                                <rect x="76" y="48" width="48" height="26" rx="4" fill="#EFF6FF" />
                                <rect x="82" y="54" width="24" height="4" rx="2" fill="#60A5FA" />
                                <rect x="82" y="62" width="32" height="6" rx="3" fill="#004BEE" />

                                <rect x="130" y="48" width="48" height="26" rx="4" fill="#F0FDF4" />
                                <rect x="136" y="54" width="24" height="4" rx="2" fill="#4ADE80" />
                                <rect x="136" y="62" width="32" height="6" rx="3" fill="#16A34A" />

                                <rect x="184" y="48" width="56" height="26" rx="4" fill="#FEF3C7" />
                                <rect x="190" y="54" width="28" height="4" rx="2" fill="#FBBF24" />
                                <rect x="190" y="62" width="36" height="6" rx="3" fill="#D97706" />

                                <!-- Bar Chart -->
                                <rect x="76" y="82" width="104" height="52" rx="4" fill="#F8FAFC" stroke="#E2E8F0" />
                                <rect x="86" y="112" width="10" height="16" rx="2" fill="#60A5FA" />
                                <rect x="102" y="98" width="10" height="30" rx="2" fill="#004BEE" />
                                <rect x="118" y="104" width="10" height="24" rx="2" fill="#60A5FA" />
                                <rect x="134" y="92" width="10" height="36" rx="2" fill="#004BEE" />
                                <rect x="150" y="116" width="10" height="12" rx="2" fill="#60A5FA" />
                                <rect x="166" y="88" width="10" height="40" rx="2" fill="#22C55E" />

                                <!-- Pie Chart Widget -->
                                <rect x="186" y="82" width="54" height="52" rx="4" fill="#F8FAFC" stroke="#E2E8F0" />
                                <circle cx="213" cy="108" r="18" fill="#004BEE" />
                                <path d="M213 108L231 108A18 18 0 0 1 213 126Z" fill="#FFB000" />

                                <!-- Laptop Base / Bottom Lid -->
                                <path d="M10 150H270L255 165H25L10 150Z" fill="#CBD5E1" />
                                <rect x="115" y="150" width="50" height="4" rx="2" fill="#94A3B8" />
                            </svg>
                        </div>

                        <!-- Right Plant -->
                        <div class="plant-right">
                            <svg width="40" height="60" viewBox="0 0 40 60" fill="none">
                                <path
                                    d="M15 60V42C15 42 5 35 5 25C5 15 15 10 20 5C25 10 35 15 35 25C35 35 25 42 25 42V60H15Z"
                                    fill="#16A34A" />
                                <path d="M20 5V60" stroke="#15803D" stroke-width="2" />
                                <ellipse cx="20" cy="54" rx="10" ry="6" fill="#15803D" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Middle Column: Heading & Yellow CTA Button -->
                <div class="cta-content-col">
                    <h3 class="cta-main-title">Kya aap bhi ek Agent hain?</h3>
                    <p class="cta-subtitle">Apni Profile banaye, apni services promote kare aur naye customers tak
                        pahuche.</p>

                    @if(\Auth::check())
                        <a href="{{ route('front.addListing') }}" class="btn-register-yellow">
                            <span>Abhi Listing Kare</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="btn-register-yellow open-signin" onclick="$('.tab[data-tab=signup]').trigger('click');">
                            <span>Abhi Register Kare</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    @endif
                </div>

                <!-- Right Column: Checkmark Feature List -->
                <div class="cta-features-col">
                    <ul class="cta-feature-list">
                        <li class="cta-feature-item">
                            <span class="check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                    stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span>Free Listing Option</span>
                        </li>

                        <li class="cta-feature-item">
                            <span class="check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                    stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span>Affordable Paid Plans</span>
                        </li>

                        <li class="cta-feature-item">
                            <span class="check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                    stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span>All India Visibility</span>
                        </li>

                        <li class="cta-feature-item">
                            <span class="check-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16A34A"
                                    stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span>Business Growth</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
    <!-- Agent Registration Banner Section End -->

    <!-- Trust Features Bar Section Start -->
    <section class="trust-features-section" id="trustFeatures">
        <div class="section-container">
            <div class="trust-features-card">

                <!-- Feature 1: Trusted Platform -->
                <div class="trust-feature-col">
                    <div class="trust-icon-box icon-blue-shield">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" />
                            <polygon
                                points="12 6 13.8 9.6 17.7 10.2 14.9 12.9 15.6 16.8 12 14.9 8.4 16.8 9.1 12.9 6.3 10.2 10.2 9.6"
                                fill="#FFB000" />
                        </svg>
                    </div>
                    <div class="trust-text-group">
                        <h4 class="trust-title">Trusted Platform</h4>
                        <p class="trust-subtitle">Bharat ka bharosemand Agent Directory</p>
                    </div>
                </div>

                <div class="trust-divider"></div>

                <!-- Feature 2: Safe & Secure -->
                <div class="trust-feature-col">
                    <div class="trust-icon-box icon-blue-lock">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                            <path
                                d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
                        </svg>
                    </div>
                    <div class="trust-text-group">
                        <h4 class="trust-title">Safe & Secure</h4>
                        <p class="trust-subtitle">Aapki jankari hai 100% secure</p>
                    </div>
                </div>

                <div class="trust-divider"></div>

                <!-- Feature 3: All India Network -->
                <div class="trust-feature-col">
                    <div class="trust-icon-box icon-blue-pin">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                    </div>
                    <div class="trust-text-group">
                        <h4 class="trust-title">All India Network</h4>
                        <p class="trust-subtitle">Har shahar, har jila humare saath</p>
                    </div>
                </div>

                <div class="trust-divider"></div>

                <!-- Feature 4: Affordable Plans -->
                <div class="trust-feature-col">
                    <div class="trust-icon-box icon-blue-tag">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                            <path
                                d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z" />
                        </svg>
                    </div>
                    <div class="trust-text-group">
                        <h4 class="trust-title">Affordable Plans</h4>
                        <p class="trust-subtitle">Har Agent ke liye best plans</p>
                    </div>
                </div>

                <div class="trust-divider"></div>

                <!-- Feature 5: Grow Your Business -->
                <div class="trust-feature-col">
                    <div class="trust-icon-box icon-gold-trophy">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#FFB000" stroke="none">
                            <path
                                d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V18H8v2h8v-2h-3v-2.1c2.14-.46 3.78-2.14 4.39-4.34C19.08 11.37 21 9.29 21 6.74V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" />
                        </svg>
                    </div>
                    <div class="trust-text-group">
                        <h4 class="trust-title">Grow Your Business</h4>
                        <p class="trust-subtitle">Zyada visibility, zyada customers</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Trust Features Bar Section End -->

    <!-- Dark Blue Stats Metrics Bar Section Start -->
    <section class="dark-stats-section" id="darkStats">
        <div class="section-container">
            <div class="dark-stats-card">

                <!-- Stat 1: 10,000+ Verified Agents -->
                <div class="dark-stat-col">
                    <div class="dark-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
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
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
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
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                            <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
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
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
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
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path
                                d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z">
                            </path>
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
    <!-- Dark Blue Stats Metrics Bar Section End -->

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        if ($.fn.select2) {
            $('#agentTypeSelect').select2({
                placeholder: "सभी Agent Services",
                allowClear: true,
                width: '100%'
            });

            $('#cityInput').select2({
                placeholder: "Select District / City",
                allowClear: true,
                width: '100%'
            });

            $('#categorySelect').select2({
                placeholder: "All Categories",
                allowClear: true,
                width: '100%'
            });
        }

        // Search Form Submission Redirection
        $('#agentSearchForm').on('submit', function (e) {
            e.preventDefault();

            var subcategory = $('#agentTypeSelect').val();
            var district = $('#cityInput').val();
            var category = $('#categorySelect').val();

            var searchBtn = $('#searchAgentBtn');
            var originalBtnHtml = searchBtn.html();

            searchBtn.html(`
                <svg class="spin-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="2" x2="12" y2="6"></line>
                    <line x1="12" y1="18" x2="12" y2="22"></line>
                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                    <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                    <line x1="2" y1="12" x2="6" y2="12"></line>
                    <line x1="18" y1="12" x2="22" y2="12"></line>
                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                    <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                </svg>
                <span>Khoj Rahe Hain...</span>
            `);

            setTimeout(function () {
                var redirectUrl = "{{ route('front.vendorlist') }}";

                if (district && category) {
                    var template = "{{ route('front.vendorlist.location.category', ['location' => 'LOC_ID', 'category' => 'CAT_ID']) }}";
                    redirectUrl = template.replace('LOC_ID', encodeURIComponent(district)).replace('CAT_ID', encodeURIComponent(category));
                } else if (district && subcategory) {
                    var template = "{{ route('front.vendorlist.location.subcategory', ['location' => 'LOC_ID', 'subcategory' => 'SUBCAT_ID']) }}";
                    redirectUrl = template.replace('LOC_ID', encodeURIComponent(district)).replace('SUBCAT_ID', encodeURIComponent(subcategory));
                } else if (district) {
                    var template = "{{ route('front.vendorlist.location', ['location' => 'LOC_ID']) }}";
                    redirectUrl = template.replace('LOC_ID', encodeURIComponent(district));
                } else if (category) {
                    var template = "{{ route('front.vendorlist.category', ['category' => 'CAT_ID']) }}";
                    redirectUrl = template.replace('CAT_ID', encodeURIComponent(category));
                }

                window.location.href = redirectUrl;
            }, 400);
        });

        // Top Verified Agents Carousel Controls
        const agentsSliderTrack = document.getElementById('agentsSliderTrack');
        const agentPrevBtn = document.getElementById('agentPrevBtn');
        const agentNextBtn = document.getElementById('agentNextBtn');

        if (agentsSliderTrack && agentPrevBtn && agentNextBtn) {
            agentPrevBtn.addEventListener('click', function () {
                const cardWidth = agentsSliderTrack.querySelector('.agent-card')?.offsetWidth || 230;
                agentsSliderTrack.scrollBy({
                    left: -(cardWidth * 2),
                    behavior: 'smooth'
                });
            });

            agentNextBtn.addEventListener('click', function () {
                const cardWidth = agentsSliderTrack.querySelector('.agent-card')?.offsetWidth || 230;
                agentsSliderTrack.scrollBy({
                    left: cardWidth * 2,
                    behavior: 'smooth'
                });
            });
        }

        // Rajasthan Districts Carousel Controls
        const districtSliderTrack = document.getElementById('districtSliderTrack');
        const districtPrevBtn = document.getElementById('districtPrevBtn');
        const districtNextBtn = document.getElementById('districtNextBtn');

        if (districtSliderTrack && districtPrevBtn && districtNextBtn) {
            districtPrevBtn.addEventListener('click', function () {
                const cardWidth = districtSliderTrack.querySelector('.district-card')?.offsetWidth || 210;
                districtSliderTrack.scrollBy({
                    left: -(cardWidth * 2),
                    behavior: 'smooth'
                });
            });

            districtNextBtn.addEventListener('click', function () {
                const cardWidth = districtSliderTrack.querySelector('.district-card')?.offsetWidth || 210;
                districtSliderTrack.scrollBy({
                    left: cardWidth * 2,
                    behavior: 'smooth'
                });
            });
        }

        // Testimonials Carousel Controls
        const testimonialSliderTrack = document.getElementById('testimonialSliderTrack');
        const testimonialPrevBtn = document.getElementById('testimonialPrevBtn');
        const testimonialNextBtn = document.getElementById('testimonialNextBtn');

        if (testimonialSliderTrack && testimonialPrevBtn && testimonialNextBtn) {
            testimonialPrevBtn.addEventListener('click', function () {
                const cardWidth = testimonialSliderTrack.querySelector('.testimonial-card')?.offsetWidth || 320;
                testimonialSliderTrack.scrollBy({
                    left: -cardWidth,
                    behavior: 'smooth'
                });
            });

            testimonialNextBtn.addEventListener('click', function () {
                const cardWidth = testimonialSliderTrack.querySelector('.testimonial-card')?.offsetWidth || 320;
                testimonialSliderTrack.scrollBy({
                    left: cardWidth,
                    behavior: 'smooth'
                });
            });
        }
    });
</script>
@endpush

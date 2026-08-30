@extends('front.layout.main')
@section('title', $pageTitle ?? 'Terms & Conditions')

@section('content')
    <main class="terms-page-main" id="termsMainContent">
        <section class="terms-hero-banner-section">
            <div class="terms-hero-banner-container">
                <img src="{{ asset('public/front/assets/images/terms_hero_banner.png') }}" alt="Terms & Conditions - Agent 24 India" class="terms-hero-banner-img">
            </div>
        </section>

        <section class="terms-content-section">
            <div class="section-container" style="max-width: 1040px; margin: 0 auto; padding: 25px 24px 50px 24px;">
                <div class="terms-card">
                    <div class="terms-block">
                        <h2 class="terms-heading" style="text-align: center; margin-bottom: 20px;">About Agent 24 India</h2>
                        <div class="terms-text" style="line-height: 1.8; color: #334155;">
                            <p>
                                <strong>Agent 24 India</strong> is a digital platform designed to connect agents with customers in a simple, transparent, and effective way. Our goal is to give agents a professional online presence where they can showcase their profiles, promote their services, and grow their business.
                            </p>
                            <br>
                            <p>
                                We understand that visibility is key in today’s digital world. That’s why Agent 24 India provides easy-to-use tools for profile creation, banner advertisements, and service promotion — all in one place. Whether you are an individual agent or part of a growing agency, Agent 24 India helps you reach more customers, build trust, and expand your opportunities.
                            </p>
                            <br>
                            <h4 style="font-size: 18px; font-weight: 700; color: #004BEE; margin: 16px 0 8px;">Our Mission</h4>
                            <p>To empower agents across India by providing a reliable and user-friendly digital platform for promotion and growth.</p>
                            
                            <h4 style="font-size: 18px; font-weight: 700; color: #004BEE; margin: 16px 0 8px;">Our Vision</h4>
                            <p>To become India’s most trusted online agent listing and advertising platform.</p>
                        </div>
                    </div>

                    <div class="terms-action-bar">
                        <label class="terms-checkbox-label">
                            <input type="checkbox" id="termsCheck" class="terms-checkbox" checked>
                            <span>मैंने नियम और शर्तों को पढ़ा और सहमति देता/देती हूँ।</span>
                        </label>
                        
                        <a href="{{ route('front.index') }}" class="btn-terms-agree">मैं सहमत हूँ</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
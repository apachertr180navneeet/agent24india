@extends('front.layout.main')
@section('title', $pageTitle ?? 'Notice')

@section('content')
    <main class="terms-page-main" id="noticeMainContent">
        <section class="terms-hero-banner-section">
            <div class="terms-hero-banner-container">
                <img src="{{ asset('public/front/assets/images/terms_hero_banner.png') }}" alt="Notice - Agent 24 India" class="terms-hero-banner-img">
            </div>
        </section>

        <section class="terms-content-section">
            <div class="section-container" style="max-width: 1040px; margin: 0 auto; padding: 25px 24px 50px 24px;">
                <div class="terms-card">
                    <div class="terms-block">
                        <h2 class="terms-heading" style="text-align: center; margin-bottom: 20px;">{!! $about->title ?? 'Notice' !!}</h2>
                        <div class="terms-text" style="line-height: 1.8; color: #334155;">
                            {!! $about->description ?? 'No notice content available.' !!}
                        </div>
                    </div>

                    <div class="terms-action-bar">
                        <a href="{{ route('front.index') }}" class="btn-terms-agree">Back to Home</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
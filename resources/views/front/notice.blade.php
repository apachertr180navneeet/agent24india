@extends('front.layout.main')
@php
    $noticeData = $notice ?? $about ?? $siteNotice ?? null;
    $noticeTitle = $noticeData->title ?? 'Notice';
@endphp
@section('title', $noticeTitle . ' - Agent 24 India')

@section('content')
    <main class="terms-page-main" id="noticeMainContent">
        <section class="terms-hero-banner-section">
            <div class="terms-hero-banner-container">
                <div class="terms-hero-flex">
                    <div class="terms-hero-text">
                        <h1 class="terms-hero-title">{{ $noticeTitle }}</h1>
                        <p class="terms-hero-subtitle">Important announcements, platform updates, and public notices from Agent 24 India.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="terms-content-section">
            <div class="section-container" style="max-width: 1040px; margin: 0 auto; padding: 25px 24px 50px 24px;">
                <div class="terms-card">
                    <div class="terms-block">
                        <h2 class="terms-heading" style="text-align: center; margin-bottom: 24px; font-size: 24px;">{{ $noticeTitle }}</h2>
                        <div class="formatted-cms-body" style="line-height: 1.8; color: #334155;">
                            @if(!empty($noticeData) && !empty($noticeData->description))
                                {!! $noticeData->description !!}
                            @else
                                <p style="text-align: center; color: #64748B;">No notice content is currently available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="terms-action-bar">
                        <a href="{{ route('front.index') }}" class="btn-terms-agree">Back to Home</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .terms-page-main {
            background-color: #F8FAFC;
        }
        .terms-hero-banner-section {
            padding: 24px 0;
            width: 100%;
            background: linear-gradient(180deg, #F0F6FF 0%, #E8F0FE 100%);
            border-bottom: 1px solid #E2E8F0;
        }
        .terms-hero-banner-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }
        .terms-hero-title {
            font-size: 36px;
            font-weight: 800;
            color: #004BEE;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }
        .terms-hero-subtitle {
            font-size: 15px;
            font-weight: 500;
            color: #334155;
            margin: 0;
            line-height: 1.6;
            max-width: 600px;
        }
        .terms-card {
            background-color: #FFFFFF;
            border: 1.5px solid #E2E8F0;
            border-radius: 16px;
            padding: 36px 42px;
            box-shadow: 0 4px 20px rgba(0, 75, 238, 0.04);
        }
        .formatted-cms-body {
            font-size: 15px;
            line-height: 1.8;
            color: #334155;
        }
        .formatted-cms-body h1,
        .formatted-cms-body h2,
        .formatted-cms-body h3,
        .formatted-cms-body h4 {
            color: #004BEE;
            font-weight: 800;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .formatted-cms-body p {
            margin-bottom: 14px;
        }
        .formatted-cms-body ul,
        .formatted-cms-body ol {
            padding-left: 24px;
            margin-bottom: 16px;
        }
        .terms-action-bar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1.5px solid #E2E8F0;
        }
        .btn-terms-agree {
            background-color: #004BEE;
            color: #FFFFFF;
            font-size: 15.5px;
            font-weight: 700;
            padding: 11px 34px;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(0, 75, 238, 0.25);
            transition: all 0.25s ease;
            display: inline-block;
        }
        .btn-terms-agree:hover {
            background-color: #0036A8;
            color: #FFFFFF;
        }
    </style>
@endsection
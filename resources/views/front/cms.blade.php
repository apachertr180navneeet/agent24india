@extends('front.layout.main')
@section('title', ($cms->title ?? 'Page') . ' - Agent 24 India')

@section('content')
    <main class="cms-page-main" id="cmsMainContent">
        <!-- Hero Banner Section -->
        <section class="cms-hero-banner-section">
            <div class="cms-hero-banner-container">
                <div class="cms-hero-flex">
                    <div class="cms-hero-text">
                        <h1 class="cms-hero-title">{{ $cms->title ?? 'Page' }}</h1>
                        <p class="cms-hero-subtitle">Agent 24 India &mdash; Bharat ka sabse trusted aur verified Agent Directory platform.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CMS Content Section -->
        <section class="cms-content-section">
            <div class="section-container" style="max-width: 1040px; margin: 0 auto; padding: 25px 24px 50px 24px;">
                <div class="cms-card">
                    <div class="cms-block">
                        <h2 class="cms-heading" style="text-align: center; margin-bottom: 24px; font-size: 26px; font-weight: 800; color: #004BEE;">{{ $cms->title ?? '' }}</h2>
                        <div class="formatted-cms-body" style="line-height: 1.8; color: #334155;">
                            @if(!empty($cms->description))
                                {!! $cms->description !!}
                            @else
                                <p style="text-align: center; color: #64748B;">Content for this page is being updated. Please check back shortly.</p>
                            @endif
                        </div>
                    </div>

                    <div class="cms-action-bar">
                        <a href="{{ route('front.index') }}" class="btn-cms-back">Back to Home</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .cms-page-main {
            background-color: #F8FAFC;
        }
        .cms-hero-banner-section {
            padding: 28px 0;
            width: 100%;
            background: linear-gradient(180deg, #F0F6FF 0%, #E8F0FE 100%);
            border-bottom: 1px solid #E2E8F0;
        }
        .cms-hero-banner-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }
        .cms-hero-title {
            font-size: 34px;
            font-weight: 800;
            color: #004BEE;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }
        .cms-hero-subtitle {
            font-size: 15px;
            font-weight: 500;
            color: #334155;
            margin: 0;
            line-height: 1.6;
            max-width: 600px;
        }
        .cms-card {
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
        .formatted-cms-body h4,
        .formatted-cms-body h5,
        .formatted-cms-body h6 {
            color: #004BEE;
            font-weight: 800;
            margin-top: 24px;
            margin-bottom: 12px;
            letter-spacing: -0.2px;
        }
        .formatted-cms-body h1 { font-size: 26px; }
        .formatted-cms-body h2 { font-size: 20px; }
        .formatted-cms-body h3 { font-size: 17.5px; }
        .formatted-cms-body h4 { font-size: 16px; }
        .formatted-cms-body p {
            margin-bottom: 14px;
            color: #334155;
            font-weight: 500;
        }
        .formatted-cms-body ul,
        .formatted-cms-body ol {
            padding-left: 24px;
            margin-bottom: 18px;
        }
        .formatted-cms-body li {
            margin-bottom: 8px;
            color: #334155;
            font-weight: 500;
            line-height: 1.7;
        }
        .formatted-cms-body blockquote {
            border-left: 4px solid #004BEE;
            background: #F0F6FF;
            padding: 14px 20px;
            border-radius: 0 8px 8px 0;
            margin: 18px 0;
            font-style: italic;
            color: #1E293B;
        }
        .formatted-cms-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .formatted-cms-body table th,
        .formatted-cms-body table td {
            border: 1px solid #E2E8F0;
            padding: 10px 14px;
            font-size: 14px;
        }
        .formatted-cms-body table th {
            background-color: #F1F5F9;
            font-weight: 700;
            color: #0F172A;
        }
        .formatted-cms-body a {
            color: #004BEE;
            font-weight: 700;
            text-decoration: underline;
        }
        .cms-action-bar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1.5px solid #E2E8F0;
        }
        .btn-cms-back {
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
        .btn-cms-back:hover {
            background-color: #0036A8;
            color: #FFFFFF;
        }
    </style>
@endsection

@extends('front.layout.main')
@section('title', $pageTitle ?? 'Sahi Agent, Sahi Connection')

@push('styles')
<style>
    /* Ensure clean separation of mobile and desktop views */
    @media (min-width: 769px) {
        .mobile-only {
            display: none !important;
        }
        .desktop-only {
            display: block;
        }
    }
    @media (max-width: 768px) {
        .desktop-only {
            display: none !important;
        }
        .mobile-only {
            display: block;
        }
    }

    .form-field.has-error .input-with-icon,
    .form-field.has-error .select2-container--default .select2-selection--single,
    .m-field-group.has-error .m-input-wrap {
        border-color: #EF4444 !important;
        box-shadow: 0 0 0 3.5px rgba(239, 68, 68, 0.22) !important;
        animation: searchFieldShake 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
    }
    @keyframes searchFieldShake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-4px); }
        40%, 80% { transform: translateX(4px); }
    }
    .search-validation-msg {
        display: none;
        align-items: center;
        gap: 8px;
        background: #FEF2F2;
        border: 1.5px solid #F87171;
        color: #B91C1C;
        padding: 9px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 14px;
        animation: searchFadeInDown 0.25s ease;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.1);
    }
    .search-validation-msg.active {
        display: flex;
    }
    .search-validation-msg svg {
        flex-shrink: 0;
    }
    @keyframes searchFadeInDown {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Desktop Search Card & Select2 Tuning */
    .search-card-container {
        border-radius: 16px !important;
        overflow: hidden !important;
        box-shadow: 0 10px 32px rgba(15, 23, 42, 0.08) !important;
        background: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
    }
    .search-card-header {
        background: #004BEE !important;
        color: #FFFFFF !important;
        padding: 14px 22px !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }
    .search-card-form {
        padding: 20px 22px 22px !important;
        background: #FFFFFF !important;
    }
    .form-grid {
        display: grid !important;
        grid-template-columns: 1fr 1fr 1.15fr auto !important;
        gap: 14px !important;
        align-items: flex-end !important;
    }
    .form-field {
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
        min-width: 0 !important;
    }
    .form-field.btn-field {
        justify-content: flex-end !important;
    }
    .field-label {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #1E293B !important;
        margin-bottom: 0 !important;
    }
    .input-with-icon {
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
        height: 48px !important;
        min-height: 48px !important;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .input-with-icon .field-icon {
        position: absolute !important;
        left: 14px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 18px !important;
        height: 18px !important;
        min-width: 18px !important;
        min-height: 18px !important;
        display: block !important;
        pointer-events: none !important;
        z-index: 10 !important;
    }
    .input-with-icon .select2-container {
        width: 100% !important;
        height: 48px !important;
    }
    .input-with-icon .select2-container--default .select2-selection--single {
        height: 48px !important;
        min-height: 48px !important;
        border: 1.5px solid #CBD5E1 !important;
        border-radius: 10px !important;
        background-color: #FFFFFF !important;
        padding-left: 42px !important;
        padding-right: 32px !important;
        display: flex !important;
        align-items: center !important;
        position: relative !important;
        transition: border-color 0.2s, box-shadow 0.2s !important;
    }
    .input-with-icon .select2-container--default.select2-container--open .select2-selection--single,
    .input-with-icon .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #004BEE !important;
        box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.12) !important;
        outline: none !important;
    }
    .input-with-icon .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 0 !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #0F172A !important;
        line-height: 45px !important;
        height: 45px !important;
        display: flex !important;
        align-items: center !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        width: 100% !important;
    }
    .input-with-icon .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #94A3B8 !important;
        font-weight: 500 !important;
        line-height: 45px !important;
    }
    .input-with-icon .select2-container--default .select2-selection--single .select2-selection__arrow {
        position: absolute !important;
        top: 50% !important;
        right: 12px !important;
        transform: translateY(-50%) !important;
        height: 20px !important;
        width: 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .input-with-icon .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #64748B transparent transparent transparent !important;
        border-width: 5px 4.5px 0 4.5px !important;
        position: static !important;
        margin: 0 !important;
    }
    .input-with-icon .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #004BEE transparent !important;
        border-width: 0 4.5px 5px 4.5px !important;
    }
    .input-with-icon .select2-container--default .select2-selection--single .select2-selection__clear {
        display: none !important;
    }
    .btn-search-agent {
        height: 48px !important;
        min-height: 48px !important;
        padding: 0 24px !important;
        background: linear-gradient(180deg, #FBBF24 0%, #F59E0B 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        color: #0F172A !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        cursor: pointer !important;
        box-shadow: 0 4px 14px rgba(245, 158, 11, 0.35) !important;
        transition: all 0.2s ease !important;
        white-space: nowrap !important;
    }
    .btn-search-agent:hover {
        background: linear-gradient(180deg, #FCD34D 0%, #D97706 100%) !important;
        transform: translateY(-1.5px) !important;
        box-shadow: 0 6px 18px rgba(245, 158, 11, 0.45) !important;
    }
    .btn-search-agent:active {
        transform: translateY(0) !important;
    }

    /* Mobile How It Works Styles matching Screenshot */
    .m-how-it-works-section {
        padding: 24px 16px 14px 16px;
    }
    .m-how-header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        margin-bottom: 18px;
    }
    .m-how-title {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        margin: 0;
        text-align: center;
        white-space: nowrap;
    }
    .m-how-header .m-line {
        height: 1.5px;
        background: #CBD5E1;
        flex: 1;
        max-width: 55px;
    }
    .m-steps-flow {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 2px;
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 22px 8px 18px 8px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
    }
    .m-step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex: 1;
        min-width: 0;
    }
    .m-step-badge {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
    }
    .m-step-badge.step-1 { background-color: #2563EB; }
    .m-step-badge.step-2 { background-color: #F97316; }
    .m-step-badge.step-3 { background-color: #16A34A; }
    .m-step-badge.step-4 { background-color: #9333EA; }

    .m-step-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
    }
    .bg-blue-light   { background-color: #EEF5FF; }
    .bg-orange-light { background-color: #FFF4EB; }
    .bg-green-light  { background-color: #EAF8EE; }
    .bg-purple-light { background-color: #F7EEFF; }

    .m-step-text {
        font-size: 11px;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.25;
        text-align: center;
    }
    .m-step-arrow {
        color: #94A3B8;
        font-size: 12px;
        margin-top: 38px;
        font-weight: 700;
        flex-shrink: 0;
        padding: 0 1px;
    }

    /* Mobile Top Verified Agents Slider Styles */
    .m-top-agents-section {
        padding: 16px 16px 20px 16px;
    }
    .m-top-agents-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .m-top-agents-title {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        margin: 0;
    }
    .m-top-agents-link {
        font-size: 14.5px;
        font-weight: 700;
        color: #2563EB;
        text-decoration: none;
    }
    .m-agent-carousel-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        width: 100%;
    }
    .m-carousel-arrow {
        background-color: #FFFFFF;
        border: 1px solid #CBD5E1;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        transition: all 0.2s ease;
        padding: 0;
        z-index: 5;
    }
    .m-carousel-arrow:active {
        transform: scale(0.92);
        background-color: #F1F5F9;
    }
    .m-agent-slider-track {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        gap: 12px;
        flex: 1;
        min-width: 0;
        -ms-overflow-style: none;
        scrollbar-width: none;
        padding: 4px 2px;
    }
    .m-agent-slider-track::-webkit-scrollbar {
        display: none;
    }
    .m-agent-slide-card {
        flex: 0 0 100%;
        min-width: 100%;
        max-width: 100%;
        scroll-snap-align: center;
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 16px 14px 14px 14px;
        position: relative;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        box-sizing: border-box;
        overflow: hidden;
    }
    .m-verified-pill {
        position: absolute;
        top: 0;
        left: 0;
        background-color: #16A34A;
        color: #FFFFFF;
        font-size: 8.5px;
        font-weight: 800;
        padding: 4px 10px;
        border-top-left-radius: 18px;
        border-bottom-right-radius: 8px;
        line-height: 1.2;
        letter-spacing: 0.4px;
        z-index: 2;
    }
    .m-agent-card-body {
        display: flex;
        gap: 14px;
        align-items: center;
        margin-top: 8px;
    }
    .m-agent-avatar-wrap {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        border: 2px solid #F1F5F9;
        box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    }
    .m-agent-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .m-agent-info-wrap {
        flex: 1;
        min-width: 0;
    }
    .m-agent-card-name {
        font-size: 16px;
        font-weight: 800;
        color: #0F172A;
        margin: 0 0 2px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.25;
    }
    .m-agent-card-type {
        display: block;
        font-size: 12.5px;
        font-weight: 500;
        color: #64748B;
        margin-bottom: 2px;
        line-height: 1.2;
    }
    .m-agent-card-loc {
        display: block;
        font-size: 12.5px;
        font-weight: 500;
        color: #64748B;
        margin-bottom: 4px;
        line-height: 1.2;
    }
    .m-agent-card-stars {
        display: flex;
        align-items: center;
        gap: 2px;
        font-size: 12.5px;
    }
    .stars-gold {
        color: #F59E0B;
        letter-spacing: 1px;
    }
    .m-star-score {
        font-weight: 800;
        font-size: 13px;
        color: #0F172A;
        margin-left: 3px;
    }
    .m-star-count {
        color: #64748B;
        font-size: 12px;
        margin-left: 2px;
    }
    .m-agent-card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid #F1F5F9;
    }
    .m-btn-view-profile {
        border: 1.5px solid #CBD5E1;
        background-color: #FFFFFF;
        color: #0F172A;
        font-size: 13.5px;
        font-weight: 700;
        border-radius: 8px;
        padding: 9px 0;
        text-align: center;
        text-decoration: none;
        display: block;
    }
    .m-btn-call-now {
        background-color: #2563EB;
        color: #FFFFFF;
        font-size: 13.5px;
        font-weight: 700;
        border-radius: 8px;
        padding: 9px 0;
        text-align: center;
        text-decoration: none;
        display: block;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.2);
    }

    /* Mobile District Cards Grid Section matching screenshot */
    .m-district-section {
        padding: 20px 16px 24px 16px;
    }
    .m-district-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .m-district-title {
        font-size: 18.5px;
        font-weight: 800;
        color: #0F172A;
        margin: 0;
        line-height: 1.25;
    }
    .m-district-link {
        font-size: 14px;
        font-weight: 700;
        color: #2563EB;
        text-decoration: none;
        white-space: nowrap;
    }
    .m-district-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px 12px;
    }
    .m-district-card {
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .m-district-card:active {
        transform: scale(0.97);
    }
    .m-district-img {
        width: 100%;
        height: 110px;
        object-fit: cover;
        display: block;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .m-district-info {
        padding: 10px 12px 14px 12px;
        display: flex;
        flex-direction: column;
    }
    .m-district-name {
        font-size: 15.5px;
        font-weight: 800;
        color: #0F172A;
        margin: 0 0 4px 0;
        line-height: 1.2;
    }
    .m-district-agents {
        font-size: 13px;
        font-weight: 700;
        color: #2563EB;
        line-height: 1.2;
    }
    .m-district-btn-wrap {
        text-align: center;
        margin-top: 20px;
    }
    .m-btn-see-all-districts {
        display: inline-block;
        border: 1.5px solid #DBEAFE;
        background-color: #FFFFFF;
        color: #2563EB;
        font-size: 14px;
        font-weight: 700;
        padding: 9px 24px;
        border-radius: 10px;
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.05);
        transition: all 0.2s ease;
    }
    .m-btn-see-all-districts:active {
        background-color: #EFF6FF;
    }

    /* Mobile Hero Banner Carousel Styles */
    .m-hero-banner-section {
        padding: 14px 16px 8px 16px;
        position: relative;
    }
    .m-hero-carousel-container {
        position: relative;
        width: 100%;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        background: #0B1736;
        user-select: none;
    }
    .m-hero-slider-track {
        display: flex;
        transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        width: 100%;
        height: 100%;
    }
    .m-hero-slide-item {
        min-width: 100%;
        width: 100%;
        height: 100%;
        flex-shrink: 0;
        position: relative;
        display: block;
        text-decoration: none;
    }
    .m-hero-banner-img {
        width: 100%;
        height: 195px;
        min-height: 185px;
        object-fit: cover;
        object-position: center;
        display: block;
    }
    @media (max-width: 420px) {
        .m-hero-banner-img {
            height: 185px;
            min-height: 175px;
        }
    }
    @media (min-width: 421px) and (max-width: 768px) {
        .m-hero-banner-img {
            height: 230px;
            min-height: 210px;
        }
    }
    .m-hero-slider-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        color: #0F172A;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 4;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        transition: all 0.2s ease;
        padding: 0;
    }
    .m-hero-slider-arrow.left { left: 8px; }
    .m-hero-slider-arrow.right { right: 8px; }
    .m-hero-slider-arrow:active {
        transform: translateY(-50%) scale(0.92);
        background: #FFFFFF;
    }
    .m-hero-dots-wrap {
        position: absolute;
        bottom: 8px;
        left: 0;
        right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        z-index: 4;
    }
    .m-hero-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .m-hero-dot.active {
        width: 18px;
        border-radius: 4px;
        background: #FFFFFF;
        box-shadow: 0 1px 4px rgba(0,0,0,0.4);
    }

    /* Desktop Dynamic Hero Carousel Styles */
    .index-hero-banner-section.desktop-only {
        position: relative;
        overflow: hidden;
        background: #0B1736;
        user-select: none;
    }
    .index-hero-banner-container {
        position: relative;
        width: 100%;
        overflow: hidden;
    }
    .d-hero-slider-track {
        display: flex;
        transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
        width: 100%;
    }
    .d-hero-slide-item {
        min-width: 100%;
        width: 100%;
        flex-shrink: 0;
        position: relative;
    }
    .d-hero-banner-link {
        display: block;
        width: 100%;
        text-decoration: none;
    }
    .d-hero-nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        color: #0F172A;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 6;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.22);
        transition: all 0.25s ease;
        opacity: 0.8;
    }
    .index-hero-banner-section:hover .d-hero-nav-arrow {
        opacity: 1;
    }
    .d-hero-nav-arrow.prev { left: 24px; }
    .d-hero-nav-arrow.next { right: 24px; }
    .d-hero-nav-arrow:hover {
        background: #FFFFFF;
        transform: translateY(-50%) scale(1.08);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
    }
    .d-hero-dots-wrap {
        position: absolute;
        bottom: 24px;
        left: 0;
        right: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        z-index: 6;
    }
    .d-hero-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.15);
    }
    .d-hero-dot.active {
        width: 28px;
        border-radius: 6px;
        background: #FFFFFF;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.35);
    }

    /* Category Show-All In-Page Toggle Styles */
    .extra-category-card,
    .m-extra-cat-card {
        display: none !important;
    }
    .categories-grid.show-all .extra-category-card {
        display: flex !important;
        animation: catCardPop 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .categories-grid.show-all .card-more-trigger {
        display: none !important;
    }
    .m-pop-cat-grid.show-all .m-extra-cat-card {
        display: flex !important;
        animation: catCardPop 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .m-pop-cat-grid.show-all .m-card-more-trigger {
        display: none !important;
    }
    @keyframes catCardPop {
        from {
            opacity: 0;
            transform: translateY(14px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    .btn-view-all {
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
    }
    .btn-view-all:hover {
        transform: translateY(-2px);
    }

    /* Desktop & Mobile District Cards Modern Styling */
    .district-card {
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
    }
    .district-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 75, 238, 0.12);
        border-color: #BFDBFE;
    }
    .district-image-wrapper {
        width: 100%;
        height: 125px;
        overflow: hidden;
        position: relative;
        background-color: #F1F5F9;
    }
    .district-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .district-card:hover .district-img {
        transform: scale(1.06);
    }
    .district-info-body {
        padding: 12px 14px 14px 14px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        background-color: #FFFFFF;
        flex: 1;
        justify-content: space-between;
    }
    .district-meta-row {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 2px;
        width: 100%;
    }
    .district-name {
        font-size: 15.5px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.2px;
        margin: 0;
        line-height: 1.25;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 100%;
    }
    .district-agents-count {
        font-size: 12px;
        font-weight: 600;
        color: #2563EB;
        line-height: 1.2;
    }
    .btn-explore-district {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        padding: 7px 0;
        background: linear-gradient(180deg, #EFF6FF 0%, #DBEAFE 100%);
        border: 1px solid #BFDBFE;
        border-radius: 20px;
        color: #004BEE;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.22s ease;
    }
    .btn-explore-district:hover {
        background: #004BEE;
        border-color: #004BEE;
        color: #FFFFFF;
        box-shadow: 0 4px 12px rgba(0, 75, 238, 0.25);
    }
</style>
@endpush

@section('content')

@php
    $getDistrictImg = function($dist, $index = 0) {
        if (!empty($dist->image)) {
            $img = $dist->image;
            if (str_starts_with($img, 'http')) {
                return $img;
            }
            if (file_exists(public_path($img))) {
                return asset($img);
            }
            if (file_exists(public_path('upload/district/' . basename($img)))) {
                return asset('upload/district/' . basename($img));
            }
        }
        
        $name = strtolower(trim($dist->name ?? ''));
        $slug = \Illuminate\Support\Str::slug($name, '_');
        
        // Exact slug check in districts folder
        $possibleFiles = [
            "front/assets/images/districts/{$slug}.jpg",
            "front/assets/images/districts/{$slug}.png",
            "front/assets/images/districts/{$slug}.webp",
            "front/assets/images/districts/{$slug}.jpeg",
        ];
        foreach ($possibleFiles as $file) {
            if (file_exists(public_path($file))) {
                return asset($file);
            }
        }

        // Substring / alias matching for major cities
        if (str_contains($name, 'delhi')) return asset('front/assets/images/districts/new_delhi.jpg');
        if (str_contains($name, 'mumbai') || str_contains($name, 'bombay')) return asset('front/assets/images/districts/mumbai.jpg');
        if (str_contains($name, 'bangalore') || str_contains($name, 'bengaluru')) return asset('front/assets/images/districts/bangalore.jpg');
        if (str_contains($name, 'pune')) return asset('front/assets/images/districts/pune.jpg');
        if (str_contains($name, 'hyderabad')) return asset('front/assets/images/districts/hyderabad.jpg');
        if (str_contains($name, 'ahmedabad')) return asset('front/assets/images/districts/ahmedabad.jpg');
        if (str_contains($name, 'chennai') || str_contains($name, 'madras')) return asset('front/assets/images/districts/chennai.jpg');
        if (str_contains($name, 'surat')) return asset('front/assets/images/districts/surat.jpg');
        if (str_contains($name, 'lucknow')) return asset('front/assets/images/districts/lucknow.jpg');
        if (str_contains($name, 'jaipur')) return asset('front/assets/images/districts/jaipur.jpg');
        if (str_contains($name, 'jodhpur')) return asset('front/assets/images/districts/jodhpur.jpg');
        if (str_contains($name, 'udaipur')) return asset('front/assets/images/districts/udaipur.png');
        if (str_contains($name, 'ajmer')) return asset('front/assets/images/districts/ajmer.jpg');
        if (str_contains($name, 'bikaner')) return asset('front/assets/images/districts/bikaner.jpg');
        if (str_contains($name, 'jaisalmer')) return asset('front/assets/images/districts/jaisalmer.jpg');
        if (str_contains($name, 'shimla')) return asset('front/assets/images/districts/shimla.jpg');
        if (str_contains($name, 'amritsar')) return asset('front/assets/images/districts/amritsar.jpg');
        if (str_contains($name, 'haridwar')) return asset('front/assets/images/districts/haridwar.jpg');
        if (str_contains($name, 'noida')) return asset('front/assets/images/districts/noida.jpg');
        if (str_contains($name, 'patna')) return asset('front/assets/images/districts/patna.jpg');
        if (str_contains($name, 'ranchi')) return asset('front/assets/images/districts/ranchi.jpg');
        if (str_contains($name, 'raipur')) return asset('front/assets/images/districts/raipur.jpg');
        if (str_contains($name, 'indore')) return asset('front/assets/images/districts/indore.jpg');
        if (str_contains($name, 'visakhapatnam') || str_contains($name, 'vizag')) return asset('front/assets/images/districts/visakhapatnam.jpg');

        // Dynamic pool fallback so different districts never look identical
        $dynamicPool = [
            'front/assets/images/districts/jaipur.jpg',
            'front/assets/images/districts/jodhpur.jpg',
            'front/assets/images/districts/udaipur.png',
            'front/assets/images/districts/shimla.jpg',
            'front/assets/images/districts/amritsar.jpg',
            'front/assets/images/districts/haridwar.jpg',
            'front/assets/images/districts/new_delhi.jpg',
            'front/assets/images/districts/mumbai.jpg',
            'front/assets/images/districts/bangalore.jpg',
            'front/assets/images/districts/lucknow.jpg',
            'front/assets/images/districts/hyderabad.jpg',
            'front/assets/images/districts/ajmer.jpg',
            'front/assets/images/districts/bikaner.jpg',
            'front/assets/images/districts/jaisalmer.jpg',
        ];
        $idNum = is_numeric($dist->id ?? null) ? (int)$dist->id : (int)$index;
        return asset($dynamicPool[$idNum % count($dynamicPool)]);
    };
@endphp

<!-- =========================================================================
     MOBILE ONLY HOME PAGE SECTION (Matches agent2 mobile screenshot design)
     ========================================================================= -->
<div class="mobile-home-wrapper mobile-only">
    
    <!-- Mobile Dynamic Hero Banner Slider -->
    <section class="m-hero-banner-section">
        <div class="m-hero-carousel-container" id="mHeroCarousel">
            <div class="m-hero-slider-track" id="mHeroSliderTrack">
                @php
                    $mobileBanners = (isset($banner) && count($banner) > 0) ? $banner : collect();
                @endphp

                @if($mobileBanners->count() > 0)
                    @foreach($mobileBanners as $bIdx => $bItem)
                        @php
                            $bImg = !empty($bItem->image) ? (Str::startsWith($bItem->image, 'http') ? $bItem->image : asset($bItem->image)) : asset('front/assets/images/index_hero_banner.png');
                            $bLink = !empty($bItem->link) ? $bItem->link : (!empty($bItem->url) ? $bItem->url : 'javascript:;');
                        @endphp
                        <a href="{{ $bLink }}" class="m-hero-slide-item" data-slide-index="{{ $bIdx }}">
                            <img src="{{ $bImg }}" alt="{{ $bItem->title ?? 'Agent 24 India' }}" class="m-hero-banner-img" onerror="this.onerror=null;this.src='{{ asset('front/assets/images/index_hero_banner.png') }}';">
                        </a>
                    @endforeach
                @else
                    <div class="m-hero-slide-item" data-slide-index="0">
                        <img src="{{ asset('front/assets/images/index_hero_banner.png') }}" alt="Agent 24 India" class="m-hero-banner-img">
                    </div>
                @endif
            </div>

            @if($mobileBanners->count() > 1)
                <button type="button" class="m-hero-slider-arrow left" id="mHeroPrevBtn" aria-label="Previous Slide">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <button type="button" class="m-hero-slider-arrow right" id="mHeroNextBtn" aria-label="Next Slide">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>

                <div class="m-hero-dots-wrap" id="mHeroDotsWrap">
                    @foreach($mobileBanners as $bIdx => $bItem)
                        <span class="m-hero-dot {{ $bIdx == 0 ? 'active' : '' }}" data-dot-index="{{ $bIdx }}"></span>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Trust Badges Row -->
        <div class="m-trust-row" style="margin-top: 12px;">
            <div class="m-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="#004BEE"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                <span>Verified Agents</span>
            </div>
            <div class="m-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="#004BEE"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                <span>Secure & Safe</span>
            </div>
            <div class="m-trust-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="#16A34A"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                <span>100% Trusted</span>
            </div>
        </div>
    </section>

    <!-- Mobile Search Card -->
    <section class="m-search-card-section">
        <div class="m-search-card">
            <h2 class="m-search-card-title">अपनी जरूरत का Agent खोजें</h2>

            <form action="{{ route('front.vendorlist') }}" method="GET" id="mAgentSearchForm">
                <div class="search-validation-msg" id="mSearchValidationMsg">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>कृपया Search, District या Category में से कम से कम एक चुनें।</span>
                </div>

                <!-- Field 1: District -->
                <div class="m-field-group" id="mSearchDistrictField">
                    <label class="m-field-label">District / जिला</label>
                    <div class="m-input-wrap">
                        <select name="district" id="mDistrictSelect" class="m-select-box">
                            <option value="">Search district</option>
                            @foreach(collect($district ?? [])->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $d)
                                <option value="{{ $d->id }}" {{ request('district') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                            @endforeach
                        </select>
                        <svg class="m-field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    </div>
                </div>

                <!-- Field 2: City -->
                <div class="m-field-group" id="mSearchCityField">
                    <label class="m-field-label">City / शहर</label>
                    <div class="m-input-wrap">
                        <select name="city" id="mCitySelect" class="m-select-box">
                            <option value="">Select city</option>
                            <option value="all">All City</option>
                            @if(isset($initialCities) && count($initialCities) > 0)
                                @foreach($initialCities as $c)
                                    <option value="{{ $c->id }}" {{ request('city') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <svg class="m-field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    </div>
                </div>

                <!-- Field 3: Category -->
                <div class="m-field-group" id="mSearchCategoryField">
                    <label class="m-field-label">Category / कैटेगरी</label>
                    <div class="m-input-wrap">
                        <select name="category" id="mCategorySelect" class="m-select-box">
                            <option value="">Select Category</option>
                            @if(isset($category) && count($category) > 0)
                                @foreach(collect($category ?? [])->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <svg class="m-field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0F172A" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
                    </div>
                </div>

                <!-- Search Agent Button -->
                <button type="submit" class="m-btn-submit-search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <span>Agent खोजें</span>
                </button>
            </form>
        </div>
    </section>

    <!-- Mobile Stats Bar -->
    <section class="m-stats-section">
        <div class="m-stats-grid">
            <div class="m-stat-box">
                <div class="m-stat-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <span class="m-stat-val">10,000+</span>
                <span class="m-stat-lbl">Verified<br>Agents</span>
            </div>
            <div class="m-stat-box">
                <div class="m-stat-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <span class="m-stat-val">2500+</span>
                <span class="m-stat-lbl">Cities<br>Covered</span>
            </div>
            <div class="m-stat-box">
                <div class="m-stat-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </div>
                <span class="m-stat-val">50+</span>
                <span class="m-stat-lbl">Categories</span>
            </div>
            <div class="m-stat-box">
                <div class="m-stat-icon-wrap">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                </div>
                <span class="m-stat-val">1L+</span>
                <span class="m-stat-lbl">Happy<br>Customers</span>
            </div>
        </div>
    </section>

    <!-- Mobile Popular Categories Section -->
    <section class="m-popular-cat-section">
        <div class="m-pop-cat-header">
            <h2 class="m-pop-cat-title">लोकप्रिय कैटेगरी</h2>
            @if(isset($category) && $category->count() > 7)
                <a href="javascript:void(0);" class="m-pop-cat-link" id="mToggleCategoriesLink">सभी देखें &rarr;</a>
            @else
                <a href="{{ route('front.vendorlist') }}" class="m-pop-cat-link">सभी देखें &rarr;</a>
            @endif
        </div>
        <div class="m-pop-cat-grid" id="mPopCatGrid">
            @if(isset($category) && $category->count() > 0)
                @php
                    $mCatColors = ['bg-orange', 'bg-blue', 'bg-green', 'bg-purple', 'bg-rupee', 'bg-scale', 'bg-truck'];
                @endphp
                @foreach($category->take(7) as $index => $cat)
                    <a href="{{ route('front.vendorlist') }}?category={{ $cat->id }}" class="m-cat-card">
                        <div class="m-cat-icon-container {{ $mCatColors[$index % count($mCatColors)] }}">
                            @if(!empty($cat->image) && !str_contains($cat->image, 'images.png'))
                                <img src="{{ $cat->image }}" alt="{{ $cat->name }}" style="width: 26px; height: 26px; object-fit: contain; border-radius: 4px;">
                            @else
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            @endif
                        </div>
                        <span class="m-cat-label">{{ $cat->name }}</span>
                    </a>
                @endforeach

                @if($category->count() > 7)
                    {{-- 8th Card: Trigger for all remaining categories --}}
                    <a href="javascript:void(0);" class="m-cat-card m-card-more-trigger" id="mCardMoreTrigger">
                        <div class="m-cat-icon-container bg-dots">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><circle cx="19" cy="12" r="2"></circle><circle cx="5" cy="12" r="2"></circle></svg>
                        </div>
                        <span class="m-cat-label">और भी<br>बहुत कुछ</span>
                    </a>

                    {{-- All remaining extra categories --}}
                    @foreach($category->slice(7) as $index => $cat)
                        <a href="{{ route('front.vendorlist') }}?category={{ $cat->id }}" class="m-cat-card m-extra-cat-card">
                            <div class="m-cat-icon-container {{ $mCatColors[($index + 7) % count($mCatColors)] }}">
                                @if(!empty($cat->image) && !str_contains($cat->image, 'images.png'))
                                    <img src="{{ $cat->image }}" alt="{{ $cat->name }}" style="width: 26px; height: 26px; object-fit: contain; border-radius: 4px;">
                                @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                @endif
                            </div>
                            <span class="m-cat-label">{{ $cat->name }}</span>
                        </a>
                    @endforeach
                @else
                    <a href="{{ route('front.vendorlist') }}" class="m-cat-card">
                        <div class="m-cat-icon-container bg-dots">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><circle cx="19" cy="12" r="2"></circle><circle cx="5" cy="12" r="2"></circle></svg>
                        </div>
                        <span class="m-cat-label">और भी<br>बहुत कुछ</span>
                    </a>
                @endif
            @else
                <!-- Card 1 -->
                <a href="{{ route('front.vendorlist') }}?search=Real+Estate" class="m-cat-card">
                    <div class="m-cat-icon-container bg-orange">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    </div>
                    <span class="m-cat-label">Real Estate<br>Agent</span>
                </a>
                <!-- Card 2 -->
                <a href="{{ route('front.vendorlist') }}?search=Automobile" class="m-cat-card">
                    <div class="m-cat-icon-container bg-blue">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle></svg>
                    </div>
                    <span class="m-cat-label">Automobile<br>Agent</span>
                </a>
                <!-- Card 3 -->
                <a href="{{ route('front.vendorlist') }}?search=RTO" class="m-cat-card">
                    <div class="m-cat-icon-container bg-green">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    </div>
                    <span class="m-cat-label">RTO<br>Agent</span>
                </a>
                <!-- Card 4 -->
                <a href="{{ route('front.vendorlist') }}?search=Insurance" class="m-cat-card">
                    <div class="m-cat-icon-container bg-purple">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9333EA" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
                    </div>
                    <span class="m-cat-label">Insurance<br>Agent</span>
                </a>
                <!-- Card 5 -->
                <a href="{{ route('front.vendorlist') }}?search=Finance" class="m-cat-card">
                    <div class="m-cat-icon-container bg-rupee">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#EA580C" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M8 9h8M8 15h6"></path></svg>
                    </div>
                    <span class="m-cat-label">Finance<br>Agent</span>
                </a>
                <!-- Card 6 -->
                <a href="{{ route('front.vendorlist') }}?search=Legal" class="m-cat-card">
                    <div class="m-cat-icon-container bg-scale">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2"><path d="M12 3v18M3 7l9-4 9 4M5 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7M15 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7"></path></svg>
                    </div>
                    <span class="m-cat-label">Legal<br>Agent</span>
                </a>
                <!-- Card 7 -->
                <a href="{{ route('front.vendorlist') }}?search=Transport" class="m-cat-card">
                    <div class="m-cat-icon-container bg-truck">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                    <span class="m-cat-label">Transport<br>Agent</span>
                </a>
                <!-- Card 8 -->
                <a href="{{ route('front.vendorlist') }}" class="m-cat-card">
                    <div class="m-cat-icon-container bg-dots">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><circle cx="19" cy="12" r="2"></circle><circle cx="5" cy="12" r="2"></circle></svg>
                    </div>
                    <span class="m-cat-label">और भी<br>बहुत कुछ</span>
                </a>
            @endif
        </div>
    </section>

    <!-- Mobile Why Choose Agent 24 Section -->
    <section class="m-why-choose-section">
        <div class="m-why-choose-card">
            <div class="m-why-header">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                <h3 class="m-why-title">Agent 24 India क्यों चुनें?</h3>
            </div>
            
            <div class="m-why-list">
                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">100% Verified & Trusted Agents</h4>
                        <p class="m-why-item-desc">हर Agent की जांच के बाद ही Listing</p>
                    </div>
                </div>

                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">Direct Contact With Agent</h4>
                        <p class="m-why-item-desc">बीच में कोई Third Party नहीं</p>
                    </div>
                </div>

                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">Sahi Jankari, Sahi Faisla</h4>
                        <p class="m-why-item-desc">पूरी जानकारी के साथ सही Agent चुनें</p>
                    </div>
                </div>

                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M8 9h8M8 15h6"></path></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">Save Time & Money</h4>
                        <p class="m-why-item-desc">सही Agent से समय और पैसे की बचत</p>
                    </div>
                </div>

                <div class="m-why-item">
                    <div class="m-why-icon-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2.2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path></svg>
                    </div>
                    <div class="m-why-content">
                        <h4 class="m-why-item-title">Call Support Available</h4>
                        <p class="m-why-item-desc">हमेशा आपकी मदद के लिए तैयार</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile How It Works 4-Step Flow -->
    <section class="m-how-it-works-section">
        <div class="m-how-header">
            <span class="m-line"></span>
            <h2 class="m-how-title">Agent कैसे खोजें?</h2>
            <span class="m-line"></span>
        </div>

        <div class="m-steps-flow">
            <div class="m-step-item">
                <span class="m-step-badge step-1">1</span>
                <div class="m-step-icon-box bg-blue-light">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <span class="m-step-text">अपनी<br>जरूरत बताएं</span>
            </div>

            <span class="m-step-arrow">&rarr;</span>

            <div class="m-step-item">
                <span class="m-step-badge step-2">2</span>
                <div class="m-step-icon-box bg-orange-light">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"></rect><line x1="8" y1="8" x2="16" y2="8"></line><line x1="8" y1="12" x2="16" y2="12"></line><line x1="8" y1="16" x2="12" y2="16"></line></svg>
                </div>
                <span class="m-step-text">Best<br>Agents देखें</span>
            </div>

            <span class="m-step-arrow">&rarr;</span>

            <div class="m-step-item">
                <span class="m-step-badge step-3">3</span>
                <div class="m-step-icon-box bg-green-light">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </div>
                <span class="m-step-text">सीधा संपर्क<br>करें</span>
            </div>

            <span class="m-step-arrow">&rarr;</span>

            <div class="m-step-item">
                <span class="m-step-badge step-4">4</span>
                <div class="m-step-icon-box bg-purple-light">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#9333EA" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                </div>
                <span class="m-step-text">काम शुरू करें</span>
            </div>
        </div>
    </section>

    <!-- Mobile Top Verified Agents Carousel Section -->
    <section class="m-top-agents-section">
        <div class="m-top-agents-header">
            <h2 class="m-top-agents-title">Top Verified Agents</h2>
            <a href="{{ route('front.vendorlist') }}" class="m-top-agents-link">सभी देखें &rarr;</a>
        </div>

        <div class="m-agent-carousel-wrapper">
            <button type="button" class="m-carousel-arrow left" id="mAgentPrevBtn" aria-label="Previous Agent">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            
            <div class="m-agent-slider-track" id="mAgentSliderTrack">
                @if(isset($vendoruser) && count($vendoruser) > 0)
                    @foreach($vendoruser as $vendor)
                        <div class="m-agent-slide-card">
                            <span class="m-verified-pill">VERIFIED</span>
                            <div class="m-agent-card-body">
                                <div class="m-agent-avatar-wrap">
                                    <img src="{{ $vendor->profile_photo_url }}" alt="{{ $vendor->business_name ?: $vendor->name }}" class="m-agent-avatar-img" onerror="this.onerror=null;this.src='{{ asset('front/assets/images/agent_sharma.jpg') }}';">
                                </div>
                                <div class="m-agent-info-wrap">
                                    <h3 class="m-agent-card-name">{{ $vendor->business_name ?: $vendor->name }}</h3>
                                    <span class="m-agent-card-type">{{ $vendor->businessCategory->name ?? ($vendor->category->name ?? 'Real Estate Agent') }}</span>
                                    <span class="m-agent-card-loc">{{ $vendor->district->name ?? 'Jaipur' }}, Rajasthan</span>
                                    <div class="m-agent-card-stars">
                                        <span class="stars-gold">★★★★☆</span> <span class="m-star-score">4.8</span> <span class="m-star-count">(120)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="m-agent-card-actions">
                                <a href="{{ route('front.vendor.details', ['vendor' => $vendor->id]) }}" class="m-btn-view-profile">View Profile</a>
                                <a href="tel:{{ $vendor->mobile ?? ($vendor->phone ?? '+919876543210') }}" class="m-btn-call-now">Call Now</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="m-agent-slide-card">
                        <span class="m-verified-pill">VERIFIED</span>
                        <div class="m-agent-card-body">
                            <div class="m-agent-avatar-wrap">
                                <img src="{{ asset('front/assets/images/agent_sharma.jpg') }}" alt="Sharma Property Consultant" class="m-agent-avatar-img">
                            </div>
                            <div class="m-agent-info-wrap">
                                <h3 class="m-agent-card-name">Sharma Property Consultant</h3>
                                <span class="m-agent-card-type">Real Estate Agent</span>
                                <span class="m-agent-card-loc">Jaipur, Rajasthan</span>
                                <div class="m-agent-card-stars">
                                    <span class="stars-gold">★★★★☆</span> <span class="m-star-score">4.8</span> <span class="m-star-count">(120)</span>
                                </div>
                            </div>
                        </div>

                        <div class="m-agent-card-actions">
                            <a href="{{ route('front.vendorlist') }}" class="m-btn-view-profile">View Profile</a>
                            <a href="tel:+919876543210" class="m-btn-call-now">Call Now</a>
                        </div>
                    </div>

                    <div class="m-agent-slide-card">
                        <span class="m-verified-pill">VERIFIED</span>
                        <div class="m-agent-card-body">
                            <div class="m-agent-avatar-wrap">
                                <img src="{{ asset('front/assets/images/agent_krishna.jpg') }}" alt="Krishna Motors" class="m-agent-avatar-img">
                            </div>
                            <div class="m-agent-info-wrap">
                                <h3 class="m-agent-card-name">Krishna Motors</h3>
                                <span class="m-agent-card-type">Automobile Agent</span>
                                <span class="m-agent-card-loc">Jodhpur, Rajasthan</span>
                                <div class="m-agent-card-stars">
                                    <span class="stars-gold">★★★★☆</span> <span class="m-star-score">4.7</span> <span class="m-star-count">(98)</span>
                                </div>
                            </div>
                        </div>

                        <div class="m-agent-card-actions">
                            <a href="{{ route('front.vendorlist') }}" class="m-btn-view-profile">View Profile</a>
                            <a href="tel:+919876543211" class="m-btn-call-now">Call Now</a>
                        </div>
                    </div>

                    <div class="m-agent-slide-card">
                        <span class="m-verified-pill">VERIFIED</span>
                        <div class="m-agent-card-body">
                            <div class="m-agent-avatar-wrap">
                                <img src="{{ asset('front/assets/images/agent_rto.jpg') }}" alt="RTO Solution Point" class="m-agent-avatar-img">
                            </div>
                            <div class="m-agent-info-wrap">
                                <h3 class="m-agent-card-name">RTO Solution Point</h3>
                                <span class="m-agent-card-type">RTO Agent</span>
                                <span class="m-agent-card-loc">Ajmer, Rajasthan</span>
                                <div class="m-agent-card-stars">
                                    <span class="stars-gold">★★★★☆</span> <span class="m-star-score">4.9</span> <span class="m-star-count">(155)</span>
                                </div>
                            </div>
                        </div>

                        <div class="m-agent-card-actions">
                            <a href="{{ route('front.vendorlist') }}" class="m-btn-view-profile">View Profile</a>
                            <a href="tel:+919876543212" class="m-btn-call-now">Call Now</a>
                        </div>
                    </div>
                @endif
            </div>

            <button type="button" class="m-carousel-arrow right" id="mAgentNextBtn" aria-label="Next Agent">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </div>
    </section>

    <!-- Mobile District Cards Grid Section -->
    <section class="m-district-section">
        <div class="m-district-header">
            <h2 class="m-district-title">Important Cities</h2>
            <a href="{{ route('front.vendorlist') }}" class="m-district-link">सभी जिले देखें &rarr;</a>
        </div>

        <div class="m-district-grid">
            @php
                // Get dynamic districts from $districthome or $district
                $dbDistricts = (isset($districthome) && $districthome->count() > 0) 
                    ? $districthome 
                    : (isset($district) && $district->count() > 0 ? $district : collect());

                // If fewer than 6, pull extra from $district if available
                if ($dbDistricts->count() < 6 && isset($district) && $district->count() > $dbDistricts->count()) {
                    $existingIds = $dbDistricts->pluck('id')->toArray();
                    $extraFromDistrict = $district->whereNotIn('id', $existingIds);
                    $dbDistricts = $dbDistricts->concat($extraFromDistrict);
                }

                $curatedDefaults = [
                    [
                        'name' => 'Jaipur',
                        'agents' => '12,500+ Agents',
                        'image' => asset('front/assets/images/districts/jaipur.jpg')
                    ],
                    [
                        'name' => 'Jodhpur',
                        'agents' => '8,200+ Agents',
                        'image' => asset('front/assets/images/districts/jodhpur.jpg')
                    ],
                    [
                        'name' => 'Udaipur',
                        'agents' => '6,800+ Agents',
                        'image' => asset('front/assets/images/districts/udaipur.png')
                    ],
                    [
                        'name' => 'Kota',
                        'agents' => '5,100+ Agents',
                        'image' => asset('front/assets/images/districts/lucknow.jpg')
                    ],
                    [
                        'name' => 'Bikaner',
                        'agents' => '4,300+ Agents',
                        'image' => asset('front/assets/images/districts/bikaner.jpg')
                    ],
                    [
                        'name' => 'Ajmer',
                        'agents' => '3,900+ Agents',
                        'image' => asset('front/assets/images/districts/ajmer.jpg')
                    ],
                ];

                $agentCountPresets = ['12,500+ Agents', '8,200+ Agents', '6,800+ Agents', '5,100+ Agents', '4,300+ Agents', '3,900+ Agents', '3,200+ Agents', '2,800+ Agents'];
                $renderedCount = 0;
                $renderedNames = [];
            @endphp

            {{-- 1. Render all real dynamic DB items first --}}
            @if($dbDistricts->count() > 0)
                @foreach($dbDistricts->take(6) as $index => $dist)
                    @php
                        $renderedNames[] = strtolower($dist->name);
                        $renderedCount++;
                        $distImg = $getDistrictImg($dist, $index);

                        // Dynamic or formatted agent count
                        $agentLabel = isset($dist->users_count) && $dist->users_count > 0 
                            ? number_format($dist->users_count) . '+ Agents' 
                            : ($agentCountPresets[$index % count($agentCountPresets)] ?? '5,000+ Agents');
                    @endphp
                    <a href="{{ route('front.vendorlist') }}?district={{ $dist->id }}" class="m-district-card">
                        <img src="{{ $distImg }}" alt="{{ $dist->name }}" class="m-district-img" onerror="this.onerror=null;this.src='{{ asset('front/assets/images/districts/jaipur.jpg') }}';">
                        <div class="m-district-info">
                            <h3 class="m-district-name">{{ $dist->name }}</h3>
                            <span class="m-district-agents">{{ $agentLabel }}</span>
                        </div>
                    </a>
                @endforeach
            @endif

            {{-- 2. If DB has fewer than 6 items (e.g. only 2 in DB), backfill the remaining slots from curated list so all 6 cards appear --}}
            @if($renderedCount < 6)
                @foreach($curatedDefaults as $preset)
                    @if(!in_array(strtolower($preset['name']), $renderedNames) && $renderedCount < 6)
                        @php
                            $renderedCount++;
                        @endphp
                        <a href="{{ route('front.vendorlist') }}?search={{ urlencode($preset['name']) }}" class="m-district-card">
                            <img src="{{ $preset['image'] }}" alt="{{ $preset['name'] }}" class="m-district-img" onerror="this.onerror=null;this.src='{{ asset('front/assets/images/districts/jaipur.jpg') }}';">
                            <div class="m-district-info">
                                <h3 class="m-district-name">{{ $preset['name'] }}</h3>
                                <span class="m-district-agents">{{ $preset['agents'] }}</span>
                            </div>
                        </a>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="m-district-btn-wrap">
            <a href="{{ route('front.vendorlist') }}" class="m-btn-see-all-districts">सभी जिले देखें &rarr;</a>
        </div>
    </section>

    <!-- Mobile Join As Agent CTA Banner Section -->
    <section class="m-agent-cta-section">
        <div class="m-agent-cta-card">
            <div class="m-agent-cta-body">
                <div class="m-agent-cta-text">
                    <h2 class="m-cta-title">क्या आप भी Agent हैं?</h2>
                    <p class="m-cta-subtext">
                        अपनी Profile बनाएं, अपनी Services Promote करें और नए Customers तक पहुँचें।
                    </p>

                    <div class="m-cta-checklist">
                        <div class="m-check-item">
                            <span class="m-check-icon">&#10004;</span>
                            <span>Free Listing Option</span>
                        </div>
                        <div class="m-check-item">
                            <span class="m-check-icon">&#10004;</span>
                            <span>Affordable Paid Plans</span>
                        </div>
                        <div class="m-check-item">
                            <span class="m-check-icon">&#10004;</span>
                            <span>All India Visibility</span>
                        </div>
                        <div class="m-check-item">
                            <span class="m-check-icon">&#10004;</span>
                            <span>Business Growth</span>
                        </div>
                    </div>

                    <div class="m-cta-btn-wrap">
                        <a href="{{ route('front.register') }}" class="m-btn-register-agent">Register As Agent &rarr;</a>
                    </div>
                </div>

                <div class="m-agent-cta-graphic">
                    <img src="{{ asset('front/assets/images/login_hero_banner.png') }}" alt="Agent Dashboard App" class="m-cta-phone-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile Why Best Feature List Section -->
    <section class="m-why-best-section">
        <h2 class="m-why-best-title">हम क्यों हैं सबसे बेहतर?</h2>

        <div class="m-why-best-list">
            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="#004BEE"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4" stroke="#FFF" stroke-width="2.5" stroke-linecap="round"/></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">Trusted Platform</h3>
                    <p class="m-best-item-desc">भारत का भरोसेमंद Agent Directory</p>
                </div>
            </div>

            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">Safe & Secure</h3>
                    <p class="m-best-item-desc">आपकी जानकारी 100% सुरक्षित</p>
                </div>
            </div>

            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">All India Network</h3>
                    <p class="m-best-item-desc">हर शहर, हर जिला, आपके साथ</p>
                </div>
            </div>

            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">Affordable Plans</h3>
                    <p class="m-best-item-desc">हर Agent के लिए Best Plans</p>
                </div>
            </div>

            <div class="m-why-best-item">
                <div class="m-best-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2.2"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.45 1-1 1H7v4h10v-4h-2c-.55 0-1-.45-1-1v-2.34"></path><path d="M18 4H6v7a6 6 0 0 0 12 0V4z"></path></svg>
                </div>
                <div class="m-best-info">
                    <h3 class="m-best-item-title">Grow Your Business</h3>
                    <p class="m-best-item-desc">ज्यादा Visibility, ज्यादा Customers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile Metrics Light Blue Card -->
    <section class="m-metrics-summary-section">
        <div class="m-metrics-box">
            <div class="m-metric-col">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                <span class="m-mval">10,000+</span>
                <span class="m-mlbl">Verified Agents</span>
            </div>
            <div class="m-metric-col">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span class="m-mval">2500+</span>
                <span class="m-mlbl">Cities Covered</span>
            </div>
            <div class="m-metric-col">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <span class="m-mval">50+</span>
                <span class="m-mlbl">Categories</span>
            </div>
            <div class="m-metric-col">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path></svg>
                <span class="m-mval" style="font-size: 13px;">Call</span>
                <span class="m-mlbl">Support Available</span>
            </div>
        </div>
    </section>

    <!-- Mobile About Us Section -->
    <section class="m-about-section">
        <h2 class="m-about-title">हमारे बारे में</h2>
        <p class="m-about-text">
            Agent 24 India एक ऐसा Platform है जो Agents और Businesses को एक साथ जोड़ता है। हमारा मिशन है - सही Agent को सही Customers तक पहुँचाना और Business Growth को आसान बनाना।
        </p>
        <a href="{{ route('front.aboutus') }}" class="m-btn-about-more">और पढ़ें &rarr;</a>
    </section>

</div>

<!-- =========================================================================
     DESKTOP ONLY HOME PAGE SECTIONS (Matches agent2 desktop design)
     ========================================================================= -->

<!-- Main Hero Banner Section Start (DESKTOP ONLY) -->
<section class="index-hero-banner-section desktop-only">
    <div class="index-hero-banner-container" id="dHeroCarousel">
        <div class="d-hero-slider-track" id="dHeroSliderTrack">
            @php
                $desktopBanners = (isset($banner) && count($banner) > 0) ? $banner : collect();
            @endphp

            @if($desktopBanners->count() > 0)
                @foreach($desktopBanners as $dIdx => $dItem)
                    @php
                        $dImg = !empty($dItem->image) ? (Str::startsWith($dItem->image, 'http') ? $dItem->image : asset($dItem->image)) : asset('front/assets/images/index_hero_banner.png');
                        $dLink = !empty($dItem->link) ? $dItem->link : (!empty($dItem->url) ? $dItem->url : 'javascript:;');
                    @endphp
                    <div class="d-hero-slide-item" data-slide-index="{{ $dIdx }}">
                        <a href="{{ $dLink }}" class="d-hero-banner-link">
                            <img src="{{ $dImg }}" alt="{{ $dItem->title ?? 'काम कोई भी हो... Agent Sahi Yahi Milega! - Agent 24 India' }}" class="index-hero-banner-img" onerror="this.onerror=null;this.src='{{ asset('front/assets/images/index_hero_banner.png') }}';">
                        </a>
                    </div>
                @endforeach
            @else
                <div class="d-hero-slide-item" data-slide-index="0">
                    <img src="{{ asset('front/assets/images/index_hero_banner.png') }}" alt="काम कोई भी हो... Agent Sahi Yahi Milega! - Agent 24 India" class="index-hero-banner-img">
                </div>
            @endif
        </div>

        @if($desktopBanners->count() > 1)
            <!-- Desktop Navigation Arrows -->
            <button type="button" class="d-hero-nav-arrow prev" id="dHeroPrevBtn" aria-label="Previous Slide">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <button type="button" class="d-hero-nav-arrow next" id="dHeroNextBtn" aria-label="Next Slide">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>

            <!-- Desktop Pagination Dots -->
            <div class="d-hero-dots-wrap" id="dHeroDotsWrap">
                @foreach($desktopBanners as $dIdx => $dItem)
                    <span class="d-hero-dot {{ $dIdx == 0 ? 'active' : '' }}" data-dot-index="{{ $dIdx }}"></span>
                @endforeach
            </div>
        @endif
    </div>
</section>
<!-- Main Hero Banner Section End -->

<!-- Search & Features Section Start -->
<section class="index-search-section desktop-only">
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

            <form class="search-card-form" id="agentSearchForm" action="{{ route('front.vendorlist') }}" method="GET">
                <div class="search-validation-msg" id="searchValidationMsg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>कृपया खोजने के लिए कम से कम एक विकल्प चुनें या भरें (Search keyword, City/District या Category)।</span>
                </div>

                <div class="form-grid">

                    <!-- Field 1: District -->
                    <div class="form-field" id="searchDistrictField">
                        <label class="field-label">District / जिला</label>
                        <div class="input-with-icon">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <select class="custom-select select2-district" name="district" id="districtSelect">
                                <option value="">Search district</option>
                                @foreach(collect($district ?? [])->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $d)
                                    <option value="{{ $d->id }}" {{ request('district') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Field 2: City -->
                    <div class="form-field" id="searchCityField">
                        <label class="field-label">City / शहर</label>
                        <div class="input-with-icon">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <select class="custom-select select2-city" name="city" id="citySelect">
                                <option value="">Select city</option>
                                <option value="all">All City</option>
                                @if(isset($initialCities) && count($initialCities) > 0)
                                    @foreach($initialCities as $c)
                                        <option value="{{ $c->id }}" {{ request('city') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Field 3: Category -->
                    <div class="form-field" id="searchCategoryField">
                        <label class="field-label">Category / कैटेगरी</label>
                        <div class="input-with-icon">
                            <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="#004BEE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            <select class="custom-select select2-category" name="category" id="categorySelect">
                                <option value="">Select Category</option>
                                @if(isset($category) && count($category) > 0)
                                    @foreach(collect($category ?? [])->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE) as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
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
                    <span class="stat-number">2500+</span>
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
                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path>
                    </svg>
                </div>
                <div class="stat-text-group">
                    <span class="stat-number" style="font-size: 15px;">Call</span>
                    <span class="stat-label">Support Available</span>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Main Hero Banner Section End -->

<!-- Popular Categories Section Start -->
<section class="categories-section desktop-only">
    <div class="section-container">

        <!-- Section Header -->
        <div class="section-header">
            <span class="header-line"></span>
            <h2 class="section-title">लोकप्रिय Categories</h2>
            <span class="header-line"></span>
        </div>

        <!-- Categories Grid -->
        <div class="categories-grid" id="desktopCategoriesGrid">
            @if(isset($category) && $category->count() > 0)
                @php
                    $desktopCatIcons = ['icon-orange', 'icon-blue', 'icon-green', 'icon-purple', 'icon-rupee', 'icon-scale', 'icon-red'];
                @endphp
                @foreach($category->take(7) as $index => $cat)
                    <a href="{{ route('front.vendorlist') }}?category={{ $cat->id }}" class="category-card">
                        <div class="category-icon-box {{ $desktopCatIcons[$index % count($desktopCatIcons)] }}">
                            @if(!empty($cat->image) && !str_contains($cat->image, 'images.png'))
                                <img src="{{ $cat->image }}" alt="{{ $cat->name }}" style="width: 36px; height: 36px; object-fit: contain; border-radius: 6px;">
                            @else
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            @endif
                        </div>
                        <h3 class="category-title">{{ $cat->name }}</h3>
                        <p class="category-subtitle">{{ $cat->description ?: 'Explore Services' }}</p>
                    </a>
                @endforeach

                @if($category->count() > 7)
                    {{-- 8th Card: Trigger to expand all remaining categories --}}
                    <a href="javascript:void(0);" class="category-card card-more card-more-trigger" id="desktopCardMoreTrigger">
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
                        <p class="category-subtitle highlight-subtitle">{{ $category->count().'+ Categories' }}</p>
                    </a>

                    {{-- All remaining extra categories --}}
                    @foreach($category->slice(7) as $index => $cat)
                        <a href="{{ route('front.vendorlist') }}?category={{ $cat->id }}" class="category-card extra-category-card">
                            <div class="category-icon-box {{ $desktopCatIcons[($index + 7) % count($desktopCatIcons)] }}">
                                @if(!empty($cat->image) && !str_contains($cat->image, 'images.png'))
                                    <img src="{{ $cat->image }}" alt="{{ $cat->name }}" style="width: 36px; height: 36px; object-fit: contain; border-radius: 6px;">
                                @else
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                @endif
                            </div>
                            <h3 class="category-title">{{ $cat->name }}</h3>
                            <p class="category-subtitle">{{ $cat->description ?: 'Explore Services' }}</p>
                        </a>
                    @endforeach
                @else
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
                        <p class="category-subtitle highlight-subtitle">{{ isset($category) ? $category->count().'+ Categories' : '18+ Categories' }}</p>
                    </a>
                @endif
            @else
                <!-- Card 1: Real Estate -->
                <a href="{{ route('front.vendorlist') }}?search=Real+Estate" class="category-card">
                    <div class="category-icon-box icon-orange">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <h3 class="category-title">Real Estate Agent</h3>
                    <p class="category-subtitle">Buy / Sell / Rent</p>
                </a>

                <!-- Card 2: Automobile -->
                <a href="{{ route('front.vendorlist') }}?search=Automobile" class="category-card">
                    <div class="category-icon-box icon-blue">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                            <circle cx="7" cy="17" r="2"></circle>
                            <circle cx="17" cy="17" r="2"></circle>
                        </svg>
                    </div>
                    <h3 class="category-title">Automobile Agent</h3>
                    <p class="category-subtitle">Car, Bike & More</p>
                </a>

                <!-- Card 3: RTO Agent -->
                <a href="{{ route('front.vendorlist') }}?search=RTO" class="category-card">
                    <div class="category-icon-box icon-green">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <h3 class="category-title">RTO Agent</h3>
                    <p class="category-subtitle">RTO Related Services</p>
                </a>

                <!-- Card 4: Insurance Agent -->
                <a href="{{ route('front.vendorlist') }}?search=Insurance" class="category-card">
                    <div class="category-icon-box icon-purple">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9333EA" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="category-title">Insurance Agent</h3>
                    <p class="category-subtitle">Life, Health, General</p>
                </a>

                <!-- Card 5: Finance Agent -->
                <a href="{{ route('front.vendorlist') }}?search=Finance" class="category-card">
                    <div class="category-icon-box icon-rupee">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#EA580C" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 6v12M8 9h8M8 15h6"></path>
                        </svg>
                    </div>
                    <h3 class="category-title">Finance Agent</h3>
                    <p class="category-subtitle">Loan & Finance</p>
                </a>

                <!-- Card 6: Legal Agent -->
                <a href="{{ route('front.vendorlist') }}?search=Legal" class="category-card">
                    <div class="category-icon-box icon-scale">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3v18M3 7l9-4 9 4M5 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7M15 7v4a4 4 0 0 0 4 4h0a4 4 0 0 0 4-4V7"></path>
                        </svg>
                    </div>
                    <h3 class="category-title">Legal Agent</h3>
                    <p class="category-subtitle">All Legal Services</p>
                </a>

                <!-- Card 7: Transport Agent -->
                <a href="{{ route('front.vendorlist') }}?search=Transport" class="category-card">
                    <div class="category-icon-box icon-red">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <h3 class="category-title">Transport Agent</h3>
                    <p class="category-subtitle">Transport & Logistics</p>
                </a>

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
            @endif
        </div>

        <!-- View All Categories Button -->
        <div class="view-all-wrapper">
            <button type="button" class="btn-view-all" id="btnToggleAllCategories" aria-expanded="false">
                <span class="btn-text">सभी Categories देखें</span>
                <svg class="btn-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </div>

    </div>
</section>
<!-- Popular Categories Section End -->

<!-- Why Choose Agent 24 India Banner Section Start -->
<section class="why-choose-section desktop-only">
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
                            <h3 class="custom-why-head">Call Support Available</h3>
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
<section class="how-it-works-section desktop-only">
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
<section class="verified-agents-section desktop-only" id="verifiedAgents">
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

                    @if(isset($vendoruser) && count($vendoruser) > 0)
                        @foreach($vendoruser as $vendor)
                            <div class="agent-card">
                                <div class="verified-badge">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    <span>VERIFIED</span>
                                </div>
                                <div class="agent-avatar-wrapper">
                                    <img src="{{ $vendor->profile_photo_url }}" alt="{{ $vendor->business_name ?: $vendor->name }}" class="agent-avatar-img" onerror="this.onerror=null;this.src='{{ asset('front/assets/images/agent_sharma.jpg') }}';">
                                </div>
                                <h3 class="agent-name">{{ $vendor->business_name ?: $vendor->name }}</h3>
                                <p class="agent-category">{{ $vendor->businessCategory->name ?? ($vendor->category->name ?? 'Verified Agent') }}</p>
                                <p class="agent-location">{{ $vendor->district->name ?? 'Jaipur' }}, Rajasthan</p>
                                <div class="agent-rating-row">
                                    <div class="rating-stars">★★★★★</div>
                                    <span class="rating-score">4.9 <span class="rating-count">(Verified)</span></span>
                                </div>
                                <div class="agent-card-actions">
                                    <a href="{{ route('front.vendor.details', ['vendor' => $vendor->id]) }}" class="btn-agent-outlined">View Profile</a>
                                    <a href="tel:{{ $vendor->mobile ?? ($vendor->phone ?? '+919876543210') }}" class="btn-agent-filled">Call Now</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback Card 1 -->
                        <div class="agent-card">
                            <div class="verified-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED</span>
                            </div>
                            <div class="agent-avatar-wrapper">
                                <img src="{{ asset('front/assets/images/agent_sharma.jpg') }}" alt="Sharma Property Consultant" class="agent-avatar-img">
                            </div>
                            <h3 class="agent-name">Sharma Property Consultant</h3>
                            <p class="agent-category">Real Estate Agent</p>
                            <p class="agent-location">Jaipur, Rajasthan</p>
                            <div class="agent-rating-row">
                                <div class="rating-stars">★★★★★</div>
                                <span class="rating-score">4.8 <span class="rating-count">(120)</span></span>
                            </div>
                            <div class="agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a>
                                <a href="tel:+919876543210" class="btn-agent-filled">Call Now</a>
                            </div>
                        </div>

                        <!-- Fallback Card 2 -->
                        <div class="agent-card">
                            <div class="verified-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED</span>
                            </div>
                            <div class="agent-avatar-wrapper">
                                <img src="{{ asset('front/assets/images/agent_krishna.jpg') }}" alt="Krishna Motors" class="agent-avatar-img">
                            </div>
                            <h3 class="agent-name">Krishna Motors</h3>
                            <p class="agent-category">Automobile Agent</p>
                            <p class="agent-location">Jodhpur, Rajasthan</p>
                            <div class="agent-rating-row">
                                <div class="rating-stars">★★★★★</div>
                                <span class="rating-score">4.7 <span class="rating-count">(98)</span></span>
                            </div>
                            <div class="agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a>
                                <a href="tel:+919876543211" class="btn-agent-filled">Call Now</a>
                            </div>
                        </div>

                        <!-- Fallback Card 3 -->
                        <div class="agent-card">
                            <div class="verified-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED</span>
                            </div>
                            <div class="agent-avatar-wrapper">
                                <img src="{{ asset('front/assets/images/agent_rto.jpg') }}" alt="RTO Solution Point" class="agent-avatar-img">
                            </div>
                            <h3 class="agent-name">RTO Solution Point</h3>
                            <p class="agent-category">RTO Agent</p>
                            <p class="agent-location">Ajmer, Rajasthan</p>
                            <div class="agent-rating-row">
                                <div class="rating-stars">★★★★★</div>
                                <span class="rating-score">4.9 <span class="rating-count">(155)</span></span>
                            </div>
                            <div class="agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a>
                                <a href="tel:+919876543212" class="btn-agent-filled">Call Now</a>
                            </div>
                        </div>

                        <!-- Fallback Card 4 -->
                        <div class="agent-card">
                            <div class="verified-badge">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>VERIFIED</span>
                            </div>
                            <div class="agent-avatar-wrapper">
                                <img src="{{ asset('front/assets/images/agent_insurance.jpg') }}" alt="Secure Life Insurance" class="agent-avatar-img">
                            </div>
                            <h3 class="agent-name">Secure Life Insurance</h3>
                            <p class="agent-category">Insurance Agent</p>
                            <p class="agent-location">Udaipur, Rajasthan</p>
                            <div class="agent-rating-row">
                                <div class="rating-stars">★★★★★</div>
                                <span class="rating-score">4.8 <span class="rating-count">(112)</span></span>
                            </div>
                            <div class="agent-card-actions">
                                <a href="{{ route('front.vendorlist') }}" class="btn-agent-outlined">View Profile</a>
                                <a href="tel:+919876543213" class="btn-agent-filled">Call Now</a>
                            </div>
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
<section class="districts-section desktop-only" id="rajasthanDistricts">
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
            <h2 class="district-section-title">Important Cities</h2>
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
                    $dDistricts = (isset($districthome) && $districthome->count() > 0) ? $districthome : (isset($district) && $district->count() > 0 ? $district : collect());
                @endphp
                @if($dDistricts->count() > 0)
                    @foreach($dDistricts as $dist)
                        <div class="district-card">
                            <div class="district-image-wrapper">
                                <img src="{{ $getDistrictImg($dist, $loop->index) }}" alt="{{ $dist->name }}" class="district-img" onerror="this.onerror=null;this.src='{{ asset('front/assets/images/districts/jaipur.jpg') }}';">
                            </div>
                            <div class="district-info-body">
                                <div class="district-meta-row">
                                    <h3 class="district-name">{{ $dist->name }}</h3>
                                    <span class="district-agents-count">Top Verified Agents</span>
                                </div>
                                <a href="{{ route('front.vendorlist') }}?district={{ $dist->id }}" class="btn-explore-district">
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
                    <!-- Card 1: Jaipur -->
                    <div class="district-card">
                        <div class="district-image-wrapper">
                            <img src="{{ asset('front/assets/images/jal-mahal-jaipur-9175.jpg') }}" alt="Jaipur Jal Mahal" class="district-img">
                        </div>
                        <div class="district-info-body">
                            <div class="district-meta-row">
                                <h3 class="district-name">Jaipur</h3>
                                <span class="district-agents-count">12,500+ Agents</span>
                            </div>
                            <a href="{{ route('front.vendorlist') }}?search=Jaipur" class="btn-explore-district">
                                <span>Explore</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Card 2: Jodhpur -->
                    <div class="district-card">
                        <div class="district-image-wrapper">
                            <img src="{{ asset('front/assets/images/jodhpur.jpg') }}" alt="Jodhpur Mehrangarh Fort" class="district-img">
                        </div>
                        <div class="district-info-body">
                            <div class="district-meta-row">
                                <h3 class="district-name">Jodhpur</h3>
                                <span class="district-agents-count">8,200+ Agents</span>
                            </div>
                            <a href="{{ route('front.vendorlist') }}?search=Jodhpur" class="btn-explore-district">
                                <span>Explore</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Card 3: Udaipur -->
                    <div class="district-card">
                        <div class="district-image-wrapper">
                            <!-- Lake Palace Udaipur SVG -->
                            <svg viewBox="0 0 300 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="landmark-svg">
                                <rect width="300" height="160" fill="url(#udaipur-sky)" />
                                <rect y="105" width="300" height="55" fill="url(#lake-water)" />
                                <path d="M40 105V50H80V35H130V50H170V30H210V50H260V105H40Z" fill="#F8FAFC" />
                                <path d="M50 105V58H85V42H125V58H165V38H205V58H250V105H50Z" fill="#FFFFFF" />
                                <path d="M95 35C95 20 102 12 107 12C112 12 120 20 120 35H95Z" fill="#F1F5F9" />
                                <path d="M175 30C175 15 182 8 187 8C192 8 200 15 200 30H175Z" fill="#F1F5F9" />
                                <path d="M70 70C70 60 78 55 85 55C92 55 100 60 100 70V105H70V70Z" fill="#0EA5E9" />
                                <path d="M130 65C130 55 138 50 145 50C152 50 160 55 160 65V105H130V65Z" fill="#0EA5E9" />
                                <path d="M190 70C190 60 198 55 205 55C212 55 220 60 220 70V105H190V70Z" fill="#0EA5E9" />
                                <line x1="20" y1="125" x2="80" y2="125" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" opacity="0.6" />
                                <line x1="120" y1="135" x2="200" y2="135" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" opacity="0.6" />
                                <line x1="220" y1="120" x2="280" y2="120" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" opacity="0.6" />
                                <defs>
                                    <linearGradient id="udaipur-sky" x1="0" y1="0" x2="0" y2="160" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#0284C7" />
                                        <stop offset="0.65" stop-color="#E0F2FE" />
                                    </linearGradient>
                                    <linearGradient id="lake-water" x1="0" y1="105" x2="0" y2="160" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#0284C7" />
                                        <stop offset="1" stop-color="#0369A1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="district-info-body">
                            <div class="district-meta-row">
                                <h3 class="district-name">Udaipur</h3>
                                <span class="district-agents-count">6,800+ Agents</span>
                            </div>
                            <a href="{{ route('front.vendorlist') }}?search=Udaipur" class="btn-explore-district">
                                <span>Explore</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Card 4: Kota -->
                    <div class="district-card">
                        <div class="district-image-wrapper">
                            <!-- Kota Chambal Riverfront SVG -->
                            <svg viewBox="0 0 300 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="landmark-svg">
                                <rect width="300" height="160" fill="url(#kota-sky)" />
                                <rect y="110" width="300" height="50" fill="#0284C7" />
                                <path d="M30 110V50H90V30H130V50H170V110H30Z" fill="#9A3412" />
                                <path d="M40 110V58H85V38H125V58H160V110H40Z" fill="#C2410C" />
                                <path d="M170 85H270V110H170V85Z" fill="#EA580C" />
                                <circle cx="110" cy="30" r="14" fill="#FDBA74" />
                                <path d="M180 110C180 98 188 92 195 92C202 92 210 98 210 110H180Z" fill="#0284C7" />
                                <path d="M220 110C220 98 228 92 235 92C242 92 250 98 250 110H220Z" fill="#0284C7" />
                                <defs>
                                    <linearGradient id="kota-sky" x1="0" y1="0" x2="0" y2="160" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#38BDF8" />
                                        <stop offset="0.7" stop-color="#E0F2FE" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="district-info-body">
                            <div class="district-meta-row">
                                <h3 class="district-name">Kota</h3>
                                <span class="district-agents-count">5,100+ Agents</span>
                            </div>
                            <a href="{{ route('front.vendorlist') }}?search=Kota" class="btn-explore-district">
                                <span>Explore</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Card 5: Bikaner -->
                    <div class="district-card">
                        <div class="district-image-wrapper">
                            <!-- Bikaner Junagarh Fort SVG -->
                            <svg viewBox="0 0 300 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="landmark-svg">
                                <rect width="300" height="160" fill="url(#bikaner-sky)" />
                                <path d="M0 160L40 130L150 135L300 140V160H0Z" fill="#78350F" opacity="0.4" />
                                <path d="M40 135V45H90V25H140V45H190V30H230V45H260V135H40Z" fill="#991B1B" />
                                <path d="M50 135V52H85V32H135V52H185V38H225V52H250V135H50Z" fill="#B91C1C" />
                                <path d="M105 25C105 12 114 6 120 6C126 6 135 12 135 25H105Z" fill="#EF4444" />
                                <path d="M200 30C200 18 208 12 213 12C218 12 226 18 226 30H200Z" fill="#EF4444" />
                                <path d="M125 135V95C125 82 138 72 150 72C162 72 175 82 175 95V135H125Z" fill="#FEF2F2" />
                                <defs>
                                    <linearGradient id="bikaner-sky" x1="0" y1="0" x2="0" y2="160" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#F97316" />
                                        <stop offset="0.6" stop-color="#FFEDD5" />
                                        <stop offset="1" stop-color="#FEF08A" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="district-info-body">
                            <div class="district-meta-row">
                                <h3 class="district-name">Bikaner</h3>
                                <span class="district-agents-count">4,300+ Agents</span>
                            </div>
                            <a href="{{ route('front.vendorlist') }}?search=Bikaner" class="btn-explore-district">
                                <span>Explore</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Card 6: Ajmer -->
                    <div class="district-card">
                        <div class="district-image-wrapper">
                            <!-- Ajmer Dargah & Ana Sagar Lake SVG -->
                            <svg viewBox="0 0 300 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="landmark-svg">
                                <rect width="300" height="160" fill="url(#ajmer-sky)" />
                                <rect y="120" width="300" height="40" fill="#0284C7" />
                                <path d="M50 120V70H250V120H50Z" fill="#F8FAFC" />
                                <path d="M60 120V78H240V120H60Z" fill="#FFFFFF" />
                                <path d="M105 70C105 35 125 15 150 15C175 15 195 35 195 70H105Z" fill="#FFFFFF" />
                                <path d="M147 15V0H153V15H147Z" fill="#EAB308" />
                                <circle cx="150" cy="0" r="4" fill="#EAB308" />
                                <path d="M130 120V95C130 85 138 78 150 78C162 78 170 85 170 95V120H130Z" fill="#0284C7" />
                                <defs>
                                    <linearGradient id="ajmer-sky" x1="0" y1="0" x2="0" y2="160" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#0284C7" />
                                        <stop offset="0.75" stop-color="#BAE6FD" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="district-info-body">
                            <div class="district-meta-row">
                                <h3 class="district-name">Ajmer</h3>
                                <span class="district-agents-count">3,900+ Agents</span>
                            </div>
                            <a href="{{ route('front.vendorlist') }}?search=Ajmer" class="btn-explore-district">
                                <span>Explore</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
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

        <!-- Centered View All Districts Button Wrapper inside Section Container -->
        <div class="view-all-districts-wrapper" style="display: flex; justify-content: center; margin-top: 24px;">
            <a href="{{ route('front.vendorlist') }}" class="btn-all-districts">
                <span>सभी जिलों को देखें</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

    </div>
</section>
<!-- Rajasthan Districts Section End -->

<!-- Happy Customers Testimonials Section Start -->
<section class="testimonials-section desktop-only" id="testimonials">
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
                            <path d="M34 40C34 52 41 60 50 60C59 60 66 52 66 40C66 28 59 22 50 22C41 22 34 28 34 40Z" fill="#F0B89A" />
                            <path d="M30 38C30 20 38 10 50 10C62 10 70 20 70 38C70 52 66 65 62 72C60 64 63 48 60 34C56 24 52 21 50 21C48 21 44 24 40 34C37 48 40 64 38 72C34 65 30 52 30 38Z" fill="#0F172A" />
                            <circle cx="45" cy="39" r="2" fill="#0F172A" />
                            <circle cx="55" cy="39" r="2" fill="#0F172A" />
                            <path d="M44 48C47 52 53 52 56 48" stroke="#0F172A" stroke-width="1.5" fill="#FFFFFF" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"Agent 24 India की मदद से हमें Jaipur में भरोसेमंद Property Consultant बहुत जल्दी मिल गया। अब घर लेना आसान हो गया!"</p>
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
                            <path d="M34 38C34 50 41 58 50 58C59 58 66 50 66 38C66 26 59 20 50 20C41 20 34 26 34 38Z" fill="#E2A687" />
                            <circle cx="44" cy="36" r="2" fill="#111827" />
                            <circle cx="56" cy="36" r="2" fill="#111827" />
                            <path d="M45 46C48 49 52 49 55 46" fill="#FFFFFF" stroke="#111827" stroke-width="1.2" />
                        </svg>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"RTO का काम महीनों से अटका था, यहाँ सही Agent मिला और 2 दिन में काम पूरा हो गया!"</p>
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
                            <path d="M34 38C34 50 41 58 50 58C59 58 66 50 66 38C66 26 59 20 50 20C41 20 34 26 34 38Z" fill="#F0C3AA" />
                            <circle cx="44" cy="36" r="2" fill="#0F172A" />
                            <circle cx="56" cy="36" r="2" fill="#0F172A" />
                            <path d="M45 46C48 49 52 49 55 46" fill="#FFFFFF" stroke="#0F172A" stroke-width="1.2" />
                        </svg>
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"Insurance Agent यहाँ से खोजकर सही प्लान लिया। शानदार प्लेटफॉर्म है!"</p>
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
<section class="agent-cta-section desktop-only" id="agentRegisterCta">
    <div class="section-container">
        <div class="agent-cta-card">

            <!-- Left Column: Laptop Graphic with Dashboard & Houseplants -->
            <div class="cta-graphic-col">
                <div class="laptop-illustration-wrapper">
                    <!-- Left Plant -->
                    <div class="plant-left">
                        <svg width="40" height="60" viewBox="0 0 40 60" fill="none">
                            <path d="M15 60V42C15 42 5 35 5 25C5 15 15 10 20 5C25 10 35 15 35 25C35 35 25 42 25 42V60H15Z" fill="#16A34A" />
                            <path d="M20 5V60" stroke="#15803D" stroke-width="2" />
                            <ellipse cx="20" cy="54" rx="10" ry="6" fill="#15803D" />
                        </svg>
                    </div>

                    <!-- SVG Laptop with Analytics Dashboard -->
                    <div class="laptop-device">
                        <svg viewBox="0 0 280 180" fill="none" xmlns="http://www.w3.org/2000/svg" class="laptop-svg">
                            <rect x="25" y="10" width="230" height="140" rx="10" fill="#0F172A" />
                            <rect x="32" y="18" width="216" height="124" rx="4" fill="#FFFFFF" />
                            <rect x="32" y="18" width="216" height="22" fill="#004BEE" />
                            <circle cx="44" cy="29" r="4" fill="#60A5FA" />
                            <rect x="54" y="26" width="40" height="6" rx="3" fill="#FFFFFF" />
                            <rect x="200" y="24" width="36" height="10" rx="3" fill="#FFB000" />
                            <rect x="32" y="40" width="36" height="102" fill="#F1F5F9" />
                            <rect x="76" y="48" width="48" height="26" rx="4" fill="#EFF6FF" />
                            <rect x="130" y="48" width="48" height="26" rx="4" fill="#F0FDF4" />
                            <rect x="184" y="48" width="56" height="26" rx="4" fill="#FEF3C7" />
                            <rect x="76" y="82" width="104" height="52" rx="4" fill="#F8FAFC" stroke="#E2E8F0" />
                            <rect x="86" y="112" width="10" height="16" rx="2" fill="#60A5FA" />
                            <rect x="102" y="98" width="10" height="30" rx="2" fill="#004BEE" />
                            <rect x="118" y="104" width="10" height="24" rx="2" fill="#60A5FA" />
                            <rect x="134" y="92" width="10" height="36" rx="2" fill="#004BEE" />
                            <rect x="150" y="116" width="10" height="12" rx="2" fill="#60A5FA" />
                            <rect x="166" y="88" width="10" height="40" rx="2" fill="#22C55E" />
                            <circle cx="213" cy="108" r="18" fill="#004BEE" />
                            <path d="M213 108L231 108A18 18 0 0 1 213 126Z" fill="#FFB000" />
                            <path d="M10 150H270L255 165H25L10 150Z" fill="#CBD5E1" />
                        </svg>
                    </div>

                    <!-- Right Plant -->
                    <div class="plant-right">
                        <svg width="40" height="60" viewBox="0 0 40 60" fill="none">
                            <path d="M15 60V42C15 42 5 35 5 25C5 15 15 10 20 5C25 10 35 15 35 25C35 35 25 42 25 42V60H15Z" fill="#16A34A" />
                            <path d="M20 5V60" stroke="#15803D" stroke-width="2" />
                            <ellipse cx="20" cy="54" rx="10" ry="6" fill="#15803D" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Middle Column: Heading & Yellow CTA Button -->
            <div class="cta-content-col">
                <h3 class="cta-main-title">क्या आप भी एक Agent हैं?</h3>
                <p class="cta-subtitle">अपनी Profile बनाएं, अपनी services promote करें और नए customers तक पहुँचें।</p>

                <a href="{{ route('front.register') }}" class="btn-register-yellow">
                    <span>अभी Register करें</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
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
<section class="trust-features-section desktop-only" id="trustFeatures">
    <div class="section-container">
        <div class="trust-features-card">

            <!-- Feature 1: Trusted Platform -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-blue-shield">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" />
                        <polygon points="12 6 13.8 9.6 17.7 10.2 14.9 12.9 15.6 16.8 12 14.9 8.4 16.8 9.1 12.9 6.3 10.2 10.2 9.6" fill="#FFB000" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">Trusted Platform</h4>
                    <p class="trust-subtitle">भारत का भरोसेमंद Agent Directory</p>
                </div>
            </div>

            <div class="trust-divider"></div>

            <!-- Feature 2: Safe & Secure -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-blue-lock">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">Safe & Secure</h4>
                    <p class="trust-subtitle">आपकी जानकारी है 100% Secure</p>
                </div>
            </div>

            <div class="trust-divider"></div>

            <!-- Feature 3: All India Network -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-blue-pin">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">All India Network</h4>
                    <p class="trust-subtitle">हर शहर, हर जिला हमारे साथ</p>
                </div>
            </div>

            <div class="trust-divider"></div>

            <!-- Feature 4: Affordable Plans -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-blue-tag">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#004BEE" stroke="none">
                        <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">Affordable Plans</h4>
                    <p class="trust-subtitle">हर Agent के लिए Best Plans</p>
                </div>
            </div>

            <div class="trust-divider"></div>

            <!-- Feature 5: Grow Your Business -->
            <div class="trust-feature-col">
                <div class="trust-icon-box icon-gold-trophy">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#FFB000" stroke="none">
                        <path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V18H8v2h8v-2h-3v-2.1c2.14-.46 3.78-2.14 4.39-4.34C19.08 11.37 21 9.29 21 6.74V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" />
                    </svg>
                </div>
                <div class="trust-text-group">
                    <h4 class="trust-title">Grow Your Business</h4>
                    <p class="trust-subtitle">ज्यादा Visibility, ज्यादा Customers</p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Trust Features Bar Section End -->

<!-- Dark Blue Stats Metrics Bar Section Start -->
<section class="dark-stats-section desktop-only" id="darkStats">
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

            <!-- Stat 2: 2500+ Cities Covered -->
            <div class="dark-stat-col">
                <div class="dark-stat-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <div class="dark-stat-text">
                    <span class="dark-stat-number">2500+</span>
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
                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2H3z"></path>
                    </svg>
                </div>
                <div class="dark-stat-text">
                    <span class="dark-stat-number">Full</span>
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
document.addEventListener('DOMContentLoaded', () => {
    // Carousel logic for Mobile Dynamic Hero Banner Slider
    const mHeroCarousel = document.getElementById('mHeroCarousel');
    const mHeroTrack = document.getElementById('mHeroSliderTrack');
    const mHeroSlides = mHeroTrack ? mHeroTrack.querySelectorAll('.m-hero-slide-item') : [];
    const mHeroPrev = document.getElementById('mHeroPrevBtn');
    const mHeroNext = document.getElementById('mHeroNextBtn');
    const mHeroDots = document.querySelectorAll('#mHeroDotsWrap .m-hero-dot');

    if (mHeroTrack && mHeroSlides.length > 1) {
        let currentHeroIndex = 0;
        let heroInterval = null;

        function showHeroSlide(index) {
            if (index < 0) index = mHeroSlides.length - 1;
            if (index >= mHeroSlides.length) index = 0;
            currentHeroIndex = index;
            mHeroTrack.style.transform = `translateX(-${currentHeroIndex * 100}%)`;
            mHeroDots.forEach((dot, idx) => {
                dot.classList.toggle('active', idx === currentHeroIndex);
            });
        }

        function nextHeroSlide() {
            showHeroSlide(currentHeroIndex + 1);
        }

        function startHeroAuto() {
            stopHeroAuto();
            heroInterval = setInterval(nextHeroSlide, 4000);
        }

        function stopHeroAuto() {
            if (heroInterval) clearInterval(heroInterval);
        }

        if (mHeroNext) {
            mHeroNext.addEventListener('click', (e) => {
                e.preventDefault();
                nextHeroSlide();
                startHeroAuto();
            });
        }
        if (mHeroPrev) {
            mHeroPrev.addEventListener('click', (e) => {
                e.preventDefault();
                showHeroSlide(currentHeroIndex - 1);
                startHeroAuto();
            });
        }

        mHeroDots.forEach((dot, idx) => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                showHeroSlide(idx);
                startHeroAuto();
            });
        });

        // Touch Swipe Handling
        let touchStartX = 0;
        let touchEndX = 0;
        mHeroCarousel.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
            stopHeroAuto();
        }, { passive: true });

        mHeroCarousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].clientX;
            const diffX = touchStartX - touchEndX;
            if (Math.abs(diffX) > 40) {
                if (diffX > 0) {
                    nextHeroSlide();
                } else {
                    showHeroSlide(currentHeroIndex - 1);
                }
            }
            startHeroAuto();
        }, { passive: true });

        startHeroAuto();
    }

    // Carousel logic for Desktop Dynamic Hero Banner Slider
    const dHeroCarousel = document.getElementById('dHeroCarousel');
    const dHeroTrack = document.getElementById('dHeroSliderTrack');
    const dHeroSlides = dHeroTrack ? dHeroTrack.querySelectorAll('.d-hero-slide-item') : [];
    const dHeroPrev = document.getElementById('dHeroPrevBtn');
    const dHeroNext = document.getElementById('dHeroNextBtn');
    const dHeroDots = document.querySelectorAll('#dHeroDotsWrap .d-hero-dot');

    if (dHeroTrack && dHeroSlides.length > 1) {
        let currentDHeroIndex = 0;
        let dHeroInterval = null;

        function showDHeroSlide(index) {
            if (index < 0) index = dHeroSlides.length - 1;
            if (index >= dHeroSlides.length) index = 0;
            currentDHeroIndex = index;
            dHeroTrack.style.transform = `translateX(-${currentDHeroIndex * 100}%)`;
            dHeroDots.forEach((dot, idx) => {
                dot.classList.toggle('active', idx === currentDHeroIndex);
            });
        }

        function nextDHeroSlide() {
            showDHeroSlide(currentDHeroIndex + 1);
        }

        function startDHeroAuto() {
            stopDHeroAuto();
            dHeroInterval = setInterval(nextDHeroSlide, 4500);
        }

        function stopDHeroAuto() {
            if (dHeroInterval) clearInterval(dHeroInterval);
        }

        if (dHeroNext) {
            dHeroNext.addEventListener('click', (e) => {
                e.preventDefault();
                nextDHeroSlide();
                startDHeroAuto();
            });
        }
        if (dHeroPrev) {
            dHeroPrev.addEventListener('click', (e) => {
                e.preventDefault();
                showDHeroSlide(currentDHeroIndex - 1);
                startDHeroAuto();
            });
        }

        dHeroDots.forEach((dot, idx) => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                showDHeroSlide(idx);
                startDHeroAuto();
            });
        });

        // Pause auto-sliding on hover
        if (dHeroCarousel) {
            dHeroCarousel.addEventListener('mouseenter', stopDHeroAuto);
            dHeroCarousel.addEventListener('mouseleave', startDHeroAuto);
        }

        startDHeroAuto();
    }

    // Carousel logic for Mobile Top Verified Agents
    const mAgentTrack = document.getElementById('mAgentSliderTrack');
    const mAgentPrev = document.getElementById('mAgentPrevBtn');
    const mAgentNext = document.getElementById('mAgentNextBtn');

    if (mAgentTrack && mAgentPrev && mAgentNext) {
        mAgentPrev.addEventListener('click', () => {
            const card = mAgentTrack.querySelector('.m-agent-slide-card');
            const step = card ? card.offsetWidth + 12 : 280;
            mAgentTrack.scrollBy({ left: -step, behavior: 'smooth' });
        });
        mAgentNext.addEventListener('click', () => {
            const card = mAgentTrack.querySelector('.m-agent-slide-card');
            const step = card ? card.offsetWidth + 12 : 280;
            mAgentTrack.scrollBy({ left: step, behavior: 'smooth' });
        });
    }

    // Carousel logic for Top Verified Agents (Desktop)
    const agentTrack = document.getElementById('agentsSliderTrack');
    const agentPrev = document.getElementById('agentPrevBtn');
    const agentNext = document.getElementById('agentNextBtn');

    if (agentTrack && agentPrev && agentNext) {
        agentPrev.addEventListener('click', () => {
            agentTrack.scrollBy({ left: -320, behavior: 'smooth' });
        });
        agentNext.addEventListener('click', () => {
            agentTrack.scrollBy({ left: 320, behavior: 'smooth' });
        });
    }

    // Carousel logic for Districts (Desktop)
    const districtTrack = document.getElementById('districtSliderTrack');
    const districtPrev = document.getElementById('districtPrevBtn');
    const districtNext = document.getElementById('districtNextBtn');

    if (districtTrack && districtPrev && districtNext) {
        districtPrev.addEventListener('click', () => {
            districtTrack.scrollBy({ left: -300, behavior: 'smooth' });
        });
        districtNext.addEventListener('click', () => {
            districtTrack.scrollBy({ left: 300, behavior: 'smooth' });
        });
    }

    // Carousel logic for Testimonials (Desktop)
    const testTrack = document.getElementById('testimonialSliderTrack');
    const testPrev = document.getElementById('testimonialPrevBtn');
    const testNext = document.getElementById('testimonialNextBtn');

    if (testTrack && testPrev && testNext) {
        testPrev.addEventListener('click', () => {
            testTrack.scrollBy({ left: -340, behavior: 'smooth' });
        });
        testNext.addEventListener('click', () => {
            testTrack.scrollBy({ left: 340, behavior: 'smooth' });
        });
    }

    // =========================================================================
    // SEARCH FORM: SELECT2 & DYNAMIC DISTRICT -> CITY AJAX
    // =========================================================================
    const cityApiBaseUrl = "{{ url('/get-cities') }}";

    if ($.fn.select2) {
        $('.select2-district').select2({
            placeholder: 'Search district',
            allowClear: false,
            width: '100%'
        });
        $('.select2-city').select2({
            placeholder: 'Select city',
            allowClear: false,
            width: '100%'
        });
        $('.select2-category').select2({
            placeholder: 'Select Category',
            allowClear: false,
            width: '100%'
        });
    }

    function setupDistrictCityBinding(districtSelectId, citySelectId, isSelect2) {
        const $dist = $('#' + districtSelectId);
        const $city = $('#' + citySelectId);

        $dist.on('change', function() {
            const districtId = $(this).val();
            if (!districtId) {
                const defaultOpts = '<option value="">Select city</option><option value="all">All City</option>';
                $city.html(defaultOpts);
                if (isSelect2 && $.fn.select2) {
                    $city.trigger('change.select2');
                }
                return;
            }

            $.get(cityApiBaseUrl + '/' + districtId, function(cities) {
                let options = '<option value="">Select city</option><option value="all">All City</option>';
                if (Array.isArray(cities) && cities.length) {
                    cities.forEach(function(c) {
                        options += '<option value="' + c.id + '">' + c.name + '</option>';
                    });
                }
                $city.html(options);
                if (isSelect2 && $.fn.select2) {
                    $city.trigger('change.select2');
                }
            });
        });
    }

    setupDistrictCityBinding('districtSelect', 'citySelect', true);
    setupDistrictCityBinding('mDistrictSelect', 'mCitySelect', false);

    // Desktop Search Form Validation
    const desktopSearchForm = document.getElementById('agentSearchForm');
    const districtSelect = document.getElementById('districtSelect');
    const citySelect = document.getElementById('citySelect');
    const categorySelect = document.getElementById('categorySelect');
    const searchValMsg = document.getElementById('searchValidationMsg');
    const desktopFields = [
        document.getElementById('searchDistrictField'),
        document.getElementById('searchCityField'),
        document.getElementById('searchCategoryField')
    ];

    function clearDesktopErrors() {
        if (searchValMsg) searchValMsg.classList.remove('active');
        desktopFields.forEach(f => {
            if (f) f.classList.remove('has-error');
        });
    }

    if (desktopSearchForm) {
        desktopSearchForm.addEventListener('submit', (e) => {
            const district = districtSelect ? districtSelect.value.trim() : '';
            const city = citySelect ? citySelect.value.trim() : '';
            const category = categorySelect ? categorySelect.value.trim() : '';

            // Require at least one field to be selected
            if (!district && !city && !category) {
                e.preventDefault();
                if (searchValMsg) searchValMsg.classList.add('active');
                desktopFields.forEach(f => {
                    if (f) {
                        f.classList.remove('has-error');
                        void f.offsetWidth; // Trigger reflow for shake animation
                        f.classList.add('has-error');
                    }
                });
                return false;
            }
        });

        if (districtSelect) $(districtSelect).on('change', clearDesktopErrors);
        if (citySelect) $(citySelect).on('change', clearDesktopErrors);
        if (categorySelect) $(categorySelect).on('change', clearDesktopErrors);
    }

    // Mobile Search Form Validation
    const mSearchForm = document.getElementById('mAgentSearchForm');
    const mDistrictSelect = document.getElementById('mDistrictSelect');
    const mCitySelect = document.getElementById('mCitySelect');
    const mCategorySelect = document.getElementById('mCategorySelect');
    const mSearchValMsg = document.getElementById('mSearchValidationMsg');
    const mFields = [
        document.getElementById('mSearchDistrictField'),
        document.getElementById('mSearchCityField'),
        document.getElementById('mSearchCategoryField')
    ];

    function clearMobileErrors() {
        if (mSearchValMsg) mSearchValMsg.classList.remove('active');
        mFields.forEach(f => {
            if (f) f.classList.remove('has-error');
        });
    }

    if (mSearchForm) {
        mSearchForm.addEventListener('submit', (e) => {
            const district = mDistrictSelect ? mDistrictSelect.value.trim() : '';
            const city = mCitySelect ? mCitySelect.value.trim() : '';
            const category = mCategorySelect ? mCategorySelect.value.trim() : '';

            // Require at least one field to be selected
            if (!district && !city && !category) {
                e.preventDefault();
                if (mSearchValMsg) mSearchValMsg.classList.add('active');
                mFields.forEach(f => {
                    if (f) {
                        f.classList.remove('has-error');
                        void f.offsetWidth; // Trigger reflow for shake animation
                        f.classList.add('has-error');
                    }
                });
                return false;
            }
        });

        if (mDistrictSelect) mDistrictSelect.addEventListener('change', clearMobileErrors);
        if (mCitySelect) mCitySelect.addEventListener('change', clearMobileErrors);
        if (mCategorySelect) mCategorySelect.addEventListener('change', clearMobileErrors);
    }

    // =========================================================================
    // IN-PAGE CATEGORY SHOW-ALL EXPANSION (No Redirection)
    // =========================================================================

    // Desktop Category Show-All Toggle
    const desktopCatGrid = document.getElementById('desktopCategoriesGrid');
    const btnToggleCat = document.getElementById('btnToggleAllCategories');
    const desktopCardMore = document.getElementById('desktopCardMoreTrigger');

    function toggleDesktopCategories() {
        if (!desktopCatGrid) return;
        const isExpanded = desktopCatGrid.classList.toggle('show-all');
        if (btnToggleCat) {
            btnToggleCat.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            const btnText = btnToggleCat.querySelector('.btn-text');
            const btnIcon = btnToggleCat.querySelector('.btn-icon');
            if (isExpanded) {
                if (btnText) btnText.textContent = 'कम Categories देखें';
                if (btnIcon) btnIcon.innerHTML = '<line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline>';
            } else {
                if (btnText) btnText.textContent = 'सभी Categories देखें';
                if (btnIcon) btnIcon.innerHTML = '<line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline>';
            }
        }
    }

    if (btnToggleCat) {
        btnToggleCat.addEventListener('click', (e) => {
            e.preventDefault();
            toggleDesktopCategories();
        });
    }
    if (desktopCardMore) {
        desktopCardMore.addEventListener('click', (e) => {
            e.preventDefault();
            toggleDesktopCategories();
        });
    }

    // Mobile Category Show-All Toggle
    const mPopCatGrid = document.getElementById('mPopCatGrid');
    const mToggleCatLink = document.getElementById('mToggleCategoriesLink');
    const mCardMore = document.getElementById('mCardMoreTrigger');

    function toggleMobileCategories() {
        if (!mPopCatGrid) return;
        const isExpanded = mPopCatGrid.classList.toggle('show-all');
        if (mToggleCatLink) {
            mToggleCatLink.innerHTML = isExpanded ? 'कम देखें &uarr;' : 'सभी देखें &rarr;';
        }
    }

    if (mToggleCatLink) {
        mToggleCatLink.addEventListener('click', (e) => {
            e.preventDefault();
            toggleMobileCategories();
        });
    }
    if (mCardMore) {
        mCardMore.addEventListener('click', (e) => {
            e.preventDefault();
            toggleMobileCategories();
        });
    }
});
</script>
@endpush

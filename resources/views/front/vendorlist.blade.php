@extends('front.layout.main')
@section('title', $pageTitle ?? 'Verified Agents List - Agent 24 India')

@push('styles')
<style>
    :root {
        --primary-blue: #004BEE;
        --primary-hover: #0036B8;
        --secondary-navy: #0B1948;
        --slate-dark: #0F172A;
        --slate-body: #334155;
        --slate-muted: #64748B;
        --border-color: #E2E8F0;
        --bg-page: #F8FAFC;
        --verified-green: #10B981;
    }

    body {
        background-color: var(--bg-page);
    }

    .vendorlist-page {
        background-color: var(--bg-page);
        padding-bottom: 70px;
    }

    /* -------------------------------------------------------------
       Top Horizontal Secondary Filter Bar
    -------------------------------------------------------------- */
    .vl-top-filter-bar {
        background: #FFFFFF;
        border-bottom: 1px solid var(--border-color);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        padding: 12px 0;
        position: sticky;
        top: 72px;
        z-index: 90;
    }

    .vl-filter-bar-container {
        max-width: 1340px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .vl-filter-bar-left {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        flex: 1;
    }

    .vl-filter-toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #F1F5F9;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--slate-dark);
        cursor: pointer;
        transition: all 0.2s;
    }

    .vl-filter-toggle-btn:hover {
        background: #E2E8F0;
        color: var(--primary-blue);
    }

    .vl-dropdown-capsule {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 600;
        color: var(--slate-dark);
        transition: border-color 0.2s;
    }

    .vl-dropdown-capsule:focus-within {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 2.5px rgba(0, 75, 238, 0.12);
    }

    .vl-dropdown-capsule label {
        margin: 0;
        color: var(--slate-muted);
        font-size: 12px;
        font-weight: 600;
    }

    .vl-dropdown-capsule select {
        border: none;
        background: transparent;
        font-size: 13px;
        font-weight: 700;
        color: var(--slate-dark);
        outline: none;
        cursor: pointer;
        padding-right: 4px;
    }

    .vl-filter-bar-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .vl-sort-group {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
    }

    .vl-sort-group label {
        margin: 0;
        color: var(--slate-muted);
        font-weight: 600;
        font-size: 12px;
    }

    .vl-sort-group select {
        border: none;
        background: transparent;
        font-size: 13px;
        font-weight: 700;
        color: var(--slate-dark);
        outline: none;
        cursor: pointer;
    }

    .vl-view-toggle {
        display: inline-flex;
        align-items: center;
        background: #F1F5F9;
        border-radius: 8px;
        padding: 3px;
        gap: 2px;
    }

    .vl-view-btn {
        border: none;
        background: transparent;
        color: var(--slate-muted);
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .vl-view-btn.active {
        background: var(--primary-blue);
        color: #FFFFFF;
        box-shadow: 0 2px 6px rgba(0, 75, 238, 0.25);
    }

    /* -------------------------------------------------------------
       Main 3-Column Layout
    -------------------------------------------------------------- */
    .vl-layout-wrap {
        max-width: 1340px;
        margin: 20px auto 0 auto;
        padding: 0 24px;
    }

    .vl-3col-grid {
        display: grid;
        grid-template-columns: 250px 1fr 270px;
        gap: 22px;
        align-items: start;
    }

    @media (max-width: 1200px) {
        .vl-3col-grid {
            grid-template-columns: 230px 1fr 250px;
            gap: 16px;
        }
    }

    @media (max-width: 991px) {
        .vl-3col-grid {
            grid-template-columns: 1fr;
        }
        .vl-filter-sidebar {
            display: none;
        }
        .vl-filter-sidebar.is-open {
            display: block;
        }
        .vl-visiting-sidebar {
            order: 3;
        }
    }

    /* -------------------------------------------------------------
       Left Column: Filter Sidebar
    -------------------------------------------------------------- */
    .vl-filter-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02);
    }

    .vl-filter-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 14px;
        border-bottom: 1px solid #F1F5F9;
        margin-bottom: 16px;
    }

    .vl-filter-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 800;
        color: var(--slate-dark);
        margin: 0;
    }

    .vl-filter-block {
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #F1F5F9;
    }

    .vl-filter-block:last-of-type {
        border-bottom: none;
        margin-bottom: 12px;
        padding-bottom: 0;
    }

    .vl-block-label {
        font-size: 13px;
        font-weight: 700;
        color: var(--slate-dark);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .vl-block-select {
        width: 100%;
        height: 40px;
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        padding: 0 10px;
        font-size: 13px;
        font-weight: 600;
        color: var(--slate-dark);
        background-color: #FFFFFF;
        outline: none;
        transition: border-color 0.2s;
    }

    .vl-block-select:focus {
        border-color: var(--primary-blue);
    }

    .vl-search-mini {
        position: relative;
        margin-bottom: 10px;
    }

    .vl-search-mini input {
        width: 100%;
        height: 36px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0 10px 0 30px;
        font-size: 12.5px;
        color: var(--slate-dark);
        outline: none;
        background: #F8FAFC;
    }

    .vl-search-mini input:focus {
        border-color: var(--primary-blue);
        background: #FFFFFF;
    }

    .vl-search-mini svg {
        position: absolute;
        left: 9px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate-muted);
        pointer-events: none;
    }

    .vl-checkbox-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-height: 210px;
        overflow-y: auto;
        padding-right: 4px;
    }

    .vl-checkbox-list::-webkit-scrollbar {
        width: 4px;
    }
    .vl-checkbox-list::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 4px;
    }

    .vl-checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
        color: var(--slate-body);
        cursor: pointer;
        user-select: none;
        transition: color 0.15s;
    }

    .vl-checkbox-label:hover {
        color: var(--primary-blue);
    }

    .vl-checkbox-label input[type="checkbox"] {
        accent-color: var(--primary-blue);
        width: 15px;
        height: 15px;
        cursor: pointer;
    }

    .vl-more-link {
        display: inline-block;
        font-size: 12.5px;
        font-weight: 700;
        color: var(--primary-blue);
        cursor: pointer;
        margin-top: 6px;
        text-decoration: none;
    }
    .vl-more-link:hover {
        text-decoration: underline;
    }

    .vl-stars-row {
        display: flex;
        align-items: center;
        gap: 2px;
        color: #F59E0B;
    }

    .vl-btn-reset-filters {
        width: 100%;
        padding: 9px;
        background: transparent;
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        color: var(--slate-muted);
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 10px;
    }

    .vl-btn-reset-filters:hover {
        background: #F1F5F9;
        color: #DC2626;
        border-color: #FCA5A5;
    }

    /* -------------------------------------------------------------
       Middle Column: Premium Banner & Vendor Cards
    -------------------------------------------------------------- */
    .vl-main-col {
        min-width: 0;
    }

    /* Premium Banner Ad Hero */
    .vl-premium-banner {
        position: relative;
        background: linear-gradient(135deg, #05102A 0%, #0A1B44 40%, #0E2963 100%);
        border-radius: 18px;
        overflow: hidden;
        padding: 24px 28px;
        color: #FFFFFF;
        box-shadow: 0 10px 30px rgba(11, 25, 72, 0.15);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 200px;
    }

    .vl-pb-content {
        position: relative;
        z-index: 2;
        max-width: 60%;
    }

    .vl-pb-badge {
        display: inline-block;
        background: #FFB800;
        color: #0F172A;
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 3px 9px;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .vl-pb-title {
        font-size: 24px;
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 4px;
        color: #FFFFFF;
    }

    .vl-pb-subtitle {
        font-size: 13.5px;
        color: #94A3B8;
        margin-bottom: 16px;
    }

    .vl-pb-features {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .vl-pb-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 600;
        color: #E2E8F0;
    }

    .vl-pb-pill-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(0, 75, 238, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #60A5FA;
        font-size: 11px;
    }

    .vl-pb-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FFB800;
        color: #0F172A !important;
        font-size: 13px;
        font-weight: 800;
        padding: 9px 20px;
        border-radius: 30px;
        text-decoration: none;
        transition: transform 0.2s, background 0.2s;
        box-shadow: 0 4px 14px rgba(255, 184, 0, 0.35);
    }

    .vl-pb-btn:hover {
        transform: translateY(-1px);
        background: #E5A600;
    }

    .vl-pb-visual {
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 46%;
        z-index: 1;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .vl-pb-visual img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        mask-image: linear-gradient(to right, transparent 0%, black 40%);
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 40%);
    }

    .vl-pb-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.85);
        color: #0F172A;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 5;
        transition: background 0.2s;
    }
    .vl-pb-arrow:hover {
        background: #FFFFFF;
    }
    .vl-pb-arrow.left { left: 10px; }
    .vl-pb-arrow.right { right: 10px; }

    .vl-pb-dots {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
        z-index: 5;
    }

    .vl-pb-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
    }
    .vl-pb-dot.active {
        background: #FFFFFF;
        width: 16px;
        border-radius: 4px;
    }

    /* Listing Header Results Stats */
    .vl-results-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .vl-results-count {
        font-size: 13.5px;
        font-weight: 600;
        color: var(--slate-muted);
    }

    /* -------------------------------------------------------------
       Vendor Cards: List View
    -------------------------------------------------------------- */
    .vl-agents-container {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .vl-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 18px 20px;
        display: flex;
        gap: 20px;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        position: relative;
    }

    .vl-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 75, 238, 0.07);
        border-color: #BFDBFE;
    }

    .vl-card-photo-box {
        width: 106px;
        height: 106px;
        border-radius: 12px;
        background: #0B1948;
        border: 1px solid #1E293B;
        position: relative;
        flex-shrink: 0;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .vl-card-photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vl-card-badge-verified {
        position: absolute;
        top: 6px;
        left: 6px;
        background: #10B981;
        color: #FFFFFF;
        font-size: 9.5px;
        font-weight: 800;
        letter-spacing: 0.4px;
        padding: 2px 6px;
        border-radius: 4px;
        z-index: 2;
        text-transform: uppercase;
    }

    .vl-card-info {
        flex: 1;
        min-width: 0;
    }

    .vl-card-title-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 4px;
    }

    .vl-card-title {
        font-size: 17px;
        font-weight: 800;
        color: var(--slate-dark);
        margin: 0;
        line-height: 1.3;
    }

    .vl-card-title a {
        color: var(--slate-dark);
        text-decoration: none;
        transition: color 0.15s;
    }
    .vl-card-title a:hover {
        color: var(--primary-blue);
    }

    .vl-blue-tick {
        color: #004BEE;
        flex-shrink: 0;
    }

    .vl-card-rating-row {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        font-weight: 700;
        color: var(--slate-dark);
        margin-bottom: 6px;
    }

    .vl-card-rating-num {
        font-weight: 800;
    }

    .vl-card-stars {
        color: #F59E0B;
        display: flex;
        align-items: center;
        gap: 2px;
    }

    .vl-card-reviews {
        color: var(--slate-muted);
        font-weight: 500;
    }

    .vl-card-location {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: var(--slate-muted);
        margin-bottom: 8px;
    }
    .vl-card-location svg {
        color: var(--primary-blue);
        flex-shrink: 0;
    }

    .vl-card-desc {
        font-size: 13px;
        color: var(--slate-body);
        line-height: 1.45;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .vl-card-tags {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .vl-card-tag {
        background: #EFF6FF;
        color: var(--primary-blue);
        border: 1px solid #DBEAFE;
        font-size: 11.5px;
        font-weight: 600;
        padding: 2px 9px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.15s;
    }
    .vl-card-tag:hover {
        background: var(--primary-blue);
        color: #FFFFFF;
        border-color: var(--primary-blue);
    }

    /* Right Action Column on Card */
    .vl-card-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
        gap: 10px;
        flex-shrink: 0;
        min-width: 170px;
    }

    .vl-card-heart-btn {
        background: transparent;
        border: none;
        color: #94A3B8;
        cursor: pointer;
        padding: 4px;
        transition: color 0.15s, transform 0.15s;
    }
    .vl-card-heart-btn:hover {
        color: #EF4444;
        transform: scale(1.15);
    }
    .vl-card-heart-btn.is-saved {
        color: #EF4444;
    }

    .vl-card-phone {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--slate-dark);
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .vl-card-phone svg {
        color: var(--primary-blue);
    }

    .vl-card-btn-call {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 7px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        background: #EFF6FF;
        color: var(--primary-blue) !important;
        border: 1px solid #BFDBFE;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .vl-card-btn-call:hover {
        background: var(--primary-blue);
        color: #FFFFFF !important;
        border-color: var(--primary-blue);
    }

    .vl-card-btn-wa {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 7px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        background: #F0FDF4;
        color: #16A34A !important;
        border: 1px solid #BBF7D0;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .vl-card-btn-wa:hover {
        background: #16A34A;
        color: #FFFFFF !important;
        border-color: #16A34A;
    }

    .vl-card-view-details {
        font-size: 12.5px;
        font-weight: 700;
        color: var(--primary-blue);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: gap 0.2s;
    }
    .vl-card-view-details:hover {
        gap: 7px;
    }

    /* -------------------------------------------------------------
       Grid View Layout Mode
    -------------------------------------------------------------- */
    .vl-agents-container.is-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    @media (max-width: 640px) {
        .vl-agents-container.is-grid {
            grid-template-columns: 1fr;
        }
    }

    .vl-agents-container.is-grid .vl-card {
        flex-direction: column;
        align-items: stretch;
        text-align: left;
    }

    .vl-agents-container.is-grid .vl-card-photo-box {
        width: 100%;
        height: 140px;
    }

    .vl-agents-container.is-grid .vl-card-actions {
        width: 100%;
        align-items: stretch;
        border-top: 1px solid #F1F5F9;
        padding-top: 12px;
    }

    /* -------------------------------------------------------------
       Right Column: Visiting Card Ad Space
    -------------------------------------------------------------- */
    .vl-visiting-card-container {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 18px 16px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02);
    }

    .vl-visiting-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
        padding-bottom: 10px;
        border-bottom: 1px solid #F1F5F9;
        gap: 8px;
    }

    .vl-visiting-title-wrap {
        display: flex;
        align-items: baseline;
        gap: 8px;
    }

    .vl-visiting-title {
        font-size: 14px;
        font-weight: 800;
        color: #0F172A;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin: 0;
    }

    .vl-visiting-slots {
        font-size: 11.5px;
        font-weight: 600;
        color: var(--slate-muted);
    }

    .vl-vc-slider-controls {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .vl-vc-nav-btn {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        color: #0F172A;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        padding: 0;
    }

    .vl-vc-nav-btn:hover {
        background: #004BEE;
        border-color: #004BEE;
        color: #FFFFFF;
    }

    .vl-vc-slider-wrapper {
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .vl-vc-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        max-height: 480px;
        overflow-y: auto;
        scroll-behavior: smooth;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .vl-vc-list::-webkit-scrollbar {
        display: none;
    }

    .vl-vc-item {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 12px 14px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        position: relative;
        overflow: hidden;
        display: flex;
        gap: 12px;
        align-items: center;
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        text-decoration: none;
    }

    .vl-vc-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        border-color: #BFDBFE;
    }

    /* Diagonal Ribbon Fold on top-right */
    .vl-vc-ribbon {
        position: absolute;
        top: 0;
        right: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 38px 38px 0;
        border-color: transparent var(--ribbon-bg, #F59E0B) transparent transparent;
        z-index: 2;
    }

    .vl-vc-logo {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        background: #0B1948;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
        flex-shrink: 0;
        overflow: hidden;
        border: 1px solid #1E293B;
    }

    .vl-vc-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vl-vc-info {
        flex: 1;
        min-width: 0;
    }

    .vl-vc-name {
        font-size: 13.5px;
        font-weight: 800;
        color: var(--slate-dark);
        margin-bottom: 2px;
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .vl-vc-role {
        font-size: 11.5px;
        color: var(--slate-muted);
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .vl-vc-meta {
        font-size: 11.5px;
        color: var(--slate-body);
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 2px;
        font-weight: 600;
    }
    .vl-vc-meta svg {
        color: var(--primary-blue);
        flex-shrink: 0;
    }

    .vl-vc-location {
        font-size: 11px;
        color: var(--slate-muted);
        display: flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .vl-vc-location svg {
        color: var(--primary-blue);
        flex-shrink: 0;
    }

    .vl-vc-view-all {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid #F1F5F9;
        font-size: 13px;
        font-weight: 700;
        color: var(--primary-blue);
        text-decoration: none;
        transition: gap 0.2s;
    }
    .vl-vc-view-all:hover {
        gap: 9px;
    }

    /* -------------------------------------------------------------
       Clean Pagination Styles (< 1 2 3 ... 13 >)
    -------------------------------------------------------------- */
    .vl-pagination-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 28px;
        gap: 6px;
    }

    .vl-page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 8px;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--slate-dark);
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        text-decoration: none;
        transition: all 0.2s;
    }

    .vl-page-link:hover {
        border-color: var(--primary-blue);
        color: var(--primary-blue);
    }

    .vl-page-link.active {
        background: var(--primary-blue);
        color: #FFFFFF;
        border-color: var(--primary-blue);
        box-shadow: 0 3px 10px rgba(0, 75, 238, 0.25);
    }

    .vl-page-link.disabled {
        opacity: 0.5;
        pointer-events: none;
        background: #F8FAFC;
    }

    /* Empty state */
    .vl-empty-card {
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 60px 24px;
        text-align: center;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02);
    }

    .vl-empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #EFF6FF;
        color: var(--primary-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px auto;
    }

    /* =============================================================
       COMPREHENSIVE MOBILE RESPONSIVE SUITE FOR VENDORLIST PAGE
    ============================================================== */
    
    /* Backdrop Overlay for Filter Drawer on Mobile */
    .vl-filter-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        z-index: 9998;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .vl-filter-backdrop.is-active {
        display: block;
        opacity: 1;
    }

    .vl-filter-close-btn {
        display: none;
        background: #F1F5F9;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        color: #475569;
        font-size: 20px;
        line-height: 1;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .vl-filter-close-btn:hover {
        background: #E2E8F0;
        color: #0F172A;
    }

    .vl-filter-drawer-footer {
        display: none;
        position: sticky;
        bottom: 0;
        left: 0;
        right: 0;
        background: #FFFFFF;
        padding: 12px 16px;
        border-top: 1px solid #E2E8F0;
        box-shadow: 0 -4px 14px rgba(0, 0, 0, 0.05);
        gap: 10px;
        z-index: 10;
    }

    @media (min-width: 769px) {
        .vl-card {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 20px;
        }
        .vl-card-header-top {
            display: contents;
        }
        .vl-card-body-content {
            display: contents;
        }
    }

    @media (max-width: 991px) {
        .vl-3col-grid {
            display: flex !important;
            flex-direction: column !important;
            gap: 16px !important;
        }

        /* Filter Offcanvas Drawer */
        .vl-filter-sidebar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            bottom: 0 !important;
            width: 88% !important;
            max-width: 340px !important;
            height: 100vh !important;
            background: #FFFFFF !important;
            z-index: 9999 !important;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.25) !important;
            transform: translateX(-100%) !important;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
            overflow-y: auto !important;
            display: block !important;
            padding: 0 !important;
        }
        .vl-filter-sidebar.is-open {
            transform: translateX(0) !important;
        }
        .vl-filter-card {
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            padding: 18px 16px 80px 16px !important;
            background: #FFFFFF !important;
        }
        .vl-filter-close-btn {
            display: flex !important;
        }
        .vl-filter-drawer-footer {
            display: flex !important;
        }
        .vl-drawer-apply-btn {
            flex: 1;
            height: 40px;
            background: #004BEE;
            color: #FFFFFF;
            font-size: 13.5px;
            font-weight: 700;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
        .vl-drawer-reset-btn {
            padding: 0 14px;
            height: 40px;
            background: #F1F5F9;
            color: #475569;
            font-size: 13px;
            font-weight: 700;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            cursor: pointer;
        }

        /* Right column on tablet / mobile */
        .vl-visiting-sidebar {
            order: 3 !important;
            width: 100% !important;
            margin-top: 10px !important;
        }
        .vl-visiting-card {
            width: 100% !important;
            max-width: 100% !important;
        }
    }

    @media (max-width: 768px) {
        .vendorlist-page {
            padding-bottom: 40px !important;
        }

        /* Hide Top Sticky Filter Bar on mobile since we have in-page mobile filter bar */
        .vl-top-filter-bar {
            display: none !important;
        }

        /* Layout wrapper */
        .vl-layout-wrap {
            padding: 0 14px !important;
            margin-top: 14px !important;
        }

        /* =========================================================
           1. Top Premium Banner Ad (Matches Screenshot)
        ========================================================= */
        .vl-premium-banner {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            text-align: center !important;
            padding: 22px 16px 18px 16px !important;
            border-radius: 18px !important;
            margin-bottom: 18px !important;
            min-height: auto !important;
            background: #0B1736 !important;
            box-shadow: 0 6px 20px rgba(11, 23, 54, 0.2) !important;
            position: relative !important;
            overflow: hidden !important;
        }
        .vl-pb-content {
            max-width: 100% !important;
            width: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            text-align: center !important;
        }
        .vl-pb-badge {
            display: inline-block !important;
            background: #F1B434 !important;
            color: #0B1736 !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            padding: 4px 12px !important;
            border-radius: 6px !important;
            margin-bottom: 10px !important;
            letter-spacing: 0.4px !important;
            text-transform: uppercase !important;
        }
        .vl-pb-title {
            font-size: 19px !important;
            font-weight: 800 !important;
            color: #FFFFFF !important;
            line-height: 1.25 !important;
            margin: 0 0 5px 0 !important;
            text-align: center !important;
        }
        .vl-pb-subtitle {
            font-size: 13.5px !important;
            font-weight: 700 !important;
            color: #F1B434 !important;
            margin: 0 0 16px 0 !important;
            text-align: center !important;
        }
        .vl-pb-features-row {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
            margin-bottom: 14px !important;
            position: relative !important;
            padding: 0 2px !important;
        }
        .vl-pb-nav-btn {
            width: 28px !important;
            height: 28px !important;
            min-width: 28px !important;
            border-radius: 50% !important;
            background: #FFFFFF !important;
            color: #0B1736 !important;
            border: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 11px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
            cursor: pointer !important;
            z-index: 3 !important;
        }
        .vl-pb-feature-item {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            text-align: center !important;
            padding: 0 2px !important;
        }
        .vl-pb-circle-icon {
            width: 44px !important;
            height: 44px !important;
            border-radius: 50% !important;
            background: #1B4BD8 !important;
            color: #FFFFFF !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 16px !important;
            margin-bottom: 6px !important;
            box-shadow: 0 3px 8px rgba(27, 75, 216, 0.35) !important;
        }
        .vl-pb-feature-label {
            font-size: 10px !important;
            font-weight: 700 !important;
            color: #FFFFFF !important;
            line-height: 1.2 !important;
            text-align: center !important;
        }
        .vl-pb-carousel-dots {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            margin-bottom: 16px !important;
        }
        .vl-pb-dot {
            width: 7px !important;
            height: 7px !important;
            border-radius: 50% !important;
            border: 1.5px solid rgba(255, 255, 255, 0.7) !important;
            background: transparent !important;
            display: inline-block !important;
        }
        .vl-pb-dot.active {
            background: #FFFFFF !important;
            border-color: #FFFFFF !important;
        }
        .vl-pb-cta-btn {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: #F1B434 !important;
            color: #0B1736 !important;
            font-size: 14.5px !important;
            font-weight: 800 !important;
            height: 44px !important;
            border-radius: 10px !important;
            width: 100% !important;
            text-decoration: none !important;
            border: none !important;
            box-shadow: 0 3px 10px rgba(241, 180, 52, 0.3) !important;
        }
        .vl-pb-visual,
        .vl-pb-arrow,
        .vl-pb-dots {
            display: none !important;
        }

        /* =========================================================
           2. Listing Title & Hindi Subtitle
        ========================================================= */
        .vl-listing-header {
            margin: 4px 0 12px 0 !important;
        }
        .vl-listing-title {
            font-size: 22px !important;
            font-weight: 800 !important;
            color: #0F172A !important;
            margin: 0 0 4px 0 !important;
            line-height: 1.25 !important;
        }
        .vl-title-city {
            color: #004BEE !important;
        }
        .vl-listing-subtitle {
            font-size: 13.5px !important;
            color: #475569 !important;
            font-weight: 500 !important;
            margin: 0 !important;
            line-height: 1.4 !important;
        }

        /* =========================================================
           3. In-page Mobile Filter & Sort Bar
        ========================================================= */
        .vl-mobile-filter-bar {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 10px !important;
            margin-bottom: 14px !important;
            margin-top: 10px !important;
        }
        .vl-mobile-filter-btn {
            background: #FFFFFF !important;
            border: 1.5px solid #E2E8F0 !important;
            border-radius: 10px !important;
            padding: 7px 14px !important;
            font-size: 13.5px !important;
            font-weight: 700 !important;
            color: #0F172A !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            height: 38px !important;
            cursor: pointer !important;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.02) !important;
        }
        .vl-mobile-sort-wrap {
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        .vl-mobile-sort-wrap label {
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #0F172A !important;
            margin: 0 !important;
        }
        .vl-mobile-sort-select {
            background: #FFFFFF !important;
            border: 1.5px solid #E2E8F0 !important;
            border-radius: 10px !important;
            padding: 6px 12px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #0F172A !important;
            height: 38px !important;
            outline: none !important;
            cursor: pointer !important;
        }
        .vl-results-meta {
            display: none !important;
        }

        /* =========================================================
           4. Vendor Card (Mobile Layout Matching Screenshot)
        ========================================================= */
        .vl-agents-container {
            gap: 14px !important;
        }
        .vl-card {
            display: flex !important;
            flex-direction: column !important;
            align-items: stretch !important;
            padding: 14px !important;
            border-radius: 16px !important;
            gap: 0 !important;
            background: #FFFFFF !important;
            border: 1.5px solid #E5E7EB !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03) !important;
            position: relative !important;
        }
        .vl-card-header-top {
            display: flex !important;
            align-items: flex-start !important;
            gap: 14px !important;
            width: 100% !important;
            position: relative !important;
        }
        .vl-card-photo-box {
            width: 90px !important;
            height: 90px !important;
            min-width: 90px !important;
            border-radius: 12px !important;
            background: #0A1128 !important;
            position: relative !important;
            overflow: hidden !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: 1px solid #E2E8F0 !important;
        }
        .vl-card-photo-box img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
        }
        .vl-card-badge-verified {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            background: #16A34A !important;
            color: #FFFFFF !important;
            font-size: 8px !important;
            font-weight: 800 !important;
            padding: 2px 6px !important;
            border-top-left-radius: 10px !important;
            border-bottom-right-radius: 6px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 2px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.3px !important;
            z-index: 2 !important;
        }
        .vl-card-info {
            flex: 1 !important;
            min-width: 0 !important;
            padding-right: 28px !important;
        }
        .vl-card-title-row {
            margin-bottom: 2px !important;
        }
        .vl-card-title {
            font-size: 16px !important;
            font-weight: 800 !important;
            line-height: 1.25 !important;
            color: #0F172A !important;
            margin: 0 !important;
        }
        .vl-card-title a {
            color: #0F172A !important;
            text-decoration: none !important;
        }
        .vl-card-blue-tick-row {
            display: flex !important;
            align-items: center !important;
            margin: 3px 0 !important;
        }
        .vl-blue-tick {
            width: 16px !important;
            height: 16px !important;
        }
        .vl-card-rating-row {
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
            font-size: 12px !important;
            margin-bottom: 3px !important;
            flex-wrap: wrap !important;
        }
        .vl-card-rating-num {
            font-weight: 800 !important;
            color: #0F172A !important;
        }
        .vl-card-stars {
            color: #F59E0B !important;
            font-size: 11px !important;
            display: inline-flex !important;
            gap: 1px !important;
        }
        .vl-card-reviews {
            color: #64748B !important;
            font-size: 11.5px !important;
            font-weight: 500 !important;
        }
        .vl-card-location {
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
            color: #64748B !important;
            font-size: 12px !important;
            font-weight: 500 !important;
            margin-bottom: 0 !important;
        }
        .vl-card-location svg {
            color: #64748B !important;
            stroke: #64748B !important;
            flex-shrink: 0 !important;
        }

        /* Wishlist Heart Button placed at top-right */
        .vl-card-heart-btn {
            position: absolute !important;
            top: 10px !important;
            right: 10px !important;
            width: 32px !important;
            height: 32px !important;
            border-radius: 50% !important;
            background: transparent !important;
            border: none !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            z-index: 5 !important;
            color: #0F172A !important;
        }
        .vl-card-heart-btn svg {
            width: 20px !important;
            height: 20px !important;
            stroke: #0F172A !important;
        }
        .vl-card-heart-btn.is-saved svg {
            fill: #EF4444 !important;
            stroke: #EF4444 !important;
        }

        /* Body Content: Description & Tags */
        .vl-card-body-content {
            display: block !important;
            margin-top: 10px !important;
            width: 100% !important;
        }
        .vl-card-desc {
            font-size: 12.5px !important;
            color: #334155 !important;
            line-height: 1.45 !important;
            margin-bottom: 8px !important;
            font-weight: 500 !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        .vl-card-tags {
            display: flex !important;
            align-items: center !important;
            flex-wrap: wrap !important;
            gap: 6px !important;
            margin-bottom: 0 !important;
        }
        .vl-card-tag {
            background: #EEF4FF !important;
            color: #004BEE !important;
            border: 1px solid #D6E4FF !important;
            border-radius: 6px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            padding: 3px 10px !important;
            text-decoration: none !important;
            display: inline-block !important;
        }

        /* Action Buttons: 2 Equal Outline Buttons side-by-side */
        .vl-card-actions {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 10px !important;
            margin-top: 12px !important;
            padding-top: 12px !important;
            border-top: 1px solid #F1F5F9 !important;
            width: 100% !important;
            align-items: center !important;
        }
        .vl-card-phone,
        .vl-card-view-details {
            display: none !important;
        }
        .vl-card-btn-call {
            background: #FFFFFF !important;
            border: 1.5px solid #004BEE !important;
            color: #004BEE !important;
            height: 42px !important;
            border-radius: 10px !important;
            font-size: 13.5px !important;
            font-weight: 700 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            text-decoration: none !important;
            box-shadow: none !important;
        }
        .vl-card-btn-call svg {
            stroke: #004BEE !important;
        }
        .vl-card-btn-wa {
            background: #FFFFFF !important;
            border: 1.5px solid #16A34A !important;
            color: #16A34A !important;
            height: 42px !important;
            border-radius: 10px !important;
            font-size: 13.5px !important;
            font-weight: 700 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            text-decoration: none !important;
            box-shadow: none !important;
        }

        /* Right Column / Area Agent Visiting Card Slider on Mobile */
        .vl-right-col,
        .vl-visiting-sidebar {
            width: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            margin-top: 18px !important;
        }
        .vl-visiting-card-container {
            border-radius: 16px !important;
            padding: 16px 14px !important;
            background: #FFFFFF !important;
            border: 1.5px solid #E5E7EB !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03) !important;
        }
        .vl-vc-slider-wrapper {
            overflow: visible !important;
            width: 100% !important;
        }
        .vl-vc-list {
            display: flex !important;
            flex-direction: row !important;
            gap: 12px !important;
            max-height: none !important;
            overflow-x: auto !important;
            overflow-y: hidden !important;
            scroll-snap-type: x mandatory !important;
            scroll-behavior: smooth !important;
            -webkit-overflow-scrolling: touch !important;
            scrollbar-width: none !important;
            padding: 4px 2px 8px 2px !important;
        }
        .vl-vc-list::-webkit-scrollbar {
            display: none !important;
        }
        .vl-vc-item {
            width: 265px !important;
            min-width: 265px !important;
            max-width: 265px !important;
            scroll-snap-align: start !important;
            flex-shrink: 0 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04) !important;
        }

        /* Pagination */
        .vl-pagination-wrap {
            margin-top: 18px !important;
            gap: 4px !important;
            flex-wrap: wrap !important;
        }
        .vl-page-link {
            min-width: 32px !important;
            height: 32px !important;
            font-size: 12px !important;
            padding: 0 6px !important;
            border-radius: 6px !important;
        }
        body.overflow-hidden {
            overflow: hidden !important;
        }
    }
</style>
@endpush

@section('content')
<div class="vendorlist-page">

    <!-- Secondary Filter Bar Below Header -->
    <div class="vl-top-filter-bar">
        <div class="vl-filter-bar-container">
            
            <div class="vl-filter-bar-left">
                <!-- Mobile / Quick Filter Toggle -->
                <button type="button" class="vl-filter-toggle-btn" id="vlSidebarToggle">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="21" x2="4" y2="14"></line>
                        <line x1="4" y1="10" x2="4" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12" y2="3"></line>
                        <line x1="20" y1="21" x2="20" y2="16"></line>
                        <line x1="20" y1="12" x2="20" y2="3"></line>
                        <line x1="1" y1="14" x2="7" y2="14"></line>
                        <line x1="9" y1="8" x2="15" y2="8"></line>
                        <line x1="17" y1="16" x2="23" y2="16"></line>
                    </svg>
                    <span>Filters</span>
                </button>

                <!-- Category Capsule -->
                <div class="vl-dropdown-capsule">
                    <label>Category:</label>
                    <select id="topBarCategorySelect">
                        <option value="">All Categories</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}" {{ (isset($selectedCategory) && $selectedCategory == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Services Capsule -->
                <div class="vl-dropdown-capsule">
                    <label>Services:</label>
                    <select id="topBarServiceSelect">
                        <option value="">All Services</option>
                        @foreach($categoryServices as $srv)
                            <option value="{{ $srv->id }}" {{ (isset($selectedService) && $selectedService == $srv->id) ? 'selected' : '' }}>
                                {{ $srv->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Area Capsule -->
                <div class="vl-dropdown-capsule">
                    <label>Area:</label>
                    <select id="topBarAreaSelect">
                        <option value="all">All Areas</option>
                        @foreach($popularAreas as $pa)
                            @php
                                $paVal = $pa['type'] === 'city' ? ($pa['id'] ?? $pa['name']) : $pa['name'];
                                $isPaSelected = ($selectedArea == $pa['name']) || ($selectedCityId == ($pa['id'] ?? ''));
                            @endphp
                            <option value="{{ $paVal }}" data-type="{{ $pa['type'] }}" {{ $isPaSelected ? 'selected' : '' }}>
                                {{ $pa['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="vl-filter-bar-right">
                <!-- Sort By Dropdown -->
                <div class="vl-sort-group">
                    <label>Sort By:</label>
                    <select id="topBarSortSelect">
                        <option value="recommended" {{ $sortBy == 'recommended' ? 'selected' : '' }}>Recommended</option>
                        <option value="rating" {{ $sortBy == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                        <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>

                <!-- List / Grid View Switcher -->
                <div class="vl-view-toggle">
                    <button type="button" class="vl-view-btn active" id="viewListBtn" title="List View">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                    </button>
                    <button type="button" class="vl-view-btn" id="viewGridBtn" title="Grid View">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Filter Backdrop Overlay for Mobile -->
    <div class="vl-filter-backdrop" id="vlFilterBackdrop"></div>

    <!-- Main 3-Column Content Layout -->
    <div class="vl-layout-wrap">
        <div class="vl-3col-grid">

            <!-- -------------------------------------------------------------
                 Left Column: Filter Sidebar
            -------------------------------------------------------------- -->
            <aside class="vl-filter-sidebar" id="vlFilterSidebar">
                <div class="vl-filter-card">
                    
                    <div class="vl-filter-header">
                        <h3 class="vl-filter-title">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#004BEE" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                <line x1="17" y1="16" x2="23" y2="16"></line>
                            </svg>
                            <span>Filters</span>
                        </h3>
                        <button type="button" class="vl-filter-close-btn" id="vlFilterCloseBtn" aria-label="Close Filters">
                            &times;
                        </button>
                    </div>

                    <!-- Category Filter -->
                    <div class="vl-filter-block">
                        <div class="vl-block-label">Category</div>
                        <select id="sidebarCategorySelect" class="vl-block-select">
                            <option value="">Select Category</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}" {{ (isset($selectedCategory) && $selectedCategory == $cat->id) ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Services (Subcategories) Filter -->
                    <div class="vl-filter-block">
                        <div class="vl-block-label">Services</div>
                        <div class="vl-checkbox-list" id="servicesCheckboxList">
                            @forelse($categoryServices as $idx => $srv)
                                <label class="vl-checkbox-label">
                                    <input type="checkbox" name="services" value="{{ $srv->id }}" {{ (isset($selectedServices) && in_array($srv->id, $selectedServices)) ? 'checked' : '' }}>
                                    <span>{{ $srv->name }}</span>
                                </label>
                            @empty
                                <div style="font-size:12.5px; color:#94A3B8;">No services listed</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Area Filter with Live Search -->
                    <div class="vl-filter-block">
                        <div class="vl-block-label">
                            <span>Area in {{ $selectedDistrict->name ?? 'Jaipur' }}</span>
                        </div>
                        <div class="vl-search-mini">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <input type="text" id="areaSearchInput" placeholder="Search Area..." autocomplete="off">
                        </div>
                        <div class="vl-checkbox-list" id="areaCheckboxList">
                            @foreach($popularAreas as $idx => $pa)
                                @php
                                    $isPaChecked = false;
                                    if ($pa['type'] === 'city') {
                                        $isPaChecked = in_array((string)($pa['id'] ?? ''), array_map('strval', $selectedCityIds ?? [])) || in_array($pa['name'], $selectedAreas ?? []);
                                    } else {
                                        $isPaChecked = in_array($pa['name'], $selectedAreas ?? []);
                                    }
                                @endphp
                                <label class="vl-checkbox-label area-item {{ $idx >= 5 ? 'area-extra' : '' }}" style="{{ $idx >= 5 ? 'display:none;' : '' }}" data-name="{{ strtolower($pa['name']) }}">
                                    <input type="checkbox" name="areas" value="{{ $pa['name'] }}" data-type="{{ $pa['type'] }}" data-id="{{ $pa['id'] ?? '' }}" {{ $isPaChecked ? 'checked' : '' }}>
                                    <span>{{ $pa['name'] }}</span>
                                </label>
                            @endforeach
                        </div>
                        @if(count($popularAreas) > 5)
                            <a href="javascript:void(0)" class="vl-more-link" id="toggleMoreAreas">Show More +</a>
                        @endif
                    </div>

                    <!-- Rating Filter -->
                    <div class="vl-filter-block">
                        <div class="vl-block-label">Rating</div>
                        <div class="vl-checkbox-list">
                            <label class="vl-checkbox-label">
                                <input type="checkbox" name="rating" value="4.5" {{ $selectedRating == '4.5' ? 'checked' : '' }}>
                                <span class="vl-stars-row">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                </span>
                                <span>4.5 & above</span>
                            </label>
                            <label class="vl-checkbox-label">
                                <input type="checkbox" name="rating" value="4.0" {{ $selectedRating == '4.0' ? 'checked' : '' }}>
                                <span class="vl-stars-row">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                                <span>4.0 & above</span>
                            </label>
                            <label class="vl-checkbox-label">
                                <input type="checkbox" name="rating" value="3.5" {{ $selectedRating == '3.5' ? 'checked' : '' }}>
                                <span class="vl-stars-row">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                                <span>3.5 & above</span>
                            </label>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    <button type="button" class="vl-btn-reset-filters" id="btnResetFilters">
                        Reset Filters
                    </button>

                </div>

                <!-- Sticky Mobile Drawer Footer -->
                <div class="vl-filter-drawer-footer">
                    <button type="button" class="vl-drawer-reset-btn" id="btnDrawerReset">Reset</button>
                    <button type="button" class="vl-drawer-apply-btn" id="btnDrawerApply">Apply Filters</button>
                </div>
            </aside>

            <!-- -------------------------------------------------------------
                 Middle Column: Main Content (Premium Banner + Vendor Cards)
            -------------------------------------------------------------- -->
            <main class="vl-main-col">

                <!-- Top Premium Banner Carousel -->
                <!-- Top Premium Banner Carousel (Matches Screenshot) -->
                <div class="vl-premium-banner">
                    <span class="vl-pb-badge">PREMIUM BANNER AD</span>
                    <h2 class="vl-pb-title">Grow Your {{ $selectedCategoryObj ? $selectedCategoryObj->name : 'Real Estate' }} Business</h2>
                    <div class="vl-pb-subtitle">Advertise with Premium Banner Ad</div>

                    <div class="vl-pb-features-row">
                        <button type="button" class="vl-pb-nav-btn prev" aria-label="Previous">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <div class="vl-pb-feature-item">
                            <div class="vl-pb-circle-icon"><i class="fa-solid fa-eye"></i></div>
                            <span class="vl-pb-feature-label">High<br>Visibility</span>
                        </div>
                        <div class="vl-pb-feature-item">
                            <div class="vl-pb-circle-icon"><i class="fa-solid fa-users"></i></div>
                            <span class="vl-pb-feature-label">Targeted<br>Audience</span>
                        </div>
                        <div class="vl-pb-feature-item">
                            <div class="vl-pb-circle-icon"><i class="fa-solid fa-briefcase"></i></div>
                            <span class="vl-pb-feature-label">City<br>Wise Reach</span>
                        </div>
                        <div class="vl-pb-feature-item">
                            <div class="vl-pb-circle-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                            <span class="vl-pb-feature-label">Boost<br>Your Business</span>
                        </div>

                        <button type="button" class="vl-pb-nav-btn next" aria-label="Next">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>

                    <!-- 5 Dots -->
                    <div class="vl-pb-carousel-dots">
                        <span class="vl-pb-dot active"></span>
                        <span class="vl-pb-dot"></span>
                        <span class="vl-pb-dot"></span>
                        <span class="vl-pb-dot"></span>
                        <span class="vl-pb-dot"></span>
                    </div>

                    <a href="{{ route('front.addbanner') }}" class="vl-pb-cta-btn">
                        Book Banner Ad
                    </a>
                </div>

                <!-- Listing Header Section (Matches Screenshot) -->
                <div class="vl-listing-header">
                    <h1 class="vl-listing-title">
                        {{ $selectedCategoryObj ? $selectedCategoryObj->name : 'Real Estate' }} Agent in <span class="vl-title-city">{{ $selectedDistrict ? $selectedDistrict->name : 'Jaipur' }}</span>
                    </h1>
                    <p class="vl-listing-subtitle">
                        {{ $selectedDistrict ? $selectedDistrict->name : 'Jaipur' }} में कुल {{ $vendoruser->total() }} Verified {{ $selectedCategoryObj ? $selectedCategoryObj->name : 'Real Estate' }} Agents उपलब्ध हैं।
                    </p>
                </div>

                <!-- In-page Filter & Sort Controls for Mobile (Matches Screenshot) -->
                <div class="vl-mobile-filter-bar">
                    <button type="button" class="vl-mobile-filter-btn" id="vlMobileFilterTrigger">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="6" x2="20" y2="6"></line>
                            <line x1="4" y1="12" x2="14" y2="12"></line>
                            <line x1="4" y1="18" x2="8" y2="18"></line>
                        </svg>
                        <span>फ़िल्टर करें</span>
                    </button>
                    <div class="vl-mobile-sort-wrap">
                        <label>Sort By:</label>
                        <select class="vl-mobile-sort-select" id="mobileSortSelect">
                            <option value="recommended" {{ $sortBy == 'recommended' ? 'selected' : '' }}>Recommended</option>
                            <option value="rating" {{ $sortBy == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                            <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Newest</option>
                        </select>
                    </div>
                </div>

                <!-- Vendor Cards Container (Supports List View & Grid View) -->
                <div class="vl-agents-container" id="vlAgentsContainer">
                    @forelse($vendoruser as $vendor)
                        @php
                            $cleanMobile = !empty($vendor->mobile) ? preg_replace('/[^0-9+]/', '', $vendor->mobile) : '';
                            $waNum = '';
                            if (!empty($vendor->whats_app)) {
                                $waNum = preg_replace('/[^0-9]/', '', $vendor->whats_app);
                                if (strlen($waNum) == 10) {
                                    $waNum = '91' . $waNum;
                                }
                            } elseif (!empty($cleanMobile)) {
                                $waNum = preg_replace('/[^0-9]/', '', $cleanMobile);
                                if (strlen($waNum) == 10) {
                                    $waNum = '91' . $waNum;
                                }
                            }

                            $businessName = $vendor->business_name ?: $vendor->name;
                            $addressText = $vendor->business_address ?: ($selectedDistrict ? $selectedDistrict->name . ', Rajasthan' : 'Jaipur, Rajasthan');
                            $vendorPhoto = !empty($vendor->profile_photo) ? $vendor->profile_photo_url : asset('images/images.png');
                        @endphp

                        <div class="vl-card" data-id="{{ $vendor->id }}">
                            
                            <!-- Header Top: Photo + Info Details -->
                            <div class="vl-card-header-top">
                                <!-- Left: Logo / Photo with Verified Badge -->
                                <div class="vl-card-photo-box">
                                    <span class="vl-card-badge-verified">
                                        <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        VERIFIED
                                    </span>
                                    <img src="{{ $vendorPhoto }}" alt="{{ $businessName }}" onerror="this.onerror=null; this.src='{{ asset('images/images.png') }}';">
                                </div>

                                <!-- Info Details -->
                                <div class="vl-card-info">
                                    <div class="vl-card-title-row">
                                        <h3 class="vl-card-title">
                                            <a href="{{ route('front.vendor.details', ['vendor' => $vendor->id]) }}">
                                                {{ $businessName }}
                                            </a>
                                        </h3>
                                    </div>

                                    <!-- Blue Verified Checkmark Icon -->
                                    <div class="vl-card-blue-tick-row">
                                        <svg class="vl-blue-tick" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <circle cx="12" cy="12" r="10" fill="#004BEE"/>
                                            <path d="M8 12l2.5 2.5L16 9" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>

                                    <!-- Star Rating -->
                                    <div class="vl-card-rating-row">
                                        <span class="vl-card-rating-num">{{ $vendor->calc_rating ?? '4.8' }}</span>
                                        <span class="vl-card-stars">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                        <span class="vl-card-reviews">({{ $vendor->calc_reviews ?? '128' }} Reviews)</span>
                                    </div>

                                    <!-- Location -->
                                    <div class="vl-card-location">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span>{{ $addressText }}</span>
                                    </div>
                                </div>

                                <!-- Wishlist Heart Button placed at top-right -->
                                <button type="button" class="vl-card-heart-btn" title="Save to Favorites" data-id="{{ $vendor->id }}">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Body Content: Description & Tags -->
                            <div class="vl-card-body-content">
                                <!-- Description / Tagline -->
                                <div class="vl-card-desc">
                                    @if(!empty($vendor->description))
                                        {{ $vendor->description }}
                                    @else
                                        हम Buy, Sell, Rent और Commercial Properties में बेहतर सुविधा और मार्गदर्शन प्रदान करते हैं।
                                    @endif
                                </div>

                                <!-- Service Chips -->
                                <div class="vl-card-tags">
                                    @foreach(($vendor->service_tags ?? ['Buy', 'Sell', 'Rent']) as $tag)
                                        <a href="javascript:void(0)" class="vl-card-tag">{{ $tag }}</a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Right / Bottom: Actions & Contact -->
                            <div class="vl-card-actions">
                                @if(!empty($cleanMobile))
                                    <div class="vl-card-phone">
                                        <span>+91 {{ substr($cleanMobile, -10, 5) }} {{ substr($cleanMobile, -5) }}</span>
                                    </div>
                                    <a href="tel:{{ $cleanMobile }}" class="vl-card-btn-call" onclick="if(!/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)){ event.preventDefault(); alert('Phone: +91 {{ $cleanMobile }}'); }">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                        <span>Call Now</span>
                                    </a>
                                @else
                                    <a href="tel:919876543210" class="vl-card-btn-call">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                        <span>Call Now</span>
                                    </a>
                                @endif

                                @if(!empty($waNum))
                                    <a href="https://wa.me/{{ $waNum }}?text={{ urlencode('Hello, I saw your profile on Agent 24 India and would like to inquire about your services.') }}" target="_blank" class="vl-card-btn-wa">
                                        <i class="fa-brands fa-whatsapp" style="font-size:16px;"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                @else
                                    <a href="https://wa.me/919876543210" target="_blank" class="vl-card-btn-wa">
                                        <i class="fa-brands fa-whatsapp" style="font-size:16px;"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                @endif

                                <a href="{{ route('front.vendor.details', ['vendor' => $vendor->id]) }}" class="vl-card-view-details">
                                    <span>View Details</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    @empty
                        <div class="vl-empty-card">
                            <div class="vl-empty-icon">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                            <h3 style="font-size: 20px; font-weight: 800; color: #0F172A; margin-bottom: 6px;">No Verified Agents Found</h3>
                            <p style="font-size: 14.5px; color: #64748B; margin-bottom: 20px;">Try adjusting your selected filters or choosing another category or area.</p>
                            <a href="{{ route('front.vendorlist') }}" class="vl-pb-btn" style="background:#004BEE; color:#fff !important;">Clear Filters</a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Matching Mockup (< 1 2 3 ... 13 >) -->
                @if($vendoruser->hasPages())
                    <div class="vl-pagination-wrap">
                        {{-- Previous Page Link --}}
                        @if ($vendoruser->onFirstPage())
                            <span class="vl-page-link disabled">&lt;</span>
                        @else
                            <a href="{{ $vendoruser->previousPageUrl() }}" class="vl-page-link" rel="prev">&lt;</a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($vendoruser->getUrlRange(1, $vendoruser->lastPage()) as $page => $url)
                            @if ($page == $vendoruser->currentPage())
                                <span class="vl-page-link active">{{ $page }}</span>
                            @elseif ($page <= 3 || $page >= $vendoruser->lastPage() - 1 || abs($page - $vendoruser->currentPage()) <= 1)
                                <a href="{{ $url }}" class="vl-page-link">{{ $page }}</a>
                            @elseif ($page == 4 && $vendoruser->currentPage() > 4)
                                <span class="vl-page-link disabled">...</span>
                            @elseif ($page == $vendoruser->lastPage() - 2 && $vendoruser->currentPage() < $vendoruser->lastPage() - 3)
                                <span class="vl-page-link disabled">...</span>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($vendoruser->hasMorePages())
                            <a href="{{ $vendoruser->nextPageUrl() }}" class="vl-page-link" rel="next">&gt;</a>
                        @else
                            <span class="vl-page-link disabled">&gt;</span>
                        @endif
                    </div>
                @endif

            </main>

            <!-- -------------------------------------------------------------
                 Right Column: Visiting Card Ad Space (Slider)
            -------------------------------------------------------------- -->
            <aside class="vl-visiting-sidebar">
                <div class="vl-visiting-card-container">
                    
                    <div class="vl-visiting-header">
                        <div class="vl-visiting-title-wrap">
                            <h4 class="vl-visiting-title">AREA AGENT</h4>
                            <span class="vl-visiting-slots">10 Slots Available</span>
                        </div>
                        <div class="vl-vc-slider-controls">
                            <button type="button" class="vl-vc-nav-btn prev" id="vcPrevBtn" aria-label="Previous Area Agent">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </button>
                            <button type="button" class="vl-vc-nav-btn next" id="vcNextBtn" aria-label="Next Area Agent">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="vl-vc-slider-wrapper">
                        <div class="vl-vc-list" id="vcSliderTrack">
                            @foreach($visitingCards as $vc)
                                @php
                                    $vcName = $vc->business_name ?: $vc->name;
                                    $cleanVcMobile = !empty($vc->mobile) ? preg_replace('/[^0-9]/', '', $vc->mobile) : '9827654321';
                                    $vcMobile = '+91 ' . $cleanVcMobile;
                                    $vcAddress = $vc->business_address ?: ($selectedDistrict ? $selectedDistrict->name . ', Jaipur' : 'Vaishali Nagar, Jaipur');
                                    $vcInitials = strtoupper(substr($vcName, 0, 2));
                                    $vcRibbonColor = $vc->ribbon_color ?? '#F59E0B';
                                @endphp

                                <a href="{{ route('front.vendor.details', ['vendor' => $vc->id]) }}" class="vl-vc-item" style="--ribbon-bg: {{ $vcRibbonColor }};">
                                    <!-- Corner Fold Ribbon -->
                                    <div class="vl-vc-ribbon"></div>

                                    <!-- Square Logo Box -->
                                    <div class="vl-vc-logo">
                                        @if(!empty($vc->profile_photo))
                                            <img src="{{ $vc->profile_photo_url }}" alt="{{ $vcName }}" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <span style="display:none;">{{ $vcInitials }}</span>
                                        @else
                                            <span>{{ $vcInitials }}</span>
                                        @endif
                                    </div>

                                    <!-- Card Details -->
                                    <div class="vl-vc-info">
                                        <div class="vl-vc-name" title="{{ $vcName }}">{{ $vcName }}</div>
                                        <div class="vl-vc-role">{{ $vc->designation ?? 'Real Estate Consultant' }}</div>
                                        <div class="vl-vc-meta">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                            </svg>
                                            <span>{{ $vcMobile }}</span>
                                        </div>
                                        <div class="vl-vc-location">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            <span>{{ Str::limit($vcAddress, 24) }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('front.addbanner') }}" class="vl-vc-view-all">
                        <span>View All</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>

                </div>
            </aside>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        var currentDistrictId = "{{ $location ?? 150 }}";
        var currentCategoryId = "{{ $selectedCategory ?? '' }}";
        var currentSubcategoryId = "{{ $selectedSubCategory ?? '' }}";

        var listSubcategoryUrlTemplate = "{{ route('front.vendorlist.location.subcategory', ['location' => 'LOC_ID', 'subcategory' => 'SUBCAT_ID']) }}";
        var listCategoryUrlTemplate = "{{ route('front.vendorlist.location.category', ['location' => 'LOC_ID', 'category' => 'CAT_ID']) }}";
        var listDistrictUrlTemplate = "{{ route('front.vendorlist.location', ['location' => 'LOC_ID']) }}";
        var generalListUrl = "{{ route('front.vendorlist') }}";

        function applyCurrentFilters(customParams) {
            var urlParams = new URLSearchParams(window.location.search);

            if (customParams) {
                Object.keys(customParams).forEach(function(key) {
                    if (customParams[key] === null || customParams[key] === '' || customParams[key] === 'all') {
                        urlParams.delete(key);
                    } else {
                        urlParams.set(key, customParams[key]);
                    }
                });
            }

            // Always reset page to 1 on filter change
            urlParams.delete('page');

            var targetBaseUrl = window.location.pathname;
            var queryString = urlParams.toString();
            window.location.href = targetBaseUrl + (queryString ? '?' + queryString : '');
        }

        // 1. Header Search Capsule Action
        $('#hscSearchBtn').on('click', function () {
            var cat = $('#hscCategorySelect').val();
            var dist = $('#hscDistrictSelect').val() || currentDistrictId || '150';

            if (cat) {
                var url = listCategoryUrlTemplate.replace('LOC_ID', dist).replace('CAT_ID', cat);
                window.location.href = url;
            } else {
                var url = listDistrictUrlTemplate.replace('LOC_ID', dist);
                window.location.href = url;
            }
        });

        // 2. Top Filter Bar Category Select
        $('#topBarCategorySelect, #sidebarCategorySelect').on('change', function () {
            var cat = $(this).val();
            var dist = currentDistrictId || '150';
            if (cat) {
                window.location.href = listCategoryUrlTemplate.replace('LOC_ID', dist).replace('CAT_ID', cat);
            } else {
                window.location.href = listDistrictUrlTemplate.replace('LOC_ID', dist);
            }
        });

        // 3. Top Filter Bar Services Select
        $('#topBarServiceSelect').on('change', function () {
            var srv = $(this).val();
            var dist = currentDistrictId || '150';
            if (srv) {
                window.location.href = listSubcategoryUrlTemplate.replace('LOC_ID', dist).replace('SUBCAT_ID', srv);
            } else {
                if (currentCategoryId) {
                    window.location.href = listCategoryUrlTemplate.replace('LOC_ID', dist).replace('CAT_ID', currentCategoryId);
                } else {
                    window.location.href = listDistrictUrlTemplate.replace('LOC_ID', dist);
                }
            }
        });

        // 4. Services Checkbox Selection in Sidebar (Multi-Select)
        $('#servicesCheckboxList input[type="checkbox"]').on('change', function () {
            var checkedServices = [];
            $('#servicesCheckboxList input[type="checkbox"]:checked').each(function () {
                checkedServices.push($(this).val());
            });
            applyCurrentFilters({ service: checkedServices.length ? checkedServices.join(',') : null });
        });

        // 5. Area Filter (Top Bar & Sidebar Checkboxes - Multi-Select)
        $('#topBarAreaSelect').on('change', function () {
            var selectedOpt = $(this).find('option:selected');
            var val = $(this).val();
            var type = selectedOpt.data('type');

            if (!val || val === 'all') {
                applyCurrentFilters({ area: null, city: null });
            } else if (type === 'city') {
                applyCurrentFilters({ city: val, area: null });
            } else {
                applyCurrentFilters({ area: val, city: null });
            }
        });

        $('#areaCheckboxList input[type="checkbox"]').on('change', function () {
            var checkedCities = [];
            var checkedAreas = [];
            $('#areaCheckboxList input[type="checkbox"]:checked').each(function () {
                var type = $(this).data('type');
                var cityId = $(this).data('id');
                var val = $(this).val();

                if (type === 'city' && cityId) {
                    checkedCities.push(cityId);
                } else if (val) {
                    checkedAreas.push(val);
                }
            });

            applyCurrentFilters({
                city: checkedCities.length ? checkedCities.join(',') : null,
                area: checkedAreas.length ? checkedAreas.join(',') : null
            });
        });

        // 6. Live Area Search in Sidebar
        $('#areaSearchInput').on('keyup', function () {
            var q = $(this).val().toLowerCase().trim();
            if (q.length === 0) {
                $('.area-item').each(function (idx) {
                    if (idx < 5 || $('#toggleMoreAreas').data('expanded')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            } else {
                $('.area-item').each(function () {
                    var name = $(this).data('name') || '';
                    if (name.indexOf(q) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });

        // Toggle "Show More +"
        $('#toggleMoreAreas').on('click', function () {
            var $this = $(this);
            var isExpanded = $this.data('expanded') || false;
            if (!isExpanded) {
                $('.area-extra').slideDown(150);
                $this.text('Show Less -').data('expanded', true);
            } else {
                $('.area-extra').slideUp(150);
                $this.text('Show More +').data('expanded', false);
            }
        });

        // 7. Rating Filter
        $('input[name="rating"]').on('change', function () {
            if ($(this).is(':checked')) {
                $('input[name="rating"]').not(this).prop('checked', false);
                applyCurrentFilters({ rating: $(this).val() });
            } else {
                applyCurrentFilters({ rating: null });
            }
        });

        // 8. Sort Filter
        $('#topBarSortSelect, #mobileSortSelect').on('change', function () {
            applyCurrentFilters({ sort: $(this).val() });
        });

        // 9. Reset Filters Button
        $('#btnResetFilters').on('click', function () {
            var dist = currentDistrictId || '150';
            if (currentCategoryId) {
                window.location.href = listCategoryUrlTemplate.replace('LOC_ID', dist).replace('CAT_ID', currentCategoryId);
            } else {
                window.location.href = listDistrictUrlTemplate.replace('LOC_ID', dist);
            }
        });

        // 10. List vs Grid View Toggle
        var storedView = localStorage.getItem('vlViewMode') || 'list';
        function setViewMode(mode) {
            if (mode === 'grid') {
                $('#vlAgentsContainer').addClass('is-grid');
                $('#viewGridBtn').addClass('active');
                $('#viewListBtn').removeClass('active');
            } else {
                $('#vlAgentsContainer').removeClass('is-grid');
                $('#viewListBtn').addClass('active');
                $('#viewGridBtn').removeClass('active');
            }
            localStorage.setItem('vlViewMode', mode);
        }
        setViewMode(storedView);

        $('#viewListBtn').on('click', function () { setViewMode('list'); });
        $('#viewGridBtn').on('click', function () { setViewMode('grid'); });

        // 11. Wishlist Heart Toggle
        var savedVendors = JSON.parse(localStorage.getItem('agentSavedVendors') || '[]');
        function syncWishlistUI() {
            $('.vl-card-heart-btn').each(function () {
                var vid = String($(this).data('id'));
                if (savedVendors.indexOf(vid) > -1) {
                    $(this).addClass('is-saved').find('svg').attr('fill', '#EF4444').attr('stroke', '#EF4444');
                } else {
                    $(this).removeClass('is-saved').find('svg').attr('fill', 'none').attr('stroke', 'currentColor');
                }
            });
            $('#headerSavedBtn span').text(savedVendors.length ? 'Saved (' + savedVendors.length + ')' : 'Saved');
        }
        syncWishlistUI();

        $(document).on('click', '.vl-card-heart-btn', function (e) {
            e.preventDefault();
            var vid = String($(this).data('id'));
            var idx = savedVendors.indexOf(vid);
            if (idx > -1) {
                savedVendors.splice(idx, 1);
            } else {
                savedVendors.push(vid);
            }
            localStorage.setItem('agentSavedVendors', JSON.stringify(savedVendors));
            syncWishlistUI();
        });

        // 12. Mobile Filter Sidebar Drawer (Offcanvas)
        $('#vlSidebarToggle, #vlMobileFilterTrigger').on('click', function () {
            $('#vlFilterSidebar').addClass('is-open');
            $('#vlFilterBackdrop').addClass('is-active');
            $('body').addClass('overflow-hidden');
        });

        $('#vlFilterCloseBtn, #vlFilterBackdrop, #btnDrawerApply').on('click', function () {
            $('#vlFilterSidebar').removeClass('is-open');
            $('#vlFilterBackdrop').removeClass('is-active');
            $('body').removeClass('overflow-hidden');
        });

        $('#btnDrawerReset').on('click', function () {
            $('#btnResetFilters').trigger('click');
        });

        // 13. Area Agent Visiting Card Slider Control & Auto-slide
        var vcTrack = document.getElementById('vcSliderTrack');
        if (vcTrack) {
            $('#vcNextBtn').on('click', function () {
                var isMobile = window.innerWidth <= 768;
                if (isMobile) {
                    var scrollAmount = 277; // card width + gap
                    var maxScroll = vcTrack.scrollWidth - vcTrack.clientWidth;
                    if (vcTrack.scrollLeft + scrollAmount >= maxScroll - 10) {
                        vcTrack.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        vcTrack.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                    }
                } else {
                    var scrollAmount = 140;
                    var maxScroll = vcTrack.scrollHeight - vcTrack.clientHeight;
                    if (vcTrack.scrollTop + scrollAmount >= maxScroll - 10) {
                        vcTrack.scrollTo({ top: 0, behavior: 'smooth' });
                    } else {
                        vcTrack.scrollBy({ top: scrollAmount, behavior: 'smooth' });
                    }
                }
            });

            $('#vcPrevBtn').on('click', function () {
                var isMobile = window.innerWidth <= 768;
                if (isMobile) {
                    var scrollAmount = 277;
                    if (vcTrack.scrollLeft <= 10) {
                        vcTrack.scrollTo({ left: vcTrack.scrollWidth, behavior: 'smooth' });
                    } else {
                        vcTrack.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                    }
                } else {
                    var scrollAmount = 140;
                    if (vcTrack.scrollTop <= 10) {
                        vcTrack.scrollTo({ top: vcTrack.scrollHeight, behavior: 'smooth' });
                    } else {
                        vcTrack.scrollBy({ top: -scrollAmount, behavior: 'smooth' });
                    }
                }
            });

            // Auto-advance visiting cards slider periodically
            var vcAutoSlide = setInterval(function () {
                if (!$(vcTrack).is(':hover')) {
                    $('#vcNextBtn').trigger('click');
                }
            }, 3500);

            $(vcTrack).on('mouseenter touchstart', function () {
                clearInterval(vcAutoSlide);
            });
        }
    });
</script>
@endpush

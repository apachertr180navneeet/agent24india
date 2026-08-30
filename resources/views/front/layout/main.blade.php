<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteTitle ?? '' }} | @yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Jost:wght@400;500;600;700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/prototype-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/front/assets/css/prototype-style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .tab-buttons .btn {
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            margin-right: 10px;
            transition: all 0.3s;
        }

        .tab-buttons .btn.active {
            background-color: #3b82f6;
            color: white;
        }

        .form-container {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-container .form-label {
            font-weight: 600;
        }

        .form-control:disabled {
            background-color: #e9ecef;
        }

        .confirm-btn,
        .send-otp-btn {
            background-color: #3b82f6;
            color: white;
            border-radius: 30px !important;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .confirm-btn:hover,
        .send-otp-btn:hover {
            background-color: #2563eb;
            color: white;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 45px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .toggle-password:hover {
            color: #000;
        }

        /* Auth Popup Modal Styles */
        .auth-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 25, 72, 0.7);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99999;
        }

        .auth-popup {
            background: #fff;
            border-radius: 16px;
            width: 520px;
            max-width: 92%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 32px 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            position: relative;
            text-align: center;
            animation: popupFadeIn 0.3s ease;
        }

        @keyframes popupFadeIn {
            from { opacity: 0; transform: translateY(-20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .close-btn1 {
            position: absolute;
            top: 14px;
            right: 18px;
            font-size: 26px;
            color: #64748B;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
        }

        .close-btn1:hover {
            color: #0F172A;
        }

        .auth-header .logo {
            max-height: 50px;
            margin-bottom: 16px;
        }

        .auth-tabs {
            display: flex;
            background: #F1F5F9;
            border-radius: 30px;
            padding: 4px;
            margin-bottom: 20px;
        }

        .auth-tabs .tab {
            flex: 1;
            padding: 9px 18px;
            border: none;
            background: transparent;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.25s;
        }

        .auth-tabs .tab.active {
            background: #004BEE;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0, 75, 238, 0.3);
        }

        .auth-form {
            display: none;
            text-align: left;
        }

        .auth-form.active {
            display: block;
        }

        .auth-form input,
        .auth-form select {
            width: 100%;
            height: 46px;
            padding: 10px 14px;
            border: 1px solid #CBD5E1;
            border-radius: 8px;
            margin-bottom: 14px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
        }

        .auth-form input:focus,
        .auth-form select:focus {
            border-color: #004BEE;
            box-shadow: 0 0 0 3px rgba(0, 75, 238, 0.1);
        }

        .auth-form a {
            color: #004BEE;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 14px;
        }

        .auth-form a:hover {
            text-decoration: underline;
        }

        .auth-form button[type="submit"] {
            width: 100%;
            height: 48px;
            background: #004BEE;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 6px;
        }

        .auth-form button[type="submit"]:hover {
            background: #0036B8;
        }

        .or-login {
            text-align: center;
            font-size: 13px;
            color: #64748B;
            margin: 18px 0 10px;
        }

        .btn-secondary {
            width: 100%;
            padding: 10px;
            border: 1.5px solid #CBD5E1;
            background: #fff;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #1E293B;
            cursor: pointer;
            text-align: center;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #475569;
            margin: 10px 0 14px;
            cursor: pointer;
        }

        .custom-checkbox input {
            width: auto;
            height: auto;
            margin-bottom: 0;
        }

        /* Global Modern Select2 Styling */
        .select2-container {
            width: 100% !important;
            margin-bottom: 14px;
        }

        .select2-container--default .select2-selection--single {
            height: 48px !important;
            border: 1.5px solid #CBD5E1 !important;
            border-radius: 10px !important;
            background-color: #FFFFFF !important;
            display: flex !important;
            align-items: center !important;
            padding: 0 12px !important;
            transition: all 0.2s ease !important;
        }

        .input-with-icon .select2-container {
            width: 100% !important;
            flex: 1;
        }

        .input-with-icon .select2-container--default .select2-selection--single {
            padding-left: 38px !important;
            height: 48px !important;
        }

        .input-with-icon .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 4px !important;
            padding-right: 24px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #0F172A !important;
        }

        .input-with-icon .field-icon {
            z-index: 3 !important;
            pointer-events: none;
        }

        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #004BEE !important;
            box-shadow: 0 0 0 3.5px rgba(0, 75, 238, 0.14) !important;
            outline: none !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1E293B !important;
            font-size: 14.5px !important;
            font-weight: 500 !important;
            line-height: 46px !important;
            padding-left: 4px !important;
            padding-right: 28px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #94A3B8 !important;
            font-weight: 400 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px !important;
            right: 12px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #64748B transparent transparent transparent !important;
            border-width: 6px 5px 0 5px !important;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #004BEE transparent !important;
            border-width: 0 5px 6px 5px !important;
        }

        .select2-dropdown {
            border: 1.5px solid #CBD5E1 !important;
            border-radius: 10px !important;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.12) !important;
            background: #FFFFFF !important;
            overflow: hidden !important;
            z-index: 9999999 !important;
            margin-top: 4px !important;
        }

        .select2-container--default .select2-search--dropdown {
            padding: 8px 10px !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1.5px solid #E2E8F0 !important;
            border-radius: 8px !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            font-family: inherit !important;
            outline: none !important;
            transition: border-color 0.2s !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            border-color: #004BEE !important;
        }

        .select2-container--default .select2-results__option {
            padding: 10px 14px !important;
            font-size: 14px !important;
            color: #334155 !important;
            font-weight: 500 !important;
            transition: background-color 0.15s, color 0.15s !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #004BEE !important;
            color: #FFFFFF !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #EFF6FF !important;
            color: #004BEE !important;
            font-weight: 700 !important;
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 48px !important;
            border: 1.5px solid #CBD5E1 !important;
            border-radius: 10px !important;
            padding: 5px 10px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #EFF6FF !important;
            border: 1px solid #BFDBFE !important;
            color: #004BEE !important;
            border-radius: 6px !important;
            padding: 3px 8px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
        }
    </style>

    @stack('styles')
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9918904470832571"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    @php
        $categoryModel = new \App\Models\Category();
        $districtModel = new \App\Models\District();
        $cityModel = new \App\Models\City();
        $stateModel = new \App\Models\State();
        $businessCategory = $categoryModel->select('id', 'name')->whereNull('parent_id')->where('status', 1)->get();
        $districtList = $districtModel->select('id', 'name')->where('status', 1)->get();
        $cityList = $cityModel->select('id', 'name')->where('status', 1)->get();
        $stateList = $stateModel->select('id', 'name')->where('status', 1)->get();
    @endphp

    <!-- Start Header Area -->
    @include('front.layout.header')

    @yield('content')

    <!-- Start Footer Area -->
    @include('front.layout.footer')
    <script src="{{ asset('public/front/assets/js/prototype-script.js') }}"></script>
    <script>
        $(document).on('click', '.toggle-password', function() {

            let input = $($(this).attr("toggle"));
            let icon = $(this).find("i");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }

        });
    </script>
    @stack('scripts')
</body>

</html>

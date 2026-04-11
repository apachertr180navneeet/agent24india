@extends('front.layout.main')
@section('title', $pageTitle)

@section('content')

    <!-- HEADER -->
    <header class="custom-header">
        <h2>{{ $pageTitle ?? 'Pricing Plans' }}</h2>
        <p class="sub-text">Increase visibility and reach more local customers 🚀</p>
    </header>

    <!-- PRICE SECTION -->
    <section class="price-section">
        <div class="price-container">

            <!-- FREE LISTING -->
            <div class="price-card free">
                <div class="card-top">FREE LISTING</div>
                <div class="price">FREE</div>
                <ul>
                    <li>Edit profile</li>
                    <li>Sub category</li>
                    <li>Whatsapp contact</li>
                    <li>Email contact</li>
                    <li>Trusted service</li>
                </ul>
            </div>

            <!-- VISITING CARD -->
            <div class="price-card visiting highlight">
                <div class="card-top">Side banner</div>
                <div class="price">₹100 <span>/month</span></div>
                <ul>
                    <li>Edit profile</li>
                    <li>Sub category</li>
                    <li>Call contact</li>
                    <li>Whatsapp contact</li>
                    <li>Email contact</li>
                    <li>Customer support</li>
                </ul>
            </div>

            <!-- PAID LISTING -->
            <div class="price-card paid">
                <div class="card-top">PAID LISTING</div>
                <div class="price">₹250 <span>/month</span></div>
                <ul>
                    <li>Edit profile</li>
                    <li>Sub category</li>
                    <li>Call contact</li>
                    <li>Whatsapp contact</li>
                    <li>Email contact</li>
                    <li>Trusted service</li>
                    <li>Customer support</li>
                </ul>
            </div>

            <!-- TOP BANNER -->
            <div class="price-card banner">
                <div class="card-top">TOP BANNER</div>
                <div class="price">₹500 <span>/month</span></div>
                <ul>
                    <li>Edit profile</li>
                    <li>Call contact</li>
                    <li>Whatsapp contact</li>
                    <li>Website contact</li>
                    <li>Email contact</li>
                    <li>Trusted service</li>
                    <li>Customer support</li>
                </ul>
            </div>

        </div>
    </section>

    <style>
        /* HEADER */
        .custom-header {
            text-align: center;
            padding: 30px 0;
        }

        .custom-header h2 {
            font-size: 30px;
            font-weight: 700;
        }

        .sub-text {
            color: #777;
            margin-top: 5px;
        }

        /* SECTION */
        .price-section {
            padding: 40px 20px;
        }

        /* CONTAINER */
        .price-container {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        /* CARD */
        .price-card {
            background: #fff;
            border-radius: 14px;
            width: 260px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: 0.3s;
        }

        .price-card:hover {
            transform: translateY(-6px);
        }

        /* TOP COLOR BAR */
        .card-top {
            color: #fff;
            font-weight: 600;
            padding: 15px;
            font-size: 14px;
        }

        /* COLORS */
        .price-card.free .card-top {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
        }

        .price-card.visiting .card-top {
            background: linear-gradient(45deg, #7b2ff7, #f107a3);
        }

        .price-card.paid .card-top {
            background: linear-gradient(45deg, #00c853, #64dd17);
        }

        .price-card.banner .card-top {
            background: linear-gradient(45deg, #ff6a00, #ff3d00);
        }

        /* PRICE */
        .price {
            font-size: 28px;
            font-weight: bold;
            margin: 15px 0;
            color: #333;
        }

        .price span {
            font-size: 14px;
            color: #777;
        }

        /* LIST */
        .price-card ul {
            list-style: none;
            padding: 0 20px 20px;
            margin: 0;
            text-align: left;
        }

        .price-card ul li {
            font-size: 14px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        /* HIGHLIGHT */
        .price-card.highlight {
            border: 2px solid #007bff;
        }
    </style>

@endsection

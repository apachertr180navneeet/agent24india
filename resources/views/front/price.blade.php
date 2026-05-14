@extends('front.layout.main')
@section('title', $pageTitle)

@section('content')

<!-- HEADER -->
<header class="custom-header">
    <h2>{{ $pageTitle ?? 'Pricing Plans' }}</h2>
    <p class="sub-text">
        Platform provides promotion and visibility. Leads and responses depend on your business performance.
    </p>
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
            <button class="btn">Choose Plan</button>
        </div>

        <!-- VISITING CARD -->
        <div class="price-card visiting highlight">
            <div class="card-top">
                Visiting Card
                <span class="badge">Popular</span>
            </div>
            <div class="price">&#8377;100 <span>/month</span></div>
            <ul>
                <li>Edit profile</li>
                <li>Sub category</li>
                <li>Call contact</li>
                <li>Whatsapp contact</li>
                <li>Email contact</li>
                <li>Customer support</li>
            </ul>
            <button class="btn">Choose Plan</button>
        </div>

        <!-- PAID LISTING -->
        <div class="price-card paid">
            <div class="card-top">PAID LISTING</div>
            <div class="price">&#8377;250 <span>/month</span></div>
            <ul>
                <li>Edit profile</li>
                <li>Sub category</li>
                <li>Call contact</li>
                <li>Whatsapp contact</li>
                <li>Email contact</li>
                <li>Trusted service</li>
                <li>Customer support</li>
            </ul>
            <button class="btn">Choose Plan</button>
        </div>

        <!-- TOP BANNER -->
        <div class="price-card banner">
            <div class="card-top">TOP BANNER</div>
            <div class="price">&#8377;500 <span>/month</span></div>
            <ul>
                <li>Edit profile</li>
                <li>Call contact</li>
                <li>Whatsapp contact</li>
                <li>Website contact</li>
                <li>Email contact</li>
                <li>Trusted service</li>
                <li>Customer support</li>
            </ul>
            <button class="btn">Choose Plan</button>
        </div>

    </div>

    <!-- DISCLAIMER -->
    <div class="disclaimer">
        Note: Platform provides promotion and visibility only. Leads and responses depend on your business quality and service.
    </div>

    <!-- WEBSITE -->
    <p class="website-link">
        Visit: <a href="https://www.agent24india.com" target="_blank">www.agent24india.com</a>
    </p>
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
    border: 1px solid #eee;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: 0.3s;
}

.price-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

/* TOP BAR */
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

/* BADGE */
.badge {
    font-size: 10px;
    background: #fff;
    color: #000;
    padding: 2px 6px;
    border-radius: 6px;
    margin-left: 6px;
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

/* BUTTON */
.btn {
    margin: 15px 0 20px;
    padding: 10px 20px;
    border: none;
    background: #007bff;
    color: #fff;
    border-radius: 8px;
    cursor: pointer;
}

.btn:hover {
    background: #0056b3;
}

/* HIGHLIGHT */
.price-card.highlight {
    border: 2px solid #007bff;
}

/* DISCLAIMER */
.disclaimer {
    text-align: center;
    margin-top: 25px;
    color: #888;
    font-size: 13px;
}

/* WEBSITE */
.website-link {
    text-align: center;
    margin-top: 10px;
    font-size: 13px;
}

.website-link a {
    color: #007bff;
    text-decoration: none;
}

</style>

@endsection
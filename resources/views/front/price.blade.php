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

        <!-- CARD 1 -->
        <div class="price-card">
            <h3>Banner Placement</h3>
            <p>Your banner will be displayed on the homepage for 1 month.</p>
            <div class="price">₹500<span>/month</span></div>
            {{--  <button class="btn-buy">Buy Now</button>  --}}
        </div>

        <!-- CARD 2 -->
        <div class="price-card highlight">
            <div class="badge">Popular</div>
            <h3>Top Category Listing</h3>
            <p>Your business stays at the top of your category for 1 month.</p>
            <div class="price">₹100<span>/month</span></div>
            {{--  <button class="btn-buy">Buy Now</button>  --}}
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
    gap: 30px;
    flex-wrap: wrap;
}

/* CARD */
.price-card {
    position: relative;
    background: #fff;
    border-radius: 14px;
    padding: 30px 20px;
    width: 300px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.price-card:hover {
    transform: translateY(-6px);
}

/* HIGHLIGHT CARD */
.price-card.highlight {
    border: 2px solid #007bff;
}

/* BADGE */
.badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #007bff;
    color: #fff;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 20px;
}

/* TITLE */
.price-card h3 {
    font-size: 22px;
    margin-bottom: 10px;
}

/* DESCRIPTION */
.price-card p {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}

/* PRICE */
.price {
    font-size: 30px;
    font-weight: bold;
    color: #007bff;
    margin-bottom: 20px;
}
.price span {
    font-size: 14px;
    color: #777;
}

/* BUTTON */
.btn-buy {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 12px 22px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
    font-weight: 500;
}

.btn-buy:hover {
    background: #0056b3;
}

</style>

@endsection
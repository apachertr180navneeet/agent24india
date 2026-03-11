@extends('front.layout.main')

@section('title','Advertisement Payment')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h4>Advertisement Payment</h4>
                </div>

                <div class="card-body text-center">

                    <h5 class="mb-3">Payment Details</h5>

                    <table class="table table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <td>{{ $order_id }}</td>
                        </tr>

                        <tr>
                            <th>Amount</th>
                            <td>₹ {{ $amount }}</td>
                        </tr>

                        <tr>
                            <th>Payment Gateway</th>
                            <td>Razorpay</td>
                        </tr>
                    </table>

                    <button id="pay-btn" class="btn btn-success btn-lg mt-3">
                        Pay ₹ {{ $amount }}
                    </button>

                </div>

            </div>

        </div>

    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

var options = {
    "key": "{{ $razorpay_key }}",
    "amount": "{{ $amount * 100 }}",
    "currency": "INR",
    "name": "Advertisement",
    "description": "Advertisement Payment",
    "order_id": "{{ $order_id }}",

    "handler": function (response) {

        window.location.href =
        "payment-success?payment_id="+response.razorpay_payment_id+
        "&order_id="+response.razorpay_order_id+
        "&signature="+response.razorpay_signature;
    },

    "theme": {
        "color": "#28a745"
    }
};

var rzp = new Razorpay(options);

document.getElementById('pay-btn').onclick = function(e){
    rzp.open();
    e.preventDefault();
}

</script>

@endsection
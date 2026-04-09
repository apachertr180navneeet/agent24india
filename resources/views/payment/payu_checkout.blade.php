@extends('front.layout.main')

@section('title','Advertisement Payment')

@section('content')

<form action="{{ $action }}" method="post" name="payuForm">
    <input type="hidden" name="key" value="{{ $key }}" />
    <input type="hidden" name="txnid" value="{{ $txnid }}" />
    <input type="hidden" name="amount" value="{{ $amount }}" />
    <input type="hidden" name="productinfo" value="{{ $productinfo }}" />
    <input type="hidden" name="firstname" value="{{ $firstname }}" />
    <input type="hidden" name="email" value="{{ $email }}" />
    <input type="hidden" name="phone" value="{{ $phone }}" />
    <input type="hidden" name="hash" value="{{ $hash }}" />

    <input type="hidden" name="surl" value="{{ route('payu.success') }}" />
    <input type="hidden" name="furl" value="{{ route('payu.failure') }}" />

    <button type="submit">Pay Now</button>
</form>

<script>
    document.payuForm.submit();
</script>

@endsection
@extends('front.layout.main')
@section('title', 'Forgot Password')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .forgot-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .forgot-card {
        width: 100%;
        max-width: 420px;
        background: #fff;
        padding: 35px;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .forgot-title {
        text-align: center;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 24px;
        color: #333;
    }

    .forgot-subtitle {
        text-align: center;
        font-size: 14px;
        color: #777;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        outline: none;
        transition: 0.3s;
    }

    .form-group input:focus {
        border-color: #667eea;
        box-shadow: 0 0 5px rgba(102,126,234,0.5);
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 8px;
        color: #fff;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-submit:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .alert-success {
        background: #e6fffa;
        color: #065f46;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        text-align: center;
    }

    .error {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    .back-login {
        text-align: center;
        margin-top: 15px;
    }

    .back-login a {
        color: #667eea;
        font-size: 14px;
        text-decoration: none;
    }

    .back-login a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="forgot-wrapper">
    <div class="forgot-card">

        <div class="forgot-title">Forgot Password 🔐</div>
        <div class="forgot-subtitle">
            Enter your email to receive OTP
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('forgotPassword.sendOtp') }}">
            @csrf

            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your email" required>
                
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Send OTP
            </button>
        </form>

        
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Optional: Auto-hide success message
    setTimeout(() => {
        let alertBox = document.querySelector('.alert-success');
        if(alertBox){
            alertBox.style.display = 'none';
        }
    }, 4000);
</script>
@endpush
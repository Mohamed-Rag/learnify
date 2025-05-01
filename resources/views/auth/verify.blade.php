@extends('layouts.app')

@section('content')
<div class="verify-container">
    <div class="verify-card">
        <div class="logo">
            <span class="logo-letter">L</span>
            <span class="logo-text">Learnify</span>
        </div>
        <h2>{{ __('Verify Your Email Address') }}</h2>

        @if (session('resent'))
            <div class="alert-success">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
        <p>{{ __('If you did not receive the email') }},
            <form class="resend-form" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="resend-button">{{ __('click here to request another') }}</button>
            </form>
        </p>
    </div>
</div>

<style>
    .verify-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #000000;
        background-image: url('{{ asset('images/background.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        font-family: 'Inter', sans-serif;
    }

    .verify-card {
        background-color: rgba(24, 24, 24, 0.95);
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        max-width: 400px;
        width: 90%;
        text-align: center;
        color: #fff;
        border: 1px solid #860000;
    }

    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .logo-letter {
        background-color: #ff0000;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        font-weight: bold;
        font-size: 24px;
        margin-right: 10px;
    }

    .logo-text {
        font-size: 24px;
        font-weight: bold;
    }

    h2 {
        color: #fff;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.2);
        color: #28a745;
        padding: 0.75rem;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    p {
        color: #ccc;
        margin-bottom: 1rem;
    }

    .resend-form {
        display: inline;
    }

    .resend-button {
        background: none;
        border: none;
        color: #860000;
        text-decoration: underline;
        cursor: pointer;
        padding: 0;
        font: inherit;
    }

    .resend-button:hover {
        color: #ff0000;
    }
</style>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscription Plans - Learnify</title>
</head>
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #121212;
        background-image: url('{{ asset('images/background.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: white;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 24px;
        background-color: rgba(45, 45, 45, 0.4);
        backdrop-filter: blur(5px);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .navbar .logo {
        display: flex;
        align-items: center;
        font-size: 24px;
        font-weight: bold;
        color: white;
        text-decoration: none;
    }
    .navbar .logo img {
        height: 35px;
        margin-right: 10px;
    }
    .navbar .right-section {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .navbar .right-section a {
        color: white;
        text-decoration: none;
        margin-right: 15px;
        transition: color 0.2s;
    }
    .navbar .right-section a:hover {
        color: #860000;
    }
    .navbar .right-section .btn-danger {
        background-color: #860000;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .navbar .right-section .btn-danger:hover {
        background-color: #a50000;
    }
    /* Subscription Page Styles */
    .page-header {
        text-align: center;
        padding: 60px 20px 30px;
    }
    .page-header h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .page-header p {
        font-size: 1.2rem;
        color: #aaa;
        max-width: 800px;
        margin: 0 auto;
    }
    .subscription-plans {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }
    .plan-card {
        background-color: rgba(30, 30, 30, 0.8);
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        transition: transform 0.3s;
        border: 1px solid #333;
    }
    .plan-card.featured {
        border: 1px solid #860000;
        box-shadow: 0 0 20px rgba(134, 0, 0, 0.3);
    }
    .plan-card:hover {
        transform: translateY(-5px);
    }
    .plan-header {
        padding: 25px 20px;
        border-bottom: 1px solid #333;
        position: relative;
    }
    .plan-name {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .plan-description {
        color: #aaa;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    .save-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: #00aa55;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .plan-price {
        display: flex;
        align-items: baseline;
        margin: 20px 0;
    }
    .original-price {
        text-decoration: line-through;
        color: #aaa;
        margin-right: 10px;
        font-size: 1.5rem;
    }
    .current-price {
        font-size: 2.5rem;
        font-weight: 700;
    }
    .price-period {
        font-size: 1rem;
        color: #aaa;
        margin-left: 5px;
    }
    .plan-details {
        padding: 20px;
    }
    .billing-info {
        color: #aaa;
        font-size: 0.9rem;
        margin-bottom: 20px;
        text-align: center;
    }
    .select-plan-btn {
        background-color: #860000;
        color: white;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-top: 15px;
    }
    .select-plan-btn:hover {
        background-color: #a50000;
    }
    .active-subscription-alert {
        background-color: rgba(0, 112, 186, 0.2);
        border: 1px solid #0070ba;
        border-radius: 8px;
        padding: 15px;
        margin: 0 auto 30px;
        max-width: 800px;
    }
    .active-subscription-alert p {
        margin: 5px 0;
    }
    .status-alert {
        max-width: 800px;
        margin: 0 auto 30px;
        padding: 15px;
        border-radius: 8px;
    }
    .alert-success {
        background-color: rgba(0, 170, 85, 0.2);
        border: 1px solid #00aa55;
    }
    .alert-danger {
        background-color: rgba(220, 53, 69, 0.2);
        border: 1px solid #dc3545;
    }
</style>

<body>

    <div class="navbar">
        <a href="{{ route('student.dashboard') }}" class="logo">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo">
            Learnify
        </a>
        <div class="right-section">
            @auth
                <a href="{{ route('student.dashboard') }}">Home</a>
                <a href="{{ route('student.profile') }}">Profile</a>
                <a href="{{ route('student.categories') }}">Browse Courses</a>
                <a href="{{ route('enrollment.my') }}">My Enrollments</a>
                <a href="{{ route('subscription.plans') }}">Subscription Plans</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>

    <div class="page-header">
        <h1>Subscribe now and start learning</h1>
        <p>Choose a plan and get unlimited access to the best learning content in the Arab world for the best price.</p>
    </div>

    @if (session('status'))
        <div class="status-alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="status-alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($activeSubscription)
        <div class="active-subscription-alert">
            <p><strong>You have an active subscription:</strong> {{ ucfirst($activeSubscription->plan_type) }} Plan</p>
            <p>Valid until: {{ $activeSubscription->end_date->format('F j, Y') }}</p>
        </div>
    @endif

    <div class="subscription-plans">
        @foreach($plans as $plan)
            <div class="plan-card {{ $loop->first ? 'featured' : '' }}">
                <div class="plan-header">
                    <div class="plan-name">{{ $plan['name'] }}</div>
                    <div class="plan-description">{{ $plan['description'] }}</div>
                    <div class="plan-price">
                        <span class="current-price">{{ $plan['price'] }} $</span>
                        <span class="price-period">/{{ $plan['duration'] }} days</span>
                    </div>
                </div>

                <div class="plan-details">
                    <div class="billing-info">
                        {{ $plan['billing_info'] ?? 'Billing information not available' }}
                    </div>

                    <form action="{{ route('subscription.subscribe') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan_type" value="{{ $plan['id'] }}">
                        <button type="submit" class="select-plan-btn">Select plan</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>

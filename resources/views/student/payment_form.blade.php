<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        background-color: #2d2d2d62;
        backdrop-filter: blur(5px);
        position: sticky;
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
    }

    .container {
        margin-top: 50px;
    }

    .card {
        background-color: rgba(30, 30, 30, 0.95);
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(134, 0, 0, 0.2);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #860000, #630000);
        color: white;
        font-size: 24px;
        padding: 20px;
        border: none;
    }

    .card-body {
        padding: 30px;
        color: white;
    }

    .form-control {
        background-color: rgba(18, 18, 18, 0.95);
        border: 1px solid rgba(134, 0, 0, 0.2);
        border-radius: 8px;
        color: white;
        padding: 12px;
    }

    .form-control:focus {
        background-color: rgba(30, 30, 30, 0.95);
        border-color: #860000;
        box-shadow: 0 0 0 0.25rem rgba(134, 0, 0, 0.25);
        color: white;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .col-form-label {
        color: rgba(255, 255, 255, 0.8);
    }

    .btn-primary {
        background: linear-gradient(135deg, #860000, #630000);
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #a30000, #860000);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(134, 0, 0, 0.3);
    }

    .alert {
        border-radius: 8px;
        padding: 15px 20px;
    }

    .alert-info {
        background-color: rgba(0, 112, 186, 0.1);
        border: 1px solid rgba(0, 112, 186, 0.3);
        color: white;
    }

    .alert-warning {
        background-color: rgba(255, 193, 7, 0.1);
        border: 1px solid rgba(255, 193, 7, 0.3);
        color: white;
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.1);
        border: 1px solid rgba(40, 167, 69, 0.3);
        color: white;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.3);
        color: white;
    }

    .invalid-feedback {
        color: #dc3545;
    }

    /* Add payment card icons */
    .payment-icons {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        gap: 5px;
    }

    .payment-icons img {
        height: 20px;
        opacity: 0.7;
    }

    /* Form group position relative for payment icons */
    .form-group {
        position: relative;
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
                <a class="nav-link" href="{{ route('enrollment.my') }}">My Enrollments</a>
                <a class="nav-link" href="{{ route('subscription.plans') }}">Subscription Plans</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Payment Information</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($subscription)
                            <div class="alert alert-info mb-4">
                                <h5>Subscription Details:</h5>
                                <p><strong>Plan:</strong> {{ ucfirst($subscription->plan_type) }}</p>
                                <p><strong>Amount:</strong> ${{ $subscription->plan_type == 'basic' ? '9.99' : ($subscription->plan_type == 'standard' ? '19.99' : '29.99') }}</p>
                                <p><strong>Duration:</strong> 30 days</p>
                            </div>
                        @else
                            <div class="alert alert-warning mb-4">
                                No subscription selected. Please select a subscription plan first.
                            </div>
                        @endif

                        @if($subscription)
                            <form method="POST" action="{{ route('payment.process') }}">
                                @csrf
                                <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

                                <div class="form-group row mb-3">
                                    <label for="card_name" class="col-md-4 col-form-label text-md-right">Name on Card</label>
                                    <div class="col-md-6">
                                        <input id="card_name" type="text" class="form-control @error('card_name') is-invalid @enderror" name="card_name" value="{{ old('card_name') }}" required>
                                        @error('card_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="card_number" class="col-md-4 col-form-label text-md-right">Card Number</label>
                                    <div class="col-md-6">
                                        <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" value="{{ old('card_number') }}" required placeholder="1234 5678 9012 3456">
                                        @error('card_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="expiry_date" class="col-md-4 col-form-label text-md-right">Expiry Date</label>
                                    <div class="col-md-3">
                                        <input id="expiry_date" type="text" class="form-control @error('expiry_date') is-invalid @enderror" name="expiry_date" value="{{ old('expiry_date') }}" required placeholder="MM/YY">
                                        @error('expiry_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label for="cvv" class="col-md-1 col-form-label text-md-right">CVV</label>
                                    <div class="col-md-2">
                                        <input id="cvv" type="text" class="form-control @error('cvv') is-invalid @enderror" name="cvv" value="{{ old('cvv') }}" required placeholder="123">
                                        @error('cvv')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Process Payment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div>
                                <a href="{{ route('subscription.plans') }}" class="btn btn-primary">Choose a Plan</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

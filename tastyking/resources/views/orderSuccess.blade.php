@extends('layouts.app')

@section('content')
<div class="order-success-container">
    <div class="order-success-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <h1 class="success-title">Order Placed Successfully!</h1>

        @if(session('info'))
        <div class="info-message">
            <p>{{ session('info') }}</p>
        </div>
        @endif

        <div class="order-message">
            <p>Thank you for your order! We're excited to prepare your delicious meal.</p>
            <p>Your order has been received and is being processed.</p>
            <p>You will receive your food soon. Enjoy your meal!</p>
        </div>

        <div class="action-buttons">
            <a href="{{ route('menu') }}" class="btn-primary">Continue Shopping</a>
            <a href="{{ route('order-tracking') }}" class="btn-secondary">Track Order</a>
        </div>
    </div>
</div>

<style>
    .order-success-container {
        max-width: 800px;
        margin: 50px auto 200px;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .order-success-card {
        background-color: #FFF8DC;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #F17228;
    }

    .success-icon {
        font-size: 80px;
        color: #4CAF50;
        margin-bottom: 20px;
    }

    .success-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 30px;
    }

    .order-details {
        background-color: #FFFFFF;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 30px;
        border: 1px dashed #F17228;
    }

    .order-number {
        font-size: 1.2rem;
        font-weight: 600;
        color: #F17228;
        margin-bottom: 5px;
    }

    .order-date, .order-total {
        font-size: 1rem;
        color: #666;
        margin: 5px 0;
    }

    .info-message {
        background-color: #FFF3CD;
        border: 1px solid #FFEEBA;
        color: #856404;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        text-align: left;
    }

    .order-message {
        margin-bottom: 30px;
        line-height: 1.6;
        background-color: #E8F5E9;
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid #4CAF50;
    }

    .order-message p {
        margin: 10px 0;
        color: #2E7D32;
    }

    .delivery-info, .payment-info {
        text-align: left;
        margin-bottom: 30px;
        background-color: #FFFFFF;
        border-radius: 10px;
        padding: 20px;
    }

    .delivery-info h2, .payment-info h2 {
        font-size: 1.2rem;
        color: #F17228;
        margin-bottom: 15px;
        border-bottom: 1px solid #FFE4B5;
        padding-bottom: 10px;
    }

    .delivery-info p, .payment-info p {
        margin: 10px 0;
        color: #555;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .btn-primary, .btn-secondary {
        display: inline-block;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-primary {
        background-color: #F17228;
        color: white;
    }

    .btn-secondary {
        background-color: #FFE4B5;
        color: #F17228;
        border: 1px solid #F17228;
    }

    .btn-primary:hover {
        background-color: #e05a0c;
    }

    .btn-secondary:hover {
        background-color: #FFD700;
    }
</style>

@include('layouts.footer')
@endsection

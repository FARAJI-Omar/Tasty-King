@extends('layouts.app')

@section('content')
<h1 class="title">Checkout</h1>

<form class="checkout-container">
    <div class="checkout-section">
        <h2 class="section-title">Contact informations</h2>
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName">
        </div>
        <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input type="text" id="phoneNumber" name="phoneNumber">
        </div>
    </div>

    <!-- Delivery Address Section -->
    <div class="checkout-section">
        <h2 class="section-title">Delivery Address</h2>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address">
        </div>
    </div>

    <!-- Message to Delivery Section -->
    <div class="checkout-section">
        <h2 class="section-title">Message to Delivery</h2>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="4"></textarea>
        </div>
    </div>

    <!-- Estimated Delivery Time Section -->
    <div class="checkout-section">
        <div class="delivery-info">
            <div class="delivery-label">Estimated Delivery Time :</div>
            <div class="delivery-value">20-40 minutes</div>
        </div>
    </div>

    <!-- Order Total Section -->
    <div class="checkout-section">
        <div class="order-total">
            <div class="total-label">Order Total:</div>
            <div class="total-value">145.25 dh</div>
        </div>
    </div>

    <!-- Payment Method Section -->
    <div class="checkout-section">
        <h2 class="section-title">Payment Method</h2>
        <div class="payment-options">
            <div class="payment-option-container">
                <input type="radio" id="paypal" name="payment_method" value="paypal" class="payment-radio" hidden>
                <label for="paypal" class="payment-option paypal">
                    <i class="fab fa-paypal"></i>
                    PayPal
                </label>
            </div>
            <div class="payment-option-container">
                <input type="radio" id="credit-card" name="payment_method" value="credit-card" class="payment-radio" hidden>
                <label for="credit-card" class="payment-option credit-card">
                    <i class="fa fa-credit-card"></i>
                    Credit Card
                </label>
            </div>
            <div class="payment-option-container">
                <input type="radio" id="cash" name="payment_method" value="cash" class="payment-radio" hidden checked>
                <label for="cash" class="payment-option cash">
                    <i class="fa fa-money-bill"></i>
                    Cash on delivery
                </label>
            </div>
        </div>
    </div>

    <!-- Place Order Button -->
    <button class="place-order-btn">Place Order</button>
</div>

@include('layouts.footer')
@endsection



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentButtons = document.querySelectorAll('.payment-option');

        paymentButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Reset all buttons to default background
                paymentButtons.forEach(btn => {
                    btn.style.border = '';
                });
                // Set clicked button background
                this.style.border = ' black 2px solid ';
            });
        });
    });
</script>





<style>
    .title {
        font-size: 1.5rem;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        margin: 1rem 0 2rem 10rem;
    }

    .checkout-container {
        max-width: 800px;
        margin: 0 auto 200px;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        font-family: 'Poppins', sans-serif;
    }

    .checkout-section {
        background-color: #FFF8DC;
        border: 1px solid #F17228;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 3px 3px 3px #ff8a0085;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #FF8A00;
        font-size: 0.9rem;
    }

    .form-group input, .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #FFE4B5;
        border-radius: 15px;
        background-color: #FFFFFF;
        font-size: 0.9rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .delivery-info, .order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .delivery-label, .total-label {
        font-weight: 600;
        color: #333;
    }

    .delivery-value, .total-value {
        font-weight: 600;
        color: #333;
    }

    .payment-options {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .payment-option {
        flex: 1;
        padding: 10px;
        border: 1px solid #FFE4B5;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.8rem;
        transition: border 0.3s;
    }

    .payment-option:hover {
        border: 1px solid black;
    }

    .payment-option i {
        margin-right: 5px;
        font-size: 16px;
    }

    .payment-option.paypal {
        background-color: #FFC439;
        color: #003087;
    }

    .payment-option.credit-card {
        background-color: #0070BA;
        color: white;
    }

    .payment-option.cash {
        background-color: #FF7043;
        color: white;
    }

    .place-order-btn {
        width: 100%;
        padding: 15px;
        background-color: #F17228;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        transition: background-color 0.3s;
    }

    .place-order-btn:hover {
        background-color: #e05a0c;
    }
</style>
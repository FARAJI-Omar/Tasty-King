@extends('layouts.app')

@section('content')
<h1 class="title">Checkout</h1>

<form class="checkout-container" action="{{ route('place-order') }}" method="POST" id="checkoutForm">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    <div class="checkout-section">
        <h2 class="section-title">Contact informations</h2>
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" value="{{old('fullName')}}">
            @error('fullName')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="{{old('phoneNumber')}}">
            @error('phoneNumber')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="checkout-section">
        <h2 class="section-title">Delivery Address</h2>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{old('address')}}">
            @error('address')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="checkout-section">
        <h2 class="section-title">Message to Delivery</h2>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="4">{{old('message')}}</textarea>
        </div>
    </div>

    <div class="checkout-section">
        <div class="delivery-info">
            <div class="delivery-label">Estimated Delivery Time :</div>
            <div class="delivery-value">20-40 minutes</div>
        </div>
    </div>

    <div class="checkout-section">
        <div class="order-total">
            <div class="total-label">Order Total:</div>
            <div class="total-value">{{ number_format($total, 2) }} dh</div>
        </div>
    </div>

    <div class="checkout-section">
        <h2 class="section-title">Payment Method</h2>
        <div class="payment-options">
            <div class="payment-option-container">
                <input type="radio" id="cash" name="payment_method" value="cod" class="payment-radio" checked>
                <label for="cash" class="payment-option cash">
                    <i class="fa fa-money-bill"></i>
                    Cash on delivery
                </label>
            </div>
        </div>
        @error('payment_method')
            <span class="error-message payment-error">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="place-order-btn" id="placeOrderBtn">Place Order</button>
</form>

@include('layouts.footer')
@endsection



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

    .payment-option-container {
        flex: 1;
        position: relative;
        display: flex;
    }

    .payment-option {
        width: 100%;
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

    .payment-radio {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .payment-radio:checked + .payment-option {
        border: 2px solid black;
    }

    .payment-option i {
        margin-right: 5px;
        font-size: 16px;
    }

    .payment-option.cash {
        background-color: #0070BA;
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

    .error-message {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
    }

    .form-group input:has(+ .error-message),
    .form-group textarea:has(+ .error-message) {
        border-color: #dc3545;
    }

    .payment-error {
        margin-top: 10px;
        text-align: center;
    }
</style>
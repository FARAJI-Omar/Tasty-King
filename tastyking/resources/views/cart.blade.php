@extends('layouts.app')

@section('content')
<div class="cart-container">

    <div class="cart-items">
    <div class="cart-header">
        <span>item</span>
        <span style="margin-left: 240px">quantity</span>
        <span>price</span>
    </div>
    <div class="cart-divider"></div>
    @if($cartItems->count() > 0)
        @foreach($cartItems as $item)
        @php
            $itemTotal = $item->meal_price * $item->quantity;
        @endphp
        <div class="cart-item">
            <div class="item-image">
                <img src="{{ asset('storage/' . $item->meal_image) }}" alt="{{ $item->meal_name }}">
            </div>
            <div class="item-name">{{ $item->meal_name }} <span style="font-size: 14px; color: #666;">({{ ucfirst($item->size) }})</span></div>
            <div class="item-quantity">
                <form action="{{ route('update-cart', $item->id) }}" method="POST" class="quantity-form" style="display: flex; align-items: center;">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="quantity-btn decrease" onclick="decreaseQuantity(this)">-</button>
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-value" style="width: 40px; text-align: center; border: none; background: none;" readonly>
                    <button type="button" class="quantity-btn increase" onclick="increaseQuantity(this)">+</button>
                </form>
            </div>
            <div class="item-price">{{ number_format($itemTotal, 2) }} dh</div>
            <form action="{{ route('remove-from-cart', $item->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="remove-btn">&times;</button>
            </form>
        </div>
        @endforeach
    @else
        <div class="empty-cart-message">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h2>Your cart is empty</h2>
            <p>Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('menu') }}" class="browse-menu-btn">Browse Menu</a>
        </div>
    @endif
    </div>

    <div class="cart-divider"></div>


    @if(isset($cartItems) && $cartItems->count() > 0)
    <div class="cart-summary">
        <div class="summary-row">
            <div class="summary-label">Subtotal :</div>
            <div class="summary-value">{{ number_format($subtotal, 2) }} dh</div>
        </div>
        <div class="summary-row">
            <div class="summary-label">Delivery fee :</div>
            <div class="summary-value">20.00 dh</div>
        </div>
        <div class="summary-divider"></div>
        <div class="summary-row total">
            <div class="summary-label">Total :</div>
            <div class="summary-value">{{ $total }} dh</div>
        </div>
        <a href="{{ route('checkout') }}" class="checkout-btn" style="display: block; text-align: center; text-decoration: none;">Proceed to checkout</a>
    </div>
    @endif
</div>

@include('layouts.footer')
@endsection


<style>
    .cart-container {
        max-width: 800px;
        margin: 100px auto 60px;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .cart-header {
        display: flex;
        justify-self: center;
        justify-content: space-between;
        padding: 0 20px;
        color: white;
        font-size: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .cart-divider {
        height: 2px;
        background-color: white;
        margin: 0px 0 40px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 40px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        background-color: white;
        border-radius: 10px;
        padding: 15px 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 5px;
        overflow: hidden;
        margin-right: 15px;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-name {
        flex: 1;
        font-weight: 600;
        font-size: 16px;
        color: #333;
    }

    .item-quantity {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 80px;
    }

    .quantity-btn {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: #FFB30E;
        color: white;
        border: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .quantity-value {
        font-weight: 600;
        font-size: 16px;
        min-width: 20px;
        text-align: center;
    }

    .item-price {
        font-weight: 600;
        font-size: 16px;
        color: #333;
        min-width: 80px;
        text-align: right;
    }

    .remove-btn {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: #FF5E5E;
        color: white;
        border: none;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 15px;
    }

    .cart-summary {
        width: 80%;
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .summary-label {
        font-weight: 600;
        color: #333;
    }

    .summary-value {
        font-weight: 600;
        color: #333;
    }

    .summary-divider {
        height: 1px;
        background-color: #eee;
        margin: 15px 0;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: 700;
    }

    .checkout-btn {
        width: 100%;
        padding: 12px;
        background-color: #F17228;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        transition: background-color 0.3s;
    }

    .checkout-btn:hover {
        background-color: #e05a0c;
    }

    body {
        background-color: #FFB30E;
    }

    .empty-cart-message {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: white;
        border-radius: 10px;
        padding: 40px 20px;
        margin: 20px 0;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .empty-cart-icon {
        font-size: 60px;
        color: #FFB30E;
        margin-bottom: 20px;
    }

    .empty-cart-message h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .empty-cart-message p {
        font-size: 16px;
        color: #666;
        margin-bottom: 25px;
    }

    .browse-menu-btn {
        background-color: #FFB30E;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .browse-menu-btn:hover {
        background-color: #F17228;
    }
</style>

<script>
    function increaseQuantity(button) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="quantity"]');
        input.value = parseInt(input.value) + 1;
        form.submit();
    }

    function decreaseQuantity(button) {
        const form = button.closest('form');
        const input = form.querySelector('input[name="quantity"]');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            form.submit();
        }
    }
</script>
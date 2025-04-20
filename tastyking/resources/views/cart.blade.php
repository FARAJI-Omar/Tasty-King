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

        <div class="cart-item">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Crispy Sandwich">
            </div>
            <div class="item-name">Crispy Sandwich</div>
            <div class="item-quantity">
                <button class="quantity-btn decrease">-</button>
                <span class="quantity-value">2</span>
                <button class="quantity-btn increase">+</button>
            </div>
            <div class="item-price">71.98 dh</div>
            <button class="remove-btn">&times;</button>
        </div>


        <div class="cart-item">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Healthy Burger">
            </div>
            <div class="item-name">Healthy Burger</div>
            <div class="item-quantity">
                <button class="quantity-btn decrease">-</button>
                <span class="quantity-value">1</span>
                <button class="quantity-btn increase">+</button>
            </div>
            <div class="item-price">40 dh</div>
            <button class="remove-btn">&times;</button>
        </div>


        <div class="cart-item">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Hot Soup">
            </div>
            <div class="item-name">Hot Soup</div>
            <div class="item-quantity">
                <button class="quantity-btn decrease">-</button>
                <span class="quantity-value">1</span>
                <button class="quantity-btn increase">+</button>
            </div>
            <div class="item-price">25.99 dh</div>
            <button class="remove-btn">&times;</button>
        </div>
    </div>

    <div class="cart-divider"></div>


    <div class="cart-summary">
        <div class="summary-row">
            <div class="summary-label">Subtotal :</div>
            <div class="summary-value">137.97 dh</div>
        </div>
        <div class="summary-row">
            <div class="summary-label">Delivery fee :</div>
            <div class="summary-value">20 dh</div>
        </div>
        <div class="summary-divider"></div>
        <div class="summary-row total">
            <div class="summary-label">Total :</div>
            <div class="summary-value">157,97 dh</div>
        </div>
        <button class="checkout-btn">Proceed to checkout</button>
    </div>
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
</style>
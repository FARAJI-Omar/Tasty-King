@extends('layouts.app')

@section('content')
<div class="img-title">
    <div class="image">
        <img src="{{ asset('images/sandwish.png') }}" alt="">
    </div>
    <div class="title">
        <h1>Item title</h1>
        <h2>53.00 dh</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias excepturi porro iure pariatur impedit amet optio velit hic! Quam fugiat eligendi maxime dolorum asperiores nam vel voluptas quia facilis alias.</p>
    </div>
</div>

<form action="{{ route('cart') }}" method="GET" class="buttons">
    <div class="size-quantity">
        <div class="size-selection">
            <h3>Select size:</h3>
            <div class="size-options">
                <input type="radio" id="size-small" name="size" value="small" class="size-radio" hidden>
                <label for="size-small" class="size-btn">small</label>

                <input type="radio" id="size-regular" name="size" value="regular" class="size-radio" hidden>
                <label for="size-regular" class="size-btn">regular</label>

                <input type="radio" id="size-big" name="size" value="big" class="size-radio" hidden>
                <label for="size-big" class="size-btn">big</label>
            </div>
        </div>
        <div class="quantity-selection">
            <h3>Quantity:</h3>
            <div class="quantity-controls">
                <button type="button" class="quantity-btn decrease">-</button>
                <input type="number" name="quantity" value="1" min="1" max="10" class="quantity-value" readonly>
                <button type="button" class="quantity-btn increase">+</button>
            </div>
        </div>
    </div>
    <div class="add-tocart">
        <button type="submit" class="cart-btn">
            <i class="fas fa-shopping-cart"></i> Add to cart
            <span class="price">35.99 dh</span>
        </button>
    </div>
</form>

@include('layouts.footer')
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sizeLabels = document.querySelectorAll('.size-btn');
        const sizeRadios = document.querySelectorAll('.size-radio');
        const quantityInput = document.querySelector('input.quantity-value');
        const decreaseBtn = document.querySelector('.quantity-btn.decrease');
        const increaseBtn = document.querySelector('.quantity-btn.increase');

        if(!Array.from(sizeRadios).some(radio => radio.checked)) {
            const regularLabel = document.querySelector('label[for="size-regular"]');
            if(regularLabel) {
                regularLabel.click();
            }
        }

        sizeLabels.forEach(label => {
            label.addEventListener('click', function() {
                sizeLabels.forEach(lbl => {
                    lbl.style.backgroundColor = '';
                    lbl.style.border = '';
                    lbl.classList.remove('active');
                });
                this.style.backgroundColor = '#FFB30E';
                this.style.border = 'black 1px solid';
                this.classList.add('active');

                const radioId = this.getAttribute('for');
                document.getElementById(radioId).checked = true;
            });
        });

        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < 10) {
                quantityInput.value = currentValue + 1;
            }
        });
    });
</script>


<style>
    .img-title {
        display: flex;
        justify-self: center;
        width: 60%;
        gap: 8rem;
        padding: 2rem;
        margin-top: 40px;
        margin-bottom: 0px;
    }

    .img-title .image{
        width: 1000px;
        height: 70%;
    }

    .img-title .image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .title h1{
        font-size: 2rem;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 1rem;
    }

    .title h2{
        font-size: 1.2rem;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        color: #565656;
        margin-bottom: 1rem;
    }

    .title p{
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
        color: #565656;
        max-width: 80%;
    }

    .buttons {
        display: flex;
        justify-self: center;
        width: 60%;
        gap: 10rem;
        padding: 2rem;
        align-items: flex-start;
        font-family: 'Poppins', sans-serif;
    }

    .size-quantity {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .size-selection h3, .quantity-selection h3 {
        font-size: 15px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 10px;
        color: #333;
    }

    .size-options {
        display: flex;
        gap: 10px;
    }

    .size-btn {
        padding: 6px 20px;
        border: 1px solid #ddd;
        background-color: white;
        border-radius: 10px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .size-btn.active {
        background-color: #FFB30E;
        border: 1px solid black;
    }

    .size-radio:checked + .size-btn {
        background-color: #FFB30E;
        border: 1px solid black;
    }


    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .quantity-btn {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: #FFB30E;
        color: white;
        border: none;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .quantity-btn.decrease {
        content: '-';
    }

    .quantity-btn.increase {
        content: '+';
    }

    .quantity-btn:hover {
        background-color: #e59d00;
    }

    .quantity-value {
        font-size: 16px;
        font-weight: 600;
        width: 40px;
        text-align: center;
        border: none;
        background: transparent;
    }

    .add-tocart {
        width: 320px;
    }

    .cart-btn {
        width: 100%;
        padding: 15px 22px;
        background-color: #F17228;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }

    .cart-btn:hover {
        background-color: #e05a0c;
    }

    .cart-btn i {
        margin-right: 8px;
    }

    .cart-btn .price {
        margin-left: auto;
    }
</style>

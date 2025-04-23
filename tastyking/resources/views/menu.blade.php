@extends('layouts.app')

@section('content')
<div class="our_menu">
    <h1>Our Menu</h1><br>
    <h2>Discover our carefully curated selection of dishes, prepared with the finest ingredients and served with love.</h2>
</div>
<hr>
<div class="categories">
    <button class="category-btn active" style="opacity: 1;">All</button>
    @foreach($categories as $category)
        <button class="category-btn" style="opacity: 0.6;">{{ $category->name }}</button>
    @endforeach
</div>

<div class="menu-items">
    @foreach($meals as $meal)
    <a href="{{ route('item-details') }}" class="item-card">
        <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}">
        <h2>{{ $meal->name }}</h2>
        <p class="item-price">{{ $meal->price }} dh</p>
    </a>
    @endforeach
</div>

<hr>



@include('layouts.footer')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.category-btn');

        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                categoryButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.style.opacity = '0.6';
                });

                this.classList.add('active');
                this.style.opacity = '1';
            });
        });
    });
</script>

<style>
    .our_menu {
        justify-self: center;
        padding: 2rem;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }

    .our_menu h1 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #202020;
    }

    .our_menu h2 {
        font-size: 1rem;
        color: #444444;
        margin-bottom: 1rem;
        line-height: 1.5;
        width: 80%;
        justify-self: center;
    }

    hr {
        border: none;
        border-top: 2px solid #FFB30E;
        margin: 1rem auto;
        width: 80%;
    }

    .categories {
        display: flex;
        justify-content: center;
        gap: 50px;
        margin: 2rem auto;
        flex-wrap: wrap;
        width: 80%;
    }

    .category-btn {
        background-color: #FF7A00;
        color: white;
        border: none;
        padding: 7px 18px;
        border-radius: 30px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease, opacity 0.2s ease;
        opacity: 1;
    }

    .category-btn:hover {
        opacity: 1;
    }

    .menu-items {
        width: 70%;
        justify-self: center;
        margin-top: 80px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }

    .item-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 2rem auto;
        width: 250px;
    }

    .item-card {
        text-decoration: none;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .item-card:hover {
        transform: translateY(-5px);
    }

    .item-card h2 {
        font-size: 1rem;
        font-weight: bold;
        color: #202020;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    .item-price {
        font-size: 0.85rem;
        color: #565656;
        font-weight: 500;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .item-card img {
        box-shadow: 2px 6px 12px #FFCC00;
        border-radius: 15px;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
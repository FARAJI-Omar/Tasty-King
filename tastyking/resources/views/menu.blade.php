@extends('layouts.app')

@section('content')
<div class="our_menu">
    <h1>Our Menu</h1><br>
    <h2>Discover our carefully curated selection of dishes, prepared with the finest ingredients and served with love.</h2>
</div>
<hr>
<div class="categories">
    <a href="{{ route('menu') }}" class="category-btn {{ !isset($selectedCategory) || $selectedCategory == 'all' ? 'active' : '' }}" style="opacity: {{ !isset($selectedCategory) || $selectedCategory == 'all' ? '1' : '0.6' }};">All</a>
    @foreach($categories as $category)
        <a href="{{ route('menu', ['category' => $category->id]) }}" class="category-btn {{ isset($selectedCategory) && $selectedCategory == $category->id ? 'active' : '' }}" style="opacity: {{ isset($selectedCategory) && $selectedCategory == $category->id ? '1' : '0.6' }};">{{ $category->name }}</a>
    @endforeach
</div>

<div class="menu-items">
    @foreach($meals as $meal)
    <a href="{{ route('item-details',  $meal->id) }}" class="item-card">
        <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}">
        <h2>{{ $meal->name }}</h2>
        <p class="item-price">{{ $meal->price }} dh</p>
    </a>
    @endforeach
</div>

<hr>



@include('layouts.footer')
@endsection



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
        text-decoration: none;
        display: inline-block;
    }

    .category-btn:hover {
        opacity: 1;
    }

    .menu-items {
        width: 70%;
        justify-self: center;
        margin: 80px auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .item-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        width: 250px;
        height: 300px; /* Fixed height for all cards */
        text-decoration: none;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .item-card img {
        box-shadow: 2px 6px 12px #FFCC00;
        border-radius: 15px;
        width: 250px;
        height: 200px; /* Fixed height for all images */
        object-fit: cover;
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


</style>
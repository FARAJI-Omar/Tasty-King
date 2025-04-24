@extends('layouts.app')

@section('content')

@push('admin-content')
    <div class="admin-dashboard">
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <div class="card-header">
                    <span class="card-title">Total Orders</span>
                    <span class="card-icon cart-icon"><i class="fas fa-shopping-cart"></i></span>
                </div>
                <div class="card-value">521</div>
                <div class="card-change positive">+ 12.5% from last week</div>
            </div>

            <!-- Total Orders Card 2 -->
            <div class="dashboard-card">
                <div class="card-header">
                    <span class="card-title">Total Items</span>
                    <span class="card-icon cart-icon"><i class="fas fa-shopping-cart"></i></span>
                </div>
                <div class="card-value">{{$totalMeals}}</div>
                {{-- <div class="card-change positive">+ 12.5% from last week</div> --}}
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <span class="card-title">Revenue</span>
                    <span class="card-icon revenue-icon"><i class="fas fa-dollar-sign"></i></span>
                </div>
                <div class="card-value">80,250 dh</div>
                <div class="card-change positive">+ 2.5% from last week</div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <span class="card-title">Total Users</span>
                    <span class="card-icon users-icon"><i class="fas fa-users"></i></span>
                </div>
                <div class="card-value">{{$totalUsers}}</div>
                <div class="card-change positive">{{$active}}% active</div>
            </div>
        </div>

        <div class="report-section">
            <button class="download-report-btn">
                Download Report <i class="fas fa-download"></i>
            </button>
        </div>

        <div class="dashboard-sections">
            <!-- Revenue Overview Section -->
            <div class="dashboard-section revenue-overview">
                <h2>Revenu Overview</h2>
                <!-- Revenue chart or data will go here -->
            </div>

            <!-- Popular Items Section -->
            <div class="dashboard-section popular-items">
                <h2>Popular Items</h2>

                <div class="item-list">
                    <!-- Item 1 -->
                    <div class="popular-item">
                        <div class="item-image">
                            <img src="{{ asset('images/sandwish.png') }}" alt="Cheeseburger">
                        </div>
                        <div class="item-details">
                            <span class="item-name">Cheeseburger</span>
                        </div>
                        <div class="item-price">35 dh</div>
                    </div>

                    <!-- Item 2 -->
                    <div class="popular-item">
                        <div class="item-image">
                            <img src="{{ asset('images/sandwish.png') }}" alt="Pancakes">
                        </div>
                        <div class="item-details">
                            <span class="item-name">Pancakes</span>
                        </div>
                        <div class="item-price">25 dh</div>
                    </div>

                    <!-- Item 3 -->
                    <div class="popular-item">
                        <div class="item-image">
                            <img src="{{ asset('images/sandwish.png') }}" alt="Cheeseburger">
                        </div>
                        <div class="item-details">
                            <span class="item-name">Cheeseburger</span>
                        </div>
                        <div class="item-price">35 dh</div>
                    </div>

                    <!-- Item 4 -->
                    <div class="popular-item">
                        <div class="item-image">
                            <img src="{{ asset('images/sandwish.png') }}" alt="Sand">
                        </div>
                        <div class="item-details">
                            <span class="item-name">Sand</span>
                        </div>
                        <div class="item-price">35 dh</div>
                    </div>

                    <!-- Item 5 -->
                    <div class="popular-item">
                        <div class="item-image">
                            <img src="{{ asset('images/sandwish.png') }}" alt="Cheeseburger">
                        </div>
                        <div class="item-details">
                            <span class="item-name">Cheeseburger</span>
                        </div>
                        <div class="item-price">40 dh</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush

@include('admin.sidebar')
@include('layouts.footer')
@endsection

<style>
    .admin-dashboard {
        margin: 4rem 2rem;
    }

    .dashboard-cards {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .dashboard-card {
        background-color: #FFF8DC;
        border-radius: 0.5rem;
        padding: 1.5rem;
        min-width: 220px;
        flex: 1;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .card-icon {
        font-size: 1.25rem;
    }

    .cart-icon {
        color: #FF7043;
    }

    .revenue-icon {
        color: #FF9800;
    }

    .users-icon {
        color: #FF5722;
    }

    .card-value {
        font-size: 1.6rem;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .card-change {
        font-size: 0.7rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        color: #4CAF50;
    }

    .positive {
        color: #4CAF50;
    }

    .negative {
        color: #F44336;
    }

    .report-section {
        margin-top: 2rem;
    }

    .download-report-btn {
        background-color: #FF7043;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 0.8rem;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .download-report-btn:hover {
        background-color: #F4511E;
    }

    .dashboard-sections {
        display: flex;
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .dashboard-section {
        background-color: #FFF8DC;
        border-radius: 0.5rem;
        padding: 1.5rem;
        min-height: 400px;
    }

    .dashboard-section h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .revenue-overview {
        width: 60%;
        /* Styles for revenue overview section */
    }

    .popular-items {
        width: 40%;
    }

    .item-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .popular-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .popular-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 50px;
        height: 50px;
        border-radius: 0.25rem;
        overflow: hidden;
        margin-right: 1rem;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 500;
        color: #333;
    }

    .item-price {
        font-weight: 600;
        color: #333;
    }
</style>
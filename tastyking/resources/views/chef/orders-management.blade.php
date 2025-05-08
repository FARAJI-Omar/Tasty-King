@extends('layouts.app')

@section('content')

    <div class="admin-user-management">
        @if (session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
        @endif
        <div class="header-container">
            <div class="header-content">
                <h1>Today's Orders</h1>
                <p class="management-description">Manage and track orders for {{ $todayDate }}</p>
            </div>
        </div>

        <div class="menu-controls">
            <div class="search-container">
                <input type="text" id="search-input" class="search-input" placeholder="Search Order ID..." />
            </div>

            <div class="category-filter">
                <form id="statusFilterForm" action="{{ route('chef.orders-management') }}" method="GET">
                    <select class="category-select" name="status" onchange="this.form.submit()">
                        <option value="all" {{ !isset($selectedStatus) || $selectedStatus == 'all' ? 'selected' : '' }}>All Orders</option>
                        <option value="waiting" {{ isset($selectedStatus) && $selectedStatus == 'waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="delivered" {{ isset($selectedStatus) && $selectedStatus == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ isset($selectedStatus) && $selectedStatus == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <div class="menu-items">
        @if ($orders->isEmpty())
            <p class="no-orders">No orders found for today ({{ $todayDate }}).</p>
        @else
            @foreach ($orders as $order)
                <div class="menu-item-card">
                    <div class="order-header" onclick="toggleOrderDetails(this)">
                        <div class="order-info">
                            <span class="order-number">Order #{{ $order->id }}</span>
                            <span class="order-date">{{ $order->created_at->format('F d, Y - g:i A') }}</span>
                        </div>
                        <div class="header-right">
                            <span class="status-badge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            <i class="fas fa-chevron-down toggle-icon"></i>
                        </div>
                    </div>

                    <div class="order-details hidden">
                        <div class="customer-info">
                            <h3>Customer Information</h3>
                            <p><strong>Name:</strong> {{ $order->user->name }}</p>
                            <p><strong>Address:</strong> {{ $order->delivery_address }}</p>
                        </div>

                        <div class="order-items-list">
                            <h3>Order Items</h3>
                            @foreach(json_decode($order->items_data) as $item)
                                <div class="order-item">
                                    <span class="item-quantity">{{ $item->quantity }}x</span>
                                    <span class="item-name">{{ $item->meal_name }} ({{ $item->size }})</span>
                                    <span class="item-price">{{ number_format($item->meal_price * $item->quantity, 2) }} dh</span>
                                </div>
                            @endforeach
                            <div class="order-total">
                                <span>Total:</span>
                                <span>{{ number_format($order->total, 2) }} dh</span>
                            </div>
                        </div>

                        <div class="item-actions">
                            <h3>Update Status</h3>
                            <div class="status-buttons">
                                @if($order->status != 'waiting')
                                <form action="{{ route('chef.update-order-status', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="waiting">
                                    <button type="submit" class="status-btn waiting-btn">Mark as Waiting</button>
                                </form>
                                @endif

                                @if($order->status != 'delivered')
                                <form action="{{ route('chef.update-order-status', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="delivered">
                                    <button type="submit" class="status-btn delivered-btn">Mark as Delivered</button>
                                </form>
                                @endif

                                @if($order->status != 'cancelled')
                                <form action="{{ route('chef.update-order-status', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="status-btn cancelled-btn">Mark as Cancelled</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="pagination-container">
                {{ $orders->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>

    <hr style="margin-bottom: 4rem">

@endsection

<style>
    .admin-user-management {
        padding: 4rem 2rem;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    .header-content {
        text-align: left;
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .management-description {
        color: #666;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 2rem;
    }

    .menu-controls {
        width: 90%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 auto 2rem auto;
        gap: 1.5rem;
    }

    .search-container {
        flex: 1;
    }

    .search-input {
        width: 95%;
        padding: 0.75rem 1rem;
        border: #FF7043 1px solid;
        border-radius: 15px;
        background-color: #f5f5f5;
        font-size: 0.9rem;
        color: #333;
    }

    .search-input::placeholder {
        color: #999;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
    }

    .category-filter {
        min-width: 180px;
    }

    .category-select {
        width: 100%;
        padding: 0.75rem 1rem;
        background-color: #f5f5f5;
        border: #FF7043 1px solid;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: bold;
        color: #999;
        cursor: pointer;
        transition: background-color 0.3s ease;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('data:image/svg+xml;utf8,<svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
        background-repeat: no-repeat;
        background-position: right 10px center;
    }

    .category-select:hover {
        background-color: #ff7a504f;
    }

    .category-select option {
        background-color: white;
        color: #333;
        font-size: 0.9rem;
        padding: 10px;
    }

    hr {
        border: none;
        border-top: 2px solid #FFB30E;
        margin: 0 auto;
        width: 85%;
    }

    .no-orders {
        text-align: center;
        font-size: 1.2rem;
        color: #666;
        margin: 40px 0;
        font-family: 'Poppins', sans-serif;
    }

    .menu-items {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        padding: 2rem;
        margin: 0 auto 2rem auto;
        width: 91%;
        max-width: 100%;
    }

    .menu-item-card {
        width: 100%;
        margin: 0 auto;
        background-color: #FFF8DC;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 4px 5px 8px #ffb30e85;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .menu-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 6px 8px 8px #ffb30e8a;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: #FFF8DC;
        cursor: pointer;
        border-bottom: 1px solid #FFB30E;
    }

    .order-info {
        display: flex;
        flex-direction: column;
    }

    .order-number {
        font-weight: bold;
        font-size: 1.1rem;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    .order-date {
        font-size: 0.85rem;
        color: #666;
        font-family: 'Poppins', sans-serif;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        font-family: 'Poppins', sans-serif;
    }

    .status-badge.waiting {
        background-color: #FFF0C2;
        color: #FFB30E;
    }

    .status-badge.delivered {
        background-color: #E1F5FE;
        color: #0288D1;
    }

    .status-badge.cancelled {
        background-color: #FFEBEE;
        color: #D32F2F;
    }

    .toggle-icon {
        color: #666;
        transition: transform 0.3s ease;
    }

    .order-details {
        padding: 20px;
        background-color: white;
    }

    .hidden {
        display: none;
    }

    .customer-info, .order-items-list {
        margin-bottom: 20px;
    }

    .customer-info h3, .order-items-list h3 {
        font-size: 1rem;
        margin-bottom: 10px;
        color: #333;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    .customer-info p {
        margin: 5px 0;
        font-size: 0.9rem;
        color: #555;
        font-family: 'Poppins', sans-serif;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
        font-size: 0.9rem;
        color: #555;
        font-family: 'Poppins', sans-serif;
    }

    .item-quantity {
        font-weight: bold;
        margin-right: 10px;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        padding-top: 10px;
        border-top: 2px solid #eee;
        font-weight: bold;
        font-size: 1rem;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    .item-actions {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    .item-actions h3 {
        font-size: 1rem;
        margin-bottom: 10px;
        color: #333;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    .status-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .status-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    .waiting-btn {
        background-color: #FFF0C2;
        color: #FFB30E;
        border: 1px solid #FFB30E;
    }

    .waiting-btn:hover {
        background-color: #FFB30E;
        color: white;
    }

    .delivered-btn {
        background-color: #E1F5FE;
        color: #0288D1;
        border: 1px solid #0288D1;
    }

    .delivered-btn:hover {
        background-color: #0288D1;
        color: white;
    }

    .cancelled-btn {
        background-color: #FFEBEE;
        color: #D32F2F;
        border: 1px solid #D32F2F;
    }

    .cancelled-btn:hover {
        background-color: #D32F2F;
        color: white;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin: 1rem auto 3rem;
        width: 90%;
    }

    .custom-pagination {
        display: flex;
        list-style: none;
        padding: 0.5rem;
        margin: 0;
        gap: 0.5rem;
        box-shadow: 4px 5px 8px #ffb30e85;
        border-radius: 15px;
        background-color: white;
    }

    .custom-pagination li {
        display: inline-block;
    }

    .custom-pagination li a, .custom-pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        border-radius: 15px;
        padding: 0 10px;
        background-color: #FFF8DC;
        color: #333;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .custom-pagination li.active span {
        background-color: #FF7A50;
        color: white;
        box-shadow: 0 4px 8px rgba(255, 122, 80, 0.3);
    }

    .custom-pagination li a:hover {
        background-color: #ffb30e6e;
        color: #333;
        transform: translateY(-2px);
    }

    .custom-pagination li.disabled span {
        color: #999;
        background-color: #f8f8f8;
        cursor: not-allowed;
    }

    /* Alert Styles */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        animation: fadeOut 3s forwards;
        animation-delay: 3s;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; visibility: hidden; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle order details
        window.toggleOrderDetails = function(header) {
            const details = header.nextElementSibling;
            const icon = header.querySelector('.toggle-icon');

            details.classList.toggle('hidden');

            if (details.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
        };

        // Search functionality
        const searchInput = document.getElementById('search-input');
        const orderCards = document.querySelectorAll('.menu-item-card');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const paginationContainer = document.querySelector('.pagination-container');

                // Hide pagination when searching
                if (searchTerm.length > 0) {
                    if (paginationContainer) paginationContainer.style.display = 'none';
                } else {
                    if (paginationContainer) paginationContainer.style.display = 'flex';
                }

                orderCards.forEach(card => {
                    const orderNumber = card.querySelector('.order-number').textContent.toLowerCase();

                    if (orderNumber.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        // Auto-hide success message
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 300);
            }, 3000);
        }
    });
</script>

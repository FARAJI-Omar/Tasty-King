@extends('layouts.app')

@section('content')
<div class="order-tracking-container">
    <h1 class="page-title">Track Your Orders</h1>

    @if(session('success'))
        <div class="success-message" id="successMessage">{{ session('success') }}</div>
    @endif

    <div class="orders-container">
        <div class="orders-section">
            <h2 class="section-title"></h2>

            @if($orders->isEmpty())
                <div class="no-orders-message">
                    <p>You don't have any orders yet.</p>
                    <p>Browse our menu and place your first order!</p>
                </div>
            @else
                @foreach($orders as $order)
                    <div class="order-card">
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
                            <div class="order-items">
                                @foreach(json_decode($order->items_data) as $item)
                                    <div class="order-item">
                                        <span class="item-quantity">{{ $item->quantity }}x</span>
                                        <span class="item-name">{{ $item->meal_name }} ({{ $item->size }})</span>
                                        <span class="item-price">{{ number_format($item->meal_price * $item->quantity, 2) }} dh</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="order-date-time">
                                <span class="order-time">Ordered: {{ $order->created_at->format('F d, Y - g:i A') }}</span>
                            </div>

                            <div class="order-progress">
                                <div class="progress-track">
                                    <div class="progress-step {{ $order->status == 'waiting' ? 'active' : ($order->status == 'delivered' || $order->status == 'received' ? 'completed' : '') }}">
                                        <div class="step-icon">
                                            <i class="fas fa-utensils"></i>
                                        </div>
                                        <span class="step-label">Preparing</span>
                                    </div>
                                    <div class="progress-step {{ $order->status == 'on-the-way' ? 'active' : ($order->status == 'delivered' || $order->status == 'received' ? 'completed' : '') }}">
                                        <div class="step-icon">
                                            <i class="fas fa-motorcycle"></i>
                                        </div>
                                        <span class="step-label">On the way</span>
                                    </div>
                                    <div class="progress-step {{ $order->status == 'delivered' ? 'active' : ($order->status == 'received' ? 'completed' : '') }}">
                                        <div class="step-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <span class="step-label">Delivered</span>
                                    </div>
                                </div>
                            </div>

                            <div class="order-actions">
                                @if($order->status == 'delivered')
                                    <form action="{{ route('order.update-status', $order->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="received-btn">Mark as Received</button>
                                    </form>
                                @endif


                            </div>

                            <div class="order-total">
                                <a href="{{ route('generate-pdf', $order->id) }}" class="download-receipt-btn">
                                    <i class="fas fa-file-pdf"></i> Download Receipt
                                </a>
                                <div class="total-info">
                                    <span class="total-label">Total:</span>
                                    <span class="total-value">{{ number_format($order->total, 2) }} dh</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>



@include('layouts.footer')
@endsection


<script>
    // Auto-hide success message after 3 seconds
    setTimeout(function() {
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);

    // Simple function to toggle order details
    function toggleOrderDetails(header) {
        var details = header.nextElementSibling;
        if (details.style.display === 'none' || details.classList.contains('hidden')) {
            details.style.display = 'block';
            details.classList.remove('hidden');
            header.querySelector('.toggle-icon').style.transform = 'rotate(180deg)';
        } else {
            details.style.display = 'none';
            details.classList.add('hidden');
            header.querySelector('.toggle-icon').style.transform = 'rotate(0deg)';
        }
    }

    // Store the current order statuses when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Create an object to store order IDs and their statuses
        window.orderStatuses = {};

        // Get all order cards
        const orderCards = document.querySelectorAll('.order-card');

        // Store each order's current status
        orderCards.forEach(function(card) {
            const orderId = card.querySelector('.order-number').textContent.replace('Order #', '');
            const statusBadge = card.querySelector('.status-badge');
            const currentStatus = statusBadge.textContent.toLowerCase();

            window.orderStatuses[orderId] = currentStatus;
        });

        // Check for status changes every 5 seconds
        setInterval(checkOrderStatuses, 5000);
    });
</script>

<style>
    .order-tracking-container {
        max-width: 800px;
        margin: 40px auto 60px;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .section-title {
        margin-bottom: 1rem;
        border-bottom: 2px solid #FFB30E;
        padding-bottom: 0.5rem;
    }

    .order-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .order-card.fade-out {
        opacity: 0;
        transform: translateX(100%);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background-color: #FFF8DC;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .order-header:hover {
        background-color: #FFF3E0;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .toggle-icon {
        color: #666;
        transition: transform 0.3s ease;
    }

    .toggle-icon.rotate {
        transform: rotate(180deg);
    }

    .hidden {
        display: none;
    }

    .order-info {
        display: flex;
        flex-direction: column;
    }

    .order-number {
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }

    .order-date {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.25rem;
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        text-align: center;
        min-width: 80px;
        font-weight: 500;
    }

    .status-badge.preparing {
        background-color: red;
        color: #E65100;
    }

    .status-badge.on-the-way {
        background-color: #E3F2FD;
        color: #0D47A1;
    }

    .status-badge.delivered {
        background-color: #ffb9246e;
        color: #1B5E20;
    }

    .status-badge.received {
        background-color: #56eb59de;
        color: #006064;
    }

    .order-details {
        padding: 1rem;
    }

    .order-items {
        margin-bottom: 1rem;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .item-quantity {
        font-weight: 600;
        color: #FF7043;
        margin-right: 0.5rem;
        min-width: 30px;
    }

    .item-name {
        flex: 1;
        color: #333;
    }

    .item-price {
        font-weight: 500;
        color: #333;
    }

    .order-progress {
        margin: 1.5rem 0;
    }

    .progress-track {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 0 1rem;
    }

    .progress-track::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #e0e0e0;
        z-index: 1;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .step-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
        border: 2px solid #e0e0e0;
        color: #999;
        font-size: 1.2rem;
    }

    .progress-step.active .step-icon {
        background-color: #FFB30E;
        border-color: #FFB30E;
        color: white;
    }

    .progress-step.completed .step-icon {
        background-color: #4CAF50;
        border-color: #4CAF50;
        color: white;
    }

    .step-label {
        font-size: 0.8rem;
        color: #666;
        text-align: center;
    }

    .progress-step.active .step-label {
        color: #FFB30E;
        font-weight: 600;
    }

    .progress-step.completed .step-label {
        color: #4CAF50;
        font-weight: 600;
    }

    .order-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin: 1rem 0;
    }

    .received-btn {
        background-color: #F17228;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .received-btn:hover {
        background-color: #e05a0c;
    }

    .received-btn.disabled {
        background-color: #9E9E9E;
        cursor: default;
    }

    .report-btn {
        background-color: #FFECB3;
        color: #FF6F00;
        border: 1px solid #FFD54F;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .report-btn:hover {
        background-color: #FFE082;
    }

    .report-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    /* This style is no longer needed as we're using direct style manipulation */
    /* .report-modal.show {
        display: flex;
    } */

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .report-form-container {
        position: relative;
        z-index: 1001;
        width: 90%;
        max-width: 500px;
    }

    .report-form {
        background-color: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .form-header h2 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin: 0;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 1.25rem;
        color: #999;
        cursor: pointer;
        transition: color 0.2s;
    }

    .close-btn:hover {
        color: #333;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #555;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
    }

    .rating-select {
        color: #FFB30E;
        font-size: 1.2rem;
        cursor: pointer;
        background-color: #FFF8DC;
    }

    .rating-select option {
        padding: 10px;
    }

    .form-group input[readonly] {
        background-color: #f9f9f9;
        color: #666;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-actions {
        text-align: right;
    }

    .submit-report-btn {
        background-color: #F17228;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-report-btn:hover {
        background-color: #e05a0c;
    }

    .order-date-time {
        text-align: right;
        font-size: 0.8rem;
        color: #757575;
        margin-top: 0.5rem;
        font-style: italic;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px dashed #e0e0e0;
    }

    .total-info {
        display: flex;
        align-items: center;
    }

    .total-label {
        font-weight: 600;
        color: #333;
        margin-right: 0.5rem;
    }

    .total-value {
        font-weight: 700;
        color: #F17228;
        font-size: 1.1rem;
    }

    .download-receipt-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .download-receipt-btn:hover {
        background-color: #388E3C;
        color: white;
        text-decoration: none;
    }

    .download-receipt-btn i {
        font-size: 1rem;
    }

    .no-orders-message {
        text-align: center;
        color: #666;
        padding: 2rem;
        font-style: italic;
    }

    .success-message {
        background-color: #E8F5E9;
        color: #2E7D32;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        margin-top: 0.5rem;
        text-align: center;
        font-weight: 500;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 600px) {
        .order-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .status-badge {
            margin-top: 0.5rem;
        }

        .progress-track {
            margin: 0;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .step-label {
            font-size: 0.7rem;
        }
    }
</style>

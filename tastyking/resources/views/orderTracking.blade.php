@extends('layouts.app')

@section('content')
<div class="order-tracking-container">
    <h1 class="page-title">Track Your Orders</h1>

    <div class="orders-container">

        <div class="orders-section">
            <h2 class="section-title"></h2>


            <div class="order-card">
                <div class="order-header" onclick="toggleOrderDetails(this)">
                    <div class="order-info">
                        <span class="order-number">Order #12347</span>
                        <span class="order-date">June 10, 2023 - 2:15 PM</span>
                    </div>
                    <div class="header-right">
                        <span class="status-badge delivered">Delivered</span>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                </div>

                <div class="order-details hidden">
                    <div class="order-items">
                        <div class="order-item">
                            <span class="item-quantity">2x</span>
                            <span class="item-name">Pepperoni Pizza</span>
                            <span class="item-price">140.00 dh</span>
                        </div>
                        <div class="order-item">
                            <span class="item-quantity">1x</span>
                            <span class="item-name">Ice Cream</span>
                            <span class="item-price">25.00 dh</span>
                        </div>
                    </div>
                    <div class="order-date-time">
                        <span class="order-time">Ordered: June 10, 2023 - 2:15 PM</span>
                    </div>

                    <div class="order-progress">
                        <div class="progress-track">
                            <div class="progress-step completed">
                                <div class="step-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <span class="step-label">Preparing</span>
                            </div>
                            <div class="progress-step completed">
                                <div class="step-icon">
                                    <i class="fas fa-motorcycle"></i>
                                </div>
                                <span class="step-label">On the way</span>
                            </div>
                            <div class="progress-step active">
                                <div class="step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <span class="step-label">Delivered</span>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <button class="received-btn" onclick="this.disabled=true; this.textContent='Order Received'; this.classList.add('disabled'); this.closest('.order-card').querySelector('.status-badge').textContent='Received'; this.closest('.order-card').querySelector('.status-badge').className='status-badge received';">Mark as Received</button>
                        <button class="report-btn">Report Issue</button>
                    </div>

                    <div class="order-total">
                        <span class="total-label">Total:</span>
                        <span class="total-value">165.00 dh</span>
                    </div>
                </div>
            </div>


            <div class="order-card">
                <div class="order-header" onclick="toggleOrderDetails(this)">
                    <div class="order-info">
                        <span class="order-number">Order #12346</span>
                        <span class="order-date">June 10, 2023 - 1:45 PM</span>
                    </div>
                    <div class="header-right">
                        <span class="status-badge on-the-way">On the way</span>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                </div>

                <div class="order-details hidden">
                    <div class="order-items">
                        <div class="order-item">
                            <span class="item-quantity">1x</span>
                            <span class="item-name">Veggie Burger</span>
                            <span class="item-price">40.00 dh</span>
                        </div>
                        <div class="order-item">
                            <span class="item-quantity">1x</span>
                            <span class="item-name">Chocolate Cake</span>
                            <span class="item-price">35.00 dh</span>
                        </div>
                    </div>
                    <div class="order-date-time">
                        <span class="order-time">Ordered: June 10, 2023 - 1:45 PM</span>
                    </div>

                    <div class="order-progress">
                        <div class="progress-track">
                            <div class="progress-step completed">
                                <div class="step-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <span class="step-label">Preparing</span>
                            </div>
                            <div class="progress-step active">
                                <div class="step-icon">
                                    <i class="fas fa-motorcycle"></i>
                                </div>
                                <span class="step-label">On the way</span>
                            </div>
                            <div class="progress-step">
                                <div class="step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <span class="step-label">Delivered</span>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <button class="report-btn">Report Issue</button>
                    </div>

                    <div class="order-total">
                        <span class="total-label">Total:</span>
                        <span class="total-value">75.00 dh</span>
                    </div>
                </div>
            </div>


            <div class="order-card">
                <div class="order-header" onclick="toggleOrderDetails(this)">
                    <div class="order-info">
                        <span class="order-number">Order #12345</span>
                        <span class="order-date">June 10, 2023 - 12:30 PM</span>
                    </div>
                    <div class="header-right">
                        <span class="status-badge preparing">Preparing</span>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                </div>

                <div class="order-details hidden">
                    <div class="order-items">
                        <div class="order-item">
                            <span class="item-quantity">2x</span>
                            <span class="item-name">Classic Burger</span>
                            <span class="item-price">90.00 dh</span>
                        </div>
                        <div class="order-item">
                            <span class="item-quantity">1x</span>
                            <span class="item-name">Cheese Pizza</span>
                            <span class="item-price">70.00 dh</span>
                        </div>
                    </div>
                    <div class="order-date-time">
                        <span class="order-time">Ordered: June 10, 2023 - 12:30 PM</span>
                    </div>

                    <div class="order-progress">
                        <div class="progress-track">
                            <div class="progress-step active">
                                <div class="step-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <span class="step-label">Preparing</span>
                            </div>
                            <div class="progress-step">
                                <div class="step-icon">
                                    <i class="fas fa-motorcycle"></i>
                                </div>
                                <span class="step-label">On the way</span>
                            </div>
                            <div class="progress-step">
                                <div class="step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <span class="step-label">Delivered</span>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <button class="report-btn">Report Issue</button>
                    </div>

                    <div class="order-total">
                        <span class="total-label">Total:</span>
                        <span class="total-value">160.00 dh</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="report-modal" id="reportModal">
    <div class="modal-overlay"></div>
    <div class="report-form-container">
        <div class="report-form">
            <div class="form-header">
                <h2>Report an Issue</h2>
                <button class="close-btn" onclick="closeReportModal()"><i class="fas fa-times"></i></button>
            </div>
            <form action="#" method="POST" onsubmit="closeReportModal(); return false;">
                <div class="form-group">
                    <label for="order-id">Order ID</label>
                    <input type="text" id="order-id" name="order_id" readonly>
                </div>
                <div class="form-group">
                    <label for="order-status">Order Status</label>
                    <input type="text" id="order-status" name="order_status" readonly>
                </div>
                <div class="form-group">
                    <label for="report-description">Description</label>
                    <textarea id="report-description" name="description" rows="5" placeholder="Please describe the issue you're experiencing..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-report-btn">Submit Report</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.report-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();

                const orderCard = this.closest('.order-card');
                const orderId = orderCard.querySelector('.order-number').textContent;
                const orderStatus = orderCard.querySelector('.status-badge').textContent;

                document.getElementById('order-id').value = orderId;
                document.getElementById('order-status').value = orderStatus;

                document.getElementById('reportModal').classList.add('show');
            });
        });

        document.querySelector('.modal-overlay').addEventListener('click', closeReportModal);
    });

    function toggleOrderDetails(header) {
        const details = header.nextElementSibling;
        details.classList.toggle('hidden');

        const icon = header.querySelector('.toggle-icon');
        icon.classList.toggle('rotate');
    }

    function closeReportModal() {
        document.getElementById('reportModal').classList.remove('show');
    }
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
        background-color: #FFF3E0;
        color: #E65100;
    }

    .status-badge.on-the-way {
        background-color: #E3F2FD;
        color: #0D47A1;
    }

    .status-badge.delivered {
        background-color: #E8F5E9;
        color: #1B5E20;
    }

    .status-badge.received {
        background-color: #E0F7FA;
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

    .report-modal.show {
        display: flex;
    }

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
    .form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
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
        justify-content: flex-end;
        align-items: center;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px dashed #e0e0e0;
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

    .no-orders-message {
        text-align: center;
        color: #666;
        padding: 2rem;
        font-style: italic;
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

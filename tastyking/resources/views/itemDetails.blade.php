@extends('layouts.app')
@php
    use Illuminate\Support\Facades\Auth;
@endphp

@section('content')

<div class="message-container">
    @if(session('success'))
    <div class="success-message">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif
</div>
<div class="img-title" style="margin: 0 auto;">
    <div class="image">
        <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}">
    </div>
    <div class="title">
        <h1>{{ $meal->name }}</h1>
        <h2>{{ $meal->price }} dh</h2>
        <p>{{ $meal->description }}</p>
    </div>
</div>

<form action="{{ route('add-to-cart') }}" method="POST" class="buttons">
    @csrf
    <input type="hidden" name="meal_id" value="{{ $meal->id }}">
    <div class="size-quantity">
        <div class="size-selection">
            <h3>Select size:</h3>
            <div class="size-options">
                <input type="radio" id="size-small" name="size" value="small" class="size-radio" hidden>
                <label for="size-small" class="size-btn">small</label>

                <input type="radio" id="size-regular" name="size" value="regular" class="size-radio" checked hidden>
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
            <span class="price">{{ $meal->price }} dh</span>
        </button>
    </div>
</form>
<br><br><br>
<div class="reviews-section">
    <div class="reviews-header">
        <h2 class="reviews-title">Customer Reviews</h2>
        @php
            $userReview = null;
            if(Auth::check()) {
                $userReview = $reviews->where('user_id', Auth::id())->first();
            }
        @endphp
        @if(Auth::check() && !$userReview)
            <button class="write-review-btn" onclick="showReviewModal()">
                Write a Review
            </button>
        @endif
    </div>

    <div class="average-rating">
        @php
            $averageRating = $reviews->avg('stars') ?? 0;
        @endphp
        <div class="rating-stars">
            @if ($averageRating == 5)
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            @elseif ($averageRating >= 4)
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            @elseif ($averageRating >= 3)
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            @elseif ($averageRating >= 2)
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            @elseif ($averageRating > 0)
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            @else
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            @endif
        </div>
        <div class="rating-number">
            <span>{{ number_format($averageRating, 1) }}</span>
        </div>
    </div>

    @if($reviews->isEmpty())
        <div class="no-reviews">
            <p>No reviews yet.</p>
        </div>
    @else
        <div class="reviews-list">
            @foreach($reviews as $review)
                <div class="review-item">
                    <div class="reviewer-name">{{ $review->user->name }}</div>
                    <div class="review-rating">
                        <span>{{ $review->stars }}/5</span>
                    </div>
                    <div class="review-text">{{ $review->description }}</div>
                </div>
            @endforeach
        </div>
    @endif
</div>




<!-- Review Modal -->
<div class="review-modal" id="reviewModal">
    <div class="modal-overlay" onclick="closeReviewModal()"></div>
    <div class="review-form-container">
        <div class="review-form">
            <div class="form-header">
                <h2>Write a Review</h2>
                <button class="close-btn" onclick="closeReviewModal()"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('meal.add-review') }}" method="POST">
                @csrf
                <input type="hidden" name="meal_id" value="{{ $meal->id }}">

                <div class="form-group">
                    <label for="review-stars">Rating</label>
                    <select id="review-stars" name="stars" class="rating-select">
                        <option value="1">★☆☆☆☆</option>
                        <option value="2">★★☆☆☆</option>
                        <option value="3">★★★☆☆</option>
                        <option value="4">★★★★☆</option>
                        <option value="5" selected>★★★★★</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="review-description">Your Review</label>
                    <textarea id="review-description" name="description" rows="5" placeholder="Share your experience with this item..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-review-btn">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sizeLabels = document.querySelectorAll('.size-btn');
        const sizeRadios = document.querySelectorAll('.size-radio');
        const quantityInput = document.querySelector('input.quantity-value');
        const decreaseBtn = document.querySelector('.quantity-btn.decrease');
        const increaseBtn = document.querySelector('.quantity-btn.increase');

        // Highlight the selected size button (regular by default)
        const regularLabel = document.querySelector('label[for="size-regular"]');
        if(regularLabel) {
            regularLabel.style.backgroundColor = '#FFB30E';
            regularLabel.style.border = 'black 1px solid';
            regularLabel.classList.add('active');
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
        min-height: 400px; /* Fixed minimum height */
    }

    .img-title .image{
        width: 400px; /* Fixed width */
        height: 350px; /* Fixed height */
        flex-shrink: 0; /* Prevent shrinking */
    }

    .img-title .image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px; /* Rounded corners */
    }

    .title {
        width: 400px; /* Fixed width */
        min-height: 300px; /* Minimum height */
        display: flex;
        flex-direction: column;
        flex-shrink: 0; /* Prevent shrinking */
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
        max-width: 100%;
        min-height: 100px; /* Minimum height for description */
        overflow-y: auto; /* Add scrolling if content is too long */
    }

    .buttons {
        display: flex;
        justify-self: center;
        width: 60%;
        gap: 10rem;
        padding: 2rem;
        align-items: flex-start;
        font-family: 'Poppins', sans-serif;
        margin: 0 auto; /* Center horizontally */
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
        margin-left: 7rem;
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

    .message-container {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .success-message {
        background-color: #D4EDDA;
        color: #155724;
        border: 1px solid #C3E6CB;
        border-radius: 8px;
        padding: 15px 20px;
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        display: flex;
        align-items: center;
        max-width: 80%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        animation: fadeIn 0.5s ease-in-out;
    }

    .success-message i {
        color: #28A745;
        font-size: 20px;
        margin-right: 10px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Auto-hide the message after 3 seconds */
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }

    /* Reviews Section Styles */
    .reviews-section {
        width: 60%;
        margin: 2rem auto 4rem;
        font-family: 'Poppins', sans-serif;
    }

    .reviews-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #FFB30E;
    }

    .average-rating {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        background-color: #FFF8DC;
        padding: 1rem;
        border-radius: 10px;
    }

    .rating-stars {
        font-size: 1.1rem;
        color: #FFB30E;
        margin-right: 1rem;
    }

    .rating-number span {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
    }

    .no-reviews {
        text-align: center;
        padding: 1rem;
        background-color: #f9f9f9;
        border-radius: 10px;
        color: #666;
        font-style: italic;
    }

    .reviews-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .review-item {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .reviewer-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .review-rating {
        color: #FFB30E;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .review-text {
        color: #555;
        line-height: 1.5;
    }

    /* Review Modal Styles */
    .reviews-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .write-review-btn {
        background-color: #F17228;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background-color 0.3s ease;
    }

    .write-review-btn:hover {
        background-color: #e05a0c;
    }

    .review-modal {
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

    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .review-form-container {
        position: relative;
        z-index: 1001;
        width: 90%;
        max-width: 500px;
    }

    .review-form {
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

    .form-group select, .form-group textarea {
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

    .form-group textarea {
        resize: vertical;
    }

    .form-actions {
        text-align: right;
    }

    .submit-review-btn {
        background-color: #F17228;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-review-btn:hover {
        background-color: #e05a0c;
    }
</style>

<script>
    // Auto-hide success message after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.querySelector('.success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.animation = 'fadeOut 0.5s ease-in-out forwards';
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 500);
            }, 3000);
        }
    });

    // Show review modal
    function showReviewModal() {
        document.getElementById('reviewModal').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    }

    // Close review modal
    function closeReviewModal() {
        document.getElementById('reviewModal').style.display = 'none';
        document.body.style.overflow = ''; // Restore scrolling
    }
</script>

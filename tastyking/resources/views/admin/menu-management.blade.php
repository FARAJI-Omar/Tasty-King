@extends('layouts.app')

@section('content')

@push('admin-content')
    <div class="admin-user-management">
        @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle alert-icon"></i>
            <div class="alert-message">{{ session('success') }}</div>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <div class="alert-message">{{ session('error') }}</div>
        </div>
        @endif

        <h1>Menu Management</h1>
        <p class="management-description">Manage your restaurant's menu items</p>

        <div class="menu-controls">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search Menu Item ..." />
            </div>

            <div class="category-filter">
                <select class="category-select">
                    <option value="all">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <hr>

    <div class="menu-items">
    @if ($meals->isEmpty())
        <p>No meals found.</p>
    @else
        @foreach ($meals as $meal)
        <div class="menu-item-card">
            <div class="item-image">
                <img src="{{ asset('storage/' . $meal->image) }}">
            </div>
            <div class="item-details">
                <h3 class="item-name">{{ $meal->name }}</h3>
                <div class="item-actions">
                    <button type="button" class="edit-btn" onclick="showModal('editModal-{{ $meal->id }}')">Edit</button>
                    <button type="button" class="remove-btn" onclick="showDeleteConfirmation({{ $meal->id }})">Remove</button>
                </div>
            </div>
        </div>
        @endforeach
    @endif
    </div>

    <div class="pagination-container">
        {{ $meals->links('vendor.pagination.custom') }}
    </div>

    <hr style="margin-bottom: 4rem">


    @foreach($meals as $meal)
    <div id="editModal-{{ $meal->id }}" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <h2>Edit Item</h2>

            <form method="POST" action="{{ route('admin-update-meal', $meal->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle alert-icon"></i>
                    <div class="alert-content">
                        <div class="alert-title">Please fix the following errors:</div>
                        <ul class="alert-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <div class="item-image-container">
                    <label for="itemImage-{{ $meal->id }}">Image</label>
                    <div class="item-image-box upload-placeholder">
                        <span class="upload-text">Click to select a new image</span>
                        <input type="file" name="image" id="itemImage-{{ $meal->id }}" class="form-input" accept="image/*">
                    </div>
                    <p class="image-info">Recommended: 600x400px, Maximum size: 2MB</p>
                </div>

                <div class="form-group">
                    <label for="itemTitle-{{ $meal->id }}">Title</label>
                    <input type="text" name="name" id="itemTitle-{{ $meal->id }}" class="form-input" value="{{ old('name', $meal->name) }}" placeholder="{{ $meal->name }}" required>
                </div>

                <div class="form-group">
                    <label for="itemDescription-{{ $meal->id }}">Description</label>
                    <textarea name="description" id="itemDescription-{{ $meal->id }}" class="form-textarea" placeholder="{{ $meal->description }}" required>{{ old('description', $meal->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="itemPrice-{{ $meal->id }}">Price</label>
                    <div class="price-input-container">
                        <input type="number" name="price" id="itemPrice-{{ $meal->id }}" class="form-input" value="{{ old('price', $meal->price) }}" placeholder="{{ $meal->price }}" step="0.01" min="0" required>
                        <span class="currency">dh</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="itemCategory-{{ $meal->id }}">Category</label>
                    <select name="category_id" id="itemCategory-{{ $meal->id }}" class="form-input" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $meal->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="submit" class="save-btn">Save Changes</button>
                    <button type="button" class="cancel-btn" onclick="closeModal('editModal-{{ $meal->id }}')">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteConfirmation-{{ $meal->id }}" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content delete-confirmation">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete "{{ $meal->name }}"? This action cannot be undone.</p>

            <div class="modal-actions">
                <form method="POST" action="{{ route('admin-delete-meal', $meal->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Yes, Delete</button>
                </form>
                <button type="button" class="cancel-btn" onclick="closeModal('deleteConfirmation-{{ $meal->id }}')">Cancel</button>
            </div>
        </div>
    </div>
    @endforeach


@endpush

@include('admin.sidebar')
@include('layouts.footer')
@endsection

<style>
    /* Alert Styles */
    .alert {
        display: flex;
        align-items: flex-start;
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        animation: slideDown 0.3s ease-out forwards;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background-color: #d4edda;
        border-left: 5px solid #28a745;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-left: 5px solid #dc3545;
        color: #721c24;
    }

    .alert-icon {
        font-size: 1.5rem;
        margin-right: 15px;
        margin-top: 2px;
    }

    .alert-message {
        flex: 1;
        font-size: 1rem;
        line-height: 1.5;
    }

    .alert-content {
        flex: 1;
    }

    .alert-title {
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .alert-list {
        margin: 5px 0 0 20px;
        padding: 0;
        font-size: 0.9rem;
    }

    .alert-list li {
        margin-bottom: 3px;
    }

    .admin-user-management {
        padding: 4rem 2rem;
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
        margin-bottom: 2rem;
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
        background-color: #FF7043;
        border: none;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: bold;
        color: white;
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
        background-color: #F4511E;
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
        margin: 0 2rem;
        width: 85%;
    }

    .menu-items {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 5rem;
        padding: 2rem;
        margin-bottom: 2rem;
        width: 90%
    }

    .menu-item-card {
        max-width: 280px;
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

    .item-image {
        width: 100%;
        height: 180px;
        overflow: hidden;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        padding: 1rem;
    }

    .item-name {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
        font-family: 'Poppins', sans-serif;
    }

    .item-actions {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
    }

    .edit-btn, .remove-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .edit-btn {
        background-color: #ffb30e6e;
        color: #333;
        flex: 1;
    }

    .edit-btn:hover {
        background-color: #e0e0e0;
    }

    .remove-btn {
        background-color: #ff7043e8;
        color: white;
        flex: 1;
    }

    .remove-btn:hover {
        background-color: #ff4343e3;
    }

    /* Modal Styles */
    .modal {
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

    .modal.show {
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

    .modal-content {
        position: relative;
        background-color: white;
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        z-index: 1001;
        overflow-y: auto;
    }

    .modal-content h2 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    .item-image-container {
        margin-bottom: 1.5rem;
    }

    .item-image-box {
        width: 100%;
        height: 150px;
        border-radius: 10px;
        margin-bottom: 0.5rem;
        border: 2px dashed #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        background-color: #f5f5f5;
    }

    .upload-placeholder {
        flex-direction: column;
        text-align: center;
    }

    .upload-icon {
        width: 60px;
        height: 60px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .upload-text {
        color: #FF7A50;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .item-image-box input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

    .image-info {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.25rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    .delete-confirmation {
        text-align: center;
    }

    .delete-confirmation p {
        margin-bottom: 1.5rem;
        color: #555;
        font-size: 1rem;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 0.5rem 1.5rem;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-family: 'Poppins', sans-serif;
        margin-right: 1rem;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

    .form-input, .form-textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.9rem;
        background-color: #f5f5f5;
    }

    .form-textarea {
        min-height: 80px;
        resize: vertical;
    }

    .price-input-container, .promotion-input-container {
        position: relative;
    }

    .currency, .percentage {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }

    .modal-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
    }

    .save-btn, .cancel-btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 30px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
    }

    .save-btn {
        background-color: #FF7043;
        color: white;
        flex: 1;
        margin-right: 0.5rem;
    }

    .save-btn:hover {
        background-color: #F4511E;
    }

    .cancel-btn {
        background-color: #f5f5f5;
        color: #333;
        flex: 1;
        margin-left: 0.5rem;
    }

    .cancel-btn:hover {
        background-color: #e0e0e0;
    }

        /* Pagination Styles */
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

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide success messages after 3 seconds
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.opacity = '0';
                successAlert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                successAlert.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 500);
            }, 3000);
        }
    });

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    // Function to show a modal
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('show');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    // Function to show delete confirmation
    function showDeleteConfirmation(mealId) {
        showModal('deleteConfirmation-' + mealId);
    }
</script>



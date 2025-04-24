@extends('layouts.app')

@section('content')

    <div class="admin-user-management">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="header-container">
            <div class="header-content">
                <h1>Menu Management</h1>
                <p class="management-description">Manage your restaurant's menu items</p>
            </div>
            <button class="add-item-btn" onclick="showModal('addItemModal')"><i class="fas fa-plus"></i> Add New Item</button>
        </div>

        <div class="menu-controls">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search Menu Item ..." />
            </div>

            <div class="category-filter">
                <form id="categoryFilterForm" action="{{ route('chef.menu-management') }}" method="GET">
                    <select class="category-select" name="category" onchange="this.form.submit()">
                        <option value="all" {{ !isset($selectedCategory) || $selectedCategory == 'all' ? 'selected' : '' }}>All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ isset($selectedCategory) && $selectedCategory == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </form>
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
                <div class="flex justify-between">
                    <h3 class="item-name">{{ $meal->name }}</h3>
                    <h2>{{ $meal->price }} dh</h2>
                </div>
                <div class="item-actions">
                    <button type="button" class="edit-btn" onclick="showModal('editModal-{{ $meal->id }}')">Edit</button>
                    <button type="button" class="remove-btn" onclick="showDeleteConfirmation({{ $meal->id }})">Remove</button>
                </div>
            </div>
        </div>
        @endforeach
    @endif
    </div>

    <hr style="margin-bottom: 4rem">

    <div class="pagination-container">
        {{ $meals->links('vendor.pagination.custom') }}
    </div>



    @foreach($meals as $meal)
    <div id="editModal-{{ $meal->id }}" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <h2>Edit Item</h2>

            <form method="POST" action="{{ route('update-meal', $meal->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="item-image-container">
                    <label for="itemImage">Image</label>
                    <div class="item-image-box upload-placeholder">
                        <span class="upload-text">Click to select a new image</span>
                        <input type="file" name="image" id="itemImage" class="form-input" accept="image/*">
                    </div>
                    <p class="image-info">Recommended: 600x400px, Maximum size: 2MB</p>
                </div>

                <div class="form-group">
                    <label for="itemTitle">Title</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $meal->name) }}" placeholder="{{ $meal->name }}" required>
                </div>

                <div class="form-group">
                    <label for="itemDescription">Description</label>
                    <textarea name="description" class="form-textarea" placeholder="{{ $meal->description }}" required>{{ old('description', $meal->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="itemPrice">Price</label>
                    <div class="price-input-container">
                        <input type="number" name="price" class="form-input" value="{{ old('price', $meal->price) }}" placeholder="{{ $meal->price }}" step="0.01" min="0" required>
                        <span class="currency">dh</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="itemCategory">Category</label>
                    <select name="category_id" id="itemCategory" class="form-input" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $meal->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="submit" id="saveChangesBtn" class="save-btn">Save Changes</button>
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
                <form method="POST" action="{{ route('delete-meal', $meal->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Yes, Delete</button>
                </form>
                <button type="button" class="cancel-btn" onclick="closeModal('deleteConfirmation-{{ $meal->id }}')">Cancel</button>
            </div>
        </div>
    </div>
    @endforeach


    <div id="addItemModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <h2>Add New Item</h2>

            <form id="addItemForm" method="POST" action="{{ route('create-meal') }}" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="item-image-container">
                    <label for="newItemImage">Image</label>
                    <div class="item-image-box upload-placeholder">
                        <img src="{{ asset('images/upload.png') }}" alt="Upload Image" class="upload-icon">
                        <span class="upload-text">Click to upload an image</span>
                        <input type="file" name="image" id="newItemImage" class="form-input" accept="image/*">
                    </div>
                    <p class="image-info">Recommended: 600x400px, Maximum size: 2MB</p>
                </div>

                <div class="form-group">
                    <label for="newItemTitle">Title</label>
                    <input type="text" name="name" id="newItemTitle" class="form-input" placeholder="Enter item title" required>
                </div>

                <div class="form-group">
                    <label for="newItemDescription">Description</label>
                    <textarea name="description" id="newItemDescription" class="form-textarea" placeholder="Enter item description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="newItemPrice">Price</label>
                    <div class="price-input-container">
                        <input type="number" name="price" id="newItemPrice" class="form-input" placeholder="Enter price" step="0.01" min="0" required>
                        <span class="currency">dh</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="newItemCategory">Category</label>
                    <select name="category_id" id="newItemCategory" class="form-input" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="submit" id="addItemBtn" class="save-btn">Add Item</button>
                    <button type="button" class="cancel-btn" onclick="closeModal('addItemModal')">Cancel</button>
                </div>
            </form>
        </div>
    </div>

@include('layouts.footer')
@endsection

<style>
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
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

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

    .add-item-btn {
        background-color: #FF7A50;
        color: white;
        border: none;
        border-radius: 15px;
        padding: 0.75rem 1.8rem;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'Poppins', sans-serif;
        transition: background-color 0.3s ease;
    }

    .add-item-btn:hover {
        background-color: #FF6A40;
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

    .menu-items {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 5rem;
        padding: 2rem;
        margin: 0 auto 2rem auto;
        width: 90%;
        justify-content: center;
    }

    .menu-item-card {
        max-width: 280px;
        width: 100%;
        margin: 0 auto;
        background-color: #FFF8DC;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 4px 5px 8px #ffb30e85;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        justify-self: center;
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

    .edit-btn, .remove-btn, a.edit-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .edit-btn, a.edit-btn {
        display: inline-block;
        text-align: center;
        text-decoration: none;
        background-color: #ffb30e6e;
        color: #333;
        flex: 1;
    }

    .edit-btn:hover, a.edit-btn:hover {
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
        pointer-events: none;
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
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.opacity = '0';
                successAlert.style.transition = 'opacity 0.5s';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 500);
            }, 3000);
        }

        // Check if there's a category in the URL and filter accordingly
        const urlParams = new URLSearchParams(window.location.search);
        const categoryParam = urlParams.get('category');
        if (categoryParam) {
            document.getElementById('categoryFilter').value = categoryParam;
            filterByCategory();
        }
    });

    function closeModal(modal) {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    function filterByCategory() {
        const categoryId = document.getElementById('categoryFilter').value;
        const menuItems = document.querySelectorAll('.menu-item-card');
        const noResultsMessage = document.getElementById('noResultsMessage');
        let visibleCount = 0;

        // Update URL with the selected category
        const url = new URL(window.location.href);
        if (categoryId === 'all') {
            url.searchParams.delete('category');
        } else {
            url.searchParams.set('category', categoryId);
        }
        window.history.replaceState({}, '', url);

        menuItems.forEach(item => {
            if (categoryId === 'all' || item.getAttribute('data-category') === categoryId) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCount === 0 && menuItems.length > 0) {
            if (!noResultsMessage) {
                const menuItemsContainer = document.querySelector('.menu-items');
                const message = document.createElement('p');
                message.id = 'noResultsMessage';
                message.className = 'no-results';
                message.textContent = 'No items found in this category.';
                menuItemsContainer.appendChild(message);
            } else {
                noResultsMessage.style.display = 'block';
            }
        } else if (noResultsMessage) {
            noResultsMessage.style.display = 'none';
        }
    }

</script>

<script>
    // Function to show a modal
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('show');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    // Function to close a modal
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('show');
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }

    // Function to show delete confirmation
    function showDeleteConfirmation(mealId) {
        showModal('deleteConfirmation-' + mealId);
    }


</script>







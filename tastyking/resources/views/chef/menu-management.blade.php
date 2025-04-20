@extends('layouts.app')

@section('content')

    <div class="admin-user-management">
        <div class="header-container">
            <div class="header-content">
                <h1>Menu Management</h1>
                <p class="management-description">Manage your restaurant's menu items</p>
            </div>
            <button class="add-item-btn" id="addNewItemBtn"><i class="fas fa-plus"></i> Add New Item</button>
        </div>

        <div class="menu-controls">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search Menu Item ..." />
            </div>

            <div class="category-filter">
                <select class="category-select">
                    <option value="all">All Categories</option>
                    <option value="main-course">Main course</option>
                    <option value="salad">Salad</option>
                    <option value="vegetarian">Vegetarian</option>
                    <option value="pizza">Pizza</option>
                    <option value="desserts">Desserts</option>
                </select>
            </div>
        </div>
    </div>

    <hr>

    <div class="menu-items">
        <div class="menu-item-card" data-item-id="1">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Classic Burger Pomodoro">
            </div>
            <div class="item-details">
                <h3 class="item-name">Classic Burger Pomodoro</h3>
                <div class="item-actions">
                    <button class="edit-btn">Edit</button>
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        </div>

        <div class="menu-item-card" data-item-id="2">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Cheese Burger">
            </div>
            <div class="item-details">
                <h3 class="item-name">Cheese Burger</h3>
                <div class="item-actions">
                    <button class="edit-btn">Edit</button>
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        </div>

        <div class="menu-item-card" data-item-id="3">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Veggie Burger">
            </div>
            <div class="item-details">
                <h3 class="item-name">Veggie Burger</h3>
                <div class="item-actions">
                    <button class="edit-btn">Edit</button>
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        </div>

        <div class="menu-item-card" data-item-id="4">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Margherita Pizza">
            </div>
            <div class="item-details">
                <h3 class="item-name">Margherita Pizza</h3>
                <div class="item-actions">
                    <button class="edit-btn">Edit</button>
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        </div>

        <div class="menu-item-card" data-item-id="5">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Pepperoni Pizza">
            </div>
            <div class="item-details">
                <h3 class="item-name">Pepperoni Pizza</h3>
                <div class="item-actions">
                    <button class="edit-btn">Edit</button>
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        </div>

        <div class="menu-item-card" data-item-id="6">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Chocolate Cake">
            </div>
            <div class="item-details">
                <h3 class="item-name">Chocolate Cake</h3>
                <div class="item-actions">
                    <button class="edit-btn">Edit</button>
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        </div>

        <div class="menu-item-card" data-item-id="7">
            <div class="item-image">
                <img src="{{ asset('images/sandwish.png') }}" alt="Ice Cream">
            </div>
            <div class="item-details">
                <h3 class="item-name">Ice Cream</h3>
                <div class="item-actions">
                    <button class="edit-btn">Edit</button>
                    <button class="remove-btn">Remove</button>
                </div>
            </div>
        </div>
    </div>

    <hr style="margin-bottom: 4rem">


    <div id="editModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <h2>Edit Item</h2>

            <form id="editItemForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="item_id" id="itemId">

                <div class="item-image-container">
                    <div class="item-image-preview" id="imagePreviewContainer">
                        <img id="previewImage" src="{{ asset('images/sandwish.png') }}" alt="Item Preview">
                    </div>
                    <p class="image-info">Recommended: 600x400px, Maximum size: 2MB</p>
                    <input type="file" name="item_image" id="itemImage" class="image-upload" accept="image/*">
                    <label for="itemImage" class="upload-btn">Choose Image</label>
                </div>

                <div class="form-group">
                    <label for="itemTitle">Title</label>
                    <input type="text" name="title" id="itemTitle" class="form-input" placeholder="Enter item title" required>
                </div>

                <div class="form-group">
                    <label for="itemDescription">Description</label>
                    <textarea name="description" id="itemDescription" class="form-textarea" placeholder="Enter item description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="itemPrice">Price</label>
                    <div class="price-input-container">
                        <input type="number" name="price" id="itemPrice" class="form-input" placeholder="Enter price" step="0.01" min="0" required>
                        <span class="currency">dh</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="itemCategory">Category</label>
                    <select name="category_id" id="itemCategory" class="form-input" required>
                        <option value="">Select a category</option>
                        <option value="1">Burgers</option>
                        <option value="2">Pizza</option>
                        <option value="3">Pasta</option>
                        <option value="4">Desserts</option>
                        <option value="5">Drinks</option>
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="submit" id="saveChangesBtn" class="save-btn">Save Changes</button>
                    <button type="button" id="cancelEditBtn" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <div id="addItemModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <h2>Add New Item</h2>

            <form id="addItemForm" method="POST" action="" enctype="multipart/form-data">
                @csrf

                <div class="item-image-container">
                    <div class="item-image-preview upload-placeholder" id="newImagePreviewContainer">
                        <img id="newItemPreviewImage" src="{{ asset('images/upload.png') }}" alt="Upload Image">
                    </div>
                    <p class="image-info">Recommended: 600x400px, Maximum size: 2MB</p>
                    <input type="file" name="item_image" id="newItemImage" class="image-upload" accept="image/*">
                    <label for="newItemImage" class="upload-btn">Choose Image</label>
                </div>

                <div class="form-group">
                    <label for="newItemTitle">Title</label>
                    <input type="text" name="title" id="newItemTitle" class="form-input" placeholder="Enter item title" required>
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
                        <option value="1">Burgers</option>
                        <option value="2">Pizza</option>
                        <option value="3">Pasta</option>
                        <option value="4">Desserts</option>
                        <option value="5">Drinks</option>
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="submit" id="addItemBtn" class="save-btn">Add Item</button>
                    <button type="button" id="cancelAddBtn" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>

@include('layouts.footer')
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
        gap: 2rem;
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

    .item-image-preview {
        width: 100%;
        height: 150px;
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 0.5rem;
        border: 2px dashed #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .upload-placeholder {
        background-color: #f5f5f5;
        flex-direction: column;
        text-align: center;
    }

    .upload-placeholder img {
        width: 60px !important;
        height: 60px !important;
        object-fit: contain !important;
        margin-bottom: 10px;
    }

    .upload-placeholder::after {
        content: 'Click to upload or drag and drop\A PNG, JPG, JPEG up to 2MB';
        white-space: pre;
        font-size: 0.8rem;
        color: #666;
        text-align: center;
        margin-top: 5px;
    }

    .upload-placeholder::before {
        content: 'Click to upload';
        color: #FF7A50;
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .item-image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-info {
        font-size: 0.8rem;
        color: #666;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .image-upload {
        position: absolute;
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        z-index: -1;
    }

    .upload-btn {
        display: block;
        width: 100%;
        padding: 0.5rem;
        background-color: #f5f5f5;
        color: #333;
        text-align: center;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 0.9rem;
    }

    .upload-btn:hover {
        background-color: #e0e0e0;
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

</style>

<!-- Common Utility Functions -->
<script>
    // Helper function to close a modal
    function closeModal(modal) {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }

    // Helper function to handle file uploads and preview
    function handleImageUpload(inputElement, previewElement) {
        if (!inputElement) return;

        inputElement.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>

<!-- Edit Item Modal Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get edit modal elements
        const editModal = document.getElementById('editModal');
        const editButtons = document.querySelectorAll('.edit-btn');
        const cancelEditBtn = document.getElementById('cancelEditBtn');

        // File upload preview for edit item
        const itemImage = document.getElementById('itemImage');
        const previewImage = document.getElementById('previewImage');

        // Initialize image upload handler
        handleImageUpload(itemImage, previewImage);

        // Open edit modal when edit button is clicked
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the item data from the card
                const card = this.closest('.menu-item-card');
                const itemId = card.dataset.itemId;
                const itemName = card.querySelector('.item-name').textContent;
                const itemImage = card.querySelector('.item-image img').src;

                // Set form values for editing
                document.getElementById('itemId').value = itemId;
                document.getElementById('itemTitle').value = itemName;

                // Set the image preview to the item's image
                previewImage.src = itemImage;
                previewImage.alt = itemName;

                // Remove upload placeholder styling if it exists
                const imagePreviewContainer = document.getElementById('imagePreviewContainer');
                imagePreviewContainer.classList.remove('upload-placeholder');

                // Show the edit modal
                editModal.classList.add('show');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            });
        });

        // Close edit modal when cancel button is clicked
        cancelEditBtn.addEventListener('click', function() {
            closeModal(editModal);
        });
    });
</script>

<!-- Add New Item Modal Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get add new item modal elements
        const addItemModal = document.getElementById('addItemModal');
        const addNewItemBtn = document.getElementById('addNewItemBtn');
        const cancelAddBtn = document.getElementById('cancelAddBtn');

        // File upload preview for add new item
        const newItemImage = document.getElementById('newItemImage');
        const newItemPreviewImage = document.getElementById('newItemPreviewImage');

        // Initialize image upload handler
        handleImageUpload(newItemImage, newItemPreviewImage);

        // Open add new item modal when Add New Item button is clicked
        addNewItemBtn.addEventListener('click', function() {
            // Show the add item modal
            addItemModal.classList.add('show');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        });

        // Close add item modal when cancel button is clicked
        cancelAddBtn.addEventListener('click', function() {
            closeModal(addItemModal);
        });
    });
</script>

<!-- Modal Overlay Click Handler -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Close modals when clicking outside the modal content
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal') || event.target.classList.contains('modal-overlay')) {
                const modal = event.target.closest('.modal') || event.target;
                closeModal(modal);
            }
        });
    });
</script>



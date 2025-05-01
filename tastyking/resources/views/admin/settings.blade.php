@extends('layouts.app')

@section('content')

@push('admin-content')
    <div class="admin-settings">
        <h1>Settings</h1>

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

        <div class="settings-section">
            <div class="section-header">
                <h2>Category Management</h2>
                <button class="add-btn" onclick="showAddCategoryModal()">
                    <i class="fas fa-plus"></i> Add New Category
                </button>
            </div>

            <div class="category-list">
                @if($categories->isEmpty())
                    <div class="empty-state">
                        <p>No categories found!</p>
                    </div>
                @else
                    <div class="category-table-container">
                        <table class="category-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Items Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->meals->count() }}</td>
                                    <td>
                                        <form action="{{ route('delete-category', $category->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete {{ $category->name }}? This will affect all meals in this category.')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <h2>Add New Category</h2>

            <form method="POST" action="{{ route('create-category') }}">
                @csrf
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

                <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" name="name" id="categoryName" class="form-input" placeholder="Enter category name" required>
                </div>

                <div class="modal-actions">
                    <button type="submit" class="save-btn">Add Category</button>
                    <button type="button" class="cancel-btn" onclick="closeModal('addCategoryModal')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endpush

@include('admin.sidebar')
@include('layouts.footer')
@endsection

<style>
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

    .admin-settings {
        padding: 4rem 2rem;
        font-family: 'Poppins', sans-serif;
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 2rem;
        color: #333;
    }

    .settings-section {
        background-color: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }

    h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .add-btn {
        background-color: #FF7A50;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .add-btn:hover {
        background-color: #FF6A40;
    }

    .empty-state {
        padding: 2rem;
        text-align: center;
        background-color: #f9f9f9;
        border-radius: 10px;
        color: #666;
    }

    .category-table-container {
        overflow-x: auto;
    }

    .category-table {
        width: 100%;
        border-collapse: collapse;
    }

    .category-table th {
        text-align: left;
        padding: 1rem;
        background-color: #f5f5f5;
        font-weight: 600;
        color: #333;
    }

    .category-table td {
        padding: 1rem;
        border-bottom: 1px solid #eee;
    }

    .category-table tr:last-child td {
        border-bottom: none;
    }

    .delete-btn {
        background-color: #FFEBEE;
        color: #F44336;
        border: none;
        border-radius: 5px;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .delete-btn:hover {
        background-color: #FFCDD2;
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
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.9rem;
        background-color: #f5f5f5;
    }

    .form-input:focus {
        outline: none;
        border-color: #FF7A50;
        box-shadow: 0 0 0 2px rgba(255, 122, 80, 0.2);
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

    function showAddCategoryModal() {
        const modal = document.getElementById('addCategoryModal');
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
</script>

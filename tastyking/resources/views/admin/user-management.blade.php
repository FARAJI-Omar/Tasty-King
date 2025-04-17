@extends('layouts.app')

@section('content')

@push('admin-content')
    <div class="admin-user-management">
        <div class="user-management-header">
            <h1>Users Management</h1>
            <form action="#" method="POST" id="promoteToChefForm" class="select-container">
                @csrf
                <select class="add-chef-select" id="addChefSelect" name="client_id" onchange="this.form.submit()">
                    <option value="" disabled selected>Select New Chef</option>
                    <option value="1">Emma Johnson</option>
                    <option value="2">James Wilson</option>
                    <option value="3">Olivia Brown</option>
                    <option value="4">William Davis</option>
                    <option value="5">Sophia Martinez</option>
                    <option value="6">Liam Anderson</option>
                    <option value="7">Ava Thomas</option>
                </select>
            </form>
        </div>

        <div class="user-table-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Last active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Chef users section (4 chefs) -->
                    <tr class="chef-section">
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>John Smith</td>
                        <td><span class="role-badge chef">chef</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>Maria Garcia</td>
                        <td><span class="role-badge chef">chef</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>Ahmed Hassan</td>
                        <td><span class="role-badge chef">chef</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>Sophie Chen</td>
                        <td><span class="role-badge chef">chef</span></td>
                        <td><span class="status-badge inactive">inactive</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>

                    <tr class="section-divider">
                        <td colspan="6"></td>
                    </tr>

                    <!-- Client users section (7 clients) -->
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>Emma Johnson</td>
                        <td><span class="role-badge client">client</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>James Wilson</td>
                        <td><span class="role-badge client">client</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>Olivia Brown</td>
                        <td><span class="role-badge client">client</span></td>
                        <td><span class="status-badge inactive">inactive</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>William Davis</td>
                        <td><span class="role-badge client">client</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>Sophia Martinez</td>
                        <td><span class="role-badge client">client</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>Liam Anderson</td>
                        <td><span class="role-badge client">client</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('images/chef.jpg') }}" alt="User" class="user-avatar"></td>
                        <td>Ava Thomas</td>
                        <td><span class="role-badge client">client</span></td>
                        <td><span class="status-badge active">active</span></td>
                        <td><span class="last-active">21.03.2025</span></td>
                        <td><button class="delete-btn"><i class="fas fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endpush

@include('admin.sidebar')
@include('layouts.footer')
@endsection

<style>
    .admin-user-management {
        padding: 2rem;
        font-family: 'Poppins', sans-serif;
    }

    .user-management-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin: 0;
    }

    .select-container {
        position: relative;
    }

    .add-chef-select {
        background-color: #FF7A50;
        color: white;
        border: none;
        border-radius: 15px;
        padding: 0.75rem 1rem;
        font-weight: 500;
        font-size: 0.8rem;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 2.5rem;
        min-width: 180px;
    }

    .add-chef-select:hover {
        background-color: #FF6A40;
    }

    .add-chef-select:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(255, 122, 80, 0.3);
    }

    .select-container::after {
        content: '\f078';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        pointer-events: none;
    }

    .user-table-container {
        background-color: #fff;
        border-radius: 8px;
        overflow: auto;
        max-height: 800px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        scrollbar-width: thin;
        scrollbar-color: #FFB30E #f5f5f5;
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
    }

    .user-table th {
        background-color: #FFF8DC;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #333;
        position: sticky;
        top: 0;
    }

    .user-table td {
        padding: 1rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .user-table tbody tr {
        background-color: #ffffff;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .role-badge {
        display: inline-block;
        padding: 0.25rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        text-align: center;
        min-width: 80px;
    }

    .role-badge.chef {
        background-color: #ff7a50a1;
        color: #333;
    }

    .role-badge.client {
        background-color: #ffb30e6b;
        color: #333;
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        text-align: center;
        min-width: 80px;
    }

    .status-badge.active {
        background-color: #C8E6C9;
        color: #2E7D32;
    }

    .status-badge.inactive {
        background-color: #FFCDD2;
        color: #C62828;
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

    /* Add a visual separator between chef and client sections */
    .section-divider td {
        height: 20px;
        border-bottom: 2px solid #FFB30E;
    }

    /* Smaller font size for Last active column */
    .last-active {
        font-size: 0.8rem;
        color: #666;
    }

    /* Custom styles for select dropdown */
    .add-chef-select option {
        background-color: white;
        color: #333;
        padding: 12px;
    }
</style>



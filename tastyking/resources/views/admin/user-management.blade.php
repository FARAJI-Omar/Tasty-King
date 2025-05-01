@extends('layouts.app')

@section('content')

@push('admin-content')
    <div class="admin-user-management">
        <div class="user-management-header">
            <h1>Users Management</h1>
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

            <form action="{{ route('promote-to-chef') }}" method="POST" id="promoteToChefForm" class="select-container">
                @csrf
                <select class="add-chef-select" id="addChefSelect" name="client_id" onchange="this.form.submit()">
                    <option value="" disabled selected>Select New Chef</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
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
                    @if($chefs->count() > 0)
                    <tr class="chef-section">
                        <td colspan="6"></td>
                    </tr>
                    @foreach($chefs as $chef)
                    <tr>
                        <td><img src="{{ $chef->photo ? asset('storage/' . $chef->photo) : asset('images/profile.png') }}" alt="{{ $chef->name }}" class="user-avatar"></td>
                        <td>{{ $chef->name }}</td>
                        <td><span class="role-badge chef">chef</span></td>
                        <td><span class="status-badge {{ $chef->status == 'active' ? 'active' : 'inactive' }}">{{ $chef->status ?? 'active' }}</span></td>
                        <td><span class="last-active">{{ $chef->updated_at ? $chef->updated_at->format('d.m.Y') : 'N/A' }}</span></td>
                        <td>
                            <form action="{{ route('delete-user', $chef->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete {{ $chef->name }}?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    <tr class="section-divider">
                        <td colspan="6"></td>
                    </tr>

                    @if($clients->count() > 0)
                    @foreach($clients as $client)
                    <tr>
                        <td><img src="{{ $client->photo ? asset('storage/' . $client->photo) : asset('images/profile.png') }}" alt="{{ $client->name }}" class="user-avatar"></td>
                        <td>{{ $client->name }}</td>
                        <td><span class="role-badge client">client</span></td>
                        <td><span class="status-badge {{ $client->status == 'active' ? 'active' : 'inactive' }}">{{ $client->status ?? 'active' }}</span></td>
                        <td><span class="last-active">{{ $client->updated_at ? $client->updated_at->format('d.m.Y') : 'N/A' }}</span></td>
                        <td>
                            <form action="{{ route('delete-user', $client->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete {{ $client->name }}?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px;">No clients found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
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

    .admin-user-management {
        padding: 4rem 2rem;
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


    .section-divider td {
        height: 20px;
        border-bottom: 2px solid #FFB30E;
    }


    .last-active {
        font-size: 0.8rem;
        color: #666;
    }


    .add-chef-select option {
        background-color: white;
        color: #333;
        padding: 12px;
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
</script>


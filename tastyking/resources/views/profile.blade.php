@extends('layouts.app')

@section('content')
<div class="profile-edit-container">
    <div class="profile-header">
        <h1>Edit Profile</h1>
        <p>Update your personal information and account settings</p>
    </div>

    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    <div class="profile-content">
        <div class="profile-sidebar">
            <div class="profile-photo-container">
                @if(!empty(Auth::user()->photo))
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile" class="profile-photo">
                @else
                    <img src="{{ asset('images/profile.png') }}" alt="Profile" class="profile-photo">
                @endif
                <h3>{{ Auth::user()->name }}</h3>
                <p>{{ Auth::user()->email }}</p>
            </div>

            <ul class="profile-nav">
                <li class="active"><a href="#personal-info">Personal Information</a></li>
                <li><a href="#security">Security</a></li>
                <li><a href="#danger-zone">Delete Account</a></li>
            </ul>
        </div>

        <div class="profile-forms">
            <section id="personal-info" class="profile-section">
                <h2>Personal Information</h2>
                <form method="POST" action="{{ route('profile.update-info') }}" enctype="multipart/form-data" class="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo">Profile Photo</label>
                        <div class="photo-upload-container">
                            <div class="current-photo">
                                @if(!empty(Auth::user()->photo))
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Current profile photo">
                                @else
                                    <img src="{{ asset('images/profile.png') }}" alt="Default profile photo">
                                @endif
                            </div>
                            <div class="file-input-wrapper">
                                <input type="file" id="photo" name="photo" accept="image/*" class="photo-input">
                                <p class="input-hint">Choose a new profile picture (optional)</p>
                            </div>
                        </div>
                        @error('photo')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="save-btn">Save Changes</button>
                </form>
            </section>

            <section id="security" class="profile-section">
                <h2>Security</h2>
                <form method="POST" action="{{ route('profile.update-password') }}" class="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required>
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="save-btn">Update Password</button>
                </form>
            </section>

            <section id="danger-zone" class="profile-section">
                <h2>Delete Account</h2>
                <div class="danger-zone-content">
                    <div class="danger-action">
                        <div class="danger-info">
                            <h3>Delete Account</h3>
                            <p>Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                        <button type="button" class="delete-btn" onclick="showDeleteConfirmation()">Delete Account</button>
                    </div>
                </div>

                <div id="delete-modal" class="modal">
                    <div class="modal-content">
                        <h3>Are you sure?</h3>
                        <p>This action cannot be undone. All your data will be permanently deleted.</p>
                        <form method="POST" action="{{ route('profile.delete-account') }}" class="delete-form">
                            @csrf
                            @method('DELETE')

                            <div class="form-group">
                                <label for="password">Enter your password to confirm</label>
                                <input type="password" id="password" name="password" required>
                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="modal-actions">
                                <button type="button" class="cancel-btn" onclick="hideDeleteConfirmation()">Cancel</button>
                                <button type="submit" class="confirm-delete-btn">Delete Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection





<style>
    .profile-edit-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .profile-header h1 {
        font-size: 32px;
        color: #333;
        margin-bottom: 10px;
    }

    .profile-header p {
        color: #666;
        font-size: 16px;
    }

    .profile-content {
        display: flex;
        gap: 40px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .profile-sidebar {
        width: 280px;
        background-color: #f9f9f9;
        padding: 30px 0;
    }

    .profile-photo-container {
        text-align: center;
        padding: 0 20px 30px;
        border-bottom: 1px solid #eee;
    }

    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffb30e;
        margin-bottom: 15px;
    }

    .profile-photo-container h3 {
        font-size: 18px;
        margin-bottom: 5px;
        color: #333;
    }

    .profile-photo-container p {
        font-size: 14px;
        color: #666;
    }

    .profile-nav {
        list-style: none;
        padding: 0;
        margin: 20px 0 0;
    }

    .profile-nav li {
        padding: 0;
    }

    .profile-nav li a {
        display: block;
        padding: 12px 25px;
        color: #555;
        text-decoration: none;
        transition: all 0.3s;
        border-left: 3px solid transparent;
    }

    .profile-nav li.active a,
    .profile-nav li a:hover {
        background-color: #fff;
        color: #ffb30e;
        border-left-color: #ffb30e;
    }

    .profile-forms {
        flex: 1;
        padding: 30px;
    }

    .profile-section {
        display: none;
        animation: fadeIn 0.5s;
    }

    .profile-section:first-child {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .profile-section h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .profile-form {
        max-width: 600px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #555;
    }

    .form-group input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: #ffb30e;
        outline: none;
    }

    .photo-upload-container {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .current-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #eee;
    }

    .current-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .file-input-wrapper {
        flex: 1;
    }

    .photo-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 8px;
        cursor: pointer;
        color: #ffb30e;
    }

    .input-hint {
        font-size: 12px;
        color: #888;
        margin-top: 5px;
    }

    .save-btn {
        background-color: #ffb30e;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .save-btn:hover {
        background-color: #f59e0b;
    }

    .danger-zone-content {
        background-color: #fff8f8;
        border: 1px solid #ffdddd;
        border-radius: 8px;
        padding: 20px;
    }

    .danger-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .danger-info h3 {
        color: #e53935;
        margin-bottom: 5px;
        font-size: 18px;
    }

    .danger-info p {
        color: #666;
        font-size: 14px;
        max-width: 400px;
    }

    .delete-btn {
        background-color: #e53935;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #c62828;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        max-width: 500px;
        width: 100%;
    }

    .modal-content h3 {
        color: #e53935;
        margin-bottom: 15px;
    }

    .modal-content p {
        margin-bottom: 20px;
        color: #555;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 20px;
    }

    .cancel-btn {
        background-color: #f5f5f5;
        color: #333;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
    }

    .confirm-delete-btn {
        background-color: #e53935;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
    }

    .error-message {
        color: #e53935;
        font-size: 1rem;
        margin-top: 5px;
        display: block;
    }

    .success-message {
        background-color: #e8f5e9;
        color: #2e7d32;
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        text-align: center;
        border-left: 4px solid #2e7d32;
        opacity: 1;
        transition: opacity 0.5s ease;
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.profile-nav li');
        const sections = document.querySelectorAll('.profile-section');

        const successMessage = document.querySelector('.success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.opacity = '0';
                successMessage.style.transition = 'opacity 0.5s ease';

                setTimeout(function() {
                    successMessage.remove();
                }, 500);
            }, 2000);
        }

        function switchToSection(sectionId) {
            sections.forEach(section => {
                section.style.display = 'none';
            });

            document.querySelector(sectionId).style.display = 'block';

            navItems.forEach(navItem => {
                navItem.classList.remove('active');
                if(navItem.querySelector('a').getAttribute('href') === sectionId) {
                    navItem.classList.add('active');
                }
            });
        }

        @if($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
            switchToSection('#security');
        @endif

        @if(($errors->has('password') && request()->is('profile/delete-account')) || session('show_delete_modal'))
            switchToSection('#danger-zone');
            showDeleteConfirmation();
        @endif

        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.querySelector('a').getAttribute('href');
                switchToSection(targetId);
            });
        });
    });

    function showDeleteConfirmation() {
        document.getElementById('delete-modal').style.display = 'flex';
    }

    function hideDeleteConfirmation() {
        document.getElementById('delete-modal').style.display = 'none';
    }

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('delete-modal');
        if (event.target === modal) {
            hideDeleteConfirmation();
        }
    });
</script>


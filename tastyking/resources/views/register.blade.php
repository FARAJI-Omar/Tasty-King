@extends('layouts.app')

@section('content')
<!-- Main Registration Section -->
<div class="main">
    <!-- Left Division -->
    <div class="left-div">
        <h1 class="title">Sign Up</h1>
        <p class="subtitle">Join us and savor every bite—fast, fresh, and healthy!</p>
    </div>

    <!-- Right Division -->
    <div class="right-div">
        <form method="POST" action="{{ route('register')}}" class="register-form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Re-type Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="photo">Profile Photo</label>
                <div class="file-input-wrapper">
                    <input type="file" id="photo" name="photo" accept="image/*" class="photo-input">
                </div>
                <p class="input-hint">Choose a profile picture (optional)</p>
                @error('photo')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="register-btn">Register</button>

            <br>
             <a class="login-link" href="{{ route('login') }}">
                {{ __('Already registered? Log in') }}
            </a>
        </form>
    </div>
</div>

{{-- how does it work --}}

<div class="howitworks">
    <h2 class="howitworks-title">How does it work</h2>
    <div class="steps-container">
        <!-- Step 1 -->
        <div class="step">
            <div class="step-icon">
                <img src="{{ asset('images/step1.png')}}" alt="Order" class="icon">
            </div>
            <h3 class="step-title">Choose order</h3>
            <p class="step-description">Check our hundreds of items to pick your favorite food</p>
        </div>

        <!-- Step 2 -->
        <div class="step">
            <div class="step-icon">
                <img src="{{ asset('images/step2.png')}}" alt="Order" class="icon">
            </div>
            <h3 class="step-title">Select location</h3>
            <p class="step-description">Choose the location where your food will be delivered</p>
        </div>

        <!-- Step 3 -->
        <div class="step">
            <div class="step-icon">
                <img src="{{ asset('images/step3.png')}}" alt="Order" class="icon">
            </div>
            <h3 class="step-title">Make payment</h3>
            <p class="step-description">It's quick, safe, and secure. Select several methods of payment</p>
        </div>

        <!-- Step 4 -->
        <div class="step">
            <div class="step-icon">
                <img src="{{ asset('images/step4.png')}}" alt="Order" class="icon">
            </div>
            <h3 class="step-title">Enjoy meals</h3>
            <p class="step-description">Food is made and delivered directly to your home</p>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection



<style>
.main {
    background-color: #FFB30E;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    gap: 4rem;
    height: 700px;

}

.left-div {
    flex: 1;
    max-width: 400px;
    position: relative;
    top: -50px;
    left: -120px;
}

.title {
    font-size: 3rem;
    font-weight: bold;
    color: white;
    font-family: 'Poppins';
    margin-bottom: 1rem;
}

.subtitle {
    font-size: 1.2rem;
    color: gray;
    font-weight: bold;
    font-family: 'Poppins';
    line-height: 1.5;
}

.right-div {
    flex: 1;
    max-width: 500px;
    position: relative;
    top: 10px;
    left: 60px;
}

.register-form {
    background-color: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    max-width: 400px;
}

.form-group {
    margin-bottom: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #F17228;
    font-weight: 500;
    font-size: 14px;
}

.form-group input {
    width: 100%;
    max-width: 300px;
    padding: 5px;
    background-color: #FFEDAA;
    border: 1px solid #ddd;
    border-radius: 10px;
    font-size: 1rem;
}

.file-input-wrapper {
    background-color: #FFEDAA;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 10px;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    width: 90%;
    cursor: pointer;
}

.form-group input[type="file"] {
    font-size: 0.8rem;
    cursor: pointer;
    color: #666;
    width: 80%;
}

.input-hint {
    font-size: 12px;
    color: #888;
    margin-top: 4px;
    font-style: italic;
}

.register-btn {
    width: 50%;
    padding: 10px;
    background-color: #F17228;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s;
}

.register-btn:hover {
    background-color: #e6a00d;
}

.login-link{
    color: #FFB30E;
    font-size: 14px;
}

/* How it works section */
.howitworks {
    background: linear-gradient(to bottom, #FFB30E 5%, #FFF8DC 30%, #FFF8DC 45%);
    padding: 5rem 0;
    text-align: center;
}

.howitworks-title {
    color: #F17228;
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 3rem;
    font-family: 'Poppins', sans-serif;
}

.steps-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.step {
    flex: 1;
    min-width: 200px;
    max-width: 250px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.step-icon img {
    width: 45px;
    height: 55px;
    margin-bottom: 1rem;
}


.step-title {
    font-weight: bold;
    margin-bottom: 0.5rem;
    font-family: 'Poppins', sans-serif;
    color: #333;
}

.step-description {
    font-size: 0.8rem;
    color: #666;
    line-height: 1.4;
    font-family: 'Poppins', sans-serif;
}

.error-message {
    color: #d32f2f;
    font-size: 12px;
    margin-top: 5px;
    display: block;
}

</style>

@extends('layouts.app')

@section('content')
 
<div class="main">
     
    <div class="left-div">
        <h1 class="title">Log in</h1>
        <p class="subtitle">Savor every bite—fast, fresh, and healthy!</p>
    </div>

     
    <div class="right-div">
        <form method="POST" action="" class="register-form">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="register-btn">Login</button>

            <br>
             <a class="login-link" href="{{ route('register') }}">
                {{ __("Don't have an account? Register") }}
            </a>
        </form>
    </div>
</div>

{{-- how does it work --}}

<div class="installapp">
    <div class="app-content">
     <div class="app-image">
            <img src="{{ asset('images/mobile app1.png') }}" alt="Mobile App Screenshot">
        </div>

        <div class="app-info">
            <h2 class="app-title">Install the app</h2>
            <p class="app-description">It's never been easier to order healthy food. Look for the finest discounts and you'll be lost in a world of delectable food.</p>
            <div class="app-stores">
                <a href="#" class="store-button">
                    <img src="{{ asset('images/app-store.png') }}" alt="Download on App Store">
                </a>
                <a href="#" class="store-button">
                    <img src="{{ asset('images/g-paly.png') }}" alt="Get it on Google Play">
                </a>
            </div>
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
    height: 600px;

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
}

.form-group {
    margin-bottom: 1.5rem;
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
    padding: 5px;
    background-color: #FFEDAA;
    border: 1px solid #ddd;
    border-radius: 10px;
    font-size: 1rem;
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

/* install app section */
.installapp {
    width: 100%;
    background: linear-gradient(to top, #ffb30ef7 1%, #FFF8DC 25%, #FFF8DC 45%);
    padding: 4rem 0;
}

.app-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
}

.app-info {
    flex: 1;
    max-width: 500px;
}

.app-title {
    font-size: 2rem;
    font-weight: bold;
    color: #F17228;
    margin-bottom: 1.5rem;
    font-family: 'Poppins', sans-serif;
}

.app-description {
    font-size: 0.8rem;
    color: #666;
    line-height: 1.6;
    margin-bottom: 2rem;
    font-family: 'Poppins', sans-serif;
}

.app-stores {
    display: flex;
    gap: 1rem;
}

.store-button img {
    height: 40px;
    transition: transform 0.2s;
}

.store-button:hover img {
    transform: scale(1.05);
}

.app-image {
    flex: 1;
    display: flex;
    justify-content: center;
}

.app-image img {
    max-width: 400px;
    height: auto;
    -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 70%, rgba(0,0,0,0));
    mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 70%, rgba(0,0,0,0));
}

</style>




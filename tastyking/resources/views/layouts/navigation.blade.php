<header>
    <nav>
       <div class="header">

            <div class="logo">
            @if(!Auth::user() ||Auth::user()->role == 'client')
            <a href="{{ route('welcome') }}">
                <img class="icon" src="{{ asset('images/logo tastyking.png')}}"></img>
            </a>
            @elseif(Auth::user()->role == 'chef')
              <a href="{{ route('chef.menu-management') }}">
                <img class="icon" src="{{ asset('images/logo tastyking.png')}}"></img>
              </a>
            @elseif(Auth::user()->role == 'admin')
              <a href="{{ route('dashboard') }}">
                <img class="icon" src="{{ asset('images/logo tastyking.png')}}"></img>
              </a>
            @endif
            </div>


            <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass" style="color: #ffb30e;"></i>
            <input type="text" placeholder="Search Food" />
            </div>


            @auth
                <div class="profile-container">
                    <button id="profile-button" class="profile-button">
                        @php
                            $photoPath = Auth::user()->photo;
                        @endphp

                        @if(!empty($photoPath))
                            <img src="{{ asset('storage/' . $photoPath) }}" alt="Profile" class="profile-image">
                        @else
                            <img src="{{ asset('images/profile.png') }}" alt="Profile" class="profile-image">
                        @endif
                    </button>

                    <div id="profile-dropdown" class="profile-dropdown">
                    @if(Auth::user()->role == 'client')
                        <a href="{{ route('profile') }}" class="dropdown-item"><i class="fa-solid fa-user" style="margin-right: 8px;"></i>Profile</a>
                        <a href="{{ route('order-tracking') }}" class="dropdown-item"><i class="fa-solid fa-bag-shopping" style="margin-right: 8px;"></i>Orders</a>
                        <a href="{{ route('menu') }}" class="dropdown-item"><i class="fa-solid fa-list" style="margin-right: 8px;"></i>Menu</a>
                        <hr>
                    @endif
                        <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i>Logout</a>
                    </div>
                </div>
            @else
                <a class="login-btn" href="{{ route('login') }}">
                    <i class="fa-solid fa-user" style="color: #ffb30e;"></i>
                    Login
                </a>
            @endauth

            @if(Auth::check() && Auth::user()->role == 'client')
            <div class="carte-container">
                <a href="{{ route('cart') }}" class="carte-icon">
                    <i class="fas fa-shopping-cart"></i>
                    @php
                        $cartCount = App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                    @endphp
                    @if($cartCount > 0)
                        <span class="carte-count">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
            @endif
        </div>

    </nav>
</header>



<style>
  nav{
    background-color: #fff7dd;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;

  }
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    width: 80%;
    margin-right: 50px;
  }


  .logo img {
      width: 85%;
  }



  .search-bar {
    display: flex;
    align-items: center;
    background-color: white;
    padding: 6px 8px;
    border-radius: 8px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.06);
    width: 200px;
    margin-left: 380px;
  }

  .search-bar input {
    border: none;
    outline: none;
    margin-left: 8px;
    font-size: 13px;
    color: #555;
    width: 100%;
  }

  .search-icon {
    color: #fbbf24;
    font-size: 16px;
  }


  .login-btn {
    background-color: #fff1c7;
    color: #f59e0b;
    font-weight: bold;
    font-size: 16px;
    padding: 6px 16px;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(255, 200, 100, 0.3);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background 0.2s;
  }

  .login-btn:hover {
    background-color: #ffe9a1;
  }

</style>

<style>
  /* Cart Styles */
  .carte-container {
    display: flex;
    margin-left: -5rem;
  }

  .carte-icon {
    position: relative;
    font-size: 20px;
    color: #ffb30e;
    transition: color 0.3s ease;
  }

  .carte-icon:hover {
    color: #ff7a50;
  }

  .carte-count {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: #ff7a50;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }
</style>

<style>
  .profile-container {
      display: flex;
      align-items: center;
      position: relative;
  }

  .profile-button {
      background: none;
      border: none;
      padding: 2px;
      cursor: pointer;
      border-radius: 50%;
      transition: background-color 0.3s ease;
  }

  .profile-button:hover {
      background-color: #ffb30e;
  }



  .profile-image {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #ffb30e;
  }

  .profile-dropdown {
      position: absolute;
      top: 50px;
      right: 0;
      background-color: white;
      border: 2px solid #fff7dd;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 125px;
      display: none;
      z-index: 1000;
  }

  .dropdown-item {
      display: block;
      padding: 10px 15px;
      color: #333;
      text-decoration: none;
      font-size: 14px;
      transition: background-color 0.2s;
  }

  .dropdown-item:hover {
      background-color: #fff7dd;
      color: #ffb30e;
  }

  .profile-dropdown hr {
      margin: 5px 0;
      border: none;
      border-top: 1px solid #eee;
  }

  .show {
      display: block;
  }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileButton = document.getElementById('profile-button');
        const profileDropdown = document.getElementById('profile-dropdown');
        const profileContainer = document.querySelector('.profile-container');

        if (profileButton && profileDropdown && profileContainer) {
            profileButton.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (profileDropdown.classList.contains('show') && !profileContainer.contains(e.target)) {
                    profileDropdown.classList.remove('show');
                }
            });
        }
    });
</script>


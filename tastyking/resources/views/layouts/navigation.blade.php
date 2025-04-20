<header>
    <nav>
       <div class="header">

            <div class="logo">
              <a href="{{ route('welcome') }}">
                <img class="icon" src="{{ asset('images/logo tastyking.png')}}"></img>
              </a>
            </div>


            <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass" style="color: #ffb30e;"></i>
            <input type="text" placeholder="Search Food" />
            </div>


            <a class="login-btn" href="{{ route('login') }}">
                <i class="fa-solid fa-user" style="color: #ffb30e;"></i>
                Login
            </a>
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


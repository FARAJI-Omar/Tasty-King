
@extends('layouts.app')

@section('content')
<div class="main_div">
    <div class="container">
        <div class="left-div">
            <h1 class="main-title">Are you hungry?</h1>
            <h2 class="subtitle">Fuel Your Day with Freshness – Where Speed Meets Healthy Choices.</h2>

            <div class="order-box">
                <div class="order-text">
                    <h3>Start your Tasty order</h3>
                </div>
                <div class="find-food-btn">
                    <a href="{{ route('menu')}}">Find Food</a>
                </div>
            </div>
        </div>
        <div class="right-div">
            <img src="{{ asset('images/food-main.png') }}" alt="Bowl of healthy food" class="food-image">
        </div>
    </div>
</div>

<div class="howitworks">
    <h2 class="howitworks-title">How does it work</h2>
    <div class="steps-container">

        <div class="step">
            <div class="step-icon">
                <img src="{{ asset('images/step1.png')}}" alt="Order" class="icon">
            </div>
            <h3 class="step-title">Choose order</h3>
            <p class="step-description">Check our hundreds of items to pick your favorite food</p>
        </div>


        <div class="step">
            <div class="step-icon">
                <img src="{{ asset('images/step2.png')}}" alt="Order" class="icon">
            </div>
            <h3 class="step-title">Select location</h3>
            <p class="step-description">Choose the location where your food will be delivered</p>
        </div>


        <div class="step">
            <div class="step-icon">
                <img src="{{ asset('images/step3.png')}}" alt="Order" class="icon">
            </div>
            <h3 class="step-title">Make payment</h3>
            <p class="step-description">It's quick, safe, and secure. Select several methods of payment</p>
        </div>


        <div class="step">
            <div class="step-icon">
                <img src="{{ asset('images/step4.png')}}" alt="Order" class="icon">
            </div>
            <h3 class="step-title">Enjoy meals</h3>
            <p class="step-description">Food is made and delivered directly to your home</p>
        </div>
    </div>
</div>


<div class="popular-items">
    <h2 class="section-title">Popular items</h2>

    <div class="popular-items-slider">
        <div class="popular-items-container">
            <div class="popular-item">
                <div class="item-image">
                    <img src="{{ asset('images/1.jpg') }}" alt="Cheese Burger">
                </div>
                <h3 class="item-name">Honey garlic chicken</h3>
                <p class="item-price">40 dh</p>
                <a href="#" class="order-button">Order now</a>
            </div>
            <div class="popular-item">
                <div class="item-image">
                    <img src="{{ asset('images/2.jpg') }}" alt="Toffe's Cake">
                </div>
                <h3 class="item-name">Fried broccoli</h3>
                <p class="item-price">30 dh</p>
                <a href="#" class="order-button">Order now</a>
            </div>
            <div class="popular-item">
                <div class="item-image">
                    <img src="{{ asset('images/3.jpg') }}" alt="Crispy Sandwich">
                </div>
                <h3 class="item-name">Busy Weeknights</h3>
                <p class="item-price">20 dh</p>
                <a href="#" class="order-button">Order now</a>
            </div>
            <div class="popular-item">
                <div class="item-image">
                    <img src="{{ asset('images/sandwish.png') }}" alt="Thai Soup">
                </div>
                <h3 class="item-name">Crispy sandwich</h3>
                <p class="item-price">15 dh</p>
                <a href="#" class="order-button">Order now</a>
            </div>
        </div>
    </div>
</div>


<div class="installapp">
    <div class="features-banner">
        <div class="features-content">
            <div class="feature">
                <div class="feature-icon">
                    <img src="{{ asset('images/discount.png') }}" alt="Discount icon">
                </div>
                <div class="feature-text">
                    <h3>Daily <br>Discounts</h3>
                </div>
            </div>
            <div class="feature-divider"></div>
            <div class="feature">
                <div class="feature-icon">
                    <img src="{{ asset('images/quick delivery.png') }}" alt="Clock icon">
                </div>
                <div class="feature-text">
                    <h3>Quick <br>Delivery</h3>
                </div>
            </div>
        </div>

    </div>

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

<div class="deals">

    <div class="deal-card">
        <div class="deal-content">
            <h2 class="deal-title">Best deals <span class="highlight">Crispy Sandwiches</span></h2>
            <p class="deal-description">Enjoy the large size of healthy sandwiches. Complete your meal with the perfect slice of sandwiches.</p>
            <a href="#" class="proceed-button">PROCEED TO ORDER <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="deal-image">
            <img src="{{ asset('images/best deals.png') }}" alt="Crispy Sandwiches">
        </div>
    </div>


    <div class="deal-card">
        <div class="deal-image">
            <img src="{{ asset('images/celebrate.png') }}" alt="Fried Chicken">
        </div>
        <div class="deal-content">
            <h2 class="deal-title">Celebrate parties with <span class="highlight">Fried Chicken</span></h2>
            <p class="deal-description">Get the best fried chicken smeared with a lip smacking lemon chili flavor. Check out best deals for fried chicken.</p>
            <a href="#" class="proceed-button">PROCEED TO ORDER <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>


    <div class="deal-card">
        <div class="deal-content">
            <h2 class="deal-title">Wanna eat hot & <span class="highlight">spicy Pizza?</span></h2>
            <p class="deal-description">Pair up with a friend and enjoy the hot and crispy pizza pops. Try it with the best deals.</p>
            <a href="#" class="proceed-button">PROCEED TO ORDER <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="deal-image">
            <img src="{{ asset('images/wanna.png') }}" alt="Spicy Pizza">
        </div>
    </div>
</div>


@include('layouts.footer')
@endsection




<style>
.main_div {
    background-color: #FFB30E;
    overflow: hidden;
    position: relative;
    min-height: 400px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.left-div {
    width: 50%;
    padding-right: 2rem;
}

.main-title {
    font-size: 3rem;
    font-weight: bold;
    color: white;
    margin-bottom: 1rem;
    font-family: 'Poppins', sans-serif;
}

.subtitle {
    font-size: 1.1rem;
    font-weight: bold;
    color: #565656;
    margin-bottom: 2rem;
    line-height: 1.5;
    max-width: 90%;
    font-family: 'Poppins', sans-serif;
}

.order-box {
    background-color: white;
    padding: 1rem;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 320px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-text {
    width: 40%;
}

.order-text h3 {
    font-size: 1.1rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 1rem;
    font-family: 'Poppins', sans-serif;
}

.find-food-btn a {
    display: inline-block;
    background-color: #F17228;
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-family: 'Poppins', sans-serif;
    transition: background-color 0.3s;
}

.find-food-btn a:hover {
    background-color: #e05a0c;
}

.right-div {
    width: 50%;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    overflow: hidden;
    height: 450px;
}

.food-image {
    width: 450px;
    height: 450px;
    object-fit: cover;
    border-radius: 50%;
    position: absolute;
    bottom: -50px;
    right: 0;
}

.promotions {
    background-color: white;
    padding: 3rem 0;
    dsiplay: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.promotions .title {
    font-size: 1rem;
    font-weight: bold;
    color: #F17228;
    margin-bottom: 2rem;
    font-family: 'Poppins', sans-serif;
    justify-self: center;
}

.promotion-cards {
    width: 80%;
    display: flex;
    justify-content: center;
    justify-self: center;
    gap: 50px;
}

.promo-card {
    width: 20%;
    border-radius: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.promo-card:hover {
    transform: translateY(-5px);
}

.promo-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.promo-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.discount-badge {
    position: absolute;
    bottom: 0;
    left: 0;
    background-color: #FFB30E;
    color: white;
    font-size: 20px;
    font-weight: bold;
    padding: 5px 10px;
    border-top-right-radius: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.discount-badge span {
    font-size: 10px;
    line-height: 1;
    margin-left: 2px;
}

.promo-title {
    padding: 12px;
    font-weight: 600;
    color: #333;
    font-size: 14px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}

/* How it works section */
.howitworks {
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

/* Popular Items Section */
.popular-items {
    padding: 60px 0;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.section-title {
    font-size: 1rem;
    font-weight: bold;
    color: #F17228;
    margin-bottom: 2rem;
    font-family: 'Poppins', sans-serif;
    justify-self: center;
}

.popular-items-slider {
    display: flex;
    align-items: center;
    position: relative;
}

.popular-items-container {
    display: flex;
    gap: 50px;
    padding: 10px 0;
}

.popular-item {
    min-width: 250px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    background-color: #fff;
}

.popular-item:hover {
    transform: translateY(-5px);
}

.item-image {
    height: 170px;
    overflow: hidden;
    border-radius: 16px 16px 0 0;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-name {
    padding: 12px;
    font-weight: 600;
    color: #333;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;

}

.item-price {
    font-size: 16px;
    font-weight: 500;
    margin: 5px 15px 15px;
    color: #666;
}

.order-button {
    display: block;
    background-color: #FF7A00;
    color: white;
    text-align: center;
    padding: 8px;
    margin: 10px 15px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s;
}

.order-button:hover {
    background-color: #E56A00;
}

.slider-arrow {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #FFB30E;
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    position: absolute;
    z-index: 10;
    transition: background-color 0.3s;
}

.slider-arrow:hover {
    background-color: #E59D00;
}

.prev-arrow {
    left: -80px;
}

.next-arrow {
    right: -80px;
}


/* install app section */
.installapp {
    width: 100%;
    padding: 4rem 0;
    background: linear-gradient(to top, #ffb30ef7 1%, #FFF8DC 25%, #FFF8DC 45%);
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

/* Features Banner */
.features-banner {
    max-width: 700px;
    margin: 10px auto 80px;
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    padding: 15px;
}

.features-content {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 14px 0;
}

.feature {
    display: flex;
    align-items: center;
    padding: 0 20px;
}

.feature-icon {
    margin-right: 15px;
}

.feature-icon img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

.feature-text h3 {
    font-size: 18px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    color: #FF7A00;
    line-height: 1.2;
    margin: 0;
}

.feature-divider {
    width: 1px;
    height: 60px;
    background-color: #E0E0E0;
    margin: 0 30px;
}

/* Deals Section */
.deals {
    width: 70%;
    justify-self: center;
    margin: -20px;
    display: flex;
    flex-direction: column;
    gap: 60px;
    margin-bottom: 150px;
}

.deal-card {
    display: flex;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    height: 280px;
    transition: transform 0.3s;
}

.deal-card:hover {
    transform: translateY(-5px);
}

.deal-content {
    width: 40%;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.deal-title {
    font-size: 20px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    font-family: 'Poppins', sans-serif;
    line-height: 1.3;
}

.deal-title .highlight {
    display: block;
    color: #FFB30E;
}

.deal-description {
    font-size: 12px;
    color: #666;
    margin-bottom: 25px;
    line-height: 1.6;
    font-family: 'Poppins', sans-serif;
}

.proceed-button {
    display: inline-block;
    background-color: #FFB30E;
    color: white;
    font-weight: 600;
    padding: 10px 24px;
    border-radius: 8px;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 12px;
    transition: background-color 0.3s;
    align-self: flex-start;
    font-family: 'Poppins', sans-serif;
}

.proceed-button:hover {
    background-color: #F17228;
}

.proceed-button i {
    margin-left: 8px;
}

.deal-image {
    flex: 1.2;
    position: relative;
    overflow: hidden;
}

.deal-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Responsive Styles */
@media screen and (max-width: 1200px) {
    .container {
        max-width: 95%;
    }

    .deals {
        width: 85%;
        margin: 0 auto 100px;
    }
}

@media screen and (max-width: 992px) {
    /* Main hero section */
    .container {
        padding: 0 1rem;
    }

    .main-title {
        font-size: 2.5rem;
    }

    .subtitle {
        font-size: 1rem;
    }

    .food-image {
        width: 400px;
        height: 400px;
    }

    /* Popular items section */
    .popular-items-container {
        overflow-x: auto;
        padding: 1rem;
        justify-content: flex-start;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
    }

    .popular-items-container::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Edge */
    }

    /* App section */
    .app-content {
        padding: 0 1rem;
    }

    .app-image img {
        max-width: 350px;
    }

    /* Deals section */
    .deal-card {
        height: auto;
        min-height: 280px;
    }
}

@media screen and (max-width: 768px) {
    /* Main hero section */
    .container {
        flex-direction: column;
    }

    .left-div, .right-div {
        width: 100%;
        padding-right: 0;
        text-align: center;
    }

    .main-title {
        font-size: 2.2rem;
    }

    .subtitle {
        max-width: 100%;
        margin: 0 auto 2rem;
    }

    .order-box {
        margin: 0 auto 2rem;
    }

    .right-div {
        height: 350px;
        justify-content: center;
    }

    .food-image {
        position: relative;
        bottom: 0;
        right: 0;
        width: 350px;
        height: 350px;
    }

    /* How it works section */
    .steps-container {
        flex-wrap: wrap;
    }

    .step {
        min-width: 45%;
    }

    /* Install app section */
    .app-content {
        flex-direction: column-reverse;
    }

    .app-info {
        max-width: 100%;
        margin-top: 2rem;
        text-align: center;
    }

    .app-stores {
        justify-content: center;
    }

    /* Deals section */
    .deal-card {
        flex-direction: column;
    }

    .deal-content, .deal-image {
        width: 100%;
    }

    .deal-image {
        height: 200px;
    }

    .deal-content {
        padding: 1.5rem;
    }
}

@media screen and (max-width: 576px) {
    /* Main hero section */
    .main-title {
        font-size: 2rem;
    }

    .right-div {
        height: 300px;
    }

    .food-image {
        width: 280px;
        height: 280px;
    }

    /* How it works section */
    .step {
        min-width: 100%;
    }

    /* Features banner */
    .features-content {
        flex-direction: column;
    }

    .feature-divider {
        width: 80%;
        height: 1px;
        margin: 15px 0;
    }

    /* App section */
    .app-image img {
        max-width: 280px;
    }

    /* Deals section */
    .deal-title {
        font-size: 1.2rem;
    }

    .deal-description {
        font-size: 0.8rem;
    }

    .proceed-button {
        padding: 8px 16px;
        font-size: 0.7rem;
    }
}
</style>

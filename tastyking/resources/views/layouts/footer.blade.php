<!-- Footer -->
<div class="yellowpart"></div>
<footer class="footer">
    <div class="topline"></div>
    <div class="footer-container">
        <div class="footer-section">
            <h4 class="footer-title">COMPANY</h4>
            <ul class="footer-links">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Team</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4 class="footer-title">CONTACT</h4>
            <ul class="footer-links">
                <li><a href="#">Help & Support</a></li>
                <li><a href="#">Partner with us</a></li>
                <li><a href="#">Ride with us</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4 class="footer-title">LEGAL</h4>
            <ul class="footer-links">
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Refund & Cancellation</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Cookie Policy</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4 class="footer-title">FOLLOW US</h4>
            <div class="social-icons">
                <a href="#" class="social-icon"><span class="icon-placeholder"><img src="{{ asset('images/twitter.png')}}" alt=""></span></a>
                <a href="#" class="social-icon"><span class="icon-placeholder"><img src="{{ asset('images/ig.png')}}" alt=""></span></a>
                <a href="#" class="social-icon"><span class="icon-placeholder"><img src="{{ asset('images/fb.png')}}" alt=""></span></a>
            </div>
            <p class="newsletter-text">Receive exclusive offers and discounts in your mailbox</p>
            <button class="subscribe-btn">Subscribe</button>
        </div>
    </div>

    <div class="footer-bottom">
        <p>All Rights Reserved © TastyKing, {{ date('Y') }}</p>
    </div>
</footer>
<div class="yellowpart"></div>


<style>
/* Footer Styles */
.yellowpart{
    height: 40px; 
    background-color: #FFB30E;
}

.footer {
    background-color: #222;
    color: white;
    padding: 3rem 0 1rem;
}

.topline{
    border-top: 1px solid #444;
    width: 75%;
    padding-bottom: 10px;
    justify-self: center;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    gap: 2rem;
}

.footer-section {
    flex: 1;
    min-width: 200px;
}

.footer-title {
    font-weight: bold;
    margin-bottom: 1.5rem;
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 0.8rem;
}

.footer-links a {
    color: #ccc;
    text-decoration: none;
    transition: color 0.2s;
    font-size: 0.8rem;
}

.footer-links a:hover {
    color: #FFB30E;
}

.social-icons {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    color: white;
    border-radius: 50%;
    text-decoration: none;
    transition: background-color 0.2s;
}

.social-icon:hover {
    background-color: #FFB30E;
}

.icon-placeholder {
    font-size: 14px;
}

.newsletter-text {
    margin-bottom: 1rem;
    font-size: 0.9rem;
    font-weight: bold;
    color: #ccc;
}

.subscribe-btn {
    background-color: #FFB30E;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s;
    font-weight: 500;
    margin-bottom: 10px;
}

.subscribe-btn:hover {
    background-color: #F17228;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    margin-top: 2rem;
    border-top: 1px solid #444;
    font-size: 0.8rem;
    color: #888;
    width: 75%;
    margin: 0 auto;
}

</style>

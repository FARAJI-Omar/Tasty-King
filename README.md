# TastyKing – Online Food Ordering Platform

Welcome to TastyKing, your one-stop solution for discovering, ordering, and enjoying delicious meals from a variety of restaurants. This platform is designed to make food ordering easy, fast, and enjoyable for both customers and restaurant administrators.

---

## Table of Contents

- [About the Project](#about-the-project)
- [Features](#features)
- [Getting Started](#getting-started)
- [Usage](#usage)
- [Technologies Used](#technologies-used)
- [Contributing](#contributing)
- [License](#license)

---

## About the Project

TastyKing is an intuitive web application that connects users with a wide selection of meals and restaurants. Whether you are a customer looking to order your favorite dish or an administrator managing restaurant offerings, TastyKing provides a seamless experience tailored to your needs.

---

## Features

- **User Registration & Authentication:** Secure sign-up, login, and profile management for customers and administrators.
- **Meal Browsing & Search:** Explore meals by category, view detailed descriptions, and find exactly what you crave.
- **Shopping Cart & Orders:** Add meals to your cart, place orders, and track your order history with ease.
- **Reviews & Ratings:** Share your feedback and read reviews from other customers to make informed choices.
- **Admin Dashboard:** Manage meals, categories, and orders efficiently with powerful administrative tools.
- **Secure Payments:** Enjoy safe and reliable payment processing and session management.

---

## Getting Started

To get a local copy up and running, follow these simple steps:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/tastyking.git
   ```
2. **Install dependencies:**
   ```bash
   cd tastyking
   composer install
   npm install
   ```
3. **Set up environment:**
   - Copy `.env.example` to `.env` and update your database and mail settings.
   - Generate application key:
     ```bash
     php artisan key:generate
     ```
4. **Run migrations:**
   ```bash
   php artisan migrate
   ```
5. **Start the development server:**
   ```bash
   php artisan serve
   npm run dev
   ```

---

## Usage

- Visit the homepage to browse available meals and categories.
- Register or log in to place orders and manage your account.
- Use the admin dashboard to add or update meals, categories, and view orders.

---

## Technologies Used

- **Laravel** – Robust PHP framework for backend development
- **MySQL** – Reliable database management
- **Vite** – Fast asset bundling and frontend tooling
- **HTML, CSS, JavaScript** – For a dynamic and interactive user interface

---

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes. For major changes, please open an issue first to discuss what you would like to change.

---

## License

This project is licensed under the MIT License.

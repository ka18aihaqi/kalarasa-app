Kalarasa App

📌 About Kalarasa App

Kalarasa App is a web application built with Laravel, designed to provide a seamless user experience for managing and exploring culinary delights. This application leverages the power of Laravel's robust framework to deliver an efficient and scalable solution.

🚀 Features

🔥 User Authentication & Authorization

👥 User Management (Admin & Regular Users)

🛍 Product Management System

Admin can add products for any user

Regular users can only add products for themselves

📊 Dashboard & Analytics

🛠 Tech Stack

Backend: Laravel, PHP

Frontend: Blade, Tailwind CSS

Database: MySQL

Authentication: Laravel Sanctum / Passport

📖 Installation Guide

Follow these steps to set up Kalarasa App on your local machine:

Prerequisites

PHP 8+

Composer

Node.js & npm

MySQL

Steps

# Clone the repository
git clone https://github.com/ka18aihaqi/kalarasa-app.git
cd kalarasa-app

# Install dependencies
composer install
npm install && npm run dev

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env file and then run migrations
php artisan migrate --seed

# Start the application
php artisan serve

📚 Learning Laravel

To learn more about Laravel, check out the official Laravel Documentation or explore Laracasts for in-depth video tutorials.

🤝 Contributing

We welcome contributions! Feel free to fork this repo and submit a pull request.

📜 License

This project is open-source and licensed under the MIT License.

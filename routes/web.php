<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

// Navbar //

Route::get('/', function () {
    return view('welcome');
})->name('welcome.page');

Route::get('/index', function () {
    return view('index');
})->name('homepage');

Route::get('/products', [ProductController::class, 'index'], function () {
    return view('products', ['title' => 'Our Products', 'products' => Product::all()]);
})->name('products.page');

Route::get('/users', [UserController::class, 'users'])->name('users.page');

Route::get('/login', function () {
    return view('/login');
})->name('login.page');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('/register');
})->name('register.page');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/index')->with('success', 'You have successfully logged out.');
})->name('logout');

Route::get('/profile', function () {
    return view('profile');
})->name('profile.page');

// Navbar //

// Products //

Route::get('/product/{product:slug}', function (Product $product) {
    return view('product', ['product' => $product]);
})->name('productdetail.page');

Route::get('/barista/{user}', function (User $user) {
    return view('products', [
        'title' => 'Coffee made by ' . $user->name,
        'products' => $user->products,
        'users' => User::all(), // Tambahkan ini
        'id' => $user->id, // Supaya barista terpilih otomatis
        'search' => ''
    ]);
})->name('products.by.user');

Route::get('/productedit/{product_id}', [ProductController::class, 'edit'])->name('product.edit');

Route::delete('/product/{product_id}', [ProductController::class, 'destroy'])->name('product.delete');

Route::post('/products', [ProductController::class, 'addNewProduct'])->name('products.add');

Route::put('/product/{product_id}', [ProductController::class, 'update'])->name('product.update');

// Products //

// Users //

Route::get('/user/{username}', [UserController::class, 'userDetail'])->name('userdetail.page');

Route::get('/user/{username}/useredit', [UserController::class, 'userEdit'])->name('useredit.page');

Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');

Route::put('/user/update', [UserController::class, 'update'])->name('user.update');

Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.edit');

// Users //
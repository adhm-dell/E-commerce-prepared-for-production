<?php

use App\Jobs\LogCreatedUser;
use App\Livewire\Auth\Forgot;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessPage;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

Route::get('/', HomePage::class)->name('home');
Route::get('/categories', CategoriesPage::class)->name('categories');
Route::get('/products', ProductsPage::class)->name('products');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/products/{slug}', ProductDetailPage::class)->name('product-detail');

Route::get('/checkout', CheckoutPage::class)->name('checkout');
Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
Route::get('/my-orders/{order}', MyOrderDetailPage::class)->name('my-order-detail');

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/forgot', Forgot::class)->name('forgot');
Route::get('/reset-password', ResetPassword::class)->name('reset-password');

Route::get('/success', SuccessPage::class)->name('success');
Route::get('/cancel', CancelPage::class)->name('cancel');

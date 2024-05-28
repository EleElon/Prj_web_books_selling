<?php

use App\Http\Controllers\Controllers;
use App\Http\Controllers\CrudProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\favorite;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('crud_user.create');
});

Route::get('list', [CrudUserController::class, 'listUser'])->name('user.list');


Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');
Route::get('signout', [CrudUserController::class, 'signOut'])->name('signout');


Route::get('dashboard', [CrudUserController::class, 'dashboard']);

Route::get('create', [CrudUserController::class, 'createUser'])->name('user.createUser');
Route::post('create', [CrudUserController::class, 'postUser'])->name('user.postUser');


Route::get('read', [CrudUserController::class, 'readUser'])->name('user.readUser');
Route::get('delete', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');


Route::get('update', [CrudUserController::class, 'updateUser'])->name('user.updateUser');
Route::post('update', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');


// home
//Route::get('homes', [Controllers::class, 'home'])->name('homes');
Route::get('home', [Controllers::class, 'index'])->name('listHome');
// nav
Route::get('nav', [Controllers::class, 'nav'])->name('nav');


//cart
Route::get('shoppingCart/{id}', [Controllers::class, 'addToCart'])->name('addToCart');
Route::get('delete-cart/{id}', [Controllers::class, 'deleteCart'])->name('deleteCart');

Route::get('cart', [Controllers::class, 'showCart'])->name('cart');
Route::get('Detail-cart', [Controllers::class, 'Detail'])->name('Detail');


Route::get('favoritecart/{id}', [favorite::class, 'addfavorite'])->name('addfavorite');
Route::get('cartfovorite', [favorite::class, 'showFavorites'])->name('cartfovorite');
Route::get('delete-cartfovorite/{id}', [favorite::class, 'deleteFavorite'])->name('deleteFavorite');
Route::get('phantrang', [Controllers::class, 'index'])->name('phantrang');


Route::get('listproduct', [CrudProductController::class, 'listproduct'])->name('product.list');

Route::get('add-product', [CrudProductController::class, 'addproduct'])->name('product.add');
Route::post('add-product', [CrudProductController::class, 'postProduct'])->name('user.postProduct');
Route::get('delete-product', [CrudProductController::class, 'deleteProduct'])->name('product.deleteProduct');

Route::get('/products/{id}/edit', [CrudProductController::class,'editProduct'])->name('product.edit');
Route::put('/products/{id}', [CrudProductController::class,'updateProduct'])->name('product.update');

Route::get('forgot-password', [CrudUserController::class, 'showUpdatePasswordForm'])->name('crud_user.forgot_password');
Route::post('forgot-password', [CrudUserController::class, 'forgotPassword'])->name('forgot.password');

//Route::post('submit-review', [ReviewController::class, 'submitReview'])->name('submitReview');


// Route::post('/submit-review', 'ReviewController@submitReview')->name('submitReview');


Route::get('/product/{id}', [ReviewController::class, 'show'])->name('product.show');
Route::post('/submitReview', [ReviewController::class, 'store'])->name('submitReview');


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

// Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
// Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::post('/checkout/pay', [CheckoutController::class, 'index'])->name('checkout.pay');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('processCheckout');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/payments', [CheckoutController::class, 'showPayments'])->name('payments.show');

Route::get('/order-status', [CheckoutController::class, 'orderStatus'])->name('order.status');


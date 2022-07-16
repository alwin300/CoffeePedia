<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CoffeeInfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckOngkirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Files;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group (['middleware' => ['auth','CekRole:seller']], function() {

    Route::resource('/product', ProductController::class)->except('destroy');
    Route::get('/product/{product}/delete', [ProductController::class, 'delete']);
    Route::get ('/orderbaru', [ProductController::class, 'newOrder']);
    Route::get('/orderbaru/{id}', [ProductController::class, 'addResi']);
    Route::post('/updateresi/{id}', [ProductController::class, 'updateResi']);
    Route::get('/historyseller', [PesanController::class, 'historyseller']);
    // Route::get('/history/report', [PesanController::class, 'reportSeller']);
// Route::get('/tampilproduk', [ProdukController::class, 'tampilproduk']);
// Route::get('/tambahdataproduk', [ProdukController::class, 'tampilformproduk']);
// Route::get('/editproduk/{product}', [ProdukController::class, 'tampilformeditproduk'])->name('product.edit');
// Route::get('/deleteproduk/{id}', [ProdukController::class, 'deleteproduk']);
// Route::post('/insertproduk', [ProdukController::class, 'insertproduk']);
// Route::post('/updateproduk/{id}', [ProdukController::class, 'updateproduk'])->name('product.update');
// Route::get('/viewproduk/{id}', [ProdukController::class, 'viewproduk']);
// Route::get ('/orderbaru', [ProdukController::class, 'orderbaru']);
// Route::get('/orderbaru/{id}', [ProdukController::class, 'orderbaruresi']);
// Route::post('/updateresi/{id}', [ProdukController::class, 'updateresi']);

});
Route::group (['middleware' => ['auth','CekRole:buyer,seller,admin']], function() {
Route::get('/etalase', [ProductController::class, 'etalase']);
Route::get('/etalase/{produk}', [ProductController::class, 'view']);
Route::get('/etalase/review/{produk}', [ProductController::class, 'review']);
});
Route::group (['middleware' => ['auth','CekRole:buyer']], function() {
Route::get('/wishlist/{produk}', [WishlistController::class, 'addWishlist']);
Route::get('/wishlist', [WishlistController::class, 'showWishlist']);
Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'deleteWishlist']);
Route::post('order/{produk}', [PesanController::class, 'order']);
Route::get('/cart', [PesanController::class,'cart']);
Route::delete('/cart/{pesanan}', [PesanController::class, 'deleteOrder']);
Route::get('/cart/edit/{id}' ,[PesanController::class,'formEditCart']);
Route::post('/cart/update/{order_id}/{product_id}', [PesanController::class, 'editCart']);
Route::get('/history', [PesanController::class, 'history']);
Route::get('/editpayment/{id}', [PesanController::class, 'editPayment'])->name('edit.payment');
Route::post('/updatepayment/{id}', [PesanController::class, 'updatePayment']);
Route::get('/history/{id}', [PesanController::class, 'historyStatus']);
Route::get('/review/{payment}/{idproduct}', [ReviewController::class, 'addReview']);
Route::post('/reviews/{payment}/{idproduct}', [ReviewController::class,'storeReview']);


Route::get('/checkout/{id}', [CheckOngkirController::class, 'checkout']);
Route::get('province', [CheckOngkirController::class, 'get_province'])->name('province');
Route::get('/kota/{id}',[CheckOngkirController::class, 'get_city']);
Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}',[CheckOngkirController::class, 'get_ongkir']);
Route::post('/payment/{id}', [CheckOngkirController::class, 'payment']);
});


Route::get('/coffeeinfo', [CoffeeInfoController::class, 'showCoffeeInfo']);
Route::get('/coffeeinfo/{id}', [CoffeeInfoController::class, 'viewCoffeeinfo']);

Route::group (['middleware' => ['auth','CekRole:admin']], function() {
Route::get('/tambahdatacoffeeinfo', [CoffeeInfoController::class, 'addCoffeeInfo'])->middleware('auth');
Route::post('/insertcoffeeinfo', [CoffeeInfoController::class, 'insertCoffeeInfo'])->middleware('auth');
Route::get('/coffeeinfo/delete/{id}', [CoffeeInfoController::class, 'deleteCoffeeInfo'])->middleware('auth');
Route::get('/coffeeinfo/edit/{id}', [CoffeeInfoController::class, 'editCoffeeInfo'])->middleware('auth');
Route::post('/updatecoffeeinfo/{id}', [CoffeeInfoController::class, 'updateCoffeeInfo'])->middleware('auth');

Route::get('/user', [AdminController::class, 'showUser']);
Route::get('/user/add', [AdminController::class, 'addUser']);
Route::post('/adduser', [AdminController::class, 'storeUser']);
Route::get('/verifikasiorder', [AdminController::class, 'verificationOrder']);
Route::get('/verifikasiorder/{id}', [AdminController::class, 'verificationStatus']);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/profile', [LoginController::class, 'profile']);
Route::post('/profile/{id}', [LoginController::class, 'update']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Product_detail;
use App\Http\Controllers\Store;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::prefix('')->group(function(){
    Route::get('/',[MyController::class,'index'])->name('customer.index');
    // Route::get('/new-products/{number}',[MyController::class,'getnewproduct']);
});



Route::prefix('store')->group(function () {
    Route::get('/', [Store::class, 'index'])->name('store');
    Route::get('/manu/{manu_id}', [Store::class, 'show_manuid']);
    Route::get('/type/{type_id}', [Store::class, 'show_typeid']);
    Route::get('keyword/', [Store::class,'search'])->name('keyword');
});
Route::prefix('product')->group(function () {
    Route::get('/{id}', [Product_detail::class, 'show']);
});
Route::prefix('bill')->group(function () {
    Route::get('/', [BillController::class, 'index']);
    Route::get('/bought', [BillController::class, 'bought'])->name('bill.bought');
    Route::get('/bought/{bill_id}', [BillController::class, 'bought_bill_id']);
    Route::post('/add', [BillController::class, 'addbill']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth']], function () {
    Route::get('', function () {
        return view('admin.index');
    })->name('admin');

    Route::prefix('products')->group(function () {
        Route::get('', [AdminController::class, 'show_products'])->name('products');
        Route::get('/add', [AdminController::class, 'show_add_product']);
        Route::get('/edit/{product_id}', [AdminController::class, 'show_edit_product']);
        Route::post('/add-product', [AdminController::class, 'add_product']);
        Route::post('/edit-product', [AdminController::class, 'edit_product']);
        Route::get('/delete-product/{id}', [AdminController::class, 'delete_product']);
        Route::get('/comments/{id}', [AdminController::class, 'show_comment_product_id']);
        Route::get('/comments/remove/{id}', [AdminController::class, 'remove_comment']);
    });
    Route::prefix('protypes')->group(function () {
        Route::get('', [AdminController::class, 'show_protypes'])->name('protypes');
        Route::get('/add', [AdminController::class, 'show_add_protype']);
        Route::get('/edit/{type_id}', [AdminController::class, 'show_edit_protype']);
        Route::post('/add-protype', [AdminController::class, 'add_protype']);
        Route::post('/edit-protype', [AdminController::class, 'edit_protype']);
        Route::get('/delete-protype/{type_id}', [AdminController::class, 'delete_protype']);
    });
    Route::prefix('manufactures')->group(function () {
        Route::get('', [AdminController::class, 'show_manufactures'])->name('manufactures');
        Route::get('/add', [AdminController::class, 'show_add_manufacture']);
        Route::get('/edit/{manu_id}', [AdminController::class, 'show_edit_manufacture']);
        Route::post('/add-manufacture', [AdminController::class, 'add_manufacture']);
        Route::post('/edit-manufacture', [AdminController::class, 'edit_manufacture']);
        Route::get('/delete-manufacture/{manu_id}', [AdminController::class, 'delete_manufacture']);
    });
    Route::prefix('bills')->group(function () {
        Route::get('', [AdminController::class, 'show_bills'])->name('admin.bills');
        Route::get('/{id}', [AdminController::class, 'billbyid']);
        Route::get('/confirm/{id}', [AdminController::class, 'confirm_bill']);
        Route::get('/unconfirm/{id}', [AdminController::class, 'unconfirmed']);
        Route::get('/remove/{id}', [AdminController::class, 'remove_bill']);
    });
});

Route::get('/send', [MyController::class, 'sendMail'])->name('send.mail');
Route::post('/add-to-cart', [CartController::class, 'addtocart']);
Route::get('/remove-cart/{id}', [CartController::class, 'removecart']);
Route::get('/view-cart',[CartController::class,'showviewcart']);
Route::get('/add-wishlist/{product_id}',[MyController::class,'addwishlist']);
Route::get('/remove-wishlist/{product_id}',[MyController::class,'removewishlist']);
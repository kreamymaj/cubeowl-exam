<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    
    return view('auth/login');
});

Auth::routes();

// HOME
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('stores/inactive', [App\Http\Controllers\HomeController::class, 'inActiveStore'])->name('stores.inactive');
    Route::get('products/inactive', [App\Http\Controllers\HomeController::class, 'inActiveProduct'])->name('products.inactive');



// STORE
    Route::get('stores', [App\Http\Controllers\StoreController::class, 'index'])->name('stores');
    Route::get('stores/count', [App\Http\Controllers\StoreController::class, 'count'])->name('stores.count');

    Route::get('create_stores', [App\Http\Controllers\StoreController::class, 'create'])->name('create_stores');
    Route::post('create_stores', [App\Http\Controllers\StoreController::class, 'store'])->name('create_stores');
   
    Route::get('update_stores/{storeID}', [App\Http\Controllers\StoreController::class, 'edit'])->name('update_stores');
    Route::post('update_stores/{storeID}', [App\Http\Controllers\StoreController::class, 'update'])->name('update_stores');
    Route::delete('delete_stores/{storeID}', [App\Http\Controllers\StoreController::class, 'deleteStore'])->name('delete_stores');
  
// PRODUCTS
    Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('products/count', [App\Http\Controllers\ProductController::class, 'count'])->name('products.count');

    Route::get('create_products', [App\Http\Controllers\ProductController::class, 'create'])->name('create_products');
    Route::post('create_products', [App\Http\Controllers\ProductController::class, 'store'])->name('create_products');

    Route::get('update_products/{productID}', [App\Http\Controllers\ProductController::class, 'edit'])->name('update_products');
    Route::post('update_products/{productID}', [App\Http\Controllers\ProductController::class, 'update'])->name('update_products');
    Route::delete('delete_products/{productID}', [App\Http\Controllers\ProductController::class, 'deleteService'])->name('delete_products');
    Route::post('change_image/{productID}', [App\Http\Controllers\ProductController::class, 'changeImage'])->name('change_image');
    Route::post('delete_image/{productID}', [App\Http\Controllers\ProductController::class, 'deleteImage'])->name('delete_image');

// USERS
    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('users/count', [App\Http\Controllers\UserController::class, 'count'])->name('users.count');

    Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
    Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register');

    Route::get('update_user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('update_user');
    Route::post('update_user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update_user');
    Route::delete('delete_user/{id}', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete_user');

    
    Route::get('user_permission', [App\Http\Controllers\UserController::class, 'permissions'])->name('user_permission');


// HISTORY
    Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history');
    Route::get('/history/view/{week}', [App\Http\Controllers\HistoryController::class, 'viewLogs'])->name('history.view');


// BIN
    Route::get('trash', [App\Http\Controllers\TrashController::class, 'index'])->name('trash');
    Route::get('trash', [App\Http\Controllers\TrashController::class, 'deleted'])->name('trash');

    Route::post('restore_product/{productID}', [App\Http\Controllers\TrashController::class, 'restoreProduct'])->name('restore_product');
    Route::delete('destroy_product/{productID}', [App\Http\Controllers\TrashController::class, 'destroyProduct'])->name('destroy_product');

    Route::post('restore_stores/{storeID}', [App\Http\Controllers\TrashController::class, 'restoreStore'])->name('restore_stores');
    Route::delete('destroy_stores/{storeID}', [App\Http\Controllers\TrashController::class, 'destroyStore'])->name('destroy_stores');

    Route::post('restore_user/{id}', [App\Http\Controllers\TrashController::class, 'restoreUser'])->name('restore_user');
    Route::delete('destroy_user/{id}', [App\Http\Controllers\TrashController::class, 'destroyUser'])->name('destroy_user');


// Auth Middleware
    Route::middleware('auth')->group(function () {
    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

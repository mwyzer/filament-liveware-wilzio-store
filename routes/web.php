<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;

//route register
Route::get('/register', Auth\Register::class)->name('register');

//route login
Route::get('/login', Auth\Login::class)->name('login');

//route group account
Route::middleware('auth:customer')->group(function () {
    
    Route::group(['prefix' => 'account'], function () {
        
        //route my order
        Route::get('/my-orders', Account\MyOrders\Index::class)->name('account.my-orders.index');
  
        //route my order show
        Route::get('/my-orders/{snap_token}', Account\MyOrders\Show::class)->name('account.my-orders.show');

        //route my profile
        Route::get('/my-profile', Account\MyProfile\Index::class)->name('account.my-profile');

        //route password
        Route::get('/password', Account\Password\Index::class)->name('account.password');

    });

});

//route home
Route::get('/', Web\Home\Index::class)->name('home');
<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['user.auth']], function(){
    Route::get('/', [\App\Http\Controllers\Index::class, 'index'])->name('index');
    Route::get('login', [\App\Http\Controllers\UserAuth::class, 'loginIndex'])->name('login');
    Route::get('my-cards', [\App\Http\Controllers\Cards::class, 'myCards'])->name('my-cards');
    Route::post('loginPost', [\App\Http\Controllers\UserAuth::class, 'loginPost'])->name('loginPost');
    Route::get('register', [\App\Http\Controllers\UserAuth::class, 'registerIndex'])->name('register');
    Route::post('registerPost', [\App\Http\Controllers\UserAuth::class, 'registerPost'])->name('registerPost');
    Route::get('forget-password', [\App\Http\Controllers\UserAuth::class, 'forgetPasswordIndex'])->name('forget-password');
    Route::get('logout', [\App\Http\Controllers\UserAuth::class, 'logout'])->name('logout');
    Route::get('settings', [\App\Http\Controllers\Settings::class, 'index'])->name('settings');
    Route::get('my-contacts', [\App\Http\Controllers\Contacts::class, 'index'])->name('my-contacts');
    Route::get('my-transactions', [\App\Http\Controllers\Transactions::class, 'index'])->name('my-transactions');
    Route::post('changeUsernamePost', [\App\Http\Controllers\Settings::class, 'changeUsernamePost'])->name('changeUsernamePost');
    Route::post('changePasswordPost', [\App\Http\Controllers\Settings::class, 'changePasswordPost'])->name('changePasswordPost');
    Route::post('changeCard', [\App\Http\Controllers\Cards::class, 'changeCard'])->name('changeCard');
    Route::post('addCard', [\App\Http\Controllers\Cards::class, 'addCard'])->name('addCard');
    Route::post('addContact', [\App\Http\Controllers\Contacts::class, 'addContact'])->name('addContact');
    Route::post('editContact', [\App\Http\Controllers\Contacts::class, 'editContact'])->name('editContact');
    Route::post('addMoney', [\App\Http\Controllers\Transactions::class, 'addMoney'])->name('addMoney');
    Route::post('sendMoney', [\App\Http\Controllers\Transactions::class, 'sendMoney'])->name('sendMoney');
    Route::get('deleteCard/{id}', [\App\Http\Controllers\Cards::class, 'deleteCard'])->name('deleteCard');
});



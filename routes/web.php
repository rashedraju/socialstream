<?php

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get( '/', [WelcomeController::class, 'welcome']);

Auth::routes();

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::post('/home/savestatus', [HomeController::class, 'saveStatus'])->name('home.saveStatus');

Route::get('/user/{name}', [HomeController::class, 'userShout'])->name('user');
Route::get('/user/makefriend/{friendId}', [HomeController::class, 'makeFriend'])->name('user.makefriend');
Route::get('/user/unfriend/{friendId}', [HomeController::class, 'unfriend'])->name('user.unfriend');

Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/profile/saveProfile', [HomeController::class, 'saveProfile'])->name('profile.saveProfile');

Route::get('/about', function(){
    return view('about');
});

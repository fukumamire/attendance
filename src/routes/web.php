<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
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


// 会員登録ページ
// 会員登録画面の表示
Route::get('/register', [AuthController::class, 'create'])->middleware('guest')->name('register');

// 会員登録処理　register.storeはルート名
Route::post('/register', [AuthController::class, 'store'])->middleware('guest')->name('register.store');

// ログインページ
// Route::get('/login', function () {
//     return view('auth.login');
// });
Route::post('/login', [AuthController::class, 'store'])->middleware('guest')->name('login');

// ログアウト処理
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');


// 打刻ページの表示
// Route::get('/', function () {
//     return view('auth.stamp');
// });

Route::get('/', function () {
    return view('auth.stamp');
})->name('home');

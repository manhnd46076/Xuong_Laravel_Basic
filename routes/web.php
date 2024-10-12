<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
// ->middleware('auth.basic')
Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])
        ->name('customers.forceDestroy');

});
// 
// Route::resource('customers', CustomerController::class);
// Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])
//     ->name('customers.forceDestroy');

Route::middleware(['flag'])->group(function () {

    // Route::get('keke', function () {
    //     return view('welcome');
    // })->withoutMiddleware('auth');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('login', function () {
//     echo 'Đây là trang login!';
//     die;
// })->name('login');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Bài tập buổi 5
// Bài 1
Route::middleware(['age'])->group(function () {
    Route::get('movie', function () {
        echo 'Chào mừng tới rạp chiều phim cô đơn';
    });
});

Route::get('alert', function () {
    echo 'Cảnh báo dưới 18+ không được xem phim người lớn';
    die;
})->name('alert');

// Bài 2 kiểm tra quyền
Route::middleware(['role:admin'])->group(function () {

    Route::get('/admin', function () {
        echo 'Chào mừng đến trang admin ';
    });

   
});
Route::middleware(['role:nhanvien'])->group(function () {
    Route::get('/orders', function () {
        echo 'Chào mừng đến trang Order - nhan vien';
    });
  
});
Route::middleware(['role:khachhang'])->group(function () {
    Route::get('/profile', function () {
        echo 'Chào mừng đến trang profile - khach hang';
    });
});

Route::get('alert-role', function () {
    echo 'Bạn không có quyền đăng nhập vào đây';
    die;
});
// Bài 3
// auth
// Route::get('/register',[RegisterController::class]);





// Buổi 5
Route::get('/sesion', function () {
    session()->put('ahihi', 'jqrk');
    return session()->get('ahihi', '789');
});
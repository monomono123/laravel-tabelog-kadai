<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\User\Ajax\SubscriptionController;


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
    return to_route('restaurants.index');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
Route::resource('restaurants', RestaurantController::class);

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::post('favorites/{restaurant_id}', [FavoriteController::class, 'store'])->name('favorites.store');
 Route::delete('favorites/{restaurant_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

 Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');

    Route::get('users/mypage/reservations', 'reservations')->name('mypage.reservations');
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    });
 });

 Route::resource('reservations', ReservationController::class);

 Route::resource('users','UsersController',['only'=>['show','destroy']]);

 Route::prefix('users')->middleware(['auth'])->group(function() {

    // 課金
    Route::get('subscription', [SubscriptionController::class,'index']);
    Route::get('ajax/subscription/status', [SubscriptionController::class, 'status']);
    Route::post('ajax/subscription/subscribe', [SubscriptionController::class,'subscribe']);
    Route::post('ajax/subscription/cancel', [SubscriptionController::class,'cancel']);
    Route::post('ajax/subscription/resume', [SubscriptionController::class, 'resume']);
    Route::post('ajax/subscription/change_plan', [SubscriptionController::class, 'change_plan']);
    Route::post('ajax/subscription/update_card', [SubscriptionController::class, 'update_card']);

});
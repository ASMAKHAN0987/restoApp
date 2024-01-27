<?php

use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\Frontend\Welcome;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\AdminController ;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\MenuController  as FrontendMenuController;
use App\Http\Controllers\Frontend\CategoryController  as FrontendCategoryController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;



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

Route::get('/', [Welcome::class,'index']);
Route::get('/categories',[FrontendCategoryController::class,'index'])->name('categories.index');
Route::get('/categories/{category}',[FrontendCategoryController::class,'show'])->name('categories.show');
Route::get('/menus',[FrontendMenuController::class,'index'])->name('menus.index');
Route::get('/reservation/step-one',[FrontendReservationController::class,'stepOne'])->name('reservation.step.one');
Route::post('/reservation/step-one',[FrontendReservationController::class,'storeStepOne'])->name('reservation.store.step.one');
Route::get('/reservation/step-two',[FrontendReservationController::class,'stepTwo'])->name('reservation.step.two');
Route::post('/reservation/step-two',[FrontendReservationController::class,'storeStepTwo'])->name('reservation.store.step.two');
Route::get('/thankyou',[Welcome::class,'thankyou'])->name('thankyou');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories',CategoryController::class);
    Route::resource('/menus',MenuController::class);Route::resource('/tables',TableController::class);Route::resource('/reservation',ReservationController::class);
});

require __DIR__.'/auth.php';

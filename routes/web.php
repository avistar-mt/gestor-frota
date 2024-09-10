<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchVehicleController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebitController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;

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
	return redirect('/default');
})->middleware('auth');


Route::get('/auth/redirect', [AuthController::class, 'redirectToProvider'])->name('auth.microsoft');
Route::get('/auth/callback', [AuthController::class, 'handleProviderCallback']);


Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/default', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(UserController::class)->group(function() {
        Route::get('/user-management', 'index')->name('user-management');
        Route::get('/user-management/new', 'create')->name('user-new');
        Route::post('/user-management/new', 'store')->name('user-new.store');
        Route::get('/user-management/edit/{id}', 'edit')->name('user-edit');
        Route::post('/user-management/edit/{id}', 'update')->name('user-edit.update');
        Route::post('/user-delete/{id}', 'destroy')->name('user-destroy');
    });

    Route::controller(RoleController::class)->group(function() {
        Route::get('/role-management', 'index')->name('role-management');
        Route::get('/role-management/new', 'create')->name('role-new');
        Route::post('/role-management/new', 'store')->name('role-new.store');
        Route::get('/role-management/edit/{id}', 'edit')->name('role-edit');
        Route::post('/role-management/edit/{id}', 'update')->name('role-edit.update');
        Route::post('/role-delete/{id}', 'destroy')->name('role-destroy');
    });

    
    Route::controller(BranchController::class)->group(function() {
        Route::get('/branch-management', 'index')->name('branch-management');
        Route::get('/branch-management/new', 'create')->name('branch-new');
        Route::post('/branch-management/new', 'store')->name('branch-new.store');
        Route::get('/branch-management/edit/{id}', 'edit')->name('branch-edit');
        Route::post('/branch-management/edit/{id}', 'update')->name('branch-edit.update');
        Route::post('/branch-delete/{id}', 'destroy')->name('branch-destroy');
    });

    Route::controller(CityController::class)->group(function() {
        Route::get('/city-management', 'index')->name('city-management');
        Route::get('/city-management/new', 'create')->name('city-new');
        Route::post('/city-management/new', 'store')->name('city-new.store');
        Route::get('/city-management/edit/{id}', 'edit')->name('city-edit');
        Route::post('/city-management/edit/{id}', 'update')->name('city-edit.update');
        Route::post('/city-delete/{id}', 'destroy')->name('city-destroy');
    });
    
    Route::controller(VehicleController::class)->group(function() {
        Route::get('/vehicle-management', 'index')->name('vehicle-management');
        Route::get('/vehicle-management/new', 'create')->name('vehicle-new');
        Route::post('/vehicle-management/new', 'store')->name('vehicle-new.store');
        Route::get('/vehicle-management/edit/{id}', 'edit')->name('vehicle-edit');
        Route::post('/vehicle-management/edit/{id}', 'update')->name('vehicle-edit.update');
        Route::post('/vehicle-delete/{id}', 'destroy')->name('vehicle-destroy');
    });


    Route::controller(ReservationController::class)->group(function() {
        Route::get('/reservation-management', 'index')->name('reservation-management');
        Route::get('/reservation-management/new', 'create')->name('reservation-new');
        Route::post('/reservation-management/new', 'store')->name('reservation-new.store');
        Route::get('/reservation-management/edit/{id}', 'edit')->name('reservation-edit');
        Route::post('/reservation-management/edit/{id}', 'update')->name('reservation-edit.update');
        Route::post('/reservation-delete/{id}', 'destroy')->name('reservation-destroy');
        Route::post('/reservation-status/{id}', 'updateStatus')->name('reservation-status');
        Route::get('reservations/report', 'reportForm')->name('reservation-reportForm');
        Route::post('/reservations/generateReport', 'generateReport')->name('reservation-generateReport');
        Route::post('/reservations/exportReport', 'exportReport')->name('reservation-exportReport');
    });
    
    Route::controller(CheckinController::class)->group(function() {
        Route::get('/reservations/{reservation}/checkin', 'index')->name('reservation-checkin');
        Route::post('/reservations/{reservation}/checkin/{id}', 'update')->name('reservation-checkin.update');
    });

    Route::controller(CheckoutController::class)->group(function() {
        Route::get('/reservations/{reservation}/checkout', 'index')->name('reservation-checkout');
        Route::get('/reservations/{reservation}/checkout/{id}', 'edit')->name('reservation-checkout.edit');
        Route::post('/reservations/{reservation}/checkout/{id}', 'update')->name('reservation-checkout.update');
    });

    Route::controller(BranchVehicleController::class)->group(function() {
        Route::get('/branch-vehicle-management', 'index')->name('branch-vehicle-management');
        Route::get('/branch-vehicle-management/new', 'create')->name('branch-vehicle-new');
        Route::post('/branch-vehicle-management/new', 'store')->name('branch-vehicle-new.store');
        Route::get('/branch-vehicle-management/edit/{id}', 'edit')->name('branch-vehicle-edit');
        Route::post('/branch-vehicle-management/edit/{id}', 'update')->name('branch-vehicle-edit.update');
        Route::post('/branch-vehicle-delete/{id}', 'destroy')->name('branch-vehicle-destroy');
        Route::get('/api/vehicles-for-branch/{id}', 'getVehicleByBranchId');

    });

    Route::controller(DebitController::class)->group(function() {
        Route::get('/debit-management', 'index')->name('debit-management');
        Route::get('/debit-management/new', 'create')->name('debit-new');
        Route::post('/debit-management/new', 'store')->name('debit-new.store');
        Route::get('/debit-management/edit/{id}', 'edit')->name('debit-edit');
        Route::post('/debit-management/edit/{id}', 'update')->name('debit-edit.update');
        Route::post('/debit-delete/{id}', 'destroy')->name('debit-destroy');
        Route::get('/thumbnail/{path}',  'showThumbnail')->name('debit-show-thumbnail');
    }); 

    Route::get('/{page}', [PageController::class, 'dashboards'])->name('dashboards');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

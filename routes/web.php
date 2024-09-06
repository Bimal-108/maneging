<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitControll;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
//    return view('dashboard');
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');

    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

//Supplier Controller
Route::controller(SupplierController::class)->group(function(){
    Route::get('/supplier/all','SupplierAll')->name('supplier.all');
    Route::get('/supplier/add','SupplierAdd')->name('supplier.add');
    Route::get('/supplier/edit/{id}','SupplierEdit')->name('supplier.edit');
    Route::post('/supplier/store','SupplierStore')->name('supplier.store');
    Route::post('/supplier/update','SupplierUpdate')->name('supplier.update');
    Route::get('/supplier/delete/{id}','SupplierDelete')->name('supplier.delete');
});

//Customer Controller
Route::controller(CustomerController::class)->group(function(){
    Route::get('/customer/all', 'CustomerAll')->name('customer.all');
    Route::get('/customer/add', 'CustomerAdd')->name('customer.add');
    Route::post('/customer/store', 'CustomerStore')->name('customer.store');
    Route::get('/customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
    Route::get('/customer/delete/{id}', 'CustomerDelete')->name('customer.delete');
    Route::post('/customer/update', 'CustomerUpdate')->name('customer.update');
});

//Unit Controller
Route::controller(UnitControll::class)->group(function (){
    Route::get('/unit/all', 'UnitAll')->name('unit.all');
    Route::get('/unit/add', 'UnitAdd')->name('unit.add');
    Route::post('/unit/store', 'UnitStore')->name('unit.store');
    Route::get('/unit/edit/{id}', 'UnitEdit')->name('unit.edit');
    Route::get('/unit/delete/{id}', 'UnitDelete')->name('unit.delete');
    Route::post('/unit/update', 'UnitUpdate')->name('unit.update');

});

require __DIR__.'/auth.php';

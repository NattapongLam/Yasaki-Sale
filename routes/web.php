<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Employee\PersonListPage;
use App\Http\Livewire\Product\ProductListPage;
use App\Http\Livewire\TypeVat\TypevatListPage;
use App\Http\Livewire\Customer\CustomerFormPage;
use App\Http\Livewire\Customer\CustomerListPage;
use App\Http\Livewire\District\DistrictListPage;
use App\Http\Livewire\Employee\EmployeeFormPage;
use App\Http\Livewire\Employee\EmployeeListPage;
use App\Http\Livewire\Province\ProvinceListPage;
use App\Http\Livewire\Product\ProductUnitListPage;
use App\Http\Livewire\Product\ProductGroupListPage;
use App\Http\Livewire\Department\DepartmentListPage;
use App\Http\Livewire\Customer\CustomerGroupListPage;
use App\Http\Livewire\Employee\RolePermissionFormPage;
use App\Http\Livewire\SubDistrict\SubDistrictListPage;

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
Route::get('/',[DashboardController::class,'index'] );
// Route::get('/', function () {
//     return view('layouts.main');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::group([
    'prefix' => 'employees',
    'as' => 'employee.',
    'middleware' =>  ['auth','role:superadmin']
],function(){
    Route::get('/',EmployeeListPage::class)->name('list');
    Route::get('/create',EmployeeFormPage::class)->name('create');
    Route::get('/update/{id}', EmployeeFormPage::class)->name('update');
    Route::get('/rloe-permission/{id}', RolePermissionFormPage::class)->name('rloe.permission');
});

Route::group([
    'prefix' => 'departments',
    'as' => 'department.',
    'middleware' =>  ['auth','role:superadmin']
],function(){
    Route::get('/',DepartmentListPage::class)->name('list');
});

Route::group([
    'prefix' => 'persons',
    'as' => 'person.',
    
],function(){
    Route::get('/',PersonListPage::class)->name('list');
});

Route::group([
    'prefix' => 'provinces',
    'as' => 'province.',
    'middleware' =>  ['auth','role:superadmin|admin']
],function(){
    Route::get('/',ProvinceListPage::class)->name('list');
});

Route::group([
    'prefix' => 'districts',
    'as' => 'district.',
    'middleware' =>  ['auth','role:superadmin|admin']
],function(){
    Route::get('/',DistrictListPage::class)->name('list');
});

Route::group([
    'prefix' => 'subdistricts',
    'as' => 'subdistrict.',
    'middleware' =>  ['auth','role:superadmin|admin']
],function(){
    Route::get('/',SubDistrictListPage::class)->name('list');
});

Route::group([
    'prefix' => 'typevats',
    'as' => 'typevat.',
    'middleware' =>  ['auth','role:superadmin|admin']
],function(){
    Route::get('/',TypevatListPage::class)->name('list');
});

Route::group([
    'prefix' => 'customergroups',
    'as' => 'customergroup.',
    'middleware' =>  ['auth','role:superadmin|admin']
],function(){
    Route::get('/',CustomerGroupListPage::class)->name('list');
});

Route::group([
    'prefix' => 'customers',
    'as' => 'customer.',
    'middleware' =>  ['auth','role:superadmin|admin']
],function(){
    Route::get('/',CustomerListPage::class)->name('list');
    Route::get('/create',CustomerFormPage::class)->name('create');
    Route::get('/update/{id}', CustomerFormPage::class)->name('update');
});

Route::group([
    'prefix' => 'productgroups',
    'as' => 'productgroup.',
    'middleware' =>  ['auth','role:superadmin|admin']
],function(){
    Route::get('/',ProductGroupListPage::class)->name('list');
});

Route::group([
    'prefix' => 'productunits',
    'as' => 'productunit.',
    'middleware' =>  ['auth','role:superadmin|admin']
],function(){
    Route::get('/',ProductUnitListPage::class)->name('list');
});

Route::group([
    'prefix' => 'products',
    'as' => 'product.',
],function(){
    Route::get('/',ProductListPage::class)->name('list');
});


Route::resource('/requestorder' , App\Http\Controllers\RequestOrderSale::class);
Route::post('/getProduct' , [App\Http\Controllers\RequestOrderSale::class , 'getProduct']);
Route::post('/cancelSku' , [App\Http\Controllers\RequestOrderSale::class , 'cancelSku']);
Route::post('/cancelDoc' , [App\Http\Controllers\RequestOrderSale::class , 'cancelDoc']);
Route::get('/requestorder-list' , [App\Http\Controllers\RequestOrderSale::class , 'RequestorderList']);
Route::resource('/stockcard' , App\Http\Controllers\StockCardSale::class);
Route::resource('/reportsale' , App\Http\Controllers\ReportSaleOrder::class);
Route::get('/report-backlog' , [App\Http\Controllers\ReportSaleOrder::class , 'ReportBacklogList']);
Route::get('/report-sendproduct' , [App\Http\Controllers\ReportSaleOrder::class , 'ReportSendProductList']);
Route::get('/report-billorder' , [App\Http\Controllers\ReportSaleOrder::class , 'ReportBillOrderList']);
Route::get('/report-grouplow' , [App\Http\Controllers\ReportSaleOrder::class , 'ReportGroupLowList']);
Route::get('/report-saleorder' , [App\Http\Controllers\ReportSaleOrder::class , 'ReportSaleOrderList']);
Route::post('/getOrderBacklog' , [App\Http\Controllers\RequestOrderSale::class , 'getOrderBacklog']);
<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\ExportPermissionController;
use App\Http\Controllers\RoleAndPermission\ExportRoleController;
use App\Http\Controllers\RoleAndPermission\ImportPermissionController;
use App\Http\Controllers\RoleAndPermission\ImportRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ServicePackageController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Models\Category;

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
    return view('auth/login');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Route untuk Dashboard Sales
    // Route::get('/sales/monthly-customer-count', [DashboardController::class, 'monthlyCustomerCount']);
    //user list

    Route::prefix('user-management')->group(function () {
        Route::resource('user', UserController::class);
        Route::post('import', [UserController::class, 'import'])->name('user.import');
        Route::get('export', [UserController::class, 'export'])->name('user.export');
        Route::get('demo', DemoController::class)->name('user.demo');
    });

    Route::prefix('menu-management')->group(function () {
        Route::resource('menu-group', MenuGroupController::class);
        Route::resource('menu-item', MenuItemController::class);
    });
    Route::group(['prefix' => 'role-and-permission'], function () {
        //role
        Route::resource('role', RoleController::class);
        Route::get('role/export', ExportRoleController::class)->name('role.export');
        Route::post('role/import', ImportRoleController::class)->name('role.import');

        //permission
        Route::resource('permission', PermissionController::class);
        Route::get('permission/export', ExportPermissionController::class)->name('permission.export');
        Route::post('permission/import', ImportPermissionController::class)->name('permission.import');

        //assign permission
        Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
        Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
        Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
        Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
        Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');

        //assign user to role
        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assing-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
    });

    Route::group(['prefix' => 'data-management'], function () {
        //service package
        Route::get('service-package',[ServicePackageController::class,'index'])->name('service_package.index');
        Route::get('service-package/create',[ServicePackageController::class,'create'])->name('service_package.create');
        Route::post('service-package',[ServicePackageController::class,'store'])->name('service_package.store');
        Route::get('service-package/{service_package}/edit',[ServicePackageController::class,'edit'])->name('service_package.edit');
        Route::put('service-package/{service_package}',[ServicePackageController::class,'update'])->name('service_package.update');
        Route::delete('service-package/{service_package}',[ServicePackageController::class,'destroy'])->name('service_package.destroy');
        //customer
        Route::get('customer',[CustomerController::class,'index'])->name('customer.index');
        Route::get('customer/create',[CustomerController::class,'create'])->name('customer.create');
        Route::post('customer',[CustomerController::class,'store'])->name('customer.store');
        Route::get('customer/{customer}/edit',[CustomerController::class,'edit'])->name('customer.edit');
        Route::put('customer/{customer}',[CustomerController::class,'update'])->name('customer.update');
        Route::delete('customer/{customer}',[CustomerController::class,'destroy'])->name('customer.destroy');
        
    });
});



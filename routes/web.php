<?php

use App\Http\Controllers\Admin\AdminGroupPermissionController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Demo\AdminController;
use App\Http\Controllers\DemoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


// DEMO DEMO DEMO
Route::prefix('demo/')->group(function () {

    Route::get('sendmail', [DemoController::class, 'sendmail']);
    Route::get('add/post', [DemoController::class, 'addPost']);
    Route::get('cart/add/{id}', [DemoController::class, 'addCart'])->name('cart.add');
    Route::get('cart/show', [DemoController::class, 'showCart'])->name('cart.show');
    Route::post('cart/update', [DemoController::class, 'updateCart'])->name('cart.update');
    Route::get('admin/{age}', [AdminController::class, 'index']);
    Route::get('admin/show/{age}', [AdminController::class, 'show']);
    Route::get('admin/add/{age}', [AdminController::class, 'add']);
    Route::get('logout', [DemoController::class, 'logout'])->name('demo.logout');
    Route::post('logout', [DemoController::class, 'logout'])->name('demo.logout');
    // Route::get('demo/admin/{age}', function () {
    //     return view('demo.admin.index');
    // })->middleware('CheckAge');

});



Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');



Route::middleware('auth')->group(function () {

    // Route::get('admin/dashboard', [DemoController::class, 'dashboard'])->middleware('auth','CheckRole');
    // Route::get('admin/dashboard', [DemoController::class, 'dashboard']);
    Route::get('admin/dashboard', [DashboardController::class, 'show'])->name('admin.dashboard');

    Route::prefix('admin/post/')->group(function () {

        Route::get('add', [AdminPostController::class, 'add'])->name('admin.post.add');
        Route::get('list', [AdminPostController::class, 'list'])->name('admin.post.list');
    });

    Route::prefix('admin/product/')->group(function () {

        Route::get('add', [AdminProductController::class, 'add'])->name('admin.product.add');
        Route::get('list', [AdminProductController::class, 'list'])->name('admin.product.list');
    });

    Route::prefix('admin/order/')->group(function () {

        Route::get('list', [AdminOrderController::class, 'list'])->name('admin.order.list');
    });

    Route::prefix('admin/page/')->group(function () {

        Route::get('list', [AdminPageController::class, 'list'])->name('admin.page.list');
        Route::get('add', [AdminPageController::class, 'add'])->name('admin.page.add');
    });

    Route::prefix('admin/category/post')->group(function () {

        Route::get('list', [AdminCategoryPostController::class, 'list'])->name('admin.category.post');
        Route::get('add', [AdminCategoryPostController::class, 'add'])->name('admin.category.post.add');
    });

    Route::prefix('admin/category/product')->group(function () {

        Route::get('list', [AdminCategoryProductController::class, 'list'])->name('admin.category.product');
        Route::get('add', [AdminCategoryProductController::class, 'add'])->name('admin.category.product.add');
    });

    Route::prefix('admin/user/')->group(function () {

        Route::get('list', [AdminUserController::class, 'list'])->name('admin.user.list');
        Route::post('list', [AdminUserController::class, 'list'])->name('admin.user.list');
        Route::get('add', [AdminUserController::class, 'add'])->name('admin.user.add');
        Route::get('edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::get('update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::post('update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::get('store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::post('store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::post('action', [AdminUserController::class, 'action'])->name('admin.user.action');
        Route::get('delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');
        Route::get('districts/ajax/{province_id}', [AdminUserController::class, 'GetDistricts']);
        Route::get('wards/ajax/{province_id}', [AdminUserController::class, 'GetWards']);
        //

    });

    //Quản lý permission
    Route::group(['prefix' => 'admin/permission'], function () {
        Route::group(['prefix' => 'group'], function () {

            Route::get('/', [AdminGroupPermissionController::class, 'list'])->name('groupPermission.list');
            Route::post('/', [AdminGroupPermissionController::class, 'store'])->name('groupPermission.store');
            // Route::get('/', 'AdminGroupPermissionController@list')->name('groupPermission.list');

            // Route::post('/', 'AdminGroupPermissionController@store');

            // Route::get('update/{id}', 'AdminGroupPermissionController@getUpdate')->name('groupPermission.update');
            // Route::post('update/{id}', 'AdminGroupPermissionController@postUpdate');
            Route::get('delete/{id}', [AdminGroupPermissionController::class, 'delete'])->name('groupPermission.delete');
        });


        Route::get('/', [AdminPermissionController::class, 'list'])->name('permission.list');
        Route::post('/', [AdminPermissionController::class, 'store'])->name('permission.store');
        Route::get('delete/{id}', [AdminPermissionController::class, 'delete'])->name('permission.delete');


        // Route::get('update/{id}', 'AdminPostController@getUpdate')->name('post.update');
        // Route::post('update/{id}', 'AdminPostController@postUpdate');

        // Route::get('delete/{id}', 'AdminPermissionController@delete')->name('permission.delete');
    });

    // Quản lý role
    Route::group(['prefix' => 'admin/role'], function () {
        Route::get('/', [AdminRoleController::class, 'list'])->name('role.list');
        Route::get('add', [AdminRoleController::class, 'add'])->name('role.add');
        Route::post('add', [AdminRoleController::class, 'postAdd'])->name('role.postAdd');

        Route::get('update/{id}', [AdminRoleController::class, 'getUpdate'])->name('role.update');
        Route::post('update/{id}', [AdminRoleController::class, 'postUpdate']);
        Route::get('delete/{id}', [AdminRoleController::class, 'delete'])->name('role.delete');



        // Route::get('action', 'AdminSliderController@action')->name('slider.action');
    });
});

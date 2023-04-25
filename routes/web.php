<?php

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

Route::get('/', 'App\Http\Controllers\AuthController@showLogin');
Route::post('/', 'App\Http\Controllers\AuthController@login')->name('auth.login');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout');

Route::prefix('admin')->middleware(\App\Http\Middleware\CheckAdmin::class)->group(function () {

    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index');

    Route::prefix('role')->group(function () {
        Route::get('/', [
            'as' => 'admin.role.index',
            'uses' => 'App\Http\Controllers\Admin\RoleController@index'
        ]);

        Route::post('/create', [
            'as' => 'admin.role.create',
            'uses' => 'App\Http\Controllers\Admin\RoleController@create'
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.role.update',
            'uses' => 'App\Http\Controllers\Admin\RoleController@update'
        ]);
        Route::post('/delete/{id}', [
            'as' => 'admin.role.delete',
            'uses' => 'App\Http\Controllers\Admin\RoleController@delete'
        ]);
    });

    Route::prefix('menu')->group(function () {
        Route::get('/', [
            'as' => 'admin.menu.index',
            'uses' => 'App\Http\Controllers\Admin\MenuController@index'
        ]);

        Route::post('/create', [
            'as' => 'admin.menu.create',
            'uses' => 'App\Http\Controllers\Admin\MenuController@create'
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.menu.update',
            'uses' => 'App\Http\Controllers\Admin\MenuController@update'
        ]);
        Route::post('/delete/{id}', [
            'as' => 'admin.menu.delete',
            'uses' => 'App\Http\Controllers\Admin\MenuController@delete'
        ]);
    });
    Route::prefix('item')->group(function () {
        Route::get('/', [
            'as' => 'admin.item.index',
            'uses' => 'App\Http\Controllers\Admin\ItemController@index'
        ]);

        Route::post('/create', [
            'as' => 'admin.item.create',
            'uses' => 'App\Http\Controllers\Admin\ItemController@create'
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.item.update',
            'uses' => 'App\Http\Controllers\Admin\ItemController@update'
        ]);
        Route::post('/delete/{id}', [
            'as' => 'admin.item.delete',
            'uses' => 'App\Http\Controllers\Admin\ItemController@delete'
        ]);
    });
    Route::prefix('customer')->group(function () {
        Route::get('/', [
            'as' => 'admin.customer.index',
            'uses' => 'App\Http\Controllers\Admin\CustomerController@index'
        ]);

        Route::post('/create', [
            'as' => 'admin.customer.create',
            'uses' => 'App\Http\Controllers\Admin\CustomerController@create'
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.customer.update',
            'uses' => 'App\Http\Controllers\Admin\CustomerController@update'
        ]);
        Route::post('/delete/{id}', [
            'as' => 'admin.customer.delete',
            'uses' => 'App\Http\Controllers\Admin\CustomerController@delete'
        ]);
    });
    Route::prefix('employee')->group(function () {
        Route::get('/', [
            'as' => 'admin.employee.index',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@index'
        ]);

        Route::post('/create', [
            'as' => 'admin.employee.create',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@create'
        ]);
        Route::post('/update/{id}', [
            'as' => 'admin.employee.update',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@update'
        ]);
        Route::post('/delete/{id}', [
            'as' => 'admin.employee.delete',
            'uses' => 'App\Http\Controllers\Admin\EmployeeController@delete'
        ]);
    });

    Route::prefix('table')->group(function () {
        Route::get('/', [
            'as' => 'admin.table.index',
            'uses' => 'App\Http\Controllers\Admin\OrderController@showTableList'
        ]);
        Route::get('/order/{table}', [
            'as' => 'admin.table.item',
            'uses' => 'App\Http\Controllers\Admin\OrderController@selectItems'
        ]);
        Route::post('/order/{table}', [
            'as' => 'admin.table.order',
            'uses' => 'App\Http\Controllers\Admin\OrderController@addToCart'
        ]);
        Route::post('/order/confirm/{table}', [
            'as' => 'admin.table.order.confirm',
            'uses' => 'App\Http\Controllers\Admin\OrderController@confirmOrder'
        ]);
        Route::get('/payment/{table}', [
            'as' => 'admin.table.payment',
            'uses' => 'App\Http\Controllers\Admin\OrderController@payment'
        ]);
    });
});

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

Route::prefix('admin')->group(function () {

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
});

Route::get('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/login', 'App\Http\Controllers\AuthController@checkLogin')->name('auth.login');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout');
Route::get('/register', 'App\Http\Controllers\AuthController@showRegister');
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('auth.register');
Route::post('/showMajorsInCollege', 'App\Http\Controllers\AuthController@showMajorsInCollege');

Route::get('search-scholarship', 'App\Http\Controllers\SearchController@searchScholarship')->name('search.scholarship');
Route::get('search-edu-center', 'App\Http\Controllers\SearchController@searchEduCenter')->name('search.edu_center');
Route::get('search-motel', 'App\Http\Controllers\SearchController@searchMotel')->name('search.motel');
Route::get('search-job', 'App\Http\Controllers\SearchController@searchJob')->name('search.job');

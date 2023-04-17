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
        Route::post('/edit/{id}', [
            'as' => 'admin.role.edit',
            'uses' => 'App\Http\Controllers\Admin\RoleController@edit'
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
        Route::post('/edit/{id}', [
            'as' => 'admin.menu.edit',
            'uses' => 'App\Http\Controllers\Admin\MenuController@edit'
        ]);
        Route::post('/delete/{id}', [
            'as' => 'admin.menu.delete',
            'uses' => 'App\Http\Controllers\Admin\MenuController@delete'
        ]);
    });

    Route::prefix('jobs')->group(function () {
        Route::get('/', [
            'as' => 'client.jobs.index',
            'uses' => 'App\Http\Controllers\Client\JobController@index'
        ]);

        Route::get('/detail/{id}', [
            'as' => 'job.detail',
            'uses' => 'App\Http\Controllers\Client\JobController@detail'
        ]);

        Route::post('/comment', [
            'as' => 'comments.store',
            'uses' => 'App\Http\Controllers\Client\CommentController@store'
        ])->middleware(\App\Http\Middleware\Auth::class);
    });
    Route::prefix('motels')->group(function () {
        Route::get('/', [
            'as' => 'client.motels.index',
            'uses' => 'App\Http\Controllers\Client\MotelController@index'
        ]);

        Route::get('/detail/{id}', [
            'as' => 'motel.detail',
            'uses' => 'App\Http\Controllers\Client\MotelController@detail'
        ]);

        Route::post('/comment', [
            'as' => 'comments.store',
            'uses' => 'App\Http\Controllers\Client\CommentController@store'
        ])->middleware(\App\Http\Middleware\Auth::class);
    });

    Route::prefix('edu-centers')->group(function () {
        Route::get('/', [
            'as' => 'edu_center.index',
            'uses' => 'App\Http\Controllers\Client\EduCenterController@index'
        ]);

        Route::get('/detail/{id}', [
            'as' => 'edu_center.detail',
            'uses' => 'App\Http\Controllers\Client\EduCenterController@detail'
        ]);

        Route::post('/comment', [
            'as' => 'comments.store',
            'uses' => 'App\Http\Controllers\Client\CommentController@store'
        ])->middleware(\App\Http\Middleware\Auth::class);
    });

    Route::prefix('dining-venues')->group(function () {
        Route::get('/', [
            'as' => 'client.dining_venue.index',
            'uses' => 'App\Http\Controllers\Client\DiningVenueController@index'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'client.dining_venue.detail',
            'uses' => 'App\Http\Controllers\Client\DiningVenueController@detail'
        ]);
    });

    Route::prefix('tourist-places')->group(function () {
        Route::get('/', [
            'as' => 'client.tourist_place.index',
            'uses' => 'App\Http\Controllers\Client\TouristPlaceController@index'
        ]);

        Route::get('/detail/{id}', [
            'as' => 'client.tourist_place.detail',
            'uses' => 'App\Http\Controllers\Client\TouristPlaceController@detail'
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

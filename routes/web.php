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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@view')->name('home');
Route::get('/add', 'HomeController@add')->name('todolists.add');
Route::post('/store', 'HomeController@store')->name('todolists.store');
Route::get('/edit/{id}', 'HomeController@edit')->name('todolists.edit');
Route::post('/update/{id}', 'HomeController@update')->name('todolists.update');
Route::post('/delete', 'HomeController@delete')->name('todolists.delete');

// Search route
Route::get('/search', 'HomeController@search')->name('todolists.search');


Route::group(['middleware' => 'auth'], function() {

    Route::group(['middleware' => ['role:admin']], function() {
        //User routes
        Route::prefix('users')->group(function () {

            Route::get('/view', 'Backend\UserController@view')->name('users.view');
            Route::get('/add', 'Backend\UserController@add')->name('users.add');
            Route::post('/store', 'Backend\UserController@store')->name('users.store');
            Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
            Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
            Route::post('/delete', 'Backend\UserController@delete')->name('users.delete');

            //Permission routes
            Route::get('/view-permission', 'PermissionController@viewPermission')->name('permissions.view');
            Route::get('/add-permission', 'PermissionController@addPermission')->name('permissions.add');
            Route::post('/store-permission', 'PermissionController@storePermission')->name('permissions.store');
            Route::get('/edit-permission/{id}', 'PermissionController@editPermission')->name('permissions.edit');
            Route::post('/update-permission/{id}', 'PermissionController@updatePermission')->name('permissions.update');
            Route::post('/delete-permission', 'PermissionController@deletePermission')->name('permissions.delete');

            //Role routes
            Route::get('/view-role', 'RoleController@viewRole')->name('roles.view');
            Route::get('/add-role', 'RoleController@addRole')->name('roles.add');
            Route::post('/store-role', 'RoleController@storeRole')->name('roles.store');
            Route::get('/edit-role/{id}', 'RoleController@editRole')->name('roles.edit');
            Route::post('/update-role/{id}', 'RoleController@updateRole')->name('roles.update');
            Route::post('/delete-role', 'RoleController@deleteRole')->name('roles.delete');


            //Search route
            Route::get('/search', 'Backend\UserController@search')->name('users.search');
        });
    });

    //Profile route
    Route::prefix('profiles')->group(function(){
        
        Route::get('/view', 'Backend\ProfileController@view')->name('profiles.view');
        Route::get('/edit', 'Backend\ProfileController@edit')->name('profiles.edit');
        Route::post('/store', 'Backend\ProfileController@update')->name('profiles.update');
        Route::get('/password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
        Route::post('/password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
        
    });

    //TodoList route
    // Route::group(['middleware' => ['role:admin|user']], function() {

    //     Route::prefix('todolists')->group(function() {
    //         Route::get('/view', 'Backend\TodolistController@view')->name('todolists.view');
    //         Route::get('/add', 'Backend\TodolistController@add')->name('todolists.add');
    //         Route::post('/store', 'Backend\TodolistController@store')->name('todolists.store');
    //         Route::get('/edit/{id}', 'Backend\TodolistController@edit')->name('todolists.edit');
    //         Route::post('/update/{id}', 'Backend\TodolistController@update')->name('todolists.update');
    //         Route::post('/delete', 'Backend\TodolistController@delete')->name('todolists.delete');

    //         // Search route
    //         Route::get('/search', 'Backend\TodolistController@search')->name('users.search');
    //     });
    // });

});
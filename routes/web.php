<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth']],function() {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/password-change', 'PasswordController@index')->name('password_change');
    Route::post('/password-change', 'PasswordController@changePassword');
});
Route::group(['middleware'=>['auth'],'namespace'=>'Permission'],function() {

    Route::get('/role-permission', 'RoleController@index')->name("role");
    Route::post('/role', 'RoleController@store');
    Route::get('/role/edit/{role_id}', 'RoleController@edit');
    Route::get('/role/delete/{role_id}', 'RoleController@delete');
    Route::get('/assign-permission/{role_id}', 'RoleController@assignPermission');
    Route::post('/assign-permission/{role_id}', 'RoleController@assignPermission');

    Route::get('/module', 'ModuleController@index')->name("module");
    Route::post('/module/add_parent', 'ModuleController@add_parent');
    Route::get('/module/get_subparent', 'ModuleController@get_subparent');
    Route::post('/module/add', 'ModuleController@add');
    Route::post('/module/control', 'ModuleController@control');
    Route::get('/module/edit/{id?}/{cat_id?}/{msg?}', 'ModuleController@edit');
    Route::post('/module/edit/{id?}/{cat_id?}/{msg?}', 'ModuleController@edit');
    Route::get('/module/delete/{id?}/{cat_id?}/{msg?}', 'ModuleController@delete');
    Route::post('/module/moduleUpdate/', 'ModuleController@moduleUpdate');
});

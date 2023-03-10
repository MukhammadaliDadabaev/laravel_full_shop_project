<?php

use Illuminate\Support\Facades\Route;

Route::group([
  'namespace' => 'App\Http\Controllers\Admin',
  // 'prefix' => config('admin.prefix'),
  'prefix' => env('ADMIN_PREFIX', 'admin'),
  'middleware' => ['auth', 'verified'],
], function () {
  Route::resource('user', 'UserController');
  Route::resource('role', 'RoleController');
  Route::resource('permission', 'PermissionController');
  Route::resource('menu', 'MenuController')->except([
    'show'
  ]);
  Route::resource('menu.item', 'MenuItemController');
  Route::get('edit-account-info', 'UserController@accountInfo')->name('admin.account.info');
  Route::post('edit-account-info', 'UserController@accountInfoStore')->name('admin.account.info.store');
  Route::post('change-password', 'UserController@changePasswordStore')->name('admin.account.password.store');
});
<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/','inventario@index')->name('index');
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

/**
 * Router Cors
 */

 Route::get('product','inventario@showProduct');
 Route::post('addProduct','catalogo@addProduct');
 Route::get('allProduct','catalogo@allProduct');
 Route::post('editProduct','catalogo@editProduct');
 Route::post('deleteProductById','catalogo@deleteProductById');

 /****************************** */
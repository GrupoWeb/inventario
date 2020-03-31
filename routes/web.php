<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/','inventario@index')->name('index');
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('getYear','catalogo@getYear');
Route::get('sequence','catalogo@sequences_data');

/**
 * Router Cors
 */

 /******Product Data****************** */
 Route::get('product','inventario@showProduct');
 Route::post('addProduct','catalogo@addProduct');
 Route::get('allProduct','catalogo@allProduct');
 Route::post('editProduct','catalogo@editProduct');
 Route::post('deleteProductById','catalogo@deleteProductById');

 /****************************** */

 /** Form Active */

 Route::get('active','inventario@showActive');
 /***************** */

<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/','inventario@index')->name('index');
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('getYear','catalogo@getYear');
Route::get('sequence/{table}','catalogo@sequences_data');
Route::post('barCode','BarCode@barcodeGet');
Route::get('barCode','BarCode@BarCodeAll');



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
 Route::post('active','inventario@addActivosBienes');
 /***************** */

  /** Form Active */
  Route::get('entidades','catalogo@getEntidad');
  Route::get('unidades','catalogo@getUnidad');
  Route::get('grupos','catalogo@getGrupo');
  Route::post('categorias','catalogo@getCategoria');
  Route::post('secciones','catalogo@getSeccion');
  Route::post('tipos','catalogo@getTipo');
  Route::post('Bienes','catalogo@getBien');
  Route::get('EstadosProducto','catalogo@getEstadoProducto');
  Route::post('PersonasEntidad','catalogo@getPersonas');
  Route::post('addproductobien','catalogo@addProductBienes');
  Route::get('dependencias','catalogo@getDependencias');
  Route::get('cuentas','catalogo@getCuentasActivo');
  Route::get('respaldos','catalogo@getDocumentosRespaldo');
  Route::get('secuenciasFac','catalogo@getSecuenciasFactura');
  /***************** */

  /** Printer BarCode */

  Route::get('printer','BarCode@BarCodePrinter');
  Route::get('search','inventario@showSearch'); 
  Route::get('printCode/{code}','BarCode@GetBarCodeById');
  Route::get('List','inventario@showList');
  /******************** */



  /****Inventario Inicial */

  Route::get('Inicial','InventarioInicial@SetCategory');
  Route::get('inventarioinicial','initialCharge@setDataDB_03');
  /********************* */
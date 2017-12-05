<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {

    //waybills
    Route::get('waybills', 'WaybillController@index');
    Route::post('waybills', 'WaybillController@post');
    Route::put('waybills/batch-update', 'WaybillController@batchUpdate');
    Route::get('waybills/{uuid}', 'WaybillController@get');
    Route::put('waybills/{uuid}', 'WaybillController@put');
    Route::patch('waybills/{uuid}', 'WaybillController@patch');
    Route::delete('waybills/{uuid}', 'WaybillController@delete');
    Route::get('carriers/{uuid}/waybills', 'WaybillController@getByCarrierUuid');

    //products
    Route::get('products', 'ProductController@index');

    //warehouses
    Route::get('warehouses', 'WarehouseController@index');

    //orders
    Route::get('orders', 'OrderController@index');
    Route::get('orders/{uuid}', 'OrderController@get');
    Route::post('orders', 'OrderController@post');
    Route::put('orders/{uuid}', 'OrderController@put');
    Route::patch('orders/{uuid}', 'OrderController@patch');
    Route::delete('orders/{uuid}', 'OrderController@delete');


    //carriers
    Route::get('carriers', 'CarrierController@index');

    //trucks
    Route::get('trucks', 'TruckController@index');

    //quotation-requests
    Route::get('quotation-requests', 'QuotationRequestController@index');
    Route::get('quotation-requests/{uuid}', 'QuotationRequestController@get');
    Route::post('quotation-requests', 'QuotationRequestController@post');
    Route::put('quotation-requests/{uuid}', 'QuotationRequestController@put');
    Route::patch('quotation-requests/{uuid}', 'QuotationRequestController@patch');
    Route::delete('quotation-requests/{uuid}', 'QuotationRequestController@delete');

    //transfer-guides
    Route::get('transfer-guides', 'TransferGuideController@index');
    Route::get('transfer-guides/{uuid}', 'TransferGuideController@get');
    Route::post('transfer-guides', 'TransferGuideController@post');
    Route::put('transfer-guides/{uuid}', 'TransferGuideController@put');
    Route::patch('transfer-guides/{uuid}', 'TransferGuideController@patch');
    Route::delete('transfer-guides/{uuid}', 'TransferGuideController@delete');

    //suppliers
    Route::get('suppliers', 'SupplierController@index');
    Route::get('suppliers/{uuid}', 'SupplierController@get');

    //employees
    Route::get('employees/{uuid}', 'EmployeeController@get');

    //users
    Route::get('me', 'EmployeeController@getByUserUuid');


});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::any('/test', 'ShopifyController@test')->name('test');
Route::any('/webhook_shopify_customer_create', 'ShopifyController@webhook_shopify_customer_create')->name('webhook_shopify_customer_create');
Route::any('/webhook_shopify_customer_update', 'ShopifyController@webhook_shopify_customer_update')->name('webhook_shopify_customer_update');
Route::any('/webhook_shopify_order_create', 'ShopifyController@webhook_shopify_order_create')->name('webhook_shopify_order_create');
Route::any('/webhook_shopify_order_update', 'ShopifyController@webhook_shopify_order_update')->name('webhook_shopify_order_update');
Route::any('/webhook_shopify_order_cancelled', 'ShopifyController@webhook_shopify_order_cancelled')->name('webhook_shopify_order_cancelled');
Route::any('/webhook_shopify_refund_create', 'ShopifyController@webhook_shopify_refund_create')->name('webhook_shopify_refund_create');
Route::any('/webhook_shopify_product_create', 'ShopifyController@webhook_shopify_product_create')->name('webhook_shopify_product_create');
Route::any('/webhook_shopify_product_update', 'ShopifyController@webhook_shopify_product_update')->name('webhook_shopify_product_update');
Route::any('/webhook_shopify_product_delete', 'ShopifyController@webhook_shopify_product_delete')->name('webhook_shopify_product_delete');
Route::any('/webhook_shopify_order_paid', 'ShopifyController@webhook_shopify_order_paid')->name('webhook_shopify_order_paid');


Route::any('/webhook_bp_product_create', 'BrightpearlController@webhook_bp_product_create')->name('webhook_bp_product_create');
Route::any('/webhook_bp_product_destroyed', 'BrightpearlController@webhook_bp_product_destroyed')->name('webhook_bp_product_destroyed');
Route::any('/webhook_bp_good_out_shipped_modified', 'BrightpearlController@webhook_bp_good_out_shipped_modified')->name('webhook_bp_good_out_shipped_modified');
Route::any('/webhook_bp_product_inventory_update', 'BrightpearlController@webhook_bp_product_inventory_update')->name('webhook_bp_product_inventory_update');
Route::any('/test_bp', 'BrightpearlController@test_bp')->name('test_bp');
Route::any('/test', 'ShopifyController@test')->name('test');








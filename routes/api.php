<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Order_ProductController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Categories api urls
Route::get('/categories',[CategoryController::class,'getCategories']);
Route::post('/categories',[CategoryController::class,'createCategory']);
Route::get('/categories/{categoryId}',[CategoryController::class,'getCategory']);
Route::patch('/categories/{categoryId}',[CategoryController::class,'updateCategory']);
Route::delete('/categories/{categoryId}',[CategoryController::class,'deleteCategory']);
Route::get('/categories/{categoryId}/products',[CategoryController::class,'getProductsOfCategory']);

Route::get('/products',[ProductController::class,'getProducts']);
Route::post('/products',[ProductController::class,'createProduct']);
Route::get('/products/{productId}',[ProductController::class,'getProduct']);
Route::patch('/products/{productId}',[ProductController::class,'updateProduct']);
Route::delete('/products/{productId}',[ProductController::class,'deleteProduct']);
// Route::get('/products/{categoryId}',[CategoryController::class,'getProductsOf']);

Route::get('/images',[ImageController::class,'getImages']);
Route::post('/images',[ImageController::class,'createImage']);
Route::get('/images/{imageId}',[ImageController::class,'getImage']);
Route::patch('/images/{imageId}',[ImageController::class,'updateImage']);
Route::delete('/images/{imageId}',[ImageController::class,'deleteImage']);

Route::get('/orders',[OrderController::class,'getOrders']);
Route::post('/order',[OrderController::class,'createOrder']);
Route::get('/order/{orderId}',[OrderController::class,'getOrder']);
Route::patch('/order',[OrderController::class,'updateOrder']);
Route::delete('/order',[OrderController::class,'deleteOrder']);

Route::get('/order_products',[Order_ProductController::class,'getOrder_Products']);
Route::post('/order_product',[Order_ProductController::class,'createOrder_Product']);
Route::get('/order_product/{order_prductId}',[Order_ProductController::class,'getOrder_Product']);
Route::patch('/order_product',[Order_ProductController::class,'updateOrder_Product']);
Route::delete('/order_product',[Order_ProductController::class,'deleteOrder_Product']);

Route::post('/register',[AuthenticationController::class,'register']);


Route::post('/carts', [ProductController::class, 'addProductToCart']);
Route::delete('/carts', [ProductController::class, 'removeProductFromCart']);
Route::get('/carts', [ProductController::class, 'getProductsFromCart']);
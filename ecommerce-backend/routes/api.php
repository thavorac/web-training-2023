<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Order_productsController;
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


// Route::post('/categories', function (Request $request){
//     return "Create 1 category";
// });
// Route::get('categories/{categoryId}', function (Request $request){
//     return "Get 1 category by categoryId";
// } );
// Route::patch('/categories/{catogoryId}' , function (Request $request){
//     return "Update 1 category";
// });
// Route::delete('/categories/{categoryId}' , function (Request $request){
//     return "Delete 1 category";
// });

// // api for products

// Route::get('/products' , function (Request $request){{
//     return "Get all products";
// }});
// Route::post('/products' , function (Request $request){
//     return "Create 1 product";
// });
// Route::get('products/{productId}', function (Request $request){
//     return "Get 1 product ";
// }); 
// Route::patch('products/{productId', function (Request $request){
//     return "Update 1 product";
// });
// Route::delete('/products/{productId}' , function (Request $request){
//     return "Delete 1 product";
// });
// Route::get('/products/{productId}/products' , function (Request $request){
//     return "Get all products belong to categoryId";
// });

// api for suppliers



// categories api urls
Route::get('/categories', [CategoryController::class,'getCategories']);
Route::post('/categories', [CategoryController::class,'createCategory']);
Route::get('/categories/{categoryId}', [CategoryController::class,'getCategory']);
Route::patch('/categories/{categoryId}', [CategoryController::class,'updateCategory']);
Route::delete('/categories/{categoryId}', [CategoryController::class,'deleteCategory']);
Route::get('/categories/{categoryId}/products', [CategoryController::class,'getProductsOfCategory']);

// products api urls
Route::get('/products', [ProductController::class,'getProducts']);
Route::post('/products', [ProductController::class,'createProduct']);
Route::get('/products/{productId}', [ProductController::class,'getProduct']);
Route::patch('/products/{productId}', [ProductController::class,'updateProduct']);
Route::delete('/products/{productId}', [ProductController::class,'deleteProduct']);
Route::get('/products/{productId}/images', [ProductController::class,'getImagesOfProduct']);
Route::get('/products/{productId}/categories',[ProductController::class,'findProductsOfCategory']);

//suppliers api urls
Route::get('/suppliers',[SupplierController::class,'getSuppliers']);
Route::post('/suppliers',[SupplierController::class , 'createSupplier']);
Route::get('/suppliers/{supplierId}',[SupplierController::class ,'getSupplier']);
Route::patch('/suppliers/{supplierId}',[SupplierController::class,'updateSupplier']);
Route::delete('/suppliers/{supplierId}',[SupplierController::class,'deleteSupplier']);

//Images api urls 
Route::get('/images',[ImageController::class, 'getImages']);
Route::post('/images',[ImageController::class,'createImage']);
Route::patch('/images/{imageId}',[ImageController::class,'updateImage']);
Route::get('/images/{imageId}',[ImageController::class,'getImage']);
Route::delete('images/{imageId}',[ImageController::class,'deleteImage']);

//Orders api urls
Route::get('/orders',[OrderController::class,'getOrders']);
Route::post('/orders',[OrderController::class,'createOrder']);
Route::get('/orders/{orderId}',[OrderController::class,'getOrder']);
Route::patch('/orders/{orderId}',[OrderController::class,'updateOrder']);
Route::delete('/orders/{orderId}',[OrderController::class,'deleteOrder']);

//Order_products api urls
Route::get('/order_products',[Order_productsController::class,'getOrderProducts']);
Route::post('/order_products',[Order_productsController::class,'createOrderProduct']);
Route::get('/order_products/{order_productsId}',[Order_productsController::class , 'getOrderProduct']);
Route::patch('/order_products/{order_productsId}',[Order_productsController::class , 'updateOrderProduct']);
Route::delete('/order_products/{order_productsId}',[Order_productsController::class,'deleteOrderProduct']);

// api for Authentication
Route::post('/register',[AuthenticationController::class,'register']);



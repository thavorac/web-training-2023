<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderProductsController;


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

// Example category routes
Route::post('/categories', function (Request $request){
    return "Create 1 category";
});
Route::get('categories/{categoryId}', function (Request $request){
    return "Get 1 category by categoryId";
});
Route::patch('/categories/{categoryId}', function (Request $request){
    return "Update 1 category";
});
Route::delete('/categories/{categoryId}', function (Request $request){
    return "Delete 1 category";
});

// API for products
Route::get('/products', function (Request $request){
    return "Get all products";
});
Route::post('/products', function (Request $request){
    return "Create 1 product";
});
Route::get('products/{productId}', function (Request $request){
    return "Get 1 product";
});
Route::patch('products/{productId}', function (Request $request){
    return "Update 1 product";
});
Route::delete('/products/{productId}', function (Request $request){
    return "Delete 1 product";
});
Route::get('/categories/{categoryId}/products', function (Request $request){
    return "Get all products belong to categoryId";
});

// Categories API URLs
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::post('/categories', [CategoryController::class, 'createCategory']);
Route::get('/categories/{categoryId}', [CategoryController::class, 'getCategory']);
Route::patch('/categories/{categoryId}', [CategoryController::class, 'updateCategory']);
Route::delete('/categories/{categoryId}', [CategoryController::class, 'deleteCategory']);
Route::get('/categories/{categoryId}/products', [CategoryController::class, 'getProductsOfCategory']);

// Products API URLs
Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('/products/{productId}/getFirstImage', [ProductController::class, 'getFirstImage']);
Route::get('/products/create', [ProductController::class, 'showCreateForm']);

Route::middleware(['cors'])->group(function(){
    Route::post('/products', [ProductController::class, 'createProduct']);
});
Route::get('/products/{productId}', [ProductController::class, 'getProduct']);
Route::patch('/products/{productId}', [ProductController::class, 'updateProduct']);
Route::delete('/products/{productId}', [ProductController::class, 'deleteProduct']);
Route::get('/products/{productId}/images', [ProductController::class, 'getImagesOfProduct']);
Route::get('/products/{productId}/categories', [ProductController::class, 'findProductsOfCategory']);

// Suppliers API URLs
Route::get('/suppliers', [SupplierController::class, 'getSuppliers']);
Route::post('/suppliers', [SupplierController::class, 'createSupplier']);
Route::get('/suppliers/{supplierId}', [SupplierController::class, 'getSupplier']);
Route::patch('/suppliers/{supplierId}', [SupplierController::class, 'updateSupplier']);
Route::delete('/suppliers/{supplierId}', [SupplierController::class, 'deleteSupplier']);

// Images API URLs
Route::get('/images', [ImageController::class, 'getImages']);
Route::post('/images', [ImageController::class, 'createImage']);
Route::patch('/images/{imageId}', [ImageController::class, 'updateImage']);
Route::get('/images/{imageId}', [ImageController::class, 'getImage']);
Route::delete('/images/{imageId}', [ImageController::class, 'deleteImage']);

// Orders API URLs
Route::get('/orders', [OrderController::class, 'getOrders']);
Route::post('/orders', [OrderController::class, 'createOrder']);
Route::get('/orders/{orderId}', [OrderController::class, 'getOrder']);
Route::delete('/orders/{orderId}', [OrderController::class, 'deleteOrder']);
Route::put('/orders/{orderId}', [OrderController::class, 'updateOrder']);
Route::post('/checkout', [OrderController::class, 'checkout']);


// Order Products API URLs
Route::get('/order_products', [OrderProductsController::class, 'index']);
Route::post('/order_products', [OrderProductsController::class, 'store']);
Route::get('/order_products/{id}', [OrderProductsController::class, 'show']);
Route::put('/order_products/{id}', [OrderProductsController::class, 'update']);
Route::delete('/order_products/{id}', [OrderProductsController::class, 'destroy']);

// Authentication API
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/forgot-password', [AuthenticationController::class, 'forgotPassword']);
Route::get('reset-password/{token}', [AuthenticationController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthenticationController::class, 'resetPassword']);

// Stripe payment session routes
Route::post('/create-checkout-session', [StripeController::class, 'session']);
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');

// Order Details API
Route::get('orderdetails', [OrderDetailController::class, 'index']);
Route::post('orderdetails', [OrderDetailController::class, 'store']);
Route::get('orderdetails/{orderDetail}', [OrderDetailController::class, 'show']);
Route::put('orderdetails/{orderDetail}', [OrderDetailController::class, 'update']);
Route::delete('orderdetails/{orderDetail}', [OrderDetailController::class, 'destroy']);

// Corrected route definition for products
Route::get('products', [ProductController::class, 'index']);

// User purchase route
Route::post('purchase', [UserController::class, 'purchase']);
?>

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

// -- Category api url
Route::get('/categories',[CategoryController::class, 'getCategories']);
Route::post('/categories',[CategoryController::class, 'createCategory']);
Route::get('/categories/{categoryId}',[CategoryController::class, 'getCategory']);
Route::patch('/categories/{categoryId}',[CategoryController::class, 'updateCategory']);
Route::delete('/categories/{categoryId}',[CategoryController::class, 'deleteCategory']);
Route::get('/categories/{categoryId}/products/productId',[CategoryController::class, 'getProductsOfCategory']);



// -- Prodcut api url
Route::get('/products',[CategoryController::class, 'getProducts']);
Route::post('/products',[CategoryController::class, 'createProduct']);
Route::get('/products/{productId}',[CategoryController::class, 'getProduct']);
Route::patch('/products/{productId}',[CategoryController::class, 'updateProduct']);
Route::delete('/products/{categoryId}',[CategoryController::class, 'deteProduct']);


Route::post('/register',[AuthenticationController::class,'register']);

Route::post('/login', [AuthenticationController::class, 'login']);



// Route::post('/resetPassword', [AuthenticationController::class, 'resetPassword']);

Route::post('/forgot-password', [AuthenticationController::class, 'forgotPassword']);

Route::get('reset-password/{token}', [AuthenticationController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthenticationController::class, 'resetPassword']);








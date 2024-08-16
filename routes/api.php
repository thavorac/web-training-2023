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
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;




use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\PurchaseController;


use App\Http\Controllers\PurchaseProductController;
use App\Http\Controllers\SupplierAuthController;



Route::post('accounts', [AccountController::class, 'createAccount']);
Route::get('accounts', [AccountController::class, 'showAllAccounts']);
Route::get('accounts/{account}', [AccountController::class, 'showAccount']);
Route::put('accounts/{account}', [AccountController::class, 'updateAccount']);
Route::delete('accounts/{account}', [AccountController::class, 'deleteAccount']);
Route::get('account-histroy/{account}', [AccountController::class, 'history']);
Route::get('accounts/{id}/statistics/{period}', [AccountController::class, 'statistics']);



Route::get('/product-sold', [TransactionController::class, 'productSold']);
Route::get('/product-order', [TransactionController::class, 'orderProducts']);

Route::get('all-history', [TransactionController::class, 'history']);
Route::post('/transfer', [TransactionController::class, 'transfer']);



//Route Cart_Item
Route::prefix('cart-items')->group(function () {
    Route::get('/', [CartItemController::class, 'index']); // List all cart items
    Route::post('/', [CartItemController::class, 'store']); // Add a new cart item
    Route::get('/{cartItem}', [CartItemController::class, 'show']); // Show a specific cart item
    Route::put('/{cartItem}', [CartItemController::class, 'update']); // Update a specific cart item
    Route::delete('/{cartItem}', [CartItemController::class, 'destroy']); // Remove a specific cart item
});

// Route Cart
Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth:sanctum');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->middleware('auth:sanctum');
Route::get('/cart', [CartController::class, 'view'])->middleware('auth:sanctum');  

// Order Products API URLs
Route::get('/order-products', [OrderProductController::class, 'index']);
Route::post('/order-products', [OrderProductController::class, 'store'])->middleware('auth:sanctum');
Route::get('/order-products/{orderProduct}', [OrderProductController::class, 'view']);
Route::patch('/order-products/{orderProduct}', [OrderProductController::class, 'update']);
Route::delete('/order-products/{orderProduct}', [OrderProductController::class, 'destroy']);

//Orders api urls
Route::get('/orders', [OrderController::class, 'view'])->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'add'])->middleware('auth:sanctum');
Route::get('/orders/{orderId}', [OrderController::class, 'show'])->middleware('auth:sanctum');
Route::patch('/orders/{orderId}', [OrderController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/orders/{orderId}', [OrderController::class, 'remove'])->middleware('auth:sanctum');

// Route Payment
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);

// Define API routes for the RecipeController
// Route::apiResource('recipes', RecipeController::class);
Route::get('/recipes', [RecipeController::class, 'index']);
Route::post('/recipes', [RecipeController::class, 'store']);
Route::get('/orders/{id}/recipes', [RecipeController::class, 'show']);
Route::put('/orders/{id}/recipes', [RecipeController::class, 'update']);
Route::delete('/recipes/{id}', [RecipeController::class, 'destroy']);
Route::post('/carts', [CartController::class, 'addProductToCart']);
Route::delete('/carts', [CartController::class, 'removeProductFromCart']);
Route::get('/carts', [CartController::class, 'getProductsFromCart']);
Route::post('/user', [UserController::class, 'createUser']);

// api for suppliers
Route::get('/suppliers',[SupplierController::class,'getSuppliers']);
Route::get('/suppliers/{supplierId}',[SupplierController::class,'getSupplier']);
Route::post('/suppliers',[SupplierController::class,'createSupplier']);
Route::patch('/suppliers/{supplierId}',[SupplierController::class,'updateSupplier']);
Route::delete('/suppliers/{supplierId}',[SupplierController::class,'deleteSupplier']);


// api for purchases
Route::get('/purchases',[PurchaseController::class,'getPurchases']);
Route::get('purchases/{purchaseId}',[PurchaseController::class,'getPurchase']);
Route::post('/purchases',[PurchaseController::class,'createPurchase']);
Route::patch('/purchases/{purchaseId}',[PurchaseController::class,'updatePurchase']);
Route::delete('/purchases/{purchaseId}',[PurchaseController::class,'deletePurchase']);
Route::patch('/purchase/{purchaseId}', [PurchaseController::class, 'updateStatus']);

// api for purchaseProducts
Route::get('/purchaseProducts',[PurchaseProductController::class,'getPurchaseProducts']);
Route::get('purchaseProducts/{purchaseProductId}',[PurchaseProductController::class,'getPurchaseProduct']);
Route::post('/purchaseProducts',[PurchaseProductController::class,'createPurchaseProduct']);
Route::patch('/purchaseProducts/{purchaseProductId}',[PurchaseProductController::class,'updatePurchaseProduct']);
Route::delete('/purchaseProducts/{purchaseProductId}',[PurchaseProductController::class,'deletePurchaseProduct']);



// categories api urls
Route::get('/categories', [CategoryController::class,'getCategories']);
Route::post('/categories', [CategoryController::class,'createCategory']);
// Route::get('/categories/{categoryId}', [CategoryController::class,'getCategory']);
// Route::patch('/categories/{categoryId}', [CategoryController::class,'updateCategory']);
Route::get('/categories/{categoryId}', [CategoryController::class, 'getCategory']);
Route::patch('/categories/{categoryId}', [CategoryController::class, 'updateCategory']);

Route::delete('/categories/{categoryId}', [CategoryController::class,'deleteCategory']);
Route::get('/categories/{categoryId}/products', [CategoryController::class,'getProductsOfCategory']);



// Route::get('/products/{productId}/getFirstImage',[ProductController::class,'getFirstImage']);

// Route::middleware(['cors'])->group(function(){
//     Route::post('/products', [ProductController::class,'createProduct']);
// });

// products api urls

Route::get('/products', [ProductController::class,'getProducts']);
Route::post('/products', [ProductController::class,'createProduct']);
Route::get('/products/{productId}', [ProductController::class,'getProduct']);
Route::get('/products', [ProductController::class,'index']);
Route::patch('/products/{productId}', [ProductController::class,'updateProduct']);
Route::delete('/products/{productId}', [ProductController::class,'deleteProduct']);
Route::get('/products/{productId}/images', [ProductController::class,'getImagesOfProduct']);
Route::get('/products/{productId}/categories',[ProductController::class,'findProductsOfCategory']);
Route::get('products/{productId}/suppliers', [ProductController::class, 'getSuppliersByProduct']);


//suppliers api urls
Route::get('/suppliers',[SupplierController::class,'getSuppliers']);
Route::post('/suppliers',[SupplierController::class , 'createSupplier']);
Route::get('/suppliers/{supplierId}',[SupplierController::class ,'getSupplier']);
Route::patch('/suppliers/{supplierId}',[SupplierController::class,'updateSupplier']);
Route::delete('/suppliers/{supplierId}',[SupplierController::class,'deleteSupplier']);  
Route::get('/suppliers/{supplierId}/purchases',[SupplierController::class,'getPurchasesOfSupplier']);


// api for admin Authentication

Route::prefix('suppliers')->group(function () {
    Route::post('/login', [SupplierAuthController::class, 'login']);
    Route::middleware('auth:supplier')->post('/logout', [SupplierAuthController::class, 'logout']);
});

//Images api urls 
Route::get('/images',[ImageController::class, 'getImages']);

Route::post('/images',[ImageController::class,'createImage']);
Route::patch('/images/{imageId}',[ImageController::class,'updateImage']);
Route::get('/images/{imageId}',[ImageController::class,'getImage']);
Route::delete('images/{imageId}',[ImageController::class,'deleteImage']);





// add product form 

// // need to create customer 
// // -- Category api url
// Route::get('/categories',[CategoryController::class, 'getCategories']);
// Route::post('/categories',[CategoryController::class, 'createCategory']);
// Route::get('/categories/{categoryId}',[CategoryController::class, 'getCategory']);
// Route::patch('/categories/{categoryId}',[CategoryController::class, 'updateCategory']);
// Route::delete('/categories/{categoryId}',[CategoryController::class, 'deleteCategory']);
// Route::get('/categories/{categoryId}/products/productId',[CategoryController::class, 'getProductsOfCategory']);



// // -- Prodcut api url
// Route::get('/products',[CategoryController::class, 'getProducts']);
// Route::post('/products',[CategoryController::class, 'createProduct']);
// Route::get('/products/{productId}',[CategoryController::class, 'getProduct']);
// Route::patch('/products/{productId}',[CategoryController::class, 'updateProduct']);
// Route::delete('/products/{categoryId}',[CategoryController::class, 'deteProduct']);


// api for user Authentication
Route::post('/register',[AuthenticationController::class,'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/forgot-password', [AuthenticationController::class, 'forgotPassword']);
Route::get('reset-password/{token}', [AuthenticationController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthenticationController::class, 'resetPassword']);
Route::post('/logout', [AuthenticationController::class, 'logout']);



// User purchase route
Route::post('purchase', [UserController::class, 'purchase']);

Route::post('/logout', [AuthenticationController::class, 'logout']);

// api for admin Authentication

Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::middleware('auth:admin')->post('/logout', [AdminAuthController::class, 'logout']);
});

//promotion
Route::get('/promotions', [PromotionController::class, 'listAllPromotions']);
Route::get('/promotions/{promotionId}', [PromotionController::class, 'show']);
Route::post('/promotions', [PromotionController::class, 'createPromotion']);
Route::put('/promotions/{id}', [PromotionController::class, 'updatePromotion']);
Route::delete('/promotions/{id}', [PromotionController::class, 'deletePromotion']);
Route::get('/discountHistory', [PromotionController::class, 'discountHistory']);
Route::get('/showTime', [PromotionController::class, 'showTime']);


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
use App\Http\Controllers\CartController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

Route::post('accounts', [AccountController::class, 'createAccount']);
Route::get('accounts', [AccountController::class, 'showAllAccounts']);
Route::get('accounts/{account}', [AccountController::class, 'showAccount']);
Route::put('accounts/{account}', [AccountController::class, 'updateAccount']);
Route::delete('accounts/{account}', [AccountController::class, 'deleteAccount']);
Route::get('account-histroy/{account}', [AccountController::class, 'history']);
Route::get('accounts/{id}/statistics/{period}', [AccountController::class, 'statistics']);


Route::post('transactions/productSold', [TransactionController::class, 'productSold']);
Route::get('all-history', [TransactionController::class, 'history']);
Route::post('/transfer', [TransactionController::class, 'transfer']);



use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseProductController;


Route::post('/cart', [CartController::class, 'store']);



Route::post('/carts', [CartController::class, 'addProductToCart']);
Route::delete('/carts', [CartController::class, 'removeProductFromCart']);
Route::get('/carts', [CartController::class, 'getProductsFromCart']);
Route::post('/user', [UserController::class, 'createUser']);

// api for suppliers
Route::get('/suppliers',[SupplierController::class,'getSuppliers']);
Route::get('suppliers/{supplierId}',[SupplierController::class,'getSupplier']);
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
// Route::get('/order_products',[Order_productsController::class,'getOrderProducts']);
// Route::post('/order_products',[Order_productsController::class,'createOrderProduct']);
// Route::get('/order_products/{order_productsId}',[Order_productsController::class , 'getOrderProduct']);
// Route::patch('/order_products/{order_productsId}',[Order_productsController::class , 'updateOrderProduct']);
// Route::delete('/order_products/{order_productsId}',[Order_productsController::class,'deleteOrderProduct']);


Route::post('/create-payment-intent', [StripeController::class, 'createPaymentIntent']);
Route::post('/webhook', [StripeController::class, 'handlePaymentWebhook']);
// api for Authentication
// Route::post('/register',[AuthenticationController::class,'register']);


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
// Route::get('products', [ProductController::class, 'index']);

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

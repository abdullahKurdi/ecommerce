<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CustomerAddressController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\ProductCategoriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductCouponController;
use App\Http\Controllers\Backend\ProductReviewController;
use App\Http\Controllers\Backend\ShippingCompanyController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\SupervisorController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/'                  ,     [   FrontendController::class , 'index'    ])->name('frontend.index');
Route::get('/cart'              ,     [   FrontendController::class , 'cart'     ])->name('frontend.cart');
Route::get('/checkout'          ,     [   FrontendController::class , 'checkout' ])->name('frontend.checkout');
Route::get('/product/{slug?}'   ,     [   FrontendController::class , 'product'  ])->name('frontend.product');
Route::get('/shop'              ,     [   FrontendController::class , 'shop'     ])->name('frontend.shop');




Auth::routes(['verify'=>true]);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Backend Routes
Route::group(['prefix' => 'admin' ,'as' => 'admin.'], function() {

    Route::group(['middleware' => 'guest'], function (){
        Route::get('/login'           ,    [   BackendController::class   , 'login'             ])->name('login');
        Route::get('/forgot-password' ,    [   BackendController::class   , 'forgot_password'   ])->name('forgot_password');
    });

    Route::group(['middleware' => ['roles' , 'role:admin|supervisor']] , function (){

        Route::get('/'                                      ,    [   BackendController::class   , 'index'                               ])->name('index_route');
        Route::get('/index'                                 ,    [   BackendController::class   , 'index'                               ])->name('index');
        Route::post('/remove_image'                         ,    [   BackendController::class   ,'remove_image'                         ])->name('remove_image');
        Route::get('/account_settings'                      ,    [   BackendController::class   , 'account_settings'                    ])->name('account_settings');
        Route::patch('/account_settings'                    ,    [   BackendController::class   , 'update_account_settings'             ])->name('update_account_settings');

        Route::post('/product_category/remove_image'        ,    [   ProductCategoriesController::class    ,'remove_image'])->name('product_categories.remove_image');
        Route::resource('product_categories'              ,ProductCategoriesController::class     );

        Route::post('/product/remove_image'                 ,    [   ProductController::class               ,'remove_image'])->name('product.remove_image');
        Route::resource('products'                        ,ProductController::class               );

        Route::resource('tags'                            ,TagController::class                   );

        Route::resource('product_coupons'                 ,ProductCouponController::class         );

        Route::resource('product_reviews'                 ,ProductReviewController::class         );

        Route::post('/customer/remove_image'                ,    [   CustomerController::class               ,'remove_image'])->name('customers.remove_image');
        Route::get('/customers/get_customers'               ,    [   CustomerController::class                  ,'get_customers'])->name('customers.get_customers');
        Route::resource('customers'                       ,CustomerController::class         );
        Route::resource('customer_addresses'              ,CustomerAddressController::class);

        Route::post('/supervisor/remove_image'              ,    [   SupervisorController::class               ,'remove_image'])->name('supervisors.remove_image');
        Route::resource('supervisors'                     ,SupervisorController::class         );

        Route::resource('countries', CountryController::class);
        Route::get('states/get_states', [StateController::class, 'get_states'])->name('states.get_states');

        Route::resource('states', StateController::class);
        Route::get('cities/get_cities', [CityController::class, 'get_cities'])->name('cities.get_cities');

        Route::resource('cities', CityController::class);

        Route::resource('shipping_companies', ShippingCompanyController::class);

    });

});


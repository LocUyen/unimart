<?php

use GuzzleHttp\Middleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


#admin
Route::get('/admin', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    #dashboard
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@show');

    Route::group(['prefix' => 'admin'], function () {

        #user
        Route::group(['prefix' => 'user'], function () {
            Route::get('list', 'App\Http\Controllers\AdminUserController@list')->name('user.list')->can('user.list');
            //add
            Route::get('add', 'App\Http\Controllers\AdminUserController@add')->name('user.add')->can('user.add');
            Route::post('store', 'App\Http\Controllers\AdminUserController@store')->name('user.store')->can('user.add');
            //delete
            Route::get('delete/{id}', 'App\Http\Controllers\AdminUserController@delete')->name('user.delete')->can('user.delete');
            Route::get('action', 'App\Http\Controllers\AdminUserController@action')->name('user.action')->can('user.delete');
            //edit
            Route::get('edit/{id}', 'App\Http\Controllers\AdminUserController@edit')->name('user.edit')->can('user.edit');
            Route::post('update/{id}', 'App\Http\Controllers\AdminUserController@update')->name('user.update')->can('user.edit');
        });

        #permissions
        Route::group(['prefix' => 'permission'], function () {
            //add
            Route::get('add', 'App\Http\Controllers\AdminPermissionController@add')->name('permission.add')->can('permission.add');
            Route::post('store', 'App\Http\Controllers\AdminPermissionController@store')->name('permission.store')->can('permission.add');
            //delete
            Route::get('delete/{id}', 'App\Http\Controllers\AdminPermissionController@delete')->name('permission.delete')->can('permission.delete');
            //edit
            Route::get('edit/{id}', 'App\Http\Controllers\AdminPermissionController@edit')->name('permission.edit')->can('permission.edit');
            Route::post('update/{id}', 'App\Http\Controllers\AdminPermissionController@update')->name('permission.update')->can('permission.edit');


        });


        #role
        Route::group(['prefix' => 'role'], function () {
            //list
            Route::get('list', 'App\Http\Controllers\AdminRoleController@list')->name('role.list')->can('role.list');
            //add
            Route::get('add', 'App\Http\Controllers\AdminRoleController@add')->name('role.add')->can('role.add');
            Route::post('store', 'App\Http\Controllers\AdminRoleController@store')->name('role.store')->can('role.add');
            //delete
            Route::get('delete/{role}', 'App\Http\Controllers\AdminRoleController@delete')->name('role.delete')->can('role.delete');
            //edit
            Route::get('edit/{role}', 'App\Http\Controllers\AdminRoleController@edit')->name('role.edit')->can('role.edit');
            Route::post('update/{role}', 'App\Http\Controllers\AdminRoleController@update')->name('role.update')->can('role.edit');


        });

        Route::group(['prefix' => 'product'], function () {
            #product_cat
            //add
            Route::get('cat/add', 'App\Http\Controllers\AdminCategoriesController@add')->can('productcat.add');
            Route::post('cat/store', 'App\Http\Controllers\AdminCategoriesController@store')->can('productcat.add');
            //delete
            Route::get('cat/delete/{id}', 'App\Http\Controllers\AdminCategoriesController@delete')->name('delete_category')->can('productcat.delete');
            //edit
            Route::get('cat/edit/{id}', 'App\Http\Controllers\AdminCategoriesController@edit')->name('category.edit')->can('productcat.edit');;
            Route::post('cat/update/{id}', 'App\Http\Controllers\AdminCategoriesController@update')->name('category.update')->can('productcat.edit');

            #product
            Route::get('list', 'App\Http\Controllers\AdminProductController@list')->can('product.list');
            //add
            Route::group(['prefix' => 'laravel-filemanager'], function () {
                \UniSharp\LaravelFilemanager\Lfm::routes();
            });
            Route::get('add', 'App\Http\Controllers\AdminProductController@add')->can('product.add');
            Route::post('store', 'App\Http\Controllers\AdminProductController@store')->can('product.add');
            //edit
            Route::get('edit/{id}', 'App\Http\Controllers\AdminProductController@edit')->name('product.edit')->can('product.edit');
            Route::post('update/{id}', 'App\Http\Controllers\AdminProductController@update')->name('product.update')->can('product.edit');
            //delete
            Route::get('delete/{id}', 'App\Http\Controllers\AdminProductController@delete')->name('delete_product')->can('product.delete');
            Route::get('action', 'App\Http\Controllers\AdminProductController@action')->can('product.delete');
        });

        #customer
        Route::group(['prefix' => 'customer'], function () {
            Route::get('list', 'App\Http\Controllers\AdminCustomerController@list')->can('customer.list');
        });

        #order
        Route::group(['prefix' => 'order'], function () {
            Route::get('list', 'App\Http\Controllers\AdminOrderController@list')->can('order.list');
            //edit
            Route::get('edit/{id}', 'App\Http\Controllers\AdminOrderController@edit')->name('order.edit')->can('order.edit');
            Route::post('update/{id}', 'App\Http\Controllers\AdminOrderController@update')->name('order.update')->can('order.edit');
            //delete
            Route::get('delete/{id}', 'App\Http\Controllers\AdminOrderController@delete')->name('delete_order')->can('order.delete');
            Route::post('action', 'App\Http\Controllers\AdminOrderController@action')->can('order.delete');

        });

        Route::group(['prefix' => 'post'], function () {
            #post_cat
            //add
            Route::get('cat/add', 'App\Http\Controllers\AdminPostCatController@add')->can('postcat.add');
            Route::post('cat/store', 'App\Http\Controllers\AdminPostCatController@store')->can('postcat.add');
            //delete
            Route::get('cat/delete/{id}', 'App\Http\Controllers\AdminPostCatController@delete')->name('delete_postcat')->can('postcat.delete');
            //edit
            Route::get('cat/edit/{id}', 'App\Http\Controllers\AdminPostCatController@edit')->name('postcat.edit')->can('postcat.edit');
            Route::post('cat/update/{id}', 'App\Http\Controllers\AdminPostCatController@update')->name('postcat.update')->can('postcat.edit');

            #post
            Route::get('list', 'App\Http\Controllers\AdminPostController@list')->can('post.list');
            //add
            Route::get('add', 'App\Http\Controllers\AdminPostController@add')->can('post.add');
            Route::post('store', 'App\Http\Controllers\AdminPostController@store')->can('post.add');
            //edit
            Route::get('edit/{id}', 'App\Http\Controllers\AdminPostController@edit')->name('post.edit')->can('post.edit');
            Route::post('update/{id}', 'App\Http\Controllers\AdminPostController@update')->name('post.update')->can('post.edit');
            //delete
            Route::get('delete/{id}', 'App\Http\Controllers\AdminPostController@delete')->name('delete_post')->can('post.delete');
            Route::post('action', 'App\Http\Controllers\AdminPostController@action')->can('post.delete');
        });

        #menu
        Route::group(['prefix' => 'menu'], function () {
            //add
            Route::get('add', 'App\Http\Controllers\AdminMenuController@add')->can('menu.add');
            Route::post('store', 'App\Http\Controllers\AdminMenuController@store')->can('menu.add');
            //delete
            Route::get('delete/{id}', 'App\Http\Controllers\AdminMenuController@delete')->name('delete_menu')->can('menu.delete');
            //edit
            Route::get('edit/{id}', 'App\Http\Controllers\AdminMenuController@edit')->name('menu.edit')->can('menu.edit');
            Route::post('update/{id}', 'App\Http\Controllers\AdminMenuController@update')->name('menu.update')->can('menu.edit');
        });

        #slider
        Route::group(['prefix' => 'slider'], function () {
            //add
            Route::get('add', 'App\Http\Controllers\AdminSliderController@add')->can('slider.add');
            Route::post('store', 'App\Http\Controllers\AdminSliderController@store')->can('slider.add');
            //delete
            Route::get('delete/{id}', 'App\Http\Controllers\AdminSliderController@delete')->name('delete_slider')->can('slider.delete');
            //edit
            Route::get('edit/{id}', 'App\Http\Controllers\AdminSliderController@edit')->name('slider.edit')->can('slider.edit');
            Route::post('update/{id}', 'App\Http\Controllers\AdminSliderController@update')->name('slider.update')->can('slider.edit');
        });

        #page
        Route::group(['prefix' => 'page'], function () {
            Route::get('list', 'App\Http\Controllers\AdminPageController@list')->can('page.list');
            //add
            Route::get('add', 'App\Http\Controllers\AdminPageController@add')->can('page.add');
            Route::post('store', 'App\Http\Controllers\AdminPageController@store')->can('page.add');
            //edit
            Route::get('edit/{id}', 'App\Http\Controllers\AdminPageController@edit')->name('page.edit')->can('page.edit');
            Route::post('update/{id}', 'App\Http\Controllers\AdminPageController@update')->name('page.update')->can('page.edit');
            //delete
            Route::get('delete/{id}', 'App\Http\Controllers\AdminPageController@delete')->name('delete_page')->can('page.delete');
            Route::get('action', 'App\Http\Controllers\AdminPageController@action')->can('page.delete');
        });

    });
});








#Public
//trang chủ
Route::get('/', 'App\Http\Controllers\HomeController@show')->name('home');
//tìm kiếm
Route::get('/san-pham/tim-kiem', 'App\Http\Controllers\HomeController@search')->name('search');
Route::post('/san-pham/tim-kiem-auto', 'App\Http\Controllers\HomeController@searchAuto')->name('search.auto');


//product
Route::get('san-pham', 'App\Http\Controllers\ProductController@show')->name('product.show');
Route::get('san-pham/{slug_cat}', 'App\Http\Controllers\ProductController@category')->name('product.category');
Route::get('san-pham/{slug}/html', 'App\Http\Controllers\ProductController@detail')->name('product.detail');

//cart
Route::get('cart/add/{id}', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::get('cart/show', 'App\Http\Controllers\CartController@show');
Route::get('cart/remove/{rowId}', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::get('cart/destroy', 'App\Http\Controllers\CartController@destroy')->name('cart.destroy');
Route::post('cart/update', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::post('cart/update_ajax', 'App\Http\Controllers\CartController@update_ajax')->name('cart.update_ajax');
Route::get('cart/quick_checkout/{id}', 'App\Http\Controllers\CartController@quick_checkout')->name('cart.quick_checkout');

//checkout
Route::get('order/checkout', 'App\Http\Controllers\OrderController@checkout')->name('order.checkout');
Route::post('order/store', 'App\Http\Controllers\OrderController@store')->name('order.store');
Route::get('order/success', 'App\Http\Controllers\OrderController@success')->name('order.success');
Route::post('order/address_ajax', 'App\Http\Controllers\OrderController@address_ajax')->name('order.address_ajax');
// Route::get('order/quick_checkout', 'App\Http\Controllers\OrderController@quick_checkout')->name('order.quick_checkout');

//post
Route::get('bai-viet', 'App\Http\Controllers\PostController@show')->name('post.show');
Route::get('bai-viet/{slug}.html', 'App\Http\Controllers\PostController@detail')->name('post.detail');

//menu
Route::get('{slug}.html', 'App\Http\Controllers\HomeController@page')->name('home.page');

<?php
use Illuminate\Support\Facades\Route;
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
Route::get('/', function () {
    $items = App\Item::paginate(12);
    return view('index', compact('items'));
});

Auth::routes();

Route::get('logout', function() {
    Auth::logout();
    return redirect('/');
});

#role:admin
Route::prefix('admin')->middleware(['auth', 'is-admin'])->group(function()
{
    Route::get('/', function () {

        return view('admin.index');
    })->name('admin');

    Route::get('categories', 'CategoryController@create')->name('categories.create');
    Route::post('categories/store', 'CategoryController@store')->name('categories.store');
    Route::get('categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::patch('categories/{category}/update', 'CategoryController@update')
        ->name('categories.update');
    Route::patch('categories/{category}/update/logo', 'CategoryController@updateLogo')
        ->name('categories.update.logo');
    Route::delete('categories/{category}/delete', 'CategoryController@destroy')
        ->name('categories.destroy');

    Route::delete('specificationGroups/{group}/delete', 'SpecificationGroupController@destroy')->name('groups.destroy');
    Route::post('specificationGroups/store', 'SpecificationGroupController@store')->name('groups.store');

    Route::delete('specifications/{specification}/delete', 'SpecificationController@destroy')->name('specifications.destroy');

    Route::get('items', 'ItemController@create')->name('items.create');
    Route::post('items/store', 'ItemController@store')->name('items.store');
    Route::get('items/{item}/edit', 'ItemController@edit')->name('items.edit');
    Route::patch('items/{item}/update', 'ItemController@update')->name('items.update');
    Route::delete('items/{item}/delete', 'ItemController@destroy')->name('items.destroy');

    Route::post('items/{item}/itemImages/store', 'ItemImageController@store')->name('itemImages.store');
    Route::patch('itemImages/{itemImage}/update', 'ItemImageController@update')->name('itemImages.update');
    Route::delete('itemImages/{itemImage}/delete', 'ItemImageController@destroy')->name('itemImages.destroy');

    Route::patch('items/{item}/itemSpecifications/update', 'ItemSpecificationController@update')->name('itemSpecifications.update');

    Route::get('brands', 'BrandController@create')->name('brands.create');
    Route::post('brands/store', 'BrandController@store')->name('brands.store');
    Route::get('brands/{brand}/edit', 'BrandController@edit')->name('brands.edit');
    Route::patch('brands/{brand}/update', 'BrandController@update')->name('brands.update');
    Route::delete('brands/{brand}/delete', 'BrandController@destroy')->name('brands.destroy');
    Route::patch('brands/{brand}/update/logo', 'BrandController@updateLogo')
        ->name('brands.update.logo');

    Route::get('users', 'UserController@index')->name('users');
    Route::get('users/{user}', 'UserController@show')->name('users.show');
    Route::delete('users/{user}/delete', 'UserController@destroy')->name('users.destroy');

    Route::get('orders', 'OrderController@index')->name('admin.orders');
    Route::get('orders/{order}', 'OrderController@show')->name('admin.orders.show');


    Route::get('transactions', 'TransactionController@index')->name('transactions');
    Route::get('settings',  function () {

        return view('admin.settings');
    })->name('admin.settings');
});

#role:user
Route::prefix('account')->middleware(['auth', 'is-user'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('addresses', 'AddressController@index')->name('addresses');
    Route::post('addresses/store', 'AddressController@store')->name('addresses.store');
    Route::delete('addresses/{address}/delete', 'AddressController@destroy')->name('addresses.destroy');
    Route::get('orders', 'OrderController@index')->name('account.orders');
    Route::get('orders/{order}', 'OrderController@show')->name('account.orders.show');
    Route::get('settings', 'HomeController@index')->name('settings');
});

Route::middleware(['auth'])->group(function () {
    Route::patch('orders/{order}/cancel', 'OrderController@cancel')->name('orders.cancel');
    Route::patch('orders/{order}/complete', 'OrderController@complete')->name('orders.complete');
    Route::get('last-order', 'OrderController@last')->name('orders.last');
    Route::get('orders/{order}/execute', 'OrderController@execute')->name('orders.execute');

    Route::patch('users/{user}/update', 'UserController@update')->name('users.update');

    Route::post('items/{item}/reviews/store', 'ReviewController@store')->name('reviews.store');
    Route::delete('reviews/{review}/delete', 'ReviewController@destroy')->name('reviews.destroy');

});

Route::prefix('payment')->middleware(['auth'])->group(function() {
    Route::get('checkout', 'PaymentController@checkout')->name('checkout');
    Route::post('submit', 'PaymentController@submit')->name('payment.submit');
});

Route::get('categories', 'CategoryController@index')->name('categories');
Route::get('categories/{category}', 'CategoryController@show')->name('categories.show');
Route::get('categories/{category}/ajax', 'CategoryController@CategoryAjaxResponse')->name('category.ajax');

Route::get('items', 'ItemController@index')->name('items');
Route::get('items/{item}', 'ItemController@show')->name('items.show');

Route::get('brands', 'BrandController@index')->name('items');
Route::get('brands/{brand}', 'BrandController@show')->name('brands.show');

Route::get('/specifications/{group}/ajax', 'SpecificationController@SpecificationAjaxResponse');

Route::get('cart', 'CartController@index')->name('cart');
Route::post('cart/{item}/add', 'CartController@addToCart')->name('add-to-cart');
Route::post('cart/clear', 'CartController@clearCart')->name('clear-cart');
Route::delete('cart/{item}/remove', 'CartController@removeFromCart')->name('remove-from-cart');
Route::patch('cart/{item}/update', 'CartController@update')->name('update-cart-item');


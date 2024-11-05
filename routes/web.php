<?php

use App\Http\Controllers\AllController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

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

//untuk akses alamat website sesuai dengan route yang telah dibuat
Route::get('/', function () {
    return view('welcome', [
        'header' => 'Home',
        'categories' => Category::all()
    ]);
});


//untuk akses ke server login
Route::get('/login', 'AllController@vlogin')->name('login');
Route::post('/login', 'AllController@login');

Route::get('/logout', 'AllController@logout');

Route::get('/register', 'AllController@vregister')->name('register');
Route::post('/register', 'AllController@register');

Route::get('/category/{category:id}', 'AllController@category');
Route::get('/products', 'AllController@products');
Route::get('/product/{product:id}', 'AllController@product');

Route::get('/cart', 'AllController@cart')->name('cart')->middleware('auth');
Route::post('/postcart/{product}', 'AllController@postcart')->name('postcart')->middleware('auth');
Route::post('/deletecart/{DetailTransaksi}', 'AllController@deletecart')->name('deletecart');

Route::get('/checkout/{detailtransaksi}', 'AllController@checkout')->name('checkout')->middleware('auth');
Route::post('/postcheckout/{detailtransaksi}', 'AllController@postcheckout')->name('postcheckout');

Route::get('/summary', 'AllController@summary')->name('summary')->middleware('auth');

Route::get('/kelola', 'AllController@kelola')->name('kelola')->middleware('auth');

Route::get('/tambah', 'AllController@tambah')->name('tambah')->middleware('auth');
Route::post('/posttambah', 'AllController@posttambah')->name('posttambah')->middleware('auth');

Route::get('/edit/{product}', 'AllController@edit')->name('edit')->middleware('auth');
Route::post('/postedit/{product}', 'AllController@postedit')->name('postedit')->middleware('auth');

Route::post('/deleteproduct/{product:id}', 'AllController@deleteproduct')->name('deleteproduct')->middleware('auth');

Route::get('/category', 'AllController@categoryIndex')->name('category.index')->middleware('auth');
Route::get('/categories/create', 'AllController@categoryCreate')->name('category.buat')->middleware('auth');
Route::post('/category/store', 'AllController@categoryPost')->name('category.post')->middleware('auth');
Route::get('/category/edit/{id}', 'AllController@categoryEdit')->name('category.edit')->middleware('auth');
Route::post('/category/update/{id}', 'AllController@categoryUpdate')->name('category.update')->middleware('auth');
Route::post('/category/delete/{id}', 'AllController@categoryDestroy')->name('category.delete')->middleware('auth');


Route::get('/pdf/{id}/pdf', 'AllController@pdf')->name('pdf')->middleware('auth');

Route::post('/products/{product}/reviews', 'AllController@store')->name('reviews.store')->middleware('auth');

Route::get('/account', 'AllController@showACC')->name('account.index')->middleware('auth');


Route::get('/status', 'AllController@statusShow')->name('status.index')->middleware('auth');
Route::post('/status/{id}', 'AllController@statusEdit')->name('status.edit')->middleware('auth');

Route::get('/users', 'AllController@kelolausers')->name('kelola.show')->middleware('auth');
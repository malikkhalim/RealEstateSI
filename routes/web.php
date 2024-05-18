<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShortlistController;
use App\Http\Controllers\ListingController;


Auth::routes();

Route::get('/', 'FrontEndController@index' )->name('index');
Route::get('/listings', 'FrontEndController@listings' )->name('listings');
Route::get('/listing/{id}', 'FrontEndController@listing' )->name('single.listing');
Route::get('/calculation/{id}', 'FrontEndController@calculation' )->name('calculation');
Route::get('/dashboard', 'FrontEndController@dashboard' )->name('dashboard');
Route::get('/about', 'FrontEndController@about' )->name('about');
Route::get('/query', 'searchController@search' )->name('search');
Route::get('/search', 'searchController@result' )->name('result');
Route::post('/contact', 'ContactController@store' )->name('send-message');
Route::resource('becomerealtor', 'NewRealtorController');
Route::put('/realtors/{id}/update-role', [RealtorController::class, 'updateRealtorRole'])->name('realtors.updateRole');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('shortlist', 'ShortlistController@store')->name('shortlist.store');
Route::delete('shortlist', 'ShortlistController@destroy')->name('shortlist.destroy');





// 'middleware' => 'auth'
// ['middleware'=>'auth']
// isauthorize:0 -> 0 == admin
Route::group(['prefix' => 'back','middleware' => 'isauthorize:0'], function() {

    Route::get('/', 'AdminController@index' )->name('admin.index');
    Route::resource('listings', 'ListingController');
    Route::resource('realtors', 'RealtorController');
    Route::resource('users', 'UserController');
    Route::resource('som', 'SellerOftheMonth');
    Route::resource('inquiries', 'InquiryController');

});

Route::group(['prefix' => 'forward','middleware' => 'isauthorize:1'], function() {
    Route::resource('inquiry', 'InquiryRealtorController' );
    Route::resource('mylisting', 'ListingRealtorController' );
});




    // Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    // Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    // Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    
    // Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    


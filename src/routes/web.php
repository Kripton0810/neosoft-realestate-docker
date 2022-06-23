<?php

use App\Http\Controllers\HomeDashboard;
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

Route::get('/',[HomeDashboard::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('testme/{id}','HomeDashboard@showProperty')->name('findproperty');
Route::get('showproperty/{id}','Admin\Property@showProperty')->name('showproperty');
Route::post('sortpage','HomeDashboard@filterSortHomePage')->name('sort');
Route::post('sendmessage','HomeDashboard@sendMessage')->name('sendmassage');
require __DIR__.'/auth.php';


//Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/','HomeController@adminhome')->name('adminhome');
    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        //login routes
        Route::get('login','AuthenticatedSessionController@create')->name('login');
        Route::post('login','AuthenticatedSessionController@store')->name('adminlogin');
    });
    Route::middleware('admin')->group(function(){
        Route::get('dashboard','HomeController@index')->name('dashboard');
        Route::get('addproperty','Property@index')->name('addproperty');
        Route::resource('property','Property');
        Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
        Route::get('getuser','Property@getUser')->name('getuser');
        Route::post('addproperty','Property@store')->name('storeproperty');
        Route::get('messages/{id}','Property@showMessages')->name('mymessages');
    });
});

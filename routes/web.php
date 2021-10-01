<?php

use Illuminate\Support\Facades\Route;
use App\Models\Cars;
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



Route::get('/', 'App\Http\Controllers\CarController@customcarlist');

Route::get('/addcars', 'App\Http\Controllers\CarController@create');
Route::post('/insertcars','App\Http\Controllers\CarController@store');
Route::get('delete/{id}','App\Http\Controllers\CarController@destroy');
Route::get('edit/{id}','App\Http\Controllers\CarController@edit');
Route::post('/update','App\Http\Controllers\CarController@update');

/* Route::get('/', function () {
    return view('welcome');

    
}); */


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    $cars = Cars::select("*")
    ->where("user_id", Auth::id())
    ->get();
    
    return view('dashboard',compact('cars'));
   

})->name('dashboard');

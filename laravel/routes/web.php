<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});
Route::get('/adduser',function(){
     return view('adduser');
});
Route::post('adduser',[UsersController::class,'adduser'])->name('adduser');
Route::get('/get-users',function(){
    return view('users');
});
Route::get('edit-user/{id}',[UsersController::class,'getuserData']);
Route::post('update-data',[UsersController::class,'updateuser'])->name('updateuser');

//Route::get('/get-all-users',[UsersController::class,'getusers'])->name('getusers');

Auth::routes();
//Route::get('/login',[LoginController::class,'index']);


Route::get('/home', [HomeController::class, 'index'])->name('home');

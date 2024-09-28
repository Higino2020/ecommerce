<?php

use App\Http\Controllers\{
    HomeController,
    UserController
};
use App\Http\Controllers\CarrinhoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>'auth'], function () {
    Route::get('carrinho', [CarrinhoController::class,'']);
});

Route::group(['prefix'=>'gestor'],function(){
    Route::get('/',[HomeController::class,'index'])->name('admin.index');
    Route::get('user',[UserController::class,'index'])->name('admin.user');
});

Auth::routes();

Route::get('/home', function(){
    return redirect()->route('admin.index');
})->name('home');

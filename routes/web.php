<?php

use App\Http\Controllers\{
    HomeController,
    UserController
};
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});
Route::group(['middleware'=>'auth'], function () {
    Route::get('carrinho', [CarrinhoController::class,'']);
});

Route::group(['prefix'=>'gestor', 'middleware'=>'auth'],function(){
    Route::get('/',[HomeController::class,'index'])->name('admin.index');
    Route::get('user',[UserController::class,'index'])->name('admin.user');
    Route::resource('catego',CategoriaController::class);
    Route::get('catego/{id}/apagar',[CategoriaController::class,'apagar'])->name('catego.apagar');
    Route::get('sairadmin',[UserController::class,'sairadmin'])->name('sairadmin');
});

Auth::routes();

Route::get('/home', function(){
    return redirect()->route('admin.index');
})->name('home');

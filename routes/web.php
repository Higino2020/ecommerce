<?php

use App\Http\Controllers\{
    HomeController,
    SubcategoriaController,
    UserController,
    CategoriaController,
    CarrinhoController,
    MarcaController,
    ProdutoController
};
use Illuminate\Support\Facades\Auth;
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
    //categorias e suas routas
    Route::resource('catego',CategoriaController::class);
    Route::get('catego/{id}/apagar',[CategoriaController::class,'apagar'])->name('catego.apagar');
    //subcategorias e suas routas
    Route::resource('subcatego',SubcategoriaController::class);
    Route::get('subcatego/{id}/apagar',[SubcategoriaController::class,'apagar'])->name('subcatego.apagar');
    //marcas e suas routas
    Route::resource('marca',MarcaController::class);
    Route::get('marca/{id}/apagar',[MarcaController::class,'apagar'])->name('marca.apagar');
    //Produtos e suas routas
    Route::resource('product',ProdutoController::class);
    Route::get('product/{id}/apagar',[ProdutoController::class,'apagar'])->name('product.apagar');
    //routa para sair do administrador
    Route::get('sairadmin',[UserController::class,'sairadmin'])->name('sairadmin');
});

Auth::routes();

Route::get('/home', function(){
    return redirect()->route('admin.index');
})->name('home');

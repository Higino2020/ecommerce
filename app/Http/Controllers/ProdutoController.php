<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produto = Produto::all();
        return view("admin.produto", compact("produto"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produto = null;
        $sms = "";
        try{
            if(isset($request->id)){
                $produto = Produto::find($request->id);
                $sms = "Actulizado com exito";
            }else{
                $produto = new Produto();
                $sms = "Cadastro realizado com exito";
            }

            if(isset($request->imagem)){
                $file = $request->imagem;
                $imagename = md5($file->getClientOriginalName().strtotime('now'));
                $file->move(public_path('img/Produto'), $imagename);
                $produto->imagem = $imagename;
            }
            $produto->titulo = $request->titulo;
            $produto->codigo = $request->codigo;
            $produto->preco = $request->preco;
            $produto->estado = $request->estado;
            $produto->qtd = $request->qtd;
            $produto->categoria_id = $request->categoria_id;
            $produto->subcategoria_id = $request->subcategoria_id;
            $produto->marca_id = $request->marca_id;
            $produto->descricao = $request->descricao;
            $produto->save();
            return redirect()->back()->with('success',$sms);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function apagar($sub)
    {
        try{
            Produto::find($sub)->delete();
            return redirect()->back()->with('success','Realizado com exito');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}

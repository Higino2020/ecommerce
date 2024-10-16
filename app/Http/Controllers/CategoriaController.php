<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria = Categoria::all();
        return view("admin.categoria", compact("categoria"));
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
        $categoria = null;
        $sms = "";
        try{
            if(isset($request->id)){
                $categoria = Categoria::find($request->id);
                $sms = "Actulizado com exito";
            }else{
                $categoria = new Categoria();
                $sms = "Cadastro realizado com exito";
            }

            if(isset($request->imagem)){
                $file = $request->imagem;
                $extecio = $file->extension();
                $imagename = md5($file->getClientOriginalName().strtotime('now'));
                $file->move(public_path('img/categoria'), $imagename);
                $categoria->imagem = $imagename;
            }
            $categoria->titulo = $request->titulo;
            $categoria->descricao = $request->descricao;
            $categoria->save();
            return redirect()->back()->with('success',$sms);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function apagar($categoria)
    {
        try{
            Categoria::find($categoria)->delete();
            return redirect()->back()->with('success','Realizado com exito');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}

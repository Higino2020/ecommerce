<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Exception;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategoria = Subcategoria::all();
        return view("admin.subcategoria", compact("subcategoria"));
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
                $categoria = Subcategoria::find($request->id);
                $sms = "Actulizado com exito";
            }else{
                $categoria = new Subcategoria();
                $sms = "Cadastro realizado com exito";
            }

            if(isset($request->imagem)){
                $file = $request->imagem;
                $imagename = md5($file->getClientOriginalName().strtotime('now'));
                $file->move(public_path('img/subcategoria'), $imagename);
                $categoria->imagem = $imagename;
            }
            $categoria->titulo = $request->titulo;
            $categoria->categoria_id = $request->categoria_id;
            $categoria->descricao = $request->descricao;
            $categoria->save();
            return redirect()->back()->with('success',$sms);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function apagar($sub)
    {
        try{
            Subcategoria::find($sub)->delete();
            return redirect()->back()->with('success','Realizado com exito');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function show(Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategoria $subcategoria)
    {
        //
    }
}

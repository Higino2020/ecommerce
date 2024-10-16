<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Exception;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marca = Marca::all();
        return view("admin.marca", compact("marca"));
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
        $marca = null;
        $sms = "";
        try{
            if(isset($request->id)){
                $marca = Marca::find($request->id);
                $sms = "Actulizado com exito";
            }else{
                $marca = new Marca();
                $sms = "Cadastro realizado com exito";
            }

            if(isset($request->imagem)){
                $file = $request->imagem;
                $imagename = md5($file->getClientOriginalName().strtotime('now'));
                $file->move(public_path('img/marca'), $imagename);
                $marca->imagem = $imagename;
            }
            $marca->titulo = $request->titulo;
            $marca->descricao = $request->descricao;
            $marca->save();
            return redirect()->back()->with('success',$sms);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        //
    }

    public function apagar($marc)
    {
        try{
            Marca::find($marc)->delete();
            return redirect()->back()->with('success','Realizado com exito');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        //
    }
}

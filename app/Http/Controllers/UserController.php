<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view("admin.user", compact("user"));
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
        $user = null;
        try{
            if (isset($request->id)) {
                $user = User::find($request->id);
            }else{
                $user = new User();
            }
            $user->name = $request->name;   
            $user->email = $request->email;
            $user->password = bcrypt("1234Funcionario");
            $user->save();
            return redirect()->back()->with("Sucesso","");
        }catch(\Exception $e){
            return redirect()->back()->with("Error","Erro ao cadastrar Usuario");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = User::find($user);
        return view("", compact("user"));
    }

   public function apagar($user){
    try{
        User::find($user)->delete();
        return redirect()->back()->with("Sucesso","");
    }catch(\Exception $e){
        return redirect()->back()->with("","");
    }
   }
}

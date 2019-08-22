<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Usuario;
use App\Http\Requests\UsuarioStore;
use App\Http\Requests\UsuarioSolicitanteEdit;

use App\Http\Controllers\LoginController;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.crearUsuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = (new Usuario)->fill($request->all());
        $usuario->password = Hash::make($request->password);
        // dd($usuario);
        if($usuario->save()){
            $login = new LoginController();
            return $login->auth(["correo" => $request->correo, "password" => $request->password], '/home');
        }else{
            return back()->withInput()->with('false', 'Algo no salio bien, intente nuevamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('inicio.perfil');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public static function editSolicitante(){
        $user = session('datos');
        if($user["nivel"]==null){
            return view('usuarios.editUsuarioSolicitante');
        }
    }

    public function updateSolicitante(UsuarioSolicitanteEdit $request){
        $user=session('datos');
        $usuario=Usuario::where("pk_usuario",$user["pk_usuario"])->get()[0];
        $usuario->fill($request->all());
        if(!$usuario->save()){
            return back()->withInput()->with('false', 'Algo no salio bien, intente nuevamente');
        }
        session(['datos'=> Auth::user()->session()]);
        return redirect("/solicitudes/crear");
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

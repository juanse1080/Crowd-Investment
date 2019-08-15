<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notificacion;

class NotificacionController extends Controller {

    public function conteoNotificacion(Request $request){
        if($request->ajax()){
            $notificaciones = Notificacion::where('notificacion.fk_usuario',session('datos')['pk_usuario'])->where('estado',false)->get();
            return response()->json([
                'numero' => count($notificaciones),
            ]);
        }
    }
    public function index()
    {
        $notificaciones = Notificacion::where('notificacion.fk_usuario',session('datos')['pk_usuario'])->get();
        return view('notificaciones.verNotificacion', ['notificaciones' => $notificaciones, 'num' => count($notificaciones)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id, request $request){
        if($request->ajax()){
            $empleado = Notificacion::findOrFail($id);
            $empleado->update([
                'estado' => true,
            ]);
            return response()->json([
                'mensaje' => 'Fue actualizado'
            ]);
        }
    }
}

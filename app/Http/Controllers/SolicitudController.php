<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SolicitudStoreController;
use App\Http\Controllers\SupraController;
use App\Http\Controllers\UsuarioController;
use App\Solicitud;
use App\Multimedia;
use App\Notificacion;

class SolicitudController extends Controller
{

    public function index()
    {
        $solicitudes = Solicitud::where('solicitud.fk_usuario', session('datos')['pk_usuario'])->get();
        return view('solicitudes.solicitudes', ['solicitudes' => $solicitudes]);
    }

    public function dashboard()
    {
        $solicitudes = Solicitud::where('fk_usuario', '<>', session('datos')['pk_usuario'])->where('solicitud.estado', 1)->get()->groupBy('categoria');
        return view('inicio.home', ['solicitudes' => $solicitudes]);
    }

    public function create()
    {   
        // dd(session('datos'));
        if(is_null(session('datos')['cedula']) || is_null(session('datos')['nivel']) || is_null(session('datos')['pasivos']) || is_null(session('datos')['activos'])){
            return redirect()->action('UsuarioController@completarInformacion');
        }
        return view('solicitudes.crearSolicitud');
    }

    public function store(SolicitudStoreController $request)
    {
        $solicitud = (new Solicitud)->fill($request->all());
        $solicitud->fk_usuario = session('datos')["pk_usuario"];
        $solicitud->save();
        if(count($request->fotos) > 0){
            foreach ($request->fotos as $foto) {
                $multimedia = Multimedia::create([
                    'fk_solicitud' => $solicitud->pk_solicitud,
                    'url' => '',
                ]);
                $multimedia->url = SupraController::subirArchivo($foto, 'solicitud' . $multimedia->pk_multimedia, 'foto');
                $multimedia->save();
            }
        }
        return redirect("/solicitudes");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = Solicitud::where('solicitud.pk_solicitud', $id)->first();
        return view('solicitudes.verSolicitud', ['solicitud' => $solicitud]);
    }

    public function confirmacion(request $request, $id)
    {
        if ($request->ajax()) {
            $solicitud = Solicitud::where('pk_solicitud', $id)->where('fk_usuario', session('datos')['pk_usuario'])->get();
            if (count($solicitud) == 1) {
                $solicitud[0]->estado = $request->res;
                $solicitud[0]->save();
                return response()->json([
                    'mensaje' => 'Se registro con exito',
                ]);
            }
        }
    }

    public function updateEstado(request $request, $pk_solicitud){
        if ($request->ajax()) {
            $solicitud = Solicitud::find($pk_solicitud);
            $solicitud -> estado = !boolval($request->estado);
            $solicitud -> save();
            if($solicitud -> estado){
                Notificacion::create([
                    'fk_usuario' => $solicitud -> fk_usuario,
                    'titulo' => '¡Tu solicitud #'.$solicitud -> pk_solicitud.' ya es visible!',
                    'descripcion' => 'Tu solicitud "'.$solicitud -> titulo.'" actualmente se encuentra activa, en este momento otros usuarios podran apoyar tu idea',
                    'url' => route('solicitudes.show', $solicitud -> pk_solicitud)
                ]);
            }
            return response()->json([
                'estado' => $solicitud -> estado,
            ]);
        }
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
    public function destroy($id)
    {
        //
    }

}

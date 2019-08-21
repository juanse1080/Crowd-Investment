<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InversionStore;
use App\Inversion;
use App\Notificacion;
use App\Solicitud;

class InversionController extends Controller
{

    public function index()
    {
        $inversiones = Inversion::where('inversion.fk_usuario', session('datos')['pk_usuario'])->groupBy('inversion.fk_solicitud')->get();
        // dd($inversiones);
        return view("inversiones.inversiones", ['inversiones' => $inversiones]);
    }

    public function create(Request $request)
    {
        $solicitud = Solicitud::select("pk_solicitud", "titulo")->where("pk_solicitud", $request->fk_solicitud)->get()[0];
        return view("inversiones.crearInversion", compact('solicitud'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $inversion = (new Inversion)->fill($request->all());
            $solicitud = Solicitud::find($request->fk_solicitud);
            $inversion -> fk_usuario = session('datos')['pk_usuario'];
            $inversion -> save();
            $solicitud -> monto_juntado = $request -> monto > ($solicitud -> monto_requerido - $solicitud -> monto_juntado) ? $solicitud -> monto_requerido : $solicitud -> monto_juntado + $request -> monto;
            $solicitud -> save();
            if($solicitud -> monto_juntado != $solicitud -> monto_requerido){
                Notificacion::create([
                    'fk_usuario' => $solicitud -> fk_usuario,
                    'titulo' => '¡Paso a paso se puede!',
                    'descripcion' => 'Tu solicitud "'.$solicitud -> titulo.'" tuvo una inversión por un monto igual a $'.number_format($solicitud -> monto_juntado).', estas cada vez mas cerca',
                    'url' => route('solicitudes.show', $solicitud -> pk_solicitud)
                ]);
            } else {
                Notificacion::create([
                    'fk_usuario' => $solicitud -> fk_usuario,
                    'titulo' => '!!!Felicidades¡¡¡',
                    'descripcion' => 'Tu solicitud "'.$solicitud -> titulo.'" completo el monto requerido. No olvides que el tiempo empieza a correr, tienes '.$solicitud -> tiempo_devolucion.' meses apartir de hoy' ,
                    'url' => route('solicitudes.show', $solicitud -> pk_solicitud)
                ]);
                foreach ($solicitud->inversiones as $inversion) {
                    Notificacion::create([
                        'fk_usuario' => $inversion -> fk_usuario,
                        'titulo' => '!!Pronto tendras tu dinero¡¡',
                        'descripcion' => 'La solicitud "'.$solicitud -> titulo.'" completo el monto requerido. El tiempo empieza a correr, te regresaran tu dinero en '.$solicitud -> tiempo_devolucion.' meses apartir de hoy' ,
                        'url' => route('solicitudes.show', $solicitud -> pk_solicitud)
                    ]);
                }
            }
            return response()->json([
                'href' => route('solicitudes.show', $request->fk_solicitud),
                'mensaje' => "¡La inversión fue realizada con exito!",
            ]);
        }
    }

    public function pagination(request $request, $pk_solicitud)
    {
        if ($request->ajax()) {

            if (Solicitud::find($pk_solicitud)->fk_usuario != session('datos')['pk_usuario']) {
                $solicitud = Solicitud::find($pk_solicitud)->inversiones()->join('solicitud', 'solicitud.pk_solicitud', 'inversion.fk_solicitud')->join('usuario', 'inversion.fk_usuario', 'usuario.pk_usuario')->select('inversion.*', 'usuario.*', 'solicitud.*')->where('inversion.fk_usuario', session('datos')['pk_usuario'])->orderBy('monto', 'desc')->get();
                $num = count($solicitud);
            } else {
                $solicitud = Solicitud::find($pk_solicitud)->inversiones()->join('solicitud', 'solicitud.pk_solicitud', 'inversion.fk_solicitud')->join('usuario', 'inversion.fk_usuario', 'usuario.pk_usuario')->select('inversion.*', 'usuario.*', 'solicitud.*')->orderBy('monto', 'desc')->get();
                $num = count($solicitud);
            }

            return response()->json([
                'pagina' => $request->pagina,
                'count' => $num,
                'inversiones' => $solicitud->slice($request->pagina * 10)->take(10),
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}

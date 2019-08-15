<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InversionStore;
use App\Inversion;
use App\Solicitud;

class InversionController extends Controller {

    public function index(){
        $inversiones = Inversion::where('inversion.fk_usuario',session('datos')['pk_usuario'])->join("solicitud","inversion.fk_solicitud","=","solicitud.pk_solicitud")->get();
        foreach ($inversiones as $i) {
            if($i->tiempo_recaudacion > date('Y-m-d')){
                if ($i->monto_requerido==$i->monto_juntado) {
                    $i->estado2="Monto requerido recolectado";
                }else{
                    $i->estado2="Recaudando";
                }
            }else{
                if($i->estado){
                    $i->estado2="Aprovado";    
                }else{
                    $i->estado2="Rechazado";
                }
            }
        }
        return view("inversiones.inversiones",compact('inversiones'));
    }

    public function create(Request $request){
        $solicitud=Solicitud::select("pk_solicitud","titulo")->where("pk_solicitud",$request->fk_solicitud)->get()[0];
        return view("inversiones.crearInversion",compact('solicitud'));
    }

    public function store(InversionStore $request){
        $solicitud=Solicitud::where("pk_solicitud",$request->fk_solicitud)->get();
        if(empty($solicitud[0])){
            return back()->withInput()->with('false', 'La solucitud escogida no existe.');
        }else{
            $solicitud=$solicitud[0];
            if(($solicitud->monto_juntado+$request->monto) <= $solicitud->monto_requerido){
                $inversion = (new Inversion)->fill($request->all());
                $inversion->fk_usuario=session('datos')['pk_usuario'];
                $solicitud->monto_juntado=$solicitud->monto_juntado+$request->monto;
                if($inversion->save() and $solicitud->save()){
                    return redirect("/inversiones");
                    // return "Creado";
                }else{
                    return back()->withInput()->with('false', 'Algo no salio bien, intente nuevamente.');
                }
            }else{
                // return "entro";
                // return back()->withInput()->with('false', 'El monto que desea donar no es valido, puede donar '.($solicitud->monto_requerido-$solicitud->monto_juntado).' o menos, para que el monto juntado no supere al requerido.');
                $msj="El monto que desea donar no es valido, puede donar ".($solicitud->monto_requerido-$solicitud->monto_juntado)." o menos, para que el monto juntado no supere al requerido.";
                return "<script>alert('$msj'); history.back(1);</script>";
                // return back();
                
            }
        }
        
        
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }
}

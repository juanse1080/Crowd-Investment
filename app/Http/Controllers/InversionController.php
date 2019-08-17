<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InversionStore;
use App\Inversion;
use App\Solicitud;

class InversionController extends Controller {

    public function index(){
        $inversiones = Inversion::where('inversion.fk_usuario',session('datos')['pk_usuario'])->groupBy('inversion.fk_solicitud')->get();
        // dd($inversiones);
        return view("inversiones.inversiones",['inversiones' => $inversiones]);
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

    public function pagination(request $request, $pk_solicitud)
    {
        if ($request->ajax()) {
            
            if(Solicitud::find($pk_solicitud)->fk_usuario != session('datos')['pk_usuario']){
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

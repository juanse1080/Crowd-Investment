<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Solicitud;
use App\Notificacion;
use App\Inversion;

class notificacionSolicitante extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificacion:solicitante';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creacion de la notificacion en caso de expiracion';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public static function handle(){
        $solicitudes = Solicitud::where('estado', 'i')->get();
        $dia = date('Y-m-d');
        foreach ($solicitudes as $value) {
            if($value->tiempo_recaudacion < $dia){
                $value->estado = 'e';
                $value->save();
                Notificacion::create([
                    'fk_usuario' => $value->fk_usuario,
                    'estado' => false,
                    'titulo' => '¡Tu solicitud '.$value->nombre.' expiro!',
                    'url' => '/solicitudes/'.$value->pk_solicitud,
                    'descripcion' => 'Tu solicitud numero '.$value->pk_solicitud.' ha expirado. Desea Aceptar el monto recolectado?'
                ]);
                $inversion = Inversion::where('fk_solicitud', $value->pk_solicitud)->get();
                foreach($inversion as $item){
                    Notificacion::create([
                        'fk_usuario' => $item->fk_usuario,
                        'estado' => false,
                        'titulo' => '¡Inversion numero '.$item->pk_inversion.'!',
                        'url' => '/inversiones/'.$item->pk_solicitud,
                        'descripcion' => '¡Tu inversion ha expirado, por favor espera la decision de tu solicitante!'
                    ]);
                }
            }else if($value->monto_requerido == $value->monto_juntado){
                $solicitud->estado = 'e';
                $solicitud->save();
                Notificacion::create([
                    'fk_usuario' => $value->fk_usuario,
                    'estado' => false,
                    'titulo' => '¡Tu solicitud '.$value->nombre.' ha cumplido su objetivo!',
                    'url' => '/solicitudes/'.$value->pk_solicitud,
                    'descripcion' => 'Tu solicitud numero '.$value->pk_solicitud.' ha completado el monto solicitado'
                ]);
                $inversion = Inversion::where('fk_solicitud', $value->pk_solicitud)->get();
                foreach($inversion as $item){
                    Notificacion::create([
                        'fk_usuario' => $item->fk_usuario,
                        'estado' => false,
                        'titulo' => '¡Inversion numero '.$item->pk_inversion.'!',
                        'url' => '/inversiones/'.$item->pk_solicitud,
                        'descripcion' => '¡Tu inversion ha alcanzado su objetivo!'
                    ]);
                }
            }
            
            // foreach($value ){

            // }
        }
        $notificaciones = Notificacion::where('notificacion.fk_usuario',session('datos')['pk_usuario'])->where('estado',false)->get();
        // dd($notificaciones);
        session(['noti'=>count($notificaciones)]);
    }
}

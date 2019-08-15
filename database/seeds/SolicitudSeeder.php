<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\SolicitudController;
use App\Solicitud;
use App\Usuario;

class SolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $usuario=Solicitud::where("pk_usuario","1");
        $usuario->nivel="Doctorado";
        $usuario->activos=10000000;
        $usuario->pasivos=5000000;
        $s=Solicitud::create([
            'fk_usuario' => '1',
            'titulo' => 'Servidores nuevos para LaU',
            'descripcion' => 'Se necesitan unos buenos servidores para las practicas de redes.',
            'categoria' => 'educacion',
            'monto_requerido' => 10000,
            'interes' => '1',
            'tiempo_devolucion'=>'12',
          ]);
    }
}

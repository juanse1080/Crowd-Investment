<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitud';
    protected $primaryKey = 'pk_solicitud';
    protected $fillable = ['pk_solicitud','fk_usuario','titulo','descripcion','categoria','estado','monto_requerido','monto_juntado','interes','tiempo_devolucion'];

    public function usuario(){
        return $this->belongsTo('App\Usuario', 'fk_usuario', 'pk_usuario');
    }

    public function multimedias(){
        return $this->hasMany('App\Multimedia', 'fk_solicitud', 'pk_solicitud');
    }

    public function inversiones(){
        return $this->hasMany('App\Inversion', 'fk_solicitud', 'pk_solicitud');
    }
}

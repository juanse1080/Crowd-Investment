<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable {

    use Notifiable;
    protected $table = 'usuario';
    protected $primaryKey = 'pk_usuario';
    protected $fillable = ['nombre','apellido','correo','password','cedula','fecha_nacimiento','nivel','pasivos','activos','empresa'];

    public function session(){
        return $this->attributes;
    }

    public function get_full_name(){
        return $this->nombre.' '.$this->apellido;
    }

    public function solicitudes(){
        return $this->hasMany('App\Solicitud', 'fk_usuario', 'pk_usuario');
    }

    public function inversiones(){
        return $this->hasMany('App\Inversion', 'fk_usuario', 'pk_usuario');
    }
}

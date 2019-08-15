<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inversion extends Model {
    protected $table = 'inversion';
    protected $primaryKey = 'pk_inversion';
    protected $fillable = ['pk_inversion', 'fk_solicitud','fk_usuario', 'monto'];

    public function usuario(){
        return $this->belongsTo('App\Usuario', 'fk_usuario', 'pk_usuario');
    }

    public function solicitud(){
        return $this->belongsTo('App\Solicitud', 'fk_solicitud', 'pk_solicitud');
    }
}

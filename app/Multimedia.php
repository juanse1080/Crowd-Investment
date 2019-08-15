<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $table = 'multimedia';
    protected $primaryKey = 'pk_multimedia';
    protected $fillable = ['pk_multimedia','fk_solicitud','descripcion','url'];

    public function solicitud(){
        return $this->belongsTo('App\Solicitud', 'fk_solicitud', 'pk_solicitud');
    }
}
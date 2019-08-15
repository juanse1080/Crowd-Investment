<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudStoreController extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'categoria' => 'required|string',
            'monto_requerido' => 'required|numeric',
            'interes' => 'required|numeric',
            'tiempo_recaudacion' => 'required|date',
            'tiempo_devolucion' => 'required|numeric',
            'foto' => 'image|mimes:jpeg,bmp,png,jpg',
            'video' => 'string',
        ];
    }

}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioSolicitanteEdit extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'nivel' => 'required|string|max:255',
            'pasivos' => 'required|numeric',
            'activos' => 'required|numeric'
        ];
    }


}
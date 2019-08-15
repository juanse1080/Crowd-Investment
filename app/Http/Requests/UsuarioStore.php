<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStore extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'cedula' => 'required|numeric|unique:usuario',
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'correo' => 'required|email|max:255',
            'fecha_nacimiento' => 'required|date',
            'password' => 'required|string|max:255',
            'password2' => 'required|string|max:255|same:password'
        ];
    }


}
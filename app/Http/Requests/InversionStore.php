<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InversionStore extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'monto' => 'required|numeric|min:1',
            'tarjeta' => 'required|numeric|max:16',
        ];
    }


}
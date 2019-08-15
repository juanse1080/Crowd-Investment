@extends('contenedores.principal')
@section('titulo','Registro')
@section('contenedor_principal')
@include('error.error')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <form enctype="multipart/form-data" action="{{ url('/inversiones/crear') }}" method = "POST">
            @csrf
            @method("GET")
            <div class="card border-primary rounded-0" style="border-color:#66bb6a !important;">
                    <input type="number" name="fk_solicitud" id="fk_solicitud" value="1" hidden>
                    <div class="text-center">
                        <input type="submit" id="submitbtn" name="action" value="Invertir" class=" btn btn-info btn-block rounded-0 py-2 " style="background-color: #66bb6a !important; border-color: #66bb6a !important;">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<br>
@endsection

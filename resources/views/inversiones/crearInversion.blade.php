@extends('contenedores.home')
@section('titulo','Datos requeridos')
@section('contenedor_home')
@include('error.error')
<br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <form enctype="multipart/form-data" action="/inversiones" method = "POST">
                @csrf
                <div class="card border-primary rounded-0" style="border-color:#66bb6a !important;">
                    <div class="card-header p-0">
                        <div class="bg-info text-white text-center py-2" style="background-color:#66bb6a !important;">
                            <h3><i class="fas fa-credit-card"></i> Realizar inversión</h3>
                        </div>
                    </div>
                    <div class="card-body p-2 text-center" style="border-bottom: 1px solid #c7f3c9 !important;">
                       <b> Titulo solicitud a invertir </b>
                       <br>
                       <h2>{{$solicitud->titulo}}</h2>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-2"></div>
                            {{--Foranea solicitud ocula--}}
                            <input type="number" name="fk_solicitud" id="fk_solicitud" value="{{$solicitud->pk_solicitud}}" hidden>
                            {{-- Monto --}}
                            <div class="col-md-8">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class= "input-group-text">
                                                    <i class="fas fa-coins"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control form-control-sm"  id="monto" name="monto" placeholder="Monto a invertir" tittle="Monto a invertir" value="@eachError('monto', $errors) @endeachError">
                                    </div>
                            </div>
                        </div>
                        <div class="row" id="alert1">
                            {{-- @if (session()->has("false"))
                                <div class='col-md-12'><div class='alert alert-danger'><strong>Error:</strong> {{session('false')}} </div></div>
                            @endif   --}}
                        </div>
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

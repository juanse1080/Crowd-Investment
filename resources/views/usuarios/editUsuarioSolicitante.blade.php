@extends('contenedores.home')
@section('titulo','Datos requeridos')
@section('contenedor_home')
@include('error.error')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <form enctype="multipart/form-data" action="{{ url('/usuarios/solicitante') }}" method = "POST">
            @csrf
            <div class="card border-primary rounded-0" style="border-color:#66bb6a !important;">
                <div class="card-header p-0">
                    <div class="bg-info text-white text-center py-2" style="background-color:#66bb6a !important;">
                        <h3><i class="fas fa-user-tie"></i> Datos previos</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        {{-- Nivel educativo --}}
                        <div class="col-md-12">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class= "input-group-text">
                                        <i class="fas fa-graduation-cap"> Nivel académico</i>
                                    </span>
                                </div>
                                
                                <select class="custom-select custom-select-sm" name="nivel" id="nivel" >
                                    <option @select('nivel', 'Ninguno') @endselect value="Ninguno">Ninguno</option>
                                    <option @select('nivel', 'Primaria') @endselect value="Primaria">Primaria</option>
                                    <option @select('nivel', 'Bachiller') @endselect value="Bachiller">Bachiller</option>
                                    <option @select('nivel', 'Tecnico') @endselect value="Tecnico">Técnico</option>
                                    <option @select('nivel', 'Tecnologo') @endselect value="Tecnologo">Tecnólogo</option>
                                    <option @select('nivel', 'Universitario') @endselect value="Universitario">Universitario</option>
                                    <option @select('nivel', 'Maestria') @endselect value="Maestria">Maestria</option>
                                    <option @select('nivel', 'Doctorado') @endselect value="Doctorado">Doctorado</option>
                                </select>
                            </div>
                        </div>
                        

                        
                    </div>
                    <div class="row">
                        {{-- Activos --}}
                        <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class= "input-group-text">
                                                <i class="fas fa-chart-line"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control form-control-sm"  id="activos" name="activos" placeholder="Activos" tittle="activos" value="@eachError('activos', $errors) @endeachError">
                                </div>
                            </div> 
                        {{-- Pasivos --}}
                        <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class= "input-group-text">
                                                <i class="fas fa-house-damage"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control form-control-sm"  id="pasivo" name="pasivos" placeholder="Pasivos" tittle="Pasivos" value="@eachError('pasivos', $errors) @endeachError">
                                </div>
                            </div> 
                    </div>
                    <div class="text-center">
                        <input type="submit" id="submitbtn" name="action" value="Enviar" class=" btn btn-info btn-block rounded-0 py-2 " style="background-color: #66bb6a !important; border-color: #66bb6a !important;">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<br>
@endsection

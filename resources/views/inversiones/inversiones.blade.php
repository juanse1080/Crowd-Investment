@extends('contenedores.home')
@section('titulo','Mis inversiones')
@section('contenedor_home')
@include('error.error')
<div class="container">
  <h4 class="mb-4">Mis inversiones</h4>
  <div class="row">
    <div class="col-12">
      <div class="card-columns">
        @foreach($inversiones as $inversion)
        <div class="card">
          <div class="card-body">
            <div class="row justify-content-between ml-1 mr-1">
              <h5 class="card-title">
                <a href="{{route('solicitudes.show', $inversion->solicitud->pk_solicitud)}}">
                  {{ucfirst($inversion->solicitud->titulo)}}
                </a>
              </h5>
              <span class="font-italic" style="font-size: small;">
                {{explode(' ', $inversion->solicitud->created_at)[0]}}
              </span>
            </div>
            <!-- <span class="ml-3">
              ${{number_format($inversion->monto_requerido)}}
            </span> -->
            <div class="row justify-content-between mr-1 ml-3">
              ${{number_format($inversion->monto)}}
              <span data-toggle="tooltip" data-placement="top"
                title="${{number_format($inversion->monto * $inversion->solicitud->interes/100 + $inversion->monto)}}">
                {{$inversion->solicitud->interes}}% interes
              </span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
@extends('contenedores.home')
@section('titulo','Mis inversiones')
@section('contenedor_home')
@include('error.error')
<div class="container">
  <h4 class="mb-4">Mis inversiones</h4>
  <div class="row">
    <div class="col-12">
      <div class="card-columns">
        <div class="accordion" id="accordionExample">
          @foreach($inversiones as $inversion)
            <div class="card shadow-sm" style="border: 1px solid #e3e6f0 !important;border-radius: .35rem !important;cursor: pointer;" data-toggle="collapse" data-target="#collapse{{$inversion->fk_solicitud}}" aria-expanded="true" aria-controls="collapse{{$inversion->fk_solicitud}}">
              <div class="card-body">
                <div class="row justify-content-between ml-1 mr-1 mb-n1">
                  <h5 class="card-title">
                    <a href="{{route('solicitudes.show', $inversion->solicitud->pk_solicitud)}}">
                      {{ucfirst($inversion->solicitud->titulo)}}
                    </a>
                  </h5>
                  <span>
                    {{$inversion->solicitud->interes}}% interes
                  </span>
                </div>
              </div>
              <div id="collapse{{$inversion->fk_solicitud}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <ul class="list-group list-group-flush">
                  @foreach($inversion->solicitud->inversiones()->where('inversion.fk_usuario', session('datos')['pk_usuario'])->get() as $inv)
                  <li class="list-group-item" style="border-top: 1px solid rgba(0,0,0,.125) !important;">
                    <div class="row justify-content-between mr-1 ml-1">
                      <span data-toggle="tooltip" data-placement="top"
                      title="${{number_format($inv->monto*pow(($inv->solicitud->interes/100) + 1, $inv->solicitud->tiempo_devolucion))}}" class="font-italic" style="font-size: small;">${{number_format($inv->monto)}}</span>
                      <span class="font-italic" style="font-size: small;">{{date("M j", strtotime($inv->created_at))}}</span>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('contenedores.home')
@section('titulo','Notificaciones')
@section('contenedor_home')
@include('error.error')
{{-- {{$notificaciones}}
{{$num}} --}}
<div id="br"></div>
@csrf
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Sus Notificaciones</h2>
            @if (!empty($notificaciones[0]))
                @foreach ($notificaciones as $i => $noti)
                    @if ($noti->estado==0) {{-- Ya vieron la notificacion --}}
                        <div class="card mt-3" id="n{{$noti->pk_notificacion}}">
                            {{-- <div class="card-header">
                                Notificacion #{{$noti->pk_notificacion}}
                                
                                
                            </div> --}}
                            <div class="card-body">
                                <button form="estado"  ruta="notificaciones" identificador="{{$noti->pk_notificacion}}" type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="card-title">{{$noti->titulo}}</h5>
                                <p class="card-text">{{$noti->descripcion}}</p>
                                <a href="{{$noti->url}}" class="btn btn-primary">Continuar</a>
                            </div>
                        </div>
                    @else
                        <div class="card mt-3" id="n{{$noti->pk_notificacion}}">
                            {{-- <div class="card-header">
                                Notificacion #{{$noti->pk_notificacion}}
                                
                                
                            </div> --}}
                            <div class="card-body" style="background-color: #FFF1E2">
                                <button form="estado"  ruta="notificaciones" identificador="{{$noti->pk_notificacion}}" type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="card-title">{{$noti->titulo}}</h5>
                                <p class="card-text">{{$noti->descripcion}}</p>
                                <a href="{{$noti->url}}" class="btn btn-primary">Continuar</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="card">
                    <div class="card-header">Información</div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>Lo sentimos, actualmente no tienes notificaciones nuevas</p>
                            <footer class="blockquote-footer">CEIS_UIS</footer>
                        </blockquote>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<br>
@endsection
@extends('contenedores.home')
@section('titulo','Solicitud')
@section('contenedor_home')
@include('error.error')

<div class="container">
    @if (count($solicitud->multimedias)>0)
        <div id="demo" class="carousel slide mt-n4" data-ride="carousel">
            <h3 class="text-center text-white d-none d-sm-block" style="position:relative;left:10px;top:100px;z-index:9999">{{strtoupper($solicitud->titulo)}}</h3>

            <!-- Indicators -->
            <ul class="carousel-indicators">
                @for ($i = 0; $i < count($solicitud->multimedias); $i++)
                    <li data-target="#demo" data-slide-to="$i" {{($i==0)? "class='active'":""}}></li>
                @endfor
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner" style="background-color:rgba(0, 0, 2, 0.5);">

                @foreach ( $solicitud->multimedias as $i => $m )
                    <div class="text-center carousel-item {{($i==0)?'active':''}}">
                        <!-- <div style="background: url({{asset($m->url)}});background-size: cover;width: 100%;height: 500px;"></div> -->
                        <img class="w-100" src="{{asset($m->url)}}" style="object-fit: cover;height:400px">
                        <!-- <div class="carousel-caption " style="padding-left:15px;background-color:black;opacity: 0.5;border-radius:10px;">
                            Descripción: {{$m->descripcion}}
                        </div> -->
                    </div>
                @endforeach
            </div>
            
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>
    @else
        <img class="w-100" src="{{asset('/storage/default.jpg')}}" style="object-fit: cover;height:400px">    
    @endif
    <div class="row mt-3">
        <div class="col-12 d-block d-sm-none">
            <h4 class="">{{ucwords($solicitud->titulo)}}</h4>
        </div>
    </div>
    <!-- <div class="row align-items-center">
        <div style="width:calc(100% - 85px)" class="ml-3">
            <div class="progress" style="height: 8px;">
                <div class="progress-bar" role="progressbar" style="width: {{$solicitud->monto_juntado > 0 ? $solicitud->monto_requerido/$solicitud->monto_juntado : 0}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <span class="ml-3">{{$solicitud->monto_juntado > 0 ? intval($solicitud->monto_requerido/$solicitud->monto_juntado) : 0}}%</span>
    </div> -->
    <div class="row">
        <div class="col-12" data-toggle="tooltip" data-placement="top" title="${{number_format($solicitud->monto_juntado, 2)}} reunidos">
            <div class="progress" style="height: 8px;">
                <div class="progress-bar" role="progressbar" style="width:{{$solicitud->monto_juntado > 0 ? $solicitud->monto_juntado * 100 /$solicitud->monto_requerido: 0}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-sm-6">
            <label class="font-weight-bold mt-3">Dinero a reunir: </label>
            <div>${{number_format($solicitud->monto_requerido, 2)}}</div>
            <label class="font-weight-bold mt-3">Descripción: </label>
            <p>
                {{$solicitud->descripcion}}
            </p>
            <label class="font-weight-bold mt-3">Usuario: </label>
            <div>
                <a href="{{route('usuarios.show', $solicitud->fk_usuario)}}">{{$solicitud->usuario->get_full_name()}}</a>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <label class="font-weight-bold mt-3">Fecha de recaudación: </label>
            <div>{{$solicitud->tiempo_recaudacion}}</div>
            <label class="font-weight-bold mt-3">Fecha de devolución: </label>
            <div>{{$solicitud->tiempo_devolucion}} meses</div>
            <label class="font-weight-bold mt-3">Porcentaje de interes EA: </label>
            <div>{{$solicitud->interes}}%</div>
        </div>
    </div>
</div>
@endsection

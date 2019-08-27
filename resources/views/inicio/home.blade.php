@extends('contenedores.home')
@section('titulo','Home')
@section('contenedor_home')

<div class="container">
    <h4 class="mb-4">Dashboard</h4>
<!--     <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-filter"></i>
                    </span>
                </div>
                <input type="text" class="form-control form-control-sm" id="entradafilter" name="titulo"
                    placeholder="Filtrar Resultados">
            </div>
        </div>
    </div> -->
    @foreach ($solicitudes as $key => $categoria)
        <div class="row mb-3">
            <div class="col-12">
                <label>{{ucwords($key)}}: </label>
                <div class="owl-carousel owl-theme">
                    @foreach($categoria->take(10) as $solicitud)
                        <div class="item" onclick="location.href='{{route('solicitudes.show', $solicitud->pk_solicitud)}}'" style="cursor: pointer">
                            <div class="card">
                                <img src="{{asset(count($solicitud->multimedias) > 0 ? $solicitud->multimedias->first()->url : '/storage/default.jpg')}}" class="card-img-top" style="object-fit: cover;height:200px">
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar" role="progressbar" style="width:{{$solicitud->monto_juntado > 0 ? $solicitud->monto_juntado * 100 /$solicitud->monto_requerido: 0}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ucwords(substr($solicitud->titulo, 0, 20))}}</h5>
                                    <div>${{number_format($solicitud->monto_requerido, 2)}}</div>
                                    <div data-toggle="tooltip" data-placement="right" title="Efectivo Anual">{{$solicitud->interes}}% EM</div>
                                    <div>{{ucfirst($solicitud->usuario->get_full_name())}}</div>
                                </div>
                                <div class="card-img-overlay" style="left: -15px;top: -15px;">
                                    <span class="badge badge-pill badge-light">
                                        <i class="fas fa-clock"></i>
                                        {{date("M j", strtotime($solicitud->created_at))}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(count($categoria) > 10)
                        <div class="item" onclick="location.href=''" style="cursor: pointer">
                            <div class="card">
                                <img src="{{asset('/storage/crowd.jpg')}}" class="card-img-top" style="object-fit: cover;height:200px">
                                <div class="card-body">
                                    <h5 class="card-title">¡Explora!</h5>
                                    <div>Encuentra mas en CrodwInvestmen.</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
<script>
    $('.owl-carousel').owlCarousel({
        margin:10,
        responsiveClass:true,
        dots:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    });
</script>
@endsection
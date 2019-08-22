@extends('contenedores.home')
@section('titulo','Mis solicitudes')
@section('contenedor_home')
<style>
    .drop {
        width: 10px;
        height: 10px;
        right: 10px;
        position: absolute;
        font-size: 3px;
        text-align: center;
        -webkit-transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        -ms-transition: all .2s ease-in-out;
    }
    .transition {
        -webkit-transform: scale(3); 
        -moz-transform: scale(3);
        -o-transform: scale(3);
        transform: scale(3);
    }
</style>

<div class="container">
    <h4 class="mb-4">Mis solicitudes</h4>
    <!-- <div class="row">
        @csrf
        {{-- filtro --}}
        <div class="col-md-4"></div>
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
        <a class="btn btn-success" href="{{url('/solicitudes/crear') }}" role="button">Nueva Solicitud</a>
    </div> -->
    <div class="row">
        @foreach($solicitudes as $solicitud)
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <div class="progress" style="height: 2px;">
                        <div class="progress-bar @if($solicitud->monto_juntado == $solicitud->monto_requerido) bg-success @else bg-primary @endif" role="progressbar" style="width:{{$solicitud->monto_juntado > 0 ? $solicitud->monto_juntado * 100 /$solicitud->monto_requerido: 0}}%" aria-valuenow="{{$solicitud->monto_juntado > 0 ? round($solicitud->monto_juntado * 100 /$solicitud->monto_requerido): 0}}" aria-valuemin="0" aria-valuemax="100">
                            <div class="rounded-circle row align-items-center justify-content-center drop text-center @if($solicitud->monto_juntado == $solicitud->monto_requerido) bg-success @else bg-primary @endif" data-toggle="tooltip" data-placement="top" title="${{number_format($solicitud->monto_juntado)}}">
                                <span class="text-center font-weight-bold @if($solicitud->monto_juntado == $solicitud->monto_requerido) text-success @else text-primary @endif">{{$solicitud->monto_juntado > 0 ? round($solicitud->monto_juntado * 100 /$solicitud->monto_requerido): 0}}%</span>
                            </div>
                        </div>
                        </div>
                    <div class="card-body">
                        <div class="row justify-content-between ml-1 mr-1">
                            <h5 class="card-title">
                                <a href="{{route('solicitudes.show', $solicitud->pk_solicitud)}}" class="@if($solicitud->monto_juntado == $solicitud->monto_requerido) text-success @else text-primary @endif">
                                    {{ucfirst($solicitud->titulo)}}
                                </a>
                            </h5>
                            <span class="font-italic" style="font-size: small;">
                                {{date("M j", strtotime($solicitud->created_at))}}
                            </span>
                        </div>
                        <span class="ml-3">
                            ${{number_format($solicitud->monto_requerido)}}
                        </span>
                        <div class="row justify-content-between mr-1 ml-3">
                            @if($solicitud->monto_juntado < $solicitud->monto_requerido)
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" label-change="#label{{$solicitud->pk_solicitud}}" {{$solicitud->estado ? 'checked' : ''}} class="estado custom-control-input" id="switch{{$solicitud->pk_solicitud}}" url="{{route('estado', $solicitud->pk_solicitud)}}" value="{{$solicitud->estado ? 1 : 0}}">
                                    <label id="label{{$solicitud->pk_solicitud}}" class="custom-control-label" for="switch{{$solicitud->pk_solicitud}}">{{$solicitud->estado ? 'Activo' : 'Inactivo'}}</label>
                                </div>
                            @else
                                <label class="text-success mb-0">Completado</label>
                            @endif
                            <span data-toggle="tooltip" data-placement="top" title="${{number_format($solicitud->monto_juntado, 2)}} reunidos">
                                {{$solicitud->interes}}% interes
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.progress-bar').each(function(){
            val = $(this).attr('aria-valuenow');
            $(this).children().css('left', 'calc('+val+'% + 6px)');
        });
        $('.card').hover(function() {
            element = $(this).find('.drop');
            element.addClass('transition');
            element.children().removeClass('text-success').removeClass('text-primary').addClass('text-white');
        }, function() {
            element = $(this).find('.drop');
            element.removeClass('transition');
            success = element.hasClass('bg-success');
            primary = element.hasClass('bg-primary');
            element.children().removeClass('text-white');
            if(success){
                element.children().addClass('text-success');
            } else if(primary) {
                element.children().addClass('text-primary');
            }
        });
        $('.btn-danger').click(function () {
            var id = $(this).attr('identificador');
            var h = $(this);
            $('.clos').click(function () {
                var respuesta = $(this).attr('respuesta');
                update('aceptar', id, respuesta, h);
            });
        });

        $('.estado').change(function(){
            let estado = $(this).val();
            let url = $(this).attr('url');
            let label = $(this).attr('label-change');
            let element = $(this);
            $.ajax({
                type: "POST",
                url,
                data: { _token: $('#csrf_token').attr('content'), estado },
                success: function (result) {
                    $(label).html(result.estado ? 'Activo' : 'Inactivo');
                    element.val(result.estado ? '1' : '0')
                },
                error: function (result) {
                    alert("Data not found");
                }
            });
        });
    });
</script>
@endsection
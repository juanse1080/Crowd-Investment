@extends('contenedores.home')
@section('titulo','Home')
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
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-8 mt-3 text-center">
            <div class="">
                <img src="{{Auth::user()->foto}}" alt="" class="card-img-top rounded-circle">
            </div>
            <h4>{{Auth::user()->get_full_name()}}</h4>
        </div>
        <div class="col-lg-8 mt-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Información personal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Solicitudes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">inversiones</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="mt-4">
                        <h5 class="mb-3">Datos personales</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Cédula</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between">
                                        {{Auth::user()->pk_usuario}}
                                        <span class="btn btn-link" style="font-size: small;">Editar <i class="fas fa-edit"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Nombre</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between">
                                        {{Auth::user()->get_full_name()}}
                                        <span class="btn btn-link" style="font-size: small;">Editar <i class="fas fa-edit"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Correo Electronico</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between">
                                        {{Auth::user()->correo}}
                                        <span class="btn btn-link" style="font-size: small;">Editar <i class="fas fa-edit"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Fecha de Nacimiento</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between">
                                        {{date("j M Y", strtotime(Auth::user()->fecha_nacimiento))}}
                                        <span class="btn btn-link" style="font-size: small;">Editar <i class="fas fa-edit"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Nivel de estudios</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between">
                                        {{Auth::user()->nivel ? Auth::user()->nivel : 'NULL'}}
                                        <span class="btn btn-link" style="font-size: small;">Editar <i class="fas fa-edit"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Pasivos</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between">
                                        {{Auth::user()->pasivos ? Auth::user()->pasivos : 'NULL'}}
                                        <span class="btn btn-link" style="font-size: small;">Editar <i class="fas fa-edit"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Activos</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between">
                                        {{Auth::user()->activos ? Auth::user()->activos : 'NULL'}}
                                        <span class="btn btn-link" style="font-size: small;">Editar <i class="fas fa-edit"></i></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="mt-4">
                        <h5 class="mb-3">Solicitudes populares</h5>
                        <div class="row">
                            @foreach($solicitudes as $solicitud)
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="card">
                                    <div class="progress" style="height: 2px;">
                                        <div class="progress-bar @if($solicitud->monto_juntado == $solicitud->monto_requerido) bg-success @else bg-primary @endif"
                                            role="progressbar"
                                            style="width:{{$solicitud->monto_juntado > 0 ? $solicitud->monto_juntado * 100 /$solicitud->monto_requerido: 0}}%"
                                            aria-valuenow="{{$solicitud->monto_juntado > 0 ? round($solicitud->monto_juntado * 100 /$solicitud->monto_requerido): 0}}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="rounded-circle row align-items-center justify-content-center drop text-center @if($solicitud->monto_juntado == $solicitud->monto_requerido) bg-success @else bg-primary @endif"
                                                data-toggle="tooltip" data-placement="top"
                                                title="${{number_format($solicitud->monto_juntado)}}">
                                                <span
                                                    class="text-center font-weight-bold @if($solicitud->monto_juntado == $solicitud->monto_requerido) text-success @else text-primary @endif">{{$solicitud->monto_juntado > 0 ? round($solicitud->monto_juntado * 100 /$solicitud->monto_requerido): 0}}%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-between ml-1 mr-1">
                                            <h5 class="card-title">
                                                <a href="{{route('solicitudes.show', $solicitud->pk_solicitud)}}"
                                                    class="@if($solicitud->monto_juntado == $solicitud->monto_requerido) text-success @else text-primary @endif">
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
                                                    <input type="checkbox"
                                                        label-change="#label{{$solicitud->pk_solicitud}}"
                                                        {{$solicitud->estado ? 'checked' : ''}}
                                                        class="estado custom-control-input"
                                                        id="switch{{$solicitud->pk_solicitud}}"
                                                        url="{{route('estado', $solicitud->pk_solicitud)}}"
                                                        value="{{$solicitud->estado ? 1 : 0}}">
                                                    <label id="label{{$solicitud->pk_solicitud}}"
                                                        class="custom-control-label"
                                                        for="switch{{$solicitud->pk_solicitud}}">{{$solicitud->estado ? 'Activo' : 'Inactivo'}}</label>
                                                </div>
                                                @else
                                                <label class="text-success mb-0">Completado</label>
                                                @endif
                                                <span data-toggle="tooltip" data-placement="top"
                                                    title="${{number_format($solicitud->monto_juntado, 2)}} reunidos">
                                                    {{$solicitud->interes}}% interes
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mt-4">
                        <h5 class="mb-3">inversiones populares</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-columns">
                                    <div class="accordion" id="accordionExample">
                                        @foreach($inversiones as $inversion)
                                        <div class="card shadow-sm"
                                            style="border: 1px solid #e3e6f0 !important;border-radius: .35rem !important;cursor: pointer;"
                                            data-toggle="collapse" data-target="#collapse{{$inversion->fk_solicitud}}"
                                            aria-expanded="true" aria-controls="collapse{{$inversion->fk_solicitud}}">
                                            <div class="card-body">
                                                <div class="row justify-content-between ml-1 mr-1 mb-n1">
                                                    <h5 class="card-title">
                                                        <a
                                                            href="{{route('solicitudes.show', $inversion->solicitud->pk_solicitud)}}">
                                                            {{ucfirst($inversion->solicitud->titulo)}}
                                                        </a>
                                                    </h5>
                                                    <span>
                                                        {{$inversion->solicitud->interes}}% interes
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="collapse{{$inversion->fk_solicitud}}" class="collapse"
                                                aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <ul class="list-group list-group-flush">
                                                    @foreach($inversion->solicitud->inversiones()->where('inversion.fk_usuario',
                                                    session('datos')['pk_usuario'])->get() as $inv)
                                                    <li class="list-group-item"
                                                        style="border-top: 1px solid rgba(0,0,0,.125) !important;">
                                                        <div class="row justify-content-between mr-1 ml-1">
                                                            <span data-toggle="tooltip" data-placement="top"
                                                                title="${{number_format($inv->monto*pow(($inv->solicitud->interes/100) + 1, $inv->solicitud->tiempo_devolucion))}}"
                                                                class="font-italic"
                                                                style="font-size: small;">${{number_format($inv->monto)}}</span>
                                                            <span class="font-italic"
                                                                style="font-size: small;">{{date("M j", strtotime($inv->created_at))}}</span>
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.progress-bar').each(function () {
            val = $(this).attr('aria-valuenow');
            $(this).children().css('left', 'calc(' + val + '% + 6px)');
        });
        $('.card').hover(function () {
            element = $(this).find('.drop');
            element.addClass('transition');
            element.children().removeClass('text-success').removeClass('text-primary').addClass('text-white');
        }, function () {
            element = $(this).find('.drop');
            element.removeClass('transition');
            success = element.hasClass('bg-success');
            primary = element.hasClass('bg-primary');
            element.children().removeClass('text-white');
            if (success) {
                element.children().addClass('text-success');
            } else if (primary) {
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

        $('.estado').change(function () {
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
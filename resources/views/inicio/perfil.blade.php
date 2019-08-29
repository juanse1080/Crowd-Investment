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
                <img src="{{$usuario->foto}}" alt="" class="card-img-top rounded-circle">
            </div>
            <h4>{{$usuario->get_full_name()}}</h4>
        </div>
        <div class="col-lg-8 mt-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Información personal</a>
                </li>
                @if($usuario->solicitudes()->orderBy('updated_at')->get()->count() > 0)
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Solicitudes</a>
                </li>
                @endif
                @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                @if($usuario->inversiones()->orderBy('updated_at')->get()->count() > 0)
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Inversiones</a>
                </li>
                @endif
                @endif
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
                                    <div class="col-md-8 row justify-content-between pr-0">
                                        {{$usuario->cedula}}
                                        @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                                        <span class="pr-0 btn btn-link numb" val="{{$usuario->cedula}}" campo="cedula" onclick="numb(this)" style="font-size: small;">Editar <i
                                                class="fas fa-edit"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Nombre</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between pr-0">
                                        {{$usuario->nombre}}
                                        @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                                        <span class="pr-0 btn btn-link text" val="{{$usuario->nombre}}" campo="nombre" onclick="text(this)" style="font-size: small;">Editar <i
                                                class="fas fa-edit"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Apellido</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between pr-0">
                                        {{$usuario->apellido}}
                                        @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                                        <span class="pr-0 btn btn-link text" val="{{$usuario->apellido}}" campo="apellido" onclick="text(this)" style="font-size: small;">Editar <i
                                                class="fas fa-edit"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Correo Electronico</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between pr-0">
                                        {{$usuario->correo}}
                                        @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                                        <span class="pr-0 btn btn-link text" val="{{$usuario->correo}}" campo="correo" onclick="text(this)" style="font-size: small;">Editar <i
                                                class="fas fa-edit"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Fecha de Nacimiento</label>
                                        <!-- <input type="text" id="datepicker" class="pl-3 pr-3 form-control rounded-pill" value="{{$usuario->fecha_nacimiento}}"> -->
                                    </div>
                                    <div class="col-md-8 row justify-content-between pr-0">
                                        {{date("j M Y", strtotime($usuario->fecha_nacimiento))}}
                                        @if(Auth::user()->pk_usuario == $usuario->pk_usuario )
                                        <span class="pr-0 btn btn-link date" val="{{$usuario->fecha_nacimiento}}" campo="fecha_nacimiento" onclick="date(this)" style="font-size: small;">Editar <i
                                                class="fas fa-edit"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Nivel de estudios</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between pr-0">
                                        {{$usuario->nivel ? $usuario->nivel : 'NULL'}}
                                        @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                                        <span class="pr-0 btn btn-link select" val="{{$usuario->nivel}}" campo="nivel" onclick="select(this)" style="font-size: small;">Editar <i
                                                class="fas fa-edit"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Pasivos</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between pr-0">
                                        {{$usuario->pasivos ? $usuario->pasivos : 'NULL'}}
                                        @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                                        <span class="pr-0 btn btn-link numb" val="{{$usuario->pasivos}}" campo="pasivos" onclick="numb(this)" style="font-size: small;">Editar <i
                                                class="fas fa-edit"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="font-weight-bold" for="">Activos</label>
                                    </div>
                                    <div class="col-md-8 row justify-content-between pr-0">
                                        {{$usuario->activos ? $usuario->activos : 'NULL'}}
                                        @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                                        <span class="pr-0 btn btn-link numb" val="{{$usuario->activos}}" campo="activos" onclick="numb(this)" style="font-size: small;">Editar <i
                                                class="fas fa-edit"></i></span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                @if($usuario->solicitudes()->orderBy('updated_at')->get()->count() > 0)
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="mt-4">
                        <h5 class="mb-3">Solicitudes populares</h5>
                        <div class="row">
                            @foreach($usuario->solicitudes()->orderBy('updated_at')->get()->take(6) as $solicitud)
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
                @endif
                @if(Auth::user()->pk_usuario == $usuario->pk_usuario)
                @if($usuario->inversiones()->orderBy('updated_at')->get()->count() > 0)
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mt-4">
                        <h5 class="mb-3">Inversiones populares</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-columns">
                                    <div class="accordion" id="accordionExample">
                                        @foreach($usuario->inversiones()->orderBy('updated_at')->groupBy('inversion.fk_solicitud')->get()->take(12)
                                        as $inversion)
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
                                                    $usuario->pk_usuario)->get() as $inv)
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
                @endif
                @endif
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
        text = (element) => {
            html = ''+
            '<input type="text" id="edit'+$(element).attr('campo')+'" class="pl-3 pr-3 form-control rounded-pill" value="'+$(element).attr('val')+'">';
            $(element).parent().html(html);
            $('#edit'+$(element).attr('campo')).focus();
        }
        numb = (element) => {
            html = ''+
            '<input type="number" id="edit'+$(element).attr('campo')+'" class="pl-3 pr-3 form-control rounded-pill" value="'+$(element).attr('val')+'">';
            $(element).parent().html(html);
            $('#edit'+$(element).attr('campo')).focus();
        }
        date = (element) => {
            html = ''+
            '<input type="text" id="edit'+$(element).attr('campo')+'" style="border-radius: 50rem 0rem 0rem 50rem !important;" class="pl-3 pr-3 form-control" value="'+$(element).attr('val')+'">';
            $(element).parent().html(html);
            $('#edit'+$(element).attr('campo')).datepicker({
                uiLibrary: 'bootstrap4'
            });
            // $('#edit'+$(element).attr('campo')).focus();
        }
        select = (element) => {
            html = ''+
            '<select name="type" id="edit'+$(element).attr('campo')+'" class="selectpicker form-control">'+
                '<option value="ninguno">Ninguno</option>'+
                '<option value="bachiller">Bachiller</option>'+
                '<option value="profesional">Profesional</option>'+
                '<option value="maestria">Maestria</option>'+
                '<option value="doctorado">Doctorado</option>'+
            '</select>';
            console.log(html);
            $(element).parent().html(html);
        }
        
        
    }); 
</script>
@endsection
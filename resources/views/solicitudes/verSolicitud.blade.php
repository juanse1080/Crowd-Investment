@extends('contenedores.home')
@section('titulo','Solicitud')
@section('contenedor_home')
@include('error.error')
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (count($solicitud->multimedias)>0)
            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    @for ($i = 0; $i < count($solicitud->multimedias); $i++)
                        <li data-target="#demo" data-slide-to="{{$i}}" @if($i==0) class="active" @endif
                            style="border-radius: 50%;width: 10px;height: 10px;"></li>
                        @endfor
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner" style="background-color:rgba(0, 0, 2, 0.5);">

                    @foreach ( $solicitud->multimedias as $i => $m )
                    <div class="text-center carousel-item {{($i==0)?'active':''}}">
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
            <div class="row">
                <div class="col-12" data-toggle="tooltip" data-placement="top"
                    title="{{$solicitud->monto_juntado > 0 ? round($solicitud->monto_juntado * 100 /$solicitud->monto_requerido): 0}}%">
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar" role="progressbar"
                            style="width:{{$solicitud->monto_juntado > 0 ? $solicitud->monto_juntado * 100 /$solicitud->monto_requerido: 0}}%"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-1">
            <span class="mb-1">{{count($solicitud->inversiones)}} inversiones</span>
            <h3 class="mb-0">{{ucwords($solicitud->titulo)}}</h3>
            <div class="mb-3">
                @if($solicitud->fk_usuario != session('datos')['pk_usuario'])
                <a
                    href="{{route('usuarios.show', $solicitud->fk_usuario)}}">{{$solicitud->usuario->get_full_name()}}</a>
                @endif
            </div>
            <strike class="mb-1">${{number_format($solicitud->monto_requerido)}}</strike> -
            <span
                class="text-success">{{$solicitud->monto_juntado > 0 ? round($solicitud->monto_juntado * 100 /$solicitud->monto_requerido): 0}}%
                reunido</span>
            <h2 class="mb-2">${{number_format($solicitud->monto_requerido - $solicitud->monto_juntado)}}</h2>


            <!-- <label class="font-weight-bold mt-3">Dinero reunido: </label> -->

            <!-- <label class="font-weight-bold mt-3">Porcentaje de interes EM: </label> -->
            <div class="mb-0"><i class="fas fa-undo-alt"></i> {{$solicitud->interes}}% interes EM</div>
            <div class="mb-3"><i class="fas fa-comments-dollar"></i> devolución en {{$solicitud->interes}} meses</div>

            @if($solicitud->fk_usuario != session('datos')['pk_usuario'] && ($solicitud->monto_requerido -
            $solicitud->monto_juntado) != 0 )
            <label for="customRange3" class="row justify-content-between ml-1 mr-1">
                <span>$0</span>
                <span id="actual" class="text-primary">$0</span>
                <span class="span">${{number_format($solicitud->monto_requerido - $solicitud->monto_juntado)}}</span>
            </label>
            <input type="range" class="custom-range" id="custom-range" min="0" interes="{{$solicitud->interes}}"
                tiempo="{{$solicitud->tiempo_devolucion}}"
                max="{{$solicitud->monto_requerido - $solicitud->monto_juntado}}" id="customRange3" value="0">
            <div id="devolver" class="text-info mb-3">te devolveran $0</div>
            <button id="invertir" class="btn btn-primary w-100">Invertir</button>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label class="font-weight-bold mt-3">Descripción: </label>
            <p>
                {{$solicitud->descripcion}}
            </p>
        </div>
    </div>

    @if($solicitud->fk_usuario == session('datos')['pk_usuario'])
    <div class="owl-carousel owl-theme">
        @foreach($solicitud->inversiones()->orderBy('monto', 'desc')->get()->take(10) as $inversion)
        <div class="item">
            <div class="card">
                <div class="progress" style="height: 2px;">
                    <div class="progress-bar" role="progressbar"
                        style="width:{{$inversion->monto * 100 /$solicitud->monto_requerido}}%"
                        aria-valuenow="{{$inversion->monto * 100 /$solicitud->monto_requerido}}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between ml-1 mr-1">
                        <h4 class="card-title">
                            ${{number_format($inversion->monto)}}
                        </h4>
                        <span class="font-italic" style="font-size: small;">
                            {{date("M j", strtotime($inversion->created_at))}}
                        </span>
                    </div>
                    <!-- <h4>${{number_format($inversion->monto_requerido)}}</h4> -->
                    <!-- <div data-toggle="tooltip" data-placement="right" title="Efectivo Anual">{{$inversion->interes}}% EM</div> -->
                    <div>
                        <a href="{{route('usuarios.show', $inversion->usuario->pk_usuario)}}">
                            {{ucfirst($inversion->usuario->get_full_name())}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @if(count($solicitud->inversiones) > 10)
        <div class="item">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">¿Deseas mas?</h4>
                    <div class="font-italic btn btn-link" id="mas" style="font-size: small;">
                        ver registro completo
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @else
    <div class="owl-carousel owl-theme">
        @foreach($solicitud->inversiones()->where('inversion.fk_usuario',
        session('datos')['pk_usuario'])->orderBy('monto', 'desc')->get()->take(10) as $inversion)
        <div class="item">
            <div class="card">
                <div class="progress" style="height: 2px;">
                    <div class="progress-bar" role="progressbar"
                        style="width:{{$inversion->monto * 100 /$solicitud->monto_requerido}}%"
                        aria-valuenow="{{$inversion->monto * 100 /$solicitud->monto_requerido}}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between ml-1 mr-1">
                        <h4 class="card-title">
                            ${{number_format($inversion->monto)}}
                        </h4>
                        <span class="font-italic" style="font-size: small;">
                            {{date("M j", strtotime($inversion->created_at))}}
                        </span>
                    </div>
                    <!-- <h4>${{number_format($inversion->monto_requerido)}}</h4> -->
                    <!-- <div data-toggle="tooltip" data-placement="right" title="Efectivo Anual">{{$inversion->interes}}% EM</div> -->
                </div>
            </div>
        </div>
        @endforeach
        @if(count($solicitud->inversiones()->where('inversion.fk_usuario', session('datos')['pk_usuario'])->get()) > 10)
        <div class="item">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">¿Deseas mas?</h4>
                    <div class="font-italic btn btn-link" id="mas" style="font-size: small;">
                        ver registro completo
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif
    <div id="pag-table"></div>
    <div class="modal fade" id="invertirModal" tabindex="-1" role="dialog" aria-labelledby="invertirModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid mt-3">
                        <ul class="nav nav-tabs mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Valor</a>
                            </li>
                            <li class="nav-item second">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Pago</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="customRange3" class="row justify-content-between ml-1 mr-1">
                                            <span>Min: $0</span>
                                            <span>Max:
                                                ${{number_format($solicitud->monto_requerido - $solicitud->monto_juntado)}}</span>
                                        </label>
                                        <input type="range" class="custom-range mb-3 input-modal" min="0"
                                            interes="{{$solicitud->interes}}" tiempo="{{$solicitud->tiempo_devolucion}}"
                                            max="{{$solicitud->monto_requerido - $solicitud->monto_juntado}}"
                                            id="customRange3" value="0">
                                        <div class="row justify-content-end ml-1 mr-1 mb-3">
                                            <input id="monto" type="number"
                                                class="number input-modal text-center rounded-pill form-control form-control-sm"
                                                max="{{$solicitud->monto_requerido - $solicitud->monto_juntado}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tarjeta">Número de tarjeta</label>
                                            <input type="number" class="form-control" id="tarjeta"
                                                aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre y apellido</label>
                                            <input type="text" class="form-control" id="nombre"
                                                aria-describedby="emailHelp" style="text-transform: uppercase">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="cedula">Cédula</label>
                                            <input type="number" class="form-control" id="cedula"
                                                aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha de expiración</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="number" class="form-control" id="fecha"
                                                        aria-describedby="emailHelp">
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" class="form-control" id="fecha2"
                                                        aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="form-group">
                                            <label for="codigo">CVC</label>
                                            <input type="number" class="form-control" id="codigo"
                                                aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end mb-3 ml-1 mr-1 mt-2">
                                    <button id="submit" class="btn btn-success">Completar pago</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div aria-label="Page navigation example" class="mt-3 mb-3 row justify-content-between ml-1 mr-1">

        <span>25 registros</span>
        <ul class="pagination justify-content-end">
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
            </li>
        </ul>
    </div> -->
</div>

<script>

    $('#custom-range').change(function () {
        valor = $(this).val();
        $('#actual').html('$' + new Intl.NumberFormat("co-ES").format(valor).replace(/\./g, ','))
        interes = $(this).attr('interes');
        tiempo = $(this).attr('tiempo');
        total = Math.round(valor * Math.pow((1 + (interes / 100)), tiempo));
        total = new Intl.NumberFormat("co-ES").format(total).replace(/\./g, ',');
        console.log(typeof total);
        $('#devolver').html('te devolveran $' + total);
    });
    $('.owl-carousel').owlCarousel({
        margin: 10,
        responsiveClass: true,
        dots: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 4,
            }
        }
    });
    $('#mas').click(function (e) {
        e.stopPropagation();
        $('.owl-carousel').css('display', 'none');
        ajax('0');
    });
    $('#invertir').click(function (e) {
        $('.input-modal').val($('#custom-range').val());
        $('.number').width($('.span').width() - 20);
        $('#invertirModal').modal('show');
        console.log($('.span').width() - 20);
    });
    $('.input-modal').change(function () {
        $('.second').addClass('rubberBand animated');
        value = $(this).val();
        max = parseInt("{{ $solicitud -> monto_requerido - $solicitud -> monto_juntado}}");
        if (value >= max) {
            $('.input-modal').val(max);
        } else {
            $('.input-modal').val(value);
        }
        setTimeout(function () {
            $('.second').removeClass('rubberBand animated');
        }, 500);
    });

    $('.input-modal').keydown(function () {
        value = $(this).val();
        max = parseInt("{{ $solicitud -> monto_requerido - $solicitud -> monto_juntado}}");
        if (value >= max) {
            $('.input-modal').val(max);
        } else {
            $('.input-modal').val(value);
        }
    });

    let ajax = (pagina) => {
        $.ajax({
            type: "POST",
            url: "{{route('pagination', $solicitud->pk_solicitud)}}",
            data: { _token: $('#csrf_token').attr('content'), pagina: pagina },
            success: function (result) {
                console.log(result);
                html = '' +
                    '<label id="label-table" class="font-weight-bold mt-3">Inversiones</label>' +
                    '<div class="table-responsive" style="display:none;" id="table">' +
                    '<table class="table table-bordered" style="background-color: white;">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">Usuario</th>' +
                    '<th scope="col">Monto</th>' +
                    '<th scope="col">Aporte</th>' +
                    '<th scope="col">Fecha</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                for (const element in result.inversiones) {
                    temp = result.inversiones[element].created_at.split(' ')[0].split('-');
                    // temp[2] = parseInt(temp[2]) + 1;
                    created = new Date(temp[0] + '-' + temp[1] + '-' + temp[2]).toString().split(' ');
                    html += '' +
                        '<tr>' +
                        '<td><a href="'+result.urls[element]+'">' + result.inversiones[element].nombre + ' ' + result.inversiones[element].apellido + '</a></td>' +
                        '<td>$' + new Intl.NumberFormat("co-ES").format(result.inversiones[element].monto).replace(/\./g, ',') + '</td>' +
                        '<td>' + new Intl.NumberFormat("co-ES").format(result.inversiones[element].monto * 100 / result.inversiones[element].monto_requerido).replace(/,/g, '.') + '%</td>' +
                        '<td>' + created[1] + " " + created[2] + '</td>' +
                        '</tr>';
                }
                html += '' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div id="pagination" aria-label="Page navigation example" class="mb-3 row justify-content-between ml-1 mr-1">' +
                    '<span>' + (result.pagina * 10 + 1) + ' - ' + (result.pagina * 10 + Object.keys(result.inversiones).length) + ' de ' + result.count + ' registros</span>' +
                    '<ul class="pagination justify-content-end">' +
                    '<li class="page-item">';
                if (parseInt(result.pagina) == 0) {
                    html += '<a class="page-link deactivate"><i class="fas fa-chevron-left"></i></a>';
                } else {
                    html += '<a class="page-link" onclick="ajax(' + (parseInt(result.pagina) - 1) + ')"><i class="fas fa-chevron-left"></i></a>';
                }
                html += '' +
                    '</li>' +
                    '<li class="page-item">';
                if (Math.ceil(result.count / 10) <= parseInt(result.pagina) + 1) {
                    html += '<a class="page-link deactivate"><i class="fas fa-chevron-right"></i></a>';
                } else {
                    html += '<a class="page-link" onclick="ajax(' + (parseInt(result.pagina) + 1) + ')"><i class="fas fa-chevron-right"></i></a>';
                }
                '</li>' +
                    '</ul>' +
                    '</div>';
                $('#pag-table').html(html);
                $('#table').fadeIn();
            },
            error: function (result) {
                alert("Data not found");
            }
        });
    }

    $('#submit').click(function () {
        let monto = $('#monto').val();
        let tarjeta = $('#tarjeta').val();
        let fk_solicitud = "{{$solicitud->pk_solicitud}}";
        if (invalid([$('#monto'), $('#tarjeta'), $('#nombre'), $('#cedula'), $('#fecha'), $('#fecha2'), $('#codigo')])) {
            $.ajax({
                type: "POST",
                url: "{{route('inversiones.store')}}",
                data: { _token: $('#csrf_token').attr('content'), monto, tarjeta, fk_solicitud },
                success: function (result) {
                    // console.log(result);
                    location.href = result.href;
                },
                error: function (result) {
                    alert("Data not found");
                }
            });
        }
    });

    invalid = (list) => {
        let bandera = true;
        list.forEach(function (element) {
            element.removeClass("is-invalid");
            element.addClass(element.val() == "" ? "is-invalid" : "");
            bandera = element.val() == "" ? false : true;
        });
        return bandera;
    }

</script>

@endsection
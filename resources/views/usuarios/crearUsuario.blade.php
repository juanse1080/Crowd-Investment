@extends('contenedores.sesion')
@section('titulo','Registro')
@section('content')

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @include('error.login')
            <div class="container" style="height:100%">
                <div class="d-flex justify-content-center">
                    <div class="col-lg-10" style="margin-top:calc( 50vh - 188px )">
                        <div class="card shadow mb-4 animated bounceInUp">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Registrarse</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Opciones:</div>
                                        <a class="dropdown-item" href="{{route('login')}}">Iniciar sessión</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('usuarios.store')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <div class="input-group">
                                                    <input id="nombre" name="nombre" type="text" class="form-control"
                                                        placeholder="">
                                                </div>
                                                <small id="error_nombre" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellido">Apellido:</label>
                                                <div class="input-group">
                                                    <input id="apellido" name="apellido" type="text"
                                                        class="form-control" placeholder="">
                                                </div>
                                                <small id="error_apellido" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="correo">Correo electronico:</label>
                                                <div class="input-group">
                                                    <input id="correo" name="correo" type="email" class="form-control"
                                                        placeholder="">
                                                </div>
                                                <small id="error_correo" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                                <div class="input-group">
                                                    <input id="datepicker" name="fecha_nacimiento" type="text"
                                                        class="form-control" placeholder="">
                                                </div>
                                                <small id="error_fecha_nacimiento"
                                                    class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Contraseña:</label>
                                                <div class="input-group">
                                                    <input id="password" name="password" type="password"
                                                        class="form-control" placeholder="">
                                                </div>
                                                <small id="error_password" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password_confirm">Confirmar contraseña:</label>
                                                <div class="input-group">
                                                    <input id="password_confirm" name="password_confirm" type="password"
                                                        class="form-control" placeholder="">
                                                </div>
                                                <small id="error_password_confirm"
                                                    class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right">Registrar</button>
                                    <div class="form-text text-danger float-left"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
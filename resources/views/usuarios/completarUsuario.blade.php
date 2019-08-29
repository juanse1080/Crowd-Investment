@extends('contenedores.sesion')
@section('titulo','Completar información')
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
                                <h6 class="m-0 font-weight-bold text-primary">Completa tu perfil</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('guardarInformacion') }}" method="post">
                                    <input type="hidden" id="color" name="color">
                                    @csrf
                                    <input name="_method" type="hidden" value="PATCH">

                                    <!-- pk -->
                                    <input name="pk_usuario" type="hidden" value="{{session('datos')['pk_usuario']}}">

                                    <!-- pasivos -->
                                    <label for="cedula">Cedula:</label>
                                    <input type="text" id="cedula" name="cedula" class="form-control mb-4" placeholder="Cedula">

                                    <!-- nivel -->
                                    <label for="nivel">Nivel academico:</label>
                                    <select name="nivel" class="form-control mb-4">
                                        <option disabled>Seleccione nivel academico</option>
                                        <option selected value="ninguno">Ninguno</option>
                                        <option value="bachiller">Bachiller</option>
                                        <option value="profesional">Profesional</option>
                                        <option value="maestria">Maestria</option>
                                        <option value="doctorado">Doctorado</option>
                                    </select>
                                    {{-- <input type="text" id="nivel" name="nivel" class="form-control mb-4" placeholder="Nivel"> --}}

                                    <!-- pasivos -->
                                    <label for="pasivos">Pasivos:</label>
                                    <input type="number" id="pasivos" name="pasivos" class="form-control mb-4" placeholder="Pasivos">

                                    <!-- activos -->
                                    <label for="activos">Activos:</label>
                                    <input type="number" id="activos" name="activos" class="form-control mb-4" placeholder="Activos">

                                    <!-- Sign in button -->
                                    <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>
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
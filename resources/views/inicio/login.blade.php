@extends('contenedores.sesion')
@section('titulo','Inicio de Sesion')
@section('content')

<div class="container" style="height:100%">
  <div class="d-flex justify-content-center">
    <div class="col-lg-6" style="margin-top:calc( 50vh - 188px )">
      <div class="card shadow mb-4 animated bounceInUp">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Bienvenido a CrowdFunding</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <form action="{{route('authenticate')}}" method="post">
            @csrf
            <div class="form-group mb-3">
              <label for="email">Correo electronico:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-user"></i>
                  </span>
                </div>
                <input id="email" name="email" type="text" class="form-control"
                  placeholder="">
              </div>
              <small id="email" class="form-text text-danger"></small>
            </div>
            <div class="form-group mb-3">
              <label for="password">Contraseña:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-key"></i>
                  </span>
                </div>
                <input id="password" name="password" type="password"
                  class="form-control" placeholder="">
              </div>
              <small id="password" class="form-text text-danger"></small>
            </div>
            <div class="row justify-content-between ml-n1 mr-n1">
                <button type="submit" class="btn btn-primary">Iniciar sesion</button>
                <a href="{{route('usuarios.create')}}" class="btn btn-link" style="font-size:small">¡Crea una cuenta!</a>
            </div>
            <div class="form-text text-danger float-left"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
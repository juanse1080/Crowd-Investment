@extends('contenedores.sesion')
@section('titulo','Inicio de Sesion')
@section('content')

<section class="login-block">
    <div class="container2">
      <div class="row">
        <div class="col-md-4 login-sec">
            <h2 class="text-center">Acceso a MyLend</h2>
            @include('error.login')
            <form class="login-form" action="{{route('authenticate')}}" method="POST">
              @csrf
              <div class="form-group">
                <label for="username" class="text-uppercase">Usuario</label>
                <input type="text" class="form-control" placeholder="" name='username' id='username' value="{{old('username')}}">
              </div>
              <div class="form-group">
                <label for="password" class="text-uppercase" >Contraseña</label>
                <input type="password" class="form-control" placeholder="" name='password' id='password'>
              </div>
              <div class="form-group">
                  <label for="reg" class="text-uppercase" ></label>
                  <a  name="reg" class="float-right" href="/usuarios/crear">Registrarse</a>
              </div>
              <div class="form-check">
                <button type="submit" class="btn btn-login float-right">Iniciar Sesión</button>
              </div>
              
                
            </form>
            
        </div>
        <div class="col-md-8 banner-sec"></div>
      </div>
    </div>
  
  </section>

@endsection

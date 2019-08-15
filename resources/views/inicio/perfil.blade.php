@extends('contenedores.home')
@section('titulo','Home')
@section('contenedor_home')
<br>
<div class="card mx-auto border-dark bg-light" style="width: 20rem;"><br>
    <img class="mx-auto" style="width:300px; height:300px;background-repeat: no-repeat;
    background-position: 50%; border-radius: 50%; background-size: 100% auto;" src=" @if(session('datos')['empresa']) img/store.png  @else img/man.png @endif "  alt="Foto estudiante"><br>
    <ul class="list-group list-group-flush">
        <li class="list-group-item border-dark bg-light"><h5 class="card-title text-center"><i class="fas fa-user"></i> {{ucwords(session('datos')['nombre'])}} {{ucwords(session('datos')['apellido'])}}</h5></li>
        <li class="list-group-item border-dark bg-light"><h5 class="card-title text-center"><i class="fas fa-hashtag"></i> Id Usuario {{ucwords(session('datos')['pk_usuario'])}}</h5></li>
        <li class="list-group-item border-dark bg-light"><h5 class="card-title text-center"><i class="fas fa-envelope"></i> {{ucwords(session('datos')['correo'])}}</h5></li>
        <li class="list-group-item border-dark bg-light"><h5 class="card-title text-center"><i class="far fa-calendar-alt"></i> Fecha {{ucwords(session('datos')['fecha_nacimiento'])}}</h5></li>
    </ul>
    
</div>
<br>

@endsection
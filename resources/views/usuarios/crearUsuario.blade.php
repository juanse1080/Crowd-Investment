
@extends('contenedores.principal')
@section('titulo','Registro')
@section('contenedor_principal')
@include('error.error')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <form enctype="multipart/form-data" action="{{ url('/usuarios') }}" method = "POST">
            @csrf
            <div class="card border-primary rounded-0" style="border-color:#66bb6a !important;">
                <div class="card-header p-0">
                    <div class="bg-info text-white text-center py-2" style="background-color:#66bb6a !important;">
                        <h3><i class="fas fa-user-tie"></i> Registro</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        {{-- Persona Juridica - Natural --}}
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class= "input-group-text">
                                        <i class="fas fa-user-cog"></i>
                                    </span>
                                </div>
                                
                                <select class="custom-select custom-select-sm" name="empresa" id="empresa" onchange="desactivar(this)">
                                    <option @select('empresa', '0') @endselect value="0">Persona Natural</option>
                                    <option @select('empresa', '1') @endselect value="1">Persona Juridica</option>
                                </select>
                            </div>
                        </div>

                        {{-- cedula --}}
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class= "input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control form-control-sm"  id="cedula" name="cedula" placeholder="Cedula" value="@eachError('cedula', $errors) @endeachError">
                            </div>
                        </div>

                        
                    </div>
                    <div class="row">
                        {{-- nombre --}}
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <input type="text" id="nombre" name="nombre" placeholder="Nombres" class="form-control form-control-sm" value="@eachError('nombre', $errors)@endeachError">
                            </div>
                        </div>
                        {{-- apellido --}}
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <input type="text" id="apellido" name="apellido" placeholder="Apellidos" class="form-control form-control-sm" value="@eachError('apellido', $errors)@endeachError" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- correo --}}
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" id="correo" name="correo" placeholder="E-mail" class="form-control form-control-sm" value="@eachError('correo', $errors)@endeachError">
                            </div>
                        </div>
                        {{-- fecha de nacimiento/creacion --}}
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt" id="titlefecha"> Fecha nacimiento</i>
                                    </span>
                                </div>
                                <input type="date" name="fecha_nacimiento" placeholder="dd/mm/yyyy" min="2018-11-17" class="form-control form-control-sm" value="@eachError('fecha_nacimiento', $errors)@endeachError">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            {{-- contraseña --}}
                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input onchange="confirmar(this.value,1)" type="password" id="password" name="password" placeholder="Contraseña" class="form-control form-control-sm" value="@eachError('password', $errors)@endeachError" >
                                </div>
                            </div>
                            {{-- confirmar contraseña --}}
                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input onchange="confirmar(this.value,2)" type="password" id="password2" name="password2" placeholder="Confirmar contraseña" class="form-control form-control-sm"  >
                                </div>
                            </div>
                    </div>
                    <div class="row" id="alert1">
                        
                    </div>
                    <div class="text-center">
                        <input type="submit" id="submitbtn" name="action" value="Enviar" class=" btn btn-info btn-block rounded-0 py-2 " style="background-color: #66bb6a !important; border-color: #66bb6a !important;">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<br>
<script>
        function desactivar(s1){
            var cedula = document.getElementById("cedula");
            var nombre = document.getElementById("nombre");
            var apellido = document.getElementById("apellido");
            var fecha = document.getElementById("titlefecha");
            if(s1.value=='1'){
                cedula.placeholder="Nit";
                nombre.placeholder="Nombre de la empresa";
                apellido.disabled=true;
                fecha.innerHTML=" Fecha de creacion";
                
            }else{
                cedula.placeholder="Cedula";
                nombre.placeholder="Nombres";
                apellido.disabled=false;
                fecha.innerHTML=" Fecha nacimiento";
            }
        }
        function confirmar(password2, n){
            var alert1=document.getElementById("alert1");
            var btn=document.getElementById("submitbtn");
            if (n==2) {
                password=document.getElementById("password").value;
            }else{
                password=document.getElementById("password2").value;
            }
            if(password!=password2){
                alert1.innerHTML="<div class='col-md-12'><div class='alert alert-danger'><strong>Error:</strong> Las contraseñas no coinciden.</div></div>";
                btn.disabled=true;
            }else{
                alert1.innerHTML="";
                btn.disabled=false;
            } 
        }
    </script>
@endsection

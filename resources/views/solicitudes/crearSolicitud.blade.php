@extends('contenedores.home')
@section('titulo','Crear Solicitud')
@section('contenedor_home')
@include('error.error')
<br>
<script>var i=0</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <form enctype="multipart/form-data" action="{{ url('/solicitudes') }}" method = "POST">
            @csrf
            <div class="card border-primary rounded-0" style="border-color:#66bb6a !important;">
                <div class="card-header p-0">
                    <div class="bg-info text-white text-center py-2" style="background-color:#66bb6a !important;">
                        <h3><i class="fas fa-hand-holding-usd"></i> Crear Solicitud</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
						{{-- titulo --}}
						<div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class= "input-group-text">
											<i class="fas fa-font"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-sm"  id="titulo" name="titulo" placeholder="Titulo Solicitud" value="@eachError('titulo', $errors) @endeachError">
                            </div>
						</div>
                    </div>
					<div class="row">
						{{-- descripcion --}}
						<div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class= "input-group-text">
										<i class="fas fa-edit"></i>
                                    </span>
								</div>
								{{-- <input type="text" class="form-control form-control-sm"  id="titulo" name="titulo" placeholder="Titulo Solicitud" value="@eachError('titulo', $errors) @endeachError"> --}}

                                <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="50" rows="5" placeholder="Describe tu Solicitud" >@eachError('descripcion', $errors) @endeachError</textarea>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
						{{-- categoria --}}
						<div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                </div>
								<select  id="categoria" name="categoria" placeholder="Categoria de la solicitud" class="form-control form-control-sm" >
										<option value="">Seleccione una categoria</option>
										<option value="educacion" @select('categoria', 'educacion')@endselect >Educacion</option>
										<option value="investigacion" @select('categoria', 'investigacion')@endselect >Investigacion</option>
										<option value="arte" @select('categoria', 'arte')@endselect >Arte</option>
										<option value="empresa" @select('categoria', 'empresa')@endselect >Empresa</option>
										<option value="personal" @select('categoria', 'personal')@endselect >Personal</option>
										
								</select>
							</div>
                        </div>
                        {{-- monto --}}
                        <div class="col-md-4">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                                </div>
                                <input type="number" id="monto" name="monto_requerido" placeholder="Monto solicitado" class="form-control form-control-sm" value="@eachError('monto_requerido', $errors)@endeachError">
                            </div>
                        </div>
                    </div>
					<div class="row">
							{{-- tasa de interes --}}
							<div class="col-md-2"></div>
							<div class="col-md-4">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-percentage"></i></i></span>
									</div>
									<input type="number" step="any"  id="tasa" name="interes" placeholder="Tasa de Interes" class="form-control form-control-sm" value="@eachError('interes', $errors)@endeachError">
								</div>
							</div>
							{{-- fecha recaudo --}}
							<div class="col-md-4">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"> Plazo recaudo</i> 
											</span>
										</div>
										<input type="date" min="2018-11-17" name="tiempo_recaudacion" placeholder="dd/mm/yyyy" class="form-control form-control-sm" value="@eachError('tiempo_recaudacion', $errors)@endeachError">
									</div>
								</div>
							</div>
                    <div class="row">
						<div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="input-group mb-2">
                            {{-- tiempo devolucion --}}
							<div class="input-group-prepend">
								<span class="input-group-text">
										<i class="fas fa-donate"></i>
								</span>
							</div>
							<select  id="tiempo" name="tiempo_devolucion" placeholder="Tiempo para devolucion" class="form-control form-control-sm" >
								<option value="">Seleccione plazo de entrega</option>
								<option value="3" @select('tiempo_devolucion', '3')@endselect >3 meses</option>
								<option value="6" @select('tiempo_devolucion', '6')@endselect>6 meses</option>
								<option value="9" @select('tiempo_devolucion', '9')@endselect>9 meses</option>
								<option value="12" @select('tiempo_devolucion', '12')@endselect>1 año</option>
								<option value="24" @select('tiempo_devolucion', '24')@endselect>2 años</option>
							</select>
                        </div>
                    </div>
					</div>
			<div id="imagenes">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="input-group mb-2">
							{{-- Foto --}}
							<div class="input-group-prepend" style="height: calc(1.8125rem + 2px); font-size: .875rem;">
								<i class="fas fa-file-image input-group-text"></i>
							</div>
							<div class="custom-file">
								<input type="file" id="fotos" name="fotos[]" multiple  class="custom-file-input form-group"  lang="es" value="@eachError('foto', $errors) @endeachError">
								<label id="file" class="custom-file-label" for="customFileLang">Sube tus fotos</label>
							</div>
						</div>
					</div>
				</div>
			</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8"><output id="list"></output></div>
		
	</div>
	<br>
				<div id="vide">
					<div class="row meno">
							<div class="col-md-2"></div>
							<div class="col-md-8">
									<div class="input-group mb-2">
											{{-- video --}}
											<div class="input-group-prepend">
													<span class="input-group-text">
															<i class="fab fa-youtube"></i>
													</span>
												</div>
														<input type="text" name="videos[0]" class="form-control form-control-sm" placeholder="Ingrese la url de YouTube" id="video" onblur="videop()" value="@eachError('video', $errors) @endeachError">

											</div>
	
										
							</div>
					</div>
				</div>
					
					<div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4 ">
                <a class=" btn btn-secondary btn-block  " id="create"><i class="fas fa-plus" style="color: white !important;"></i></a>
            </div>
            <div class="col-md-4 ">
                <a class=" btn btn-secondary btn-block " id="delete"><i class="fas fa-minus" style="color: white !important;"></i></a>
            </div>
        </div><br>
					<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<div class="text-center">
									<input type="submit" name="action" value="Enviar" class=" btn btn-info btn-block rounded-0 py-2 " style="background-color: #66bb6a !important; border-color: #66bb6a !important;">
								</div>
							</div>
					</div>
					
					
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<br>







<style>
  .thumb {
    height: 85px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>



<script>
  function handleFileSelect(evt) {
    var fotos = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = fotos[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('fotos').addEventListener('change', handleFileSelect, false);
</script>



{{-- 

<script>
function videop(){
	result = document.getElementById('videoSalida');
	val = document.getElementById('video').value;
	result.style.display = "inline";
	inicio = "https://www.youtube.com/embed/";
	result.src = inicio+val;
	document.getElementById('descripcion_video').style.display = "inline";
};
</script> --}}
@endsection
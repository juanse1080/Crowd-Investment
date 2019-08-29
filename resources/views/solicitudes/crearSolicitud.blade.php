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
            <div class="card rounded pb-4">
                <div class="card-header p-0">
                    <div class="bg-info text-white text-center py-2 rounded-top" style="background-color:#636bff !important;">
                        <h3><i class="fas fa-hand-holding-usd mt-2"></i> Crear Solicitud</h3>
                    </div>
                </div>
                <div class="card-body p-3">
					<div class="container">
						<div class="row">
							{{-- titulo --}}
							<div class="col-md-6">
								<label for="cedula">Titulo Solicitud:</label>
								<input type="text" class="form-control mb-2"  id="titulo" name="titulo" value="@eachError('titulo', $errors) @endeachError">
							</div>
							{{-- Tiempo para devolución --}}
							<div class="col-md-6">
								<label for="tiempo">Tiempo para devolución:</label>
								<select  id="tiempo" name="tiempo_devolucion" class="form-control mb-3" >
									<option disabled value="">Seleccione plazo de entrega</option>
									<option value="3" @select('tiempo_devolucion', '3')@endselect >3 meses</option>
									<option value="6" @select('tiempo_devolucion', '6')@endselect>6 meses</option>
									<option value="9" @select('tiempo_devolucion', '9')@endselect>9 meses</option>
									<option value="12" @select('tiempo_devolucion', '12')@endselect>1 año</option>
									<option value="24" @select('tiempo_devolucion', '24')@endselect>2 años</option>
								</select>
							</div>
						</div>
						<div class="row">
							{{-- descripcion --}}
							<div class="col-md-12">
								<label for="cedula">Descripcion:</label>
								<textarea class="form-control mb-2" name="descripcion" id="descripcion" cols="50" rows="5" >@eachError('descripcion', $errors) @endeachError</textarea>
							</div>
						</div>
						<div class="row">
							{{-- categoria --}}
							<div class="col-md-6">
								<label for="categoria">Categoria:</label>
								<select  id="categoria" name="categoria" class="form-control mb-2" >
									<option disabled value="">Seleccione una categoria</option>
									<option value="educacion" @select('categoria', 'educacion')@endselect >Educacion</option>
									<option value="investigacion" @select('categoria', 'investigacion')@endselect >Investigacion</option>
									<option value="arte" @select('categoria', 'arte')@endselect >Arte</option>
									<option value="empresa" @select('categoria', 'empresa')@endselect >Empresa</option>
									<option value="personal" @select('categoria', 'personal')@endselect >Personal</option>
								</select>
							</div>
							{{-- monto --}}
							<div class="col-md-6">
								<label for="monto">Monto:</label>
								<input type="number" id="monto" name="monto_requerido" class="form-control mb-2" value="@eachError('monto_requerido', $errors)@endeachError">
							</div>
						</div>
						<div class="row">
							{{-- tasa de interes --}}
							<div class="col-md-6">
								<label for="tasa">Tasa de interes:</label>
								<input type="number" step="any"  id="tasa" name="interes" class="form-control mb-2" value="@eachError('interes', $errors)@endeachError">
							</div>
						</div>
						<div id="imagenes">
							<div class="row">
								<div class="col-md-12">
									<label for="cedula">Sube tus fotos:</label>
									<div class="custom-file">
										<input type="file" id="fotos" name="fotos[]" multiple  class="custom-file-input form-group"  lang="es" value="@eachError('foto', $errors) @endeachError">
										<label id="file" class="custom-file-label" for="customFileLang">png, jpg, jpeg...</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"><output id="list"></output></div>
						</div>
						<div class="row">
							<div class="col-md-12 mt-3">
								<div class="text-center">
									<input type="submit" name="action" value="Crear" class=" btn btn-primary btn-block rounded py-2">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
			
</div>








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
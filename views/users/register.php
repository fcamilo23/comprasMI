<div class="row col-12" style="margin-top: 50px; background: #0d0f1d; border: 10px solid #1c1e25; padding: 25px">

<div class="col-12 panel panel-default">
  <div style="margin-top: 80px; margin-bottom: 50px;" class="panel-heading">
    <h1 style="color: #fff" class="panel-title">Registrar usuario</h1>
  </div>
  <div class="panel-body">
    <form id="registerUser" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

		<div class="form-group">
    		<label style="margin-top: 25px; color: #fff" >cedula</label>
    		<input id="cedula" type="text" name="cedula" class="form-control" />
			<span style="margin-top: 25px; color: #fff" id="resultcedula"></span>
		</div>

		<div class="form-group">
    		<label style="margin-top: 25px; color: #fff">Nick de persona referida</label>
    		<input id="personaReferida" type="text" name="personaReferida" class="form-control" />
			<span style="margin-top: 25px; color: #fff" id="resultPersonaReferida"></span>
    	</div>
		
		<div class="form-group">
    		<label style="margin-top: 25px; color: #fff">Email</label>
    		<input id="email" type="email" name="email" class="form-control" />
			<span style="margin-top: 25px; color: #fff" style="color: blue" id="resultEmail"></span>
    	</div>

		<div class="form-group">
    		<label style="margin-top: 25px; color: #fff">telefono</label>
    		<input type="text" name="telefono" class="form-control" />
    	</div>

		<div class="form-group">
    		<label style="margin-top: 25px; color: #fff">Nombre</label>
    		<input type="text" name="nombre" class="form-control" />
    	</div>

		<div class="form-group">
    		<label style="margin-top: 25px; color: #fff">Apellido</label>
    		<input type="text" name="apellido" class="form-control" />
    	</div>

		<div class="form-group">
			<input type="text" name="imagen" id="imagen" class="form-control d-none"/>
			<label style="margin-top: 25px; color: #fff">Imágen</label>
			<input type="text" name="imagen1" id="imagen1" class="form-control" disabled/>
			<button style="margin-top: 5px; margin-bottom: 15px; color: black; background: #b5d6d9; border: none; width: 15%" type="button" class="btn btn-primary" id="btn">
				Agregar imagen
			</button>

			
    	</div>

    	<div class="form-group">
    		<label style="margin-top: 25px; color: #fff">Biografia</label>
    		<input type="text" name="biografia" class="form-control" />
    	</div>

		<div class="form-group">
    		<label style="margin-top: 25px">Contrasena</label>
    		<input type="password" name="password" class="form-control" />
    	</div>

    	<input style="margin-top: 25px; margin-bottom: 15px;border: none; width: 15%;"  class="btn btn-primary" name="submit" type="submit" value="Registrarse" />
    </form>
  </div>
</div>
</div>
<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
<script type="text/javascript">
	let cedulaInput = document.getElementById("cedula");
	$(document).ready(function(){    
		$("#cedula").blur(function(){
			console.log("entra")  
  			var name = $(this).val(); 
			$("#resultcedula").html('checking...');
			$.ajax({
				type : 'POST',
				url  : "validatecedula",
				data : $(this).serialize(),
				success : function(data){
					console.log(data)
					$("#resultcedula").html(data);
				}
			});
			return false;
		});

		$("#personaReferida").blur(function(){
			console.log("entra")  
  			var name = $(this).val(); 
			$("#resultPersonaReferida").html('checking...');
			$.ajax({
				type : 'POST',
				url  : "validatePersonaReferida",
				data : $(this).serialize(),
				success : function(data){
					console.log(data)
					$("#resultPersonaReferida").html(data);
				}
			});
			return false;
		});

		$("#email").blur(function(){  
			var name = $(this).val(); 
			$("#resultEmail").html('checking...');
			$.ajax({
				type : 'POST',
				url  : "validateEmail",
				data : $(this).serialize(),
				success : function(data){
					console.log(data)
					$("#resultEmail").html(data);
				}
			});
			return false;
		});

	})

	// Subir imagen
	const btn = document.querySelector("#btn");
	const imagen = document.querySelector("#imagen");
	const imagen1 = document.querySelector("#imagen1");

	let urlImagen = ''
	const widget_cloudinary = cloudinary.createUploadWidget({
		cloudName: "dgooa3xoj",
		uploadPreset: "jgpjerdd"
	}, (error, result) => {
		if (!error && result && result.event === 'success') {
			console.log(result.info.secure_url)
			imagen.value = result.info.secure_url;
			imagen1.value = result.info.secure_url;

		}
	})

	btn.addEventListener("click", e => {
            e.preventDefault();
            widget_cloudinary.open()
        }, false)
</script>
<div class="row col-12" style="margin-top: 50px; padding: 25px">

<div class="col-9 panel panel-default center" >
  <div style="margin-top: 80px; margin-bottom: 50px;" class="panel-heading center">
    <h1 style="color: #001d5a" class="panel-title">Registrar usuario</h1>
  </div>
  <div class="panel-body">
    <form id="registerUser" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

		<div class="form-group">
    		<label style="margin-top: 25px; color: #001d5a" >CI</label>
    		<input id="cedula" type="text" name="cedula" class="form-control" />
			<label id="resultcedula"></label>
		</div>

		<div class="form-group">
		<label style="margin-top: 25px; color: #001d5a">Rol</label>
			<select name="rol" class="form-control">
				<option value="Consultor" selected>Consultor</option>
				<option value="Operador">Operador</option>
				<option value="Administrador">Administrador</option>
			</select>
    	</div>


		
		<div class="form-group">
    		<label style="margin-top: 25px; color: #001d5a">Email</label>
    		<input id="email" type="email" name="email" class="form-control" />
			<span style="margin-top: 25px; color: #001d5a" style="color: blue" id="resultEmail"></span>
    	</div>

		<div class="form-group">
    		<label style="margin-top: 25px; color: #001d5a">Nombre</label>
    		<input type="text" name="nombre" class="form-control" />
    	</div>

		<div class="form-group">
    		<label style="margin-top: 25px; color: #001d5a">Apellido</label>
    		<input type="text" name="apellido" class="form-control" />
    	</div>

		


    	<input style="margin-top: 25px; margin-bottom: 15px;border: none;"  class="btn btn-primary sombraAzul" name="submit" type="submit" value="Registrar" />
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
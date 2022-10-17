<?php
if($_SESSION['user_data']['rol'] != 'Administrador'){
	?>
	<script>
    Swal.fire({
        title: '',
        text: "Solo los administradores tienen acceso al registro de usuarios",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="<?php echo ROOT_URL; ?>";
        }
        })

</script>

	<?php
}else{
?>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-body">
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


<?php } ?>
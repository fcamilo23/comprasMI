<?php if($_SESSION['user_data']['rol'] == 'Consultor'){ ?>

<script>
    Swal.fire({
        title: '',
        text: "Debes ser Operador o Administrador para agregar una novedad",
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

<?php }else{ ?>

<a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-body">
				<div style="margin-top: 80px; margin-bottom: 50px;" class="panel-heading center">
  </div>
  <h1 style="color: #025396; margin-bottom: 40px" class="panel-title">Agregar Novedad</h1>

  <div class="panel-body">

    <form id="registerUser" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <?php //obtener fecha de hoy con hora zona horaria argentina o uruguay
        date_default_timezone_set('America/Montevideo');
        $fecha = date('Y-m-d H:i');
        //restarle un año a la fecha
        $fecha2 = strtotime ( '-1 year' , strtotime ( $fecha ) ) ;
        $fecha2 = date ( 'Y-m-d H:i' , $fecha2 );
        //un anio mas
        $fecha3 = strtotime ( '+1 year' , strtotime ( $fecha ) ) ;
        $fecha3 = date ( 'Y-m-d H:i' , $fecha3 );

        ?>
        <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon3">Fecha y hora: </span>
        <input id="fecha" type="datetime-local" style="max-width:200px;"rows="2" min="<?php echo $fecha2 ?>" max="<?php echo $fecha3 ?>" value="<?php echo $fecha ?>" name="fecha"  class="form-control" required>
        </div>
        <hr>
        <div class="form-group">
		</div>
		<div class="form-group">
    		<textarea id="texto" type="text" rows="7" name="texto"  placeholder="Ingrese la novedad..." required class="form-control"></textarea>
		</div>

			

    	<input style="margin-top: 25px; margin-bottom: 15px;border: none; display: none"  class="btn btn-primary sombraAzul" id="confirmarnovedad" name="submit" type="submit" value="Confirmar" />

    	<input style="margin-top: 25px; margin-bottom: 15px;border: none; "  class="btn btn-primary sombraAzul"   type="button" value="Confirmar" onclick='confirmarnovedadd()' />
    </form>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function confirmarnovedadd(){

        if(document.getElementById('texto').value == ""){
            Swal.fire({
            title: 'Ups!',
            text: "No puedes agregar una novedad vacía...",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
            }).then((result) => {
            if (result.isConfirmed) {
                
            }
        })
        }else{

                Swal.fire({
                title: 'Confirmación',
                text: "Seguro que deseas agregar ésta novedad?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, agregar novedad',
                cancelButtonText: 'No, cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('confirmarnovedad').click();
                }
            })



        }
    }
</script>

<?php } ?>

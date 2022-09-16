<a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-body">
				<div style="margin-top: 80px; margin-bottom: 50px;" class="panel-heading center">
  </div>
  <h1 style="color: #001d5a; margin-bottom: 40px" class="panel-title">Agregar Novedad</h1>

  <div class="panel-body">

    <form id="registerUser" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

		<div class="form-group">
    		<textarea id="texto" type="text" rows="7" name="texto" placeholder="Ingrese la novedad..." class="form-control"></textarea>
		</div>

			


    	<input style="margin-top: 25px; margin-bottom: 15px;border: none;"  class="btn btn-primary sombraAzul" name="submit" type="submit" value="Confirmar" />
    </form>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>



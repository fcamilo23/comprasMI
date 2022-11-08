<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/>

<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet"/>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
    $('#listaProveedores').DataTable( {
        dom: 'lBfrtip',
        buttons: [
           
        ]
    } );
} );
</script>
<a href="<?php echo ROOT_URL; ?>"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>
<?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
    <a href="<?php echo ROOT_PATH; ?>proveedor/nuevoProveedor"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaProv.jpg" width="190px" height="50px" ></button></a>
<?php } ?>

<div id="main-container" style="width: 100%; overflow: auto; padding: 55px; background: #fff">

		<table id="listaProveedores"style="width: 100%">
        

			<thead>
                
				<tr>
					<th>Empresa</th>
                    <th>Razon Social</th>
                    <th>R.U.T.</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Acciones</th>
				</tr>
			</thead>
            <tbody >
			<?php foreach($viewmodel as $item) : ?>
                <tr>

                <td><?php echo $item['empresa'] ?></td>
                <td><?php echo $item['razon_social'] ?></td>
                <td><?php echo $item['rut'] ?></td>
                <td><?php echo $item['telefono'] ?></td>
                <td><?php echo $item['email'] ?></td>
                <td>
                    <form action="<?php echo ROOT_PATH; ?>proveedor/seleccionarProveedor" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $item['id']?>">
                        <input type="submit" name="submit" class = "btn azul" style="color:white" value="Ampliar">
                    </form>
                </td>

			</tr> <?php endforeach; ?>
            </tbody>
		</table>
	</div>
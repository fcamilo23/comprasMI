<a href="<?php echo ROOT_URL; ?>"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>
<?php if($_SESSION['user_data']['rol'] == 'Administrador'){?>
<a href="<?php echo ROOT_PATH; ?>users/register"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevoUser.jpg" width="200px" height="50px" ></button></a>
<?php } ?>


    <script>
    $(document).ready(function() {
    $('#us').DataTable( {
        dom: 'lBfrtip',
        buttons: [
           
        ]
    } );
} );
</script>

<div id="main-container" style="width: 100%; overflow: auto; padding: 55px; background: #fff">



		<table id="us" style="width: 100%">
			<thead>
				<tr>
					<th>CI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <?php if($_SESSION['user_data']['rol'] == 'Administrador'){ ?><th></th>  <?php }?>

				</tr>
			</thead>
            <tbody >
                
			<tr><?php foreach($viewmodel as $item) : //if($item['cedula'] != $_SESSION['user_data']['cedula']){?>
                <td><strong style="font-size: 20px" ><?php if($item['cedula'] == $_SESSION['user_data']['cedula']){ echo '👤 ';  }?></strong>​<?php echo $item['cedula'] ?> </td>
                <td><?php echo $item['nombre'] ?></td>
                <td><?php echo $item['apellido'] ?></td>
                <td><?php echo $item['email'] ?></td>
                <td><?php echo $item['rol'] ?></td>
                <?php if($_SESSION['user_data']['rol'] == 'Administrador'){ ?><td>
                <form id="editarUser" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="ciuser" value="<?php echo $item['cedula'] ?>" style="display:none" />    
                <input type="submit" name="submit" value="Editar" style="background: #001d5a; border: none" class="btn btn-primary "/>
                <!--<input type="submit" value="Eliminar" style="color: #fff; border: none" class="btn btnEliminar "/>-->
                </form>
                </td> <?php } ?>


                
			</tr> <?php endforeach; ?>
            </tbody>
		</table>
	</div>
<a href="<?php echo ROOT_PATH; ?>users/register"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevoUser.jpg" width="200px" height="50px" ></button></a>
<h1  class="center" style="color: #001d5a; margin-left: 40%">Usuarios</h1>

<script>
        $(document).ready(function() {
        $('#us').DataTable( {
            
        } );
    } );
    </script>

<div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">



		<table id="us" style="width: 100%">
			<thead>
				<tr>
					<th>CI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th></th>

				</tr>
			</thead>
            <tbody >
                <tr class="yo"><?php foreach($viewmodel as $item) : if($item['cedula'] == $_SESSION['user_data']['cedula']){?>
                    <td><?php echo $item['cedula']; ?></td>
                    <td><?php echo $item['nombre']; ?></td>
                    <td><?php echo $item['apellido']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['rol']; ?></td>
                    <td><input type="submit" value="Editar" style="background: #001d5a; border: none" class="btn btn-primary somraAzul1"/></td>

         
                </tr> <?php }endforeach; ?>
			<tr><?php foreach($viewmodel as $item) : if($item['cedula'] != $_SESSION['user_data']['cedula']){?>
                <td><?php echo $item['cedula'] ?></td>
                <td><?php echo $item['nombre'] ?></td>
                <td><?php echo $item['apellido'] ?></td>
                <td><?php echo $item['email'] ?></td>
                <td><?php echo $item['rol'] ?></td>
                <td><input type="submit" value="Editar" style="background: #001d5a; border: none" class="btn btn-primary somraAzul1"/>
                <input type="submit" value="Eliminar" style="color: #fff; border: none" class="btn btnEliminar somraAzul1"/></td>


                
			</tr> <?php }endforeach; ?>
            </tbody>
		</table>
	</div>
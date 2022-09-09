<a href="<?php echo ROOT_PATH; ?>users/register"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevoUser.jpg" width="200px" height="50px" ></button></a>

<div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

		<table style="width: 100%">
			<thead>
				<tr>
					<th>CI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
				</tr>
			</thead>
            <tbody >
			<tr><?php foreach($viewmodel as $item) : ?>
                <td><?php echo $item['cedula'] ?></td>
                <td><?php echo $item['nombre'] ?></td>
                <td><?php echo $item['apellido'] ?></td>
                <td><?php echo $item['email'] ?></td>
                <td><?php echo $item['rol'] ?></td>

                
			</tr> <?php endforeach; ?>
            </tbody>
		</table>
	</div>
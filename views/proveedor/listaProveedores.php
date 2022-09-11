<a href="<?php echo ROOT_PATH; ?>solicitudes/downloadFile"><button type="button" class="excel sombraVerde"> <img src="<?php echo ROOT_PATH; ?>imagenes/Excel1.jpg" width="150px" height="50px" ></button></a>
<a href="<?php echo ROOT_PATH; ?>solicitudes/nuevoProveedor"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaSoli.jpg" width="190px" height="50px" >no</button></a>

<div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

		<table style="width: 100%">
        

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
			<tr><?php foreach($viewmodel as $item) : ?>
                <td><?php echo $item['empresa'] ?></td>
                <td><?php echo $item['razon_social'] ?></td>
                <td><?php echo $item['rut'] ?></td>
                <td><?php echo $item['telefono'] ?></td>
                <td><?php echo $item['email'] ?></td>
                <td>
                    <form action="<?php echo ROOT_PATH; ?>proveedor/verProveedor" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $item['id'] ?>">
                        <button type="submit" class = "btn btn-success">Ampliar</button>
                    </form>
                </td>

			</tr> <?php endforeach; ?>
            </tbody>
		</table>
	</div>
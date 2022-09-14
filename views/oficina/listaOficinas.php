<a href="<?php echo ROOT_PATH; ?>oficina/listaOficinas"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaOfi.jpg" width="190px" height="50px" ></button></a>
<div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

		<table style="width: 100%">
        

			<thead>
                
				<tr>
					<th>UNIDAD</th>
                    <th>UE</th>
                    <th></th>

                </tr>

			</thead>
            <tbody>
            <tr><?php foreach($viewmodel as $item) : ?>
                <td><?php echo $item['unidad'] ?></td>
                <td><?php echo $item['ue'] ?></td>
                <td>
                    <button class = "btn btn-success" value="<?php echo $item['unidad'] ?>">Editar</button>
                    <button value="Eliminar"class="btn btn-danger">Quitar</button>
                </td>
            </tr> <?php endforeach; ?>
            </tbody>
    </table>
</div>


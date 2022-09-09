<a href="<?php echo ROOT_PATH; ?>solicitudes/downloadFile"><button type="button" class="excel sombraVerde"> <img src="<?php echo ROOT_PATH; ?>imagenes/Excel1.jpg" width="150px" height="50px" ></button></a>
<button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaSoli.jpg" width="190px" height="50px" ></button>

<div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

		<table style="width: 100%">
        

			<thead>
                
				<tr>
					<th>SR</th>
                    <th>Procedimiento</th>
                    <th>Art/Serv</th>
                    <th>Grupo Art/Serv</th>
                    <th>Gastos e Inversiones</th>
                    <th>Cantidad</th>
                    <th>Costo Estimado</th>
                    <th>Planificado</th>
                    <th>Estado</th>
                    <th>Oficina Solicitante</th>
                    <th>Referente</th>
                    <th>Contacto</th>
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Observaciones</th>


				</tr>
			</thead>
            <tbody >
			<tr><?php foreach($viewmodel as $item) : ?>
                <td><?php echo $item['SR'] ?></td>
                <td><?php echo $item['procedimiento'] ?></td>
                <td><?php echo $item['artServ'] ?></td>
                <td><?php echo $item['grupoAS'] ?></td>
                <td><?php echo $item['gastos_inversiones'] ?></td>
                <td><?php echo $item['cantidad'] ?></td>
                <td><?php echo $item['costoAprox'] ?></td>
                <td><?php echo $item['planificado'] ?></td>
                <td><?php echo $item['estado'] ?></td>
                <td><?php echo $item['oficinaSolicitante'] ?></td>
                <td><?php echo $item['referente'] ?></td>
                <td><?php echo $item['contactoReferente'] ?></td>
                <td><?php echo $item['fechaHora'] ?></td>
                <td><?php echo $item['detalle'] ?></td>
                <td><?php echo $item['observaciones'] ?></td>
                
			</tr> <?php endforeach; ?>
            </tbody>
		</table>
	</div>
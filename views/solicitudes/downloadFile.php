<?php
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=solicitudes.xls");

?>
<table>
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
			<tr><?php foreach($_SESSION['solicitudesExcel'] as $item) : ?>
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


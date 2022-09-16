

    <script>
        $(document).ready(function() {
        $('#solis').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        } );
    } );


    </script>
    
    <a href="<?php echo ROOT_URL; ?>users/profile"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>


<!--<button type="button" tabindex="0" aria-controls="solis" class="excel sombraVerde"> <img src="<?php echo ROOT_PATH; ?>imagenes/Excel1.jpg" width="150px" height="50px" ></button>-->
<a href="<?php echo ROOT_PATH; ?>solicitudes/nuevaSolicitud"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaSoli.jpg" width="190px" height="50px" ></button></a>
<h1 style="color: #001d5a" class="center">Solicitudes de Compra</h1>

<div id="main-container" style="width: 100%; overflow: auto; padding: 25px;"> <!--  max-height: 800px -->

		<table id="solis" style="width: 100%;">

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
                    <th style="width:150px">Fecha y Hora</th>
                    <th>Detalle</th>
                    <th>Observaciones</th>
                    <th></th>



				</tr>
			</thead>
            <tbody >
			<tr><?php foreach($viewmodel as $item) : ?>
                <td><?php echo $item['SR'] ?></td>
                <td><?php echo substr($item['procedimiento'],0,3); ?></td>
                <td><?php echo $item['artServ'] ?></td>
                <td><?php echo $item['grupoAS']; ?></td>
                <td><?php echo $item['gastos_inversiones'] ?></td>
                <td><?php echo $item['cantidad'] ?></td>
                <td>$<?php echo $item['costoAprox'] ?></td>
                <td><?php echo $item['planificado'] ?></td>
                <td><?php echo $item['estado'] ?></td>
                <td><?php echo $item['oficinaSolicitante'] ?></td>
                <td><?php echo $item['referente'] ?></td>
                <td><?php echo $item['contactoReferente'] ?></td>
                <td><?php $date = new DateTime($item['fechaHora'], new DateTimeZone('America/Montevideo') ); echo $date->format('d-m-Y H:i:s') ?></td>
                <td><?php echo $item['detalle'] ?></td>
                <td><?php echo $item['observaciones'] ?></td>

                <form id="filtro" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       
                <td><input type="text" name="numero" style="display: none" value="<?php echo $item['SR']; ?>"/>
                <input type="submit" name="submit" value="Ampliar" style="background: #001d5a; border: none" class="btn btn-primary sombraAzul"/></td>
                </form>
                
			</tr> <?php endforeach; ?>
            </tbody>
		</table>
	</div>

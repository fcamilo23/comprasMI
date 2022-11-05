<script>
       $(document).ready(function() {
        $('#compras').DataTable( {
            buttons: [
            {
                extend: 'excel',
                title: 'REPORTE DE VENCIOMIENTOS VIGENTES EN EL <?php echo $viewmodel['anio']; ?>',
                filename: '*',
                header: true

            }

            ],

            paging: false,
            order: [[0, 'desc']],
            dom: 'lBfrtip',
            searching: false,
            ///poner titulo al excel
        } );
    } );
</script>
    
<a href="<?php echo ROOT_URL; ?>orden/contratosAVencer"><input type="button" style="width: 200px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="Volver a Vencimientos"/></a>

<button form="anioDespues" type="submit" class="btn btn-primary excel sombra" style="background: black">►</button>
<p class="excel" style="font-size: 25px" value=><b><?php echo $viewmodel['anio'] ?></b></p>
<?php if($viewmodel['anio'] >2010) {?>
    <button form="anioAntes" type="submit" class="btn btn-primary excel sombra" style="background: black">◄</button>
<?php } ?>
<div id="main-container" style="width: auto; overflow:auto; padding: 25px; background: #fff"> <!--  max-height: 800px -->
            <h3 class="center" style="text-align: center">Reporte de Vencimiento de Servicios en el año <?php echo $viewmodel['anio']; ?></h3>
<br>
<?php if(count($viewmodel['servicios'])>0) {?>
		<table id="compras" style=" overflow-x: auto; ">

        <caption>Reporte de Servicios Vigentes en el año <?php echo $viewmodel['anio']. "-"."Realizado ".date('d/m/y') ?></caption>
        </tbody>
			<thead style="background: rgb(20,20,20);" >
              
            <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th >Procedimiento</th>
                    <th>Orden</th>
                <!-- <th >Monto</th> -->
                    <th >Proveedor</th>
                    <th value="<?php echo $item['inicio'] ?>">Fecha Inicio</th>
                    <th >Fecha Fin</th>
                <!--   <th >Meses</th>
                    <th >Meses Anio</th> -->
                    <th style="min-width:40px; max-width:90px;" >Monto Mensual</th> 
                    <th >Monto Estimado Anual</th>
                    <th >Monto Estimado Total</th>
                    <th>Tipo</th>
                    <th style="display:none"  >Observacion</th>
			</tr>
        </thead>
        <tbody>

            <tr><?php foreach($viewmodel['servicios'] as $item) : 
                $moneda;
                                            if($item["moneda"]== "$ (Pesos Uruguayos)"){
                                                $moneda = '$U';
                                            }else{
                                                if($item["moneda"] == "U.I.(Unidades Indexadas)"){
                                                    $moneda = "U.I.";
                                                }else{
                                                    if($item["moneda"] == "U.R. (Unidades Reajustables)"){
                                                        $moneda = "U.R.";
                                                    }else{
                                                        if($item["moneda"] == "€ (Euro)"){
                                                            $moneda = "€";
                                                        }else{
                                                            $moneda = 'U$S';
                                                        }
                                                    }
                                                }
                                            }
                ?>
                <td><?php echo $item['cantidad']." ".$item['unidad'] ?></td>
                <td><?php echo $item['descripcion'] ?></td>
                <?php 
                $numero="";
                if(is_null($item['numeroAmpliacion'])){ 
                    $numero = $item['numeroAmpliacion'];
                } 
                ?>
                <td><?php echo $item['procedimiento']." ".$numero ?> </td>
                <td><?php echo 'OC ' . $item['numero'] .'-' .$item['anio'] ?></td>
                <!-- <td><?php echo $item['moneda']." ".$item['monto']; ?></td> -->
                <td> <?php echo $item['empresa'] ?></td>
                <td>
                    <?php 
                    $originalDate = "2017-03-08";
                    $newDate = date("d/m/Y", strtotime($item['inicio'] ));
                    echo $newDate;  ?>
                </td>
                <td><?php echo $item['fin'] ?></td>
                <?php 
                    $fecha1 = new DateTime($item['inicio']);
                    $fecha2 = new DateTime($item['fin']);
                    $fecha = $fecha1->diff($fecha2);
                        $fecha->m = $fecha->m +($fecha->y*12);
                        if($fecha->d >15||$fecha->m==0){
                        $fecha->m= $fecha->m +1;
                    }
                    $mesesServicio = $fecha->m;
                    $desde;
                    $hasta;
                    $principioAnio = new DateTime('01-01-'.$viewmodel['anio']);
                    $finAnio = new DateTime('31-12-'.$viewmodel['anio']);
                    if($fecha1>$principioAnio ){
                        $desde = $fecha1;
                    }else{
                        $desde = $principioAnio;
                    }
                    if($fecha2<$finAnio){
                        $hasta = $fecha2;
                    }else{
                        $hasta = $finAnio;
                    }
                    $fecha = $desde->diff($hasta);
                    //$fecha->m = $fecha->m +($fecha->y*12);
                    if($fecha->d >15||$fecha->m==0){
                        $fecha->m= $fecha->m +1;
                    }
                    $mesesServicioAnio = $fecha->m;

                ?>
               <!-- <td><?php echo $mesesServicio ?></td>
                <td><?php echo $mesesServicioAnio ?></td>-->
                <td>

                    <?php 
                    $montoMensual=round($item['monto']/$mesesServicio,2);
                    if($item['esservicio']=="Licencia"){
                        echo $moneda."  0" ;
                    }else{
                        echo $moneda." ".$montoMensual;
                    }?>
                </td>
                <td>
                    <?php echo $moneda." ".$montoMensual*$mesesServicioAnio ?>
                </td>
                <td>
                    <?php echo $moneda." ".$item['monto'] ?>
                </td>
                <td> <?php echo $item['esservicio'] ?></td>
                <td style="display:none" >
                    <?php echo "hola".$item['observacion'] ?>
            </tr><?php endforeach;?>
        </tbody>
       
</table>
</div>
<?php }else{?>
    <div class="alert alert-warning" role="alert" style="text-align:center;">
        No se encontraron servicios vigentes en el año <?php echo $viewmodel['anio'] ?>
    </div>

<?php }?>
<form id="anioDespues" action="<?php echo ROOT_URL; ?>orden/reporteServicios" method="post">
    <input  type="hidden" name="anio" value="<?php echo $viewmodel['anio']+1; ?>">
</form>
<form id="anioAntes" action="<?php echo ROOT_URL; ?>orden/reporteServicios" method="post">
    <input  style="display:none" type="hidden" name="anio" value="<?php echo $viewmodel['anio']-1; ?>">
</form>
<div id="main-container" style="width: 100%; overflow: auto; padding: 25px; background: #fff"> <!--  max-height: 800px -->
            <h3 class="center" style="text-align: center">Reporte de Servicios Vigentes en el año <?php echo $viewmodel['anio']; ?></h3>
<br>
		<table id="compras" >
        <h1></h1>
			<thead style="background: rgb(20,20,20);" >
              
            <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th >Procedimiento</th>
                    <th>Orden</th>
                    <th >Monto</th>
                    <th >Proveedor</th>
                    <th >Fecha Inicio</th>
                    <th >Fecha fin</th>
                    <th >Meses</th>
                    <th >Meses Anio</th>
                    <th >Monto Mensual</th>
                    <th >Monto Estimado Anual</th>
                    <th >Monto Estimado Total</th>
                    <th ></th>
			</tr>
        </thead>
        <tbody >

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
                <td><?php echo $item['moneda']." ".$item['monto']; ?></td>
                <td>proveedor</td>
                <td><?php echo $item['inicio'] ?></td>
                <td><?php echo $item['fin'] ?></td>
                <td>
                    <?php 
                        $fecha1 = new DateTime($item['inicio']);
                        $fecha2 = new DateTime($item['fin']);
                        $fecha = $fecha1->diff($fecha2);
                         $fecha->m = $fecha->m +($fecha->y*12);
                         if($fecha->d >15||$fecha->m==0){
                            $fecha->m= $fecha->m +1;
                        }
                        $mesesServicio = $fecha->m;
                       echo $mesesServicio;
                    
                    ?>
                
                </td>
                <td>
                <?php 
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
                    echo $mesesServicioAnio;
        
                ?>

                </td>
                <td>
                    <?php 
                        $montoMensual = round($item['monto']/$mesesServicio,2);
                        echo $moneda." ".$montoMensual ?>
                </td>
                <td>
                    <?php echo $moneda." ".$montoMensual*$mesesServicioAnio ?>
                </td>
                <td>
                    <?php echo $moneda." ".$item['monto'] ?>
                </td>
            </tr><?php endforeach;?>
        </tbody>
       
</table>

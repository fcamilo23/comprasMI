<!-- <div class="text-center homeimg1"  style="width: 50%">


<div class="center" style=" width: 100%">
	<img src="<?php echo ROOT_PATH; ?>imagenes/asd.png" alt="" style="" class="homeimg">

</div>

</div>



-->


<div class="row col-12" style="background: white;  height: 200%"> 
<div class="text-center center inicio"  >
<div class="center" style=" width: 100%">
	<img src="<?php echo ROOT_PATH; ?>imagenes/asd.png" alt="" style="margin-bottom: 50px" class="homeimg">

	
    <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true){?> 

        
<?php if($viewmodel != null && $_SESSION['ordindex'] != null){ ?><input type="button" id="ocultarBoton" onclick="ocultarBoton(this)" class="btn ocultarmostrar" style="float: right; margin-bottom: 20px" value="Ocultar Datos ▲"> <?php } ?>
<input type="button" id="mostrarBoton" onclick="ocultarBoton1(this)" class="btn ocultarmostrar" style="display: none; float: right; background: none; margin-bottom: 20px" value="Mostrar Datos ▼">







    <?php if($_SESSION['ordindex'] != null){ ?>

    <div id="main-container" style="width: 100%; overflow: auto; padding: 25px;"> <!--  max-height: 800px -->
            <h3 class="center" style="text-align: center"></h3>
		
	

		<a href="<?php echo ROOT_PATH; ?>orden/entregasPendientes" id="tag1" onclick="return true;" style="text-decoration: none">
        <h4 id="titulo1" style="color:black; ">Entregas Pendientes</h4>
       
		<table id="compras1" style="width: 100%;">

        <thead style="background: rgb(40,40,40)" >
                    
                    <tr>
                        <th>Id</th>
                        <th>Procedimiento</th>
                        <th>Orden</th>
                        <th>Monto</th>
                        <th>Proveedor</th>
                        <th>Fecha de Entrega</th>
                        <th>Atraso</th>






                    </tr>
                </thead>
                <tbody >

                <tr class="semaforoRojo"><?php foreach($_SESSION['ordindex'] as $item) : ?>
                    <td><?php echo $item['id'] ?></td>
                    <td><?php echo $item['procedimiento'] ?></td>
                    <td><?php echo 'OC ' . $item['numero'] .'-' . $item['anio'] ?></td>
                    <?php 
                    $moneda;
                    if($item['moneda'] == "$ (Pesos Uruguayos)"){
                        $moneda = '$U';
                    }else{
                        if($item['moneda'] == "U.I.(Unidades Indexadas)"){
                            $moneda = "U.I.";
                        }else{
                            if($item['moneda'] == "U.R. (Unidades Reajustables)"){
                                $moneda = "U.R.";
                            }else{
                                if($item['moneda'] == "€ (Euro)"){
                                    $moneda = "€";
                                }else{
                                    $moneda = 'U$S';
                                }
                            }
                        }
                    } ?>
                    <td><?php echo $moneda." ".$item['montoReal']; ?></td>
                    <td><?php foreach($_SESSION['proveedores'] as $p) : 
                    if($p['id'] == $item['idProveedor']){ 
                        echo $p['empresa'];
                    } endforeach;?></td>

                    <td><?php echo date("d/m/Y", strtotime( $item['plazoEntrega'])); ?></td>

                    <td style="color: rgb(180,0,0)"><strong>
                    <?php
                                        $now = time(); // or your date as well
                                        $your_date = strtotime($item['plazoEntrega']);
                                        $datediff = $your_date - $now;
                                
                                        $res = round($datediff / (60 * 60 * 24));
                                        if($res >= 364){
                                            $res = $res / 365;
                                            $año = intval($res);
                                            if($año == 0){$año = 1;}
                                            echo '';
                                            echo $año;
                                            echo ' años de atraso';
                                        }else{
                                            echo '';
                                            echo $res + 1 ;
                                            echo ' días de atraso';
                                        }
                                    ?>

                    </td></strong>

                    
                    









                </tr> <?php endforeach; ?>
                </tbody>
                </table>
		</a>
		
		<?php } ?>

	</div>











<?php if($viewmodel != null){ ?>


	
	<div id="main-container" style="width: 100%; overflow: auto; padding: 25px;"> <!--  max-height: 800px -->
            <h3 class="center" style="text-align: center"></h3>
		
		
            <h4 id="titulo" style="color:black">Servicios Próximos a Vencer</h4>

		<a href="<?php echo ROOT_PATH; ?>orden/contratosAVencer" id="tag" onclick="return true;" style="text-decoration: none"><table id="compras" style="width: 100%;">
        <h1></h1>
			<thead style="background: rgb(40,40,40)" >
              
            <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th >Orden</th>
                    <th >Fecha fin</th>
                    <th >Tiempo restante</th>
				</tr>
          
			</thead>
            <tbody >
            <?php 
            $hoy = date('Y-m-d');
            $_SESSION['hoy'] = $hoy;
            $_SESSION['1mes'] = date('Y-m-d', strtotime($hoy. ' + 30 days'));
            $_SESSION['3meses'] = date('Y-m-d', strtotime($hoy. ' + 90 days'));

            
            
            foreach($viewmodel as $item) : ?>
			<tr style="border-bottom: 5px solid grey"
            <?php if($item['fin'] > $_SESSION['3meses']){ ?>class="semaforoVerde" <?php }?>
            <?php if($item['fin'] <= $_SESSION['3meses'] && $item['fin'] > $_SESSION['1mes']){ ?>class="semaforoAmarillo" <?php }?>
            <?php if($item['fin'] <= $_SESSION['1mes']){ ?>class="semaforoRojo" <?php }?>
            >

            <td><?php echo $item['cantidad']." ".$item['unidad'];?></td>
                <td><?php echo $item['descripcion'];?></td>
                <td><?php echo 'OC ' . $item['numero'] .'-' . $item['anio'] ?></td>
                <?php    
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
                
                <td><?php if($item['fin'] == ""){echo 'N/A';}else{ $date = new DateTime($item['fin'], new DateTimeZone('America/Montevideo') ); echo $date->format('d/m/Y'); }?></td>
                <td><strong>
                <?php
                    $now = time(); // or your date as well
                    $your_date = strtotime($item['fin']);
                    $datediff = $your_date - $now;
            
                    $res = round($datediff / (60 * 60 * 24));
                    if($res >= 364){
                        $res = $res / 365;
                        $año = intval($res);
                        if($año == 0){$año = 1;}
                        echo '(';
                        echo $año;
                        echo ' años)';
                    }else{
                        echo '(';
                        echo $res + 1 ;
                        echo ' días)';
                    }
                ?>
                </strong></td>


                
                


            


            


			</tr> <?php endforeach; ?>
            </tbody>
		</table>
		</a>



        
	</div>

    <?php } ?>



    <?php } ?>


	</div>


	</div>



</div>

<script>
	function ocultarBoton(boton){
		boton.style = "display: none";
		document.getElementById('mostrarBoton').style= "float: right; margin-top: 20px; display: block";
		document.getElementById('compras').style.visibility = "hidden";
		document.getElementById('tag').style= "pointer-events: none; cursor: default;";
        document.getElementById('titulo').style.visibility = "hidden";

        document.getElementById('compras1').style.visibility = "hidden";
		document.getElementById('tag1').style= "pointer-events: none; cursor: default;";
        document.getElementById('titulo1').style.visibility = "hidden";


		
  



	}

	function ocultarBoton1(boton){
		boton.style = "display: none";
		document.getElementById('ocultarBoton').style= "float: right; margin-top: 20px; display: block";
		document.getElementById('compras').style.visibility = "visible";
        document.getElementById('titulo').style.visibility = "visible";
		document.getElementById('tag').style= "pointer-events: auto; cursor: pointer; text-decoration: none";


        document.getElementById('compras1').style.visibility = "visible";
        document.getElementById('titulo1').style.visibility = "visible";
		document.getElementById('tag1').style= "pointer-events: auto; cursor: pointer; text-decoration: none";


	}
</script>
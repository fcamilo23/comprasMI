<script>
       
       $(document).ready(function() {
        $('#compras').DataTable( {
            buttons: [
                'excel'
            ],order: [],
            dom: 'lBfrtip',
            "columnDefs": [ {
                "targets": [],
                "searchable": false,
                
                } ,
                
                {
                "targets": [],
                "visible": false,
                } ,
                {
                "targets": [0,1,2,3,4,5,6,7,8,9],
                "orderable": false,
                }
            
               ]
            

        } );
    } );


    $(document).ready(function() {
        $('#vencidos').DataTable( {
            buttons: [
                'excel'
            ],order: [],
            dom: 'lBfrtip',
            "columnDefs": [ {
                "targets": [],
                "searchable": false,
                
                } ,
                
                {
                "targets": [],
                "visible": false,
                } ,
                {
                "targets": [0,1,2,3,4,5,6,7,8],
                "orderable": false,
                }
            
               ]
            

        } );
    } );






</script>
  
  
  <a href="<?php echo ROOT_URL; ?>"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>


<!--<button type="button" tabindex="0" aria-controls="solis" class="excel sombraVerde"> <img src="<?php echo ROOT_PATH; ?>imagenes/Excel1.jpg" width="150px" height="50px" ></button>-->




<div id="main-container" style="width: 100%; overflow: auto; padding: 25px; background: #fff"> <!--  max-height: 800px -->
            <h3 class="center" style="text-align: center">Contratos Próximos a Vencer</h3>

		<table id="compras" style="width: 100%;">
        <h1></h1>
			<thead style="background: rgb(20,20,20);" >
              
				<tr>
                    <th >Id</th>
                    <th >Orden</th>
                    <th >Moneda</th>
                    <th >Monto Real</th>
                    <th >Procedimiento</th>
                    <th >Proveedor</th>
                    <th >Fecha Inicio</th>
                    <th >Fecha Fin</th>
                    <th >Tiempo Restante</th>
                    <th ></th>






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
            <?php if($item['fechaFin'] > $_SESSION['3meses']){ ?>class="semaforoVerde" <?php }?>
            <?php if($item['fechaFin'] <= $_SESSION['3meses'] && $item['fechaFin'] > $_SESSION['1mes']){ ?>class="semaforoAmarillo" <?php }?>
            <?php if($item['fechaFin'] <= $_SESSION['1mes']){ ?>class="semaforoRojo" <?php }?>


            >
                <td><?php echo $item['id'] ?></td>
                <td><?php echo 'OC ' . $item['numero'] .'-' . $item['anio'] ?></td>
                <td><?php echo $item['moneda'] ?></td>
                <td><?php echo $item['montoReal'] ?></td>
                <td><?php echo $item['procedimiento'] ?></td>
                <td><?php foreach($_SESSION['proveedores'] as $p) : 
                if($p['id'] == $item['idProveedor']){ 
                    echo $p['empresa'];
                } endforeach;?></td>
                <td><?php if($item['fechaInicio'] == ""){echo 'N/A';}else{ $date = new DateTime($item['fechaInicio'], new DateTimeZone('America/Montevideo') ); echo $date->format('d-m-Y'); }?></td>
                <td><?php if($item['fechaFin'] == ""){echo 'N/A';}else{ $date = new DateTime($item['fechaFin'], new DateTimeZone('America/Montevideo') ); echo $date->format('d-m-Y'); }?></td>
                <td><strong>
                <?php
                    $now = time(); // or your date as well
                    $your_date = strtotime($item['fechaFin']);
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


                
                

                <form id="verOrden" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       

                <td><input type="text" name="numero" style="display:none" value="<?php echo $item['id']; ?>"/>
                <input type="submit" name="submit" id="ver" value="Ampliar" style="background: rgb(230,230,230); color:black; border: 1px solid grey"  class="btn btn-primary sombra"/></td>
                </form>


            


            


			</tr> <?php endforeach; ?>
            </tbody>
		</table>

        <div style="margin-top: 30px">
            <div style="display: inline-block; margin-right:50px">
                <h2 style="margin-left: 15px; color: green; display: inline-block">■</h2>
                <h4 style="display: inline-block; color: grey">   Vence en más de 3 meses</h4>
            </div>
            <div style="display: inline-block;  margin-right:50px">
                <h2 style="margin-left: 15px; color: yellow; display: inline-block">■</h2>
                <h4 style="display: inline-block; color: grey">   Vence en menos de 3 meses</h4>
            </div>
            <div style="display: inline-block;">
                <h2 style="margin-left: 15px; color: red; display: inline-block">■</h2>
                <h4 style="display: inline-block; color: grey">   Vence en menos de 1 mes</h4>
            </div>
        </div>
	</div>


    
    






    

<div id="main-container" style="width: 100%; overflow: auto; padding: 25px; margin-top:200px; background: #fff"> <!--  max-height: 800px -->
            <h3 class="center" style="text-align: center">Contratos Vencidos</h3>

		<table id="vencidos" style="width: 100%;">
        <h1></h1>
			<thead style="background: rgb(20,20,20);" >
              
				<tr>
                    <th >Id</th>
                    <th >Orden</th>
                    <th >Moneda</th>
                    <th >Monto Real</th>
                    <th >Procedimiento</th>
                    <th >Proveedor</th>
                    <th >Fecha Inicio</th>
                    <th >Fecha Fin</th>
                    <th ></th>






				</tr>

              
			</thead>
            <tbody >
            <?php 
            $hoy = date('Y-m-d');
            $_SESSION['hoy'] = $hoy;
            $_SESSION['1mes'] = date('Y-m-d', strtotime($hoy. ' + 30 days'));
            $_SESSION['3meses'] = date('Y-m-d', strtotime($hoy. ' + 90 days'));

            
            
            foreach($_SESSION['vencidos'] as $item) : ?>
			<tr style="border-bottom: 5px solid grey" class="semaforoRojo">
                <td><?php echo $item['id'] ?></td>
                <td><?php echo 'OC ' . $item['numero'] .'-' . $item['anio'] ?></td>
                <td><?php echo $item['moneda'] ?></td>
                <td><?php echo $item['montoReal'] ?></td>
                <td><?php echo $item['procedimiento'] ?></td>
                <td><?php foreach($_SESSION['proveedores'] as $p) : 
                if($p['id'] == $item['idProveedor']){ 
                    echo $p['empresa'];
                } endforeach;?></td>
                <td><?php if($item['fechaInicio'] == ""){echo 'N/A';}else{ $date = new DateTime($item['fechaInicio'], new DateTimeZone('America/Montevideo') ); echo $date->format('d-m-Y'); }?></td>
                <td><?php if($item['fechaFin'] == ""){echo 'N/A';}else{ $date = new DateTime($item['fechaFin'], new DateTimeZone('America/Montevideo') ); echo $date->format('d-m-Y'); }?></td>



                
                

                <form id="verOrden" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       

                <td><input type="text" name="numero" style="display:none" value="<?php echo $item['id']; ?>"/>
                <input type="submit" name="submit" id="ver" value="Ampliar" style="background: rgb(230,230,230); color:black; border: 1px solid grey"  class="btn btn-primary sombra"/></td>
                </form>


            


            


			</tr> <?php endforeach; ?>
            </tbody>
		</table>
    </div>
    

    <script>
   
       

       

       



    </script>
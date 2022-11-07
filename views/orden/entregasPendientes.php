    <script>
        
        $(document).ready(function() {
         $('#compras').DataTable( {
             buttons: [
                {
                extend: 'excelHtml5',
                title: 'Entregas Pendientes <?php echo date('d-m-Y'); ?>'
            }
             ],
             order: [[2, 'desc']],
             dom: 'lBfrtip',
             "columnDefs": [ {
                 "targets": [],
                 "searchable": false,
                 
                 } ,
                 {
                 "targets": [],
                 "orderable": false,
                 }
             
                ]
             
 
         } );
     } );


</script>
  
  
  <a href="<?php echo ROOT_URL; ?>"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>




<div id="main-container" style="width: 100%; overflow: auto; padding: 25px; background: #fff"> <!--  max-height: 800px -->
<h1 class="center"  style="text-align: center">Entregas Pendientes</h1> 


		<table id="compras" style="width: 100%;">

			<thead style="background: rgb(40,40,40)">
                
				<tr>
                    <th>Id</th>
                    <th>Procedimiento</th>
                    <th>Orden</th>
                    <th>Monto</th>
                    <th>Proveedor</th>
                    <th>Fecha de Entrega</th>
                    <th>Atraso</th>
                    <th></th>






				</tr>
			</thead>
            <tbody >

			<tr><?php foreach($viewmodel as $item) : ?>
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

                <td><?php echo $item['plazoEntrega'] ?></td>

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

                
                

                <form id="editar" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       

                    <td><input type="text" name="numero" style="display:none" value="<?php echo $item['id']; ?>"/>
                    <input type="submit" name="submit" id="ver" value="Ampliar" style="background: rgb(40,40,40); border: none"  class="btn btn-primary sombraAzul"/></td>
                </form>


            


            


			</tr> <?php endforeach; ?>
            </tbody>
		</table>

        <?php  if($viewmodel == null){ ?> <h4 class="" style="margin-top: 30px; margin-left: 20px">No hay entregas pendientes</h4> <?php } ?>

	</div>



    <script>
        const abrirModal = document.querySelector("#abrirFiltros");
        const modal = document.querySelector("#modalfiltros");
        const cerrarModal = document.querySelector("#cerrarFiltros");


        abrirModal.addEventListener("click",()=>{

                abrirModal.classList.add("mystyle");

                modal.show();

            
        })
        cerrarModal.addEventListener("click",()=>{

                modal.close();
                abrirModal.classList.remove("mystyle");


       
        })



        function verOrden(orden){
            
           
        }

        function cambiarFecha(ini){
            
            const fin = document.getElementById("fechaIni").value;
            document.getElementById("fechaFin").value = fin;
            document.getElementById("fechaFin").min = fin;
            document.getElementById("fechaFin").disabled = false;


        }

        function cambiarFecha1(ini){
            
            const fin = document.getElementById("fechaIni1").value;
            document.getElementById("fechaFin1").value = fin;
            document.getElementById("fechaFin1").min = fin;
            document.getElementById("fechaFin1").disabled = false;


        }


        function mostrarFecha(servicio){
            
            if(servicio.value == 'Si'){
                document.getElementById("fechas").hidden = false;
            }else{
                document.getElementById("fechaIni1").value = "";
                document.getElementById("fechaFin1").value = "";
                document.getElementById("fechaIni").value = "";
                document.getElementById("fechaFin").value = "";
                document.getElementById("fechas").hidden = true;


            }


        }



    </script>
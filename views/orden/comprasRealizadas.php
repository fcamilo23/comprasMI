 <script>
       
       $(document).ready(function() {
        $('#compras').DataTable( {
            buttons: [
                'excel'
            ],
            dom: 'lBfrtip',
            "columnDefs": [ {
                "targets": [],
                "searchable": false,
                
                } ,
                {
                "targets": [4],//si se quire sacar la fecha hacer esto [4]
                "visible": false,
                }
            
               ]
            

        } );
    } );



</script>
  
  
  <a href="<?php echo ROOT_URL; ?>"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>


<!--<button type="button" tabindex="0" aria-controls="solis" class="excel sombraVerde"> <img src="<?php echo ROOT_PATH; ?>imagenes/Excel1.jpg" width="150px" height="50px" ></button>-->
<button class="filtrado sombra" style ="cursor: pointer; padding:5px; font-size: 25px; float:right; margin-right: 40px; border:none; background:#e9e9e9" id="abrirFiltros" > <i class="fas fa-filter" style="color:#303030" ></i> <p style="height: 10px; font-size: 20px;display: inline-block">Filtros</p></button>
<form id="filtro" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       

<dialog class="divfiltros center" id="modalfiltros" style="z-index: 1; animation: createBox .15s">
<h2 class="" style="display: inline-block; ">Filtros</h2>
    <label id="cerrarFiltros" style="cursor: pointer; display: inline-block; font-size: 40px; background: none; border: none; float:right">×</label>
    <div class="">
       



        <label  style="margin-top: 15px; color: rgb(130, 130, 130)">Procedimiento</label>
            <select name="procedimiento"  class="form-control">
                <option value="0" >Ninguno</option>
                <option value="---" >Aún no definido</option>
				<option value="LP">LP - Licitación Pública</option>
				<option value="LA">LA - Licitación Abreviada</option>
				<option value="CD">CD - Compra Directa</option>
                <option value="CE">CE - Compra por Excepción</option>
				<option value="CP">CP - Concurso de Precios</option>
				<option value="PCE">PCE - Procedimientos de Contratación Especiales</option>
				<option value="ARR">ARR - Arrendamiento</option>
				<option value="CCH">CCH - Caja Chica</option>

			</select> 
            

		</select> 

        <label  style="margin-top: 15px; color: rgb(130, 130, 130)">Articulos o Servicios</label>
        <select style ="" name="servicio" class="form-control" onchange="mostrarFecha(this)" >
            <option value="0" >Ambos</option>
            <option value="Si" >Servicios</option>
            <option value="No" >Artículos</option>

            

		</select> 

        <div id="fechas" style="" hidden>
    <div style="border: 1px solid rgb(200,200,200); padding: 20px; border-radius: 5px; margin-top: 20px">
        <strong ><label class="" style="color:grey; text-align: center; margin-bottom: 15px">Fecha de Inicio</label></strong>
        <div style="">
            <label class="" style="display: inline-block; color:grey" for="">Desde</label>
            <input class="form-control" style="display: inline-block;  width: 150px;" id="fechaIni" type="date" name="fechaIni" onchange="cambiarFecha(this)">
            <label class="" style="display: inline-block; color:grey; margin-left: 40px" for="">Hasta</label>
            <input class="form-control" style="display: inline-block; width: 40%; " id="fechaFin" type="date" disabled name="fechaFin"><br>
        </div>
        </div>

        <div style="border: 1px solid rgb(200,200,200); padding: 20px; border-radius: 5px; margin-top: 20px">
        <strong ><label class="" style="color:grey; text-align: center; margin-bottom: 15px">Fecha de Finalización</label></strong>
        <div style="">
            <label class="" style="display: inline-block; color:grey" for="">Desde</label>
            <input class="form-control" style="display: inline-block;  width: 150px;" id="fechaIni1" type="date" name="fechaIni1" onchange="cambiarFecha1(this)">
            <label class="" style="display: inline-block; color:grey; margin-left: 40px" for="">Hasta</label>
            <input class="form-control" style="display: inline-block; width: 40%; " id="fechaFin1" type="date" disabled name="fechaFin1"><br>
        </div>
        </div>

        </div>


        </div>

        <input type="submit" name="submit"  class="btn sombraAzul center " style="color:white; float:right; margin-right: 2%; width: 100px; margin-top:40px; background: #001d5a" value="Filtrar"/>
        <button  class="btn sombra center " style="color:white; float:right; margin-right: 4%; width: 100px; margin-top:40px; background: #999999">Limpiar </button>
</dialog>
</form>

<nav class="navbar navbar-light bg-light mt-4" style="width: 100%;">
        <h2 style="color: #001d5a; text-align: center;"class="center">Compras Realizadas</h2>
</nav>

<div id="main-container" style="width: 100%; overflow: auto; padding: 25px; background: #fff"> <!--  max-height: 800px -->

		<table id="compras" style="width: 100%;">

			<thead>
                
				<tr>
                    <th>Id</th>
                    <th>Procedimiento</th>
                    <th>Orden</th>
                    <th>Monto</th>
                    <th>Plazo Entrega</th>
                    <th>Proveedor</th>
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
                <?php
                $fecha = $item['plazoEntrega'];
                $fecha = date("d/m/Y", strtotime($fecha));
                ?>

                <td><?php echo $fecha ; ?> </td>
                <td><?php foreach($_SESSION['proveedores'] as $p) : 
                if($p['id'] == $item['idProveedor']){ 
                    echo $p['empresa'];
                } endforeach;?></td>



                
                

                <form id="verOrden" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       

                <td><input type="text" name="numero" style="display:none" value="<?php echo $item['id']; ?>"/>
                <input type="submit" name="submit" id="ver" value="Ampliar" style="background: #001d5a; border: none"  class="btn btn-primary sombraAzul"/></td>
                </form>


            


            


			</tr> <?php endforeach; ?>
            </tbody>
		</table>


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
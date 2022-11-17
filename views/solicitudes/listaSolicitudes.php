

    <script>
        
       $(document).ready(function() {
        $('#solis').DataTable( {
            buttons: [
                'excel'
            ],
            order: [[0, 'desc']],
            dom: 'lBfrtip',
            "columnDefs": [ {
                "targets": [14,13,12,11,8,7,6,5,2,0],
                "searchable": false,
                
                } ,
                {
                "targets": [6,14,13,11],
                "visible": false,
                }
            
               ]
            

        } );
    } );


/*
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#solis tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });
 
    // DataTable
    var table = $('#solis').DataTable({
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
    });
});*/

    </script>


<?php 
    if(isset($_SESSION['alertaSolicitud'])){ ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Perfecto! Se ha registrado la nueva solicitud',
            showConfirmButton: false,
            timer: 1500
        })
    </script>

    <?php
    unset($_SESSION['alertaSolicitud']);

    }
?>
    
    <a href="<?php echo ROOT_URL; ?>"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>


<!--<button type="button" tabindex="0" aria-controls="solis" class="excel sombraVerde"> <img src="<?php echo ROOT_PATH; ?>imagenes/Excel1.jpg" width="150px" height="50px" ></button>-->
<?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
    <a href="<?php echo ROOT_PATH; ?>solicitudes/nuevaSolicitud"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaSoli.jpg" width="190px" height="50px" ></button></a>
<?php } ?>
<button class="filtrado sombra" style ="cursor: pointer; padding:5px; font-size: 25px; float:right; margin-right: 40px; border:none; background:#e9e9e9" id="abrirFiltros" > <i class="fas fa-filter" style="color:#303030" ></i> <p style="height: 10px; font-size: 20px;display: inline-block">Filtros</p></button>
<form id="filtro" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">     
<nav class="navbar navbar-light bg-light mt-4" style="width: 100%;" style="z-index:1">
        <h2 style="color: #001d5a; text-align: center;"class="center">Lista Solicitudes</h2>
</nav>  
<dialog class="divfiltros center" id="modalfiltros" style="z-index: 1; animation: createBox .15s">
<h2 class="" style="display: inline-block; ">Filtros</h2>
    <label id="cerrarFiltros" style="cursor: pointer; display: inline-block; font-size: 40px; background: none; border: none; float:right">×</label>
    <div class="">
    <label class="center" style="color:grey" for="">Desde</label>
    <input class="form-control" style="" id="fechaIni" type="date" name="fechaIni" onchange="cambiarFecha(this)">
    <label style="margin-top: 5px; color:grey;" for="">Hasta</label>
    <input class="form-control" style="" id="fechaFin" type="date" disabled name="fechaFin"><br>

    
    <label  style="margin-top: 15px; color: rgb(130, 130, 130)">Estado</label>
        <select style ="" name="estado" class="form-control" >
            <option value="0" >Ninguno</option>

            <option value="Pendiente" >Pendiente</option>
            <option value="Solicitada" >Solicitada</option>
            <option value="Publicada" >Publicada</option>
            <option value="Informe Técnico" >Informe Técnico</option>
            <option value="Adjudicada" >Adjudicada</option>
            <option value="Entregada Parcial" >Entregada Parcial</option>
            <option value="Entregada Total" >Entregada Total</option>
            <option value="Facturada" >Facturada</option>
            <option value="Cancelada" >Cancelada</option>
            <option value="En Espera" >En Espera</option>

		</select> 

        <label  style="margin-top: 15px; color: rgb(130, 130, 130)">Planificado</label>
        <select style ="" name="planificado" class="form-control" >
            <option value="0" >Ninguno</option>
            <option value="Si" >Si</option>
            <option value="No" >No</option>
            

		</select> 

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

        <label  style="margin-top: 15px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
        <select style ="" name="gastos_inversiones" class="form-control" >
            <option value="0" >Ninguno</option>
            <option value="Bienes de Consumo" >Bienes de Consumo</option>
            <option value="Servicios No Personales" >Servicios No Personales</option>
            <option value="Bienes de Uso" >Bienes de Uso</option>

            

		</select> 


        </div>

        <input type="submit" name="submit"  class="btn sombraAzul center " style="color:white; float:right; margin-right: 2%; width: 100px; margin-top:40px; background: #001d5a" value="Filtrar"/>
        <button  class="btn sombra center " style="color:white; float:right; margin-right: 4%; width: 100px; margin-top:40px; background: #999999">Limpiar </button>
</dialog>
</form>


<div id="main-container" style="width: 100%; overflow: auto; padding: 25px; background: #fff"> <!--  max-height: 800px -->

		<table id="solis" style="width: 100%;">

			<thead>
                
				<tr >
                    <th>Id</th>
					<th>SR</th>
                    <th>Procedimiento</th>
                    <th>Art/Serv</th>
                    <th>Grupo Art/Serv</th>
                    <th>Gastos e Inversiones</th>
                    <th>Costo Estimado</th>
                    <th>Planificado</th>
                    <th>Estado</th>
                    <th>Unidad Ejecutora</th>
                    <th>Referente</th>
                    <th>Contacto</th>
                    <th style="width:90px">Fecha</th>
                    <th>Detalle</th>
                    <th>Observaciones</th>
                    <th></th>



				</tr>
			</thead>
            <tbody >
			<tr ><?php foreach($viewmodel as $item) : ?>
                <td><?php echo $item['id'] ?></td>
                <td><?php echo $item['SR'] ?></td>
                <td><?php if($item['numProc'] != "0" && $item['anioProc'] != "0"){echo $item['procedimiento'] . " ". $item['numProc'] . "/" . $item['anioProc'];}else{ echo $item['procedimiento'];} ?></td>
                <td><?php echo $item['artServ'] ?></td>
                <td><?php echo $item['grupoAS']; ?></td>
                <td><?php echo $item['gastos_inversiones'] ?></td>
                <td>$<?php echo $item['costoAprox'] ?></td>
                <td><?php echo $item['planificado'] ?></td>
                <td><?php echo $item['estado'] ?></td>
                <td><?php echo $item['oficinaSolicitante'] ?></td>
                <td><?php echo $item['referente'] ?></td>
                <td><?php echo $item['contactoReferente'] ?></td>
                <td><?php $date = new DateTime($item['fechaHora'], new DateTimeZone('America/Montevideo') ); echo $date->format('d-m-Y') ?></td>
                <td><?php echo $item['detalle'] ?></td>
                <td><?php echo $item['observaciones'] ?></td>
                <form id="editar" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       
                <td><input type="text" name="numero" style="display: none" value="<?php echo $item['id']; ?>"/>
                <input type="submit" name="submit" value="Ampliar" style="background: #001d5a; border: none" class="btn btn-primary sombraAzul"/></td>
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


        function cambiarFecha(ini){
            
            const fin = document.getElementById("fechaIni").value;
            document.getElementById("fechaFin").value = fin;
            document.getElementById("fechaFin").min = fin;
            document.getElementById("fechaFin").disabled = false;


        }



    </script>
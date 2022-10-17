<script>

    mensajes();
    function mensajes(){
        <?php if($_SESSION['mensaje']['tipo'] != '' ) { ?>

                Swal.fire({
                position: 'top-center',
                icon: '<?php echo $_SESSION['mensaje']['tipo']; ?>',
                title: '<?php echo $_SESSION['mensaje']['contenido']; ?>',
                showConfirmButton: false,
                timer: 2000
                });
        <?php 
            $_SESSION['mensaje']['tipo'] = '';
            $_SESSION['mensaje']['contenido'] = '';
            } ?>
        } 

</script>
<?php 
    $_SESSION['solicitudActual'] = $_SESSION['respaldoSolicitud'];
?>

<?php


        if(isset($_SESSION['alertEditarSoli'])){
            ?> <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Perfecto!',
                text: 'Se han efectuado los cambios',
                showConfirmButton: false,
                timer: 700
                })
                </script> <?php
                unset($_SESSION['alertEditarSoli']);
        }

        if(isset($_SESSION['alertAddNovedad'])){ ?>

            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Se ha agregado la novedad!',
                    timer: 1500,
                    showConfirmButton: false
                })
                
            </script> 
            <?php
            unset($_SESSION['alertAddNovedad']);

        }




    if(isset($_SESSION['alertDeleteFile'])){ ?>

           <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Archivo eliminado!',
                    timer: 1500,
                    showConfirmButton: false
                })
                
            </script> 
            <?php
            unset($_SESSION['alertDeleteFile']);

        }




        if(isset($_SESSION['alertAddFile'])){ 
            
            if($_SESSION['alertAddFile'] == '1'){ ?>

            <script>
                 Swal.fire({
                     position: 'center',
                     icon: 'success',
                     title: 'Archivo subido!',
                     timer: 1500,
                     showConfirmButton: false
                 })
                 
             </script> 
             
             <?php
             }else{
                ?>
                <script>
                 Swal.fire({
                     position: 'center',
                     icon: 'error',
                     title: 'Ha ocurrido un error!',
                     text: 'No ha sido posible subir este archivo ',
                     showConfirmButton: true
                 })


                
                 
             </script> 

                <?php
             }  

             unset($_SESSION['alertAddFile']);
 
         }

    
    

?>
 <!---->
<a href="<?php echo ROOT_URL; ?>solicitudes/listaSolicitudes"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>
<a href="<?php echo ROOT_PATH; ?>solicitudes/nuevaNovedad"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaNovedad.jpg" width="218px" height="48px" ></button></a>
<a href="<?php echo ROOT_PATH; ?>orden/nuevaOrden"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaOrden.jpg" width="190px" height="50px" ></button></a>
<a href="<?php echo ROOT_PATH; ?>solicitudes/nuevoArchivo"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevoArchivo.jpg" width="200px" height="48px" ></button></a>


<div class="row col-12 center" style="background: white; width: 70%; padding: 40px; border: 1px solid rgba(220, 220, 220); border-radius: 5px; margin-top: 3%;">
<div style="width: 100%; margin-bottom: 50px;" class="">
    <h1 style="color: #505050; text-align: center" class="center">Solicitud N° <?php echo $_SESSION['solicitudActual']['id']; ?></h1>
</div>
    <div class="col-lg-6 center">
        <form id="verSolicitud" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div style="padding: 20 40; background: rgb(239,239,239); border-radius: 5px; margin-top: 30px">

            <label  style="margin-top: 20px; color: rgb(130, 130, 130)">SR</label>
            <input type="text" id="sr" name="sr" class="form-control" value="<?php echo $_SESSION['solicitudActual']['SR']; ?>" style="margin-top: 0px;" placeholder="" disabled >

            <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
            <select name="gastos_inversiones" class="form-control" disabled >
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Bienes de Consumo"){?> selected <?php } ?> value="Bienes de Consumo">Bienes de Consumo</option>
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Servicios No Personales"){?> selected <?php } ?> value="Servicios No Personales">Servicios No Personales</option>
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Bienes de Uso"){?> selected <?php } ?> value="Bienes de Uso">Bienes de Uso</option>
			</select> 

            <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Planificado</label>
            <select name="planificado" class="form-control" disabled>
				<option <?php if ($_SESSION['solicitudActual']['planificado'] == "Si"){?> selected <?php } ?> value="Si" selected>Si</option>
				<option <?php if ($_SESSION['solicitudActual']['planificado'] == "No"){?> selected <?php } ?> value="No">No</option>
			</select> 

            <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Costo Estimado ($U)</label>
            <input type="number" name="costo" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['costoAprox'] ?>" required placeholder="0" disabled>
        
        </div>
        


        <div style="padding: 20 40; background: rgb(239,239,239); border-radius: 5px; margin-top: 30px">

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Oficina Solicitante</label>
        <input type="text" name="oficinaSolicitante" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['oficinaSolicitante'] ?>" disabled>

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">UO</label>
        <input type="text" name="UO" id="UO" value="<?php echo $_SESSION['solicitudActual']['uo'] ?>" class="form-control" style="margin-top: 0px;" disabled  >



       

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Referente de Compra</label>
        <input type="text" name="costo" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['referente'] ?>" required placeholder="" disabled>
        
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Contacto Referente</label>
        <input type="text" name="costo" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['contactoReferente'] ?>" required placeholder="" disabled>
        


        </div>
        <div style="padding: 35 40; background: rgb(239,239,239); border-radius: 5px; margin-top: 30px">

        <label  style=" color: rgb(130, 130, 130); font-size:20px">Fecha de Emisión: <?php echo $_SESSION['solicitudActual']['fechaHora'] ?></label>


        </div>
    </div>
    <div class="col-lg-6 center">
        <!--<label  style="margin-top: 20px; color: rgb(130, 130, 130)">Cantidad</label>
        <input type="number" name="cantidad" min="1" value="<?php echo $_SESSION['solicitudActual']['cantidad'] ?>" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese la cantidad" disabled>
-->


<div style="padding: 20 40; background: rgb(239,239,239); border-radius: 5px; margin-top: 30px">
 
<label  style="margin-top: 20px; color: rgb(130, 130, 130)">Grupos Art/Serv</label>
        <select name="grupoAS" class="form-control" disabled>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Artículos y Accesorios de Informática"){?> selected <?php } ?> value="Artículos y Accesorios de Informática" selected>Artículos y Accesorios de Informática</option>
                <option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Teléfono y Similares"){?> selected <?php } ?> value="Teléfono y Similares" >Teléfono y Similares</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)"){?> selected <?php } ?> value="Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)" >Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Arrendamiento Dispositivos Electrónicos (Tobilleras)"){?> selected <?php } ?> value="Arrendamiento Dispositivos Electrónicos (Tobilleras)" >Arrendamiento Dispositivos Electrónicos (Tobilleras)</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Servicios informáticos"){?> selected <?php } ?> value="Servicios informáticos" >Servicios informáticos</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Equipos de Informática"){?> selected <?php } ?> value="Equipos de Informática" >Equipos de Informática</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Equipos de Comunicaciones"){?> selected <?php } ?> value="Equipos de Comunicaciones" >Equipos de Comunicaciones</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Programas de Computación"){?> selected <?php } ?> value="Programas de Computación" >Programas de Computación</option>


			</select> 

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Art/Serv</label>
        <input type="text" name="artServ" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['artServ'] ?>" required placeholder="" disabled>
			

       
        </div>
        <div style="padding: 20 40; margin-top: 20px;  background: rgb(239,239,239); border-radius: 5px">
         <label  style=" color: rgb(130, 130, 130); display: block">Tipo de Procedimiento                     Número           Año </label>

        <!-- Todos estos if son para el momento de agregar items, que inevitablemente se recarga la pagina y con estos if conservamos los datos ya ingresados en el formulario -->
        <select name="procedimiento" id="procedimiento"  class="form-control" style="width: 50%; display: inline-block" disabled>
                <option value="---" >Aún no definido</option>
				<option <?php if(isset($_SESSION['solicitudActual']['procedimiento'])){if($_SESSION['solicitudActual']['procedimiento'] == "LP"){?> selected <?php }} ?> value="LP">LP - Licitación Pública</option>
				<option <?php if(isset($_SESSION['solicitudActual']['procedimiento'])){if($_SESSION['solicitudActual']['procedimiento'] == "LA"){?> selected <?php }} ?> value="LA">LA - Licitación Abreviada</option>
				<option <?php if(isset($_SESSION['solicitudActual']['procedimiento'])){if($_SESSION['solicitudActual']['procedimiento'] == "CD"){?> selected <?php }} ?> value="CD">CD - Compra Directa</option>
                <option <?php if(isset($_SESSION['solicitudActual']['procedimiento'])){if($_SESSION['solicitudActual']['procedimiento'] == "CE"){?> selected <?php }} ?> value="CE">CE - Compra por Excepción</option>
				<option <?php if(isset($_SESSION['solicitudActual']['procedimiento'])){if($_SESSION['solicitudActual']['procedimiento'] == "CP"){?> selected <?php }} ?> value="CP">CP - Concurso de Precios</option>
				<option <?php if(isset($_SESSION['solicitudActual']['procedimiento'])){if($_SESSION['solicitudActual']['procedimiento'] == "PCE"){?> selected <?php }} ?> value="PCE">PCE - Procedimientos de Contratación Especiales</option>
				<option <?php if(isset($_SESSION['solicitudActual']['procedimiento'])){if($_SESSION['solicitudActual']['procedimiento'] == "ARR"){?> selected <?php }} ?> value="ARR">ARR - Arrendamiento</option>
				<option <?php if(isset($_SESSION['solicitudActual']['procedimiento'])){if($_SESSION['solicitudActual']['procedimiento'] == "CCH"){?> selected <?php }} ?> value="CCH">CCH - Caja Chica</option>

			</select> 
           

            <input disabled type="number" name="numProcedimiento" id="numProcedimiento" value="<?php if(isset($_SESSION['solicitudActual']['numProcedimiento'])) {  echo $_SESSION['solicitudActual']['numProcedimiento']; }?>"   class="form-control" style="margin-top: 0px; width: 20%; display: inline-block"   onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
            <input disabled type="number" name="anioProcedimiento" id="anioProcedimiento" value="<?php if(isset($_SESSION['solicitudActual']['anioProcedimiento'])) {  echo $_SESSION['solicitudActual']['anioProcedimiento']; }?>"  class="form-control" style="margin-top: 0px; width: 28%; display: inline-block"   onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
        </div>

        

        <div style="padding: 20 40; background: rgb(239,239,239); border-radius: 5px; margin-top: 30px">

            <label  style="margin-top: 14px; color: rgb(130, 130, 130)">Detalle</label>
            <textarea class="form-control" name="detalle" cols="40" rows="5" style="margin-top: 0px;" placeholder="" disabled><?php echo $_SESSION['solicitudActual']['detalle'] ?></textarea>

            <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Observaciones</label>
            <textarea class="form-control" name="observaciones" cols="40" rows="5" style="margin-top: 0px;" value="" placeholder="" disabled><?php echo $_SESSION['solicitudActual']['observaciones'] ?></textarea>
        </div>

<div style="padding: 15 40; background: rgb(239,239,239); border-radius: 5px; margin-top: 30px">

        <label  style="margin-top: 10px; color: rgb(130, 130, 130)">Estado</label>
    <select name="estado" class="form-control" disabled>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Pendiente"){?> selected <?php } ?> value="Pendiente" >Pendiente</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Solicitada"){?> selected <?php } ?> value="Solicitada" >Solicitada</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Publicada"){?> selected <?php } ?> value="Publicada" >Publicada</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Informe Técnico"){?> selected <?php } ?> value="Informe Técnico" >Informe Técnico</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Adjudicada"){?> selected <?php } ?> value="Adjudicada" >Adjudicada</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Entregada Parcial"){?> selected <?php } ?> value="Entregada Parcial" >Entregada Parcial</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Entregada Total"){?> selected <?php } ?> value="Entregada Total" >Entregada Total</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Facturada"){?> selected <?php } ?> value="Facturada" >Facturada</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "Cancelada"){?> selected <?php } ?> value="Cancelada" >Cancelada</option>
    <option <?php if ($_SESSION['solicitudActual']['estado'] == "En Espera"){?> selected <?php } ?> value="En Espera" >En Espera</option>

</select> 
        </div>
       
    </div>








    <h3 style="margin-top: 150px">Items</h3>
                        <table style="background: #b4bacc">
                            <thead style="background: #172033">
                                <tr>
                                    <th style="width: 7%">Cantidad</th>
                                    <th style="width: 28%">Unidad</th>
                                    <th>Descripcion</th>
                                    <th style="width: 12%">Total ($U)</th>

                                </tr>
                            </thead>
                                    
                                    <?php if($_SESSION['items'] != NULL){ 
                                        
                                    foreach($_SESSION['items'] as $item) : ?>
                                    <tr class="tclass">
                                        <td><input  class="form-control" type="text" readonly value="<?php echo $item['cantidad'] ?>"></td>
                                        <td><input class="form-control" type="text" readonly value="<?php echo $item['unidad'] ?>"></td>
                                        <td><textarea class="form-control" rows="1" readonly type="text"><?php echo $item['descripcion'] ?></textarea></td>
                                        <td><input class="form-control" type="text" readonly value="<?php echo $item['total'] ?>"></td>

                                    </tr>

                                    <?php endforeach; } ?>
                                    

                            <tbody>

                            </tbody>
                        </table>

    <div class="col-12 center" style="text-align: center; margin-top: 60px">
        <a href="<?php echo ROOT_URL; ?>solicitudes/editarSolicitud"><input class="btn btn-primary" value="Editar Solicitud" style="width: 150px;"/> </a>
    </div>

</div>

</form>

<?php if($_SESSION['ordenes'] != null){?>

<div style="margin-top: 100px">
<a href="<?php echo ROOT_PATH; ?>orden/nuevaOrden"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaOrden.jpg" width="190px" height="50px" ></button></a>
<h1 style="color: #001d5a; margin-left: 25px" class="">Órdenes de Compra</h1>

<div id="main-container" style="width: 100%; overflow: auto; padding: 15px; max-height: 800px">

		<table id="solis" style="width: 100%;">

			<thead>
                
				<tr>
					<th>Número</th>
                    <th>Procedimiento</th>
                    <th>Proveedor</th>
                    <th>Monto Real ($U)</th>
                    <th>Plazo de Entrega</th>
                    <th></th>
                    <th></th>



				</tr>
			</thead>
            <tbody >
            
                <?php foreach ($_SESSION['ordenes']  as $orden) : ?>
                    <tr>
                    <td>OC <?php echo $orden['numero']; ?>-<?php echo $orden['anio']; ?></td>
                    <td><?php echo $orden['procedimiento']; ?></td>
                    <td><?php echo $orden['proveedor']; ?></td>
                    <?php
                    $moneda;
                    if($orden['moneda'] == "$ (Pesos Uruguayos)"){
                        $moneda = '$U';
                    }else{
                        if($orden['moneda'] == "U.I.(Unidades Indexadas)"){
                            $moneda = "U.I.";
                        }else{
                            if($orden['moneda'] == "U.R. (Unidades Reajustables)"){
                                $moneda = "U.R.";
                            }else{
                                if($orden['moneda'] == "€ (Euro)"){
                                    $moneda = "€";
                                }else{
                                    $moneda = 'U$S';
                                }
                            }
                        }
                    }
                    ?>
                    <td> <?php echo $moneda; ?> <?php echo $orden['montoReal']; ?> </td>
                    
                    <td><?php echo $orden['plazoEntrega']; ?></td>

                    <td>
                        <form  action="<?php echo ROOT_PATH; ?>orden/seleccionarOrden" method="POST">
                            <input type="hidden" name="idOrden" value="<?php echo $orden['idOrden']; ?>">
                            <button style="background: #001d5a; width: 100px; float:right; margin-right: 5%; border: none" class="btn btn-primary sombraAzul">VER</button>
                        </form>
                    </td>
                    <td>
                        <form id="eliminarOrden<?php echo $orden['idOrden']; ?>" action="<?php echo ROOT_PATH; ?>orden/eliminarOrden" method="POST">
                            <input type="hidden" name="idOrden" value="<?php echo $orden['idOrden']; ?>">
                        </form>
                        <input type="button" value="✖" onclick="cartelEliminarOrden(<?php echo $orden['idOrden']; ?>)" style="float:right; margin-right: 4%; border: none; color:white;" class="btn btnEliminar sombraRoja"/>
                    </td>
                    </tr>
                <?php endforeach; ?>
            

            </tbody>
		</table>
	</div>
</div>
<?php }else{?>
    
    <!-- <h1 style="color: grey; text-align: center" class="center">No hay ordenes de compra</h1> -->


<?php } ?>




<div style="margin-top: 40px; align-text: center">
<?php if($_SESSION['novedades'] != null){?>
<a href="<?php echo ROOT_PATH; ?>solicitudes/nuevaNovedad"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevaNovedad.jpg" width="218px" height="48px" ></button></a>


<h1  class="" style="color: #001d5a; margin-left: 25px">Novedades</h1>

<div id="main-container" style="width: 100%; overflow: auto; padding: 15px; max-height: 800px">

		<table id="solis" style="width: 100%;">

			<thead>
                
				<tr>
                    <th style="width:200px">Fecha</th>
					<th>Novedad</th>
                    
				</tr>
			</thead>
            <tbody >
            <tr><?php foreach($_SESSION['novedades'] as $item) : ?>
                <td><?php $date = new DateTime($item['fecha'], new DateTimeZone('America/Montevideo') ); echo $date->format('d-m-Y H:i:s') ?></td>

                <td><?php echo $item['texto'] ?></td>
            </tr> <?php endforeach; ?>

           

            </tbody>
		</table>
        <?php }else{
            ?>
            <!-- <h1 style="color: grey; text-align: center" class="center">No hay novedades</h1> -->

            <?php

        }?>
	</div>
    <div id="main-container" style="width: 100%; overflow: auto; padding: 15px; max-height: 800px">
    <?php if($_SESSION['archivos'] != null){?>
    <a  href="<?php echo ROOT_PATH; ?>solicitudes/nuevoArchivo"><button type="button" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevoArchivo.jpg" width="200px" height="48px" ></button></a>

    <h1  class="" style="color: #001d5a; margin-left: 25px">Archivos</h1>
		<table id="solis" style="width: 100%; margin-top: 30px;">
			<thead>
				<tr>
					<th>Nombre</th>
                    <th></th>
				</tr>
			</thead>
            <tbody >
            <?php foreach($_SESSION['archivos'] as $item) : ?>
                <tr>
					<td><?php echo $item ['nombre'] ?></td>

                <td>

                    <form action="<?php echo ROOT_PATH; ?>solicitudes/eliminarArchivo" method="post">
                            <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                            
                            <input type="submit" name="" value="✖" style="float:right; margin-right: 4%; border: none; color:white;" class="btn btnEliminar sombraRoja"/>
                    </form>  
                    <form action="<?php echo ROOT_PATH; ?>solicitudes/verArchivo" method="post">
                        <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                        
                       <input type="submit" name="submit" value="Ver" style="background: #001d5a; width: 100px; float:right; margin-right: 5%; border: none" class="btn btn-primary sombraAzul"/>
                        
                    </form>   
                                         
                    
                </td>
                </tr> <?php endforeach; ?>
            </tbody>
		</table>
        <?php }else{
            ?>
           <!--  <h1 style="color: grey; text-align: center" class="center">No hay archivos anexados</h1>-->
            <?php
        }?>
	</div>
</div>

<script>
function cartelEliminarOrden(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Borrar Orden?',
        text: "Seguro que quieres borrar esta orden, tambien se eliminan las facturas y archivos!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'No, borrar!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            //enviar formulario

            document.getElementById('eliminarOrden'+id).submit();

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelado',
            'No se elimino la orden ',
            'error'
            )
        }
        });

    }
</script>

=======


<script>
function deleteFileAlert(){
            
            const eliminar = document.getElementById("deleteFile");
            
            Swal.fire({
                title: 'Estás seguro?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, confirmar!',
                cancelButtonText: 'No, cancelar!'

                }).then((result) => {
                if (result.isConfirmed) {

                    
                    eliminar.click();
                    


                }
                })

        }



</script>
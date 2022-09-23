<a href="<?php echo ROOT_URL; ?>solicitudes/listaSolicitudes"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>
<div class="row col-12 center" style="background: white; width: 70%; padding: 40px; border: 1px solid rgba(220, 220, 220); border-bottom: none; border-radius: 5px; margin-top: 3%" >
    <h1 class="center " style="text-align: center; color: #001d5a">Nueva Solicitud</h1>
</div>
<div class="row col-12 center" style="background: white; width: 70%; padding: 40px; border: 1px solid rgba(220, 220, 220); border-radius: 5px; border-top: none; " >
    <div class="col-lg-6 center" >
        <form id="nuevaSolicitud" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">SR</label>
        <input type="text" value="<?php if(isset($_SESSION['solicitud']['sr'])) {  echo $_SESSION['solicitud']['sr']; }?>"  name="sr" class="form-control" style="margin-top: 0px;" placeholder="Ingrese el SR" required >

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
        <select name="gastos_inversiones" class="form-control">
                <option value="0" selected>Seleccione una opción</option>
                <option <?php if(isset($_SESSION['solicitud']['gastos_inversiones'])){if($_SESSION['solicitud']['gastos_inversiones'] == "Bienes de Consumo") { ?> selected <?php }} ?> value="Bienes de Consumo" >Bienes de Consumo</option>
				<option <?php if(isset($_SESSION['solicitud']['gastos_inversiones'])){if($_SESSION['solicitud']['gastos_inversiones'] == "Servicios No Personales") { ?> selected <?php }} ?> value="Servicios No Personales">Servicios No Personales</option>
				<option <?php if(isset($_SESSION['solicitud']['gastos_inversiones'])){if($_SESSION['solicitud']['gastos_inversiones'] == "Bienes de Uso") { ?> selected <?php }} ?> value="Bienes de Uso">Bienes de Uso</option>
			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Planificado</label>
        <select name="planificado" class="form-control">
                <option value="0" selected>Seleccione una opción</option>
				<option <?php if(isset($_SESSION['solicitud']['planificado'])){if($_SESSION['solicitud']['planificado'] == "Si") { ?> selected <?php }} ?> value="Si">Si</option>
				<option <?php if(isset($_SESSION['solicitud']['planificado'])){if($_SESSION['solicitud']['planificado'] == "No") { ?> selected <?php }} ?> value="No">No</option>
			</select> 

        <!-- Por si hay que poner el procedimiento con numero y año como dijo Saul: Procedimiento|Numero|Año ---------------------------------------------------- 
        <label style="margin-top: 20px; color: rgb(130, 130, 130)">Procedimiento | Número | Año</label>
        <div class="input-group">

        <select name="procedimiento" class="form-control" style="width: 42%">
                <option value="0" selected>Seleccione una opción</option>
				<option value="LP - Licitación Pública">LP - Licitación Pública</option>
				<option value="LA - Licitación Abreviada">LA - Licitación Abreviada</option>
				<option value="CD - Compra Directa">CD - Compra Directa</option>
                <option value="CE - Compra por Excepción">CE - Compra por Excepción</option>
				<option value="CP - Concurso de Precios">CP - Concurso de Precios</option>
				<option value="PCE - Procedimientos de Contratación Especiales">PCE - Procedimientos de Contratación Especiales</option>
				<option value="ARR - Arrendamiento">ARR - Arrendamiento</option>
				<option value="CCH - Caja Chica">CCH - Caja Chica</option>

			</select> 

        <input style="width: 10%; border-left: 3px solid grey"type="number" name="numProc" min="1"  class="form-control" style="margin-top: 0px;" required placeholder="Número">
        <input style="width: 10%; border-left: 3px solid grey"type="number" name="añoProc" min="1" class="form-control" style="margin-top: 0px;" required placeholder="Año">
        </div>

         ------------------------------------------------------------------------------------------------------------------------------------------------- -->





        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Tipo de Procedimiento</label>
        <!-- Todos estos if son para el momento de agregar items, que inevitablemente se recarga la pagina y con estos if conservamos los datos ya ingresados en el formulario -->
        <select name="procedimiento" class="form-control">
                <option value="0" >Seleccione una opción</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "LP - Licitacion Publica"){?> selected <?php }} ?> value="LP - Licitación Pública">LP - Licitación Pública</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "LA - Licitación Abreviada"){?> selected <?php }} ?> value="LA - Licitación Abreviada">LA - Licitación Abreviada</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "CD - Compra Directa"){?> selected <?php }} ?> value="CD - Compra Directa">CD - Compra Directa</option>
                <option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "CE - Compra por Excepción"){?> selected <?php }} ?> value="CE - Compra por Excepción">CE - Compra por Excepción</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "CP - Concurso de Precios"){?> selected <?php }} ?> value="CP - Concurso de Precios">CP - Concurso de Precios</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "PCE - Procedimientos de Contratación Especiales"){?> selected <?php }} ?> value="PCE - Procedimientos de Contratación Especiales">PCE - Procedimientos de Contratación Especiales</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "ARR - Arrendamiento"){?> selected <?php }} ?> value="ARR - Arrendamiento">ARR - Arrendamiento</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "CCH - Caja Chica"){?> selected <?php }} ?> value="CCH - Caja Chica">CCH - Caja Chica</option>

			</select> 

       

        <label  style="margin-top: 45px; color: rgb(130, 130, 130)">Oficina Solicitante</label>

            <select name="oficinaSolicitante" style="" class="form-control">
                
                <option value="0" selected>Seleccione una opción</option>
                <?php
                foreach($viewmodel as $item) : $oficina = $item['unidad'] . ' ' . $item['ue'];
                ?>
                <option <?php if(isset($_SESSION['solicitud']['oficinaSolicitante'])){if($_SESSION['solicitud']['oficinaSolicitante'] == $oficina) { ?> selected <?php }} ?>  value="<?php echo $oficina ?>" ><?php echo $oficina ?></option>
                <?php endforeach; ?>
            </select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Referente</label>
        <input type="text" name="referente" value="<?php if(isset($_SESSION['solicitud']['referente'])) {  echo $_SESSION['solicitud']['referente']; }?>" class="form-control" style="margin-top: 0px;" placeholder="Ingrese el nombre de un referente para esta solicitud" required >

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Contacto Referente</label>
        <input type="text" name="contactoReferente" value="<?php if(isset($_SESSION['solicitud']['contactoReferente'])) {  echo $_SESSION['solicitud']['contactoReferente']; }?>" class="form-control" style="margin-top: 0px;" placeholder="Ingrese correo del referente" required >
				



    </div>
    <div class="col-lg-6 center">
        <!--
        <label style="margin-top: 20px; color: rgb(130, 130, 130)">Cantidad | Unidad</label>
        <div class="input-group">

        <input style="width: 18%; border-right: 3px solid grey"type="number" name="cantidad" min="1"  class="form-control" style="margin-top: 0px;" required placeholder="Cantidad">
        <input style="width: 80%; border-left: 3px solid grey"type="text" name="unidad" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese la unidad">
        </div>-->

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Costo Estimado ($U)</label>
        <input type="number" name="costo" value="<?php if(isset($_SESSION['solicitud']['costo'])) {  echo $_SESSION['solicitud']['costo']; }?>" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese el costo estimado de la compra"> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Grupos Art/Serv</label>
        <select name="grupoAS" class="form-control">
                <option value="0" selected>Seleccione una opción</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Artículos y Accesorios de Informática"){?> selected <?php }} ?> value="Artículos y Accesorios de Informática" >Artículos y Accesorios de Informática</option>
                <option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Teléfono y Similares"){?> selected <?php }} ?> value="Teléfono y Similares" >Teléfono y Similares</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)"){?> selected <?php }} ?> value="Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)" >Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Arrendamiento Dispositivos Electrónicos (Tobilleras)"){?> selected <?php }} ?> value="Arrendamiento Dispositivos Electrónicos (Tobilleras)" >Arrendamiento Dispositivos Electrónicos (Tobilleras)</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Servicios informáticos"){?> selected <?php }} ?> value="Servicios informáticos" >Servicios informáticos</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Equipos de Informática"){?> selected <?php }} ?> value="Equipos de Informática" >Equipos de Informática</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Equipos de Comunicaciones"){?> selected <?php }} ?> value="Equipos de Comunicaciones" >Equipos de Comunicaciones</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Programas de Computación"){?> selected <?php }} ?> value="Programas de Computación" >Programas de Computación</option>


			</select> 

        <label  style="margin-top: 45px; color: rgb(130, 130, 130)">Art/Serv</label>
        <input name="artServ" class="form-control" placeholder="Ingrese un artículo o servicio">
        
       

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Detalle</label>
        <textarea class="form-control" name="detalle" cols="40" rows="4" style="margin-top: 0px;" placeholder="Ingrese un detalle aquí (opcional)"><?php if(isset($_SESSION['solicitud']['detalle'])) {  echo $_SESSION['solicitud']['detalle']; }?></textarea>

        <label  style="margin-top: 10px; color: rgb(130, 130, 130)">Observaciones</label>
        <textarea class="form-control" name="observaciones" cols="40" rows="4" style="margin-top: 0px;" placeholder="Ingrese observaciones aquí (opcional)"><?php if(isset($_SESSION['solicitud']['observaciones'])) {  echo $_SESSION['solicitud']['observaciones']; }?></textarea>

    </div>

    



<!--
<form>
    
<table style="width: 100%">
                        

                        <thead>
                            
                            <tr>
                                <th>Referente</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tr> <?php foreach($_SESSION['items'] as $item) : ?>
                        

                        <tr >
                            <form  action="" method="POST">
                                <td><input type="text" class="form-control" id="cant" name="cant" value="<?php echo $item['cantidad'] ?>"></td>
                                <td><input type="text" class="form-control" id="uni" name="uni" value="<?php echo $item['unidad'] ?>"></td>
                                <td><input type="text" class="form-control" id="descrip" name="descrip" value="<?php echo $item['descripcion'] ?>"></td>
                                <td><button type="submit" class="btn btn-success"> ></button></td>
                            </form>
                        </tr>
                            <?php endforeach; ?>
                            <form id="nform" action="<?php echo ROOT_PATH; ?>proveedor/verProveedor" method="POST">
                                <td><input type="text" class="form-control" id="nreferente" name="nreferente"></td>
                                <div id="nreferenteError"></div>
                                <td><input type="text" class="form-control" id="ncorreo" name="ncorreo"></td>
                                <td><input type="text" class="form-control" id="ntelefono" name="ntelefono"></td>
                                <td>
                                
                                <input type="hidden" name="id" id="id" value="<?php echo $viewmodel["id"] ?>">
                                <input type="hidden" name="accion" id="accion" value="newreferente">
                                <button type="submit" id="nuevo-ref" class = "btn btn-primary">+</button>
                            </form>
                            </td>

                        </tr> 
                        <tbody >


            </div>
</form>
                        -->



                        <h3 style="margin-top: 150px">Agregar ítems</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 7%">Cantidad</th>
                                    <th style="width: 30%">Unidad</th>
                                    <th>Descripcion</th>
                                    <th style="width: 3%"></th>

                                </tr>
                            </thead>
                                    <tr>
                                        <td><input class="form-control" name="cant" id="cant" type="text"></td>
                                        <td><input class="form-control" name="uni" id="uni" type="text"></td>
                                        <td><textarea class="form-control" name="desc" id="desc" rows="1" type="text"></textarea></td>
                                        <td><input type="submit" id="add" name="submit"  class="btn btn-primary" value="+"></input></td>

                                        
                                        

                                    </tr>


                                    <?php if($_SESSION['items'] != NULL){ 
                                        
                                    foreach($_SESSION['items'] as $item) : ?>
                                    <tr>
                                        <td><input  class="form-control" type="text" readonly value="<?php echo $item['cantidad'] ?>"></td>
                                        <td><input class="form-control" type="text" readonly value="<?php echo $item['unidad'] ?>"></td>
                                        <td><textarea class="form-control" rows="1" readonly type="text"><?php echo $item['descripcion'] ?></textarea></td>
                                        <td><button style="color: white" class="btn btnEliminar">×</button></td>

                                        
                                        

                                    </tr>

                                    <?php endforeach; } ?>
                                    

                            <tbody>

                            </tbody>
                        </table>

                        <div class="col-12 center" style="text-align: center; margin-top: 100px">
                            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Confirmar" style="width: 150px;"/>
                        </div>
        </form>

</div>


<script>


$(document).ready(function(){
    $('#add').attr('disabled',true);
    $('#cant, #uni').keyup(function(){
        if($('#cant').val().length !=0 && $('#uni').val().length !=0)
            $('#add').attr('disabled', false);            
        else
            $('#add').attr('disabled',true);
    })
});















</script>
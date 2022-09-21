<a href="<?php echo ROOT_URL; ?>solicitudes/listaSolicitudes"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>

<div class="row col-12 center" style="background: white; width: 70%; padding: 40px; border: 1px solid rgba(220, 220, 220); border-radius: 5px; margin-top: 3%" >
    <div class="col-lg-6 center" >
        <form id="nuevaSolicitud" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">SR</label>
        <input type="text" name="sr" class="form-control" style="margin-top: 0px;" placeholder="Ingrese el SR" required >

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
        <select name="gastos_inversiones" class="form-control">
                <option value="0" selected>Seleccione una opción</option>
                <option value="Bienes de Consumo" >Bienes de Consumo</option>
				<option value="Servicios No Personales">Servicios No Personales</option>
				<option value="Bienes de Uso">Bienes de Uso</option>
			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Planificado</label>
        <select name="planificado" class="form-control">
                <option value="0" selected>Seleccione una opción</option>
				<option value="Si">Si</option>
				<option value="No">No</option>
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
        <select name="procedimiento" class="form-control">
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

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Grupos Art/Serv</label>
        <select name="grupoAS" class="form-control">
                <option value="0" selected>Seleccione una opción</option>
				<option value="Artículos y Accesorios de Informática" >Artículos y Accesorios de Informática</option>
                <option value="Teléfono y Similares" >Teléfono y Similares</option>
				<option value="Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)" >Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)</option>
				<option value="Arrendamiento Dispositivos Electrónicos (Tobilleras)" >Arrendamiento Dispositivos Electrónicos (Tobilleras)</option>
				<option value="Servicios informáticos" >Servicios informáticos</option>
				<option value="Equipos de Informática" >Equipos de Informática</option>
				<option value="Equipos de Comunicaciones" >Equipos de Comunicaciones</option>
				<option value="Programas de Computación" >Programas de Computación</option>


			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Art/Serv</label>
        <input name="artServ" class="form-control" placeholder="Ingrese un artículo o servicio">

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Oficina Solicitante</label>

            <select name="oficinaSolicitante" style="" class="form-control">
                
                <option value="0" selected>Seleccione una opción</option>
                <?php foreach($viewmodel as $item) : ?>
                <option value="<?php echo $item['unidad'] . ' ' . $item['ue'] ?>" ><?php echo $item['unidad'] . ' ' . $item['ue'] ?></option>
                <?php endforeach; ?>
            </select> 
				



    </div>
    <div class="col-lg-6 center">
        <label style="margin-top: 20px; color: rgb(130, 130, 130)">Cantidad | Unidad</label>
        <div class="input-group">

        <input style="width: 18%; border-right: 3px solid grey"type="number" name="cantidad" min="1"  class="form-control" style="margin-top: 0px;" required placeholder="Cantidad">
        <input style="width: 80%; border-left: 3px solid grey"type="text" name="unidad" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese la unidad">
        </div>

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Costo Estimado ($U)</label>
        <input type="number" name="costo" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese el costo estimado de la compra">
        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Referente</label>
        <input type="text" name="referente" class="form-control" style="margin-top: 0px;" placeholder="Ingrese el nombre de un referente para esta solicitud" required >

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Contacto Referente</label>
        <input type="text" name="contactoReferente" class="form-control" style="margin-top: 0px;" placeholder="Ingrese correo del referente" required >

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Detalle</label>
        <textarea class="form-control" name="detalle" cols="40" rows="4" style="margin-top: 0px;" placeholder="Ingrese un detalle aquí (opcional)"></textarea>

        <label  style="margin-top: 10px; color: rgb(130, 130, 130)">Observaciones</label>
        <textarea class="form-control" name="observaciones" cols="40" rows="4" style="margin-top: 0px;" placeholder="Ingrese observaciones aquí (opcional)"></textarea>

    </div>

    

</div>
<div class="col-12 center" style="text-align: center; margin-top: 100px">
        <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Confirmar" style="width: 150px;"/>
    </div>
</form>
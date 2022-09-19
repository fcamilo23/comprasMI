<a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>

<div class="row col-12">
    <div class="col-lg-6 center">
        <form id="verSolicitud" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

        <input type="number" id="id" name="id" class="form-control" value="<?php echo $_SESSION['solicitudActual']['id']; ?>" style="margin-top: 0px; display:none" placeholder="Ingrese el número SR"  required >



        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Número SR</label>
        <input type="number" id="sr" name="sr" class="form-control" value="<?php echo $_SESSION['solicitudActual']['SR']; ?>" style="margin-top: 0px;" placeholder="Ingrese el número SR"  readonly >

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
        <select name="gastos_inversiones" class="form-control"  >
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Bienes de Consumo"){?> selected <?php } ?> value="Bienes de Consumo">Bienes de Consumo</option>
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Servicios No Personales"){?> selected <?php } ?> value="Servicios No Personales">Servicios No Personales</option>
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Bienes de Uso"){?> selected <?php } ?> value="Bienes de Uso">Bienes de Uso</option>
			</select> 

   
        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Tipo de Procedimiento</label>
        <select name="procedimiento" class="form-control" >
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "LP - Licitación Pública"){?> selected <?php } ?> value="LP - Licitación Pública" selected>LP - Licitación Pública</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "LA - Licitación Abreviada"){?> selected <?php } ?> value="LA - Licitación Abreviada">LA - Licitación Abreviada</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "CD - Compra Directa"){?> selected <?php } ?> value="CD - Compra Directa">CD - Compra Directa</option>
                <option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "CE - Compra por Excepción"){?> selected <?php } ?> value="CE - Compra por Excepción">CE - Compra por Excepción</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "CP - Concurso de Precios"){?> selected <?php } ?> value="CP - Concurso de Precios">CP - Concurso de Precios</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "PCE - Procedimientos de Contratación Especiales"){?> selected <?php } ?> value="PCE - Procedimientos de Contratación Especiales">PCE - Procedimientos de Contratación Especiales</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "ARR - Arrendamiento"){?> selected <?php } ?> value="ARR - Arrendamiento">ARR - Arrendamiento</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "CCH - Caja Chica"){?> selected <?php } ?> value="CCH - Caja Chica">CCH - Caja Chica</option>

			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Grupos Art/Serv</label>
        <select name="grupoAS" class="form-control" >
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Artículos y Accesorios de Informática"){?> selected <?php } ?> value="Artículos y Accesorios de Informática" selected>Artículos y Accesorios de Informática</option>
                <option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Teléfono y Similares"){?> selected <?php } ?> value="Teléfono y Similares" >Teléfono y Similares</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)"){?> selected <?php } ?> value="Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)" >Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Arrendamiento Dispositivos Electrónicos (Tobilleras)"){?> selected <?php } ?> value="Arrendamiento Dispositivos Electrónicos (Tobilleras)" >Arrendamiento Dispositivos Electrónicos (Tobilleras)</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Servicios informáticos"){?> selected <?php } ?> value="Servicios informáticos" >Servicios informáticos</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Equipos de Informática"){?> selected <?php } ?> value="Equipos de Informática" >Equipos de Informática</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Equipos de Comunicaciones"){?> selected <?php } ?> value="Equipos de Comunicaciones" >Equipos de Comunicaciones</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Programas de Computación"){?> selected <?php } ?> value="Programas de Computación" >Programas de Computación</option>


			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Art/Serv</label>
        <select name="artServ" class="form-control" >
				


		</select> 


        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Estado</label>
        <select name="estado" class="form-control" >
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

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Referente de Compra</label>
        <input type="text" name="referente" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['referente'] ?>" required placeholder="Ingrese el referente" >
        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Contacto Referente</label>
        <input type="text" name="contactoReferente" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['contactoReferente'] ?>" required placeholder="Ingrese el correo del referente" >
        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130); font-size:20px">Fecha de Emisión: <?php echo $_SESSION['solicitudActual']['fechaHora'] ?></label>
        <input type="text" name="fechaHora" class="form-control" style="margin-top: 0px; display:none" value="<?php echo $_SESSION['solicitudActual']['fechaHora'] ?>" required placeholder="Ingrese el correo del referente" >
        


    </div>
    <div class="col-lg-6 center">
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Cantidad</label>
        <input type="number" name="cantidad" min="1" value="<?php echo $_SESSION['solicitudActual']['cantidad'] ?>" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese la cantidad" >

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Costo Estimado ($U)</label>
        <input type="number" name="costo" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['costoAprox'] ?>" required placeholder="Ingrese el costo estimado de la compra" >
        
        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Planificado</label>
        <select name="planificado" class="form-control">
				<option <?php if ($_SESSION['solicitudActual']['planificado'] == "Si"){?> selected <?php } ?> value="Si" selected>Si</option>
				<option <?php if ($_SESSION['solicitudActual']['planificado'] == "No"){?> selected <?php } ?> value="No">No</option>
			</select> 


        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Oficina Solicitante</label>
        <select name="oficinaSolicitante" style="" class="form-control">
                
                <option value="0" selected>Seleccione una opción</option>
                <?php foreach($viewmodel as $item) : ?>
                <option <?php $ofi = $item['unidad'] . ' ' . $item['ue']; if($_SESSION['solicitudActual']['oficinaSolicitante'] == $ofi){ ?> selected <?php } ?>value="<?php echo $ofi ?>" ><?php echo $ofi ?></option>
                <?php endforeach; ?>
            </select> 

        <label  style="margin-top: 30px; color: rgb(130, 130, 130)">Detalle</label>
        <textarea class="form-control" name="detalle" cols="40" rows="5" style="margin-top: 0px;" placeholder="Ingrese un detalle aquí" ><?php echo $_SESSION['solicitudActual']['detalle'] ?></textarea>

        <label  style="margin-top: 30px; color: rgb(130, 130, 130)">Observaciones</label>
        <textarea class="form-control" name="observaciones" cols="40" rows="5" style="margin-top: 0px;" value="" placeholder="Ingrese observaciones aquí" ><?php echo $_SESSION['solicitudActual']['observaciones'] ?></textarea>

       
    </div>

    

</div>
<div class="col-12 center" style="text-align: center; margin-top: 100px">
        <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Guardar Cambios" style="width: 150px;"/> 
    </div>
</form>
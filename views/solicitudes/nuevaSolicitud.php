<div class="row col-12">
    <div class="col-lg-6 center">
        <form id="nuevaSolicitud" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Número SR</label>
        <input type="number" name="sr" class="form-control" style="margin-top: 0px;" placeholder="Ingrese el número SR" required >

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
        <select name="gastos_inversiones" class="form-control">
				<option value="Bienes de Consumo" selected>Bienes de Consumo</option>
				<option value="Servicios No Personales">Servicios No Personales</option>
				<option value="Bienes de Uso">Bienes de Uso</option>
			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Planificado</label>
        <select name="planificado" class="form-control">
				<option value="Si" selected>Si</option>
				<option value="No">No</option>
			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Tipo de Procedimiento</label>
        <select name="procedimiento" class="form-control">
				<option value="LP - Licitación Pública" selected>LP - Licitación Pública</option>
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
				<option value="Artículos y Accesorios de Informática" selected>Artículos y Accesorios de Informática</option>
                <option value="Teléfono y Similares" >Teléfono y Similares</option>
				<option value="Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)" >Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)</option>
				<option value="Arrendamiento Dispositivos Electrónicos (Tobilleras)" >Arrendamiento Dispositivos Electrónicos (Tobilleras)</option>
				<option value="Servicios informáticos" >Servicios informáticos</option>
				<option value="Equipos de Informática" >Equipos de Informática</option>
				<option value="Equipos de Comunicaciones" >Equipos de Comunicaciones</option>
				<option value="Programas de Computación" >Programas de Computación</option>


			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Art/Serv</label>
        <select name="artServ" class="form-control">
				


		</select> 

    </div>
    <div class="col-lg-6 center">
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Cantidad</label>
        <input type="number" name="cantidad" min="1" value="1" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese la cantidad">

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Costo Estimado ($U)</label>
        <input type="number" name="costo" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese el costo estimado de la compra">
        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Oficina Solicitante</label>
        <select name="oficinaSolicitante" class="form-control">
		</select> 

        <label  style="margin-top: 30px; color: rgb(130, 130, 130)">Detalle</label>
        <textarea class="form-control" name="detalle" cols="40" rows="4" style="margin-top: 0px;" placeholder="Ingrese un detalle aquí"></textarea>

        <label  style="margin-top: 30px; color: rgb(130, 130, 130)">Observaciones</label>
        <textarea class="form-control" name="observaciones" cols="40" rows="4" style="margin-top: 0px;" placeholder="Ingrese observaciones aquí"></textarea>

    </div>

    

</div>
<div class="col-12 center" style="text-align: center; margin-top: 100px">
        <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Confirmar" style="width: 150px;"/>
    </div>
</form>
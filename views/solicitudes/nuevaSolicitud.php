<div class="row col-12">
    <div class="col-lg-6 center">
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Número SR</label>
        <input type="number" class="form-control" style="margin-top: 0px;" placeholder="Ingrese el número SR">

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
        <select name="gastos_inversiones" class="form-control">
				<option value="1" selected>Bienes de Consumo</option>
				<option value="2">Servicios No Personales</option>
				<option value="3">Bienes de Uso</option>
			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Planificado</label>
        <select name="planificado" class="form-control">
				<option value="Si" selected>Si</option>
				<option value="No">No</option>
			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Tipo de Procedimiento</label>
        <select name="procedimiento" class="form-control">
				<option value="LP" selected>LP - Licitación Pública</option>
				<option value="LA">LA - Licitación Abreviada</option>
				<option value="CD">CD - Compra Directa</option>
                <option value="CE">CE - Compra por Excepción</option>
				<option value="CP">CP - Concurso de Precios</option>
				<option value="PCE">PCE - Procedimientos de Contratación Especiales</option>
				<option value="ARR">ARR - Arrendamiento</option>
				<option value="CCH">CCH - Caja Chica</option>

			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Grupos Art/Serv</label>
        <select name="grupoAS" class="form-control">
				<option value="1" selected>Artículos y Accesorios de Informática</option>
                <option value="2" >Teléfono y Similares</option>
				<option value="3" >Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)</option>
				<option value="4" >Arrendamiento Dispositivos Electrónicos (Tobilleras)</option>
				<option value="5" >Servicios informáticos</option>
				<option value="6" >Equipos de Informática</option>
				<option value="7" >Equipos de Comunicaciones</option>
				<option value="8" >Programas de Computación</option>


			</select> 

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Art/Serv</label>
        <select name="AS" class="form-control">
				


			</select> 

    </div>
    <div class="col-lg-6 center">
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Cantidad</label>
        <input type="number" min="1" value="1" class="form-control" style="margin-top: 0px;" placeholder="Ingrese la cantidad">

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Costo Estimado ($U)</label>
        <input type="number" class="form-control" style="margin-top: 0px;" placeholder="Ingrese el costo estimado de la compra">
        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Oficina Solicitante</label>
        <select name="AS" class="form-control">
		</select> 

        <label  style="margin-top: 30px; color: rgb(130, 130, 130)">Detalle</label>
        <textarea class="form-control" cols="40" rows="4" style="margin-top: 0px;" placeholder="Ingrese un detalle aquí"></textarea>

        <label  style="margin-top: 30px; color: rgb(130, 130, 130)">Observaciones</label>
        <textarea class="form-control" cols="40" rows="4" style="margin-top: 0px;" placeholder="Ingrese observaciones aquí"></textarea>

    </div>

    

</div>
<div class="col-12 center" style="text-align: center; margin-top: 100px">
        <input type="submit" class="btn btn-primary" value="Confirmar" style="width: 150px;"/>
    </div>
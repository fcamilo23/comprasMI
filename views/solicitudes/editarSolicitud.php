<a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>

<div class="row col-12 center" style="background: white; width: 70%; padding: 40px; border: 1px solid rgba(220, 220, 220); border-radius: 5px; margin-top: 3%;">
    <div class="col-lg-6 center">
        <form id="verSolicitud" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

        <input type="number" id="id" name="id" class="form-control" value="<?php echo $_SESSION['solicitudActual']['id']; ?>" style="margin-top: 0px; display:none" placeholder=""   >



        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">SR</label>
        <input type="text" id="sr" name="sr" class="form-control" value="<?php echo $_SESSION['solicitudActual']['SR']; ?>" style="margin-top: 0px;" placeholder=""  >
        <input type="text" id="srActual" name="srActual" class="form-control" value="<?php echo $_SESSION['solicitudActual']['SR']; ?>" style="display:none" placeholder=""  >


        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
        <select name="gastos_inversiones" class="form-control"  >
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Bienes de Consumo"){?> selected <?php } ?> value="Bienes de Consumo">Bienes de Consumo</option>
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Servicios No Personales"){?> selected <?php } ?> value="Servicios No Personales">Servicios No Personales</option>
				<option <?php if ($_SESSION['solicitudActual']['gastos_inversiones'] == "Bienes de Uso"){?> selected <?php } ?> value="Bienes de Uso">Bienes de Uso</option>
			</select> 

   

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Grupos Art/Serv</label>
        <!--
        <select name="grupoAS" class="form-control" readonly >
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Artículos y Accesorios de Informática"){?> selected <?php } ?> value="Artículos y Accesorios de Informática" selected>Artículos y Accesorios de Informática</option>
                <option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Teléfono y Similares"){?> selected <?php } ?> value="Teléfono y Similares" >Teléfono y Similares</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)"){?> selected <?php } ?> value="Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)" >Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Arrendamiento Dispositivos Electrónicos (Tobilleras)"){?> selected <?php } ?> value="Arrendamiento Dispositivos Electrónicos (Tobilleras)" >Arrendamiento Dispositivos Electrónicos (Tobilleras)</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Servicios informáticos"){?> selected <?php } ?> value="Servicios informáticos" >Servicios informáticos</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Equipos de Informática"){?> selected <?php } ?> value="Equipos de Informática" >Equipos de Informática</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Equipos de Comunicaciones"){?> selected <?php } ?> value="Equipos de Comunicaciones" >Equipos de Comunicaciones</option>
				<option <?php if ($_SESSION['solicitudActual']['grupoAS'] == "Programas de Computación"){?> selected <?php } ?> value="Programas de Computación" >Programas de Computación</option>


			</select> -->

        <input type="text" name="grupoAS" class="form-control"  value="<?php echo $_SESSION['solicitudActual']['grupoAS'] ?>" required readonly >


        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Art/Serv</label>
        <input type="text" name="artServ" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['artServ'] ?>" required readonly placeholder="Ingrese el artículo/servicio" >


 


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

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Referente de Compra *</label>
        <input type="text" name="referente" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['referente'] ?>"  >
        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Contacto Referente *</label>
        <input type="text" name="contactoReferente" class="form-control" style="margin-top: 0px;" value="<?php echo $_SESSION['solicitudActual']['contactoReferente'] ?>"  >
        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130); font-size:20px">Fecha de Emisión: <?php echo $_SESSION['solicitudActual']['fechaHora'] ?></label>
        <input type="text" name="fechaHora" class="form-control" style="margin-top: 0px; display:none" value="<?php echo $_SESSION['solicitudActual']['fechaHora'] ?>"  >
        


    </div>
    <div class="col-lg-6 center">
        <!--<label  style="margin-top: 20px; color: rgb(130, 130, 130)">Cantidad</label>
        <input type="number" name="cantidad" min="1" value="<?php echo $_SESSION['solicitudActual']['cantidad'] ?>" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese la cantidad" >
        -->
        



        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Costo Estimado ($U) *</label>
        <input type="number" name="costo" id="costo" class="form-control" style="margin-top: 0px;" placeholder="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"  value="<?php echo $_SESSION['solicitudActual']['costoAprox'] ?>"   >
        

        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Tipo de Procedimiento</label>
        <select name="procedimiento" class="form-control" >
                <option value="---" selected>Aún no definido</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "LP"){?> selected <?php } ?> value="LP">LP - Licitación Pública</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "LA"){?> selected <?php } ?> value="LA">LA - Licitación Abreviada</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "CD"){?> selected <?php } ?> value="CD">CD - Compra Directa</option>
                <option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "CE"){?> selected <?php } ?> value="CE">CE - Compra por Excepción</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "CP"){?> selected <?php } ?> value="CP">CP - Concurso de Precios</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "PCE"){?> selected <?php } ?> value="PCE">PCE - Procedimientos de Contratación Especiales</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "ARR"){?> selected <?php } ?> value="ARR">ARR - Arrendamiento</option>
				<option <?php if ($_SESSION['solicitudActual']['procedimiento'] == "CCH"){?> selected <?php } ?> value="CCH">CCH - Caja Chica</option>

			</select> 


        
        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Planificado</label>
        <select name="planificado" class="form-control">
				<option <?php if ($_SESSION['solicitudActual']['planificado'] == "Si"){?> selected <?php } ?> value="Si" selected>Si</option>
				<option <?php if ($_SESSION['solicitudActual']['planificado'] == "No"){?> selected <?php } ?> value="No">No</option>
			</select> 


        <label  style="margin-top: 40px; color: rgb(130, 130, 130)">Oficina Solicitante</label>
        <select name="oficinaSolicitante" style="" class="form-control">
                
                <?php foreach($viewmodel as $item) : ?>
                <option <?php $ofi = $item['unidad'] . ' ' . $item['ue']; if($_SESSION['solicitudActual']['oficinaSolicitante'] == $ofi){ ?> selected <?php } ?>value="<?php echo $ofi ?>" ><?php echo $ofi ?></option>
                <?php endforeach; ?>
            </select> 

        <label  style="margin-top: 30px; color: rgb(130, 130, 130)">Detalle</label>
        <textarea class="form-control" name="detalle" cols="40" rows="5" style="margin-top: 0px;" placeholder="Ingrese un detalle aquí" required><?php echo $_SESSION['solicitudActual']['detalle'] ?> </textarea>

        <label  style="margin-top: 30px; color: rgb(130, 130, 130)">Observaciones</label>
        <textarea class="form-control" name="observaciones" cols="40" rows="5" style="margin-top: 0px;" value="" placeholder="Ingrese observaciones aquí" ><?php echo $_SESSION['solicitudActual']['observaciones'] ?></textarea>

       
    </div>
    <div class="col-12 center" style="text-align: center; margin-top: 60px">
        <input type="submit" id="guardar" name="submit" class="btn btn-primary" value="Guardar Cambios" style="display: none; width: 150px;"/> 
        <input type="button" id="alertCambios" name="submit" class="btn btn-primary" value="Guardar Cambios" style="width: 150px;" onclick="alertAddCambios()" /> 

    </div>

    <h3 style="margin-top: 100px">Items</h3>
                        <table style="background: #b4bacc">
                            <thead style="background: #172033">
                                <tr>
                                    <th style="width: 7%">Cantidad</th>
                                    <th style="width: 30%">Unidad</th>
                                    <th>Descripcion</th>
                                    <th style="width: 3%"></th>

                                </tr>
                            </thead>
                                    <tr class="tclass">
                                        <td><input type="number" class="form-control" name="cant" id="cant" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" ></td>
                                        <td><input class="form-control" name="uni" id="uni" type="text"></td>
                                        <td><textarea class="form-control" name="desc" id="desc" rows="1" type="text"></textarea></td>
                                        <td><input type="button" id="alerta" class="btn btn-primary" onclick="alertAddItem()" value="+"></input></td>
                                        <input style="display: none" type="submit" id="add" name="submit"  class="btn btn-primary" value="+"></input>

                                        
                                        

                                    </tr>

                                    
                                    <?php if($_SESSION['items'] != NULL){ 
                                        
                                    foreach($_SESSION['items'] as $item) : ?>
                                    <tr class="tclass">
                                        <td>
                                        <!--<input style="display:none" class="form-control" type="text" name="id1" readonly value="<?php echo $item['id'] ?>">-->
    
                                        <input  class="form-control" type="text" name="cant1" readonly value="<?php echo $item['cantidad'] ?>"></td>
                                        <td><input class="form-control" type="text" name="uni1" readonly value="<?php echo $item['unidad'] ?>"></td>
                                        <td><textarea class="form-control" rows="1" name="desc1" readonly type="text"><?php echo $item['descripcion'] ?></textarea></td>
                                        <td><input type="button" style="color: white;" id=""  class="btn btnEliminar" onclick="alertDeleteItem(<?php echo $item['id']; ?>)" value="×" <?php if(count($_SESSION['items']) <= 1){?> disabled <?php } ?>  ></input>
                                        <input style="display:none" type="submit" id="delete" name="submit" class="btn btnEliminar" value="×"  <?php if(count($_SESSION['items']) <= 1){?> disabled <?php } ?>></input></td>
                                    
                                        
                                        
                                    </tr>

                                    <?php endforeach; } ?>
                                    <input style="display:none" id="id1" name="id1" type="text" value="">
                                    
                                    

                            <tbody>

                            </tbody>
                        </table>

  

</div>

</form>


<script>
    $(document).ready(function(){
    $('#alerta').attr('disabled',true);
    $('#cant, #uni').keyup(function(){
        if($('#cant').val().length !=0 && $('#uni').val().length !=0)
            $('#alerta').attr('disabled', false);            
        else
            $('#alerta').attr('disabled',true);
    })
});



/*
 const items = document.getElementById("index");
    const g = document.getElementById("gastos_inversiones");
    const p = document.getElementById("planificado");
    const o = document.getElementById("oficinaSolicitante");
    const r = document.getElementById("referente");
    const cr = document.getElementById("contactoReferente");
    const c = document.getElementById("costo");
    const gr = document.getElementById("grupoAS");
    const a = document.getElementById("artServ");

    if(g.value != "0" && p.value != "0" && o.value != "0" && r.value != "" && cr.value != "" && c.value != "" && gr.value != "0" && a.value != "" && items != null){
*/
function addItem(){
    document.getElementById('add').click();
}

function deleteItem(){
    document.getElementById('delete').click();
}


function alertAddItem(){
    Swal.fire({
            title: 'Desea confirmar este ítem?',
            text: "Se efectuarán los cambios una vez confirme",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, cancelar!',
            confirmButtonText: 'Si, confirmar!'
            }).then((result) => {
        if (result.isConfirmed) {

            
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '',
                showConfirmButton: false,
                timer: 700
                })

            const myTimeout = setTimeout(addItem, 700);

        }
})



}

//DESACTIVAR ENTER PARA ESTOS INPUT
var input = document.getElementById("cant");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});
var input = document.getElementById("uni");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});
var input = document.getElementById("desc");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});


var input = document.getElementById("costo");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});

//-----------------------------------------------

//DESACTIVAR ENTER PARA ESTOS INPUT
$('#verSolicitud').on('keypress', 'input', function(event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			if ('You want enter2tab') {
				$(this).next('input').focus();
			} else { // Just disable enter key
				return false;
			}
		} else {
			return true;
		}
	});
//-----------------------------------------------

//DESACTIVAR ENTER PARA ESTOS INPUT
$('#editarSoli').on('keypress', 'input', function(event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			if ('You want enter2tab') {
				$(this).next('input').focus();
			} else { // Just disable enter key
				return false;
			}
		} else {
			return true;
		}
	});
//-----------------------------------------------

function alertDeleteItem(id){
    //e.preventDefault();

     Swal.fire({
            title: 'Seguro que desea eliminar este ítem?',
            text: "Se efectuarán los cambios una vez confirme",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, cancelar!',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById('id1').value = id;
            document.getElementById('delete').click();

            //alert(id);
            //document.getElementById('editarSoli').submit();

            //form.submit();

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Perfecto!',
                text: 'Se ha eliminado el ítem',
                showConfirmButton: false,
                timer: 700
                })

          
        }else{
            return false;
        }
})
}




function alertAddCambios(){
    Swal.fire({
            title: 'Seguro que desea guardar la edición?',
            text: "Se efectuarán los cambios una vez confirme",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, cancelar!',
            confirmButtonText: 'Si, confirmar!'
            }).then((result) => {
        if (result.isConfirmed) {

            document.getElementById("guardar").click();


            

          
        }
})
}



</script>
<?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>


<form id="filtro" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       

<dialog class="divfiltros center" id="modalconfirmar" style="z-index: 1; animation: createBox .15s; margin-top: 30%;">
<h2 class="" style="display: inline-block; ">Desea confirmar la nueva solicitud?</h2>

           <label type="submit" name="submit"  class="btn sombraAzul center " style="color:white; float:right; margin-right: 2%; width: 100px; margin-top:40px; background: #001d5a" >Cancelar</label>
           <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Confirmar" onclick="const myTimeout = setTimeout(document.getElementById('confirm').click(), 1500"; style="color:white; float:right; margin-right: 4%; width: 100px; margin-top:40px; background: #999999"/>
 
</dialog>


</form>





    

<a href="<?php echo ROOT_URL; ?>solicitudes/listaSolicitudes"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>
<div class="row col-12 center" style="background: white; width: 70%; padding: 40px; border: 1px solid rgba(220, 220, 220); border-bottom: none; border-radius: 5px; margin-top: 3%" >
    <h1 class="center " style="text-align: center; color: #001d5a">Nueva Solicitud</h1>
</div>
<div class="row col-12 center" style="background: white; width: 70%; padding: 40px; border: 1px solid rgba(220, 220, 220); border-radius: 5px; border-top: none; " >
    <div class="col-lg-6 center borderright">
        <form id="nuevaSolicitud" name="nuevaSolicitud" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        
    <div style=" padding: 20 40; background: rgb(239,239,239); border-radius: 5px">
        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">SR</label>
        <input type="text" value="<?php if(isset($_SESSION['solicitud']['sr'])) {  echo $_SESSION['solicitud']['sr']; }?>"  name="sr" id="sr" class="form-control" style="margin-top: 0px;"  >

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Gastos e Inversiones</label>
        <label  style=" color: red">*</label>
        <select name="gastos_inversiones" id="gastos_inversiones" class="form-control">
                <option value="0" selected>-</option>

                <option <?php if(isset($_SESSION['solicitud']['gastos_inversiones'])){if($_SESSION['solicitud']['gastos_inversiones'] == "Bienes de Consumo") { ?> selected <?php }} ?> value="Bienes de Consumo" >Bienes de Consumo</option>
				<option <?php if(isset($_SESSION['solicitud']['gastos_inversiones'])){if($_SESSION['solicitud']['gastos_inversiones'] == "Servicios No Personales") { ?> selected <?php }} ?> value="Servicios No Personales">Servicios No Personales</option>
				<option <?php if(isset($_SESSION['solicitud']['gastos_inversiones'])){if($_SESSION['solicitud']['gastos_inversiones'] == "Bienes de Uso") { ?> selected <?php }} ?> value="Bienes de Uso">Bienes de Uso</option>
			</select> 

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Planificado</label>
        <label  style=" color: red">*</label>
        <select name="planificado" id="planificado" class="form-control" style="margin-bottom:45px">
				<option <?php if(isset($_SESSION['solicitud']['planificado'])){if($_SESSION['solicitud']['planificado'] == "Si") { ?> selected <?php }} ?> value="Si">Si</option>
				<option <?php if(isset($_SESSION['solicitud']['planificado'])){if($_SESSION['solicitud']['planificado'] == "No") { ?> selected <?php }} ?> value="No">No</option>
			</select> 

        <h1 style="display:none"><label  style="margin-top: 20px; color: rgb(130, 130, 130)">Costo Estimado ($U)</label>
        <input type="number" name="costo" id="costo" min="0"  value="<?php if(isset($_SESSION['solicitud']['costo'])) {  echo $_SESSION['solicitud']['costo']; }?>" class="form-control" style="margin-top: 0px; margin-bottom: 40px;" placeholder="" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" > 
        </h1>
    </div>
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





        

       
    <div style="padding: 40px; margin-top: 30px; padding-top: 40px; background: rgb(239,239,239); border-radius: 5px">
        <label  style=" color: rgb(130, 130, 130)">Unidad Ejecutora</label>
        <label  style=" color: red">*</label>

            <select name="oficinaSolicitante" id="oficinaSolicitante" style="" class="form-control">
                <option value="0" selected>-</option>
                <?php
                foreach($viewmodel as $item) : $oficina = $item['unidad'] . ' ' . $item['ue'];
                
                ?>
                <option <?php if(isset($_SESSION['solicitud']['oficinaSolicitante'])){if($_SESSION['solicitud']['oficinaSolicitante'] == $oficina) { ?> selected <?php }} ?>  value="<?php echo $oficina ?>" ><?php echo $oficina ?></option>
                <?php endforeach; ?>
            </select> 

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">UO</label>
        <input type="text" name="uo" id="UO" value="<?php if(isset($_SESSION['solicitud']['uo'])) {  echo $_SESSION['solicitud']['uo']; }?>" class="form-control" style="margin-top: 0px;"   >


        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Referente</label>
        <input type="text" name="referente" id="referente" value="<?php if(isset($_SESSION['solicitud']['referente'])) {  echo $_SESSION['solicitud']['referente']; }?>" class="form-control" style="margin-top: 0px;"   >

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Contacto Referente</label>
        <input type="text" name="contactoReferente" id="contactoReferente"  value="<?php if(isset($_SESSION['solicitud']['contactoReferente'])) {  echo $_SESSION['solicitud']['contactoReferente']; }?>" class="form-control" style="margin-top: 0px; margin-bottom: 30px"   >
				
        </div>


    </div> 
    <div class="col-lg-6 center borderleft">
        <!--
        <label style="margin-top: 20px; color: rgb(130, 130, 130)">Cantidad | Unidad</label>
        <div class="input-group">

        <input style="width: 18%; border-right: 3px solid grey"type="number" name="cantidad" min="1"  class="form-control" style="margin-top: 0px;" required placeholder="Cantidad">
        <input style="width: 80%; border-left: 3px solid grey"type="text" name="unidad" class="form-control" style="margin-top: 0px;" required placeholder="Ingrese la unidad">
        </div>-->

        
    <div style="padding: 20 40;  background: rgb(239,239,239); border-radius: 5px" class="mar">
        <label  id="pp" style="margin-top: 20px; color: rgb(130, 130, 130)">Grupos Art/Serv</label>
        <label  style=" color: red">*</label>
        <select name="grupoAS" id="grupoAS" onchange="arts(this);" class="form-control">
                <option value="0" selected>-</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Artículos y Accesorios de Informática"){?> selected <?php }} ?> value="Artículos y Accesorios de Informática" >Artículos y Accesorios de Informática</option>
                <option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Teléfono y Similares"){?> selected <?php }} ?> value="Teléfono y Similares" >Teléfono y Similares</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)"){?> selected <?php }} ?> value="Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)" >Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Arrendamiento Dispositivos Electrónicos (Tobilleras)"){?> selected <?php }} ?> value="Arrendamiento Dispositivos Electrónicos (Tobilleras)" >Arrendamiento Dispositivos Electrónicos (Tobilleras)</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Servicios informáticos"){?> selected <?php }} ?> value="Servicios informáticos" >Servicios informáticos</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Equipos de Informática"){?> selected <?php }} ?> value="Equipos de Informática" >Equipos de Informática</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Equipos de Comunicaciones"){?> selected <?php }} ?> value="Equipos de Comunicaciones" >Equipos de Comunicaciones</option>
				<option <?php if(isset($_SESSION['solicitud']['grupoAS'])){if($_SESSION['solicitud']['grupoAS'] == "Programas de Computación"){?> selected <?php }} ?> value="Programas de Computación" >Programas de Computación</option>


			</select> 


        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Art/Serv</label>
        <label  style=" color: red">*</label>
        <select name="artServ" id="artServ" style=" margin-bottom: 30px;" onchange="cambiarinput(value);" class="form-control" placeholder="-">

        </select>
        <input type="text" style="display:none"  name="inputas" value="<?php if(isset($_SESSION['solicitud']['inputas'])){ echo $_SESSION['solicitud']['inputas']; } ?>"  id="inputas">
        </div>

        <div style="padding: 45 40; margin-top: 20px;  background: rgb(239,239,239); border-radius: 5px">
         <!--<label  style=" color: rgb(130, 130, 130); display: block">Tipo de Procedimiento                     Número           Año </label>-->
         <label  style=" color: rgb(130, 130, 130); display: block">Tipo de Procedimiento                     Número           Año </label>

        <!-- Todos estos if son para el momento de agregar items, que inevitablemente se recarga la pagina y con estos if conservamos los datos ya ingresados en el formulario -->
        <select name="procedimiento" id="procedimiento"  class="form-control" style="width: 50%; display: inline-block" onchange="habilitarProcedimiento(this)">
                <option value="---" >Aún no definido</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "LP"){?> selected <?php }} ?> value="LP">LP - Licitación Pública</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "LA"){?> selected <?php }} ?> value="LA">LA - Licitación Abreviada</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "CD"){?> selected <?php }} ?> value="CD">CD - Compra Directa</option>
                <option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "CE"){?> selected <?php }} ?> value="CE">CE - Compra por Excepción</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "CP"){?> selected <?php }} ?> value="CP">CP - Concurso de Precios</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "PCE"){?> selected <?php }} ?> value="PCE">PCE - Procedimientos de Contratación Especiales</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "ARR"){?> selected <?php }} ?> value="ARR">ARR - Arrendamiento</option>
				<option <?php if(isset($_SESSION['solicitud']['procedimiento'])){if($_SESSION['solicitud']['procedimiento'] == "CCH"){?> selected <?php }} ?> value="CCH">CCH - Caja Chica</option>

			</select> 
           

            <input type="number" name="numProcedimiento" id="numProcedimiento" value="<?php if(isset($_SESSION['solicitud']['numProcedimiento'])) {  echo $_SESSION['solicitud']['numProcedimiento']; }?>"   class="form-control" style="margin-top: 0px; width: 20%; display: inline-block"   onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
            <input type="number" name="anioProcedimiento" id="anioProcedimiento" value="<?php if(isset($_SESSION['solicitud']['anioProcedimiento'])) {  echo $_SESSION['solicitud']['anioProcedimiento']; }?>"  class="form-control" style="margin-top: 0px; width: 28%; display: inline-block"   onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
    </div>

    <div style="padding: 20 40; background: rgb(239,239,239); border-radius: 5px; margin-top: 30px">


        <label  style="margin-top: 15px; color: rgb(130, 130, 130)">Detalle</label>
        <label  style=" color: red">*</label>
        <textarea class="form-control" name="detalle" id="detalle" cols="40" rows="4" style="margin-top: 0px;" placeholder=""><?php if(isset($_SESSION['solicitud']['detalle'])) {  echo $_SESSION['solicitud']['detalle']; }?></textarea>

        <label  style="margin-top: 20px; color: rgb(130, 130, 130)">Observaciones</label>
        <textarea class="form-control" name="observaciones" cols="40" rows="4" style="margin-top: 0px;" placeholder=""><?php if(isset($_SESSION['solicitud']['observaciones'])) {  echo $_SESSION['solicitud']['observaciones']; }?></textarea>
    </div>
    </div>

    <div class="col-12" style="margin-top: 50px; border-top: 2px solid rgb(200,200,200);">

    </div>

    <div style="display:none" class="col-12 center" style="text-align: center; ">
                                        <input type="submit" id="confirm" name="submit" class="btn btn-primary" value="Confirmar" style="width: 150px;"/>
    </div>


    
<?php 
    if(!isset($_SESSION['solicitud']['procedimiento'])){
        ?>
                <script>
                    document.getElementById('numProcedimiento').readOnly = true;
                    document.getElementById('anioProcedimiento').readOnly = true;

                </script>
            <?php
    }else{
        if($_SESSION['solicitud']['procedimiento'] == '---'){
            ?>
                <script>
                    document.getElementById('numProcedimiento').readOnly = true;
                    document.getElementById('anioProcedimiento').readOnly = true;

                </script>
            <?php

        }
    }
      

?>
  

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


                        <h3 style="margin-top: 70px;display: inline-block">Items</h3>

                        <table style="background: #b4bacc">
                            <thead style="background: #172033">
                                <tr>
                                    <th style="width: 7%">Cantidad</th>
                                    <th style="width: 28%">Unidad</th>
                                    <th>Descripcion</th>
                                    <th style="width: 12%">Total ($U)</th>
                                    <th style="width: 3%"></th>

                                </tr>
                            </thead>
                                    <tr class="tclass">
                                        <td><input class="form-control" name="cant" id="cant" type="number" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"></td>
                                        <td><input class="form-control" name="uni" id="uni" type="text" ></td>
                                        <td><textarea class="form-control" name="desc" id="desc" rows="1" type="text"></textarea></td>
                                        <td><input class="form-control" name="totalItem" id="totalItem" type="text" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" placeholder="$"></td>

                                        <td><input type="submit" id="add" name="submit"  class="btn btn-primary" value="+"></input></td>

                                        
                                        

                                    </tr>
                                    
                                    


                                    

                                    <?php if($_SESSION['items'] != NULL){ 
                                    $indx = 0;
                                    foreach($_SESSION['items'] as $item) : ?>
                                    <tr class="tclass">
                                    <form id="asd" name="asd" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <input style="display:none" type="number" name="index" id="index" value="<?php echo $indx; $indx = $indx + 1; ?>">
                                        <td ><input  class="form-control" type="text" readonly value="<?php echo $item['cantidad'] ?>"></td>
                                        <td><input class="form-control" type="text" readonly value="<?php echo $item['unidad'] ?>"></td>
                                        <td><textarea class="form-control" rows="1" readonly type="text"><?php echo $item['descripcion'] ?></textarea></td>
                                        <td><input class="form-control" type="text" readonly value="<?php echo $item['totalItem'] ?>"></td>
                                        <td><input style="color: white" type="submit" id="delete" name="submit"  class="btn btnEliminar" value="×"></input></td>
                                    </form>

                                        

                                    </tr>
                                    

                                    <?php endforeach; } ?>

                                    

                            <tbody>

                            </tbody>
                        </table>

                       

                        </form>

                

        

                        <div class="col-12 center" style="text-align: center; margin-top: 100px">
                            <input type="submit" id="alerta" name="submit" class="btn btn-primary" value="Confirmar" onclick="mostrarConfirmacion()" style="width: 150px;"/>
                        </div>

</div>

<script>

$(document).ready(function(){
    $('#add').attr('disabled',true);
    $('#cant, #uni, #desc, #totalItem').keyup(function(){
        if($('#cant').val().length !=0 && $('#uni').val().length !=0 && $('#desc').val().length !=0 && $('#totalItem').val().length !=0)
            $('#add').attr('disabled', false);            
        else
            $('#add').attr('disabled',true);
    })
});



$(document).ready(function(){
    const s = document.querySelector("#grupoAS");
    const i = document.querySelector("#artServ");

    cargarSelect(s);

    if(s.value != '0'){
        
    }
   

});


//DESACTIVAR ENTER PARA ESTOS INPUT
var input = document.getElementById("sr");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});
var input = document.getElementById("referente");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});
var input = document.getElementById("contactoReferente");
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
var input = document.getElementById("cant");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});var input = document.getElementById("uni");
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});

//-----------------------------------------------
$(document).ready(function(){
   // const p = document.querySelector("#procedimiento");
    if(p.value == '---'){
        
        document.getElementById('numProcedimiento').disabled = true;
        $('#numProcedimiento').prop('readOnly', true);
        $('#anioProcedimiento').prop('readOnly', true);
    }
   

});

function habilitarProcedimiento(p){
    if(p.value != '---'){
        $('#numProcedimiento').prop('readonly', false);
        $('#anioProcedimiento').prop('readonly', false);
        document.getElementById('boolnum').value = "1";
        document.getElementById('boolanio').value = "1";

    }else{
        document.getElementById('numProcedimiento').value = "";
        document.getElementById('anioProcedimiento').value = "";
        $('#numProcedimiento').prop('readonly', true);
        $('#anioProcedimiento').prop('readonly', true);
        document.getElementById('boolnum').value = "";
        document.getElementById('boolanio').value = "";
    }
}


function mostrarConfirmacion(){
    const items = document.getElementById("index");
    const sr = document.getElementById("sr");
    const g = document.getElementById("gastos_inversiones");
    const p = document.getElementById("planificado");
    const o = document.getElementById("oficinaSolicitante");
    const d = document.getElementById("detalle");
    const gr = document.getElementById("grupoAS");
    const a = document.getElementById("artServ");

    if(g.value != "0" && p.value != "0" && o.value != "0" && d.value != "" && gr.value != "0" && a.value != "" && items != null){
        Swal.fire({
            title: 'Desea confirmar la solicitud de compra?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, cancelar!',
            confirmButtonText: 'Si, confirmar!'
            }).then((result) => {
        if (result.isConfirmed) {

            

            document.getElementById('confirm').click();
            

        }
})
    }else{
                Swal.fire(
                    'Error!',
                    'Debes completar todos los campos y agregar al menos un ítem para completar la solicitud',
                    'warning'
                    )
    }

   

}


function limpiarSelect(){
    /*
    select = document.getElementById('artServ');    
    for (let i = select.options.length; i >= 0; i--) {
        $select.remove(i);
    }*/
    $("#artServ").empty();

}

function cambiarinput(valor){
    inp = document.getElementById('inputas');    
    inp.value = valor;

}


function addoption(opcion){
    inp = document.getElementById('inputas');    
    select = document.getElementById('artServ');    
    var opt = document.createElement('option');
    opt.value = opcion;
    opt.innerHTML = opcion;

    if(inp.value == opcion){
        opt.selected = true;
    }

   
    select.appendChild(opt); 




}


function cargarSelect(gas){

    if(gas.value == '0'){
        limpiarSelect();
        //addoption('-');
    }

    if(gas.value == 'Artículos y Accesorios de Informática'){
        limpiarSelect();
        addoption('Insumos de Informática (toners, cintas, teclados)');
        addoption('Insumos de Comunicaciones (baterías, antenas, cables, etc)');
    }

    if(gas.value == 'Teléfono y Similares'){
        limpiarSelect();
        addoption('Productos y servicios de ANTEL (Tablets, celulares, líneas fijas y móviles, enlaces)');

    }

    if(gas.value == 'Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)'){
        limpiarSelect();
       addoption('Arrendamiento de equipos computación (impresoras, cámaras, etc)'); 
    }

    if(gas.value == 'Arrendamiento Dispositivos Electrónicos (Tobilleras)'){
        limpiarSelect();
        addoption('Arrendamiento de dispositivos (tobilleras, espirómetros)');
    }

    if(gas.value == 'Servicios informáticos'){
        limpiarSelect();
        addoption('Mantenimiento de Software correctivo/evolutivo');
        addoption('Licencias de Software suscripción anual');
        addoption('Soporte Técnico a Plataformas de Software');
        addoption('Soporte Técnico a Plataformas de Hardware');
    }

    if(gas.value == 'Equipos de Informática'){
        limpiarSelect();
        addoption('Adquisición equipos Informáticos');
    }

    if(gas.value == 'Equipos de Comunicaciones'){
        limpiarSelect();
        addoption('Adquisición equipos Comunicaciones');
    }

    if(gas.value == 'Programas de Computación'){
        limpiarSelect();
        addoption('Proyectos de Desarrollo de Software a Medida');
        addoption('Licencias de Software perpetuas');
    }

}

function arts(gas) {

    if(gas.value == '0'){
        limpiarSelect();
        addoption('');
    }
    
    if(gas.value == 'Artículos y Accesorios de Informática'){
        limpiarSelect();
        addoption('Insumos de Informática (toners, cintas, teclados)');
        addoption('Insumos de Comunicaciones (baterías, antenas, cables, etc)');
    }

    if(gas.value == 'Teléfono y Similares'){
        limpiarSelect();
        addoption('Productos y servicios de ANTEL (Tablets, celulares, líneas fijas y móviles, enlaces)');

    }

    if(gas.value == 'Arrendamiento de Equipos Computación (Cámara de Video Vigilancia)'){
        limpiarSelect();
       addoption('Arrendamiento de equipos computación (impresoras, cámaras, etc)'); 
    }

    if(gas.value == 'Arrendamiento Dispositivos Electrónicos (Tobilleras)'){
        limpiarSelect();
        addoption('Arrendamiento de dispositivos (tobilleras, espirómetros)');
    }

    if(gas.value == 'Servicios informáticos'){
        limpiarSelect();
        addoption('Mantenimiento de Software correctivo/evolutivo');
        addoption('Licencias de Software suscripción anual');
        addoption('Soporte Técnico a Plataformas de Software');
        addoption('Soporte Técnico a Plataformas de Hardware');
    }

    if(gas.value == 'Equipos de Informática'){
        limpiarSelect();
        addoption('Adquisición equipos Informáticos');
    }

    if(gas.value == 'Equipos de Comunicaciones'){
        limpiarSelect();
        addoption('Adquisición equipos Comunicaciones');
    }

    if(gas.value == 'Programas de Computación'){
        limpiarSelect();
        addoption('Proyectos de Desarrollo de Software a Medida');
        addoption('Licencias de Software perpetuas');
    }
    

    
}








</script>


<?php }else{ ?>
    <script>
    Swal.fire({
        title: '',
        text: "Debes ser usuario Operador o Administrador para registrar una solicitud de compra",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="<?php echo ROOT_URL; ?>";
        }
        })

</script>

<?php } ?>
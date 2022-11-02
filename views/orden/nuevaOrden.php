<?php if($_SESSION['user_data']['rol'] == 'Consultor'){ ?>

<script>
    Swal.fire({
        title: '',
        text: "Debes ser Operador o Administrador para agregar una novedad",
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

<?php }else{ ?>














<?php if($_SESSION['solicitudActual']['SR'] != "" && $_SESSION['solicitudActual']['procedimiento'] != "---" && $_SESSION['solicitudActual']['numProcedimiento'] != "0"  && $_SESSION['solicitudActual']['anioProcedimiento'] != "0" && $_SESSION['solicitudActual']['numProcedimiento'] != ""  && $_SESSION['solicitudActual']['anioProcedimiento'] != "" ) {?>


<script>
    $(document).ready(function() {
    $('#proveedores').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
        ]
    } );
} );


let cant = 0;
function readAsBase64() {

    var files = document.getElementById("loadFile").files;
    if (files.length > 0) {

        var fileToLoad = files[0];
        var fileReader = new FileReader();
        var base64File;

        fileReader.onload = function(event) {
            base64File = event.target.result;

            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "pdf[]");
            input.setAttribute("id", cant+"pdf");
            input.setAttribute("value", base64File);
            document.getElementById("formOrden").appendChild(input);

            var inputName = document.createElement("input");
            inputName.setAttribute("type", "hidden");
            inputName.setAttribute("name", "pdfnombre[]");
            inputName.setAttribute("id", cant+"pdfnombre");
            inputName.setAttribute("value", fileToLoad.name);
            document.getElementById("formOrden").appendChild(inputName);

            var table = document.getElementById("guardado");
            var row = table.insertRow(cant);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = fileToLoad.name;
            cell2.innerHTML = '<button type="button" id="'+cant+'"class="btn btn-danger" onclick="eliminar('+cant+')">Eliminar</button>';   
            cant++;
    
        };
        
        fileReader.readAsDataURL(fileToLoad);
    }
}
 
    function eliminar(id){
        var input = document.getElementById(id+"pdf");
        input.parentNode.removeChild(input);
        var inputName = document.getElementById(id+"pdfnombre");
        inputName.parentNode.removeChild(inputName);
        var table = document.getElementById("guardado");
        table.rows[id].style.display = "none";

    }

</script>
<body>
<form id="formOrden" onsubmit="validarFormulario(event)" action="<?php echo ROOT_URL; ?>orden/agregarOrden" method ="POST" enctype="multipart/form-data" >
<input type="hidden" value="<?php echo $_SESSION['solicitudActual']['procedimiento']." ".$_SESSION['solicitudActual']['numProcedimiento']." - ".$_SESSION['solicitudActual']['anioProcedimiento'] ?>" name="procedimiento">
<div class="container" >
    <div class="row d-flex justify-content-center ">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10" >
            <div class="card" style="margin-bottom: 40px; margin-top: 50px">
                <br>
            <h2 style="color: #001d5a; text-align: center;"class="center">Nueva Orden de Compra</h2>
                <hr style= "margin-bottom: 20px" >
            <div class="card-body " >
                


                            <label for="numero" class="form-label"></label>
                            <div class="input-group  center2">
                                <p class="m-3">Numero<b class="text-danger">*</b></p>
                                <input id="numero" name="numero" min="1" max="9999999"type="number" class="m-2  form-control " required>
                                <p class="m-3" style="margin-left: 200px;" >      Año <b class="text-danger">*</b></p>
                                <input id="anio" name="anio" type="number" min="2010" max="2060" class="m-2 miniinput2 form-control" value="<?php echo date('Y') ?>" required>
                            </div>
                            <div id="numeroAnioError"  style="color:red; min-height:100%; position: static;" ></div>

                            
                            
                       
                            
                            <div class="input-group  mt-3 center2">
                                <p class="m-3">Moneda<b class="text-danger">*</b></p>
                                <select name="moneda"  id="moneda" onchange="cambiarMoneda(this)" class="m-2  form-control" required>
                                        <option id="moneda--" value="" selected disabled="disabled">--</option>
                                        <option value="$ (Pesos Uruguayos)" >$U (Pesos Uruguayos)</option>
                                        <option value="U$S (Dolares)">US$ (Dólares)</option>
                                        <option value="U.I.(Unidades Indexadas)">U.I.(Unidades Indexadas)</option>
                                        <option value="U.R. (Unidades Reajustables)">U.R. (Unidades Reajustables)</option>
                                        <option value="€ (Euro)">€ (Euro)</option>
                                    </select>
                            </div>
                            <div id="monedaError"  class="center2" style="color:red; min-height:100%; position: static;" ></div>
                        <br><br>
                           
                             
                            <div class="input-group center2" >
                            <label for="plazoEntrega" class="m-2 form-label" >  Fecha Entrega<b class="text-danger">*</b></label>
                                <input id="plazoEntrega" name="plazoEntrega" type="date" class="form-control" style="max-width: 15rem" required>
                                <p class="m-2">       Nº Ampliación </p>
                                <input id="numeroAmplicacion" style="width: 2rem" name="numeroAmpliacion" type="text" class="form-control">


                            </div>
                            <div id="plazoEntregaError" style="color:red" class="center2"></div>


                            <label for="numeroAmplicacion" style="margin-top: 10px"></label>
                            <div class="input-group mb-3">
                            </div>
                            
                        </div>

                        <label for="formaPago" class="form-label">              Forma de Pago</label>
                            <textarea id="formaPago" name="formaPago" class="form-control center" style="width: 90%;"></textarea>
                            <br><br>
                    </div>
                </div>
    </div>
</div>

<div class="container"  >
    <div class="row d-flex justify-content-center " >
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10" >
                <div class="card" style="margin-top: 10px; margin-bottom: 50px">    
                    <div class="card-body ">
                            <!-- aqui se va a guardar proveedor -->
                            <input id="idProveedor" name="idProveedor" type="hidden" >
                            <!--  -->
                            <div>
                                <h4>Proveedor: </h4><p id="proveedorNombre" ></p>
                            </div>


                            <hr>
                            <div id="main-container" style="width: 100%; overflow: auto; padding: 25px; max-height: 500px"> <!--  max-height: 800px -->
                            
                                <table id="proveedores"style="width: 100%; background: #b4bacc">
                                    <thead style="background: #172033">
                                        
                                        <tr >
                                            <th>Empresa</th>
                                            <th>Razon Social</th>
                                            <th>R.U.T.</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <tr style="max-height:20px; height:20px"><?php foreach($viewmodel['proveedores'] as $item) : ?>

                                        <td><?php echo $item['empresa'] ?></td>
                                        <td><?php echo $item['razon_social'] ?></td>
                                        <td>
                                            <?php echo $item['rut'] ?>
                                        </td>
                                        <td>
                                           <input type="button" value="✔️" class="btn btn-light" id="este" onclick="confirmarProveedor(<?php echo $item['id']?>, '<?php echo $item['empresa']?>', '<?php echo $item['rut'] ?>', '<?php echo $item['razon_social'] ?>')" >
                                        </td>
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>

                
                <div class="card" style="margin-top: 10px; margin-bottom: 50px">    
                    <div class="card-body ">
                        <h3 style="color: #001d5a; margin-left: 25px" class="">Items</h3>
                        <div id="main-container" style="width: 100%; overflow: auto; padding: 15px; max-height: 800px">

                                <table id="listaItems" style="width: 100%;">

                                    <thead>
                                        
                                        <tr>
                                            <th style="width: 10%">Cantidad</th>
                                            <th style="width: 10%">Unidad</th>
                                            <th style="width: 35%">Descripcion</th>
                                            <th style="width: 10%">Monto</th>
                                            <th style="width: 10%">Servicio</th>
                                            <th style="width: 10%">Inicio</th>
                                            <th style="width: 10%">Fin</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaItems">
                            
                                    </tbody>
                                </table>
                            </div>
                        <hr>
                        <div class="card-body" style="max-width:800px">
                            <label for="nuevoIdItemSolicitud" class=" form-label">                       Agregar Items de la solicitud o nuevos</label>
                            <div class="input-group ">                      
                                <select  name="nuevoIdItemSolicitud" class="form-control" id="nuevoIdItemSolicitud">
                                    <option value="-1">Seleccione Item</option>
                                    <?php foreach($viewmodel['items'] as $item) : ?>
                                    <option id="opcionItem<?php echo $item['id'] ?>" value="<?php echo $item['id'] ?>">
                                        <?php echo $item['cantidad'].' '.$item['unidad'].' '.$item['descripcion']  ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <option value="0">Nuevo Item</option>
                                    
                                </select>
                                <?php foreach($viewmodel['items'] as $item) : ?>
                                    <input type="hidden" id="seleccionItemCantidad<?php echo $item['id'] ?>" value="<?php echo $item['cantidad'] ?>">
                                    <input type="hidden" id="seleccionItemUnidad<?php echo $item['id'] ?>" value="<?php echo $item['unidad'] ?>">
                                    <input type="hidden" id="seleccionItemDescripcion<?php echo $item['id'] ?>" value="<?php echo $item['descripcion'] ?>">
                                    <input type="hidden" id="seleccionItemPrecio<?php echo $item['id'] ?>" value="<?php echo $item['total'] ?>">
                                <?php endforeach; ?>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="abrirModelNuevoItem()">Agregar</button>
                                </div>    
                            </div>
                        </div>
                        <div class="card-body" style="max-width:800px"><br><br>
                            <div class="form-group row">

                                <div class="col-sm-10">
                                <label for="colFormLabel" id="mtotal" class="" style="display: inline-block" >Monto Total</label>
     
                                    <input type="text" name="montoReal" class="form-control miniinput2" style="display: inline-block" id="montoReal" value="0" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card" style="margin-top: 10px">    
                    <div class="card-body ">
                            
                                <h3 style="color: #001d5a; margin-left: 25px" class="">Subir Archivos</h3>
                                <div class="card-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Subir PDF (*No es obligatorio, puede hacerlo mas adelante)</label>
                                    <input class="form-control" id="loadFile" accept="application/pdf" type="file" onchange="readAsBase64()"  width="190px" height="50px"/>
                                </div>

                                <hr>
                                <table style="max-width: 500px" id="guardado">

                                </table>
                                <br>
                        </div>
                   </div>  
                </div> 
        </div> 
        
    </div>
    
</div>



<div class="container" >
    <div class="row d-flex justify-content-center ">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10" >
                    <div class="card text-center" style="margin-top: 40px; margin-bottom: 50px;">                
                        <div class="card-body ">
                            <div >           
                                <a class="ml-2" href="<?php echo ROOT_PATH; ?>solicitudes/verSolicitud"><button type="button"  class="btn btn-secondary ml-3">   Cancelar   </button></a>
                                        
                                <input type="submit" class="float-right btn btn-primary " value="    Guardar    ">
                            </div>
                    </div>
            </div>
        </div>
    </div>
</div>


                            
                            <!--MODAL PROVEEDOR -->
                            <div class="modal" tabindex="-1" role="dialog" id="confirmarProveedor">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">SELECCIÓN PROVEEDOR:</h5>

                                    </div>
                                    <div class="modal-body" id="mensajeProveedor">
                                        
                                    </div>
                                    <div class="modal-footer" id="botonesConfirmarProveedor">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModel()">CANCELAR</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!--MODAL -->

                             <!--MODAL -->
                            <div class="modal" tabindex="-1" role="dialog" id="modalconfirmar">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">CREAR ORDEN:</h5>

                                    </div>
                                    <div class="modal-body" id="mensajeOrden">
                                        <p><b>¿Quiere crear Orden?<b></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">CONFIRMAR</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModel()">CANCELAR</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!--MODAL</form> -->
 </form>

                        <!--MODAL Items -->
                        <dialog class="divfiltros center " id="modalNuevoItem" style="margin-top:50px; z-index: 1; animation: createBox .15s">
                            <div class="card">
                                    <div class="card-body ">

                                            <h3>Agregar Item a la Orden</h3>
                                            
                                            <hr>
                                        <input type="hidden" id="idItemSolicitud">
                                         <div class="input-group">
                                            <label for="cantidadNuevoItem" class=" m-2 form-label" style="font-weight: normal">Cantidad:<b class="text-danger">*</b></label>
                                            <input id="cantidadNuevoItem" type="number" class="miniinput2 form-control">
                                            <div id="cantidadNuevoItem" class="invalid-feedback"></div>
                                            <label for="unidadNuevoItem" class="m-2 form-label" style="font-weight: normal"> Unidad:<b class="text-danger">*</b></label> 
                                            <input id="unidadNuevoItem" type="text" class="miniinput2 form-control">
                                        </div>
                                        <span id="cantidadUnidadItemError" class="center2" style="color:red; position: static;" ></span>
                                        <br>
                                        <label for="descripcionNuevoItem" class="form-label mb-2 " style="font-weight: normal">Descripción<b class="text-danger">*</b></label>
                                            <div class="input-group mb-1 ">
                                                <input id="descripcionNuevoItem" name="descripcionNuevoItem" type="text" class="mb-3 form-control " >
                                                <span id="descripcionNuevoItemError" class="center2" style="color:red; height:100%; " ></span>
                                            </div>
                                        <label for="observacion" class="form-label" style="font-weight: normal">Observación (opcional):</label>
                                            <div class="input-group mb-3">
                                            <textarea id="nuevoObservacionItem" name="nuevoObservacionItem" class="form-control"></textarea>
                                        </div>

                                        <div class="input-group mb-1">
                                            <label for="nuevoPrecioItem" id="mtotal1" class="m-2 form-label" style="font-weight: normal" ><b class="text-danger">*</b></label>
                                            <input class="miniinput2 form-control" id="nuevoPrecioItem" name="nuevoPrecioItem" type="number" min="1" class="m-2 form-control">
                                            <span id="precioError" class="center2" style="color:red; position: static;" ></span>

                                        </div>
                                        <div class="input-group mb-1">
                                            <label for="nuevoTipoItem" class="m-2 form-label" style="font-weight: normal"> Es servicio:<b class="text-danger">*</b></label>
                                            <select onchange="servicio(this)" class="miniinput2 form-control" id="nuevoTipoItem" name="nuevoTipoItem" class="m-2 form-control">
                                                <option value="No" selected>No</option>
                                                <option value="General">General</option>
                                                <option value="Licencia">Licencia</option>
                                            </select>
                                        </div>
                                        <hr>
                                        
                                        <div class="input-group mb-1" >
                                            <label for="entrega" class=" m-2 form-label" style="font-weight: normal">Inicio: </label>
                                            <input id="nuevoInicioItem" name="nuevoInicioItem" type="date" class="miniinput2 form-control" disabled>
                                            <div id="inicioError" class="invalid-feedback"></div>
                                            <label for="fin" class="m-2 form-label" style="font-weight: normal">  Finalización:</label> 
                                            <input id="nuevoFinItem" name="nuevoFinItem" type="date" class="miniinput2 form-control" disabled>
                                        </div>
                                        <span id="fechasError" class="center2"style="color:red; position: static;" ></span>
                                        <hr>
                                    

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrerModelItem()">Cancelar</button>
                                            <button type="button" class="btn btn-primary" onclick="crearItemOden()">Agregar</button>
                                    </div>
                            </div>
                            </dialog>
                            <!--Fin Modal Item -->

</body>
<script>
    let cantItems=0;
    var montoReal=0;

    function servicio(opcion){
        var tipo = opcion.value;

        if(tipo == "General" || tipo == "Licencia"){
            document.getElementById("nuevoInicioItem").disabled = false;
            document.getElementById("nuevoFinItem").disabled = false;
        }else{
            document.getElementById("nuevoInicioItem").disabled = true;
            document.getElementById("nuevoFinItem").disabled = true;
        }
    }

    function abrirModelNuevoItem(){
        var tipoMoneda = document.getElementById("moneda").value;
        if(tipoMoneda == ""){
            comprobarMoneda();
            Swal.fire({
                icon: 'warning',
                html: 'Debe seleccionar una moneda',
              });
              return;
        }

            reiniciarModelItem();
            var itemseleccionado = document.getElementById("nuevoIdItemSolicitud").value;
           if(itemseleccionado > 0){
                var cantidad = document.getElementById("seleccionItemCantidad"+itemseleccionado).value;
                var unidad = document.getElementById("seleccionItemUnidad"+itemseleccionado).value;
                var descripcion = document.getElementById("seleccionItemDescripcion"+itemseleccionado).value;
                
                document.getElementById("idItemSolicitud").value = itemseleccionado;
                document.getElementById("descripcionNuevoItem").value = descripcion;
                document.getElementById("unidadNuevoItem").value = unidad;
                document.getElementById("cantidadNuevoItem").value = cantidad;

            }else{
                if(itemseleccionado == -1){
                    return;
                }
            }
            document.getElementById("mtotal1").innerHTML = "Precio en "+document.getElementById("moneda").value+":<b class='text-danger'>*</b>";
            document.getElementById("modalNuevoItem").showModal();
    }  
    function cambiarMoneda(select){
        document.getElementById("mtotal").textContent = "Monto total en " + select.value + ":";


    }
    function crearItemOden(){
        ///comprobar inputs nombreServico
        var descripcion = document.getElementById("descripcionNuevoItem").value;
        var cantidad = document.getElementById("cantidadNuevoItem").value;
        var unidad = document.getElementById("unidadNuevoItem").value;
        var precio = document.getElementById("nuevoPrecioItem").value;
        var inicio = document.getElementById("nuevoInicioItem").value;
        var fin = document.getElementById("nuevoFinItem").value;
        var tipo = document.getElementById("nuevoTipoItem").value;
        var observacion = document.getElementById("nuevoObservacionItem").value;
        var idItemSolicitud = document.getElementById("idItemSolicitud").value;
        document.getElementById("descripcionNuevoItemError").innerHTML = "";
        document.getElementById("precioError").innerHTML = "";
        document.getElementById("inicioError").innerHTML = "";
        document.getElementById("fechasError").innerHTML = "";
        document.getElementById("cantidadUnidadItemError").innerHTML = "";
        let iniciomostrar=inicio;
        let finmostrar=fin;

        var error=false;

        if(descripcion == ""){
            document.getElementById("descripcionNuevoItemError").innerHTML = "La descripcion no puede estar vacio";
            error=true;
        }
            
        if(precio == ""){
            document.getElementById("precioError").innerHTML = "El precio no puede estar vacio";
            error=true;
        }
        if(unidad == ""){
            document.getElementById("cantidadUnidadItemError").innerHTML = "La unidad no puede estar vacia";
            error=true;
        }
        if(cantidad == "" || cantidad <= 0){
            document.getElementById("cantidadUnidadItemError").innerHTML = "La cantidad no puede estar vacia";
            error=true;
        }
        if(tipo=="General" || tipo=="Licencia"){
            if(inicio == ""){
                document.getElementById("inicioError").innerHTML = "La fecha de inicio no puede estar vacia";
                error=true;
            }
            if(fin == ""){
                document.getElementById("fechasError").innerHTML = "La fecha de fin no puede estar vacia";
                error=true;
            }
            if(inicio > fin){
                document.getElementById("fechasError").innerHTML = "La fecha de inicio no puede ser mayor a la fecha de fin";
                error=true;
            }
        }else{
            inicio = null;
            fin = null;
            iniciomostrar="";
            finmostrar="";
        }

        if(error==false){
            
            var fila=`<tr id="filaItem`+cantItems+`">
					<th style="width: 10%">`+cantidad+`</th>
                    <th style="width: 10%">`+unidad+`</th>
                    <th style="width: 35%">`+descripcion+`</th>
                    <th style="width: 10%">`+precio+`</th>
                    <th style="width: 10%">`+tipo+`</th>
                    <th style="width: 10%">`+iniciomostrar+`</th>
                    <th style="width: 10%">`+iniciomostrar+`</th>
                    <th style="width: 5%"><button type="button" class="btn btn-danger" onclick="quitarItem(`+cantItems+`,`+precio+`)">X</button></th>
                    <input type="hidden" name="itemcantidad[]" id="itemcantidad[]" value="`+cantidad+`" >
                    <input type="hidden" name="itemunidad[]" id="itemunidad[]" value="`+unidad+`">
                    <input type="hidden" name="itemdescripcion[]" id="itemdescripcion[]" value="`+descripcion+`" >
                    <input type="hidden" name="itemprecio[]" id="itemprecio[]" value="`+precio+`" >
                    <input type="hidden" name="itemtipo[]" id="itemtipo[]" value="`+tipo+`" >
                    <input type="hidden" name="iteminicio[]" id="iteminicio[]" value="`+inicio+`" readonly>
                    <input type="hidden" name="itemfin[]" id="itemfin[]" value="`+fin+`" readonly>
                    <input type="hidden" name="itemobservacion[]" id="itemobservacion[]" value="`+observacion+`" readonly>
                    <input type="hidden" name="itemidsolicitud[]"id="itemidsolicitud[]" value="`+idItemSolicitud+`" readonly>
				</tr>`
                cerrerModelItem();
                document.getElementById("tablaItems").innerHTML += fila;
                cantItems++;
                montoReal= parseFloat(montoReal) + parseFloat(precio);
                document.getElementById("montoReal").value = montoReal;
            }
    }
    

    function reiniciarModelItem(){
        document.getElementById("cantidadUnidadItemError").innerHTML = "";
        document.getElementById("descripcionNuevoItemError").innerHTML = "";
        document.getElementById("precioError").innerHTML = "";
        document.getElementById("inicioError").innerHTML = "";
        document.getElementById("fechasError").innerHTML = "";
        document.getElementById("idItemSolicitud").value = "0";
        document.getElementById("descripcionNuevoItem").value="";
        document.getElementById("cantidadNuevoItem").value="";
        document.getElementById("nuevoPrecioItem").value="";
        document.getElementById("nuevoInicioItem").value="";
        document.getElementById("nuevoFinItem").value="";
        document.getElementById("unidadNuevoItem").value="";
        document.getElementById("nuevoObservacionItem").value="";
        document.getElementById("nuevoTipoItem").value="No";
        document.getElementById("nuevoInicioItem").disabled=true;
        document.getElementById("nuevoFinItem").disabled=true;
    }

    function cerrerModelItem(){
        document.getElementById("modalNuevoItem").close();
        reiniciarModelItem();
    }
    function quitarItem(id, monto){
        Swal.fire({
            title: '¿Quitar el Item?',
            text: "¡El item no se guardara!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, quitar!'
        }).then((result) => {
            if (result.isConfirmed) {
                //eliminar el servicio
                montoReal = parseFloat(montoReal) - parseFloat(monto);
                document.getElementById("montoReal").value = montoReal;
                document.getElementById("filaItem"+id).remove();
                
                
                Swal.fire(
                    '¡Eliminado!',
                    'El item ha sido quitado.',
                    'success'
                )
            }
        });

    }

    </script>

    <script>
        ///ESTE SCRIPT MANEJA TODO LO QUE SE REFIERE A PROVEEDOR Y CONTROL SIN SER LOS ITEMS 

    document.getElementById("plazoEntrega").addEventListener("blur", errorPlazoEntrega);
    document.getElementById("numero").addEventListener("blur", comprobarNumero);
    document.getElementById("anio").addEventListener("blur", comprobarNumero);
    
    document.getElementById("moneda").addEventListener("change", function(){
        document.getElementById("mtotal").value = "Monto total en: "+document.getElementById("moneda").value;
    });


    function errorPlazoEntrega(){
        var plazoEntrega = document.getElementById("plazoEntrega").value;

        if(plazoEntrega.length < 1){
            document.getElementById("plazoEntregaError").innerHTML = "              El plazo de entrega es obligatorio ❌" ;
        }
        else{
            document.getElementById("plazoEntregaError").innerHTML = "";
        }
 
    }
    function comprobarMoneda(){
        var moneda = document.getElementById("moneda").value;
        if(moneda == ""){
            document.getElementById("monedaError").innerHTML = "              La moneda es obligatoria ❌" ;
            return true;
        }
        else{
            document.getElementById("monedaError").innerHTML = "";
            return  false;
        }
    }
    function validarFormulario(event){
        comprobarNumero();
        let mensaje ="";
        var idProveedor = document.getElementById("idProveedor").value;
        //por si no selecciona proveedor
        if(idProveedor.length < 1){
            mensaje = "<hr><h4>Debe seleccionar un proveedor </h4><hr>";
            event.preventDefault();
        }
        if(comprobarMoneda()){
            mensaje = "<hr><h4>Debe seleccionar una moneda </h4><hr>"+mensaje;
            event.preventDefault();
        }

        
        var numeroAnioError = document.getElementById("numeroAnioError").innerHTML;
        if(numeroAnioError.length > 1){
            mensaje = "<hr><h4>Ya existe esa orden</h4><hr>"+mensaje;
            event.preventDefault();
        }
        //contar las filas de la tabla de items
        var filas = document.getElementById("tablaItems").rows.length;
        if(filas < 1){
            mensaje = "<hr><h4>Debe agregar al menos un item</h4><hr>"+mensaje;
            event.preventDefault();
        }
        
        if( mensaje.length > 1){
             
                Swal.fire({
                icon: 'error',
                html: mensaje,
            
                });
        return;
        }
        
        //aqui muestra el modal
        if(document.getElementById("modalconfirmar").style.display != "block"){
            event.preventDefault();
            document.getElementById("mensajeOrden").innerHTML = "<p><b>¿Quiere crear Orden?<b></p>";
            event.preventDefault();
            document.getElementById("modalconfirmar").style.display = "block"; 
        }
    }

    //MODAL DE PROVEEEDOR
    function confirmarProveedor (id, empresa, razon, rut) {
        if(document.getElementById("confirmarProveedor").style.display != "block"){
            document.getElementById("mensajeProveedor").innerHTML = "<h4>Confirma el proveedor</h4>"+empresa+"<br><b>Razon Social: </b>"+razon+"<br><b> Rut: </b>"+rut;
            document.getElementById("botonesConfirmarProveedor").innerHTML = "<input class='btn btn-primary' type='button' onclick='seleccionProveedor("+id+",`"+empresa+"`,`"+razon+"`,`"+rut+"`)' value='CONFIRMAR'> <input type='button' class='btn btn-secondary' onclick=cerrarModel() value='CANCELAR'>";
            document.getElementById("confirmarProveedor").style.display = "block";
        }

    }

    function seleccionProveedor(id,empresa,razon_social,rut){

        document.getElementById("confirmarProveedor").style.display = "none";
        document.getElementById("main-container").style.display = "none";
        document.getElementById("idProveedor").value = id;
        document.getElementById("proveedorNombre").innerHTML = empresa ;
    }


    function comprobarNumero(){
        var numero = document.getElementById("numero").value;
        var anio = document.getElementById("anio").value;
        let retorno;
        var parametros = {
            "numero" : numero,
            "anio" : anio,
        };
        $.ajax({
            data: parametros,
            url: 'isValidatedNumero',
            type: "post",
            success: retorno = function(response){
                //aqui si se devuelve no es porque no hay problema
                if(response.includes("true")){
                    
                    document.getElementById("numeroAnioError").innerHTML = "";
                    return true;
                }else{
                    document.getElementById("numeroAnioError").innerHTML = response;
                    return false;
                    
                }
            }
        });
        return retorno;
    }
    function cerrarModel(){
        document.getElementById("confirmarProveedor").style.display = "none";
        document.getElementById("modalconfirmar").style.display = "none";
     }

</script>
<?php } else{ ?>


<script>
    Swal.fire({
        title: 'Ups!',
        text: "La solicitud de compra debe tener 'SR' y un procedimiento definido para poder agregarle una orden de compra",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="<?php echo ROOT_URL; ?>solicitudes/verSolicitud";
        }
        })

</script>



<?php }?>






<?php } ?>
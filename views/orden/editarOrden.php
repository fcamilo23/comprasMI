<script>
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>


<body>
<form onsubmit="validarFormulario(event)" action="<?php echo ROOT_URL; ?>orden/modificarOrden" method ="POST" enctype="multipart/form-data" id="formOrden">

<a href="<?php echo ROOT_URL; ?>orden/verOrden"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>

<div class="container mt-3 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10">
            <div class="card">
                <br>
            <h2 style="color: #001d5a; margin-left: 25px" class="">EDITAR ORDEN</h1>
            <hr>
                <div class="card-body">
                             <!-- aqui se va a guardar proveedor -->
                             <input type="hidden" id="idProveedor" name="idProveedor" value="<?php  echo $viewmodel["orden"]["idProveedor"] ?>" />
                            <!--  -->
                            <div class="input-group mb-3">
                                <p class="m-2">Numero        </p>
                                <input id="numero" name="numero" type="text" class="m-2 miniinput form-control" value=" <?php  echo $viewmodel["orden"]["numero"]?>" readonly>  
                                <p class="m-2">Año:</p>
                                <input id="anio" name="anio" type="text" class="m-2 miniinput form-control"  min="2010" max="2060" value=" <?php  echo $viewmodel["orden"]["anio"] ?>" readonly required>
                            </div>

                            
                            <div class="input-group mb-3">
                                <p class="m-2">Moneda     </p>
                               <select name="moneda"  id="moneda" class="m-2  form-control" style="max-width:300px;" >
                                        <option <?php if ($viewmodel["orden"]["moneda"]== "$ (Pesos Uruguayos)"){?> selected <?php } ?>value="$ (Pesos Uruguayos)" selected>$U (Pesos Uruguayos)</option>
                                        <option <?php if ($viewmodel["orden"]["moneda"]== 'U$S (Dolares)'){?> selected <?php } ?> value="U$S (Dolares)">US$ (Dólares)</option>
                                        <option <?php if ($viewmodel["orden"]["moneda"]== "U.I.(Unidades Indexadas)"){?> selected <?php } ?> value="U.I.(Unidades Indexadas)">U.I.(Unidades Indexadas)</option>
                                        <option <?php if ($viewmodel["orden"]["moneda"]== "U.R. (Unidades Reajustables)"){?> selected <?php } ?> value="U.R. (Unidades Reajustables)">U.R. (Unidades Reajustables)</option>
                                        <option <?php if ($viewmodel["orden"]["moneda"]== "€ (Euro)"){?> selected <?php } ?> value="€ (Euro)">€ (Euro)</option>
                                    </select>
                            </div>
                            <div class="input-group mb-3">
                            <p class="m-2">Nº Amplición</p>
                                <input id="numeroAmpliacion" style="max-width: 20rem" name="numeroAmpliacion" type="text" class="form-control"  value="<?php  echo$viewmodel["orden"]["numeroAmpliacion"] ?>" >
                            </div>

                            <div id="montoRealError" class="center2"style="color:red" ></div>
                            <div class="input-group mb-3">
                            <label for="plazoEntrega" class="m-2 form-label">Fecha Entrega</label>
                                <input id="plazoEntrega" min='2010-01-01' max='2050-01-01' name="plazoEntrega" type="date" class="miniinput2 form-control" value="<?php  echo$viewmodel["orden"]["plazoEntrega"] ?>" required>
                            </div>

                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" style="max-width:800px" name="formaPago" class="form-control"><?php  echo$viewmodel["orden"]["formaPago"] ?></textarea>
                            </div>
                            

                            <hr><hr>
                            <h4 id="proveedorNombre">PROVEEDOR: <?php echo $viewmodel["orden"]["nombreEmpresa"] ?></h4>
                            
                            <div>
                                <input type="button" class="btn btn-success" id="editor" onclick ="mostrarProveedores()" value="CAMBIAR PROVEEDOR">
                            </div>
                            <hr>
                            <div id="main-container" style="width: 100%; overflow: auto; padding: 25px; display:none;"> <!--  max-height: 800px -->

                                <table id="proveedores"style="width: 100%">
                                    <thead>
                                        
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Razon Social</th>
                                            <th>R.U.T.</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <tr><?php foreach($viewmodel['proveedores'] as $item) : ?>

                                        <td><?php echo $item['empresa'] ?></td>
                                        <td><?php echo $item['razon_social'] ?></td>
                                        <td>
                                            <?php echo $item['rut'] ?>
                                        </td>
                                        <td>

                                           <input type="button" value="✔️" class="btn btn-light" id="este" onclick="confirmarProveedor(<?php echo $item['id']?>,' <?php echo $item['empresa']?>',' <?php echo $item['razon_social']?>',' <?php echo $item['rut']?>')" >
                                        </td>
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
  
        </div>
    </div>
</div>

<div class="container mt-3 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10">
            <div class="card">
                <div class="card-body" id="todoItems">

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
                                    <?php 
                                    $i = 0;
                                    $cantidad=0;
                                    $total=0;
                                    foreach($viewmodel['itemsOrden'] as $item) : 
                                    ?>

                                        <tr id="filaItem<?php echo $i;?>">
                                            <th style="width: 10%"><?php echo $item['cantidad'] ?> </th>
                                            <th style="width: 10%"><?php echo $item['unidad'] ?> </th>
                                            <th style="width: 35%"><?php echo $item['descripcion'] ?> </th>
                                            <th style="width: 10%"><?php echo $item['monto'] ?> </th>
                                            <th style="width: 10%"><?php echo $item['esservicio'] ?> </th>
                                            <th style="width: 10%"><?php echo $item['inicio'] ?></th>
                                            <th style="width: 10%"><?php echo $item['fin'] ?> </th>
                                            <th style="width: 5%"><button type="button" class="btn btn-danger" onclick="quitarItemDeLaBase(<?php echo $item['id'] ?>,<?php echo $i ?>,<?php echo $item['monto'] ?> )">X</button></th>
                                        </tr>
                                        <?php $i++; $total += $item['monto'];
                                     endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <hr>
                        <div class="card-body" style="max-width:800px">
                            <label for="nuevoIdItemSolicitud" class=" form-label">Agregar Items de la solicitud o nuevos</label>
                            <div class="input-group mb-1 ">
                                <select  name="nuevoIdItemSolicitud" class="form-control " id="nuevoIdItemSolicitud">
                                    <option value="-1">Seleccione Item</option>
                                    <?php foreach($viewmodel['itemsSolicitud'] as $item) : ?>
                                    <option id="opcionItem<?php echo $item['id'] ?>" value="<?php echo $item['id'] ?>">
                                        <?php echo $item['cantidad'].' '.$item['unidad'].' '.$item['descripcion']  ?>
                                    </option>
                                    <?php endforeach; ?>
                                    <option value="0">Nuevo Item</option>
                                    
                                </select>
                                <?php foreach($viewmodel['itemsSolicitud'] as $item) : ?>
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
                        <div class="card-body" style="max-width:800px">
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label" >Monto Total:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="montoReal" class="form-control miniinput2" id="montoReal" value="<?php echo $total ?>" readonly>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
                <div class="card text-center" style="margin-top: 40px; margin-bottom: 50px;">
                    <div class="card-body" id="todoItems" >
                        <div >           
                            <a class="ml-2" href="<?php echo ROOT_PATH; ?>orden/verOrden"><button type="button" class="btn btn-secondary ml-3">CANCELAR</button></a>

                            <button type="submit" class="float-right btn btn-primary ">GUARDAR</button>
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
                                    <input type="button" value="✔️" class="btn btn-light" id="este" onclick="confirmarProveedor(<?php echo $item['id']?>,' <?php echo $item['empresa']?>',' <?php echo $item['razon_social']?>',' <?php echo $item['rut']?>')" >
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
                                        <h5 class="modal-title">MODIFICAR ORDEN:</h5>

                                    </div>
                                    <div class="modal-body" id="mensajeOrden">
                                        <p><b>¿Editar Orden?<b></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">CONFIRMAR</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModel()">CANCELAR</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!--MODAL -->
                        </form>
                        <dialog class="divfiltros center " id="modalNuevoItem" style="margin-top:50px; z-index: 1; animation: createBox .15s">
                            <div class="card">
                                    <div class="card-body ">

                                            <h3>AGREGAR ITEM</h3>
                                            <hr>
                                        <input type="hidden" id="idItemSolicitud">
                                         <div class="input-group">
                                            <label for="cantidadNuevoItem" class="text-secondary m-2 form-label">Cantidad: </label>
                                            <input id="cantidadNuevoItem" type="number" step="0.01" class="miniinput2 form-control">
                                            <div id="cantidadNuevoItem" class="invalid-feedback"></div>
                                            <label for="unidadNuevoItem" class="text-secondary m-2 form-label"> Unidad:</label> 
                                            <input id="unidadNuevoItem" type="text" class="miniinput2 form-control">
                                        </div>
                                        <span id="cantidadUnidadItemError" class="center2" style="color:red; position: static;" ></span>
                                        <br>
                                        <label for="descripcionNuevoItem" class="text-secondary form-label mb-2 ">Descripción(si tiene cambios)</label>
                                            <div class="input-group mb-1 ">
                                                <input id="descripcionNuevoItem" name="descripcionNuevoItem" type="text" class="m-2 form-control " >
                                                <span id="descripcionNuevoItemError" class="center2" style="color:red; height:100%; " ></span>
                                            </div>
                                        <label for="observacion" class="text-secondary form-label">Observacion (no obligatorio):</label>
                                            <div class="input-group mb-3">
                                            <textarea id="nuevoObservacionItem" name="nuevoObservacionItem" class="form-control"></textarea>
                                        </div>

                                        <div class="input-group mb-1">
                                            <label for="nuevoPrecioItem" class="text-secondary m-2 form-label">Precio: </label>
                                            <input class="miniinput2 form-control" id="nuevoPrecioItem" name="nuevoPrecioItem" type="number" min="1" class="m-2 form-control">
                                            <label for="nuevoPrecioItem" class="text-secondary m-2 form-label">   Es servicio: </label>
                                            <select onchange="servicio(this)" class="miniinput2 form-control" id="nuevoTipoItem" name="nuevoTipoItem" class="m-2 form-control">
                                                <option value="No" selected>No</option>
                                                <option value="General">General</option>
                                                <option value="Licencia">Licencia</option>
                                            </select>
                                        </div>
                                        <span id="precioError" class="center2" style="color:red; position: static;" ></span>
                                        <hr>
                                        
                                        <div class="input-group mb-1" >
                                            <label for="entrega" class="text-secondary m-2 form-label" >Inicio: </label>
                                            <input id="nuevoInicioItem" name="nuevoInicioItem" type="date" class="miniinput2 form-control" disabled>
                                            <div id="inicioError" class="invalid-feedback"></div>
                                            <label for="fin" class="text-secondary m-2 form-label">   Finaliza:</label> 
                                            <input id="nuevoFinItem" name="nuevoFinItem" type="date" class="miniinput2 form-control" disabled>
                                        </div>
                                        <span id="fechasError" class="center2"style="color:red; position: static;" ></span>
                                        <hr>
                                    

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrerModelItem()">CANCELAR</button>
                                            <button type="button" class="btn btn-primary" onclick="crearItemOden()">AGREGAR</button>
                                    </div>
                            </div>
                            </dialog>
</body>
<script>
    let montoReal = <?php echo $total ?>;
    let cantItems = <?php echo $i ?>;

    function quitarItemDeLaBase(id,i,monto){
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

                montoReal = parseFloat(montoReal) - parseFloat(monto);
                document.getElementById("montoReal").value = montoReal;
                document.getElementById("filaItem"+i).remove();

                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "quitarItem[]";
                input.value = id;
                document.getElementById("todoItems").appendChild(input);
                
                Swal.fire(
                    'Quitado!',
                    'El item ha sido quitado.',
                    'success'
                )
            }
        });
    }

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
            reiniciarModelItem();
            var itemseleccionado = document.getElementById("nuevoIdItemSolicitud").value;
           if(itemseleccionado > 0){
                var cantidad = document.getElementById("seleccionItemCantidad"+itemseleccionado).value;
                var unidad = document.getElementById("seleccionItemUnidad"+itemseleccionado).value;
                var descripcion = document.getElementById("seleccionItemDescripcion"+itemseleccionado).value;
                var precio = document.getElementById("seleccionItemPrecio"+itemseleccionado).value;
                document.getElementById("idItemSolicitud").value = itemseleccionado;
                document.getElementById("descripcionNuevoItem").value = descripcion;
                document.getElementById("unidadNuevoItem").value = unidad;
                document.getElementById("cantidadNuevoItem").value = cantidad;
                document.getElementById("nuevoPrecioItem").value = precio;
            }else{
                if(itemseleccionado == -1){
                    return;
                }
            }
           document.getElementById("modalNuevoItem").showModal();
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
            document.getElementById("descripcionNuevoItemError").innerHTML = "El nombre no puede estar vacio";
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
                    <th style="width: 10%">`+finmostrar+`</th>
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
            $(document).ready(function() {
    $('#proveedores').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
        ]
    } );
} );

    document.getElementById("montoReal").addEventListener("blur", errorMonto);
    document.getElementById("plazoEntrega").addEventListener("blur", errorPlazoEntrega);


    function errorMonto(){
        var monto = document.getElementById("montoReal").value;

        if(monto.length < 1){
            document.getElementById("montoRealError").innerHTML = "              El monto es obligatorio ❌";
        }
        else{
            document.getElementById("montoRealError").innerHTML = "";
        }
 
    }

    function errorPlazoEntrega(){
        var plazoEntrega = document.getElementById("plazoEntrega").value;

        if(plazoEntrega.length < 1){
            document.getElementById("plazoEntregaError").innerHTML = "              El plazo de entrega es obligatorio ❌" ;
        }
        else{
            document.getElementById("plazoEntregaError").innerHTML = "";
        }
 
    }
    //evitar mandar formulario si idProveedor esta vacio
    function validarFormulario(event){
        let mensaje ="";
        ///controlar que item tablaItems tenga al men
        var filas = document.getElementById("tablaItems").rows.length;
        if(filas < 1){
            mensaje = "<hr><h4>Debe agregar al menos un item</h4><hr>"+mensaje;
            event.preventDefault();
        }

        if('<?php echo $viewmodel['orden']['servicio'] ?>' == 'si'){
            var fin = document.getElementById("fin").value;
            var inicio = document.getElementById("inicio").value;
            if(fin <= inicio){
                mensaje = "<hr><h4>La fecha de inicio debe ser menor a la fecha de fin </h4><hr>"+mensaje;
                event.preventDefault();
            }
        }
        if( mensaje != ""){
             
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: mensaje,
                
            
                });
                event.preventDefault();
                return;
            
        }
        
        if(document.getElementById("modalconfirmar").style.display != "block"){
            ///muestra mensaje si no selecciona pdf
            document.getElementById("mensajeOrden").innerHTML = "<p><b>¿Quiere crear Orden?<b></p>";
            document.getElementById("modalconfirmar").style.display = "block"; 
            event.preventDefault();
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
        document.getElementById("proveedorNombre").innerHTML ="PROVEEDOR: "+empresa ;
        console.log(empresa);
        console.log(id);
    }
   


    function cerrarModel(){
        document.getElementById("confirmarProveedor").style.display = "none";
        document.getElementById("modalconfirmar").style.display = "none";
    }

    function mostrarProveedores(){
        document.getElementById("main-container").style.display = "block";
    }
</script>



                       
                       

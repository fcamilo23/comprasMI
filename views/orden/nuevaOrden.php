<?php if($_SESSION['solicitudActual']['SR'] != "") {?>


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
<div class="container" >
    <div class="row d-flex justify-content-center ">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8" >
            <div class="card">
                <br>
            <h2 style="color: #001d5a; text-align: center; margin-bottom: 50px" class="center">Nueva Orden de Compra</h2>
                
            <div class="card-body ">
                


                            <label for="numero" class="form-label"></label>
                            <div class="input-group mb-3 center2">
                                <p class="m-3">Numero</p>
                                <input id="numero" name="numero" min="1" max="9999999"type="number" class="m-2 miniinput2 form-control " required>
                                <p class="m-3" style="margin-left: 200px;" >   Año: </p>
                                <input id="anio" name="anio" type="number" min="2010" max="2060" class="m-2 miniinput2 form-control" value="<?php echo date('Y') ?>" required>
                            </div>
                            <div id="numeroAnioError"  style="color:red; min-height:100%; position: static;" ></div>

                            
                            
                       
                            
                            <div class="input-group mb-3 center2">
                                <p class="m-3">Moneda</p>
                                <select name="moneda"  id="moneda" class="m-2  form-control">
                                        <option value="$ (Pesos Uruguayos)" selected>$U (Pesos Uruguayos)</option>
                                        <option value="U$S (Dolares)">US$ (Dólares)</option>
                                        <option value="U.I.(Unidades Indexadas)">U.I.(Unidades Indexadas)</option>
                                        <option value="U.R. (Unidades Reajustables)">U.R. (Unidades Reajustables)</option>
                                        <option value="€ (Euro)">€ (Euro)</option>
                                    </select>
                            </div>
                            <!--<div id="montoRealError" class="center2"style="color:red position: static;" ></div>-->
                        
                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" name="formaPago" class="form-control"></textarea>
                             </div>
                             
                            <div class="input-group mb-3" style="">
                            <label for="plazoEntrega" class="m-2 form-label" >Fecha Entrega</label>
                                <input id="plazoEntrega" name="plazoEntrega" type="date" class="form-control" style="max-width: 15rem" required>
                            </div>
                            <div id="plazoEntregaError" style="color:red" class="center2"></div>


                            <label for="numeroAmplicacion" style="margin-top: 10px"></label>
                            <div class="input-group mb-3">
                            <p class="m-2">Nº Ampliación </p>
                                <input id="numeroAmplicacion" style="max-width: 15rem" name="numeroAmpliacion" type="text" class="form-control">
                            </div>
                        </div>
                    </div>


                <div class="card" style="margin-top: 10px">    
                    <div class="card-body ">
                            <!-- aqui se va a guardar proveedor -->
                            <input id="idProveedor" name="idProveedor" type="hidden" >
                            <!--  -->
                            <div>
                                <h4>Proveedor: </h4><p id="proveedorNombre" ></p>
                            </div>


                            <hr>
                            <div id="main-container" style="width: 100%; overflow: auto; padding: 25px; max-height: 500px"> <!--  max-height: 800px -->

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
                                           <input type="button" value="✔️" class="btn btn-light" id="este" onclick="confirmarProveedor(<?php echo $item['id']?>, '<?php echo $item['empresa']?>', '<?php echo $item['rut'] ?>', '<?php echo $item['razon_social'] ?>')" >
                                        </td>
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
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


<hr>       
<div style="margin-top: 100px">
<h1 style="color: #001d5a; margin-left: 25px" class="">Listado de Items</h1>
<div class="d-flex justify-content-center">
    <input type="submit" onclick="abrirModelNuevoItem()" class="float-right  btn btn-success" value="+ NUEVO ITEM">
</div>

                                <div id="items-conteiner" style="width: 100%; overflow: auto; padding: 25px; max-height: 500px"> <!--  max-height: 800px -->

                                    <table id="items"style="width: 100%">
                                        <thead>
                                            
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Costo</th>
                                                <th>R.U.T.</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        <tr><?php foreach($viewmodel as $item) : ?>

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
                                    <div class="col-12 center" style="text-align: center; margin-top: 60px">

                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <br>
                    <hr>
<div class="container" >
    <div class="row d-flex justify-content-center ">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" >
                    <div class="card">                
                        <div class="card-body ">
                            <div >           
                                <a class="ml-2" href="<?php echo ROOT_PATH; ?>solicitudes/verSolicitud"><button type="button"  class="btn btn-secondary ml-3">CANCELAR</button></a>
    
                                <input type="submit" class="float-right btn btn-primary " value="GUARDAR">
                            </div>
                    </div>
            </div>


        </div>
    </div>
</div>

</form>

<!--
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
            


            

            </tbody>
		</table>
	</div>
</div> -->


                            
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
                                <!--MODAL -->
</form>

                        <!--MODAL Servicio -->
                        <dialog class="divfiltros center " id="modalNuevoItem" style="margin-top:50px; z-index: 1; animation: createBox .15s">
                                
                                    <div class="card-body ">
                                    <label for="nuevoIdItemSolicitud" class="form-label">Item de la solicitud</label>
                                        <div class="input-group mb-1 ">
                                            <select name="nuevoIdItemSolicitud" class="m-2 form-control " id="nuevoIdItemSolicitud">
                                                <option value="-1">Seleccione Item</option>
                                                <?php foreach($viewmodel['items'] as $item) : ?>
                                                <option onclick="agregarItem(<?php echo $item['id'] ?>)" value="<?php echo $item['id'] ?>">
                                                    <?php echo $item['cantidad'].' '.$item['unidad'].' '.$item['descripcion']  ?>
                                                </option>

                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <label for="descripcionNombreItem" class="form-label">Descripción(si tiene cambios)</label>
                                                <div class="input-group mb-1 ">
                                                <input id="descripcionNombreItem" name="descripcionNombreItem" type="text" class="m-2 form-control " >
                                                <input type="button"  class="btn btn-light" value="*">
                                                <span id="descripcionNombreItemError" class="center2" style="color:red; height:100%; " ></span>
                                        </div>
    
                                        <label for="formaPago" class="form-label">Observacion:</label>
                                            <div class="input-group mb-3">
                                            <textarea id="nuevoObservacionServicio" name="nuevoObservacionServicio" class="form-control"></textarea>
                                        </div>

                                        <div class="input-group mb-1">
                                            <label for="nuevoPrecioServicio" class="m-2 form-label">Precio: </label>
                                            <input class="miniinput2 form-control" id="nuevoPrecioServicio" name="nuevoPrecioServicio" type="number" min="1" class="m-2 form-control">
                                            <label for="nuevoPrecioServicio" class="m-2 form-label">   Tipo de servicio: </label>
                                            <select class="miniinput2 form-control" id="nuevoTipoServicio" name="nuevoTipoServicio" class="m-2 form-control">
                                                <option value="General" selected>General</option>
                                                <option value="Licencia">Licencia</option>
                                            </select>
                                        </div>
                                        <span id="precioError" class="center2"style="color:red; position: static;" ></span>
                                        <br>
                                        
                                        <div class="input-group mb-1">
                                            <label for="entrega" class="m-2 form-label">Inicio: </label>
                                            <input id="nuevoInicioServicio" name="nuevoInicioServicio" type="date" class="miniinput2 form-control">
                                            <div id="inicioError" class="invalid-feedback"></div>
                                            <label for="fin" class="m-2 form-label">   Finaliza:</label> 
                                            <input id="nuevoFinServicio" name="nuevoFinServicio" type="date" class="miniinput2 form-control">
                                        </div>
                                        <span id="fechasError" class="center2"style="color:red; position: static;" ></span>

                                    </div>

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModel()">CANCELAR</button>
                                            <button type="button" class="btn btn-primary" onclick="crearServicio()">GUARDAR</button>
                              
                                <br>
                            </dialog>
                            <!--Fin Modal Servicio -->

</body>
<script>
    cantServicios=0;
        function crearServicio(){
        ///comprobar inputs nombreServico
        var nombreServico = document.getElementById("descripcionNombreItem").value;
        var precio = document.getElementById("nuevoPrecioServicio").value;
        var inicio = document.getElementById("nuevoInicioServicio").value;
        var fin = document.getElementById("nuevoFinServicio").value;
        document.getElementById("descripcionNombreItemError").innerHTML = "";
        document.getElementById("precioError").innerHTML = "";
        document.getElementById("inicioError").innerHTML = "";
        document.getElementById("fechasError").innerHTML = "";
        var error=false;
        
        if(nombreServico == ""){
            document.getElementById("descripcionNombreItemError").innerHTML = "El nombre no puede estar vacio";
            document.getElementById("descripcionNombreItem").focus();
            error=true;
        }
            
        if(precio == ""){
            document.getElementById("precioError").innerHTML = "El precio no puede estar vacio";
            document.getElementById("nuevoPrecioServicio").focus();
            error=true;
        }

        if(inicio > fin){
            document.getElementById("fechasError").innerHTML = "El inicio no puede ser mayor al fin";
            document.getElementById("nuevoInicioServicio").focus();
            error=true;
        }
        if(fin == ""){
            document.getElementById("fechasError").innerHTML = "La fecha de fin no puede estar vacia";
            document.getElementById("nuevoInicioServicio").focus();
            error=true;
        }
        if(inicio == ""){
            document.getElementById("fechasError").innerHTML = "La fecha de inicio no puede estar vacia";
            document.getElementById("nuevoFinServicio").focus();
            error=true;
        }
        if(error==false){
            cerrarModel();

                //ingresar codigo html en el div Servicios
                var div = document.getElementById("Servicios");
                var html = `<div id="cardServicio`+cantServicios+`" class="card" >
                                <div class="card-body">
                                    <div class="float-right text-end" >
                                        <input type="button" class="btn btn-danger" onclick="quitarServicio(`+cantServicios+`)" value="x">
                                    </div>
                                    <input type="hidden" name="nombreServicio[]" value="`+nombreServico+`">
                                    <input type="hidden" name="precioServicio[]" value="`+precio+`">
                                    <input type="hidden" name="inicioServicio[]" value="`+inicio+`">
                                    <input type="hidden" name="finServicio[]" value="`+fin+`">
                                    <input type="hidden" name="observacionServicio[]" value="`+document.getElementById("nuevoObservacionServicio").value+`">
                                    <input type="hidden" name="tiposervicio[]" value="`+document.getElementById("nuevoTipoServicio").value+`">
                                    <b><h4 class="card-title mb-2">`+nombreServico+`</h4></b>
                                    <h5 class=" mb-2"><b>Costo:</b>`+precio+`</h5>
                                    <p class="card-text">Del `+inicio+` al`+fin+`</p>
                                </div>
                            </div>
                            <br>`;
                div.innerHTML += html;
                cantServicios++;
                   
                document.getElementById("descripcionNombreItem").value="";
                document.getElementById("nuevoPrecioServicio").value="";
                document.getElementById("nuevoInicioServicio").value="";
                document.getElementById("nuevoFinServicio").value="";
                document.getElementById("nuevoObservacionServicio").value="";
                document.getElementById("nuevoTipoServicio").value="General";
        }

    }

    function quitarServicio(id){

        Swal.fire({
            title: '¿Quitar el servicio?',
            text: "¡El servicio no se guardara!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, quitar!'
        }).then((result) => {
            if (result.isConfirmed) {
                //eliminar el servicio
                var div = document.getElementById("cardServicio"+id);
                div.remove();
                Swal.fire(
                    '¡Eliminado!',
                    'El servicio ha sido quitado.',
                    'success'
                )
            }
        });
    }



    document.getElementById("plazoEntrega").addEventListener("blur", errorPlazoEntrega);

    document.getElementById("numero").addEventListener("blur", comprobarNumero);
    document.getElementById("anio").addEventListener("blur", comprobarNumero);


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
        var idProveedor = document.getElementById("idProveedor").value;
        //por si no selecciona proveedor
        if(idProveedor.length < 1){
            mensaje = "<hr><h4>Debe seleccionar un proveedor </h4><hr>";
            event.preventDefault();
        }

        comprobarNumero();
        //controlar si div numeroAnioError tiene algun mensaje de error
        var numeroAnioError = document.getElementById("numeroAnioError").innerHTML;
        if(numeroAnioError.length > 1){
            //mostrar el mensaje de error igual al de numeroAnioError
            mensaje = "<hr><h4>Ya existe esa orden</h4><hr>"+mensaje;
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
    function abrirModelNuevoItem(){

            document.getElementById("modalNuevoItem").showModal();
    }



    
    function cerrarModel(){
        //cerrar modal de servicio
        document.getElementById("modalNuevoItem").close();
        document.getElementById("confirmarProveedor").style.display = "none";
        document.getElementById("modalconfirmar").style.display = "none";
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

    function agregarItem(id, descripcion, cantidad, unidad, precio){
        var div = document.createElement("div");
        div.setAttribute("class", "card");
        div.setAttribute("id", "cardItem"+id);
        div.innerHTML = "<div class='card-body'><h5 class='card-title'>"+nombre+"</h5><p class='card-text'>Precio: $"+precio+"</p><input type='button' class='btn btn-danger' onclick='eliminarItem("+id+")' value='Eliminar'></div>";
        document.getElementById("items").appendChild(div);
        document.getElementById("modalNuevoItem").close();
    }

    }
</script>
<?php } else{ ?>


<script>
    Swal.fire({
        title: '',
        text: "La solicitud de compra debe tener un SR para poder agregarle una orden de compra",
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

<?php if($_SESSION['solicitudActual']['SR'] != "") {?>


<script>
    $(document).ready(function() {
    $('#proveedores').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
        ]
    } );
} );


    function servicio(){
        var s = document.getElementById("esServicio").checked;

        if(s == true){
            document.getElementById("inicio").readOnly = false;
            document.getElementById("fin").readOnly = false;
            document.getElementById("siservicio").value = "si";

        }
        else{
            document.getElementById("inicio").readOnly = true;
            document.getElementById("fin").readOnly = true;
            document.getElementById("siservicio").value = "no";
            
        }
    }



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
<div class="container" >
    <div class="row d-flex justify-content-center ">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8" >
            <div class="card">
                <br>
            <h2 style="color: #001d5a; text-align: center; margin-bottom: 50px" class="center">Nueva Orden de Compra</h1>
                
            <div class="card-body ">
                
                    <form id="formOrden" onsubmit="validarFormulario(event)" action="<?php echo ROOT_URL; ?>orden/agregarOrden" method ="POST" enctype="multipart/form-data" >

                            <label for="numero" class="form-label"></label>
                            <div class="input-group mb-3 center2">
                                <p class="m-3">Numero</p>
                                <input id="numero" name="numero" min="1" max="9999999"type="number" class="m-2 miniinput2 form-control " required>
                                <p class="m-3" style="margin-left: 200px;" >              Año: </p>
                                <input id="anio" name="anio" type="number" min="2010" max="2060" class="m-2 miniinput2 form-control" value="<?php echo date('Y') ?>" required>
                                <div id="numeroAnioError" style="color:red" ></div>
                            </div>

                            
                            
                       
                            
                            <div class="input-group mb-3 center2">
                                <p class="m-3">Moneda</p>
                                <select name="moneda"  id="moneda" class="m-2 miniinput2 form-control">
                                        <option value="$ (Pesos Uruguayos)" selected>$U (Pesos Uruguayos)</option>
                                        <option value="U$S (Dolares)">US$ (Dólares)</option>
                                        <option value="U.I.(Unidades Indexadas)">U.I.(Unidades Indexadas)</option>
                                        <option value="U.R. (Unidades Reajustables)">U.R. (Unidades Reajustables)</option>
                                        <option value="€ (Euro)">€ (Euro)</option>
                                    </select>
                               <p class="m-3">          Monto:</p>
                                <input id="montoReal" name="montoReal" type="number" min="0"class="m-2 miniinput2 form-control" required>
                            </div>
                            <div id="montoRealError" class="center2"style="color:red" ></div>



                            <label for="procedimiento" style="margin-top: 50px" class="form-label">Tipo de Procedimiento</label>
                            <div class="input-group mb-3">
                                <select id="procedimiento" name="procedimiento" class="form-control">
                                        <option value="LP - Licitación Pública" selected>LP - Licitación Pública</option>
                                        <option value="LA - Licitación Abreviada">LA - Licitación Abreviada</option>
                                        <option value="CD - Compra Directa">CD - Compra Directa</option>
                                        <option value="CE - Compra por Excepción">CE - Compra por Excepción</option>
                                        <option value="CP - Concurso de Precios">CP - Concurso de Precios</option>
                                        <option value="PCE - Procedimientos de Contratación Especiales">PCE - Procedimientos de Contratación Especiales</option>
                                        <option value="ARR - Arrendamiento">ARR - Arrendamiento</option>
                                        <option value="CCH - Caja Chica">CCH - Caja Chica</option>
                                    </select> 
                            </div>

 
                            
                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" name="formaPago" class="form-control"></textarea>
                             </div>
                             
                            <br>

                            <div class="input-group mb-3" style="">
                            <label for="plazoEntrega" class="m-2 form-label" >Fecha Entrega</label>
                                <input id="plazoEntrega" name="plazoEntrega" type="date" class="form-control" style="max-width: 15rem" required>
                            </div>
                            <div id="plazoEntregaError" style="color:red" class="center2"></div>


                            <label for="numeroAmplicacion" style="margin-top: 40px"></label>
                            <div class="input-group mb-3">
                            <p class="m-2">Nº Ampliación </p>
                                <input id="numeroAmplicacion" style="max-width: 15rem" name="numeroAmpliacion" type="text" class="form-control">
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="m-2 form-check-input" onclick="servicio()" type="checkbox" id="esServicio">
                                <label class="m-2 form-check-label" for="inlineCheckbox1">Es Servicio</label>
                                <input id="siservicio" name="siservicio" type="hidden" value="no">
                            </div>    

                            <hr>

                            <div class="input-group mb-3">
                                <label for="entrega" class="m-2 form-label">Inicio Servicio</label>
                                <input id="inicio" name="inicio" type="date" class="miniinput2 form-control" readonly>
                                <div id="inicioError" class="invalid-feedback"></div>
                                <label for="fin" class="m-2 form-label">            Fin Servicio</label> 
                                <input id="fin" name="fin" type="date" class="miniinput2 form-control" readonly>
                            </div>
                            <br>
                            <!-- aqui se va a guardar proveedor -->
                            <input id="idProveedor" name="idProveedor" type="hidden" >
                            <!--  -->
                            <div>
                                <p><b>PROVEEDOR: </b></p><p id="proveedorNombre" ></p>
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
                            </div>
                          
                            <hr>
                            
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
                            <div >           
                                <a class="ml-2" href="<?php echo ROOT_PATH; ?>solicitudes/verSolicitud"><button type="button"  class="btn btn-secondary ml-3">CANCELAR</button></a>
    
                                <input type="submit" class="float-right btn btn-primary " value="GUARDAR">
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
                                <!--MODAL -->
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>

    document.getElementById("numero").addEventListener("blur", errorNumero);
    document.getElementById("anio").addEventListener("blur", errorNumero);
    document.getElementById("montoReal").addEventListener("blur", errorMonto);
    document.getElementById("plazoEntrega").addEventListener("blur", errorPlazoEntrega);

    function errorNumero(){
        var numero = document.getElementById("numero").value;
        var anio = document.getElementById("anio").value;

        if(numero.length < 1 || anio.length < 1){
            if(numero.length < 1 && anio.length < 1){
                document.getElementById("numeroAnioError").innerHTML = "              El numero de orden y año es obligatorio ❌";
            }else {
                if(numero.length < 1){
                    document.getElementById("numeroAnioError").innerHTML = "              El numero de orden es obligatorio ❌";
                }else{
                    document.getElementById("numeroAnioError").innerHTML = "              El campo año es obligatorio entre 2010 y 2050 ❌ ";
                }
            }
        }
        else{
            document.getElementById("numeroAnioError").innerHTML = "";
        }
 
    }


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
        var idProveedor = document.getElementById("idProveedor").value;
        //por si no selecciona proveedor
        if(idProveedor.length < 1){
            
            mensaje = "<hr><h4>Debe seleccionar un proveedor </h4><hr>";
            event.preventDefault();

        }
        //por si ingresa fechas que sean coerente
        var siservicio = document.getElementById("siservicio").value;
        var fin = document.getElementById("fin").value;
        var inicio = document.getElementById("inicio").value;
        if(siservicio == 'si' && fin.length > 1 && inicio.length > 1){
            if(fin <= inicio){
                mensaje = "<hr><h4>La fecha de inicio debe ser menor a la fecha de fin </h4><hr>"+mensaje;
                event.preventDefault();
            }
        }
        if( mensaje.length > 1){
             
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: mensaje,
                
            
                });
        return;
        }
        
        //aqui muestra el modal
        if(document.getElementById("modalconfirmar").style.display != "block"){

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
   


    function cerrarModel(){
        document.getElementById("confirmarProveedor").style.display = "none";
        document.getElementById("modalconfirmar").style.display = "none";
    }
</script>
<?php } else{ ?>


<script>
    Swal.fire({
        title: 'Acceso denegado!',
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

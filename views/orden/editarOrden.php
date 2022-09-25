<script>
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>


<body>
<a href="<?php echo ROOT_URL; ?>orden/verOrden"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>

<div class="container mt-3 mb-3">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10">
            <div class="card">
                <br>
            <h2 style="color: #001d5a; margin-left: 25px" class="">EDITAR ORDEN</h1>
                <div class="card-body">
                <form onsubmit="validarFormulario(event)" action="<?php echo ROOT_URL; ?>orden/modificarOrden" method ="POST" enctype="multipart/form-data" id="formOrden">
                             <!-- aqui se va a guardar proveedor -->
                             <input type="hidden" name="idProveedor" value="<?php  echo $viewmodel["orden"]["idProveedor"] ?>" />
                            <!--  -->
                            <label for="oc" class="form-label">OC</label>
                            <div class="input-group mb-3">
                                <p class="m-2">Numero   </p>
                                <input id="numero" name="numero" type="text" class="m-2 miniinput form-control" value=" <?php  echo $viewmodel["orden"]["numero"]?>" readonly>  
                                <p class="m-2">Año:</p>
                                <input id="anio" name="anio" type="text" class="m-2 miniinput form-control"  min="2010" max="2060" value=" <?php  echo $viewmodel["orden"]["anio"] ?>" readonly required>
                            </div>
                            <br>
                            
                            <div class="input-group mb-3">
                                <p class="m-2">Moneda</p>
                                <input name="moneda"  id="moneda" style="max-width: 15rem" class="m-2 form-control"  value="<?php  echo $viewmodel["orden"]["moneda"] ?>" >
                               <p class="m-2"> Monto:</p>
                                <input id="montoReal" name="montoReal" type="text" class="m-2 miniinput2 form-control"  value="<?php  echo $viewmodel["orden"]["montoReal"] ?>" required>
                                <div id=montoError" class="invalid-feedback"></div>
                            </div>
                            <div id="montoRealError" class="center2"style="color:red" ></div>

                            <br>

                            <label for="procedimiento" class="form-label">Tipo de Procedimiento</label>
                            <div class="input-group mb-3">
                                <select id="procedimiento" name="procedimiento" class="form-control">
                                        <option <?php  if ($viewmodel["orden"]["procedimiento"]== "LP - Licitación Pública") { ?> selected <?php } ?> value="LP - Licitación Pública">LP - Licitación Pública</option>
                                        <option <?php  if ($viewmodel["orden"]["procedimiento"]== "LA - Licitación Abreviada") { ?> selected <?php } ?> value="LA - Licitación Abreviada">LA - Licitación Abreviada</option>
                                        <option <?php  if ($viewmodel["orden"]["procedimiento"]== "CD - Compra Directa") { ?> selected <?php } ?> value="CD - Compra Directa">CD - Compra Directa</option>
                                        <option <?php  if ($viewmodel["orden"]["procedimiento"]== "CE - Compra por Excepción") { ?> selected <?php } ?> value="CE - Compra por Excepción">CE - Compra por Excepción</option>
                                        <option <?php  if ($viewmodel["orden"]["procedimiento"]== "CP - Concurso de Precios") { ?> selected <?php } ?> value="CP - Concurso de Precios">CP - Concurso de Precios</option>
                                        <option <?php  if ($viewmodel["orden"]["procedimiento"]== "PCE - Procedimientos de Contratación Especiales") { ?> selected <?php } ?> value="PCE - Procedimientos de Contratación Especiales">PCE - Procedimientos de Contratación Especiales</option>
                                        <option <?php  if ($viewmodel["orden"]["procedimiento"]== "ARR - Arrendamiento") { ?> selected <?php } ?> value="ARR - Arrendamiento">ARR - Arrendamiento</option>
                                        <option <?php  if ($viewmodel["orden"]["procedimiento"]== "CCH - Caja Chica") { ?> selected <?php } ?> value="CCH - Caja Chica">CCH - Caja Chica</option>
                                    </select> 
                            </div>
                            <br>
                            <div class="input-group mb-3">
                            <label for="plazoEntrega" class="m-2 form-label">Fecha Entrega</label>
                                <input id="plazoEntrega" name="plazoEntrega" type="date" class="miniinput2 form-control" value="<?php  echo$viewmodel["orden"]["plazoEntrega"] ?>" required>
                            </div>
                            <br>
                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" name="formaPago" class="form-control"><?php  echo$viewmodel["orden"]["formaPago"] ?></textarea>
                            </div>
                            <br>
                            <div class="input-group mb-3">
                            <p class="m-2">Nº Amplición</p>
                                <input id="numeroAmpliacion" style="max-width: 20rem" name="numeroAmpliacion" type="text" class="form-control"  value="<?php  echo$viewmodel["orden"]["numeroAmpliacion"] ?>" >
                            </div>
                            <br>

                            <hr>
                            <?php if($viewmodel["orden"]["servicio"] == "si"){ ?>
                            <div class="input-group mb-3">
                                <h3>SERVCICIO</h3>
                                <label for="entrega" class="m-2 form-label">Inicio Servicio</label>
                                <input id="inicio" name="inicio" type="date" class="miniinput2 form-control" value="<?php echo $viewmodel["orden"]["fechaInicio"] ?>" >
                                <div id="inicioError" class="invalid-feedback"></div>
                                <label for="fin" class="m-2 form-label">Fin Servicio</label> 
                                <input id="fin" name="fin" type="date" class="miniinput2 form-control" value="<?php echo $viewmodel["orden"]["fechaFin"] ?>" >
                            </div>
                            <br>
                            <?php } ?>
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

                                           <input type="button" value="✔️" class="btn btn-light" id="este" onclick="seleccionaProveedor(<?php echo $item['id']?>,' <?php echo $item['empresa']?>')" >
                                        </td>
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <hr>
                            <div >           
                                <a class="ml-2" href="<?php echo ROOT_PATH; ?>orden/verOrden"><button type="button" class="btn btn-secondary ml-3">CANCELAR</button></a>
    
                                <button type="submit" class="float-right btn btn-primary ">GUARDAR</button>
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
                                        <h5 class="modal-title">MODIFICAR ORDEN:</h5>

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
       /* var idProveedor = document.getElementById("idProveedor").value;
        //por si no selecciona proveedor
        if(idProveedor.length < 1){
            mensaje = "<hr><h4>Debera seleccionar un proveedor </h4><hr>";
            event.preventDefault();

        }*/
        //por si ingresa fechas que sean coerente
        var fin = document.getElementById("fin").value;
        var inicio = document.getElementById("inicio").value;
        if('<?php echo $viewmodel['orden']['servicio'] ?>' == 'si' && fin.length > 1 && inicio.length > 1){
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
            ///muestra mensaje si no selecciona pdf
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

    function mostrarProveedores(){
        document.getElementById("main-container").style.display = "block";
    }
</script>



                       
                       

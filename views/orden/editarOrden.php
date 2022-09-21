<a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10">
            <div class="card">
                <br>
            <h2 style="color: #001d5a; margin-left: 25px" class="">VER ORDEN</h1>
                <div class="card-body">
                <form action="" id="formOrden"></form>
                            <label for="oc" class="form-label">OC</label>
                            <div class="input-group mb-3">
                                <p class="m-2">Numero   </p>
                                <input id="numero" name="numero" type="text" class="m-2 miniinput form-control" value=" <?php  echo $viewmodel["orden"]["numero"] ?>" readonly> 
                                <p class="m-2">Año:</p>
                                <input id="anio" name="anio" type="text" class="m-2 miniinput form-control"  value=" <?php  echo $viewmodel["orden"]["anio"] ?>" readonly>
                            </div>
                            <br>
                            
                            <div class="input-group mb-3">
                                <p class="m-2">Moneda</p>
                                <input name="moneda"  id="moneda" style="max-width: 15rem" class="m-2 form-control"  value="<?php  echo $viewmodel["orden"]["moneda"] ?>">
                               <p class="m-2"> Monto:</p>
                                <input id="montoReal" name="montoReal" type="text" class="m-2 miniinput2 form-control"  value="<?php  echo $viewmodel["orden"]["montoReal"] ?>">
                                <div id=montoError" class="invalid-feedback"></div>
                            </div>
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
                                <input id="plazoEntrega" name="plazoEntrega" type="date" class="miniinput2 form-control" value="<?php  echo$viewmodel["orden"]["plazoEntrega"] ?>" >
                            </div>
                            <br>
                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" name="formaPago" class="form-control"><?php  echo$viewmodel["orden"]["formaPago"] ?></textarea>
                            </div>

                            <br>
                            <h4 id="proveedorNombre"></h4>
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
                            <div>
                                <button class="btn btn-success" id="editor" onclick ="accion()">CAMBIAR PROVEEDOR</button>
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

    function seleccionaProveedor(id, empresa){

        document.getElementById("main-container").style.display = "none";

        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "editadoIdProveedor";
        input.value = id;
        document.getElementById("formOrden").appendChild(input);

        document.getElementById("proveedorNombre").innerHTML = "PROVEDOR: "+empresa+"";
    }
       
        


    function accion(){
        document.getElementById("main-container").style.display = "block";
        document.getElementById("editor").style.display = "none";
    }







</script>



                       
                       

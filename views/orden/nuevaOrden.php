<script>
    $(document).ready(function() {
    $('#proveedores').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
        ]
    } );
} );

//crear seleccionaProveedor
function seleccionaProveedor(id, empresa){
    //quitar tabla proveedores
    document.getElementById("main-container").style.display = "none";
    //quitar buscador y paginado

    //crear un input hidden con el id del proveedor
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "idProveedor";
    input.value = id;
    document.getElementById("formOrden").appendChild(input);
    //agreagar nombre del proveedor en p proveedorNombre
    document.getElementById("proveedorNombre").innerHTML = empresa; 
    console.log(empresa);
    //agregar boton para volver a seleccionar proveedor

    //crear un boton para volver atras

    }
    //si esServicio es 1, permitir editar inicio y fin
    function esServicio(){
        var esServicio = document.getElementById("esServicio").value;
        if(esServicio == on){
            document.getElementById("inicio").disabled = false;
            document.getElementById("fin").disabled = false;
        }else{
            document.getElementById("inicio").disabled = true;
            document.getElementById("fin").disabled = true;
        }
    }

    


</script>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <br>
            <h2 style="color: #001d5a; margin-left: 25px" class="">Subir Orden</h1>
                
            <div class="card-body">
                
                    <form id="formOrden" action="<?php echo ROOT_URL; ?>proveedor/listaProveedores" method ="POST" enctype="multipart/form-data" >

                            <label for="oc" class="form-label">OC</label>
                            <div class="input-group mb-3">
                                <p class="m-2">Numero   </p>
                                <input id="numero" name="numero" type="text" class="miniinput form-control">
                                <div id=ocError" class="invalid-feedback"></div>
                                <p class="m-2">Año:</p>
                                <input id="anio" name="anio" type="text" class="miniinput form-control" >
                                <div id=ocError" class="invalid-feedback"></div>
                            </div>
                            <br>
                            <label for="procedimiento" class="form-label">Tipo de Procedimiento</label>
                            <div class="input-group mb-3">
                                <select name="procedimiento" class="form-control">
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
                            </div>
                            <br>
                            <div class="input-group mb-3">
                                <p class="m-2">Moneda</p>
                                <select name="moneda"  id="moneda" class="miniinput2 form-control">
                                        <option value="$ (Pesos Uruguayos)" selected>$ (Pesos Uruguayos)</option>
                                        <option value="U$S (Dolares)">U$S (Dolares)</option>
                                        <option value="U.I.(Unidades Indexadas)">U.I.(Unidades Indexadas)</option>
                                        <option value="U.R. (Unidades Reajustables)">U.R. (Unidades Reajustables)</option>
                                        <option value="€ (Euro)">€ (Euro)</option>
                                    </select>
                               <p class="m-2"> Monto:</p>
                                <input id="monto" name="monto" type="number" class="miniinput2 form-control" >
                                <div id=montoError" class="invalid-feedback"></div>
                            </div>
                            <br>    
                            <div class="input-group mb-3">
                            <label for="entrega" class="m-2 form-label">Fecha Entrega</label>
                                <input id="entrega" name="entrega" type="date" class="miniinput2 form-control">
                                <div id="entregaError" class="invalid-feedback"></div>
                            </div>

                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" name="formaPago" class="form-control"></textarea>
                                <div id="telefonoError" class="invalid-feedback"></div>
                            </div>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="m-2 form-check-input"  type="checkbox" id="esServicio">
                                <label class="m-2 form-check-label" for="inlineCheckbox1">Es Servicio</label>
                            </div>    

                            <hr>

                            <div class="input-group mb-3">
                                <label for="entrega" class="m-2 form-label">Inicio Servicio</label>
                                <input id="inicio" name="inicio" type="date" class="miniinput2 form-control" readonly>
                                <div id="entregaError" class="invalid-feedback"></div>
                                <label for="entrega" class="m-2 form-label">Fin Servicio</label> 
                                <input id="fin" name="fin" type="date" class="miniinput2 form-control" readonly>
                            </div>
                            <hr>
                            <div id="main-container" style="width: 100%; overflow: auto; padding: 25px;"> <!--  max-height: 800px -->

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

                                           <input type="button" value="✔️" class="btn btn-light" id="este" onclick="seleccionaProveedor(<?php echo $item['id']?>,' <?php echo $item['empresa']?>')" >
                                        </td>
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
   

                            <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

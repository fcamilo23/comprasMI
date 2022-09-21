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
    input.name = "idProveedor";
    input.value = id;
    document.getElementById("formOrden").appendChild(input);

    document.getElementById("proveedorNombre").innerHTML = empresa ;


    }
    let servicio1 = 1;

    function servicio(){
        var esServicio = document.getElementById("esServicio").value;

        if(servicio1 == 1){
            document.getElementById("inicio").readOnly = false;
            document.getElementById("fin").readOnly = false;
            servicio1 = 0;
            document.getElementById("esServicio").value = "si";

        }
        else{
            document.getElementById("inicio").readOnly = true;
            document.getElementById("fin").readOnly = true;
            servicio1 = 1;
            document.getElementById("esServicio").value = "no";
            
        }
    }

    ////DE ACA TEMAS DE PDF

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

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <br>
            <h2 style="color: #001d5a; margin-left: 25px" class="">Subir Orden</h1>
                
            <div class="card-body">
                
                    <form id="formOrden" action="<?php echo ROOT_URL; ?>orden/agregarOrden" method ="POST" enctype="multipart/form-data" >

                            <label for="oc" class="form-label">OC</label>
                            <div class="input-group mb-3">
                                <p class="m-2">Numero   </p>
                                <input id="numero" name="numero" type="number" class="m-2 miniinput form-control">
                                <div id=ocError" class="invalid-feedback"></div>
                                <p class="m-2">Año:</p>
                                <input id="anio" name="anio" type="number" class="m-2 miniinput form-control" >
                                <div id=ocError" class="invalid-feedback"></div>
                            </div>
                            <br>
                            
                            <div class="input-group mb-3">
                                <p class="m-2">Moneda</p>
                                <select name="moneda"  id="moneda" class="m-2 miniinput2 form-control">
                                        <option value="$ (Pesos Uruguayos)" selected>$ (Pesos Uruguayos)</option>
                                        <option value="U$S (Dolares)">U$S (Dolares)</option>
                                        <option value="U.I.(Unidades Indexadas)">U.I.(Unidades Indexadas)</option>
                                        <option value="U.R. (Unidades Reajustables)">U.R. (Unidades Reajustables)</option>
                                        <option value="€ (Euro)">€ (Euro)</option>
                                    </select>
                               <p class="m-2"> Monto:</p>
                                <input id="montoReal" name="montoReal" type="number" class="m-2 miniinput2 form-control" >
                                <div id=montoError" class="invalid-feedback"></div>
                            </div>
                            <br>

                            <label for="procedimiento" class="form-label">Tipo de Procedimiento</label>
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
                            <br>
 
                            <div class="input-group mb-3">
                            <label for="plazoEntrega" class="m-2 form-label">Fecha Entrega</label>
                                <input id="plazoEntrega" name="plazoEntrega" type="date" class="miniinput2 form-control">
                                <div id="plazoEntregaError" class="invalid-feedback"></div>
                            </div>

                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" name="formaPago" class="form-control"></textarea>
                                <div id="telefonoError" class="invalid-feedback"></div>
                            </div>
                            <br>

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
                                <label for="fin" class="m-2 form-label">Fin Servicio</label> 
                                <input id="fin" name="fin" type="date" class="miniinput2 form-control" readonly>
                            </div>
                            <br>
                            <div>
                                <p><b>PROVEEDOR: </b></p><p id="proveedorNombre" ></p>
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
                            <hr>
                           
                            <hr>
                            
                                <h1 style="color: #001d5a; margin-left: 25px" class="">Subir Archivos</h1>
                                <div class="card-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Default file input example</label>
                                    <input class="form-control" id="loadFile" accept="application/pdf" type="file" onchange="readAsBase64()"  width="190px" height="50px"/>
                                </div>

                                <hr>
                                <table style="max-width: 500px" id="guardado">

                                </table>
                                <br>
                            <div >           
                                <a class="ml-2" href="<?php echo ROOT_PATH; ?>solicitudes/verSolicitud"><button type="button" class="btn btn-secondary ml-3">CANCELAR</button></a>
    
                                <button type="submit" class="float-right btn btn-primary ">GUARDAR</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

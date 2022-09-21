<a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <br>
            <h2 style="color: #001d5a; margin-left: 25px" class="">VER ORDEN</h1>
                
            <div class="card-body">
                
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
                                <input name="moneda"  id="moneda" style="max-width: 15rem" class="m-2 form-control"  value="<?php  echo$viewmodel["orden"]["moneda"] ?>"readonly>
                               <p class="m-2"> Monto:</p>
                                <input id="montoReal" name="montoReal" type="text" class="m-2 miniinput2 form-control"  value="<?php  echo$viewmodel["orden"]["montoReal"] ?>"readonly>
                                <div id=montoError" class="invalid-feedback"></div>
                            </div>
                            <br>

                            <label for="procedimiento" class="form-label">Tipo de Procedimiento</label>
                            <div class="input-group mb-3">
                                <input id="procedimiento" name="procedimiento" class="form-control" value="<?php  echo$viewmodel["orden"]["procedimiento"] ?>" readonly>
                            </div>
                            <br>
                            <div class="input-group mb-3">
                            <label for="plazoEntrega" class="m-2 form-label">Fecha Entrega</label>
                                <input id="plazoEntrega" name="plazoEntrega" type="text" class="miniinput2 form-control" value="<?php  echo$viewmodel["orden"]["plazoEntrega"] ?>" readonly>
                            </div>
                            <br>
                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" name="formaPago" class="form-control" readonly><?php  echo$viewmodel["orden"]["formaPago"] ?></textarea>
                            </div>
                            <br>
                            <hr>
                            <?php if($viewmodel["orden"]["servicio"] == "si"){ ?>
                            <div class="input-group mb-3">
                                <h3>SERVCICIO</h3>
                                <label for="entrega" class="m-2 form-label">Inicio Servicio</label>
                                <input id="inicio" name="inicio" type="date" class="miniinput2 form-control" value="<?php echo $viewmodel["orden"]["fechaInicio"] ?>" readonly>
                                <div id="inicioError" class="invalid-feedback"></div>
                                <label for="fin" class="m-2 form-label">Fin Servicio</label> 
                                <input id="fin" name="fin" type="date" class="miniinput2 form-control" value="<?php echo $viewmodel["orden"]["fechaFin"] ?>" readonly>
                            </div>
                            <br>
                            <?php } ?>
                            <div>
                                <h3>PROVEEDOR: <?php  echo $viewmodel["proveedor"]["empresa"] ?></h3>
                            </div>
                            <div class="col-12 center" style="text-align: center; margin-top: 100px">
                            <a href="<?php echo ROOT_URL; ?>orden/editarOrden" class="float-right btn btn-primary">EDITAR ORDEN</a>
                            </div>
                            <hr>

                            <div id="main-container" style="width: 100%; overflow: auto; padding: 25px;"> <!--  max-height: 800px -->
                                <?php 
                                if ($viewmodel["archivos"] != null) {
                                 
                                ?>
                                <table id="proveedores"style="width: 100%">
                                    <thead>
                                        
                                        <tr>
                                            <th>PDF</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <tr><?php foreach($viewmodel["archivos"] as $item) : ?>

                                        <td><?php echo $item['nombre'] ?></td>
                                        <td>
                                            <form action="<?php echo ROOT_PATH; ?>orden/eliminarArchivo" method="post">
                                                <input type="hidden" name="idArchivo" value="<?php echo $item['id'] ?>">
                                                <input type="submit" name="" value="✖" style="float:right; margin-right: 4%; border: none; color:white;" class="btn btnEliminar sombraRoja"/>
                                            </form> 
                                            <form action="<?php echo ROOT_URL; ?>orden/verArchivo" method="post">
                                                <input type="hidden" name="idArchivo" value="<?php echo $item['id'] ?>">
                                                <input type="submit" name="submit" value="Ver" style="background: #001d5a; width: 100px; float:right; margin-right: 5%; border: none" class="btn btn-primary sombraAzul"/>
                                            </form>
                                         </td>
         
                                       
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                    <h3>No hay archivos</h3>
                                <?php } ?> 
                            </div>
                            <br>
                            <hr>

                            <h3 style="color: #001d5a; margin-left: 25px" class="">Subir Archivos</h3>
                                <div class="card-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Default file input example</label>
                                    <input class="form-control" id="loadFile" accept="application/pdf" type="file" onchange="readAsBase64()"  width="190px" height="50px"/>
                                </div>

                                <hr>
                                <form id="formArchivo" action="<?php echo ROOT_PATH; ?>orden/subirArchivos" method='post'>
                                    <table style="max-width: 500px" id="guardado">
                                
                                    </table>
                                    <button type="submit" class="float-right btn btn-primary ">SUBIR</button>
                                </form>
                                <br>
                                <hr>
                        <a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let cant = 0;
function readAsBase64() {

    var files = document.getElementById("loadFile").files;
    if (files.length > 0) {

        var fileToLoad = files[0];
        var fileReader = new FileReader();
        var base64File;
        // Reading file content when it's loaded
        fileReader.onload = function(event) {
            base64File = event.target.result;

            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "pdf[]");
            input.setAttribute("id", cant+"pdf");
            input.setAttribute("value", base64File);
            document.getElementById("formArchivo").appendChild(input);

            var inputName = document.createElement("input");
            inputName.setAttribute("type", "hidden");
            inputName.setAttribute("name", "pdfnombre[]");
            inputName.setAttribute("id", cant+"pdfnombre");
            inputName.setAttribute("value", fileToLoad.name);
            document.getElementById("formArchivo").appendChild(inputName);

            //crear una tabla para mostrar los archivos
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


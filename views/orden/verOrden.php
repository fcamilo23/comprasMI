<script>

mensajes();

function mensajes(){
    <?php if($_SESSION['mensaje']['tipo'] != '' ) { ?>

            Swal.fire({
            position: 'top-center',
            icon: '<?php echo $_SESSION['mensaje']['tipo']; ?>',
            title: '<?php echo $_SESSION['mensaje']['contenido']; ?>',
            showConfirmButton: false,
            timer: 3000
            });
    <?php 
        $_SESSION['mensaje']['tipo'] = '';
        $_SESSION['mensaje']['contenido'] = '';
        } ?>
    } 
</script>


<body onload="mensajes()">

<!---MODAL---->
<form id="formArchivo" action="<?php echo ROOT_PATH; ?>orden/subirArchivos" method='post'>

    <dialog class="divfiltros center " id="modalSubirArchivo" style="margin-top:50px; z-index: 1; animation: createBox .15s">
 
            <h3 style="color: #001d5a; margin-left: 25px" class="">Subir Archivos</h3>
                <div class="card-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Seleccione archivo</label>
                    <input class="form-control" id="loadFile" accept="application/pdf" type="file" onchange="readAsBase64()"  width="190px" height="50px"/>
                </div>
                <hr>
                    <table style="max-width: 500px" id="guardado">
                    </table>
                    <button type="submit" class="float-right btn btn-primary ">SUBIR</button>
                    <input id="cerrarFiltros2" onclick ="cerrarModal()" type="button" class="float-right btn btn-secondary " value="CERRAR">
    </dialog> 
</form> 
<!---MODAL FIN---->

<a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>


<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
                    <div class="card">
                <br>
            <h2 style="color: #001d5a; margin-left: 25px" class="">VER ORDEN</h1>
                <hr>
                        <div class="card-body">
                        <h4>OC: <?php echo $viewmodel['orden']['numero']; ?> - <?php echo $viewmodel['orden']['anio']; ?></h4>
                        <h4>SR: <?php echo $viewmodel['solicitud']['unidad']; ?></h4>
                        <h4>Aca iria el nuemero de procedimiento</h4>

                    </div>
                    </div>
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-body">
                            
                            <div class="input-group mb-3">
                                <p class="m-2">Moneda</p>
                                <input name="moneda"  id="moneda" style="max-width: 15rem" class="m-2 form-control"  value="<?php  echo$viewmodel["orden"]["moneda"] ?>"readonly>
                               <p class="m-2"> Monto:</p>
                                <input id="montoReal" name="montoReal" type="text" class="m-2 miniinput2 form-control"  value="<?php  echo$viewmodel["orden"]["montoReal"] ?>"readonly>
                                <div id=montoError" class="invalid-feedback"></div>
                            </div>

                            <label for="procedimiento" class="form-label">Tipo de Procedimiento</label>
                            <div class="input-group mb-3">
                                <input id="procedimiento" name="procedimiento" class="form-control" value="<?php  echo$viewmodel["orden"]["procedimiento"] ?>" readonly>
                            </div>
   
                            <div class="input-group mb-3">
                            <label for="plazoEntrega" class="m-2 form-label">Fecha Entrega</label>
                                <input id="plazoEntrega" name="plazoEntrega" type="text" class="miniinput2 form-control" value="<?php  echo$viewmodel["orden"]["plazoEntrega"] ?>" readonly>
                            </div>
    
                            <label for="formaPago" class="form-label">Forma de Pago:</label>
                            <div class="input-group mb-3">
                                <textarea id="formaPago" name="formaPago" class="form-control" readonly><?php  echo$viewmodel["orden"]["formaPago"] ?></textarea>
                            </div>
    
                            <div class="input-group mb-3">
                            <p class="m-2">Nº Amplición</p>
                                <input id="numeroAmpliacion" style="max-width: 20rem" name="numeroAmpliacion" type="text" class="form-control"  value="<?php  echo$viewmodel["orden"]["numeroAmpliacion"] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-body">
                                <form action="<?php echo ROOT_URL; ?>proveedor/seleccionarProveedor" target='_blank' method="POST">
                                    <input type="hidden" name="idProveedor" value="<?php echo $viewmodel['proveedor']['id']; ?>">
                                    <h4><b>Proveedor:</b><input name="submit" class="btn btn-light btn-lg active" value="<?php  echo $viewmodel["proveedor"]["empresa"] ?>" type="submit"> </h4>
                                    <h4><b>Razon Social: </b><?php  echo $viewmodel["proveedor"]["razon_social"] ?></h4>
                                    <h4><b>RUT: </b><?php  echo $viewmodel["proveedor"]["rut"] ?></h4>
                                </form>

                        </div>
                    </div>
                    <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>

                    <div class="card" style="margin-top: 10px;">
                        <div class="card-body" >
                            <div class="col-12 center" style="text-align: center;">
                                <a href="<?php echo ROOT_URL; ?>orden/editarOrden" class="float-right btn btn-primary">EDITAR ORDEN</a>
                            </div>
                        </div>
                    </div> 
                    
                    <?php } ?>

                   
            </div>
        </div>
    </div>
</div>
<!-- tabla de Items -->
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
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="tablaItems">
                                    <?php 
                                    $i = 0;
                                    $cantidad=0;
                                    $total=0;
                                    foreach($viewmodel['items'] as $item) : 
                                    ?>

                                        <tr id="filaItem<?php echo $i;?>">
                                            <th style="width: 10%"><?php echo $item['cantidad'] ?> </th>
                                            <th style="width: 10%"><?php echo $item['unidad'] ?> </th>
                                            <th style="width: 35%"><?php echo $item['descripcion'] ?> </th>
                                            <th style="width: 10%"><?php echo $item['monto'] ?> </th>
                                            <th style="width: 10%"><?php echo $item['esservicio'] ?> </th>
                                            <th style="width: 10%"><?php echo $item['inicio'] ?></th>
                                            <th style="width: 10%"><?php echo $item['fin'] ?> </th>
                                        </tr>
                                        <?php $i++; $total += $item['monto'];
                                     endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- facturas -->
                            <div style="margin-top: 100px">
                            <form id="anexarFactura" action="<?php echo ROOT_PATH; ?>factura/nuevaFactura" method="post" >
                                <input type="hidden" name="idOrden" value="<?php echo $viewmodel["orden"]["id"] ?>">
                                <input type="hidden" name="idProveedor" value="<?php echo $viewmodel["orden"]["idProveedor"] ?>">
                                <input type="hidden" name="numero" value="<?php echo $viewmodel["orden"]["numero"] ?>">
                                <input type="hidden" name="anio" value="<?php echo $viewmodel["orden"]["anio"] ?>">
                                <input type="hidden" name="empresa" value="<?php echo $viewmodel["proveedor"]["empresa"] ?>">
                                <input type="hidden" name="rut" value="<?php echo $viewmodel["proveedor"]["rut"] ?>">
                                <input type="hidden" name="razon_social" value="<?php echo $viewmodel["proveedor"]["razon_social"] ?>">
                                <input type="hidden" name="moneda" value="<?php echo $viewmodel["orden"]["moneda"] ?>">

                            <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
                                <button type="submit" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/anexarFactura.jpg" width="190px" height="50px" ></button>
                            <?php } ?>

                            </form>


                            <div id="main-container" style="width: 100%; overflow: auto; padding: 25px;"> <!--  max-height: 800px -->
                                <?php 
                                if ($viewmodel["facturas"] != null) {
                                 
                                ?>
                                <h1 style="color: #001d5a; margin-left: 25px" class="">Facturas</h1>

                                <table id="pdf"style="width: 100%">
                                    <thead>
                                        
                                        <tr>
                                            <th>Factura</th>
                                            <th>Monto</th>
                                            <th>Fecha</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    <tr><?php foreach($viewmodel["facturas"] as $factura) : ?>

                                        <td><?php echo $factura['numeroFactura'] ?></td>
                                        <?php
                                            $moneda;
                                            if($factura['monedaFactura'] == "$ (Pesos Uruguayos)"){
                                                $moneda = '$U';
                                            }else{
                                                if($factura['monedaFactura'] == "U.I.(Unidades Indexadas)"){
                                                    $moneda = "U.I.";
                                                }else{
                                                    if($factura['monedaFactura'] == "U.R. (Unidades Reajustables)"){
                                                        $moneda = "U.R.";
                                                    }else{
                                                        if($factura['monedaFactura'] == "€ (Euro)"){
                                                            $moneda = "€";
                                                        }else{
                                                            $moneda = 'U$S';
                                                        }
                                                    }
                                                }
                                            }

                                            ?>
                                        <td> <?php echo $moneda; ?> <?php echo $factura['montoFactura']; ?> </td>
                                        <td><?php echo $factura['fechaFactura'] ?></td>
                                        <td>
                                        <form id="eliminarFactura<?php echo $factura['id'] ?>" action="<?php echo ROOT_PATH; ?>factura/eliminarFactura" method="post">
                                            <input type="hidden" name="id" value="<?php echo $factura['id'] ?>">
                                            <input type="button" name="" onclick="cartelEliminarFactura(<?php echo $factura['id'] ?>)" value="✖" style="float:right; margin-right: 4%; border: none; color:white;" class="btn btnEliminar sombraRoja"/>
                                        </form>

                                            <form action="<?php echo ROOT_URL; ?>factura/seleccionFactura" method="post">
                                                <input type="hidden" name="idFactura" value="<?php echo $factura['id'] ?>">
                                                <input type="submit" name="submit" value="Ver" style="background: #001d5a; width: 100px; float:right; margin-right: 5%; border: none" class="btn btn-primary sombraAzul"/>
                                            </form>
                                         </td>
                                         
         
                                       
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                    <h3>No hay facturas anexadas</h3>
                                <?php } ?> 
                                </div>
                            </div>
                            <!-------------->
                            <hr>
                            <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
                                <button type="button" id="btnmodal" class="excel sombraAzul1" onclick="abrirModal()"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevoArchivo.jpg" width="200px" height="48px" ></button>
                            <?php } ?>

                            <div id="contenedor-archivos" style="width: 100%; overflow: auto; padding: 25px;"> <!--  max-height: 800px -->
                                <?php 
                                if ($viewmodel["archivos"] != null) {
                                 
                                ?>
                                <h1 style="color: #001d5a; margin-left: 25px" class="">Archivos Adjuntos</h1>
                                <table id="pdf"style="width: 100%">
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
                                            <form id="eliminarArchivo<?php echo $item['id'] ?>" action="<?php echo ROOT_PATH; ?>orden/eliminarArchivo" method="post">
                                                <input type="hidden" name="idArchivo" value="<?php echo $item['id'] ?>">
                                            </form> 
                                            <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
                                                <input type="button" name="" onclick="cartelEliminarArchivo(<?php echo $item['id'] ?>)" value="✖" style="float:right; margin-right: 4%; border: none; color:white;" class="btn btnEliminar sombraRoja"/>
                                            <?php } ?>

                                            <form action="<?php echo ROOT_URL; ?>orden/verArchivo" method="post">
                                                <input type="hidden" name="idArchivo" value="<?php echo $item['id'] ?>">
                                                <input type="submit" name="submit" value="Ver" style="background: #001d5a; width: 100px; float:right; margin-right: 5%; border: none" class="btn btn-primary sombraAzul"/>
                                            </form>
                                         </td>
         
                                       
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                    <h3>No hay archivos adjuntos</h3>
                                <?php } ?> 
                            </div>
                            <br>
                            <hr>

                        <a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>
                        <hr>



</body>


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
            document.getElementById("loadFile").value = "";
    
        };
        
        fileReader.readAsDataURL(fileToLoad);
    }
    
}
    function cartelEliminarFactura(id){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Borrar factura?',
        text: "Seguro que quieres borrar esta factura!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'No, borrar!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            //enviar formulario

            document.getElementById('eliminarFactura'+id).submit();

        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelado',
            'No se elimino la factura ',
            'error'
            )
        }
        });

    }

    function cartelEliminarArchivo(id){
        
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Borrar archvivo?',
        text: "Seguro que quieres borrar este archivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'No, borrar!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            //enviar formulario
              document.getElementById('eliminarArchivo'+id).submit();
            eliminar($id);
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelado',
            'No se elimino el archivo ',
            'error'
            )
        }
        });
    }
 
    function eliminar(id){
        var input = document.getElementById(id+"pdf");
        input.parentNode.removeChild(input);
        var inputName = document.getElementById(id+"pdfnombre");
        inputName.parentNode.removeChild(inputName);
        var table = document.getElementById("guardado");
        table.rows[id].style.display = "none";
    }
    ///modal de subir archivos
    const modal = document.querySelector("#modalSubirArchivo");

    btn.addEventListener("click", function() {
        modal.showModal();
    });
    function abrirModal(){
        modal.showModal();
    }

    function cerrarModal(){
        for (let index = 0; index < cant; index++) {
            if(document.getElementById(index+"pdf")){
                eliminar(index);
            }
        }
        modal.close();
    }






</script>


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

<?php $completo=true; 
 foreach($viewmodel['items'] as $item) {
    if($item['sinFacturar']>0 ){
    $completo=false;
    }
 }
?>

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
<form id="editar" method="post" action="<?php echo ROOT_URL; ?>solicitudes/listaSolicitudes">       
                <a href="<?php echo ROOT_URL; ?>orden/comprasRealizadas"><input type="button" style="width: 180px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="Compras Realizadas"/></a>

                <td><input type="text" name="numero" style="display: none" value="<?php echo $viewmodel['solicitud']['id']; ?>"/>
                <input type="submit" name="submit" value="Ir a la Solicitud" style="background: #001d5a; border: none; margin-left: 30px" class="btn btn-primary sombraAzul"/></td>

                <?php if($viewmodel['orden']['entregada']=='entregada' ){ ?> <label style="font-size: 23px; margin-left: 40px" class="verde">✔️ Entregada</label> 
                <?php }else{ if($_SESSION['user_data']['rol'] != 'Consultor' && $viewmodel['orden']['estado']=='activo' ){
                    ?> 
                        
                        <input type="button" onclick="alertEntregar()" value="✔️ Confirmar Entrega" style="background: rgb(20, 77, 3); border: none; margin-left: 30px" class="btn btn-primary sombra"/></td>
                
                    <?php }
                } ?>
</form>
<form action="<?php echo ROOT_URL; ?>orden/entregado" method="post">
    <input type="text" name="idOrden" style="display: none" value="<?php echo $viewmodel['orden']['id'];?>" />
    <input type="submit" name="submit"  id="entregar"  value="Entregada" style="display: none; background: rgb(20, 77, 3); border: none; margin-left: 30px" class="btn btn-primary sombra"/></td>
</form>


<?php if($_SESSION['user_data']['rol'] != 'Consultor' && $viewmodel['orden']['estado']=='activo' ){ 
    if($completo==false){   
        ?>
        <button type="submit" form="anexarFactura" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/anexarFactura.jpg" width="190px" height="50px" ></button>
<?php } ?>    
    <button type="button" id="btnmodal" class="excel sombraAzul1" onclick="abrirModal()"> <img src="<?php echo ROOT_PATH; ?>imagenes/nuevoArchivo.jpg" width="200px" height="48px" ></button>
    <?php } ?>


<div  class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
                    <div class="card">
                <br>
            <h2 style="color: #001d5a; margin-left: 25px" class="text-center">ORDEN OC: <?php echo $viewmodel['orden']['numero']; ?> - <?php echo $viewmodel['orden']['anio']; ?></h2>
            <?php if($viewmodel['orden']['estado']=='inactivo' ){ ?>   
                    <div class="alert alert-warning" role="alert" style="text-align:center;">
                        <h6><b>Esta Orden esta anulada</b></h6>Para volver a activarla debe ir a la Solicitud y en la sección de Ordenes de Compra, activarla.
                    </div>
            <?php } ?>
                        <div class="card-body">
                        <hr>
                            <h4 style="color: #001d5a;" class="m-2"><b>Solicitud SR: </b><?php echo $viewmodel['solicitud']['SR']; ?></h4>
                            <h4 style="color: #001d5a;"  class="m-2"><b>Procedimiento:</b> <?php echo $viewmodel['solicitud']['procedimiento']." ".$viewmodel['solicitud']['numProc']." ".$viewmodel['solicitud']['anioProc']; ?> </h4>
                            <hr>
                            <div class="input-group mb-3">
                            <?php    
                            $monedaOrden;
                                            if($viewmodel["orden"]["moneda"]== "$ (Pesos Uruguayos)"){
                                                $monedaOrden = '$U';
                                            }else{
                                                if($viewmodel["orden"]["moneda"] == "U.I.(Unidades Indexadas)"){
                                                    $monedaOrden = "U.I.";
                                                }else{
                                                    if($viewmodel["orden"]["moneda"] == "U.R. (Unidades Reajustables)"){
                                                        $monedaOrden = "U.R.";
                                                    }else{
                                                        if($viewmodel["orden"]["moneda"] == "€ (Euro)"){
                                                            $monedaOrden = "€";
                                                        }else{
                                                            $monedaOrden = 'U$S';
                                                        }
                                                    }
                                                }
                                            }
                            ?>
                            <div class="input-group mb-1">   
                                <h4 style="color: #001d5a;"  class="m-2"><b>Monto Total:</b> <?php  echo $monedaOrden." ". $viewmodel["orden"]["montoReal"] ?></h4>
                            </div>
                            <div class="input-group mb-1">  
                                <h4 style="color: #001d5a;"  class="m-2"><b>Fecha Entrega:</b>     <?php  echo$viewmodel["orden"]["plazoEntrega"] ?></h4>
                            </div>
                            <div class="input-group mb-1"> 
                                <h4 style="color: #001d5a;"   class="m-2"><b>Nº Amplición:</b> <?php  echo$viewmodel["orden"]["numeroAmpliacion"] ?></h4>
                            </div>  

                            <div class="input-group mb-1">  
                                <h4 style="color: #001d5a;"  class="m-2"><b>Forma de Pago:</b></h4>
                            </div>

                            
                            <div class="card">
                                <div class="card-body" >
                                    <div class="input-group mb-1" style="width: 800">
                                        <h5 style="min-width: 500"><?php  echo$viewmodel["orden"]["formaPago"] ?></h5>
                                    </div>
                                </div>
                            </div>   
                            
    

                        </div>

                    </div>
                </div>
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-body">
                                <form action="<?php echo ROOT_URL; ?>proveedor/seleccionarProveedor" target='_blank' method="POST">
                                    <input type="hidden" name="idProveedor" value="<?php echo $viewmodel['proveedor']['id']; ?>">
                                    <h4 style="color: #001d5a;" ><b>Proveedor:</b><input name="submit" class="btn btn-light btn-lg active" value="<?php  echo $viewmodel["proveedor"]["empresa"] ?>" type="submit"> </h4>
                                    <h4 style="color: #001d5a;"  ><b>Razon Social: </b><?php  echo $viewmodel["proveedor"]["razon_social"] ?></h4>
                                    <h4 style="color: #001d5a;" ><b>RUT: </b><?php  echo $viewmodel["proveedor"]["rut"] ?></h4>
                                </form>

                        </div>
                    </div>
                    <?php if($_SESSION['user_data']['rol'] != 'Consultor'&& $viewmodel['orden']['estado']=='activo' ){ ?>

                    <div class="card" style="margin-top: 10px;">
                        <div class="card-body" >
                            <div class="col-12 center" style="text-align: center;">
                            
                            <?php 
                            $read="";
                            if(count($viewmodel['facturas'])>0 ){ 
                                $read="readonly";
                            ?>
                                    <p class=".text-muted">*Una vez creada una Factura no se puede editar la Orden de Compra</p>
                             <?php
                            }else{
                            ?>
                                <a href="<?php echo ROOT_URL; ?>orden/editarOrden" class="float-right btn amarillo"<?php echo $read ?> >✏️ Editar Orden</a>
                            </div>
                            <?php } ?>
                        </div>
                    </div> 
                    
                    <?php } ?>

                   
            </div>
        </div>
    </div>
</div>
<!-- tabla de Items -->
                        <h1 style="color: #001d5a; margin-left: 40px" class="">Item</h1>
                        <div id="main-container" style="width: 100%; overflow: auto; padding: 15px; max-height: 800px">

                                <table id="listaItems" style="width: 100%;">

                                    <thead>
                                        
                                        <tr>
                                            <th >Facturado</th>
                                            <th >Cantidad</th>
                                            <th >Unidad</th>
                                            <th style="width: 30%">Descripcion</th>
                                            <th >Monto (<?php echo $monedaOrden ?>) </th>
                                            <th >Servicio</th>
                                            <th >Inicio (y-m-d)</th>
                                            <th >Fin (y-m-d)</th>
                                            <th>Obs.</th>
                                            
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
                                            <th ><?php echo $item['cantidad']-$item['sinFacturar'] ?> </th>
                                            <th ><?php echo $item['cantidad'] ?> </th>
                                            <th ><?php echo $item['unidad'] ?> </th>
                                            <th ><?php echo $item['descripcion'] ?> </th>
                                            <th ><?php echo $item['monto'] ?> </th>
                                            <th ><?php echo $item['esservicio'] ?> </th>
                                            <th ><?php if($item['esservicio'] == "No"){echo 'N/A';}else{echo $item['inicio'];} ?></th>
                                            <th ><?php if($item['esservicio'] == "No"){echo 'N/A';}else{ echo $item['fin'];} ?> </th>
                                            <th >
                                                <?php if($item['observacion'] != "")
                                                { ?>
                                                  
                                                <input class="rounded-circle border-white" onclick="verObsercion(<?php echo $item['id']?>)" type="button" value="  ❕  ">
                                                <input type="hidden" id="observacion<?php echo $item['id']?>" value="<?php echo $item['observacion']?>">
                                                <?php }else{
                                                    
                                                } ?>
                                            </th>

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


                                <hr>


                            <?php if($_SESSION['user_data']['rol'] != 'Consultor' && $completo==false && $viewmodel['orden']['estado']=='activo' ){ ?>
                                <button type="submit" class="excel sombraAzul1"> <img src="<?php echo ROOT_PATH; ?>imagenes/anexarFactura.jpg" width="190px" height="50px" ></button>
                            <?php } ?>

                            </form>


                            <div id="main-container" style="width: 100%; overflow: auto; padding: 25px;"> <!--  max-height: 800px -->
                                <?php 
                                if ($viewmodel["facturas"] != null) {
                                 
                                ?>
                                <h1 style="color: #001d5a; margin-left: 25px" class="">Facturas</h1>
                                <?php  if($completo==true){   ?>
                                <h5 style=" margin-left: 25px" class="text-muted">*Ya se facturaron todos los item de la Orden</h5>
                                <?php  }   ?>
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
                                        <?php if($_SESSION['user_data']['rol'] == 'Administrador' && $viewmodel['orden']['estado']=="activo" && $factura['estado']=="activo" ){ ?>
                                            <form id="eliminarFactura<?php echo $factura['id'] ?>" action="<?php echo ROOT_PATH; ?>factura/anularFactura" method="post">
                                                <input type="hidden" name="idFactura" value="<?php echo $factura['id'] ?>">
                                                <input type="button" name="anular" onclick="cartelEliminarFactura(<?php echo $factura['id'] ?>)" value="Anular" style="float:right; margin-right: 4%; border: none; color:white;" class="btn btnEliminar sombraRoja"/>
                                            </form>  
                                        <?php } ?>
                                        <?php if($factura['estado']!="activo" ){ ?>
                                            <span un-clickable style="float:right; margin-right: 4%; border: none;" class="btn text-danger">Anulado</span>
                                        <?php } ?>                                 


                                            <form action="<?php echo ROOT_URL; ?>factura/seleccionFactura" method="post">
                                                <input type="hidden" name="idFactura" value="<?php echo $factura['id'] ?>">
                                                <input type="submit" name="submit" value="Ver" style="background: #001d5a; width: 100px; float:right; margin-right: 5%; border: none" class="btn btn-primary sombraAzul"/>
                                            </form>
                                         </td>
                                         
         
                                       
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php } else { ?>
                                    <h3 style="color: rgb(180,180,180)">No hay facturas anexadas</h3>
                                <?php } ?> 
                                </div>
                            </div>
                            <!-------------->
                            <hr>
                            <?php if($_SESSION['user_data']['rol'] != 'Consultor' && $viewmodel['orden']['estado']=='activo'){ ?>
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
                                            <?php if($_SESSION['user_data']['rol'] != 'Consultor' && $viewmodel['orden']['estado']=='activo'){ ?>
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
                                    <h3 style="color: rgb(180,180,180)">No hay archivos adjuntos</h3>
                                <?php } ?> 
                            </div>
                            <br>
                            <hr>

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
        title: 'Anular factura?',
        text: "Seguro que quieres anular esta factura!. No podras revertir esta accion!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, anular!',
        cancelButtonText: 'No anular! ',
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
            'No se anulo la factura ',
            'error'
            )
        }
        });

    }

    function verObsercion(id){
        var observacion = document.getElementById('observacion'+id).value;
        Swal.fire({
            title: 'Observación',
            text: observacion,
           
            confirmButtonText: 'Ok'
        })
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
 
    function alertEntregar(){
            
            const entregar = document.getElementById("entregar");
            
            Swal.fire({
                title: 'Estás seguro?',
                text: "Se marcará la compra como entregada total",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, confirmar!',
                cancelButtonText: 'No, cancelar!'

                }).then((result) => {
                if (result.isConfirmed) {

                    
                    entregar.click();
                    


                }
                })

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

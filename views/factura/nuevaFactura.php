<script>
    $(document).ready(function(){
        document.getElementById('fechaFactura').valueAsDate = new Date();

        const moneda = document.getElementById('monedaFactura').value.substring(0,3);
        const moneda1 = document.getElementById('monedaFactura').value.substring(0,2);

        if(moneda == "$ (" || moneda == "€ ("){
            document.getElementById('thMonto').textContent = "Total " + moneda1;
        }else{
            document.getElementById('thMonto').textContent = "Total " + moneda;
        }




});
   
</script>
<body>
<form id="formFactura" onsubmit="validarFormulario(event)" action="<?php echo ROOT_URL; ?>factura/agregarFactura" method="POST" enctype="multipart/form-data">

    <div class="container">
        <div class="row d-flex justify-content-center ">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-8">
                <div class="card">
                    <br>
                    <h1 style="color: #001d5a; text-align:center; margin-bottom: 10px" class="center">Agregar Factura</h1>

                        <div class="card-body ">

                            <input type="hidden" name="idOrden" value="<?php echo $viewmodel['orden']['id']; ?>">
                            <input type="hidden" name="idProveedor" value="<?php echo $viewmodel['idProveedor']; ?>">
                                        <?php
                                            $moneda;
                                            if($viewmodel['orden']["moneda"] == "$ (Pesos Uruguayos)"){
                                                $moneda = '$U';
                                            }else{
                                                if($viewmodel['orden']["moneda"] == "U.I.(Unidades Indexadas)"){
                                                    $moneda = "U.I.";
                                                }else{
                                                    if($viewmodel['orden']["moneda"] == "U.R. (Unidades Reajustables)"){
                                                        $moneda = "U.R.";
                                                    }else{
                                                        if($viewmodel['orden']["moneda"] == "€ (Euro)"){
                                                            $moneda = "€";
                                                        }else{
                                                            $moneda = 'U$S';
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                        
                            
                                <h5><b>DATOS DE LA ORDEN:</b></h5>
                                <div class="card">
                                    <div class="card-body">
                                        <h6><b>PROCEDIMIENTO: </b> <?php echo $viewmodel['orden']["procedimiento"]?></h6>
                                        <h6><b>ORDEN: </b> <?php echo $viewmodel['orden']["numero"]?>-<?php echo $viewmodel['orden']["anio"]?></h6>
                                        <h6><b>Monto de la Orden:</b><?php echo $moneda." ".$viewmodel['orden']["montoReal"]?></h6>
                                        <hr>
                                        <h6><b>PROVEEDOR: </b><?php echo $viewmodel["empresa"]?></h6>
                                        <h6><b>Razon Social: </b><?php echo $viewmodel["razon_social"]?></h6>
                                        <h6><b>R.U.T.: </b><?php echo $viewmodel["rut"]?></h6>
                                    </div>
                                </div>
                                <hr>
                                </div>
                                </div>
                                <div class="card" style="margin-top: 10px;">
                                    
                                    <div class="card-body">
                                        <h4 style="color: #001d5a; margin-left: 25px" class="">Subir Archivos</h4>
    
                                        <div class="mb-3">
                                        <input class="form-control" id="loadFile" accept="application/pdf" type="file" onchange="readAsBase64()"  width="190px" height="50px"/>
                                        </div>
                                        <div class="">
                                            <label for="">PDF para anexar:</label>
                                        </div>
                                        <hr>
                                        <table style="max-width: 600px" id="guardado">
                                        </table>
                                    </div>
                                </div>

                                <div class="card" style="margin-top: 10px;">
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label for="numeroFactura" class="col-sm-2 col-form-label"> N° Factura</label>
                                            <div class="col-sm-6">
                                                <input id="numeroFactura" name="numeroFactura" type="text" class="form-control" required>
                                            </div>
                                            <div id="numeroError" style="color:red"></div>
                                        </div>

                                       <div class="mb-3 row">
                                            <label for="monedaFactura" class="col-sm-2 col-form-label"> Total </label>
                                            <div class="col-sm-4">
                                                <select name="monedaFactura" id="monedaFactura" onchange="cambiarMoneda(this)" class="form-control">
                                                    <option value="$ (Pesos Uruguayos)" <?php if($viewmodel["orden"]["moneda"]=='$U (Pesos Uruguayos)') { echo "selected"; } ?>>$U (Pesos Uruguayos)</option>
                                                    <option value="U$S (Dolares)" <?php if($viewmodel["orden"]["moneda"]=='U$S (Dolares)') { echo "selected"; } ?>>US$ (Dólares)</option>
                                                    <option value="U.I.(Unidades Indexadas)" <?php if($viewmodel["orden"]["moneda"]=='U.I.(Unidades Indexadas)') { echo "selected"; } ?> >U.I.(Unidades Indexadas)</option>
                                                    <option value="U.R. (Unidades Reajustables)" <?php if($viewmodel["orden"]["moneda"]=='U.R. (Unidades Reajustables)') { echo "selected"; } ?> >U.R. (Unidades Reajustables)</option>
                                                    <option value="€ (Euro)" <?php if($viewmodel["orden"]["moneda"]=='€ (Euro)') { echo "selected"; } ?> >€ (Euro)</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                            <input id="montoFactura" name="montoFactura" type="number" class="form-control" placeholder="Monto"required>

                                            </div>
                                            <div id="montoRealError" class="center2" style="color:red"></div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="fecha" class="col-sm-2 col-form-label"> Fecha</label>
                                            <div class="col-sm-4">
                                                <input id="fechaFactura" name="fechaFactura" type="date" value="27/10/2022" class="form-control"  style="max-width: 15rem" required>
                                            </div>
                                        </div>
                                        <div id="fechaError" style="color:red" class="center2">     </div>


                                        <label for="concepto" class="form-label">Concepto:</label>
                                        <div class="input-group mb-3">
                                            <textarea id="conceptoFactura" name="conceptoFactura" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!--MODAL -->
                                <div class="modal" tabindex="-1" role="dialog" id="modalconfirmar">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">AGREGAR FACTURA:</h5>

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
                                

                            

                        </div>
                </div>
            </div>
<div class="container" >
    <div class="row d-flex justify-content-center ">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10" >
            <div class="card text-center" style="margin-top: 40px; margin-bottom: 50px;">                
                <div class="card-body ">
            <hr>
            <h3 style="color: #001d5a; margin-left: 25px" class="">Items</h3>
                        <div id="main-container" style="width: 100%; overflow: auto; padding: 15px; max-height: 800px">

                                <table id="listaItems" style="width: 100%;">

                                    <thead>
                                        
                                        <tr>
                                            <th style="width: 10%">Restan</th>
                                            <th style="width: 15%">Cantidad</th>
                                            <th style="width: 25%">Unidad</th>
                                            <th style="width: 40%">Descripcion</th>
                                            <th style="width: 10%">Agregar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaItems">
                                    <?php 
                                    foreach($viewmodel['items'] as $item) : 
                                    if($item['sinFacturar'] >0){
                                    ?>

                                        <tr id="filaItem<?php echo $item['id'] ?>">
                                            <th style="width: 15%"><?php echo $item['sinFacturar'] ?></th>
                                            <th style="width: 15%"><input id="itemCantidad<?php echo $item['id'] ?>" type="number" step="" min="1" max="<?php echo $item['sinFacturar'] ?>"class="form-control"value="<?php echo $item['sinFacturar'] ?>" readonly> </th>
                                            <th style="width: 35%"><?php echo $item['unidad'] ?> </th>
                                            <th style="width: 40%"><?php echo $item['descripcion'] ?> </th>
                                            <th id="agregar<?php echo $item['id'] ?>"style="width: 5%"><button type="button" class="btn btn-success" onclick="agregarItem(<?php echo $item['id'] ?>,<?php echo $item['monto'] ?> )">+</button></th>
                                        </tr>
                                        <input type="hidden" id="itemOrden<?php echo $item['id'] ?>" value="<?php echo $item['id'] ?>">
                                        <input type="hidden" id="descripcion<?php echo $item['id'] ?>" value="<?php echo $item['descripcion'] ?>">
                                        <input type="hidden" id="unidad<?php echo $item['id'] ?>" value="<?php echo $item['unidad'] ?>">
                                        <input type="hidden" id="recuperacionCantidad<?php echo $item['id'] ?>" value="<?php echo $item['sinFacturar'] ?>">
                                        <?php  }
                                    endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
        </div>
    </div>
    <div class="card text-center" style="margin-top: 40px; margin-bottom: 50px;">                
                <div class="card-body ">

                    <div >  
                        <a href="<?php echo ROOT_URL; ?>orden/verOrden" ><input type="button" value="CANCELAR" class="btn btn-secondary"  ></a>
                        <input type="submit" class="btn btn-primary" value="AGREGAR FACTURA"  onclick="abrirModal()" style="margin-top: 20px; margin-bottom: 20px">
                    </div>
                </div>
            </div>
        </div>
    </div>


    </form>
</body>
<script>
    let total=0;    
    function agregarItem(idItem,monto){
        ///readonly false a cantidad y monto
        document.getElementById("itemCantidad"+idItem).readOnly = false;
        document.getElementById("agregar"+idItem).innerHTML = '<button type="button" class="btn btn-danger" onclick="quitarItem('+idItem+','+monto+')">-</button>';
        //agregar name a cantidad monto unidad y descripcion
        document.getElementById("itemCantidad"+idItem).setAttribute("name", "cantidadItem[]");
        document.getElementById("unidad"+idItem).setAttribute("name", "unidadItem[]");
        document.getElementById("descripcion"+idItem).setAttribute("name", "descripcionItem[]");
        document.getElementById("itemOrden"+idItem).setAttribute("name", "idItem[]");

    }

    function quitarItem(idItem,monto){
        //readonly true a cantidad y monto
        document.getElementById("itemCantidad"+idItem).value = document.getElementById("recuperacionCantidad"+idItem).value;
        document.getElementById("itemCantidad"+idItem).readOnly = true;
        document.getElementById("agregar"+idItem).innerHTML = '<button type="button" class="btn btn-success" onclick="agregarItem('+idItem+','+monto+')">+</button>';
        //quitar name a cantidad monto unidad y descripcion
        document.getElementById("itemCantidad"+idItem).removeAttribute("name");
        document.getElementById("unidad"+idItem).removeAttribute("name");
        document.getElementById("descripcion"+idItem).removeAttribute("name");
        document.getElementById("itemOrden"+idItem).removeAttribute("name");
        //recuperar valores

    }

    ///funcion que controla que exista un name en html
    function existeName(name){
        var inputs = document.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].getAttribute('name') == name) {
                return true;
            }
        }
        return false;
    }


</script>

<script>
document.getElementById("numeroFactura").addEventListener("blur", errorNumeroFactura);
document.getElementById("montoFactura").addEventListener("blur", errorMonto);


function errorNumeroFactura (){
    var numeroFactura = document.getElementById("numeroFactura").value;
    if(numeroFactura ==""){
        document.getElementById("numeroError").innerHTML = "El campo no puede estar vacio X";
    }
    else{
        document.getElementById("numeroError").innerHTML = "";
    }
}
function errorMonto(){
    var montoFactura = document.getElementById("montoFactura").value;
    if(montoFactura <= 0 || montoFactura ==""){
        document.getElementById("montoRealError").innerHTML = "     El Monto no puede estar vacio o en 0 X";
    }
    else{
        document.getElementById("montoRealError").innerHTML = "";
    }
}

  


</script>

<script>
function validarFormulario(event){
        let errores = "";
        var numeroFactura = document.getElementById('numeroFactura').value;
        var fechaFactura = document.getElementById('fechaFactura').value;
        var montoFactura = document.getElementById('montoFactura').value;

       if(existeName("descripcionItem[]") == false){
            errores += "<h4>Debe agregar al menos un item a la factura</h4><hr>";
        }
        if(montoFactura == 0 || montoFactura == ""){
            errores += "<h4>El monto de la factura no puede ser 0</h4><hr>";
        }
        if(numeroFactura == null || numeroFactura.length == 0 || /^\s+$/.test(numeroFactura)){
            errores = errores + "<h4>Debe ingresar un numero de factura</h4><hr>";
            event.preventDefault();
        }

        if(fechaFactura == null || fechaFactura.length == 0 || /^\s+$/.test(fechaFactura)){
            errores = errores + "<h4>Debe ingresar una fecha</h4><hr>";
            event.preventDefault();
        }
        if(existeName("pdfnombre[]") == false){
            errores += "<h4>Debe agregar al menos un archivo</h4><hr>";
        }
        
        if( errores != ""){
             
             Swal.fire({
             icon: 'error',
             title: 'Oops...',
             html: errores,
            });
            event.preventDefault();
            return;
        }
        var modalconfirmar = document.getElementById('modalconfirmar').style.display;
        if(modalconfirmar != "block"){
            //abrir modalconfirmar
            document.getElementById('modalconfirmar').style.display = "block";
            event.preventDefault();
        }
        
    }


    function cerrarModel(){
        document.getElementById('modalconfirmar').style.display = "none";
    }
</script>
<script>
    

    function cambiarMoneda(select){
        const moneda = select.value.substring(0,3);
        const moneda1 = select.value.substring(0,2);

        if(moneda == "$ (" || moneda == "€ ("){
            document.getElementById('thMonto').textContent = "Total " + moneda1;
        }else{
            document.getElementById('thMonto').textContent = "Total " + moneda;
        }

        
    }
</script>
<script>
   ////CARGAR ARCHIVOS/////
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
            document.getElementById("formFactura").appendChild(input);

            var inputName = document.createElement("input");
            inputName.setAttribute("type", "hidden");
            inputName.setAttribute("name", "pdfnombre[]");
            inputName.setAttribute("id", cant+"pdfnombre");
            inputName.setAttribute("value", fileToLoad.name);
            document.getElementById("formFactura").appendChild(inputName);

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
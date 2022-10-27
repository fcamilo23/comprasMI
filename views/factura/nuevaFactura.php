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
                    <h1 style="color: #001d5a; text-align:center; margin-bottom: 30px" class="center">Agregar Factura
                        </h1>

                        <div class="card-body ">

                            <input type="hidden" name="idOrden" value="<?php echo $viewmodel['idOrden']; ?>">
                            <input type="hidden" name="idProveedor" value="<?php echo $viewmodel['idProveedor']; ?>">
           
                            <hr>
                                <h5><b>DATOS:</b></h5>
                                <div class="card">
                                    <div class="card-body">
                                        <h6><b>ORDEN: </b> <?php echo $viewmodel["numero"]?>-<?php echo $viewmodel["anio"]?></h6>
                                        <h6><b>PROVEEDOR: </b><?php echo $viewmodel["empresa"]?></h6>
                                        <h6><b>Razon Social: </b><?php echo $viewmodel["razon_social"]?></h6>
                                        <h6><b>R.U.T.: </b><?php echo $viewmodel["rut"]?></h6>
                                    </div>

                                </div>
                                <hr>
                                <h4 style="color: #001d5a; margin-left: 25px" class="">Subir Archivos</h4>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="formFileFactura" class="form-label">Subir PDF (Obligatorio)</label>
                                        <input class="form-control" id="loadFileFactura" name="loadFileFactura" onchange="readAsBase64()" accept="application/pdf" type="file" width="190px" height="50px" />
                                        <input type="hidden" name="pdfFactura" id="pdfFactura" value="">
                                        <input type ="hidden" name="pdfNombreFactura" id="pdfNombreFactura" value="">
                                    </div>
                                </div>
                                <hr>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label for="numeroFactura" class="col-sm-2 col-form-label"> N° Factura</label>
                                            <div class="col-sm-6">
                                                <input id="numeroFactura" name="numeroFactura" type="text" class="form-control" required>
                                            </div>
                                            <div id="numeroError" style="color:red"></div>
                                        </div>

                                       <div class="mb-3 row">
                                            <label for="monedaFactura" class="col-sm-2 col-form-label"> Moneda</label>
                                            <div class="col-sm-4">
                                                <select name="monedaFactura" id="monedaFactura" onchange="cambiarMoneda(this)" class="form-control">
                                                    <option value="$ (Pesos Uruguayos)" <?php if($viewmodel["moneda"]=='$U (Pesos Uruguayos)') { echo "selected"; } ?>>$U (Pesos Uruguayos)</option>
                                                    <option value="U$S (Dolares)" <?php if($viewmodel["moneda"]=='U$S (Dolares)') { echo "selected"; } ?>>US$ (Dólares)</option>
                                                    <option value="U.I.(Unidades Indexadas)" <?php if($viewmodel["moneda"]=='U.I.(Unidades Indexadas)') { echo "selected"; } ?> >U.I.(Unidades Indexadas)</option>
                                                    <option value="U.R. (Unidades Reajustables)" <?php if($viewmodel["moneda"]=='U.R. (Unidades Reajustables)') { echo "selected"; } ?> >U.R. (Unidades Reajustables)</option>
                                                    <option value="€ (Euro)" <?php if($viewmodel["moneda"]=='€ (Euro)') { echo "selected"; } ?> >€ (Euro)</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div id="montoRealError" class="center2" style="color:red"></div>

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
                                            <th style="width: 20%">Cantidad</th>
                                            <th style="width: 20%">Unidad</th>
                                            <th style="width: 30%">Descripcion</th>
                                            <th id="thMonto" style="width: 20%">Monto</th>
                                            <th>Agregar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaItems">
                                    <?php 
                                    foreach($viewmodel['items'] as $item) : 
                                    ?>

                                        <tr id="filaItem<?php echo $item['id'] ?>">
                                            <th style="width: 20%"><input id="itemCantidad<?php echo $item['id'] ?>" type="number" step="0.01" min="1"class="form-control"value="<?php echo $item['cantidad'] ?>" readonly> </th>
                                            <th style="width: 20%"><?php echo $item['unidad'] ?> </th>
                                            <th style="width: 30%"><?php echo $item['descripcion'] ?> </th>
                                            <th style="width: 20%"><input id="itemMonto<?php echo $item['id'] ?>" type="number" step="0.01" min="1"class="form-control"value="<?php echo $item['monto'] ?>" readonly> </th>
                                            <th id="agregar<?php echo $item['id'] ?>"style="width: 5%"><button type="button" class="btn btn-success" onclick="agregarItem(<?php echo $item['id'] ?>,<?php echo $item['monto'] ?> )">+</button></th>
                                        </tr>
                                        <input type="hidden" id="itemOrden<?php echo $item['id'] ?>" value="<?php echo $item['id'] ?>">
                                        <input type="hidden" id="descripcion<?php echo $item['id'] ?>" value="<?php echo $item['descripcion'] ?>">
                                        <input type="hidden" id="unidad<?php echo $item['id'] ?>" value="<?php echo $item['unidad'] ?>">
                                        <input type="hidden" id="recuperacionCantidad<?php echo $item['id'] ?>" value="<?php echo $item['cantidad'] ?>">
                                        <input type="hidden" id="recuperacionMonto<?php echo $item['id'] ?>" value="<?php echo $item['monto'] ?>">
                                        <?php  endforeach; ?>
                                    </tbody>
                                </table>
                            <!--MODAL   
                                <div class="form-group row" style="margin-top: 40px;">
                                <label for="colFormLabel" class="col-sm-2 col-form-label" >Monto Total:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="montoReal" class="form-control miniinput2" id="montoReal" value="0" readonly>
                                </div>
                            </div>-->  
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
        document.getElementById("itemMonto"+idItem).readOnly = false;
        document.getElementById("agregar"+idItem).innerHTML = '<button type="button" class="btn btn-danger" onclick="quitarItem('+idItem+','+monto+')">-</button>';
        //agregar name a cantidad monto unidad y descripcion
        document.getElementById("itemCantidad"+idItem).setAttribute("name", "cantidadItem[]");
        document.getElementById("itemMonto"+idItem).setAttribute("name", "montoItem[]");
        document.getElementById("unidad"+idItem).setAttribute("name", "unidadItem[]");
        document.getElementById("descripcion"+idItem).setAttribute("name", "descripcionItem[]");
        document.getElementById("itemOrden"+idItem).setAttribute("name", "idItem[]");

    }

    function quitarItem(idItem,monto){
        //readonly true a cantidad y monto
        document.getElementById("itemCantidad"+idItem).value = document.getElementById("recuperacionCantidad"+idItem).value;
        document.getElementById("itemMonto"+idItem).value = document.getElementById("recuperacionMonto"+idItem).value;
        document.getElementById("itemCantidad"+idItem).readOnly = true;
        document.getElementById("itemMonto"+idItem).readOnly = true;
        document.getElementById("agregar"+idItem).innerHTML = '<button type="button" class="btn btn-success" onclick="agregarItem('+idItem+','+monto+')">+</button>';
        //quitar name a cantidad monto unidad y descripcion
        document.getElementById("itemCantidad"+idItem).removeAttribute("name");
        document.getElementById("itemMonto"+idItem).removeAttribute("name");
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

    function validarFormulario(event){
        let errores = "";
        var numeroFactura = document.getElementById('numeroFactura').value;
        var fechaFactura = document.getElementById('fechaFactura').value;
        var loadFileFactura = document.getElementById('loadFileFactura').value;

       if(existeName("descripcionItem[]") == false){
            errores += "Debe agregar al menos un item a la factura";
        }
        if(numeroFactura == null || numeroFactura.length == 0 || /^\s+$/.test(numeroFactura)){
            errores = errores + "<p>Debe ingresar un numero de factura</p><hr>";
            event.preventDefault();
        }

        if(fechaFactura == null || fechaFactura.length == 0 || /^\s+$/.test(fechaFactura)){
            errores = errores + "<p>Debe ingresar una fecha</p><hr>";
            event.preventDefault();
        }
        if(loadFileFactura == null || loadFileFactura.length == 0 || /^\s+$/.test(loadFileFactura)){
            errores = errores + "<p>Debe ingresar un archivo</p><hr>";
            event.preventDefault();
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

    

    function cambiarMoneda(select){
        const moneda = select.value.substring(0,3);
        const moneda1 = select.value.substring(0,2);

        if(moneda == "$ (" || moneda == "€ ("){
            document.getElementById('thMonto').textContent = "Total " + moneda1;
        }else{
            document.getElementById('thMonto').textContent = "Total " + moneda;
        }

        
    }

    ////CARGAR ARCHIVOS/////
    function readAsBase64() {

        var files = document.getElementById("loadFileFactura").files;
        if (files.length > 0) {

            var fileToLoad = files[0];
            var fileReader = new FileReader();
            // Reading file content when it's loaded
            fileReader.onload = function(event) {
                console.log(event.target.result);
                base64File = event.target.result;
                console.log(fileToLoad.name);
                document.getElementById("pdfFactura").value = event.target.result;
                document.getElementById("pdfNombreFactura").value = fileToLoad.name+"";
               // base64File = event.target.result;
                //AGREGAR AL INPUT PDFFACTURA EL ARCHIVO EN BASE64FILE
               // document.getElementById("pdfFactura").value = base64File;
                //PONER NOMBRE EN PDFNOMBREFACTURA
              //  document.getElementById("pdfNombreFactura").value = fileToLoad.name;
            };
                        
            fileReader.readAsDataURL(fileToLoad);
        }
}

</script>
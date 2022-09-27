<body>
    <div class="container">
        <div class="row d-flex justify-content-center ">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-8">
                <div class="card">
                    <br>
                    <h1 style="color: #001d5a; text-align:center; margin-bottom: 30px" class="center">Agregar Factura
                        </h1>

                        <div class="card-body ">

                            <form id="formFactura" onsubmit="validarFormulario(event)" action="<?php echo ROOT_URL; ?>factura/agregarFactura" method="POST" enctype="multipart/form-data">
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
                                        <label for="formFile" class="form-label">Subir PDF (Obligatorio)</label>
                                        <input class="form-control" id="loadFileFactura" name="loadFileFactura" accept="application/pdf" type="file" width="190px" height="50px" />
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
                                            <label for="monedaFactura" class="col-sm-2 col-form-label"> Monto</label>
                                            <div class="col-sm-4">
                                                <select name="monedaFactura" id="monedaFactura" class="form-control">
                                                    <option value="$ (Pesos Uruguayos)" <?php if($viewmodel["moneda"]=='$U (Pesos Uruguayos)') { echo "selected"; } ?>>$U (Pesos Uruguayos)</option>
                                                    <option value="U$S (Dolares)" <?php if($viewmodel["moneda"]=='U$S (Dolares)') { echo "selected"; } ?>>US$ (Dólares)</option>
                                                    <option value="U.I.(Unidades Indexadas)" <?php if($viewmodel["moneda"]=='U.I.(Unidades Indexadas)') { echo "selected"; } ?> >U.I.(Unidades Indexadas)</option>
                                                    <option value="U.R. (Unidades Reajustables)" <?php if($viewmodel["moneda"]=='U.R. (Unidades Reajustables)') { echo "selected"; } ?> >U.R. (Unidades Reajustables)</option>
                                                    <option value="€ (Euro)" <?php if($viewmodel["moneda"]=='€ (Euro)') { echo "selected"; } ?> >€ (Euro)</option>
                                                </select>
                                            </div>
                                                <div class="col-sm-4">
                                                    <input id="montoFactura" name="montoFactura" type="number" min="0"  class=" form-control" required>
                                                </div>
                                        </div>
                                        <div id="montoRealError" class="center2" style="color:red"></div>

                                        <div class="mb-3 row">
                                            <label for="fecha" class="col-sm-2 col-form-label"> Fecha</label>
                                            <div class="col-sm-4">
                                                <input id="fechaFactura" name="fechaFactura" type="date" class="form-control"  style="max-width: 15rem" required>
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
                                <input type="button" value="CANCELAR" class="btn btn-secondary"  href="<?php echo ROOT_URL; ?>orden/verOrden">
                                <input type="submit" class="btn btn-primary" value="AGREGAR FACTURA"  onclick="abrirModal()" style="margin-top: 20px; margin-bottom: 20px">

                            </form>

                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>

    function validarFormulario(event){
        let errores = "";
        var numeroFactura = document.getElementById('numeroFactura').value;
        var montoFactura = document.getElementById('montoFactura').value;
        var fechaFactura = document.getElementById('fechaFactura').value;
        var loadFileFactura = document.getElementById('loadFileFactura').value;

       
        if(numeroFactura == null || numeroFactura.length == 0 || /^\s+$/.test(numeroFactura)){
            errores = errores + "<p>Debe ingresar un numero de factura</p><hr>";
            event.preventDefault();
        }
        if(montoFactura == null || montoFactura.length == 0 || /^\s+$/.test(montoFactura)){
            errores = errores + "<p>Debe ingresar un monto</p><hr>";
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





</script>
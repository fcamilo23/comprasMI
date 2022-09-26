<body>
<div class="container" >
    <div class="row d-flex justify-content-center ">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8" >
            <div class="card">
                <br>
            <h2 style="color: #001d5a; text-align: center; margin-bottom: 50px" class="center">Agregar Factura</h1>
                
            <div class="card-body ">
                
                    <form id="formOrden" onsubmit="validarFormulario(event)" action="<?php echo ROOT_URL; ?>orden/agregarOrden" method ="POST" enctype="multipart/form-data" >
                           <hr> 
                            <h5><b>DATOS:</b></h5>
                            <div class="input-group mb-3 center2">
                                <div class="column">
                                    <h6><b>ORDEN: </b>OC 54567678 - 2022</h6>
                                    <h6><b>PROVEEDOR: </b>Empresa Matiauda Rodriguez</h6>
                                    <h6><b>Razon Social: </b>Empresa Matiauda Rodriguez.srl</h6>
                                    <h6><b>R.U.T.: </b>30-12345678-9</h6>
                                </div>

                            </div>
                            <hr>
                                <h4 style="color: #001d5a; margin-left: 25px" class="">Subir Archivos</h4>
                                <div class="card-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Subir PDF (*No es obligatorio, puede hacerlo mas adelante)</label>
                                    <input class="form-control" id="loadFile" accept="application/pdf" type="file" onchange="readAsBase64()"  width="190px" height="50px"/>
                                </div>

                                <hr>
                                <table style="max-width: 500px" id="guardado">

                                </table>

                                
                            
                            <label for="numeroFactura" class="form-label"></label>
                            <div class="input-group mb-3 center2">
                                <p class="m-3">N° Factura</p>
                                <input id="numeroFactura" name="numeroFactura" type="text" class="m-2 form-control " required>
                                <div id="numeroError" style="color:red" ></div>
                            </div>
                            

                    
                            <div class="input-group mb-3 center2">
                                <p class="m-3">    Moneda</p>
                                <select name="moneda"  id="moneda" class="m-2 miniinput2 form-control">
                                        <option value="$ (Pesos Uruguayos)" selected>$U (Pesos Uruguayos)</option>
                                        <option value="U$S (Dolares)">US$ (Dólares)</option>
                                        <option value="U.I.(Unidades Indexadas)">U.I.(Unidades Indexadas)</option>
                                        <option value="U.R. (Unidades Reajustables)">U.R. (Unidades Reajustables)</option>
                                        <option value="€ (Euro)">€ (Euro)</option>
                                    </select>
                               <p class="m-3">    Monto:</p>
                                <input id="montoReal" name="montoReal" type="number" min="0"class="m-2 miniinput2 form-control" required>
                            </div>
                            <div id="montoRealError" class="center2"style="color:red" ></div>

                            <div class="input-group mb-3" style="">
                            <label for="fecha" class="m-2 form-label" >Fecha</label>
                                <input id="fecha" name="fecha" type="date" class="form-control" style="max-width: 15rem" required>
                            </div>
                            <div id="fechaError" style="color:red" class="center2"></div>

                         
                            <label for="concepto" class="form-label">Concepto:</label>
                            <div class="input-group mb-3">
                                <textarea id="concepto" name="concepto" class="form-control"></textarea>
                             </div>
                             
                            <br>




                            <label for="numeroAmplicacion" style="margin-top: 40px"></label>
                            <div class="input-group mb-3">
                            <p class="m-2">Nº Ampliación </p>
                                <input id="numeroAmplicacion" style="max-width: 15rem" name="numeroAmpliacion" type="text" class="form-control">
                            </div>
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
                                <label for="fin" class="m-2 form-label">            Fin Servicio</label> 
                                <input id="fin" name="fin" type="date" class="miniinput2 form-control" readonly>
                            </div>
                            <br>
                            <!-- aqui se va a guardar proveedor -->
                            <input id="idProveedor" name="idProveedor" type="hidden" >
                            <!--  -->
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
                                           <input type="button" value="✔️" class="btn btn-light" id="este" onclick="confirmarProveedor(<?php echo $item['id']?>, '<?php echo $item['empresa']?>', '<?php echo $item['rut'] ?>', '<?php echo $item['razon_social'] ?>')" >
                                        </td>
                                    </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                          
                            <hr>
                            

                                <br>
                            <div >           
                                <a class="ml-2" href="<?php echo ROOT_PATH; ?>solicitudes/verSolicitud"><button type="button"  class="btn btn-secondary ml-3">CANCELAR</button></a>
    
                                <input type="submit" class="float-right btn btn-primary " value="GUARDAR">
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
                                        <h5 class="modal-title">CREAR ORDEN:</h5>

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
</body>
<body>
<a href="<?php echo ROOT_URL; ?>orden/verOrden"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>

    <div class="container" style="margin-bottom: 40px" >
        <div class="row d-flex justify-content-center ">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-8">
                <div class="card">
                    <br>
                    <h2 style="color: #001d5a; text-align:center; margin-bottom: 30px" class="center">FACTURA: <?php echo $viewmodel['numeroFactura']?></h2>
                <div class="card-body " style="margin-bottom: 30px">
                    <div class="card">
                        <div class="card-body ">

                                <h5><b>OC: </b> <?php echo $viewmodel['orden']['numeroOrden']?> - <?php echo $viewmodel['orden']['anioOrden'] ?> </h5> 
                                <h5><b>Numero: </b> <?php echo $viewmodel['numeroFactura']?></h3>
                                <h5><b>Fecha: </b> <?php echo $viewmodel['fechaFactura']?></h5>
                                <h5><b>Monto en <?php echo $viewmodel['monedaFactura']?>:</b>  <?php echo $viewmodel['montoFactura']?></h5>
                                <hr>
                                <h5><b>Concepto: </h5>
                                <p><?php echo $viewmodel['conceptoFactura']?></p>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body "> 
                            <h4>PROVEEDOR</h4>
                        
                            <hr>
                            <h5><b>Empresa: </b> <?php echo $viewmodel['proveedor']['empresa']?></h5>
                            <h5><b>Razon Social: </b> <?php echo $viewmodel['proveedor']['razon_social']?></h5>
                            <h5><b>RUT: </b> <?php echo $viewmodel['proveedor']['rut']?></h5>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body "> 
                        <h4>ITEMS</h4>
                        <div id="main-container" style="width: 100%; overflow: auto; max-height: 800px">

                            <table id="listaItems" style="width: 100%;">

                                <thead>
                                    
                                    <tr>
                                        <th style="width: 15%">Cantidad</th>
                                        <th style="width: 15%">Unidad</th>
                                        <th style="width: 50%">Descripcion</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="tablaItems">
                                    <?php foreach($viewmodel['items'] as $item) : ?>
                                        <tr>
                                            <td><?php echo $item['cantidad']; ?></td>
                                            <td><?php echo $item['unidad']; ?></td>
                                            <td><?php echo $item['descripcion']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body "> 
                            <h4>ARCHIVOS</h4>
                            <div id="main-container" style="width: 100%; overflow: auto; max-height: 800px">

                            <table id="listaFactura" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 75%">PDF</th>
                                        <th style="width: 25%">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($viewmodel['archivosFacuturas'] as $archivo) : ?>
                                        <tr>
                                            <td><?php echo $archivo['nombreFactura']; ?></td>
                                            <td>

                                            <form action="<?php echo ROOT_URL; ?>factura/verArchivo" method="post">
                                            <input type="hidden" id="idArchivo" name="idArchivo" value="<?php echo $archivo['idArchivo']; ?>">
                                                <input type="submit" name="submit" value="Ver" style="background: #001d5a; width: 100px; float:right; margin-right: 5%; border: none" class="btn btn-primary sombraAzul"/>
                                            </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                            </table>

                        </div>
                    </div>
                    <h5><b></b>
                </div>
            </div>
        </div>
    </div>
</body>


<!--archivosFacuturas-->
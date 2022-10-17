<body>
<a href="<?php echo ROOT_URL; ?>orden/verOrden"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>

    <div class="container">
        <div class="row d-flex justify-content-center ">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-8">
                <div class="card">
                    <br>
                <h1 style="color: #001d5a; text-align:center; margin-bottom: 30px" class="center">VER FACTURA</h1>

                <div class="card-body ">
                    <div class="card">
                        <div class="card-body ">
                        <form action="<?php echo ROOT_URL; ?>factura/verArchivo" method="post">
                            <input type="hidden" id="idArchivo" name="idArchivo" value="<?php echo $viewmodel['archivosFacuturas']['idArchivo']; ?>">
                            <input type="submit" value="VER ARCHIVO" class="btn btn-primary azul sombraAzul1" style="margin-right: 30px; float: right; margin-bottom: 30px"/>
                        </form>
                                <h5><b>OC: </b> <?php echo $viewmodel['orden']['numeroOrden']?> - <?php echo $viewmodel['orden']['anioOrden'] ?> </h5> 
                                <h3><b>Factura: </b> <?php echo $viewmodel['numeroFactura']?></h3>
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
                        <?php foreach($viewmodel['items'] as $item) : ?>
                        
                            <hr>
                            <h6><?php echo $item['cantidad'].' '.$item['unidad'].'- '.$item['descripcion'].'- '.$item['monto'] ?></h6>
                        <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <h5><b></b>
                </div>
            </div>
        </div>
    </div>
</body>



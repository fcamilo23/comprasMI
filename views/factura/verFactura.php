<body>
<a href="<?php echo ROOT_URL; ?>orden/verOrden"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>

    <div class="container">
        <div class="row d-flex justify-content-center ">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-8">
                <div class="card">
                <h1 style="color: #001d5a; text-align:center; margin-bottom: 30px" class="center">VER FACTURA</h1>
                
                <div class="card-body ">
                <input type="button" value="VER ARCHIVO" class="btn btn-primary azul sombraAzul1" style="margin-right: 30px; float: right; margin-bottom: 30px"/>
                    <h3><b>Factura: </b> <?php echo $viewmodel['numeroFactura']?></h3>
                    <h4><b>Fecha: </b> <?php echo $viewmodel['fechaFactura']?></h4>
                </div>
            </div>
        </div>
    </div>
</body>



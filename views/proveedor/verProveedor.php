<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">PROVEEDOR</h2>
                    <hr>

              <!--       <form action="<?php echo ROOT_URL; ?>proveedor/agregarProveedor" method ="POST" enctype="multipart/form-data" >
                           <label for="empresa" class="form-label">Nombre Empresa</label>
                            <div class="input-group mb-3">
                                <input id="empresa" name="empresa" type="text" class="form-control">
                                <div id=empresaError" class="invalid-feedback"></div>
                            </div>
                            <label for="razon_social" class="form-label">Razon Social</label>
                            <div class="input-group mb-3">
                                <input id="razon_social" name="razon_social" type="text" class="form-control">
                                <div id="razon_socialError" class="invalid-feedback"></div>
                            </div>
                            <label for="rut" class="form-label">R.U.T.</label>
                            <div class="input-group mb-3">
                                <input id="rut" name="rut" type="text" class="form-control">
                                <div id="rutError" class="invalid-feedback"></div>
                            </div>
                            <label for="telefono" class="form-label">Telefono</label>
                            <div class="input-group mb-3">
                                <input id="telefono" name="telefono" type="text" class="form-control">
                                <div id="telefonoError" class="invalid-feedback"></div>
                            </div>
                            <label for="email" class="form-label">Correo</label>
                            <div class="input-group mb-3">
                                <input id="email" name="email" type="text" class="form-control">
                                <div id="emailError" class="invalid-feedback"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>-->
                    <!-- obtener de $viewmodel la row singular empresa-->

                    <h4><b>NOMBRE EMPRESA: </b> <?php echo  $viewmodel["empresa"] ?></h4>
                    <h4><b>RAZON SOCIAL: </b> <?php echo $viewmodel ["razon_social"] ?></h4>
                    <h4><b>R.U.T.: </b> <?php  echo $viewmodel ["rut"] ?></h4>
                    <h4><b>TELEFONO: </b> <?php echo $viewmodel ["telefono"] ?></h4>
                    <h4><b>CORREO: </b> <?php echo $viewmodel ["email"] ?></h4>

                    <div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

                        <table style="width: 100%">
                        

                            <thead>
                                
                                <tr>
                                    <th>Referentes</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tr>

                                <td><input type="text" class="form-control" id="nreferente" name="nreferente"></td>
                                <td><input type="text" class="form-control" id="ncorreo" name="ncorreo"></td>
                                <td><input type="text" class="form-control" id="ntelefono" name="ntelefono"></td>
                                <td>
                                <form action="<?php echo ROOT_PATH; ?>proveedor/verProveedor" method="POST">
                                        <input type="hidden" name="id" id="id" value="<?php echo $item['id']?>">
                                        <button type="submit" class = "btn btn-success">Ampliar</button>
                                    </form>
                                </td>

                            </tr> 
                            <tbody >


                </div>
            </div>
        </div>
    </div>
</div>
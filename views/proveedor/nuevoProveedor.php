<a href="<?php echo ROOT_URL; ?>proveedor/listaProveedores"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Nuevo Proveedor</h2>
                    <form action="<?php echo ROOT_URL; ?>proveedor/agregarProveedor" method ="POST" enctype="multipart/form-data" >
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<body>
<a href="<?php echo ROOT_URL; ?>proveedor/listaProveedores"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">PROVEEDOR</h2>
                    <hr>
                    <?php
                    if(isset($viewmodel["id"]) && $viewmodel["id"] != '') {
                     
                    ?>
                     <form  id="editarProveedor" action="<?php echo ROOT_PATH; ?>proveedor/verProveedor" method="POST">
                        <h5><b>NOMBRE EMPRESA: </b></h5>
                        <input id="empresa" name="empresa" type="text" value="<?php echo $viewmodel["empresa"] ?>" class="editar form-control editar" >
                        <div id="empresaError"></div>
                        <h5><b>RAZON SOCIAL: </b></h5>
                        <input id="razon_social" name="razon_social" type="text" value="<?php echo $viewmodel["razon_social"] ?>" class="editar form-control" >
                        <br>
                        <h5><b>R.U.T.: </b></h5>
                        <input id="rut" name="rut" type="text" value="<?php echo $viewmodel["rut"] ?>" class="editar form-control" >
                        <br>
                        <h5><b>TELEFONO: </b></h5>
                        <input id="telefono" name="telefono" type="text" value="<?php echo $viewmodel["telefono"] ?>" class="editar form-control" >
                        <br>
                        <h5><b>CORREO: </b></h5>
                        <input id="email" name="email" type="text" value="<?php echo $viewmodel["email"] ?>" class="editar form-control" >
                        <br>
                        
                        <input type="hidden" id="id" name="id" value="<?php echo $viewmodel["id"] ?>">
                        <input type="hidden" id="accion" name="accion" value="editarProveedor">
                        <button class="btn btn-success" type="submit">EDITAR</button>

                    </form>
                    <div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

                        <table style="width: 100%">
                        

                            <thead>
                                
                                <tr>
                                    <th>Referente</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tr>
                            <?php foreach($viewmodel['referentes'] as $ref) : ?>
                            <tr>
                                <form  action="<?php echo ROOT_PATH; ?>proveedor/verProveedor" method="POST">
                                    <td><input type="text" class="form-control" id="ereferente" name="ereferente" value="<?php echo $ref['nombre'] ?>"></td>
                                    <td><input type="text" class="form-control" id="etelefono" name="etelefono" value="<?php echo $ref['telefono'] ?>"></td>
                                    <td><input type="text" class="form-control" id="ecorreo" name="ecorreo" value="<?php echo $ref['email'] ?>"></td>
                                    <input type="hidden" name="id" id="id" value="<?php echo $viewmodel["id"] ?>">
                                    <input type="hidden" name="idReferente" id="idReferente" value="<?php echo $ref["id"] ?>">
                                    <input type="hidden" name="accion" id="accion" value="ediproveedor">
                                    <td><button type="submit" class="btn btn-success"> ></button></td>
                                </form>
                            </tr>
                                <?php endforeach; ?>
                                <form id="nform" action="<?php echo ROOT_PATH; ?>proveedor/verProveedor" method="POST">
                                    <td><input type="text" class="form-control" id="nreferente" name="nreferente"></td>
                                    <div id="nreferenteError"></div>
                                    <td><input type="text" class="form-control" id="ncorreo" name="ncorreo"></td>
                                    <td><input type="text" class="form-control" id="ntelefono" name="ntelefono"></td>
                                    <td>
                                    
                                    <input type="hidden" name="id" id="id" value="<?php echo $viewmodel["id"] ?>">
                                    <input type="hidden" name="accion" id="accion" value="newreferente">
                                    <button type="submit" id="nuevo-ref" class = "btn btn-primary">+</button>
                                </form>
                                </td>

                            </tr> 
                            <tbody >


                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else {
    echo "No se ha encontrado el proveedor";
}
?>

<script type="text/javascript">
    document.getElementById("empresa").addEventListener("keyup", empresa_vacio);
    document.getElementById("empresa").addEventListener("blur", empresa_vacio);


    
    function nreferente_vacio(){
        var nreferente = document.getElementById("nreferente").value;
        if(nreferente == null || nreferente.length == 0 || /^\s+$/.test(nreferente)){
            document.getElementById("nreferente").style.border = "1px solid red";
            document.getElementById("nreferenteError").innerHTML = "El Rederente esta vacio";
            return false;
        }else{
            document.getElementById("nreferente").style.border = "1px solid green";
            document.getElementById("nreferenteError").innerHTML = "";
            return true;
        }
    }
    ///no permitir enviar formulario id nform si hay errores en el campo nreferente o ncorreo o ntelefono
    document.getElementById("nform").addEventListener("submit", function(event){
        if(nreferente_vacio() == false){
            event.preventDefault();
        }
    });




    function empresa_vacio(){
        
        var nombre = document.getElementById('empresa');
        
        if(nombre.value == ""){
            nombre.classList.add("is-invalid");
            nombre.classList.remove("is-valid");
            document.getElementById("empresaError").innerHTML = "El nombre de la empresa es obligatorio";
        }
        else{
            nombre.classList.add("is-valid");
            nombre.classList.remove("is-invalid");
            document.getElementById("empresaError").innerHTML = "";
        }
}
//no permitir enviar formulario si empresa esta vacio
document.getElementById("editarProveedor").addEventListener("submit", function(event){
    if(empresa_vacio() == false){
        event.preventDefault();
    }
});

</script>
</body>


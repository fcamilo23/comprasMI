<script>

mensajes();

function mensajes(){
    <?php if($_SESSION['mensaje']['tipo'] != '' ) { ?>

            Swal.fire({
            position: 'top-center',
            icon: '<?php echo $_SESSION['mensaje']['tipo']; ?>',
            title: '<?php echo $_SESSION['mensaje']['contenido']; ?>',
            showConfirmButton: false,
            timer: 3000
            });
    <?php 
        $_SESSION['mensaje']['tipo'] = '';
        $_SESSION['mensaje']['contenido'] = '';
        } ?>
    } 
</script>
<body>
<a href="<?php echo ROOT_URL; ?>proveedor/listaProveedores"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="☰  Lista"/></a>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10">
            <div class="card">
                <div class="card-body" style="padding: 65px">
                    <h2 class="card-title">PROVEEDOR</h2>
                    <hr>
                    <?php
                    if(isset($viewmodel["id"]) && $viewmodel["id"] != '') {
                     
                    ?>

                        <h5><b>Empresa: </b></h5>
                        <input id="empresa" name="empresa" type="text" value="<?php echo $viewmodel["empresa"] ?>" class="editar form-control editar" readonly>
                        <div id="empresaError"></div>
                        <br>
                        <h5><b>Razón Social: </b></h5>
                        <input id="razon_social" name="razon_social" type="text" value="<?php echo $viewmodel["razon_social"] ?>" class="editar form-control" readonly>
                        <br>
                        <h5><b>R.U.T.: </b></h5>
                        <input id="rut" name="rut" type="text" value="<?php echo $viewmodel["rut"] ?>" class="editar form-control" readonly>
                        <br>
                        <h5><b>Teléfono: </b></h5>
                        <input id="telefono" name="telefono" type="text" value="<?php echo $viewmodel["telefono"] ?>" class="editar form-control" readonly>
                        <br>
                        <h5><b>Correo: </b></h5>
                        <input id="email" name="email" type="text" value="<?php echo $viewmodel["email"] ?>" class="editar form-control" readonly>
                        <br>
                        <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
                        <a href= "<?php echo ROOT_PATH; ?>proveedor/editarProveedor"><input type="button" class="btn btn-success" id="editar" name="editar"  value="✏️  Editar  "></a>
                        <?php } ?>
                        <hr>
                    <div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

                        <table style="width: 100%; border: 2px solid rgb(235,235,235)">
                        

                            <thead>
                                
                                <tr>
                                    <th>Referente</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
                                        <th></th>
                                    <?php } ?>

                                </tr>
                            </thead>
                            <tr>
                            <?php foreach($viewmodel['referentes'] as $ref) : ?>
                            <tr>
                                <form  id="editarReferente<?php echo $ref["id"] ?>" action="<?php echo ROOT_PATH; ?>proveedor/editarReferente" method="POST">
                                    <td><input <?php if($_SESSION['user_data']['rol'] == 'Consultor'){ ?> disabled <?php } ?> type="text" class="form-control" id="ereferente<?php echo $ref["id"] ?>" name="ereferente" value="<?php echo $ref['nombre'] ?>"></td>
                                    <td><input <?php if($_SESSION['user_data']['rol'] == 'Consultor'){ ?> disabled <?php } ?>  type="text" class="form-control" id="etelefono" name="etelefono" value="<?php echo $ref['telefono'] ?>"></td>
                                    <td><input <?php if($_SESSION['user_data']['rol'] == 'Consultor'){ ?> disabled <?php } ?>  type="text" class="form-control" id="ecorreo" name="ecorreo" value="<?php echo $ref['email'] ?>"></td>
                                    <input type="hidden" name="id" id="id" value="<?php echo $viewmodel["id"] ?>">
                                    <input type="hidden" name="idReferente" id="idReferente" value="<?php echo $ref["id"] ?>">
                                    <input type="hidden" name="accion" id="accion" value="ediproveedor">
                                    <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
                                        <td><input type="button" onclick="cartelModificarReferente(<?php echo $ref['id'] ?>);" class="btn btn-success" value="✏️"></td>
                                    <?php } ?>

                                </form>
                            </tr>
                                <?php endforeach; ?>
                                
                                <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>

                                <form id="nuevoReferente" action="<?php echo ROOT_PATH; ?>proveedor/agregarReferente" method="POST">
                                    <td><input type="text" class="form-control" id="nreferente" name="nreferente">
                                        <span style="position : static; width:100%; color:red" id="nreferenteError"></span>
                                    </td>

                                    <td><input type="text" class="form-control" id="ncorreo" name="ncorreo"></td>
                                    <td><input type="text" class="form-control" id="ntelefono" name="ntelefono"></td>
                                    <td>
                                    
                                    <input type="hidden" name="id" id="id" value="<?php echo $viewmodel["id"] ?>">
                                    <input type="button" onclick="cartelAgregarReferente();" id="nuevo-ref" class = "btn btn-primary azul" value=" + ">
                                </form>
                                <?php } ?>

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




    document.getElementById("nreferente").addEventListener("keyup", nreferente_vacio);
    document.getElementById("nreferente").addEventListener("blur", nreferente_vacio);

    function nreferente_vacio(){
        var nreferente = document.getElementById("nreferente").value;
        if(nreferente == null || nreferente.length == 0 || /^\s+$/.test(nreferente)){
            document.getElementById("nreferente").style.border = "1px solid red";
            document.getElementById("nreferenteError").innerHTML = "El referente es obligatorio";
            return false;
        }else{
            document.getElementById("nreferente").style.border = "1px solid green";
            document.getElementById("nreferenteError").innerHTML = "";
            return true;
        }
    }

  
function cartelModificarReferente(idReferente){
    var nombre = document.getElementById('ereferente'+idReferente).value;
    if(nombre == ""){
        Swal.fire({
         icon: 'error',
         title: 'Nombre de la empresa vacio',
        
        });
        return;
    }
    else{
        Swal.fire({
        title: 'Seguro que desea modificar el referente?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No, cancelar!',
        confirmButtonText: 'Si, confirmar!'
        }).then((result) => {
            if (result.isConfirmed) {
                //enviar formulario
                document.getElementById("editarReferente"+idReferente).submit();
            }else{
                //crear mensaje de cancelado
                Swal.fire({
                    icon: 'error',
                    title: 'Cancelado',
                    text: 'Todo sigue como estaba!',
                });
            }
        }
        );
    }
}
function cartelAgregarReferente(){
    var nombre = document.getElementById('nreferente');
    if(nreferente_vacio() == false){

        Swal.fire({
         icon: 'error',
         title: 'Nombre de la empresa vacio',
        
        });
        return;
    }
    else{
        Swal.fire({
        title: 'Confirma el agregar referente?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No, cancelar!',
        confirmButtonText: 'Si, confirmar!'
        }).then((result) => {
            if (result.isConfirmed) {
                //enviar formulario
                document.getElementById("nuevoReferente").submit();
            }else{
                //crear mensaje de cancelado
                Swal.fire({
                    icon: 'error',
                    title: 'Cancelado',
                    text: 'No se agregó el referente!',
                });
            }
        }
        );
    }
}

</script>
</body>


<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-body">
                    <br>
                    <h2 class="card-title" style="text-align: center">EDITAR PROVEEDOR</h2><br>
                    <form  id="editarProveedor" action="<?php echo ROOT_PATH; ?>proveedor/realizarEditadoProveedor" method="POST">
                        <h5><b>Empresa: </b></h5>
                        <input id="empresa" name="empresa" type="text" value="<?php echo $viewmodel['empresa'] ?>" class="editar form-control editar">
                        <span style="position : static; width:100%; color:red" id="empresaError"></span>
                        <br>
                        <h5><b>Razón Social: </b></h5>
                        <input id="razon_social" name="razon_social" type="text" value="<?php echo $viewmodel['razon_social'] ?>" class="editar form-control" >
                        <br>
                        <h5><b>R.U.T.: </b></h5>
                        <input id="rut" name="rut" type="text" value="<?php echo $viewmodel['rut'] ?>" class="editar form-control" >
                        <br>
                        <h5><b>Teléfono: </b></h5>
                        <input id="telefono" name="telefono" type="text" value="<?php echo $viewmodel['telefono'] ?>" class="editar form-control" >
                        <br>
                        <h5><b>Correo: </b></h5>
                        <input id="email" name="email" type="text" value="<?php echo $viewmodel['email'] ?>" class="editar form-control" >
                        <br>
                        
                        <input type="hidden" id="id" name="id" value="<?php echo $viewmodel['id'] ?>">
                    </form><br>
                    <a href="<?php echo ROOT_URL; ?>proveedor/verProveedor"><input  class="btn btn-secondary" type="button" value ="Cancelar"></a>
                    <input  class="btn btn-success" onclick="cartelEditarProveedor();" type="button" value ="Guardar Cambios">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("empresa").addEventListener("keyup", empresa_vacio);
    document.getElementById("empresa").addEventListener("blur", empresa_vacio);
    
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

function cartelEditarProveedor(){
    var nombre = document.getElementById('empresa');
    if(nombre.value == ""){
        nombre.classList.add("is-invalid");
        nombre.classList.remove("is-valid");
        document.getElementById("empresaError").innerHTML = "El nombre de la empresa es obligatorio";
        Swal.fire({
         icon: 'error',
         title: 'Nombre de la empresa vacio',
        
        });
        return;
    }
    else{
        Swal.fire({
        title: 'Confirma el modificaciones a proveedor?',
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
                document.getElementById("editarProveedor").submit();
            }else{
                //crear mensaje de cancelado
                Swal.fire({
                    icon: 'error',
                    title: 'Cancelado',
                    text: 'Aun no se ha modificado el proveedor',
                });
            }
        }
        );
    }
}


</script>
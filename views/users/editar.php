

<?php 
if(isset($_SESSION['usuarioActual'])){

if($_SESSION['user_data']['rol'] == 'Consultor' && $_SESSION['usuarioActual']['cedula'] != $_SESSION['user_data']['cedula']){ ?>

<script>
    Swal.fire({
        title: '',
        text: "Debes ser Administrador para editar el perfil de otro usuario",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="<?php echo ROOT_URL; ?>";
        }
    })

</script>

<?php }else{ ?>
<!--
<div class="row col-12" style="height: 850px; margin-top: 10px; background: #e9e9e9; width: 80%; margin-left: 15%">
    <div class="col-lg-6" style="margin-top: 0px;" >
    <a href="<?php echo ROOT_URL; ?>users/listaUsuarios"><div class="opciones"><img class="icons" src="<?php echo ROOT_PATH; ?>imagenes/usuarios.png" alt=""><label class="etiqueta" for="">Gestión de Usuarios</label> </div></a><br> <br>
    <a href="<?php echo ROOT_URL; ?>proveedor/listaProveedores"><div class="opciones"><img class="icons" src="<?php echo ROOT_PATH; ?>imagenes/proveedores.png" alt=""><label class="etiqueta" for="">Gestión de Proveedores</label></div></a> <br> <br>
        
     

    </div>
    
    <div class="col-lg-6" style="margin-top: 0px;" >
        <div>

        <a href="<?php echo ROOT_URL; ?>oficina/listaOficinas"><div class="opciones"><img class="icons" src="<?php echo ROOT_PATH; ?>imagenes/oficinas.png" alt=""><label class="etiqueta"  for="">Gestión de Oficinas</label></div></a><br><br>
        <a href="<?php echo ROOT_URL; ?>solicitudes/listaSolicitudes"><div class="opciones"><img class="icons" src="<?php echo ROOT_PATH; ?>imagenes/solicitudes.png" alt=""><label class="etiqueta" for="">Solicitudes de Compra</label></div></a>

            <!--
        <a href="<?php echo ROOT_URL; ?>comprar/pedidosUser"><button style="margin-top: 50px; background: #7d86c5; border: 1px solid white; width: 70%; color: black" class="btn btn-primary">Gestión de Usuarios</button></a><br>
        <a href="<?php echo ROOT_URL; ?>viajes/viajesUser"><button style="margin-top: 50px; background: #7d86c5; border: 1px solid white; width: 70%; color: black" class="btn btn-primary">Gestión de Proveedores</button></a><br>
        <a href="<?php echo ROOT_URL; ?>users/cuponesUser"><button style="margin-top: 50px; background: #7d86c5; border: 1px solid white; width: 70%; color: black" class="btn btn-primary">Solicitudes de Compra</button></a><br>
        <a href="<?php echo ROOT_URL; ?>users/postulacionesUser"><button style="margin-top: 50px; background: #7d86c5; border: 1px solid white; width: 70%; color: black" class="btn btn-primary">Gestión de Oficinas</button></a><br>
        <a href="<?php echo ROOT_URL; ?>users/logout"><button style="margin-top: 60%; background: #7c1010; border: none; width: 70%;" class="btn btn-primary">Logout</button></a><br>


--



</div></div>
-->
<a href="<?php echo ROOT_URL; ?>users/listaUsuarios"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄ Atrás"/></a>
<?php if($_SESSION['user_data']['cedula'] == $_SESSION['usuarioActual']['cedula']){ ?>
    <input type="button" style=" margin-right: 30px; float: right"class="btn btn-success sombra" onclick="alertPassword()" value="Actualizar Contraseña"/>
    <input type="submit" name="resetPass" id="resetPass" style="display: none">
<?php } ?>

       
<div class="col-12 perfil center" style="padding: 50px; background: white; margin-top: 60px">
   
    <div  >
    <form id="editarUsuario" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

    <!--<img src="<?php echo ROOT_PATH; ?>imagenes/minterior1.png" alt="" class="iii " style="width: 300px; height: 170px;margin-top: 20px; margin-bottom: 30px; margin-left: 20%">
    <img src="<?php echo ROOT_URL; ?>imagenes/us.png" class="center" style="width: 200px; height: 200px" alt="">-->

    <h1 class="" style="">Editar Usuario</h1>

    <h5 class="" style="margin-top: 25px"><?php echo $_SESSION['usuarioActual']['nombre']; ?> <?php echo $_SESSION['usuarioActual']['apellido']; ?>, <?php echo $_SESSION['usuarioActual']['cedula']; ?></h4>


    </div>   
    <label  style="float: left; margin-top: 45px; color: rgb(130, 130, 130)">CI:</label>
    <input class="form-control" name="ciActual" style=" display:none" value="<?php echo $_SESSION['usuarioActual']['cedula']; ?>"/> <br>
    <input required class="form-control" name="ci" style=" font-size: 20px; width: 100%; margin-bottom: 0px" value="<?php echo $_SESSION['usuarioActual']['cedula']; ?>"/> <br>
    
    <label  style="float: left; margin-top: 5px; color: rgb(130, 130, 130)">Nombre:</label>
    <input required class="form-control" name="nombre" style="font-size: 20px; width: 100%; margin: 0px" value="<?php echo $_SESSION['usuarioActual']['nombre']; ?>" /> <br>
    
    <label  style="float: left; margin-top: 5px; color: rgb(130, 130, 130)">Apellido:</label>
    <input required class="form-control" name="apellido" style="font-size: 20px; width: 100%; margin: 0px" value="<?php echo $_SESSION['usuarioActual']['apellido']; ?>" /> <br>
    
    <label  style="float: left; margin-top: 5px; color: rgb(130, 130, 130)">Email:</label>
    <input required class="form-control" name="email" style="font-size: 20px; width: 100%; margin: 0px"value="<?php echo $_SESSION['usuarioActual']['email']; ?>" /> <br>
    
    <label  style="float: left; margin-top: 5px; color: rgb(130, 130, 130)">Rol:</label>
    <?php if($_SESSION['user_data']['rol'] == 'Administrador'){ ?>
    <select class="form-control" style="font-size: 20px" name="rol" id="rol">
        <option <?php if($_SESSION['usuarioActual']['rol'] == 'Consultor'){?> selected <?php } ?> value="Consultor"> Consultor </option>
        <option <?php if($_SESSION['usuarioActual']['rol'] == 'Operador'){?> selected <?php } ?> value="Operador"> Operador </option>
        <option <?php if($_SESSION['usuarioActual']['rol'] == 'Administrador'){?> selected <?php } ?> value="Administrador"> Administrador </option>

    </select>
    <?php } else{?>
        <input readonly class="form-control" name="rol" style="font-size: 20px; width: 100%; margin: 0px" value="<?php echo $_SESSION['usuarioActual']['rol']; ?>" /> <br>
    <?php }?>

    <input type="submit" name="submit" value="Guardar Cambios" class="btn btn-primary sombraAzul" style="margin-top: 50px">

    <?php if($_SESSION['user_data']['cedula'] != $_SESSION['usuarioActual']['cedula']){?>
    <input type="submit" name="submit" value="Eliminar Usuario" class="btn btnEliminar sombraRoja" style="margin-top: 50px; margin-left: 20px; color:white">
    <?php } ?>

</form>


</div>
<div>
    <h1 style="visibility: hidden"> asdasd</h1>
</div>
<div></div>



<script>

function alertPassword(){
  
        Swal.fire({
            title: 'Seguro que desea actualizar su contraseña?',
            text: "Se le enviará un código de reestablecimiento a su correo",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, cancelar!',
            confirmButtonText: 'Si, cambiar contraseña!'
            }).then((result) => {
        if (result.isConfirmed) {

            window.location.href = 'resetPassword';

            
            //document.getElementById('resetPassword').click();
            

        }
})


   

}

</script>


<?php }}else{   ?>
    
<script>
    Swal.fire({
        title: 'Que intentas hacer? ',
        text: "No puedes ingresar las rutas directas para navegar en la web, la romperás 😠 ",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location="<?php echo ROOT_URL; ?>";
        }
    })

</script>

<?php } ?>
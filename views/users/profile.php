
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


       
<div class="col-12 perfil center" style="padding: 50px; background: white; margin-top: 60px">
   
    <div  >
    <!--<img src="<?php echo ROOT_PATH; ?>imagenes/minterior1.png" alt="" class="iii " style="width: 300px; height: 170px;margin-top: 20px; margin-bottom: 30px; margin-left: 20%">-->
    <img src="<?php echo ROOT_URL; ?>imagenes/us.png" class="center" style="width: 200px; height: 200px" alt="">
    </div>   
    <label  style="float: left; margin-top: 45px; color: rgb(130, 130, 130)">CI:</label>
    <input class="form-control" style="border: none; font-size: 20px; width: 100%; margin-bottom: 0px" value="<?php echo $_SESSION['user_data']['cedula']; ?>" disabled/> <br>
    
    <label  style="float: left; margin-top: 5px; color: rgb(130, 130, 130)">Nombre:</label>
    <input class="form-control" style="border: none; font-size: 20px; width: 100%; margin: 0px" value="<?php echo $_SESSION['user_data']['nombre']; ?> <?php echo $_SESSION['user_data']['apellido']; ?>" disabled/> <br>
    
    <label  style="float: left; margin-top: 5px; color: rgb(130, 130, 130)">Email:</label>
    <input class="form-control" style="border: none; font-size: 20px; width: 100%; margin: 0px"value="<?php echo $_SESSION['user_data']['email']; ?>" disabled/> <br>
    
    <label  style="float: left; margin-top: 5px; color: rgb(130, 130, 130)">Rol:</label>
    <input class="form-control" style="border: none; font-size: 20px; width: 100%; margin: 0px" value="<?php echo $_SESSION['user_data']['rol']; ?>" disabled/> 


</div>
<div>
    <h1 style="visibility: hidden"> asdasd</h1>
</div>
<div></div>


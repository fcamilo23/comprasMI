
<html>

<head>
    <title>Gestión de Compras</title>

    <meta name="google-signin-client_id"
        content="233819586639-6vk3d8qfqbkukjjusenrldpg989rs7h8.apps.googleusercontent.com">
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <!-- BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    
    <!-- Icons boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>            

    
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--Excel -->

<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet"/>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="<?php echo ROOT_PATH; ?>assets/css/datatables.min.js?v=<?php echo time(); ?>" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
<script src="<?php echo ROOT_PATH; ?>assets/css/buttons.html5.min.js?v=<?php echo time(); ?>" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" crossorigin="anonymous"></script>
<!--<script src="<?php echo ROOT_PATH; ?>assets/css/css/package.json"></script>-->







    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/botoneslib.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/search.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/menu.css?v=<?php echo time(); ?>">








    
    <link rel="icon" href="../imagenes/minterior1 - copia.png">
</head>


<body style="background: #e9e9e9" onkeydown="if(event.keyCode==13){event.keyCode=9; return event.keyCode}">
    <nav id="barra" class="nav1">
    
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
            <a href="<?php echo ROOT_URL.'users/logout'; ?>"><div class="hv" >
            <label for="" alt="Cerrar Sesión" class="interacciones" style="margin-top:15px; margin-left: 0px">
                <i class="elhov" style="margin-right: 0px; margin-left: 0px"><img src="<?php echo ROOT_URL.'imagenes/logout.png' ?>" style="width:50px; height:50px;" alt=""></i>


            </label>
            <ul>
            <li class="iconmargen"><label style="text-decoration: none; margin-right: 0px" class="elhov1">Logout</label></li>
            </ul>
        </div></a>

            <a href="<?php echo ROOT_URL.'users/profile'; ?>"><div class="hv" >
            <label for="" class="interacciones">
                <i 
                        class="fas fa-user elhov iconmargen1"></i>

            </label>
            


        <ul>    
       <!--
        <li style="margin-right: 0px; margin-top: 20px">
        <form id="formBusqueda">
        <select name="select" id="select" style="border-radius: 6px; margin-left:10px; margin-top: 0px; margin-right: 0px; height: 40px; width: 70px; float: left">
        <option value="viaje" selected>Viaje</option>
        <option value="articulo">Pedido</option>
        <option value="" selected>Filtro</option>
        </select>
        <input type="text" class="form-control" name="txtbusca" style="margin-left: 10px; margin-top: 0px; margin-right: 250px; height: 40px; width: 450px; float: left" id="txtbusca" placeholder="Buscar" aria-label="Buscar" aria-describedby="basic-addon2">
   
        <button name="Btn_buscar" id="Btn_buscar" type="submit" class="btn btn-primary" style="display: none;border: 1px solid; margin-left: 10px; margin-top: 0px; margin-right: 0px; height: 40px; width: 80px; float: left; margin-right: 200px; background: #0d0f1d">Buscar</button>
     </form>
        </li>-->
        
        <li class="iconmargen" ><label style="text-decoration: none" class="elhov1"><?php echo $_SESSION['user_data']['nombre']; ?> <?php echo $_SESSION['user_data']['apellido']; ?></label></li>

        </ul>
        </div></a>
        <label style="margin-right: 10px" id="barrita" for="check" class="checkbtn interacciones1">
                <i 
                         class="fas fa-bars elhov"></i>

        </label>
        
<input type="checkbox" id="check">
<div id="menux1" class="container-menu" style="z-index:2;" >
    <div id="menux" class="cont-menu">
        <div style="">
            <label for="check" id="a0"><h1 style="float: right; margin-right:10px; color: grey; font-size: 40px; cursor:pointer;"></h1></p><br><br>

        </div>
        <nav id="nav">

            <a id="a1" href="<?php echo ROOT_URL; ?>solicitudes/listaSolicitudes">Solicitudes de Compra</a>
            <a id="a2" href="<?php echo ROOT_URL; ?>orden/comprasRealizadas">Compras Realizadas</a>
            <a id="a3" href="<?php echo ROOT_URL; ?>oficina/listaOficinas">Unidades Ejecutoras</a>
            <a id="a4" href="<?php echo ROOT_URL; ?>users/listaUsuarios">Usuarios</a>
            <a id="a5" href="<?php echo ROOT_URL; ?>proveedor/listaProveedores">Proveedores</a>
            <p onclick="return false" name="abrirReportes" id="abrirReportes" ><button onclick="return false" style="font-size: 22px;  background: none; border: none; color: rgb(200,200,200)">Reportes</button></p>

            

            <input type="checkbox" style="display:none" id="checkmodal">


        </nav>
        <dialog class="" id="modalreportes" style="width: 300px; background: #025396; margin-left: 340px; margin-top: -25px; border: none; border-radius: 0px; padding: 25px;  z-index: 1; animation: createBox .15s; border: none">
            <a class="optReportes" href="<?php echo ROOT_URL; ?>orden/contratosAVencer" style="border:none"><div style="border:none" class="optReportes">   Vencimientos</div></a><br>
            <a class="optReportes" href="<?php echo ROOT_URL; ?>solicitudes/ejecucionInversiones"><div class="optReportes">   Ejecución de Inversiones</div></a><br>
            <a class="optReportes" href="<?php echo ROOT_URL; ?>orden/entregasPendientes"><div class="optReportes">   Entregas Pendientes</div></a>
        </dialog>
        

    </div>


</div>
        
    
        <?php else : ?>
                <a style="display: none; cursor: pointer;" class="loginregisterBtn" href="<?php echo ROOT_URL; ?>users/register" >Registrarse</a> 
                <a style="cursor: pointer;" class="btn btn-primary loginBtn sombraAzul" href="<?php echo ROOT_URL; ?>users/login">Iniciar Sesión</a>
                
        <?php endif; ?>
        

        <a href="<?php echo ROOT_URL; ?>" class="enlace">
            <img src="<?php echo ROOT_PATH; ?>imagenes/minterior.png" alt="" class="logo">
        </a>
        
        
    </nav>
    
    <div class="container">
    <div class="input-group mb-3" style=" width: 700px;  margin-left: 30%">
        <input type="text" class="form-control" style="display: none; margin-top: 25px; height: 55px;" id="txtbusca" placeholder="Buscar" aria-label="Buscar" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <span class="input-group-text" style="display: none; margin-top: 25px; height: 55px; background-color: #0d0f1d; color: white; border:none" id="basic-addon2">BUSCAR</span>
        </div>
    </div>
    <div class="salida"></div>
    </div>
    <!--  <section></section> -->
    <!-- /.container -->
</body>
<div class="">

    <div style="" class="">
        <!-- <div class="col-lg-3" style="background-color:red;">dasddsadas</div> -->
        <?php Messages::display(); ?>
        <?php require($view); ?>
    </div>

</div><!-- /.container -->

</body>


</html>

<script>
        function buscar()
        {    
            location.reload();
        }
    </script>
    <script>
        $(document).ready(function(){
            $('#formBusqueda').submit(function(e){
                e.preventDefault();
                var parametros = document.getElementById("txtbusca").value;
                var selection = document.getElementById("select");

                var data = $(this).serializeArray();
                data.push({name: 'texto', value: parametros});
                data.push({name: 'filtro', value: selection.options[selection.selectedIndex].value});

                let a = "<?php echo ROOT_PATH; ?>";
                $.ajax({
                    url:   a+'home/buscarContenido',
                    type:  'POST',
                    data:  data,
                });
                location.reload();

            })
        })



        $(document).on("click",function(e) {
/*
            var container = $("#menux");
            var barra = $("#barra");
            
            if (!barra.is(e.target) && barra.has(e.target).length === 0) { 

                if (!container.is(e.target) && container.has(e.target).length === 0) { 
                    alert(1);

                        var container1 = $("#menux1");
                        if(document.getElementById("check").checked == true){
                                alert('123');
                            

                        }


                    //Se ha pulsado en cualquier lado fuera de los elementos contenidos en la variable container

                    }

                }
                
        */    
                    
});
        
    </script>





<script>
        const abrirModal1 = document.querySelector("#abrirReportes");
        const modal1 = document.querySelector("#modalreportes");
        const nav = document.querySelector("#nav");
        const checkmodal = document.querySelector("#checkmodal");
        const a1 = document.querySelector("#a1");
        const a2 = document.querySelector("#a2");
        const a3 = document.querySelector("#a3");
        const a4 = document.querySelector("#a4");
        const a5 = document.querySelector("#a5");
        const check = document.querySelector("#check");
        const menux1 = document.querySelector("#menux1");




        //const cerrarModal1 = document.querySelector("#cerrarReportes");


        abrirModal1.addEventListener("mouseenter",()=>{

                //abrirModal1.classList.add("mystyle");
                if(checkmodal.checked == false){
                    modal1.show();
                    abrirModal1.classList.add("hoverp");
                    checkmodal.checked = true;
                    return false; 
                }else{
                    modal1.close();
                    abrirModal1.classList.remove("hoverp");
                    checkmodal.checked = false; 
                    return false; 
                }
                
                
                

            
        })

        
        a0.addEventListener("mouseenter",()=>{

        //abrirModal1.classList.add("mystyle");

            modal1.close();
            abrirModal1.classList.remove("hoverp");
            checkmodal.checked = false; 

        })
        a1.addEventListener("mouseenter",()=>{

            //abrirModal1.classList.add("mystyle");
           
                modal1.close();
                abrirModal1.classList.remove("hoverp");
                checkmodal.checked = false; 

        })
                    a2.addEventListener("mouseenter",()=>{

            //abrirModal1.classList.add("mystyle");

                modal1.close();
                abrirModal1.classList.remove("hoverp");
                checkmodal.checked = false; 

            })
            a3.addEventListener("mouseenter",()=>{

            //abrirModal1.classList.add("mystyle");

                modal1.close();
                abrirModal1.classList.remove("hoverp");
                checkmodal.checked = false; 

            })
            a4.addEventListener("mouseenter",()=>{

            //abrirModal1.classList.add("mystyle");

                modal1.close();
                abrirModal1.classList.remove("hoverp");
                checkmodal.checked = false; 

            })
            a5.addEventListener("mouseenter",()=>{

            //abrirModal1.classList.add("mystyle");

                modal1.close();
                abrirModal1.classList.remove("hoverp");
                checkmodal.checked = false; 

            })

            menux1.addEventListener("click",()=>{

            //abrirModal1.classList.add("mystyle");

                check.checked = false; 

            })

        
        function selectCheck()
        {    
            if(checkmodal.checked == false){
                    modal1.show();
                    abrirModal1.classList.add("hoverp");
                    checkmodal.checked = true;
                }else{
                    modal1.close();
                    abrirModal1.classList.remove("hoverp");
                    checkmodal.checked = false; 
                }
                
        }


    </script>
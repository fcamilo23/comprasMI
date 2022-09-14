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
    
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--Excel -->
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/>

<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet"/>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" crossorigin="anonymous"></script>




    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/botoneslib.min.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/menu.css?v=<?php echo time(); ?>">

    
    <link rel="icon" href="../imagenes/sss.png">
</head>


<body style="background: #e9e9e9" >
    <nav>
    
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
            <a href="<?php echo ROOT_URL.'users/profile'; ?>"><div class="hv" >
            <label for="" class="interacciones">
                <i style="margin-right: 40px;"
                        class="fas fa-user elhov"></i>
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
        <li><label style="text-decoration: none" class="elhov1"><?php echo $_SESSION['user_data']['nombre']; ?> <?php echo $_SESSION['user_data']['apellido']; ?></label></li>

        </ul>
        </div></a>
    
        <?php else : ?>
                <a style="display: none; cursor: pointer;" class="loginregisterBtn" href="<?php echo ROOT_URL; ?>users/register" >Registrarse</a> 
                <a style="cursor: pointer;" class="btn btn-primary loginBtn sombraAzul" href="<?php echo ROOT_URL; ?>users/login">Iniciar Sesión</a>
                
        <?php endif; ?>

        <a href="<?php echo ROOT_URL; ?>" class="enlace">
            <img src="<?php echo ROOT_PATH; ?>imagenes/minterior.jpg" alt="" class="logo">
        </a>
        
    </nav>
    <?php
        if(isset($_SESSION['contenidoBuscado'])){
            ?>
                <div class="container">
                    <div class="row col-12" style="width: 100%; margin-right: 200px; margin-top: 25px; background: #0d0f1d; border: 10px solid #1c1e25;">
                        <h1 style="text-align: center; margin-top: 50px; color: #fff;" >Resultado de Busqueda</h1>
                        <table style="padding: 5px; margin-top: 15px" class="table table-bordered">
                            <thead>
                                
                                <tr>
                                    <th style="text-align: center">Id</th>
                                    <th style="text-align: center">Titulo</th>
                                    <th style="text-align: center">Descripción</th>
                                    <th style="text-align: center">Precio</th>
                                    <th style="text-align: center">Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr> <?php foreach($_SESSION['contenidoBuscado'] as $item) : ?>
                                    <td style="line-height: 100px"><?php echo $item['idPedido']; ?></td>
                                    <td style="line-height: 100px"><?php echo $item['titulo']; ?></td>
                                    <td style="line-height: 100px"><?php echo $item['descripcion']; ?></td>
                                    <td style="line-height: 100px"><?php echo $item['precio']; ?></td>
                                    <td style="line-height: 100px"><img src="<?php echo $item['imagen'];?>" alt="Image" style="width: 100px; height: 100px"></td>
                                </tr>
                                <?php endforeach; ?>         
                            </tbody>    
                        </table>    
                    </div>
                </div>
            <?php
            unset($_SESSION['contenidoBuscado']);                                                                                               
        }
        elseif(isset($_SESSION['contenidoBuscado2'])){
            ?>
                <div class="container">
                    <div class="row col-12" style="width: 100%; margin-right: 200px; margin-top: 25px; background: #0d0f1d; border: 10px solid #1c1e25;">
                        <h1 style="text-align: center; margin-top: 50px; color: #fff;" >Resultado de Busqueda</h1>
                        <table style="padding: 5px; margin-top: 15px" class="table table-bordered">
                            <thead>
                                
                                <tr>
                                    <th style="text-align: center">Id</th>
                                    <th style="text-align: center">IdViajero</th>
                                    <th style="text-align: center">Origen</th>
                                    <th style="text-align: center">Destino</th>
                                    <th style="text-align: center">Fecha de Arribo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr> <?php foreach($_SESSION['contenidoBuscado2'] as $item) : ?>
                                    <td style="line-height: 100px"><?php echo $item['idViaje']; ?></td>
                                    <td style="line-height: 100px"><?php echo $item['idViajero']; ?></td>
                                    <td style="line-height: 100px"><?php echo $item['origen']; ?></td>
                                    <td style="line-height: 100px"><?php echo $item['destino']; ?></td>
                                    <td style="line-height: 100px"><?php echo $item['fechaArribo']; ?></td>
                                </tr>
                                <?php endforeach; ?>         
                            </tbody>    
                        </table>    
                    </div>
                </div>
            <?php
            unset($_SESSION['contenidoBuscado2']);                                                                                               
        }
    ?>
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
    </script>
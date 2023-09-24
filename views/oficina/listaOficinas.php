<body>
<a href="<?php echo ROOT_URL; ?>"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>
<nav class="navbar navbar-light bg-light mt-2" style="width: 100%;">
        <h2 style="color: #025396; text-align: center;"class="center">Unidades Ejecutoras</h2>
</nav>
<div class="container mt-2 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-10">
            <div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

                    <table style="width: 100%">
                    

                        <thead>
                            
                            <tr>
                                <th>UNIDAD</th>
                                <th>UE</th>
                                <th></th>

                            </tr>
                        <?php 
                        $read = "";
                        if($_SESSION['user_data']['rol'] != 'Administrador'){ 
                            $read = 'readonly';
                        }
                            ?>
                            

                        </thead>
                        <tbody>
                        <tr><?php foreach($viewmodel as $item) : ?>
                            <form action="<?php echo ROOT_PATH; ?>oficina/listaOficinas" method="post">
                            <td><input type="text" class="miniinput form-control" name="eid" id="eid"value="<?php echo $item['unidad'] ?>" readonly></td>
                            <td><input type="text" class="form-control" name="eue" id="eue"value="<?php echo $item['ue'] ?>" <?php echo $read; ?>><div id="errorEue" ></td>
                            <?php if($_SESSION['user_data']['rol'] == 'Administrador'){ ?>
                            <td>
                            <input type="hidden" name="accion" id="accion" value="editar">
                                <button class = "btn btn-primary" type="submit">✒️</button>
                            </td>
                            <?php } ?>
                            </form>
                        </tr> <?php endforeach; ?>
                        <?php if($_SESSION['user_data']['rol'] == 'Administrador'){ ?>
                        <tr>
                            <form action="<?php echo ROOT_PATH; ?>oficina/listaOficinas" method="post">
                                <td><input type="text" name="nid" class="miniinput form-control" id="nid" value="" ><div id="errorNid"></div></td>
                                
                                <td><input type="text" name="nue" class="form-control" id="nue" value=""><div id="errorNue"></div></td>
                                
                                <td>
                                <input type="hidden" id="accion" name="accion" value="nuevo" readonly>
                                    <button class ="btn btn-primary"  type="submit">+</button>
                                </td>
                            </form>
                        </tr>
                        <?php } ?>

                        </tbody>
                </table>
            </div>
        </div>
    </div>
<script>


</script>

</body>

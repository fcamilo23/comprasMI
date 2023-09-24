<form id="filtro" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       

<dialog class="divfiltros center" id="modalfiltros" style="z-index: 1; animation: createBox .15s">
<h2 class="" style="display: inline-block; ">Nueva Cotización</h2> <br><br><br>
    <div class="">

<div style="display: inline-block">
    <label for="" >Año:                           </label>
</div>
<div style="display: inline-block">
    <input type="number" name="anioNuevo" class="form-control" placeholder="" maxlength="4"  onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
</div>

<br><br><br><br>
    
<div style="display: inline-block">
    <label for="" >Dólar:                         </label>
</div>
<div style="display: inline-block">
    <input type="text" name="dolar" class="form-control" placeholder="Ingrese valor en $U" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
</div>

<br><br>

<div style="display: inline-block">
    <label for="" >Euro:                          </label>
</div>
<div style="display: inline-block">
    <input type="text" name="euro" class="form-control" placeholder="Ingrese valor en $U" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
</div>

<br><br>

<div style="display: inline-block">
    <label for="" >Unidad Indexada:      </label>
</div>
<div style="display: inline-block">
    <input type="text" name="ui" class="form-control" placeholder="Ingrese valor en $U" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
</div>

<br><br>

<div style="display: inline-block">
    <label for="" >Unidad Reajustable:  </label>
</div>
<div style="display: inline-block">
    <input type="text" name="ur" class="form-control" placeholder="Ingrese valor en $U" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
</div>


  

        


        </div>

        <input type="submit" name="submit"  class="btn sombraAzul center " style="color:white; float:right; margin-right: 2%; width: 100px; margin-top:40px; background: #025396" value="Confirmar"/>
        <label  id="cerrarFiltros" class="btn sombra center " style="color:white; float:right; margin-right: 4%; width: 100px; margin-top:40px; background: #999999">Cancelar </label>
</dialog>
</form>



<form id="filtroanio" name="filtroanio" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

<?php //echo $_SESSION['anioInversiones']; ?>
    <script>
        
        $(document).ready(function() {
         $('#solis').DataTable( {
             buttons: [
                {
                extend: 'excelHtml5',
                title: 'Ejecución de Inversiones <?php echo date('d-m-Y'); ?>'
            }
             ],
             order: [[2, 'asc']],
             dom: 'lBfrtip',
             "columnDefs": [ {
                 "targets": [],
                 "searchable": false,
                 
                 } ,
                 {
                 "targets": [],
                 "visible": false,
                 }
             
                ]
             
 
         } );
     } );
 
 
 /*
     $(document).ready(function () {
     // Setup - add a text input to each footer cell
     $('#solis tfoot th').each(function () {
         var title = $(this).text();
         $(this).html('<input type="text" placeholder="Search ' + title + '" />');
     });
  
     // DataTable
     var table = $('#solis').DataTable({
         initComplete: function () {
             // Apply the search
             this.api()
                 .columns()
                 .every(function () {
                     var that = this;
  
                     $('input', this.footer()).on('keyup change clear', function () {
                         if (that.search() !== this.value) {
                             that.search(this.value).draw();
                         }
                     });
                 });
         },
     });
 });*/
 
     </script>
 

<!--     <label id="cerrarFiltros" style="cursor: pointer; display: inline-block; font-size: 40px; background: none; border: none; float:right">×</label>
 -->






 
 <?php 
     if(isset($_SESSION['alertaSolicitud'])){ ?>
     <script>
         Swal.fire({
             position: 'center',
             icon: 'success',
             title: 'Perfecto! Se ha registrado la nueva solicitud',
             showConfirmButton: false,
             timer: 1500
         })
     </script>
 
     <?php
     unset($_SESSION['alertaSolicitud']);
 
     }
 ?>
     
     <a href="<?php echo ROOT_URL; ?>solicitudes/ejecucionInversiones"><input type="button" style=" margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄  Volver al reporte"/></a>
 
 <!--<button type="button" tabindex="0" aria-controls="solis" class="excel sombraVerde"> <img src="<?php echo ROOT_PATH; ?>imagenes/Excel1.jpg" width="150px" height="50px" ></button>-->
 <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
    <label class="filtrado sombra" style ="cursor: pointer; padding:5px; font-size: 25px; float:right; margin-right: 40px; margin-left: 100px; border:none; background:#e9e9e9" id="abrirFiltros" > <i class="fas fa-plus" style="color:#303030" ></i> <p style="height: 10px; font-size: 20px;display: inline-block">Nueva Cotización</p></label>

<?php } ?>


 <input type="submit" name="submit" id="submit" class="btn azul" style="color: white; float:right; margin-right: 50px "  value="Seleccionar" />
 <select name="anio" class="form-control"  onchange="selectAnio()" style="float: right; width: 140px; float: right; margin-bottom: 0px" id="anio">
 <option value="" selected></option>
 <?php  foreach($viewmodel as $item) : $anio = date('Y')?>

                <option  value="<?php echo $item['anio']; ?>" ><?php echo $item['anio']; ?></option>
                
<?php endforeach; ?>



 </select> 
 <!--

 <select name="anio" class="form-control" onchange="selectAnio(this)" style="float: right; width: 140px; float: right; margin-bottom: 0px" id="">
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030</option>
    <option value="2031">2031</option>
    <option value="2032">2032</option>
    <option value="2033">2033</option>
    <option value="2034">2034</option>
    <option value="2035">2035</option>
    <option value="2036">2036</option>
    <option value="2037">2037</option>
    <option value="2038">2038</option>
    <option value="2039">2039</option>
    <option value="2040">2040</option>
    <option value="">Histórico</option>



 </select>-->
 <label for="" style="float: right;margin-right: 10px; margin-top: 5px; font-size: 20px">Año: </label>

 
 
 <div id="main-container" style="width: 100%; overflow: auto; padding: 25px; background: #fff"> <!--  max-height: 800px -->
    
        <h1 class="center" style="margin-bottom: 30px"> Cotizaciones del año <?php echo $_SESSION['anioCotizacion']; ?></h1>
 
         <table id="solis" style="width: 100%;">
 
             <thead>
                 
                 <tr >
                     <th>Moneda</th>
                     <th style="width: 10%" >Cotización ($U)</th>
                    
 
 
 
                 </tr>
             </thead>
             <tbody >
             <tr ><?php $i = 1; foreach($_SESSION['cotizaciones'] as $item) : ?>
                 <td><?php echo $item['moneda']; ?></td>
                 <td ><input style="width: 180px" type="text" name="<?php echo $i; ?>" id="<?php echo $item['moneda'];?>" readonly class="form-control" value="<?php echo $item['valor']; ?>" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" ></td>
                    <input type="text" style="display: none" name="anioc" value="<?php echo $item['anio']; ?> ">
                <!-- <form id="editar" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       
                 <td><input type="text" name="numero" style="display: none" value="<?php echo $item['id']; ?>"/>
                 <input type="submit" name="submit" value="Ampliar" style="background: #025396; border: none" class="btn btn-primary sombraAzul"/></td>
                 </form> -->
                 <?php $i++ ?>
 
             </tr> <?php endforeach; ?>
             </tbody>
         </table>
 
                <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
                <label class="btn amarillo" onclick="habilitarinputs(this)" id="habilitarinputs" style="width: 120px; float:right; margin-top: 50px" for="">✏️ Editar</label>


                <input type="submit" name="submit" id="editar" value="Guardar Cambios" class="btn azul" style="color:white; display:none; float: right; margin-top: 50px">

                <label class="btn amarillo" onclick="inhabilitarinputs(this)" id="inhabilitarinputs" style="display: none; background: #999999; margin-right: 20px; color:white; float:right; margin-top: 50px" for="">Cancelar</label>
                    <?php } ?>
     </div>
     </form>

 
     <script>
         const abrirModal = document.querySelector("#abrirFiltros");
         const modal = document.querySelector("#modalfiltros");
         const cerrarModal = document.querySelector("#cerrarFiltros");
 
 
         abrirModal.addEventListener("click",()=>{
 
                 abrirModal.classList.add("mystyle");
 
                 modal.show();
 
             
         })
         cerrarModal.addEventListener("click",()=>{
 
                 modal.close();
                 abrirModal.classList.remove("mystyle");
 
 
        
         })
 
 
         function cambiarFecha(ini){
             
             const fin = document.getElementById("fechaIni").value;
             document.getElementById("fechaFin").value = fin;
             document.getElementById("fechaFin").min = fin;
             document.getElementById("fechaFin").disabled = false;
 
 
         }

 
            $d = document.getElementById('Dolar').value;
            $e = document.getElementById('€ (Euro)').value;
            $ui = document.getElementById('U.I.(Unidades Indexadas)').value;
            $ur = document.getElementById('U.R. (Unidades Reajustables)').value;

         function habilitarinputs(boton){
            
            //const anio = document.getElementById('anio').value;
            //alert(anio); 
            boton.style.display="none";
            document.getElementById('editar').style.display = "block";
            document.getElementById('inhabilitarinputs').style.display = "block";



            document.getElementById('Dolar').readOnly = false;
            document.getElementById('€ (Euro)').readOnly = false;
            document.getElementById('U.I.(Unidades Indexadas)').readOnly = false;
            document.getElementById('U.R. (Unidades Reajustables)').readOnly = false;


             
  
  
          }

          function inhabilitarinputs(boton){
            
            //const anio = document.getElementById('anio').value;
            //alert(anio); 
            boton.style.display="none";
            document.getElementById('editar').style.display = "none";
            document.getElementById('habilitarinputs').style.display = "block";

            document.getElementById('Dolar').value = $d;
            document.getElementById('€ (Euro)').value = $e;
            document.getElementById('U.I.(Unidades Indexadas)').value = $ui;
            document.getElementById('U.R. (Unidades Reajustables)').value = $ur;

            document.getElementById('Dolar').readOnly = true;
            document.getElementById('€ (Euro)').readOnly = true;
            document.getElementById('U.I.(Unidades Indexadas)').readOnly = true;
            document.getElementById('U.R. (Unidades Reajustables)').readOnly = true;


             
  
  
          }
 
 
     </script>
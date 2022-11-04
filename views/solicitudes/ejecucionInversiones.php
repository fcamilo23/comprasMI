
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
     
     <a href="<?php echo ROOT_URL; ?>"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>
 
 <!--<button type="button" tabindex="0" aria-controls="solis" class="excel sombraVerde"> <img src="<?php echo ROOT_PATH; ?>imagenes/Excel1.jpg" width="150px" height="50px" ></button>-->
 <?php if($_SESSION['user_data']['rol'] != 'Consultor'){ ?>
    <a href="<?php echo ROOT_PATH; ?>home/cotizaciones" class="filtrado sombra" style ="text-decoration: none; color:black; cursor: pointer; padding:5px; font-size: 25px; float:right; margin-right: 40px; border:none; background:#e9e9e9" id="abrirFiltros" > <i class="fas fa-duotone fa-comments-dollar" style="color:#303030" ></i> <p style="height: 10px; font-size: 20px;display: inline-block">Cotizaciones</p></a>
<?php } ?>


 <input type="submit" name="submit" id="submit" class="btn azul" style="color: white; float:right; margin-right: 50px "  value="Seleccionar"/>
 <select name="anio" class="form-control"  onchange="selectAnio()" style="float: right; width: 140px; float: right; margin-bottom: 0px" id="anio">
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2022') {?> selected <?php } ?> value="2022">2022</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2023') {?> selected <?php } ?> value="2023">2023</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2024') {?> selected <?php } ?> value="2024">2024</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2025') {?> selected <?php } ?> value="2025">2025</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2026') {?> selected <?php } ?> value="2026">2026</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2027') {?> selected <?php } ?> value="2027">2027</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2028') {?> selected <?php } ?> value="2028">2028</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2029') {?> selected <?php } ?> value="2029">2029</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2030') {?> selected <?php } ?> value="2030">2030</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2031') {?> selected <?php } ?> value="2031">2031</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2032') {?> selected <?php } ?> value="2032">2032</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2033') {?> selected <?php } ?> value="2033">2033</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2034') {?> selected <?php } ?> value="2034">2034</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2035') {?> selected <?php } ?> value="2035">2035</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2036') {?> selected <?php } ?> value="2036">2036</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2037') {?> selected <?php } ?> value="2037">2037</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2038') {?> selected <?php } ?> value="2038">2038</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2039') {?> selected <?php } ?> value="2039">2039</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '2040') {?> selected <?php } ?> value="2040">2040</option>
    <option <?php if(isset($_SESSION['anioInversiones']) && $_SESSION['anioInversiones'] == '') {?> selected <?php } ?> value="">Histórico</option>



 </select> 
    <?php  unset($_SESSION['anioInversiones']); ?>
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
 
 
         <table id="solis" style="width: 100%;">
 
             <thead>
                 
                 <tr >
                     <th>Detalle</th>
                     <th>Procedimiento</th>
                     <th>Grupo Art/Serv</th>
                     <th>Gastos e Inversiones</th>
                     <th>Monto Estimado ($U)</th>
                     <th>Monto Real ($U)</th>
                     <th>Monto Facturado ($U)</th>
                     <th>Observaciones</th>
 
 
 
                 </tr>
             </thead>
             <tbody >
             <tr ><?php foreach($viewmodel as $item) : ?>
                <td><?php echo $item['detalle'] ?></td>
                 <td><?php if($item['numProc'] != "0" && $item['anioProc'] != "0"){echo $item['procedimiento'] . " ". $item['numProc'] . "/" . $item['anioProc'];}else{ echo "---";} ?></td>
                 <td><?php echo $item['grupoAS']; ?></td>
                 <td><?php echo $item['gastos_inversiones'] ?></td>
                 <td>$<?php echo number_format($item['costoAprox'], 2, '.', ',') ?></td>
                 <td>$<?php echo number_format($item['montoRealOrden']) ?></td>
                 <td>$<?php echo number_format($item['montoRealFacturado']) ?></td>
                 <td><?php echo $item['observaciones'] ?></td>

                <!-- <form id="editar" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">       
                 <td><input type="text" name="numero" style="display: none" value="<?php echo $item['id']; ?>"/>
                 <input type="submit" name="submit" value="Ampliar" style="background: #001d5a; border: none" class="btn btn-primary sombraAzul"/></td>
                 </form> -->
 
             </tr> <?php endforeach; ?>
             </tbody>
         </table>
 
 
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

 
 
         function selectAnio(){
            
            //const anio = document.getElementById('anio').value;
            //alert(anio); 

             
             
  
  
          }
 
 
     </script>

     <?php if($_SESSION['actualizarRep'] == '0'){
            $_SESSION['actualizarRep'] = '1'; ?>
           <script> location.reload(); </script> <?php
     }else{
        $_SESSION['actualizarRep'] = '0';
     } ?>
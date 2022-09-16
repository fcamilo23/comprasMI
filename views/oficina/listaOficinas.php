<body>
    

<div id="main-container" style="width: 100%; overflow: auto; padding: 15px;">

		<table style="width: 100%">
        

			<thead>
                
				<tr>
					<th>UNIDAD</th>
                    <th>UE</th>
                    <th></th>

                </tr>

			</thead>
            <tbody>
            <tr><?php foreach($viewmodel as $item) : ?>
                <form action="<?php echo ROOT_PATH; ?>oficina/listaOficinas" method="post">
                <td><input type="text" class="form-control" name="eid" id="eid"value="<?php echo $item['unidad'] ?>" readonly></td>
                <td><input type="text" class="form-control" name="eue" id="eue"value="<?php echo $item['ue'] ?>"><div id="errorEue"></td>
                <td>
                <input type="hidden" name="accion" id="accion" value="editar">
                    <button class = "btn btn-primary" type="submit">✒️</button>
                </td>
                </form>
            </tr> <?php endforeach; ?>
            <tr>
                <form action="<?php echo ROOT_PATH; ?>oficina/listaOficinas" method="post">
                    <td><input type="text" name="nid" class="form-control" id="nid" value="" ><div id="errorNid"></div></td>
                    
                    <td><input type="text" name="nue" class="form-control" id="nue" value=""><div id="errorNue"></div></td>
                    
                    <td>
                    <input type="hidden" id="accion" name="accion" value="nuevo" readonly>
                        <button class ="btn btn-primary"  type="submit">+</button>
                    </td>
                </form>
            </tr>
            </tbody>
    </table>
</div>
<script>


</script>

</body>

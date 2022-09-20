
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8">
            <div class="card">
                <br>
            <h1 style="color: #001d5a; margin-left: 25px" class="">Subir Archivos</h1>
                <div class="card-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" id="loadFile" accept="application/pdf" type="file" onchange="readAsBase64()" src="<?php echo ROOT_PATH; ?>imagenes/nuevaOrden.jpg" width="190px" height="50px"/>
                </div>
                <form id="form" action="<?php echo ROOT_PATH; ?>solicitudes/subirarchivos" method='post'>
                <button class="btn btn-primary"  type="submit" >GUARDAR</button>
                <hr>
                <table style="max-width: 500px" id="guardado">

                </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
let cant = 0;
function readAsBase64() {

    var files = document.getElementById("loadFile").files;
    if (files.length > 0) {

        var fileToLoad = files[0];
        var fileReader = new FileReader();
        var base64File;
        // Reading file content when it's loaded
        fileReader.onload = function(event) {
            base64File = event.target.result;
            // base64File console
            console.log(base64File);
            //crear un input oculto para enviar el base64
            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "pdf[]");
            input.setAttribute("id", cant+"pdf");
            input.setAttribute("value", base64File);
            document.getElementById("form").appendChild(input);

            var inputName = document.createElement("input");
            inputName.setAttribute("type", "hidden");
            inputName.setAttribute("name", "pdfnombre[]");
            inputName.setAttribute("id", cant+"pdfnombre");
            inputName.setAttribute("value", fileToLoad.name);
            document.getElementById("form").appendChild(inputName);

            //crear una tabla para mostrar los archivos
            var table = document.getElementById("guardado");
            var row = table.insertRow(cant);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = fileToLoad.name;
            cell2.innerHTML = '<button type="button" id="'+cant+'"class="btn btn-danger" onclick="eliminar('+cant+')">Eliminar</button>';   
            cant++;
    
        };
        
        fileReader.readAsDataURL(fileToLoad);
    }
}
    //crear funcion eliminar que quitara los input oculto y la fila de la tabla
    function eliminar(id){
        var input = document.getElementById(id+"pdf");
        input.parentNode.removeChild(input);
        var inputName = document.getElementById(id+"pdfnombre");
        inputName.parentNode.removeChild(inputName);
        var table = document.getElementById("guardado");
        table.rows[id].style.display = "none";

    }



</script>
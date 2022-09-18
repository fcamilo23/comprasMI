<input id="loadFile" accept="application/pdf" type="file" onchange="readAsBase64()" />
<form id="form" action="<?php echo ROOT_PATH; ?>pdf/prueba" method='post'>

    <input type="submit" value="Subir" />
</form>
<script type="text/javascript">

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
            input.setAttribute("name", "pdf");
            input.setAttribute("id", 'pdf');
            input.setAttribute("value", base64File);
            document.getElementById("form").appendChild(input);
            //document.getElementById("base64File").value = base64File;

        };

        // Convert data to base64
        fileReader.readAsDataURL(fileToLoad);
    }
}
</script>
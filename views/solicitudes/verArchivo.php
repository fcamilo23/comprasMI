
<a href="<?php echo ROOT_URL; ?>solicitudes/verSolicitud"><input type="button" style="width: 100px; margin-left: 30px"class="btn btn-primary azul sombraAzul1" value="◄   Atrás"/></a>
<p class="excel">Si no puede ver el archivo <a download='<?php echo $viewmodel['nombre']; ?>' href="<?php echo $viewmodel['pdf']; ?>" title='<?php echo $viewmodel['nombre']; ?>' >descargelo aqui</a></p>
<hr>
<embed src="<?php echo $viewmodel['pdf']; ?>" type="application/pdf" width="100%" height="85%">

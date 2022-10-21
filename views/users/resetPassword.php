<div>

    <form  method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div style="width: 50%; background: #fff; padding: 50px; margin-top: 40px" class="center">
    
        <div style="margin-top: 50px">
        <h1 class="center" style="text-align: center">Cambio de contraseña</h1>
            <input type="text" name="code" id="code" class="form-control" style="display: inline-block; width: 100%; margin-top: 102px;" placeholder="Ingrese el código enviado" /> 
            <input type="password" name="password1" id="password1" class="form-control" style="display: inline-block; width: 100%; margin-top: 82px;" placeholder="Ingrese su nueva contraseña" /> 
        </div>    
        <div >
            <input type="password" name="password2" id="password2"  class="form-control" style="display: inline-block; width: 100%; margin-top: 50px; margin-bottom: 50px" placeholder="Repita la contraseña" /> 
        </div>   
        <input class="btn btn-success sombra" style=""  onclick="alertPass()" type="button" value="Confirmar" />
        <input class="btn btn-success sombra" style="display: none" name="submit" id="submit" type="submit" value="Confirmar" />

        </div>
 
    </form>
</div>

<script>
    function alertPass(){
        password1 = document.getElementById('password1');
        password2 = document.getElementById('password2');
        code = document.getElementById('code')
        //alert(password1.value.length);
        //alert(password2.value);
        //alert(code.value);

        if(password1.value.length < 6){
            Swal.fire(
            'Error!',
            'La contraseña debe tener al menos 6 caracteres',
            'error'
            );
        }else{
            if(password1.value != password2.value){
                Swal.fire(
                    'Error!',
                    'Las contraseñas no coinciden',
                    'error'
                );
            }else{
                

        Swal.fire({
            title: 'Desea confirmar contraseña?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, cancelar!',
            confirmButtonText: 'Si, confirmar!'
            }).then((result) => {
        if (result.isConfirmed) {

            

            document.getElementById('submit').click();
            

        }
})
            }
        }

    }
</script>
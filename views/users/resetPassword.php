<input type="text" hidden id="corr" value="<?php echo substr($_SESSION['user_data']['email'], 0, 4) . '*****' . substr($_SESSION['user_data']['email'], -4);  ?>" >

<?php if(isset($_SESSION['enviarCorreoCC'])){ ?>



<script>
    
    Swal.fire(
    'Correo enviado!',
    'Se le envió un código a su dirección de correo electrónico ' + document.getElementById('corr').value,
    'success'
    )
</script>



<?php 
unset($_SESSION['enviarCorreoCC']);

} ?>



<?php if(isset($_SESSION['noEnviarCorreo'])){ ?>



<script>


        Swal.fire({
        title: 'Ya solicitó el cambio de contraseña!',
        text: "Por favor revise su correo, ya le hemos enviado un código de restablecimiento anteriormente a la dirección " + document.getElementById('corr').value,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: 'btn btn-success',
        confirmButtonText: 'Reenviar código',
        cancelButtonText: 'Ok! Tengo el código'
        }).then((result) => {
        if (result.isConfirmed) {

            <?php $_SESSION['reenviar'] = '1'; ?>

            window.location.href = 'resetPassword';
        }
        })
    
    
</script>



<?php 
unset($_SESSION['noEnviarCorreo']); //

} ?>
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
    var input = document.getElementById("code");
        input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });

    var input = document.getElementById("password1");
        input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });

    var input = document.getElementById("password2");
        input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });



   



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
                
                if(!charIsLetter(password1.value) || !charIsNumber(password1.value)){
                    Swal.fire(
                    'La contraseña no cumple con los requisitos',
                    '',
                    'error'
                    )
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

    }


     function charIsLetter(char) {
    if (typeof char !== 'string') {
        return false;
    }
    return /[a-zA-z]/.test(char);
    }

    function charIsNumber(char) {
    if (typeof char !== 'string') {
        return false;
    }
    return /[0-9]/.test(char);
    }
</script>
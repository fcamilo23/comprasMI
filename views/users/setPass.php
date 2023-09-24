<div class="center" style="padding: 40px; background: #fff; width: 1300px">

    <form  method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div style="width: 50%" class="center">
    
        <div style="margin-top: 50px">
        <h1 class="center" style="text-align: center">Ingrese una nueva contraseña</h1><br>

        <p class="center" onclick="charIsLetter('0')" style="text-align: center; color: rgb(180,0,0)">(Debe contener al menos 6 caracteres, una letra y un número)</p>

            <input type="password" name="password1" id="password1" class="form-control" style="display: inline-block; width: 100%; margin-top: 102px;" placeholder="Ingrese su contraseña" /> 
            
        </div>    
        <div >
            <input type="password" name="password2"  id="password2"class="form-control" style="display: inline-block; width: 100%; margin-top: 50px; margin-bottom: 50px" placeholder="Repita la contraseña" /> 
            <div class=" center" style="text-align: center; margin-bottom: 50px">
            <input class="btn btn-primary sombraAzul azul " style="display: none; width: 200px" name="submit" id="confirmar" type="submit" value="Submit" />
            <input class="btn btn-primary sombraAzul azul " style="width: 200px"  onclick="validar()" type="button" value="Confirmar" />
            </div>
        </div>   
        <div>
        </div>
</div>
 
    </form>
</div>


<script>

    function validar(){
        const pass = document.getElementById('password1').value;
        const pass2 = document.getElementById('password2').value;
        const confirmar = document.getElementById('confirmar');


       // alert(pass);
       if(pass.length > 5){
            if(pass == pass2){
                if(!charIsLetter(pass) || !charIsNumber(pass)){
                    Swal.fire(
                    'La contraseña no cumple con los requisitos',
                    '',
                    'error'
                    )
                }else{
                    confirmar.click();
                }
            }else{
                Swal.fire(
                'Las contraseñas no coinciden',
                '',
                'error'
                )
            }
        }else{
            Swal.fire(
                'La contraseña es demasiado corta',
                '',
                'error'
                )
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
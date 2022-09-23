<div>

    <form  method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div style="width: 50%" class="center">
    
        <div style="margin-top: 50px">
        <h1 class="center">Ingrese una nueva contraseña</h1>

            <input type="password" name="password1" class="form-control" style="display: inline-block; width: 100%; margin-top: 102px;" placeholder="Ingrese su contraseña" /> 
        </div>    
        <div >
            <input type="password" name="password2" class="form-control" style="display: inline-block; width: 100%; margin-top: 50px; margin-bottom: 100px" placeholder="Repita la contraseña" /> 
        </div>   
        <input class="btn btn-primary sombraAzul" style="float: right" name="submit" type="submit" value="Submit" />
        </div>
 
    </form>
</div>
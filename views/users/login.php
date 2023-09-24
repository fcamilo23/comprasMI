<div class="row col-12 fullancho" style="margin-top: 50px; padding: 25px">

<div class="logindiv center" style="" >
    
	    <img src="<?php echo ROOT_PATH; ?>imagenes/minterior.png" alt="" style="margin-left: 12%; margin-bottom: 50px; margin-top: 40px;" class="">

        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <label style="float: left; ">CI:</label>
                <input type="text" name="cedula"  class="form-control logandpass"  />
                <label style="float: left; margin-top: 30px;">Password: </label>
                <input type="password" name="password"   class="form-control logandpass" />
            <input style="margin-top: 20px; margin-bottom: 15px; border: none; width: 15%" class="btn btn-primary sombraAzul" name="submit" type="submit" value="Login" />
    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
</div>
</div>




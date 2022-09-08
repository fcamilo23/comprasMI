<div class="row col-12" style="margin-top: 50px; padding: 25px">

<div class="col-12 panel panel-default">
    
    <div class="center" style="">
	    <img src="<?php echo ROOT_PATH; ?>imagenes/sss.png" alt="" style="margin-top: 40px;" class="homeimg1">

    </div>
    <div class="panel-body center">
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label style="">cedula</label>
                <input type="text" name="cedula" class="form-control logandpass" />
            </div>
            <div class="form-group">
                <label style="margin-top: 30px;">Password</label>
                <input type="password" name="password" class="form-control logandpass" />
            </div>
            <input style="margin-top: 20px; margin-bottom: 15px; border: none; width: 15%" class="btn btn-primary sombraAzul" name="submit" type="submit" value="Login" />
    </div>
    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
</div>
</div>




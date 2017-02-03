
    <div class="container">
       
      <?php  echo $this->Form->create('Admin',array('class'=>'form-signin','url'=>array('controller'=>'login','action'=>'index','prefix'=>'webadmin')));?>
         
        <h2 class="form-signin-heading">Admin Sign In</h2>
        <div class="login-wrap">
            <?php  echo $this->Session->flash(); ?>
            <div class="user-login-info">
                <input type="text" class="form-control" placeholder="User Name" name="data[Admin][username]" autofocus>
                <input type="password" class="form-control" placeholder="Password" name="data[Admin][password]">
            </div>
<!--            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>-->
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>

<!--            <div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
            </div>-->

        </div>


        <?php  echo $this->Form->end() ;?>

    </div>



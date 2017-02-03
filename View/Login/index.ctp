<div class="container marg_tb50">

    <h2 class=" marg_btm30" style="margin-left: 41%">Sign in</h2>


    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

            <?php
            echo $this->Session->flash();
//        pr($_SESSION);
//        die;
            echo $this->Form->create('User', array('class' => 'formstyle form_sighn brder_blck  padd_30', 'role' => 'form', 'url' => array('controller' => 'login', 'action' => 'index')));
            ?>
            <!--         <form role="form" class="formstyle form_sighn brder_blck  padd_30">-->
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <?php
                    if (isset($_SESSION['User']['Cookie']['email'])) {
                        $co_name = $_SESSION['User']['Cookie']['email'];
                        $val = 1;
                    } else {
                        $val = 0;
                        $co_name = '';
                    }
                    if (isset($_SESSION['User']['Cookie']['password'])) {
                        $co_passw = $_SESSION['User']['Cookie']['password'];
                        $val = 1;
                    } else {
                        $val = 0;
                        $co_passw = '';
                    }

                    echo $this->Form->input('email', array('value' => $co_name, 'type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Email', 'id' => 'user', 'required' => false));
                    ?>
        <!--          <input type="text" placeholder="Username" class="form-control" id="exampleInputEmail1">-->
                </div> </div>

            <div class="col-md-12 col-sm-12">
                <div class="form-group">
<?php echo $this->Form->input('password', array('value' => $co_passw, 'type' => 'password', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Password', 'id' => 'password', 'required' => false)); ?>
        <!--          <input type="Password" placeholder="Password" class="form-control" id="exampleInputEmail1">-->
                </div>
            </div>
            <div class="col-md-6  pull-left">

                <button type="submit" class="btn btn-sm  btn_red btn_red12 ">Login</button> 

            </div> 
            <div class="col-md-6 col-sm-6">
                <div class="checkbox pull-right ">
                    <label>
                        <?php
                        if ($val == 1) {
                            $check = "checked";
                        } else {
                            $check = "";
                        }
                        echo $this->Form->input('remember', array('type' => 'checkbox', 'id' => 'remember_me', 'value' => '1', 'checked' => $check, 'label' => 'Remember me next time'));
                        ?>
                <!--      <input type="checkbox"  id="remember_me" name="data[User][remember]" value="1">remember me next time-->
                    </label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 marg_tb15">

                <a href="<?php echo $this->Html->Url(array('controller' => 'login', 'action' => 'forgetpassword')); ?>">Forgot password ?</a></br>
            </div>
            <div class="col-md-6 marg_tb15">
                <a href="<?php echo $this->webroot; ?>users">
                    <button type="button" class="btn btn-sm  btn_red btn_red12 ">Not a member yet ?</button> 
                </a>
            </div>
            <div class="clearfix"></div>
<?php echo $this->Form->end(); ?>



        </div>
    </div>

</div>




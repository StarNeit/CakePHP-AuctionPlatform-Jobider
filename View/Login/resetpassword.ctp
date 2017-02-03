<div class="container marg_tb50">

    <h2 class="text-center marg_btm30">Reset Password</h2>


    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <?php //pr($this->params);?>
            <?php
            echo $this->Session->flash();
            echo $this->Form->create('User', array('class' => 'formstyle form_sighn brder_blck  padd_30', 'role' => 'form', 'url' => array('controller' => 'login', 'action' => 'resetpassword', $this->params['pass']['0'])));
            ?>

            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <?php echo $this->Form->input('new_password', array('type' => 'password', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'value' => '', 'label' => false, 'placeholder' => 'Enter New Password', 'value' => '')); ?>
                </div> 
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'value' => '', 'label' => false, 'placeholder' => 'Enter Confirm Password')); ?>
                </div>
            </div>

            <div class="col-md-6  pull-left">
                <button type="submit" class="btn btn-sm  btn_red btn_red12 ">Submit</button> </div> 

            <div class="clearfix"></div>
            <?php echo $this->Form->end(); ?>


        </div>
    </div>

</div>




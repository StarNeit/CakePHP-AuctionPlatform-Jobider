<div class="container">

    <div class="row marg_tb15">

        <div class="col-md-3 pad_l0 col-sm-3">

            <?php echo $this->element('client_profile_sideber'); ?>

            <?php echo $this->element('client_notification'); ?>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">

                <div class="green"> Change Password </div>
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Form->create('User', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'role' => 'form', 'url' => array('controller' => 'client', 'action' => 'changepassword'))); ?>

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label> Current Password </label>
                        <?php echo $this->Form->input('old_password', array('class' => 'form-control', 'id' => 'exampleInputEmail1o', 'type' => 'password', 'label' => false, 'value' => '')); ?>
                <!--         <input type="password" id="exampleInputEmail1" class="form-control"> -->
                    </div>
                </div>
         

<div class="col-md-6 col-sm-6">
    <div class="form-group">
        <label> New Password </label>
        <?php echo $this->Form->input('new_password', array('class' => 'form-control', 'id' => 'exampleInputEmail1n', 'type' => 'password', 'label' => false, 'value' => '')); ?>
    </div> </div>

<div class="col-md-6 col-sm-6">
    <div class="form-group">
        <label> Confirm New Password </label>
        <?php echo $this->Form->input('confirm_password', array('class' => 'form-control', 'id' => 'exampleInputEmail1c', 'type' => 'password', 'label' => false, 'value' => '')); ?>
    </div>
</div>

<div class="col-md-12 marg_tb50 text-center">
    <p>
        <button class="btn-lg btn-green1"> Save </button>
    </p>
</div>




<?php echo $this->Form->end(); ?>



<div class="clearfix"></div>
</div>


</div>
<div class="clearfix"></div>
</div>          

</div>

<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>
<script>
    $(document).ready(function() {
        $("#UserChangepasswordForm").validate({
            rules: {
                'data[User][old_password]': {
                    required: true,
                },
                'data[User][new_password]': {
                    required: true,
                },
                'data[User][confirm_password]': {
                    required: true,
                },
            },
            messages: {
                'data[User][old_password]': {
                    required: "Please enter old password !",
                },
                'data[User][new_password]': {
                    required: "Please enter new password !",
                },
                'data[User][confirm_password]': {
                    required: "Please enter confirm password",
                },
            },
        });
    });
</script>
<style>
    label.error {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 295px;
    }
</style>



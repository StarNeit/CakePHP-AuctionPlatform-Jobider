
<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('employee_settings'); ?>
        <div class="col-md-9 col-sm-8">
            <div class="bg_white">
                <div class="green"> Change Password </div>
                <div class="p15 category">
                    <p class="font_14 opensans grayclr mb0">In order to change password , you must enter your old password.</p>      
                    <hr class="mtb10">
                    <p class="font_16 opensans bue_clr mb0"><strong>A Strong Password</strong></p>      
                    <p class="opensans font_14 grayclr mb0"> <span class="bue_clr font_18">&bull; </span> &nbsp; is 14 characters  ( eight minimum ) in length.</p>
                    <p class="opensans font_14 grayclr"> <span class="bue_clr font_18">&bull; </span>  &nbsp;is a combination of letters ( lower case or uper case ) and atleast one number <br> or other non-letter character</p>

                    <hr class="mtb10">
                    <?php
                    echo $this->Session->flash();
                    echo $this->Form->create('User', array('class' => 'formstyle', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'settings')));
                    ?>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="font_16 grayclr opensans">Old Password</label>
                                <?php echo $this->Form->input('password_old', array('type' => 'password', 'id' => 'exampleInputEmail1o', 'class' => 'form-control', 'label' => false,'value' => '')); ?>  </div> 
                        </div>  
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"  class="font_16 grayclr opensans">New Password</label>
                                <?php echo $this->Form->input('password_new', array('type' => 'password', 'id' => 'exampleInputEmail1n', 'class' => 'form-control', 'label' => false,'value' => '')); ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"  class="font_16 grayclr opensans">Retype New Password</label>
                                <?php echo $this->Form->input('password_confirm', array('type' => 'password', 'id' => 'exampleInputEmailc', 'class' => 'form-control', 'label' => false,'value' => '')); ?>
                            </div> </div>
                        <div class="col-md-12 marg_btm30 ">
                            <button type="submit" class="btn btn-lg btn_cust marg_tb15 mr10">Change</button>
                            <button  class="btn btn-lg btn_cust marg_tb15"  type="button"  value="Cancel"  onClick="this.form.reset()"> Cancel</button>
                        </div>
                    </div>
                    <?php $this->Form->end(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>
<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>

<script>
                                $(document).ready(function() {
                                    $("#UserSettingsForm").validate({
                                        rules: {
                                            'data[User][password_old]': {
                                                required: true,
                                            },
                                            'data[User][password_new]': {
                                                required: true,
                                            },
                                            'data[User][password_confirm]': {
                                                required: true,
                                            },
                                        },
                                        messages: {
                                            'data[User][password_old]': {
                                                required: "Please enter old password !",
                                            },
                                            'data[User][password_new]': {
                                                required: "Please enter new password !",
                                            },
                                            'data[User][password_confirm]': {
                                                required: "Please ReType your Password !",
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
        width: 258px;
    }
</style>

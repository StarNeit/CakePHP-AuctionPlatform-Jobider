<div class="container">

    <div class="row marg_tb15">
        <?php echo $this->element('employee_settings'); ?>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">




                <?php
                if (isset($membership) and $membership == 'small') {
                    if (isset($completeQuota) and $completeQuota <=2) {
                        ?>
                        <div class="bg_white">
                            <div class="green"> Add Member</div>
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('User', array('url' => array('controller' => 'freelancer', 'action' => 'addMembers'), 'class' => 'formstyle form_sighn form_style2 marg_tb15'));
                            ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> First Name </label>
        <?php echo $this->Form->input('first_name', array('label' => false, 'required' => false, 'class' => 'form-control', 'id' => 'exampleInputEmail1')); ?>
                                </div> </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> Last Name </label>
        <?php echo $this->Form->input('last_name', array('label' => false, 'required' => false, 'class' => 'form-control', 'id' => 'exampleInputEmail1')); ?>

                                </div> </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>E-mail</label>
        <?php echo $this->Form->input('email', array('label' => false, 'required' => false, 'class' => 'form-control', 'id' => 'exampleInputEmail1')); ?>

                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> Password </label>
        <?php echo $this->Form->input('password', array('label' => false, 'required' => 'false', 'type' => 'password', 'class' => 'form-control', 'id' => 'exampleInputEmail1')); ?>
                                </div> </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 marg_tb50 text-center">
                                    <p>
                                        <button class="btn-lg btn-green1"> Save </button>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                        </div>
    <?php } else { ?>
                        <div class="bg_white">
                            <div class="green"> Add Member</div>
                            <div class="col-md-12 quota">
                                <div class="form-group">
                                    <span> You have Already added the 3 members.</span></div>
                            </div>
                        </div>

                    <?php
                    }
                } if(isset($membership) and $membership == 'large') {
                    ?>
                       <div class="bg_white">
                            <div class="green"> Add Member</div>
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('User', array('url' => array('controller' => 'freelancer', 'action' => 'addMembers'), 'class' => 'formstyle form_sighn form_style2 marg_tb15'));
                            ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> First Name </label>
        <?php echo $this->Form->input('first_name', array('label' => false, 'required' => false, 'class' => 'form-control', 'id' => 'exampleInputEmail1')); ?>
                                </div> </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> Last Name </label>
        <?php echo $this->Form->input('last_name', array('label' => false, 'required' => false, 'class' => 'form-control', 'id' => 'exampleInputEmail1')); ?>

                                </div> </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>E-mail</label>
        <?php echo $this->Form->input('email', array('label' => false, 'required' => false, 'class' => 'form-control', 'id' => 'exampleInputEmail1')); ?>

                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> Password </label>
        <?php echo $this->Form->input('password', array('label' => false, 'required' => 'false', 'type' => 'password', 'class' => 'form-control', 'id' => 'exampleInputEmail1')); ?>
                                </div> </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 marg_tb50 text-center">
                                    <p>
                                        <button class="btn-lg btn-green1"> Save </button>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                        </div>
                
                <?php
                    
                }
                ?>



                <div class="clearfix"> </div>
            </div>          
        </div>
    </div>

</div>
<style>
    .col-md-12.quota {
        color: #66c5bf;
        font-size: 22px;
        height: 100px;
        margin-top: 20px;
        text-align: center;
    }
</style>
<script>
    $(function () {
        $("#datepicker1").datepicker({
            showOn: "button",
            buttonImage: "img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
    });
</script> 
<script>
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
</script>
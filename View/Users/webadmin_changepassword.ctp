<style>
    .error-message{
        color:red;
    }
</style>  


<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Change Password</h3>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Admin', array('role' => 'form', 'url' => array('controller' => 'users', 'action' => 'changepassword')));
                            ?>
                            <!--                                <form role="form">-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Old Password</label>
                                <?php echo $this->Form->input('old_password', array('type' => 'password', 'class' => 'form-control', 'id' => 'exampleInputPassword1old', 'label' => false, 'required'=>false,'value' => '')); ?>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <?php echo $this->Form->input('new_password', array('type' => 'password', 'class' => 'form-control', 'required'=>false,'id' => 'exampleInputPassword1new', 'label' => false)); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <?php echo $this->Form->input('confirm_password', array('type' => 'password','required'=>false, 'class' => 'form-control', 'id' => 'exampleInputPassword1cnfrm', 'label' => false)); ?>
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <?php echo $this->Form->end(); ?>
                        </div>
                </section>

            </div>

        </div>
        <!-- page end-->
    </section>
</section>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.min.js"></script>
<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>
<script>
    $("#AdminWebadminChangepasswordForm").validate({
        rules: {
            'data[Admin][old_password]': {
                required: true,
            },
            'data[Admin][new_password]': {
                required: true,
            },
            'data[Admin][confirm_password]': {
                required: true,
            },
        },
        messages: {
            'data[Admin][old_password]': {
                required: "Please enter old password !",
            },
            'data[Admin][new_password]': {
                required: "Please enter new password !",
            },
            'data[Admin][confirm_password]': {
                required: "Please enter confirm password !",
            },
        },
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


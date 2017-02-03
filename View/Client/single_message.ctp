<?php
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'mymessage')) {
    $postajob = 'active';
} else {
    $postajob = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'send')) {
    $searchfreelancer = 'active';
} else {
    $searchfreelancer = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'single_message') && ($this->params['pass'][0] == $receiver_id)) {
    $postajob = 'active';
} else {
    $postajob = '';
}
?>
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <?php if ($count_Inbox == 0) { ?>
                            <?php //echo "yes"; ?>
                            <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'mymessages')); ?>"> Inbox </a></li><?php } else { ?>
                            <?php //echo "no";  ?>
                            <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'mymessages')); ?>"> Inbox <?php echo '(' . $count_Inbox . ')'; ?></a></li>
                        <?php } ?>

                        <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'send')); ?>"> Sent messages </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/archieve_message">Archive  </a></li>
                    </ul>
                </div>
            </div>
            <?php echo $this->element('client_notification'); ?>
        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">
            <?php if (!empty($user_data)) { ?>
                <div class="bg_white">
                    <?php echo $this->Session->flash(); ?>
                    <div class="green">
                        <?php if (!empty($job_value)) {
                            echo ucwords($job_value['Job']['job_title']);
                        } ?>
                        <span class="pull-right">Go to <a href="<?php echo $this->webroot; ?>client/job_application/<?php echo $receiver_id; ?>"> job application </a>
                        </span>  
                    </div>
    <?php foreach ($user_data as $val) { ?>
                        <div class="detail  brder_btm padd_tb15">
                            <div class="col-md-2 col-sm-2">
                                <div class="user_imgbox">
                                    <?php
                                    if (isset($val) and !empty($val)) {
                                        foreach ($val['Message']['user'] as $k => $v) {
                                            if (!empty($v['User']['image'])) {
                                                ?>
                                                <img   class="img-thumbnail" alt="login user" src="<?php echo $this->webroot; ?>uploads/<?php echo $v['User']['image']; ?>" width='100' height='100'>  <?php } else { ?>
                                                <img   class="img-thumbnail" alt="login" src="<?php echo $this->webroot; ?>img/user_1.png" width='100' height='100'>  
                                            <?php } ?>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <img alt="login user" src="<?php echo $this->webroot; ?>img/user_1.png">
        <?php } ?>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-2 pad_l0"> 
                                <div class="user_content pull-left">
                                    <?php foreach ($val['Message']['user'] as $k => $v) { ?>
                                        <h4 class="marg_0 "><?php echo $v['User']['first_name'] . ' ' . $v['User']['last_name']; ?></h4>
        <?php } ?>
                                    <small class="text_1"><?php echo $date = date('F d,Y', strtotime($val['Message']['created'])); ?></small>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <p class="text_1"><?php echo $val['Message']['reply']; ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
    <?php } ?>

                    <div class="col-md-12">
                        <!--                    <hr class="brder_btm">-->
                    </div>
    <?php echo $this->Form->create('Message', array('class' => 'profile_form form_sighn marg_tb15', 'role' => 'form', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'client', 'action' => 'single_message', $receiver_id))); ?>
                    <!--                <form class=" profile_form form_sighn marg_tb15" role="form">-->
                    <div class="col-md-12">
                        <div class="row">  
                            <div class="col-md-12  new_send_butt1">

                                <div class="fileUpload btn btn-primary">
                                    <p><img src="<?php echo $this->webroot; ?>img/upload_plus.png" alt="Upload plus"><span>Attach a File </span> </p>
                                    <input type="file" class="upload" name="data[Message][attach_data]">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post a reply</label>
    <?php echo $this->Form->input('reply', array('class' => 'form-control txtarea', 'label' => false, 'rows' => '5', 'id' => 'replydata')); ?>
                        </div>

                        <p class="waiting" style="display:none"></p>
                        <p class="correct" style="display:none"></p>
                        <button class="btn-lg btn-green col-md-3 col-sm-3 col-xs-4 replymsg  reply_mesg" type="submit">Reply</button>
                    </div>  <?php echo $this->Form->end(); ?>

                    <div class="clearfix"></div>

                </div>
<?php } else { ?>
                <div class="bg_white"> 
                    <div class="green">
                        Messages 

                    </div>

                    <div class="detail  brder_btm padd_tb15">
                        <p style="color: #C7C4C8; text-align: center; font-size: 18px;"> <strong>Message Not Found.</strong></p>
                        <div class="clearfix"></div>
                    </div>



                </div>
<?php } ?>

        </div>
    </div>
</div>

<?php //echo $this->Html->script('jquery.min');   ?>

<script>
    $(document).ready(function() {
        $(document).on('click', '.reply_mesg', function() {
            var search = $('#replydata').val();
            if (search == '') {
                alert('Please Enter the message !');
                return false;
            } else {
                $('.reply_mesg').attr('type', 'submit');
                return true;
            }
        });
    });

</script>
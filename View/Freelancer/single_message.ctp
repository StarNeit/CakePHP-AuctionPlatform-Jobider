<?php
if ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'mymessage')) {
    $inbox = 'active';
} else {
    $inbox = '';
}
if ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'sent_message')) {
    $send = 'active';
} else {
    $send = '';
}
if ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'single_message') && ($this->params['pass']['0'] == $reciever_id)) {
    $inbox = 'active';
} else {
    $inbox = '';
}
if ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'archieve_message')) {
    $archive = 'active';
} else {
    $archive = '';
}
?> 

<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">My Messages</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <?php if (isset($Count) and ! empty($Count) and $Count == 0) { ?>
                            <li class="<?php echo $inbox; ?>"> <a href="<?php echo $this->webroot; ?>freelancer/mymessage"> Inbox(0) </a> </li>
                        <?php } else { ?>
                            <li class="<?php echo $inbox; ?>"><a href="<?php echo $this->webroot; ?>freelancer/mymessage"> Inbox <?php echo '(' . $Count . ')'; ?></a></li>  <?php } ?>
                        <li class="<?php echo $send; ?>"><a href="<?php echo $this->webroot; ?>freelancer/sent_message"> Sent</a></li>
                        <li class="<?php echo $archive; ?>"><a href="<?php echo $this->webroot; ?>freelancer/archieve_message"> Archive</a></li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <?php if (!empty($Payment_earning)) { ?>
                        <p>Available now : <?php echo '$' . $Payment_earning . '.00'; ?> </p>
                    <?php } else { ?>
                        <p>Available now : $0.00 </p>
                    <?php } ?>
                    <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="View pending earnings"/></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings >></a></p>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <?php if (!empty($job_value) && !empty($message)) { ?>
                <div class="bg_white">

                    <div class="green">

                        <?php echo $job_value['Job']['job_title']; ?>

                    </div>

                    <?php echo $this->Session->flash(); ?>
                    <?php foreach ($message as $val) { ?>
                        <div class="detail  brder_btm padd_tb15">

                            <div class="col-md-2 col-sm-2">
                                <div class="user_imgbox">
                                    <?php foreach ($val['Message']['user'] as $k => $v) { ?>
                                        <?php if (!empty($v['User']['image'])) { ?>
                                            <img alt="login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $v['User']['image']; ?>" width='100' height='100'>
                                        <?php } else { ?>
                                            <img alt="dummy user image icon" src="<?php echo $this->webroot; ?>img/user_1.png" width='100' height='100'>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 pad_l0"> 
                                <div class="user_content pull-left">
                                    <?php foreach ($val['Message']['user'] as $k => $v) { ?>
                                        <h4 class="marg_0 user "><?php echo $v['User']['first_name'] . ' ' . $v['User']['last_name']; ?></h4>
                                    <?php } ?>
                                    <small class="text_1"><?php echo $date = date('F d,Y', strtotime($val['Message']['created'])); ?></small>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="clearfix"></div>
                                <p class="text_1"><?php echo $val['Message']['reply']; ?></p><p class="text_1"><?php if (!empty($val['Message']['attach_data'])) { ?>
                                        <?php echo 'attachment file :- ' ?> <a href='<?php echo $this->webroot; ?>freelancer/downloadfile/<?php echo $val['Message']['id']; ?>'><?php echo $val['Message']['attach_data']; ?></a>
                                    <?php } ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>

                    <div class="col-md-12">
                        <!--                        <hr class="brder_btm">-->
                    </div>
                    <?php echo $this->Form->create('Message', array('class' => 'profile_form form_sighn marg_tb15', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'single_message', $reciever_id))); ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post a reply</label>
                            <?php echo $this->Form->input('reply', array('class' => 'form-control txtarea', 'label' => false, 'rows' => '5', 'id' => 'replydata')); ?>
                        </div>
                        <p class="waiting" style="display:none"></p>
                        <p class="correct" style="display:none"></p>
                        <button class="btn-lg btn-green col-md-3 col-sm-3 col-xs-4 replymsg reply_mesg" type="submit">Reply</button>
                    </div> 
                    <?php echo $this->Form->end(); ?>
                    <!--            </form>-->
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

<?php // echo $this->Html->script('jquery.min'); ?>

<script>
    $(document).ready(function () {
        $(document).on('click', '.reply_mesg', function () {
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


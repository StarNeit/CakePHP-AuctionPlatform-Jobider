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

if ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'archieve_message')) {
    $archieve = 'active';
} else {
    $archieve = '';
}
?> 

<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">My Messages</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <?php if (isset($count_msg) and !empty($count_msg) and $count_msg == '0') { ?>
                            <li class="<?php echo $inbox; ?>"><a href="<?php echo $this->webroot; ?>freelancer/mymessage"> Inbox</a></li>
                        <?php } else { ?>
                            <li class="<?php echo $inbox; ?>"><a href="<?php echo $this->webroot; ?>freelancer/mymessage"> Inbox (<?php echo $count_msg; ?>) </a></li>
                        <?php } ?>
                        <li class="<?php echo $send; ?>"><a href="<?php echo $this->webroot; ?>freelancer/sent_message"> Sent messages  </a></li>
                        <li class="<?php echo $archieve; ?>"><a href="<?php echo $this->webroot; ?>freelancer/archieve_message"> Archive</a></li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now : <?php if(!empty($Payment_earning)){echo '$'.$Payment_earning.'.00';}else{ echo '$0.00';} ?> </p>
<!--                    <p class="text-center">
                        <?php //echo $this->Form->create('Job', array('url' => array('controller' => 'freelancer', 'action' => 'withdraw'))); ?> 
                        <button type="submit" class="btn btn-danger">Withdraw</button>
                        <?php ///echo $this->Form->end(); ?>
                    </p>-->
                    <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="View pending earnings image"/></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings >></a></p>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">
            <?php echo $this->Session->flash(); ?>
            <?php if (isset($msgs) and !empty($msgs)) { ?>
                <div class="bg_white"> 
                    <?php echo $this->Form->create('Message', array('id' => 'frm1', 'url' => array('controller' => 'freelancer', 'action' => 'mymessage'))); ?>
                    <div class="green ">
                        <div class="chk_spe">
                            <input type="checkbox" name="checkbox" onclick="checkedAll(frm1);" >
                        </div>
                        Messages 
                        <div class="my_butt">
                        <button class="btn btn-danger pull-right" type="submit" name="read" value="read">Mark as read</button>&nbsp;
                        <button class="btn btn-danger pull-right" type="submit"  name="archive" value="archive">Archive Message</button>
                    </div>
                    </div>
                    <?php foreach ($msgs as $key => $val) { ?>


                        <div class="detail  brder_btm padd_tb15">
                            <div class="col-md-3 col-sm-3"><div class="my_chk">
                                    <input type="checkbox" name="data[Message][chk1][]" value="<?php echo $val['Message']['id']; ?>" ></div>
                                <div class="user_imgbox mess">
                                    <?php foreach ($val['Message']['user'] as $kk => $vv) { ?>
                                    <?php  if(!empty($vv['User']['image'])){?>
                                        <img src="<?php echo $this->webroot; ?>uploads/<?php echo $vv['User']['image']; ?>" alt="login user image"  style="width: 68px;"/>
                                    <?php } else { ?>
                                         <img src="<?php echo $this->webroot; ?>img/user_1.png" alt="dummy user icon image"  style="width: 68px;"/>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-3 pad_l0"> 
                                <div class="user_content pull-left">
                                    <?php foreach ($val['Message']['user'] as $k => $v) { ?>
                                    <a href="<?php echo $this->webroot; ?>freelancer/single_message/<?php echo $v['User']['id'] ?>" style="text-decoration:none; color: black; margin-left:-20px;" class='mesgdata' id='<?php echo $v['User']['id']; ?>'><h4 class="marg_0"><?php echo ucfirst($v['User']['first_name']) . ' ' . ucfirst($v['User']['last_name']) . '   (' . $val['Message']['msg_count'] . ')'; ?></a></h4>
                                    <?php } ?>
                                    <small class="text_1"><?php echo $date = date('F d,Y', strtotime($val['Message']['created'])); ?></small>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="clearfix"> </div>
                                <?php foreach ($val['Message']['user'] as $ke => $vl) { ?>
                                    <?php foreach ($val['Message']['job'] as $ke => $va) { ?>
                                        <a href="<?php echo $this->webroot; ?>freelancer/single_message/<?php echo $vl['User']['id']; ?>" style="text-decoration:none;" class='mesgdata' id='<?php echo $vl['User']['id']; ?>'><h4 class="text_4 marg_0"><strong><?php echo $va['Job']['job_title']; ?></strong>
                                            </h4></a>
                                    <?php }
                                }
                                ?>
                                <p class="text_1"><?php echo $val['Message']['reply']; ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php echo $this->Form->end(); ?>
    <?php if (!empty($msgs)) { ?>
                        <!--                    <div class="col-md-12 ">
                                                <a href="#" class="pull-right font_18 marg_tb15 text_4">All messages</a>
                                            </div>-->
                        <div class="clearfix"></div>
                <?php } ?>
                </div>
<?php } else { ?>
                <div class="bg_white"> 
                    <div class="green">
                        Messages 

                    </div>

                    <div class="detail  brder_btm padd_tb15">
                        <p style="color: #C7C4C8; text-align: center; font-size: 18px;"> <strong>You have no inbox messages.</strong></p>
                        <div class="clearfix"></div>
                    </div>

                </div>
<?php } ?>
            <div class="clearfix"></div>
        </div>

    </div>
</div>
<!--Script by hscripts.com-->
<!-- Free javascripts @ https://www.hscripts.com -->
<script type="text/javascript">
                            checked = false;
                            function checkedAll(frm1) {
                                var aa = document.getElementById('frm1');
                                if (checked == false)
                                {
                                    checked = true
                                }
                                else
                                {
                                    checked = false
                                }
                                for (var i = 0; i < aa.elements.length; i++) {
                                    aa.elements[i].checked = checked;
                                }
                            }
</script>
<!-- Script by hscripts.com -->
<script>
    $(document).ready(function() {
        $(document).on('click', '.mesgdata', function(event) {
            event.preventDefault();
            var user_id = $(this).attr('id');
//          var user_id=$('.mesgdata').attr('id');
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>freelancer/ajax_mesg',
                data: {user_id: user_id},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        window.location.href = msg.url;
                    }
                }
            });
        });
    });
</script>

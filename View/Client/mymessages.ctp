<?php
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'mymessages')) {
    $postajob = 'active';
} else {
    $postajob = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'send')) {
    $searchfreelancer = 'active';
} else {
    $searchfreelancer = '';
}
?> 
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <?php if ($count_msg == '0') { ?>
                            <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'mymessages')); ?>"/> Inbox</a></li>
                        <?php } else { ?>
                            <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'mymessages')); ?>"/> Inbox (<?php echo $count_msg; ?>) </a></li>
                        <?php } ?>

                        <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'send')); ?>"/> Send mesages</a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/archieve_message">Archive</a></li>
                    </ul>
                </div>
            </div>
           <?php echo $this->element('client_notification'); ?>
        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">
            <?php echo $this->Session->flash(); ?>
            <?php if (!empty($message)) { ?>
                <div class="bg_white">
                    <?php echo $this->Form->create('Message', array('id' => 'frm1', 'url' => array('controller' => 'client', 'action' => 'mymessages'))); ?>
                    <div class="green">
                        
                        <div class="chk_spe">
 
                            <input type="checkbox" value="" name="checkbox"  onclick='checkedAll(frm1);'">
                        Messages </div>
 <div class="my_butt2">
                        <button class="btn btn-danger pull-right" type="submit" name="read" value="read">Mark as read</button>&nbsp;
                        <button class="btn btn-danger pull-right" type="submit"  name="archive" value="archive">Archive Message</button>
                    </div>
                    </div>
                    <?php foreach ($message as $key => $val) { ?>
                        <!--<input type="checkbox" name="data[Message][chk1][]" value="<?php echo $val['Message']['id']; ?>">-->
                        <div class="detail  brder_btm padd_tb15">
                            <div class="col-md-3 col-sm-3">
                                <div class="my_chk">
                                    <input type="checkbox" value="<?php echo $val['Message']['id']; ?>" name="data[Message][chk1][]">
                                </div>
                                
                                    <div class="user_imgbox mess">
                                        <?php
                                     foreach ($val['Message']['freelancer'] as $k => $v) { if(!empty($v['User']['image'])){?>
                                     <img  class="img-thumbnail"src="<?php echo $this->webroot; ?>uploads/<?php echo $v['User']['image']; ?>" alt="login user" width="100" height="100"><?php  }else{?>  <img  class="img-thumbnail"src="<?php echo $this->webroot; ?>img/user_1.png" alt="dummy user" width="100" height="100">
                                        <?php }?>
                                     <?php } ?>
                                    </div>
                                  
                            </div>
                            
                            <div class="col-md-4 col-sm-4 pad_l0"> 
                                <div class="user_content pull-left">
                                    <?php foreach ($val['Message']['freelancer'] as $ke => $va) { ?>
                                        <a href="<?php echo $this->webroot; ?>client/single_message/<?php echo $va['User']['id']; ?>" style="text-decoration:none; color: black;" class="msgdata" id="<?php echo $va['User']['id']; ?>"><h4 class="marg_0"><?php echo $va['User']['first_name'] . ' ' . $va['User']['last_name'] . '  (' . $val['Message']['msg_count'] . ')'; ?></a></h4>
                                    <?php } ?>
                                    <small class="text_1"><?php echo $date = date('F d,Y', strtotime($val['Message']['created'])); ?></small>
                                </div>
                                <div class="clearfix"> </div>   </div>
                            <div class="col-md-5 col-sm-5">
                                <?php foreach ($val['Message']['freelancer'] as $ke => $vl) { ?>
                                    <?php foreach ($val['Message']['jobs'] as $kk => $vv) { ?>
                                        <a href="<?php echo $this->webroot; ?>client/single_message/<?php echo $vl['User']['id'] ?>" style="text-decoration:none;" class="msgdata" id="<?php echo $vl['User']['id']; ?>"><h4 class="text_4 marg_0"><?php echo $vv['Job']['job_title']; ?></h4></a>
                                    <?php }
                                }
                                ?>
                                <p class="text_1"><?php echo $val['Message']['reply']; ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    <?php }
                    ?>
                    <?php echo $this->Form->end(); ?>
                    <?php if (!empty($message)) { ?>
                        <div class="col-md-12">
                            <!--                    <a href="#" class="pull-right font_18 marg_tb15 text_4">All messages</a>-->
                        </div> <div class="clearfix"></div>
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
        </div>
    </div>
</div>
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
        $(document).on('click', '.msgdata', function(event) {
            event.preventDefault();
            var user_id = $(this).attr('id');
//          var user_id=$('.msgdata').attr('id');
            // alert(user_id);
            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'url': '<?php echo $this->webroot; ?>client/ajax_message',
                'data': {user_id: user_id},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        window.location.href = msg.url;
                    }
                }
            });
        });
    });
</script>


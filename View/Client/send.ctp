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
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'single_message') and $this->params['pass'] == $job_value['Job']['id']) {
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
                          <?php if ($count_msg == '0') { ?>
                            <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'mymessages')); ?>"/> Inbox</a></li>
                        <?php } else { ?>
                            <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'mymessages')); ?>"/> Inbox (<?php echo $count_msg; ?>) </a></li>
                        <?php } ?>
                        <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->webroot; ?>client/send"> Sent messages </a></li>                   
                        <li><a href="<?php echo $this->webroot; ?>client/archieve_message">Archive  </a></li>
                    </ul>
                </div>
            </div>
      <?php  echo $this->element('client_notification');?>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green">
                    Messages 
                </div>   
                <?php
                if (isset($contect_data) and !empty($contect_data)) {
                    foreach ($contect_data as $val) {
                        ?>
                        <div class="detail  brder_btm padd_tb15">

                            <div class="col-md-2 col-sm-2">

                                <div class="user_imgbox">
                                    <?php foreach ($val['Message']['user'] as $k => $v) { ?>
                                        <img alt="login user image" class="img-thumbnail" src="<?php echo $this->webroot; ?>uploads/<?php echo $v['User']['image']; ?>" width="100" height="100">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 pad_l0"> 
                                <div class="user_content pull-left">
                                    <?php foreach ($val['Message']['user'] as $k => $v) { ?>
                                    <a href="<?php echo $this->webroot;?>client/single_message/<?php  echo $v['User']['id']?>" style="text-decoration:none; color: black;"><h4 class="marg_0"><?php echo $v['User']['first_name'] . ' ' . $v['User']['last_name'].'('.$val['Message']['count'].')'; ?></a></h4>
                                    <?php } ?>
                                    <small class="text_1"><?php echo $date = date('F d,Y', strtotime($val['Message']['created'])); ?></small>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="col-md-8 col-sm-8">
                                <?php foreach ($val['Message']['job'] as $kk => $vv) { ?>
                                    <h4 class="text_4 marg_0"><?php echo $vv['Job']['job_title']; ?></h4>
                                <?php } ?>
                                <p class="text_1"><?php echo substr($val['Message']['reply'], 0, 150); ?></p>

                            </div>
                            <div class="clearfix"></div>

                        </div>
<!--                  <div class="col-md-12">
                    <a class="pull-right font_18 marg_tb15 text_4" href="#">All messages</a>
              </div> <div class="clearfix"></div>-->
                    <?php }
                } else { ?>
                    <div class="detail  brder_btm padd_tb15">
                        <p style="color: #C7C4C8;text-align: center;  font-size: 18px;"> <strong>You have no sent messages.</strong></p>
                        <div class="clearfix"></div>
                    </div>
<?php } ?>
              
            </div>

        </div>


    </div>

</div>
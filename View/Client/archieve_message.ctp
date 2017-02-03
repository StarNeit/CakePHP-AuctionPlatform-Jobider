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
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'archieve_message')) {
    $archive = 'active';
} else {
    $archive = '';
}
?>
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <?php if (isset($count_inbox) and !empty($count_inbox) and $count_inbox == 0) { ?>
                            <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->webroot; ?>client/mymessages"> Inbox </a></li>
                        <?php } else { ?>          
                            <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->webroot; ?>client/mymessages"> Inbox <?php echo '(' . $count_inbox . ')'; ?></a>
                            </li>   <?php } ?>
                        <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->webroot; ?>client/send"> Sent messages </a></li>                     
                        <li class="<?php echo $archive; ?>"><a href="<?php echo $this->webroot; ?>client/archieve_message">Archive  </a></li>
                    </ul>
                </div>
            </div>
        <?php echo $this->element('client_notification'); ?>
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
                                        <img  class="img-thumbnail" alt="LoginUserImage" src="<?php echo $this->webroot; ?>uploads/<?php echo $v['User']['image']; ?>" width="100" height="100">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 pad_l0"> 
                                <div class="user_content pull-left">
                                    <?php foreach ($val['Message']['user'] as $k => $v) { ?>
                                        <h4 class="marg_0"><?php echo $v['User']['first_name'] . ' ' . $v['User']['last_name']; ?></h4>
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
                        <?php
                    }
                } else {
                    ?>
                    <div class="detail  brder_btm padd_tb15">
                        <p style="color: #C7C4C8; text-align: center;  font-size: 18px;"> 
                            <strong>You have no archived messages.</strong>
                        </p>
                        <div class="clearfix"></div>
                    </div>
                <?php } ?>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>



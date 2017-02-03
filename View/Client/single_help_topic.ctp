<?php
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'singleHelpTopic')) {
    $help = 'active';
} else {
    $help = '';
}
?>
<div class="container">
<?php if(!empty($result)){ ?>
    <div class="row marg_tb15">
 <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <?php
                        if (isset($help_topic) and !empty($help_topic)) {
                            foreach ($help_topic as $k => $val) {
                                ?>
                                <li><a href="<?php echo $this->webroot; ?>client/singleHelpTopic/<?php echo $val['Help']['id'] ?>"><?php echo $val['Help']['title']; ?></a></li>
                            <?php }
                        }
                        ?>
                    </ul>
                </div>
            </div>
          <?php echo $this->element('client_notification'); ?>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green"><?php echo $result['Help']['title']; ?> </div>
                <div class="col-md-12">
                    <div class="basic">
                        <h5>  Basic </h5>
                        <p> <?php echo $result['Help']['description']; ?> </p>
                        
                    </div>

                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>    
<?php } else { ?>
     <div class="row marg_tb15">
        <p style="color: #C7CBD6; font-size: 20px; padding: 100px; text-align: center"><strong>Sorry</strong>, No Data Found</p>
    </div>
<?php } ?>
</div>
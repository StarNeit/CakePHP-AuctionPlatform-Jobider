<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('freelancer_dashboard'); ?>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green">
                    Notifications
                </div>

                <?php
                if (isset($Notify) and !empty($Notify)) {
                    foreach ($Notify as $key => $value) {
                        ?>
                        <div class="detail  brder_btm padd_tb15">
                            <div class="col-md-10 col-sm-8">
                                <p class="text_1"><a href="<?php echo $this->webroot; ?>freelancer/delete_notify/<?php echo $value['Notification']['id']; ?>" style="text-decoration: none ;  color: #817978;" onclick='javascript:return confirm("Are you Sure to delete this Notification ?");'><img src="<?php echo $this->webroot; ?>img/cross_icon.png"> </a><?php echo $value['Notification']['notification_msg']; ?></p>
                            </div>
                            <div class="col-md-2">
                                <div class="right_side">
                                    <span>
                                        <img src="<?php echo $this->webroot; ?>img/calander.png"/> <?php echo date('M d Y', strtotime($value['Notification']['created'])); ?> 
                                    </span> 
                                    <br>
                                    <span> <img src="<?php echo $this->webroot; ?>img/clock1.png"> <?php echo date('H:i', strtotime($value['Notification']['created'])) . '  min'; ?> </span>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                    <?php }
                } else {
                    ?>     
                    <div class="detail  brder_btm padd_tb15">
                        <p style="color: #C7C4C8; text-align: center;  font-size: 18px;"> 
                            <strong>You have no notifications.</strong>
                        </p>
                        <div class="clearfix"></div>
                    </div>
            <?php } ?>
                <div class="clearfix"></div>
            </div>
                <?php if (isset($Notify) and !empty($Notify)) { ?>
                <ul class="pagination pull-right">
                    <li><?php echo $this->Paginator->prev('<<Previous', null, null, array('class' => 'disabled')); ?></li>
                    <?php
                    echo $this->Paginator->numbers(array(
                        'before' => '',
                        'after' => '',
                        'separator' => '',
                        'tag' => 'li',
                        'spanClass' => 'sr-only',
                        'currentClass' => 'active',
                        'currentTag' => 'a',
                    ));
                    ?> 
                    <li><?php echo $this->Paginator->next('Next>>', null, null, array('class' => 'disabled')); ?></a></li>
                </ul>    
<?php } ?>  

        </div>
    </div>
</div>
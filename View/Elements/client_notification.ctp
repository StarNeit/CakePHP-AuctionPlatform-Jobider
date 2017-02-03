<div class="panel panel-default green_bg1">
    <div class="panel-heading">Notifications</div>
    <div class="panel-body bg_grey1 padd_tb15">
        <?php if (!empty($notification)) { ?>
            <marquee onmouseout="this.start()" onmouseover="this.stop()" scrolldelay="200" direction="up" scrollamount="8" behavior="scroll" height="100" vspace="20">

                <?php foreach ($notification as $k => $v) { ?>
                    <?php if ($v['Notification']['status'] == '0') { ?>
                        <p class="font_14" style="margin:15px; line-height:18px; ">
                            <a href="<?php echo $v['Notification']['url']; ?>" style="text-decoration: none; color:#434343;"><?php echo $v['Notification']['notification_msg']; ?></a>
                            <img src="<?php echo $this->webroot; ?>img/new_icon.gif">
                        </p>                       
                    <?php } else { ?>
                        <p class="font_14" style="margin:15px; line-height:18px">
                            <a class="client_h"  href="<?php echo $v['Notification']['url']; ?>"><?php echo ucfirst($v['Notification']['notification_msg']); ?></a>
                        </p>
                        <div class="brder_btm"></div>
                    <?php } ?>
        
                <?php } ?></marquee>
        <?php } else { ?>
            <p style="text-align: center">No Notification(s) Recieved !</p>                                      <?php } ?>
        <p><i><img alt="See all notifications" class="mrg_r5" src="<?php echo $this->webroot; ?>img/view.png"></i><a href="<?php echo $this->webroot; ?>client/allNotifications" style="text-decoration: none;">See all notifications  &gt;&gt;</a></p>
    </div>
</div>

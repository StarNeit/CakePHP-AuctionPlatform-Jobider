<div class="container">
    <?php if (isset($help) and !empty($help)) {
        ?>
        <div class="row marg_tb15">
            <div class="col-md-3 pad_l0 col-sm-3">
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body bg_grey1 padd_0">
                        <ul class="nav ">
                            <?php if (isset($help_topic) and !empty($help_topic)) {
                                foreach ($help_topic as $k => $val) {
                                    ?>
                                    <li><a href="<?php echo $this->webroot; ?>freelancer/singleHelpTopic/<?php echo $val['Help']['id'] ?>"><?php echo $val['Help']['title']; ?></a></li> <?php }
                } ?> 
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Notifications</div>
                    <div class="panel-body bg_grey1 padd_tb15">
                            <?php if (!empty($notification)) { ?>
                            <marquee onmouseout="this.start()" onmouseover="this.stop()" scrolldelay="200" direction="up" scrollamount="8" behavior="scroll" height="100" vspace="20">
                                <?php foreach ($notification as $k => $v) {
                                    ?>
            <?php if ($v['Notification']['status'] == '0') { ?>
                                        <p class="font_14" style="margin:15px; line-height:18px">
                                            <a href="<?php echo $v['Notification']['url']; ?>" style="color: #434343; text-decoration: none;"><?php echo $v['Notification']['notification_msg']; ?></a>
                                            <img src="<?php echo $this->webroot; ?>img/new_icon.gif" alt="new icon gif image">
                                        </p>

            <?php } else { ?>
                                        <p class="font_14" style="margin:15px; line-height:18px">
                                            <a href="<?php echo $v['Notification']['url']; ?>" style="color:#434343;text-decoration: none;"><?php echo $v['Notification']['notification_msg']; ?></a>
                                        </p>
                                <?php } ?>
        <?php } ?></marquee>       
                        <?php } else { ?>
                            <p style="font-size: 15px; text-align: center; margin-top: 25px; margin-bottom: 25px;">No Notifcation(s) Recieved !</p>      

    <?php } ?>
                        <p><i><img alt="See all notification" class="mrg_r5" src="<?php echo $this->webroot; ?>img/view.png"></i><a href="<?php echo $this->webroot; ?>freelancer/allNotifications" style="text-decoration: none;">See all notifications  &gt;&gt;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9  pad_r0 ">

                <div class="bg_white">
                    <div class="green"> <?php echo $help['Help']['title']; ?> </div>
                    <div class="col-md-12">
                        <div class="basic">
                            <h5>  Basic </h5>
                            <p> <?php echo $help['Help']['description']; ?> </p>

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
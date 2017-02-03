<div class="container">
    <?php if (!empty($faqs)) { ?>
        <div class="row marg_tb15">

            <div class="col-md-3 pad_l0 col-sm-3">

                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body bg_grey1 padd_0">
                        <ul class="nav ">
                            <li class="active"><a href="<?php echo $this->webroot; ?>freelancer/dashboardHelp"> Help </a></li>
    <!--                        <li><a href="<?php echo $this->webroot; ?>freelancer/freelancer_dispute">  Dispute </a></li>-->
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
                                            <img src="<?php echo $this->webroot; ?>img/new_icon.gif" alt="new image icon">
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
                        <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="See all Notifications"/></i><a href="<?php echo $this->webroot; ?>freelancer/allNotifications" style="text-decoration: none;"/>See all notifications  >></a></p>

                        </ul>
                    </div>
                </div>



            </div>

            <div class="col-md-9 col-sm-9  pad_r0 ">
                <div class="bg_white">

                    <div class="green"> <?php echo $faqs['Faq']['question']; ?> </div>
                    <div class="col-md-12">
                        <div class="basic">
                            <h5>  Basic </h5>
                            <p> <?php echo $faqs['Faq']['title']; ?> </p>

                        </div>
                        <div class="basic" style="border-bottom:0px;">
                            <h5>  Details </h5>

                            <p> <?php echo $faqs['Faq']['answer']; ?> </p>

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
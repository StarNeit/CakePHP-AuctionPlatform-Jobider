<?php
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'notifications')) {
    $notify = 'active';
} else {
    $notify = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'settings')) {
    $settings = 'active';
} else {
    $settings = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'setupPayments')) {
    $setup = 'active';
} elseif ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'setupPayments_step1')) {
    $setup = 'active';
} elseif ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'setupPayments_step2')) {
    $setup = 'active';
} else {
    $setup = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'myprofile')) {
    $myprofile = 'active';
} else {
    $myprofile = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'contact_info')) {
    $contact_info = 'active';
} else {
    $contact_info = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'membership_plans')) {
    $plans = 'active';
} else {
    $plans = '';
}
?>
<div class="container">
    <!--Left Sidebar-->
    <div class="col-md-3 col-sm-4">
        <div class="nav_top">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Settings</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav opensans font_14">
                        <li class="<?php echo $settings; ?>"><a class="opensans font_16" href="<?php echo $this->webroot; ?>freelancer/settings"> Change Password </a></li>
                        <li class="<?php echo $myprofile; ?>"><a href="<?php echo $this->webroot; ?>freelancer/myprofile" class="opensans font_16"> My Profile</a></li>
                        <li class="<?php echo $contact_info; ?>"><a class="opensans font_16" href="<?php echo $this->webroot; ?>freelancer/contact_info"> Contact Info</a></li>
                        <li class="<?php echo $notify; ?>"><a class="opensans font_16" href="<?php echo $this->webroot; ?>freelancer/notifications"> Notification Settings </a></li>
<!--                        <li class="<?php //echo $setup; ?>"><a class="opensans font_16" href="<?php //echo $this->webroot; ?>freelancer/setupPayments"> Setup Payments</a></li>-->
                        <li class="<?php echo $plans; ?>"><a class="opensans font_16" href="<?php echo $this->webroot; ?>freelancer/membership_plans">Membership Plans</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--End Left Sidebar--->

    <!--Right Section Contact-info-->

    <div class="col-md-9 col-sm-8">
        <div class="info"> 
            <h1>Contact info</h1>
        </div> <!--info --> 
        <div class="account">Account</div> <!--account --> 
        <div class="edit">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="edit_left">
                    <p><b> UserName</b></p>
                </div> <!--edit_left -->
            </div> <!--col-md-6 -->
            <?php
            if (isset($user) and !empty($user)) {
                ?>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="edit_right">
                        <p><?php echo ucfirst($user['User']['username']); ?></p>
                    </div>	<!--edit_rigth -->
                </div><!--col-md-6-->
            <?php } ?>
        </div><!--edit --> 
        <div class="edit">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="edit_left">
                    <p><b>Name</b></p>
                </div><!--edit_left -->
            </div><!--col-md-6 -->
            <?php if (isset($user) and !empty($user)) { ?>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="edit_right">
                        <p><?php echo ucfirst($user['User']['first_name']) . '  ' . ucfirst($user['User']['last_name']); ?></p>
                    </div>	<!--edit_rigth -->
                </div><!--col-md-6-->
            <?php } ?>
        </div><!--edit --> 
        <div class="edit">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="edit_left">
                    <p><b>Image</b></p>
                </div><!--edit_left -->
            </div><!--col-md-6 -->
            <div class="col-md-9 col-sm-8 col-xs-12">
                <div class="edit_right">

                    <div class="col-md-3 s">
                        <div class="edit_right_left">
                            <?php if (isset($user['User']['image']) and !empty($user['User']['image'])) { ?>
                                <img class="img-thumbnail" src="<?php echo $this->webroot; ?>uploads/<?php echo $user['User']['image'] ?>"  height="100"width="100">
                            <?php } else { ?>
                                <img src="<?php $this->webroot;?>/img/freelancer.png" class="img-thumbnail" >
                            <?php } ?>
                        </div>
                    </div>
                </div>	<!--edit_rigth -->
            </div><!--col-md-6-->
        </div><!--edit --> 
        <div class="edit">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="edit_left">
                    <p><b>Email</b></p>
                </div><!--edit_left -->
            </div><!--col-md-6 -->
            <div class="col-md-9 col-sm-8 col-xs-12">
                <?php if (isset($user) and !empty($user)) { ?>
                    <div class="edit_right">
                        <p><?php echo $user['User']['email']; ?></p>
                    </div>	<!--edit_rigth -->
                <?php } ?>


            </div><!--col-md-6-->
        </div><!--edit --> 

        <div class="edit">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="edit_left">
                </div><!--edit_left -->
            </div><!--col-md-6 -->

        </div><!--edit --> 
        <div class="account">Location</div><!--account --> 
        <div class="edit">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="edit_left">
                    <p><b>Country</b></p>
                </div><!--edit_left -->
            </div><!--col-md-6 -->
            <div class="col-md-9 col-sm-8 col-xs-12">
                <?php if (isset($user) and !empty($user)) { ?>
                    <div class="edit_right">
                        <p><?php echo $u_country['Country']['name']; ?></p>
                    </div>	<!--edit_rigth -->
                <?php } ?> 
            </div><!--col-md-6-->
        </div><!--edit --> 
        <div class="edit">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="edit_left">
                    <p><b>Phone</b></p>
                </div><!--edit_left -->
            </div><!--col-md-6 -->
            <div class="col-md-9 col-sm-8 col-xs-12">  

                <div class="edit_right">
                    <?php if (isset($user['User']['phone']) and !empty($user['User']['phone'])) { ?>
                        <p><?php echo $user['User']['phone']; ?></p>
                    <?php } else { ?>
                        <p>No Phone number Register.</p>
                    <?php } ?>
                </div>	<!--edit_rigth -->

            </div><!--col-md-6-->
        </div><!--edit --> 
        <div class="edit">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="edit_left">
                    <p><b>Company</b></p>
                </div><!--edit_left -->
            </div><!--col-md-6 -->
            <div class="col-md-9 col-sm-8 col-xs-12">  
                    <div class="edit_right">
                          <?php if (isset($user['User']['company']) and !empty($user['User']['company'])) { ?>
                        <p><?php echo ucfirst($user['User']['company']); ?></p>
                            <?php }else{ ?>
                        <p>No Company Register .</p>
                            <?php }?>
                    </div><!--edit_rigth -->
                </div> <!--col-md-6-->
            <div class="col-md-9 col-sm-9 col-xs-7col-md-offset-3 col-sm-offset-3 col-xs-offset-5">
                <?php if (isset($user) and !empty($user)) { ?>

                    <div class="edit_right1">
                        <a href="<?php echo $this->webroot; ?>freelancer/editprofile"><button class="btn-green test">Edit Profile</button></a>
                    </div>	<!--edit_rigth -->
                <?php } ?>   


            </div>
        </div><!--edit --> 
    </div>

    <!---End Right Section--->



</div>
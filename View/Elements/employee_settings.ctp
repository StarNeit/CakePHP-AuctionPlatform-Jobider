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
}elseif ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'setupPayments_step2')) {
    $setup = 'active';
}  
else {
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


if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'addMembers')) {
    $add_members = 'active';
} else {
    $add_members = '';
}
?>
<div class="col-md-3 pad_l0 col-sm-4">
    <div class="panel panel-default green_bg1">
        <div class="panel-heading">Settings</div>
        <div class="panel-body bg_grey1 padd_0">
            <ul class="nav opensans font_14">
                <li class="<?php echo $settings; ?>"><a href="<?php echo $this->webroot; ?>freelancer/settings" class="opensans font_16"> Change Password </a></li>
                <li class="<?php echo $notify; ?>"><a href="<?php echo $this->webroot; ?>freelancer/notifications" class="opensans font_16"> Notification Settings </a></li>
<!--                <li class="<?php //echo $setup; ?>"><a href="<?php //echo $this->webroot; ?>freelancer/setupPayments" class="opensans font_16"> Setup Payments</a></li>-->
                <li class="<?php echo $myprofile; ?>"><a href="<?php echo $this->webroot; ?>freelancer/myprofile" class="opensans font_16"> My Profile</a></li>
                <li class="<?php echo $contact_info; ?>"><a href="<?php echo $this->webroot; ?>freelancer/contact_info" class="opensans font_16"> Contact Info</a></li>
                <li class="<?php echo $plans; ?>"><a href="<?php echo $this->webroot; ?>freelancer/membership_plans" class="opensans font_16"> Membership Plans</a></li><?php if(!empty($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['employer_type']=='company'){ ?>
                   <li class="<?php echo $add_members; ?>"><a href="<?php echo $this->webroot; ?>freelancer/addMembers" class="opensans font_16"> Add Members for Company</a></li>
                
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
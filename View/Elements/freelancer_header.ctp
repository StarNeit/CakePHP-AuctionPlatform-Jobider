<?php
//pr($this->params);
//pr($test_data);
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'index') {
    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'myprofile') {
    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'mytests') {
    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'editprofile') {
    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'takeatest') {
    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'TakeTestOnClick' && $this->params['pass'][0] == $test) {

    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'start_test' && $this->params['pass'][0] == $test_data) {

    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'starting_test' && $this->params['pass'][0] == $test_data) {

    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'test_result' && $this->params['pass'][0] == $test_data) {

    $findwork1 = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'finalresult' && $this->params['pass'][0] == $test_data) {

    $findwork1 = 'active';
} else {
    $findwork1 = '';
}


if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'myjobs') {
    $myapplications = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'contracts') {
    $myapplications = 'active';
} else {
    $myapplications = '';
}

if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'reporting') {
    $reporting = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'viewearning') {
    $reporting = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'withdraw') {
    $reporting = 'active';
} else {
    $reporting = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'mymessage') {
    $mymessage = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'single_message') {
    $mymessage = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'inbox_message') {
    $mymessage = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'sent_message') {
    $mymessage = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'archieve_message') {
    $mymessage = 'active';
} else {
    $mymessage = '';
}
//// For Top bar icons like  Settings , Dashboard Help and Notifications //// 
if ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'settings')) {
    $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} elseif ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'notifications')) {
    $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} elseif ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'setupPayments')) {
    $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} elseif ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'myprofile')) {
    $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} elseif ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'contact_info')) {
    $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} elseif ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'membership_plans')) {
    $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} else {
    $setting = '';
}
if ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'dashboardHelp')) {
    $help = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} elseif ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'view_help') && ($this->params['pass'][0] == $helpid)) {
    $help = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} elseif ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'freelancer_dispute')) {
    $help = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} elseif ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'singleHelpTopic') && ($this->params['pass'][0] == $helps)) {
    $help = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} else {
    $help = '';
}
if ($this->params['controller'] == 'freelancer' && ($this->params['action'] == 'allNotifications')) {
    $notifications = 'active';
    ?>
    <style>
        .btn.btn-default.dropdown-toggle.active
        {
            background: none repeat scroll 0 0 #66c5bf;
        }
    </style>
    <?php
} else {
    $notifications = '';
}
?>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="logo "> <a href="<?php echo BASE_URL; ?>/freelancer" class="col-md-2 col-sm-2"> <img src="<?php echo $this->webroot; ?>img/logo.png" alt="logo"/> </a> </div>
            <div class="col-md-10 col-sm-10">
                <div class="new_hdr">
                    <div class="row">
                        <div class="pull-right">
                            <ul class="list-inline new_top_list">
                                <?php
                                $ses = $this->Session->read();
                                if (!empty($ses['Auth']['User']['id'])) {
                                    ?>
                                    <div class="dropdown1">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome <?php echo $ses['Auth']['User']['first_name']; ?> <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu new_drop li" role="menu">
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'settings')); ?>">My Settings</a></li>
                                                <li class="divider"></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'myjobs')); ?>">My Jobs </a>                                            </li>
                                                <li class="divider"></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'login', 'action' => 'logout')); ?>">Logout</a></li>
                                            </ul> 
                                        </li> 
                                    </div>
                                <?php } ?>
                                <li class="<?php echo $setting; ?>">
                                    <a href="<?php echo $this->Html->URL(array('controller' => 'freelancer', 'action' => 'settings')); ?>" class="icon_bg"><img src="<?php echo $this->webroot; ?>img/setting.png" alt="Settings"/></a>
                                </li>
                                <li class="<?php echo $help; ?>">
                                    <a href="<?php echo $this->webroot; ?>freelancer/dashboardHelp" class="icon_bg"><img src="<?php echo $this->webroot; ?>img/ques.png" alt="Quetsion"/></a>   </li>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle <?php echo $notifications; ?>" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                        <span><img src="<?php echo $this->webroot; ?>img/notify.png" alt="Notify"/></span>
                                        <?php if ($count_notify > 0) { ?> <span class="badge"><?php echo $count_notify; ?></span> <?php } ?>
                                    </button>
                                    <?php $CountNotifications = count($notification); ?>
                                    <ul <?php if ($CountNotifications > 3) { ?>class="dropdown-menu scrl" <?php } elseif ($CountNotifications >= 1 && $CountNotifications <= 3) { ?> class="dropdown-menu" <?php } elseif (empty($notification)) { ?> class="dropdown-menu" <?php } ?> role="menu" aria-labelledby="dropdownMenu1">
                                        <span class="arrow1"></span>
                                        <?php
                                        if (!empty($notification)) {
                                            foreach ($notification as $key => $value) {
                                                ?>
                                                <li>
                                                    <p>
                                                        <?php if ($value['Notification']['status'] == '0') { ?> 
                                                            <a role="menuitem" tabindex="-1" href="<?php echo $value['Notification']['url'] ?>" class="btndata" id="<?php echo $value['Notification']['id']; ?>" >
                                                                <?php echo $value['Notification']['notification_msg']; ?>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a role="menuitem" tabindex="-1" href="<?php echo $value['Notification']['url'] ?>" style="color:#C7CBD6";  id="<?php echo $value['Notification']['id']; ?>">
                                                                <?php echo $value['Notification']['notification_msg']; ?>
                                                            </a>
                                                        <?php } ?>
                                                        <a href="<?php echo $this->webroot; ?>freelancer/delete_notify/<?php echo $value['Notification']['id']; ?>" onclick='javascript:return confirm("Are you Sure to delete this Notification ?");'> <i><img src="<?php echo $this->webroot; ?>img/cross_icon.png" alt="cross"/></i></a></p> </li>
                                                <li class="divider"></li>
                                            <?php } ?>
                                            <a href="<?php echo $this->webroot; ?>freelancer/allNotifications" style="float:left;margin-left:10px;text-decoration: none; font-size:17px;">See all Notifications</a>
                                        <?php } else { ?>
                                            <a href="<?php echo $this->webroot; ?>freelancer/allNotifications" style="float:left;margin-left:10px">See all Notifications</a>
                                        <?php } ?>
                                    </ul>
                                </div> 
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row marg_t5">
                    <div class="pull-right fnone">
                        <nav role="navigation" class="new_navigation">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header ">
                                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse ">
                                <ul class="nav navbar-nav">
                                    <li class="<?php echo $findwork1; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'index')); ?>">Find Work </a></li>  
                                    <li class="<?php echo $myapplications; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'myjobs')); ?>"> My Jobs</a></li>
<!--                                    <li class="<?php echo $Membership_plans; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'membership_plans')); ?>">Membership Plans</a></li>-->
                                    <li class="<?php echo $reporting; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'reporting')); ?>">Reporting</a></li>
                                    <li class="<?php echo $mymessage ?>">
                                        <?php if ($count_message > 0) { ?>  <span class="mymessge"><?php echo $count_message; ?></span><?php } ?><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'mymessage')); ?>">My Messages</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse --> 
                            <!-- /.container-fluid --> 
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.btndata', function (event) {
            event.preventDefault();
//                                                        alert('dsvjksd');
            var id = $('.btndata').attr('id');
            $.ajax({
                'type': 'post',
                dataType: 'json',
                'url': '<?php echo $this->webroot; ?>freelancer/ajax_notify',
                'data': {id: id},
                success: function (msg) {
                    if (msg.suc == 'yes') {
                        window.location.href = msg.url;
                    }
                }
            });
        });
    });
</script>
<style>

    .dropdown-menu.scrl {
        height: 210px;
        overflow-y: scroll;
    }</style>
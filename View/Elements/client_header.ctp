<?php
//pr($this->params);
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'index')) {
    $index = 'active';
}
else 
{
    $index = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'postajob')) 
{
    $recruit = 'active';
} 
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'searchfreelancer'))
{
   $recruit = 'active'; 
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'contract') && ($this->params['pass'][0]==$us))
{
    $recruit = 'active';
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'postedJobs'))
{
    $recruit='active';
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'viewpost') && ($this->params['pass'][0]==$jobid))
{
    $recruit='active';
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'editjob') && ($this->params['pass'][0]==$jobid))
{
    $recruit ='active';
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'Postinfo') && ($this->params['pass'][0]==$jobid))
{
    $recruit='active';
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'freelancer_profile') && ($this->params['pass'][0]==$ussid))
{
    $recruit='active';
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'contect_for_freelancer') && ($this->params['pass'][0]==$ussid))
{
    $recruit='active';
}
else
{
    $recruit = '';
}
if($this->params['controller'] == 'client' && ($this->params['action'] == 'manageMyTeam')) 
{
    $manageTeam = 'active';
} 
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'ActiveContract'))
{
 $manageTeam ='active'; 
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'SentMessageToApplicant'))
{
 $manageTeam ='active'; 
}
else 
{
    $manageTeam = '';
}
if($this->params['controller'] == 'client' && ($this->params['action'] == 'Reports')) 
{
    $report = 'active';
} 
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'transactionHistory'))
{
    $report = 'active';
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'WorkSummary'))
{
    $report ='active';
}
else 
{
    $report = '';
}
if($this->params['controller'] == 'client' && ($this->params['action'] == 'mymessages')) 
{
    $msg = 'active';
} 
elseif($this->params['controller'] == 'client' && $this->params['action'] == 'send')
{
   $msg = 'active'; 
}
elseif($this->params['controller'] == 'client' && $this->params['action'] == 'archieve_message')
{
  $msg = 'active';  
}
elseif($this->params['controller'] == 'client' && $this->params['action'] == 'single_message' && $this->params['pass'][0]==$sender)
{
  $msg = 'active';  
}
else
{
    $msg = '';
}
////// For Top Bar Icons like Setting, Dashboard Help,Notifications /////////
if($this->params['controller'] == 'client' && ($this->params['action'] == 'settings')) 
{
    $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} 
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'changepassword'))
{
     $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'my_payment'))
{
     $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'notifications'))
{
     $setting = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php 
}
else
{
    $setting = '';
}

if($this->params['controller'] == 'client' && ($this->params['action'] == 'dashboardHelp'))
{
    $dashboardHelpPage = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
} 
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'client_Dispute'))
{
     $dashboardHelpPage = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'view_help') && ($this->params['pass'][0]==$helpid))
{
    $dashboardHelpPage = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
}
elseif($this->params['controller'] == 'client' && ($this->params['action'] == 'singleHelpTopic') && ($this->params['pass'][0]==$helps))
{
    $dashboardHelpPage = 'active';
    ?>
    <style>
        .active .icon_bg
        {
            background: #66C5BF !important;
        }
    </style>
    <?php
}
else
{
    $dashboardHelpPage = '';
}

if($this->params['controller'] == 'client' && ($this->params['action'] == 'allNotifications')) 
{
    $all_notifications = 'active';
    ?>
    <style>
        .btn.btn-default.dropdown-toggle.active 
        {
            background: none repeat scroll 0 0 #66c5bf;
        }
    </style>
    <?php
} 
else
{
    $all_notifications = '';
}
?>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="logo "> <a href="<?php echo BASE_URL; ?>/client" class="col-md-2 col-sm-2"> <img src="<?php echo $this->webroot; ?>img/logo.png" alt="logo image"/> </a> </div>
            <div class="col-md-10 col-sm-10">
                <div class="new_hdr">
                <div class="row">
                    <div class="pull-right">
                        <ul class="list-inline new_top_list">
                            <?php
                            $session = $this->Session->read();
                            if (!empty($session['Auth']['User']['id'])) {
                                ?>
                                <div class="dropdown1">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome <?php echo substr($session['Auth']['User']['first_name'],0,300); ?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu new_drop li" role="menu">
                                            <?php $client_session = $this->Session->read(); ?>
                                            <?php if (isset($client_session['Auth']['User']['first_name'])) { ?><li><a href="<?php echo $this->Html->Url('/client'); ?>"> <?php echo $client_session['Auth']['User']['first_name'] . '&nbsp;' . $client_session['Auth']['User']['last_name']; ?></a></li><?php } ?>  <li class="divider"></li>
                                            <li><a href="<?php echo $this->Html->Url(array('controller' => 'login', 'action' => 'logout')); ?>" class="">Logout </a>
                                            </li>
                                        </ul>
                                    </li>
                                </div>
                            <?php } ?>
                            <li class="<?php echo $setting; ?>">
                                <a href="<?php echo $this->Html->Url('/client/settings'); ?>" class="icon_bg"><img src="<?php echo $this->webroot; ?>img/setting.png" alt="Settngs image"/></a>
                            </li>
                            <li class="<?php echo $dashboardHelpPage; ?>">
                                <a href="<?php echo $this->webroot; ?>client/dashboardHelp" class="icon_bg"><img src="<?php echo $this->webroot; ?>img/ques.png" alt="Question"/></a>
                            </li>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle <?php echo $all_notifications; ?> " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
              <span><img src="<?php echo $this->webroot; ?>img/notify.png" alt="notify"/></span>
                                  <?php if($count_notify >0){?> 
              <span class="badge"><?php echo $count_notify ?></span><?php } ?>
                                </button>
                                      <?php $CountNotifications = count($notification); 
                                      ?>
                                               <ul <?php if ($CountNotifications > 3) { ?>class="dropdown-menu scrl" role="menu" aria-labelledby="dropdownMenu1" <?php } elseif($CountNotifications >=1 && $CountNotifications<=3){ echo $CountNotifications; ?> class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" <?php }elseif(empty($notification)){ ?> class="dropdown-menu" <?php } ?> role="menu" aria-labelledby="dropdownMenu1">
<!--                                <ul class="dropdown-menu scrl" role="menu" aria-labelledby="dropdownMenu1"> -->
                                    <span class="arrow1"></span>
                                    <?php
                                    if (!empty($notification)) {
                                        foreach ($notification as $val) {
                                            ?>
                                            <li class="dataval"><p>
                                                    <?php if($val['Notification']['status']=='0') {?><a role="menuitem" tabindex="-1" href="<?php echo $val['Notification']['url']; ?>" class="btndata" id="<?php  echo $val['Notification']['id'];?>">
                                                    <?php echo $val['Notification']['notification_msg']; ?></a> <i><a href="<?php echo $this->webroot; ?>client/delete_notification/<?php echo $val['Notification']['id']; ?>"><img src="<?php echo $this->webroot; ?>img/closepng.png" alt="Close image"/></i></a>
                                                        <?php } else { ?>
                                                <a role="menuitem"  style="color:#CbCBD6;"  tabindex="-1" href="<?php echo $val['Notification']['url']; ?>">
                                                    <?php echo $val['Notification']['notification_msg']; ?></a> 
                                                <i><a href="<?php echo $this->webroot; ?>client/delete_notification/<?php echo $val['Notification']['id']; ?>"><img src="<?php echo $this->webroot; ?>img/closepng.png" alt="Close image"/></i></a>
                                                    <?php } ?>
                                                   </p> </li>
                                            <li class="divider"></li>
                                        <?php } ?>
                                        <a href="<?php echo $this->webroot; ?>client/allNotifications" style="float:left;margin-left:10px">See all Notifications</a>
                                    <?php } else { ?>
                                        <a href="<?php echo $this->webroot; ?>client/allNotifications" style="float:left;margin-left:10px">See all Notifications</a>
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
                            <div class="navbar-header ">
                                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <li class="<?php echo $index; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'index')); ?>">Dashboard </a></li>
                                    <li class="<?php echo $recruit; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'postajob')); ?>">Recruit </a></li>
                                    <li class='<?php echo $manageTeam; ?>'><a href="<?php echo $this->webroot; ?>client/manageMyTeam">Manage My Team</a></li>
                                    <li class='<?php echo $report; ?>'><a href="<?php echo $this->webroot; ?>client/transactionHistory">Reports </a></li>
                                    <li class='<?php echo $msg; ?>'><?php if($count_message >0){?>  <span class="mymessge"><?php  echo $count_message;?></span><?php } ?><a href="<?php echo $this->webroot; ?>client/mymessages">My Messages </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
            $(document).on('click','.btndata',function(event){
              event.preventDefault();
              var id=$('.btndata').attr('id');
              $.ajax({
                 'type':'post',
                 'dataType':'json',
                 'url':'<?php  echo $this->webroot;?>client/ajax_notification ',
                 'data':{id :id},
                 success:function(msg){
                     if(msg.suc=='yes'){
                         window.location.href=msg.url;
                     }
                     
                 }
              });
            });
        });
        </script>    

<style>
    .No-notify {
        clear: both;
        color: #434343;
        font-size: 15px;
        margin-bottom: 25px;
        margin-top: 25px;
        text-align: center !important;
    }
</style>

<style>
    
    .dropdown-menu.scrl {
    height: 210px;
    overflow-y: scroll;
    }
</style>                      
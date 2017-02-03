<?php die('sbcvjv');
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'index') {
    $findwork1 = 'active';
} else {
    $findwork1 = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'applyjob') {
    $findwork = 'active';
} else {
    $findwork = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'findjobs') {
    $findwork = 'active';
} else {
    $findwork = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'findjobsbycategory' && $this->params['pass']['0'] == '2') {
    $findwork = 'active';
} else {
    $findwork = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'jobdetail') {
    $findwork = 'active';
} else {
    $findwork = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'takeatest') {
    $findwork = 'active';
} else {
    $findwork = '';
}


if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'myapplication') {
    $myapplications = 'active';
} else {
    $myapplications = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'archapplication') {
    $myapplication = 'active';
} else {
    $myapplication = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'sentapplication') {
    $myapplication = 'active';
} else {
    $myapplication = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'invinterview') {
    $myapplication = 'active';
} else {
    $myapplication = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'reporting') {
    $reporting = 'active';
}elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'viewearning') {
     $reporting = 'active';
} 
elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'withdraw') {
     $reporting = 'active';
} 

else {
    $reporting = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'mymessage') {
    $mymessage = 'active';
} 
elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'single_message') {
    
     $mymessage = 'active';
    
}
elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'inbox_message') {
    
     $mymessage = 'active';
    
}
elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'sent_message') {
    
     $mymessage = 'active';
    
}
else {
    $mymessage = '';
}
?>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="logo "> <a href="<?php echo BASE_URL; ?>" class="col-md-2 col-sm-2"> <img src="<?php echo $this->webroot; ?>img/logo.png" alt="Logo"/> </a> </div>
            <div class="col-md-10 col-sm-10">
                <div class="row">
                    <div class="pull-right">
                        <ul class="list-inline new_top_list">
                            <?php
                            $ses = $this->Session->read();
                            if (!empty($ses['Auth']['User']['id'])) {
                                ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome <?php echo $ses['Auth']['User']['first_name']; ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'editprofile')); ?>">My Settings</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'myapplication')); ?>">My Job Application</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo $this->Html->Url(array('controller' => 'login', 'action' => 'logout')); ?>">Logout</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li>

                                <a href="<?php echo $this->Html->URL(array('controller' => 'freelancer', 'action' => 'settings')); ?>" class="icon_bg"><img src="<?php echo $this->webroot; ?>img/setting.png" alt="Settings"/></a>
                            </li>
                            <li>

                                <a href="#" class="icon_bg"><img src="<?php echo $this->webroot; ?>img/ques.png"alt="Quetsion"/></a>
                            </li>
                            <li>

                                <a href="#" class="icon_bg"><img src="<?php echo $this->webroot; ?>img/notify.png" alt="Notify"/></a>
                            </li>

                        </ul>
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
                                    <li class="<?php echo $myapplications; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'myapplication')); ?>"> My Applications</a></li>
                                    <li class="<?php echo $reporting; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'reporting')); ?>">Reporting</a></li>
                                    <li class="<?php echo $mymessage ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'mymessage')); ?>">My Messages</a></li>

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

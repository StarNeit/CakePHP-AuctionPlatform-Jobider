<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="<?php echo $this->webroot; ?>img/job2.png">
        <title>Jobider</title>
        <!--Core CSS -->
        <link href="<?php echo $this->webroot; ?>bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $this->webroot; ?>js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
        <link href="<?php echo $this->webroot; ?>css/bootstrap-reset.css" rel="stylesheet">
        <link href="<?php echo $this->webroot; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo $this->webroot; ?>js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
        <link href="<?php echo $this->webroot; ?>css/clndr.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/jquery.tagsinput.css" />
        <!--clock css-->
        <link href="<?php echo $this->webroot; ?>js/css3clock/css/style.css" rel="stylesheet">
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>js/morris-chart/morris.css">

        <!--dynamic table-->
        <link href="<?php echo $this->webroot; ?>js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
        <link href="<?php echo $this->webroot; ?>js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>js/data-tables/DT_bootstrap.css" />
        <!-- Custom styles for this template -->
        <link href="<?php echo $this->webroot; ?>css/style.css" rel="stylesheet">
        <link href="<?php echo $this->webroot; ?>css/style-responsive.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/colorbox.css" />
        <?php //echo $this->Html->css(array('custom','bootstrap')); ?>
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]>
        <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
            checked = false;
            function checkedAll(frm1) {
                var aa = document.getElementById('frm1');
                if (checked == false)
                {
                    checked = true
                }
                else
                {
                    checked = false
                }
                for (var i = 0; i < aa.elements.length; i++) {
                    aa.elements[i].checked = checked;
                }
            }
        </script>

    </head>
    <body>
        <section id="container">
            <!--header start-->
            <header class="header fixed-top clearfix">
                <!--logo start-->
                <div class="brand">
                    <a href="<?php echo $this->webroot; ?>webadmin" class="logo">
                        <img src="<?php echo $this->webroot; ?>images/jobider_logo.png" alt="Jobider Backend" height="55" width="150">
                    </a>
                    <div class="sidebar-toggle-box">
                        <div class="fa fa-bars"></div>
                    </div>
                </div>
                <!--logo end-->
<!--                <div class="nav notify-row" id="top_menu">
                      notification start 
                    <ul class="nav top-menu">
                        <li id="header_notification_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                <i class="fa fa-bell-o"></i>
                                <?php //if (!empty($admin_count)) { ?>
                                    <span class="badge bg-warning"><?php //echo $admin_count; ?></span>
                                <?php //} else { ?>
                                    <span class="badge bg-warning"></span>
                                <?php //} ?>
                            </a>
                            <ul class="dropdown-menu extended notification">
                                <li>
                                    <p>Notifications</p>
                                </li>
                                <?php //foreach ($admin_data as $k => $v) { ?>
                                    <?php //if ($v['AdminNotification']['read_status'] == '0') { ?>
                                        <li>
                                            <div class="alert alert-info clearfix">
                                                <span class="alert-icon"></span>
                                                <div class="noti-info">
                                                    <a href="JavaScript:void(0);" class="notifi"> <?php  // echo $v['AdminNotification']['message']; ?></a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php //} else { ?>
                                        <li>
                                            <div class="alert alert-success clearfix">
                                                <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                                <div class="noti-info">
                                                    <a href="#"><?php //echo $v['AdminNotification']['message']; ?></a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php //} ?>
                                <?php //} ?>



                            </ul>
                        </li>
                         notification dropdown end 
                    </ul>
                      notification end 
                </div>-->


                <div class="top-nav clearfix">
                    <!--search & user info start-->
                    <ul class="nav pull-right top-menu">
                        <li>
                            <a href="<?php echo $this->webroot; ?>" class="form-control" style="width: 100%; text-align: center;" target="_blank"><span class="username">view site</span></a>
                        </li>
<!--                            <input type="text" class="form-control search" placeholder=" Search">                        </li>-->
                            <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="User image" src="<?php echo $this->webroot; ?>img/user_1.png">
                                <span class="username"><?php echo $_SESSION['Auth']['Admin']['username']; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                <!--                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>-->
                                <li><a href="<?php echo $this->Html->url('/webadmin/login/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                        <li>
                        </li>
                    </ul>
                    <!--search & user info end-->
                </div>
            </header>
            <!--header end-->

            <?php echo $this->Html->script('jquery.min'); ?>
            <script>
                $(document).ready(function() {
                    $(document).on('click','.notifi',function(){
//                        alert('sdgasdjsa');
                    });
                });

            </script>




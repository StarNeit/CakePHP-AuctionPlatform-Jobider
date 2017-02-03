<?php
//pr($this->params);
if ($this->params['controller'] == 'blogs' && ($this->params['action'] == 'index')) {
    $blog = 'active';
} else {
    $blog = '';
}
if ($this->params['controller'] == 'home' && ($this->params['action'] == 'index')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'pages' && ($this->params['action'] == 'feedback')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'careers' && ($this->params['action'] == 'career')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'pages' && ($this->params['action'] == 'press')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'pages' && ($this->params['action'] == 'termsofservices')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'pages' && ($this->params['action'] == 'privacy')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'pages' && ($this->params['action'] == 'clientresource')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'findfreelancer' && ($this->params['action'] == 'professional_category')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'findfreelancer' && ($this->params['action'] == 'professional_skills')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'findfreelancer' && ($this->params['action'] == 'professional_country')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'findfreelancer' && ($this->params['action'] == 'findjobs')) {
    $home = 'active';
} elseif ($this->params['controller'] == 'partners' && ($this->params['action'] == 'partner')) {
    $home = 'active';
} else {
    $home = '';
}
if ($this->params['controller'] == 'pages' && ($this->params['action'] == 'howitworks')) {
    $page = 'active';
} else {
    $page = '';
}
if ($this->params['controller'] == 'pages' && ($this->params['action'] == 'aboutus')) {
    $about = 'active';
} else {
    $about = '';
}
if ($this->params['controller'] == 'pages' && ($this->params['action'] == 'contactus')) {
    $contact = 'active';
} else {
    $contact = '';
}

//pr($this->params);
?>
<style type="text/css">
    .navigation{
        background: #454343 none repeat scroll 0% 0%;
        color: #fff;
        font-size: 20px;
    }
    .navigation ul li a{
        color: #fff;
    }
    .web ul li.active a{
        color:#66C5BF;
        background-color: #434343;
    }
    .navigation ul li a:focus{
        background-color: #434343;
    }
    .navigation ul li a {
        padding: 5px 15px;
    }
    .top_link a{
        padding: 0px 5px;   
    }
    .navigation li.active a, .navigation li a:hover {
        border-bottom: 2px solid #66C5BF;
        background-color: #434343;
        padding-bottom: 3px;
    }
</style>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2"> <a href="<?php echo BASE_URL; ?>" class=""> <img src="<?php echo $this->webroot; ?>img/logo.png" alt="image" width="150" /> </a> </div>
            <div class="col-md-6 marg_15 col-sm-6">

                <?php if ($this->params['controller'] == 'enterprisesolutions' && ($this->params['action'] == 'index')) { ?>
                    <nav role="navigation" class="navigation">
                        <div class="container" style="width: 100%; padding-left: 0px; padding-right: 0px;"> 
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header ">
                                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse web ">
                                <ul class="nav navbar-nav">
                                    <?php
                                    if ($this->params['controller'] == 'enterprisesolutions' and $this->params['action'] == 'index') {
                                        $enter = 'active';
                                        ?>

                                        <li class="active"><?php echo $this->Html->link('Overview', array('controller' => 'enterprisesolutions', 'action' => 'index')); ?></li>
                    <?php } ?>
                                    <div class="marketing_drop">
                                        <li class="dropdown">
                                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">How We Can Help </a>
                                            <ul role="menu" class="dropdown-menu">
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">Marketing</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">Human Resources</a></li>                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">Procurement</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">Operations</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'certified_program_concultants')); ?>">Certified Program Consultants</a></li>
                                            </ul>
                                        </li>
                                    </div><!--marketing_drop-->

                                    <li class="con"><a href="#RequestaDemo">Contact Us</a></li>

                                </ul>
                            </div>
                            <!-- /.navbar-collapse --> 
                        </div>
                        <!-- /.container-fluid --> 
                    </nav>
                <?php } elseif ($this->params['controller'] == 'enterprisesolutions' && ($this->params['action'] == 'marketing')) { ?>
                    <nav role="navigation" class="navigation">
                        <div class="container" style="width: 100%; padding-left: 0px; padding-right: 0px;"> 
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header ">
                                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse ">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'index')); ?>">Overview</a></li>

                                    <div class="marketing_drop">
                                        <li class="dropdown">
                                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">How We Can Help </a>
                                            <ul role="menu" class="dropdown-menu">
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">Marketing</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">Human Resources</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">Procurement</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">Operations</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'certified_program_concultants')); ?>">Certified Program Consultants</a></li>
                                            </ul>
                                        </li>
                                    </div><!--marketing_drop-->
                                    <li class="con"><a href="#RequestaDemo">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                <?php } elseif ($this->params['controller'] == 'enterprisesolutions' && ($this->params['action'] == 'Human_Recources')) { ?>
                    <nav role="navigation" class="navigation">
                        <div class="container" style="width: 100%; padding-left: 0px; padding-right: 0px;"> 
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header ">
                                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse ">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'index')); ?>">Overview</a></li>

                                    <div class="marketing_drop">
                                        <li class="dropdown">
                                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">How We Can Help </a>
                                            <ul role="menu" class="dropdown-menu">
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">Marketing</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">Human Resources</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">Procurement</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">Operations</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'certified_program_concultants')); ?>">Certified Program Consultants</a></li>
                                            </ul>
                                        </li>
                                    </div><!--marketing_drop-->
                                    <li class="con"><a href="#RequestaDemo">Contact Us</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse --> 
                        </div>
                        <!-- /.container-fluid --> 
                    </nav>

                <?php } elseif ($this->params['controller'] == 'enterprisesolutions' && ($this->params['action'] == 'Procurement')) { ?>
                    <nav role="navigation" class="navigation">
                        <div class="container" style="width: 100%; padding-left: 0px; padding-right: 0px;"> 
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header ">
                                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse ">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'index')); ?>">Overview</a></li>

                                    <div class="marketing_drop">
                                        <li class="dropdown">
                                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">How We Can Help </a>
                                            <ul role="menu" class="dropdown-menu">
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">Marketing</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">Human Resources</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">Procurement</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">Operations</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'certified_program_concultants')); ?>">Certified Program Consultants</a></li>
                                            </ul>
                                        </li>
                                    </div><!--marketing_drop-->
                                    <li class="con"><a href="#RequestaDemo">Contact Us</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse --> 
                        </div>
                        <!-- /.container-fluid --> 
                    </nav>
                <?php } elseif ($this->params['controller'] == 'enterprisesolutions' && ($this->params['action'] == 'operation')) { ?>
                    <nav role="navigation" class="navigation">
                        <div class="container" style="width: 100%; padding-left: 0px; padding-right: 0px;"> 
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header ">
                                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse ">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'index')); ?>">Overview</a></li>

                                    <div class="marketing_drop">
                                        <li class="dropdown">
                                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">How We Can Help </a>
                                            <ul role="menu" class="dropdown-menu">
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">Marketing</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">Human Resources</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">Procurement</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">Operations</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'certified_program_concultants')); ?>">Certified Program Consultants</a></li>
                                            </ul>
                                        </li>
                                    </div><!--marketing_drop-->
                                    <li class="con"><a href="#RequestaDemo">Contact Us</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse --> 
                        </div>
                        <!-- /.container-fluid --> 
                    </nav>
                <?php } elseif ($this->params['controller'] == 'enterprisesolutions' && ($this->params['action'] == 'certified_program_concultants')) { ?>
                    <nav role="navigation" class="navigation">
                        <div class="container" style="width: 100%; padding-left: 0px; padding-right: 0px;"> 
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header ">
                                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse ">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'index')); ?>">Overview</a></li>

                                    <div class="marketing_drop">
                                        <li class="dropdown">
                                            <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">How We Can Help </a>
                                            <ul role="menu" class="dropdown-menu">
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">Marketing</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">Human Resources</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">Procurement</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">Operations</a></li>
                                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'certified_program_concultants')); ?>">Certified Program Consultants</a></li>
                                            </ul>
                                        </li>
                                    </div><!--marketing_drop-->
                                    <li class="con"><a href="#RequestaDemo">Contact Us</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse --> 
                        </div>
                        <!-- /.container-fluid --> 
                    </nav>

                <?php } else { ?>
                    <nav class="navigation" role="navigation">
                        <div class="container" style="width: 100%; padding-left: 0px; padding-right: 0px;"> 
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header ">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse  web" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="<?php echo $home; ?>"><a href="<?php echo BASE_URL; ?>">Home</a></li>
                                    <li class="<?php echo $page ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'howitworks')); ?>">How it work</a></li>
                                    <li class="<?php echo $about ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'aboutus')); ?>">About Us</a></li>
                                    <li class="<?php echo $blog; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'blogs', 'action' => 'index')); ?>">Blogs</a></li>
                                  <li class="<?php echo $contact; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'contactus')); ?>">Contact Us</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse --> 
                        </div>
                        <!-- /.container-fluid --> 
                    </nav>
                <?php } ?>

            </div>
            <div class="col-md-4 marg_15 col-sm-4">
                <div class="row">
                    <div class="col-md-7 pull-right" style="padding: 0px 5px">
                        <div class="form_1" style="width: 100%;">
                            <?php
                            echo $this->Form->create('Category', array('url' => array('controller' => 'home', 'action' => 'index', 'home')));
                            ?>
                            <div class="input-group">
                            <?php 
                            if(!isset($search_flag))
                                $search_flag=0;
                            ?>

                            <?php if($search_flag==0){?>
                                <input type = "text" id = "searchbar" placeholder = "Search Jobs..."  name = "data[Category][search_home]" class = "form-control" style="text-transform: uppercase !important;"> 
                                <label for="searchbar" style="display: none">Search Jobs</label>
                                <input type="hidden" name="data[Category][search_type]" id="search_type" value="job">
                            <?php }else if($search_flag==1){?>
                                <input type = "text" id = "searchbar" placeholder = "Search Freelancers..."  name = "data[Category][search_home]" class = "form-control" style="text-transform: uppercase !important;"> 
                                <label for="searchbar" style="display: none">Search Freelancers</label>
                                <input type="hidden" name="data[Category][search_type]" id="search_type" value="freelancer">
                            <?php }else{?>
                                <input type = "text" id = "searchbar" placeholder = "Search Clients..."  name = "data[Category][search_home]" class = "form-control" style="text-transform: uppercase !important;"> 
                                <label for="searchbar" style="display: none">Search Clients</label>
                                <input type="hidden" name="data[Category][search_type]" id="search_type" value="client">
                            <?php }?>

                                <span class="input-group-btn">
                                    <button class="btn btn-default search_job" type="button"><i class="icon-search icon-white"></i></button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                          <li><a href="javascript:search_client()" style="font-weight: bold; padding: 3px 10px"><i class="icon-user icon-white"></i>&nbspCLIENTS</a></li>
                                          <li><a href="javascript:search_freelancer()" style="font-weight: bold; padding: 3px 10px"><i class="icon-user icon-white"></i>&nbspFREELANCERS</a></li>
                                          <li><a href="javascript:search_job()" style="font-weight: bold; padding: 3px 10px"><i class="icon-bookmark icon-white"></i>&nbspJOBS</a></li>
                                        </ul>
                                   </span> 
                                
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                    <div class="col-md-5 text-right pull-right top_link" style="padding: 0px 5px">
                        <a href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'index')); ?>" class="text-right">Join</a> 
                        <a href="<?php echo $this->Html->Url(array('controller' => 'login', 'action' => 'index')); ?>" class="text-right">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>

    function search_freelancer()
        {
            var searchbar=$('#searchbar');
            var search_type=$('#search_type');

            search_type.attr('value', 'freelancer');

            searchbar.attr('placeholder', "search freelancers...");
        }

        function search_client()
        {
            var searchbar=$('#searchbar');
            var search_type=$('#search_type');
            search_type.attr('value', 'client');
            searchbar.attr('placeholder', "search clients...");   
        }

        function search_job()
        {
            var searchbar=$('#searchbar');
            var search_type=$('#search_type');
            search_type.attr('value', 'job');
            searchbar.attr('placeholder', "search jobs...");
        }

    $(document).ready(function() {

         $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = this.hash,
                    $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 1500, 'swing', function() {
                window.location.hash = target;
            });
        });
        $(document).on('mouseover', '.dropdown', function() {
            $(this).addClass('open');
        });
        $(document).on('mouseout', '.dropdown', function() {
            $(this).removeClass('open');
        });


        $(document).on('click', '.search_job', function() {
            var search = $('#searchbar').val();
                $('.search_job').attr('type', 'submit');
                return true;
        });
    });

</script>
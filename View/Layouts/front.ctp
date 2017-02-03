<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html" >
        <meta name="Description" content="Jobider is short for job-bidder. Jobider is a trusted online workplace where businesses associate and work with thousands of freelancers around the globe.">
        <meta name="keywords" content="HTML, CSS, XML, XHTML, JavaScript, Php, Ajax, Jquery, Angularjs, Wordpress, job, bidder">

        <meta name="msvalidate.01" content="A9E00492902AC3611EC595A4F9D42F3D" />

        <link rel="icon" href="<?php echo $this->webroot; ?>img/job2.png" type="image/gif" width="100" height="100" alt="image">
        <title><?php echo @$title_for_layout; ?></title>
        <link href="<?php echo $this->webroot; ?>live.rss" rel="alternate" type="application/rss+xml" title="What's New on About.com Web Design / HTML" />
         <link href="<?php echo $this->webroot; ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo $this->webroot; ?>css/bootstrap-combined.min.css" rel="stylesheet">
       
        <link href="<?php echo $this->webroot; ?>css/jquery.bxslider.css" rel="styesheet">
        <link href="<?php echo $this->webroot; ?>css/custom.css" rel="stylesheet">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-65832262-1', 'auto');
            ga('send', 'pageview');

        </script>


        <!-- Start Alexa Certify Javascript -->
        <script type="text/javascript">
            _atrk_opts = {atrk_acct: "5IUri1asyr00oD", domain: "jobider.com", dynamic: true};
            (function() {
                var as = document.createElement('script');
                as.type = 'text/javascript';
                as.async = true;
                as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js";
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(as, s);
            })();
        </script>
    <noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=5IUri1asyr00oD" alt="Noscript" style="display:none" height="1" width="1" /></noscript>
    <!-- End Alexa Certify Javascript -->



    <?php echo $this->Html->script(array('jquery.min', 'jquery-1.10.2')); ?>
    <script src="<?php echo $this->webroot; ?>jquery-ui-1.11.2.custom/jquery-ui.js"></script>
    <script src="<?php  echo $this->webroot ;?>jwplayer/jwplayer.js" type="text/javascript"></script>
    <script type="text/javascript">jwplayer.key = "r1hjmJXGnMrcVECvwFuNiroKB0vJot8bEvXg7w==";</script>

    <?php
    if (($this->params['controller'] == 'client') && ($this->params['action'] == 'milestone')) {
        
    } else {
        ?>
        <script src="<?php echo $this->webroot; ?>js/bootstrap.js"></script> 
    <?php }
    ?>

</head>

<body>
    <?php
    $sess = $this->Session->read();


    if (isset($sess['Auth']['User']['type']) && $sess['Auth']['User']['type'] == 'client' and $this->params['controller'] == 'client') {
        echo $this->element('client_header');
    } elseif (isset($sess['Auth']['User']['type']) && $sess['Auth']['User']['type'] == 'freelancer' and $this->params['controller'] == 'freelancer') {
        echo $this->element('freelancer_header');
    } else {
        if(isset($this->search_flag)){
            echo $this->element('front_header_without_login', array("search_flag"=>$this->search_flag));    
        }else{
            echo $this->element('front_header_without_login');    
        }
        
    }

    echo $this->fetch('content');
    ?>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.more', function() {
                $(this).parent().parent().next().removeClass('hide');
                $(this).parent().parent().addClass('hide');
            });

        });
        $(document).ready(function() {
            $(document).on('click', '.less', function() {
                $(this).parent().parent().prev().removeClass('hide');
                $(this).parent().parent().addClass('hide');

            });
        });
    </script>

    <script>
        if (window.location.hash && window.location.hash == '#_=_') {
            window.location.hash = '';
        }
    </script>

    <?php echo $this->element('front_footer'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="<?php echo $this->webroot; ?>img/job2.png">
    
      <title>Login</title>

    <!--Core CSS -->
    <link href="<?php  echo $this->webroot;?>bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php  echo $this->webroot;?>css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php  echo $this->webroot;?>font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php  echo $this->webroot;?>css/style.css" rel="stylesheet">
    <link href="<?php  echo $this->webroot;?>css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <!-- Placed js at the end of the document so the pages load faster -->
<?php  echo $this->fetch('content');?>
    <!--Core js-->
    <script src="<?php  echo $this->webroot;?>js/jquery.js"></script>
    <script src="<?php  echo $this->webroot;?>bs3/js/bootstrap.min.js"></script>

  </body>
</html>

<?php
if($this->params['controller']=='client' && $this->params['action']=='settings'){
	$settings='active';
}else{
	$settings='';
}
if($this->params['controller']=='client' && $this->params['action']=='changepassword'){
	$changepassword='active';
}else{
	$changepassword='';
}
if($this->params['controller']=='client' && $this->params['action']=='my_payment'){
	$mypayment='active';
}else{
	$mypayment='';
}
if($this->params['controller']=='client' && $this->params['action']=='notifications'){
	$notification='active';
}else{
	$notification='';
}
?> 

<div class="panel panel-default green_bg1">
  <div class="panel-heading">Dashboard</div>
  <div class="panel-body bg_grey1 padd_0">
       <ul class="nav ">
         <li class="<?php  echo $settings;?>"><a href="<?php echo $this->Html->Url('/client/settings'); ?>"> My Info </a></li>
         <li class="<?php  echo $changepassword;?>"><a href="<?php  echo $this->Html->Url('/client/changepassword');?>">  Change Password </a></li>
<!--         <li class="<?php //echo $mypayment; ?>"><a href="<?php //echo $this->Html->Url('/client/my_payment');?>">  My Payment Methods </a></li>-->
         <li class="<?php echo $notification;?>"><a href="<?php echo $this->Html->Url('/client/notifications'); ?>">  Notification Settings</a></li>
       </ul>
  </div>
</div>
<?php
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'index')) {
    $reportsActive = 'active';
}else{
      $reportsActive = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'editprofile')) {
    $pricecheckerActive = 'active';
}else{
      $pricecheckerActive = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'myapplication')) {
    $trackshipmentActive = 'active';
}else{
      $trackshipmentActive = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'takeatest')) {
    $takeatestActive = 'active';
}else{
      $takeatestActive = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'postajob')) {
    $postajob = 'active';
}else{
      $postajob = '';
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'myprofile')) {
    $profile = 'active';
}else{
      $profile = '';
}
?> 
<div class="col-md-3 pad_l0 col-sm-3">
        <div class="panel panel-default green_bg1">
  <div class="panel-heading">Find work</div>
  <div class="panel-body bg_grey1 padd_0">
       <ul class="nav ">
         <li class="<?php echo $reportsActive ; ?>"><a href="<?php echo $this->Html->Url(array('controller'=>'freelancer','action'=>'index')); ?>" >Find Jobs</a></li>
         <li class="<?php echo $trackshipmentActive; ?>" ><a href="<?php echo $this->html->Url(array('controller'=>'freelancer','action'=>'myapplication')); ?>">Job Applications</a></li>
<li class="<?php echo $profile;?>"><a href="<?php echo $this->Html->Url(array('controller'=>'freelancer','action'=>'freelancer_profile')); ?>" >profile</a></li>
 <li class="<?php echo $takeatestActive;?>"><a href="<?php echo $this->Html->Url(array('controller'=>'freelancer','action'=>'mytests')); ?>">Test</a></li>
   </ul>
  </div>
</div>

<div class="panel panel-default green_bg1">
  <div class="panel-heading">Job Applications</div>
  <div class="panel-body bg_grey1 padd_tb15">
      <?php if(isset($inv_count) and !empty($inv_count)) {?>
        <p>Invitations to Interview : <font class="text_green"><?php  echo $inv_count;?></font></p>
      <?php } else{?>
        <p>Invitations to Interview : <font class="text_green">0</font></p>
      <?php   } ?>
         <?php if(isset($sent_app) and !empty($sent_app)){?>
      <p>Sent Applications : <font class="text_green">
         
         <?php  echo $sent_app;
           }else{?>
            <p>Sent Applications : <font class="text_green"> 0   </font></p>
           <?php  } ?>  
          </font></p>
       </ul>
  </div>
</div>


        
   </div>
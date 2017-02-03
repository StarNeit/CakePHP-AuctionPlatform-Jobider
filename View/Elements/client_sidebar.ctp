<?php
//pr($this->params);
if($this->params['controller']=='client' && ($this->params['action']=='postajob')){
    $postajob='active';
}else{
    $postajob='';
}
if($this->params['controller']=='client' && ($this->params['action']=='searchfreelancer')){
    $searchfreelancer='active';
}else{
    $searchfreelancer='';
}
?>

<div class="col-md-3 pad_l0 col-sm-3">
        
        <div class="panel panel-default green_bg1">
  <div class="panel-heading">Dashboard</div>
  <div class="panel-body bg_grey1 padd_0">
       <ul class="nav ">
         
           <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller'=>'client','action'=>'postajob')); ?>"> Post a job</a></li>
         <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->Html->Url(array('controller'=>'client','action'=>'searchfreelancer')); ?>"> Search for freelancer </a></li>
         
          <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->Html->Url(array('controller'=>'client','action'=>'postedJobs')); ?>"> Jobs i have Posted </a></li>
             <li><a href="<?php echo $this->webroot; ?>client/job_payment">Jobs Payment</a></li>       
       </ul>
  </div>
</div>
<?php  echo $this->element('client_notification');?>

        
   </div>
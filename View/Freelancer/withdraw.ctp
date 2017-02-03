<?php
if($this->params['controller']=='freelancer' && $this->params['action']=='reporting'){
$transaction='active';	
}
elseif($this->params['controller']=='freelancer' && $this->params['action']=='withdraw'){
$transaction='active';	
}
else{
$transaction="inactive";
}
if($this->params['controller']=='freelancer' && $this->params['action']=='viewearning'){
$viewearning='active';	
}
else{
$viewearning="inactive";
}
?>


<div class="container">
<div class="row marg_tb15">

    
    <div class="col-md-3 pad_l0 col-sm-3">
  <div class="panel panel-default green_bg1">
        <div class="panel-heading">Reports</div>
        <div class="panel-body bg_grey1 padd_0">
          <ul class="nav ">
            <li class="<?php echo $transaction;?>"><a href="<?php echo $this->html->Url(array('controller'=>'freelancer','action'=>'reporting')); ?>"> Transactions</a></li>
            <li class="<?php echo $viewearning; ?>"><a href="<?php echo $this->Html->Url(array('controller'=>'freelancer','action'=>'viewearning'));?>"> View earnings </a></li>
          </ul>
        </div>
      </div>
  <div class="panel panel-default green_bg1">
    <div class="panel-heading">Earning</div>
    <div class="panel-body bg_grey1 padd_tb15">
      <p>Available now : $0.00 </p>
      <p><i><img alt="View pending earnings image icon" class="mrg_r5" src="<?php  echo $this->webroot; ?>img/view.png"></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings &gt;&gt;</a></p>
      
    </div>
  </div>
</div>
 
    <div class="col-md-9 col-sm-9  pad_r0 ">
<div class="bg_white">
<div class="green"> Withdraw Earnings <span class="pull-right">Total Funds : $370</span> </div>
  <?php
            echo $this->Form->create('Job', array('role'=>'form','class'=>'apply_jobform withdraw_earnings p15 font_14','url' => array('controller' => 'freelancer', 'action' => 'withdrawconfirmation')));
            ?>
<div class="row">
  <label class="col-sm-3 opensans font_14">Withdrawal Method</label>
  <div class="col-sm-9">
    <input type="text" placeholder="Local Funds Transfer to bpi - main (head office) xxx-6438" class="w100 font_14">
    <a class="opensans font_14" href="#">Add or manage withdrawal methods</a> </div>
</div>
<div class="row">
  <label class="col-sm-3 opensans font_14"> Amount</label>
  <div class="col-sm-9">
    <div class="radio">
      <label class="font_14 opensans grayclr">
        <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios">
        Available Balance ($370) </label>
    </div>
    <div class="radio">
      <label class="font_14 opensans grayclr">
        <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios">
        Other Amount &nbsp;&nbsp;&nbsp;  $ </label>
      <input type="text" class="font_14">
    </div>
  </div>
</div>
<div class="row">
  <label class="col-sm-3 opensans font_14">Withdrawal Fee</label>
  <div class="col-sm-9">
    <span class="font_14 grayclr opensans">$ 1.99</span>
</div>
</div>
<div class="row">
  <label class="col-sm-3 opensans font_14">Amount to be withdrawan</label>
  <div class="col-sm-9">
    <span class="font_14 grayclr opensans">$ 368.01</span>
</div>
</div>
<div class="row">
  <label class="col-sm-3 opensans font_14">Last exchange rate used by jobider
</label>
  <div class="col-sm-9">
    <span class="font_14 grayclr opensans">60 INR/USD</span>
    <p class="opensans font_12 grayclr line_height22">As of Mar 18, 2011 11:17 UTC. Actual exchange rate to be set on next business day.<br>
Upon clicking Withdraw, Jobider will send $368.01 worth of INR to account xxxx-6482.<br>
Local Funds Transfers are normally proceed within one business day. Please allow 3-5 business days for the funds to hit your bank account.</p>
</div>
</div>
<div class="row"> 
  <div class="col-sm-9 col-md-offset-3">
    <button class="btn btn-green opensans font_14" type="button">  Withdraw           </button>
    <button class="btn btn-green opensans font_14" type="button" style="margin-left: 10px;">Cancel
    </button>
</div>
</div>

    <?php  echo $this->Form->end(); ?>
</div>
</div>
</div>
</div>
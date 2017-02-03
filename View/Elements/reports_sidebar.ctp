<?php
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'Reports')) {
    $report = 'active';
} else {
    $report = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'transactionHistory')) {
    $TransHistory = 'active';
} else {
    $TransHistory = '';
}

if ($this->params['controller'] == 'client' && ($this->params['action'] == 'WorkSummary')) {
    $Work = 'active';
} else {
    $Work = '';
}

?>

<div class="col-md-3 pad_l0 col-sm-3">
      <div class="panel panel-default green_bg1">
        <div class="panel-heading">Dashboard</div>
        <div class="panel-body bg_grey1 padd_0">
          <ul class="nav ">
<!--            <li class='<?php //echo $report;  ?>'><a href="<?php //echo $this->webroot; ?>client/Reports"> Weekly Summary</a></li>-->
            <li class="<?php  echo $TransHistory; ?>"><a href="<?php echo $this->webroot; ?>client/transactionHistory"> Transaction History </a></li>
         <li class='<?php //echo $Work; ?>'><a href="<?php echo $this->webroot; ?>client/AllWithdrawRequest"> Withdraw Requests </a></li>
         <li class='<?php //echo $Work; ?>'><a href="<?php echo $this->webroot; ?>client/ApprovedRequest"> Approved Requests </a></li>
         <li class='<?php //echo $Work; ?>'><a href="<?php echo $this->webroot; ?>client/DeclinedRequest"> Declined Requests </a></li>
          </ul>
        </div>
      </div>
    <?php  echo $this->element('client_notification');?>
    </div>
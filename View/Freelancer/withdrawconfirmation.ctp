<?php
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'reporting') {
    $transaction = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'withdraw') {
    $transaction = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'withdrawconfirmation') {
    $transaction = 'active';
} else {
    $transaction = "inactive";
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'viewearning') {
    $viewearning = 'active';
} else {
    $viewearning = "inactive";
}
?>
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Reports</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="<?php echo $transaction; ?>"><a href="<?php echo $this->webroot; ?>freelancer/reporting"> Transactions</a></li>
                        <li class="<?php echo $viewearning; ?>"><a href="<?php echo $this->webroot; ?>freelancer/viewearning"> View earnings </a></li>
                        <li><a href="<?php  echo $this->webroot; ?>freelancer/previousEarnings"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now : $0.00 </p>
                    <p><i><img alt="View pending earning image icon" class="mrg_r5" src="<?php echo $this->webroot; ?>img/view.png"></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings &gt;&gt;</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">

                <div class="green"> Withdraw Earnings <span class="pull-right">Total Funds : $370</span> </div>



                <form role="form" class="apply_jobform withdraw_earnings p15 font_14">
             <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        Your <strong>withdrawal request</strong> has been received.
                    </div>


                    <h3 class="opensans">Payment Details</h3>

                    <div class="row">
                        <label class="col-sm-4 opensans font_14"> Payment method </label>
                        <div class="col-sm-8">
                            <span class="font_14 grayclr opensans">Local Funds Transfer (xxxx-6578)</span>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 opensans font_14"> Withdraw amount </label>
                        <div class="col-sm-8">
                            <span class="font_14 grayclr opensans">$370</span>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 opensans font_14"> Withdrawal fee  </label>
                        <div class="col-sm-8">
                            <span class="font_14 grayclr opensans">$ 1.99</span>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 opensans font_14"> Amount to be withdrawn  </label>
                        <div class="col-sm-8">
                            <span class="font_14 grayclr opensans">$ 368.01</span>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 opensans font_14"> Last published exchange rate  </label>
                        <div class="col-sm-8">
                            <span class="font_14 grayclr opensans">60 INR/USD</span>
                            <p class="opensans font_12 grayclr line_height22">* As of May 13, 2014 12:00 UTC. Actual exchange rate to be set on next business day.</p>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-8 col-md-offset-4">
                            <button class="btn btn-green opensans font_14" type="button">Done</button>
                            <button class="btn btn-gray opensans font_14" type="button"style="margin-bottom: 10px; margin-left: 74px;">Print</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
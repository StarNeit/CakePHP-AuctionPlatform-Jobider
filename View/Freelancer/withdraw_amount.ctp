<?php
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'reporting') {
    $transaction = 'active';
} elseif ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'withdraw') {
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
                        <li><a href="<?php echo $this->webroot; ?>freelancer/previousEarnings"> View Previous Earning </a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now : $<?php echo $Result['Milestone']['payment_amount']; ?> </p>
                    <p><i><img alt="View Pending earning image icon" class="mrg_r5" src="<?php echo $this->webroot; ?>img/view.png"></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings &gt;&gt;</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green"> Withdraw Earnings
                    <span class="pull-right">Total Funds : $<?php echo $Result['Milestone']['payment_amount'];?></span> </div>
                <?php
                
                echo $this->Form->create('Job', array('role' => 'form', 'class' => 'apply_jobform withdraw_earnings p15 font_14', 'url' => array('controller' => 'freelancer', 'action' => 'withdrawconfirmation')));
                ?>
                <div class="scess"></div>
                <div class="row">
                    <label class="col-sm-3 opensans font_14">Withdrawal Method</label>
                    <div class="col-sm-9">

                        <input type="text" id="paypalEmail" placeholder="Paypal Email-id" class="w100 font_14" name='data[Withdrawpayment][email]'>
                        <div class="err"></div>
                        </br> <a class="opensans font_14" href="https://www.paypal.com/in/webapps/mpp/merchant" target='_Blank'>Don't have Paypal Account ?</a> </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 opensans font_14"> Amount</label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label class="font_14 opensans grayclr">
                                                  <input  type='hidden' name='date[Withdrawpayment][available_balance]' value='<?php echo $Result['Milestone']['payment_amount']; ?>' />
                                Available Balance<?php echo '($' . $Result['Milestone']['payment_amount'] . ')'; ?></label>
                            <input class="total_amount" type="hidden" value="<?php echo $Result['Milestone']['payment_amount']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 opensans font_14">Withdrawal Fee</label>
                    <div class="col-sm-9">
                        <input type='hidden' name='data[Withdrawpayment][withdrawfee]' value='8'/>
                        <span class="font_14 grayclr opensans">8%</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 opensans font_14">Amount to be withdrawan</label>
                    <div class="col-sm-9">
                        <input type='hidden' class="withdraw_amount" name='data[Withdrawpayment][withdrawamount]' value='<?php echo $Withdrawn_amount; ?>'/>
                        <span class="font_14 grayclr opensans"><?php echo '$' . $Withdrawn_amount; ?></span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 opensans font_14">Last exchange rate used by jobider
                    </label>
                    <div class="col-sm-9">
                        <span class="font_14 grayclr opensans">60 INR/USD</span>
                        <p class="opensans font_12 grayclr line_height22">As of Mar 18, 2011 11:17 UTC. Actual exchange rate to be set on next business day.<br>
                            Upon clicking Withdraw, Jobider will send $368.01 worth  to your Paypal Account.<br>
                            Local Funds Transfers are normally proceed within one business day. Please allow 3-5 business days for the funds to hit your bank account.</p>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-sm-9 col-md-offset-3">
                        <input type="hidden" value="<?php echo $Result['Milestone']['id'];?>" class="milestone_id" />
                        <button class="btn btn-green opensans font_14 withdraw" type="button">  Withdraw           </button>
                        <button class="btn btn-green opensans font_14" type="button" style="margin-left: 10px;">Cancel</button>
                    </div>
                </div>
             <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.withdraw', function () {
            var email = $('#paypalEmail').val();
            var withdraw_amount=$('.withdraw_amount').val();
            var total_amount=$('.total_amount').val();
            var milestone_id=$('.milestone_id').val();
            if (email == '') {
                $('#paypalEmail').css('border', '2px solid red');
                $('.err').html('<div class="error-message">Please Enter Your Paypal Email.</div>');
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->webroot; ?>freelancer/ajax_withdraw',
                    dataType: 'json',
                    data: {
                        email: email,
                        withdraw_amount: withdraw_amount,
                        total_amount: total_amount,
                        milestone_id: milestone_id,
                    },
                    success: function (msg) {
                       //console.log(msg);
                        if(msg.status=='true'){
                            $('.scess').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong></strong>'+msg.message+'</div>');
                        }

                    }
                });




            }
        });
    });
</script>
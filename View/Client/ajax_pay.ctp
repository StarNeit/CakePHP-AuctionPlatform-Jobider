<div class="modal-dialog" id="datapay">
    <div class="modal-content">
        <div class="modal-header green">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Payment Method</h4>
        </div>
        <div class="modal-body">
            <?php echo $this->Form->create('Creditpayment', array('class' => 'apply_jobform withdraw_earnings p15 font_14 form-horizontal datacredit hide', 'role' => 'form', 'url' => array('controller' => 'client', 'action' => 'credit_payment'))); ?>
            <!--            <form role="form" class="apply_jobform withdraw_earnings p15 font_14 form-horizontal datacredit hide">-->
            <div class="row">
                <label class="col-sm-4 opensans font_14">Card Type </label>
                <div class="col-sm-8">
                    <select name="data[Creditpayment][card_type]" class="card_type">

                        <option value="">Select Card Type</option>
                        <option value="visa">Visa</option>
                        <option value="american_express">American Express</option>
                        <option value="discover">Discover</option>
                        <option value="jcb">JCB</option>
                        <option value="mastercard">MasterCard</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 opensans font_14">Card Number</label>
                <div class="col-sm-8">
                    <input type="text" placeholder="card number" id="inputEmail3" class="form-control card_number" name="data[Creditpayment][card_number]">
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 opensans font_14">CVV</label>
                <div class="col-sm-8">
                    <input type="text" placeholder="cvv number" id="inputEmail3" class="form-control cvv" name="data[Creditpayment][cvv]">
                    <input type="hidden" name="data[Creditpayment][amount]" value="<?php echo $payment['Milestone']['payment_amount'];?>">
                    <input type="hidden" name="data[Creditpayment][milestone_id]" value="<?php  echo $milestone_id;?>">
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 opensans font_14">Expire Date</label>
                <div class="col-sm-2 mar_b20">
                    <select name="data[Creditpayment][start_date]" class="start_date">

                        <option value="">Select month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">Augest</option>
                        <option value="9">September</option>
                        <option value="10">Octuber</option>
                        <option value="11">November</option>
                        <option value="12">December</option>

                    </select>
                </div>
                <div class="col-sm-4 mar_b20">
                    <?php $year = date('Y'); ?>
                    <select name="data[Creditpayment][end_date]" class="end_date">
                        <option value="">Select Year</option>
                     <?php  for($i=$year; $i<=$year+20;$i++){?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                     <?php } ?>
                        

                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-2 set_up text-center">


                <button class="btn btn-danger col-md-12 marg_tb15 credit_data" type="button">Pay Now </button>

            </div>

            </form>
            <div class="row">
                <div class="radio_payment paypalval">
                    <label class="checkbox-inline">
                        <input type="radio" id="inlineCheckbox1" value="option1" class="paypal" >                          <img src="<?php echo $this->webroot; ?>img/imgo.jpeg" alt="PaypalImage">
                    </label>

                </div>
                <div class="radio_payment creditdata">
                    <label class="checkbox-inline">
                        <input type="radio" id="inlineCheckbox1" value="option1" class="credit"> <img src="<?php echo $this->webroot; ?>img/imgo2.jpeg" style="" alt="CreditCardImage">
                    </label>

                </div>

            </div>


            <div class="bg_grey  marg_30 datapayment hide">
                <?php echo $this->Form->create('Paypalpayment', array('url' => array('controller' => 'client', 'action' => 'pay_milestone', $milestone_id))); ?>
                
               

                   

                    <div class="col-md-3 col-sm-2 set_up text-center">


                        <button class="btn btn-danger col-md-12 marg_tb15" type="submit">Pay Now </button>

                    </div>
                    <?php $this->Form->end(); ?>
                    <div class="clearfix"></div>

               
            </div>




        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        $('.paypal').click(function () {
            $('.datapayment').removeClass('hide');
            //$('.creditdata').addClass('hide');
            //$('.paypalval').addClass('hide');
        });
        $('.credit').click(function () {
            $('.datacredit').removeClass('hide');
            $('.paypalval').addClass('hide');
            $('.creditdata').addClass('hide');
        });

    });
    
    
    $('.credit_data').click(function(){
        var card_type=$('.card_type').val();
        var card_number=$('.card_number').val();
        var cvv=$('.cvv').val();
        var start_date=$('.start_date').val();
        var end_date=$('.end_date').val();
        if(card_type=='' && card_number=='' && cvv=='' && start_date=='' && end_date==''){
            //alert('ksdfjkdsjf');
            alert('Firstly, Please Enter The All Fields');
            return false;
        }else{
            alert('kdfkldjf');
            $('.credit_data').attr('type','submit');
            return true;
        }
        
    });
</script>
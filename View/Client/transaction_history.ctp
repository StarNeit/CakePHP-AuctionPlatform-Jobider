<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('reports_sidebar'); ?>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green"> Transaction History<span class="pull-right">Total Funds : <?php  echo '$'.$total_budgte;?></span> </div>
                <?php  echo $this->Form->create('Paypalpayment',array('class'=>'transaction_form','role'=>'form','url'=>array('controller'=>'client','action'=>'transactionHistory')));?>
<!--                <form role="form" class="transaction_form">-->
                    <div class="date_box marg_tb15">
                        <div class="col-md-2"> From </div>
                        <div class="input-group datepicker col-md-4 pull-left">
                            <input type="text" id="datepicker1" class="col-md-11" name="data[Paypalpayment][start_date]">
                        </div>
                        <div class="col-md-1 text-center"> To </div>
                        <div class="input-group datepicker col-md-4">
                            <input type="text" id="datepicker2" class="col-md-11 " name="data[Paypalpayment][end_date]">
                        </div>
                    </div>
                    <div class="transaction">
                        <div class="col-md-2"> Transaction </div>
                        <select class="form col-md-4 pull-left" name="data[Paypalpayment][transaction]">
                            <option value="">Select Transaction</option>
                            <option value="credit">Credit</option>
                            <option value="debit">Debit</option>
                        </select>
                        <div class="col-md-1 text-center padd_0"> Freelancer </div>
                        <select class="form col-md-4 pull-left" name="data[Paypalpayment][freelancer]">
                            <option value=''>Select Freelancer</option>
                            <?php foreach ($hire as $k => $v) { ?>
                            <option value="<?php echo $v['Contractor']['id'] ?>"><?php echo ucfirst($v['Contractor']['first_name']). ' ' . ucfirst($v['Contractor']['last_name']); ?></option>
                            <?php } ?>

                        </select>
                        <div class="col-md-1 text-center">
                            <button class="btn btn_cust" name="trans" value="trans" type="submit">Go</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
              <?php echo $this->Form->end(); ?>
                <div class="table-responsive marg_tb15">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>
                                <th>Date </th>
                                <th>Type </th>
                                <th> Contract</th>
                                <th> Freelancer </th>
                                <th>Amount </th>
                                <th>Ref ID</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if(!empty($payment)){?>
                            <?php
                            foreach ($payment as $k => $v) {
                              
                                if (array_key_exists('Paypalpayment', $v)) {
                                    $date=date('d-M-Y',strtotime($v['Paypalpayment']['payment_date']));
                                    $type = $v['Paypalpayment']['payment_type'];
                                    $amount = $v['Paypalpayment']['payment_amount'];
                                    $title = $v['Job']['job_title'];
                                $user_name = $v['Freelancer']['first_name'] . ' ' . $v['Freelancer']['last_name'];
                                 $transaction_id=$v['Paypalpayment']['custom'];
                                 $status=$v['Paypalpayment']['pay_status'];
                                }
                                if (array_key_exists('Creditpayment', $v)) {
                                    $date=date('d-M-Y',strtotime($v['Creditpayment']['created']));             $type = $v['Creditpayment']['type'];
                                    $amount = $v['Creditpayment']['amount'];
                                    $title = $v['Job']['job_title'];
                                 $user_name = $v['Freelancer']['first_name'] . ' ' . $v['Freelancer']['last_name'];
                                 $transaction_id=$v['Creditpayment']['custom'];
                                 $status=$v['Creditpayment']['pay_status'];
                                }
                                ?> 
                                <tr>
                                    <td><?php echo $date; ?></td>
                                    <td> <?php echo $type; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td> <?php  echo $user_name;?></td>
                                    <td> <?php echo '$'.$amount.'.00'; ?></td>
                                    <td><?php echo $transaction_id; ?></td>
                                    <td><?php echo $status; ?></td>
                                </tr>

                            <?php } ?>
                            <?php  } else { ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; font-size: 20px; padding: 21px;">
                                     No transactions meet your selected criteria.
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if(!empty($total_budgte) and !empty($total_amnt) and !empty($end_total)){ ?>
        <div class="bg_white marg_tb15">
        <div class="green"> Statement</div>
        <div class="table-responsive">
          <table class="table cust_table4 marg_0">
              
            <thead>
              <tr>
                <th>Beginning Balance</th>
                <th><?php  echo '$'.number_format($total_budgte,2);?></th>
              </tr>
            </thead>
            <tbody>
              
              <tr>
                <td>Total Debits</td>
                <td><?php echo '$'.number_format($total_amnt,2); ?></td>
              </tr>
              
              <tr>
                <td>Ending Balance</td>
                <td><?php  echo '$'.number_format($end_total,2);?></td>
              </tr>
            </tbody>
             
            
          </table>
        </div>
        <div class="clearfix"></div>
      </div>
             <?php }  ?>
        </div>
    </div>
</div>
<?php echo $this->Html->script('jquery-ui'); ?>
<script>
    $(function () {
        $("#datepicker1").datepicker({
            showOn: "button",
            buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });

    });
    $(function () {
        $("#datepicker2").datepicker({
            showOn: "button",
            buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });

    });
</script> 
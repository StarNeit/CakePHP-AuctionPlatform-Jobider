<?php
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'reporting') {
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

                    </ul>
                </div>
            </div>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning </div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now : <?php if(!empty($Payment_earning)) {echo '$' . $Payment_earning.'.00'; }else { echo "$0.00"; }?></p>
<!--                    <p class="text-center">
                        <?php
                        //echo $this->Form->create('Job', array('url' => array('controller' => 'freelancer', 'action' => 'viewearning')));
                        ?>
                        <button type="submit" class="btn btn-danger">Withdraw</button>
                        <?php //echo $this->Form->end(); ?>
                    </p>-->
                    <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="View pending earning image"/></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings >></a></p>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green"> Transaction History<span class="pull-right">Total Funds : <?php echo '$' . $total_budgte; ?></span> </div>
                <?php echo $this->Form->create('Paypalpayment', array('class' => 'transaction_form', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'reporting'))); ?>
                <div class="date_box marg_tb15">
                    <div class="col-md-2"> From </div> 
                    <div class="input-group datepicker col-md-4 pull-left">
                        <?php
                        if (!empty($this->request->data['Paypalpayment']['start_date'])) {
                            $start = str_replace('/', '-', date('d/m/Y', strtotime($this->request->data['Paypalpayment']['start_date'])));
                        } else {
                            $start = '';
                        }

                        if (!empty($this->request->data['Paypalpayment']['end_date'])) {
                            $end = str_replace('/', '-', date('d/m/Y', strtotime($this->request->data['Paypalpayment']['end_date'])));
                        } else {
                            $end = '';
                        }
                        ?>
                        <input type="text" id="datepicker1" class="col-md-11 start" name="data[Paypalpayment][start_date]" value="<?php echo $start; ?>">
                    </div>
                    <div class="col-md-1 text-center"> To </div>
                    <div class="input-group datepicker col-md-4">
                        <input type="text" id="datepicker2" class="col-md-11 end" name="data[Paypalpayment][end_date]" value="<?php echo $end; ?>">
                    </div>
                </div>

                <div class="transaction">
                    <div class="col-md-2"> Transaction </div>
                    <select class="form col-md-4 pull-left" name="data[Paypalpayment][transaction]">
                        <?php if (!empty($this->request->data['Paypalpayment']['transaction']) and $this->request->data['Paypalpayment']['transaction'] == 'credit') { ?>
                            <option value="credit">Credit</option>
                        <?php } elseif (!empty($this->request->data['Paypalpayment']['transaction']) and $this->request->data['Paypalpayment']['transaction'] == 'debit') { ?>
                            <option value="debit">Debit</option>
                        <?php } else { ?>
                            <option value="">Select Transaction</option>
                            <option value="credit">Credit</option>
                            <option value="debit">Debit</option>
                        <?php } ?>
                    </select>
                    <div class="col-md-1 text-center padd_0"> Client </div>
                    <select class="form col-md-4 pull-left" name="data[Paypalpayment][freelancer]"><option value=''>Select Client</option>
                        <?php foreach ($hire as $k => $v) { ?>
                            <option value="<?php echo $v['Hiring']['id'] ?>"><?php echo ucfirst($v['Hiring']['first_name']) . ' ' . ucfirst($v['Hiring']['last_name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <div class="col-md-1 text-center">
                        
                        <button class="btn btn_cust" type="submit">Go</button>
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
                                <th> Description</th>
                                <th> Client </th>
                                <th>Amount </th>
                                <th>Balance </th>
                                <th>Ref ID</th>
                                <th>Withdraw</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (!empty($payment)) {                            
                                foreach ($payment as $k => $v) {
                                    if (array_key_exists('Paypalpayment', $v)) {
                                        $id = $v['Paypalpayment']['id'];
                                        $date = date('d-M-Y', strtotime($v['Paypalpayment']['payment_date']));
                                        $type = $v['Paypalpayment']['payment_type'];
                                        $amount = $v['Paypalpayment']['payment_amount'];
                                        $title = $v['Job']['job_title'];
                                        $user_name = $v['Client']['first_name'] . ' ' . $v['Client']['last_name'];
                                        $transaction_id = $v['Paypalpayment']['custom'];
                                        $request=$v['withdraw'];
                                    }
                                    if (array_key_exists('Creditpayment', $v)) {
                                          $id = $v['Creditpayment']['id'];
                                        $date = date('d-M-Y', strtotime($v['Creditpayment']['created']));
                                        $type = $v['Creditpayment']['type'];
                                        $amount = $v['Creditpayment']['amount'];
                                        $title = $v['Job']['job_title'];
                                        $user_name = $v['Client']['first_name'] . ' ' . $v['Client']['last_name'];
                                        $transaction_id = $v['Creditpayment']['custom'];
                                               $request=$v['withdraw'];
                                    }
                                    ?> 
                                    <tr>
                                        <td><?php echo $date; ?></td>
                                        <td> <?php echo $type; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td> <?php echo $user_name; ?></td>
                                        <td> <?php echo '$' .$amount.'.00'; ?></td>
                                        <td> <?php echo '$' .$amount.'.00'; ?></td>
                                        <td><?php echo $transaction_id; ?></td>
                                             <?php if(!empty($request)){ ?><td><button class="btn-sm btn-danger btn_red11 btn-req" type="button">Withdraw</button></td>
                                         <?php } else { ?>
                                        <td><a href="<?php echo $this->webroot; ?>freelancer/withdrawPaypalAmount/<?php echo $id; ?>"><button class="btn-sm btn-danger btn_red11">Withdraw</button></a></td>
                                        <?php } ?>
<!--                                      <td><a href="<?php //echo $this->webroot; ?>freelancer/withdrawPaypalAmount/<?php //echo $id; ?>"><button class="btn-sm btn-danger btn_red11">Withdraw</button></a></td>-->
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 37px; font-size: 19px;">
                                    No Record(s) Found !
                                    </td>
                                </tr>    
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if (!empty($total_budgte) and !empty($total_amnt) and !empty($end_total)) { ?>
                <div class="bg_white marg_tb15">
                    <div class="green"> Statement Period <small class="font_14">(oct 20,2014 to Dec 21,2014)</small> </div>
                    <div class="table-responsive">
                        <table class="table cust_table4 marg_0">
                            <thead>
                                <tr>
                                    <th>Beginning Balance</th>
                                    <th><?php echo '$' . number_format($total_budgte, 2); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Debits</td>
                                    <td><?php echo '$' . number_format($total_amnt, 2); ?></td>
                                </tr>

                                <tr>
                                    <td>Ending Balance</td>
                                    <td><?php echo '$' . number_format($end_total, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--               <script>
$(document).ready(function(){
    $(document).on('click','.start',function(){
        var startdate = $('.start').val();
        alert(startdate);
    });    
});
</script>             -->
<script>
    $(document).ready(function(){
        $('.btn-req').click(function(){
           alert('Please wait , Your Withdraw request is in process.'); 
        });
    });
    </script>
<?php echo $this->Html->script('jquery-ui'); ?>
<script>
    $(function() {
        $("#datepicker1").datepicker({
            showOn: "button",
            buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
    });
</script> 

<script>
    $(function() {
        $("#datepicker2").datepicker({
            showOn: "button",
            buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
    });
</script>




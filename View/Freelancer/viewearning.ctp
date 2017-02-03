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

<div class="container" style="padding:0px;">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Reports</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="<?php echo $transaction; ?>"><a href="<?php echo $this->html->Url(array('controller' => 'freelancer', 'action' => 'reporting')); ?>"> Transactions</a></li>
                        <li class="<?php echo $viewearning; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'viewearning')); ?>"> View earnings </a></li>
<!--                          <li ><a href="<?php  echo $this->webroot; ?>freelancer/previousEarnings"> Previous earnings </a></li>-->
                    </ul>
                </div>
            </div>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning </div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now : <?php if(!empty($Payment_earning)) {echo '$'.$Payment_earning.'.00'; } else { echo "$0.00"; }?> </p>
                    <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="View peding earnings"/></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings >></a></p>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">

            <div class="bg_white">
                <div class="green"> Transaction History<span class="pull-right">Available Balance : $0 <small class="font_12">(pending transactions :$0.00)</small></span> </div>
                <!--                <form role="form" class="transaction_form">-->
                <?php echo $this->Form->create('Milestone', array('class' => 'transaction_form', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'viewearning'))); ?>     
                <div class="date_box marg_tb15">
                    <div class="col-md-2"> From </div>
                    <div class="col-md-4">
                        <div class="input-group datepicker pull-left">
                            <?php  
                            if(!empty($this->request->data['Milestone']['start_date'])){
                                 $start=  str_replace('/','-',date('d/m/Y',strtotime($this->request->data['Milestone']['start_date'])));
                            }else{
                                 $start= '';
                            }
                            if(!empty($this->request->data['Milestone']['end_date'])){
                                 $end=  str_replace('/','-',date('d/m/Y',strtotime($this->request->data['Milestone']['end_date'])));
                            }else{
                                 $end= '';
                            }  
                            ?>
                            <input type="text" id="datepicker2" class="col-md-11" name="data[Milestone][start_date]" value='<?php  echo $start;?>'>
                        </div>
                    </div>
                    <div class="col-md-1 text-center"> To </div>
                    <div class="col-md-4">
                        <div class="input-group datepicker">
                            <input type="text" id="datepicker1" class="col-md-11" name="data[Milestone][end_date]" value='<?php  echo $end;?>'>
                        
                        </div>
                    </div><div class="clearfix"></div>
                </div>

                <div class="transaction">
                    <div class="col-md-2"> Clients </div>
                    <div class="col-md-4 ">
                        <select class="form-control  pull-left cust_input" name='data[Milestone][client]'>
                            <option value="">All Clients</option>
                            <?php foreach ($milestone as $k => $v) {
                                if($v['user']['User']['id']==$this->request->data['client']){
                                ?>
                                <option value="<?php echo $v['user']['User']['id'];?>"><?php echo $v['user']['User']['first_name'] . ' ' . $v['user']['User']['last_name'] ?></option>

                            <?php }else{ ?>
                                  <option value="<?php echo $v['user']['User']['id'];?>"><?php echo $v['user']['User']['first_name'] . ' ' . $v['user']['User']['last_name'] ?></option>
                            <?php } }?>
                        </select>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-1 text-center padd_0">
                        <button class="btn btn_cust" type="submit">Go</button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php echo $this->Form->end(); ?>
                <!--                </form>-->
                <div class="table-responsive marg_tb15">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>
                                <th>Start Date </th>
                                <th>End Date </th>
                                <th> Milestone Title</th>
                                <th> Client </th>
                                <th>Amount </th>
                                <th>Pending Balance </th>
                                <th>Action</th>
                                <th>Withdraw</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($milestone)) { ?>
                                <?php foreach ($milestone as $k => $v) { ?>
                                    <tr>
                                        <td><?php echo date('d-m-Y', strtotime($v['Milestone']['start_date'])); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($v['Milestone']['end_date'])); ?></td>
                             <td> <?php echo $v['Milestone']['milestone_title']; ?> <br/>
                                        </td>
                                        <td> <?php echo $v['user']['User']['first_name'] . ' ' . $v['user']['User']['last_name'] ?></td>
                                        <td> <?php echo '$' . $v['Milestone']['payment_amount']; ?></td>
                                        <td style="text-align:center"><?php echo '$' . $v['balance']; ?> </td>
                                        <td><a href="<?php echo $this->webroot; ?>freelancer/viewMilestoneDetail/<?php echo $v['Milestone']['id']; ?>"><button class="btn-sm btn-danger btn_red11">View Detail</button></a></td>
                                        <?php if(!empty($v['withdraw'])){ ?><td><button class="btn-sm btn-danger btn_red11 btn-req" type="button">Withdraw</button></td><?php } else { ?>
                                        <td><a href="<?php echo $this->webroot; ?>freelancer/withdrawAmount/<?php echo $v['Milestone']['id']; ?>"><button class="btn-sm btn-danger btn_red11">Withdraw</button></a></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr><td colspan="8" style="text-align:center; padding: 35px; font-size: 20px">No transactions meet your selected criteria</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
<!--            <div class="bg_white marg_tb15">
                <div class="green"> Statement Period <small class="font_14">(oct 20,2014 to Dec 21,2014)</small> </div>
                <div class="table-responsive">
                    <table class="table cust_table4 marg_0">
                        <thead>
                            <tr>
                                <th>Beginning Balance</th>
                                <th>$0.00</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Total Credits</td>
                                <td>$0.00</td>
                            </tr>

                            <tr>
                                <td>Ending Balance</td>
                                <td>$0.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>-->

        </div>

        <div class="clearfix"></div>
    </div>
</div>
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
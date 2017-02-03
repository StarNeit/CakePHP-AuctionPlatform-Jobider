<style>
    #datePicker{z-index:1151 !important;}
</style>
<?php
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'postajob')) {
    $postajob = 'active';
} else {
    $postajob = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'searchfreelancer')) {
    $searchfreelancer = 'active';
} else {
    $searchfreelancer = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'contract') && $this->params['pass']['0'] == $users['User']['id']) {
    $searchfreelancer = 'active';
} else {
    $searchfreelancer = '';
}
?> 
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'postajob')); ?>"> Post a job </a></li>
                        <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'searchfreelancer')); ?>"> Search for freelancer </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/postedJobs">  Jobs i have posted   </a></li>


                    </ul>
                </div>
            </div>
            <?php echo $this->element('client_notification'); ?>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="row marg_btm30"> 

                <div class="col-md-12 list_1">
                    <div class="blue_line_bg">
                        <div class="col-xs-4 text-center block1 pdng"> 
                            <?php if ($this->params['controller'] == 'client' and $this->params['action'] == 'contract') { ?>
                                <span class="  bg_grey_1"><font color="#817D7C">1</font></span> <br>
                            <?php } else { ?>
                                <span class="bg_blue_1">1</span> <br>
                            <?php } ?>
                            <br>
                            <label class="font_size16">Contract</label>
                        </div>
                        <div style="text-align:center;" class="col-xs-4 text-center block1 pdng"> 
                            <?php if ($this->params['controller'] == 'client' and $this->params['action'] == 'review_hire') { ?>
                                <span class=" bg_grey_1"><font color="#817D7C">2</font></span> <br>
                            <?php } else { ?>
                                <span class="bg_blue_1">2</span> <br>
                            <?php } ?>
                            <br>
                            <label class="font_size16">Review</label>
                        </div>
                        <div class="col-xs-4 text-center block1 pdng">
                            <div class="gree"> <span class="">
                                    <?php if ($this->params['controller'] == 'client' and $this->params['action'] == 'milestone') { ?>
                                        <span class="bg_grey_1"><font color="#817D7C">3</font></span> </span> <br>
                                <?php } else { ?>
                                    <span class="bg_blue_1">3</span> </span> <br>
                                <?php } ?>
                                <br>
                                <label class="font_size16 text_blue">Milestone and Hire</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bg_white marg_btm30">
                <div class="green"> Job Information </div>
                <form class="apply_jobform withdraw_earnings p15 font_14" role="form">
                    <div class="row">
                        <label class="col-sm-4 opensans font_14">Job Title </label>
                        <div class="col-sm-8"> <span class="font_14 grayclr opensans"><?php if (isset($job_data['Job']['job_title'])) {
                                    echo $job_data['Job']['job_title'];
                                } ?></span> </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 opensans font_14">Start Date</label>
                        <div class="col-sm-8"> <span class="font_14 grayclr opensans"><?php if (isset($job_data['Job']['start_date'])) {
                                    echo $job_data['Job']['start_date'];
                                } ?></span> </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 opensans font_14">Duration </label>
                        <div class="col-sm-8"> <span class="font_14 grayclr opensans"><?php if (isset($job_session['Contect']['time_duration'])) {
                                    echo $job_session['Contect']['time_duration'];
                                } ?></span> </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 opensans font_14">Payment </label>
                        <div class="col-sm-8"> <span class="font_14 grayclr opensans">$<?php if (isset($job_data['Job']['budget'])) {
                                    echo $job_data['Job']['budget'];
                                } ?></span> </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
<?php echo $this->Session->flash(); ?>
            <div class="bg_white marg_btm30">
                <div class="green"> Payment Information </div>
                <form role="form" class="apply_jobform withdraw_earnings p15 font_14 form_style2">
                    <div class="row">
<?php echo $this->Form->create('Paypalpayment', array('url' => array('controller' => 'client', 'action' => 'upfront_payment'))); ?>
                        <label class="col-sm-3 opensans font_14 upfront">Upfront Payment </label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Upfront Payment" id="exampleInputEmail1" class="form-control"  id="searchbar" name="data[Paypalpayment][payment_amount]" required="required">  </div>

                        <div class="col-md-2">
                            <input type='hidden' name='data[Paypalpayment][payment_type]' value='Upfront' class='type_data'>
                            <button class='btn-sm btn-danger btn_red11 paydata linebtn btn_data' type="button" data-toggle="modal" data-target="#myModal2"> Pay </button>
                        </div>
<?php echo $this->Form->end(); ?>
                    </div>

                    <p class="text-center newor"> OR </p>
<?php if (!empty($balance)) { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="balance">
                                    <label class="opensans font_14 upfront">Balance Payment </label>  
                                </div>
                            </div>

                            <div class="col-md-8">
                                <span><?php echo '$' . str_replace(',', '', $balance['Balancepayment']['remaining_payment']); ?></span>
                            </div>
                        </div>
<?php } ?>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-3">
                            <div class="lineinbtn">
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" class="mile_stn" id="inlineRadio1" value="option1"> Add Milestone
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" class="full_pymnt" id="inlineRadio2" value="option2"> Full Payment Pay
                                </label>
                            </div> </div>


                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <div style="display:none;" class="pay_btn">
                <input type="hidden" name="data[Paypalpayment][payment_amount]" value='<?php echo $job_data['Job']['budget']; ?>'class='payments'>
                <input type="hidden" name="data[Paypalpayment][payment_type]" value='full-payment' class='type'>
                <button class="btn-lg btn-green col-md-2 marg_l20 paynow" type="button" data-toggle="modal" data-target="#myModal2">Pay now</button>

            </div>
            <div class="add_mlstn" style="display:none;">
                <button data-target="#myModal1" data-toggle="modal" class="btn-lg btn-green col-md-3" id="add_milestone" >Add Milestones</button>

            </div
            <div class="btnpay">
<?php if (isset($_SESSION['type']) and $_SESSION['type'] == 'full-payment') { ?>
                    <?php echo $this->Form->create('Hire', array('url' => array('controller' => 'client', 'action' => 'milestone'))); ?>
                    <input type='hidden' name='data[Milestone][check]' value='milestone added'>
                    <button type="submit" class="btn-lg btn-green col-md-3 " style="margin-left: 35px;" name="hire" value="hire">Hire</button>
    <?php echo $this->Form->end(); ?>
<?php } else { ?>
    <?php echo $this->Form->create('Hire', array('url' => array('controller' => 'client', 'action' => 'milestone'))); ?>
                    <input type='hidden' name='data[Milestone][check]' value='milestone added'>
                    <button type="submit" class="btn-lg btn-green col-md-3 hire_data" style="margin-left: 35px;" name="hire" value="hire" disabled="">Hire</button>
    <?php echo $this->Form->end(); ?>
<?php } ?>

            </div>

        </div>


    </div>
</div>
</div>


<!------------------- Pop Up For Add Milestones ------------------>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1" class="modal  popup" style="display:none;">
    <div class="milestone_dialog modal-dialog dialog">
        <div class="modal-content">
            <div class="modal-header green">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 id="myModalLabel" class="modal-title">Add Milestones</h4>
            </div>
            <div class="modal-body">
<?php echo $this->Form->create('Milestone', array('class' => 'apply_jobform withdraw_earnings p15 font_14 form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'popup_form'));
?>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">Milestone Title </label>
                    <div class="col-sm-8">
<?php echo $this->Form->input('milestone_title', array('type' => 'text', 'class' => 'form-control title', 'id' => 'title', 'label' => false, 'placeholder' => 'Milestone Title', 'required' => FALSE)); ?>

                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">Start Date</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" class="form-control inpt_mile start" placeholder="Start Date" aria-describedby="basic-addon2" id="datePicker" name="data[Milestone][start_date]">
                            <span class="input-group-addon" id="basic-addon2"><i id="datePicker" class="glyphicon glyphicon-th"></i></span>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">End Date </label>
                    <div class="col-sm-8">

                        <div class="input-group">
                            <input type="text" class="form-control inpt_mile end" placeholder="End Date" aria-describedby="basic-addon2" id="datePicker1" name="data[Milestone][end_date]">
                            <span class="input-group-addon" id="basic-addon2"><i id="datePicker1" class="glyphicon glyphicon-th"></i></span>

                        </div>


                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">Payment </label>
                    <div class="col-sm-8">
<?php echo $this->Form->input('payment_amount', array('type' => 'text', 'class' => 'form-control payment', 'id' => 'pay', 'label' => false, 'placeholder' => 'Milestone Payment', 'required' => FALSE)); ?>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <div class="col-md-12  text-center ">
                    <button type="button" class="btn-lg btn-green bvtn_green1" id="add_popup">Add</button>
                    <button class="btn-lg btn-green bvtn_green1" type="reset"data-dismiss="modal">Cancel</button>
                </div>
            </div>
<?php echo $this->Form->end(); ?> 
        </div>
    </div>
</div>
<!---------------------------------------------------------------------->



<!----------------------  Modal For Payment Method ----------------------->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>
<!------------------------------------------------------------------------->

<script>
    $(document).ready(function () {
        $('.paynow').on('click', function () {
            var payment = $('.payments').val();
            var type = $('.type').val();
//       alert(type);
            $.ajax({
                type: 'post',
                data: {payment: payment, type: type},
                url: '<?php echo $this->webroot; ?>client/payment_data',
                success: function (response) {
                    $('#myModal2').html(response);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        var form_data = $('#popup_form');
        $('#add_popup').click(function () {
            var title = $('.title').val();
            var start_date = $('.start').val();
            var end_date = $('.end').val();
            var payment = $('.payment').val();
            if (title == '' && start_date == '' && end_date == '' && payment == '') {
                alert('Please Enter All The Fields');
            } else {
                $.ajax({
                    type: 'post',
                    data: form_data.serialize(),
                    url: '<?php echo $this->webroot; ?>client/add_milestone_popup_save',
                    success: function (msg) {
                        location.reload();
                        $('.hire_data').removeAttr("disabled")
                    }
                });
            }
        });
    });
</script>
<!--date picker-->
<script src="//code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" type="text/javascript"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js" type="text/javascript"></script>
<script>
        //start date
        $('#datePicker').datepicker({
            dateFormat: 'dd-mm-yy',
//     minDate: '+5d',
        });
        //end date
        $('#datePicker1').datepicker({
            dateFormat: 'dd-mm-yy',
//     minDate: '+5d',
        });

        //start date
        $('#datePicker2').datepicker({
            dateFormat: 'dd-mm-yy',
//     minDate: '+5d',
        });
        //end date
        $('#datePicker3').datepicker({
            dateFormat: 'dd-mm-yy',
//     minDate: '+5d',
        });


// Payment Information Radio buttons.
        $('.mile_stn').on('click', function () {
            $('.add_mlstn').show();
            $('.pay_btn').hide();
            //$('.btn_datye').addClass('hide');
        });

        $('.full_pymnt').on('click', function () {
            $('.add_mlstn').hide();
            //$('.btn_datye').addClass('hide');
            $('.pay_btn').show();
        });

        // show Milestone information table when new milestone added.
        $('body').ready(function () {
            var radio = $('.mile_stn').is(':checked');
            if (radio == true) {
                $('.add_mlstn').show();
            }
        });
</script>
<style>
    .error_msg
    {
        color: red;
    }
    .btn-green.paydata {
        font-size: 15px;
    }
    .btn.btn-danger.col-md-12.marg_tb15.pay {
        margin-top: 58px;
    }
    .balance {
        margin-left: 15px;
    }
</style> 
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn_data', function () {

            var search = $('#exampleInputEmail1').val();
            if (search == '') {
                alert('Please Enter the Search keyword !');
                $('.fade').removeClass('in');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                var payment = $('input[name="data[Paypalpayment][payment_amount]"]').val();
                var type = $('.type_data').val();
                $.ajax({
                    type: 'post',
                    data: {payment: payment, type: type},
                    url: '<?php echo $this->webroot; ?>client/payment_data',
                    success: function (response) {
                        $('#myModal2').html(response);
                    }
                });
                return true;
            }
        });
    });
</script>
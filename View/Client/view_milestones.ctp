<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="payment1">
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body bg_grey1 padd_0">
                        <ul class="nav ">
                            <li><a href="<?php echo $this->webroot; ?>client/postajob"> Post a job </a></li>
                            <li><a href="<?php echo $this->webroot; ?>client/searchfreelancer"> Search for freelancer </a></li>
                            <li><a href="<?php echo $this->webroot; ?>client/postedJobs">Jobs i have posted </a></li>
                            <li><a href="<?php echo $this->webroot; ?>client/job_payment">Jobs Payment</a></li>
                        </ul>
                    </div>
                </div>
             <?php echo $this->element('client_notification'); ?>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="payment">
                <div class="bg_white">
                    <div class="green">Milestones Detail <?php if(!empty($remain['Balancepayment']['remaining_payment'])){?><span class="pull-right">Remaining amount <font class="text_3">(<?php  echo '$'.$remain['Balancepayment']['remaining_payment'];?>)</font></span>
                    <?php } ?></div>
                      <?php echo $this->Session->flash();?>
                    <div class="table-responsive marg_tb15">
                        <table class="table cust_table11 table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No </th>
                                    <th> Title</th>
                                    <th>  Start Date </th>
                                    <th>  End  Date </th>
                                    <th> Status </th>
                                    <th> Amount </th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($milestone)) { ?>
                                    <?php
                                    $i = 1;
                                    foreach ($milestone as $k => $v) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                       <td> <?php echo $v['Milestone']['milestone_title']; ?></td>
                                            <td><?php echo $v['Milestone']['start_date']; ?></td>
                                            <td><?php echo $v['Milestone']['end_date']; ?></td>
                                        <td><?php echo $v['Milestone']['milestone_status']; ?> </td>
                                            <td><?php echo $v['Milestone']['payment_amount']; ?> </td>
                                            <?php if ($v['Milestone']['milestone_status'] == 'Paid') { ?>
                                                <td><button class="btn-sm btn-danger btn_red11 btn_pay" data-toggle="modal" data-target='#myModal1' id='<?php echo $v['Milestone']['id']; ?>' type="button" disabled="">Pay Now</button></td>
                                            <?php } else { ?>
                                                <td><button class="btn-sm btn-danger btn_red11 btn_pay" data-toggle="modal" data-target='#myModal1' id='<?php echo $v['Milestone']['id']; ?>' type="button">Pay Now</button></td>
        <?php } ?>
                                            <td><span> <a href="javascript:;" id="<?php echo $v['Milestone']['id']; ?>"  class="edit_milestone" data-target="#myModalEdit" data-toggle="modal"> <img src="<?php echo $this->webroot; ?>img/edit_1.png"> </a> </span>  &nbsp;&nbsp; <span><a href="javascript:;" id="<?php echo $v['Milestone']['id']; ?>" class="btn_del" onClick="return confirm('Are you sure want to delete?');"> <img src="<?php echo $this->webroot; ?>img/delete.png"></a> </span>
                                        
                                            </td>
                                        </tr>
                                        <?php $i++;
                                    } 
                                    } else { ?>
                                    <tr>
                                        <td colspan="7" style="text-align:center; font-size:20px;padding: 40px">No Milestone(s) Found </td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                                                         
                  
                </div>
                
                <?php if(!empty($val) and (!empty($remain['Balancepayment']['remaining_payment']))){?>
                <span>
                                                    <input type="hidden" value="<?php echo $val['Milestone']['client_id'] ?>" class="client">
                                                    <input type="hidden" value="<?php echo $val['Milestone']['freelancer_id'] ?>" class="freelancer">
                                                    <input type="hidden" value="<?php echo $val['Milestone']['job_id'] ?>" class="job">
                                                    <a href="javascript:;" id="add_milestone" data-target="#myModalAdd" data-toggle="modal"class="btn btn-danger">Add More<i class="fa fa-user"></i></a> </span> 
                <?php } else{?>
                <table class="table cust_table11 table-striped">
                    <tr>
                        <td style="text-align:center;"> No remaining amount, so you can not add milestone</td>
                    </tr>
                </table>
                <?php } ?>
            </div>
            



        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!------------------Add Milestone Popup--------------->

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalAdd" class="modal  popup" style="display:none;">
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
                    <label class="col-sm-4 opensans font_14">Job Title </label>
                    <div class="col-sm-8">
<?php echo $this->Form->input('milestone_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'title', 'label' => false, 'placeholder' => 'Milestone Title', 'required' => FALSE)); ?>

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

<!--              <input type="email" placeholder="End Date" id="datePicker1" class="form-control end" name="data[Milestone][end_date]">-->

                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">Payment </label>
                    <div class="col-sm-8">
<?php echo $this->Form->input('payment_amount', array('type' => 'text', 'class' => 'form-control', 'id' => 'pay', 'label' => false, 'placeholder' => 'Milestone Payment', 'required' => FALSE)); ?>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <div class="col-md-12  text-center ">
                    <input type="hidden" class="datas" value="" name="data[Milestone][job_id]">
                    <input type="hidden" class="clients" value="" name="data[Milestone][client_id]">
                    <input type="hidden" class="freel" value="" name="data[Milestone][freelancer_id]">
                    <button type="button" class="btn-lg btn-green bvtn_green1" id="add_popup">Add</button>
                    <button class="btn-lg btn-green bvtn_green1" type="reset"data-dismiss="modal">Cancel</button>
                </div>
            </div>
<?php echo $this->Form->end(); ?> 
        </div>
    </div>
</div>

<!---------------------------------------------------->

<!---------Edit PopUp---------->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEdit" class="modal  popup" style="display:none;">
    <div class="modal-dialog dialog">
        <div class="modal-content">
            <div class="modal-header green">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 id="myModalLabel" class="modal-title">Add Milestones</h4>
            </div>
            <div class="modal-body">
<?php echo $this->Form->create('Milestone', array('class' => 'apply_jobform withdraw_earnings p15 font_14 form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data', 'id' => 'popup_form'));
?>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">Job Title </label>
                    <div class="col-sm-8">
<?php echo $this->Form->input('milestone_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'title1', 'label' => false, 'placeholder' => 'Milestone Title', 'required' => FALSE)); ?>
 </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">Start Date</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" class="form-control inpt_mile start1" placeholder="Start Date" aria-describedby="basic-addon2" id="datePicker2" name="data[Milestone][start_date]">
                            <span class="input-group-addon" id="basic-addon2"><i id="datePicker2" class="glyphicon glyphicon-th"></i></span>
                        </div>
                        <!--               <input type="email" placeholder="Start Date" id="datePicker2" class="form-control  start1" name="data[Milestone][start_date]">-->
                           <!-- <span><i id="datePicker" class="glyphicon glyphicon-th"></i></span> -->
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">End Date </label>
                    <div class="col-sm-8">
                        <input type="email" placeholder="End Date" id="datePicker3" class="form-control end1" name="data[Milestone][end_date]">
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 opensans font_14">Payment </label>
                    <div class="col-sm-8">
<?php echo $this->Form->input('payment_amount', array('type' => 'text', 'class' => 'form-control', 'id' => 'pay1', 'label' => false, 'placeholder' => 'Milestone Payment', 'required' => FALSE)); ?>
                    </div>
                </div>

            </div>
            <input type="hidden" name="data[Milestone][id]" id="hdn_id" value="">
            <div class="modal-footer">
                <div class="col-md-12  text-center ">
                    <button type="button" class="btn-lg btn-green bvtn_green1" id="update_popup">Add</button>
                    <button class="btn-lg btn-green bvtn_green1" type="reset"data-dismiss="modal">Cancel</button>
                </div>
            </div>
<?php echo $this->Form->end(); ?> 
        </div>
    </div>
</div>
<!----------------------------------->

<div class="modal fade " id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn_pay', function () {
            var milestone_id = $(this).attr('id');
            $.ajax({
                'type': 'post',
                'url': '<?php echo $this->webroot; ?>client/ajax_pay',
                data: {milestone_id: milestone_id},
                success: function (response) {
                    $('#myModal1').html(response);
                }
            });
        });

    });
</script>
<!----------------------------->
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

    // Add Milestone



    $('#add_milestone').on('click', function () {
        var job_id = $(this).prev().val();
        //alert(job_id);
        var freelancer_id = $(this).prev().prev().val();
        var client_id = $(this).prev().prev().prev().val();
        $('.datas').val(job_id);
        $('.clients').val(client_id);
        $('.freel').val(freelancer_id);
    });
    var save_data = $('#popup_form');
    $('#add_popup').click(function () {
        $.ajax({
            type: 'post',
            data: save_data.serialize(),
            url: '<?php echo $this->webroot; ?>client/add_milestones',
            success: function (msg) {
                location.reload();
            }
        });
    });

//Delete Milestone//
    $('.btn_del').click(function () {
        var Milestone_id = $(this).attr('id');
        $this = $(this);
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '<?php echo $this->base; ?>/client/delete_milestone',
            data: {Milestone_id: Milestone_id},
            success: function (msg) {
                if (msg.suc == 'yes') {
                    $this.parent().parent().parent().remove();
                }
            }
        });
    });


//Edit Milestone//

    $('.edit_milestone').on('click', function () {
        var Milestone_edit_id = $(this).attr('id');
//alert(Milestone_edit_id);
        $this = $(this);
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '<?php echo $this->base; ?>/client/edit_milestone',
            data: {Milestone_edit_id: Milestone_edit_id},
            success: function (msg) {
                if (msg.suc == 'yes') {

                    $('#title1').val(msg.record.milestone_title);
                    $('#hdn_id').val(msg.record.id);
                    $('.start1').val(msg.record.start_date);
                    $('.end1').val(msg.record.end_date);
                    $('#pay1').val(msg.record.payment_amount);

                }
            }
        });

    });

    $('#update_popup').on('click', function () { //alert('fd');
        $this = $(this).parent().parent().parent();
        var milestone_title = $this.find('#title1').val();
        var start_date = $this.find('.start1').val();
        var end_date = $this.find('.end1').val();
        var payment_amount = $this.find('#pay1').val();
        var id = $this.find('#hdn_id').val();
        $.ajax({
            type: "POST",
            url: '/client/edit_milestone_save',
            data: {'milestone_title': milestone_title, 'start_date': start_date, 'end_date': end_date, 'payment_amount': payment_amount, 'id': id},
            success: function (data) {

                $('.popup').hide();
                $('#myModal1').hide();
                $('.modal-backdrop').hide();
                location.reload();
            },
        });
    });


// Payment Information Radio buttons.

    $('.mile_stn').on('click', function () {

        $('.add_mlstn').show();
        $('.pay_btn').hide();
    });

    $('.full_pymnt').on('click', function () {
        $('.add_mlstn').hide();
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
    .payment {
        margin-top: 20px;
    }

    .payment .marg_tb15 {
        margin: 0;
    }

    .payment1 {
        margin-top: 20px;
    }

</style>
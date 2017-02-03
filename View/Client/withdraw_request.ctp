<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('reports_sidebar'); ?>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">

                <div class="green">Withdraw Request Details </div>

                <form accept-charset="utf-8" method="post" id="UserSettingsForm" role="form" class="formstyle form_sighn form_style2 marg_tb15" action="/client/settings"><div style="display:none;"><input type="hidden" value="POST" name="_method"></div>              
                    <div class="job_form">



                        <div class="col-md-12">
                            <div class="suc">
                            </div>

                            <div class="form-group">

                                <div class="col-md-6">  <div class="job_form_info"><label for="exampleInputName2"> Freelancer Name</label> </div></div>
                                <div class="col-md-6">  <div class="job_form"><label for="exampleInputName2"><?php echo ucfirst($WithdrawResult['User']['first_name']) . ' ' . ucfirst($WithdrawResult['User']['last_name']); ?></label>

                                    </div></div></div></div>
                        <?php  if(!empty($WithdrawResult['Milestone']['milestone_title'])){ ?>
                        <div class="col-md-12">
                            <div class="form-group">

                                <div class="col-md-6">  <div class="job_form_info"><label for="exampleInputName2">Milestone Title</label> </div></div>
                                <div class="col-md-6">  <div class="job_form"><label for="exampleInputName2"><?php echo $WithdrawResult['Milestone']['milestone_title']; ?></label>

                                    </div></div></div></div>
                        <?php } ?>
                        <div class="col-md-12">
                            <div class="form-group">

                                <div class="col-md-6">  <div class="job_form_info"><label for="exampleInputName2">Reciever EmailId</label> </div></div>
                                <div class="col-md-6">  <div class="job_form"><label for="exampleInputName2"><?php echo $WithdrawResult['Withdrawrequest']['receiver_email']; ?></label>

                                    </div></div></div></div>


                        <div class="col-md-12">
                            <div class="form-group">

                                <div class="col-md-6">  <div class="job_form_info"><label for="exampleInputName2">Total Amount</label> </div></div>
                                <div class="col-md-6">  <div class="job_form"><label for="exampleInputName2"><?php echo '$' . $WithdrawResult['Withdrawrequest']['total_amount']; ?></label>

                                    </div></div></div></div>                  

                        <div class="col-md-12">
                            <div class="form-group">

                                <div class="col-md-6">  <div class="job_form_info"><label for="exampleInputName2">Withdrawn Amount</label> </div></div>
                                <div class="col-md-6">  <div class="job_form"><label for="exampleInputName2"><?php echo '$' . $WithdrawResult['Withdrawrequest']['withdraw_amount']; ?></label>

                                    </div></div></div></div>

<?php  if(!empty($WithdrawResult['Withdrawrequest']['start_date'])){ ?>
                        <div class="col-md-12">
                            <div class="form-group">

                                <div class="col-md-6"> 

                                    <div class="job_form_info"><label for="exampleInputName2">Start Date</label> </div>
                                </div>
                                <div class="col-md-6">  <div class="job_form"><label for="exampleInputName2"><?php echo $WithdrawResult['Milestone']['start_date']; ?></label>

                                    </div></div></div></div>
<?php } ?>
                        
                        <?php  if(!empty($WithdrawResult['Withdrawrequest']['end_date'])){ ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6"> 
                                    <div class="job_form_info">
                                        <label for="exampleInputName2">End Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="job_form">
                                        <label for="exampleInputName2">
                                            <?php echo $WithdrawResult['Milestone']['end_date']; ?>
                                        </label>
                                        <input type="hidden" class="request_id" value="<?php echo $WithdrawResult['Withdrawrequest']['id']; ?>"
                                    </div>
                                </div>
                            </div>
                        </div>








                    </div>
                        <?php } ?>            
                </form>
                   <input type="hidden" class="request_id" value="<?php echo $WithdrawResult['Withdrawrequest']['id']; ?>">
                <?php if($WithdrawResult['Withdrawrequest']['request_status']==''){ ?>
                    
            
                <div class="col-md-12 marg_tb50 text-center">
                    <div class="job_form_butt">
                        <p>

                            <button type="button" class="btn-lg btn-green1 accept"> Accept </button>


                            <button type="button" class="btn-lg btn-green1 decline"> Decline</button>

                        </p>

                    </div>

                </div>
  <?php   }else{ ?>
                   <div class="col-md-12 marg_tb50 text-center">
                    <div class="job_form_butt">
                        <p>
<?php if($WithdrawResult['Withdrawrequest']['request_status']=='accepted'){ ?>
                            <button type="button" class="btn-lg btn-green1"> Already Accepted </button>
<?php }else{ ?>

                            <button type="button" class="btn-lg btn-green1"> Already  Declined</button>
<?php } ?>

                        </p>

                    </div>

                </div>
      
 <?php } ?>






                <div class="clearfix"></div>
            </div>


        </div>
    </div>
</div>
</div>
<script>
    $(document).on('click', '.accept', function () {
        var request_id = $('.request_id').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->webroot . 'client/ajax_activity' ?>',
            dataType: 'json',
            data: {
                request_id: request_id
            },
            success: function (msg) {
                if (msg.status == 'true') {
                    $('.suc').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong></strong>You have approved the Payment withdraw request. </div>');
                    setInterval(function () {
                        window.location = "<?php echo $this->webroot . 'client/AllWithdrawRequest' ?>";
                    }, 1000);


                }

            }
        });
    });

    $(document).on('click', '.decline', function () {
        var request_id = $('.request_id').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->webroot . 'client/ajax_activity_decline' ?>',
            dataType: 'json',
            data: {
                request_id: request_id
            },
            success: function (msg) {
                if (msg.status == 'true') {
                    $('.suc').html('<div class="alert alert-success"><button data-dismiss="alert" class="close">x</button><strong></strong>You have declined the Payment withdraw request. </div>');

                    setInterval(function () {
                        window.location = "<?php echo $this->webroot . 'client/AllWithdrawRequest' ?>";
                    }, 1000);
                }

            }
        });
    });

</script>
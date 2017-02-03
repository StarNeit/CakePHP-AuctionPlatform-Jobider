<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <?php echo $this->element('client_profile_sideber'); ?>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p class="font_14">A payment of $23 has been supplied to your account.
                    </p> <p class="font_14">Michel shey contact : <br>
                        Tester for wordpress site started on 13-Nov-2014 </p>
                    <p><i><img alt="View" class="mrg_r5" src="<?php echo $this->webroot; ?>img/view.png"></i><a href="#">See all notifications  &gt;&gt;</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Form->create('Notificationsetting', array('url' => array('controller' => 'client', 'action' => 'notifications'))); ?>
            <div class="bg_white notifications">
                <div class="green"> Notifications Settings  </div>
                <div class="col-md-12">
                    <p>Send email notification to <strong><?php echo $user_email['User']['email']; ?></strong> when...</p>
                    <hr class="brder_btmgrey marg_0"></div>
                <div class="clearfix"></div>
                <div class="col-md-12 marg_tb15">
                    <div class="bg_grey3">
                        Message Center 
                    </div>

                    <p class="pull-left" >Someone send me message</p>
                    <div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>                   <div class="clearfix"></div>
                    <div class="bg_grey3">
                        Recruiting
                    </div>
                    <p class="pull-left" >A job is posted or modified. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" >A job  application is received. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">An interview is accepted or offer terms are modified.</p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">A interview or offer is declined or withdrawn. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">An offer is accepted. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" >A job posting will expire soon. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">A job posting expired. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">No interviews have been initiated. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">
                </div>
                <div class="col-md-12 marg_tb15">
                    <div class="bg_grey3">
                        Freelancer and Agency job Applications
                    </div>

                    <p class="pull-left" >A job is posted or submitted. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" >An interview is initiated. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">An offer or interview invitaion is recieved.</p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">A  offer  or interview invitaion is withdrawn. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">A job application is rejected. </p><div class="checkbox pull-right"><input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" >A job I applied to is modified or canceled. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">
                </div>
                <div class="col-md-12 marg_tb15">
                    <div class="bg_grey3">
                        Contracts
                    </div>

                    <p class="pull-left" >A hire is made or a contract begins . </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">A job is received. </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" >Time logging begins .</p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">Contract terms are modified . </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" >A contract ends. </p><div class="checkbox pull-right " id='chekdata' >
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">
                    <p class="pull-left" >A timelog is ready for review . </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">

                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">Feedback changes are made  . </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">

                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">Daily snapshot of time recorded by your freelancers . </p><div class="checkbox pull-right">
<!--<input type='hidden' name="check_value[]" id='chek' value='yes'>-->
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">

                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left">Weekly billing digest . </p><div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="" >

                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" >A contract is going to be automatically paused  . </p>
                    <div class="checkbox pull-right">
                        <input type="checkbox" id='chek' name="check_value[]" checked="" class='chkdata' value="">

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">
                </div>
                <div class="col-md-12">
                    <button class="btn-lg btn-green col-md-3 col-sm-3 col-xs-4 marg_tb15 testdata" type='button'>Save Change</button>

                </div>
                <div class="clearfix"></div>
            </div>
            <?php echo $this->Form->end(); ?> 
        </div>

        <div class="clearfix"> </div> </div>          

</div>

<script>
    $(document).ready(function() {
        $('.testdata').click(function() {
//       var testValue="<?php //echo $this->request->data;  ?>";
            var multiCheck = new Array();
            if($(this).is(':checked')==true){
    $('input:checked').each(function() {
                multiCheck.push($(this).val());
                alert(multiCheck);
            });
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>client/ajax_val',
                data: {multiCheck: multiCheck},
                success: function() {
                }
            });
            }else{
    $('input:checked').each(function() {
                multiCheck.push($(this).val());
                alert(multiCheck);
            });
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>client/ajax_val',
                data: {multiCheck: multiCheck},
                success: function() {
                }
            });
            }
            return false;
        });



    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.chkdata', function() {
            // alert('kdhfdjsh');

            //alert(data);
            if ($(this).is(':checked') == true) {
                // alert($(this).val());
                $(this).val('yes');
            } else {
                $(this).val('no');
//        $(this).prev().attr('name','');
//        $(this).parent().prev().prev().attr('name','');
            }


        });
    });
</script>
<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('employee_settings'); ?>
      <?php echo $this->Form->create('Notificationsetting',array('url'=>array('controller'=>'freelancer','action'=>'notifications'))); ?>
        <?php //pr($check); die; ?>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white notifications">
                <div class="green"> Notifications Settings  </div>
                <?php if (isset($email_info) and !empty($email_info)) {
                    ?>
                    <div class="col-md-12">
                        <p>Send email notification to <b><?php echo $email_info['User']['email']; ?> </b> when...</p>

                        <hr class="brder_btmgrey marg_0">
                    </div>
                <?php } ?>
                <div class="clearfix"></div>

                <div class="col-md-12 marg_tb15">
                    <div class="bg_grey3">
                        Message Center
                        <!-- <a class="pull-right" href="#">Email</a>-->
                    </div>
                    <p class="pull-left"  >Someone send me message</p>

                    <div class="checkbox pull-right">

                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['0']) && $check['0']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>    

                    </div><p></p>
                    <div class="clearfix"></div>
                    <div class="bg_grey3">
                        Recruiting
                    </div>
                    <p class="pull-left" name="data[Notificationsetting][title]"> A job is posted or modified. </p>
                    <div class="checkbox pull-right">
            
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['1']) && $check['1']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">A job application is received </p><div class="checkbox pull-right">

                       
                      
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['2']) && $check['2']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">An interview is accepted or offer terms are modified </p><div class="checkbox pull-right">

                        
                    
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['3']) && $check['3']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]"> An interview or offer is declined or withdrawn  </p><div class="checkbox pull-right">

                        
                      
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['4']) && $check['4']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left"  name="data[Notificationsetting][title]">An offer is accepted  </p><div class="checkbox pull-right">

                        
                     
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['5']) && $check['5']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">A job posting will expire soon  </p><div class="checkbox pull-right">

                         
                        
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['6']) && $check['6']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]"> A job posting expired  </p><div class="checkbox pull-right">
      
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['7']) && $check['7']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">
                    <p class="pull-left" name="data[Notificationsetting][title]"> No interviews have been initiated </p><div class="checkbox pull-right">
                         
                        
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['8']) && $check['8']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">
                </div>

                <div class="col-md-12 marg_tb15">


                    <div class="bg_grey3">
                        Freelancer and Agency job Applications

                    </div>

                    <p class="pull-left" name="data[Notificationsetting][title]">A job application is submitted  </p><div class="checkbox pull-right">

                         
                      
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['9']) && $check['9']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">An interview is initiated  </p><div class="checkbox pull-right">

                         
                        
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['10']) && $check['10']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">An offer or interview invitation is received</p><div class="checkbox pull-right">

                         
                       
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['11']) && $check['11']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">An offer or interview invitation is withdrawn </p><div class="checkbox pull-right">

                         
                      
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['12']) && $check['12']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">A job application is rejected </p><div class="checkbox pull-right">

                         
                        
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['13']) && $check['13']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]"> A job I applied to is modified or canceled </p><div class="checkbox pull-right">

                   
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['14']) && $check['14']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">
                </div>

                <div class="col-md-12 marg_tb15">


                    <div class="bg_grey3">
                        Contracts

                    </div>

                    <p class="pull-left" name="data[Notificationsetting][title]">A hire is made or a contract begins </p><div class="checkbox pull-right">

                         
                     
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['15']) && $check['15']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">Time logging begins  </p><div class="checkbox pull-right">

                         
                        
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['16']) && $check['16']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">Contract terms are modified </p><div class="checkbox pull-right">

                         
                        
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['17']) && $check['17']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left"  name="data[Notificationsetting][title]">A contract ends  </p><div class="checkbox pull-right">

                         
                        
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['18']) && $check['18']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left"  name="data[Notificationsetting][title]">A timelog is ready for review </p><div class="checkbox pull-right">

                       
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['19']) && $check['19']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">Feedback changes are made</p><div class="checkbox pull-right">

                         
                      
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['20']) && $check['20']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">Daily snapshot of time recorded by your freelancers </p><div class="checkbox pull-right">

                     
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['21']) && $check['21']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">Weekly billing digest </p><div class="checkbox pull-right">

                         
                       
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['22']) && $check['22']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>

                    </div><p></p>
                    <div class="clearfix"></div>

                    <hr class="brder_btmgrey marg_0">

                    <p class="pull-left" name="data[Notificationsetting][title]">A contract is going to be automatically paused </p><div class="checkbox pull-right">
    
                        
                                                 <input type="checkbox" id='chek' name="check_value[]"    class='chkdata' <?php if( isset($check['23']) && $check['23']=='yes'){  echo  "value='yes' checked='checked'";} else { echo 'value=no'; }?>>
                    </div><p></p>
                    <div class="clearfix"></div>
                    <hr class="brder_btmgrey marg_0">
                </div>
                <div class="img_loader  loader hide ">
                    <img src="<?php  echo $this->webroot;?>img/loading_blue.gif">
                </div>
                <div class="col-md-12">
                    <button class="btn-lg btn-green col-md-3 col-sm-3 col-xs-4 marg_tb15 testdata " type="button">Save Change</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php  echo $this->Form->end(); ?>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.testdata').click(function() {
            
        var arr=[];

$.each($("input[type='checkbox']"),function(){
    arr.push($(this).val());
   // alert(arr);
});
     $('.loader').removeClass('hide');
     setTimeout(function(){
         $('.loader').addClass('hide');
     },3000);
            $.ajax({
           
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>freelancer/ajax_val',
                data: {arr: arr},
                success: function() {
                }
            });
           
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
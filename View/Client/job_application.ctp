<?php
if (!empty($this->params['pass'][0])) {
    $free_id = $this->params['pass'][0];
}
?>
<div class="container">
    <hr class="brder_btm">
    <?php if (isset($freelancer_info) and !empty($freelancer_info) and !empty($Contect_result)) { ?>
        <div class="col-md-7">
            <div class="job_app">
                <div class="row">
                    <div class="col-md-2">
                        <img src="<?php echo $this->webroot; ?>uploads/<?php echo $freelancer_info['User']['image']; ?>" class="img-responsive" height='50' width='50' alt="image">    </div>
                    <div class="col-md-7">
                        <h1><?php echo ucfirst($freelancer_info['User']['first_name']) . ' ' . ucfirst($freelancer_info['User']['last_name']); ?> </h1>
                        <p> <?php echo $freelancer_info['User']['job_title']; ?> </p>
                        <p> <i> <img src="<?php echo $this->webroot; ?>img/location1.png" alt="image"> </i> <strong> <?php echo $freelancer_country['Country']['name']; ?></strong> </p>
                        <h6>
                            <?php  if(!empty($freelancer_info['User']['login_time'])){
                                echo date('h:i A',  strtotime($freelancer_info['User']['login_time']));
                            }else{
                                
                            } ?>
                     </h6>
                        <div class="tabs_1 col-md-12">
                            <div class="col-md-12colsm-12 less_skills ">
                                <?php
                                if (!empty($freelancer_skill)) {
                                    $total_skills = count($freelancer_skill);
                                    $j = 0;
                                    foreach ($freelancer_skill as $kk => $vv) {
                                        ?>
                                        <button disabled="" class="subskil"><?php echo $vv['Subskill']['skill_name']; ?></button>
                                        <?php
                                        if ($j == '5') {
                                            break;
                                        }$j++;
                                    }
                                }
                                if ($total_skills >= 5) {
                                    ?>
                                    <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
                                <?php } ?>
                            </div>

                            <div class="col-md-12 colsm-12 more_skills hide ">
                                <?php
                                if (!empty($freelancer_skill)) {
                                    $total_skills = count($freelancer_skill);
                                    $j = 0;
                                    foreach ($freelancer_skill as $kk => $vv) {
                                        ?>
                                        <button disabled="" class="subskil"><?php echo $vv['Subskill']['skill_name']; ?></button>
                                        <?php
                                        $j++;
                                        ?>
                                    <?php
                                    }
                                }
                                ?>
                                <a href="JavaScript:void(0);" class="subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="text-right">
          <?php echo '$' . $Contect_result['Contect']['total_amount'].'.00'; ?>
    <!--  <i>($88.2)</i>-->
                        </h2>
                    </div>
                </div>
            </div>
            <div class="drop_text marg_t35">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">   <div class="panel panel-default">
                        <div class="panel-heading padd_0" role="tab" id="headingOne">
                            <h4 class="panel-title green">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="marg_r10"><img src="/img/accordian.png" alt="image"></i>Message from Client
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body text_1">

                                <h5 class="font_14"><?php echo nl2br($Contect_result['Contect']['messages']); ?></h5>
                                <!--                      <h5 class="font_14">Regards</h5>-->
                            </div>
                        </div>
                    </div>


                </div>


            </div>



            <div class="drop_text marg_t35">


                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    <div class="panel panel-default">
                        <div class="panel-heading padd_0" role="tab" id="headingOne">
                            <h4 class="panel-title green">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOnee" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="marg_r10"><img src="/img/accordian.png" alt="image"></i>Message
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOnee" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <!--                            <form accept-charset="utf-8" method="post" id="MessageJobApplicationForm" action="/client/job_application/4">-->

                                <?php echo $this->Form->create('Messages', array('url' => array('controller' => 'client', 'action' => 'job_application/' . $freelancer_info['User']['id']))); ?>
                            <div class="panel-body text_1">

                                <?php
                                if (isset($Messages) and !empty($Messages)) {
                                    foreach ($Messages as $key => $val) {
                                        ?> 
                                        <div class="detail  brder_btm padd_tb15">
                                            <div class="col-md-2 col-sm-2 pad_l0"> 
                                                <div class="user_content pull-left">
                                                    <?php foreach ($val['users'] as $keey => $vval)
                                                        
                                                        ?>
                                                    <h4 class="marg_0 text-danger font_14"><?php echo ucfirst($vval['User']['first_name']) . '  ' . ucfirst($vval['User']['last_name']); ?></h4>
                                                    <small class="text_1"><?php echo date('M d,Y', strtotime($val['Message']['created'])); ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-8">
                                                <p class="text_1"><?php echo $val['Message']['reply'] ?></p>                                       </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>  
                                <div class="detail  bottom_brder padd_tb15">
                                    <div class="col-md-12 col-sm-12 pad_l0"> 
                                        <h4 class="marg_0 text_1 font_14 ">Reply</h4>
                                        <div class="text_reply marg_tb15">

                                            <textarea class="text_area" name="data[Message][reply]" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div><div class="col-md-12 marg_tb50 pad_l0">
                                    <p>
                                        <button type="button" class="btn-lg btn-green1 sendbtn"> Send </button>
                                    </p>
                                </div>
                            </div>
    <?php echo $this->Form->end(); ?>
                            <!--                            </form>     -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } else { ?>
        <div class="col-md-8 col-sm-8 marg_btm30"  style="margin-top: 20px;">
            <div class="clearfix"></div>
            <div class="bg_white freelaners marg_btm30">
                <div class="green">
    <?php echo ucfirst($freelancer_info['User']['first_name']) . ' ' . ucfirst($freelancer_info['User']['last_name']); ?><span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt="image"></i><?php echo $freelancer_info['User']['job_title']; ?><?php echo '(' . $subskills . ')'; ?></span>
                    <div class="clearfix"></div></div>
                <div class="col-md-2 col-sm-2 marg_tb15">
                    <img class="img-thumbnail" alt="image" src="<?php echo $this->webroot; ?>uploads/<?php echo $freelancer_info['User']['image']; ?>">
                </div>
                <div class="col-md-10 colsm-10 marg_tb15 lesval">
                    <p>
    <?php echo substr($freelancer_info['User']['description'], 0, 200) . '....'; ?> 
                        <a href="JavaScript:void(0);" class="more">More</a>
                    </p>
                </div>
                <div class="col-md-10 colsm-10 marg_tb15 moreval hide ">
                    <p><?php echo $freelancer_info['User']['description']; ?>
                        <a href="JavaScript:void(0);" class="less" >Less</a>
                    </p>
                </div>
                <div class="clearfix"></div>
                <hr class="brder_btm1">
                <div class="tabs_1 col-md-12 marg_t5">
                     <div class="col-md-10 colsm-10 less_skills ">
                        <?php
                        if (!empty($freelancer_skill)) {
                            $total_skills = count($freelancer_skill);
                            $k = 0;
                            foreach ($freelancer_skill as $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
                                <?php
                                if ($k == '3') {
                                    break;
                                } $k++;
                            }
                            ?>
                        <?php } ?>
                        <?php if ($total_skills >= 4) { ?>
                            <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
                        <?php } ?> 
                    </div>
                    <div class="col-md-10 colsm-10 more_skills hide">
                        <?php
                        if (!empty($freelancer_skill)) {
                            $total_skills = count($freelancer_skill);
                            $k = 0;
                            foreach ($freelancer_skill as $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
                                <?php
                                $k++;
                            }
                            ?>
                        <?php } ?>

                        <a href="JavaScript:void(0);" class=" subskil less_skill" style="background: #2A6EB3;color:#fff; text-decoration: none;">Less</a>

                    </div>
                </div>
                    <div class="clearfix "></div>
                    <br>
                    <hr class="brder_btm marg_0">
                    <div class="col-md-12 ">
                        <h2>Work History and Feedback </h2>
                    </div>   <div class="clearfix"></div>
                    <div class="table-responsive">



                        <table width="88%" class="table marg_tb15 cust_table1">


                            <tbody>
                                <tr>
                                    <td width="28%"><span class="pull-left">4.8</span> <ul class="list-inline pull-left marg_l20"><li><img alt="image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li></ul></td>
                                    <td width="36%"><p>Lorem Ipsum is simply a dummy text 
                                            to ysed in HTML.Lorm Ipsum is simply 
                                            a dummy text.</p></td>
                                    <td width="36%"><h5 class="marg_t5 text_2">AWS SDK Developer-C# and Java</h5>
                                        <p class="text_green marg_0">May 2013 <font class="text_1">to</font> June 2014</p>
                                        <span class="font_14">Earned $1300</span></td>

                                </tr>
                                <tr>
                                    <td width="28%"><span class="pull-left">4.8</span> <ul class="list-inline pull-left marg_l20"><li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li></ul></td>
                                    <td width="36%"><p>Lorem Ipsum is simply a dummy text 
                                            to ysed in HTML.Lorm Ipsum is simply 
                                            a dummy text.</p></td>
                                    <td width="36%"><h5 class="marg_t5 text_2">AWS SDK Developer-C# and Java</h5>
                                        <p class="text_green marg_0">May 2013 <font class="text_1">to</font> June 2014</p>
                                        <span class="font_14">Earned $1300</span></td>

                                </tr>

                                <tr>
                                    <td width="28%"><span class="pull-left">4.8</span> <ul class="list-inline pull-left marg_l20"><li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li></ul></td>
                                    <td width="36%"><p>Lorem Ipsum is simply a dummy text 
                                            to ysed in HTML.Lorm Ipsum is simply 
                                            a dummy text.</p></td>
                                    <td width="36%"><h5 class="marg_t5 text_2">AWS SDK Developer-C# and Java</h5>
                                        <p class="text_green marg_0">May 2013 <font class="text_1">to</font> June 2014</p>
                                        <span class="font_14">Earned $1300</span></td>

                                </tr>

                                <tr>
                                    <td width="28%"><span class="pull-left">4.8</span> <ul class="list-inline pull-left marg_l20"><li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li></ul></td>
                                    <td width="36%"><p>Lorem Ipsum is simply a dummy text 
                                            to ysed in HTML.Lorm Ipsum is simply 
                                            a dummy text.</p></td>
                                    <td width="36%"><h5 class="marg_t5 text_2">AWS SDK Developer-C# and Java</h5>
                                        <p class="text_green marg_0">May 2013 <font class="text_1">to</font> June 2014</p>
                                        <span class="font_14">Earned $1300</span></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

                    <?php } ?>
        <div class="col-md-4 col-sm-4">
            <div class="job_right">

                <div class="well bg_none">
<?php if (!empty($job)) { ?>
                        <button type="button" class="btn btn_red1 btn-block margg_t20 btn_new" disabled="">Already Hire</button>

                    <?php } else { ?>
                        <input type="hidden" value="<?php echo $free_id; ?>" class="freedata">
                        <input type="hidden" value="<?php echo $job_id; ?>" class="jobval">
                        <button type="button" class="btn btn_red1 btn-block margg_t20 new_data">Hire</button>

<?php } ?>
                    <h5><a href="#" data-toggle="modal" data-target="#myModal_new">Decline</a></h5>
                </div>
                <div class="col-md-12">
                    <div class=" hre_details">
                        <div class="pad_lzero">
                            Work History<span class="pull-right"></span>
                            <hr class="brder_bttm1">
                            Language<span class="pull-right"></span>
                            <hr class="brder_bttm1">
                            <strong>English</strong><span class="">: Fluent</span>
                            <p class="marg_t35 pad_lzero"><strong>Self Assessed</strong></p>
                            <!--                                <hr class="brder_bttm1">-->
                        </div>
                    </div>





                </div><!--job_right1-->
            </div><!--col-md-12-->

        </div>

    </div>

    <!----Pop Up For Decline ---->
    <div class="modal fade cust_moadl" id="myModal_new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Decline</h4>
                </div>
                <div class="modal-body">
                    <p class="text_cust">We will politely notify the applicant and move them to your inactive tab </p>
                    <!--                <form class="apply_jobform form_new_cust marg_t35" role="form">-->
<?php echo $this->Form->create('Declinefreelancer', array('class' => 'apply_jobform form_new_cust marg_t35', 'role' => 'form', 'url' => array('controller' => 'client', 'action' => 'decline_freelancer/' . $freelancer_info['User']['id']))); ?>
                    <div class="row">
                        <div class="client_resoun">
                            <label class="col-sm-3">Reason</label>
                            <div class="col-sm-7">
                                <label class="radio">
                                    <?php if (!empty($Contect_result['Contect']['job_id'])) { ?>
                                        <input type="hidden" value="<?php echo $Contect_result['Contect']['job_id']; ?>" name="data[Declinefreelancer][job_id]">
<?php } else { ?>
                                        <input type="hidden" name="data[Declinefreelancer][job_id]" value="<?php echo $job_id; ?>">
<?php } ?>
                                    <select name="data[Declinefreelancer][reason]" class="form-control"  >
                                        <option value="">Please Select...</option>
                                        <option value="Ignored instructions in Job Posting">Ignored instructions in Job Posting</option>
                                        <option value="Insufficient oDesk history">Insufficient Jobider history</option>
                                        <option value="Lacks desired skills or qualifications">Lacks desired skills or qualifications</option>
                                        <option value="Rate/bid too high">Rate/bid too high</option>
                                        <option value="Just preferred other applicants">Just preferred other applicants</option>
                                        <option value="Spam application - recycled cover letter">Spam application - recycled cover letter</option>
                                        <option value="Applicant requesting to work outside of oDesk">Applicant requesting to work outside of Jobider</option>
                                    </select> 
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row marg_btm30">
                        <label class="col-sm-3"> Your Message</label>
                        <div class="col-sm-9">
                            <textarea class="col-md-9 col-sm-9 col-xs-12" rows="5" name="data[Declinefreelancer][message]"></textarea>
                            <div class="clearfix"></div>
              <!--              <p class="text-right col-md-9 pad_r0  font_14">500 characters left</p>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!--            <div class="checkbox">
                                <label>
                                  <input type="checkbox"> Lorem ipsum sit amiet.It is simply a dummy text.
                                </label>
                              </div>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12  text-center ">
                            <button  class="btn-lg btn-green bvtn_green1  " type='submit'>Decline</button>
                            <button data-dismiss="modal" class="btn-lg btn-green bvtn_green1">Close</button>
                        </div>
                    </div>
                    <!--                </form>-->
<?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>


    <!--------------------------->

    <script>
        $(document).ready(function() {
            $(document).on('click', '.sendbtn', function() {
                var textdata = $('.text_area').val();
                if (textdata == '') {
                    alert('Please neter your message !');
                } else {
                    $('.sendbtn').attr('type', 'submit');
                }
            });
        });

        $(document).ready(function() {
            $('.new_data').click(function() {
                var job_id = $(this).prev().val();
                var user_id = $(this).prev().prev().val();
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '<?php echo $this->webroot; ?>client/aplicant_data',
                    data: {job_id: job_id, user_id: user_id},
                    success: function(msg) {
                        if (msg.suc == 'yes') {
                            window.location = '<?php echo $this->webroot; ?>client/contract/' + msg.free_id;
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.more_skill', function() {
                $(this).parent().next().removeClass('hide');
                $(this).parent().addClass('hide');
            });

        });
        $(document).ready(function() {
            $(document).on('click', '.less_skill', function() {
                $(this).parent().prev().removeClass('hide');
                $(this).parent().addClass('hide');
            });
        });
    </script>
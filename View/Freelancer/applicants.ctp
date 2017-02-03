<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($Job_detail) and !empty($Job_detail)) { ?>
                    <h3> <?php echo $Job_detail['Job']['job_title']; ?></h3>
                <?php } ?>
                <p>
                <div class="tabs_1 col-md-12 marg_t5" style="margin-bottom: 10px;">
                    <div class="col-md-10 colsm-10 less_skills ">
                        <?php
                        if (!empty($skill_data)) {
                            $total_skill = count($skill_data);
                            $j = 0;
                            foreach ($skill_data as $kk => $vv) {
                                ?>
                                <span class="sm_btn"><?php echo $vv['Subskill']['skill_name']; ?></span>   
                                <?php
                                if ($j == '3') {
                                    break;
                                }$j++;
                                ?>
                            <?php }
                        } ?>
                        <?php if ($total_skill >= 5) { ?>
                            <a href="JavaScript:void(0);" class="sm_btn more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
                        <?php } ?>

                    </div>
                    
                            <div class="col-md-10 colsm-10 more_skills hide ">
                        <?php
                        if (!empty($skill_data)) {
                            $total_skill = count($skill_data);
                            $j = 0;
                            foreach ($skill_data as $kk => $vv) {
                                ?>
                                <span class="sm_btn"><?php echo $vv['Subskill']['skill_name']; ?></span>   
                                <?php
                              $j++;
                                ?>
                            <?php }
                        } ?>
                       
                            <a href="JavaScript:void(0);" class="sm_btn less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills</a>
                       

                    </div>
                </div>
                </p>
                <?php if (isset($Job_detail) and !empty($Job_detail)) { ?>
                    <a class="pull-right" href="<?php echo $this->webroot; ?>freelancer/viewJobPosting/<?php echo $Job_detail['Job']['id']; ?>"/>View Job Posting</a>
                <?php } ?>
                <?php if (isset($timeduration) and !empty($timeduration)) { ?>
                    <p> <i> <img src="<?php echo $this->webroot; ?>img/clock_new.png" alt="Clock new icon "> </i><?php echo $timeduration; ?> </p>
                <?php } ?>
                <p><?php if (isset($Job_detail) and !empty($Job_detail)) { ?>
                        <span> <strong>Fixed Price  :</strong> <?php echo '$' . $Job_detail['Job']['budget']; ?> Budget </span> 
                    <?php } ?>
                    <?php if (isset($InvitationSent) and !empty($InvitationSent)) { ?>
                        <span class="pull-right">Deliver by : <?php echo date('d-M-Y', strtotime($InvitationSent['Contect']['created'])); ?></span>
                    <?php } ?>
                </p>
                <div class="drop_text marg_t35">
                    <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div id="headingOne" role="tab" class="panel-heading padd_0">
                                <h4 class="panel-title green">
                                    <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOnee" data-parent="#accordion" data-toggle="collapse">
                                        <i class="marg_r10"><img alt="Accordian image" src="<?php echo $this->webroot; ?>img/accordian.png"></i>Job Description
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="collapseOnee">
                                <?php if (isset($Job_detail) and !empty($Job_detail)) { ?>
                                    <div class="panel-body text_1 lesval">
                                        <p>
                                            <?php echo substr($Job_detail['Job']['description'], 0, 150) . '........'; ?>
                                            <a href="JavaScript:void(0);" class="more">More</a>
                                        </p>
                                    </div>
                                    <div class="panel-body text_1 moreval hide">
                                        <p>
                                            <?php echo $Job_detail['Job']['description']; ?>
                                            <a href="JavaScript:void(0);" class="less">Less</a>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="drop_text marg_t35">
                    <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div id="headingOnee" role="tab" class="panel-heading padd_0">
                                <h4 class="panel-title green">
                                    <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
                                        <i class="marg_r10"><img alt="Accordian image" src="<?php echo $this->webroot; ?>img/accordian.png">
                                        </i>Message from Client
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="collapseOne">
                                <?php if (isset($InvitationSent) and !empty($InvitationSent)) { ?>
                                    <div class="panel-body text_1">
                                        <?php echo nl2br($InvitationSent['Contect']['messages']); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="job_right">

            <div class="well bg_none">
                <h4 class="bg_greyd">Invitation to interview</h4>
                <?php if (isset($Client) and !empty($Client)) { ?>
                    <p class="pad_lzero"><strong>Client Name : </strong> <?php echo ucfirst($Client['User']['first_name']) . '  ' . ucfirst($Client['User']['last_name']); ?>  </p><?php } ?>
                <font>Are you interested in doing job ?</font>
                <button data-target="#myModal" data-toggle="modal" class="btn btn_red1 btn-block margg_t20 btn_new" type="button">Yes , Accept interview</button>                <h5><a href="#"  data-target="#myModal_new" data-toggle="modal">Decline</a></h5>
                <h4 class="pad_lzero">About Client</h4> 
                <div class="clearfix"></div>
                <div class="bg_reyy1">
                    <div class="pad_lzero deatil_info">
                        <?php if (isset($Client) and !empty($Client)) { ?>
                            <span><?php echo ucfirst($Client['User']['first_name']) . '  ' . ucfirst($Client['User']['last_name']); ?></span>
                        <?php } ?>
                        <hr class="brder_bttm">
                        <?php if (isset($Client_country) and !empty($Client_country)) { ?>
                            <span><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location icon image"/><?php echo $Client_country['Country']['name']; ?></span> 
                        <?php } else { ?>
                            <span><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location icon image"/>No Country Added</span> 
                        <?php } ?>

                        <hr class="brder_bttm"> Member since <?php echo date('M-d-Y', strtotime($Client['User']['created'])); ?>
                    </div>
                    <div class="clearfix"></div>     
                </div>   <br>
<!--                <a class="text-center margg_t20" href="#">
                    Payment method not verified
                </a>-->
                <p class="pad_lzero marg_t5">
                   <?php  
                   if(!empty($Feedback)){
                   $number = number_format($Feedback['Projectfeedback']['score']);
                   for($i=0;$i<=$number;$i++){
                   ?> 
                    <img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"> 
                   <?php } }else{  echo '<b>No any feedback to this client !</b>'; }?>
<!--                    <br/>-->
                    <?php 
                    if(!empty($Review_client)){
                        echo '('.$Review_client.' reviews)';
                    }else{
                        echo '0 reviews';
                    } ?>
               </p>
            </div><br/>
            <div class="col-md-12">
                <div class=" hre_details">
                    <div class="pad_lzero">
                        <?php if (!empty($pay)) { ?>
                            Total Spent <span class="pull-right"><?php echo $pay; ?></span>
                        <?php } else { ?>
                            Total Spent <span class="pull-right">0</span>
                        <?php } ?>
                        <hr class="brder_bttm1">
                        <?php if (!empty($Job_count)) { ?>
                            Job Posted<span class="pull-right"><?php echo $Job_count; ?></span>
                        <?php } else { ?>
                            Job Posted <span class="pull-right">0</span>
                        <?php } ?>
                        <hr class="brder_bttm1">
                        <?php if (!empty($hire_count)) { ?>
                            Hire<span class="pull-right"><?php echo $hire_count; ?></span>
                        <?php } else { ?>
                            Hire<span class="pull-right">0</span>
                        <?php } ?>
                        <hr class="brder_bttm1">
                        <?php if (!empty($job_count)) { 
                            ?>
                            OpenJobs <span class="pull-right"><?php echo $job_count; ?></span>
                        <?php } else { ?>
                            OpenJobs<span class="pull-right">0</span>
                        <?php } ?>
                        <hr class="brder_bttm1">

                    </div>
                    <p class="marg_t35 pad_lzero">
<!--                        <strong>Activity for this job</strong>-->
                    </p>

                </div>





            </div><!--job_right1-->
        </div><!--col-md-12-->
    </div>
</div>

<div class="modal fade cust_moadl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Accept Interview</h4>
            </div>
            <div class="modal-body">
                <p class="text_cust">
                    Accept an interview for this job by replying and proposing terms. After you click Done, this Invitation to Interview will become an "Active Interview". You will discuss the job and the client will decide whether to hire you.
                </p>

                <?php echo $this->Form->create('Acceptinterview', array('class' => 'apply_jobform form_new_cust marg_t35', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'applicants/' . $Job_detail['Job']['id']))) ?>       

                <!--                <form class="apply_jobform form_new_cust marg_t35" role="form">-->
                <div class="row">
                    <label class="col-sm-3">Apply As</label>
                    <div class="col-sm-9">
                        <label class="radio">
                            <?php if (isset($free_id) and !empty($free_id)) { ?>
                                <label>
                                    <input type="radio" value="<?php echo $free_id; ?>" id="inlineRadio1" name="data[Acceptinterview][freelancer_id]">apply for yourself
                                </label>
                            <?php } else { ?>
                                <label>
                                    <input type="radio" value="<?php echo $free_id; ?>" id="inlineRadio1" name="data[Acceptinterview][freelancer_id]">apply for yourself
                                </label>
                            <?php } ?>
                        </label>

                    </div>
                </div>
                <div class="row marg_btm30">
                    <label class="col-sm-3">Message to Client</label>
                    <div class="col-sm-9">
                        <textarea class="col-md-9" rows="5"  name="data[Acceptinterview][message]" class="textdata"></textarea>
                        <div class="clearfix"></div>
                        <p class="text-right col-md-9 pad_r0  font_14">500 characters left</p>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3">Propose Terms</label>
                    <div class="col-sm-7">
                        <div class="bg_grey1 margin_zero">
                            <div class="row">
                                <div class="col-md-4">Bid</div>
                                <div class="col-md-8">
                                    <font class="pull-left mrg_r5">$</font>
                                    <?php if (isset($budget) and !empty($budget)) { ?>
                                        <input type="text" placeholder="0.00" class="pull-left"  name="data[Acceptinterview][bid]"  value="<?php echo $budget; ?>"/>
                                    <?php } ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">You will earn</div>
                                <div class="col-md-8">
                                    <font class="pull-left mrg_r5">$</font>
                                    <?php if (isset($earn) and !empty($earn)) { ?>  
                                        <input type="text" placeholder="0.00" class="pull-left" name="data[Acceptinterview][earn]"   value="<?php echo $earn; ?>"/>
                                    <?php } ?>      
                                </div>
                            </div>
                            <br>
                        </div>
<!--                            <small class="marg_0 text-success">Client budget is $4500 US Dollars.</small>-->
                    </div>
                </div>
                <br>
                <div class="row marg_btm30">
                    <label class="col-sm-3">Estimated Duration</label>
                    <div class="col-sm-7">
                        <select class="form-control pull-left col-md-4" name="data[Acceptinterview][duration]">
                            <option value="">Please Select..........</option>
                            <option value="Less than 1 week">Less than 1 week</option>
                            <option  value="Less than 1 month">Less than 1 month</option>
                            <option value="1 to 3 months">1 to 3 months</option>
                            <option value="3 to 6 months">3 to 6 months</option>
                            <option value="More than  6 months"> More than  6 months
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12  text-center ">
                        <button class="btn-lg btn-green bvtn_green1 send_data" type="button" >Save</button>
                        <button data-dismiss="modal" class="btn-lg btn-green bvtn_green1  ">Close</button>

                    </div>
                </div>
                <!--                </form>-->
                <?php echo $this->Form->end(); ?>  

            </div>
        </div>
    </div>
</div>


<!--modal2 start -->
<div class="modal fade cust_moadl" id="myModal_new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Decline</h4>
            </div>
            <div class="modal-body">
                <p class="text_cust">We will politely notify the client you are not interested. </p>
                <?php echo $this->Form->create('Declinejob', array('class' => 'apply_jobform form_new_cust marg_t35', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'decline_jobs/' . $Job_detail['Job']['id']))); ?>
                <div class="row">
                    <label class="col-sm-3">Reason</label>
                    <div class="col-sm-9">
                        <label class="radio">
                            <label>
                                <input type="radio" value="Job is not a fit for my Skills" id="inlineRadio1" name="data[Declinejob][reason]">
                                Job is not a fit for my Skills
                            </label>
                        </label>
                        <label class="radio">
                            <label>
                                <input type="radio" value="Not intersted in work  described" id="inlineRadio1" name="data[Declinejob][reason]">
                                Not intersted in work  described</label>
                        </label>
                        <label class="radio">
                            <label>
                                <input type="radio" value="Too busy on other Projects" id="inlineRadio1" name="data[Declinejob][reason]">
                                Too busy on other Projects</label>
                        </label>
                        <label class="radio">
                            <label>
                                <input type="radio" value=" Client has too little jobider experience" id="inlineRadio1" name="data[Declinejob][reason]">
                                Client has too little jobider experience</label>
                        </label>
                        <label class="radio">
                            <label>
                                <input type="radio" value="Proposed rate or budget too low" id="inlineRadio1" name="data[Declinejob][reason]">
                                Proposed rate or budget too low </label>
                        </label>
                        <label class="radio">
                            <label>
                                <input type="radio" value="Spam" id="inlineRadio1" name="data[Declinejob][reason]">
                                Spam </label>
                        </label>
                        <label class="radio">
                            <label>
                                <input type="radio" value="Client asked  for free work" id="inlineRadio1" name="data[Declinejob][reason]">
                                Client asked  for free work</label>
                        </label>
                        <label class="radio">
                            <label>
                                <input type="radio" value="Client asked to work outside Jobider" id="inlineRadio1" name="data[Declinejob][reason]">
                                Client asked to work outside Jobider</label>
                        </label>

                    </div>
                </div>

                <div class="row marg_btm30">
                    <label class="col-sm-3"> Your Message</label>
                    <div class="col-sm-9">
                        <textarea class="col-md-9" rows="5" name="data[Declinejob][message]"></textarea>
                        <div class="clearfix"></div>
                        <p class="text-right col-md-9 pad_r0  font_14">500 characters left</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-md-12  text-center ">
                        <button class="btn-lg btn-green bvtn_green1  " type="submit">Decline</button>
                        <button data-dismiss="modal"   class="btn-lg btn-green bvtn_green1">Close</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<!--modal2 closed -->

<script>
    $(document).ready(function() {
        $(document).on('click', '.send_data', function() {
            var text = $('.textdata').val();
            if (text == '') {
                alert('Please enter your message !');
            } else {
                $('.send_data').attr('type', 'submit');
            }
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

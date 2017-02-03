<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($Job_detail) and !empty($Job_detail)){ ?>
                    <h3> <?php echo $Job_detail['Job']['job_title']; ?></h3>
                <?php } ?>
                <p>
                <div class="tabs_1 col-md-12 marg_t5" style="margin-bottom: 10px;">
                    <div class="col-md-10 colsm-10 less_skills ">
                        <?php
                        if (!empty($Subskill)) {
                            $total_skill = count($Subskill);
                            $j = 0;
                            foreach ($Subskill as $kk => $vv) {  ?>
                                <span class="sm_btn"><?php echo $vv['Subskill']['skill_name']; ?></span>                                   <?php
                                if ($j == '3') {
                                    break;
                                }$j++;
                                ?>  <?php  }
                        }
                        ?>
                        <?php if ($total_skill >= 5) { ?>
                            <a href="JavaScript:void(0);" class="sm_btn more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
<?php } ?>

                    </div>

                    <div class="col-md-10 colsm-10 more_skills hide ">
                        <?php
                        if (!empty($Subskill)) {
                            $total_skill = count($Subskill);
                            $j = 0;
                            foreach ($Subskill as $kk => $vv) {
                                ?>
   <span class="sm_btn"><?php echo $vv['Subskill']['skill_name']; ?></span>   
                                <?php
                                $j++;
                                ?>
                            <?php  }    }    ?>
                        <a href="JavaScript:void(0);" class="sm_btn less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills</a>
                    </div>
                </div>
                <a class="pull-right" href="<?php echo $this->webroot; ?>freelancer/viewJobPosting/<?php echo $Job_detail['Job']['id']; ?>">View Job Posting</a>
                </p>
                <p> <i> <img src="<?php echo $this->webroot; ?>img/clock_new.png"> </i>  <?php echo $TimeDuration; ?> </p>
                <p> <span> <strong>Fixed Price  :</strong><?php echo '$' . $Job_detail['Job']['budget']; ?>  Budget </span> <span class="pull-right">Deliver by : <?php echo date('d-M-Y', strtotime($Contect_info['Contect']['created'])); ?></span></p>
                <div class="drop_text marg_t35">
                    <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div id="headingOne" role="tab" class="panel-heading padd_0">
                                <h4 class="panel-title green">
                                    <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOnee" data-parent="#accordion" data-toggle="collapse">
                                        <i class="marg_r10"><img alt="Accrodian icon image" src="<?php echo $this->webroot; ?>img/accordian.png"></i>Job Description
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="collapseOnee">
                                <div class="panel-body text_1 lesval">
                                    <p><?php echo substr($Job_detail['Job']['description'], 0, 250) . '........'; ?>
                                        <a href="JavaScript:void(0);" class="more">more</a>
                                    </p>
                                </div>
                                <div class="panel-body text_1 moreval hide">
                                    <p>   <?php echo $Job_detail['Job']['description']; ?>
                                        <a href="JavaScript:void(0);" class="less">less</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="drop_text marg_t35">
                    <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div id="headingOne" role="tab" class="panel-heading padd_0">
                                <h4 class="panel-title green">
                                    <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOneee" data-parent="#accordion" data-toggle="collapse">
                                        <i class="marg_r10"><img alt="Accrodian icon image" src="<?php echo $this->webroot; ?>img/accordian.png"></i>Message from Client
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="collapseOneee" >
                                <div class="panel-body text_1">
<?php echo nl2br($Contect_info['Contect']['messages']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="drop_text marg_t35">
                    <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div id="headingOne" role="tab" class="panel-heading padd_0">
                                <h4 class="panel-title green">
                                    <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
                                        <i class="marg_r10"><img alt="Accrodian icon image"src="<?php echo $this->webroot; ?>img/accordian.png"></i>Message
                                    </a>
                                </h4>
                            </div>
                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="collapseOne">
                                    <?php echo $this->Form->create('Message', array('url' => array('controller' => 'freelancer', 'action' => 'job_application', $Job_detail['Job']['id']))); ?>
                                <div class="panel-body text_1">
                                    <?php
                                    if (isset($Messages) and !empty($Messages)) {
                                        foreach ($Messages as $key => $val) {
                                            if (array_key_exists('Message', $val)) {
                                                $date = date('M d,Y', strtotime($val['Message']['created']));
                                                $message = $val['Message']['reply'];
                                            }
                                            if (array_key_exists('Changeterm', $val)) {
                                                $date = date('M d,Y', strtotime($val['Changeterm']['created']));
                                                $message = $val['Changeterm']['message'];
                                            }
                                            ?> 
                                            <div class="detail  brder_btm padd_tb15">
                                                <div class="col-md-2 col-sm-2 pad_l0"> 
                                                    <div class="user_content pull-left">
                                                        <?php foreach ($val['users'] as $keey => $vval)
                                                            
                                                            ?>
                                                        <h4 class="marg_0 text-danger font_14"><?php echo ucfirst($vval['User']['first_name']) . '  ' . ucfirst($vval['User']['last_name']); ?></h4>
                                                        <small class="text_1"><?php echo $date; ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8">
                                                    <p class="text_1"><?php echo $message; ?></p>                                       </div>
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
                                                <textarea rows="5"  name="data[Message][reply]" class="text_area"></textarea>
                                            </div>
                                        </div>

                                    </div><div class="col-md-12 marg_tb50 pad_l0">
                                        <p>
                                            <button class="btn-lg btn-green1 sendbtn" type="button"> Send </button>
                                        </p>
                                    </div>
                                </div>

<?php echo $this->Form->end(); ?>
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
                <p class="pad_lzero"><strong>Client Name : </strong><?php echo ucfirst($Client_info['User']['first_name']) . '  ' . ucfirst($Client_info['User']['last_name']); ?></p>

                <h5 class="text-left pad_lzero font_16 tlft">Your proposed terms:</h5>
<?php if (empty($terms)) { ?>
    <?php if (!empty($Accept_values)) { ?>
                        <strong class="right_text"><?php echo ' $' . $Accept_values['Acceptinterview']['earn']; ?></strong>
                        <br>     

                        <span class="pull-right bid">Bid/Budget :<?php echo '  $' . $Accept_values['Acceptinterview']['bid']; ?>  charged to client</span>
    <?php } ?>
<?php } else { ?>
                    <strong class="right_text"><?php echo ' $' . $terms['Changeterm']['earn']; ?></strong>
                    <br>     

                    <span class="pull-right bid">Bid/Budget :<?php echo '  $' . $terms['Changeterm']['bid']; ?>  charged to client</span>
<?php } ?>
                <button class="btn btn_red1 btn-block margg_t20 btn_new" type="button" data-toggle="modal" data-target="#myModal">Propose Different Terms</button>
                <!--                <h5><a href="#">Withdraw Application | Archieve</a></h5>-->
                <h4 class="pad_lzero">About Client</h4> 
                <div class="clearfix"></div>
                <div class="bg_reyy1"> 
                    <div class="pad_lzero deatil_info">
                        <span><?php echo ucfirst($Client_info['User']['first_name']) . '  ' . ucfirst($Client_info['User']['last_name']); ?></span>

                        <hr class="brder_bttm">

                        <?php if (!empty($Country)) { ?>
                            <span><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location image icon"/><?php echo $Country['Country']['name']; ?></span> 
<?php } else { ?>
                            <span><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location dummy icon"/>No Country Added</span> 
<?php } ?>
                        <hr class="brder_bttm">
                        Member since <?php echo date('F d,Y', strtotime($Client_info['User']['created'])); ?>
                    </div>
                    <div class="clearfix"></div>     
                </div>   <br>

                <!--                <a class="text-center margg_t20" href="#">
                                    Payment method not verified
                                </a>-->
                <p class="pad_lzero marg_t5">
                    <?php
                    if (!empty($Feedback)) {
                        $number = number_format($Feedback['Projectfeedback']['score'], 0);
                        for ($i = 0; $i <= $number; $i++) {
                            ?>
                            <img src="<?php echo $this->webroot; ?>img/star.png" alt="Star image"> 
                            <?php
                        }
                    } else {
                        echo '<b>No any feedback to this Client ! </b>';
                    }
                    ?>&nbsp;&nbsp;
                    <?php
                    if (!empty($Review)) {
                        echo $Review . '  reviews';
                    } else {
                        echo '0  reviews';
                    }
                    ?>
                </p>
            </div> 
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
                        <?php if (!empty($job_count)) { ?>
                            OpenJobs<span class="pull-right"><?php echo $job_count; ?></span>
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
<!--Pop up -->

<div class="modal fade cust_moadl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Terms</h4>
            </div>
            <div class="modal-body">
<?php echo $this->Form->create('Changeterm', array('class' => 'apply_jobform form_new_cust marg_t35', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'job_applicants/' . $Accept_values['Acceptinterview']['job_id']))) ?>       
                <!--                <form class="apply_jobform form_new_cust marg_t35" role="form">-->

                <div class="row marg_btm30">
                    <label class="col-sm-3">Message to Client</label>
                    <div class="col-sm-9">
                        <textarea class="col-md-9" rows="5"  name="data[Changeterm][message]">I have changed the terms in this job application.</textarea>
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
<?php if (isset($Accept_values['Acceptinterview']['bid']) and !empty($Accept_values['Acceptinterview']['bid'])) { ?>
                                        <input type="text" placeholder="0.00" class="pull-left paid"  name="data[Changeterm][bid]"  value="<?php echo $Accept_values['Acceptinterview']['bid']; ?>"/>
<?php } ?>
                                </div>
                            </div>
                            <br> 
                            <div class="row">
                                <div class="col-md-4">You will earn</div>
                                <div class="col-md-8">
                                    <font class="pull-left mrg_r5">$</font>
<?php if (isset($Accept_values['Acceptinterview']['earn']) and !empty($Accept_values['Acceptinterview']['earn'])) { ?>  
                                        <input type="text" placeholder="0.00" class="pull-left tens" name="data[Changeterm][earn]"   value="<?php echo $Accept_values['Acceptinterview']['earn']; ?>"/>
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
<?php echo $this->Form->input('duration', array('type' => 'select', 'class' => 'form-control pull-left col-md-4', 'label' => false, 'options' => array('Less than 1 week' => 'Less than 1 week', 'Less than 1 month' => 'Less than 1 month', '1 to 3 months' => '1 to 3 months', '3 to 6 months' => '3 to 6 months', 'More than  6 months' => 'More than  6 months'), 'default' => $Accept_values['Acceptinterview']['duration'], '' => 'Please Select ......')) ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12  text-center ">
                        <button class="btn-lg btn-green bvtn_green1" type="submit" >Save</button>      <button data-dismiss="modal" class="btn-lg btn-green bvtn_green1  ">Close</button>

                    </div>
                </div>
                <!--                </form>-->
<?php echo $this->Form->end(); ?>  

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(document).on('click', '.sendbtn', function() {
            var text = $('.text_area').val();
            if (text == '') {
                alert('Please enter your message !');
                return false;
            } else {
                $('.sendbtn').attr('type', 'submit');
                return true;
            }
        });


        $('.paid').on('keyup', function() {
            var paid = $('.paid').val();
            var ten = paid / 8;
            var tens = parseInt(paid) - ten;
            if (tens > 10) {
                $('.tens').val(tens)
            } else {
                $('.tens').val(tens + '.00')
            }
            $('#tens1').val(ten);
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



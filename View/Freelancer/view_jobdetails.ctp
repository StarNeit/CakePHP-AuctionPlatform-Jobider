<div class="container">
    <hr class="brder_btm">
    <div class="col-md-12">
        <p><i><img class="mrg_r5" alt="Back to Search results" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $this->webroot; ?>freelancer/sentapplication">Back to Search Result</a> </p> </div>
    <?php if (!empty($jobdetail)) { ?>
        <div class="row marg_tb15">
            <div class="col-md-12">
            </div>
            <div class="col-md-8 col-sm-8 job_detail">
                <div class="bg_grey2">
                    <h3 class="marg_0"><?php echo $jobs['Job']['job_title']; ?></h3>
                    <div class="row">
  <div class="col-md-8 col-sm-4 offset cate">
    <h4 class="marg_btm30"><?php echo $category_name['Subcategory']['category_name']; ?> <small class="marg_l20"> <?php echo $jobdetail['Jobdetail']['time_duration'];?> - <a href="<?php echo $this->webroot; ?>freelancer/jobdetails/<?php echo $jobdetail['Jobdetail']['job_id']; ?>">View Job Posting</a></small></h4>
  </div>
</div>
                    <div class="row">
  <div class="col-md-4 subs">
    
    <h4 class="marg_btm30"><img src="<?php echo $this->webroot; ?>img/fixed.png" alt="Fixed image icon">  <?php echo $jobdet['Job']['pay_type'].' Price'; ?><p style="font-size: 11px; margin-left: 24px;">Delivered by <?php echo date('F d, Y',strtotime($jobdet['Job']['start_date'])); ?></p></h4>
  </div>
                        <div class="col-md-3 budg">
     <h4 class="marg_btm30"><img src="<?php echo $this->webroot; ?>img/dollar.png" alt="dollar icon image"> <?php echo '$'.$jobdet['Job']['budget']; ?> <p style="font-size: 11px; margin-left: 32px;">Budget</p></h4>
  </div>
  
</div>
                    
                          <div class="tabs_1 col-md-12">
                        <div class="col-md-12colsm-12 less_skills">
                    <?php
                    if (!empty($skills)) {
                        $total_skills = count($skills);
                        $j = 0;
                        foreach ($skills as $kk => $vv) {
                            ?> 
                            <button class="subskil" type="button"><?php echo $vv['Subskill']['skill_name']; ?></button>
                            <?php 
                            if($j>='3'){
                                break;
                            }$j++;
                            ?>
                            <?php
                        }
                   } if($total_skills>=5){?>
                         <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
                   <?php } ?>
                        </div>
                        
                          <div class="col-md-12colsm-12 more_skills hide">
                    <?php
                    if (!empty($skills)) {
                        $total_skills = count($skills);
                        $j = 0;
                        foreach ($skills as $kk => $vv) {
                            ?> 
                            <button class="subskil" type="button"><?php echo $vv['Subskill']['skill_name']; ?></button>
                            <?php 
                            $j++;
                            ?>
                            <?php
                        }
                   } ?>
                         <a href="JavaScript:void(0);" class="subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills</a>
                  
                        </div>
                        
                        
                    </div>      
                    <div class="clearfix"></div>
                </div>
                <h3>Job Description  </h3>
                <div class="col-md lesval">
                <p>Hello,
                    <br/><?php echo substr($jobdetail['Jobdetail']['cover_letter'],0,100).'........'; ?>
                    <a href="JavaScript:void(0);" class="more"> More</a>
                </p>
                </div>
                
                <div class="col-md moreval hide">
                    <p>Hello,
                        <br/><?php  echo $jobdetail['Jobdetail']['cover_letter']; ?>
                        <a href="JavaScript:void(0);" class="less">Less</a>
                    </p>
                </div>
                <div class="open_jobs marg_tb50">
                    <h3 class="text_1">Cover Letter</h3>
                    <?php foreach ($question as $q_key => $q_val) { ?>
                        <p><strong><?php echo $q_val; ?></strong> </p>
                        <?php foreach ($answer as $a_key => $a_val) { ?>
                            <p><?php
                                if ($q_key == $a_key) {
                                    echo $a_val;
                                }
                                ?>
                            </p>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="job_right">

                    <div class="well bg_none">
                        <p class="pad_lzero">Sent Job Application</p>

                        <h5 class="text-left pad_lzero font_16 tlft">Your proposed terms:</h5>
                        <?php if (!empty($changes['ChangeTerm']['bid'])) { ?>
                            <strong class="right_text"> <?php echo '$' . $changes['ChangeTerm']['bid']; ?></strong>
                        <?php } else { ?>
                            <strong class="right_text"> <?php echo '$' . $jobdetail['Jobdetail']['porpose_terms']; ?></strong>
                        <?php } ?>
                        <br>     
                        <?php if (!empty($changes['ChangeTerm']['earn'])) { ?>
                            <span class="pull-right bid">Bid/Budget :  <?php echo '$' . $changes['ChangeTerm']['earn']; ?>  charged to client</span>
                        <?php } else { ?>
                            <span class="pull-right bid">Bid/Budget :  <?php echo '$' . $jobdetail['Jobdetail']['earn_amount']; ?>  charged to client</span>
                        <?php } ?>
                        <button data-target="#myModal" data-toggle="modal" type="button" class="btn btn_red1 btn-block margg_t20 btn_new">Propose Different Terms</button>
                        <!--                <h5><a href="#">Withdraw Application | Archieve</a></h5>-->
                        <h4 class="pad_lzero">About Client</h4> 
                        <div class="clearfix"></div>
                        <div class="bg_reyy1"> 
                            <div class="pad_lzero deatil_info">
                                <span><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?></span>

                                <hr class="brder_bttm">


                                <span><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location image icon"><?php if (!empty($country)) {
                        echo $country['Country']['name'];
                    } else {
                        echo "No Country ";
                    } ?></span>  <hr class="brder_bttm">


                                Member since <?php echo date('M d, Y', strtotime($user['User']['created'])); ?>

                            </div>




                            <div class="clearfix"></div>     
                        </div>   <br>
                        <a href="#" class="text-center margg_t20">Payment method not verified</a>


                        <p class="pad_lzero marg_t5"><img alt="Rating image icon" src="<?php echo $this->webroot; ?>img/rating.png" > 0 reviews</p>

                    </div>




                    <div class="col-md-12">
                        <div class=" hre_details">

                            <div class="pad_lzero">
                                Total Spent <span class="pull-right">0</span>
                                <hr class="brder_bttm1">
    <?php if (!empty($count)) { ?>
                                    Job Posted<span class="pull-right"><?php echo $count; ?></span>
                                    <hr class="brder_bttm1">
                                <?php } else { ?>
                                    Job Posted<span class="pull-right">0</span>
                                    <hr class="brder_bttm1">
                                <?php } ?>
    <?php if (!empty($hire)) { ?>
                                    Hire<span class="pull-right"><?php echo $hire; ?></span>
                                    <hr class="brder_bttm1">
                                <?php } else { ?>
                                    Hire<span class="pull-right">0</span>
                                    <hr class="brder_bttm1">
                                <?php } ?>
    <?php if (!empty($counts)) { ?>
                                    OpenJobs<span class="pull-right"><?php echo $counts; ?></span>
                                    <hr class="brder_bttm1">
    <?php } else { ?>
                                    OpenJobs<span class="pull-right">0</span>
                                    <hr class="brder_bttm1">
    <?php } ?>
                            </div>
                            <p class="marg_t35 pad_lzero"><strong>Activity for this job</strong></p>

                        </div>

                    </div><!--job_right1-->
                </div><!--col-md-12-->

            </div>
        </div>
    <?php } else { ?>
        <div class="row marg_tb15">
            <p style="text-align: center; font-size:20px; padding: 100px; color: #C7C4C8"> <strong>Sorry</strong>, No Job Found</p>
        </div>
<?php } ?>

</div>

<div class="modal fade cust_moadl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Terms</h4>
            </div>
            <div class="modal-body">
<?php echo $this->Form->create('ChangeTerm', array('class' => 'apply_jobform form_new_cust marg_t35', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'change_terms/' . $jobdetail['Jobdetail']['job_id']))) ?>       
                <!--                <form class="apply_jobform form_new_cust marg_t35" role="form">-->

                <div class="row">
                    <label class="col-sm-3">Propose Terms</label>
                    <div class="col-sm-7">
                        <div class="bg_grey1 margin_zero">
                            <div class="row">
                                <div class="col-md-4">Bid</div>
                                <div class="col-md-8">
                                    <font class="pull-left mrg_r5">$</font>
<?php if (!empty($changes['ChangeTerm']['bid'])) { ?>
                                        <input type="text" placeholder="0.00" class="pull-left paid"  name="data[ChangeTerm][bid]"  value="<?php echo$changes['ChangeTerm']['bid']; ?>"/>                     
                                            <?php } else { ?>
                                        <input type="text" placeholder="0.00" class="pull-left paid"  name="data[ChangeTerm][bid]"  value="<?php echo $jobdetail['Jobdetail']['porpose_terms']; ?>"/>
<?php } ?>

                                </div>
                            </div>
                            <br> 
                            <div class="row">
                                <div class="col-md-4">You will earn</div>
                                <div class="col-md-8">
                                    <font class="pull-left mrg_r5">$</font>
<?php if (!empty($changes['ChangeTerm']['earn'])) { ?>
                                        <input type="text" placeholder="0.00" class="pull-left tens" name="data[ChangeTerm][earn]"   value="<?php echo $changes['ChangeTerm']['earn']; ?>"/>                                    <?php } else { ?>
                                        <input type="text" placeholder="0.00" class="pull-left tens" name="data[ChangeTerm][earn]"   value="<?php echo $jobdetail['Jobdetail']['earn_amount']; ?>"/> 
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
                        <?php  if(!empty($changes['ChangeTerm']['duration'])) {?>
<?php echo $this->Form->input('duration', array('type' => 'select', 'class' => 'form-control pull-left col-md-4', 'label' => false, 'options' => array('Less than 1 week' => 'Less than 1 week', 'Less than 1 month' => 'Less than 1 month', '1 to 3 months' => '1 to 3 months', '3 to 6 months' => '3 to 6 months', 'More than  6 months' => 'More than  6 months'), 'default' => $changes['ChangeTerm']['duration'], '' => 'Please Select ......')) ?>
                        <?php } else { ?>
                        <?php echo $this->Form->input('duration', array('type' => 'select', 'class' => 'form-control pull-left col-md-4', 'label' => false, 'options' => array('Less than 1 week' => 'Less than 1 week', 'Less than 1 month' => 'Less than 1 month', '1 to 3 months' => '1 to 3 months', '3 to 6 months' => '3 to 6 months', 'More than  6 months' => 'More than  6 months'), 'default' => $jobdetail['Jobdetail']['duration'], '' => 'Please Select ......')) ?>
                        <?php } ?>

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
    $(document).ready(function () {
        $('.paid').on('keyup', function () {
            var paid = $('.paid').val();
            var ten = paid / 8;
            var tens = parseInt(paid) - ten;
            var num = tens.toFixed(2);
            $('.tens').val(num)
            $('#tens1').val(ten);
        });
    });
</script>

<style>
    .subskil {
    background: none repeat scroll 0 0 #d2322d;
    border: 0 none;
    border-radius: 4px !important;
    color: #fff !important;
    float: left;
    margin: 2px !important;
    padding: 4px !important;
}
.subskil:hover {
    background: none repeat scroll 0 0 #d2322d;
}
.col-md-6.cate {
    margin-left: 14px;
    margin-top: 10px;
}
.col-md-4.subs {
    margin-top: -25px;
}
.col-md-3.budg {
    margin-top: -25px;
}
</style>


<script>
    $(document).ready(function(){
        $(document).on('click','.more_skill',function(){
            $(this).parent().next().removeClass('hide');
            $(this).parent().addClass('hide');
        });
        $(document).on('click','.less_skill',function(){
            $(this).parent().prev().removeClass('hide');
            $(this).parent().addClass('hide');
        });
        
    });
    
</script>
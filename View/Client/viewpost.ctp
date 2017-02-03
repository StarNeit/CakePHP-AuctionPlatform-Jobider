<style>
    .marg_0.client {
        margin-left: -26px;
    }
    .sub {
        margin-left: -26px;
    }
</style>

<div class="container">
    <?php if (!empty($Jobresult)) { ?>
        <div class="row marg_tb15">
            <div class="col-md-12">
                <p><i><img class="mrg_r5" alt="Back to search result" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $last_url; ?>">Back to Search Result</a></p>
            </div>
            <div class="col-md-8 col-sm-8 job_detail">
                <div class="bg_grey2">
                    <h3 class="marg_0"><?php echo $Jobresult['Job']['job_title']; ?>   </h3>
                    <div class="row">
                        <div class="col-md-8 col-sm-4 offset cate"><h4  class="marg_btm30"><?php echo $category['Subcategory']['category_name']; ?> <small class="marg_l20"> <?php echo $Jobresult['Job']['time_duration']; ?></small> </h4></div>
                    </div>
                    <div class="row">

                        <div class="col-md-4 subs">
                            <h4 class="marg_btm30">
                                <img src="<?php echo $this->webroot; ?>img/fixed.png" alt="Fixed"> <?php echo $Jobresult['Job']['pay_type'] . ' Price' ?><p style="font-size: 11px; margin-left: 24px;">Delivered by <?php echo date('F d,Y', strtotime($Jobresult['Job']['start_date'])); ?></p>
                            </h4>
                        </div>
                        <div class="col-md-3 budg">
                            <h4 class="marg_btm30">
                                <img src="<?php echo $this->webroot; ?>img/dollar.png" alt="dollar"> <?php echo '$' . $Jobresult['Job']['budget'] . '.00' ?> <p style="font-size: 11px; margin-left: 26px;">Budget</p>
                            </h4>
                        </div>

                    </div> 
                    <div class="tabs_1 col-md-12">
                        <div class="col-md-12colsm-12 less_skills"> 
                            <?php
                            if (!empty($skill)) {
                                $total_skills = count($skill);
                                $j = 0;
                                foreach ($skill as $kk => $vv) {
                                    ?> 
                                    <button class="subskil" type="button" ><?php echo $vv['Subskill']['skill_name']; ?></button>
                                    <?php
                                    if ($j == '2') {
                                        break;
                                    }$j++;
                                    ?>
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            if ( !empty($total_skills) && $total_skills >= 2) {
                                ?>
                                <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;border-color: #2A6EB3;">More Skills</a>                            
                            <?php }else{
                            ?>
                                <p style="font-size:20px;">You have added no skills</p>
                            <?php } ?>
                        </div>
                        
                          <div class="col-md-12colsm-12 more_skills hide"> 
                            <?php
                            if (!empty($skill)) {
                                $total_skills = count($skill);
                                $j = 0;
                                foreach ($skill as $kk => $vv) {
                                    ?> 
                                    <button class="subskil" type="button" ><?php echo $vv['Subskill']['skill_name']; ?></button>
                                    <?php
                                    $j++;
                                    ?>
                                    <?php
                                }
                            }
                            ?>
                          
                                <a href="JavaScript:void(0);" class="subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;border-color: #2A6EB3;">Less Skills</a>                            
                         
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <h3>Job Description  </h3>
                <div class="col-md lesval">
                    <p>Hello,
                        <br><?php echo substr($Jobresult['Job']['description'], 0, 300) . '....'; ?>   
                        <a href="JavaScript:void(0);" class="more" style="text-decoration:none" >more</a>
                    </p> 
                </div>
                <div class="col-md moreval hide">
                    <p>Hello,
                        <br><?php echo $Jobresult['Job']['description'] . '......'; ?>
                        <a href="JavaScript:void(0);" class="less" style="text-decoration:none">less</a>
                    </p> 
                </div>
                <div class="open_jobs marg_tb50">
                    <h3 class="text_1">Other open jobs by this client</h3>
                    <span class="text_3 font_18">Active Jobs </span>
                    <div class="clearfix"> </div> 
                    <p class="marg_tb15 count_more"> 
                        <?php
                        $total_count = count($OtherOpenJobs);
                        $i = 0;
                        if (isset($OtherOpenJobs) and !empty($OtherOpenJobs)) {
                            foreach ($OtherOpenJobs as $job) {
                                ?>
                                <a href="<?php echo $this->webroot; ?>client/viewpost/<?php echo $job['Job']['id'] ?>" style="text-decoration:none"/><?php echo $job['Job']['job_title']; ?></a><br>
                                <?php
                                $i++;
                                if ($i == 2) {
                                    break;
                                }
                            }
                            ?>
                            <a class="font_18 more_jobs" href="JavaScript:void(0);" >More...</a>
    <?php } else { ?>
                        <p> No other Open jobs !</p>
                        <?php } ?>
                    </p>

                    <p class="marg_tb15 count_less hide "> 
                        <?php
                        $total_count = count($OtherOpenJobs);
                        $i = 0;
                        foreach ($OtherOpenJobs as $job) {
                            ?>
                            <a href="<?php echo $this->webroot; ?>client/viewpost/<?php echo $job['Job']['id'] ?>" style="text-decoration:none"><?php echo $job['Job']['job_title']; ?></a><br>
        <?php $i++;
    }
    ?>
                        <a class="font_18 less_jobs" href="JavaScript:void(0);" >Less...</a>
                    </p>


                </div>
            </div> 

            <div class="col-md-4 col-sm-4 pad_r0">
    <?php echo $this->Form->create('Job', array('url' => array('controller' => 'freelancer', 'action' => 'applyjob/' . $_SESSION['job_id']))); ?>
                            <?php echo $this->Form->end(); ?>
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Job Overview </div>
                    <div class="panel-body bg_grey1 padd_0 bg_content">
                        <div class="col-md-6 col-xs-6">Budget</div>
                        <div class="col-md-6 col-xs-6">
    <?php echo '$' . $Jobresult['Job']['budget'] . '.00'; ?>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            Posted </div><div class="col-md-6 col-xs-6"> <?php echo date('M d Y,h:i A', strtotime($Jobresult['Job']['created'])); ?></div>
                        <div class="col-md-6 col-xs-6">
                            Planned Start </div><div class="col-md-6 col-xs-6"><?php echo $date = date('F d Y', strtotime($Jobresult['Job']['start_date'])); ?></div>
                        <div class="col-md-6 col-xs-6"> Duration   </div>
                        <div class="col-md-6 col-xs-6"> <?php echo $Jobresult['Job']['duration']; ?></div>
                        <div class="col-md-6 col-xs-6">
                            Category
                        </div>
                        <div class="col-md-6 col-xs-6"> 
                            <?php echo $category_data['Category']['name']; ?>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            Sub-category
                        </div>
                        <div class="col-md-6 col-xs-6"> 
                <?php echo $subcategory_data['Subcategory']['category_name']; ?>
                        </div> 
                    </div>
                </div>
    <?php
    // pr($clientinfo);
//            die;
    ?>
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">About the client </div>
                    <div class="panel-body bg_grey1 padd_0 bg_content">
                        <div class="col-md-5 col-xs-6">
                            <ul class="list-inline marg_0">
                                <?php
                                if (!empty($feedback)) {
                                    $avgscor = number_format($feedback['Projectfeedback']['score'], 0);
                                    for ($n = 1; $n <= $avgscor; $n++) {
                                        ?>
                                        <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                <?php } ?>
                            <?php } else { ?>
                                    <li></li>
                                <?php } ?>


                            </ul>
                            <?php if (!empty($feedback)) { ?>
                                <span>(<?php number_format($feedback['Projectfeedback']['score'], 1); ?>) <?php
                                if ($counts > 1) {
                                    echo $counts . 'reviews';
                                } else {
                                    echo $counts . " review";
                                }
                                ?></span>
                            <?php } else { ?>
                                <span>(0.00) 0 review</span>
    <?php } ?>
                        </div>
                        <div class="col-md-7 font_16">
                            <?php if (isset($country_name) and !empty($country_name)) { ?>
                                <i class="mrg_r5"><img alt="location" src="<?php echo $this->webroot; ?>img/location1.png"></i><?php echo $country_name['Country']['name']; ?>
                            <?php } else { ?>
                                <i class="mrg_r5"><img alt="location" src="<?php echo $this->webroot; ?>img/location1.png"></i>No Country added yet !
    <?php } ?> </div>
                        <div class="clearfix"></div>
                        <span class="col-md-12 padd_tb15 font_16 text-muted"> <?php
                        if (!empty($clientinfo['User'])) {
                            echo 'Member since ' . date('M d Y', strtotime($clientinfo['User']['created']));
                        } else {
                            echo 'Member since May 12 2012';
                        }
                        ?>
                        </span>
                        <div class="col-md-6 col-xs-6">
                    <?php if (!empty($pay)) { ?>
                                Total Spent</div><div class="col-md-6 col-xs-6"><?php echo '$' . $pay . '.00'; ?></div>
    <?php } else { ?>
                            Total Spent</div><div class="col-md-6 col-xs-6">$0.00</div>
    <?php } ?>
                    <div class="col-md-6 col-xs-6">
                        Jobs Posted </div>
                    <?php if (isset($count) and !empty($count)) { ?>
                        <div class="col-md-6 col-xs-6"> <?php echo $count; ?></div>
                    <?php } else { ?>
                        <div class="col-md-6 col-xs-6">0</div>
    <?php } ?>
                    <div class="col-md-6 col-xs-6">
                        Hires </div>
                        <?php if(!empty($hire_count)){ ?>
                        <div class="col-md-6 col-xs-6"><?php echo $hire_count; ?></div>
                        <?php } else { ?>
                          <div class="col-md-6 col-xs-6">0</div>
                        <?php } ?>
                    <div class="col-md-6 col-xs-6">
                        Open Jobs</div>
    <?php if (isset($open_jobs) and !empty($open_jobs)) { ?>
                        <div class="col-md-6 col-xs-6"><?php echo $open_jobs; ?></div>
    <?php } else { ?>
                        <div class="col-md-6 col-xs-6">0</div>
    <?php } ?>
                </div>
            </div>
        </div> 

    </div>
<?php } else { ?>
    <div class="row marg_tb15">
        <div class="col-md-12">
            <p><i><img class="mrg_r5" alt="BAck to Search" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $this->webroot; ?>client/postedJobs">Back to Search Result</a></p>
        </div>
        <p style="font-size:20px;color: #C7CBD6;"> The Job Cannot Be Found</p>;

        <div class="col-md-4 col-sm-4 pad_r0" style="padding: 100px">

        </div> 

    </div>
<?php } ?>

</div>


<script>
    $(document).ready(function() {
        $(document).on('click', '.more_jobs', function() {
            //alert('hello');
            $('.count_more').addClass('hide');
            $('.count_less').removeClass('hide');
        });
        $(document).on('click', '.less_jobs', function() {
            //alert('hello');
            $('.count_more').removeClass('hide');
            $('.count_less').addClass('hide');
        });
    })
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


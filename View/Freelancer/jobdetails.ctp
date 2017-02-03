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
                <p><i><img src="<?php echo $this->webroot; ?>img/back.png" alt="Back icon image" class="mrg_r5"></i><a class="font_18" href="<?php echo $last_url; ?>">Back to Search Result</a> </p> </div>
            <div class="col-md-8 col-sm-8 job_detail">
                <div class="bg_grey2">
                    <h3 class="marg_0"><?php echo $Jobresult['Job']['job_title']; ?> </h3>
                    <div class="row">
                        <div class="col-md-8 col-sm-4 offset cate">
                            <h4 class="marg_btm30"><?php echo $subcategory_data['Subcategory']['category_name']; ?> <small class="marg_l20"><?php echo $Jobresult['Job']['time_duration']; ?> </small></h4>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 subs">
                            <h4 class="marg_btm30">
                                <img src="<?php echo $this->webroot; ?>img/fixed.png" alt="fixed image icon"> <?php echo $Jobresult['Job']['pay_type'] . ' Price' ?><p style="font-size: 11px; margin-left: 24px;">Delivered by <?php echo date('F d,Y', strtotime($Jobresult['Job']['start_date'])); ?></p>
                            </h4>
                        </div>
                        <div class="col-md-3 budg">
                            <h4 class="marg_btm30">
                                <img src="<?php echo $this->webroot; ?>img/dollar.png" alt="dollar image icon"> <?php echo '$' . $Jobresult['Job']['budget'] . '.00' ?> <p style="font-size: 11px; margin-left: 26px;">Budget</p>
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
                                    <button class="subskil" type="button"><?php echo $vv['Subskill']['skill_name']; ?></button>
                                    <?php
                                    if ($j == '3') {
                                        break;
                                    }$j++;
                                    ?>
                                    <?php
                                }
                            } if ($total_skills >= 5) {
                                ?>
                                <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
                            <?php } ?>
                        </div>

                        <div class="col-md-12colsm-12 more_skills hide">
                            <?php
                            if (!empty($skill)) {
                                $total_skills = count($skill);
                                $j = 0;
                                foreach ($skill as $kk => $vv) {
                                    ?> 
                                    <button class="subskil" type="button"><?php echo $vv['Subskill']['skill_name']; ?></button>
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
                    <div class="clearfix"></div>
                </div>
                <h3>Job Description  </h3>
                <div class="col-md lesval">
                    <p>Hello,
                        <br><?php echo substr($Jobresult['Job']['description'], 0, 150) . '....'; ?>
                        <a href="JavaScript:void(0);" class="more" style="text-decoration:none" >more</a>
                    </p> 
                </div>
                <div class="col-md moreval hide">
                    <p>Hello,
                        <br><?php echo $Jobresult['Job']['description']; ?>
                        <a href="JavaScript:void(0);" class="less" style="text-decoration:none">less</a>
                    </p> 
                </div>


                <div class="open_jobs marg_tb50">
                    <h3 class="text_1">Other open jobs by this client</h3>
                    <span class="text_3 font_18">Active Jobs </span>
                    <div class="clearfix"> </div> 
                    <?php if (!empty($OtherOpenJobs)) { ?>
                        <p class="marg_tb15  count_more"> 
                            <?php
                            $i = 0;
                            foreach ($OtherOpenJobs as $job) {
                                ?>
                                <a href="<?php echo $this->webroot; ?>freelancer/jobdetails/<?php echo $job['Job']['id'] ?>"><?php echo $job['Job']['job_title']; ?></a><br>
                                <?php
                                $i++;
                                if ($i == 3) {
                                    break;
                                }
                            }
                            ?>
                            <a class="font_18 more_jobs " href="JavaScript:void(0);">More...</a>
                        </p><?php } else { ?>
                        <p style="padding:10px;">No other open job(s) Found !</p>
                    <?php } ?>
                    <?php if (!empty($OtherOpenJobs)) { ?>
                        <p class="marg_tb15  count_less hide"> 
                            <?php
                            $i = 0;
                            foreach ($OtherOpenJobs as $job) {
                                ?>
                                <a href="<?php echo $this->webroot; ?>freelancer/jobdetails/<?php echo $job['Job']['id'] ?>"><?php echo $job['Job']['job_title']; ?></a><br>
                            <?php } ?>
                            <a class="font_18 less_jobs " href="JavaScript:void(0);">Less...</a>
                        </p>
                    <?php } else { ?>
                        <p class="hide" style="padding:10px;">No Other open job(s) Found !</p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 pad_r0">
              <?php  //pr($job_detail);?>
                <?php if (!empty($job_detail)) { ?>
                    <?php echo $this->Form->create('Job', array('url' => array('controller' => 'freelancer', 'action' => 'applyjob/' . $_SESSION['job_id']))); ?>
                    <button class="btn-lg btn-green btn-block marg_btm30" disabled>Already Applied </button>
                    <?php echo $this->Form->end(); ?>
                <?php } else { ?>
                    <?php echo $this->Form->create('Job', array('url' => array('controller' => 'freelancer', 'action' => 'applyjob/' . $_SESSION['job_id']))); ?>
                    <button class="btn-lg btn-green btn-block marg_btm30">Apply to this job</button>
                    <?php echo $this->Form->end(); ?>
                <?php } ?>
                <?php // pr($users);   ?>
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Client Profile Image </div>
                    <div class="panel-body bg_grey1 padd_0">
                        <div class="col-md-3 col-sm-4 col-xs-4 marg_tb15">

                            <?php if (!empty($users['User']['image'])) { ?>
                                <input type="hidden" name="data[User][image]" value="<?php echo $users['User']['image']; ?>" id="userimage">
                                <img alt="login user image"  width='52' height='48' src="<?php echo $this->webroot; ?>uploads/<?php echo $users['User']['image']; ?>">
                            <?php } else { ?> <input type="hidden" name="data[User][image]" value="<?php echo $users['User']['image']; ?>" id="userimage">
                                <img alt="dummy user image"  width='52' height='48' src="<?php echo $this->webroot; ?>img/user_1.png">   
                            <?php } ?>
                        </div>
                        <div class="col-md-9 col-sm-8 marg_tb15">
                            <h4 class="marg_0 client"><?php echo ucfirst($users['User']['first_name']) . ' ' . ucfirst($users['User']['last_name']); ?></h4>
                            <p class='sub'><i><img alt="edit image icon" class="mrg_r5 editimage" src="<?php echo $this->webroot; ?>img/edit.png"></i><a class="font_12 editimage" href="<?php echo $this->webroot; ?>freelancer/client_profile/<?php echo $users['User']['id']; ?>" class="viewprofile">View  Profile</a></p>                    </div>
                        <div class="clearfix"></div>
                        <div class="brder_btm"></div>

                    </div>
                </div>
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Job Overview </div>
                    <div class="panel-body bg_grey1 padd_0 bg_content">
                        <div class="col-md-6">Budget</div>
                        <div class="col-md-6">
                            <?php echo '$' . $Jobresult['Job']['budget']; ?></div>
                        <div class="col-md-6">
                            Posted </div><div class="col-md-6"> <?php echo date('M d Y,h:i A', strtotime($Jobresult['Job']['created'])); ?></div>
                        <div class="col-md-6">
                            Planned Start </div><div class="col-md-6"><?php echo $date = date('F d Y', strtotime($Jobresult['Job']['start_date'])); ?></div>
                        <div class="col-md-6">
                            Duration   </div><div class="col-md-6"> <?php echo $Jobresult['Job']['duration']; ?></div>
                        <div class="col-md-6">
                            Category
                        </div>
                        <div class="col-md-6"> 
                            <?php echo $category_data['Category']['name']; ?>
                        </div>
                        <div class="col-md-6">
                            Sub-category
                        </div>
                        <div class="col-md-6"> 
                            <?php echo $subcategory_data['Subcategory']['category_name']; ?>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">About the client </div>
                    <div class="panel-body bg_grey1 padd_0 bg_content">
                        <div class="col-md-5">
                            <?php if (!empty($feedback)) { ?>
                                <ul class="list-inline marg_0">
                                    <?php
                                    $score = number_format($feedback['Projectfeedback']['score'], 0);
                                    for ($n = 1; $n <= $score; $n++) {
                                        ?>
                                        <li><img alt="star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                <ul class="list-inline marg_0">
                                    <li></li>

                                </ul>
                            <?php } ?>
                            <?php if (!empty($feedback)) { ?>
                                <span><?php echo '('.$feedback['Projectfeedback']['score'].')'; ?> <?php if(!empty($Reviews)){ echo $Reviews.' reviews';}else{ echo '0 reviews'; } ?>   </span>
                            <?php } else { ?>
                                <span><?php  echo '(0.00) 0 reviews'; ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-md-7 font_16">
                        <?php if (isset($client_country) and !empty($client_country)) { ?>
                                <i class="mrg_r5"><img alt="location image icon" src="<?php echo $this->webroot; ?>img/location1.png"></i><?php echo $client_country['Country']['name']; ?>
                            <?php } else { ?>
                                <i class="mrg_r5"><img alt="location image" src="<?php echo $this->webroot; ?>img/location1.png"></i><?php  echo 'No Country added yet !';?>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <span class="col-md-12 padd_tb15 font_16 text-muted">Member since <?php echo date('M d Y', strtotime($users['User']['created'])); ?> </span>
                        <div class="col-md-6">
                            Total Spent</div><div class="col-md-6"> <?php
                            if (!empty($pay)) {
                                echo ' Over $' . $pay;
                            } else {
                                echo'Over $0.00';
                            }
                            ?></div>
                        <div class="col-md-6">
                            Jobs Posted </div>
                        <?php if (isset($count_job) and !empty($count_job)) { ?>
                            <div class="col-md-6"><?php echo $count_job; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6"> <?php echo '0'; ?></div>
    <?php } ?>
                        <div class="col-md-6">
                            Hires </div>
                        <?php if (isset($Hired_users) and !empty($Hired_users)) { ?>
                            <div class="col-md-6"><?php echo $Hired_users; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6"><?php echo '0'; ?></div>
    <?php } ?>
                        <div class="col-md-6">
                            Open Jobs</div>
                        <?php if (isset($open_jobs) and !empty($open_jobs)) { ?>
                            <div class="col-md-6"><?php echo $open_jobs; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6"><?php echo '0'; ?></div>
    <?php } ?>
                    </div>
                </div>
            </div> 
        </div>
<?php } else { ?>
        <div class="row marg_tb15">
            <p style="text-align: center; font-size:20px; padding: 100px; color: #C7C4C8"> <strong>Sorry</strong>, No Data Found</p>
        </div>
<?php } ?>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.more_jobs', function() {
            $('.count_less').removeClass('hide');
            $('.count_more').addClass('hide');
        });
        $(document).on('click', '.less_jobs', function() {
            $('.count_less').addClass('hide');
            $('.count_more').removeClass('hide');
        });
        var image = $('#userimage').val();
        if (image == '') {
            $('.editimage').hide();
        } else {
            return true;
        }
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
    $(document).ready(function() {
        $(document).on('click', '.more_skill', function() {
            $(this).parent().next().removeClass('hide');
            $(this).parent().addClass('hide');
        });

        $(document).ready(function() {
            $(document).on('click', '.less_skill', function() {
                $(this).parent().prev().removeClass('hide');
                $(this).parent().addClass('hide');
            });
        });



    });





</script>

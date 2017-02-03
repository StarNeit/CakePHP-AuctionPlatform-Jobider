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
                <p><i><img src="/img/back.png" alt="Back to result" class="mrg_r5"></i><a class="font_18" href="<?php echo $last_url; ?>">Back to Search Result</a> </p> </div>
            <div class="col-md-8 col-sm-8 job_detail">
                <div class="bg_grey2">
                    <h3 class="marg_0"><?php echo $Jobresult['Job']['job_title']; ?> </h3>
                    <h4 class="marg_btm30">Est. Budget : <?php echo $Jobresult['Job']['budget']; ?> <small class="marg_l20" style="font-size:15px;"> <?php echo $Jobresult['Job']['time_duration']; ?></small>   </h4>     
                    <h5 class="marg_0"> Skills required</h5>
                    <?php
                    if (!empty($skill) and isset($skill)) {
                        foreach ($skill as $kk => $vv) {
                            ?> 
                            <button class="btn btn-danger btn_red3 marg_tb15" type="button"><?php echo $vv['Subskill']['skill_name']; ?></button>
                            <?php
                        }
                    } else {
                        ?>
                        <p style="margin-left:150px"> No Skill(s) selected !</p>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
                <h3>Job Description  </h3>
                <p>Hello,
                    <br><?php echo $Jobresult['Job']['description']; ?>
                </p> 
                <div class="open_jobs marg_tb50">
                    <h3 class="text_1">Other open jobs by this client</h3>
                    <span class="text_3 font_18">Active Jobs </span>
                    <div class="clearfix"> </div> 
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
                    </p>
                    <p class="marg_tb15  count_less hide"> 
                        <?php
                        $i = 0;
                        foreach ($OtherOpenJobs as $job) {
                            ?>
                            <a href="<?php echo $this->webroot; ?>freelancer/jobdetails/<?php echo $job['Job']['id'] ?>"><?php echo $job['Job']['job_title']; ?></a><br>
                        <?php } ?>
                        <a class="font_18 less_jobs " href="JavaScript:void(0);">Less...</a>
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 pad_r0">
              
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
                            <h4 class="marg_0 client"><?php echo $users['User']['first_name'] . ' ' . $users['User']['last_name']; ?></h4>
                            <p class='sub'><i><img alt="Edit image icon" class="mrg_r5 editimage" src="<?php echo $this->webroot; ?>img/edit.png"></i><a class="font_12 editimage" href="<?php echo $this->webroot; ?>freelancer/client_profile/<?php echo $users['User']['id']; ?>" class="viewprofile">View  Profile</a></p>                    </div>
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
                            <ul class="list-inline marg_0">
                                <li><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                <li><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                            <li><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                <li><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                <li><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                            </ul>
                            <span>(5.00) 4 reviews</span>
                        </div>
                        <div class="col-md-7 font_16">
                            <?php if (isset($client_country) and !empty($client_country)) { ?>
                                <i class="mrg_r5"><img alt="" src="<?php echo $this->webroot; ?>img/location1.png" alt="location image icon"></i><?php echo $client_country['Country']['name']; ?>
                            <?php } else { ?>
                                <i class="mrg_r5"><img alt="location image icon" src="<?php echo $this->webroot; ?>img/location1.png"></i>Brazil
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <span class="col-md-12 padd_tb15 font_16 text-muted">Member since <?php echo date('M d Y', strtotime($users['User']['created'])); ?> </span>
                        <div class="col-md-6">
                            Total Spent</div><div class="col-md-6">Over <?php echo '$' . $pay; ?></div>
                        <div class="col-md-6">
                            Jobs Posted </div>
                        <?php if (isset($count_job) and !empty($count_job)) { ?>
                            <div class="col-md-6"><?php echo $count_job; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6"> 0</div>
                        <?php } ?>
                        <div class="col-md-6">
                            Hires </div>
                        <?php if (isset($Hired_users) and !empty($Hired_users)) { ?>
                            <div class="col-md-6"><?php  echo $Hired_users;?></div>
                        <?php } else { ?>
                            <div class="col-md-6">0</div>
                        <?php } ?>
                        <div class="col-md-6">
                            Open Jobs</div>
                        <?php if (isset($count_job) and !empty($count_job)) { ?>
                            <div class="col-md-6"><?php echo $count_job; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6">0</div>
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
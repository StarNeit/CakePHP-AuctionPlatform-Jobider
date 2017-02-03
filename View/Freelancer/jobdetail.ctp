<div class="container">
    <?php if (!empty($Jobresult)) { ?>
        <div class="row marg_tb15">
            <div class="col-md-12">
                <p><i><img class="mrg_r5" alt="Back image" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $last_url; ?>">Back to Search Result</a></p>
            </div>
            <div class="col-md-8 col-sm-8 job_detail">
                <div class="bg_grey2">
                    <h3 class="marg_0"><?php echo $Jobresult['Job']['job_title']; ?> </h3>
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="marg_btm30">
                                <img src="<?php echo $this->webroot; ?>img/fixed.png" alt="fixed image"> <?php echo $Jobresult['Job']['pay_type'] . ' Price' ?><p style="font-size: 11px; margin-left: 24px;">Delivered by <?php echo date('F d,Y', strtotime($Jobresult['Job']['start_date'])); ?></p>
                            </h4>
                        </div>
                        <div class="col-md-3">
                            <h4 class="marg_btm30">
                                <img src="<?php echo $this->webroot; ?>img/dollar.png" alt="dollar icon image"> <?php echo '$' . $Jobresult['Job']['budget'] . '.00' ?> <p style="font-size: 11px; margin-left: 26px;">Budget</p>
                            </h4>
                        </div>

                    </div>
                    <div class="tabs_1 col-md-12">
                        <div class="col-md-12colsm-12 less_skills">
                            <h5 class="marg_0">Skills required</h5>
                            <?php
                            if (!empty($skill)) {
                                $total_skills = count($skill);
                                $j = 0;
                                foreach ($skill as $kk => $vv) {
                                    ?> 
                                    <button class="btn btn-danger btn_red3 marg_tb15" type="button"><?php echo $vv['Subskill']['skill_name']; ?></button>
                                    <?php
                                    if ($j == '3') {
                                        break;
                                    }
                                    $j++;
                                    ?>
                                    <?php
                                }
                            }
                            if ($total_skills >= 3) {
                                ?>
                                <a href="JavaScript:void(0);" class="btn btn-danger btn_red3 marg_tb15 more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;border-color: #2A6EB3;">More Skills</a> 

                            <?php } ?>
                        </div>

                        <div class="col-md-12colsm-12 more_skills hide">
                            <h5 class="marg_0">Skills required</h5>
                            <?php
                            if (!empty($skill)) {
                                $total_skills = count($skill);
                                $j = 0;
                                foreach ($skill as $kk => $vv) {
                                    ?> 
                                    <button class="btn btn-danger btn_red3 marg_tb15" type="button"><?php echo $vv['Subskill']['skill_name']; ?></button>
                                    <?php
                                    $j++;
                                    ?><?php
                                }
                            }
                            ?>
                            <a href="JavaScript:void(0);" class="btn btn-danger btn_red3 marg_tb15 less_skill" style="border-color:#2A6EB3;background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills</a> 
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <h3>Job Description  </h3>
                <div class="lesval">
                    <p>Hello,
                        <br/><?php echo substr($Jobresult['Job']['description'], 0, 350) . '........'; ?>
                        <a href="JavaScript:void(0);" class="more">More</a>
                    </p>
                </div>

                <div class="moreval hide">
                    <p>
                        Hello<br/>
                        <?php echo $Jobresult['Job']['description']; ?>
                        <a href="JavaScript:void(0);" class="less">Less</a>
                    </p>

                </div>


                <div class="open_jobs marg_tb50">
                    <h3 class="text_1"> Other open jobs by this client</h3>
                    <span class="text_3 font_18"> Active Jobs </span>
                    <div class="clearfix"></div>

                    <p class="marg_tb15 count_more"> 
                        <?php
                        $total_count = count($OtherOpenJobs);
                        $i = 0;
                        foreach ($OtherOpenJobs as $job) {
                            ?>
                            <a href="<?php echo $this->webroot; ?>freelancer/jobdetail/<?php echo $job['Job']['id'] ?>" style="text-decoration:none"><?php echo $job['Job']['job_title']; ?></a> <br>
                            <?php
                            $i++;
                            if ($i == 4) {
                                break;
                            }
                        }
                        ?>
                        <a class="font_18 more_jobs" href="JavaScript:void(0);" >More...</a>
                    </p>

                    <p class="marg_tb15 count_less hide "> 
                        <?php
                        $total_count = count($OtherOpenJobs);
                        $i = 0;
                        foreach ($OtherOpenJobs as $job) {
                            ?>
                            <a href="<?php echo $this->webroot; ?>freelancer/jobdetail/<?php echo $job['Job']['id'] ?>" style="text-decoration:none"><?php echo $job['Job']['job_title']; ?></a><br>
                            <?php
                            $i++;
                        }
                        ?>
                        <a class="font_18 less_jobs" href="JavaScript:void(0);" >Less...</a>
                    </p>


                </div>
            </div>
            <div class="col-md-4 col-sm-4 pad_r0">
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Job Overview </div>
                    <div class="panel-body bg_grey1 padd_0 bg_content">
                        <div class="col-md-6">
                            Budget</div><div class="col-md-6"><?php echo '$' . $Jobresult['Job']['budget']; ?></div>
                        <div class="col-md-6">
                            Posted </div><div class="col-md-6"> <?php echo $date = date('F d Y, H:i A', strtotime($Jobresult['Job']['created'])); ?></div>
                        <div class="col-md-6">
                            Planned Start </div><div class="col-md-6"><?php echo $date = date('F d Y', strtotime($Jobresult['Job']['start_date'])); ?></div>
                        <div class="col-md-6">
                            Duration </div><div class="col-md-6"><?php echo $Jobresult['Job']['duration']; ?></div>
                        <div class="col-md-6">
                            Category </div><div class="col-md-6">  <?php echo $category_data['Category']['name']; ?></div>
                        <div class="col-md-6">
                            Sub Category </div><div class="col-md-6">  <?php echo $subcategory_data['Subcategory']['category_name']; ?></div>
                    </div>
                </div>

                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">About the client </div>
                    <div class="panel-body bg_grey1 padd_0 bg_content">
                        <div class="col-md-5">
                            <ul class="list-inline marg_0">
                                <?php
                                $score = 0;
                                $ik = 0;
                                if (!empty($Feedback)) {
                                    $score += $Feedback['Projectfeedback']['score'];
                                    $ik++;
                                }
                                if ($ik != 0) {
                                    $AvgScore = $score / $ik;
                                } else {
                                    $AvgScore = 0;
                                }
                                ?>
                                <?php
                                $avg = number_format($AvgScore, 0);
                                for ($k = 1; $k <= $avg; $k++) {
                                    ?>
                                    <li><img alt="Star image icon" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                <?php } ?>
                            </ul>
                            <span> <?php
                                if (!empty($AvgScore)) {
                                    echo '(' . number_format($AvgScore, 0) . ')';
                                }
                                ?>
                                <?php
                                if (!empty($Reviews)) {
                                    echo '(' . $Reviews . ') reviews';
                                } else {
                                    echo '0 reviews';
                                }
                                ?>
                            </span>
                        </div>
                        <div class="col-md-7 font_16">
                            <?php if (isset($client_country) and !empty($client_country)) { ?>
                                <i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location icon image"/>
                                </i> <?php echo $client_country['Country']['name']; ?>
                            <?php } else { ?>
                                <i class="mrg_r5"><img src=" <?php echo $this->webroot; ?>img/location1.png" alt="location image icon"/></i> <?php echo 'No country added in your profile !'; ?>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>

                        <span class="col-md-12 padd_tb15 font_16 text-muted">Member since <?php echo date('M-d-Y', strtotime($clientinfo['User']['created'])); ?></span>               <div class="col-md-6">
                            Total Spent</div><div class="col-md-6"> <?php 
                            if(!empty($pay)){
                            echo 'Over  $' . $pay;
                             }
                             else{
                                 echo 'Over  $0.00';
                             }
?></div> <div class="col-md-6">
                            Jobs Posted </div>
                        <?php if (isset($posted_jobs) and !empty($posted_jobs)) { ?>
                            <div class="col-md-6"><?php echo $posted_jobs; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6"><?php  echo '0'; ?></div>
                        <?php } ?>
                        <div class="col-md-6">
                            Hires </div>
                        <div class="col-md-6">
                            <?php
                            if (!empty($Hired_data)) {
                                echo $Hired_data;
                            } else {
                                echo '0';
                            }
                            ?>                                
                        </div>
                        <div class="col-md-6">
                            Open Jobs</div>
                        <div class="col-md-6"><?php
                            if (!empty($count)) {
                                //echo $counts;
                            } else {
                                echo "0";
                            }
                            ?>
                        </div>                    
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
            $('.count_more').addClass('hide');
            $('.count_less').removeClass('hide');
        });
        $(document).on('click', '.less_jobs', function() {
            $('.count_more').removeClass('hide');
            $('.count_less').addClass('hide');
        });
    });
</script>


<script>
    $(document).ready(function() {
        $(document).on('click', '.more_skill', function() {
            $(this).parent().next().removeClass('hide');
            $(this).parent().addClass('hide');
        });
        $(document).on('click', '.less_skill', function() {
            $(this).parent().prev().removeClass('hide');
            $(this).parent().addClass('hide');
        });

    });
</script>


<?php if (!empty($jobs)) {
    ?>

    <div class="container">

        <div class="row marg_tb15">

            <div class="col-md-12">
                <p><i><img class="mrg_r5" alt="Back to Search" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $this->webroot; ?>client/job_payment">Back to search result</a></p>
            </div>
            <div class="col-md-8 col-sm-8 job_detail">
                <div class="bg_grey2">
                    <h3 class="marg_0"><?php echo $jobs['Job']['job_title']; ?></h3>

                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="marg_btm30">
                                <img src="<?php echo $this->webroot; ?>img/fixed.png" alt="fixed"> <?php echo $jobs['Job']['pay_type'] . ' Price' ?><p style="font-size: 11px; margin-left: 24px;">Delivered by <?php echo date('F d,Y', strtotime($jobs['Job']['start_date'])); ?></p>
                            </h4>
                        </div>
                        <div class="col-md-3">
                            <h4 class="marg_btm30">
                                <img src="<?php echo $this->webroot; ?>img/dollar.png" alt="dollar"> <?php echo '$' . $jobs['Job']['budget'] . '.00' ?> <p style="font-size: 11px; margin-left: 26px;">Budget</p>
                            </h4>
                        </div>

                    </div>
                    <div class="tabs_1 col-md-12">
                        <div class="col-md-12colsm-12 less_skills"> 
                            <h5 class="marg_0">Skills required</h5>
                            <?php
                            if (!empty($skills)) {
                                $total_skills = count($skills);
                                $j = 0;
                                foreach ($skills as $k => $v) {
                                    ?>
                                    <button class="btn btn-danger btn_red3 marg_tb15" type="button" disabled=""><?php echo $v['Subskill']['skill_name']; ?></button>

                                    <?php
                                    if ($j == '2') {
                                        break;
                                    }$j++;
                                }
                            }
                            if ($total_skills >= 2) {
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
                                foreach ($skills as $k => $v) {
                                    ?>
                                    <button class="btn btn-danger btn_red3 marg_tb15" type="button" disabled=""><?php echo $v['Subskill']['skill_name']; ?></button>
                                    <?php
                                    $j++;
                                }
                            }
                            ?>
                            <a href="JavaScript:void(0);" class="btn btn-danger btn_red3 marg_tb15 less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;border-color: #2A6EB3;">Less Skills</a>                                 
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <h3>Job Description  </h3>
                <div class="col-md lesval">
                    <p>Hello,<br/>
                        <?php echo substr($jobs['Job']['description'], 0, 350) . '........'; ?>
                        <a href="JavaScript:void(0);" class="more">More</a>
                    </p>
                </div>
                <div class="col-md moreval hide">
                    <p>Hello<br/>
                        <?php echo $jobs['Job']['description']; ?>
                        <a href="JavaScript:void(0);" class="less">Less</a>
                    </p>
                </div>

            </div>

            <div class="col-md-4 col-sm-4 pad_r0">
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Job Overview </div>
                    <div class="panel-body bg_grey1 padd_0 bg_content">

                        <div class="col-md-6">
                            Budget</div><div class="col-md-6"> <?php echo '$' . $jobs['Job']['budget'] . '.00'; ?></div>

                        <div class="col-md-6">
                            Posted </div><div class="col-md-6"> <?php echo date('F d Y, h:i A', strtotime($jobs['Job']['created'])) ?></div>

                        <div class="col-md-6">
                            Planned Start </div><div class="col-md-6"><?php echo date('F d Y', strtotime($jobs['Job']['start_date'])); ?></div>

                        <div class="col-md-6">
                            Duration    </div><div class="col-md-6"><?php echo $jobs['Job']['duration']; ?></div>

                        <div class="col-md-6">
                            category </div><div class="col-md-6"><?php echo $category['Category']['name']; ?></div>
                        <div class="col-md-6">
                            Sub-category</div><div class="col-md-6"> <?php echo $subcategory['Subcategory']['category_name']; ?></div>



                    </div>
                </div>

                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">About the client </div>  
                    <div class="panel-body bg_grey1 padd_0 bg_content">

                        <div class="col-md-5">
                            <ul class="list-inline marg_0">
                                <li> </li>
                                <?php
                                if (!empty($feedback)) {
                                    $score = number_format($feedback['Projectfeedback']['score'], 0);
                                    for ($n = 1; $n <= $score; $n++) {
                                        ?>
                                        <li><img alt="star_image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                        <?php
                                    }
                                } ?>
                            </ul>
                            <?php if (!empty($feedback)) { ?>
                                <span>(<?php echo number_format($feedback['Projectfeedback']['score'], 1); ?>) <?php if ($count_data > 1) { ?><?php echo $count_data; ?> reviews<?php } else { ?><?php echo $count_data; ?> review<?php } ?></span>
                            <?php } else { ?>
                                <span><?php echo '(0.0) 0 review'; ?></span>
                            <?php } ?>
                        </div>

                        <div class="col-md-7 font_16">
                            <i class="mrg_r5"><img alt="location" src="<?php echo $this->webroot; ?>img/location1.png"></i><?php
                            if (!empty($country_name['Country']['name'])) {
                                echo $country_name['Country']['name'];
                            } else {
                                echo "No country found !";
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <span class="col-md-12 padd_tb15 font_16 text-muted">Member since <?php echo date('F d Y', strtotime($jobs['User']['created'])); ?></span>


                        <div class="col-md-6">
                            Total Spent</div><div class="col-md-6"> <?php
                            if (!empty($spent['Paypalpayment']['payment_amount'])) {
                                echo '$' . $spent['Paypalpayment']['payment_amount'] . ' (' . $spent['Paypalpayment']['pay_status'] . ')';
                            } else {
                                echo 'over $0.00';
                            }
                            ?></div>


                        <?php if (!empty($job_count)) { ?>
                            <div class="col-md-6">
                                Job Posted </div><div class="col-md-6"><?php echo $job_count; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6">
                                Job Posted </div><div class="col-md-6">0</div>
                        <?php } ?>    

                        <?php if (!empty($count_hire)) { ?>
                            <div class="col-md-6">
                                Hires </div><div class="col-md-6"><?php echo $count_hire; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6">
                                Hires </div><div class="col-md-6">0</div>
                        <?php } ?>         
                        <?php if (!empty($OpenJobs)) { ?>
                            <div class="col-md-6">
                                Open Jobs</div>
                            <div class="col-md-6"><?php echo $OpenJobs; ?></div>
                        <?php } else { ?>
                            <div class="col-md-6">
                                Open Jobs</div>
                            <div class="col-md-6">0</div>  
                        <?php } ?>

                    </div>
                </div>

            </div> 
        </div>

    </div>

<?php } else { ?>
    <div class="container">
        <hr class="brder_btm">
        <div class="row">

            <div class="bg_white freelaners marg_btm30">
                <div class="green">
                    Job Detail
                </div>
                <div style="text-align:center; color:#C7C4C8; padding: 25px; font-size: 20px;" class="col-md-12 colsm-12 marg_tb15"><span> <strong> No Job Found for this team </strong> </span></div>
                <div class="clearfix"></div>
                <hr class="brder_btm1 marg_0">
                <div class="tabs_1 col-md-12 marg_t5">
                </div>
            </div>
        </div>
    </div>
<?php } ?>
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

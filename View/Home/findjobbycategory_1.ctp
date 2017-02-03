<div class="container">
    <?php if (!empty($category)) { ?>
        <div class="row marg_tb15">

            <div class="col-md-12">
                <p><i><img class="mrg_r5" alt="BAck icon image" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo BASE_URL ?>">Back to search result</a></p>
            </div>
            <?php if (!empty($category)) { ?>
                <div class="col-md-8 col-sm-8 job_detail">
                    <div class="bg_grey2">

                        <h3 class="marg_0"><?php echo $category['Job']['job_title']; ?> </h3>
                        <div class="row">
                            <div class="col-md-8 col-sm-4 offset cate">
                                <h4 class="marg_btm30"><?php echo $category_name['Subcategory']['category_name']; ?> <small class="marg_l20"><?php echo $category['Job']['time_duration']; ?></small></h4>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 subs">
                                <h4 class="marg_btm30">
                                    <img src="<?php echo $this->webroot; ?>img/fixed.png" alt="Fixed icon image"> <?php echo ucfirst($category['Job']['pay_type']) . ' Price' ?><p style="font-size: 11px; margin-left: 24px;">Delivered by <?php echo date('F d,Y', strtotime($category['Job']['start_date'])); ?></p>
                                </h4>
                            </div>
                            <div class="col-md-3 budg">
                                <h4 class="marg_btm30">
                                    <img src="<?php echo $this->webroot; ?>img/dollar.png" alt="Dollar icon image"><?php echo '$' . $category['Job']['budget'] . '.00' ?><p style="font-size: 11px; margin-left: 26px;">Budget</p>
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

                    <p>Hello,
                        <br><?php echo $category['Job']['description']; ?></p>



                </div>

                <div class="col-md-4 col-sm-4 pad_r0">


                    <!--<button class="btn-lg btn-green btn-block marg_btm30">Apply to this job</button>-->



                    <div class="panel panel-default green_bg1">
                        <div class="panel-heading">Job Overview </div>
                        <div class="panel-body bg_grey1 padd_0 bg_content">

                            <div class="col-md-6">
                                Budget</div><div class="col-md-6"> <?php echo '$' . $category['Job']['budget'] . '.00' ?></div>

                            <div class="col-md-6">
                                Posted </div><div class="col-md-6"> <?php echo date('M d Y h:i A', strtotime($category['Job']['created'])); ?></div>

                            <div class="col-md-6">
                                Planned Start </div><div class="col-md-6"><?php echo date('F d Y', strtotime($category['Job']['start_date'])) ?></div>

                            <div class="col-md-6">
                                Duration    </div><div class="col-md-6"> <?php echo $category['Job']['duration']; ?></div>


                            <div class="col-md-6">
                                category </div><div class="col-md-6"><?php echo $category_name['Category']['name']; ?></div>
                            <div class="col-md-6">
                                Sub-category</div><div class="col-md-6"><?php echo $category_name['Subcategory']['category_name']; ?></div>



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
                                            <li><img alt="Star icon image"src="<?php echo $this->webroot; ?>img/star.png"></li>
                                        <?php } ?>
                                    </ul>
                                <?php } else { ?>
                                    <ul class="list-inline marg_0">
                                        <li></li>

                                    </ul>
                                <?php } ?>
                                <?php if (!empty($feedback)) { ?>
                                    <span><?php echo '(' . $feedback['Projectfeedback']['score'] . ')'; ?> <?php if (!empty($Reviews)) {
                            echo $Reviews . ' reviews';
                        } else {
                            echo '0 reviews';
                        } ?>   </span>
        <?php } else { ?>
                                    <span><?php echo '(0.00) 0 reviews'; ?></span>
        <?php } ?>
                            </div>

                            <div class="col-md-7 font_16">

                                <i class="mrg_r5"><img alt="Location icon image" src="<?php echo $this->webroot; ?>img/location1.png"></i><?php if (!empty($country_name)) {
            echo $country_name['Country']['name'];
        } else {
            echo "No Country Added";
        } ?>

                            </div>
                            <div class="clearfix"></div>

                            <span class="col-md-12 padd_tb15 font_16 text-muted">Member since <?php echo date('F d Y', strtotime($category['User']['created'])); ?></span>

                            <div class="col-md-6">
                                Total Spent</div><div class="col-md-6"><?php echo 'Over $' . $pay . '.00'; ?></div>

                            <div class="col-md-6">
                                Jobs Posted </div>
                            <?php if (!empty($job_data)) { ?>
                                <div class="col-md-6"> <?php echo $job_data; ?></div>
                            <?php } else { ?>
                                <div class="col-md-6">0</div>
                            <?php } ?>

                            <div class="col-md-6">
                                Hires </div>
                            <?php if (!empty($hire_data)) { ?>
                                <div class="col-md-6"><?php echo $hire_data; ?></div>
                            <?php } else { ?>
                                <div class="col-md-6">0</div>
                            <?php } ?>

                            <div class="col-md-6">
                                Open Jobs</div>
        <?php if (!empty($open_jobs)) { ?>
                                <div class="col-md-6"><?php echo $open_jobs; ?></div>
                <?php } else { ?>
                                <div class="col-md-6">0</div>
        <?php } ?>

                        </div>
                    </div>

                </div> 
    <?php } else { ?>
                <div class="bg_white freelaners marg_btm30">
                    <div class="green">
                        Job Detail
                    </div>
                    <div style="text-align:center; color:#DD5428;" class="col-md-12 colsm-12 marg_tb15"><span> <strong> No Result Found! </strong> </span></div>
                    <div class="clearfix"></div>
                    <hr class="brder_btm1 marg_0">
                    <div class="tabs_1 col-md-12 marg_t5">
                    </div>
                </div>
    <?php } ?>
        </div>

<?php } elseif (!empty($user)) { ?> 
        <div class="title">
            <h2>
                <span class=" text-left"> Top Developers & Programmers </span>
                <a href="<?php echo $this->webroot; ?>login">
                    <button type="submit" class="btn btn-sm  btn_red btn_red12 pull-right fnone"> Post a job   </button>
                </a>
            </h2>
        </div>

        <div class="col-md-12 mbtm">
            <br>
                    <?php
                    if (isset($user) and !empty($user)) {
                        foreach ($user as $key => $val) {
                            ?>
                    <div class="col-md-12 skill_sec">
                        <div class="col-sm-3 col-md-2 text-center immg_sec">
            <?php if (!empty($val['User']['image'])) { ?>
                                <img class="img-thumbnail" alt="login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $val['User']['image']; ?>"/>
            <?php } else { ?>
                                <img class="img-thumbnail" src="<?php echo $this->webroot; ?>img/freelancer.png" alt="freelancer image"/>
            <?php } ?>
                        </div>
                        <div class="col-sm-6 col-md-8 middle_dv">
                            <h5><?php echo ucfirst($val['User']['first_name']) . '  ' . ucfirst($val['User']['last_name']); ?></h5>
                            <h4><?php echo $val['User']['job_title']; ?></h4>
                            <div class="lesval">
                                <p><?php if (!empty($val['User']['description'])) {
                        echo substr($val['User']['description'], 0, 150) . '..........'; ?> <a href="JavaScript:void(0);" class="more" style="font-size: 15px; text-decoration: none;">More</a> <?php } else {
                    echo '<p style="color: rgb(187, 187, 187); padding: 17px; font-size: 19px;"> No other Information about yourself added in your Profile, <br> Please Complete Your Profile !</p>';
                } ?></p>   </div>

                            <div class="moreval hide">
                                <p> <?php echo $val['User']['description']; ?> <a href="JavaScript:void(0);" class="less" style="font-size: 15px; text-decoration: none;">Less</a> </p>
                            </div>
                            <h3><img alt="location icon image" src="<?php echo $this->webroot; ?>img/location1.png"><b><?php echo $val['User']['country']['Country']['name']; ?></b>&nbsp; -&nbsp; Last days&nbsp;:&nbsp; <?php
                        if (!empty($val['User']['timeduration'])) {
                            echo $val['User']['timeduration'];
                        } else {
                            echo "0 day ago";
                        }
                        ?>&nbsp;-&nbsp;Tests:<span><?php echo $val['User']['tests'] ?></span></h3>
                            <ul>
                                <div class="less_skills">
                                    <?php
                                    $i = 0;
                                    $total = count($val['User']['skills']);
                                    foreach ($val['User']['skills'] as $kk => $vv) {
                                        ?>
                                        <li><?php echo ucfirst($vv['Subskill']['skill_name']); ?></li>
                <?php if ($i == '3') {
                    break;
                }$i++;
            } ?>
            <?php if ($total > 4) { ?>
                                        <li style="background-color: rgb(1, 193, 249);"><a class="more_skil" href="JavaScript:void(0);" style="color:#fff; text-decoration: none;">More</a></li>
            <?php } ?>
                                </div>

                                <div class="more_skills hide">
            <?php
            //$i=0;
            //$total=count($val['User']['Skills']);
            foreach ($val['User']['skills'] as $kk => $vv) {
                ?>
                                        <li><?php echo ucfirst($vv['Subskill']['skill_name']); ?></li>
                                <?php } ?>

                                    <li style="background-color: rgb(1, 193, 249);"><a class="less_skil" href="JavaScript:void(0);" style="color:#fff; text-decoration: none;">Less</a></li>
                                </div>
                                <div class="clearfix"></div>
                            </ul>


                            <div class="col-md-12 grp">
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-sm-3 col-md-2 right_dv">

                            <p>
                                <?php if (!empty($val['User']['budget'])) { ?>
                                    <b><?php echo '$' . $val['User']['budget'] . '.00/hr'; ?></b>
                                <?php } else { ?>
                                    <b><?php echo '$0.00/hr'; ?></b>
                                <?php } ?>
                                <br>
                                <?php
                                $score = 0;
                                $ik = 0;
                                if (!empty($val['User']['feedback'])) {
                                    $score += $val['User']['feedback']['Projectfeedback']['score'];
                                    $ik++;
                                }
                                if ($ik != 0) {
                                    $AvgScore = $score / $ik;
                                } else {
                                    $AvgScore = 0;
                                }
                                ?>
                                <b><?php echo number_format($AvgScore, 0); ?></b>
                    <?php
                    $AvgScore = number_format($AvgScore, 0);
                    for ($j = 1; $j <= $AvgScore; $j++) {
                        ?>      
                                    <img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png">
            <?php } ?>  
                            </p>
                            <br>


                            <div class="clearfix"></div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                            <?php
                        }
                    } else {
                        ?>
                <p class="Noresult">No Record(s) Found !</p>
                <div class="clearfix"></div>
                    <?php } ?>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12 ">
            <nav>
                <ul class="pagination pull-right pagi">
                    <li>
            <?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?>
                    </li>
                <?php
                echo $this->Paginator->numbers(array(
                    'before' => '',
                    'after' => '',
                    'separator' => '',
                    'tag' => 'li',
                    'spanClass' => 'sr-only',
                    'currentClass' => 'active',
                    'currentTag' => 'a',
                ));
                ?> 
                    <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
                </ul>
            </nav>
        </div>
<?php } elseif (!empty($category_data)) { ?>
        <h2 class="header_style">
    
                <span class="large_font text-left">
        <?php
        if (!empty($category_data)) {
            echo $category_data['Category']['name'];
        }
        ?> Jobs</span> <span class="text_green marg_l20 font_18"> <?php echo '(' . $count_job . ' were found based on your criteria )'; ?></span>
                </button>   
                <div class="clearfix"></div>
            </h2>
            <hr class="brder_btm"/>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="green_bg panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="marg_0">Narrow results by:</h3></div>
                        <form class="cust_form sider_bar_form">
                            <div class="panel1">
                                <h4 class="marg_0">Category</h4>
                            </div>
                            <div class='web_job'>
                                <ul class="list-group padd_tb15">
        <?php
        if (!empty($cat_data) and isset($cat_data)) {
            foreach ($cat_data as $value) {
                ?>
                <?php
                if ($value['Category']['id'] == $category_data['Category']['id']) {
                    $active = 'active';
                } else {
                    $active = '';
                }
                ?>
                                            <li class="list-group-item <?php echo $active; ?>"> <a href="<?php echo $this->webroot; ?>home/find_jobsby_category/<?php echo $value['Category']['id'] ?>" style="text-decoration:none"><?php echo $value['Category']['name']; ?></a></li>
            <?php
            }
        }
        ?>
                                </ul>
                            </div>
                            <div class="sub_content">
                                <div class="clearfix"></div>
                                <div class="brder_tb">
                                    <h4 class="marg_0">Subcategory</h4>
                                </div>
                                <div>
                                    <ul class="list-group padd_tb15">
        <?php foreach ($sub_cat as $value) { ?>
                                            <li class="list-group-item"> <a href="#" style="text-decoration:none"><?php echo $value['Subcategory']['category_name'] ?></a></li>
        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="sub_content">
                                <div class="clearfix"></div>
                                <div class="brder_tb">
                                    <h4 class="marg_0">Date Posted</h4>
                                </div><div>
                                    <ul class="list-group padd_tb15">
                                        <li class="list-group-item"> <a href="#">Last 24 Hours (<?php echo $job_count_oneday; ?>)</a></li>
                                        <li class="list-group-item"><a href="#">Last 3 Days (<?php echo $job_count_threedays; ?>)</a></li>
                                        <li class="list-group-item"><a href="#">Last 7 Days (<?php echo $job_count_sevendays; ?>)</a></li>
                                        <li class="list-group-item"><a href="#">Last 14 Days (<?php echo $job_count_fourteendays; ?>)</a></li>
                                        <li class="list-group-item"><a href="#">Last 30 Days (<?php echo $job_count_thirtydays; ?>)</a></li>

                                    </ul>

                                </div>
                            </div>

                        </form>
                        <div class="clearfix"></div>
                        <!-- List group -->


                    </div>



                </div>

                <div class="col-md-8 col-sm-8 marg_btm30">


                    <ul class="pagination pull-right">
                        <li><?php echo $this->Paginator->prev('<<Previous', null, null, array('class' => 'disabled')); ?></li>
        <?php
        echo $this->Paginator->numbers(array(
            'before' => '',
            'after' => '',
            'separator' => '',
            'tag' => 'li',
            'spanClass' => 'sr-only',
            'currentClass' => 'active',
            'currentTag' => 'a',
        ));
        ?> 
                        <li><?php echo $this->Paginator->next('Next>>', null, null, array('class' => 'disabled')); ?></a></li>
                    </ul>

                    <div class="clearfix"></div>
        <?php
        if (!empty($data_JobResult) and isset($data_JobResult)) {
            foreach ($data_JobResult as $key => $value) {
                ?>
                            <div class="bg_white freelaners marg_btm30">
                                <div class="green" >
                                    <a href="<?php echo $this->webroot; ?>home/jobdetail/<?php echo $value['Job']['id']; ?>" style="color:white; text-decoration: none">
                                        <?php echo $value['Job']['job_title'] ?>
                                    </a>
                                </div>
                                <div class="col-md-12 colsm-12 marg_tb15 lesval">
                                    <p><?php echo substr($value['Job']['description'], 0, 250) . '....'; ?>     <a href="JavaScript:void(0);" class="more">more</a>
                                    </p>
                                </div>
                                <div class="col-md-12 colsm-12 marg_tb15 moreval hide">
                                    <p><?php echo $value['Job']['description']; ?>
                                        <a href="JavaScript:void(0);" class="less">less</a>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                                <hr class="brder_btm1 marg_0">
                                <div class="tabs_1 col-md-12 marg_t5">
                                    <div class="col-md-10 col-sm-10 less_skills ">
                <?php
                if (!empty($val['Job']['skill_name'])) {
                    $total_skills = count($val['Job']['skill_name']);
                    $j = 0;
                    foreach ($val['Job']['skill_name'] as $key => $vv) {
                        ?>
                                                <button type='button' class='subskil'disabled> <?php echo $vv['Subskill']['skill_name']; ?>
                                                </button>  
                        <?php
                        if ($j == '4') {
                            break;
                        }$j++;
                    }
                }
                ?> 
                <?php if (!empty($total_skills) and $total_skills >= 4) { ?>
                                            <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills </a>  
                <?php }
                ?>
                                    </div>
                                    <div class="col-md-10 col-sm-10 more_skills hide ">
                <?php
                if (!empty($val['Job']['skill_name'])) {
                    $total_skills = count($val['Job']['skill_name']);
                    $j = 0;
                    foreach ($val['Job']['skill_name'] as $key => $vv) {
                        ?>
                                                <button type='button' class='subskil'disabled> <?php echo $vv['Subskill']['skill_name']; ?>
                                                </button>  
                        <?php
                        $j++;
                    }
                }
                ?> 

                                        <a href="JavaScript:void(0);" class="subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills </a>  

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="bg_grey1 pull-left marg_t5">
                                    <div class="location pull-right">
                                        <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project icon image"/></i><span class=" text_green">Est. Budget: <?php echo $value['Job']['budget'] ?></span>
                                    </div>
                                    <div class="location pull-right">
                                        <i><img src="<?php echo $this->webroot; ?>img/clock.png" alt="Clock icon image"/></i><span class=" text_green"> <?php echo $value['Job']['time_duration'] ?></span>

                                    </div>
                                    <div class="location pull-right">
                                        <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project icon image"/></i><span class=" text_green">Posted by : <?php echo ' ' . ucfirst($value['Job']['user_info']['User']['first_name']) . '  ' . ucfirst($value['Job']['user_info']['User']['last_name']); ?></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                <?php
            }
        } else {
            ?>
                        <div class="bg_white freelaners marg_btm30">
                            <div class="green">
                                Job Detail
                            </div>
                            <div style="text-align:center; color:#DD5428;" class="col-md-12 colsm-12 marg_tb15"><span> <strong> No Job(s) Found under this category ! </strong> </span></div>
                            <div class="clearfix"></div>
                            <hr class="brder_btm1 marg_0">
                            <div class="tabs_1 col-md-12 marg_t5">
                            </div>
                        </div>
        <?php } ?>
                </div>
            </div>
    <?php } 
    else { ?>
            <div class="bg_white freelaners marg_btm30" style="margin-top: 21px;">
                <div class="green">
                    Job Detail
                </div>
                <div style="text-align:center; color:#C7C4C8;" class="col-md-12 colsm-12 marg_tb15"><span> <strong> No Record Found ! </strong> </span></div>
                <div class="clearfix"></div>
                <hr class="brder_btm1 marg_0">
                <div class="tabs_1 col-md-12 marg_t5">
                </div>
            </div>
    <?php } ?>
</div>


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
    .subskils {
        background: none repeat scroll 0 0 #E3E3DF;
        border: 0 none;
        border-radius: 4px !important;
/*        color: #000 !important;*/
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
<style>
    .current{
        /*background: none repeat scroll 0 0 #FF0000 !important;*/
        background: none repeat scroll 0 0 #DA423D !important;
        float: left;
        height: 34px !important;
        margin-top: 2px;
        width: 36px;
        padding-top: 6px;
        padding-left: 12px;
        color: white;
    }
    .next{
        color:white !important;
    }
    .prev{
        color:white !important;
    }
    .input-group-addon.grrenbtn {
        background: #1fb5ad;
        color: #fff;
        font-size: 14px;
    }
</style>

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

<script>
    $(document).ready(function() {
        $(document).on('click', '.searchbtn', function() {
            var search_value = $('#searchbox').val();
            if (search_value == '') {
                alert('Please enter Search keyword !');
                return false;
            } else {
                $('.searchbtn').attr('type', 'submit');
                return true;
            }

        });
    });

</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.more_skil', function() {
            $(this).parent().parent().next().removeClass('hide');
            $(this).parent().parent().addClass('hide');
        });

    });
    $(document).ready(function() {
        $(document).on('click', '.less_skil', function() {
            $(this).parent().parent().prev().removeClass('hide');
            //$('.less_skills').removeClass('hide');
            $(this).parent().parent().addClass('hide');

        });
    });
</script>
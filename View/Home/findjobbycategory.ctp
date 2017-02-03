<?php if (!empty($Freelancer_user)) { ?>
    


<?php
} elseif (isset($job_data) and !empty($job_data)) {
    ?>
    <div class="container">
    <?php if (!empty($count_job) and ( $count_job != 0)) { ?>
            <h2 class="header_style"><span class="large_font text-left">
                    All Jobs
                </span>
                <span class="text_green marg_l20 font_18">  (<?php echo $count_job; ?> were found based on your criteria )</span>
                <div class="clearfix"></div>
            </h2>
            <hr class="brder_btm"/>

            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="green_bg panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading"> <h3 class="marg_0">Narrow results by:</h3></div>

                        <form class="cust_form sider_bar_form">
                            <div class="panel1">
                                <h4 class="marg_0">Category</h4>

                            </div>
                            <div>
                                <ul class="list-group padd_tb15">
        <?php
        foreach ($category as $key => $value) {
            $id = $value['Category']['id'];
            ?>
                                        <li class="list-group-item"> <a href="<?php echo $this->webroot; ?>findfreelancer/category_jobs/<?php echo $id; ?>" style="text-decoration: none;"><?php echo $value['Category']['name']; ?></a></li>
        <?php } ?>
                                </ul>
                            </div>

                            <div class="sub_content">
                                <div class="clearfix"></div>
                                <div class="brder_tb">
                                    <h4 class="marg_0">Date Posted</h4>
                                </div><div>
                                    <ul class="list-group padd_tb15">
                                        <li class="list-group-item"> <a href="#" style="text-decoration:none;">Last 24 Hours <?php echo '(' . $job_count_oneday . ')'; ?></a></li>
                                        <li class="list-group-item"><a href="#" style="text-decoration:none;" >Last 3 Days <?php echo '(' . $job_count_threedays . ')'; ?></a></li>
                                        <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 7 Days <?php echo '(' . $job_count_sevendays . ')'; ?></a></li>
                                        <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 14 Days <?php echo '(' . $job_count_fourteendays . ')'; ?></a></li>
                                        <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 30 Days <?php echo '(' . $job_count_thirtydays . ')'; ?></a></li>                                </ul>
                                </div>
                            </div>

                        </form>
                        <div class="clearfix"></div>
                        <!-- List group -->


                    </div>



                </div>

                <div class="col-md-8 col-sm-8 marg_btm30">

                    <ul class="pagination pull-right">
                        <li><?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?></li>
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
                        <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></a></li>
                    </ul>
                    <div class="clearfix"></div>
        <?php foreach ($job_data as $val) { ?>
                        <div class="bg_white freelaners marg_btm30">

                            <div class="green">
            <?php echo $this->Html->link($val['Job']['job_title'], array('controller' => 'findfreelancer', 'action' => 'jobsdata', $val['Job']['id']), array('class' => 'makewhite')); ?>
                            </div>
                            <div class="col-md-12 colsm-12 marg_tb15 lesval">

                                <p><?php echo substr($val['Job']['description'], 0, 300) . '......'; ?> 
                                    <a href="JavaScript:void(0);" class="more">more</a>
                                </p>

                            </div>

                            <div class="col-md-12 colsm-12 marg_tb15 moreval hide">

                                <p><?php echo $val['Job']['description']; ?> 
                                    <a href="JavaScript:void(0);" class="less">less</a>
                                </p>

                            </div>

                            <div class="clearfix"></div>
                            <hr class="brder_btm1 marg_0">
                            <div class="tabs_1 col-md-12 marg_t5">
                                <div class="col-md-10 colsm-10 less_skills ">
                                    <?php
                                    if (!empty($val['Job']['realskill'])) {
                                        $total = count($val['Job']['realskill']);
                                        $k = 0;
                                        foreach ($val['Job']['realskill'] as $kk => $vv) {
                                            ?>                            
                                            <button type='button' class='subskil' disabled><?php echo $vv['Subskill']['skill_name']; ?></button>
                                            <?php
                                            if ($k == "3") {
                                                break;
                                            }
                                            $k++;
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if (!empty($total) && $total > 4) { ?>
                                        <a href="JavaScript:void(0);" class=" subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More</a>
                                    <?php } ?>
                                </div>

                                <div class="col-md-10 colsm-10  more_skills hide ">
                                    <?php
                                    if (!empty($val['Job']['realskill'])) {
                                        //$total=count($data['User']['realskill']);
                                        $k = 0;
                                        foreach ($val['Job']['realskill'] as $kk => $vv) {
                                            // echo $k;
                                            ?>

                                            <button type='button' class='subskil' disabled><?php echo $vv['Subskill']['skill_name']; ?></button>
                    <?php
                    $k++;
                }
                ?>
            <?php }
            ?>
                                    <a href="JavaScript:void(0);" class=" subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less</a>

                                </div>

                            </div>
                            <div class="clearfix"></div>
                            <div class="bg_grey1 pull-left marg_t5">

                                <div class="location pull-right">

                                    <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project image icon"/></i><span class=" text_green">Est. Budget: <?php echo $val['Job']['budget'] . '.00'; ?> </span>

                                </div>

                                <div class="location pull-right">

                                    <i><img src="<?php echo $this->webroot; ?>img/clock.png" alt="Clock image icon"/></i><span class=" text_green"> Posted 
                                        <?php if ($val['Job']['days'] > 0) { ?>
                                            <?php echo $val['Job']['days'] ?> days
                                        <?php } ?>
                                        <?php
                                        if ($val['Job']['hours'] > 0) {
                                            echo $val['Job']['hours']
                                            ?> hrs
                                        <?php } ?>

                                        <?php
                                    if ($val['Job']['minutes'] > 0) {
                                        echo $val['Job']['minutes']
                                        ?> min
            <?php } ?>  
            <?php
            if ($val['Job']['seconds'] > 0) {
                echo $val['Job']['seconds']
                ?> sec ago	</span>
            <?php } ?>   
                                </div>

                                <div class="location pull-right">
                                    <span class=" text_green"><?php echo 'Posted By: ' . ucfirst($val['Job']['users']['User']['first_name']) . ' ' . ucfirst($val['Job']['users']['User']['last_name']); ?> </span>

                                </div>
                            </div>


                            <div class="clearfix"></div>

                        </div>
        <?php } ?>

                </div>
            </div>
    <?php } else { ?>
            <h2 class="header_style"><span class="large_font text-left"> </span> <span class="text_green marg_l20 font_18"> 
                </span>
                <!--            <button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button>-->
            </h2>
            <hr class="brder_btm">
            <div class="row">
                <div class="col-md-12 col-sm-8 marg_btm30">
                    <div class="clearfix"></div>
                    <div class="bg_white freelaners marg_btm30">
                        <div class="green">
                            Search Results<span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt="detail image icon"></i></span>
                            <div class="clearfix"></div>   </div>

                        <div class="col-md-10 colsm-10 marg_tb15">
                            <p style="color:#C7C4C8;; text-align: center;padding:20px;font-size: 20px;"> <strong>Sorry,</strong>No record found related to <strong><?php echo $sub_text; ?></strong> category</p>      
                        </div>

                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
    <?php } ?>
    </div>
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
            <?php } else {
                ?>

    <div class="container">
                <?php if (!empty($category)) { ?>
            <h2 class="header_style">

                <span class="large_font text-left">
        <?php
        if (!empty($category)) {
            echo $category['Category']['name'];
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
                                            $id = $value['Category']['id'];
                                            ?>
                                            <?php
                                            if ($value['Category']['id'] == $category['Category']['id']) {
                                                $active = 'active';
                                            } else {
                                                $active = '';
                                            }
                                            ?>
                                            <li class="list-group-item <?php echo $active; ?>"> <a href="<?php echo $this->webroot; ?>home/find_jobsby_category/<?php echo $value['Category']['id'] ?>" style="text-decoration:none"><?php echo $value['Category']['name']; ?><?php echo '(' . $Job_Count[$id] . ')'; ?></a></li>
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
        if (!empty($job_data) and isset($job_data)) {
            foreach ($job_data as $key => $value) {
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
                                        if (!empty($value['Job']['skill_name'])) {
                                            $total_skills = count($value['Job']['skill_name']);
                                            $j = 0;
                                            foreach ($value['Job']['skill_name'] as $key => $vv) {
                                                ?>
                                                <button type='button' class='subskil'disabled> <?php echo $vv['Subskill']['skill_name']; ?>
                                                </button>  
                                                <?php
                                                if ($j == '1') {
                                                    break;
                                                }$j++;
                                            }
                                        }
                                        ?> 
                                        <?php if (!empty($total_skills) and $total_skills >= 1) { ?>
                                            <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills </a>  
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="col-md-10 col-sm-10 more_skills hide ">
                                        <?php
                                        if (!empty($value['Job']['skill_name'])) {
                                            $total_skills = count($value['Job']['skill_name']);
                                            $j = 0;
                                            foreach ($value['Job']['skill_name'] as $key => $vv) {
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
                                        <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Projcetr icon image"/></i><span class=" text_green">Posted by : <?php echo ' ' . ucfirst($value['Job']['user_info']['User']['first_name']) . '  ' . ucfirst($value['Job']['user_info']['User']['last_name']); ?></span>
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
    <?php } elseif (!empty($job_datas)) { ?>
            <div class="row marg_tb15">

                <div class="col-md-12">
                    <p><i><img class="mrg_r5" alt="Back icon image" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo BASE_URL ?>">Back to search result</a></p>
                </div>
        <?php if (!empty($job_datas)) { ?>
                    <div class="col-md-8 col-sm-8 job_detail">
                        <div class="bg_grey2">

                            <h3 class="marg_0"><?php echo ucwords($job_datas['Job']['job_title']); ?> </h3>
                            <div class="row">
                                <div class="col-md-8 col-sm-4 offset cate">
                                    <h4 class="marg_btm30"><?php echo $category_name['Subcategory']['category_name']; ?> <small class="marg_l20"><?php echo $job_datas['Job']['time_duration']; ?></small></h4>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 subs">
                                    <h4 class="marg_btm30">
                                        <img src="<?php echo $this->webroot; ?>img/fixed.png" alt="fixed icon image"> <?php echo ucfirst($job_datas['Job']['pay_type']) . ' Price' ?><p style="font-size: 11px; margin-left: 24px;">Delivered by <?php echo date('F d,Y', strtotime($job_datas['Job']['start_date'])); ?></p>
                                    </h4>
                                </div>
                                <div class="col-md-3 budg">
                                    <h4 class="marg_btm30">
                                        <img src="<?php echo $this->webroot; ?>img/dollar.png" alt="dollar icon image"><?php echo '$' . $job_datas['Job']['budget'] . '.00' ?><p style="font-size: 11px; margin-left: 26px;">Budget</p>
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

                                <div class="col-md-12 col-sm-12 more_skills hide">
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
                            <br>
                        <div class="col-md-12 lesval">        
                            <p><?php echo substr($job_datas['Job']['description'], 0, 200) . '.....'; ?>
                                <a href="Javascript:void(0);" class="more">More</a>
                            </p>
                        </div>
                        <div class="col-md-12 moreval hide">
                            <p>
            <?php echo $job_datas['Job']['description']; ?>
                                <a href="Javascript:void(0);" class="less">Less</a>
                            </p> 
                        </div>
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-4 pad_r0">
                        <div class="panel panel-default green_bg1">
                            <div class="panel-heading">Job Overview </div>
                            <div class="panel-body bg_grey1 padd_0 bg_content">
                                <div class="col-md-6">
                                    Budget</div><div class="col-md-6"> <?php echo '$' . $job_datas['Job']['budget'] . '.00' ?></div>

                                <div class="col-md-6">
                                    Posted </div><div class="col-md-6"> <?php echo date('M d Y h:i A', strtotime($job_datas['Job']['created'])); ?></div>

                                <div class="col-md-6">
                                    Planned Start </div><div class="col-md-6"><?php echo date('F d Y', strtotime($job_datas['Job']['start_date'])) ?></div>

                                <div class="col-md-6">
                                    Duration    </div><div class="col-md-6"> <?php echo $job_datas['Job']['duration']; ?></div>
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
                                                <li><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                        <?php } ?>
                                        </ul>
                                        <?php } else { ?>
                                        <ul class="list-inline marg_0">
                                            <li></li>

                                        </ul>
                                        <?php } ?>
                                    <?php if (!empty($feedback)) { ?>
                                        <span><?php echo '(' . $feedback['Projectfeedback']['score'] . ')'; ?> <?php
                                        if (!empty($Reviews)) {
                                            echo $Reviews . ' reviews';
                                        } else {
                                            echo '0 reviews';
                                        }
                                        ?>   </span>
                                    <?php } else { ?>
                                        <span><?php echo '(0.00) 0 reviews'; ?></span>
                                    <?php } ?>
                                </div>

                                <div class="col-md-7 font_16">

                                    <i class="mrg_r5"><img alt="location icon image" src="<?php echo $this->webroot; ?>img/location1.png"></i><?php
                        if (!empty($country_name)) {
                            echo $country_name['Country']['name'];
                        } else {
                            echo "No Country Added";
                        }
                        ?>

                                </div>
                                <div class="clearfix"></div>

                                <span class="col-md-12 padd_tb15 font_16 text-muted">Member since <?php echo date('F d Y', strtotime($job_datas['User']['created'])); ?></span>

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
                                    <img class="img-thumbnail" src="<?php echo $this->webroot; ?>img/freelancer.png" alt="Freelancer user image" />
                                        <?php } ?>   
                            </div>
                            <div class="col-sm-6 col-md-8 middle_dv">
                                <h5><?php echo ucfirst($val['User']['first_name']) . '  ' . ucfirst($val['User']['last_name']); ?></h5>
                                <h4><?php echo $val['User']['job_title']; ?></h4>
                                <div class="lesval">
                                    <p><?php
                        if (!empty($val['User']['description'])) {
                            echo substr($val['User']['description'], 0, 150) . '..........';
                            ?> <a href="JavaScript:void(0);" class="more" style="font-size: 15px; text-decoration: none;">More</a> <?php
                        } else {
                            echo '<p style="color: rgb(187, 187, 187); padding: 17px; font-size: 19px;"> No other Information about yourself added in your Profile, <br> Please Complete Your Profile !</p>';
                        }
                                        ?></p>   </div>

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
                                            <?php
                                            if ($i == '3') {
                                                break;
                                            }$i++;
                                        }
                                        ?>
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

                <?php } else { ?>
            <h2 class="header_style"><span class="large_font text-left"> </span> <span class="text_green marg_l20 font_18"> 
                </span>
            </h2>
            <!--        <hr class="brder_btm">-->
            <div class="row">
                <div class="col-md-12 col-sm-8 marg_btm30">
                    <div class="clearfix"></div>
                            <?php
//                            pr($_SESSION);
//                            die('sdjsdjfjsd');
                            ?>
                    <div class="bg_white freelaners marg_btm30">
                        <div class="green">
                            Search Results <span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt="detail icon image"></i></span>
                            <div class="clearfix"></div>   </div>
                        <div class="col-md-10 colsm-10 marg_tb15">
            <?php if (empty($user))  ?>
                            <p style="color: red; text-align: center;"> <strong>Sorry,</strong>No record   <?php if(isset($_SESSION['search_content']) and !empty($_SESSION['search_content'])){ echo 'for '.'<strong>'.$_SESSION['search_content'].'</strong>'; }else{ echo 'found!'; } ?> 
                            </p>      
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
    <?php } ?>
    </div>

    <style>
        .current{
            background: none repeat scroll 0 0 #DA423D !important; 
            float: left;
            height: 34px !important;
            margin-top: 2px;
            width: 36px;
            padding-top: 6px;
            padding-left: 12px;
            /*        color: white;*/
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
            $(document).on('click', '.less_skill', function() {
                $(this).parent().prev().removeClass('hide');
                $(this).parent().addClass('hide');
            });
            $(document).on('click', '.more_skil', function() {
                $(this).parent().parent().next().removeClass('hide');
                $(this).parent().parent().addClass('hide');
            });
            $(document).on('click', '.less_skil', function() {
                $(this).parent().parent().prev().removeClass('hide');
                $(this).parent().parent().addClass('hide');
            });
        });
    </script>
<?php } ?>   


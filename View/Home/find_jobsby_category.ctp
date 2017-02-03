<div class="container">
    <h2 class="header_style">
        <?php if (!empty($count_job) and $count_job != 0) { ?>
            <span class="large_font text-left">
                <?php
                if (!empty($Category)) {
                    echo $Category['Category']['name'];
                }
                ?>  Jobs</span> 
        <?php } else { ?>
            <span class="large_font text-left">
                <?php
                if (!empty($Category)) {
                    echo $Category['Category']['name'];
                }
                ?>  Jobs</span> <?php } ?>
        <span class="text_green marg_l20 font_18"> <?php echo '(' . $count_job . ' were found based on your criteria )'; ?></span>
        <!--        <a type="Button" class="btn btn-sm  btn_red btn_red12 pull-right" <button="" href="/developer/freelancer/postajob">Post a job</a>-->
        <div class="clearfix"></div>
    </h2>
    <hr class="brder_btm">
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
                    <div class="web_job">
                        <ul class="list-group padd_tb15">
                            <li class="list-group-item active"> <a href="<?php echo $this->webroot; ?>home/find_jobsby_category/<?php echo $Category['Category']['id']; ?>" style="text-decoration: none"><?php echo $Category['Category']['name']; ?></a></li>
                        </ul>
                    </div>
                    <div class="sub_content">
                        <div class="clearfix"></div>
                        <div class="brder_tb">
                            <h4 class="marg_0">Subcategory</h4>
                        </div>
                        <div>

                            <ul class="list-group padd_tb15">
                                <?php foreach ($Category['Subcategory'] as $value) { ?>
                                    <li class="list-group-item"> <a href="#" style="text-decoration: none"><?php echo $value['category_name']; ?></a></li>
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
                                <?php if (isset($job_count_oneday) and !empty($job_count_oneday)) { ?>
                                    <li class="list-group-item"> <a href="#">Last 24 Hours (<?php echo $job_count_oneday; ?>)</a></li><?php } else { ?>
                                    <li class="list-group-item"> <a href="#">Last 24 Hours (0)</a></li>
                                <?php } ?>
                                <?php if (isset($job_count_threedays) and !empty($job_count_threedays)) { ?>
                                    <li class="list-group-item"><a href="#">Last 3 Days (<?php echo $job_count_threedays; ?>)</a></li><?php } else { ?>
                                    <li class="list-group-item"><a href="#">Last 3 Days (0)</a></li>
                                <?php } ?>
                                <?php if (isset($job_count_sevendays) and !empty($job_count_sevendays)) { ?>
                                    <li class="list-group-item"><a href="#">Last 7 Days (<?php echo $job_count_sevendays; ?>)</a></li> <?php } else { ?>
                                    <li class="list-group-item"><a href="#">Last 7 Days (0)</a></li>
                                <?php } ?>
                                <?php if (isset($job_count_fourteendays) and !empty($job_count_fourteendays)) { ?>
                                    <li class="list-group-item"><a href="#"  style="text-decoration:none">Last 14 Days (<?php echo $job_count_fourteendays; ?>)</a></li><?php } else { ?>
                                    <li class="list-group-item"><a href="#"  style="text-decoration:none">Last 14 Days (0)</a></li> <?php } ?>
                                <?php if (isset($job_count_thirtydays) and !empty($job_count_thirtydays)) { ?>
                                    <li class="list-group-item"><a href="#"  style="text-decoration:none">Last 30 Days (<?php echo $job_count_thirtydays; ?>)</a></li>
                                <?php } else { ?>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none">Last 30 Days (0)</a></li>
                                <?php } ?>
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
            if (!empty($jobdata) and isset($jobdata)) {
                foreach ($jobdata as $key => $val) {
                    ?>
                    <div class="bg_white freelaners marg_btm30">
                        <div class="green">
                            <a style="color:white; text-decoration: none" href="<?php echo $this->webroot; ?>home/jobdetail/<?php echo $val['Job']['id']; ?>">
                                <?php echo $val['Job']['job_title']; ?></a>
                        </div>
                        <div class="col-md-12 colsm-12 marg_tb15 lesval">
                            <p><?php echo substr($val['Job']['description'], 0, 250) . '....'; ?>                                   <a class="more" href="JavaScript:void(0);">more</a>
                            </p>
                        </div>
                        <div class="col-md-12 colsm-12 marg_tb15 moreval hide">
                            <p><?php echo $val['Job']['description']; ?>                                  <a class="less" href="JavaScript:void(0);">less</a>
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
                                <?php if ( !empty($total_skills) and $total_skills >= 4) { ?>
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
                                <i><img alt="Project icon image" src="<?php echo $this->webroot; ?>img/project_img.png"></i><span class=" text_green">Est. Budget:<?php echo $val['Job']['budget']; ?></span>
                            </div>
                            <div class="location pull-right">
                                <i><img alt="Clock icon image" src="<?php echo $this->webroot; ?>img/clock.png"></i><span class=" text_green"> <?php echo $val['Job']['time_duration']; ?> </span>

                            </div>
                            <div class="location pull-right">
                                <i><img alt="Project icon image" src="<?php echo $this->webroot; ?>img/project_img.png"></i><span class=" text_green">Posted by :<?php echo ' '.ucfirst($postedBy['User']['first_name'] ). '  ' . ucfirst($postedBy['User']['last_name']); ?></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-md-12 col-sm-8 marg_btm30">
                    <div class="clearfix"></div>
                    <div class="bg_white freelaners marg_btm30">
                        <div class="green">
                            Results<span class="date pull-right"><i class="mrg_r5"></i></span>
                            <div class="clearfix"></div>   </div>
                        <div class="col-md-10 colsm-10 marg_tb15">
                            <p style=" color:#FF6C6E;  text-align: center;"> <strong>Sorry,</strong>No record found related to <strong><?php echo $Category['Category']['name']; ?></strong> category</p>      
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
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



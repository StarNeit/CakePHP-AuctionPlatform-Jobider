<div class="container">
    <?php if (!empty($job_count)) { ?>
        <?php if ($job_count > 1) { ?>
            <h2 class="header_style"><span class="large_font text-left"><?php echo $category_name['Category']['name']; ?> Jobs</span> <span class="text_green marg_l20 font_18">  (<?php echo $job_count; ?>  jobs were  found based on your criteria )</span>

                <div class="clearfix"></div>
            </h2>
        <?php } else { ?>
            <h2 class="header_style"><span class="large_font text-left"><?php echo $category_name['Category']['name']; ?> Jobs</span> <span class="text_green marg_l20 font_18">  (<?php echo $job_count; ?>  job was  found based on your criteria )</span>

                <div class="clearfix"></div>
            </h2>
        <?php } ?>

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
                                <?php foreach ($sidebar_category as $val) { ?>
                                    <li class="list-group-item"> <a href="#" style="text-decoration:none;"><?php echo $val['Category']['name']; ?></a></li>

                                <?php } ?>
                            </ul>

                        </div>


                        <div class="sub_content">


                            <div class="clearfix"></div>
                            <div class="brder_tb">

                                <h4 class="marg_0">Subcategory</h4>
                            </div><div>
                                <ul class="list-group padd_tb15">
                                    <?php foreach ($subcategory as $val) { ?>
                                        <li class="list-group-item"> <a href="#" style="text-decoration:none;"><?php echo $val['Subcategory']['category_name']; ?></a></li>

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
                                    <li class="list-group-item"> <a href="#" style="text-decoration:none;">Last 24 Hours (<?php echo $job_count_oneday; ?>)</a></li>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 3 Days (<?php echo $job_count_threedays; ?>)</a></li>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 7 Days (<?php echo $job_count_sevendays; ?>)</a></li>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 14 Days (<?php echo $job_count_fourteendays; ?>)</a></li>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 30 Days (<?php echo $job_count_thirtydays; ?>)</a></li>

                                </ul>

                            </div>
                        </div>

                    </form>
                    <div class="clearfix"></div>
                    <!-- List group -->


                </div>



            </div>

            <div class="col-md-8 col-sm-8 marg_btm30">

                <ul class="pagination pull-right pagi">
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
                    <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
                </ul>
                <div class="clearfix"></div>
                <?php foreach ($job_data as $val) { ?>
                    <div class="bg_white freelaners marg_btm30">

                        <div class="green">
                            <?php echo $this->Html->link($val['Job']['job_title'], array('controller' => 'findfreelancer', 'action' => 'jobscategory', $val['Job']['id']), array('class' => 'makewhite')); ?>
                        </div>




                        <div class="col-md-12 colsm-12 marg_tb15 lesval">

                            <p><?php echo substr($val['Job']['description'], 0, 200) . '.......'; ?>
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
                            <?php foreach ($val['Job']['Subskill'] as $key => $vall) { ?>
                                <button disabled="" type="button" class="subskil"><?php echo $vall['Subskill']['skill_name']; ?></button>
                            <?php } ?>


                        </div>
                        <div class="clearfix"></div>
                        <div class="bg_grey1 pull-left marg_t5">           
                            <div class="location pull-right">

                                <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project image icon"/></i><span class=" text_green"><?php echo ucfirst($val['Job']['Client_record']['User']['first_name']).' '.  ucfirst($val['Job']['Client_record']['User']['last_name']);  ?></span>

                            </div>
                            <div class="location pull-right">

                                <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="projcet image icon"/></i><span class=" text_green">Est. Budget: <?php echo $val['Job']['budget']; ?> </span>

                            </div>

                            <div class="location pull-right">

                                <i><img src="<?php echo $this->webroot; ?>img/clock.png" alt="Clock image icon"/></i><span class=" text_green"> Posted 4 hours, 51 minutes ago</span>

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
                        <p style="color: red; text-align: center;"> <strong>Sorry,</strong>No record found related to <strong><?php echo $sub_text; ?></strong> category</p>      
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
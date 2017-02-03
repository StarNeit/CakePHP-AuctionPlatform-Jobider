<div class="container">

    <h2 class="header_style"><span class="large_font text-left"><?php echo $sub_data['Category']['name']; ?> Jobs</span> <span class="text_green marg_l20 font_18">  (<?php echo $count_job; ?> were found based on your criteria )</span>
        <a href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'client')); ?>"><button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button></a>

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
                                <li class="list-group-item"> <a href="<?php echo $this->webroot; ?>findfreelancer/category_jobs/<?php echo $id; ?>"><?php echo $value['Category']['name']; ?>(<?php echo $job_count[$id]; ?>)</a></li>
<?php } ?>

                        </ul>

                    </div>


                    <div class="sub_content">


                        <div class="clearfix"></div>
                        <div class="brder_tb">

                            <h4 class="marg_0">Subcategory</h4>
                        </div><div>
                            <ul class="list-group padd_tb15">
                                <?php foreach ($subcategory as $va) { ?>
                                    <li class="list-group-item"> <a href="#"><?php echo $va['Subcategory']['category_name']; ?></a></li>
<?php } ?>

                            </ul>

                        </div>
                    </div>

                    <div class="sub_content">


                        <div class="clearfix"></div>
                        <div class="brder_tb">

                            <h4 class="marg_0">Date Posted</h4>
                        </div>
                        <div>
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
    <?php echo $this->Html->link($val['Job']['job_title'], array('controller' => 'findfreelancer', 'action' => 'jobscategory', $val['Job']['id']), array('class' => 'makewhite')); ?>
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
                        <?php
                        $k = 0;
                        if (!empty($val['Job']['realskill'])) {
                            foreach ($val['Job']['realskill'] as $kk => $vv) {
                                ?>
                                <button class="subskil" disabled=""><?php echo $vv['Subskill']['skill_name']; ?></button>
                            <?php
                            }
                        } else {
                            echo 'No Skill(s) selected.';
                        }
                        $k++;
                        ?>

                    </div>
                    <div class="clearfix"></div>
                    <div class="bg_grey1 pull-left marg_t5">
                        <div class="location pull-right">

                            <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Estimated Budget icon"/></i><span class=" text_green">Est. Budget: <?php echo $val['Job']['budget'] . '.00'; ?> </span>

                        </div>

                        <div class="location pull-right">
                            <i><img src="<?php echo $this->webroot; ?>img/clock.png" alt="Clock image icon"/></i><span class=" text_green"><?php echo 'Posted  ' . $val['Job']['time_duration']; ?></span>
                        </div>

                        <div class="location pull-right">

                            <i><img src="<?php echo $this->webroot; ?>img/clock.png" alt="Clock image icon"/></i><span class=" text_green"><?php if($val['Job']['users']['User']){ echo 'Posted  By :  ' . ucfirst($val['Job']['users']['User']['first_name']) . '  ' . ucfirst($val['Job']['users']['User']['last_name']); }?></span>

                        </div>



                    </div>


                    <div class="clearfix"></div>

                </div>
<?php } ?>

        </div>



    </div>
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

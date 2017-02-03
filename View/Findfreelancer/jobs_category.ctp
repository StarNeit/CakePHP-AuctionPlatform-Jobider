<div class="container">
    <?php if (!empty($count_job) and ( $count_job != 0)) { ?>
        <h2 class="header_style"><span class="large_font text-left"><?php echo $sub_text; ?> Jobs</span> <span class="text_green marg_l20 font_18">  (<?php echo $count_job; ?> were found based on your criteria )</span>
            <a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'postajob')); ?>"><button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button></a>

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
                                <h4 class="marg_0">Subcategory</h4>
                            </div><div>
                                <ul class="list-group padd_tb15">
                                    <?php foreach ($subcategory as $va) { 
                                        $sub_id=$va['Subcategory']['id']?>
                                        <li class="list-group-item"> <a href="#"><?php echo $va['Subcategory']['category_name']; ?><?php echo '('.$job_count[$sub_id].')'; ?></a></li>
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
                                    <li class="list-group-item"> <a href="#" style="text-decoration:none;">Last 24 Hours <?php echo '('.$job_count_oneday.')'; ?></a></li>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none;" >Last 3 Days <?php echo '('.$job_count_threedays.')'; ?></a></li>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 7 Days <?php echo '('.$job_count_sevendays.')'; ?></a></li>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 14 Days <?php echo '('.$job_count_fourteendays.')'; ?></a></li>
                                    <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 30 Days <?php echo '('.$job_count_thirtydays.')'; ?></a></li>                                </ul>
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
                                <?php if (!empty($total)  && $total > 4) { ?>
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
                                        <?php $k++;
                                    } ?>
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
    $(document).ready(function () {
        $(document).on('click', '.more_skill', function () {
            $(this).parent().next().removeClass('hide');
            $(this).parent().addClass('hide');
        });

    });
    $(document).ready(function () {
        $(document).on('click', '.less_skill', function () {
            $(this).parent().prev().removeClass('hide');
            $(this).parent().addClass('hide');

        });
    });
</script>
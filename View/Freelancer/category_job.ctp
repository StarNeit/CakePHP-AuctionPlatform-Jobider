<div class="container">

    <h2 class="header_style">
        <?php if (!empty($job_count) && $job_count != 0) { ?>
            <span class="large_font text-left">
                <?php echo $category_value['Category']['name']; ?> Jobs</span> <span class="text_green marg_l20 font_18">  (<?php echo $job_count; ?> were found based on your criteria )</span>
            <!-- <button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button>-->

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
                        <div class="web_job">
                            <ul class="list-group padd_tb15">
                                <?php foreach ($categories as $val) { ?>
                                    <?php
                                    if ($val['Category']['name'] == $category_value['Category']['name']) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }
                                    ?>
                                    <li class="list-group-item <?php echo $active; ?>"> <a href="<?php echo $this->webroot; ?>freelancer/find_jobsby_category/<?php echo $val['Category']['id']; ?>"><?php echo $val['Category']['name']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>


                        <div class="sub_content">


                            <div class="clearfix"></div>
                            <div class="brder_tb">

                                <h4 class="marg_0">Subcategory</h4>
                            </div>
                            <div class="web_job">
                                <ul class="list-group padd_tb15">
                                    <?php
                                    foreach ($subcategory as $key => $value) {
                                        $sib_id = $value['Subcategory']['id']
                                        ?>
                                        <?php
                                        if ($this->params['pass']['0'] == $value['Subcategory']['id']) {
                                            $active = 'active';
                                        } else {
                                            $active = '';
                                        }
                                        ?>
                                        <li class="list-group-item <?php echo $active; ?>"> <a href="#"><?php echo $value['Subcategory']['category_name']; ?>(<?php echo $job_counts[$sib_id]; ?>)</a></li>
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
                    <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
                </ul>
                <div class="clearfix"></div>
                <?php foreach ($job_detail as $key => $val) { ?>
                    <div class="bg_white freelaners marg_btm30">
                        <div class="green">
                            <?php echo $this->Html->link($val['Job']['job_title'], array('controller' => 'freelancer', 'action' => 'jobdetail', $val['Job']['id']), array('class' => 'makewhite')); ?>
                        </div>
                        <div class="col-md-12 colsm-12 marg_tb15 lesval">
                            <p><?php echo substr($val['Job']['description'], 0, 300) . '.....'; ?>                                 <a href="JavaScript:void(0);" class ="more">more</a>
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
                                if (!empty($val['Job']['skill'])) {
                                    $total_skill = count($val['Job']['skill']);
                                    $k = 0;
                                    foreach ($val['Job']['skill'] as $kk => $vv) {
                                        ?>
                                        <button type='button' class='subskil'disabled> <?php echo $vv['Subskill']['skill_name']; ?>
                                        </button>
                                        <?php
                                        if ($k == '9') {
                                            break;
                                        }$k++;
                                        ?>
                                    <?php }
                                } ?>
                                <?php if ($total_skill >= 9) { ?>
                                    <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills </a>
        <?php } ?>
                            </div>     
                                 <div class="col-md-10 colsm-10 more_skills hide ">
                                <?php
                                if (!empty($val['Job']['skill'])) {
                                    $total_skill = count($val['Job']['skill']);
                                    $k = 0;
                                    foreach ($val['Job']['skill'] as $kk => $vv) {
                                        ?>
                                        <button type='button' class='subskil'disabled> <?php echo $vv['Subskill']['skill_name']; ?>
                                        </button>
                                        <?php
                                      $k++;
                                        ?>
                                    <?php }
                                } ?>
                    
                                    <a href="JavaScript:void(0);" class="subskil less_skill"  style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills </a>
       
                            </div>     
                        </div>
                        <div class="clearfix"></div>
                        <div class="bg_grey1 pull-left marg_t5">
                            <div class="location pull-right">
                                <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project icon image"/></i><span class=" text_green">Est. Budget: <?php if (!empty($val['Job']['budget'])) {
            echo '$' . $val['Job']['budget'];
        } else {
            echo '$0.00';
        } ?> </span>
                            </div>
                            <div class="location pull-right">
                                <i><img src="<?php echo $this->webroot; ?>img/clock.png" alt="Clock icon image"/></i><span class="text_green"> Posted on :
                                    <?php if ($val['Job']['days'] > 0) { ?>
                                        <?php echo $val['Job']['days'] ?> days
                                    <?php } ?>
                                    <?php
                                    if ($val['Job']['hours'] > 0) {
                                        echo $val['Job']['hours']
                                        ?> hours 
        <?php } ?>
                                <?php
                                if ($val['Job']['minutes'] > 0) {
                                    echo $val['Job']['minutes']
                                    ?> minutes ago </span>
        <?php } ?>  
                            </div>  
                            <div class="location pull-right">
                    <?php foreach ($val['Job']['user_name'] as $kk => $va) { ?>
                                    <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project icon image"/></i><span class=" text_green">Posted By: <?php echo ucfirst($va['User']['first_name']) . '   ' . ucfirst($va['User']['last_name']); ?> </span>
        <?php } ?>
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
        <div class="row">
            <div class="col-md-10 col-sm-8 marg_btm30 else" style="margin-left:139px">
                <div class="clearfix"></div>
                <div class="bg_white freelaners marg_btm30">
                    <div class="green">
                        Search Results<span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt="Detail icon Image"></i></span>
                        <div class="clearfix"></div>   </div>
                    <div class="col-md-10 colsm-10 marg_tb15">
                        <p style="color: #C7C4C8; text-align: center; font-size:20px;"> <strong>Sorry,</strong>No record found related to <strong><?php echo $sub_text; ?></strong> category</p>                          </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
<?php } ?>
</div>
<style>
    .col-md-9 col-sm-8 marg_btm30 else{
        margin-left: 139px !important;
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
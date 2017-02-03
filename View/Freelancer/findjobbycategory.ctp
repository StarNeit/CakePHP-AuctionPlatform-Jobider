<div class="container">
    <h2 class="header_style">
        <?php if (!empty($count_job) and $count_job != 0) { ?>
            <span class="large_font text-left">
                <?php
                if (!empty($category)) {
                    echo $category['Category']['name'] . '  Jobs';
                }
                ?> </span> <span class="text_green marg_l20 font_18"> <?php echo '( ' . $count_job . '   were found based on your criteria )'; ?></span>
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
                                        if ($value['Category']['id'] == $category['Category']['id']) {
                                            $active = 'active';
                                        } else {
                                            $active = '';
                                        }
                                        ?>
                                        <li class="list-group-item <?php echo $active; ?>"> <a href="<?php echo $this->webroot; ?>freelancer/find_jobsby_category/<?php echo $value['Category']['id'] ?>" style="text-decoration:none"><?php echo $value['Category']['name']; ?></a></li>
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
                                        <li class="list-group-item"> <a href="<?php echo $this->webroot; ?>freelancer/findjobbycategory" style="text-decoration:none"><?php echo $value['Subcategory']['category_name'] ?></a></li>
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
                                    <li class="list-group-item"> <a  style="text-decoration:none;">Last 24 Hours <?php echo '(' . $job_count_oneday . ')'; ?></a></li>
                                    <li class="list-group-item"><a  style="text-decoration:none">Last 3 Days<?php echo '(' . $job_count_threedays . ')'; ?></a></li>
                                    <li class="list-group-item"><a  style="text-decoration:none;">Last 7 Days<?php echo '(' . $job_count_sevendays . ')'; ?></a></li>
                                    <li class="list-group-item"><a style="text-decoration:none;">Last 14 Days <?php echo '(' . $job_count_fourteendays . ')'; ?></a></li>
                                    <li class="list-group-item"><a  style="text-decoration:none;">Last 30 Days <?php echo ' (' . $job_count_thirtydays . ')'; ?></a></li>

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
                                <a href="<?php echo $this->webroot; ?>freelancer/jobdetail/<?php echo $value['Job']['id']; ?>" style="color:white; text-decoration: none">
                                    <?php echo $value['Job']['job_title'] ?>
                                </a>
                            </div>
                            <div class="col-md-12 colsm-12 marg_tb15 lesval">
                                <p><?php echo substr($value['Job']['description'], 0, 250) . '....'; ?>    <a href="JavaScript:void(0);" class="more">more</a>
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
                                    if (!empty($value['Job']['skill'])) {
                                        $total_skills = count($value['Job']['skill']);
                                        $j = 0;
                                        ?>
                                        <?php foreach ($value['Job']['skill'] as $kk => $v) { ?>
                                            <button type='button' class='subskil'disabled> <?php echo $v['Subskill']['skill_name']; ?>
                                            </button>
                                            <?php
                                            if ($j == '3') {
                                                break;
                                            }$j++;
                                            ?>
                                        <?php }
                                    } ?>
                                    <?php if ($total_skills >= 3) { ?>
                                        <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills </a>
            <?php } ?>
                                </div>  

                                <div class="col-md-10 colsm-10 more_skills hide">
                                    <?php
                                    if (!empty($value['Job']['skill'])) {
                                        $total_skills = count($value['Job']['skill']);
                                        $j = 1;
                                        ?>
                <?php foreach ($value['Job']['skill'] as $kk => $v) { ?>
                                            <button type='button' class='subskil'disabled> <?php echo $v['Subskill']['skill_name']; ?>
                                            </button>
                                            <?php
                                            $j++;
                                            ?>
                                        <?php
                                        }
                                    }
                                    ?>

                                    <a href="JavaScript:void(0);" class="subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills </a>

                                </div>  
                            </div>
                            <div class="clearfix"></div>
                            <div class="bg_grey1 pull-left marg_t5">
                                <div class="location pull-right">
                                    <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project icon image"/></i><span class=" text_green">Est. Budget: <?php echo '$' . $value['Job']['budget']; ?></span>
                                </div>
                                <div class="location pull-right">
                                    <i><img src="<?php echo $this->webroot; ?>img/clock.png" alt="Clock icon image"/></i><span class=" text_green"> <?php echo $value['Job']['time_duration'] ?></span>

                                </div>
                                <div class="location pull-right">
                                    <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project icon image"/></i><span class=" text_green">Posted by : <?php echo '  ' . ucfirst($postedBy['User']['first_name']) . '  ' . ucfirst($postedBy['User']['last_name']); ?></span>
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
                        <div style="text-align:center; color:#C7C4C8;" class="col-md-12 colsm-12 marg_tb15"><span> <strong> No Job(s) Found under this category ! </strong> </span></div>
                        <div class="clearfix"></div>
                        <hr class="brder_btm1 marg_0">
                        <div class="tabs_1 col-md-12 marg_t5">
                        </div>
                    </div>
        <?php } ?>
            </div>
        </div>
<?php } else { ?>
        <h2 class="header_style"><span class="large_font text-left"> </span> <span class="text_green marg_l20 font_18"> 
            </span>
        </h2>
        <!--        <hr class="brder_btm">-->
        <div class="row">
            <div class="col-md-12 col-sm-8 marg_btm30">
                <div class="clearfix"></div>
                <div class="bg_white freelaners marg_btm30">
                    <div class="green">
                        Search Results <span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?><img/deatil.png" alt="detail icon image"></i></span>
                        <div class="clearfix"></div>   </div>
                    <div class="col-md-10 colsm-10 marg_tb15">
                        <p style="color: rgb(199, 196, 200); text-align: center; margin-top: 43px; font-size: 20px; margin-left: 105px;"> <strong>Sorry,</strong>No record found related to <strong> <?php echo $_SESSION['cat_name']; ?></strong> category
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

    });
    $(document).ready(function() {
        $(document).on('click', '.less_skill', function() {
            $(this).parent().prev().removeClass('hide');
            $(this).parent().addClass('hide');

        });
    });
</script>


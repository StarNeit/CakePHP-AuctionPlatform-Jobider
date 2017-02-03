<div class="container">
    <?php if (!empty($user_count) && ($user_count != 0)) { ?>
        <h2 class="header_style"><span class="large_font text-left"><?php echo $subskill['Skill']['name']; ?></span> <span class="text_green marg_l20 font_18">  (Showing <?php echo '<strong id =freelancer_count>' . $user_count . '</strong>'; ?> freelancers)
            </span>
        </h2>
        <hr class="brder_btm"/>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="green_bg panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"> <h3 class="marg_0">Narrow results by:</h3></div>
                    <?php echo $this->Form->create('Userskill', array('class' => 'cust_form sider_bar_form', 'url' => array('
	controller' => 'findfreelancer', 'action' => 'freelancer_skill'))); ?>
                    <form class="cust_form sider_bar_form">
                        <div class="panel1">
                            <h4 class="marg_0">Skills</h4>
                        </div>
                        <div class=" col-md-12">
                            <?php echo $this->Form->input('skills', array('class' => 'form-control skill', 'type' => 'select', 'label' => false, 'options' => array('' => 'Select Skill', $skill_name))); ?>
                        </div>
                        <div class="sub_content" >
                            <div class="clearfix"></div>
                            <div class="brder_tb">
                                <h4 class="marg_0">Subskills</h4>
                            </div><div class=" col-md-12">
                                <?php echo $this->Form->input('sub_skills', array('class' => 'form-control subskill', 'type' => 'select', 'label' => false, 'options' => array('' => 'Select Subkill'))); ?>
                            </div>
                        </div>
                        <div class="sub_content">
                            <div class="clearfix"></div>
                            <div class="brder_tb">
                                <h4 class="marg_0">Country</h4>
                            </div><div class=" col-md-12">
                                <?php echo $this->Form->input('country', array('class' => 'form-control country', 'type' => 'select', 'label' => false, 'options' => array('' => 'Select Country', $country_name))); ?>
                            </div>
                        </div>
                        <div class="sub_content">
                            <div class="clearfix"></div>
                            <div class="brder_tb">
                                <h4 class="marg_0">Feedback Score</h4>
                            </div>
                            <div class=" col-md-12">
                                <h4 class="text_green">Any Feedback Score (80,016) </h4>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 4.5 & above (36,254)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">4.0 & above (41,459)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">3.0 & above (44,946)
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 2.0 & above (46,231)
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">1.0 & above (47,301) 
                                    </label>
                                </div>

                            </div>
                        </div>

                        <?php echo $this->Form->end(); ?>
                        <div class="clearfix"></div>
                        <!-- List group -->


                </div>



            </div>

            <div class="col-md-8 col-sm-8 marg_btm30 search_data">

                <div class="clearfix"></div>
                <?php foreach ($user_info as $val) { ?>
                    <div class="bg_white freelaners marg_btm30">

                        <div class="green">
                            <?php echo $val['User']['first_name'] . '&nbsp;' . $val['User']['last_name']; ?><span class="date pull-right"><i class="mrg_r5"><img alt="detail icon image" src="<?php echo $this->webroot; ?>img/deatil.png"></i><?php echo $val['User']['job_title']; ?><?php echo '(' . $val['User']['LimitedSkills'] . ')'; ?></span>
                            <div class="clearfix"></div>  </div>


                        <div class="col-md-2 col-sm-2 marg_tb15">

                            <img src="<?php echo $this->webroot; ?>uploads/<?php echo $val['User']['image']; ?>" alt="login user image" class="img-thumbnail" height="auto" width="100%">

                        </div>

                        <div class="col-md-10 colsm-10 marg_tb15 lesval">

                            <p><?php echo substr($val['User']['description'], 0, 300) . '.....'; ?> 
                                <a href="JavaScript:void(0);" class="more">more</a>
                            </p>

                        </div>
                        <div class="col-md-10 colsm-10 marg_tb15 moreval hide">

                            <p><?php echo $val['User']['description']; ?> 
                                <a href="JavaScript:void(0);" class="less">less</a>
                            </p>
                        </div>

                        <div class="clearfix"></div>
                        <hr class="brder_btm1 marg_tb15">

                        <div class="tabs_1 col-md-12">
                            <?php $ke = 0; ?>
                            <?php
                            if (!empty($val['User']['skill_data'])) {
                                foreach ($val['User']['skill_data'] as $kk => $vv) {
                                    ?>
                                    <button class="subskil" type="button" disabled><?php echo $vv['Subskill']['skill_name']; ?></button>
                                <?php } ?>
                                <?php
                            } else {
                                echo "No skill Selected";
                                ?>
                                <?php
                            }
                            $ke++;
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="bg_grey1 pull-left marg_t5">
                            <div class="rating pull-left">
                                <span class="text_green pull-left">4.8 Star</span>
                                <ul class=" list-inline pull-left ">
                                    <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
                                    <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
                                    <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
                                    <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
                                    <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>

                                </ul>

                            </div>  

                            <div class="location pull-left">
                                <?php foreach ($val['User']['country_name'] as $ks => $ca) {
                                    ?>
                                    <i><img src="<?php echo $this->webroot; ?>img/location.png" alt="location image icon"/></i><span class=" text_green"><?php echo $ca['name']; ?></span>
                                <?php } ?>
                            </div>

                            <div class="location pull-left">

                                <i><img src="<?php echo $this->webroot; ?>img/check.png" alt="check icon image"/></i><span class=" text_green"><?php echo $date = date('F d Y', strtotime($val['User']['created'])); ?></span>

                            </div>

                            <div class="location pull-left">

                                <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project image icon"/></i><span class=" text_green">12 Completed projects</span>

                            </div>

                            <div class="location pull-left">

                                <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="roject image icon"/></i><span class=" text_green">2 in process</span>

                            </div>
                        </div>


                        <div class="clearfix"></div>

                    </div>
                <?php } ?>



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
            </div>

        <?php } else { ?>
            <h2 class="header_style"><span class="large_font text-left"> </span> <span class="text_green marg_l20 font_18"> 
                </span>
            </h2>
            <div class="row">
                <div class="col-md-12 col-sm-8 marg_btm30">
                    <div class="clearfix"></div>
                    <div class="bg_white freelaners marg_btm30">
                        <div class="green">
                            Search Results<span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt="detail image"></i></span>
                            <div class="clearfix"></div>   </div>
                        <div class="col-md-10 colsm-10 marg_tb15">
                            <p style="color: red; text-align: center;"> <strong>Sorry,</strong>No record found related to <strong><?php echo $sub_text; ?></strong> skill</p>      
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('change', '.skill', function() {
            var skill = $('.skill').val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>findfreelancer/skill_data',
                data: {skill: skill},
                success: function(msg) {
                    if (msg.suc == 'yes') {

                        $('.subskill').html(msg.subskill);
                    }
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', '.skill', function() {
            var skill = $('.skill').val();
            var subskill = $('.subskill').val();
            var country = $('.country').val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>findfreelancer/skills_free',
                data: {skill: skill, subskill: subskill, country: country},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('#freelancer_count').html(msg.count);
                        $('.search_data').html(msg.dataDiv);
                        $('.pagi').html(msg.dataPagi);
                    } else {
                        $('#freelancer_count').html(msg.count);
                        $('.search_data').html(msg.dataDivs);
                        $('.pagi').html(msg.dataPagi);
                    }

                }
            });
        });
        $(document).on('change', '.subskill', function() {
            var skill = $('.skill').val();
            var subskill = $(this).val();
            var country = $('.country').val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>findfreelancer/skills_free',
                data: {subskill: subskill, skill: skill, country: country},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('#freelancer_count').html(msg.count);
                        $('.search_data').html(msg.dataDiv);
                        $('.pagi').html(msg.dataPagi);
                    } else {
                        $('#freelancer_count').html(msg.count);
                        $('.search_data').html(msg.dataDivs);
                        $('.pagi').html(msg.dataPagi);
                    }
                }
            });
        });
        $(document).on('change', '.country', function() {
            var skill = $('.skill').val();
            var subskill = $('.subskill').val();
            var country = $('.country').val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>findfreelancer/skills_free',
                data: {skill: skill, subskill: subskill, country: country},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('#freelancer_count').html(msg.count);
                        $('.search_data').html(msg.dataDiv);
                        $('.pagi').html(msg.dataPagi);
                    } else {
                        $('#freelancer_count').html(msg.count);
                        $('.search_data').html(msg.dataDivs);
                        $('.pagi').html(msg.dataPagi);
                    }
                }
            });
        });
    });
</script>
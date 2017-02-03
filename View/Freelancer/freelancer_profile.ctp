<div class="container">

    <hr class="brder_btm">

    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="green_bg panel panel-default side_bar">
                <!-- Default panel contents -->
                <ul class="nav padd_tb15 publicl_profile">
                    <?php
                    $score = 0;
                    $ik = 0;
                    if (!empty($project_feedback)) {

                        foreach ($project_feedback as $key => $value) {
                            $score += $value['Projectfeedback']['score'];
                            $ik++;
                        }
                    }
                    if ($ik != 0) {
                        $AvgScore = $score / $ik;
                    } else {
                        $AvgScore = 0;
                    }
                    ?>

                    <li><i class="mrg_r5 pull-left"><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star_1.png"></i><span class="mrg_r5 pull-left marg_t5"><?php echo number_format($AvgScore, 0); ?></span><ul class="list-inline">
                            <li></li>
                            <?php
                            $avg = number_format($AvgScore, 0);
                            for ($k = 1; $k <= $avg; $k++) {
                                ?>
                                <li><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                            <?php } ?>
                        </ul></li>
                    <li><i class="mrg_r5 pull-left"><img alt="job icon image" src="<?php echo $this->webroot; ?>img/job.png"></i>
                        <span class="mrg_r5 pull-left marg_t5"><?php
                            if ($total > 1) {
                                echo $total;
                                ?> Total jobs worked<?php
                            } else {
                                echo $total;
                                ?> Total job worked<?php } ?>  <div class="clearfix"></div><strong class="font_12"><?php if ($remain > 1) { ?>(<?php echo $remain; ?> Jobs in process)<?php } else { ?>
                                    (<?php echo $remain; ?> Job in process)
                                <?php } ?></strong></span>

                    </li>
                    <li class="wdf_100"><i class="mrg_r5 pull-left"><img alt="location icon image" src="<?php echo $this->webroot; ?>img/location.png"></i>  <span class="mrg_r5 pull-left marg_t5"><?php echo ucfirst($country['Country']['name']); ?></span></li>

                </ul>
                <!--<div class="col-md-12 text-center">
                
                <button class="btn-lg btn-green col-md-6 col-md-offset-3">Contact</button>
                </div>-->
                <div class="clearfix"></div>
                <!-- List group -->


            </div>

            <div class="green_bg panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"> <h3 class="marg_0">Tasks Taken</h3></div>
                <div class="table-responsive">
                    <?php if (!empty($result)) { ?>
                        <table class="table cust_table">

                            <thead>
                                <tr class="panel1">
                                    <th><h4 class="marg_0">Name</h4></th>
                            <th class="text-right"><h4 class="marg_0">Percentile Score</h4></th>

                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $k => $v) { ?>
                                    <tr>
                                        <?php foreach ($v['test'] as $val) { ?><td><?php echo $val['Test']['title']; ?></td><?php } ?>
                                        <td><?php echo $v['percent']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p  style="text-align: center; font-size: 18px; color :#C7C4C8;padding: 25px; ">You have taken no tasks </p>
<!--                        <table class="table cust_table">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>-->
                    <?php } ?>

                    <!-- List group -->

                </div>

            </div>  

        </div>

        <div class="col-md-8 col-sm-8 marg_btm30">


            <div class="clearfix"></div>

            <div class="bg_white freelaners marg_btm30">

                <div class="green">
                    <a href="<?php echo $this->webroot; ?>freelancer/freelancer_profile" style="text-decoration: none;" class="makewhite"><?php echo ucfirst($user['User']['first_name'] . ' ' . ucfirst($user['User']['last_name'])); ?> </a>
                    <a href="<?php echo $this->webroot; ?>freelancer/freelancer_profile"class="makewhite" style="text-decoration: none"><span class="date pull-right"><?php if (!empty($user['User']['job_title'])) { ?><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt="detail icon mage"></i><?php } ?><?php
                    if (!empty($user['User']['job_title'])) {
                        echo $user['User']['job_title'];
                    }
                    ?> <?php
                    if (!empty($skill_name)) {
                        echo '(' . $skill_name . ')';
                    }
                    ?></span></a>
                    <div class="clearfix"></div></div>


                <div class="col-md-2 col-sm-2 marg_tb15">
                    <?php if (!empty($user['User']['image'])) { ?>
                    <a href="<?php echo $this->webroot; ?>freelancer/freelancer_profile"> <img class="img-thumbnail" alt="login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $user['User']['image']; ?>">
                    </a>
                    <?php } else { ?>
                    <a href="<?php  echo $this->webroot;?>freelancer/freelancer_profile">
                        <img height="65" width="65" alt="freelancer user image" src="<?php  echo $this->webroot;?>img/freelancer.png">
                        </a>
                    <?php } ?>
                </div>
                <?php if (!empty($user['User']['description'])) { ?>
                    <div class="col-md-10 colsm-10 marg_tb15 lesval">

                        <p><?php echo substr($user['User']['description'], 0, 300) . '..........'; ?>
                            <a href="JavaScript:void(0);" class="more">More </a>
                        </p>

                    </div>
                <?php } else { ?>
                    <div class="col-md-10 colsm-10 marg_tb15 lesval">

                        <p>No Description Found !
                            <!--                <a href="JavaScript:void(0);" class="more">more</a>-->
                        </p>

                    </div>
                <?php } ?>
                <div class="col-md-10 colsm-10 marg_tb15 moreval hide">

                    <p><?php echo $user['User']['description']; ?>
                        <a href="JavaScript:void(0);" class="less">Less</a>
                    </p>

                </div>

                <div class="clearfix"></div>
                <hr class="brder_btm1">

                <div class="tabs_1 col-md-12 marg_t5">
                    <div class="col-md-10 colsm-10 less_skills ">
                        <?php
                        if (!empty($skills)) {
                            $total_skills = count($skills);
                            $k = 0;
                            foreach ($skills as $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
                                <?php
                                if ($k == '3') {
                                    break;
                                } $k++;
                            }
                            ?>
                        <?php } else{
                            echo '<p style="color:#7C7A7A;text-align:center;font-size:16px;">No Skills Found in your Profile , Please Complete your Profile !</p>';
                        } ?>
                        <?php if (!empty($total_skills) and $total_skills >= 4) { ?>
                            <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
                        <?php } ?> 
                    </div>
                    <div class="col-md-10 colsm-10 more_skills hide">
                        <?php
                        if (!empty($skills)) {
                            $total_skills = count($skills);
                            $k = 0;
                            foreach ($skills as $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
                                <?php
                                $k++;
                            }
                            ?>
                        <?php } ?>

                        <a href="JavaScript:void(0);" class=" subskil less_skill" style="background: #2A6EB3;color:#fff; text-decoration: none;">Less Skills</a>

                    </div>
                </div>
                <div class="clearfix "></div>
                <br>
                <hr class="brder_btm marg_0">
                <?php if (!empty($project_feedback)) { ?>
                    <div class="col-md-12 ">
                        <h2>Work History and Feedback </h2>
                    </div>   
                    <div class="clearfix"></div>
                    <div class="table-responsive">
                        <table width="88%" class="table marg_tb15 cust_table1">
                            <tbody>
                                <?php foreach ($project_feedback as $k => $v) {
                                    ?>
                                    <tr>
                                        <td width="28%"><span class="pull-left"><?php echo number_format($v['Projectfeedback']['score'], 1); ?></span> <ul class="list-inline pull-left marg_l20">
                                                <?php
                                                $number = number_format($v['Projectfeedback']['score'], 0);
                                                for ($i = 1; $i <= $number; $i++) {
                                                    ?>
                                                    <li><img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png"></li>
                                                <?php } ?>


                                            </ul></td>
                                        <td width="36%"><p><?php echo $v['Projectfeedback']['feedback']; ?></p></td>
                                        <td width="36%"><h5 class="marg_t5 text_2"><?php echo $v['Job']['job_title']; ?></h5>
                                            <p class="text_green marg_0"><?php
                                                if (!empty($v['start_date'])) {
                                                    echo date('d F Y', strtotime($v['start_date']));
                                                }
                                                ?> <font class="text_1">to</font> <?php echo date('d F Y', strtotime($v['Projectfeedback']['created'])); ?></p>
                                            <span class="font_14">Earned <?php
                                                $amt = ($v['Job']['budget'] * 8) / 100;
                                                $earned_amount = $v['Job']['budget'] - $amt;
                                                echo '$' . $earned_amount;
                                                ?></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>    
                    <div class="table-responsive">
                        <table width="88%" class="table marg_tb15 cust_table1">
                            <tbody>
                                <tr>
                                    <td colspan="3" style="text-align: center;font-size: 16px;">No work history for this freelancer.</td>
                                </tr>
                            </tbody>
                        </table>


                    </div> 
                <?php } ?>
                <div class="clearfix"></div>
            </div>






        </div>



    </div>
</div>



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
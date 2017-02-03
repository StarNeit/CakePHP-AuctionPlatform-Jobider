<div class="container">
    <h2 class="header_style"><span class="large_font text-left"><a href="<?php echo $this->Html->Url(array('controller' => 'home', 'action' => 'browseprofile')); ?>">Back to search result</a></span> 
        <div class="clearfix"></div>
    </h2>
    <hr class="brder_btm">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="green_bg panel panel-default side_bar">
                <!-- Default panel contents -->
                <div class="col-md-12 text-center" style="margin-top: 30px;">
                    <a href="<?php echo $this->Html->Url(array('controller' => 'login', 'action' => 'index')); ?>"><button class="btn-lg btn-green col-md-6 col-md-offset-3">Post a Job</button></a><br>
                    <p style="margin-top: 50px;">Or</p>
                    <a href="<?php echo $this->Html->Url(array('controller' => 'login', 'action' => 'index')); ?>"><button class="btn-lg btn-green col-md-6 col-md-offset-3" style="margin-top: 7px;" distabled="disabled">Contact</button></a>
                </div>
                <div class="clearfix"></div>
                <hr class="brder_btm">
                <ul class="nav padd_tb15 publicl_profile">
                    <?php
                    $score = 0;
                    $ik = 0;
                    if (!empty($Projectfeedback)) {
                        foreach ($Projectfeedback as $key => $value) {
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
                    <li><i class="mrg_r5 pull-left">
                            <img alt="" src="<?php echo $this->webroot; ?>img/star_1.png"></i>
                        <span class="mrg_r5 pull-left marg_t5"><?php echo number_format($AvgScore, 0); ?></span>
                        <ul class="list-inline">
                            <?php
                            $AvgScore = number_format($AvgScore, 0);
                            for ($j = 1; $j <= $AvgScore; $j++) {
                                ?>     
                                <li><img src="<?php echo $this->webroot; ?>img/star.png" alt=""/></li> <?php } ?>     </ul></li><br>
                    <li><i class="mrg_r5 pull-left"><img alt="" src="<?php echo $this->webroot; ?>img/job.png"></i>
                        <span class="mrg_r5 pull-left marg_t5"><?php
                            if ($total > 1) {
                                echo $total;
                                ?> Total jobs worked<?php
                            } else {
                                echo $total;
                                ?> Total job worked<?php } ?>  <div class="clearfix"></div><strong class="font_12"><?php if ($remain > 1) { ?>(<?php echo $remain; ?> Jobs in process)<?php } else { ?>
                                    (<?php echo $remain; ?> Job in process)
                                <?php } ?></strong></span>     </li>
                    <li class="wdf_100"><i class="mrg_r5 pull-left"><img alt="" src="<?php echo $this->webroot; ?>img/location.png"></i>  <span class="mrg_r5 pull-left marg_t5"><?php echo $country_name['Country']['name']; ?></span></li>
                </ul>
                <div class="clearfix"></div>
                <!--  List group -->
            </div>
            <div class="green_bg panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"> 
                    <h3 class="marg_0">Tasks Taken</h3>

                </div>         
                <?php if (isset($Tasks_Taken) and !empty($Tasks_Taken)) { ?>
                    <div class="table-responsive">

                        <table class="table cust_table">

                            <thead>
                                <tr class="panel1">
                                    <th><h4 class="marg_0">Name</h4></th>
                            </thead>
                            <tbody>
                                <?php foreach ($Tasks_Taken as $kk => $vv) {
                                    ?>
                                    <tr>
                                        <?php foreach ($vv['Test'] as $Ke => $va) { ?>
                                            <td><?php
                                                if ($vv['Percentage'] > 0) {
                                                    echo $va['Test']['title'];
                                                }
                                                ?></td>
                                        <?php } ?>
                                        <td><?php
                                            if ($vv['Percentage'] > 0) {
                                                echo number_format($vv['Percentage']);
                                            }
                                            ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>


                    <div class="table-responsive">

                        <table class="table cust_table">

                            <thead>
                            </thead>
                            <tbody>
                                <tr><p style="color: #C7C4C8; text-align: center;  font-size: 18px;">    <strong>You have taken no tasks.</strong>
                            </p>
                            </tr>
                            </tbody>
                        </table>
                        <!-- List group -->
                    </div><?php } ?>
                <!-- List group -->
            </div>
        </div>  
        <div class="col-md-8 col-sm-8 marg_btm30">
            <div class="clearfix"></div>
            <div class="bg_white freelaners marg_btm30">
                <div class="green">
                    <a href="<?php echo $this->webroot; ?>home/viewprofile/<?php echo $users['User']['id']; ?>" class="makewhite"><?php echo $users['User']['first_name'] . ' ' . $users['User']['last_name']; ?></a>
                    <a href="<?php echo $this->webroot; ?>home/viewprofile/<?php echo $users['User']['id'] ?>" class="makewhite">
                        <span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt=""></i><?php echo $users['User']['job_title']; ?>      <?php echo '(' . $skills_name . ')'; ?>
                        </span>
                    </a>
                    <div class="clearfix"></div></div>
                <div class="col-md-2 col-sm-2 marg_tb15">
                    <?php if (!empty($users['User']['image'])) { ?>
                        <a href="<?php echo $this->webroot; ?>home/viewprofile/<?php echo $users['User']['id']; ?>" class="makewhite" >
                            <img class="img-thumbnail" alt="" src="<?php echo $this->webroot; ?>uploads/<?php echo $users['User']['image']; ?>" width="200" height="200">
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo $this->webroot; ?>home/viewprofile/<?php echo $users['User']['id']; ?>" class="makewhite" >
                            <img src="<?php echo $this->webroot; ?>img/freelancer.png" class="img-thumbnail" />
                        </a>
                    <?php } ?>
                </div>

                <div class="col-md-10 colsm-10 marg_tb15 lesval">
                    <p><?php echo substr($users['User']['description'], 0, 100) . '....'; ?> 
                        <a href="JavaScript:void(0);" class="more" style="font-size: 15px; text-decoration: none;">more</a>
                    </p>
                </div>

                <div class="col-md-10 colsm-10 marg_tb15 moreval hide">
                    <p><?php echo $users['User']['description'] . '......'; ?>
                        <a href="JavaScript:void(0);" class="less" style="font-size: 15px; text-decoration: none;">less</a>
                    </p>
                </div>
                <div class="clearfix"></div>
                <hr class="brder_btm1">
                <div class="tabs_1 col-md-12 marg_t5">
                    <div class="col-md-10 colsm-10 less_skills ">
                        <?php
                        if (!empty($subskill)) {
                            $total_skills = count($subskill);
                            $k = 0;
                            foreach ($subskill as $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
                                <?php
                                if ($k == '3') {
                                    break;
                                } $k++;
                            }
                            ?>
                        <?php } ?>
                        <?php if ($total_skills >= 4) { ?>
                            <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
                        <?php } ?> 
                    </div>
                    <div class="col-md-10 colsm-10 more_skills hide">
                        <?php
                        if (!empty($subskill)) {
                            $total_skills = count($subskill);
                            $k = 0;
                            foreach ($subskill as $val) {
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
                <div class="col-md-12 ">
                    <h2>Work History and Feedback </h2>
                </div>   <div class="clearfix"></div>
                <div class="table-responsive">
                    <table width="88%" class="table marg_tb15 cust_table1">
                        <tbody>
                            <?php
                            if (!empty($Projectfeedback)) {
                                foreach ($Projectfeedback as $key => $value) {
                                    ?>
                                    <tr>
                                        <td width="17%"><span class="pull-left"><?php echo number_format($value['Projectfeedback']['score'], 1); ?></span>
                                            <ul class="list-inline pull-left marg_l20">
                                                <?php
                                                $number = number_format($value['Projectfeedback']['score'], 0);
                                                for ($i = 1; $i <= $number; $i++) {
                                                    ?> 
                                                    <li><img src="<?php echo $this->webroot; ?>img/star.png" alt=""/></li>
                                                <?php } ?> </ul>
                                        </td>
                                        <td width="36%"><p>
                                                <?php echo $value['Projectfeedback']['feedback']; ?></p></td>
                                        <td width="36%">
                                            <h5 class="marg_t5 text_2"><?php echo $value['Job']['job_title']; ?></h5>
                                            <p class="text_green marg_0"><?php
                                                if (!empty($value['Projectfeedback']['start'])) {
                                                    echo date('d,M Y', strtotime($value['Projectfeedback']['start']));
                                                }
                                                ?><font class="text_1">  to</font> <?php echo date('d,M Y', strtotime($value['Projectfeedback']['created'])); ?></p>



                                            <span class="font_14">Earned $<?php
                                                $amt = ($value['Job']['budget'] * 8) / 100;
                                                echo $value['Job']['budget'] - $amt;
                                                ?></span></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td align="center" colspan="3" style="padding: 30px;">No Work History for this Freelancer</td>
                                </tr>            
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

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

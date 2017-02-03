<div class="container">
    <?php if (!empty($user_data)) { ?>   
        <hr class="brder_btm"/>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="green_bg panel panel-default side_bar">
                    <!-- Default panel contents -->
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
                                <img src="<?php echo $this->webroot; ?>img/star_1.png" alt="image"/>
                            </i>
                            <span class="mrg_r5 pull-left marg_t5"><?php echo number_format($AvgScore, 0); ?></span>
                            <ul class="list-inline">
                                <?php
                                $AvgScore = number_format($AvgScore, 0);
                                for ($j = 1; $j <= $AvgScore; $j++) {
                                    ?>     
                                    <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="image"/></li> <?php } ?>
                            </ul>
                        </li><br/>
                        <li><i class="mrg_r5 pull-left"><img src="<?php echo $this->webroot; ?>img/job.png" alt="image"/></i>
                            <span class="mrg_r5 pull-left marg_t5">
                                <?php echo $total_completed; ?> Total jobs worked <div class="clearfix"></div><strong class="font_12">(<?php echo $total_counts; ?> Jobs in process)</strong></span>   </li>
                                <?php if (!empty($country_name['Country']['name'])) { ?>
                            <li class="wdf_100"><i class="mrg_r5 pull-left"><img src="<?php echo $this->webroot; ?>img/location.png" alt="image"/></i>  <span class="mrg_r5 pull-left marg_t5"><?php echo $country_name['Country']['name']; ?></span></li>
                        <?php } else { ?>
                            <li class="wdf_100"><i class="mrg_r5 pull-left"><img src="<?php echo $this->webroot; ?>img/location.png" alt="image"/></i>  <span class="mrg_r5 pull-left marg_t5">Brazil</span></li>
                        <?php } ?>
                    </ul>


                    <div class="col-md-12 text-center ">

                        <a href='<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'contect_for_freelancer', $user_data['User']['id'])); ?>'><button class="btn-lg btn-green col-md-6 col-md-offset-3">Contact</button></a>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="green_bg panel panel-default">
                    <div class="panel-heading"> <h3 class="marg_0">Tasks Taken</h3></div>
                    <?php if (!empty($tasks)) { ?>
                        <div class="table-responsive">

                            <table class="table cust_table">

                                <thead>
                                    <tr class="panel1">
                                        <th><h4 class="marg_0">Name</h4></th>
                                <th class="text-right"><h4 class="marg_0">Percentile Score</h4></th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $val) { ?>

                                        <tr>
                                            <?php foreach ($val['test'] as $va) { ?>
                                                <td><?php
                                                    if ($val['percent'] > 0) {
                                                        echo $va['Test']['title'];
                                                    }
                                                    ?></td>
                                            <?php } ?>
                                            <td><?php
                                                if ($val['percent'] > 0) {
                                                    echo number_format($val['percent'],0);
                                                }
                                                ?></td>      </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- List group -->

                        </div>
                    <?php } else { ?>
                        <div class="table-responsive">

                            <table class="table cust_table">

                                <thead>

                                </thead>
                                <tbody>
                                    <tr>  <p style="color: #C7C4C8; text-align: center;  font-size: 18px; padding:25px;"> 
                                    <strong>You have taken no tasks.</strong>
                                </p>
                                </tr>

                                </tbody>
                            </table>


                            <!-- List group -->

                        </div>
                    <?php } ?>
                </div>  

            </div>

            <div class="col-md-8 col-sm-8 marg_btm30">


                <div class="clearfix"></div>
                <?php echo $this->Session->flash(); ?>
                <div class="bg_white freelaners marg_btm30">
                    <?php if (!empty($user_data)) { ?>
                        <div class="green">
                            <?php echo $user_data['User']['first_name'] . ' ' . $user_data['User']['last_name']; ?><span class="date pull-right"><i class="mrg_r5">
                            <?php if (!empty($skill_value)) { ?>
                                        <img alt="image" src="<?php echo $this->webroot; ?>img/deatil.png"></i><?php echo ucwords($user_data['User']['job_title']); ?> <?php echo '(' . $result_skill . ')'; ?>
                                <?php } else { ?>
                                    <img alt="image"src="<?php echo $this->webroot; ?>img/deatil.png"></i>Cakephp Developer (scala,java)
                                <?php } ?></span>

                            <div class="clearfix"></div>
                        </div>

                    <?php } ?>
                    <div class="col-md-2 col-sm-2 marg_tb15">
                        <?php if (!empty($user_data['User']['image'])) { ?>
                            <img src="<?php echo $this->webroot; ?>uploads/<?php echo $user_data['User']['image']; ?>" alt="image" class="img-thumbnail" height="100" width="100">
                        <?php } else { ?>
                            <img src="<?php echo $this->webroot; ?>img/user_1.png" alt="image" class="img-thumbnail" height="100" width="100">
                        <?php } ?>
                    </div>

                    <?php if (!empty($user_data['User']['description'])) { ?>
                        <div class="col-md-10 colsm-10 marg_tb15 lesval ">
                            <p><?php echo substr($user_data['User']['description'], 0, 300) . '....'; ?>
                                <a href="JavaScript:void(0);" class='more' >more</a>
                            </p>
                        </div>
                        <div class="col-md-10 colsm-10 marg_tb15 moreval hide ">
                            <p><?php echo $user_data['User']['description']; ?>
                                <a href="JavaScript:void(0);" class='less' >less</a>
                            </p>
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <hr class="brder_btm1">
                    <div class="tabs_1 col-md-12 marg_t5">
                        <div class="col-md-10 colsm-10 more_skills ">
                            <?php
                            $k = 0;
                            $total = count($subskill);
                            foreach ($subskill as $k => $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
                                <?php if ($k == '3') {
                                    break;
                                } $k++;
                            } ?>
    <?php if ($total > 4) { ?>
                                <a href="JavaScript:void(0);" class="more_skill subskil" style="background: #2A6EB3;color:#fff; text-decoration: none;">More Skills</a>
                            <?php } ?>
                        </div>
                        <div class="col-md-10 colsm-10 less_skills hide ">
                            <?php
                            $k = 0;
                            $total = count($subskill);
                            foreach ($subskill as $k => $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
        <?php $k++;
    } ?>

                            <a href="JavaScript:void(0);" class="less_skill subskil"  style="background: #2A6EB3;color:#fff; text-decoration: none;">Less Skills</a>

                        </div>
                    </div>

                    <div class="clearfix "></div>
                    <br/>
                    <hr class="brder_btm marg_0"></hr>
                    <div class="col-md-12 ">
    <?php if (!empty($Projectfeedback)) { ?>
                            <h2>Work History and Feedback </h2>
    <?php } ?>
                    </div>   <div class="clearfix"></div>
                    <div class="table-responsive">

                        <table width="88%" class="table marg_tb15 cust_table1">
                            <tbody>
    <?php
    if (!empty($Projectfeedback)) {
        foreach ($Projectfeedback as $key => $value) {
            ?>
                                        <tr>
                                            <td width="17%"><span class="pull-left"><?php echo number_format($value['Projectfeedback']['score'], 0); ?></span>
                                                <ul class="list-inline pull-left marg_l20">
                                                    <?php
                                                    $number = number_format($value['Projectfeedback']['score'], 0);
                                                    for ($i = 1; $i <= $number; $i++) {
                                                        ?> 
                                                        <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="image" /></li>
            <?php } ?>

                                                </ul>


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
                                    </tr>  <?php
                        }
                        ?>        </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
<?php } else { ?>
        <hr class="brder_btm">
        <div class="row">
            <div class="col-md-12">
                <p><i><img class="mrg_r5" alt="image" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $this->webroot; ?>client">Back to Search Result</a></p>
            </div>
            <p style="font-size: 20px; color: #C7CBD6;text-align:center;padding-top: 60px!important;"> The User Cannot Be Found ,Please Register Yourself.<br><h4 style="font-size: 20px; color: #C7CBD6;text-align:center;">If you are Already Registered then Please complete your Profile so that we can Redirect you to Right Place !</h4></p> <div class="col-md-8 col-sm-8 marg_btm30" style="padding: 100px;">
            </div>
        </div>
        <hr class="brder_btm">
<?php } ?>

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
            //$('.less_skills').removeClass('hide');
            $(this).parent().addClass('hide');

        });
    });
</script>
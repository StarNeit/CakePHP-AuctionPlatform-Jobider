<div class="container">
    <div class="col-md-12">
        <div class="free_profile_lay">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="free_profile">
                    <p>
                        <a href="<?php echo $this->webroot; ?>freelancer/editprofile"><button class="btn-lg btn-green1"> Edit Profile </button>
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                           </div><!--col-md-6-->
        </div><!--free_profile_lay-->
    </div><!--col-md-12-->
</div>
<div class="container">
    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="col-md-2 col-sm-6">
            <div class="freelancer_profile">
                <?php if (!empty($userdata['User']['image'])) { ?>
                <a href="<?php echo $this->webroot; ?>freelancer/myprofile"> <img class="img-thumbnail"  src="<?php echo $this->webroot; ?>uploads/<?php echo $userdata['User']['image']; ?>" height="100" width="100"></a>
                <?php } else { ?>
                <a href="<?php echo $this->webroot; ?>freelancer/myprofile"/>
                    <img class="img-thumbnail"  height="65" width="65" alt="" src="<?php echo $this->webroot;?>img/freelancer.png"></a>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-8 col-sm-4">
            <div class="freelancer_profile_md">
                <a href="<?php echo $this->webroot; ?>freelancer/myprofile" style="text-decoration:none;"> <h1><?php echo ucfirst($userdata['User']['first_name']) . ' ' . ucfirst($userdata['User']['last_name']); ?></h1></a>
                <h4><?php echo $userdata['User']['job_title']; ?></h4>
                <h5><i><img src="<?php echo $this->webroot; ?>img/location1.png"></i> <b><?php echo $userdata_country['Country']['name']; ?></b> </h5>
             <?php if(!empty($userdata['User']['login_time'])){?> 
                <p><?php echo date('h:i a',  strtotime($userdata['User']['login_time'])).' Local time'; ?></p>
                 <?php }else{?>
                     <p>9:00am Local time</p>
                     <?php  }?>  
                     <div class="col-md-12 colsm-12 less_skills">
                <?php 
                if(!empty($skill)){
                    $total_skills = count($skill);
                    $k = 0;
                foreach($skill as $kk => $vv) { ?>
                    <span><?php echo $vv['Subskill']['skill_name']; ?></span>
                    <?php  
                    if($k=='5'){
                        break;
                    }
                    $k++;
                    ?>
                <?php } } ?>
                    <?php 
                    if( !empty($total_skills) and $total_skills>='5'){?>
                    <a href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff; text-decoration: none;">More Skills </a>
                    <?php  }else{ ?>
                    <p style="color:#7C7A7A;text-align:center;font-size:16px;"><?php echo 'No Skills Found in your Profile , Please Complete your Profile !'; ?></p>
                    <?php } ?>
                     </div> <div class="col-md-12 colsm-12  more_skills hide">
                <?php 
                if(!empty($skill)){
                    $total_skills = count($skill);
                    $k = 0;
                foreach($skill as $kk => $vv) { ?>
                    <span><?php echo $vv['Subskill']['skill_name']; ?></span>
                    <?php  
                    $k++;
                    ?>
                <?php } }?>
                    <a href="JavaScript:void(0);" class=" subskil less_skill" style="background: #2A6EB3;color:#fff; text-decoration: none;">Less Skills </a>                                   </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="freelancer_profile_right">
                <?php if (!empty($userdata['User']['budget'])) { ?>
                    <b><?php echo '$' . $userdata['User']['budget'] . '.00/hr'; ?></b>
                <?php } else { ?>
                    <b> <?php echo '$0.00/hr'; ?></b>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="free_profile_content lesval">
                <h1>Overview</h1>
                <?php if (!empty($userdata['User']['description'])) { ?>  <p><?php echo substr($userdata['User']['description'], 0, 450) . '......'; ?><a href="JavaScript:void(0);" class="more" style="text-decoration:none" >More</a></p> <?php } else { ?>
                    <p style="text-align: center; padding: 26px; color: rgb(155, 155, 155); font-size: 16px;">No Details Provided !</p>
                <?php } ?>
            </div><!--free_profile_content-->
            <div class="free_profile_content  moreval hide">
                <h1>Overview</h1>
                <p><?php echo $userdata['User']['description'].'. '; ?><a href="JavaScript:void(0);" class="less" style="text-decoration:none" >Less</a></p> 
            </div>
            <div class="freelancer_profile_content">
                <h1>Tests</h1>
                <div class="table-responsive">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Score (out of 5)</th>
                                <th>Time to Complete</th>
                                <th> Details </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($result) and !empty($result)) {
                                foreach ($result as $key => $val) {
                                    ?>            <tr>
                                        <?php foreach ($val['test'] as $keey => $vall) { ?>
                                            <td><?php echo $vall['Test']['title']; ?></td>
                                        <?php } ?>
                                        <td class="nowrap"> <?php echo $val['score']; ?> <span class="oScore oScoreFailed"><?php echo '(' . $val['Finalresult']['percentile'] . ')'; ?></span> </td>
                                        <td class="nowrap"><?php
                                            if ($val['Finalresult']['total_time'] >= 1) {
                                                echo $val['Finalresult']['total_time'] . ' minutes';
                                            } else {
                                                echo $val['Finalresult']['total_time'] . ' seconds';
                                            }
                                            ?></td>
                                        <td class="nowrap"><a href="<?php echo $this->webroot; ?>freelancer/finalresult/<?php echo $val['Finalresult']['test_id']; ?>">Details</a>                </td>    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr align="center"><td colspan="4" style="padding: 31px;">No Record(s) Found. </td></tr>';
                            }
                            ?> </tbody>
                    </table>
                </div>
            </div>
            <div class="freelancer_profile_con">
                <h1>Employment History</h1>
                <?php if (!empty($userdata['User']['job_title']) and !empty($userdata['User']['company'])) { ?>
                    <span><?php echo $userdata['User']['job_title']; ?></span>|<span><?php echo '  ' . $userdata['User']['company']; ?></span>
                <?php } else { ?>

                    <p style="text-align: center; padding: 20px; color: rgb(155, 155, 155); font-size: 16px;">No Record(s) Found !</p>
                <?php } ?>
            </div>  <!--freelancer_profile_con-->
            <div class="freelancer_profile_con">
              </div>
        </div>
    </div><!--col-md-8-->
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="free_profile_lay_right">

            <div class="freelancer_right_side_content">
                <h5>Languages</h5>
                <?php
                if (!empty($language)) {
                    foreach ($language as $v) {
                        ?>
                        <p><b><?php echo $v['Userlanguage']['language']; ?></b> - <?php echo $v['Userlanguage']['proficiency']; ?></p>
                        <h6>Self-Assessed</h6>
                        <?php
                    }
                } else {  ?>
                    <p>No language(s) Found !</p>
                <?php } ?>

            </div>
            <!--freelancer_right_side_content-->

            <!--            <div class="freelancer_right_side_bottom">
                            <h5>Languages</h5>
                            <p><img src="<?php //echo $this->webroot;      ?>img/location1.png"><a href="#">web development</a></p>
            
                        </div>freelancer_right_side_bottom-->



        </div><!--free_profile_lay_right-->

    </div><!--col-md-4-->
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
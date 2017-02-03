<div class="container">
    <hr class="brder_btm">
    <div class="col-md-12">
        <div class="col-sm-8 col-md-8 view_job">
            <?php
            if (isset($Jobs_result) and !empty($Jobs_result)) {
                ?>

                <h3><?php echo $Jobs_result['Job']['job_title']; ?></h3>
            <?php } ?>
            <p>
                     <div class="tabs_1 col-md-12 marg_t5" style="margin-bottom: 10px;">
                    <div class="col-md-10 colsm-10 less_skills ">
                        <?php
                        if (!empty($Skills_result)) {
                            $total_skill = count($Skills_result);
                            $j = 0;
                            foreach ($Skills_result as $kk => $vv) {
                                ?>
                                <span class="sm_btn"><?php echo $vv['Subskill']['skill_name']; ?></span>   
                                <?php
                                if ($j == '3') {
                                    break;
                                }$j++;
                                ?>
                            <?php }
                        } ?>
                        <?php if ($total_skill >= 5) { ?>
                            <a href="JavaScript:void(0);" class="sm_btn more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills</a>
                        <?php } ?>

                    </div>
                    
                            <div class="col-md-10 colsm-10 more_skills hide ">
                        <?php
                        if (!empty($Skills_result)) {
                            $total_skill = count($Skills_result);
                            $j = 0;
                            foreach ($Skills_result as $kk => $vv) {
                                ?>
                                <span class="sm_btn"><?php echo $vv['Subskill']['skill_name']; ?></span>   
                                <?php
                              $j++;
                                ?>
                            <?php }
                        } ?>
                       
                            <a href="JavaScript:void(0);" class="sm_btn less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills</a>
                       

                    </div>
                </div>
            </p>
            <p> <i> <img src="<?php echo $this->webroot; ?>img/clock_new.png" alt="Clock new image icon"> </i> <?php echo $timeduration; ?> </p>
            <p> <span> <strong>Fixed Price  :</strong><?php echo '$' . $Jobs_result['Job']['budget']; ?> Budget </span> <span class="pull-right">Deliver by:  <?php echo date('d-M-Y', strtotime($Jobs_result['Contect']['created'])); ?> </span></p>
            <div class="col-md-12 dtl_hding">
                <h4>Details</h4>
                <?php if (isset($Jobs_result) and !empty($Jobs_result)) { ?>
                <div class="lesval">
                    <p><?php echo substr($Jobs_result['Job']['description'],0,250).'.....'; ?>    <a href="JavaScript:void(0);" class="more">More</a>   
                    </p>
                </div>
                
                <div class="moreval hide">
                    <p><?php echo $Jobs_result['Job']['description']; ?>
                        <a href="JavaScript:void(0);" class="less">Less</a>
                    </p>
                </div>
                <?php } ?>
                <div class="dtl_list">


                </div>
                <div class="col-md-6 tbl spc1">
                    <h4>Client activity on this job</h4>
                    <table class="table">

                        <tbody><tr>
                                <td class="fnt_style">Applicants:</td>
                                <?php if (isset($Total_applicants) and !empty($Total_applicants)) { ?>
                                    <td><?php echo $Total_applicants; ?></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="fnt_style">Interviewing:</td>
                                <td>0</td>
                            </tr>
                        </tbody></table>

                </div>
                <div class="col-md-12 back">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default">
                            <div class="panel-heading padd_0" role="tab" id="headingOne">
                                <h4 class="panel-title green">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="marg_r10"><img src="<?php echo $this->webroot; ?>img/accordian.png" alt="Accordian image icon"></i>
                                        <?php if (isset($JobApplicants_count)) { ?>
                                            Applicants<?php echo ' (' . $JobApplicants_count . ')'; ?><?php
                                        } 
                                        ?></a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="table-responsive">
                                    <?php if (isset($JobApplicants) and !empty($JobApplicants)) { ?>    
                                        <table class="table cust_table11 table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Freelancer</th>
                                                    <th>Job</th>
                                                    <th>Date applied</th>
                                                    <th>Initiated by</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($JobApplicants as $kk => $vv) { ?>
                                                    <tr>
                                                        <td><?php echo ucfirst($vv['User']['first_name']) . ' ' . ucfirst($vv['User']['last_name']); ?></td>
                                                        <td><?php echo $vv['Job']['job_title']; ?></td>
                                                        <td><?php echo $vv['Time_duration']; ?></td>
                                                        <td>client</td>
                                                    </tr>
                                                <?php } ?>  
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <p class="appl">No Applicant(s) for this Job Found !</p>                
                                    <?php } ?>
                                </div>
                                <div class="clearbox"></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default">
                            <div class="panel-heading padd_0" role="tab" id="headingOnee">
                                <h4 class="panel-title green">
                                    <a class="" data-toggle="collapse" data-parent="#accordion" href="#collapseOnee" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="marg_r10"><img src="<?php echo $this->webroot; ?>img/accordian.png"  alt="Accordian image icon"></i>       Other open jobs by this client <?php echo '(' . $Count_openjobs . ')'; ?></a>

                                </h4>
                            </div>
                            <div style="height: auto;" id="collapseOnee" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="similr_job_list">
                                    <ul>
                                        <?php
                                        if (isset($openjobs) and !empty($openjobs)) {
                                            foreach ($openjobs as $kk => $vv) {
                                                ?>
                                                <li style="margin-left: 10px"><a href="<?php echo $this->webroot; ?>freelancer/viewjob/<?php echo $vv['Job']['id']; ?>"><b><?php echo $vv['Job']['job_title'] ?></b></a><?php echo '   ' . substr($vv['Job']['description'], 0, 50) . '....'; ?> </li>
                                            <?php }
                                        } ?>  </ul>
                                </div>
                                <div class="clearbox"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-sm-4 col-md-4 ryt_dvv">
            <input type="submit" value="Apply to this Job">
            <h4><a href="#">About the Client</a></h4>
            <a href="#">Payment method not verified <img alt="Question mark icon" src="<?php echo $this->webroot; ?>img/questionmark.png"></a>
            <h6><b>Member Since</b> &nbsp;April 16, 2015</h6>
        </div>
        <div class="clearfix"></div>
    </div>

</div>

<style>
    .appl {
        color: #c7c4c8;
        font-size: 21px;
        padding: 32px;
        text-align: center;
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




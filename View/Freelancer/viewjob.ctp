<div class="container">
    <hr class="brder_btm">
    <div class="col-md-12">
        <div class="col-sm-8 col-md-10 view_job">
            <h3><?php echo $Job['Job']['job_title']; ?></h3>
            <p>
                <?php foreach ($allSkills as $kk => $vv) { ?>
    <span class="sm_btn"><?php echo $vv['Subskill']['skill_name']; ?></span>
                <?php } ?>
            </p>
            <p><i><img src="<?php echo $this->webroot; ?>img/clock_new.png" alt="Clock image icon"> </i> <?php echo $timeDuration; ?></p>
            <p> <span> <strong>Fixed Price  :</strong><?php echo '$' . $Job['Job']['budget']; ?> Budget </span> <span class="pull-right">Posted on : <?php echo date('d-M-Y', strtotime($Job['Job']['created'])); ?></span></p>



            <div class="col-md-12 dtl_hding">

                <h4>Details</h4>
                <div class="lesval">
                <p><?php echo substr($Job['Job']['description'],0,250).'..........'; ?>
                    <a href="JavaScript:void(0);" class="more">More</a>
                </p>
                </div>
                <div class="moreval hide">
                    <p>
                        <?php  echo $Job['Job']['description'];?>
                        <a href="JavaScript:void(0);" class="more">Less</a>
                    </p>
                </div>

                <div class="col-md-6 tbl spc1">
                    <h4>Client activity on this job</h4>
                    <table class="table">

                        <tbody><tr>
                                <td class="fnt_style">Applicants:</td>
                                <?php if (isset($applicant)) { ?>
                                    <td><?php echo $applicant; ?></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td class="fnt_style">Interviewing:</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 back">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading padd_0" role="tab" id="headingOne">
                                <h4 class="panel-title green">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="marg_r10"><img src="<?php echo $this->webroot; ?>img/accordian.png" alt="Accrdian image"></i>Applicants <?php echo '(' . $applicant . ')'; ?> </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="table-responsive">
                                    <?php if (isset($Job_apply_applicant) and !empty($Job_apply_applicant)) { ?> 
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
                                                <?php foreach ($Job_apply_applicant as $keey => $vall) { ?>
                                                    <tr>
                                                        <td><?php echo ucfirst($vall['User']['first_name']) . ' ' . ucfirst($vall['User']['last_name']); ?></td>
                                                        <td><?php echo $vall['Job']['job_title']; ?></td>
                                                        <td><?php echo $vall['timeduration']; ?> </td>
                                                        <td>client</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>   

                                        <p class="appl">No Applicant(s) for this Job Found !</p>                  

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Other open jobs by this Client</h4> 
                    <div class="similr_job_list">
                        <ul>
                            <?php foreach ($otherjobs as $key => $val) { ?>
                                <li><a href="<?php echo $this->webroot; ?>freelancer/viewjob/<?php echo $val['Job']['id'] ?>"><b><?php echo $val['Job']['job_title']; ?></a> &nbsp;</b><?php echo substr($val['Job']['description'], 0, 90); ?></li>
                            <?php } ?>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
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




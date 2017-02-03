<div class="container">
    <hr class="brder_btm">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-8">
                <h3> <?php echo $Job['Job']['job_title']; ?></h3>
                <p>
                    <?php
                    if (isset($Skills) and !empty($Skills)) {
                        foreach ($Skills as $key => $val) {
                            ?>
                            <span class="sm_btn"><?php echo $val['Subskill']['skill_name']; ?></span>
                            <?php
                        }
                    }
                    ?>   
                    <a href="<?php echo $this->webroot; ?>freelancer/viewJobPosting/<?php echo $Job['Job']['id']; ?>" class="pull-right"  style="text-decoration:none"/>View Job Posting</a>
                </p>
                <p><i><img src="<?php echo $this->webroot; ?>img/clock_new.png" alt="clock icon image"> </i> <?php echo $TimeDuration; ?></p>
                <p><span> <strong>Fixed Price :</strong> <?php echo '$' . $Job['Job']['budget'] . ' Budget'; ?> </span> <span class="pull-right">Deliver by : <?php echo date('D-M-Y', strtotime($Job['Contect']['created'])); ?></span></p>
                <div class="drop_text marg_t35">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading padd_0" role="tab" id="headingOne">
                                <h4 class="panel-title green">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none">
                                        <i class="marg_r10"><img src="<?php echo $this->webroot; ?>img/accordian.png" alt="accordian style image"></i>Job Description
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body text_1">
                                    <?php echo $Job['Job']['description']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="drop_text marg_t35">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading padd_0" role="tab" id="headingOne">
                                <h4 class="panel-title green">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none">
                                        <i class="marg_r10"><img src="<?php echo $this->webroot; ?>img/accordian.png" alt="accordian style image"></i>Message from Client
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body text_1">

                                    <?php echo nl2br($Job['Contect']['messages']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="new_job_back">
                    <div class="new_job2"><p><b>Declined Invitation to Interview </b> </p>
                        </br>
                        <p>Client:  <?php echo ucfirst($Client_Info['User']['first_name']) . ' ' . ucfirst($Client_Info['User']['last_name']) . ' (' . ucfirst($Client_Info['User']['first_name']) . ' ' . ucfirst($Client_Info['User']['last_name']) . ')'; ?></p>
                        <p><?php echo $Decline_Info['Declinejob']['decline_status'] . ' : '; ?><?php echo $Decline_Info['Declinejob']['reason']; ?> </p>
                    </div>
                    <div class="new_job2_left">
                        <a href="#"  data-target="#myModal_new" data-toggle="modal">view declined message</a>
                        </br></br>
                        <p><b>About the Client</b></p></br>
                        <p><b><?php echo ucfirst($Client_Info['User']['first_name']) . ' ' . ucfirst($Client_Info['User']['last_name']); ?></b></p>
                        <p><b><?php echo ucfirst($Client_Info['User']['first_name']) . ' ' . ucfirst($Client_Info['User']['last_name']); ?></b></p>
                    </div>
                    <div class="new_job2_bottom">
                        <p> <img src="<?php echo $this->webroot; ?>img/location.png" alt="location icon image"><?php echo $Client_Country['Country']['name']; ?></p>
                        <p>Member since <?php echo ' ' . date('F d,Y', strtotime($Client_Info['User']['created'])); ?> </p>
                    </div>
                    <p class="text-center margg_t20">Payment method not verified</p>
                    <p class="pad_lzero marg_t5"><img alt="rating icon image" src="<?php echo $this->webroot; ?>img/rating.png"> 0 reviews</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hre_details">
                                <div class="pad_lzero">
                                    Total Spent<span class="pull-right">$0</span>
                                    <hr class="brder_bttm1">
                                       Jobs Posted
                                    <?php if(isset($countPostedJobs) and !empty($countPostedJobs)){  ?>
                                    <span class="pull-right"><?php echo $countPostedJobs; ?></span>
                                    <?php }else{ ?>
                                     <span class="pull-right">0</span>
                                    <?php } ?>
                                    <hr class="brder_bttm1">
                                    Hires
                                    <?php  if(isset($countHiredJobs) and !empty($countHiredJobs)){ ?>
                                    <span class="pull-right"><?php echo $countHiredJobs; ?></span>
                                    <?php } else{ ?>
                                        <span class="pull-right">0</span>
                                    <?php } ?>
                                    <hr class="brder_bttm1">
                                    Open Jobs
                                    <?php if(isset($countOpenJobs) and !empty($countOpenJobs)){ ?>
                                    <span class="pull-right"><?php echo $countOpenJobs; ?></span>
                                    <?php } else{?>
                                  <span class="pull-right">0</span>   
                                    <?php }?>
                                    <hr class="brder_bttm1">
                                </div>
                                <p class="marg_t35 pad_lzero"><strong>Activity for this job</strong></p>
                                <p>3 application</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--          modal2 start   -->
<div class="modal fade cust_moadl" id="myModal_new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 100px">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Declined Message</h3>
            </div>
            <div class="modal-body">
                <p class="text_cust" style="padding: 35px;"><?php echo $Decline_Info['Declinejob']['message']; ?> </p>
            </div>
        </div>
    </div>
</div>

<!--modal2 closed -->






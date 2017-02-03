<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-12">
            <p><i><img src="<?php echo $this->webroot; ?>img/back.png" alt="Back to Search Result" class="mrg_r5"></i><a href="<?php echo $last_url; ?>" class="font_18">Back to search result</a></p>
        </div>
        <div class="col-md-8 col-sm-8 job_detail">
            <?php if (isset($Detail) and !empty($Detail)) { ?>
                <div class="bg_grey2">
                    <h3 class="marg_0"><?php echo $Detail['Job']['job_title']; ?></h3>
                    <h4 class="marg_btm30">Est. Budget :<?php echo '   $' . $Detail['Job']['budget']; ?>
                     </h4>
                    <h5 class="marg_0">Skills required</h5>
                    <?php foreach ($Skill_info as $kk => $vv) { ?>
                        <button type="button" class="btn btn-danger btn_red3 marg_tb15"><?php echo $vv['Subskill']['skill_name']; ?></button>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
                <h3>Job Description  </h3>
                <p>Hello,
                    <br><?php echo $Detail['Job']['description']; ?>
                    <br>
                </p>
            <?php } ?>
            <div class="open_jobs marg_tb50">
                <p style="font-size: 28px;">Milestone Detail</p>
                <table class="table cust_table11 table-striped">
                    <thead>
                        <tr>
                            <th>Start Date </th>
                            <th>End Date </th>
                            <th> Milestone Title</th>
                            <th> Client </th>
                            <th>Amount </th>
                            <th>Pending Balance </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($Detail) and !empty($Detail)) { ?>
                            <tr>
                                <td><?php echo date('d-m-Y', strtotime($Detail['Milestone']['start_date'])); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($Detail['Milestone']['end_date'])); ?></td>
                                <td><?php echo $Detail['Milestone']['milestone_title']; ?><br>
                                </td>
                                <td><?php echo ucfirst($Client['User']['first_name']) . ' ' . ucfirst($Client['User']['last_name']); ?></td>
                                <td> <?php echo '$' . $Detail['Milestone']['payment_amount']; ?></td>
                                <td style="text-align:center"><?php echo '$' . $Balance; ?> </td>

                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>


        </div>

        <div class="col-md-4 col-sm-4 pad_r0">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Job Overview </div>
                <div class="panel-body bg_grey1 padd_0 bg_content">

                    <div class="col-md-6">
                        <b>Budget</b>
                    </div>
                    <div class="col-md-6"> 
                        <?php echo ' $' . $Detail['Job']['budget']; ?>
                    </div>

                    <div class="col-md-6">
                        <b>Posted</b>
                    </div>
                    <div class="col-md-6"> 
                        May 12 2014,7:00 PM
                    </div>

                    <div class="col-md-6">
                        <b>Planned Start</b>
                    </div><div class="col-md-6"><?php echo $Detail['Job']['start_date']; ?></div>

                    <div class="col-md-6">
                        <b> Duration </b>  </div><div class="col-md-6"> <?php echo $Detail['Job']['duration']; ?> </div>

                    <!--    <div class="col-md-6">  Visibility </div><div class="col-md-6"> Writing &amp; Translation</div>-->
                    <div class="col-md-6">
                        <b>Category</b> </div><div class="col-md-6"> <?php echo $Category['Category']['name']; ?></div>
                    <div class="col-md-6">
                        <b> Sub-category</b></div><div class="col-md-6"> <?php echo $SubCategory['Subcategory']['category_name']; ?></div>
                </div>
            </div>

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">About the client </div>
                <div class="panel-body bg_grey1 padd_0 bg_content">
                    <div class="col-md-5">
                        <ul class="list-inline marg_0">
                            <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star image icon"></li>
                            <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star image icon"></li>
                            <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star image icon"></li>
                            <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star image icon"></li>
                            <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star image icon"></li>
                        </ul>
                        <span>(5.00) 4 reviews</span>
                    </div>
                    <div class="col-md-7 font_16">
                        <i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location image icon"></i><?php echo $Country['Country']['name']; ?>
                    </div>
                    <div class="clearfix"></div>
                    <span class="col-md-12 padd_tb15 font_16 text-muted">
                        <b>Member since</b> <?php echo date('d/M/Y', strtotime($Client['User']['created'])); ?></span>
                    <div class="col-md-6">
                        <b>Total Spent</b>
                    </div>
                    <div class="col-md-6">Over $10,000</div>

                    <div class="col-md-6">
                        <b>Jobs Posted</b> </div><div class="col-md-6"> <?php
                        if (isset($Posted) and !empty($Posted)) {
                            echo $Posted;
                        } else {
                            echo '0';
                        }
                        ?></div>


                    <div class="col-md-6">
                        <b>Hires </b> </div><div class="col-md-6"><?php
                        if (isset($Hire) and !empty($Hire)) {
                            echo $Hire;
                        } else {
                            echo '0';
                        }
                        ?></div>
                    <div class="col-md-6">
                        <b>Open Jobs</b> </div><div class="col-md-6"><?php
                        if (isset($OpenJobs) and !empty($OpenJobs)) {
                            echo $OpenJobs;
                        } else {
                            echo '0';
                        }
                        ?></div>


                </div>
            </div>

        </div> 
    </div>

</div>
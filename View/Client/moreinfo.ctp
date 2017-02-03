<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-12">
            <p><i><img class="mrg_r5" alt="Back to Search" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $this->webroot; ?>client/searchfreelancer">Back to search result</a></p>
        </div>
        <div class="col-md-8 col-sm-8 job_detail">
            <div class="bg_grey2">
                <h3 class="marg_0"><?php echo $detailed_info['User']['first_name'] . '   ' . $detailed_info['User']['last_name'] ?> </h3><br>
                <img  src="<?php echo $this->webroot; ?>uploads/<?php echo $detailed_info['User']['image']; ?>" alt="login user" class="img-thumbnail" height="100" width="100" style="align:right"><br><br> 
                <h5 class="marg_0">Skills required</h5>
                <?php
                foreach ($skill as $kk => $vv) {
                    ?>
                    <button class="btn btn-danger btn_red3 marg_tb15" type="button"><?php echo $vv['Skill']['name']; ?></button>
                <?php } ?>
                <?php foreach ($subskill as $key => $value) { ?>
                    <button class="btn btn-danger btn_red3 marg_tb15" type="button"><?php echo $value['Subskill']['skill_name']; ?></button>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
            <h3>About Freelancer </h3>
            <p>Hello,
                <br>
                <?php echo $detailed_info['User']['description']; ?>
            </p>

        </div>
        <div class="col-md-4 col-sm-4 pad_r0">
            <!--  
            <button class="btn-lg btn-green btn-block marg_btm30">Apply to this job</button>
            -->
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Job Overview </div>
                <div class="panel-body bg_grey1 padd_0 bg_content">
                    <div class="col-md-6">
                        Job Title</div>
                    <div class="col-md-6"> <?php echo $detailed_info['User']['job_title'] ?></div>
                    <div class="col-md-6">
                        Total Jobs </div><div class="col-md-6"> <?php echo $detailed_info['User']['total_jobs']; ?></div>
                    <div class="col-md-6">
                        Available Jobs </div><div class="col-md-6"> <?php echo $detailed_info['User']['available_jobs']; ?>    </div>

                    <div class="col-md-6">
                        Jobs in Account </div>
                    <div class="col-md-6"> <?php echo $detailed_info['User']['jobs_in_account']; ?></div>

                    <!--                    <div class="col-md-6">
                    
                                            Visibility </div><div class="col-md-6"> Writing &amp; Translation</div>
                                        <div class="col-md-6">
                                            category </div><div class="col-md-6"> Other - Writing &amp; Translation</div>
                                        <div class="col-md-6">
                                            Sub-category</div><div class="col-md-6"> Translation</div>-->



                </div>
            </div>

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">About the Freelancer </div>


                <div class="panel-body bg_grey1 padd_0 bg_content">

                    <div class="col-md-5">
                        <ul class="list-inline marg_0">
                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png"alt="image"></li>
                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png"alt="image"></li>
                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png"alt="image"></li>
                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png"alt="image"></li>
                            <li><img alt="Star image" src="<?php echo $this->webroot; ?>img/star.png"alt="image"></li>
                        </ul>
                        <span>(5.00) 4 reviews</span>
                    </div>

                    <div class="col-md-7 font_16">

                        <i class="mrg_r5"><img alt="location" src="<?php echo $this->webroot; ?>img/location1.png" alt="image"></i>United States (UTC - 06)                       
                    </div>
                    <div class="clearfix"></div>
<!--                    <span class="col-md-12 padd_tb15 font_16 text-muted">Member since May 12 2012</span>-->
                    <div class="col-md-6">
                        Email-ID</div><div class="col-md-6"><?php echo $detailed_info['User']['email']; ?></div>
                    <!-- <div class="col-md-6">
                         Jobs Posted </div><div class="col-md-6"> 159</div>
 
                     <div class="col-md-6"> 
                         Hires </div><div class="col-md-6">129</div>
 
                     <div class="col-md-6">
                        Open Jobs</div><div class="col-md-6">6</div> -->
                </div>
            </div>  
        </div> 
    </div>

</div>
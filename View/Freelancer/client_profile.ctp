

<?php if(!empty($client_info['User']['country_id'])){?>
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-12">
            <p><i><img class="mrg_r5" alt="Back icon image" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $Last_link; ?>">Back to search result</a></p>
        </div>
        <div class="col-md-8 col-sm-8 job_detail">
            <div class="bg_grey2">
                <div class="col-md-11 col-sm-2">
                    <div class="user_imgbox">
                        <img  src="<?php echo $this->webroot; ?>uploads/<?php echo $client_info['User']['image']; ?>" alt="login user image" width="100" height="100" >
                    </div>
                </div>
                <h3 class="marg_0"><?php echo $client_info['User']['first_name'] . '   ' . $client_info['User']['last_name']; ?> </h3>
                <h4 class="marg_btm30"><img alt="location icon image" src="<?php echo $this->webroot; ?>img/location1.png"> <?php echo $country_name['Country']['name']; ?> <small class="marg_l20"> </small></h4>

                <h4 class="marg_0">Skills</h5>
                <?php foreach ($User_skills as $kk => $vv) { ?>
                    <button class="btn btn-danger btn_red3 marg_tb15" type="button"><?php echo $vv['Subskill']['skill_name']; ?></button>
                <?php } ?>
                <div class="clearfix"></div>
            </div>

            <h3>About Client </h3>

            <p>Hello,
                <br>
                <?php  echo $client_info['User']['description']; ?>
</p>

            <div class="open_jobs marg_tb50">
                <h3 class="text_1">Other open jobs by this client</h3>
                <span class="text_3 font_18">Active Jobs    1</span>
                <div class="clearfix"></div>
                <p class="marg_tb15">  
                    <?php foreach ($jobs_posted as $key => $val){?>
                    <a href="#" style="text-decoration: none"><?php  echo $val['Job']['job_title'];?></a><br>
                    <?php } ?>
                    <br>
                </p>
                <a class="font_18" href="#">More...</a>
            </div>


        </div>
    
    </div>

</div>
<?php } else { ?>
<div class="container">
    <div class="row marg_tb15">
       <div class="row">
            <div style="margin-left:139px" class="col-md-10 col-sm-8 marg_btm30 else">
                <div class="clearfix"></div>
                <div class="bg_white freelaners marg_btm30">
                    <div class="green">
                        User  Results<span class="date pull-right"></span>
                        <div class="clearfix"></div>   </div>
                    <div class="col-md-10 colsm-10 marg_tb15">
                        <p style="color: #C7C4C8; text-align: center; font-size:20px;">Sorry,No Client Record Found , Firstly Complete Your Profile.</p>                          </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php } ?>

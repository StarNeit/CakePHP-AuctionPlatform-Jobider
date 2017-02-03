<div class="container">

    <div class="row marg_tb15">


        <div class="col-md-9 col-sm-8 job_detail">
            <div class="bg_grey2">
                <div class="col-md-2 col-sm-2">
                    <div class="user_imgbox">
                        <img width="100" height="100" alt="image" src="<?php echo $this->webroot; ?>uploads/<?php echo $users['User']['image']; ?>">
                    </div>
                </div>
                <h2 class="marg_0"> <?php echo $users['User']['first_name'] . ' ' . $users['User']['last_name']; ?></h2>

                <h4 class="marg_btm30"><?php echo $users['User']['job_title']; ?>
                    <small class="marg_l20"></small>
                </h4>

                <h4 class="marg_0" style="margin-top: -15px;"><img src="<?php echo $this->webroot; ?>img/location1.png" alt="image"> <?php echo $country['Country']['name']; ?></h4>
                <?php foreach ($subskill as $kk => $vv) { ?>
                    <button class="subskil"disabled=""><?php echo $vv['Subskill']['skill_name']; ?></button>
                <?php } ?>

                <div class="clearfix"></div>
            </div>

            <h3>Original Message From Client </h3>

            <p>Hello,
                <br>Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.Lorem ipsum is siplydummy text.Lorem ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem  ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.

                <br>
                <br>Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.Lorem ipsum is siplydummy text.Lorem ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem  ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.Lorem ipsum is simply a dummy text.Lorem ipsum sit amiet.......</p>

            <div class="open_jobs marg_tb50">

                <h3 class="text_1">Other open jobs by this client</h3>
                <span class="text_3 font_18">Active Jobs    1</span>



                <div class="clearfix"></div>
                <p class="marg_tb15">  <a href="#">Ending job order Form - Joomla 3.0</a>
                    <br>
                    <a href="#">Ending job order Form - Joomla 3.0</a>    <br>
                    <a href="#">Ending job order Form - Joomla 3.0</a>    <br>
                    <a href="#">Ending job order Form - Joomla 3.0</a></p>


                <a class="font_18" href="#">More...</a>
            </div>


        </div>

        <div class="col-md-3 col-sm-4 pad_r0">

            <button class="btn-lg btn-green btn-block marg_btm30">Hire</button>

            <div class="panel panel-default green_bg1">

                <div class="panel-body bg_grey1 padd_0 bg_content">

                    <div class="col-md-5">

                        <ul class="list-inline marg_0">

                            <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                            <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                            <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                            <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>
                            <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="image"></li>

                        </ul>
                        <span>(5.00) 4 reviews</span>
                    </div>

                    <div class="col-md-7 font_16">

                        <i class="mrg_r5"><img alt="starimage"src="img/location1.png" alt="image"></i>United States (UTC - 06)

                    </div>
                    <div class="clearfix"></div>

                    <span class="col-md-12 padd_tb15 font_16 text-muted">Member since May 12 2012</span>

                    <div class="col-md-6">
                        Total Spent</div><div class="col-md-6">Over $10,000</div>

                    <div class="col-md-6">
                        Jobs Posted </div><div class="col-md-6"> 159</div>

                    <div class="col-md-6">
                        Hires </div><div class="col-md-6">129</div>

                    <div class="col-md-6">
                        Open Jobs</div><div class="col-md-6">6</div>







                </div>
            </div>

        </div> 
    </div>

</div>
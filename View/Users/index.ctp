<div class="container marg_tb50">
    <?php echo $this->Session->flash(); ?>
    <h1 class="text-center newcls ">Lets get started</h1>
    <h2 class="text-center marg_btm30">First, tell us what you're looking for.</h2>

    <div class="row">

        <div class="col-md-5 col-sm-5 col-md-offset-1 col-sm-offset-1 marg_btm30">

            <div class="sign_upbox">

                <div class="signup_content marg_tb15">
                    <div class="col-md-3 col-sm-3">

                        <span class="img_box">

                            <img src="<?php echo $this->webroot; ?>img/freelancer.png" alt="freelancerImage"/>

                        </span>

                    </div>

                    <div class="col-md-9 col-sm-9 text-left">

                        <h3 class="marg_0">I need a freelancer</h3>
                        <p class="font_18">Find, hire, manage, and pay for help, on
                            demand.</p>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <a  style="text-decoration:none;" href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'client')); ?>">  
                    <button class="btn-block">signup</button></a>
                <div class="clearfix"></div>

            </div>

        </div>

        <div class="col-md-5 col-sm-5 marg_btm30">

            <div class="sign_upbox">

                <div class="signup_content marg_tb15">
                    <div class="col-md-3 col-sm-3">

                        <span class="img_box">

                            <img src="<?php echo $this->webroot; ?>img/freelancer.png" alt="freelancerIcon"/>

                        </span>

                    </div>

                    <div class="col-md-9 col-sm-9 text-left">

                        <h3 class="marg_0">I need a job</h3>
                        <p class="font_18">Find work, earn money, and grow your career.</p>



                    </div>
                    <div class="clearfix"></div>

                </div>
                <a style="text-decoration:none;" href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'freelancer')); ?>">     <button class="btn-block">signup</button></a>
                <div class="clearfix"></div>

            </div>

        </div>

    </div>

</div>
<style>
    .newcls{
        color: #333333;
    }
</style>




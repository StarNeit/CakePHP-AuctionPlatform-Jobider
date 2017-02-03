<?php //pr($_SESSION); ?>

<div class="container marg_tb50">
     <?php //pr($_SESSION);?>
    <?php echo $this->Session->flash(); ?>
    <h2 class="text-center marg_tb50">Create a free Client Account </h2>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="cut_tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li<?php if ((isset($this->params['data']['User']['employer_type']) and $this->params['data']['User']['employer_type'] != 'company') or (empty($this->params['data']['User']['employer_type']))) { ?>  class="active" <?php } ?>   role="presentation" ><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Signup as Individual</a></li>
                    <li <?php if (!empty($this->params['data']['User']['employer_type']) and $this->params['data']['User']['employer_type'] == 'company') { ?> class="active" <?php } ?> role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Signup as Company</a></li>

                </ul>
                <div id="myTabContent" class="tab-content">
                    <div aria-labelledby="home-tab" id="home"  <?php if ((isset($this->params['data']['User']['employer_type']) and $this->params['data']['User']['employer_type'] != 'company') or (empty($this->params['data']['User']['employer_type']))) { ?> class="tab-pane fade in active" <?php } else { ?>class="tab-pane fade" <?php } ?> role="tabpanel">
                        <?php echo $this->Form->create('User', array('role' => 'form', 'class' => 'formstyle form_sighn', 'url' => array('controller' => 'users', 'action' => 'client'))); ?>
                        <!--                        <form role="form" class="formstyle form_sighn">-->
                        <div class="col-md-7 col-md-offset-0 col-sm-5">

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <?php
//pr($_SESSION);

                                    if (isset($_SESSION['google_data']) and !empty($_SESSION['google_data'])) {
                                        $firstName = $_SESSION['google_data']['given_name'];
                                        $lastName = $_SESSION['google_data']['family_name'];
                                        $email = $_SESSION['google_data']['email'];
//                                        $google_token = json_decode($_SESSION['token'], true);
                                    } if (isset($_SESSION['facebook_info']) && !empty($_SESSION['facebook_info'])) {
//                                        pr($facebook_profile);die;

                                        $firstName = $_SESSION['facebook_info']['first_name'];
                                        $lastName = $_SESSION['facebook_info']['last_name'];
                                        $email = $_SESSION['facebook_info']['email'];
                                    } if (!empty($_SESSION['linkedIn_info']) && isset($_SESSION['linkedIn_info'])) {
                                        $firstName = $_SESSION['linkedIn_info']->firstName;
                                        $lastName = $_SESSION['linkedIn_info']->lastName;
                                        $email = $_SESSION['linkedIn_info']->emailAddress;
                                    }
                                  if(!isset($_SESSION['linkedIn_info']) && !isset($_SESSION['facebook_info']) && !isset($_SESSION['google_data']))
                                 {
                                        $firstName = '';
                                        $lastName = '';
                                        $email = '';
                                    }
                                    echo $this->Form->input('first_name', array('type' => 'text', 'placeholder' => 'First Name', 'value' => $firstName, 'label' => false, 'class' => 'form-control', 'required' => false))
                                    ?>
<!--                                        <input type="text" placeholder="First Name" class="form-control" id="exampleInputEmail1">-->
                                </div> </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('last_name', array('type' => 'text', 'placeholder' => 'Last Name', 'value' => $lastName, 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
<!--                                        <input type="text" placeholder="Last Name" class="form-control" id="exampleInputEmail1">-->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email ID', 'value' => $email, 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
<!--                                        <input type="email" placeholder="Email" class="form-control" id="exampleInputEmail1">-->
                                </div> </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
<!--                                        <input type="email" placeholder="Password" class="form-control" id="exampleInputEmail1">-->
                                </div> </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="data[User][agree]"> I agree to the <a class="text_deco" href="<?php echo $this->Html->Url(array('controller'=>'pages','action'=>'termsofservices'))?>">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 marg_btm30 text-center">
                                <input type="hidden" name="data[User][type]" value="client">                         
                                <input type="hidden" name="data[User][employer_type]" value="individual">                         

                                <button type="submit" class="btn btn-lg  btn_red marg_tb15 ">Get Started</button>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>

                        <div class="col-md-5 bdr_lft mrg_left hdng hyt_new col-sm-5 wdth_hundrd">
                            <span class="or_dv">or</span>
                            <a class="margn_tp" href="http://www.jobider.com/login/Facebook"><img alt="Facebook New icon" class="img-responsive margn_tp" id="facebook" src="<?php echo $this->webroot; ?>img/fb_new.png"></a>
                            <a class="margn_tp" href="http://www.jobider.com/login/linkedin"><img alt="Linked in New" class="img-responsive margn_tp" id="googleplus" src="<?php echo $this->webroot; ?>img/linkedin.png" height="40px" width="370px"></a>
                            <a href="http://www.jobider.com/login/GooglePlus" class="margn_tp"><img alt="Google plus icon" class="img-responsive margn_tp" id="googleplus" src="<?php echo $this->webroot; ?>img/gp1_new.png"></a>
                        </div>
                        <!--   </form>-->

                    </div>
                    <div role="tabpanel" <?php if (!empty($this->params['data']['User']['employer_type']) and $this->params['data']['User']['employer_type'] == 'company') { ?> class="tab-pane fade in active" <?php } else { ?>class="tab-pane fade" <?php } ?> id="profile" aria-labelledby="profile-tab">
                        <?php echo $this->Form->create('User', array('role' => 'form', 'class' => 'formstyle form_sighn', 'url' => array('controller' => 'users', 'action' => 'client'))); ?>

                        <!--                        <form role="form" class="formstyle form_sighn">-->
                        <div class="col-md-7 col-md-offset-0 col-sm-5">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('first_name', array('type' => 'text', 'placeholder' => 'First Name', 'label' => false, 'class' => 'form-control', 'required' => false, 'value' => $firstName)) ?>
<!--                                        <input type="text" placeholder="First Name" class="form-control" id="exampleInputEmail1">-->
                                </div> </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('last_name', array('type' => 'text', 'placeholder' => 'Last Name', 'label' => false, 'class' => 'form-control', 'required' => false, 'value' => $lastName)) ?>
<!--                                        <input type="text" placeholder="Last Name" class="form-control" id="exampleInputEmail1">-->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email ID', 'label' => false, 'class' => 'form-control', 'required' => false, 'value' => $email)) ?>
<!--                                        <input type="email" placeholder="Email" class="form-control" id="exampleInputEmail1">-->
                                </div> </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
<!--                                        <input type="email" placeholder="Password" class="form-control" id="exampleInputEmail1">-->
                                </div> </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <?php echo $this->Form->input('company', array('type' => 'text', 'placeholder' => 'Company Name', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
<!--                                        <input type="email" placeholder="Comapny Name" class="form-control" id="exampleInputEmail1">-->
                                </div> </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="data[User][agree]"> I agree to the <a class="text_deco" href="#">terms and conditions</a>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="checkbox marg_0">
                                    <label>
                                        <input type="checkbox" name="data[User][email_alert]"> Yes! Send me genuinely useful emails very now and then to help me get the most out of Jobider
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 marg_btm30 text-center">

                                <input type='hidden' name='data[User][type]' value='client'/>
                                <input type='hidden' name='data[User][employer_type]' value='company'/>
                                <button type="submit" class="btn btn-lg  btn_red marg_tb15 ">Get Started</button> </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                        <div class="col-md-5 bdr_lft mrg_left hdng hyt_new col-sm-5 wdth_hundrd">
                            <span class="or_dv">or</span>

                            <a href="http://www.jobider.com/login/Facebook"> <img alt="Facebook" class="img-responsive margn_tp" id="facebook" src="<?php echo $this->webroot; ?>img/fb_new.png"></a>

                            <a href="http://www.jobider.com/login/linkedin"><img alt="LinkedIn" class="img-responsive margn_tp" id="googleplus" src="<?php echo $this->webroot; ?>img/linkedin.png"></a>

                            <a href="http://www.jobider.com/login/GooglePlus"><img alt="GooglePlus" class="img-responsive margn_tp" id="googleplus" src="<?php echo $this->webroot; ?>img/gp1_new.png"></a>
                       </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
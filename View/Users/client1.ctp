<?php
//pr($this->params); 
//if($this->params['data']['User']['employer_type']=='company'){
//    die('com');
//}else{
//    die('not');
//}
?>
<div class="container marg_tb50">
    <?php echo $this->Session->flash(); ?>
    <h2 class="text-center marg_tb50">Create a free Client Account </h2>
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="cut_tabs">
                <ul role="tablist" class="nav nav-tabs" id="myTab">
                    <li <?php if ((isset($this->params['data']['User']['employer_type']) and $this->params['data']['User']['employer_type'] != 'company') or (empty($this->params['data']['User']['employer_type']))) { ?>  class="active" <?php } ?> role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">Sign up as Individual</a></li>

                    <li <?php if (!empty($this->params['data']['User']['employer_type']) and $this->params['data']['User']['employer_type'] == 'company') { ?> class="active" <?php } ?> role="presentation"><a aria-controls="profile" data-toggle="tab" id="profile-tab" role="tab" href="#profile">Sign up as Company</a></li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <!--            <form class="formstyle form_sighn" role="form">-->
                    <div aria-labelledby="home-tab" id="home"  <?php if ((isset($this->params['data']['User']['employer_type']) and $this->params['data']['User']['employer_type'] != 'company') or (empty($this->params['data']['User']['employer_type']))) { ?> class="tab-pane fade in active" <?php } else { ?>class="tab-pane fade" <?php } ?>role="tabpanel">
                        <?php echo $this->Form->create('User', array('role' => 'form', 'class' => 'formstyle form_sighn', 'url' => array('controller' => 'users', 'action' => 'client'))); ?>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('first_name', array('type' => 'text', 'placeholder' => 'First Name', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                            </div> </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('last_name', array('type' => 'text', 'placeholder' => 'Last Name', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                    <!--          <input type="text" id="exampleInputEmail1" class="form-control" placeholder="Last Name">-->
                            </div>
                        </div>
                        <div class='clearfix'> </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email ID', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                            </div> 
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                            </div>
                        </div>
                        <div class='clearfix'></div>
                        <div class="col-md-12 col-sm-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name='data[User][agree]'> I agree to the <a href="#" class="text_deco">terms and conditions</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 marg_btm30 text-center">
                            <input type="hidden" name='data[User][type]' value="client">
                            <input type="hidden" name='data[User][employer_type]' value="individual">
                            <button class="btn btn-lg  btn_red marg_tb15 " type="submit">Get Started</button> </div>
                        <?php echo $this->Form->end(); ?>

                    </div>
                    <div aria-labelledby="profile-tab" id="profile" <?php if (!empty($this->params['data']['User']['employer_type']) and $this->params['data']['User']['employer_type'] == 'company') { ?> class="tab-pane fade in active" <?php } else { ?>class="tab-pane fade" <?php } ?> role="tabpanel">
                        <?php echo $this->Form->create('User', array('role' => 'form', 'class' => 'formstyle form_sighn', 'url' => array('controller' => 'users', 'action' => 'client'))); ?>
                        <!--        <form class="formstyle form_sighn" role="form">-->
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('first_name', array('type' => 'text', 'placeholder' => 'First Name', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                              <!--<input type="text" id="exampleInputEmail1" class="form-control" placeholder="First Name">-->
                            </div> </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('last_name', array('type' => 'text', 'placeholder' => 'Last Name', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                    <!--          <input type="text" id="exampleInputEmail1" class="form-control" placeholder="Last Name">-->
                            </div>
                        </div>
                        <div class='clearfix'></div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email ID', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                              <!--<input type="email" id="exampleInputEmail1" class="form-control" placeholder="Email">-->
                            </div> </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                              <!--<input type="email" id="exampleInputEmail1" class="form-control" placeholder="Password">-->
                            </div> </div>
                        <div class='clearfix'></div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <?php echo $this->Form->input('company', array('type' => 'text', 'placeholder' => 'Company Name', 'label' => false, 'class' => 'form-control', 'required' => false)) ?>
                              <!--<input type="email" id="exampleInputEmail1" class="form-control" placeholder="Comapny Name">-->
                            </div> </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"  name='data[User][agree]'> I agree to the <a href="#" class="text_deco">terms and conditions</a>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="checkbox marg_0">
                                <label>
                                    <input type="checkbox" name='data[User][email_alert]'> Yes! Send me genuinely useful emails very now and then to help me get the most out of Jobider</a>
                                </label>
                            </div>
                        </div>
                        <div class='clearfix'></div>
                        <div class="col-md-12 marg_btm30 text-center">
                            <input type="hidden" name='data[User][type]' value="client">
                            <input type="hidden" name='data[User][employer_type]' value="company">
                            <button class="btn btn-lg  btn_red marg_tb15 " type="submit">Get Started</button> </div>
                        <?php echo $this->Form->end(); ?>
                    </div>

                    <div class="clearfix"></div>

                </div>
            </div>

        </div>


    </div>

</div>


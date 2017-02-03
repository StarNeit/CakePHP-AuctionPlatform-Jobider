<style>
    #UserCountry > option {
        width: 190px !important;
    }
</style>

<?php $submitted_data = $this->Session->read('userData'); ?>
<div class="container marg_tb50">
    <?php echo $this->Session->flash(); ?>
    <h2 class="text-center marg_tb50">Create a free Freelancer Account </h2>


    <div class="row">


        <div class="col-md-6 col-md-offset-3">


            <div class="cut_tabs">
                <ul role="tablist" class="nav nav-tabs" id="myTab">
                    <li class="active" role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">Sign up as Freelancer</a></li>


                </ul>
                <div class="tab-content" id="myTabContent">
                    <div aria-labelledby="home-tab" id="home" class="tab-pane fade in active" role="tabpanel">

                        <?php echo $this->Form->create('User', array('role' => 'form', 'class' => 'formstyle form_sighn', 'url' => array('controller' => 'users', 'action' => 'freelancer'))); ?>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('first_name', array('type' => 'text', 'placeholder' => 'First Name', 'label' => false, 'class' => 'form-control', 'required' => false, 'value' => $submitted_data['User']['first_name'])) ?>
                            </div> </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('last_name', array('type' => 'text', 'placeholder' => 'Last Name', 'label' => false, 'class' => 'form-control', 'required' => false, 'value' => $submitted_data['User']['last_name'])) ?>
                            </div>
                        </div>
                        <div class='clearfix'></div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('email', array('type' => 'email', 'placeholder' => 'Email ID', 'label' => false, 'class' => 'form-control', 'required' => false, 'value' => $submitted_data['User']['email'])) ?>

                            </div> </div>

                        <div class="col-md-6 col-sm-3">
                            <div class="form-group">
                                <?php if (!empty($submitted_data['User']['country'])) { ?> 
                                    <?php echo $this->Form->input('country_id', array('label' => false, 'required' => FALSE, 'class' => 'form-control ', 'type' => 'select', 'options' => array($find), 'default' => $submitted_data['User']['country'], 'empty' => 'Select Your Country')); ?>
                                <?php } else { ?>
                                    <?php echo $this->Form->input('country_id', array('label' => false, 'required' => FALSE, 'class' => 'form-control ', 'type' => 'select', 'options' => array($find), 'empty' => 'Select Your Country')); ?>
                                <?php } ?>

                            </div> </div>
                        <div class='clearfix'></div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Username', 'label' => false, 'class' => 'form-control', 'required' => false, 'value' => $submitted_data['User']['username'])) ?>

                            </div> </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password', 'label' => false, 'class' => 'form-control', 'required' => false, 'value' => $submitted_data['User']['password'])) ?>

                            </div> </div>
                        <div class='clearfix'></div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <?php if (!empty($submitted_data['User']['reference_from'])) { ?> 
                                    <?php echo $this->Form->input('reference_from', array('label' => false, 'required' => FALSE, 'class' => 'form-control ', 'type' => 'select', 'options' => array('Internet' => 'Internet', 'Newspaper' => 'Newspaper', 'Magazine' => 'Magazine', 'Friend' => 'Friend', 'Other' => 'Other'), 'default' => $submitted_data['User']['reference_from'], 'empty' => 'How did you hear about us?')); ?><?php } else { ?>
                                    <?php echo $this->Form->input('reference_from', array('label' => false, 'required' => FALSE, 'class' => 'form-control ', 'type' => 'select', 'options' => array('Internet' => 'Internet', 'Newspaper' => 'Newspaper', 'Magazine' => 'Magazine', 'Friend' => 'Friend', 'Other' => 'Other'), 'empty' => 'How did you hear about us?')); ?>
                                <?php } ?>
                            </div> 
                        </div>
                        <div class='clearfix'></div>
                        
          <div class="col-md-12">
                            <div class="form-group">
                                <label>How do you want to represent yourself to Clients on Jobider? 
                                </label><br>
                                <div>
                                    <input type="radio" name="data[User][employer_type]" value='individual' id='indvsul' checked="">&nbsp; Individual &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="data[User][employer_type]" value='company' id='cmpny'>&nbsp; Company
                            </div> 
                            </div> 
                        </div>
                        <div class='clearfix'></div>
                                 <div class="col-md-12 col-sm-12" style='display:none;' id='cmpny_name'>
                            <div class="form-group">
                                <input type='text' name='data[User][company_name]' class='form-control' placeholder='Enter your Company Name'>
                            </div> 
                        </div>
                        <div class='clearfix'></div>
                        <div class="col-md-12 col-sm-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name='data[User][agree]' <?php if (isset($submitted_data['User']['agree']) and ($submitted_data['User']['agree'] == "on")) { ?> checked<?php } ?>> I agree to the <a href="#" class="text_deco">terms and conditions</a>
                                </label>
                            </div>
                        </div>
                        <div class='clearfix'></div>

                        <div class="col-md-12 col-sm-12">
                            <div class="checkbox marg_0">
                                <label>
                                    <input type="checkbox"  name='data[User][email_alert]' <?php if (isset($submitted_data['User']['email_alert']) and ($submitted_data['User']['email_alert'] == "on")) { ?> checked<?php } ?>> Yes! Send me genuinely useful emails every now and then to help me get the most out of Jobider</a>
                                </label>
                            </div>
                        </div>
                        <div class='clearfix'></div>

                        <div class="col-md-12 marg_btm30 text-center">
                            <input type='hidden' name='data[User][type]' value='freelancer'>
                            <button class="btn btn-lg  btn_red marg_tb15 " type="submit">Get  Started</button> </div>

                        <?php echo $this->Form->end(); ?>

                    </div>


                    <div class="clearfix"></div>

                </div>
            </div>

        </div>


    </div>

</div>
<script>
    $('#cmpny').on('click',function(){
     $('#cmpny_name').show();
    });
     $('#indvsul').on('click',function(){
     $('#cmpny_name').hide();
    });
  </script>
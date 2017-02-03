<div class="container">

    <div class="row marg_tb15">

        <div class="col-md-3 pad_l0 col-sm-3">

            <?php echo $this->element('client_profile_sideber'); ?>

            <?php echo $this->element('client_notification'); ?>
        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">

                <div class="green"> My Profile </div>

                <?php echo $this->Form->create('User', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'role' => 'form', 'url' => array('controller' => 'client', 'action' => 'settings'))); ?>
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label> First Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                      <?php echo ucfirst($userdata['User']['first_name']); ?>
                    </div> </div>
                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label> Last Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                        <?php echo ucfirst($userdata['User']['last_name']); ?>
                    </div> 
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>E-mail &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <?php echo $userdata['User']['email']; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php if (!empty($userdata['User']['phone'])) { ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label> Phone &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <?php echo $userdata['User']['phone']; ?>
                        </div> </div>
                <?php } else { ?>
                <?php } ?>
                <div class="clearfix"></div>
                <?php if (!empty($userdata['User']['timezone'])) { ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                   <label>Time Zone &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <?php echo $date = date('F d Y', strtotime($userdata['User']['timezone'])); ?>
                        </div>
                    </div>
                <?php } else { ?>
                <?php } ?>
                <div class="clearfix"></div>
                <?php if (!empty($userdata['User']['company'])) { ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label> Company &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <?php echo $userdata['User']['company']; ?>
                        </div>
                    </div>
                <?php } else { ?>
                <?php } ?>

                <div class="clearfix"></div> 
                <?php if(isset($userdata['User']['image']) and !empty($userdata['User']['image'])) {?>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Image &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <img  src="<?php echo $this->webroot; ?>uploads/<?php echo $userdata['User']['image']; ?>" height="100" width="100">
                    </div>
                </div>
                <?php  } else{?> 
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Image &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <img class="img-thumbnail" src="<?php echo $this->webroot; ?>img/user_1.png" height="100" width="100">
                    </div>
                </div>
                <?php } ?>
                
                
                <div class="clearfix"></div>
                <?php if (!empty($userdata['User']['skills'])) { ?>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group marg_0">
                            <label>Skills &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <?php  foreach($userskill as $k=>$v){ ?>
                            <button class="skill_style" disabled><?php echo $v['Subskill']['skill_name']; ?></button>    <?php } ?>
                        </div>  
                    </div>
                <?php } else { ?>
                <?php } ?>
                <div class="clearfix"></div>
                <?php if (!empty($userdata['User']['description'])) { ?>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group marg_0">
                            <label>Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <p style="text-align: justify;"> <?php echo $userdata['User']['description']; ?></p>  </div>   </div>
                <?php } else { ?><?php } ?>
                <div class="col-md-12 marg_tb50 text-center">
                    <p><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'editprofile', $userdata['User']['id'])); ?>"/>
                        <button class="btn-lg btn-green1" type="button"> Edit My Profile </button></a>
                    </p>
                </div>



                <?php echo $this->Form->end(); ?>




                <div class="clearfix"></div>
            </div>


        </div>
        <div class="clearfix"> </div> </div>          

</div>

</div>

</div>



<style>
    .skill_style {
    background: none repeat scroll 0 0 #e3e3df;
    border: 0 none;
    border-radius: 4px !important;
    color: #666775 !important;
/*    float: left;*/
    margin: 3px 5px !important;
    padding: 4px !important;
}
</style>
<?php
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'postajob')) {
    $postajob = 'active';
} else {
    $postajob = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'searchfreelancer')) {
    $searchfreelancer = 'active';
} else {
    $searchfreelancer = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'contract') && $this->params['pass']['0'] == $users['User']['id']) {
    $searchfreelancer = 'active';
} else {
    $searchfreelancer = '';
}
?> 
<div class="container">

    <div class="row marg_tb15">

        <div class="col-md-3 pad_l0 col-sm-3">

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                    <li><a href="<?php echo $this->webroot; ?>client/postajob"> Post a job </a></li>
                    <li><a href="<?php echo $this->webroot; ?>client/searchfreelancer"> Search for freelancer </a></li>
                    <li><a href="<?php echo $this->webroot; ?>client/postedJobs">Jobs i have posted </a></li>
                    <li><a href="<?php echo $this->webroot; ?>client/job_payment">Jobs Payment</a></li>
                </ul>
                </div>
            </div>

         <?php  echo $this->element('client_notification'); ?>



        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">

       <div class="row marg_btm30"> 
              
        <!--steps start -->
        <div class="col-md-12 list_1">
          <div class="blue_line_bg">
            <div class="col-xs-4 text-center block1 pdng"> 
                <?php 
//                pr($this->params);
//                die('sdkfhas'); 
                if($this->params['controller']=='client' and $this->params['action']=='contract') {?>
                <span class="  bg_grey_1"><font color="#817D7C">1</font></span> <br>
                <?php } else{?>
                 <span class="bg_blue_1">1</span> <br>
                 <?php } ?>
              <br>
              <label class="font_size16">Contract</label>
            </div>
            <div style="text-align:center;" class="col-xs-4 text-center block1 pdng"> 
                 <?php      if($this->params['controller']=='client' and $this->params['action']=='review_hire') {?>
                <span class=" bg_grey_1"><font color="#817D7C">2</font></span> <br>
                   <?php } else{?>
                 <span class="bg_blue_1">2</span> <br>
                 <?php } ?>
              <br>
              <label class="font_size16">Review</label>
            </div>
            <div class="col-xs-4 text-center block1 pdng">
              <div class="gree"> <span class="">
                       <?php      if($this->params['controller']=='client' and $this->params['action']=='milestone') {?>
                      <span class="bg_grey_1"><font color="#817D7C">3</font></span> </span> <br>
                                      <?php } else{?>
                        <span class="bg_blue_1">3</span> </span> <br>
                 <?php } ?>
                <br>
                <label class="font_size16 text_blue">Milestone and Hire</label>
              </div>
            </div>
          </div>
        </div>
               
      </div>
            <?php echo $this->Form->create('Hire',array('class'=>'apply_jobform withdraw_earnings p15 font_14','role'=>'form','url'=>array('controller'=>'client','action'=>'review_hire'))); ?>
            <div class="data_div">
    <div class="bg_white marg_btm30">

                <div class="green">

                    Hiring Company

                </div>

  <div class="row" style="margin-left:10px;margin-top: 10px;">
                        <label class="col-sm-4 opensans font_14">Company Name </label>
                        <div class="col-sm-8">
                            <span class="font_14 grayclr opensans"><?php if(!empty($user['User']['company'])){echo $user['User']['company']; }else{ echo 'No company registred yet !';}?></span>
                        </div>
                    </div>

                    <div class="row" style="margin-left:10px;">
                        <label class="col-sm-4 opensans font_14">Hiring Manager</label>
                        <div class="col-sm-8">
                            <span class="font_14 grayclr opensans"><?php if(isset($user)){ echo $user['User']['first_name'];} ?></span>
                        </div>
                    </div>
<?php if(isset($job_data) and !empty($job_data)){ ?>
                    <div class="row" style="margin-left:10px;">
                        <label class="col-sm-4 opensans font_14">Job   </label>
                        <div class="col-sm-8">
                            <span class="font_14 grayclr opensans"><?php echo $job_data['Job']['job_title'] . '    (<strong>' . 'Fixed'.'</strong>)'; ?></span>
                        </div>
                    </div>
<?php }?>

                <div class="clearfix"></div>
            </div>

            <div class="bg_white marg_btm30">

                <div class="green">

                    Contractor

                </div>

   <div class="row" style="margin-left:10px; margin-top: 10px;">
                        <label class="col-sm-4 opensans font_14">Contractor</label>
                        <div class="col-sm-8">
                            <div class="user_imgbox">
                                <?php if (!empty($users['User']['image'])) { ?>
                                <?php if(isset($users['User']['image'])){ ?>
                                    <img alt="login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $users['User']['image']; ?>" width="100" height="100">
                                <?php } ?>
                                <?php } else { ?>
                                    <img alt="User login image" src="<?php echo $this->webroot; ?>img/user_1.png">
                                <?php } ?>

                            </div>
                            <span style="text-align:center;margin-left: 8px;"><?php if(isset($users)){ echo $users['User']['first_name'] . ' ' . $users['User']['last_name']; } ?></span>
                        </div>
                    </div>

 <div class="clearfix"></div>
            </div>

            <button class="btn-lg btn-green  col-md-3" type="submit">Submit Review</button><button class="btn-lg btn-green  col-md-2 marg_l20">Cancel</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>


    </div>

</div>
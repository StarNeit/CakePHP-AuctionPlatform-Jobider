<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('employee_settings'); ?>
     
     <div class="col-md-9 col-sm-9  pad_r0 ">
<div class="bg_white">
<div class="green"> Membership &amp; Connect Summary </div>
<form role="form" class="apply_jobform withdraw_earnings p15 font_14 membership">
<div class="row">
  <label class="col-sm-3 opensans font_14">Current Plan</label>
  <div class="col-sm-9">
      <?php  if($userdata['User']['membership_type']=='premium_smallAgency'){ ?>
    <p class="font_14 grayclr opensans">Premium Membership for Small Agency</p>
      <?php }elseif($userdata['User']['membership_type']=='premium_largeAgency'){ ?>
    <p class="font_14 grayclr opensans">Premium Membership for Large Agency</p>
      <?php }elseif($userdata['User']['membership_type']=='premium'){ 
?>
      <p class="font_14 grayclr opensans">Premium</p>
    <?php
      } else {?>
    <p class="font_14 grayclr opensans"> Freelancer Basic</p>
      <?php } ?>
    <a class="opensans font_14" href="<?php  echo $this->webroot; ?>freelancer/viewandedit_membershipPlans">View or Edit membership plan</a> </div>
</div>
<div class="row">
  <label class="col-sm-3 opensans font_14">Available Connects</label>
  <div class="col-sm-9">
      <?php  if(!empty($userdata['User']['used_connects']) and $userdata['User']['used_connects']=='0'){?>
    <p class="font_14 grayclr opensans"><?php echo $userdata['User']['connects']; ?></p>
      <?php  }else { 
          $total_used_contects=$userdata['User']['connects']-$userdata['User']['used_connects'];?>
    <p class="font_14 grayclr opensans"><?php echo $total_used_contects; ?></p>
      <?php } ?>
    <a class="opensans font_14" href="<?php  echo $this->webroot;?>freelancer/view_connect_history/<?php  echo $userdata['User']['id'];?>">View Connect History</a> </div>
</div>
<div class="row">
  <label class="col-sm-3 opensans font_14">Membership connects</label>
  <div class="col-sm-9">
<!--<p class="font_14 grayclr opensans">60 per month</p>-->
   
      <?php if($userdata['User']['membership_type']=='premium_smallAgency'){
          
          $connects='70';?>
    <p class="font_14 grayclr opensans"><?php  echo $connects; ?></p>
      <?php }elseif($userdata['User']['membership_type']=='premium_largeAgency'){
          $connects='70';?>
     <p class="font_14 grayclr opensans">
         <?php  echo $connects; ?>
     </p>
      <?php }
      elseif($userdata['User']['membership_type']=='premium') {
          $connects='60';
          ?>
     
        <p class="font_14 grayclr opensans"><?php  echo $connects; ?></p>
      <?php }else{ 
          $connects='50';
          ?>
         <p class="font_14 grayclr opensans"><?php  echo $connects; ?></p>
      <?php }?>
<!--    <a class="opensans font_14" href="#">View or Edit membership plan</a>-->
  </div>
</div>
<div class="row">
  <label class="col-sm-3 opensans font_14">Membership Fee </label>
  <div class="col-sm-9">
      <?php if($userdata['User']['membership_type']=='premium_smallAgency'){ ?>
    <p class="font_14 grayclr opensans">$15</p>
      <?php }elseif($userdata['User']['membership_type']=='premium_largeAgency'){?>
     <p class="font_14 grayclr opensans">$40</p>
      <?php }elseif($userdata['User']['membership_type']=='premium') {?>
        <p class="font_14 grayclr opensans">$5</p>
      <?php } else{?>
         <p class="font_14 grayclr opensans"><?php echo ucfirst($userdata['User']['membership_type']); ?></p>
      <?php } ?>
<!--    <a class="opensans font_14" href="#">View or Edit membership plan</a>-->
  
  </div>
</div>
    
    <div class="row">
  <label class="col-sm-3 opensans font_14"> Current Billing Cycle </label>
  <div class="col-sm-9">
     
         <p class="font_14 grayclr opensans"><?php echo $start_date.' - '.$end_date; ?></p>
      

  
  </div>
</div>
<!--    
<div class="row">
  <label class="col-sm-3 opensans font_14">Current Plan</label>
  <div class="col-sm-9">
    <p class="font_14 grayclr opensans">$ 1.99</p>
    <a class="opensans font_14" href="#">View or Edit membership plan</a> </div>
</div>
    
<div class="row">
  <label class="col-sm-3 opensans font_14">Current Plan</label>
  <div class="col-sm-9">
    <p class="font_14 grayclr opensans">$ 1.99</p>
    <a class="opensans font_14" href="#">View or Edit membership plan</a> </div>
</div>-->
</form>
</div>
</div>
               
    </div>
</div>
<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>

<script>
                                $(document).ready(function() {
                                    $("#UserSettingsForm").validate({
                                        rules: {
                                            'data[User][password_old]': {
                                                required: true,
                                            },
                                            'data[User][password_new]': {
                                                required: true,
                                            },
                                            'data[User][password_confirm]': {
                                                required: true,
                                            },
                                        },
                                        messages: {
                                            'data[User][password_old]': {
                                                required: "Please enter old password !",
                                            },
                                            'data[User][password_new]': {
                                                required: "Please enter new password !",
                                            },
                                            'data[User][password_confirm]': {
                                                required: "Please ReType your Password !",
                                            },
                                        },
                                    });
                                });
</script>

<style>
    label.error {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 258px;
    }
</style>

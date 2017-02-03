<?php 
if (isset($logged['User'])) {
    //echo"1";
    $loggedInUser = $loggedInUser;
} else {
    //echo"2";
    $logged1 = $loggedInUser;
    unset($loggedInUser);
    $loggedInUser['User'] = $logged1;
}//pr($loggedInUser);
?>
<div class="right_panel">

    <div class="holder">
        <h3 class="font_20"><?PHP ECHO _TWITTER_PROFILES_; ?></h3>

        <hr class="hr_bg">
        <?php echo $this->Session->flash(); ?>
        <div class="social_lnkbtn"> 


            <a href="<?php echo BASE_URL . 'dashboard/save_profiles/twitter?connect=true' ?>"><?php echo $this->Html->image('twitter_connect.png', array('class' => 'img-responsive')); ?></a> 
            <a href="<?php echo BASE_URL?>dashboard/social_profiles/allprofile" class="btn btn-lg pull-right btn_color3"><?PHP ECHO _GO_TO_ALL_PROFILES_;?></a>
        </div>
        <br/>
        <div class="clearfix"></div>
        <?php if (!empty($outdated_user_profiles_count)) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close thistoleft" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h6 class=" m_t10"><?PHP ECHO _NOTE_UPDATE_REQUIRED_FOR_; ?><?php echo ' '.$outdated_user_profiles_count;?>  <?PHP ECHO _READ_MARKED_PROFILES_; ?></h6>
</div>
                
            <?php
            } if ((isset($profiles) && !empty($profiles))) {
            ?>
            <div class="panel panel-primary m_t10">
                <div class="panel-heading"><?PHP ECHO _TWITTER_ACCOUNTS_; ?></div>
                <div class="panel-body">
                    <?php $i = 0; ?>

                    <?php
                    foreach ($profiles as $single) {
                        ?>

                        <div class="publishpostcontainer">
                            <div class="publishpostheading twitter_bg_clr"><img src="/developer/img/twitter1.png"> 
        <!--                                        <a onClick="return confirm('Do You Really Want to Delete the Profile?')" href="<?php // echo BASE_URL    ?>dashboard/delete_profile/twitter/<?php // echo $single['Profile']['id']    ?>" class="pull-right"><img src="/developer/img/cross.jpg"></a>-->
                            </div>
                            <div class="publishpostcontent">

                                <?php
                                $twname = ucwords($single['Profile']['twitter_name']);
                                $twimage = $single['Profile']['twitter_image_url'];
                                echo "<img src='$twimage' title='$twname' class='img-thumbnail img-responsive example' data-toggle='tooltip', data-placement='bottom'>"
                                ?>                                                                                                                                     <!--                        <img src="https://graph.facebook.com/715351611873476/picture?type=square" class="img-thumbnail img-responsive" >
                                -->

                            </div>
                        </div>
                    <?php }
                    ?>
                </div>

            </div>
        <?php } ?>
    </div>

    <div class="clearfix"></div>
</div>
</div>


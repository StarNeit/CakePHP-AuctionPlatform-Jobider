<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
            <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="active"><a href="<?php echo $this->webroot; ?>freelancer/dashboardHelp"/> Help </a>
                        </li>
<!--    <li><a href="<?php echo $this->webroot; ?>freelancer/freelancer_dispute"/>  Dispute </a>-->
                        </li>
                    </ul>
                </div>
            </div> 
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <?php   if(!empty($notification) ){?>
                        <marquee onmouseout="this.start()" onmouseover="this.stop()" scrolldelay="200" direction="up" scrollamount="8" behavior="scroll" height="100" vspace="20">
                <?php foreach ($notification as $k => $v) { 
                  
                    ?>
                 <?php  if($v['Notification']['status']=='0'){?>
                   <p class="font_14" style="margin:15px; line-height:18px">
                       <a href="<?php  echo $v['Notification']['url'];?>" style="color: #434343; text-decoration: none;"><?php echo $v['Notification']['notification_msg']; ?></a>
                         <img src="<?php  echo $this->webroot;?>img/new_icon.gif" alt="new icon gif image">
                        </p>
                       
                    <?php } else{ ?>
                        <p class="font_14" style="margin:15px; line-height:18px">
                            <a href="<?php  echo $v['Notification']['url'];?>" style="color:#434343;text-decoration: none;"><?php echo $v['Notification']['notification_msg']; ?></a>
                        </p>
                    <?php  }?>
                    <?php } ?></marquee>
                    <?php } else{?>        
                    <p style="font-size: 15px; text-align: center; margin-top: 25px; margin-bottom: 25px;">No Notifcation(s) Recieved !</p>        
                    <?php } ?>
                    <p><i><img alt="View icon image" class="mrg_r5" src="<?php echo $this->webroot; ?>img/view.png"></i><a href="<?php echo $this->webroot; ?>freelancer/allNotifications" style="text-decoration: none;"/>See all notifications &gt;&gt;</a></p>  </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class=" serch_btn ssp ">
                <div class="col-xs-12 col-sm-6  col-md-6">
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 ssp">
                    <?php echo $this->Form->create('Faq', array('url' => array('controller' => 'freelancer', 'action' => 'dashboardHelp'))); ?>
                    <div class="input-group">
                        <input type="text" placeholder="Search for..." id="searchbar"class="form-control" name="data[Faq][search]">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default search_job">
                                Search
                            </button>
                        </span>
                    </div> 
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="bg_white marg_tb15">
                <div class="green">
                    Most frequent questions from user like you
                </div>
                <?php
                if (isset($faq_data) and !empty($faq_data)) {
                    foreach ($faq_data as $key=>$val) {
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-12  ">
                            <div class="help_quest">
                                <a href="<?php echo $this->webroot; ?>freelancer/view_help/<?php echo $val['Faq']['id']; ?>" style="text-decoration: none;"/> <h4><?php echo $val['Faq']['question']; ?></h4></a>
                                <p><?php echo $val['Faq']['keyword']; ?></p>
                            </div>
                        </div>
    <?php }
} else{?>
                <p style="color:#c7c4c8;; text-align: center;  margin-top: 30px; margin-bottom: 0px; font-size:20px;"> <strong>Sorry,No Record(s) Found ! </strong> 
                    </p> 
<?php  } ?>
                <div class="col-md-12 pgentn">
                    <nav>
                        <ul class="pagination pull-right">
                            <li><?php echo $this->Paginator->prev('<<Previous', null, null, array('class' => 'disabled')); ?></li>
                            <?php
                            echo $this->Paginator->numbers(array(
                                'before' => '',
                                'after' => '',
                                'separator' => '',
                                'tag' => 'li',
                                'spanClass' => 'sr-only',
                                'currentClass' => 'active',
                                'currentTag' => 'a',
                            ));
                            ?> 
                            <li><?php echo $this->Paginator->next('Next>>', null, null, array('class' => 'disabled')); ?></a></li>
                        </ul>    
                    </nav>
                </div> <div class="clearfix"></div>
            </div>
            <div class="bg_white marg_tb15 b_quest">
                <div class="green">
                    Browse questions by category
                </div>
                <?php
                if (isset($Help_title) and !empty($Help_title)) {
                    foreach ($Help_title  as $key => $value) {
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-12  ">
                            <div class="brws_quest">
                                <h3> <a href="<?php echo $this->webroot; ?>freelancer/singleHelpTopic/<?php echo $value['Help']['id'] ?>" style="text-decoration: none"/><?php echo $value['Help']['title']; ?></a> </h3>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p style="color: red; text-align: center;  margin-top: 33px; margin-bottom: 33px;"> <strong>Sorry, &nbsp;</strong> No Help Content(s) Found!
                    </p> 
                    <div class="clearfix"></div>
<?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.search_job', function() {
            var search = $('#searchbar').val();
            if (search == '') {
                alert('Please enter search keyword !');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });
    });
</script>


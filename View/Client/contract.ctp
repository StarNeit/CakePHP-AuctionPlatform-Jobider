<style>
    .form-control.slect {
        width: 54%;
    }
    .form-control.slected {
        width: 54%;
    }
</style>
<?php
$free_id=$this->params['pass'][0];
?>
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
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'contract') && $this->params['pass']['0'] == $free_id) {
    $searchfreelancer = 'active';
} else {
    $searchfreelancer = '';
}
?> 
<?php  if(!empty($users)){?>
<div class="container">
    <!--    <hr class="brder_btm">-->
    <div class="row">
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
          <?php echo $this->element('client_notification'); ?>
            </div>            
            <div class="col-md-9 col-sm-9  pad_r0 ">
         <div class="row marg_btm30">               
        <!--steps start -->
        <div class="col-md-12 list_1">
          <div class="blue_line_bg">
            <div class="col-xs-4 text-center block1 pdng"> 
                <?php 
                if($this->params['controller']=='client' and $this->params['action']=='contract') {?>
                <span class="  bg_grey_1"><font color="#817D7C">1</font></span> <br>
                <?php } else{?>
                 <span class="bg_blue_1">1</span> <br>
                 <?php } ?>
              <br>
              <label class="font_size16">Contract</label>
            </div>
            <div style="text-align:center;" class="col-xs-4 text-center block1 pdng"> 
                 <?php if($this->params['controller']=='client' and $this->params['action']=='review_hire') {?>
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

                <?php if (isset($error)) {
                    ?>
                    <div class="alert alert-danger ">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                            X</button>
                        <h4>
                            <i class="icon-ok-sign"></i>

                        </h4>
                        <?php foreach ($error as $k => $v) { ?>
                            <p><?php echo $v; ?></p>
                        <?php } ?>
                    </div>

                <?php }
                ?>
                <div class="bg_white selectco">
                    <div class="green"> Contract Details <span class="pull-right"></span></div>

                    <div class="col-md-12 col-sm-8 marg_btm30" style="padding-left: 0px; padding-right: 0px;">


                        <div class="clearfix"></div>

                        <!--white_bg start --> 
                        <div class="bg_white freelaners marg_btm30">
                           <div class="col-md-2 col-sm-2 marg_tb15 col-xs-4">
                                <?php if (!empty($users['User']['image'])) { ?>
                                    <img class="img-thumbnail" alt="login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $users['User']['image']; ?>" height="100" width="100">
                                <?php } else { ?>
                                    <img class="img-thumbnail" alt="Dummy user" src="<?php echo $this->webroot; ?>img/user_1.png"/>
                                <?php } ?>
                            </div>

                            <div class="col-md-10 col-xs-8">
                                <h5> <?php echo $users['User']['first_name'] . '  ' . $users['User']['last_name']; ?>. </h5>
                                <?php if (!empty($subskill)) { ?>
                                    <p> <?php echo $users['User']['job_title']; ?> (<?php echo substr($subskill, 0, strpos($subskill, ',', 20)); ?>) </p>
                                <?php }?>
                            </div>
                            <div class="clearfix"> </div>
                            <?php echo $this->Form->create('Contect', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'url' => array('controller' => 'client', 'action' => 'contract', $users['User']['id']), 'role' => 'form')); ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Time period </label>
                                      <?php if(!empty($jobs)){?> 
                                        <select class="form-control slected " name="data[Contect][time_duration]">
                                        <?php if(!empty($jobs['Job']['duration'])){ ?>
                                            <?php } else { ?>
                                            <option value="<?php echo $jobs['Job']['duration']; ?>" selected="selected"><?php echo $jobs['Job']['duration']; ?></option>
                                            <?php } ?>
                                        <option value="1 to 3 months">1 to 3 months</option>
                                        <option value="3 to 6 months">3 to 6 months</option>
                                        <option value="less than 1 week">less than 1 week</option>
                                        <option value="less than 1 month">less than 1 month</option>
                                        <option value="more than 6 months">more than 6 months</option>

                                   

                                    </select>
                                      <?php }  else {?>
                                    <select class="form-control slected " name="data[Contect][time_duration]">
                                        <option value="">Please Select</option>
                                        <option value="1 to 3 months">1 to 3 months</option>
                                        <option value="3 to 6 months">3 to 6 months</option>
                                        <option value="less than 1 week">less than 1 week</option>
                                        <option value="less than 1 month">less than 1 month</option>
                                        <option value="more than 6 months">more than 6 months</option>

                                   

                                    </select>
                                      <?php } ?>
                                
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label> choose a job </label> <br>
                                    <div class="row">	
                                        <div class="col-md-3">
                                            <input type="radio" value="existjob" name="data[Contect][jobs]" checked="" id="ContectJobsExistjob" required="false"/>Choose a existing job
                                            <?php //echo $this->Form->input('jobs', array('class' => 'radio', 'type' => 'radio', 'label' => false, 'options' => array('existjob' => 'Choose a existing job'), 'checked' => 'checked','legend'=>false)); ?>
                                        </div>
                                        <div class="col-md-12" id="selctdata">
                                            <input type='hidden' id='userid' value='<?php echo $users['User']['id']; ?>' class=''>
                                            <?php if(!empty($job_data)){ ?>
                                          <?php  if(!empty($jobs)){?>
                                            <?php  //pr($jobs);?>
                                              <select class="form-control slect" name="data[Contect][job_id]">
   <?php  foreach($job_data  as $val){?>
                                                    <?php if($val['Job']['id']==$jobs['Job']['id']){ ?> 
<option value='<?php echo $jobs['Job']['id'] ; ?>' selected="selected"><?php echo $jobs['Job']['job_title']; ?></option> 
                                                    <?php }  else {?>
                                                          <option value='<?php echo $val['Job']['id'] ; ?>'><?php echo $val['Job']['job_title']; ?></option> 
                                                    <?php } ?>
                                                        <?php } ?>
                                                </select>
                                          <?php } else { ?>
                                            
                                                <select class="form-control slect" name="data[Contect][job_id]">
                                                    <option value="">Select The Existing Job</option>
                                                    
                                                    <?php foreach($job_data as $val){?>
                                                        <option value='<?php echo $val['Job']['id']; ?>'><?php echo $val['Job']['job_title']; ?></option>
                                          <?php }?>
                                                </select>
                                          
                                            
                                          <?php } ?>
                                            <?php } else { ?>
                                            <p>Sorry, You Have No Ope Jobs, Please Post A New Job</p>
                                            <?php } ?>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="radio" value="postjob" name="data[Contect][jobs]"  id="ContectJobsPostjob"/>Create a new job
                                            <?php //echo $this->Form->input('jobs', array('class' => 'radio', 'type' => 'radio', 'label' => false, 'options' => array('postjob' => 'Create a new job'),'legend'=>false)); ?>

                                        </div> </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12" id="jobdes">
                                <div class="form-group">
                                  
                                        <label> Job Description  </label>
            <input type='hidden' name='data[Contect][job_description]'value='' id='desrcip'>
                            <p id='desc'></p>
                                   
                      <!--							<textarea class="form-control" rows="3"></textarea>-->
                                </div>
                            </div>
                            <div class="col-md-12 marg_tb50 text-center invite " id="sub">
                                <button class="btn-lg btn-green col-md-2 col-sm-6 col-xs-12 pull-left  invitation"  type="submit" name="send" value="send"> Submit</button>
                                <a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'freelancer_profile', $users['User']['id'])); ?>">
                                    <button class="btn-lg btn-green col-md-2 col-sm-6 col-md-offset-1 col-xs-12" type="button" > Cancel </button></a>
                            </div>

                            <div id="datadiv" class="data hide">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label> Type of work </label>
                                        <?php echo $this->Form->input('category_id', array('class' => 'form-control category', 'type' => 'select', 'label' => false, 'options' => array('' => 'Please Select.....', $category), 'required' => false)); ?>
                                    </div> </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label style="color:#fff;"> f </label>
                                        <?php echo $this->Form->input('subcategory_id', array('class' => 'form-control subcategory', 'type' => 'select', 'label' => false, 'options' => array('' => 'Please Select.....'), 'disabled' => 'disabled', 'required' => false)); ?>
                                    </div> </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> Give your job a title </label>
                                        <div class="input-group datepicker">
                                            <?php echo $this->Form->input('job_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'required' => false)); ?>
            <!--						<input type="text" class="form-control" id="exampleInputEmail1">-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> Job description </label>
                                        <?php echo $this->Form->input('description', array('class' => 'form-control', 'type' => 'textarea', 'rows' => '3', 'label' => false, 'required' => false)); ?>
            <!--					<textarea class="form-control" rows="3"></textarea>-->
                                    </div>
                                </div>
                      
                             
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label> Budget </label>
                                            <?php echo $this->Form->input('budget', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => '$', 'required' => false)); ?>
                                        </div>
                                    </div>   
                                    <div class="col-md-7 col-sm-6">
                                        <div class="form-group">
                                            <label>Planned Start date </label>
                                            <div class="input-group datepicker">
                                                <?php echo $this->Form->input('start_date', array('class' => 'col-md-11', 'type' => 'text', 'id' => 'datepicker1', 'label' => false, 'required' => false)); ?>
                                           <!--       <input type="text" id="datepicker1" class="col-md-11">-->
                                            </div>
                                        </div>
                                    </div>
                          
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Estimated Duration </label>
                                        <?php echo $this->Form->input('duration', array('class' => 'form-control', 'type' => 'select', 'label' => false, 'options' => array('' => 'Please Select.....', 'more than 6 months' => 'more than 6 months', '3 to 6 months' => '3 to 6 months', '1 to 3 minths' => '1 to 3 months', 'less than 1 month' => 'less than 1 month', 'less than 1 week' => 'less than 1 week'), 'required' => false)); ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> Estimated Workload </label>
                                        <?php echo $this->Form->input('job_work', array('class' => 'form-control', 'type' => 'select', 'label' => false, 'options' => array('' => 'Please Select ......', 'Full Time' => 'Full Time', 'Part Time' => 'Part Time', 'As Needed' => 'As Needed'), 'required' => false)); ?>

                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label> Make job public?</label>
                                        <div class="checkbox">
                                            <input type="checkbox" checked=''> <span> Make this job public so that the other freelancers can find it and apply. </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 marg_tb50 text-center  hide " id="subm">
                                <button class="btn-lg btn-green col-md-2 col-sm-6 col-xs-12 pull-left "  type="submit" name="post" value="post"> Post  </button>
                                <a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'freelancer_profile', $users['User']['id'])); ?>"><button class="btn-lg btn-green col-md-2 col-sm-6 col-md-offset-1 col-xs-12" type="button" > Cancel </button></a>
                            </div>

                            <!--                <div class="col-md-12">  
                                                <div class="freelancer">
                                                    <p> Already know this freelancer ? <a href="#"> Hire Now </a> </p>
                                                </div> 
                                            </div>   -->
                            <div class="clearfix"></div>
                        </div> <?php echo $this->Form->end(); ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--white_bg closed --> 
    </div>
</div>
<?php } else { ?>
<div class="container">
    <hr class="brder_btm">
    <div class="row">
      
    <div class="bg_white freelaners marg_btm30">
                        <div class="green">
                            Contract Detail
                        </div>
                        <div style="text-align:center; color:#C7C4C8; padding: 25px; font-size: 20px;" class="col-md-12 colsm-12 marg_tb15"><span> <strong> No Contract Found for this team </strong> </span></div>
                        <div class="clearfix"></div>
                        <hr class="brder_btm1 marg_0">
                        <div class="tabs_1 col-md-12 marg_t5">
                        </div>
                    </div>
    </div>
</div>
<?php } ?>

<script>
    $(document).ready(function() {
        $('#ContectJobsExistjob').click(function() {
            //alert('djhfjdh');
            chkPanelChanged();

        });
        $('#ContectJobsPostjob').click(function() {
            chkPanelChanged();
        });
        function chkPanelChanged() {
            if ($('#ContectJobsExistjob').is(':checked')) {
                //	alert('hfdjhf');
                $('#selctdata').removeClass('hide');
                $('#jobdes').removeClass('hide');
                $('#sub').removeClass('hide');
                $('#datadiv').addClass('hide');
                $('#subm').addClass('hide');
            }
            if ($('#ContectJobsPostjob').is(':checked')) {
                $('#datadiv').removeClass('hide');
                $('#subm').removeClass('hide');
                $('#selctdata').addClass('hide');
                $('#jobdes').addClass('hide');
                $('#sub').addClass('hide');
            }
        }
        $('#ContectJobTypeHourly').click(function() {
            chkPanelChange();
        });
        $('#ContectJobTypeFixedPrice').click(function() {
            chkPanelChange();
        });
        function  chkPanelChange() {
            if ($('#ContectJobTypeHourly').is(':checked')) {
                $('#datedata').addClass('hide');
            }
            if ($('#ContectJobTypeFixedPrice').is(':checked')) {
                $('#datedata').removeClass('hide');
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', '.category', function() {
            var category = $('.category').val();
            if (category != '') {
                $('.subcategory').removeAttr('disabled', 'disabled');
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '<?php echo $this->base; ?>/client/ajax_data',
                    data: {category: category},
                    success: function(msg) {
                        if (msg.suc == 'yes') {
                            $('.subcategory').html(msg.subcategory_data);
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
         var job_id = $('.slect').val();
            var user_id = $('#userid').val();
            //alert(job_id);
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->base; ?>/client/ajax_contect',
                data: {job_id: job_id, user_id: user_id},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('.invite').html(msg.test);
                        $('#desc').html(msg.desc);
                         $('#desrcip').val(msg.desc);
                    }
                    if (msg.suc == 'no') {
                        $('.invite').html(msg.tested);
                        $('#desc').html(msg.desc);
                         $('#desrcip').val(msg.desc);
                    }
                }
            });
        $('.slect').on('change', function() {
            var job_id = $('.slect').val();
            //alert(job_id);
            var user_id = $('#userid').val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->base; ?>/client/ajax_contect',
                data: {job_id: job_id, user_id: user_id},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('.invite').html(msg.test);
                        $('#desc').html(msg.desc);
                         $('#desrcip').val(msg.desc);
                    }
                    if (msg.suc == 'no') {
                        $('.invite').html(msg.tested);
                        $('#desc').html(msg.desc);
                         $('#desrcip').val(msg.desc);
                    }
                }
            });
        });
    });
</script>
<?php echo $this->Html->script('jquery-ui'); ?>

<script>
    $(function() {
        $("#datepicker1").datepicker({
            showOn: "button",
            buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
    });
</script> 


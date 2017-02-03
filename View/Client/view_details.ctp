<?php if (isset($contect) and !empty($contect)) { ?>
    <div class="container">
        <div class="row marg_tb15">
            <div class="col-md-3 pad_l0 col-sm-3">
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body bg_grey1 padd_0">
                        <ul class="nav ">
                            <?php if (isset($total_applicants) and !empty($total_applicants)) { ?> <li  class="active"><a href="<?php echo $this->webroot; ?>client/view_details/<?php echo $Job_id; ?>"> <i> <img src="<?php echo $this->webroot; ?>img/user1.png" alt="user1"/> </i>Applicant<?php echo '  (' . $total_applicants . ')' ?></a></li>
                            <?php } else { ?>
                                <li><a href="#"> <i> <img src="<?php echo $this->webroot; ?>img/user1.png" alt="user1" /> </i>Applicant</a></li>
                            <?php } ?>
                            <li><a href="JavaScript:void(0);" class="msgs"  id="<?php echo $Job_id; ?>" name="msg"> <i> <img src="<?php echo $this->webroot; ?>img/message.png" alt="message" /> </i>Message</a></li>
                            <li><a href="JavaScript:void(0);" class="hired" name="hire"> <i> <img src="<?php echo $this->webroot; ?>img/hidden.png" alt="hidden" /> </i>Hired</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9  pad_r0 " id="ContentRep">
                <div class="bg_white marg_btm30">
                    <div class="green">
                        <?php
                        if (!empty($free_id)) {
//                            pr($free_id);die('djghjasd');
                            foreach ($free_id as $key => $value) {
                                if (array_key_exists('Acceptinterview', $value)) {
                                    $user_ids = $value['Acceptinterview']['freelancer_id'];
                                    
                                }
                                  if (array_key_exists('Jobdetail', $value)) {
                                    $user_ids = $value['Jobdetail']['freelancer_id'];
                                            
                                }
                            }

                        }
                        ?>
                        <input type="hidden" value="<?php echo $user_ids; ?>" class="hidden_id_freelancer" />

                        <?php if (!empty($total_applicants)) { ?>
                            <span class="pull-right">Total Applicants : <?php echo $total_applicants; ?> </span>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table cust_table11 table-striped">
                            <thead>
                                <tr>
                                    <th>Freelancer   </th>
                                    <th> Profile Title  </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contect as $kk => $vv) { ?>
                                    <tr> 
                                        <td>
                                            <div class="active col-md-5 pad_l0">
                                                <div class="user_imgbox">
                                                    <?php if(!empty($vv['User']['image'])){ ?>
                                                    <img height="75" width="80" alt="login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $vv['User']['image']; ?>" class='img-thumbnail'/>
                                                    <?php } else { ?>
                                                         <img height="75" width="80" alt="dummy user" src="<?php echo $this->webroot; ?>img/freelancer.png" class='img-thumbnail'/>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-7 pad_l0">
                                                <input type="hidden" name="user_id" value="<?php echo $vv['User'] ['id']; ?>" class="users_id">
                                                <h4 class="marg_0 "><?php echo ucfirst($vv['User']['first_name']) . ' ' . ucfirst($vv['User']['last_name']); ?></h4>
                                                <?php if(!empty($vv['country'])){?>
                                                <small class="text-danger"><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location image">  <?php echo $vv['country']; ?></small></br>
                                                <?php }?>
                                           <?php echo ucfirst($vv['User']['crnt_status']); ?>
                                                <!--Invited-->
                                            </div>
                                        </td>
                                        <?php foreach ($vv['job'] as $k => $v) { ?>
                                            <td><?php echo $v['Job']['job_title']; ?></td>
                                        <?php } ?>
                                        <td class="text-center">
                                             <input type="hidden" value="<?php echo $v['Job']['id']; ?>" class="jobs"/>
                            <input type="hidden" value="<?php echo $vv['User']['id']; ?>" class="users"/>
                                            <button class="btn-sm btn-danger btn_red11 contct_data ">View Detail</button>                                          <br>
                                            <input type='hidden' value='<?php echo $v['Job']['id']; ?>'  class='jobdata' name="data[User]['job_id]">
                                            <a class="font_14 btn_data" href="#" data-toggle="modal" data-target="#myModal" id="<?php echo $vv['User']['id']; ?>"/>Send Message</a></td>
                                    </tr>
                                <?php } ?>      

                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="row marg_tb15">
            <div class="col-md-3 pad_l0 col-sm-3">
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body bg_grey1 padd_0">
                        <ul class="nav ">
                            <li><a href="<?php echo $this->webroot; ?>client/view_details/<?php echo $Job_id; ?>"> <i> <img src="<?php echo $this->webroot; ?>img/user1.png" alt="User1" /> </i>Applicant (0)</a></li>
                            <li><a href="<?php echo $this->webroot; ?>client/view_details/<?php echo $Job_id; ?>"> <i> <img src="<?php echo $this->webroot; ?>img/message.png" alt="message" /> </i>Message (0)</a></li>
                            <li><a href="<?php echo $this->webroot; ?>client/view_details/<?php echo $Job_id; ?>"> <i> <img src="<?php echo $this->webroot; ?>img/hidden.png" alt="hiden" /> </i>Hired (0)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9  pad_r0 ">
                <div class="bg_white marg_btm30">
                    <div class="green">
                       <span class="pull-right">Total Applicants : 0 </span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="detail padd_tb15"> 
                        <div class="col-md-2 col-xs-3">
                            <div class="right_side view_img">
                                <p> <img src="<?php echo $this->webroot; ?>img/freelancer.png" class="img-responsive " alt="freelancer image" /></p>
                            </div>
                        </div>
                        <div class="col-md-10 col-xs-9">
                            <h3 class="empty"> Your applicant list is empty </h3>
                            <p class="text_1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
                        </div>
                        <div class="col-md-12  marg_tb30">
                 
                            <p class="text-center"><a href="<?php echo $this->webroot; ?>client/searchfreelancer/<?php echo $Job_id; ?>"> <button class="btn-green free_data" type="button"> View Recommended Freelancers </button></a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div> 

        </div>
    </div>
<?php } ?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<script>

    $(document).ready(function() {
        $(document).on('click', '.btn_data', function() {
            var user_id = $(this).attr('id');
            var job_id = $(this).prev().val();
         
            $.ajax({
                type: 'post',
                url: '<?php echo $this->webroot; ?>client/ajax_model',
                data: {user_id: user_id, job_id: job_id},
                success: function(response) {
                    $('#myModal').html(response);
                }
            });
        });
    });
  $(document).ready(function(){
  $(document).on('click','.jobid',function(){
       var job_id = $('.jobdata').attr('id');
    
  });
  });

    $(document).ready(function() {
        $(document).on('click', '.msgs', function() {
            var user_id = $('.hidden_id_freelancer').val();
          
            var job_id = $('.msgs').attr('id');
            var name = $(this).attr('name');
            if (name == 'msg') {
                $('ul li.active').removeClass('active');
                $(this).closest('li').addClass('active');
            }
            $.ajax({
                type: 'post',
                url: '<?php echo $this->webroot; ?>client/messageData',
                data: {job_id: job_id, user_id: user_id},
                success: function(msg) {
                    $('#ContentRep').html(msg);
                }
            });
        });
    });
    $(document).ready(function() {
        $(document).on('click', '.hired', function() {
            var user_id = $('.hidden_id_freelancer').val();
              //alert(user_id);
            var name = $(this).attr('name');
            if (name == 'hire') {
                $('ul li.active').removeClass('active');
                $(this).closest('li').addClass('active');
            }
            $.ajax({
                type: 'post',
                url: '<?php echo $this->webroot; ?>client/hireData',
                data: {user_id: user_id},
                success: function(msg) {
                    $('#ContentRep').html(msg);
                }
            });
        });
    });
    $(document).ready(function(){
     $('.contct_data').click(function(){
        var user_id=$(this).prev().val();
        var job_id=$(this).prev().prev().val();
        $.ajax({
            type:'post',
            dataType:'json',
            url:'<?php  echo $this->webroot;?>client/aplicant_data',
            data:{job_id:job_id,user_id:user_id},
            success:function(msg){
                if(msg.suc=='yes'){
                    window.location='<?php  echo $this->webroot;?>client/job_application/'+msg.free_id;
                }
            }
        });
     });
    });
    
    
    
</script>
<div class="container">
    <div class="col-md-3 pad_l0 col-sm-3">
        <div class="panel panel-default green_bg1" style="margin-top: 26px;">
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

    <div class="col-md-9 ">
        <div class="row">

            <div class="col-md-6 col-sm-4 col-xs-12 ">
                <div class="job_post">
                    <h1>Open jobs</h1>
                </div>
            </div>

            <div class="col-md-6 col-sm-4 col-xs-12 ">
                <div class="job_post_right">
                    <a href="<?php echo $this->webroot; ?>client/postajob" class="btn btn-primary" role="button">Post Jobs</a>

                </div>

            </div>

            <div class="col-md-12 col-sm-8 col-xs-12 ">
                <div class="need">
                    <div class="result_right">
                        <div class="table-responsive1">
                            <table class="table cust_table11 ">
                                <thead>
                                    <tr>
                                        <th>Jobs</th>
                                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
//                                    pr($appliedJobs);
//                                    die('sadjasjd');   
                                    if (isset($appliedJobs) and ! empty($appliedJobs)) {
                                        foreach ($appliedJobs as $k => $v) {
                                            $id = $v['Job']['id'];
                                            ?>
                                            <tr>
                                                <td class="post"><a href="<?php echo $this->webroot; ?>client/view_details/<?php echo $id; ?>" style="color: rgb(138, 137, 137); text-decoration: none;"><h4><?php echo $v['Job']['job_title']; ?></h4></a>
                                                </td>
                                                <?php if ($v['Job']['applicants'] == 0) { ?>
                                                    <td>-<br>APPLICANTS</td>
                                                <?php } else { ?>
                                                    <td><?php echo $v['Job']['applicants']; ?><br>APPLICANTS</td>
                                                <?php } ?>
                                                <?php if ($v['Job']['messaged'] == 0) { ?>
                                                    <td>-<br>message</td> 
                                                <?php } else { ?>
                                                    <td><?php echo $v['Job']['messaged']; ?><br>message</td> 
                                                <?php } ?>
                                                <?php if ($v['Job']['hire_user'] == 0) { ?>
                                                    <td>-<br>Offers/Hires</td>
                                                <?php } else { ?>
                                                    <td><?php echo $v['Job']['hire_user'] ?><br>Offers/Hires</td>
                                                <?php } ?>
                                                <td><div class="dropdown">
                                                        <button aria-expanded="true" data-toggle="dropdown" id="dropdownMenu1" type="button" class="btn btn-default dropdown-toggle">Actions<span class="caret"></span></button>
                                                        <ul aria-labelledby="dropdownMenu1" role="menu" class="dropdown-menu">
                                                            <li role="presentation"><a href="<?php echo $this->webroot; ?>client/view_details/<?php echo $id; ?>" tabindex="-1" role="menuitem">View Applicants</a>
                                                            </li>
                                                            <li role="presentation"><a href="<?php echo $this->webroot; ?>client/viewpost/<?php echo $id; ?>" tabindex="-1" role="menuitem">View Job Posting</a></li>
                                                            <li role="presentation"><a href="<?php echo $this->webroot; ?>client/editjob/<?php echo $id; ?>" tabindex="-1" role="menuitem">Edit Posting</a></li>
                                                            <li role="presentation"><a href="<?php echo $this->webroot; ?>client/deletejob/<?php echo $id; ?>" tabindex="-1" role="menuitem" onclick='javascript:return confirm("Are you Sure you want to  close this Job ?");'>Remove Posting</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td><p  style="text-align: center; margin-left: 151px; font-size: 20px;">You currently have no job postings </p></td>
                                        </tr>                    
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 ">
            <div class="col-md-12 ">
                <div class="contracts"><h3>Contracts</h3></div>
                <div class="contracts_main">
                    <?php
                    if (isset($Hired_freelancer) and ! empty($Hired_freelancer)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table cust_table11">
                                <thead>
                                    <tr>
                                        <th>Freelancer </th>
                                        <th> Job(s) </th>
                                        <th> Time Period </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Hired_freelancer as $kk => $vals) { ?>
                                        <tr>
                                             <td >
                      <input type="hidden" value="<?php  echo $vals['Hire']['contractor_id'];?>">
                      <input type="hidden" value="<?php  echo $vals['Job']['id'];?>">
                      <a href="JavaScript:void(0);" style="text-decoration: none; color: rgb(138, 137, 137);" id="" class="cont_data"><?php echo $vals['Hire']['contractor_name']; ?></a></td>
                                            <td><?php echo $vals['Hire']['job_title']; ?></td>
                                            <td><?php echo $vals['Hire']['duration']; ?></td>

                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    <?php } else {
                        ?>
                        
                    <p style="font-size:20px;">You have no hired freelancers in the team.</p>
                    <?php } ?>
                </div>

            </div>
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
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 ">

                <div class="my_job_slider">

                    <div class="slider2">
                        <?php
                        if (isset($Category_data) and ! empty($Category_data)) {
                            foreach ($Category_data as $key => $value) {
                                ?> 
                                <div class="slid">
                                    <div class="slide"><img src="<?php echo $this->webroot; ?>uploads/<?php echo $value['Category']['image']; ?>" class="img-responsive" alt="image" /><h3><?php echo $value['Category']['name']; ?></h3> <h4><?php echo $value['jobs']; ?> Jobs Posted</h4><p><?php echo $value['time_duration']; ?></p></div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>   
                </div>

            </div>
        </div>
    </div> <!--col-md-12-->


</div>



<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script src="<?php echo $this->webroot; ?>js/jquery.bxslider.js"></script>

<script>
                                                        $(document).ready(function () {
                                                            $('.slider2').bxSlider({
                                                                slideWidth: 300,
                                                                minSlides: 1,
                                                                maxSlides: 5,
                                                                slideMargin: 10,
                                                                moveSlides: 1
                                                            });
                                                            
                                                              $('.cont_data').click(function(){
     var job_id=$(this).prev().val();
     var user_id=$(this).prev().prev().val();
     $.ajax({
        type:'post',
        dataType:'json',
        url:'<?php echo $this->webroot;?>client/ajax_datas',
        data:{job_id:job_id,user_id:user_id},
        success:function(msg){
            if(msg.suc=='yes'){
                window.location='<?php echo $this->webroot;?>client/contracts/'+msg.job_id;
            }
        }
     });
  });
                                                        });
</script>



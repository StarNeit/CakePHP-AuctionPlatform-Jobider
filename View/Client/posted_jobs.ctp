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
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'postedJobs')) {
    $posted = 'active';
} else {
    $posted = '';
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
       <?php echo $this->element('client_notification'); ?>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <?php echo $this->Session->flash(); ?>
                <div class="green">
                    Jobs which i have posted  <span class="pull-right"><a href="<?php echo $this->webroot; ?>client/postajob"><button type="button" class="btn btn-sm  btn_red btn_red12 pull-right mar10" style='margin-top: -6px;'>Post a job</button></a></span><div class="clearfix"></div>
                </div>
                <?php if(isset($postedJobs) and !empty($postedJobs)){ foreach ($postedJobs as $key => $value) { ?> 
                    <div class="detail  brder_btm padd_tb15">
                        <div class="col-md-3 col-sm-2 pad_l2"> 
                            <div class="user_content pull-left">
                                <h4 class="marg_0 text-danger"><a href="<?php echo $this->webroot; ?>client/Postinfo/<?php echo $value['Job']['id']; ?>" style="color:#C7C4C8; text-decoration: none"><?php echo $value['Job']['job_title']; ?></a></h4> <small class="text_1"><?php echo $value['Job']['time_duration']; ?></small>
                                <br> 
                                <a href="<?php echo $this->webroot; ?>client/viewpost/<?php echo $value['Job']['id']; ?>" style="text-decoration:none"><span> view job</span></a> &nbsp <a href="<?php echo $this->webroot; ?>client/editjob/<?php echo $value['Job']['id']; ?>" style="text-decoration:none"><span> edit job</span></a>&nbsp; <a href="<?php echo $this->webroot; ?>client/deletejob/<?php echo $value['Job']['id']; ?>" style="text-decoration:none" onclick='javascript:return confirm("Are you Sure to delete this Job ?");'><span> delete </span></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-8 col-sm-8 lesval"> 
                            <p class="text_1"><?php echo substr($value['Job']['description'], 0, 200) . '....'; ?>        <a href="JavaScript:void(0);" class="more" style="text-decoration:none">more</a>
                            </p> 
                        </div>   
                        <div class="col-md-8 col-sm-8  moreval hide">
                            <p class="text_1"><?php echo $value['Job']['description']; ?>        <a href="JavaScript:void(0);" class="less" style="text-decoration:none" >less</a>
                            </p> 
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                <?php } }else{?>
              <div class="detail  brder_btm padd_tb15">
                  
                  <p class="posted_job"> You have no any Posted job(s).</p>
                        <div class="col-md-3 col-sm-2 pad_l2"> 
                            
                        </div>
                        <div class="col-md-8 col-sm-8 lesval"> 
                             
                        </div>   
                        <div class="col-md-8 col-sm-8  moreval hide">
                                                   </div>
                        <div class="clearfix"> </div>
                    </div>  
                <?php } ?>
                <div class="clearfix"></div>
            </div>
                <ul class="pagination pull-right">
            <li><?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?></li>
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
            <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></a></li>
        </ul>
        </div>
    
        
        
    </div>


</div>


<style>
    .current{
        
        background: none repeat scroll 0 0 #DA423D !important;
        float: left;
        height: 34px !important;
        margin-top: 2px;
        width: 36px;
        padding-top: 6px;
        padding-left: 12px;
        color: white;
    }
    .next{
        color:white !important;
    }
    .prev{
        color:white !important;
    }

    .input-group-addon.grrenbtn {
        background: #1fb5ad;
        color: #fff;
        font-size: 14px;
    }


</style>

<style>
    
    
    .posted_job {
    color: #c7c4c8;
    font-size: 20px;
    margin: 0;
    text-align: center;
}
</style>


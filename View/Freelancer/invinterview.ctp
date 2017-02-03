<?php
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'myapplication') {
    $myapplication = 'active';
} else {
    $myapplication = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'archapplication') {
    $archapplication = 'active';
} else {
    $archapplication = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'sentapplication') {
    $sentapplication = 'active';
} else {
    $sentapplication = '';
}
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'invinterview') {
    $interview = 'active';
} else {
    $interview = '';
}
?>


<div class="container">

    <div class="row marg_tb15">

        <div class="col-md-3 pad_l0 col-sm-3">

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">My applications </div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">

                        <li class="<?php echo $myapplication; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'myapplication')); ?>">Active application</a></li>
                        <li class="<?php echo $archapplication; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'archapplication')); ?>">Archived applications</a></li>
                        <li class="<?php echo $sentapplication; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'sentapplication')); ?>">Sent applications</a></li>
                        <li class="<?php echo $interview; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'invinterview')); ?>">Invitations to interviews</a></li>

                    </ul>
                </div>
            </div>

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now : <?php  if(!empty($Payment_earning)){ echo '$'.$Payment_earning.'.00';}else{ echo '$0.00';} ?> </p>
<!--                    <p class="text-center">
                        <?php //echo $this->Form->create('Job', array('url' => array('controller' => 'freelancer', 'action' => 'withdraw'))); ?>      
                        <button type="submit" class="btn btn-danger">Withdraw</button>
                        <?php //echo $this->Form->end(); ?> 
                    </p>-->
                    <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="view icon image"/></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning" style="text-decoration:none;">View pending earnings &gt;&gt;</a></p>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <?php echo $this->Session->flash(); ?> 
            <div class="bg_white">
                <div class="green">
                    Invitations to interviews 
                </div>

                <div class="table-responsive">
                    <?php if (isset($Job) and !empty($Job)) { ?>
                        <table class="table cust_table11 table-striped">
                            <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Client</th>
                                    <th>Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Job as $kk => $vv) { ?>
                                    <tr>
                                        <td><a href="<?php echo $this->webroot; ?>freelancer/applicants/<?php echo $vv['Job']['id'] ?>"><?php echo $vv['Job']['job_title']; ?></a></td>
                                        <?php foreach ($vv['user'] as $k=>$v){ ?>
                                        <td><?php echo ucfirst($v['User']['first_name']).' '.  ucfirst($v['User']['last_name']);  ?></td>
                                        <?php } ?>
                                        <td><?php  echo $vv['Contect_created'] .'('.$vv['timeduration'].')' ;?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    <?php }else { ?>
                     <div class="table-responsive">
  <p class="act"> No Invitation(s) for Interview Found ! </p>
                                    </div>
                    <?php } ?>
                </div>

                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>


<style>  
    .act {
    color: #c7c4c8;
    font-size: 19px;
    padding: 38px;
    text-align: center;
}
</style>
<?php  
if($this->params['controller']=='client' &&  $this->params['action']=='SentMessageToApplicant'){
    $send ='active';
}else{
    $send = '';
}
?>
<div class="container">

    <div class="row marg_tb15">
        <!--panel col-md-3 start -->

        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li><a href="<?php echo $this->webroot; ?>client/manageMyTeam"> Freelancers i have hired </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/ActiveContract">  Active Contract </a></li>
                        <li class="<?php echo $send; ?>"><a href="<?php echo $this->webroot; ?>client/SentMessageToApplicant">  Sent Messages to applicants </a></li>                        <li ><a href="<?php echo $this->webroot; ?>client/view_ended_contract">  View Ended Contracts </a></li>
                    </ul>
                </div>
            </div>
        <?php echo $this->element('client_notification'); ?>
        </div>

        <!--panel col-md-3 closed -->  

        <!--col-md-9 bg_white start -->

        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green">
                    Sent Messages to applicants
                </div>
                <div class="clearfix"></div>
                <?php if (!empty($message) and isset($message)) { ?>
                    <div class="table-responsive">
                        <table class="table cust_table11 table-striped">
                            <thead>
                                <tr>
                                    <th colspan="4">Freelancer   </th>
                                    <th class="text-center"> Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($message as $k => $val) {
                                    ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class="active col-md-2 pad_l0">
                                                <div class="user_imgbox">
                                                    <img src="<?php echo $this->webroot; ?>uploads/<?php echo $val['User']['image'] ?>" alt="login user" width="100" height="100">
                                                </div>
                                            </div>
                                            <div class="col-md-7 pad_l">
                                                <h4 class="marg_0 "><?php echo ucfirst($val['User']['first_name']) . '  ' . ucfirst($val['User']['last_name']); ?></h4>
                                                <small class="text-danger"> <?php echo $val['User']['job_title']; ?> </small>
                                            </div>
                                        </td>
                                        <td class="text-center"> 
                                            <div class="btn-group ">
                                                <button data-placement="left" title="" data-original-title="Lorem Ipsum" data-container="body" data-content="Lorem Ipsum is simply dummy text of the printing and typesetting industry. " aria-expanded="false" data-toggle="dropdown" class="btn btn-default  btn_red11 dropdown-toggle popover-show" type="button">        Action <span class="caret"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li><a href="<?php echo $this->webroot; ?>client/freelancer_profile/<?php echo $val['User']['id']; ?>">View Profile</a></li>
                                                    <li class="divider"></li>
<!--                                                    <li><a href="<?php echo $this->webroot; ?>client">Apply To Invite</a></li>-->

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table cust_table11 table-striped">
                            <tbody>
                                <tr>
                   <p style="color: #C7C4C8;text-align: center;  font-size: 18px; padding: 30px;"> <strong>You have no sent messages.</strong></p>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--col-md-9 bg_white closed -->             
    </div>
</div>
<style>
    .msg {
        color: #dd5429;
        font-size: 20px;
        margin-right: -98px;
        text-align: center !important;
        padding:56px;
    }
</style> 
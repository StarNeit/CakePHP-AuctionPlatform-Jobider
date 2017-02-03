<?php  
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'view_ended_contract')) {
    $cont = 'active';
}
else 
{
    $cont = '';
}
if($this->params['controller']=='client' && $this->params['action']=='ActiveContract'){
    $act ='active';
}else{
    $act='';
}
if($this->params['controller']=='client' && $this->params['action']=='SentMessageToApplicant'){
    $sent = 'active';
}else{
    $sent = '';
}
?>
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="active"><a href="<?php  echo $this->webroot; ?>client/manageMyTeam"> Freelancers i have hired </a></li>
                        <li class="<?php echo $act;  ?>"><a href="<?php echo $this->webroot; ?>client/ActiveContract">  
                                Contracts
                            </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/SentMessageToApplicant">  Sent Messages to applicants  </a></li>
                             <li class="<?php echo $cont; ?>"><a href="<?php echo $this->webroot; ?>client/view_ended_contract"> View Ended Contracts </a></li>
                    </ul>
                </div>
            </div>
      <?php  echo $this->element('client_notification');?>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
<?php echo $this->Session->flash(); ?>
            <div class="bg_white">
                <div class="green">
                    Freelancers i have hired
                </div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>
                                <th>Freelancer</th>
                                <th>Contract</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Active</th>

                            </tr>
                        </thead>
                        <?php  if (!empty($freelancer)) {?>
                        <tbody>
                            <?php foreach($freelancer as $k=>$v){
                              ?>
                            <tr>
                                <td>

                                    <div class="active col-md-5 pad_l0">
                                        <div class="user_imgbox">
                                                      <?php  if(!empty($v['Hire']['contractor_image'])){?>
                                            <img src="<?php echo $this->webroot; ?>uploads/<?php echo $v['Hire']['contractor_image']; ?>" alt="image" width='64' height='87' class='img_thumbnail'>
                                                      <?php } else { ?>
                                                <img src="<?php echo $this->webroot; ?>img/freelancer.png?>" alt="Dummy user" width='64' height='87' class='img_thumbnail'>
                                                      <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-md-7 pad_l0">

                                        <h4 class="marg_0 "><?php echo ucwords($v['Hire']['contractor_name']);?></h4>
                                        <small class="text-danger"><img src="<?php  echo $this->webroot;?>img/location1.png" alt="image"/><?php echo '  '.$v['Hire']['c_name']['Country']['name']; ?></small>

                                    </div>
                                </td>
                                <td>
                                    <?php echo $v['Hire']['job_title']; ?>
                                </td>
                                <td> <?php echo $v['Hire']['payment_type']; ?>  </td>
                                <td> <?php echo $v['Hire']['hire_status']; ?>  </td>
                                <td> <div class="btn-group ">
                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default  btn_red11 dropdown-toggle" type="button">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="<?php echo $this->webroot; ?>client/freelancer_profile/<?php  echo $v['Hire']['contractor_id'];?>">View Profile</a></li>

                                        </ul>
                                    </div></td>

                            </tr>
                            <?php } ?>
                          

                        </tbody>
                        <?php } else { ?>
                          <tbody>
            
              <tr>
                <td class="text-center contract" colspan="5"> You have  no any hired freelancer </td>
              </tr>
              
           </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>



            <div class="clearfix"></div>


        </div>


    </div>

</div>

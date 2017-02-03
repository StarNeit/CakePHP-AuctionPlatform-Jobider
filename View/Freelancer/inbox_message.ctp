<?php
if ($this->params['controller'] == 'freelancer' && $this->params['action'] == 'inbox_message') {
    $inbox = 'active';
} else {
    $inbox = '';
}
?>
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">My Messages</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="<?php echo $inbox; ?>"><a href="<?php echo $this->webroot; ?>freelancer/inbox_message"> Inbox</a></li>
                        <li><a href="<?php echo $this->webroot; ?>freelancer/sent_message"> Sent </a></li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now : $370.00 </p>
                    <p class="text-center">
                        <?php echo $this->Form->create('Job', array('url' => array('controller' => 'freelancer', 'action' => 'withdraw'))); ?> 
                        <button type="submit" class="btn btn-danger">Withdraw</button>
                        <?php echo $this->Form->end(); ?>
                    </p>

                    <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="View pending earning image"/></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings >></a></p>

                    </ul>
                </div>
            </div>



        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">

            <div class="bg_white">

                <div class="green">

                    Inbox Messages <span class="pull-right"><a href="#"></a></span>

                </div>
                <?php
                if (isset($message) and !empty($message)) {
                    foreach ($message as $key=>$val) {
//                        pr($val);
//                        die('dkjhfkdshk');
                        ?>

                        <div class="detail  brder_btm padd_tb15">

                            <div class="col-md-2 col-sm-2">

                                <div class="user_imgbox">
                                    
                                        <img src="<?php echo $this->webroot; ?>uploads/<?php echo $val['Message']['user']['User']['image']; ?>" alt="login user image" width="100" height="100">
        
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 pad_l0"> 
                                <div class="user_content pull-left">
                                    <h4 class="marg_0 text-danger"><?php echo $val['Message']['user']['User']['first_name'].'  '.$val['Message']['user']['User']['last_name']; ?></h4>
                                    <small class="text_1"><?php echo $date = date('F d,Y', strtotime($val['Message']['created'])); ?></small>
                                </div>
                            </div>

                            <div class="col-md-8 col-sm-8">


                                <p class="text_1"><?php echo $val['Message']['client_message']; ?></p>
                                <a href="#" data-toggle="modal" data-target="#myModal1"><button class="btn btn-sm  btn_red btn_red12 pull-right" type="button" >Reply</button></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
    <?php } } ?>
              

                <div class="clearfix"></div>
            </div>

        </div>
    </div>

</div>


<!-- Pop up menu for Reply -->

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header green">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Reply to client</h4>
            </div>
            <div class="modal-body">

                <form role="form">
                    <div class="bg_grey  marg_30">

                        <div class="media1 media2 padd_0  ">

                            <div class="col-md-3 col-sm-3 padd_tb15">

                                <img alt="Payoneer image icon" src="<?php echo $this->webroot; ?>img/payoneer.png">

                            </div>

                            <div class="col-md-7 col-sm-7 padd_tb15">

                                <h3 class="marg_0">Payoneer</h3>

                                <p class=" font_18">$2 USD per withdrawal.Additional activation and maintenance fee charged by Payoneer. October 3, 2014</p>

                                <a href="#">Don’t have Payoneer account?</a>
                            </div>

                            <div class="col-md-2 col-sm-2 set_up text-center">

                                <button class="btn btn-danger col-md-12 marg_tb15" type="button">Set up</button>

                            </div>
                            <div class="clearfix"></div>

                        </div>



                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <p class=" text-center">
                    <button type="button" class="btn btn_red font_18 col-md-1 col-md-offset-4 ">SAVE</button>
                    <button type="button" class="btn btn_red font_18  col-md-1 marg_l20  " data-dismiss="modal">CANCEL</button>
                <div class="clearfix"></div>
                </p>
            </div>
        </div>
    </div>
</div>
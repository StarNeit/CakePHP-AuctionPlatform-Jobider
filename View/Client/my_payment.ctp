<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav">
                        <li>
                            <a href="<?php echo $this->webroot; ?>client/settings"/> My Info                            </a>
                        </li>  
                        <li>
                            <a href="<?php echo $this->webroot; ?>client/changepassword"/>  Change Password </a>
                        </li>
<!--                        <li class="active">
                            <a href="<?php //echo $this->webroot; ?>client/my_payment"/>  My Payment Methods </a>
                        </li>-->
                        <li>
                            <a href="<?php echo $this->webroot; ?>client/notifications"/>Notification Settings </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p class="font_14">A payment of $23 has been supplied to your account.          
                    </p>
                    <p class="font_14">Michel shey contact : <br/>
                        Tester for wordpress site started on 13-Nov-2014 </p>
                    <p>
                        <i>
                            <img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="view"/>
                        </i>
                        <a href="<?php echo $this->webroot; ?>client/allNotifications" style="text-decoration: none;"/>See all notifications  >></a>
                    </p>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green"> My Payment Methods </div>
              
                <div class="col-md-12">
                    <div class="green_button">
                        <a href="#" class="marg_l20 font_14" data-toggle="modal" data-target="#myModal1"><button class="pull-right"> Add a Payment Method </button></a>
                    </div>
                </div>  
                <div class="clearfix"> </div>
                <div class="table-responsive tabl_mar">
                    <table class="table cust_table11">
                        <thead>
                            <tr>
                                <th> Payment Method   </th>
                                <th> Actions  </th>
                                <th> AutoPay Status</th>
                            </tr>
                        </thead>
                        <tbody class="bodr">
                        <td colspan="3" style="text-align: center; padding: 40px; font-size: 20px;">
                            No payment methods set up yet. 
                        </td>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>         
    </div>
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header green">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Payment Method</h4>
            </div>
            <div class="modal-body">
                <form role="form">
           <div class="bg_grey  marg_30">
                        <div class="media1 media2 padd_0  ">
                            <div class="col-md-3 col-sm-3 padd_tb15">
                                <img alt="Paypal" src="<?php echo $this->webroot; ?>img/paypal.png" >                            </div>

                            <div class="col-md-7 col-sm-7 padd_tb15">

                                <h3 class="marg_0">PayPal</h3>

                                <p class=" font_18">You must have a verified PayPal account.</p>

                                <a href="https://www.paypal.com/in/webapps/mpp/home">Don’t have Paypal account?</a>
                            </div>

                            <div class="col-md-2 col-sm-2 set_up text-center">

                                <button class="btn btn-danger col-md-12 marg_tb15" type="button">Set up</button>

                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    
                    
                        <div class="bg_grey  marg_30">
                        <div class="media1 media2 padd_0  ">
                            <div class="col-md-3 col-sm-3 padd_tb15">
                                <img  src="<?php echo $this->webroot; ?>img/credit_card.png" alt="image">                            </div>

                            <div class="col-md-7 col-sm-7 padd_tb15">

                                <h3 class="marg_0">Credit Card</h3>

                                <p class=" font_18">In order to verify your card, we may make 2 temporary charges totaling $10. These charges will be refunded to your credit card within 10 days.</p>

<!--                                <a href="https://www.paypal.com/in/webapps/mpp/home">Don’t have Paypal account?</a>-->
                            </div>

                            <div class="col-md-2 col-sm-2 set_up text-center">

                                <button class="btn btn-danger col-md-12 marg_tb15" type="button">Set up</button>

                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </form>

            </div>
           
        </div>
    </div>
</div>
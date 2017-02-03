<div style="padding:0px;" class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Reports</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li><a href="<?php echo $this->webroot; ?>freelancer/reporting"> Transactions</a></li>
                        <li><a href="<?php echo $this->webroot; ?>freelancer/viewearning"> View earnings </a></li>
                        <li class="active"><a href="<?php echo $this->webroot; ?>freelancer/previousEarnings"> Previous earnings </a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning </div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now :<?php if(!empty($earning_amount)){ echo '$'. $earning_amount; }else { echo "$0.00";}?></p>
                    <p><i><img alt="view pending earning message" class="mrg_r5" src="<?php echo $this->webroot; ?>img/view.png"></i><a href="<?php echo $this->webroot; ?>freelancer/viewearning">View pending earnings &gt;&gt;</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">

            <div class="bg_white">

                <div class="green">

                    Active Application

                </div>
                <div class="table-responsive">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>

                                <th>Job</th>
                                <th>Received</th>
                                <th>Hired By</th>
                                <th>View Contact</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Web Designing</td>
                                <td>John S. Smith</td>
                                <td>Active <font class="text_1">(since 12-5-2013)</font></td>
                                <td><button class="btn-sm btn-danger btn_red11">View Detail</button></td>
                            </tr>
                            <tr>
                                <td>Web Designing</td>
                                <td>John S. Smith</td>
                                <td>Active <font class="text_1">(since 12-5-2013)</font></td>
                                <td><button class="btn-sm btn-danger btn_red11">View Detail</button></td>
                            </tr>
                            <tr>
                                <td>Web Designing</td>
                                <td>John S. Smith</td>
                                <td>Active <font class="text_1">(since 12-5-2013)</font></td>
                                <td><button class="btn-sm btn-danger btn_red11">View Detail</button></td>
                            </tr>
                            <tr>
                                <td>Web Designing</td>
                                <td>John S. Smith</td>
                                <td>Active <font class="text_1">(since 12-5-2013)</font></td>
                                <td><button class="btn-sm btn-danger btn_red11">View detail</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
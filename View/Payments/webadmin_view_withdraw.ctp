<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>View Withdraw Payment Information</h4>
                    </header>
                    <?php echo $this->Session->flash(); ?>
                    <div class="panel-body">
                        <div class="position-center">

                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Receiver Email</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static"> <?php echo $withdraw['Withdrawrequest']['receiver_email']; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Withdraw Amount</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static"> $<?php echo $withdraw['Withdrawrequest']['withdraw_amount']; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Freelancer Name</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static"> <?php echo ucfirst($withdraw['User']['first_name']) . ' ' . ucfirst($withdraw['User']['last_name']); ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Milestone name</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static">   <?php echo $withdraw['Milestone']['milestone_title']; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Amount</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static">   <?php echo '$  ' . $withdraw['Milestone']['payment_amount']; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label"></label>
                                <form action="" method="post">
                                    <input type="hidden" nme="test" value="testing" />
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">Approve Request</button>
                                </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>


                        </div>
                </section>

            </div>

        </div>
        <!-- page end-->
    </section>
</section>




<style>
    .error-message {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 258px;
    }
    .paymnt {
        padding: 50px;
    }
</style>

<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>View Paypal Payment Information</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <!--  <form role="form">-->
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Transaction Id</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static"> <?php echo $payrecord['Paypalpayment']['transection_id']; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Client Name</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static"> <?php echo ucfirst($payrecord['Client']['first_name']) . ' ' . ucfirst($payrecord['Client']['last_name']); ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Freelancer Name</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static"> <?php echo ucfirst($payrecord['Freelancer']['first_name']) . ' ' . ucfirst($payrecord['Freelancer']['last_name']); ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Job Title</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static"> <?php echo $payrecord['Job']['job_title']; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Milestone name</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static">   <?php echo $payrecord['Paypalpayment']['item_name']; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Amount</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static">   <?php echo '$  ' . $payrecord['Paypalpayment']['payment_amount']; ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class=" col-sm-3 control-label">Transaction Date</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static">  <?php echo date('d-M-Y', strtotime($payrecord['Paypalpayment']['payment_date'])); ?></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
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

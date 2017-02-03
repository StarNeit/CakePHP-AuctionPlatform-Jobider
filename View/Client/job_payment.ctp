<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="payment1">
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body bg_grey1 padd_0">
                        <ul class="nav ">
                            <li>
                                <a href="<?php echo $this->webroot; ?>client/postajob"> Post a job </a>
                            </li>
                            <li><a href="<?php echo $this->webroot; ?>client/searchfreelancer"> Search for freelancer </a></li>
                            <li><a href="<?php echo $this->webroot; ?>client/postedJobs">Jobs i have posted </a></li>
                            <li><a href="<?php echo $this->webroot; ?>client/job_payment">Jobs Payment</a></li>
                        </ul>
                    </div>
                </div>
                <?php echo $this->element('client_notification'); ?>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="payment">
                <div class="bg_white">
                    <div class="green">Jobs Detail </div>

                    <div class="table-responsive marg_tb15">
                        <table class="table cust_table11 table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No </th>
                                    <th> Job Title</th>
                                    <th> Job Payment</th>
                                    <th> Total </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php //pr($hire);  ?>
                                <?php
                                if (!empty($hire)) {
                                    $i = 1;
                                    foreach ($hire as $k => $v) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td> <?php echo $v['Job']['job_title']; ?></td>
                                            <td> <?php  echo $v['Job']['job_payment'];?></td>
                                            <td><?php echo '$' . $v['Job']['budget']; ?></td>
                                            <?php if ($v['Job']['job_payment']=='Milestone') { ?>
                                                <td><a href="<?php echo $this->webroot; ?>client/view_milestones/<?php echo $v['Job']['id']; ?>"><button class="btn-sm btn-danger btn_red11">View Milestones</button></a></td>
                                            <?php } else { ?>
                                                <td><a href="<?php echo $this->webroot; ?>client/view_jobdetail/<?php echo $v['Job']['id']; ?>"><button class="btn-sm btn-danger btn_red11">View Detail</button></a></td>
                                        <?php } ?>
                                        </tr>

        <?php $i++;
    } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" style="text-align:center; font-size:20px;padding: 40px">No Job(s) Found </td>
                                    </tr>
<?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
        <div class="clearfix"></div>
    </div>
</div>

<style>
    .payment {
        margin-top: 20px;
    }

    .payment .marg_tb15 {
        margin: 0;
    }

    .payment1 {
        margin-top: 20px;
    }

</style>
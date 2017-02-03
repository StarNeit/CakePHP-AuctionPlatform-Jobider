<div class="container">

    <div class="row marg_tb15">
        <?php echo $this->element('reports_sidebar'); ?>

        <div class="col-md-9 col-sm-9  pad_r0 ">

            <div class="bg_white">

                <div class="green">

                    Withdraw Request
                </div>
                <div class="table-responsive">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>

                                <th>Freelancer Name</th>
                                <th>Milestone Name</th>
                                <th>Total Amount</th>
                                <th>Withdraw Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($Allrequest)) {
                                foreach ($Allrequest as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo ucfirst($value['User']['first_name']) . ' ' . ucfirst($value['User']['last_name']); ?></td>
                                        <td><?php echo $value['Milestone']['milestone_title']; ?></td>
                                        <td> <?php echo '$' . $value['Withdrawrequest']['total_amount']; ?></td>
                                        <td><?php echo '$' . $value['Withdrawrequest']['withdraw_amount']; ?></td>
                                        <td>Pending Request</td>
                                        <?php if (!empty($value['Milestone']['id'])) { ?>
                                            <td>  <a href="<?php echo $this->webroot . 'client/WithdrawRequest/' . $value['Milestone']['id'] ?>" class="btn-sm btn-danger btn_red11">View Request</a></td>
                                        <?php } elseif (!empty($value['PaypalInfo']['Paypalpayment']['id'])) { ?>
                                            <td>  <a href="<?php echo $this->webroot . 'client/WithdrawRequest/' . $value['PaypalInfo']['Paypalpayment']['id']; ?>" class="btn-sm btn-danger btn_red11">View Request</a></td>
                                        <?php } else { ?>
                                            <td>  <a href="<?php echo $this->webroot . 'client/WithdrawRequest/' . $value['Creditinfo']['Creditpayment']['id']; ?>" class="btn-sm btn-danger btn_red11">View Request</a></td>
                                        <?php } ?>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr align="center"><td colspan="6">No Record(s)  found.</td></tr> <?php } ?>        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>  
        </div>     </div>

</div>
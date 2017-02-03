<div class="container">

    <div class="row marg_tb15">

        <div class="col-md-3 pad_l0 col-sm-3">

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li><a href="<?php echo $this->webroot; ?>client/manageMyTeam"> Freelancers i have hired </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/ActiveContract">Contracts </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/SentMessageToApplicant"> Sent Messages to applicants </a></li>
                        <li  class="active"><a href="<?php echo $this->webroot; ?>client/view_ended_contract"> View Ended Contracts </a></li>
                    </ul>
                </div>
            </div>

            <?php echo $this->element('client_notification'); ?>
        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">

            <div class="bg_white">

                <div class="green">

                    Ended Contracts

                </div>
                <div class="table-responsive">
                    <div class="end_data">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>
                                <th>Contract</th>
                                <th>Freelancer</th>
                                <th>Time Period</th>
                                <th>Terms</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($Ended_contracts) and !empty($Ended_contracts)) {
                                foreach ($Ended_contracts as $kk => $vv) {
                                    ?>
                                    <tr>
                                        <td><?php echo $vv['Job']['job_title']; ?></td>
                                        <td><?php echo ucfirst($vv['Contractor']['first_name']) . ' ' . ucfirst($vv['Contractor']['last_name']); ?></td>
                                        <td><?php echo $vv['Hire']['duration']; ?></td>
                                        <td><?php echo '$' . $vv['Job']['budget'] . '  (Fixed)'; ?></td>
                                        <td><?php echo ucfirst($vv['Hire']['hire_status']); ?> &nbsp;&nbsp<img height="15" width="15" src="<?php echo $this->webroot; ?>img/yes.png"></td>  
                                    </tr>   
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center contract"> Sorry, There's  no Record(s) found for Ended Contract(s) ! </td>
                                    
                                </tr>    
                            <?php }
                            ?>

                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>

        </div>


    </div>

</div>
<style>
    .contract {
    color: #5b5a5a !important;
    font-size: 19px !important;
    padding: 20px !important;
}
.end_data .table{
    margin-bottom: 0px;
}
</style>
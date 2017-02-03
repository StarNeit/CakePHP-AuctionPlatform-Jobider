<?php if($this->params['controller']=='freelancer' && $this->params['action']=='view_ended_contract'){
    $end = 'active';
}else{
    $end = '';
} ?>

<div class="container">
    <div class="freelancer_profile_content1">
        <div class="col-md-3 pad_l0 col-sm-3">

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">My Jobs</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li><a href="<?php echo $this->webroot; ?>freelancer/myjobs"> Contracts </a></li>
                        <li class="<?php echo $end; ?>"><a href="<?php echo $this->webroot; ?>freelancer/view_ended_contract"> View Ended Contract(s) </a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning </div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>
                        Available now :<?php
                        if (!empty($Payment_earning)) {
                            echo '  $' . $Payment_earning . '.00';
                        } else {
                            echo '$0.00';
                        }
                        ?></p> 
                    <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="View pending earnings"></i><a href="<?php echo $this->webroot; ?>freelancer/reporting">View pending earnings &gt;&gt;</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green">
                    Ended Contracts
                </div>
                <div class="table-responsive">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>
                                <th>Contract</th>
                                <th>Client</th>
                                <th>Time Period</th>
                                <th>Terms</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($Ended_contracts)) {
                                foreach ($Ended_contracts as $key => $val) {
                                    ?>
                                    <tr>
                                        <td><?php echo $val['Job']['job_title']; ?></td>
                                        <td><?php echo ucfirst($val['Hiring']['first_name']) . ' ' . ucfirst($val['Hiring']['last_name']); ?></td>
                                        <td><?php echo $val['Hire']['duration']; ?></td>
                                        <td><?php echo '$' . $val['Job']['budget'] . '  (Fixed)'; ?></td>
                                        <td><?php echo ucfirst($val['Hire']['hire_status']); ?>&nbsp;<img height="15" width="15" src="<?php echo $this->webroot; ?>img/yes.png" alt="Yes image icon"></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr align="center">
                                    <td colspan="6" style="padding:22px;font-size: 20px;">
                                        Sorry, There's  no Record(s) found for Ended Contract(s) !
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>
            </div>

        </div>

    </div>




</div>


<script>
    $(document).ready(function() {
        $(document).on('click', '.search_job', function() {
            var search = $('#searchbar').val();
            if (search == '') {
                alert('Please Enter the Search keyword !');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });
        $('.chek').click(function() {
            if ($('input[type=checkbox]').is(':checked')) {
                var value = $('input[type=checkbox]').val('yes');
            } else {
                var value = $('input[type=checkbox]').val('no');
            }
            var valdata = $('input[type=checkbox]').val();
            if (valdata == 'yes') {
                $('.cont').removeClass('hide');
                $('.end_con').addClass('hide');
            }
            if (valdata == 'no') {
                $('.cont').addClass('hide');
                $('.end_con').removeClass('hide');
            }

        });
    });









</script>

<style>
    .nodisp {
        background: none repeat scroll 0 0 #fff;
        border: 0 none;
        box-shadow: none;
    }

</style>
<?php
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'contracts')) {
    $contracts = "active";
} else {
    $contracts = "";
}
if ($this->params['controller'] == 'freelancer' and ($this->params['action'] == 'myjobs')) {
    $myjobs = "active";
} else {
    $myjobs = "";
}
?>
<?php if (!empty($hire)) { ?>
    <div class="container">
        <div class="col-md-3" style="margin-top: 20px;">
            <p><i><img class="mrg_r5" alt="Back to Contrcat" src="<?php echo $this->webroot; ?>img/back.png"></i><a href="<?php echo $last_url; ?>" class="font_18">Back to Contracts</a> </p> </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3  pad_l0 col-sm-3">
                    <div class="contract_left_panel">
                        <div class="panel panel-default green_bg1">
                            <div class="panel-heading">My jobs</div>
                            <div class="panel-body bg_grey1 padd_0">
                                <ul class="nav opensans font_14">
                                    <li class="<?php echo $contracts; ?>"><a href="<?php echo $this->webroot; ?>client/ActiveContract" class="opensans font_16"> Contracts </a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="result3">
                        <h1><?php echo ucfirst($hire['Job']['job_title']); ?></h1>
                        <div class="result3_inner">
                            <div class="result3_inner1">
                                <p>Agreed</p>
                                <h1><?php echo '$' . $hire['Job']['budget'].'.00'; ?></h1>
                            </div><!--result3_inner1-->
                            <?php if ($hire['Hire']['payment_type'] == 'milestone') { ?>
                                <div class="result3_inner1">
                                    <p>Paid</p>
                                    <h1><?php echo '$' . $pay . '.00' ; ?></h1>
                                </div><!--result3_inner1-->
                            <?php } elseif(empty($hire['Hire']['payment'])) { ?>
                                <div class="result3_inner1">
                                    <p>Paid</p>
                                    <h1><?php echo '$' . 0 . '.00' ?></h1>
                                </div><!--result3_inner1-->
                            <?php } else {?>
                                 <div class="result3_inner1">
                                    <p>Paid</p>
                                    <h1><?php echo '$' . $pay . '.00' ?></h1>
                                </div><!--result3_inner1-->
                            <?php } ?>
                            <?php if ($hire['Hire']['payment_type'] == 'full-payment') { ?>
                                <div class="result3_inner1">
                                    <p>Remaining</p>
                                    <h1>$0.00</h1>
                                </div><!--result3_inner1-->
                            <?php } else { ?>
                                <div class="result3_inner1">

                                    <p>Remaining</p>

                                    <h1><?php echo '$' . $remain.'.00'; ?></h1>

                                </div><!--result3_inner1-->
                            <?php } ?>

                        </div><!--resul3_inner-->
                        <div class="result_t">
                            <div class="result_right">
                                <?php if ($hire['Hire']['payment_type'] == 'full-payment') { ?>
                                    <div class="table-responsive">
                                        <table class="table cust_table11 table-striped marg_0 milestone_new pull-left ">
                                            <thead>
                                                <tr><th>Full Payment</th><th></th><th></th></tr>
                                            </thead>
                                            <tbody>

                                                <tr>

                                                    <td>
                                                        <?php
//                                                    die('sdhasjd');
                                                        $dura = $hire['Hire']['duration'];
                                                        if (strpos($dura, 'less') !== false) {
                                                            $duration = explode('less than ', $hire['Hire']['duration']);
                                                            echo $hire['Job']['job_title'];
//                                                            echo $duration;die;
                                                            ?>(<?php
                                                            $effectiveDate = strtotime("+" . $duration[1], strtotime($hire['Hire']['created']));

                                                            echo 'due  ' . date('M-d-Y', $effectiveDate);
                                                            ?>)
                                                        <?php } ?>
                                                        <?php
                                                        if (strpos($dura, 'to') !== false) {
                                                            $duration = explode('less than', $hire['Hire']['duration']);
                                                          echo $hire['Job']['job_title']
                                                            ?>(<?php
                                                            $effectiveDate = strtotime("+" . $duration[0], strtotime($hire['Hire']['created']));

                                                            echo 'due  ' . date('M-d-Y', $effectiveDate);
                                                            ?>)      
                                                        <?php } ?></td> 
                                                    <?php
//         pr($paypal);
//         pr($credit_data);
//         die;

                                                    if (!empty($paypal) or !empty($credit_data)) {
                                                        ?>
                                                        <td><?php echo '$' . $hire['Job']['budget'] . '.00' ?> <span><img src="<?php echo $this->webroot; ?>img/yes.png" width="15" height="15" alt="yes"></span></td>
                                                        <td class="result_right_text">Approved <?php echo $tect; ?><p>
                                                                <!--                                                                <a href="#">Review Submission</a>-->
                                                            </p></td>
                                                    <?php } else { ?>
                                                        <td><?php echo '$' . $hire['Job']['budget'] . '.00' ?> </td>
                                                        <td class="result_right_text"></td>
                                                    <?php } ?>
                                                </tr>

                                            </tbody>
                                        </table>


                                    </div>
                                <?php } else {
                                    ?>

                                    <div class="table-responsive">
                                        <table class="table cust_table11 table-striped marg_0 milestone_new pull-left ">
                                            <thead>
                                                <tr><th>Milestone</th><th></th><th></th></tr>
                                            </thead>
                                            <tbody>
                                                <?php ?>
                                                <?php foreach ($milestone as $k => $v) { ?>
                                                    <?php if ($v['Milestone']['milestone_status'] == 'Paid') { ?>
                                                        <tr>
                                                            <td><?php echo $v['Milestone']['milestone_title'] ?>(<?php echo 'due  ' . date('M-d-Y', strtotime($v['Milestone']['set_time'])); ?>)</td> 
                                                            <td><?php echo '$' . $v['Milestone']['payment_amount'] . '.00' ?> <span><img src="<?php echo $this->webroot; ?>img/yes.png" width="15" height="15" alt="yesimage"></span></td>
                                                            <td class="result_right_text">Approved <?php
                                                                if (!empty($v['Milestone']['due_date'])) {
                                                                    echo $v['Milestone']['due_date'];
                                                                } else {
                                                                    echo "0.00 day ago";
                                                                }
                                                                ?><p>
                                                                </p></td>
                                                        </tr>
                                                    <?php }else{ ?>
                                                    <tr>
                                                        <td><?php echo $v['Milestone']['milestone_title'] ?>(<?php echo 'due  ' . date('M-d-Y', strtotime($v['Milestone']['set_time'])); ?>)</td> 
                                                        <td><?php echo '$' . $v['Milestone']['payment_amount'] . '.00' ?> </td>
                                                        <td class="result_right_text"></td>
                                                    </tr>

                                                <?php } }?>




                                            </tbody>
                                        </table>


                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>

                    </div><!--result_t-->




                </div><!--col-md-8-->


                <div class="col-md-3  col-sm-3 col-xs-12">

                    <div class="result_right3">

                        <div class="result_right3_inner">

                            <h3>Contractor</h3>

                            <div class="col-md-4 col-xs-6">
                                <div class="result_right1_inner1">
                                    <?php if (!empty($hire['Contractor']['image'])) { ?>
                                        <img class="responsive" src="<?php echo $this->webroot; ?>uploads/<?php echo $hire['Contractor']['image']; ?>" alt="image">
                                    <?php } else { ?>
                                        <img class="responsive" src="<?php echo $this->webroot; ?>img/user_1.png" alt="image" />
                                    <?php } ?>
                                </div><!--result_right1_innerl-->
                            </div><!--col-md-6-->
                            <div class="col-md-8 col-sm-12 col-xs-6">
                                <div class="result_right1_innerr">
                                    <h4><b><?php echo ucfirst($hire['Contractor']['first_name']) . ' ' . ucfirst($hire['Contractor']['last_name']); ?></b></h4>
                                    <p>It's <?php echo date('D. h:i A', strtotime($hire['Hire']['created'])); ?></p>
                                </div><!--result_right1_innerr-->
                            </div><!--col-md-6-->
                            <div class="clearfix"></div>
                        </div><!--result_right3_inner-->



                        <div class="result_right3_inner">

                            <h3>Client</h3>

                            <div class="col-md-4 col-xs-6">
                                <div class="result_right1_inner1">
                                    <?php if (!empty($hire['Hiring']['image'])) { ?>
                                        <img class="responsive" src="<?php echo $this->webroot; ?>uploads/<?php echo $hire['Hiring']['image']; ?>" alt="image">
                                    <?php } else { ?>
                                        <img class="responsive" src="/img/user_2.png" alt="image">
                                    <?php } ?>   
                                </div><!--result_right1_innerl-->
                            </div><!--col-md-6-->
                            <div class="col-md-8 col-sm-12 col-xs-6">
                                <div class="result_right1_innerr">
                                    <h4><b><?php echo ucfirst($hire['Hiring']['first_name']) . ' ' . ucfirst($hire['Hiring']['last_name']) ?></b></h4>
                                    <p>It's <?php echo date('D. h:i A', strtotime($hire['Hire']['created'])); ?></p>


                                </div><!--result_right1_innerr-->
                            </div><!--col-md-6-->

                            <div class="contract_butt">
                                <input type="hidden" value="<?php echo $hire['Job']['id']; ?>">
                                <button class="btn-sm btn-danger btn_red11 btn_date" id="<?php echo $hire['Contractor']['id']; ?>" data-toggle="modal" data-target="#myModal">Send Message</button>
                                </a>
                                <a href="<?php echo $this->webroot; ?>client/mymessages">
                                    <button class="btn-sm btn-danger btn_red11">all Message</button>
                                </a>


                            </div><!--result3_bottom-->

                            <div class="clearfix"></div>
                        </div><!--result_right3_inner-->




                        <div class="result_right3_inner">

                            <h3>Contract detalils</h3>

                            <?php if ($hire['Hire']['hire_status'] == 'Active') { ?>
                                <div class="result_right1_bottom">
                                    <div class="contract_right_bottom" style="color:green">
                                        <p><img src="/img/greendot.png" alt="green">&nbsp;&nbsp;<?php echo $hire['Hire']['hire_status']; ?></p>
                                    </div>
                                    <p><a href="<?php echo $this->webroot; ?>client/viewpost/<?php echo $hire['Hire']['job_id']; ?>">View Original job post</a></p>
                                 <!--   <p><a href="#"></a></p>-->

                                </div>
                            <?php } else { ?>
                                <div class="result_right1_bottom">
                                    <div class="contract_right_bottom" style="color:red">
                                        <p><img src="/img/red.png" alt="red">&nbsp;&nbsp;<?php echo $hire['Hire']['hire_status']; ?></p>
                                    </div>
                                    <p><a href="<?php echo $this->webroot; ?>client/viewpost/<?php echo $hire['Hire']['job_id']; ?>">View Original job post</a></p>


                                </div>
                            <?php } ?>

                            <div class="contract_butt">
                                <!--<button class="btn-sm btn-danger btn_red11">Give a Refund</button>-->

                                <?php if ($hire['Hire']['hire_status'] != 'closed') { ?>
                                    <a href="<?php echo $this->webroot . 'client/end_contract/' . $hire['Hire']['job_id']; ?>" class="btn-sm btn-danger btn_red11" style="text-decoration:none">End Contract</a>

                                <?php } ?>
                            </div><!--result3_bottom-->

                            <div class="clearfix"></div>
                        </div><!--result_right3_inner-->

                    </div><!--result_right3-->
                </div><!--col-md-4-->

            </div>
        </div> <!--col-md-12-->


    </div>
<?php } else { ?>
    <div class="container">
        <div class="col-md-12">
            <p style="text-align: center; color: rgb(137, 137, 137); padding: 175px; font-size: 27px;">Sorry No  Contract Found</p> </div>
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-3  pad_l0 col-sm-3">

                </div>




                <div class="col-md-6 col-sm-6">

                    <!--result_t-->




                </div><!--col-md-8-->


                <!--col-md-4-->

            </div>
        </div> <!--col-md-12-->


    </div>
<?php } ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn_date', function() {
            var user_id = $(this).attr('id');
            var job_id = $(this).prev().val();
            $.ajax({
                type: 'post',
                url: '<?php echo $this->webroot; ?>client/ajax_model',
                data: {user_id: user_id, job_id: job_id},
                success: function(response) {
                    $('#myModal').html(response);
                }
            });
        });
    });
</script>

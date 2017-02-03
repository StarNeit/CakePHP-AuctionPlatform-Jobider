<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Credit Card Payments</h3>
                    </header>
                    <div class="col-md-6">
                        <div class="btn-group">
                        </div>
                    </div>
                    <div class="panel-body">
                        <section id="unseen">
                           
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                    <!--<th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>-->
                                        <th>Sr. No</th>
                                        <th>Client Name</th>
                                        <th>Freelancer Name</th>
                                        <th>Job Title</th>
                                        <th>Card Type</th> 
                                        <th>Transection Id</th>
                                        <th>Amount</th>
                                        <th>Transaction Date</th>
                                 <th>Action</th>
<!--                                        <th>Action</th>-->

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (!empty($record)) {
                                        $i = '1';
                                        foreach ($record as $record) {
//                                            pr($record); }die;
                                            ?>
                                            <tr>

                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $record['Client']['first_name'] . ' ' . $record['Client']['last_name']; ?></td>
                                                <td><?php echo $record['Freelancer']['first_name'] . ' ' . $record['Freelancer']['last_name']; ?></td>
                                                <td><?php echo $record['Job']['job_title']; ?></td>
                                                <td><?php echo $record['Creditpayment']['card_type']; ?></td>
                                              <td><?php echo $record['Creditpayment']['transaction_id']; ?></td>
                                                <td>$<?php echo $record['Creditpayment']['amount']; ?></td>
                                                <td><?php echo date('d-M-Y',strtotime($record['Creditpayment']['created'])); ?></td>
                                                <td><a href="<?php echo $this->Html->url(array('controller'=>'payments','action'=>'view_ccpaymentrecord','prefix'=>'webadmin',$record['Creditpayment']['id'])); ?>" class="fa fa-eye"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->Html->url(array('controller'=>'payments','action'=>'delete_ccpaymentrecord','prefix'=>'webadmin',$record['Creditpayment']['id'])); ?>" class="fa fa-trash-o" onclick="return confirm('Are you sure? You Want to Delete it.');"></a></td>
                                                
  </tr>
                                            <?php
                                            $i++;
                                        }
                                       } else { ?>
                                        <tr>
                                            <td colspan="8">
                                                <?php if (isset($text) and !empty($text)) { ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Sorry!</strong> There is no data related to <strong><?php echo $text; ?></strong> right now.
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                    </div>
                                                <?php } else { ?>

                                                    <div class="alert alert-danger">
                                                        <strong> No Record(s) Found !</strong>
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                    </div> 
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Client Name</th>
                                        <th>Freelancer Name</th>
                                        <th>Job Title</th>
                                         <th>Card Type</th>
                                        <th>Transection Id</th>
                                         <th>Amount</th>
                                        <th>Transaction Date</th>
                                        <th>Action</th>
                                    </tr> 
                                </tfoot>
                                <?php echo $this->Form->end(); ?>
                            </table>
                        </section>

                        <div class="pagi ">
                            <?php ?>
                            <ul class="pagination pull-right">
                                <li><?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?></li>
                                <?php
                                echo $this->Paginator->numbers(array(
                                    'before' => '',
                                    'after' => '',
                                    'separator' => '',
                                    'tag' => 'li',
                                    'spanClass' => 'sr-only',
                                    'currentClass' => 'active',
                                    'currentTag' => 'a',
                                ));
                                ?> 
                                <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
                            </ul>

                        </div>

                    </div>

                </section>

            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<style>
    .current{
        /*background: none repeat scroll 0 0 #FF0000 !important;*/
        background: none repeat scroll 0 0 #DA423D !important;
        float: left;
        height: 34px !important;
        margin-top: 2px;
        width: 36px;
        padding-top: 6px;
        padding-left: 12px;
        color: white;
    }
    .next{
        color:white !important;
    }
    .prev{
        color:white !important;
    }

    .input-group-addon.grrenbtn {
        background: #1fb5ad;
        color: #fff;
        font-size: 14px;
    }


</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.val').click(function() {
            if ($('.selectPart').val() === "") {
                alert('Please select the bulk action');
                return false;
            }
            if ($('.selectPart').val() == 'active') {
                if ($('.checkboxes').is(':checked')) {
                    alert('Do you want to Activate it ?');
                } else {
                    alert('Please select the action');
                    return false;
                }
            }
            if ($('.selectPart').val() == 'inactive') {
                if ($('.checkboxes').is(':checked')) {
                    alert('Do you want to Deactivate it ?');
                } else {
                    alert('Please select the action');
                    return false;
                }
            }
            if ($('.selectPart').val() == 'delete') {
                if ($('.checkboxes').is(':checked')) {
                    alert('Do you want to delete it ?');
                } else {
                    alert('Please select the action');
                    return false;
                }
            }
        });
    });
</script>

<style>

    .col-lg-2.pull-left {
        margin-left: -106px;
    }
</style>

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
    });

</script>
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Membership Plans</h3>
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
                                        <th>Freelancer Name</th>
                                        <th>Current Plan</th>
                                        <th>Membership Connects</th>
                                        <th>Used Connects</th>
                                        <th>Available Connects</th>
                                        <th>Membership Fee</th>
<!--                                         <th>Action</th>-->
<!--                                        <th>Action</th>
                                        <th>Action</th>-->

                                    </tr>
                                </thead>

                                <tbody>
                                 <?php
                                    if (!empty($User_data)) {
                                        $i = '1';
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo ucfirst($User_data['User']['first_name']).'  '.  ucfirst($User_data['User']['last_name']); ?></td>
                                                <?php if(!empty($result) and $result['Membershipplan']['membership_type']=='premium_smallAgency')  {?>
                                                <td><?php echo ' Your current plan is Premium for Small Agency'; ?></td>
                                                <?php } else{ ?>
                                                <td><?php  echo 'Freelancer Basic';?></td>
                                                <?php } ?>
                                                <td><?php  echo $User_data['User']['connects'];?></td>
                                                <td> <?php  echo $User_data['User']['used_connects']; ?></td>
                                                <td><?php echo $available_connects ?></td>
                                                <td>NA</td>
                                            </tr>
                                            <?php
                                            $i++;
                                        
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
                                         <!--<th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>-->
                                        <th>Sr. No</th>
                                        <th>Freelancer Name</th>
                                        <th>Current Plan</th>
                                        <th>Membership Connects</th>
                                        <th>Used Connects</th>
                                        <th>Available Connects</th>
                                        <th>Membership Fee</th>
<!--  <th>Action</th>-->
                                    </tr> 
                                </tfoot>
                            </table>
                        </section>

                        <div class="pagi ">
                     
<!--                            <ul class="pagination pull-right">
                                <li><?php //echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?></li>
                                <?php
//                                echo $this->Paginator->numbers(array(
//                                    'before' => '',
//                                    'after' => '',
//                                    'separator' => '',
//                                    'tag' => 'li',
//                                    'spanClass' => 'sr-only',
//                                    'currentClass' => 'active',
//                                    'currentTag' => 'a',
//                                ));
                                ?> 
                                <li><?php //echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
                            </ul>-->

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
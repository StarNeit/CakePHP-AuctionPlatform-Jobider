<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Manage Enterprise Solutions</h3>
                    </header>
                    <div class="col-md-6">
                        <div class="btn-group">
                        </div>
                    </div>
                    <div class="panel-body">
                        <section id="unseen">
                            <div class="table-toolbar">
                                <div class="row">

                                    <div class="col-lg-3 pull-right">
                                        <?php echo $this->Form->create('Solution', array('url' => array('controller' => 'Enterprisesolutions', 'action' => 'webadmin_index'))); ?>
                                        <div class="input-group">
                                            <input type="text" id="searchbar" class="form-control" name="data[Solution][search]">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary search_job" type="button">Go</button>
                                            </span>
                                        </div>
                                        <?php echo $this->Form->end(); ?>
                                    </div>

                                    <div class="col-lg-2 pull-left">
                                        <?php echo $this->Form->create('Solution', array('id' => 'frm1', 'url' => array('controller' => 'Enterprisesolutions', 'action' => 'changeselectall'))); ?>
                                        <div class="input-group">
                                            <select name="data[Solution][select]" class=" form-control selectPart">
                                                <option value="">Select</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary val" type="submit">Go</button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                </div>
                            </div>
                            &nbsp;
                            <?php echo $this->Session->flash(); ?>
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>
                                        <th>Sr. No</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Job Title</th>
                                        <th>Company</th>
                                        <th>Employees</th>
                                        <th>Phone No.</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($blog)) {
                                        $i = '1';
                                        foreach ($blog as $blog) {// pr($blog);
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="data[Solution][type]" value="<?php echo $blog['Solution']['type']; ?>">
                                                    <input type="checkbox" name="data[Solution][chk1][]" value="<?php echo $blog['Solution']['id']; ?>" class="checkboxes"></td>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $blog['Solution']['first_name'] . ' ' . $blog['Solution']['last_name']; ?></td>
                                                <td><?php echo $blog['Solution']['email']; ?></td>
                                                <td><?php echo $blog['Solution']['job_title']; ?></td>
                                                <td><?php echo $blog['Solution']['company']; ?></td>
                                                <td><?php echo $blog['Solution']['employes']; ?></td>
                                                <td><?php echo $blog['Solution']['phone']; ?></td>
                                                <!--<td><?php //echo $blog['Solution']['notes'];   ?></td>-->
                                                <td><?php echo $blog['Solution']['type']; ?></td>
                                                <td><a href="<?php echo $this->Html->url(array('controller' => 'enterprisesolutions', 'action' => 'reply', 'prefix' => 'webadmin', $blog['Solution']['id'])); ?>"><button class="btn btn-primary" type="button">Reply</button></a></td>
                                                <td align="center">
                                                    <a href="<?php echo $this->Html->url(array('controller' => 'Enterprisesolutions', 'action' => 'delete', 'prefix' => 'webadmin', $blog['Solution']['id'])); ?>" onclick="return confirm('Are you sure? You Want to Delete it.');"><img src="<?php echo $this->webroot; ?>images/cross.png" alt="cross_image"></a></td>

                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    <?php } else { ?>
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
                                        <th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>
                                        <th>Sr. No</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Job Title</th>
                                        <th>Company</th>
                                        <th>Employees</th>
                                        <!--<th>Notes</th>-->
                                        <th>Phone No.</th>
                                        <th>Type</th>
                                        <th>Status</th>
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
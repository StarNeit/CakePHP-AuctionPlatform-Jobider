<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Manage Clients</h3>
                    </header>
                    <div class="col-md-6">
                        <div class="btn-group">
<!--                            <a href="<?php //echo Router::url('/');    ?>webadmin/pages/add">
                                <button id="sample_editable_1_new" class=" btn btn-primary" type="button">
                                    Add New <i class="fa fa-plus"></i>
                                </button>
                           
                            </a>-->
                        </div>
                    </div>
                    <div class="panel-body">
                        <section id="unseen">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-lg-3 pull-right">
                                        <?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'employer')); ?>
                                        <div class="input-group">
                                            <input type="text" id="searchbar" class="form-control" name="data[User][search]">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary search_job" type="button">Go</button>
                                            </span>
                                        </div>
                                        <?php echo $this->Form->end(); ?>
                                    </div>
                                    <div class="col-lg-2 pull-left">
                                        <?php echo $this->Form->create('User', array('id' => 'frm1', 'url' => array('controller' => 'users', 'action' => 'changeselectall'))); ?>
                                        <div class="input-group">
                                            <select name="data[User][select]" class=" form-control selectPart">
                                                <option value="">Select</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th> Sign-up as</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (!empty($blog)) {

                                        $i = '1';
                                        foreach ($blog as $blog) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="data[User][type]" value="<?php echo $blog['User']['type']; ?>">
                                                    <input type="checkbox" name="data[User][chk1][]" value="<?php echo $blog['User']['id']; ?>" class="checkboxes"></td>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $blog['User']['first_name']; ?></td>
                                                <td><?php echo $blog['User']['last_name']; ?></td>
                                                <td><?php echo $blog['User']['email']; ?></td>
                                                <td><?php echo $blog['User']['type']; ?></td>
                                                <td><?php echo ucfirst($blog['User']['employer_type']); ?></td>
                                                <td>       <?php
                                                    if ($blog['User']['status'] == '1') {
                                                        echo $this->Html->link('Active', array('controller' => 'users', 'action' => 'change_status', 'prefix' => 'webadmin', $blog['User']['id']), array('class' => 'btn btn-primary'));
                                                        ?>
                                                        <?php
                                                    } else {
                                                        echo $this->Html->link('Inactive', array('controller' => 'users', 'action' => 'change_status', 'prefix' => 'webadmin', $blog['User']['id']), array('class' => 'btn btn-danger'));
                                                        ?>

                                                    <?php }
                                                    ?></td>
                                                <td><?php echo $this->Html->link($this->Html->image("/images/pencil.png", array("alt" => "Edit")), "edit/" . $blog['User']['id'] . "", array('escape' => false, 'title' => 'Edit User', 'class' => 'edit')); ?> 
                                                    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'delete', 'prefix' => 'webadmin', $blog['User']['id'])); ?>" onclick="return confirm('Are you sure? You Want to Delete it.');"><img src="<?php echo $this->webroot; ?>images/cross.png"></a></td>

                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>

                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="8">
                                                <?php if (isset($text) and !empty($text)) { ?>
                                                    <div class="alert alert-danger error-message">
                                                        <strong>Sorry!</strong> There is no data related to <strong><?php echo $text; ?></strong> right now.
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="alert alert-danger error-message" style="text-align:center">
                                                        <strong>No Record(s) Found !</strong> 
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type='checkbox' name='checkall' onclick='checkedAll(frm1);'>
                                        </th>
                                        <th>Sr. No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Sign-up as</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr> 
                                </tfoot>
                                <?php echo $this->Form->end(); ?>
                            </table>
                        </section>

                        <div class="pagi">
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
                alert('Please enter Search Kepword ! ')
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });

    });

</script>
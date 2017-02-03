<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Manage Faqs</h4>
                    </header>
                    <div class="col-md-6">
                        <div class="btn-group">
                            <a href="<?php echo Router::url('/'); ?>webadmin/faqs/add"><button id="sample_editable_1_new" class=" btn btn-primary" type="button">
                                    Add New <i class="fa fa-plus"></i>
                                </button></a>


                        </div>
                    </div>
                    <div class="panel-body">
                        <section id="unseen">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-lg-3 pull-right">
                                        <?php echo $this->Form->create('Faq', array('controller' => 'faqs', 'action' => 'index')); ?>

                                        <div class="input-group">
                                            <input type="text" id="searchbar" class="form-control" name="data[Faq][search]">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary search_job" type="button">Go</button>
                                            </span>
                                        </div><!-- /input-group -->
                                        <?php echo $this->Form->end(); ?>
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-lg-2 pull-left">
                                        <?php echo $this->Form->create('Faq', array('id' => 'frm1', 'url' => array('controller' => 'faqs', 'action' => 'changeselectall'))); ?>
                                        <div class="input-group">
                                            <select name="data[Faq][select]" class=" form-control selectPart">
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
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <!--<th>Status</th>-->
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
                                                <td><input type="checkbox" name="data[Faq][chk1][]" value="<?php echo $blog['Faq']['id']; ?>" class="checkboxes"></td>
                                                <td><?php echo $i; ?></td> 
                                                <td><?php echo $blog['Faq']['question']; ?></td>
                                                <td><?php echo substr($blog['Faq']['answer'], 0, 450); ?></td>
                                                <td>       <?php if ($blog['Faq']['status'] == '1') { ?>
                                                        <?php echo $this->Html->link('Active', array('controller' => 'faqs', 'action' => 'index', 'prefix' => 'webadmin', $blog['Faq']['id']), array('class' => 'btn btn-primary btnclick', 'id' => $blog['Faq']['id'], 'data-toggle' => 'modal', 'data-target' => '#myModal'));
                                                        ?>
                                                        <?php
                                                    } else {
                                                        echo $this->Html->link('Inactive', array('controller' => 'faqs', 'action' => 'index', 'prefix' => 'webadmin', $blog['Faq']['id']), array('class' => 'btn btn-danger btnclick', 'id' => $blog['Faq']['id'], 'data-toggle' => 'modal', 'data-target' => '#myModal'));
                                                        ?>
        <?php } ?></td>
                                                <td><?php echo $this->Html->link($this->Html->image("/images/pencil.png", array("alt" => "Edit")), "edit/" . $blog['Faq']['id'] . "", array('escape' => false, 'title' => 'Edit User', 'class' => 'edit')); ?> 
                                                    <a href="<?php echo $this->Html->url(array('controller' => 'faqs', 'action' => 'delete', 'prefix' => 'webadmin', $blog['Faq']['id'])); ?>" onclick="return confirm('Are you sure? You Want to Delete it.');"><img src="<?php echo $this->webroot; ?>images/cross.png" alt="cross image icon"></a></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
<?php } else { ?>
                                        <tr>
                                            <td colspan="8">
    <?php if (!empty($text)) { ?>
                                                    <div class="alert alert-danger">
                                                        <strong>Sorry!</strong> There is no data related to <strong><?php echo $text; ?></strong> right now.
                                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                    </div>
    <?php } else { ?>
                                                    <div class="alert alert-danger">
                                                        <strong>No Data Available In Table</strong> right now.
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
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <!--<th>Status</th>-->
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
    /*#cboxOverlay {
                    background: none repeat scroll 0 0 black;
                    opacity: 0.9;
    }*/

</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
                                            $(document).ready(function () {
                                                $('.val').click(function () {
                                                    if ($('.selectPart').val() === "") {
                                                        alert('Please select the bulk action');
                                                        return false;
                                                    }
                                                    if ($('.selectPart').val() == 'active') {
                                                        if ($('.checkboxes').is(':checked')) {
                                                            alert('Do you want to activate it?');
                                                        } else {
                                                            alert('Please select the action');
                                                            return false;
                                                        }
                                                    }
                                                    if ($('.selectPart').val() == 'inactive') {
                                                        if ($('.checkboxes').is(':checked')) {
                                                            alert('Do you want deactivate it?');
                                                        } else {
                                                            alert('Please select the action');
                                                            return false;
                                                        }
                                                    }
                                                    if ($('.selectPart').val() == 'delete') {
                                                        if ($('.checkboxes').is(':checked')) {
                                                            alert('Do you want delete it?');
                                                        } else {
                                                            alert('Please select the action');
                                                            return false;
                                                        }
                                                    }
                                                });
                                            });
</script>
//////////////////
<script>
    $(document).ready(function () {
        $(document).on('click', '.btnclick', function (event) {
            event.preventDefault();
            var select = $('.btnclick').attr('id');
            $.ajax({
                type: 'post',
                //	dataType:'json',
                url: '<?php echo $this->webroot; ?>webadmin/faqs/showdata',
                data: {select: select},
                success: function (response) {
                    //alert('response');
                    $('#myModal').html(response);
                }
            });
        });
    });

</script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<style>
    .col-lg-2.pull-left {
        margin-left: -106px;
    }
</style>
<script>
    $(document).ready(function () {
        $(document).on('click', '.search_job', function () {
            var search = $('#searchbar').val();
            if (search == '') {
                alert('Please enter search Keyword !');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });
    });

</script>



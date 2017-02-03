<style>
    .pull-right.manageed {
        margin-top: -34px;
    }
</style>
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading"> 

                        <h4><?php echo $title['Test']['title']; ?></h4>
                        <a class="pull-right manageed  btn btn-primary" href="<?php echo $this->webroot; ?>webadmin/tests"><i>
                                <img class="mrg_r5" src="<?php echo $this->webroot; ?>img/back.png" alt="BackIcon Image">
                            </i>
                            Back To Test Management</a>
                    </header>
                    <div class="col-md-6">
                        <div class="btn-group">
                            <a href="<?php echo Router::url('/'); ?>webadmin/tests/addtestcontents"><button id="sample_editable_1_new" class=" btn btn-primary" type="button">
                                    Add New <i class="fa fa-plus"></i>
                                </button></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <section id="unseen">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-lg-3 pull-right">
                                        <?php //pr($this->params);?>
                                        <?php echo $this->Form->create('Testcontent', array('url' => array('controller' => 'tests', 'action' => 'managetestcontent', $this->params['pass'][0]))); ?>
                                        <div class="input-group">
                                            <input type="text" id='searchbar' class="form-control" name="data[Testcontent][search]">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary search_job" type="button">Go</button>
                                            </span>
                                        </div><!-- /input-group -->
                                        <?php echo $this->Form->end(); ?>
                                    </div><!-- /.col-lg-6 -->
                                    <div class="col-lg-2 pull-left">
                                        <?php echo $this->Form->create('Testcontent', array('id' => 'frm1', 'url' => array('controller' => 'tests', 'action' => 'changeselectalltestcontent', $this->params['pass']['0']))); ?>
                                        <div class="input-group">
                                            <select name="data[Testcontent][select]" class=" form-control selectPart">
                                                <option value="">Select</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary val" type="submit">Go</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            &nbsp;
                            <?php echo $this->Session->flash(); ?>
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>
                                        <th>Sr. No</th>
                                        <th>Test content</th>
                                        <th>Creation Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($blog)) {
                                        $i = '1';
                                        foreach ($blog as $subcategory) {
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="data[Testcontent][chk1][]" value="<?php echo $subcategory['Testcontent']['id']; ?>" class="checkboxes"></td>
                                                <td><?php echo $i; ?></td> 
                                                <td><?php echo $subcategory['Testcontent']['test_content']; ?></td>

                                                <td><?php echo $subcategory['Testcontent']['modified']; ?></td> 
                                                <td>       <?php
                                                    if ($subcategory['Testcontent']['status'] == '1') {
                                                        echo $this->Html->link('Active', array('controller' => 'tests', 'action' => 'change_status_testcontent', 'prefix' => 'webadmin', $subcategory['Testcontent']['id']), array('class' => 'btn btn-primary btnclick', 'id' => $subcategory['Testcontent']['id'], 'data-toggle' => 'modal', 'data-target' => '#myModal'));
                                                        ?>
                                                        <?php
                                                    } else {
                                                        echo $this->Html->link('Inactive', array('controller' => 'tests', 'action' => 'change_status_testcontent', 'prefix' => 'webadmin', $subcategory['Testcontent']['id']), array('class' => 'btn btn-danger btnclick', 'id' => $subcategory['Testcontent']['id'], 'data-toggle' => 'modal', 'data-target' => '#myModal'));
                                                        ?>
                                                    <?php }
                                                    ?></td>
                                                <td><?php echo $this->Html->link($this->Html->image("/images/pencil.png", array("alt" => "Edit")), "edittestcontent/" . $subcategory['Testcontent']['id'] . "", array('escape' => false, 'title' => 'Edit User', 'class' => 'edit')); ?> 
                                                    <a href="<?php echo $this->Html->url(array('controller' => 'tests', 'action' => 'deletetestcontent', 'prefix' => 'webadmin', $subcategory['Testcontent']['id'])); ?>" onclick="return confirm('Are you sure? You Want to Delete it.');"><img src="<?php echo $this->webroot; ?>images/cross.png"></a></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="8">
                                                <div class="alert alert-danger">
                                                    <?php if (isset($text) and !empty($text)) { ?>
                                                        <strong>Sorry!</strong> There is no data related to    <strong><?php echo $text; ?></strong> right now.<?php } else { ?>
                                                        <strong>No Record(s) Found !</strong>  
                                                    <?php } ?>
                                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>
                                        <th>Sr. No</th>
                                        <th>Test content</th>
                                        <th>Creation Date</th>
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
                                                            alert('Do you want Deactivate it ?');
                                                        } else {
                                                            alert('Please select the action');
                                                            return false;
                                                        }
                                                    }
                                                    if ($('.selectPart').val() == 'delete') {
                                                        if ($('.checkboxes').is(':checked')) {
                                                            alert('Do you want Delete it ?');
                                                        } else {
                                                            alert('Please select the action');
                                                            return false;
                                                        }
                                                    }
                                                });
                                            });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.btnclick', function(event) {
            event.preventDefault();
            var select = $('.btnclick').attr('id');
            $.ajax({
                type: 'post',
                //dataType:'json',
                url: '<?php echo $this->webroot; ?>webadmin/tests/showdata',
                data: {select: select},
                success: function(response) {
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
$(document).ready(function() {
    $(document).on('click','.search_job',function(){
        var search = $('#searchbar').val();
        if(search==''){
            alert('Please enter search Keyword !');
            return false;
        }else{
            $('.search_job').attr('type','submit');
            return true;
        }
    });
});

</script>
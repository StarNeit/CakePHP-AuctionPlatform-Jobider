<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Manage Contact Us Details</h4>
                    </header>
                    <div class="col-md-6">
                    </div>
                    <div class="panel-body">
                        <section id="unseen"> 
                            <?php echo $this->Session->flash(); ?>
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-lg-3 pull-right">
                                        <?php echo $this->Form->create('Contact', array('url' => array('controller' => 'dashboard', 'action' => 'index'))); ?>
                                        <div class="input-group">
                                            <input type="text" id="searchbar" class="form-control" name="data[Contact][search]">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary search_job" type="button">Go</button>
                                            </span>
                                        </div>
                                        <?php echo $this->Form->end(); ?>
                                    </div>
                                    <div class="col-lg-2 pull-right">
                                    </div>
                                </div>
                            </div>
                            &nbsp;
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th >Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($blog as $message) { ?>
                                        <tr class="gradeX">
                                            <td> <input type="checkbox" name="chk1"> </td>
                                            <td><?php echo $message['Contact']['id']; ?></td>
                                            <td><?php echo $message['Contact']['name']; ?></td>
                                            <td><?php echo $message['Contact']['email']; ?></td>
                                         <td><?php echo $message['Contact']['message']; ?></td>
                                            <td><?php echo $message['Contact']['created'] ?></td>
                                            <td><a href="<?php echo $this->Html->url(array('controller' => 'dashboard', 'action' => 'reply', 'prefix' => 'webadmin', $message['Contact']['id'])); ?>"/><button class="btn btn-primary" type="button">Reply</button></a>  <a href="<?php echo $this->Html->url(array('controller' => 'dashboard', 'action' => 'delete', 'prefix' => 'webadmin', $message['Contact']['id'])); ?>" onclick="return confirm('Are you sure? You Want to Delete it.');"/><button class="btn btn-primary" type="button">Delete</button></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th><input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th >Created</th>
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
                                                            alert('Do you want to Activate ?');
                                                        } else {
                                                            alert('Please select the action');
                                                            return false;
                                                        }
                                                    }
                                                    if ($('.selectPart').val() == 'inactive') {
                                                        if ($('.checkboxes').is(':checked')) {
                                                            alert('Do you want to deactivate it ?');
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
      var search= $('#searchbar').val();
   if (search=='') {
    alert('Please Enter the Search keyword !');
    return false;
   } else {
    $('.search_job').attr('type', 'submit');
    return true;
   }
  });
 });

</script>
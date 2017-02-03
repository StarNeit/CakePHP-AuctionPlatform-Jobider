<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Manage Feedback Details</h4>

                    </header>
                    <div class="col-md-6">
                    </div>
                    <div class="panel-body">
                        <section id="unseen">
                            <?php echo $this->Session->flash(); ?>
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-lg-3 pull-right">
                                        <?php echo $this->Form->create('Feedback', array('url' => array('controller' => 'pages', 'action' => 'feedbackdetail'))); ?>
                                        <div class="input-group">
                                            <input type="text" id="searchbar" class="form-control" name="data[Feedback][search]">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary search_job" type="button">Go</button>
                                            </span>
                                        </div><!-- /input-group -->
                                        <?php echo $this->Form->end(); ?>
                                    </div><!-- /.col-lg-6 -->

                                    <div class="col-lg-2 pull-right">
                                    </div><!-- /.col-lg-6 -->
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
                                            <td><?php echo $message['Feedback']['id']; ?></td>
                                            <td><?php echo $message['Feedback']['name']; ?></td>
                                            <td><?php echo $message['Feedback']['email']; ?></td>
                                            <td><?php echo substr($message['Feedback']['comment'], 0, 50); ?></td>
                                            <td><?php echo $message['Feedback']['created'] ?></td>
                                            <td>  <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'reply', 'prefix' => 'webadmin', $message['Feedback']['id'])); ?>"><button class="btn btn-primary" type="button">Reply</button></a> &nbsp; <a href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'feedback_delete', 'prefix' => 'webadmin', $message['Feedback']['id'])); ?>" onclick="return confirm('Are you sure? You Want to Delete it.');"><button class="btn btn-primary" type="button">Delete</button></a>
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
                                                            alert('Are you sure? You want active it !');
                                                        } else {
                                                            alert('Please select the action');
                                                            return false;
                                                        }
                                                    }
                                                    if ($('.selectPart').val() == 'inactive') {
                                                        if ($('.checkboxes').is(':checked')) {
                                                            alert('Are you sure? You want deactive it !');
                                                        } else {
                                                            alert('Please select the action');
                                                            return false;
                                                        }
                                                    }
                                                    if ($('.selectPart').val() == 'delete') {
                                                        if ($('.checkboxes').is(':checked')) {
                                                            alert('Are you sure? You want delete it !');
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
  $(document).on('click', '.search_job', function() {
      var search = $('#searchbar').val();
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
 

<section id="main-content">
<section class="wrapper">
<div class="row">
<div class="col-sm-12">
 <section class="panel">
<header class="panel-heading">
 <h3>Manage Blogs</h3>
 </header>
 <div class="col-md-6">
<div class="btn-group">
  <a href="<?php echo Router::url('/'); ?>webadmin/abouts/add"><button id="sample_editable_1_new" class=" btn btn-primary" type="button">
 Add New <i class="fa fa-plus"></i>
     </button></a>
           </div>
         </div>
<div class="panel-body">
 <section id="unseen">
 <div class="table-toolbar">
    <div class="row">
<div class="col-lg-3 pull-right">
   <?php echo $this->Form->create('About', array('controller' => 'abouts', 'action' => 'index')); ?>
   <div class="input-group">
 <input type="text" class="form-control" name="data[About][search]">
 <span class="input-group-btn">
    <button class="btn btn-primary" type="submit">Go</button>
       </span>
          </div><!-- /input-group -->
  <?php echo $this->Form->end(); ?>
      </div><!-- /.col-lg-6 -->
  <div class="col-lg-2 pull-left">
     <?php echo $this->Form->create('About', array('id'=>'frm1','url'=>array('controller' => 'abouts', 'action' => 'changeselectall'))); ?>
    <div class="input-group">
<select name="data[About][select]" class=" form-control selectPart">
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
       <th> Name</th>
      <th>Title</th>
       <th>Description</th>
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
     <td><input type="checkbox" name="data[About][chk1][]" value="<?php echo $blog['About']['id']; ?>" class="checkboxes"></td>
       <td><?php echo $i; ?></td> 
       <td><?php echo $blog['About']['name'] ?></td>
       <td><?php echo $blog['About']['title']; ?></td>
         <td><?php echo substr($blog['About']['description'], 0, 200); ?></td>
<td>       <?php
      if ($blog['About']['status'] == '1') {
     echo $this->Html->link('Active', array('controller' => 'abouts', 'action' => 'change_status', 'prefix' => 'webadmin', $blog['About']['id']), array('class' => 'btn btn-primary'));
        ?>
     <?php
        } else {
        echo $this->Html->link('Inactive', array('controller' => 'abouts', 'action' => 'change_status', 'prefix' => 'webadmin', $blog['About']['id']), array('class' => 'btn btn-danger'));
    ?>
  <?php }
   ?></td>
  <td><?php echo $this->Html->link($this->Html->image("/images/pencil.png", array("alt" => "Edit")), "edit/" . $blog['About']['id'] . "", array('escape' => false, 'title' => 'Edit User', 'class' => 'edit')); ?> 
 <a href="<?php echo $this->Html->url(array('controller' => 'abouts', 'action' => 'delete', 'prefix' => 'webadmin', $blog['About']['id'])); ?>" onclick="return confirm('Are you sure? You Want to Delete it.');"><img src="<?php echo $this->webroot; ?>images/cross.png" alt="cross"></a></td>
 </tr>
    <?php
       $i++;
        }
       ?>
    <?php } else { ?>
   <tr>
  <td colspan="8">
 <div class="alert alert-danger">
  <strong>Sorry!</strong> There is no data related to <strong><?php echo $text; ?></strong> right now.
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
       <th> Name</th>
      <th>Title</th>
       <th>Description</th>
       <th>Status</th>
       <th>Action</th>
</tr> 
                                </tfoot>
                                <?php echo $this->Form->end(); ?>
                            </table>
                        </section>
                    </div>
<div class="container">
<div class="pagi col-md-7 col-md-offset-4">
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
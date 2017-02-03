<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Edit Job Sub Category</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Jobsubcategory', array('role' => 'form', 'url' => array('controller' => 'jobcategory', 'action' => 'editSubcategory',$user_data['Jobsubcategory']['id'])));
                            ?>
                            <div class="form-group">
                           <label for="exampleInputPassword1">Select Category</label>
<?php echo $this->Form->input('jobcategory_id', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array($data), 'empty' => 'Select The Category','default'=>$user_data['Jobsubcategory']['jobcategory_id'])); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
<?php echo $this->Form->input('jobsubcategory_name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'value'=>$user_data['Jobsubcategory']['jobsubcategory_name'],'label' => false)); ?>
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
<?php echo $this->Form->end(); ?>
                        </div>
                </section>
            </div>
        </div>
    </section>
</section>
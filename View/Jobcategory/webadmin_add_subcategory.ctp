<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Add Job Sub Category</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Jobsubcategory', array('role' => 'form', 'url' => array('controller' => 'jobcategory', 'action' => 'addSubcategory')));
                            ?>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Category</label>
                                <?php echo $this->Form->input('jobcategory_id', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'required' => false, 'options' => array($data), 'empty' => 'Select The Category')); ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <?php echo $this->Form->input('jobsubcategory_name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'required' => false,)); ?>
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
                            <?php echo $this->Form->end(); ?>
                        </div>
                </section>
            </div>
        </div>
    </section>
</section>


<style>
    .error-message {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 258px;
    }
</style>
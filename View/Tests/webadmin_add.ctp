<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Add Tests</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Test', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'tests', 'action' => 'add')));
                            ?>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Category</label>
                                <?php echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control', 'id' => 'exampleInputPassword1cat', 'label' => false, 'required' => false, 'options' => array($data), 'empty' => 'Select The Category')); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1t', 'label' => false, 'required' => false)); ?>    </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Test Type</label>
                                <?php echo $this->Form->input('test_type', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1test', 'label' => false, 'required' => false)); ?>

                            </div>
                            
<!--              <div class="form-group">
                                <label for="exampleInputPassword1">Question</label>
                                <?php //echo $this->Form->input('question', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1q', 'label' => false, 'required' => false)); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Answer</label>
                                <?php //echo $this->Form->input('editor1', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1a', 'label' => false, 'required' => false)); ?>

                            </div> -->
                            <button type="submit" class="btn btn-info">Submit</button>
                            <?php echo $this->Form->end(); ?>
                       </div>
                </section>

            </div>

        </div>
        <!-- page end-->
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






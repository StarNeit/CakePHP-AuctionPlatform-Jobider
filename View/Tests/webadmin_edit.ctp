<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Edit Tests</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Test', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'tests', 'action' => 'edit', $blog['Test']['id'])));
                            ?>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Category</label>
                                <?php echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array($data), 'default' => $blog['Test']['category_id'], 'empty' => 'Select The Category')); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Test']['title'])); ?> </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Test Type</label>
                                <?php echo $this->Form->input('test_type', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Test']['test_type'])); ?>
                            </div>

                            <div class="form-group">
                                <?php echo $this->Form->input('slug', array('type' => 'hidden', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Test']['slug'])); ?>
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <?php echo $this->Form->end(); ?>
                        </div>
                </section>

            </div>

        </div>

        <!-- page end-->
    </section>
</section>
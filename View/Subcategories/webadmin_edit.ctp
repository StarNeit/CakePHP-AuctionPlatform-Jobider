<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Edit Sub Category</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Subcategory', array('role' => 'form', 'url' => array('controller' => 'subcategories', 'action' => 'edit', $user_data['Subcategory']['id'])));
                            ?>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Category</label>
                                <?php
                                if (!empty($user_data['Category']['name'])) {
                                    // pr($user_data['Category']['name']); die;
                                    echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array('default' => $user_data['Category']['name'],$data), ));
                                    ?>
                                <?php } else {
                                    echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array($data), 'empty' => 'Select The Category'));
                                    ?>    
<?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
<?php echo $this->Form->input('category_name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $user_data['Subcategory']['category_name'])); ?>
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
<?php echo $this->Form->end(); ?>
                        </div>
                </section>
            </div>
        </div>
    </section>
</section>
<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Edit Categories</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Category', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'categories', 'action' => 'edit', $category['Category']['id'])));
                            ?>
                            <!--                                <form role="form">-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
<?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $category['Category']['name'])); ?>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>

<?php echo $this->Form->input('file', array('type' => 'file', 'id' => 'exampleInputFile', 'label' => false)); ?><br>
                                <img src="<?php echo $this->webroot; ?>uploads/<?php echo $category['Category']['image']; ?>" height="100" width="100" alt="categoryImage">

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
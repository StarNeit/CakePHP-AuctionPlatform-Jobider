<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4> Edit Pages </h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Page', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'pages', 'action' => 'edit', $blog['Page']['id'])));
                            ?>
                            <!--                                <form role="form">-->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'value' => $blog['Page']['name'])); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Page']['title'])); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <?php echo $this->Form->input('editor1', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Page']['description'])); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                
                                <?php echo $this->Form->input('file', array('type' => 'file', 'id' => 'exampleInputFile', 'label' => false)); ?><br>
                                <img src="<?php echo $this->webroot; ?>uploads/<?php echo $blog['Page']['image']; ?>" height="250" width="250">

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
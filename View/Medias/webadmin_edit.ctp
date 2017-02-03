<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>  Edit Media  </h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Media', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'medias', 'action' => 'edit', $blog['Media']['id'])));
                            ?>
                            <!--                                <form role="form">-->

       <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'value' => $blog['Media']['name'])); ?>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Media']['title'])); ?>

                            </div>

                     
                               <div class="form-group">
                                <label for="exampleInputEmail1">URL</label>
                                <?php echo $this->Form->input('url', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'value' => $blog['Media']['url'])); ?>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <?php echo $this->Form->input('editor1', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Media']['description'])); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>

                                <?php echo $this->Form->input('file', array('type' => 'file', 'id' => 'exampleInputFile', 'label' => false)); ?><br>
                                <img src="<?php echo $this->webroot; ?>uploads/<?php echo $blog['Media']['image']; ?>" height="100" width="100">

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
<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Add Pages</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Page', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'pages', 'action' => 'add')));
                            ?>
                            <!--                                <form role="form">-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1n', 'label' => false,'required'=>false)); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1t', 'label' => false,'required'=>false)); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <?php echo $this->Form->input('editor1', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1d', 'label' => false,'required'=>false)); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <?php echo $this->Form->input('image_name', array('type' => 'file', 'id' => 'exampleInputFileimg', 'label' => false,'required'=>false)); ?>
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

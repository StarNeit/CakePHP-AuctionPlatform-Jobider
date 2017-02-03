<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Edit Home Page content</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Banner', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'banners', 'action' => 'edit',$banner['Banner']['id'])));
                            ?>
                            <!--                                <form role="form">-->


                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
<?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail', 'label' => false, 'required'=>false,'value'=>$banner['Banner']['name'])); ?>

                            </div>
                            
                              <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
<?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1p', 'label' => false, 'required'=>false,'value'=>$banner['Banner']['title'])); ?>

                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Url</label>
<?php echo $this->Form->input('url', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1p', 'label' => false, 'required'=>false,'value'=>$banner['Banner']['url'])); ?>

                            </div>
                            
                              <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
<?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1p', 'label' => false, 'required'=>false,'value'=>$banner['Banner']['description'])); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <img  src="<?php echo $this->webroot; ?>uploads/<?php echo $banner['Banner']['image'];?>" alt="bannerimage">
<?php echo $this->Form->input('image_name', array('type' => 'file', 'id' => 'exampleInputPassword1im', 'label' => false, 'required'=>false)); ?>

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
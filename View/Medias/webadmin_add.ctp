<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Add Media</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Media', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'medias', 'action' => 'add')));
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
                                <label for="exampleInputPassword1">URL</label>
                                <?php echo $this->Form->input('url', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1n', 'label' => false,'required'=>false)); ?>

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
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>form-master/jquery.validate.js"></script>


<script type="text/javascript">


//        $("#MediaWebadminAddForm").validate({
//            rules: {
//                'data[Media][title]': {
//                    required: true,
//                },
//                'data[Media][name]': {
//                    required: true,
//                },
//                'data[Media][editor1]': {
//                    required: true,
//                },
//                'data[Media][image_name]':{
//                  required:true,  
//                },
//            },
//            messages: {
//                'data[Media][title]': {
//                    required: "Please enter title !",
//                },
//                'data[Media][name]': {
//                    required: "Please enter name !",
//                },
//                'data[Media][editor1]': {
//                    required: "Please enter confirm password",
//                },
//                'data[Media][image_name]':{
//                    required:"Please choose image !",
//                },
//            },
//        });
 
</script>


<style>
   .error-message {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 295px;
    }
</style>




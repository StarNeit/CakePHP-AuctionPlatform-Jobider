  <section id="main-content" class="">
        <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Add Pages
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <?php
                                echo $this->Session->flash();
                                echo $this->Form->create('About',array('enctype' => 'multipart/form-data','role'=>'form','url'=>array('controller'=>'abouts','action'=>'add'))); ?>
<!--                                <form role="form">-->
                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Name</label>
                                            <?php  echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','id'=>'exampleInputPassword1','label'=>false));?>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Title</label>
                                            <?php  echo $this->Form->input('title',array('type'=>'text','class'=>'form-control','id'=>'exampleInputPassword1','label'=>false));?>

                                </div>

    <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                            <?php  echo $this->Form->input('editor1',array('type'=>'textarea','class'=>'form-control ckeditor','id'=>'exampleInputPassword1','label'=>false));?>

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
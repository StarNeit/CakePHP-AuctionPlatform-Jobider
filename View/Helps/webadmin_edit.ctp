  <section id="main-content" class="">
        <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4>Edit Help content</h4>
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <?php
                                echo $this->Session->flash();
                                echo $this->Form->create('Help',array('enctype' => 'multipart/form-data','role'=>'form','url'=>array('controller'=>'helps','action'=>'edit',$faq['Help']['id']))); ?>
<!--                                <form role="form">-->
                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Name</label>
                                            <?php  echo $this->Form->input('title',array('type'=>'text','class'=>'form-control','id'=>'exampleInputPassword1','label'=>false,'value'=>$faq['Help']['title']));?>

                                </div>

                           

    <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                            <?php  echo $this->Form->input('editor1',array('type'=>'textarea','class'=>'form-control ckeditor','id'=>'exampleInputPassword1','label'=>false,'value'=>$faq['Help']['description']));?>

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
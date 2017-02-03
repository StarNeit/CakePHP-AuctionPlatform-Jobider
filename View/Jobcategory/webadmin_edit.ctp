  <section id="main-content" class="">
        <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4>Edit JobCategories</h4>
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <?php
                                echo $this->Session->flash();
                                echo $this->Form->create('Jobcategory',array('role'=>'form','url'=>array('controller'=>'jobcategory','action'=>'edit',$category['Jobcategory']['id']))); ?>
<!--                                <form role="form">-->
                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Name</label>
                                            <?php  echo $this->Form->input('category_name',array('type'=>'text','class'=>'form-control','id'=>'exampleInputPassword1','label'=>false,'value'=>$category['Jobcategory']['category_name']));?>

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
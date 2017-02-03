  <section id="main-content" class="">
        <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h3>Add Sub Category</h3>
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <?php
                                echo $this->Session->flash();
                                echo $this->Form->create('State',array('role'=>'form','url'=>array('controller'=>'subcategories','action'=>'add'))); ?>
   <div class="form-group">
             <label for="exampleInputPassword1">Select Category</label>
 <?php  echo $this->Form->input('country_id',array('type'=>'select','class'=>'form-control','label'=>false,'options'=>array($country),'empty'=>'Select The Country'));?>
</div>
                                
     <div class="form-group">
             <label for="exampleInputPassword1">Name</label>
 <?php  echo $this->Form->input('country_name',array('type'=>'text','class'=>'form-control','id'=>'exampleInputPassword1','label'=>false));?>
</div>
                                
  <button type="submit" class="btn btn-info">Submit</button>
                          <?php echo $this->Form->end(); ?>
</div>
</section>
 </div>
</div>
</section>
    </section>
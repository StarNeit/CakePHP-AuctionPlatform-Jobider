  <section id="main-content" class="">
        <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4>Edit Subskills</h4>
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <?php
                                echo $this->Session->flash();
                                echo $this->Form->create('Subskill',array('role'=>'form','url'=>array('controller'=>'subskills','action'=>'edit',$skill_data['Subskill']['id']))); ?>
   <div class="form-group">
             <label for="exampleInputPassword1">Select Category</label>
													<?php if(!empty($skill_data['Skill']['name'])){ ?>
 <?php  echo $this->Form->input('skill_id',array('type'=>'select','class'=>'form-control','label'=>false,'options'=>array($data),'default'=>$skill_data['Skill']['name']));?>
													<?php } else { ?>
	<?php  echo $this->Form->input('skill_id',array('type'=>'select','class'=>'form-control','label'=>false,'options'=>array($data),'empty'=>'Select The Skills'));?>
													<?php } ?>
</div>
                                
     <div class="form-group">
             <label for="exampleInputPassword1">Name</label>
 <?php  echo $this->Form->input('skill_name',array('type'=>'text','class'=>'form-control','id'=>'exampleInputPassword1','label'=>false,'value'=>$skill_data['Subskill']['skill_name']));?>
</div>
                                
  <button type="submit" class="btn btn-info">Submit</button>
                          <?php echo $this->Form->end(); ?>
</div>
</section>
 </div>
</div>
</section>
    </section>
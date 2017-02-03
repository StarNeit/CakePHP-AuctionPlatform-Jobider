<style>
    .error-message{
        color:red;
    }
</style>  


<section id="main-content" class="">
        <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4>Edit Skills</h4>
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <?php
                                echo $this->Session->flash();
                                echo $this->Form->create('Skill',array('role'=>'form','url'=>array('controller'=>'skills','action'=>'edit',$skill_value['Skill']['id']))); ?>
<!--                                <form role="form">-->

  
                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Name</label>
                                            <?php  echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','id'=>'exampleInputPassword1','label'=>false,'required'=>false,'value'=>$skill_value['Skill']['name']));?>

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
   <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
           
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h3>Edit User</h3>
                     </header>
                        <div class="panel-body">
                            <div class="form">
                                <?php echo $this->Form->create('User',array('class'=>'cmxform form-horizontal','id'=>'signupForm','url'=>array('controller'=>'users','action'=>'edit',$user['User']['id']))); ?>
<!--                                <form class="cmxform form-horizontal " id="signupForm" method="get" action="">-->
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Firstname</label>
                                        <div class="col-lg-6">
                                            <?php  echo $this->Form->input('first_name',array('class'=>'form-control','type'=>'text','label'=>false,'value'=>$user['User']['first_name']));?>
<!--                                            <input class=" form-control" id="firstname" name="firstname" type="text" />-->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Lastname</label>
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->input('last_name',array('class'=>'form-control','type'=>'text','label'=>false,'value'=>$user['User']['last_name'])); ?>
                                        </div>
                                    </div>
                                 <?php if(!empty($user['User']['username'])) {?>
                                    <div class="form-group ">
                                        <label for="username" class="control-label col-lg-3">Username</label>
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->input('username',array('class'=>'form-control','type'=>'text','label'=>false,'value'=>$user['User']['username'])); ?>
                                        </div>
                                    </div>
                                 <?php } else { ?>
                                 <?php } ?>
                                    <div class="form-group ">
                                        <label for="confirm_password" class="control-label col-lg-3">Email</label>
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->input('email',array('class'=>'form-control','type'=>'text','label'=>false,'value'=>$user['User']['email'])); ?>
<!--                                            <input class="form-control " id="confirm_password" name="confirm_password" type="password" />-->
                                        </div>
                                    </div>
                             <?php if(!empty($user['User']['reference_from'])){ ?>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Reference</label>
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->input('reference_from',array('class'=>'form-control','type'=>'text','label'=>false,'value'=>$user['User']['reference_from'])); ?>
<!--                                            <input class="form-control " id="email" name="email" type="email" />-->
                                        </div>
                                    </div>
                             <?php } ?>
                                    <div class="form-group ">
                                        <label for="agree" class="control-label col-lg-3 col-sm-3">Type</label>
                                    <div class="col-lg-6 col-sm-9">
                                        <?php echo $this->Form->input('type',array('class'=>'form-control','type'=>'text','label'=>false,'value'=>$user['User']['type'])); ?>
<!--                                            <input  type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="agree" />-->
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                    <?php echo $this->Html->link('Cancel',array('controller'=>'users','action'=>'index'),array('class'=>'btn btn-default')); ?>   
<!--                                            <button class="btn btn-default" type="button">Cancel</button>-->
                                        </div>
                                    </div>
                          <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
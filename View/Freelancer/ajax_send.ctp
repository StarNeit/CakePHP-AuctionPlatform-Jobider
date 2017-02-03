<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header green">
        <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h3 id="myModalLabel" class="modal-title">Send Message</h3>
      </div>
      
        <?php echo $this->Form->create('Message',array('class'=>'form-horizontal','url'=>array('controller'=>'freelancer','action'=>'send_message'))); ?>
      <div class="modal-body send_mess">
        
<!--        <form class="form-horizontal">-->
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">To</label>
    <div class="col-sm-10">
        <?php  if(!empty($users['User']['image'])){?>
      <img src="<?php echo $this->webroot;?>uploads/<?php echo $users['User']['image']; ?>" class="img-responsive" />
        <?php } else { ?>
      <img src="<?php echo $this->webroot;?>img/user_1.png" class="img-responsive" />
        <?php } ?>
      <b> <?php echo $users['User']['first_name'].' '.$users['User']['last_name']; ?> </b>
      <p> <?php echo $users['User']['job_title']; ?> </p>
      <input type='hidden' name='data[Message][reciever]' value='<?php  echo $users['User']['id']; ?>' >
      <input type='hidden' name='data[Message][sender]' value='<?php  echo $reciever; ?>' >
      <input type='hidden' name='data[Message][job_id]' value='<?php echo $job; ?>' >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Message</label>
    <div class="col-sm-8">
        <?php  echo $this->Form->input('reply',array('type'=>'textarea','class'=>'form-control','rows'=>'3','label'=>false));?>
<!--      <textarea class="form-control" rows="3"></textarea>-->
    </div>
  </div>
  
      <div class="row">  
      <div class="col-md-8 col-md-offset-2 new_send">
      
      </div>
      </div>      
      </div>           
      <div class="modal-footer">
      <button type="submit" class="btn btn-danger btn_red3 marg_tb15">Save</button>
      <button type="button" class="btn btn-danger btn_red3" data-dismiss="modal">Cancel</button>
        
      </div>
        <?php echo $this->Form->end(); ?>
    </div>
  </div>
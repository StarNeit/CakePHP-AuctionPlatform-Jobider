<div class="container marg_tb50">
    
    <h2 class="text-center marg_btm30">Forgot Password</h2>
    
    
    <div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
         
        <?php echo $this->Session->flash();
        echo $this->Form->create('User',array('class'=>'formstyle form_sighn brder_blck  padd_30','role'=>'form','url'=>array('controller'=>'login','action'=>'forgetpassword'))); ?>
<!--         <form role="form" class="formstyle form_sighn brder_blck  padd_30">-->
        <div class="col-md-12 col-sm-12">
        <div class="form-group">
 <?php  echo $this->Form->input('email',array('type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'placeholder'=>'Email','id'=>'user'));?>
<!--          <input type="text" placeholder="Username" class="form-control" id="exampleInputEmail1">-->
        </div> </div>
    
   
         
            <div class="col-md-6  pull-left">
 <button type="submit" class="btn btn-sm  btn_red btn_red12 ">Submit</button> </div> 
     
    
    <div class="clearfix"></div>
 </form>
         
         
         
    </div>
    </div>
    
</div>
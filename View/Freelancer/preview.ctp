

<?php
//pr($this->params);
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'postajob')) {
    $postajob = 'active';
} else {
    $postajob = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'searchfreelancer')) {
    $searchfreelancer = 'active';
} else {
    $searchfreelancer = '';
}
?> 


<div class="container">
 
 <div class="row marg_tb15">
 
   <?php echo $this->element('freelancer_dashboard'); ?>
   
   <div class="col-md-9 col-sm-9  pad_r0 ">
      
      <div class="bg_white">
        
        <div class="green">
        
         Post a Job > Preview
    
   </div>
    
   
         <?php
                echo $this->Session->flash();
                echo $this->Form->create('Job', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'role' => 'form', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'freelancer', 'action' => 'preview')));
                ?>
        <div class="col-md-9 col-sm-6">
        <div class="form-group">
        <label>Category &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<?php if(isset($category_data['Category']['name']) and isset($subcategory_data['Subcategory']['category_name'])){ ?>				
 <?php echo $category_data['Category']['name']; ?> -> <?php echo $subcategory_data['Subcategory']['category_name']; ?>
				<?php } ?>
                                   
       
        </div> </div>
							<div class="clearfix"></div>
        <div class="col-md-9 col-sm-6">
        <div class="form-group">
        <label>Job Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<?php  if(isset($post_data['Job']['job_title'])){?>
          <?php echo $post_data['Job']['job_title']; ?>
								<?php } ?>
        </div> </div>
							<div class="clearfix"></div>
      <div class="col-md-9 col-sm-6">
        <div class="form-group">
									<label>Budget &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<?php if(isset($post_data['Job']['budget'])) {?>
        <?php echo $post_data['Job']['budget']; ?>
									<?php } ?>
          </div>
      </div>
							<div class="clearfix"></div>
         <div class="col-md-9 col-sm-6">
        <div class="form-group">
  <label>Start Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		<?php  if(isset($post_data['Job']['start_date'])){ ?>
         <?php echo $post_data['Job']['start_date']; ?>
		<?php } ?>
          </div> </div>
							<div class="clearfix"></div>
           <div class="col-md-6 col-sm-6">
        <div class="form-group">
									<label>Duration &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</label>
									<?php  if(isset($post_data['Job']['duration'])) {?>
   <?php echo $post_data['Job']['duration']; ?>
									<?php } ?>
        </div>
      </div>
							<div class="clearfix"></div>
      <div class="col-md-9 col-sm-6">
        <div class="form-group">
            <label>Attachment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
												<?php  if(isset($post_data['Job']['image'])){ ?>
 <img src="<?php  echo $this->webroot;?>uploads/<?php echo $post_data['Job']['image']; ?>" width="100" hieght="100">
												<?php } ?>
</div>
      </div>
							<div class="clearfix"></div>
      <div class="col-md-9 col-sm-6">
        <div class="form-group">
            <label> Description  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
												 <?php if(isset($post_data['Job']['description'])){ ?>
    <p style="text-align:justify;"><?php echo $post_data['Job']['description']; ?></p>
													<?php } ?>
</div>
      </div>
							<div class="clearfix"></div>
 <div class="col-md-9 col-sm-6">
        <div class="form-group">
									<label> Skills &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<?php if(isset($post_data['Job']['skills']))  { ?>
               <p style='text-align:justify;'><?php echo $post_data['Job']['skills']; ?></p>
									<?php } ?>
								</div>
      </div>
     
      <div class="col-md-12 marg_tb50 text-center">
          
          <button class="btn-lg btn-green col-md-2 col-sm-2 col-xs-2 pull-left " type="submit" name='add' value="add">Post</button>
            
          <button class="btn-lg btn-green col-md-2 col-sm-2 col-md-offset-3 col-xs-2" type="submit" name='change' value="change">Changes</button>
            
          <button class="btn-lg btn-green col-md-2 col-sm-3 col-xs-2 pull-right " onClick='this.form.reset();' type="button">Cancel</button>
      
      </div>

      
      
      
<?php echo $this->Form->end(); ?>



 <div class="clearfix"></div>
     </div>
  
   
               </div>
               
        
      </div>
      
   </div>
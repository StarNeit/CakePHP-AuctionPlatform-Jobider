<div class="container">
 
 <div class="row marg_tb15">
 
 <div class="col-md-12">
    <p><i><img src="<?php echo $this->webroot; ?>img/back.png" alt="Back to search Result" class="mrg_r5"/></i><a href="<?php echo $last_url; ?>" class="font_18">Back to search result</a></p>
   </div>
   <div class="col-md-8 col-sm-8 job_detail">
      
     <div class="bg_grey2">
         
         <h3 class="marg_0"><?php  echo $jobdata['Job']['job_title'];?> </h3>
         <h4 class="marg_btm30">Est. Budget : <?php echo $jobdata['Job']['budget'].';00'; ?> <small class="marg_l20"> Posted 2 Hours 30 Minutes ago</small></h4>
         
         <h5 class="marg_0">Skills required</h5>
									<?php  foreach($subskill as $val){?>
       <button type="button" class="btn btn-danger btn_red3 marg_tb15"><?php echo $val['Subskill']['skill_name']; ?></button>
									<?php } ?>
        
         
         <div class="clearfix"></div>
     </div>
     
     <h3>Job Description  </h3>
     
     <p>Hello,
     <br/><?php  echo $jobdata['Job']['description'];?>
     
     <br/>
  
   
   
               </div>
               
       <div class="col-md-4 col-sm-4 pad_r0">
                 
              
          
        
          <div class="panel panel-default green_bg1">
  <div class="panel-heading">Job Overview </div>
  <div class="panel-body bg_grey1 padd_0 bg_content">
         
       <div class="col-md-6">
       Budget</div><div class="col-md-6"> <?php  echo $jobdata['Job']['budget'],'.00';?></div>
                
       <div class="col-md-6">
        Posted </div><div class="col-md-6"><?php  echo $date=date('F d Y,h:i A',strtotime($jobdata['Job']['created'])); ?></div>
                
       <div class="col-md-6">
         Planned Start </div><div class="col-md-6"><?php echo $date=date('F d y',strtotime($jobdata['Job']['start_date'])); ?></div>
                
       <div class="col-md-6">
      Duration 
 </div><div class="col-md-6"><?php echo $jobdata['Job']['duration']; ?></div>

 <div class="col-md-6">
      
      Category </div><div class="col-md-6"> <?php echo $category['Category']['name']; ?></div>
 <div class="col-md-6">
            Sub-category </div><div class="col-md-6"> <?php echo $sub['Subcategory']['category_name']; ?></div>
 

       
       
  </div>
</div>

<div class="panel panel-default green_bg1">
  <div class="panel-heading">About the client </div>
  
  
  <div class="panel-body bg_grey1 padd_0 bg_content">
         
         <div class="col-md-5">
            <ul class="list-inline marg_0">
              
              <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star image icon"/></li>
              <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
              <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
              <li ><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
              <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
              
            </ul>
            <span>(5.00) 4 reviews</span>
         </div>
         
         <div class="col-md-7 font_16">
            
            <i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/location1.png" alt="location image icon"/></i>United States (UTC - 06)
            
         </div>
         <div class="clearfix"></div>
         
         <span class="col-md-12 padd_tb15 font_16 text-muted">Member since May 12 2012</span>
         
       <div class="col-md-6">
      Total Spent</div><div class="col-md-6">Over $10,000</div>
                
       <div class="col-md-6">
      Jobs Posted </div><div class="col-md-6"> 159</div>
                
       <div class="col-md-6">
       Hires </div><div class="col-md-6">129</div>
                
       <div class="col-md-6">
    Open Jobs</div><div class="col-md-6">6</div>

 
 
 

       
       
  </div>
</div>
                 
               </div> 
      </div>
      
   </div>
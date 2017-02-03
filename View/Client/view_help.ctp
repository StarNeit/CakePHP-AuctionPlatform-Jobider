<div class="container">
 
    <?php if(!empty($faqs)){ ?>
 <div class="row marg_tb15">
 
   <div class="col-md-3 pad_l0 col-sm-3">
        
       <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="active"><a href="<?php echo $this->webroot; ?>client/dashboardHelp"> Help </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/client_Dispute">  Dispute </a></li>
                    </ul>
                </div>
            </div> 

<?php echo $this->element('client_notification'); ?>


        
   </div>
   
   <div class="col-md-9 col-sm-9  pad_r0 ">
     <div class="bg_white">
        
        <div class="green"> <?php  echo $faqs['Faq']['question']; ?> </div>
         <div class="col-md-12">
          <div class="basic">
           <h5>  Basic </h5>
     <p> <?php  echo $faqs['Faq']['title'];?> </p>
            
           </div>
        <div class="basic" style="border-bottom:0px;">
           <h5>  Details </h5>
          
           <p> <?php echo $faqs['Faq']['answer']; ?> </p>
            
           </div>
      </div>

      <div class="clearfix"> </div>
     </div>
    </div>
   </div>  
    <?php } else { ?>
     <div class="row marg_tb15">
        <p style="color: #C7CBD6; font-size: 20px; padding: 100px; text-align: center"><strong>Sorry</strong>, No Data Found</p>
    </div>
    <?php } ?>
  </div>
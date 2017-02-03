<div class="container">
 
 <div class="row marg_tb15">

   <div class="col-md-12 col-sm-8">
   
   
      <div  style=" height: 221px;"class="bg_white">
        
        
        
        <div class="green">
Confirmation
    
   </div>
   
   <div class="col-md-12">
   <p class="" style="margin-top:15px">
       <?php
       if($request['Withdrawrequest']['request_status']=='accepted'){
           ?>        
     Your Payment request for withdraw has been approved by client.
   </p>
    <h5 class="text_2 marg_tb15">This Payment method will become active in 3 days.</h5>
       <?php
           
       }else{
             ?>
         
     Your Payment request for withdraw has been declined by client.
   
   
   </p>
  
       <?php
       }
       ?>
     
   
    
    
     </div>
     
     <div class="clearfix"></div>
   
     </div>
   
               </div>
               
        
      </div>
      
   </div>
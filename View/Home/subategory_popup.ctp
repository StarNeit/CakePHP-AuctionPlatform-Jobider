 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header green">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $category['Category']['name']; ?></h4>
      </div>
      <div class="modal-body">
       
      
									<?php echo $this->Form->create('Freecategory',array('role'=>'form','url'=>array('controller'=>'home','action'=>'freelancer_category'))); ?>
        <div class="row">
         
         <div class="col-md-4 col-sm-4">
             
             <h3 class="marg_0">Select The  Sub Categories Form <?php echo $category['Category']['name']; ?></h3>
            
            <p>
             <?php  foreach($subcategory as $value){?>
               <div class="checkbox">
    <label>
      <input type="checkbox" name="data[Freecategory][category_value]" value='<?php echo $value['Subcategory']['id']; ?>'> <?php  echo $value['Subcategory']['category_name'];?>
    </label>
  </div>
 
													<?php } ?>
            
            </p>
               
             
            
            
         </div>
         
  
        </div>
     
     <?php echo $this->Form->end(); ?>
        
      </div>
      <div class="modal-footer">
      <p class=" text-center">
        <button type="button" class="btn btn_red font_18 col-md-1 col-md-offset-4 ">SAVE</button>
        <button type="button" class="btn btn_red font_18  col-md-1 marg_l20  " data-dismiss="modal">CANCEL</button>
        <div class="clearfix"></div>
      </p>
      </div>
    </div>
  	</div>
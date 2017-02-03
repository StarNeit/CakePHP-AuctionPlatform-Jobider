<div class="modal-dialog">
    <?php  echo $this->Form->create('Usercategory',array('role'=>'form'));?>
    <div class="modal-content">
      <div class="modal-header green">
        <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 id="myModalLabel" class="modal-title">Which categories best fit your skills?</h4>
      </div>
      <div class="modal-body">
        <h5 class="marg_0">Select 10 categories that match your professional experience. Choosing carefully helps clients to find you in the marketplace.
</h5>
        <p class="text_1">You have 0 categories remaining to select.</p>
     
            
        <div class="row">
            <?php foreach($category as $v){ ?>
         
         <div class="col-md-4 col-sm-4">
             
             <h3><?php echo $v['Category']['name']; ?></h3>
            
            <p>
                <?php  foreach($v['Subcategory'] as $kk=>$vv){
                    $key_new=$v['Subcategory'][$kk]['id'];
                    $val_new=$v['Subcategory'][$kk]['category_name'];
                    $val_id=$v['Subcategory'][$kk]['category_id'];
                    foreach($subcategory as $key=>$value){
                    if($vv['id']==$value['Subcategory']['id']){    
                    
                            ?>
                <div class="checkbox">
    <label>
      <input type='hidden' name='data[Usercategory][category_id][]' value='<?php echo $val_id; ?>' class='category'>
      <input type="checkbox" name="data[Usercategory][categories][]" value="<?php echo $key_new ?>" class="check_values" checked=""> <?php  echo $val_new;?>
    </label>
  </div>
                <?php }else{ ?>
                <?php } ?>
               </p>
            
  

                    <?php } ?>
               <div class="checkbox">
    <label>
      <input type='hidden' name='data[Usercategory][category_id][]' value='<?php echo $val_id; ?>' class='categories' disabled='disabled'>
      <input type="checkbox" name="data[Usercategory][categories][]" value="<?php echo $key_new ?>" class="check_valuess"> <?php  echo $val_new;?>
    </label>
  </div>
                <?php } ?>
            
            <p></p>
               
             
            
            
         </div>
       
            <?php } ?>
        </div>
        
        
        
      </div>
      <div class="modal-footer">
      <p class=" text-center">
        <button class="btn btn_red font_18 col-md-1 col-md-offset-4 " type="button" id="savecategory">SAVE</button>
        <button data-dismiss="modal" class="btn btn_red font_18  col-md-1 marg_l20  " type="button">CANCEL</button>
        </p><div class="clearfix"></div>
      <p></p>
      </div>
    </div>
    <?php echo $this->Form->end(); ?>
  </div>
<script>
    $(function(){
       $('.check_valuess').click(function(){
          $(this).prev().removeAttr('disabled'); 
       }); 
       var save_data=$('#UsercategoryEditCategoryForm');
       $('#savecategory').click(function(){
          $.ajax({
             type:'post',
             dataType:'json',
             url:'<?php  echo $this->base;?>/freelancer/save_editcategory',
             data:save_data.serialize(),
             success:function(msg){
                 if(msg.suc=='yes'){
                     $('#category').html(msg.category);
                     $('.fade').removeClass('in');
                 }
             }
          }); 
       });
    });
    </script>

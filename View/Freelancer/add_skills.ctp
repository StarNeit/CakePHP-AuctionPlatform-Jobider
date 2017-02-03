<div class="modal-dialog">
   
    <div class="modal-content" id='add_skl'>
         <?php echo $this->Form->create('Dataskill',array('role'=>'form')); ?>
      <div class="modal-header green">
        <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 id="myModalLabel" class="modal-title">Choose Skills</h4>
      </div>
      <div class="modal-body">
        <h5 class="marg_0">Ther are skills that you may choose.</h5>
        <p class="text_1">You have 0 skills remaining to select.</p>
        <!--<form role="form">-->           
            
         <div class="row">
             <?php  foreach ($skill_data as $key => $value) {?>
         
         <div class="col-md-4 col-sm-4">
             
             <h3><?php  echo $value['Skill']['name'];?></h3>
            
            <p>
                <?php foreach($value['Subskill'] as $k=>$v){
                    $key_new=$value['Subskill'][$k]['id'];
                    $val_new=$value['Subskill'][$k]['skill_name'];
                    $val_id=$value['Subskill'][$k]['skill_id'];
                    
                    ?>
                
                 <div class="checkbox">
    <label>
         <input type='hidden' name='data[Dataskill][skill_id][]' value='<?php echo $val_id; ?>' class='skill' disabled='disabled'>
      <input type="checkbox" name="data[Dataskill][subskill_id][]" value='<?php  echo $key_new; ?>' class="check_val" > <?php  echo $val_new;?>
      <input type="hidden" id="skill_id">
     <input type="hidden" id="subskill_id">
    </label>
  </div>
  
  
                <?php } ?>
           
               </p>
           
  

            
<!--            <p></p>-->
               
             
            
            
         </div>
         
           <?php } ?>
        </div>
        
         
      
<!--        </form>        -->
      </div>
      <div class="modal-footer">
      <p class=" text-center">
        <button class="btn btn_red font_18 col-md-1 col-md-offset-4 " type="button" id="saveskill">SAVE</button>
        <button data-dismiss="modal" class="btn btn_red font_18  col-md-1 marg_l20  " type="button">CANCEL</button>
        </p><div class="clearfix"></div>
      <p></p>
      </div>
    </div>
    <?php echo $this->Form->end(); ?>
  </div>

<script>
    
            
   $(function(){
      $('.check_val').click(function(){
          
       var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
          $(this).next().next().val(val);
         });
        $(this).prev().removeAttr('disabled');
         var skill_id = $(this).prev().val();
         $(this).next().val(skill_id);
      
      });
      var save_data=$('#DataskillAddSkillsForm');
      $('#saveskill').click(function(){
          
              $.ajax({
             type:'post',
             dataType:'json',
             url:'<?php echo $this->base; ?>/freelancer/save_skills',
             data:save_data.serialize(),
             success:function(msg){
                 if(msg.suc=='y'){
                     
                     $('#skills').append(msg.skill_data);
                     $('.btn_skill').html('add more');
                    $('.fade').removeClass('in');
                    $('#add_skl').hide();
                 }
             }
          });
      });
     
      
      
    });
    </script>

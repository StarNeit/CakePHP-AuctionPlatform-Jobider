
<div class="modal-dialog">
    
    <div class="modal-content" id='edit_skill'>
        <?php echo $this->Form->create('Dataskill',array('role'=>'form')); ?>
        <div class="modal-header green">
            <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 id="myModalLabel" class="modal-title">Choose Skills</h4>
        </div>
        <div class="modal-body">
            <h5 class="marg_0">Ther are skills that you may choose.</h5>
            <p class="text_1">You have 0 skills remaining to select.
            
           
            </p>
            
                <div class="row">
         <?php  
       
         foreach($skill_data as $v){?>
                    <div class="col-md-4 col-sm-4">

                        <h3><?php echo $v['Skill']['name']; ?></h3>

                        <p>
                <?php 
          
                foreach($v['Subskill'] as $key=>$value){
                    $key_new=$v['Subskill'][$key]['id'];
                    $val_new=$v['Subskill'][$key]['skill_name'];
                    $val_id=$v['Subskill'][$key]['skill_id'];
                    foreach ($subskill as $keys => $values) {
                        if($value['id']==$values['Subskill']['id']){
                            ?>
                             <div class="checkbox" id='vals<?php echo $key_new;?>'>
                            <label>
                                <input type='hidden' name='data[Dataskill][skill_id][]' value='<?php echo $val_id; ?>' class='skills'>

                                <input checked type="checkbox" name="data[Dataskill][subskill_id][]" value='<?php  echo $key_new; ?>' class="check_val" ><?php  echo $val_new;?>


                                <input type="hidden" id="skill_id">
                                <input type="hidden" id="subskill_id">
                            </label>
                        </div>
                        <?php } ?>
                <?php    
}

?>  
                        <div class="checkbox" id='val<?php echo $key_new; ?>'>
                            <label>
                                <input type='hidden' name='data[Dataskill][skill_id][]' value='<?php echo $val_id; ?>' class='skills'>

                                <input  type="checkbox" name="data[Dataskill][subskill_id][]" value='<?php  echo $key_new; ?>' class="check_val" ><?php  echo $val_new;?>


                                <input type="hidden" id="skill_id">
                                <input type="hidden" id="subskill_id">
                            </label>
                        </div>
                        
                        <?php

                 } ?>
                        
</p>



                    </div>

         <?php } ?>
                </div>


                </div>
        <div class="modal-footer">
            <p class=" text-center">
                <button class="btn btn_red font_18 col-md-1 col-md-offset-4 " type="button" id="editskill">SAVE</button>
                <button data-dismiss="modal" class="btn btn_red font_18  col-md-1 marg_l20  " type="button">CANCEL</button>
            </p><div class="clearfix"></div>
            <p></p>
        </div>
    </div>
    <?php  echo $this->Form->end();?>
</div>

<script>
    $(function(){
      $('.check_vals').click(function(){
         // alert('dkfk');
       var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
          $(this).next().next().val(val);
         });
        $(this).prev().removeAttr('disabled');
         var skill_id = $(this).prev().val();
         $(this).next().val(skill_id);
       //alert(skill_id);
      });
    
    var edit_data=$('#DataskillEditSkillsForm');
    $('#editskill').click(function(){
       $.ajax({
          type:'post',
          dataType:'json',
          url:'<?php  echo $this->base;?>/freelancer/save_editskills',
          data:edit_data.serialize(),
          success:function(msg){
              if(msg.suc=='yes'){
                    $('#skills').html(msg.skill_data);
                   $('.fade').removeClass('in');
                   $('#edit_skill').hide();
              }
          }
       }); 
    });
    });
    </script>
    
    <>
<div class="container">
 
 <div class="row marg_tb15">
 
   <div class="col-md-3 pad_l0 col-sm-3">
        
       <?php echo $this->element('client_profile_sideber'); ?>
       <?php echo $this->element('client_notification'); ?>

 </div>
   
   <div class="col-md-9 col-sm-9  pad_r0 ">
     <div class="bg_white">
      <div class="bg_white">
        
        <div class="green"> Edit Profile </div>
    
     <?php echo $this->Session->flash(); ?>
									<?php echo $this->Form->create('User',array('class'=>'formstyle form_sighn form_style2 marg_tb15','role'=>'form','enctype'=>'multipart/form-data','url'=>array('controller'=>'client','action'=>'editprofile',$userdata['User']['id']))); ?>
        <div class="col-md-6 col-sm-6">
        <div class="form-group">
        <label> First Name </label>
        <?php echo $this->Form->input('first_name',array('type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'required'=>false,'value'=>$userdata['User']['first_name'])); ?>
        </div> </div>
        
        <div class="col-md-6 col-sm-6">
        <div class="form-group">
        <label> Lsat Name </label>
        <?php echo $this->Form->input('last_name',array('type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'required'=>false,'value'=>$userdata['User']['last_name'])); ?>
        </div> </div>
    
      <div class="col-md-6 col-sm-6">
        <div class="form-group">
          <label>E-mail</label>
           <?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'required'=>false,'value'=>$userdata['User']['email'])); ?>
        </div>
      </div>
      
         <div class="col-md-6 col-sm-6">
        <div class="form-group">
         <label> Phone </label>
          <?php echo $this->Form->input('phone',array('type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'required'=>false,'value'=>$userdata['User']['phone'])); ?>
         </div> </div>
         
         
           <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label>Time Zone </label>
             <div classdatepicker="input-group">

                    <?php echo $this->Form->input('timezone', array('required' => FALSE, 'placeholder' => '', 'type' => 'select', 'label' => false, 'class' => 'col-md-11', 'options' => $timezone, 'align' => 'center', 'empty' => 'Select your Time Zone','value'=>$userdata['User']['timezone'])) ?> 
<?php //echo $this->Form->input('timezone',array('type'=>'text','class'=>'col-md-11','id'=>'datepicker1','label'=>false,'required'=>false,'value'=>$userdata['User']['timezone'])); ?>
            </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label> Company Name </label>
             												<?php if(!empty($userdata['User']['company'])) {?>
            	<?php echo $this->Form->input('company',array('type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'required'=>false,'value'=>$userdata['User']['company'])); ?>
												<?php } else { ?>
												<?php echo $this->Form->input('company',array('type'=>'text','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'required'=>false)); ?>
												<?php } ?>
        </div>
      </div>
      
      
        
 <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label> Upload Photo </label>
            <div class="clearfix"></div>
            <div class="row"> 
             <div class="col-md-3">
              <div class="user_imgbox">
               <img alt="image" src="<?php echo $this->webroot; ?>uploads/<?php echo $userdata['User']['image']; ?>" hieght="50" width="69" id="uploadFile">
              </div>
            </div>
       <div class="col-md-4">
        <div class="fileUpload1 btn btn-primary input-group-addon">
									<?php echo $this->Form->input('pro_img',array('type'=>'file','class'=>'upload','id'=>'uploadBtn','label'=>false,'required'=>false)); ?>
          <span>Browse</span>
       </div>
      </div>
      </div>
      </div>
        </div>
        
                 
           <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <label>Country </label>
             <div classdatepicker="input-group">
                    <?php if(!empty($country_value)){ ?>
                    <?php echo $this->Form->input('timezone', array('required' => FALSE, 'placeholder' => '', 'type' => 'select', 'label' => false, 'class' => 'col-md-11', 'options' => $country, 'align' => 'center', 'empty' => 'Select your Country','value'=>$country_value['Country']['name'])) ?> 
                    <?php } else { ?>
                    <?php echo $this->Form->input('country_id', array('required' => FALSE, 'placeholder' => '', 'type' => 'select', 'label' => false, 'class' => 'col-md-11', 'options' => $country, 'align' => 'center', 'empty' => 'Select your Country')) ?> 
                    <?php } ?>

            </div>
        </div>
      </div>
        
        
   <div class="col-md-12 col-sm-12">
        <div class="form-group marg_0">
            <label>Description</label>
              												<?php  if(!empty($userdata['User']['description'])){?>
             <?php echo $this->Form->input('description',array('type'=>'textarea','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'required'=>false,'value'=>$userdata['User']['description'])); ?>
												<?php } else { ?>
												 <?php echo $this->Form->input('description',array('type'=>'textarea','class'=>'form-control','id'=>'exampleInputEmail1','label'=>false,'required'=>false,'rows'=>'5')); ?>
												<?php } ?>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <div class="form-group marg_0">
            <label>Skills Required (Optional)</label>
            												<?php if(!empty($userdata['User']['skills'])){ ?>
              <?php echo $this->Form->input('skills', array('type' => 'text', 'class' => ' form-control', 'id' => 'tags_3', 'label' => false, 'required' => false,'value'=>$userskill)); ?>
												<?php } else { ?>
											<?php echo $this->Form->input('skills', array('type' => 'text', 'class' => ' form-control', 'id' => 'tags_3', 'label' => false, 'required' => false)); ?>
												<?php } ?>
      </div>
      
      <div class="col-md-12 marg_tb50 text-center">
          <p>
          <button class="btn-lg btn-green1" type="submit"> Save </button>
         </p>
      </div>

      
      
      
 



 <div class="clearfix"></div>
     </div>
   <?php  echo $this->Form->end();?>
  
   
               </div>
    <div class="clearfix"> </div> </div>          
        
      </div>
      
   </div>
  
 </div>
</div>
<?php echo $this->Html->css('jquery.tagsinput.css'); ?>
	<?php echo $this->Html->script('jquery-ui'); ?>
<link rel="stylesheet" href="<?php echo $this->webroot; ?>jquery-ui-1.11.2.custom/jquery-ui.css">
<?php echo $this->Html->script('jquery.tagsinput.js'); ?>

<script type="text/javascript">

    function onAddTag(tag) {
        alert("Added a tag: " + tag);
    }
    function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
    }

    function onChangeTag(input, tag) {
        alert("Changed a tag: " + tag);
    }

    $(function() {

        $('#tags_1').tagsInput({width: 'auto'});
        $('#tags_2').tagsInput({
            width: 'auto',
            onChange: function(elem, elem_tags)
            {
                var languages = ['php', 'ruby', 'javascript', 'sapna'];
                $('.tag', elem_tags).each(function()
                {
                    if ($(this).text().search(new RegExp('\\b(' + languages.join('|') + ')\\b')) >= 0)
                        $(this).css('background-color', 'yellow');
                });
            }
        });
        $('#tags_3').tagsInput({
            width: 'auto',
            //autocomplete_url:'test/fake_plaintext_endpoint.html' //jquery.autocomplete (not jquery ui)
            autocomplete_url: "<?php echo $this->webroot . 'Client/skill_data'; ?>" // jquery ui autocomplete requires a json endpoint
        });


// Uncomment this line to see the callback functions in action
//			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});		

// Uncomment this line to see an input with no interface for adding new tags.
//			$('input.tags').tagsInput({interactive:false});
    });

</script>
<script>
$(function() {
$( "#datepicker1" ).datepicker({
showOn: "button",
buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
buttonImageOnly: true,
buttonText: "Select date"
});
});
</script> 
<script>
document.getElementById("uploadBtn").onchange = function () {
    alert(document.getElementById("uploadFile").value = this.value);
};
</script>



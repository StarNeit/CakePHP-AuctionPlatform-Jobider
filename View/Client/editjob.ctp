<?php $session = $this->Session->read('session_post_data'); ?>
<?php
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
    <?php  if(!empty($job)){?>
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'postajob')); ?>"> Post a job </a></li>
                       <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'searchfreelancer')); ?>"> Search for freelancer </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/postedJobs">  Jobs i have posted   </a></li>

                    </ul>
                </div>
            </div>
        <?php echo $this->element('client_notification'); ?>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green">
                    Post a job
                </div>

                <?php
                echo $this->Session->flash();
                echo $this->Form->create('Job', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'role' => 'form', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'client', 'action' => 'editjob', $job['Job']['id'])));
                ?>
           
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="hidden" name="data[Job][category_id]" value='<?php echo $category_data['Category']['id']; ?>'>
                        <input type="hidden" name="data[Job][subcategory_id]" value='<?php echo $subcategory_data['Subcategory']['id']; ?>'>
                        <?php echo '&nbsp;&nbsp;'.$category_data['Category']['name'].'&nbsp;&nbsp;-> &nbsp;&nbsp;'.$subcategory_data['Subcategory']['category_name']; ?>
 </div> </div>

               <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Job Title</label>
                        <?php echo $this->Form->input('job_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Job Title', 'required' => FALSE, 'value' => $job['Job']['job_title'])); ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Budget</label>
                        <?php echo $this->Form->input('budget', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'value' => $job['Job']['budget'], 'placeholder' => '$', 'required' => FALSE)); ?>
                    </div> </div>
                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Planned Start date </label>
                        <div class="input-group datepicker">
                            <?php echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'col-md-11 datepck', 'id' => 'datepicker1', 'label' => false, 'required' => FALSE, 'value' => $job['Job']['start_date'])); ?>
                        </div>
                        <div  style="display:none" class="error-message datedPicker">Please Enter The Date</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Duration</label>
                        <?php echo $this->Form->input('duration', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array($job['Job']['duration'] => $job['Job']['duration'], 'More than 6 months ' => 'More than 6 months', '3 to 6 months' => '3 to 6 months', '1 to 3 months' => '1 to 3 months', 'Less than 1 month' => 'less than 1 month', 'Less than 1 week' => 'Less than 1 week'), 'required' => FALSE)); ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label> Attach Document</label>
                        <div class="clearfix"></div>
                        <div class="input-group custom_browse"> 
                            <?php   $doc_file=array('application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.oasis.opendocument.text');   
                     $doc_image=array('image/jpeg','image/png'); ?> 
                            <?php   if(!empty($job['Job']['image'])){
                                $doc_data=explode('.',$job['Job']['image']);
                               // pr($doc_data);  
                                ?>
                            <?php if($doc_data[1]=='png' or $doc_data[1]=='jpg' or $doc_data[1]=='jpeg'){?>
                            
                            <img src="<?php echo $this->webroot; ?>uploads/<?php echo $job['Job']['image']; ?>" width="45" alt="job" >
                            <?php } ?>
                             <?php  if($doc_data[1]=='docx' or $doc_data[1]=='opt' or $doc_data[1]=='pdf'){?>
                           <?php echo $job['Job']['image']; ?>
                            <?php } ?>
                            
                            
                            <?php }else{?>
                            <img width="44" src="/img/demo_file.png" alt="job">
                            <?php } ?>
                            <div class="fileUpload btn btn-primary input-group-addon">
                                <?php echo $this->Form->input('image_names', array('type' => 'file', 'id' => 'uploadBtn', 'class' => 'upload', 'required' => false, 'label' => false)); ?> <span>Browse</span>
                            </div>
                        </div>
                        <div  style="display:none" class="error-message Errer">Please choose the correct document  file. </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="data[Job][description]" class='form-control' id='exampleInputEmail1' required=false rows="5"><?php echo $job['Job']['description']; ?></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group ">
                        <label>Skills Required (Optional)</label>
                        <input type="hidden" value='' id='taginput'>
                        <?php echo $this->Form->input('skills', array('type' => 'text', 'class' => ' form-control tags', 'id' => 'tags_3', 'label' => false, 'required' => false, 'value' => $skills)); ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group"  id="items">
                        <label>Additional Questions</label>
                        <?php foreach ($additional as $val) {
                            ?>
                            <input id="tags_3" class=" form-control tags" type="text" name="data[Job][additional_question][]" value="<?php echo $val; ?>">&nbsp;
                        <?php } ?>
                    </div>
                    <button type="button" value="addbutton" class="btn-green" id="addButton">Add More</button>
                </div>
                <div class="col-md-12 marg_tb50 text-center">
                    <button class="btn-lg btn-green col-md-2 col-sm-2 col-xs-12 pull-left " type='submit' name='add' value="add">Edit</button>
                    <button class="btn-lg btn-green col-md-2 col-sm-2 col-sm-offset-1  col-md-offset-2 col-xs-12" type="button" onClick='this.form.reset();'>  Cancel   </button>
                </div>
                <?php echo $this->Form->end(); ?> 
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php } else { ?>
          <div class="row marg_tb15">
        <div class="col-md-12">
            <p><i><img class="mrg_r5" alt="job" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $this->webroot; ?>client/postedJobs">Back to Search Result</a></p>
        </div>
          <p style="font-size:20px;color: #C7CBD6;"> The Job Cannot Be Found</p>;
        
        <div class="col-md-4 col-sm-4 pad_r0" style="padding: 100px">
          
        </div> 
        
    </div>
   <?php  } ?>
</div>
<!--
-->
<!-- Include all compiled plugins (below), or include individual files as needed --> 


<script>
    $(document).ready(function () {
        $(document).on('change', '.selectPart', function () {
            //alert('hello');
            var select = $('.selectPart').val();
            if (select != '')
            {
                $(".subcategory").removeAttr("disabled", "disabled");
                $.ajax({
                    type: 'post',
                    url: '<?php echo $this->base; ?>/client/job_data',
                    dataType: 'json',
                    data: {select: select},
                    success: function (msg) {
                        if (msg.suc == 'yes') {
                            $('.subcategory').html(msg.subcategory);
                        }
                    }
                });
            }

        })
    });
</script>

<?php echo $this->Html->css('jquery.tagsinput.css'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php //echo $this->Html->css('jquery-ui');?>
<?php echo $this->Html->script('jquery.tagsinput'); ?>

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

    $(function () {

        $('#tags_1').tagsInput({width: 'auto'});
        $('#tags_2').tagsInput({
            width: 'auto',
            onChange: function (elem, elem_tags)
            {
                var languages = ['php', 'ruby', 'javascript', 'sapna'];
                $('.tag', elem_tags).each(function ()
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


    });

</script>

<script>
    $(function () {
        $("#datepicker1").datepicker({
            showOn: "button",
            buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });

    });
</script> 

<script>
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
</script>
<script>

    $("#addButton").click(function (e) {
        //Append a new row of code to the "#items" div
        $("#items").append('<div><input id="tags_3" class="  tags" type="text" value="" name="data[Job][additional_question][]" style="width: 91%;">   <button class=" btn btn-danger deleteme" type="" style="height: 35px; margin-top: -6px;">Delete</button></div><br>');
    });
    $(document).ready(function () {
        $("body").on("click", ".deleteme", function (e) {
            $(this).parent("div").remove();
        });

    });

</script>
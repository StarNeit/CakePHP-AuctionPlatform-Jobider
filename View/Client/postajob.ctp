<?php
$session = $this->Session->read('session_post_data');
?>

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

    <div class="row marg_tb15">

        <div class="col-md-3 pad_l0 col-sm-3">

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                    <li><a href="<?php echo $this->webroot; ?>client/postajob"> Post a job </a></li>
                    <li><a href="<?php echo $this->webroot; ?>client/searchfreelancer"> Search for freelancer </a></li>
                    <li><a href="<?php echo $this->webroot; ?>client/postedJobs">Jobs i have posted </a></li>
                    <li><a href="<?php echo $this->webroot; ?>client/job_payment">Jobs Payment</a></li>
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
                echo $this->Form->create('Job', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'role' => 'form', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'client', 'action' => 'postajob')));
                ?>
                <!--<form class="formstyle form_sighn form_style2 marg_tb15" role="form">-->
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Category</label>
<?php if (isset($category_data['Category']['name'])) { ?>
                            <select name="data[Job][category_id]"  class="form-control">
                                <option value="<?php echo $category_data['Category']['id'] ?>"><?php echo $category_data['Category']['name']; ?></option>
                                <?php foreach ($category as $k => $v) { ?>
                                    <option value="<?php echo $v['Category']['id'] ?>"><?php echo $v['Category']['name']; ?></option>
                            <?php } ?>
                            </select>
<?php } else { ?>
                            <select name="data[Job][category_id]"  class="form-control selectPart">
                                <option value="">Please select</option>
                                <?php foreach ($category as $k => $v) { ?>
                                    <option value="<?php echo $v['Category']['id'] ?>"><?php echo $v['Category']['name']; ?></option>
    <?php } ?>
                            </select>
 
<?php } ?>
                    </div> </div>

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Subcategory</label>
<?php if (isset($subcategory) && !empty($subcategory) && isset($subcategory_data['Subcategory']['category_name']) && !empty($subcategory_data['Subcategory']['category_name'])) { ?>
                            <select name="data[Job][subcategory_id]"  class="form-control">
                                <option value="<?php echo $subcategory_data['Subcategory']['id'] ?>"><?php echo $subcategory_data['Subcategory']['category_name']; ?></option>
                                <?php foreach ($subcategory as $k => $v) { ?>
                                    <option value="<?php echo $v['Subcategory']['id'] ?>"><?php echo $v['Subcategory']['category_name']; ?></option>
                            <?php } ?>
                            </select>
                        <?php } else { ?>
                            <?php echo $this->Form->input('subcategory_id', array('type' => 'select', 'class' => 'form-control subcategory', 'label' => false, 'disabled' => true, 'options' => array('empty' => 'Please Select....', 'required' => FALSE))); ?>	
                                <?php } ?>
                    </div></div>

                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Job Title</label>
                      <?php if (isset($session['Job']['job_title']) && !empty($session['Job']['job_title'])) { ?>
                            <?php echo $this->Form->input('job_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Job Title', 'required' => FALSE, 'value' => $session['Job']['job_title'])); ?>
                        <?php } else { ?>
  
                            <?php echo $this->Form->input('job_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Job Title', 'required' => FALSE)); ?>
<?php } ?>
                    </div>
                </div>
          


                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Duration</label>
                        <?php if (isset($session['Job']['duration']) && !empty($session['Job']['duration'])) { ?>
                            <?php echo $this->Form->input('duration', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array($session['Job']['duration'] => $session['Job']['duration'], 'More than 6 months ' => 'More than 6 months', '3 to 6 months' => '3 to 6 months', '1 to 3 months' => '1 to 3 months', 'Less than 1 month' => 'less than 1 month', 'Less than 1 week' => 'Less than 1 week'), 'required' => FALSE)); ?>
                        <?php } else { ?>
                            <?php echo $this->Form->input('duration', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array('More than 6 months ' => 'More than 6 months', '3 to 6 months' => '3 to 6 months', '1 to 3 months' => '1 to 3 months', 'Less than 1 month' => 'less than 1 month', 'Less than 1 week' => 'Less than 1 week'), 'empty' => 'Select Duration', 'required' => FALSE)); ?>
<?php } ?>
                    </div>
                </div>

                <div class="clearfix"></div>


                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label> Attach Document</label>
                        <div class="clearfix"></div>
                        <div class="input-group custom_browse">  
                            <?php  $doc_file=array('application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.oasis.opendocument.text');   
                     $doc_image=array('image/jpeg','image/png'); ?>
                            <?php if (isset($session['Job']['image']) && !empty($session['Job']['image'])) { 
                                $doc_type=$session['Job']['image_names']['type'];?>
                              <?php if(in_array($doc_type,$doc_image)){ ?>
                                <img src="<?php echo $this->webroot; ?>uploads/<?php echo $session['Job']['image']; ?>" alt="image"><br>

                                <div class="fileUpload btn btn-primary input-group-addon">
                                <?php echo $this->Form->input('image_names', array('type' => 'file', 'id' => 'uploadBtn', 'class' => 'upload', 'required' => false, 'label' => false)); ?> <span>Browse</span>
                                </div>
                              <?php } ?>
                                <?php if(in_array($doc_type,$doc_file)){ ?>
                              <?php  echo $session['Job']['image']; ?><br>

                                <div class="fileUpload btn btn-primary input-group-addon">
                                <?php echo $this->Form->input('image_names', array('type' => 'file', 'id' => 'uploadBtn', 'class' => 'upload', 'required' => false, 'label' => false)); ?> <span>Browse</span>
                                </div>
                                <?php } ?>
                            <?php } else { ?>
                                    <?php echo $this->Form->input('image_name', array('type' => 'text', 'id' => 'uploadFile', 'label' => false, 'placeholder' => 'Choose File', 'value' => '', 'required' => false,'disabled'=>true)); ?>
                                <div class="fileUpload btn btn-primary input-group-addon">
                                <?php echo $this->Form->input('image_names', array('type' => 'file', 'id' => 'uploadBtn', 'class' => 'upload', 'required' => false, 'label' => false)); ?> <span>Browse</span>
                                </div>
<?php } ?>
                        </div>
                        <div  style="display:none" class="error-message Errer">Please choose the correct document  file. </div>
                    </div>
                </div>
                
                            <div class="clearfix"></div>
                
                         <div class="col-md-12">
                    <div class="form-group">
                        <label> How would you like to pay?</label>
                        <div class="clearfix"></div>
                       <?php if (isset($session['Job']['pay_type']) && !empty($session['Job']['pay_type'])) { ?>
                            <?php echo $this->Form->input('pay_type', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array($session['Job']['pay_type'] => $session['Job']['pay_type']), 'required' => FALSE)); ?>
                        <?php } else { ?>
                            <?php echo $this->Form->input('pay_type', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array('Fixed' => 'Fixed Price - Pay by the projects. Requires details specs'), 'required' => FALSE)); ?>
<?php } ?>
                    </div>
                </div>


                <div class="clearfix"></div>
                      <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Budget</label>
                        <?php if (isset($session['Job']['budget']) && !empty($session['Job']['budget'])) { ?>
                            <?php echo $this->Form->input('budget', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => '$', 'required' => FALSE, 'value' => $session['Job']['budget'])); ?>    
    <?php } else { ?>
                            <?php echo $this->Form->input('budget', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => '$', 'required' => FALSE)); ?><?php } ?>

                    </div> </div>

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Planned Start date </label>
                        <div class="input-group datepicker  ">
                            <?php if (isset($session['Job']['start_date']) && !empty($session['Job']['start_date'])) { ?>
                                <?php echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'col-md-11', 'id' => 'datepicker1', 'label' => false, 'required' => FALSE, 'value' => $session['Job']['start_date'])); ?>
                            <?php } else { ?>
                                <?php echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'col-md-11 datepck', 'id' => 'datepicker1', 'label' => false, 'required' => FALSE)); ?>
<?php } ?>
                        </div>
                        <div  style="display:none" class="error-message datedPicker">Please Enter The Date</div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <?php if (isset($session['Job']['description']) && !empty($session['Job']['description'])) { ?>
                            <?php echo $this->Form->input('description', array('type' => 'textarea', 'rows' => '5', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => FALSE, 'required' => false, 'value' => $session['Job']['description'])); ?>
                        <?php } else { ?>
                            <?php echo $this->Form->input('description', array('type' => 'textarea', 'rows' => '5', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => FALSE, 'required' => false)); ?>
<?php } ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group ">
                        <label>Skills Required (Optional)</label>
                        <input type="hidden" value='' id='taginput'>
                        <?php if (isset($subskill) && !empty($subskill)) { 
                            ?>
                            <?php echo $this->Form->input('skills', array('type' => 'text', 'class' => ' form-control tags', 'id' => 'tags_3', 'label' => false, 'required' => false, 'value' => $subskill)); ?>
                        <?php } else { ?>
    <?php echo $this->Form->input('skills', array('type' => 'text', 'class' => ' form-control tags', 'id' => 'tags_3', 'label' => false, 'required' => false)); ?>   <?php } ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group" id="items">
                        <label>Additional Questions</label>
                        <?php if (isset($session['Job']['additional_question']) && !empty($session['Job']['additional_question'])) { ?>
                            <input id="tags_3" class=" form-control tags" type="text"  name="data[Job][additional_question][]" value="<?php echo $session['Job']['additional_question']; ?>"><?php } else { ?>
                            <input id="tags_3" class=" form-control tags" type="text" value="" name="data[Job][additional_question][]">

<?php  }?>
                    </div>
                    <button type="button" value="addbutton" class="btn-green" id="addButton">Add More</button>
                </div>
                <div class="clearfix"> </div>
                <div class="col-md-12 marg_tb50 text-center">

                    <button class="btn-lg btn-green col-md-2 col-sm-3 col-xs-12 pull-left " type='submit' name='add' value="add">Post</button>

                    <button class="btn-lg btn-green col-md-2 col-sm-3 col-sm-offset-1 col-md-offset-3 col-xs-12" type="submit" name='preview' value="preview" >
                        Preview
                    </button>

                    <button class="btn-lg btn-green col-md-2 col-sm-3 col-xs-12 pull-right " onClick='this.form.reset();' type="button">Cancel</button>

               <div class="clearfix"> </div>    </div>
<?php echo $this->Form->end(); ?> 
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--
-->
<!-- Include all compiled plugins (below), or include individual files as needed --> 

<script>
                        $(document).ready(function() {
                            $(document).on('change', '.selectPart', function() {
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
                                        success: function(msg) {
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
            autocomplete_url: "<?php echo $this->webroot . 'Client/skill_data'; ?>"
        });
    });

</script>

<script>
    $(function() {
        $("#datepicker1").datepicker({
            showOn: "button",
            buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });

    });
</script> 

<script>
    document.getElementById("uploadBtn").onchange = function() {
        document.getElementById("uploadFile").value = this.value;
    };
</script>

<script>
    $("#addButton").click(function(e) {
        //Append a new row of code to the "#items" div
        $("#items").append('<div><br><input id="tags_3" class=" tags" type="text" value="" name="data[Job][additional_question][]"  style="width: 92%;"> <button class=" btn btn-danger deleteme" type="" style="height: 42px; margin-top: -6px; margin-left: -7px;">Delete</button></div>');
    });

    $(document).ready(function() {
        $("body").on("click", ".deleteme", function(e) {
            $(this).parent("div").remove();
        });

    });
</script>




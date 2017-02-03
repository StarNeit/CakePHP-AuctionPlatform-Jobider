<!--<script type="text/javascript">

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

</script>-->


<div class="container">

    <div class="row marg_tb15">

        <?php echo $this->element('freelancer_dashboard'); ?>

        <div class="col-md-9 col-sm-9  pad_r0 ">

            <div class="bg_white">

                <div class="green">

                    Post a job

                </div>

                <?php
                //echo $this->Session->flash();
                echo $this->Form->create('Job', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'role' => 'form', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'freelancer', 'action' => 'postajob')));
                ?>
                <!--<form class="formstyle form_sighn form_style2 marg_tb15" role="form">-->
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Category</label>
                        <?php if (isset($category_data['Category']['name'])) { ?>
                            <?php echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control selectPart', 'label' => false, 'options' => array('default' => $category_data['Category']['name'], $category), 'required' => FALSE)); ?>
                        <?php } else { ?>
                            <?php echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control selectPart', 'label' => false, 'options' => array($category), 'empty' => 'Please Select....', 'required' => FALSE)); ?>
                        <?php } ?>
                    </div> </div>

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Subcategory</label>
                        <?php if (isset($subcategory) && !empty($subcategory) && isset($subcategory_data['Subcategory']['category_name']) && !empty($subcategory_data['Subcategory']['category_name'])) { ?>
                            <?php echo $this->Form->input('subcategory_id', array('type' => 'select', 'class' => 'form-control subcategory', 'label' => false, 'options' => array('default' => $subcategory_data['Subcategory']['category_name'], $subcategory), 'required' => FALSE,)); ?>
                        <?php } else { ?>
                            <?php echo $this->Form->input('subcategory_id', array('type' => 'select', 'class' => 'form-control subcategory', 'label' => false, 'disabled' => true, 'options' => array('empty' => 'Please Select....', 'required' => FALSE,))); ?>													
                        <?php } ?>
                    </div> </div>

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
                        <label>Budget</label>
                        <?php if (isset($session['Job']['budget']) && !empty($session['Job']['budget'])) { ?>
                            <?php echo $this->Form->input('budget', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => '$', 'required' => FALSE, 'value' => $session['Job']['budget'])); ?>        <?php } else { ?>
                            <?php echo $this->Form->input('budget', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => '$', 'required' => FALSE)); ?>
                        <?php } ?>

                    </div> </div>

                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Planned Start date </label>
                        <div class="input-group datepicker">
                            <?php if (isset($session['Job']['start_date']) && !empty($session['Job']['start_date'])) { ?>
                                <?php echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'col-md-11', 'id' => 'datepicker1', 'label' => false, 'required' => FALSE, 'value' => $session['Job']['start_date'])); ?>
                            <?php } else { ?>
                                <?php echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'col-md-11', 'id' => 'datepicker1', 'label' => false, 'required' => FALSE)); ?>
                            <?php } ?>
                        </div>

                        <div  style="display:none" class="error-message datedPicker">Please Enter The Date</div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Duration</label>
                        <?php if (isset($session['Job']['duration']) && !empty($session['Job']['duration'])) { ?>
                            <?php echo $this->Form->input('duration', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array($session['Job']['duration'], 'More than 6 months ' => 'More than 6 months', '3 to 6 months' => '3 to 6 months', '1 to 3 months' => '1 to 3 months', 'Less than 1 month' => 'less than 1 month', 'Less than 1 week' => 'Less than 1 week'), 'required' => FALSE)); ?>
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
                            <?php if (isset($session['Job']['image']) && !empty($session['Job']['image'])) { ?>
                                <?php echo $this->Form->input('image_name', array('type' => 'text', 'id' => 'uploadFile', 'label' => false, 'placeholder' => 'Choose File', 'value' => '', 'required' => false)); ?>
                                <img src="<?php echo $this->webroot; ?>uploads/<?php echo $session['Job']['image']; ?>"><br>

                                <div class="fileUpload btn btn-primary input-group-addon">
                                    <?php echo $this->Form->input('image_names', array('type' => 'file', 'id' => 'uploadBtn', 'class' => 'upload', 'required' => false, 'label' => false)); ?> <span>Browse</span>
                                </div>
                            <?php } else { ?>
                                <?php echo $this->Form->input('image_name', array('type' => 'text', 'id' => 'uploadFile', 'label' => false, 'placeholder' => 'Choose File', 'value' => '', 'required' => false)); ?>
                                <div class="fileUpload btn btn-primary input-group-addon">
                                    <?php echo $this->Form->input('image_names', array('type' => 'file', 'id' => 'uploadBtn', 'class' => 'upload', 'required' => false, 'label' => false)); ?> <span>Browse</span>
                                </div>
                            <?php } ?>
                        </div>
                        <div  style="display:none" class="error-message Errer">Please choose the correct document  file. </div>
                    </div>
                </div>

                <div class="clearfix"></div>
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
                    <div class="form-group marg_0">
                        <label>Skills Required (Optional)</label>

                        <input type="hidden" value='' id='taginput'>
                        <?php if (isset($session['Job']['skills']) && !empty($session['Job']['skills'])) { ?>
                            <?php echo $this->Form->input('skills', array('type' => 'text', 'class' => ' form-control tags', 'id' => 'tags_3', 'label' => false, 'required' => false, 'value' => $session['Job']['skills'])); ?>
                        <?php } else { ?>
                            <?php echo $this->Form->input('skills', array('type' => 'text', 'class' => ' form-control tags', 'id' => 'tags_3', 'label' => false, 'required' => false)); ?>
                        <?php } ?>

                    </div>
                    <small class="text_4">Add minimum skills required to perform this job</small>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 marg_tb50 text-center">

                    <button class="btn-lg btn-green col-md-2 col-sm-2 col-xs-2 pull-left " type='submit' name='add' value="add">Post</button>

                    <button class="btn-lg btn-green col-md-2 col-sm-2 col-md-offset-3 col-xs-2" type="submit" name='preview' value="preview" >
                        Preview
                    </button>

                    <button class="btn-lg btn-green col-md-2 col-sm-3 col-xs-2 pull-right " onClick='this.form.reset();' type="button">Cancel</button>

                </div>


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
    $(document).ready(function() {
        var Dated = $('#datepicker1').next().next().html();
        if (Dated == 'Please Enter The Date') {
            $('#datepicker1').next().next().css('display', 'none');
            $('.datedPicker').css('display', 'block');
        }


        $(document).on('change', '.selectPart', function() {
            //alert('hello');
            var select = $('.selectPart').val();
            if (select != '')
            {
                $(".subcategory").removeAttr("disabled", "disabled");
                $.ajax({
                    type: 'post',
                    url: '<?php echo $this->base; ?>/freelancer/job_data',
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

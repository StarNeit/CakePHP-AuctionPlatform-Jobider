
<?php echo $this->Html->css('jquery.tagsinput.css'); ?>
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
            autocomplete_url: '<?php echo $this->webroot; ?>test/fake_json_endpoint.html' // jquery ui autocomplete requires a json endpoint
        });


// Uncomment this line to see the callback functions in action
//			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});		

// Uncomment this line to see an input with no interface for adding new tags.
//			$('input.tags').tagsInput({interactive:false});
    });

</script>

<?php
//pr($this->params);
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
                        <li class="<?php echo $postajob; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'postajob')); ?>"> Post a job </a></li>
                        <li class="<?php echo $searchfreelancer; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'searchfreelancer')); ?>"> Search for freelancer </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/postedJobs">  Jobs i have posted   </a></li>


                    </ul>
                </div>
            </div>

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p class="font_14">A payment of $23 has been supplied to your account. </p>
                    <p class="font_14">Michel shey contact : <br/>
                        Tester for wordpress site started on 13-Nov-2014 </p>
                    <p><i><img src="<?php echo $this->webroot; ?>img/view.png" class="mrg_r5" alt="View"/></i><a href="#">See all notifications  >></a></p>

                    </ul>
                </div>
            </div>



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
                        <?php echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control selectPart', 'label' => false, 'options' => array($category), 'empty' => 'Please Select....', 'required' => FALSE)); ?>

<!--          <select class="form-control"><option>web development</option><option>option1</option><option>option1</option></select>-->
                    </div> </div>

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Subcategory</label>

                        <?php echo $this->Form->input('subcategory_id', array('type' => 'select', 'class' => 'form-control subcategory', 'label' => false, 'disabled' => true, 'options' => array('empty' => 'Please Select....', 'required' => FALSE,))); ?>
                    </div> </div>

                <div class="clearfix"></div>

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Job Title</label>
                        <?php echo $this->Form->input('job_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Job Title', 'required' => FALSE)); ?>
            <!--          <input type="text" id="exampleInputEmail1" class="form-control" placeholder="designing expert">-->
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Budget</label>
                        <?php echo $this->Form->input('budget', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => '$', 'required' => FALSE)); ?>
                      <!--          <input type="email" id="exampleInputEmail1" class="form-control" placeholder="$ ">-->
                    </div> </div>

                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Planned Start date </label>
                        <div class="input-group datepicker">
                            <?php echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'col-md-11', 'id' => 'datepicker1', 'label' => false, 'required' => FALSE)); ?>
                       <!--              <input type="text" id="datepicker1" class="col-md-11">-->

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label>Duration</label>
                        <?php echo $this->Form->input('duration', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array('More than 6 months ' => 'More than 6 months', '3 to 6 months' => '3 to 6 months', '1 to 3 months' => '1 to 3 months', 'Less than 1 month' => 'less than 1 month', 'Less than 1 week' => 'Less than 1 week'), 'empty' => 'Select Duration', 'required' => FALSE)); ?>
            <!--<select class="form-control"><option></option><option>option1</option><option>option1</option></select>-->
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6">
                    <label>Choose File </label>
                    <div class="fileUpload btn btn-primary pull-right">
                        <span>Browse</span>
                        <?php echo $this->Form->input('image_name', array('type' => 'file', 'id' => 'exampleInputFile', 'class' => 'upload', 'label' => false, 'Browse')); ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <?php echo $this->Form->input('description', array('type' => 'twxtarea', 'rows' => '5', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => FALSE, 'required' => false)); ?>
            <!--            <textarea rows='5' class="form-control" id="exampleInputEmail1"></textarea>-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group marg_0">
                        <label>Skills Required (Optional)</label>

                        <input type="hidden" value='' id='taginput'>
                        <?php echo $this->Form->input('skills', array('type' => 'text', 'class' => ' form-control tags', 'id' => 'tags_3', 'label' => false, 'required' => false)); ?>
              <!--													<input id="tags_2" type="text" class="tags" value="php,ios,javascript,ruby,android,kindle" />-->

                    </div>
                    <small class="text_4">Add minimum skills required to perform this job</small>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 marg_tb50 text-center">

                    <button class="btn-lg btn-green col-md-2 col-sm-2 col-xs-2 pull-left " type='submit'>Post</button>



                    <button class="btn-lg btn-green col-md-2 col-sm-2 col-md-offset-3 col-xs-2" type='button'>Preview</button>


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



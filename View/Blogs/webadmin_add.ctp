<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>   Add Blogs</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Blog', array('enctype' => 'multipart/form-data', 'role' => 'form','id'=>'Blogadd', 'url' => array('controller' => 'blogs', 'action' => 'add')));                            ?>
                            <!--                                <form role="form">-->
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Category</label>
                                <?php echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'required'=>FALSE,'options' => array($data), 'empty' => 'Select The Category')); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Author</label>
                                <?php echo $this->Form->input('author', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'required' => false)); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'required' => false)); ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <?php echo $this->Form->input('editor1', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1', 'label' => false,'required'=>false)); ?>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <?php echo $this->Form->input('image_name', array('type' => 'file', 'id' => 'exampleInputFile', 'label' => false, 'required' => false,'required'=>false)); ?>
                            </div>   
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tags</label>
                                <input type="hidden" value='' id='taginput'>
                                <input id="tags_1" type="text" class=" form-control tags" name="data[Blog][tags]" />
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <?php echo $this->Form->end(); ?>
                        </div>
                </section>
            </div>
        </div>
    </section>
</section>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<!--        <script src="<?php echo $this->webroot;?>jquery-ui-1.11.2.custom/jquery-ui.js"></script>-->
  <script src="<?php echo $this->webroot;?>jquery-ui-1.11.2.custom/jquery-ui.js"></script>

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
//        $('#tags_3').tagsInput({
//            width: 'auto',
//            autocomplete_url: "<?php //echo $this->webroot . 'Client/skill_data';   ?>" 
//    });
    });

</script>


<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>

<script>
//                                $().ready(function() {
//                          // alert('hello');
//                                    $("#Blogadd").validate({
//                                        rules: {
//                                            'data[Blog][author]': {
//                                                required: true,
//                                            },
//                                            'data[Blog][title]': {
//                                                required: true,
//                                            },
//                                            'data[Blog][editor1]': {
//                                                required: true,
//                                            },
//                                        },
//                                        messages: {
//                                            'data[Blog][author]': {
//                                                required: "Please enter old password",
//                                            },
//                                            'data[Blog][title]': {
//                                                required: "Please enter new password",
//                                            },
//                                            'data[Blog][editor1]': {
//                                                required: "Please enter confirm password",
//                                            },
//                                        },
//                                    });
//                                });
</script>

<style>
.error-message {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 258px;
    }
</style>

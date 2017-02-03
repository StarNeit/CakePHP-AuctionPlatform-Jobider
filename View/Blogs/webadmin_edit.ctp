<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Edit  Blogs</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Blog', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'blogs', 'action' => 'edit', $blog['Blog']['id'])));
                            ?>
                            <!--                                <form role="form">-->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Auther</label>
                                <?php echo $this->Form->input('auther', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'value' => $blog['Blog']['author'])); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Blog']['title'])); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <?php echo $this->Form->input('editor1', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $blog['Blog']['description'])); ?>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <?php if(!empty($blog['Blog']['image'])){ ?>
                                <img src="<?php echo $this->webroot; ?>uploads/<?php echo $blog['Blog']['image']; ?>" height="100" width="100" alt="BlogImage">
                                <?php } else { ?>
                                 <img src="<?php echo $this->webroot; ?>img/thumbb.png" height="100" width="100" alt="ThumbImage">
                                <?php } ?>
                                <?php echo $this->Form->input('file', array('type' => 'file', 'id' => 'exampleInputFile', 'label' => false,'class'=>'addimage')); ?>

                            </div>   

                            <div class="form-group">
                                <label for="exampleInputPassword1">Tags</label>
                                <input id="tags_1" type="text" class=" form-control tags" name="data[Blog][tags]" value="<?php echo $blog['Blog']['tags']; ?>" />
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
                            <?php echo $this->Form->end(); ?>


                        </div>
                </section>

            </div>

        </div>





        <!-- page end-->
    </section>
</section>

<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.10.2.js"></script>
<!--        <script src="<?php echo $this->webroot; ?>jquery-ui-1.11.2.custom/jquery-ui.js"></script>-->
<script src="<?php echo $this->webroot; ?>jquery-ui-1.11.2.custom/jquery-ui.js"></script>

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
//            autocomplete_url: "<?php //echo $this->webroot . 'Client/skill_data';    ?>" 
//    });
    });

</script>
<style>
    .addimage {
    margin-top: 10px;
}
</style>

<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Add Test Contents</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Testcontent', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'tests', 'action' => 'addtestcontents')));
                            ?>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Category</label>
                                <?php echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control category', 'id' => 'selected', 'label' => false, 'required'=>false,'options' => array($data), 'empty' => 'Select the Category')); ?>
                            </div>
                            <div class="form-group ">
                                <label for="exampleInputPassword1">Select Test</label>
                                <?php echo $this->Form->input('test_id', array('type' => 'select', 'class' => 'form-control providesss', 'label' => false, 'required'=>false,'options' => array('' => 'Select the Test'))); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Test Content</label>
                                <?php echo $this->Form->input('test_content', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1cntn', 'label' => false,'required'=>false)); ?>
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

<?php echo $this->Html->script('jquery.min'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#selected').change(function() {
        });
        $(document).on('change', '.category', function() {
            var category = $('.category').val();
//          alert(category);  
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/tests/chek',
                dataType: 'json',
                data: {category: category}, success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('.providesss').html(msg.provide);
                    }
                }

            });
        });

        var category = $('.category').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo $this->base; ?>/tests/chek',
            dataType: 'json',
            data: {category: category},
            success: function(msg) {
                if (msg.suc == 'yes') {
                    $('.providesss').html(msg.provide);
                }
            }
        });

    });

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








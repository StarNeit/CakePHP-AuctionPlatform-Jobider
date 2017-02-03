<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Edit Test Contents</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Testcontent', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'tests', 'action' => 'edittestcontent', $user_data['Testcontent']['id'])));
                            ?>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Category</label>
                                <?php  echo  $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control provider', 'id' => 'exampleInputPassword1cat selected', 'label' => false, 'options' => array($category), 'empty' => 'Select the Category', 'default' => $user_data['Testcontent']['category_id'])); ?>
                            </div>
                            <div class="form-group providesss">
                                <label for="exampleInputPassword1">Select Test</label>
                                <?php echo $this->Form->input('test_id', array('type' => 'select', 'class' => 'form-control', 'label' => false, 'options' => array($user_data['Test']['id']=>$user_data['Test']['title']))); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Test Content</label>
                                <?php echo $this->Form->input('test_content', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $user_data['Testcontent']['test_content'])); ?>

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
<script>
    $(document).ready(function() {
        $('#selected').change(function() {});
        $(document).on('change', '.provider', function() {
            var provider = $('.provider').val();
            //alert(provider);
                $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/tests/edit_testcontent_ajax',
                dataType: 'json',
                data: {provider: provider},
                success: function(msg) {
   
                    if (msg.suc == 'yes') {
                        $('.providesss').html(msg.provide);
                    }else{
                 
                    }
                }

            });
        });
    });
</script>
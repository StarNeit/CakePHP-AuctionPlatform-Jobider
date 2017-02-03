<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Add Questions</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Question', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'tests', 'action' => 'addQuestions')));
                            ?>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Category</label>
                                <?php echo $this->Form->input('category_id', array('type' => 'select', 'class' => 'form-control provider', 'id' => 'exampleInputPassword1cat selected', 'label' => false, 'required' => false, 'options' => array($data), 'empty' => 'Select The Category')); ?>
                            </div>
                            
                            <div class="form-group providesss">
                                <label for="exampleInputPassword1">Select Test</label>
                                <?php echo $this->Form->input('test_id', array('type' => 'select', 'class' => 'form-control', 'id' => 'exampleInputPassword1test', 'label' => false, 'required' => false, 'options' => array('' => 'Select Test'))); ?>                                     </div>

                               <div class="form-group topics">
                                <label for="exampleInputPassword1">Select Topic</label>
                                <?php echo $this->Form->input('topic_id', array('type' => 'select', 'class' => 'form-control provider', 'id' => 'exampleInputPassword1top selected', 'label' => false, 'required' => false,  'options' => array('' => 'Select Test'))); ?>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Name</label>
                                <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1name', 'label' => false, 'required' => false)); ?>  </div>

                            <div class="form-group" id="items">
                                <label for="exampleInputPassword1">options</label>
                                <input id="exampleInputPassword1opt" class=" form-control " type="text" value="" name="data[Question][options][]" required="false"/>
                            </div>

                            <button type="button" value="addbutton" class="btn btn-default" id="addButton"> Add More </button>

                            <div class="form-group" id="item">
                                <label for="exampleInputPassword1">answers</label>

                                <input id="exampleInputPassword1ans" class=" form-control " type="text" value="" name="data[Question][answers][]" required="false">
                            </div>
                            <button type="button" value="addbutton"  class="btn btn-default" id="addButtons"> Add More </button>

                            <div class="form-group">
                                <label for="exampleInputPassword1"> Answer Type </label> 
                                <br/>
                                <input type="radio" value="radio" name="data[Question][option_type]" checked="" id="ContectJobsExistjobrd" required="false"/> Radio &nbsp;&nbsp;
                                <input type="radio" value="checkbox" name="data[Question][option_type]" id="ContectJobsExistjobchk" required="false"/> Checkbox   &nbsp;                         </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Minutes</label>
                                <?php echo $this->Form->input('minutes', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1minut', 'label' => false, 'required' => false)); ?>  
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Seconds</label>
                                <?php echo $this->Form->input('seconds', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1second', 'label' => false, 'required' => false)); ?>  
                            </div>
                            <button type="submit" class="btn btn-info"> Submit </button>
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
        $(document).on('change', '.provider', function() {
            var provider = $('.provider').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/tests/chek_question',
                dataType: 'json',
                data: {provider: provider},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('.providesss').html(msg.provide);
                    }
                }
            });
        });

     $(document).on('change', '.test', function() {
            var topic = $('.test').val();
             $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/tests/chek_topic',
                dataType: 'json',
                data: {topic: topic},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('.topics').html(msg.topic);
                    }
                }
            });
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

<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.10.2.js"></script>

<script>
    $("#addButton").click(function(e) {
        $("#items").append('<div><br/><div class="input-group"><input type="text" placeholder="" class="form-control" style="border-right: 0px none;" name="data[Question][options][]"><span class="input-group-btn"><button type="button" class="btn btn-default deleteme"> Delete </button></span></div></div>');
    });
    $(document).ready(function() {
        $("body").on("click", ".deleteme", function(e) {
            $(this).parent().parent().parent().remove();
        });

    });
</script>

<script>
    $("#addButtons").click(function(e) {
        $("#item").append('<div><br/><div class="input-group"><input type="text" placeholder="" class="form-control" style="border-right: 0px none;" name="data[Question][answers][]"><span class="input-group-btn"><button type="button" class="btn btn-default deleteme"> Delete </button></span></div></div>');
    });
    $(document).ready(function() {
        $("body").on("click", ".deleteme", function(e) {
            $(this).parent().parent().parent().remove();
        });

    });
</script>

<script type="text/javascript" src="/developer/js/jquery.min.js"></script>
<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>


<script>
    $("#QuestionWebadminAddQuestionsForm").validate({
        rules: {
            'data[Question][category_id]': {
                required: true,
            },
            'data[Question][test_id]': {
                required: true,
            },
            'data[Question][topic_id]':{
                required:true,
            },
            'data[Question][name]': {
                required: true,
            },
            'data[Question][options][]': {
                required: true,
            },
            'data[Question][answers][]': {
                required: true,
            },
            'data[Question][minutes]': {
                required: true,
            },
            'data[Question][seconds]': {
                required: true,
            },
        },
        messages: {
            'data[Question][category_id]': {
                required: "Please select Category !",
            },
            'data[Question][test_id]': {
                required: "Please select Test ! ",
            },
            'data[Question][topic_id]':{
                required:"Please select Topic !",
            },
            'data[Question][name]': {
                required: "Please enter Question ! ",
            },
            'data[Question][options][]': {
                required: " Please enter options for Question ! ",
            },
            'data[Question][answers][]': {
                required: "Please enter answer ! ",
            },
            'data[Question][minutes]': {
                required: "Please enter  Minutes !",
            },
            'data[Question][seconds]': {
                required: "Please enter  Seconds !",
            },
        },
    });
</script>



<style>
    label.error {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 295px;
    }
</style>






<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Add Faqs</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Faqcontent', array('role' => 'form', 'url' => array('controller' => 'pages', 'action' => 'editquestions',$quest['Faqcontent']['id'])));
                            ?>
                            <!--                                <form role="form">-->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Question</label>
<?php echo $this->Form->input('question', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'required' => false,'value'=>$quest['Faqcontent']['question'])); ?>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Answer</label>
<?php echo $this->Form->input('answer', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1', 'label' => false, 'required' => false,'value'=>$quest['Faqcontent']['answer'])); ?>

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

<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.10.2.js"></script>
<!--        <script src="<?php echo $this->webroot; ?>jquery-ui-1.11.2.custom/jquery-ui.js"></script>-->
<script src="<?php echo $this->webroot; ?>jquery-ui-1.11.2.custom/jquery-ui.js"></script>

<script src="<?php echo $this->webroot; ?>form-master/jquery.validate.js"></script>

<script>
//                          
//                                    $("#FaqWebadminAddForm").validate({
//                                        rules: {
//                                            'data[Faq][question]': {
//                                                required: true,
//                                            },
//                                            'data[Faq][answer]': {
//                                                required: true,
//                                            },
//                                          
//                                        },
//                                        messages: {
//                                            'data[Faq][question]': {
//                                                required: "Please enter the question",
//                                            },
//                                            'data[Faq][answet]': {
//                                                required: "Please enter the answer",
//                                            },
//                                          
//                                        }
//                                    });

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
<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Edit Faqs</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Faq', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'faqs', 'action' => 'edit', $faq_edit_data['Faq']['id'])));
                            ?>
                            <!--                                <form role="form">-->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Question</label>
<?php echo $this->Form->input('question', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'value' => $faq_edit_data['Faq']['question'])); ?>

                            </div>



                            <div class="form-group">
                                <label for="exampleInputPassword1">Answer</label>
<?php echo $this->Form->input('answer', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $faq_edit_data['Faq']['answer'])); ?>

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
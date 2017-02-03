<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Reply</h4>
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <?php if (isset($success)) {
                                ?>
                                <div class="alert alert-success ">
                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <h4>
                                        <i class="icon-ok-sign"></i>
                                    </h4>
                                    <p><strong><h5><?php echo $success; ?></h5></strong></p>
                                </div>
                            <?php } ?> 
                            <?php
                            echo $this->Form->create('Feedback', array('url' => array('controller' => 'pages', 'action' => 'reply/', $value['Feedback']['id']), 'class' => 'cmxform form-horizontal'));
                            ?>
                            <div class="form-group ">
                                <?php echo $this->Form->label('email', 'Email', array('class' => 'control-label col-lg-3')) ?>
                                <div class="col-lg-6">
                                    <?php echo $this->Form->input('email', array('value' => $value['Feedback']['email'], 'class' => "form-control ", 'label' => false, 'readonly' => true)); ?>
                                </div>
                            </div>
                            <div class="form-group ">
                                <?php echo $this->Form->label('message', 'Message', array('class' => 'control-label col-lg-3')) ?>
                                <div class="col-lg-6">
                                    <?php echo $this->Form->input('message', array('type' => 'textarea', 'class' => "form-control ", 'label' => false, 'rows' => 4, 'cols' => 10)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <button class="btn btn-primary" type="submit">Reply</button>
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
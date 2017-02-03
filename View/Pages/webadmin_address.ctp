<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Manage Site Address Details</h4>
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Address', array('url' => array('controller' => 'pages', 'action' => 'address/1'), 'class' => 'cmxform form-horizontal'));
                            ?>
                            <div class="form-group ">

                                <?php echo $this->Form->label('address', 'Address', array('class' => 'control-label col-lg-3')) ?>
                                <div class="col-lg-6">

                                    <?php echo $this->Form->textarea('address', array('value' => $data['Address']['address'], 'class' => "form-control ", 'label' => false, 'rows' => 4, 'cols' => 10)); ?>
                                </div>
                            </div>

                            <div class="form-group ">

                                <?php echo $this->Form->label('phone', 'Phone', array('class' => 'control-label col-lg-3')) ?>
                                <div class="col-lg-6">

                                    <?php echo $this->Form->input('phone', array('value' => $data['Address']['phone'], 'class' => "form-control ", 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group ">

                                <?php echo $this->Form->label('email', 'Email', array('class' => 'control-label col-lg-3')) ?>
                                <div class="col-lg-6">

                                    <?php echo $this->Form->input('email', array('value' => $data['Address']['email'], 'class' => "form-control ", 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group ">

                                <?php echo $this->Form->label('abn_number', 'ABN ', array('class' => 'control-label col-lg-3')) ?>
                                <div class="col-lg-6">

                                    <?php echo $this->Form->input('abn_number', array('value' => $data['Address']['abn_number'], 'class' => "form-control ", 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <button class="btn btn-primary" type="submit">Update</button>
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
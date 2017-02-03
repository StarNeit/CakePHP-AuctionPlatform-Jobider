<div class="banner_1">
    <div class="container">
        <div class="text_contact text-center marg_btm30">
            <h1 style="color:#fff; text-shadow: 0 1px #030303;">Get in Touch</h1>
            <h4 class="marg_btm30">Feel Free to Drop Us a Line to contact us</h4>
            <p>Cras mattis consectetur purus sit amet fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod. Nulla vitae elit libero, a pharetra augue. Aenean eu leo quam. Pellentesque ornare sem lacinia.
            </p>
        </div> 
        <div class="col-md-8 col-sm-12  col-md-offset-2">
            <div class="row text-center">
                <div class="col-md-4 col-sm-4">
                    <div class="link1 text-center marg_tb15">
                        <i><img src="<?php echo $this->webroot; ?>img/icon1.png" alt="AddressIcon"></i><span><?php echo $address['Address']['address']; ?></span>
                    </div>
                </div>
                <div class="col-md-4  col-sm-4">
                    <div class="link1  text-center marg_tb15">
                        <i><img src="<?php echo $this->webroot; ?>img/icon2.png" alt="PhoneImage"></i><span> <?php echo $address['Address']['phone']; ?>  </span>
                    </div>
                </div>
                <div class="col-md-4  col-sm-4">

                    <div class="link1  text-center  marg_tb15">
                        <i><img src="<?php echo $this->webroot; ?>img/icon3.png" alt="EmailImage"></i><span>   <?php echo $address['Address']['email']; ?>    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($success)) {
    ?>
    <div class="alert alert-success " style="margin-top: 27px !important;">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
            x</button>
        <h4>
            <i class="icon-ok-sign"></i>
        </h4>
        <p><strong><h4><?php echo $success; ?></h4></strong></p>
    </div>
<?php } ?>
<div class="container">
    <h2 class="text-center marg_btm30">Contact Us Form</h2>
    <h4 class="cont">Please contact us our team for helping you anytime</h4>
    <?php
    echo $this->Session->flash();
    echo $this->Form->create('Contact', array('url' => array('controller' => 'pages', 'action' => 'contactus'), array('role' => 'form', 'class' => 'from_style')));
    ?>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <?php echo $this->Form->label('name', 'Name'); ?>
            <?php echo $this->Form->input('name', array('id' => 'exampleInputEmail1n', 'value' => '', 'class' => "form-control", 'label' => false,'required'=>true)); ?>
        </div>
    </div>
    <div class="col-md-6 col-sm-6  col-xs-12">
        <div class="form-group">
            <?php echo $this->Form->label('email', 'Email'); ?>
            <?php echo $this->Form->input('email', array('id' => 'exampleInputEmail1e', 'value' => '', 'class' => "form-control", 'label' => false,'required'=>true)); ?>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <?php echo $this->Form->label('message', 'Message'); ?>
            <?php echo $this->Form->input('message', array('type' => 'textarea', 'id' => 'exampleInputEmail1m', 'rows' => '5', 'value' => '', 'class' => "form-control", 'label' => false,'required'=>false)); ?>
        </div>
    </div>
    <div class="col-md-12 marg_btm30 ">
        <button class="btn btn-lg col-md-2 col-sm-4 btn_cust marg_tb15 pull-right" type="submit">Send</button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<style>
    .error-message {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 277px;
        text-align: left;
    }
    .cont {
    color: Black;
    padding-bottom: 5px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 0 !important;
    text-align: center;
}
</style>
<div class="container">
    <h2>Our featured partners :</h2></br>
    <div class="partners_link">
        <?php foreach ($partner_image as $image) { ?>
            <img src="<?php echo $this->webroot; ?>uploads/<?php echo $image['Partner']['image']; ?>" width="125" height="39" alt="PartnerImage"> &nbsp; &nbsp;&nbsp;
        <?php } ?>
    </div>
    <div class="bg_grey online col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2 marg_tb50">
        <div class="row">
            <div class="col-md-4 col-sm-5">
                <div class="online_image text-center"> 
                    <img src="<?php echo $this->webroot; ?>uploads/<?php echo $page_info['Page']['image']; ?>" alt="PartnerImageIcon"/>
                </div>
            </div>
            <div class="col-md-8 col-sm-7 online_image_content">
                <h3><?php echo $page_info['Page']['title']; ?> </h3>
                <p><?php echo substr($page_info['Page']['description'], 0, 105); ?></p>            </div>
        </div>
        <div class="row">
            <ul class="nav marg_tb15">
                <li>
                    <p><?php echo $page_info['Page']['description']; ?></p>
                </li>
            </ul>
        </div>

    </div>
    <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3 marg_btm30">
        <?php
        echo $this->Session->flash();
        ?>
        <div class="bg_grey partner_form">
            <h3 class="marg_0">Become a Partner</h3>
            <!--            <form role="form" class="formstyle form_sighn  padd_30">-->
            <?php
            echo $this->Form->create('Partnerrequest', array('enctype' => 'multipart/form-data', 'role' => 'form', 'class' => 'formstyle form_sighn  padd_30', 'url' => array('controller' => 'partners', 'action' => 'partner_request')));
            ?>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
<!--                        <input type="text" placeholder="Name" class="form-control" id="exampleInputEmail1">-->
                    <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Name', 'id' => 'exampleInputPassword1name', 'label' => false)); ?>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="form-group">
<!--                        <input type="text" placeholder="Email" class="form-control" id="exampleInputEmail1">-->

                    <?php echo $this->Form->input('email', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1email', 'placeholder' => 'Email', 'label' => false)); ?>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <?php echo $this->Form->input('company_name', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Company Name', 'id' => 'exampleInputPassword1cmpny', 'label' => false)); ?>

                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="fileUpload btn btn-primary">
                    <span>Upload</span>
                    <?php echo $this->Form->input('image_name', array('type' => 'file', 'id' => 'exampleInputFileimg', 'class' => 'upload', 'label' => false)); ?>
                </div><div class="textImage"></div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control', 'rows' => '6', 'placeholder' => 'How would you like to partner with us?', 'id' => 'exampleInputPassword1cmmnt', 'label' => false)); ?>
                </div>          
            </div>     

            <div class="col-md-12">
                <button class="btn btn-sm  btn_red btn_red12 pull-left " type="submit">Contact Us</button>
            </div>
            <div class="clearfix"></div>
            <?php echo $this->Form->end(); ?>
            <!--            </form>-->
        </div>
    </div>
</div>

<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>


<script>
    $(document).ready(function() {
        $("#PartnerrequestPartnerForm").validate({
            rules: {
                'data[Partnerrequest][name]': {
                    required: true,
                },
                'data[Partnerrequest][email]': {
                    required: true,
                },
                'data[Partnerrequest][company_name]': {
                    required: true,
                },
                'data[Partnerrequest][image_name]': {
                    required: true,
                },
                'data[Partnerrequest][description]': {
                    required: true,
                },
            },
            messages: {
                'data[Partnerrequest][name]': {
                    required: "Please enter the name !",
                },
                'data[Partnerrequest][email]': {
                    required: "Please enter your valid e-mail !",
                },
                'data[Partnerrequest][company_name]': {
                    required: "Please enter your Company Name !",
                },
                'data[Partnerrequest][image_name]': {
                    required: "Please Choose your Image !",
                },
                'data[Partnerrequest][description]': {
                    required: "Please enter Description !",
                },
            },
        });
    });
    $(document).on('click', '.btn_red', function() {
        $('.textImage').html('<label for="exampleInputFileimg" generated="true" class="error">Please Choose your Image !</label>');
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
        width: 303px;
    }
</style>






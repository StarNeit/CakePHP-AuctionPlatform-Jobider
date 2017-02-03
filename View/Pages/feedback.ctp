<div class="green_head">
    <div class="container">
        <h3 class="text-center marg_0"> <span> Feedback </span> </h3>
    </div>
</div>
<div class="container">
    <div class="privacy_content">
        <h2> Feedback </h2>
        <p>
          Your Feedback is valuable to us and would help us improve. kindly fill in your suggestions.  </p>
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
        <?php }
        ?>
     
        <div class="form_style2">
            <?php
            echo $this->Form->create('Feedback', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'role' => 'form', 'url' => array('controller' => 'pages', 'action' => 'feedback')));
            ?>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('name', 'Name'); ?>

                        <?php echo $this->Form->input('name', array('id' => 'exampleInputEmail1n', 'value' => '', 'class' => "form-control", 'label' => false, 'required' => false)); ?>
<!--                                <input type="text" class="form-control" id="exampleInputEmail1">-->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('email', 'Email'); ?>
                        <?php echo $this->Form->input('email', array('id' => 'exampleInputEmail1e', 'value' => '', 'class' => "form-control", 'label' => false, 'required' => false)); ?>


                    </div> 
                </div>
            </div>

            <div class="row">    
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label> Your Comment </label>
                        <?php //echo $this->Form->label('comment', 'Your Comment'); ?>
                        <?php echo $this->Form->input('comment', array('type' => 'textarea', 'id' => 'exampleInputEmail1c', 'rows' => '5', 'value' => '', 'class' => "form-control", 'label' => false, 'required' => false)); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 marg_tb50 text-center">
                    <button class="btn-lg btn-green col-md-1 col-sm-5 col-xs-12 pull-left mar_btn" style="margin-right: 10px;" type="submit"> Send </button>
                    <button class="btn-lg btn-green col-md-1 col-sm-5  col-xs-12"> Cancel </button>
                </div>
            </div>

            <div class="clearfix"></div>
            <!--            </form>-->
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<!--<script src="<?php //echo $this->webroot . 'form-master/jquery.validate.js';    ?>"></script>
<script>
    $(document).ready(function() {
        $("#FeedbackFeedbackForm").validate({
            rules: {
                'data[Feedback][name]': {
                    required: true,
                },
                'data[Feedback][email]': {
                    required: true,
                },
                'data[Feedback][comment]': {
                    required: true,
                },
            },
            messages: {
                'data[Feedback][name]': {
                    required: "Please enter the name",
                },
                'data[Feedback][email]': {
                    required: "Please enter the email",
                },
                'data[Feedback][comment]': {
                    required: "Please enter the comment",
                },
            },
        });
    });
</script>-->

<style>

   .error-message {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 280px;
    }
</style>

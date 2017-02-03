<div class=" careeer client_resource">

    <div class="container">
        <div class="text_contact text-center marg_btm30 col-md-8 col-md-offset-2">

            <h3> Jobider Enterprise Solutions
            </h3><h4 class="marg_btm30">
                Source, hire, and pay job bidders using the foremost cloud-based freelancer management system.</h4>
            <div class="enterprise_1">
                <p><a href="#RequestaDemo" class="btn-green">REQUEST A DEMO</a></p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col-md-12">
        <div class="enterprise">
            <h1>Discover How Our Specialized Solution Are Helping:</h1>
            <div class="enterprise_inner">
                <div class="enterprise_inner1">
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="layout_full">
                                <a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">

                                    <div class="layout">
                                        <a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">
                                            <img src="<?php echo $this->webroot; ?>img/enterprise1.png" alt="enterpris image icon">
                                            <h3>Marketing</h3>
                                                                                    
  <hr style="width: 38%;"></hr>

                                        </a><p><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'marketing')); ?>">Learn More</a></p>                                </div>
                                </a>   
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="layout_full">
                                <a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">

                                    <div class="layout">
                                        <a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">
                                            <img src="<?php echo $this->webroot; ?>img/enterprise2.png" alt="enterprise imae2">
                                            <h3>Human Resources</h3>
                                             <hr style="width: 38%;"></hr>
                                        </a><p><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Human_Recources')); ?>">Learn More</a></p>
                                    </div>
                                </a> 
                            </div>
                        </div><!--col-sm-3 col-md-3-->
                        <div class="col-sm-3 col-md-3">
                            <div class="layout_full">
                                <a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">
                                    <div class="layout">
                                        <a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">
                                            <img src="<?php echo $this->webroot; ?>img/enterprise3.png" alt="enterprise3">
                                            <h3>Procurement</h3>
                                             <hr style="width: 38%;"></hr>
                                        </a><p><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'Procurement')); ?>">Learn More</a></p>   
                                    </div>
                                </a>
                            </div>
                        </div><!--col-sm-3 col-md-3-->
                        <div class="col-sm-3 col-md-3">
                            <div class="layout_full">
                                <a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">

                                    <div class="layout">
                                        <a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">
                                            <img src="<?php echo $this->webroot; ?>img/enterprise4.png" alt="enterprise4">
                                            <h3>Operations</h3>
                                             <hr style="width: 38%;"></hr>
                                        </a><p><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'operation')); ?>">Learn More</a></p>
                                    </div>
                                </a>
                            </div>
                        </div><!--col-sm-3 col-md-3-->
                    </div><!--row-->
                </div><!--enterprise_inner1-->
            </div><!--enterprise_inner-->
        </div><!--enterprise-->


        <div class="row">
            <div class="col-md-12">
                <div class="enterprise_content">
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="online_image text-center"> <img src="<?php echo $this->webroot; ?>img/online_partner.png" alt="online_partner"> </div>
                    </div>
                    <div class="col-md-8 col-sm-7 col-xs-12 online_image_content">
                        <h3 style="color:#fff;">Jobider is trusted by many of the world’s leading businesses. </h3>
                        <p>"It’s really hard to find subject matter experts who can also communicate clearly. Our freelancers have all kinds of skills and competencies. Upwork Enterprise helps us leverage our freelancers in new and exciting ways." </p>
                    </div>

                </div>
            </div>
        </div>

        <?php if (!isset($success)) { ?>
            <div class="row inputform">
                <div class="col-md-12">
                    <div class="enterprise_info">
                        <h1 id="RequestaDemo">Interested in a demo or learning more? Contact Us.</h1>
                        <?php echo $this->Session->flash(); ?>
                        <?php echo $this->Form->create('Solution', array('url' => array('controller' => 'enterprisesolutions', 'action' => 'index'))); ?>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" placeholder="FIRST NAME" id="exampleInputEmail1f" required="false" class="form-control firstname" name="data[Solution][first_name]">
                            </div>
                        </div> 

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">

                                <input type="text" placeholder="LAST NAME" id="exampleInputEmail1l" required="false" class="form-control lastname" name="data[Solution][last_name]">
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">

                                <input type="text" placeholder=" E-MAIL ADDRESS" id="exampleInputEmail1e" required="false" class="form-control email" name="data[Solution][email]">
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">

                                <input type="text" placeholder="COMPANY NAME" id="exampleInputEmail1c" required="false" class="form-control company" name="data[Solution][company]">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">

                                <input type="text" placeholder="JOB-TITLE" id="exampleInputEmail1j" required="false" class="form-control jobtitle" name="data[Solution][job_title]">
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">

                                <input type="text" placeholder="PHONE" id="exampleInputEmail1p" required="false" class="form-control phone" name='data[Solution][phone]'>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 ">

                            <select class="form-control employ" required="false"  name='data[Solution][employes]'>
                                <option value=''>NUMBER OF EMPLOYEES</option>    
                                <option value='1-99'>1-99</option>
                                <option value='100-999'>100-999</option>
                                <option value='1,000-9,999'>1,000-9,999</option>
                                <option value='10,000+'>10,000+</option>

                            </select>

                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">

                                <textarea rows="5" class="form-control Note" id="exampleInputEmail1n" required="false" placeholder="WRITE A NOTE" name='data[Solution][notes]'></textarea>
                            </div>
                            <p><button class="btn-lg btn-greey submit" type='submit'> SUBMIT </button></p>
                        </div>

                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="row thanks">
                <div class="col-md-12">
                    <div class="enterprise_info">

                        <h1>Thanks for your interest in Private Talent Cloud&trade;</h1><br>
                        <p class="confirm">A member of our team will be in touch with you shortly.<br>
                            Can’t wait? Give us a call! +61-8-82583428</p>

                        <!--   <form>-->
                    </div>
                </div>
            </div>   
        <?php } ?>

    </div><!--col-md-12-->
</div>

<!---JavaScript for Scroll on Button--->

<script>
    $(document).ready(function() {
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = this.hash,
                    $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 1500, 'swing', function() {
                window.location.hash = target;
            });
        });
    });
</script>

<script>
    $(document).ready(function() {

//        $(document).on('click', '.submit', function() {
////              alert('asdkjaskdjk');
//            var first_name = $('.firstname').val();
//            var last_name = $('.lastname').val();
//            var email = $('.email').val();
//            var phone = $('.phone').val();
//            var company = $('.company').val();
//            var jobtitle = $('.jobtitle').val();
//            var employ = $('.employ').val();
//            var Note = $('.Note').val();
//            $.ajax({
//                type:'POST',
//                url:'/enterprisesolutions/index',
//                data:{first_name:first_name,last_name:last_name,email:email,phone:phone,company:company,jobtitle:jobtitle,employ:employ,Note:Note},
//                success:function(data){
//                    $('.inputform').hide();
//                    $('.thanks').show();
//                }
//            });   
//        });
    });
</script>
<style>
    .confirm {
        color: #9f9b9b;
        font-size: 17px;
        padding-bottom: 52px;
    }

</style>

<!-----validations---->
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.min.js"></script>
<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>
<script>
    $("#SolutionIndexForm").validate({
        rules: {
            'data[Solution][first_name]': {
                required: true,
            },
            'data[Solution][last_name]': {
                required: true,
            },
            'data[Solution][company]': {
                required: true,
            },
            'data[Solution][job_title]': {
                required: true,
            },
            'data[Solution][phone]': {
                required: true,
            },
            'data[Solution][employes]': {
                required: true,
            },
            'data[Solution][notes]': {
                required: true,
            },
        },
        messages: {
            'data[Solution][first_name]': {
                required: "Please enter First Name !",
            },
            'data[Solution][last_name]': {
                required: "Please enter Last Name !",
            },
            'data[Solution][email]': {
                required: "Please enter Email address !",
            },
            'data[Solution][company]': {
                required: "Please enter Company !",
            },
            'data[Solution][job_title]': {
                required: "Please enter Job Title !",
            },
            'data[Solution][phone]': {
                required: "Please enter phone !",
            },
            'data[Solution][employes]': {
                required: "Please enter No. of Employees !",
            },
            'data[Solution][notes]': {
                required: "Please enter a Note messsage !",
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
        padding: 0 1%;
        width: 234px;
    }
</style>



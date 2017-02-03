<div class=" careeer client_resource">

    <div class="container">
        <div class="text_contact text-center marg_btm30 col-md-8 col-md-offset-2">

            <h3>Get Excellent Results from Top Jobider Service Providers
            </h3><h4 class="marg_btm30">Hire our Best Freelancers to get Exceptional Results
                Jobider Enterprise will assist you in hiring top job bidders for your projects.</h4>

            <div class="craeer_img">

                <img alt="Resources" src="<?php echo $this->webroot; ?>img/resource.png" class="img-responsive">

            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="col-md-12">

        <div class="human">

            <h1>Get First-rate Creative Work Done On Demand:</h1>

            <p>It takes a significant amount of time to find high-quality independent talent. Many independent professionals lament that they’re treated like vendors instead of people by their clients. Upwork Enterprise is a simplified platform leveraged by Human Resources to source, onboard, and pay a company’s entire network of independent talent. Upwork Enterprise also has built-in communication tools that foster consistent, personalized interactions so you can strengthen organizational culture and keep talent engaged. Looking for fresh talent? Tap into a global freelancer network of specialized talent and invite new members into your company’s talent cloud.</p>


        </div><!--human-->

        <div class="human_content">
            <h1> Projects We Can Help You With:</h1>

            <div class="col-md-4 col-sm-4">
                <div class="human_content_inner">
                    <h3>Design</h3>
                    <ul>
                        <li>Graphics </li>
                        <li>PowerPoint</li>
                        <li>Videography </li>
                        <li>Animated Videos </li>
                        <li>Image Editing </li>
                    </ul>  
                </div><!--human_content_inner-->
            </div><!--col-md-4-->



            <div class="col-md-4 col-sm-4">
                <div class="human_content_inner">
                    <h3>Content Creation</h3>
                    <ul>
                        <li>Ghostwriting</li>
                        <li>Web copy</li>
                        <li>Ad Copy </li>
                        <li>Blog Articles</li>
                        <li>Newsletters</li>
                    </ul>  
                </div><!--human_content_inner-->
            </div><!--col-md-4-->

            <div class="col-md-4 col-sm-4">
                <div class="human_content_inner">
                    <h3>Digital Marketing </h3>
                    <ul>
                        <li>Web design and production</li>
                        <li>Banners and online ads</li>
                        <li>SEO, SEM, SMM</li>
                        <li>Social Media </li>
                        <li>Lead Generation</li>
                    </ul>  
                </div><!--human_content_inner-->
            </div><!--col-md-4-->

        </div><!--human_content-->

        <div class="row">
            <div class="col-md-12">
                <div class="enterprise_content">
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="online_image text-center">
                                     </div>
                    </div>
                    <div class="col-md-8 col-sm-7 col-xs-12 online_image_content">
                    
                    </div>

                </div><!--enterprise_content-->
            </div><!--col-md-12-->
        </div><!--row-->
   <?php  if(!isset($success)){?>
        <div class="row inputform">
            <div class="col-md-12">
                <div class="enterprise_info">
                    <h1 id="RequestaDemo">Interested in a demo or learning more? Contact Us.</h1>
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Form->create('Solution', array('url' => array('controller' => 'enterprisesolutions', 'action' => 'marketing'))); ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" placeholder="FIRST NAME" id="exampleInputEmail1f " required="false" class="form-control firstname" name="data[Solution][first_name]">
                        </div>
                    </div> 
                    
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">

                            <input type="text" placeholder="LAST NAME" id="exampleInputEmail1l" required="false" class="form-control lastname" name="data[Solution][last_name]">
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">

                            <input type="text" placeholder="E-MAIL ADDRESS" id="exampleInputEmail1e" required="false" class="form-control email" name="data[Solution][email]">
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
        <?php } else{?>
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
        
    </div>
   
</div>


<style>
    .confirm {
        color: #9f9b9b;
        font-size: 17px;
        padding-bottom: 52px;
    }

</style>

<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.min.js"></script>
<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>"></script>
<script>
    $("#SolutionMarketingForm").validate({
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



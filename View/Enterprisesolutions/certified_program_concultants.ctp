<div class=" careeer client_resource">

    <div class="container">
        <div class="text_contact text-center marg_btm30 col-md-8 col-md-offset-2">

            <h3> Certified Program Consultants
            </h3><h4 class="marg_btm30">Jobider Enterprise provides you with experts in talent acquisition and distributed team building to help you maximize profits while minimizing costs</h4>

            <div class="craeer_img">

                <img alt="resurces image" src="<?php echo $this->webroot; ?>img/resource.png" class="img-responsive">

            </div>
        </div>


    </div>

</div>


<div class="container">
    <div class="col-md-12">

        <div class="human">

            <h1>Our Certified Program Consultants will assist you in gaining more value from your Jobider Enterprise solution:</h1>

            <p>A Certified Program Consultant can help you establish and launch your organization’s talent cloud. Your Consultant is capable of assembling specialized teams and monitoring and optimizing your processes. As a result, you get work done faster and more efficiently.</p>


        </div><!--human-->

        <div class="human_content">
            <h1>A Certified Program Consultant will assist you:</h1>
            <!--<h4>A Certified Program Consultant will assist you:</h4>-->

            <ul>
                <li>Train users on best practices for working with team members from different parts of the world</li>
                <li>Manage operational workflows and team strategy</li>
                <li>Consult on strategic talent procurement</li>
                <li>Support during launch milestones </li>
                <li>Design communication flow for Jobider Enterprise</li>
                <li>Acclimate your in-house and freelance users to Jobider Enterprise </li>
                <li>Consult on how to make sure you hire the best job bidders</li>
                <!--<li>Acclimate your in-house and freelance users to Jobider Enterprise </li>-->
            </ul>  

        </div><!--human_content-->

        <!--<div class="human_bottom">
        <h1>Discover real examples from HR leaders:</h1>
        <a>Next-Gen Talent Management (PDF)</a><br>
        
        
        
        </div>-->



        <div class="row">
            <div class="col-md-12">
                <div class="enterprise_content">



<!--        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>-->


                </div><!--enterprise_content-->
            </div>
        </div><!--col-md-12-->


        <?php if (!isset($success)) { ?>
            <div class="row inputform">
                <div class="col-md-12">
                    <div class="enterprise_info">
                        <h1 id="RequestaDemo">Interested in a demo or learning more? Contact Us.</h1>
                        <?php echo $this->Session->flash(); ?>
                        <?php echo $this->Form->create('Solution', array('url' => array('controller' => 'enterprisesolutions', 'action' => 'certified_program_concultants'))); ?>
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

                                <input type="text" placeholder="EMAIL-ADDRESS" id="exampleInputEmail1e" required="false" class="form-control email" name="data[Solution][email]">
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
    $("#SolutionCertifiedProgramConcultantsForm").validate({
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
        width: 240px;
    }

</style>



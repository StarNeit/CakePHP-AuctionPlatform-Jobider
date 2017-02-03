<div class="container">
    <div class="plans">
        <div class="col-md-12">
            <h2 class="text-center"> Work at Home . . . Work Anywhere </h2>

            <h1 class="text-center">Welcome to Jobider? </h1>
            <h4> What is Jobider? </h4>
            <p> 
                Jobider is short for Job-bidder. Jobider connects businesses with expert freelancers around the world. Business owners get access to a big 
                pool of talented individuals who can help them with various projects while skilled workers are provided with several opportunities to 
                showcase their skills to a global market where they get to choose fulfilling jobs. <br>
                Jobider was created for today's modern workforce. This innovative job platform was inspired by today's new era of globalization where working 
                is no longer confined to one common work environment. You can work from home. You can work from anywhere in the world.<br>
                Jobider is a trusted online workplace where business owners can post online jobs for free and freelancers can apply to jobs and earn income 
                without paying any additional fees. It is the fastest and most efficient way to post your projects and find qualified freelancers/contractors/
                employees or teams of experts.  <br>
                At Jobider, we have qualified freelancers who specialize in IT, Networking, Web and Mobile Development, Engineering, Architecture, Design, 
                Writing, Translation, Sales, Marketing, Customer Service, Accounting, Consulting and Administrative Support. <br>
                Jobider helps businesses/employers in the selection, recruitment and evaluation of freelancers to make sure that each contractor hired will be a 
                good fit to the employer's requirements.  <br>
                Unlike other platforms, at Jobider, both parties will benefit from the expertise of independent Business Managers who will be responsible for 
                verifying freelancer qualifications, shortlisting candidates and providing support during the entire selection process. <br>

            </p>

            <h4> What are the advantages of working on Jobider? </h4>
            <p>
                At Jobider, skilled freelancers get access to numerous online jobs. We also provide you with tools and resources that will help you build 
                and enhance your online career.</p>
            <h5> There are no hidden charges</h5>
            <p> Create your profile, apply to job openings and get interviews for free.</p>
            <h5> We are equipped with state-of-the-art technology </h5>
            <p> To ensure that freelancers get paid for work done, we have developed an app that will track your time and enable quick payment from 
                clients.</p>
            <h5> Jobider is the only job platform that has Business Managers to assist you </h5>
            <p> Jobider has independent Business Managers on hand to assist you with any enquiries or other concerns you may have. They help employers 
                assess candidates for a job, handle communications between an employer and a freelancer; check tasks and follow-up, whenever necessary.</p>

            <h5> Reap the rewards of doing excellent work</h5>
            <p>
                When you provide excellent work through Jobider, clients will provide great reviews. These, in turn will help you gain more work which means
                more money and a big boost to your reputation as a freelancer.
            </p>

            <h1> How will Jobider benefit from the work of registered freelancers? </h1>
            <h4> Service Fee </h4>
            <p>
                Creating a profile, applying for jobs and interviews on Jobider are free. However, we do charge a small service fee.
                Jobider charges an 8% service fee on all projects. This fee is shouldered by the job-bidder or freelancer. For every payment an employer makes, 
                92% goes to the job-bidder/freelancer and 8% goes to Jobider. For example, if you accept a job that pays a rate of $10/hour, you will receive 
                $9.2/hour and Jobider will receive $.80 for every hour you work. Therefore, if you want to receive $10/hour, you need to add a small mark-up of 
                $.87 to the rate, making it $10.87/hour. 
            </p>

            <h4> The Jobider Membership Platform </h4>
            <p>
                All job-bidders and Jobider agencies are required to subscribe to the Jobider membership platform. Subscription to the Jobider Primary 
                membership is free of charge and provides tools and resources that will help you succeed in your online career.
                Job bidders seeking additional benefits may avail of our Premium membership. We also offer free and premium memberships to agencies.
            </p>

            <h4> For individual job bidders </h4>
            <ol>
                <li> 
                    <h5>Individual primary membership </h5>
                    Our primary membership includes a complete Jobider profile, 50 links for each billing period, limitless invitations to jobs, and secure 
                    payment.
                </li>


                <li>
                    <h5>Individual premium membership - $5 per month </h5>
                    Our premium membership will include everything under the primary membership, an additional 10 links per month (or a total of 60 links), 
                    the ability to roll over up to 60 unused links to the next billing period, the ability to purchase more links, and the ability to see the 
                    proposals of other job bidders applying to similar jobs. 
                </li>

            </ol>


            <ol>
                <h4>For agencies </h4>
                <li>
                    <h5>Jobider primary agency membership</h5>
                    <p> Our primary agency membership includes a Jobider profile with the company name and company logo, 55 links per billing period, limitless 
                        invitations to jobs and secure payment. Team members cannot be added or assigned to work under the primary agency membership plan.</p>
                </li>

                <li>
                    <h5>Jobider agency premium membership - $15 to $40 per month </h5>
                    For small agencies, ($15 per month), under our agency premium membership, the agency owner can add up to three (3) team members with complete
                    profiles. This includes everything under the primary agency membership plan and the team members' ability to share links. The agency 
                    premium membership includes 70 links that can be rolled over to the next billing period, the ability to purchase extra links and the 
                    ability to see other job bidders' proposals to similar jobs, limitless invitations to jobs, and secure payment. <br> <br>

                    For large agencies or agencies with more than three team members, agency owners will be charged $40 per month. This includes everything under the
                    primary agency membership plus the ability to add unlimited team members.
                </li>

            </ol>
        </div>

        <!--plan_tb start -->
        <div class="plan_tb">
            <div class="clearfix"></div>
            <?php echo $this->Session->flash(); ?>
            <?php if ($user['User']['employer_type'] != 'company') {
                ?>
                <div class="col-md-12" id="individuals">
                    <h1> Benefits of the Jobider Membership Platform </h1>
                    <h2>    Benefits for Individual Job-bidders </h2>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="bs-example" data-example-id="simple-responsive-table">
                                <div class="table-responsive">
                                    <?php echo $this->Form->create('User', array('url' => array('controller' => 'freelancer', 'action' => 'viewandedit_membershipPlans'))); ?>
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Features</th>
                                                <th> Primary   $0</th>
                                                <th> Premium $5</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Links per month </td>
                                                <td>50 per month</td>
                                                <td>60 per month </td>
                                            </tr>
                                            <tr>
                                                <td>Secure work diary </td>
                                                <td>yes</td>
                                                <td>yes </td>
                                            </tr>
                                            <tr>
                                                <td>Secure payment </td>
                                                <td>yes</td>
                                                <td>yes</td>
                                            </tr>
                                            <tr>
                                                <td>Roll over of unused links </td>
                                                <td>No</td>
                                                <td>yes</td>
                                            </tr>
                                            <tr>
                                                <td> Purchase of additional links </td>
                                                <td>No</td>
                                                <td>yes</td>
                                            </tr>
                                            <tr>
                                                <td>Visibility of competitor bids </td>
                                                <td>No</td>
                                                <td>yes</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <?php
                                                if (isset($finaldate)) {
                                                    if (strtotime($finaldate) < time()) {
                                                        ?>
                                                        <td><button type="submit" class="BuyMembership"> Buy Now </button></td> 
                                                        <?php
                                                    }else {
                                                    ?>
                                                    <td><button type="button" class="notBuyMembership"> Buy Now </button></td> 
                                                <?php } } else {
                                                    ?>
                                                    <td><button type="submit" class="BuyMembership"> Buy Now </button></td> 
                                                <?php }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                                <!-- /.table-responsive --> 

                                <!-- /.table-responsive --> 
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-12" id="individual">
                    <h2>   Benefits for Agencies </h2>
                </div>
                <div class="col-md-11">
                    <div class="bs-example" data-example-id="simple-responsive-table">
                        <div class="table-responsive">
                            <table class="table  new_tb table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30%">Features</th>
                                        <th>Primary</th>
                                        <th>Small Agency </th>
                                        <th>Large Agency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> No. of team members </td>
                                        <td>1 </td>
                                        <td>3</td>
                                        <td>unlimited</td>
                                    </tr><tr>
                                        <td> Links per month and fees </td>
                                        <td>55 links at $0</td>
                                        <td>70 links at $15 + the ability to purchase more links</td>
                                        <td>70 links at $40 + ability to purchase more links</td>
                                    </tr>
                                    <tr>
                                        <td>Secure work diary</td>
                                        <td>yes</td>
                                        <td>yes</td>
                                        <td>yes</td>
                                    </tr>
                                    <tr>
                                        <td>Secure payment</td>
                                        <td>yes</td>
                                        <td>yes</td>
                                        <td>yes</td>
                                    </tr>
                                    <tr>
                                        <td>Roll over of unused links </td>
                                        <td>No</td>
                                        <td>yes</td>
                                        <td>yes</td>
                                    </tr>
                                    <tr>
                                        <td>Purchase of additional links</td>
                                        <td>No</td>
                                        <td>yes</td>
                                        <td>yes </td>
                                    </tr>
                                    <tr>
                                    </tr><tr>
                                        <td>Visibility of competitor bids</td>
                                        <td>No</td>
                                        <td>yes</td>
                                        <td>yes</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <?php
                                            if (isset($finaldate)) {

                                                if (strtotime($finaldate) < time()) {
                                                    ?>
                                                    <button class="smallAgency"> Buy Now </button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button class="smallAgencyWarning"> Buy Now </button>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <button class="smallAgency"> Buy Now </button>
    <?php } ?>
                                        </td>
                                        <td> <?php
                                            if (isset($finaldate)) {
                                                if (strtotime($finaldate) < time()) {
                                                    ?>
                                                    <button class="largeAgency"> Buy Now </button>
                                                <?php
                                                } else {
                                                ?>
                                                <button class="largeAgencyWarning"> Buy Now </button>
    <?php }} else {
                                                ?>
                                                <button class="largeAgency"> Buy Now </button>
    <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive --> 

                        <!-- /.table-responsive --> 
                    </div>
                </div>
<?php } ?>
            <div class="clearfix"> </div>
        </div>
        <!--plan_tb closed --> 

        <!--plans start -->
        <div class="new_plan">
            <div class="col-md-12">
                <div class="plans">
                    <h1> What are links? </h1>
                    <p> Links serve as a job bidders permits for submitting applications. If a client invites you to apply to his/her job post, or if you 
                        are being rehired, your links will not be used. Other applications require 1 to 5 links depending on the type and size of the project.
                        Each Jobider membership plan comes with a link budget. For individual job bidders, the primary membership plan comes with 50 links per month and 
                        the premium plan has 60 links and the job bidder's ability to buy more links as well as roll over unused links to the following month. For 
                        agencies, the primary agency membership plan comes with 55 links per month and the premium agency plan comes with 70 links per month. Unused 
                        links can be rolled over to the next billing period.</p>

                    <h1>What are roll over links? </h1>
                    <p> Unused links can be rolled over once, to the following billing period. For example, a job bidder has ten (10) links left in the 
                        current billing cycle, he can roll these over to the next billing period. Since each billing period comes with 60 links, the unused 
                        links will be added and the total links of the job bidder for the next billing cycle will be 70. However, if the job bidder still does
                        not use the 10 links, the total number of links for the next billing period will revert back to 60 and the 10 unused links will be 
                        forfeited.</p>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!--plans closed --> 

    </div>
    <!--plans closed--> 
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.notBuyMembership', function () {
            alert('You have already purchased the Connects of this Month.');
            return false;
        });
        $(document).on('click', '.largeAgencyWarning', function () {
            alert('You have already purchased the Connects of this Month.');
            return false;
        });
        $(document).on('click', '.smallAgencyWarning', function () {
            alert('You have already purchased the Connects of this Month.');
            return false;
        });
        $(document).on('click', '.smallAgency', function () {
            var small_agency = 'small_agency';
            window.location = '<?php echo $this->webroot . 'freelancer/membershipforSmallAgency'; ?>';
        });
        $(document).on('click', '.largeAgency', function () {
            var small_agency = 'largeAgency';
            window.location = '<?php echo $this->webroot . 'freelancer/membershipforlargeAgency'; ?>';
        });


    });

</script>
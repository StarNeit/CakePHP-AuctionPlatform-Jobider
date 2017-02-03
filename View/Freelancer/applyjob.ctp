
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-9 col-sm-9">
            <h2>Apply to job</h2>
            <?php
            echo $this->Session->flash();
            echo $this->Form->create('Jobdetail', array('class' => 'apply_jobform', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'applyjob/' . $id)));
            ?>
            <div class="row">
                <label class="col-sm-3">Job Posting</label>
                <div class="col-sm-9">
                    <?php echo $JOB['Job']['job_title']; ?> <a href="<?php echo $this->webroot; ?>freelancer/jobdetails/<?php echo $id; ?>" class="marg_l20">View Job posting</a>
                </div>
            </div>
            <br/>

            <div class="row">
                <label class="col-sm-3">Connects Required</label>
                <div class="col-sm-9">
                    <input type="hidden" value="<?php echo $used_connects ?>" name="data[Jobdetail][used_connects]">
                    <input type="hidden" value="job application" name="data[Jobdetail][contect_type]">
                    <input type="hidden" value="<?php  echo $remain; ?>" name="data[Jobdetail][remain_connects]">
                    <?php  echo $used_connects; ?> Connects <br/>
                    If you apply to this job, you'll have <?php echo $remain ?> Connects remaining. 
                </div>
            </div>

            <br/>
            <div class="row">
                <label class="col-sm-3">Propose Terms</label>
                <div class="col-sm-9">
                    <p class="marg_0">Propose a fixed-price bid of :</p>
                    <div class="bg_grey1">
                        <div class="row">
                            <div class="col-md-7"> Bid <br/>
                                This is what
                                the client sees </div>
                            <div class="col-md-5">
                                <font class="pull-left mrg_r5">$</font>
                                <?php echo $this->Form->input('porpose_terms', array('class' => 'pull-left paid', 'type' => 'text', 'value' => '0.00', 'label' => false, 'required' => false)); ?>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-7">You'll earn </div>
                            <div class="col-md-5">
                                <font class="pull-left mrg_r5">$</font> <?php echo $this->Form->input('earn_amount', array('class' => 'pull-left tens', 'type' => 'text', 'value' => '0.00', 'label' => false, 'required' => false)); ?>
                            </div>
                        </div>
                        <br/>
                      
                    </div>
                    <p class="marg_0">NOTE: The client's budget is <?php echo $jobs['Job']['budget'] . '.00'; ?> US Dollars.</p>
                </div>
            </div>
            <br/>

            <div class="row marg_btm30">
                <label class="col-sm-3">Estimated Duration</label>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('duration', array('class' => 'pull-left col-md-4', 'type' => 'select', 'options' => array('' => 'Please Select.......... ', 'More than 6 months ' => 'More than 6 months', '3 to 6 months' => '3 to 6 months', '1 to 3 months' => '1 to 3 months', 'Less than 1 month' => 'less than 1 month', 'Less than 1 week' => 'Less than 1 week'), 'label' => false, 'required' => false)); ?>
                </div>
            </div>
            <div class="row marg_btm30">
                <label class="col-sm-3">Cover Letter</label>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('cover_letter', array('class' => 'col-md-9', 'type' => 'textarea', 'rows' => '5', 'label' => false, 'required' => false)); ?>
                    <div class="clearfix"></div>
                    <p class="text-right col-md-9 pad_r0  font_14">500 characters left</p>
                </div>
            </div>
            <div class="row marg_btm30">
                <label class="col-sm-3">Additional Questions</label>
                <?php foreach ($additional_question as $val) { ?>
                    <div class="col-sm-9 col-sm-offset-3">
                        <p><?php echo $val; ?></p>
                        <textarea name='data[Jobdetail][additional_question][]' class='col-md-9 marg_btm30' rows='5' request=false></textarea>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm-9 col-sm-offset-3 pad_l0">
                <?php if ($connectstatus == 'completed') { ?>
                    <button class="btn-lg btn-green col-md-4 col-sm-3 col-xs-4 connects" type="button">Apply This Job</button>
                    <?php
                } else {
                    ?>
                    <button class="btn-lg btn-green col-md-4 col-sm-3 col-xs-4 " type="submit">Apply This Job</button>
                    <?php
                }
                ?>

                <button class="btn-lg btn-green col-md-3 col-sm-3 col-xs-4 marg_l20" type="reset" >Cancel</button>
                <!--  <form role="form" class="apply_jobform">-->
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        <div class="col-md-3 col-sm-3 pad_r0">
            <?php echo $this->Form->create('Category', array('class' => 'search_box', 'role' => 'search', 'url' => array('controller' => 'freelancer', 'action' => 'applyjob/' . $id))); ?>
            <form class="search_box" role="search">
                <div class="form-group">
                    <div class="input-group col-md-12">
                        <label>Search Jobs</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Job Title"id='searchbar' name="data[Category][search]">
                            <div class="input-group-addon padd_0"><button type="button" class="search_job" id='search_data'>Search</button></div>
                        </div> 
                    </div>
                </div>
            </form>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">My Profile </div>
                <div class="panel-body bg_grey1 padd_0">
                    <div class="col-md-3 col-sm-4 col-xs-4 marg_tb15">
                        <?php if (isset($user_data['User']['image']) && !empty($user_data['User']['image'])) { ?>
                            <img alt="login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $user_data['User']['image']; ?>"  height="56" width="56" >
                        <?php } else { ?>
                            <img alt="dummy user image" src="<?php echo $this->webroot; ?>img/user_img.png">
                        <?php } ?>
                    </div>
                    <div class="col-md-9 col-sm-8 marg_tb15">
                        <h4 class="marg_0"><?php echo $user_data['User']['first_name']; ?></h4>
                        <p><i><img alt="Edit icon image" class="mrg_r5" src="<?php echo $this->webroot; ?>img/edit.png"></i><a class="font_12" href="<?php echo $this->Html->Url('/freelancer/editprofile'); ?>">Edit Your Profile</a></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="brder_btm"></div>
                </div>
            </div>
            <?php if (!empty($cat_name)) { ?>
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Categories</div>
                    <div class="panel-body bg_grey1 padd_0">
                        <?php foreach ($cat_name as $val) { ?>
                            <ul class="nav">
                                <li><a href="<?php echo $this->webroot; ?>freelancer/category_job/<?php echo $val['Subcategory']['id']; ?>"><?php echo $val['Subcategory']['category_name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div> 
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#JobdetailApplyjobForm').children().children().val('');
        $(document).on('click', '.search_job', function () {
            var search = $('#searchbar').val();
            if (search == '') {
                alert('Please Enter the Search Keyword !');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });
        $('.paid').on('keyup', function () {
            var paid = $('.paid').val();
            var ten = paid * 8 / 100;
           // alert(ten);
            var tens = parseInt(paid) - ten;
            var num=tens.toFixed(2);
            $('.ten').html(ten)
         $('.tens').val(num)
        $('.tens1').val(tens);
        });
        $('.connects').on('click', function () {
            alert('Sorry.You have no connects and you cant applied to the Job.');
            return false;
        });
    });

</script>

<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.min.js"></script>
<script src="<?php echo $this->webroot . 'form-master/jquery.validate.js'; ?>">
</script>

<script>
    $('#JobdetailApplyjobForm').validate({
        rules: {
            'data[Jobdetail][porpose_terms]': {
                required: true,
            },
            'data[Jobdetail][upfront_payment]': {
                required: true,
            },
            'data[Jobdetail][duration]': {
                required: true,
            },
            'data[Jobdetail][cover_letter]': {
                required: true,
            },
            'data[Jobdetail][additional_question]': {
                required: true,
            },
        },
        messages: {
            'data[Jobdetail][porpose_terms]': {
                required: "Please enter Purpose terms !",
            },
            'data[Jobdetail][upfront_payment]': {
                required: "Please enter upfront Payment !",
            },
            'data[Jobdetail][duration]': {
                required: "Please Select the Duration !",
            },
            'data[Jobdetail][cover_letter]': {
                required: "Please enter the Cover Letters !",
            },
            'data[Jobdetail][additional_question]': {
                required: "Please enter Additional Questions ! ",
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
        padding: 0 3%;
        width: 295px;
    }
</style>








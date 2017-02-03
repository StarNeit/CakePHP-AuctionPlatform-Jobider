<div class="container">
    <?php if (!empty($users)) { ?>
        <hr class="brder_btm">

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="green_bg panel panel-default side_bar">
                    <!-- Default panel contents -->


                    <ul class="nav padd_tb15 publicl_profile">

                        <li><i class="mrg_r5 pull-left"><img alt="starimage" src="<?php echo $this->webroot; ?>img/star_1.png" alt="star image"></i><span class="mrg_r5 pull-left marg_t5">4.8</span><ul class="list-inline">

                                <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="starimage"></li>
                                <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="star image"></li>
                                <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="star image"></li>
                                <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="star image" ></li>
                                <li><img alt="starimage" src="<?php echo $this->webroot; ?>img/star.png" alt="star image"></li>
                            </ul></li>
                        <li><i class="mrg_r5 pull-left"><img alt="starimage" src="<?php echo $this->webroot; ?>img/job.png"></i>
                            <span class="mrg_r5 pull-left marg_t5">50 Total jobs worked <div class="clearfix"></div><strong class="font_12">(2 Jobs in process)</strong></span>

                        </li>
                        <?php if (!empty($country_name['Country']['name'])) { ?>
                            <li class="wdf_100"><i class="mrg_r5 pull-left"><img src="<?php echo $this->webroot; ?>img/location.png" alt="loc"/></i>  <span class="mrg_r5 pull-left marg_t5"><?php echo $country_name['Country']['name']; ?></span></li>
                        <?php } else { ?>
                            <li class="wdf_100"><i class="mrg_r5 pull-left"><img src="<?php echo $this->webroot; ?>img/location.png" alt="loc"/></i>  <span class="mrg_r5 pull-left marg_t5">Brazil</span></li>
                        <?php } ?>

                    </ul>
                    <!--                <div class="col-md-12 text-center">
                    
                                        <button class="btn-lg btn-green col-md-6 col-md-offset-3">Contact</button>
                                    </div>-->
                    <div class="clearfix"></div>
                    <!-- List group -->


                </div>

                <div class="green_bg panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"> <h3 class="marg_0">Tasks Taken</h3></div>
                    <?php if (isset($tasks) and !empty($tasks)) { ?>
                        <div class="table-responsive">

                            <table class="table cust_table">

                                <thead>
                                    <tr class="panel1">
                                        <th><h4 class="marg_0">Name</h4></th>
                                <th class="text-right"><h4 class="marg_0">Percentile Score</h4></th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($tasks) and !empty($tasks)) {
                                        foreach ($tasks as $kk => $val) {
                                            ?>
                                            <tr>
                                                <?php foreach ($val['test'] as $va) { ?>
                                                    <td><?php echo $va['Test']['title']; ?></td>
                                                <?php } ?>
                                                <td><?php echo $val['percent']; ?></td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?> 
                            </table>


                            <!-- List group -->

                        </div>
                    <?php } else { ?>
                        <div class="table-responsive">

                            <table class="table cust_table">

                                <thead>

                                </thead>
                                <tbody>
                                    <tr>  <p style="color: #C7C4C8; text-align: center;  font-size: 18px; padding:35px;"> 
                                    <strong>You have taken no tasks.</strong>
                                </p>
                                </tr>

                                </tbody>
                            </table>


                            <!-- List group -->

                        </div>
                    <?php } ?>
                </div>  

            </div>

            <div class="col-md-8 col-sm-8 marg_btm30">


                <div class="clearfix"></div>

                <!--white_bg start --> 
                <div class="bg_white freelaners marg_btm30">
                    <div class="green">
                        <?php echo $users['User']['first_name'] . ' ' . $users['User']['last_name']; ?><span class="date pull-right"><i class="mrg_r5">
                        <?php if (!empty($subskill)) { ?>
                                    <img alt="job" src="<?php echo $this->webroot; ?>img/deatil.png"></i><?php echo $users['User']['job_title']; ?> ( <?php echo substr($subskill, 0, strpos($subskill, ',', 10)); ?>   )

                            <?php } ?></span>
                        </span>
                        <div class="clearfix"></div></div> 
                    <div class="col-md-2 col-sm-2 marg_tb15">
                        <?php if (!empty($users['User']['image'])) { ?>
                            <img class="img-thumbnail" alt="img" src="<?php echo $this->webroot; ?>uploads/<?php echo $users['User']['image']; ?>" height="100" width="100">
                        <?php } else { ?>
                            <img class="img-thumbnail" alt="user" src="<?php echo $this->webroot; ?>img/user_1.png" width="100" height="100">
                        <?php } ?>
                    </div>
                    <?php if (!empty($users['User']['description'])) { ?>
                        <div class="col-md-10 colsm-10 marg_tb15 lesval ">
                            <p><?php echo substr($users['User']['description'], 0, 300) . '....'; ?>
                                <a href="JavaScript:void(0);" class='more' >more</a>
                            </p>
                        </div>
                        <div class="col-md-10 colsm-10 marg_tb15 moreval hide ">
                            <p><?php echo $users['User']['description']; ?>
                                <a href="JavaScript:void(0);" class='less' >less</a>
                            </p>
                        </div>
                    <?php } ?>

                    <div class="clearfix"> </div>
                    <!--  <hr class="brder_btm1">-->
                    <hr class="brder_btm marg_0">   
                    <div class="tabs_1 col-md-12 marg_t5">
                        <div class="col-md-10 colsm-10 more_skills ">
                            <?php
                            $k = 0;
                            $total = count($Subskill);
                            foreach ($Subskill as $k => $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
                                <?php
                                if ($k == '3') {
                                    break;
                                } $k++;
                            }
                            ?>
                            <?php if ($total > 4) { ?>
                                <a href="JavaScript:void(0);" class="more_skill subskil" style="background: #2A6EB3;color:#fff; text-decoration: none;">More Skills</a>
                            <?php } ?>
                        </div>
                        <div class="col-md-10 colsm-10 less_skills hide ">
                            <?php
                            $k = 0;
                            $total = count($Subskill);
                            foreach ($Subskill as $k => $val) {
                                ?>
                                <button type='button' class='subskil'disabled> <?php echo $val['Subskill']['skill_name']; ?>
                                </button>
                                <?php
                                $k++;
                            }
                            ?>

                            <a href="JavaScript:void(0);" class="less_skill subskil"  style="background: #2A6EB3;color:#fff; text-decoration: none;">Less Skills</a>

                        </div>
                    </div>

                    <div class="clearfix "></div>
                    <br/>
                    <hr class="brder_btm marg_0"></hr>
    <?php echo $this->Form->create('Contect', array('class' => 'formstyle form_sighn form_style2 marg_tb15', 'url' => array('controller' => 'client', 'action' => 'contect_for_freelancer', $users['User']['id']), 'role' => 'form')); ?>
                    <!--				<form role="form" class="formstyle form_sighn form_style2 marg_tb15">-->
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label> Message </label>
                            <input type='hidden' name='data[Contect][total_amount]' value='' id='totalData'>
                            <textarea class="form-control" rows="7" name='data[Contect][messages]'><?php echo $message; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label> choose a job </label> <br>
                            <div class="row">	

                                <div class="col-md-3 col-sm-5 col-xs-6 ">
                                    <input type="radio" value="existjob" name="data[Contect][jobs]" checked="" id="ContectJobsExistjob" required="false"/>Choose a existing job

                                </div>
                                <div class="col-md-5" id="selctdata">
                                    <input type='hidden' id='userid' value='<?php echo $users['User']['id']; ?>' class=''>
    <?php if (!empty($job_data)) { ?>
                                        <select class="form-control slect" name="data[Contect][job_id]">           <?php foreach ($job_data as $val) { ?>
                                                <option value='<?php echo $val['Job']['id'] ?>'><?php echo $val['Job']['job_title']; ?></option>
                                        <?php } ?>
                                        </select>
    <?php } ?>
                                </div>

                                <div class="col-md-12 col-xs-12">
                                    <input type="radio" value="postjob" name="data[Contect][jobs]"  id="ContectJobsPostjob"/>Create a new job
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12" id="jobdes">
                        <div class="form-group">
                            <label> Job Description  </label>
                            <input type='hidden' name='data[Contect][job_description]'value='' id='desrcip'>
                            <p id='desc'></p>
                        </div>
                    </div>
                    <div class="col-md-12 marg_tb50 text-center invite " id="sub">
                        <button class="btn-lg btn-green col-md-4 col-sm-5 col-xs-12 pull-left  invitation"  type="submit" name="send" value="send"> Send Invitation </button>
                        <a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'freelancer_profile', $users['User']['id'])); ?>"><button class="btn-lg btn-green col-md-2 col-sm-5 col-sm-offset-1  col-md-offset-1 col-xs-12" type="button" > Cancel </button></a>
                    </div>

                    <div id="datadiv" class="data hide">

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label> Type of work </label>
    <?php echo $this->Form->input('category_id', array('class' => 'form-control category', 'type' => 'select', 'label' => false, 'options' => array('' => 'Please Select.....', $category), 'required' => false)); ?>
                            </div> </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label style="color:#fff;"> f </label>
    <?php echo $this->Form->input('subcategory_id', array('class' => 'form-control subcategory', 'type' => 'select', 'label' => false, 'options' => array('' => 'Please Select.....'), 'disabled' => 'disabled', 'required' => false)); ?>
                            </div> </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label> Give your job a title </label>
                                <div class="input-group datepicker">
    <?php echo $this->Form->input('job_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'required' => false)); ?>
    <!--						<input type="text" class="form-control" id="exampleInputEmail1">-->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label> Job description </label>
    <?php echo $this->Form->input('description', array('class' => 'form-control', 'type' => 'textarea', 'rows' => '3', 'label' => false, 'required' => false)); ?>
    <!--					<textarea class="form-control" rows="3"></textarea>-->
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label> Budget </label>
    <?php echo $this->Form->input('budget', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => '$', 'required' => false)); ?>
                            </div>
                        </div>   
                        <div class="col-md-7 col-sm-6">
                            <div class="form-group">
                                <label>Planned Start date </label>
                                <div class="input-group datepicker">
    <?php echo $this->Form->input('start_date', array('class' => 'col-md-11 datepck', 'type' => 'text', 'id' => 'datepicker1', 'label' => false, 'required' => false)); ?>
                               <!--       <input type="text" id="datepicker1" class="col-md-11">-->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Estimated Duration </label>
    <?php echo $this->Form->input('duration', array('class' => 'form-control', 'type' => 'select', 'label' => false, 'options' => array('' => 'Please Select.....', 'more than 6 months' => 'more than 6 months', '3 to 6 months' => '3 to 6 months', '1 to 3 minths' => '1 to 3 months', 'less than 1 month' => 'less than 1 month', 'less than 1 week' => 'less than 1 week'), 'required' => false)); ?>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label> Make job public?</label>
                                <div class="checkbox">
                                    <input type="checkbox" checked=''> <span> Make this job public so that the other freelancers can find it and apply. </span>
                                </div>
                            </div>
                        </div>

                    </div>     

                    <div class="col-md-12 marg_tb50 text-center  hide " id="subm">
                        <button class="btn-lg btn-green col-md-4 col-sm-5 col-xs-12 pull-left "  type="submit" name="post" value="post"> Send Invitation </button>
                        <a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'freelancer_profile', $users['User']['id'])); ?>"><button class="btn-lg btn-green col-md-2 col-sm-5 col-sm-offset-1 col-md-offset-1 col-xs-12" type="button" > Cancel </button></a>
                    </div>

                    <!--                <div class="col-md-12">  
                                        <div class="freelancer">
                                            <p> Already know this freelancer ? <a href="#"> Hire Now </a> </p>
                                        </div> 
                                    </div>   -->
                    <div class="clearfix"></div>
                </div> <?php echo $this->Form->end(); ?>
                <div class="clearfix"></div>
            </div>

            <!--white_bg closed --> 




        </div>

<?php } else { ?>
        <div class="row">
            <div class="col-md-12">
                <p><i><img class="mrg_r5" alt="back" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $this->webroot; ?>client">Back to Search Result</a></p>
            </div>
            <p style="font-size: 20px; color: #C7CBD6"> The User Cannot Be Found</p>

            <div class="col-md-8 col-sm-8 marg_btm30" style="padding: 100px;">






            </div>



        </div>
<?php } ?>

</div>

<script>
    $(document).ready(function() {
        $('#ContectJobsExistjob').click(function() {
            //alert('djhfjdh');
            chkPanelChanged();

        });
        $('#ContectJobsPostjob').click(function() {
            chkPanelChanged();
        });
        function chkPanelChanged() {
            if ($('#ContectJobsExistjob').is(':checked')) {
                //	alert('hfdjhf');
                $('#selctdata').removeClass('hide');
                $('#jobdes').removeClass('hide');
                $('#sub').removeClass('hide');
                $('#datadiv').addClass('hide');
                $('#subm').addClass('hide');
            }
            if ($('#ContectJobsPostjob').is(':checked')) {
                $('#datadiv').removeClass('hide');
                $('#subm').removeClass('hide');
                $('#selctdata').addClass('hide');
                $('#jobdes').addClass('hide');
                $('#sub').addClass('hide');
            }
        }
        $('#ContectJobTypeHourly').click(function() {
            chkPanelChange();
        });
        $('#ContectJobTypeFixedPrice').click(function() {
            chkPanelChange();
        });
        function  chkPanelChange() {
            if ($('#ContectJobTypeHourly').is(':checked')) {
                $('#datedata').addClass('hide');
            }
            if ($('#ContectJobTypeFixedPrice').is(':checked')) {
                $('#datedata').removeClass('hide');
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', '.category', function() {
            var category = $('.category').val();
            if (category != '') {
                $('.subcategory').removeAttr('disabled', 'disabled');
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '<?php echo $this->base; ?>/client/ajax_data',
                    data: {category: category},
                    success: function(msg) {
                        if (msg.suc == 'yes') {
                            $('.subcategory').html(msg.subcategory_data);
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        var job_id = $('.slect').val();
        var user_id = $('#userid').val();
//        alert(job_id);
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '<?php echo $this->base; ?>/client/ajax_contects',
            data: {job_id: job_id, user_id: user_id},
            success: function(msg) {
                if (msg.suc == 'yes') {
                    $('.invite').html(msg.test);
                    $('#desc').html(msg.job);
                    $('#desrcip').val(msg.job);
                    $('#totalData').val(msg.amount)
                }
                if (msg.suc == 'no') {
                    $('.invite').html(msg.tested);
                    $('#desc').html(msg.job);
                    $('#desrcip').val(msg.job);
                    $('#totalData').val(msg.amount)
                }
            }
        });



        $('.slect').on('change', function() {
            var job_id = $('.slect').val();
            var user_id = $('#userid').val();
//        alert(job_id);
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->base; ?>/client/ajax_contects',
                data: {job_id: job_id, user_id: user_id},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('.invite').html(msg.test);
                        $('#desc').html(msg.job);
                        $('#desrcip').val(msg.job);
                        $('#totalData').val(msg.amount)
                    }
                    if (msg.suc == 'no') {
                        $('.invite').html(msg.tested);
                        $('#desc').html(msg.job);
                        $('#desrcip').val(msg.job);
                        $('#totalData').val(msg.amount)
                    }
                }
            });
        });
    });
    function myFunction() {
        alert('You have already invited for this posting job');
    }
</script>
<?php echo $this->Html->script('jquery-ui'); ?>

<script>
    $(function() {
        $("#datepicker1").datepicker({
            showOn: "button",
            buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
            buttonImageOnly: true,
            buttonText: "Select date"
        });
    });
</script> 




<script>
    $(document).ready(function() {
        $(document).on('click', '.more_skill', function() {
            $(this).parent().next().removeClass('hide');
            $(this).parent().addClass('hide');
        });

    });
    $(document).ready(function() {
        $(document).on('click', '.less_skill', function() {
            $(this).parent().prev().removeClass('hide');
            //$('.less_skills').removeClass('hide');
            $(this).parent().addClass('hide');

        });
    });
</script>


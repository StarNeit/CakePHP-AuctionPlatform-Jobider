

<?php if (!empty($freelancer)) { ?>
    <div class="container">
        <?php
        if (!empty($search_count)) {
            ?>
            <h2 class="header_style"> 
                <span class="large_font text-left " style="font-size: 22px;">Freelancers 
                </span> 
                <span class="text_green marg_l20 font_18">  (Showing <?php echo '<strong id =freelancer_count>' . $search_count . '</strong>'; ?> freelancers)
                </span>
                <a href="<?php echo $this->webroot; ?>client/postajob"><button type="button" class="btn btn-sm  btn_red btn_red12 pull-right">Post a job</button>       </a>  </h2>
        <?php } ?>
        <h2 class="header_style hide"> 
            <span class="large_font text-left">AJAX Developers &amp; Consultants </span> 
            <span class="text_green marg_l20 font_18">(Showing <?php echo $search_count; ?> freelancers)
            </span>
            <a href="<?php echo $this->webroot; ?>client/postajob"><button type="button" class="btn btn-sm  btn_red btn_red12 pull-right">Post a job</button></a>
        </h2>
        <hr class="brder_btm">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="green_bg panel panesl-default">
                    <div class="panel-heading"> <h3 class="marg_0"><span>Find Freelancer </span>                    </h3>
                    </div>
                    <?php
                    //echo $this->Session->flash();
                    echo $this->Form->create('User', array('url' => array('controller' => 'client', 'action' => 'searchfreelancer'), 'class' => 'cust_form sider_bar_form '));
                    ?>
                    <div class="panel1">
                        <h4 class="marg_0">Skills</h4>
                    </div>
                    <?php if (isset($skill) and !empty($skill)) { ?>
                        <div class=" col-md-12">
                            <?php echo $this->Form->input('skills', array('type' => 'select', 'label' => false, 'class' => "form-control provider", 'id' => 'selected', 'options' => array('' => 'Select Skill', $skill))); ?>   
                        </div>
                    <?php } else { ?>
                        <div class=" col-md-12">
                            <?php echo $this->Form->input('skills', array('type' => 'select', 'label' => false, 'class' => "form-control provider", 'id' => 'selected', 'options' => array('' => 'Ajax Developers  &  Consultants'))); ?>   
                        </div>
                    <?php } ?>
                    <div class="sub_content">
                        <div class="clearfix"></div>
                        <div class="brder_tb">
                            <h4 class="marg_0">Subskills</h4>
                        </div>
                        <div class=" col-md-12 providesss ">
                            <?php echo $this->Form->input('subskills', array('class' => 'form-control subskill', 'type' => 'select', 'options' => array('' => 'Select Sub-skills'), 'label' => false)) ?>                   </div>
                    </div>
                    <div class="sub_content">
                        <div class="clearfix"></div>
                        <div class="brder_tb">
                            <h4 class="marg_0">Country</h4>
                        </div>
                        <?php if (isset($country) and !empty($country)) { ?>
                            <div class=" col-md-12">
                                <?php echo $this->Form->input('country', array('class' => 'form-control contry', 'type' => 'select', 'label' => false, 'options' => array('' => 'Select Country Here', $country))) ?>
                            </div>
                        <?php } else { ?>
                            <div class=" col-md-12">
                                <?php echo $this->Form->input('country', array('class' => 'form-control', 'type' => 'select', 'label' => false, 'options' => 'Select Country Here', 'empty' => 'All Country')); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="sub_content">
                        <div class="clearfix"></div>
                        <div class="brder_tb">
                            <h4 class="marg_0">Feedback Score</h4>
                        </div>
                        <div class=" col-md-12">
                            <h4 class="text_green">Any Feedback Score  </h4>
                            <div class="checkbox">
                                <label>
                                    <input class="checked" name="" value="4.5" type="checkbox"> 4.5 &amp; above
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="checked" name="" value="4.0" type="checkbox">4.0 &amp; above
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="checked" name="" value="3.0" type="checkbox">3.0 &amp; above
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="checked"  name="" value="2.0" type="checkbox"> 2.0 &amp; above
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="checked"  name="" value="1.0" type="checkbox">1.0 &amp; above 
                                </label>
                            </div>
                            <input type="hidden" name="test" value="" class="checkedValue" />
                        </div>
                    </div>




                    <?php echo $this->Form->end(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 marg_btm30 result_search ">
                <?php foreach ($freelancer as $data) {
                    ?>
                    <div class="bg_white freelaners marg_btm30 searchresult">
                        <div class="green">
                            <a href="<?php echo $this->webroot; ?>client/freelancer_profile/<?php echo $data['User']['id']; ?>" style="text-decoration:none;color: #fff;" class=makewhite><?php echo ucfirst($data['User']['first_name']) . '   ' . ucfirst($data['User']['last_name']); ?></a>

<?php if(!empty($job_id)){ ?>
                           
                            <input type="hidden" value="<?php  echo $job_id?>" class="jobval">
                            <input type="hidden" value="<?php  echo $data['User']['id'];?>" class="userval">
                            <button class="btn-sm btn-danger btn_red11 pull-right marg_l20 hire_val">Hire Me</button> 
                           
<?php } else {  ?>
           <a href="<?php echo $this->webroot; ?>client/contract/<?php echo $data['User']['id']; ?>" class="seracgdata" >

                                <button class="btn-sm btn-danger btn_red11 pull-right marg_l20">Hire Me</button> 
                            </a>                   
<?php } ?>
                            <span class="date pull-right">
                                <a href="<?php echo $this->webroot; ?>client/freelancer_profile/<?php echo $data['User']['id']; ?>" class='makewhite' style="text-decoration:none"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt="Detail image icon"></i><?php echo $data['User']['job_title'] ?></a>(<?php echo $data['User']['subskills']; ?>)</span>
                            <div class="clearfix"></div>  </div>
                        <div class="col-md-2 col-sm-2 marg_tb15">
                            <?php if (!empty($data['User']['image'])) { ?>
                                <a href="<?php echo $this->webroot; ?>client/freelancer_profile/<?php echo $data['User']['id'] ?>">

                                    <img class="img-thumbnail" alt="Login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $data['User']['image']; ?>" height="auto" width="100">   </a><?php } else { ?>
                            <img class="img-thumbnail" src="<?php echo $this->webroot; ?>img/freelancer.png" alt="Dummy user"/>
                            <?php } ?>
                        </div>
                        <?php if (!empty($data['User']['description'])) { ?>
                            <div class="col-md-10 colsm-10 marg_tb15 lesval ">
                                <p><?php echo substr($data['User']['description'], 0, 300) . '....'; ?>
                                    <a href="JavaScript:void(0);" class='more' >more</a>
                                </p>
                            </div>
                        <?php } ?>
                        <?php if (!empty($data['User']['description'])) { ?>
                            <div class="col-md-10 colsm-10 marg_tb15 moreval hide ">
                                <p><?php echo $data['User']['description']; ?>
                                    <a href="JavaScript:void(0);" class='less' >less</a>
                                </p>
                            </div>
                        <?php } ?>
                        <div class="clearfix"></div>
                        <hr class="brder_btm1 marg_tb15">
                        <div class="tabs_1 col-md-12">
                            <div class="col-md-10 colsm-10 less_skills ">
                            <?php
                           
                            if (!empty($data['User']['realskill'])) {
                                $total=count($data['User']['realskill']);
                                $k = 0;
                                foreach ($data['User']['realskill'] as $kk => $vv) {
                                 ?>                            
                                    <button type='button' class='subskil' disabled><?php echo $vv['Subskill']['skill_name']; ?></button>
                                <?php if($k=="3"){
                                    break; 
                                    } 
                                    $k++; 
                                }  ?>
                                <?php } ?>
                                    <?php if(!empty($total) and $total>4){?>
                                    <a href="JavaScript:void(0);" class=" subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More</a>
                            <?php }?>
                            </div>
                            
                              <div class="col-md-10 colsm-10  more_skills hide ">
                            <?php
                           
                            if (!empty($data['User']['realskill'])) {
                                //$total=count($data['User']['realskill']);
                                $k = 0;
                                foreach ($data['User']['realskill'] as $kk => $vv) {
                                    // echo $k;
                                    ?>
                            
                                    <button type='button' class='subskil' disabled><?php echo $vv['Subskill']['skill_name']; ?></button>
                                <?php  $k++;  }  ?>
                                <?php }
                            ?>
                                    <a href="JavaScript:void(0);" class=" subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less</a>
                            
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="bg_grey1 pull-left marg_t5">
                            <div class="rating pull-left"> 
                                <span class="text_green pull-left"><?php echo number_format($data['User']['score'], 1); ?> Star</span>
                                <ul class=" list-inline pull-left ">  
                                    <li> </li>
                                    <?php
                                    $score = number_format($data['User']['score'], 0);
                                    // pr($score);
                                    for ($n = 1; $n <= $score; $n++) {
                                        ?>
                                        <li>
                                            <img alt="star" src="<?php echo $this->webroot; ?>img/star.png">
                                        </li>
                                    <?php } ?>
                                    <?php if (number_format($data['User']['score'], 1) == 3.3 or (number_format($data['User']['score'], 1) == 4.4)) { ?>
                                        <img alt="star" src="<?php echo $this->webroot; ?>img/star_2.png">
                                    <?php } ?>
                                </ul>
                            </div>  

                            <div class="location pull-left">
                                <?php if (!empty($data['User']['Country_name'])) { ?>
                                    <i><img alt="location image" src="<?php echo $this->webroot; ?>img/location.png"></i><span class=" text_green"><?php echo $data['User']['Country_name']['Country']['name'] ?></span>
                                <?php } ?>
                            </div>

                            <div class="location pull-left">
                                <i><img alt="Check icon image" src="<?php echo $this->webroot; ?>img/check.png"></i><span class=" text_green">LAST ACTIVE <?php echo $date = date('M.d,Y', strtotime($data['User']['created'])); ?></span>

                            </div>

                            <div class="location pull-left">
                                <i><img alt="Project Image" src="<?php echo $this->webroot; ?>img/project_img.png" ></i><span class=" text_green"><?php echo $data['User']['completed']; ?> Completed projects</span>
                            </div>

                            <div class="location pull-left">
                                <i><img alt="Project Image icon" src="<?php echo $this->webroot; ?>img/project_img.png"></i><span class=" text_green"><?php echo $data['User']['inprocess']; ?> in process</span>

                            </div>
                        </div>


                        <div class="clearfix"></div>

                    </div>
                <?php } ?>


                <ul class="pagination pull-right pagi">
                    <li>
                        <?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?>
                    </li>
                    <?php
                    echo $this->Paginator->numbers(array(
                        'before' => '',
                        'after' => '',
                        'separator' => '',
                        'tag' => 'li',
                        'spanClass' => 'sr-only',
                        'currentClass' => 'active',
                        'currentTag' => 'a',
                    ));
                    ?> 
                    <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
                </ul>
            </div>

        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="bg_white freelaners marg_btm30">
            <div class="green">
                Freelancer  Detail
            </div>
            <div style="text-align:center; color:#C7C4C8;" class="col-md-12 colsm-12 marg_tb15"><span> <strong> Sorry, no freelancer's found </strong> </span></div>
            <div class="clearfix"></div>
            <hr class="brder_btm1 marg_0">
            <div class="tabs_1 col-md-12 marg_t5">
            </div>
        </div>
    </div>
<?php } ?>


<?php echo $this->Html->script('jquery.min'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#selected').change(function() {
        });
        $(document).on('change', '.provider', function() {
            var provider = $('.provider').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/client/chek',
                dataType: 'json',
                data: {provider: provider},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        $('.providesss').html(msg.provide);
                    }
                }
            });
        });

    });

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#selected').change(function() {
        });
        $(document).on('change', '.provider', function() {
            var provider = $('.provider').val();
            var subskill = $('.Sub').val();
            var contry = $('.contry').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/client/Search',
//                dataType: 'json',
                data: {provider: provider, contry: contry, subskill: subskill},
                success: function(msg) {
                    $('.result_search').html(msg);

                }

            });
        });
        $(document).on('change', '.sub', function() {
            var provider = $('.provider').val();
            var subskill = $('.sub').val();
            var contry = $('.contry').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/client/Search',
//                dataType: 'json',
                data: {provider: provider, contry: contry, subskill: subskill},
                success: function(msg) {
                    $('.result_search').html(msg);

                }

            });
        });
        $(document).on('change', '.contry', function() {
            var contry = $('.contry').val();
            var provider = $('.provider').val();
            var subskill = $('.Sub').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/client/Search',
//                dataType: 'json',
                data: {contry: contry, provider: provider, subskill: subskill},
                success: function(msg) {
//                    alert('gfchdsfchsd');
                    $('.result_search').html(msg);

                }

            });


        });

        $(document).on('click', '.happy a', function(e) {
            e.preventDefault();
            var testAction = $(this).attr('href');
            var contry = $('.contry').val();
            var provider = $('.provider').val();
            var subskill = $('.Sub').val();
            $.ajax({
                type: 'POST',
                url: testAction,
                data: {contry: contry, provider: provider, subskill: subskill},
                success: function(msg) {
                    $('.result_search').html(msg);
                    if (msg.suc == 'yes') {
                        //alert(msg.count);
                        $('#freelancer_count').html(msg.count);
                        $('.result_search').html(msg.dataDiv);
                    } else {
                        $('.result_search').html(msg.dataDivs);
                        $('#freelancer_count').html(msg.count);
                    }
                }

            });

        });

        $(document).on('click', '.checkbox', function() {
            var checked = $(this).find('input').attr('value');
            var getCheckedValue = $('.checkedValue').val();
            if (getCheckedValue.indexOf(checked) >= 0) {
                var avoid = checked;
                var abc = getCheckedValue.replace(',' + avoid, '');
                $('.checkedValue').val(abc);
            } else {
                $('.checkedValue').val(getCheckedValue + ',' + checked);
            }
            var getCheckedValue = $('.checkedValue').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->base; ?>/client/Search',
                data: {getCheckedValue: getCheckedValue},
                success: function(msg) {
                    $('.result_search').html(msg);

                }

            });





        });
    });

</script>

<style>
    .current{
        /*background: none repeat scroll 0 0 #FF0000 !important;*/
        background: none repeat scroll 0 0 #DA423D !important;
        float: left;
        height: 34px !important;
        margin-top: 2px;
        width: 36px;
        padding-top: 6px;
        padding-left: 12px;
        color: white;
    }
    .next{
        color:white !important;
    }
    .prev{
        color:white !important;
    }

    .input-group-addon.grrenbtn {
        background: #1fb5ad;
        color: #fff;
        font-size: 14px;
    }


</style>

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
                   $(this).parent().addClass('hide');

                });
            });
        </script>
        
        <script>
            $('.hire_val').click(function(){
              var job_id = $(this).prev().prev().val();
            var user_id=$(this).prev().val();
             $.ajax({
                 type:'post',
                 dataType:'json',
                 url:'<?php  echo $this->webroot;?>client/freelancer_data',
                 data:{job_id:job_id,user_id:user_id},
                 success:function(msg){
                     if(msg.suc=='yes'){
                        window.location.href='<?php echo $this->webroot; ?>client/contract/'+msg.free_id;
                     }
                 }
              });
            });
            
        </script>


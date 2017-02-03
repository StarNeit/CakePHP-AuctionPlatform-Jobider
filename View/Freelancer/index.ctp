<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('freelancer_dashboard'); ?>
        <?php if (!empty($postedJobs)) { ?>
            <div class="col-md-6 col-sm-6">
                <div class="bg_white">
                    <div class="green">Jobs that may interest you</div>
                    <?php
                    foreach ($postedJobs as $key => $val) {
                        ?>
                        <div class="col-md-12 brder_btm work">
                            <a href="<?php echo $this->webroot; ?>freelancer/jobdetails/<?php echo $val['Job']['id']; ?>" style="text-decoration: none;"> <h4> <?php echo $val['Job']['job_title'] ?></h4></a>
                            <p class="text_1">Budget - $<?php echo $val['Job']['budget'] . ' , Posted  ' . date('h:i a', strtotime($val['Job']['created'])) . '  (' . $val['Job']['time_duration'] . ') ' ?>  </p>
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-md-6 col-sm-6">
                <div class="bg_white">
                    <div class="green">Jobs that may interest you</div>


                    <div class="col-md-12 brder_btm work" style="height: 155px;">

                        <p class="text_1" style="color: #C7C4C8; margin-top: 45px; margin-left: 0px; font-size: 20px;">Firstly you have to Complete your Profile so that you can apply for jobs !  </p>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        <?php } ?> 
        <div class="col-md-3 col-sm-3 pad_r0">
            <?php echo $this->Form->create('Category', array('class' => 'search_box', 'role' => 'search', 'url' => array('controller' => 'freelancer', 'action' => 'index',))); ?>
            <div class="form-group">
                <div class="input-group col-md-12">
                    <label>Search Jobs</label>
                    <div class="input-group">
                        <input  id="searchbar" type="text" placeholder="Enter job category" class="form-control" name="data[Category][search_freelancer_job]"><div class="input-group-addon padd_0"><button type="button" class="search_job">Search</button></div>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">My Profile </div>
                <div class="panel-body bg_grey1 padd_0">
                    <div class="col-md-3 col-sm-4 col-xs-4 marg_tb15">
                        <?php if (!empty($user_value['User']['image'])) { ?>
                        <a  href="<?php echo $this->webroot; ?>freelancer/freelancer_profile" target="_blank">
                            <img  src="<?php echo $this->webroot; ?>uploads/<?php echo $user_value['User']['image']; ?>" alt="login user image" height="65" width="65">
                        </a>
                        <?php } else { ?>
                            <img  src="<?php echo $this->webroot; ?>img/freelancer.png" alt="freelancer dummy image" height="65" width="65">
                        <?php } ?>
                    </div>
                    <div class="col-md-9 col-sm-8 marg_tb15">
                        <a  href="<?php echo $this->webroot; ?>freelancer/freelancer_profile" style="text-decoration:none; color:black;" target="_blank">
                            <h4 class="marg_0"><?php
                                $user_data = $this->Session->read();
                                echo ucfirst($user_data['Auth']['User']['first_name']) . ' ' . ucfirst($user_data['Auth']['User']['last_name']);
                                ?></h4> 
                        </a>
                        <p><i><img src="<?php echo $this->webroot; ?>img/edit.png" class="mrg_r5" alt="edit icon image"/></i><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'editprofile')); ?>" class="font_12" style="text-decoration:none;">Edit Your Profile</a>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="brder_btm"></div>
                </div>
            </div>
            <?php if (!empty($category)) { ?>
                <div class="panel panel-default green_bg1">
                    <div class="panel-heading">Categories</div>
                    <div class="panel-body bg_grey1 padd_0">
                        <ul class="nav ">
                            <?php foreach ($category as $val) { ?>
                                <li><a href="<?php echo $this->webroot; ?>freelancer/category_job/<?php echo $val['Subcategory']['id']; ?>"> <?php echo $val['Subcategory']['category_name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
    <?php if (!empty($postedJobs)) { ?>

        <ul class="pagination pull-right">
            <li><?php echo $this->Paginator->prev('<<Previous', null, null, array('class' => 'disabled')); ?></li>
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
            <li><?php echo $this->Paginator->next('Next>>', null, null, array('class' => 'disabled')); ?></a></li>
        </ul>

    <?php } ?>

</div>

<style>
    .current{
        /*        background: none repeat scroll 0 0 #FF0000 !important;*/
        background: none repeat scroll 0 0 #DA423D !important; 
        float: left;
        height: 34px !important;
        margin-top: 2px;
        width: 36px;
        padding-top: 6px;
        padding-left: 12px;
        /*        color: white;*/
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
        $(document).on('click', '.search_job', function() {
            var search = $('#searchbar').val();
            if (search == '') {
                alert('Please Enter the Search keyword !');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });
    });

</script>
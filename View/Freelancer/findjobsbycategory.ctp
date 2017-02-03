<div class="container">
<?php if(!empty($job_count) && $job_count!=0){ ?>
    <h2 class="header_style"><span class="large_font text-left"><?php echo $subcategory['Category']['name']; ?> Jobs</span> <span class="text_green marg_l20 font_18">  (<?php echo $job_count; ?> were found based on your criteria )</span>
       <a href="<?php echo $this->Html->Url('/freelancer/postajob'); ?>" <button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button></a>

        <div class="clearfix"></div>
    </h2>
    <hr class="brder_btm"/>

    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="green_bg panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"> <h3 class="marg_0">Narrow results by:</h3></div>

                <form class="cust_form sider_bar_form">
                    <div class="panel1">
                        <h4 class="marg_0">Category</h4>

                    </div>
                    <div class="web_job">
                        <ul class="list-group padd_tb15">
                        <?php foreach ($category as $value) {
                                //	pr($jobs_count);
                                ?>
                                <?php
                                if ($value['Category']['id'] == $subcategory['Category']['id']) {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }
                                ?>
                                <li class="list-group-item <?php echo $active; ?>"> <a href="#"><?php echo $value['Category']['name']; ?> (<?php
                            $cat_key = $value['Category']['id'];
                            echo $jobs_count[$cat_key];
                            ?>)</a></li>
<?php } ?>

                        </ul>

                    </div>


                    <div class="sub_content">


                        <div class="clearfix"></div>
                        <div class="brder_tb">

                            <h4 class="marg_0">Subcategory</h4>
                        </div>
                        <div class="web_job">
                            <ul class="list-group padd_tb15">
                                <?php
                                foreach ($sub_data as $val) {
                                    //$value_sub=$value['Subcategory'][$key]['category_name'];
                                    ?>
                                    <?php
                                    if ($this->params['pass'][0] == $val['Subcategory']['id']) {
                                        $sub_active = 'active';
                                    } else {
                                        $sub_active = '';
                                    }
                                    ?>
                                    <li class="list-group-item <?php echo $sub_active; ?>"> <a href="#"><?php echo $val['Subcategory']['category_name']; ?></a></li>
<?php } ?>

                            </ul>

                        </div>
                    </div>

                    <div class="sub_content">


                        <div class="clearfix"></div>
                        <div class="brder_tb">

                            <h4 class="marg_0">Date Posted</h4>
                        </div><div>
                            <ul class="list-group padd_tb15">
                                <li class="list-group-item"> <a href="#" style="text-decoration:none;">Last 24 Hours (<?php echo $job_count_oneday; ?>)</a></li>
                                <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 3 Days (<?php echo $job_count_threedays; ?>)</a></li>
                                <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 7 Days (<?php echo $job_count_sevendays ?>)</a></li>
                                <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 14 Days (<?php echo $job_count_fourteendays; ?>)</a></li>
                                <li class="list-group-item"><a href="#" style="text-decoration:none;">Last 30 Days (<?php echo $job_count_thirtydays; ?>)</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
                <!-- List group -->
            </div>
      </div>
        <div class="col-md-8 col-sm-8 marg_btm30">
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
            <div class="clearfix"></div>
<?php foreach ($job_data as $sub_value) { ?>

                <div class="bg_white freelaners marg_btm30">

                    <div class="green">
    <?php echo $sub_value['Job']['job_title']; ?>
                    </div>




                    <div class="col-md-12 colsm-12 marg_tb15">

                        <p><?php echo substr($sub_value['Job']['description'], 0, 350), '....'; ?>
                            <a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'jobdetail', $sub_value['Job']['id'])); ?>">more</a>
                        </p>

                    </div>

                    <div class="clearfix"></div>
                    <hr class="brder_btm1 marg_0">

                    <div class="tabs_1 col-md-12 marg_t5">

                        <img src="<?php echo $this->webroot; ?>img/tabs_1.png" class="img-responsive" alt="Tab1 icom image"/>


                    </div>
                    <div class="clearfix"></div>
                    <div class="bg_grey1 pull-left marg_t5">





                        <div class="location pull-right">

                            <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project icon image"/></i><span class=" text_green">Est. Budget:<?php echo $sub_value['Job']['budget'], ':00'; ?></span>

                        </div>

                        <div class="location pull-right">

                            <i><img src="<?php echo $this->webroot; ?>img/clock.png" alt="Clock icon image"/></i><span class=" text_green"> Posted 
                                <?php if ($sub_value['Job']['days'] > 0) { ?>
                                    <?php echo $sub_value['Job']['days'] ?> days
                                <?php } ?>
                                <?php if ($sub_value['Job']['hours'] > 0) {
                                    echo $sub_value['Job']['hours']
                                    ?> hours 
                            <?php } ?>

    <?php if ($sub_value['Job']['minutes'] > 0) {
        echo $sub_value['Job']['minutes']
        ?> minutes
    <?php } ?>  
    <?php if ($sub_value['Job']['seconds'] > 0) {
        echo $sub_value['Job']['seconds']
        ?> seconds ago	</span>
                <?php } ?>   
                        </div>


                    </div>


                    <div class="clearfix"></div>

                </div>
<?php } ?>


        </div>



    </div>
<?php } else { ?>
			<h2 class="header_style"><span class="large_font text-left"> </span> <span class="text_green marg_l20 font_18"> 
            </span>
<!--            <button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button>-->
        </h2>
        <hr class="brder_btm">
        <div class="row">
           <div class="col-md-12 col-sm-8 marg_btm30">
               <div class="clearfix"></div>
                <div class="bg_white freelaners marg_btm30">
                    <div class="green">
                        Search Results<span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot;?>img/deatil.png" alt="detail image"></i></span>
                        <div class="clearfix"></div>   </div>
                    <div class="col-md-10 colsm-10 marg_tb15">
																					<p style="color: red; text-align: center;"> <strong>Sorry,</strong>No record found related to <strong><?php echo $sub_text; ?></strong> category</p>      
                    </div>
                    <div class="clearfix"></div>
                   <div class="clearfix"></div>
                </div>
           </div>
        </div>
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
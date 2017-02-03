<div class="container">
    <h2><span class=" text-left">Writers &amp; Translators</span> <span class="text_green marg_l20 font_18"> (Showing 80,016 freelancers)</span>
        <button type="button" class="btn btn-sm  btn_red btn_red12 pull-right">Post a job</button>
    </h2>
    <hr class="brder_btm">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="green_bg panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"> <h3 class="marg_0">Narrow results by:</h3></div>
                <!-- <form class="cust_form sider_bar_form">-->
                <?php
                //echo $this->Session->flash();//
                echo $this->Form->create('User', array('url' => array('controller' => 'home', 'action' => 'searchbycategory'), 'class' => 'cust_form sider_bar_form '));
                ?>
                <div class="panel1">
                    <h4 class="marg_0">Category</h4>
                </div>

                <div class=" col-md-12">
                    <?php echo $this->Form->input('categories', array('type' => 'select', 'label' => false, 'class' => "form-control provider", 'id' => 'selected', 'options' => array('select' => 'Select Category', $categories))); ?>   
                </div>


                <div class="sub_content">


                    <div class="clearfix"></div>
                    <div class="brder_tb">

                        <h4 class="marg_0">Subcategory</h4>
                    </div>
                     <div class=" col-md-12">
                    <?php echo $this->Form->input('categories', array('type' => 'select', 'label' => false, 'class' => "form-control provider", 'id' => 'selected', 'options' => array('select' => 'Select Subcategory', $subcategories))); ?>   
                </div>
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
                            <?php echo $this->Form->input('country', array('class' => 'form-control', 'type' => 'select', 'label' => false, 'options' => 'Select Country Here', 'empty' => 'All Country')) ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="sub_content">


                    <div class="clearfix"></div>
                    <div class="brder_tb">

                        <h4 class="marg_0">Feedback Score</h4>
                    </div>


                    <div class=" col-md-12">

                        <h4 class="text_green">Any Feedback Score (80,016) </h4>


                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> 4.5 &amp; above (36,254)
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox">4.0 &amp; above (41,459)
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox">3.0 &amp; above (44,946)
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> 2.0 &amp; above (46,231)
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox">1.0 &amp; above (47,301) 
                            </label>
                        </div>

                    </div>
                </div>

                </form>
                <div class="clearfix"></div>
                <!-- List group -->


            </div>



        </div>

        <div class="col-md-8 col-sm-8 marg_btm30">

            <ul class="pagination pull-right">
                <li><a href="#"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
            </ul>
            <div class="clearfix"></div>
<?php foreach ($freelancer as $data) { ?>
            <div class="bg_white freelaners marg_btm30">

                <div class="green">
                  <?php echo $data['User']['first_name'] . '     ' ?><?php echo $data['User']['last_name']; ?><span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/deatil.png" alt=""></i>Architect, Backend Engineer (Scala, Java, Hadoop)</span>
                </div>


                <div class="col-md-2 col-sm-2 marg_tb15">
 <img class="img-thumbnail" alt="" src="<?php echo $this->webroot; ?>uploads/<?php echo $data['User']['image']; ?>" height=auto width="100%">

                </div>

                <div class="col-md-10 colsm-10 marg_tb15">

                    <p><?php echo substr($data['User']['description'], 0, 300) . '....'; ?>
                        <a href="#">more</a>
                    </p>

                </div>

                <div class="clearfix"></div>
                <hr class="brder_btm1 marg_tb15">

                <div class="tabs_1 col-md-12">

                    <img alt="" src="img/tabs_1.png">


                </div>
                <div class="clearfix"></div>
                <div class="bg_grey1 pull-left marg_t5">

                    <div class="rating pull-left">
                        <span class="text_green pull-left">4.8 Star</span>

                        <ul class=" list-inline pull-left ">
                            <li><img alt="" src="<?php echo $this->webroot; ?>img/star.png"></li>
                            <li><img alt="" src="<?php echo $this->webroot; ?>img/star.png"></li>
                            <li><img alt="" src="<?php echo $this->webroot; ?>img/star.png"></li>
                            <li><img alt="" src="<?php echo $this->webroot; ?>img/star.png"></li>
                            <li><img alt="" src="<?php echo $this->webroot; ?>img/star.png"></li>

                        </ul>

                    </div>  

                    <div class="location pull-left">

                        <i><img alt="" src="<?php echo $this->webroot; ?>img/location.png"></i><span class=" text_green">Brazil</span>

                    </div>

                    <div class="location pull-left">

                        <i><img alt="" src="<?php echo $this->webroot; ?>img/check.png"></i><span class=" text_green">LAST ACTIVE Oct. 12 2014</span>

                    </div>

                    <div class="location pull-left">

                        <i><img alt="" src="<?php echo $this->webroot; ?>img/project_img.png"></i><span class=" text_green">12 Completed projects</span>

                    </div>

                    <div class="location pull-left">

                        <i><img alt="" src="<?php echo $this->webroot; ?>img/project_img.png"></i><span class=" text_green">2 in process</span>

                    </div>
                </div>


                <div class="clearfix"></div>

            </div>
<?php  } ?>

        </div>

    </div>
</div>
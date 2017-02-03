<div class="container"> 
    <!--left_side start-->
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li><a href="#"> Post a job</a></li>
                        <li><a href="#"> Search for freelancer </a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p class="font_14">A payment of $23 has been applied to your account. </p>
                    <p class="font_14">Michel shey contact : <br>
                        Tester for wordpress site started on 13-Nov-2014 </p>
                    <p><i><img alt="starimage" class="mrg_r5" src="img/view.png" alt="image"></i><a href="#">See all notifications  &gt;&gt;</a></p>

                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="row marg_btm30"> 
               
                <div class="col-md-12 list_1">
                    <div class="blue_line_bg">
                        <div class="col-xs-4 text-center block1 pdng"> <a href="#"> <span class="bg_grey_1">1</span> </a> <br>
                            <br>
                            <label class="font_size16"> <a href="#"> Select Jobs </a> </label>
                        </div>
                        <div style="text-align:center;" class="col-xs-4 text-center block1 pdng"> <a href="#"> <span class="bg_blue_1"> 2</span> </a> <br>
                            <br>
                            <label class="font_size16"> <a href="#"> Contract </a> </label>
                        </div>
                        <div class="col-xs-4 text-center block1 pdng" style="text-align: right">
                            <div class="gree"> <span class="bg_blue_1"><a href="#"> <span class="grey">3</span> </a></span><a href="#"> </a> <br>
                                <br>
                                <label class="font_size16 text_blue"><a href="#"> Review and Hire </a> </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg_white selectco">
                <div class="green"> Select you below jobs posted <span class="pull-right"><a href="/developer/client/postajob">
                            <button type="button" class="btn btn-sm  btn_red btn_red12 pull-right" style="margin-top: -6px;">Post a new job</button>
                        </a></span> </div>
                <?php echo $this->Form->create('Job',array('url'=>array('controller'=>'client','action'=>'hireme',$free_id))); ?>
                <?php foreach($jobs_data as $k=>$v){ ?>
                <div class="detail  brder_btm padd_tb15">
                    <div class="col-md-3 col-sm-2 pad_l2">
                        <div class="user_content pull-left">
                            <h4 class="marg_0 text-danger"><?php echo $v['Job']['job_title']; ?></h4>
                            <small class="text_1"><?php  echo $v['Job']['time_duration'];?></small> <br>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 lesval">
                        <p class="text_1"><?php echo substr($v['Job']['description'],0,150).'.....'; ?>
                            <a href="JavaScript:void(0);" class="more">more</a> </p>
                    </div>
                     <div class="col-md-8 col-sm-8  moreval hide">
                        <p class="text_1"><?php echo $v['Job']['description']; ?>
                            <a href="JavaScript:void(0);" class="less">less</a> </p>
                    </div>
                    <div class="col-md-1">
                        <div class="checkbox">
                            <label style="margin-left: -17px;">
                                <input type="radio" name="data[Job][hire]" value='<?php echo $v['Job']['id'];?>'> 
                            </label>
                        </div>

                    </div>

                   
                    <div class="clearfix"> </div>
                </div>
                <?php } ?>
             
                <div class="clearfix"></div>
            </div>
            <nav>

                <div class="col-md-12 marg_tb50 text-center">

                    <button style="margin-right:10px;" class="btn-lg btn-green col-md-2 col-sm-2 col-xs-2">Post</button>



                    <button class="btn-lg btn-green col-md-2 col-sm-3 col-xs-2">Cancel</button> 

                </div>
                <?php echo $this->Form->end(); ?>

                <ul class="pagination pull-right">
                    <li><a href="#"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!--left_side closed--> 

</div>
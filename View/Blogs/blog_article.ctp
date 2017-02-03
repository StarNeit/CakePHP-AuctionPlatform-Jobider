<div class="container">
    <h2><span class=" text-left">Blogs</span>
    </h2>
    <div class="row">
        <div class="col-md-8 col-sm-8 marg_btm30">
            <?php if (isset($blog) and !empty($blog)) { ?>
                <?php foreach ($blog as $value) { ?>
            <?php if(!empty($value['Blog']['image'])){ ?>
                    <div class="blog bg_white marg_btm30">
                        <div class="img_cont">
                            
                            <img src="<?php echo $this->webroot; ?>uploads/<?php echo $value['Blog']['image']; ?>" height='353' width='765' alt="BlogImageIcon"/>
                       
                            
                            <span class="bg_blck_user">
                                <i><img src="<?php echo $this->webroot; ?>img/user.png" alt="UserImageIcon"/></i>
                                <font><?php echo $value['Blog']['author']; ?> </font>
                            </span>
                        </div>
                        <div class="green">
                            <?php echo $value['Blog']['title']; ?> <span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/date.png" alt="dateimage"/></i><?php echo $date = date("F d,Y", strtotime($value['Blog']['created'])); ?></span>
                        </div>
                        <div class="content_page pad_20">
                            <p>
                                <?php echo substr($value['Blog']['description'], 0, 440); ?> 
                            </p>
                            
                        </div>
                        <div class="text-center">
                            <a href="<?php echo $this->Html->Url(array('controller' => 'blogs', 'action' => 'view_blog', $value['Blog']['id'])); ?>"><button type="button" class="btn btn-lg btn_red1 marg_tb15 ">Read Full Article</button></a>
                        </div>
                    </div>
                <?php } }
            } else {
                ?>
                <div class=" col-sm-12 col-md-12">
                    <div class="clearfix"></div>
                    <div class="bg_white freelaners marg_btm30">
                        <div class="green">
                            <span class="date pull-right"><i class="mrg_r5"><img alt="detailImageIcon" src="img/deatil.png"></i></span>
                            <div class="clearfix"></div>   </div>
                        <div class="col-md-10 colsm-10 marg_tb15">
                            <p style="color: red; text-align: center;"> <strong>Sorry,</strong>No Blog(s) Found! </p>      
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
<?php } ?>
        </div>

        <div class="col-md-4 col-sm-4">
            <a href="<?php echo $this->webroot; ?>aboutus" style="text-decoration:none; color:white! important;"> <button type="button" class="btn btn_red1 btn-block marg_btm30">New to jobider ? Learn More</button></a>
            <div class="green_bg panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"> <h3 class="marg_0">Categories</h3></div>
                <div class="panel-body">
                    <p class="marg_0">
<!--                        <a href="#">View all</a>-->
                    </p>
                </div>
                <!-- List group -->
                <ul class="list-group padd_tb15">
                    <?php foreach ($category as $val) { ?>
                        <li class="list-group-item"> <a href="<?php echo $this->webroot; ?>blogs/blog_category/<?php echo $val['Category']['id'] ?>" style="text-decoration: none"><?php echo $val['Category']['name']; ?></a></li>
<?php } ?>
               </ul>
            </div>
            <div class="green_bg panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"> <h3 class="marg_0">Tags</h3></div>
                <div class="panel-body">
                    <p class="marg_0">
<!--                        <a href="#">Select Tags</a>-->
                    </p>
                </div>
                <!-- List group -->
                <ul class="list-group padd_tb15">
<?php foreach ($tags as $va) { ?>
                        <a href="<?php echo $this->webroot; ?>blogs/blog_article/<?php echo $va; ?>" style="text-decoration: none; color: #000"><?php echo $va; ?></a>
<?php } ?>
                        <div class="clearfix"></div>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .content_page{
        color: #9b9b9b;
    font-size: 18px;
    text-align: justify;
    }
    
</style>
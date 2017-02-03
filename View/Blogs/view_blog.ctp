<div class="container">
    <h2><span class=" text-left">Blog</span>
    </h2>
    <div class="row">
        <div class="col-md-8 col-sm-8 marg_btm30">
            <?php //if(!empty($blog_data['Blog']['image'])){ ?>
            <div class="blog bg_white marg_btm30">
                <div class="img_cont">
                   <?php if(!empty($blog_data['Blog']['image'])) {?>
                    <img src="<?php echo $this->webroot; ?>uploads/<?php echo $blog_data['Blog']['image']; ?>" alt="BlogImageIcon" height="353" width="765"/>
                   <?php } ?>
                  
                         <span class="bg_blck_user">
                        <i><img src="<?php echo BASE_URL; ?>img/user.png" alt="UserImage"/></i>
                        <font><?php echo $blog_data['Blog']['author']; ?> </font>
                    </span>
                </div> 
                <div class="green">
                    <?php echo $blog_data['Blog']['title']; ?>
                    <span class="date pull-right"><i class="mrg_r5"><img src="<?php echo $this->webroot; ?>img/date.png" alt="DateImage"/></i><?php echo $date = date('F d,Y', strtotime($blog_data['Blog']['created'])); ?></span>
                    <div class="clearfix"></div>
                </div>
                <div class=" content_page pad_20">
                    <p>
                        <?php echo $blog_data['Blog']['description']; ?>
                    </p>
                </div>
                <div class="text-center">
                </div>
            </div>
              <?php //} ?>
        </div>
        <div class="col-md-4 col-sm-4">
            <a href="<?php echo $this->webroot; ?>aboutus" style="text-decoration: none"> <button type="button" class="btn btn_red1 btn-block marg_btm30">New to jobider ? Learn More</button> 
            </a>
            <div class="green_bg panel panel-default">
                <div class="panel-heading"> <h3 class="marg_0">Categories</h3></div>
                <div class="panel-body">
<!--                    <p class="marg_0"><a href="#">View all</a></p>-->
                </div>
                <ul class="list-group padd_tb15">
                    <li class="list-group-item"> <a href="<?php echo $this->webroot; ?>blogs/blog_category/<?php echo $cat['Category']['id']; ?>" style="text-decoration: none"><?php echo $cat['Category']['name']; ?></a></li>
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
                    <div class="clearfix"> </div>
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
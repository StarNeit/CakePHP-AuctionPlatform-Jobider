<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 banner_content">
                <a href="<?php echo $this->webroot; ?>howitworks"><button type="button" class="btn btn-primary pull-right btn_cust btn-lg marg_l20">How it works</button></a>
                <a href="<?php echo $this->webroot; ?>login"><button type="button" class="btn btn-primary btn_cust btn-lg pull-right">Post a Job</button></a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php
        if (isset($home_content) and !empty($home_content)) {
            foreach ($home_content as $key => $val) {
                ?>  
                <div class="col-md-3 col-sm-3">
                    <div class="img_block"> <img src="<?php echo $this->webroot; ?>uploads/<?php echo $val['Banner']['image']; ?>" alt="Job-bidder" width="150px" height="150px"/>
                        <h3>
                            <a href="<?php echo $val['Banner']['url']; ?>">
                                <?php echo $val['Banner']['title']; ?>
                            </a>
                        </h3>
                        <p><?php echo substr($val['Banner']['description'], 0, 50); ?></p>
                        <a href="<?php echo $this->webroot; ?>home/read_more/<?php echo $val['Banner']['name']; ?>">Read More </a> 
                    </div>
                </div>
            <?php
            }
        }
        ?>

    </div>
</div>
<div class="portfolio">
    <div class="container">
        <div class="heading text-center"> <span class="img_cont"> <img src="<?php echo $this->webroot; ?>img/image.png" alt="Job-bidder" width="108px" height="102px"/> </span>
            <h1 title="Job-bidder">Find talented freelancers ready to</h1>
        </div>
    </div>
    <div class="portfolio_images">
        <?php
        if (isset($category) and !empty($category)) {
            $counter=0;
        ?>
         <?php
            foreach ($category as $key => $value) {
                $counter++;
                ?>
                <?php if($counter%4==1){?>
                <div class="row">
                <?php }?>
                    <div class="col-md-3 col-sm-3 col-xs-6 padd_lr0">
                        <div class="img_block1 "> <a href="<?php echo $this->webroot; ?>home/top3_developer/<?php echo $value['Category']['id'] ?>"> <img src="<?php echo $this->webroot; ?>uploads/<?php echo $value['Category']['image']; ?>" height="100%" width="100%" alt="Job-bidder"/>
                                <div class="textbox"><?php echo $value['Category']['name']; ?></div>
                            </a> <a href="<?php echo $this->webroot; ?>home/top3_developer/<?php echo $value['Category']['id']; ?>" class="text-center"><?php echo $value['Category']['name']; ?></a>
                        </div>
                    </div>
                <?php if(($counter/4>0)&&($counter%4==0)){?>
                </div>
                <?php 
                }?>
            <?php
            
            }
        }
        ?>
    </div>
    <div class="clearfix"></div>
</div>

<style>
    #homevideo_youtube{
        margin-top: 0% !important;
    }
    #homevideo_logo{
        display: none !important;
    }

</style>
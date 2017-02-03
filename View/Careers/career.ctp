<div class="careeer">
    <div class="container">
        <div class="text_contact text-center marg_btm30 col-md-8 col-md-offset-2">
            <h3><?php echo $Career_Page_data['Page']['title']; ?>
            </h3>
            <h4 class="marg_btm30"> <?php echo $Career_Page_data['Page']['description']; ?>   
            </h4>
            <div class="craeer_img">
                <img class="img-responsive" alt="carrerImage" src="<?php echo $this->webroot; ?>img/career.png">
            </div>
        </div>
    </div>
</div>

<div class="container">

    <h3 class="text-center marg_btm30">Open Positions</h3>

    <div class="col-md-10 col-md-offset-1">
        <div class="row career_content ">
            <?php foreach ($Career_data as $data) { ?>
                <div class="col-md-6 marg_btm30">

                    <div class="bg_white pad_20">

                        <h3 class="marg_0"><?php echo $data['Career']['title']; ?></h3>

                        <p> <?php echo substr($data['Career']['description'], 0, 100) . '......'; ?>  </p>
                        <a href="<?php echo $this->webroot; ?>careers/view_all/<?php echo $data['Career']['id']; ?>" >
                            <button class="btn-small pull-right">View &gt;&gt;</button>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>




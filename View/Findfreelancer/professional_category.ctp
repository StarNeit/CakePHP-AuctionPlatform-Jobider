<div class="container">
    <div class="title">
        <h2><span class=" text-left">Browse freelance job by category</span>
            <a href="<?php echo $this->webroot; ?>users"> 
                <button class="btn btn-sm  btn_red btn_red12 pull-right fnone" type="button">Sign up. its free !</button> 
            </a>
        </h2>
    </div>
    <hr class="brder_btm"/>
    <div class="row">
        <?php if (isset($category) and !empty($category)) {
            foreach ($category as $val) { ?>
                <div class="col-md-4 col-sm-4">
                    <div class="category marg_btm30">
                        <h4><?php echo $val['Category']['name']; ?></h4>
                        <ul class="nav">
                            <?php
                            foreach ($val['subcategory'] as $key => $value) {
                               // pr($value);
                               
                                ?>
                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'findfreelancer', 'action' => 'professionals_cate', $val['Category']['id'])); ?>"><?php echo $value['Subcategory']['category_name'];; ?></a></li>
        <?php } ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
    <?php }
} ?>
    </div>
</div>
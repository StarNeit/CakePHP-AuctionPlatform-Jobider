<div class="container">
    <div class="title">
        <h2><span class=" text-left">Browse freelance job by category</span>
            <button class="btn btn-sm  btn_red btn_red12 pull-right fnone mar10" type="button">Sign up. its free !</button>
        </h2>
    </div>
    <hr class="brder_btm"/>
    <div class="row">
        <?php foreach ($category as $val) {
            ?>
            <div class="col-md-4 col-sm-4">

                <div class="category marg_btm30">
                    <h4><?php echo $val['Category']['name']; ?></h4>

                    <ul class="nav">
                        <?php
                        foreach ($val['subcategory'] as $key => $value) { 
                            ?>
                            <li><a href="<?php echo $this->Html->Url(array('controller' => 'findfreelancer', 'action' => 'jobs_category', $value['Subcategory']['id'])); ?>"><?php echo $value['Subcategory']['category_name']; ?></a></li>

    <?php } ?>
                    </ul>
                </div>
            </div>
<?php } ?>
 </div>
</div>
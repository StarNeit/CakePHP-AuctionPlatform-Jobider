<div class="container">
    <div class="title">
        <h2><span class=" text-left">Browse freelance job by category</span>
<!--            <a href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'freelancer')); ?>"><button class="btn btn-sm  btn_red btn_red12 pull-right fnone" type="button">Sign up. its free !</button></a>-->
        </h2>
    </div>
    <hr class="brder_btm"/>
    <div class="row">
        <?php
           foreach ($jobcategory as $value) {
            $count_subcat = count($value['Subcategory']);
            if ($count_subcat > 0):
                ?>
                <div class="col-md-4 col-sm-4">
                    <div class="category marg_btm30">
                        <h4><?php echo $value['Category']['name']; ?></h4>
                        <ul class="nav">
                            <?php
                            foreach ($value['Subcategory'] as $key => $val) {
                                $key_new = $value['Subcategory'][$key]['id'];
                                $value_new = $value['Subcategory'][$key]['category_name'];
                                ?>
                                <li><a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'findjobsbycategory', $key_new)); ?>"><?php echo $value_new; ?></a></li>  <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php endif;
        } ?>	
       </div>
</div>
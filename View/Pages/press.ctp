<div class="container">
    <h3><span class=" text-left">Media Coverage</span></h3>
    <div class="row">
        <div class="col-md-12 colsm-12">
            <?php
            if (isset($media_result) and !empty($media_result)) {
                foreach ($media_result as $key => $value) {
                    ?>
                    <div class="bg_grey marg_btm30">
                        <div class="media1">
                            <div class="col-md-5 col-sm-4 padd_tb15">
                                <img alt="Media Image1" src="<?php echo $this->webroot; ?>uploads/<?php echo $value['Media']['image']; ?>" width="232" height="73"/>
                            </div>

                            <div class="col-md-7 col-sm-8 padd_tb15">
                                <a href="<?php echo $value['Media']['url']; ?>" target="blank"> <h3 class="marg_0"><?php echo $value['Media']['name']; ?>: <?php echo $value['Media']['title']; ?></h3></a>
                                <p class="marg_tb15 font_18"><i class="mrg_r5"><img alt="Media date image" src="<?php echo $this->webroot; ?>img/date_1.png"></i> <?php echo $date = date('F d,Y', strtotime($value['Media']['created'])); ?></p>
                            </div>  
                            <div class="clearfix"></div>
                        </div>
                    </div>
    <?php }
} ?>       
        </div>
   </div>
   <div class="pagi">
                            <?php ?>
                            <ul class="pagination pull-right">
                                <li><?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?></li>
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
                                <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
                            </ul>

                        </div>
</div>
      
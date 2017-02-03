
   <?php echo $search;  ?>



<?php if(!empty($search)){ ?>
<ul class="pagination pull-right pagi">
                <li>
                    <?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?>
                </li>
                <?php
                echo $this->Paginator->numbers(array(
                    'before' => '',
                    'after' => '',
                    'separator' => '',
                    'tag' => 'li',
                    'spanClass' => 'sr-only',
                    'class' => 'happy',
                    'currentClass' => 'active',
                    'currentTag' => 'a',
                ));
                ?> 
                <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
            </ul>
<?php }else{ ?>

<div class="bg_white freelaners marg_btm30">
            <div class="green">Result Results</div>
               <div class="col-md-2 col-sm-2 marg_tb15">
                 
               </div>
               <div class="col-md-10 colsm-10 marg_tb15 lesval">
             <p style="color: #C7C4C8;text-align: center;  font-size: 18px; padding: 30px;  margin-right: 100px;"> <strong>No Result(s) found.</strong></p>
               </div>
	
               
              <div class="clearfix"></div>
</div>

<?php } ?>

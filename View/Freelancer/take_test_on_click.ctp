<div class="container">
       <div class="row marg_tb15">
        <div class="col-md-12">
            <p><i><img class="mrg_r5" alt="Back to all test" src="<?php echo $this->webroot; ?>img/back.png"></i><a class="font_18" href="<?php echo $this->webroot; ?>freelancer/mytests">Back to all tests</a></p>
        </div>
           <?php if(!empty($tst)){ ?>
        <div class="col-md-8 col-sm-8 job_detail">
            <div class="bg_grey2">
                <h3 class="marg_0"><?php echo $tst['Test']['title'] . '   ( ' . $tst['Test']['test_type'] . ')'; ?>
                </h3>
                <p class="font_16 marg_tb15">This test is about <?php  echo $quest;?> multiple choice questions  and should take less than <?php echo '0'.$sum; ?> minutes to complete.</p>
                
                <a href="<?php echo $this->webroot; ?>freelancer/start_test/<?php echo $tst['Test']['id']; ?>" class="btn btn-danger btn_red3" <?php if( !empty($able_to_test) and isset($able_to_test) and $able_to_test['able']=="no"){  echo "disabled"; }?>>Start Test</a>
                <?php if(!empty($able_to_test['next_test_date']) && $able_to_test['able']=='no'){ ?>
                 <p class="font_16 marg_tb15 test"><img src="<?php  echo $this->webroot;?>img/Tip.png" alt="Tip image">Earliest day you can retake this exam is <?php if(isset($able_to_test['next_test_date']) and (!empty($able_to_test['next_test_date']))){ echo $able_to_test['next_test_date']; } ?></p>
                <?php } ?>
         </div>

        </div>

        <div class="col-md-4 col-sm-4 pad_r0">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Test Contents </div>
                <div class="panel-body bg_grey1 padd_0 bg_content">
                    <div class="col-md-12">
                        <?php
                        if (isset($test_content) and !empty($test_content)) {
                            foreach ($test_content as $kk => $vv) {
                                ?>
                                <ul class="nav">

                                    <p><?php echo $vv['Testcontent']['test_content']; ?>
                                        <br>
                                    </p>
                                </ul>
    <?php }
} else { ?>
       <p class="testcontent" style="color:#d2322d"> No Test Content(s) Found !</p>
<?php } ?>
                    </div>
                </div>
            </div>
        </div> 
           <?php } else { ?>
           <div class="col-md-8 col-sm-8 job_detail">
                 <p style=" font-size: 20px;"> The Test Cannot  be Found</p>

        </div>
           <div class="col-md-4 col-sm-4 pad_r0 " style="padding: 100px;">
          
        </div> 
           <?php } ?>
    </div>
</div>

<style>
    .testcontent {
        color: #d2322d;
        padding-top: 27px;
        text-align: center;
    }
    .font_16.marg_tb15.test {
    color: #DD5428;
}
</style>
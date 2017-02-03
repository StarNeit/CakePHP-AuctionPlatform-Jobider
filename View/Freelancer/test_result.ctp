 <?php if(!empty($test) && !empty($option)){ ?>
<div class="container">
   
    <div class="col-md-12">
        <div class="result1">
  <h1><?php echo $test['Test']['title']; ?> Results</h1>
            <?php if ($score < 2.5) { ?>
                <p>Unforunately, you did not pass this test. Please see below for areas that need  improvments and try again after 30 days.</p>
            <?php } ?>
  <?php echo $this->Form->create('Finalresult', array('url' => array('controller' => 'freelancer', 'action' => 'test_result', $testid))); ?>
            <div class="result_right">
                <div class="table-responsive">
                    <table class="table cust_table11 ">
                        <thead>
                            <tr><th>Topic</th><th class="result_right1">%Correct Answers</th></tr>
                        </thead>
                        <tbody>
                            <?php
                           foreach ($option as $val) {
                                ?>
                                <tr>
                            <?php foreach ($val['result'] as $v) { ?>
                                <input type="hidden" name="data[Finalresult][result_id][]" value="<?php echo $v['Result']['id']; ?>">
                                <input type="hidden" name="data[Finalresult][total_time][]" value="<?php echo $v['Result']['total_time']; ?>">
    <?php } ?>
                            <td><?php echo $val['Testcontent']['test_content']; ?></td>
                            <td class="result_right1"><?php echo $val['percentage'] . '%'; ?></td>
                            </tr>
<?php } ?>
                        <tr><td class="bottom1"><b>Your Score</b></td><td class="bottom2">
                                <b><?php echo $score; ?></b></td></tr>
                        <tr><td style="border:none;"><b>Passing Score</b></td><td style="border:none;" class="result_right1">
                                <b>2.5</b></td></tr>
           </tbody>
                    </table>
   </div>
            </div>
        </div>
    </div>
<div class="col-md-6 col-sm-6  col-xs-6    col-md-offset-5 col-sm-offset-5 col-xs-offset-5">
    
    <div class="readness"> 
            <button class="btn btn-primary" type="submit" >End Test</button>
        </div>

    </div>
  
<?php echo $this->Form->end(); ?>
</div>
  <?php } else { ?>
<div class="container">
    <p style="color: rgb(199, 196, 200); text-align: center; font-size: 20px; padding: 100px;"><strong>Sorry</strong> , No result found for this <strong><?php echo $testid; ?></strong> test id </p>
</div>
  <?php } ?>


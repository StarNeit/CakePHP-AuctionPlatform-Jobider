<div class="container">
    <?php if (!empty($test)) { ?>
        <div class="readness">
            <div class="col-md-12">
                <h1> <?php echo $test['Test']['title']; ?> </h1>
                <p>
                    Read the <a href="<?php echo $this->webroot; ?>freelancer/OnlineTestPolicy" target='_blank'>Online Testing Policies</a> and the instructions below prior to taking the test. </p>
                <p> This test will cover the following topics:  </p>


                <?php foreach ($test_content as $val) { ?>
                    <li>  <?php echo $val['Testcontent']['test_content']; ?></li>
                <?php } ?>

                <h1>Duration</h1>

                <p>The test will be <b><?php echo $sum; ?> minutes</b> and<b><?php echo '  '.$total_question; ?> multiple choice questions</b>.</p>

                <h1>Instructions:</h1>
                <li>Each Questions has between 2 and 8 options. One or more answers may be correct.</li>
                <li>Attempt all questions since there are no penalties for incorrect answers.</li>
                <li>You time remainng is show in the top of the test window.</li>
                <li>You test is best viewed using Internet Explorer 6.0+, Mozilla Firefox 2.0+ or Google Chrome.</li>
                <li>You must answer each questions before proceeding to the next questions. You will not be able to change an answer once you've moved to the questions</li>
                <li> <b>This test must be completed in a single sitting. </b>Unlike other jobider tests, this does not have an auto-resume feature. If you
                    are unable to complete the test in a single sitting, you can start the test afresh by logging in to your jobider account and once again clicking on the link to go the test.</li>
                <?php if (!empty($question)) { ?>
                    <a href="<?php echo $this->webroot; ?>freelancer/starting_test/<?php echo $test['Test']['id']; ?>" class="btn btn-primary" role="button">Start Test</a>
                <?php } else { ?>
                    <a href="<?php echo $this->webroot; ?>freelancer/starting_test/<?php echo $test['Test']['id']; ?>" class="btn btn-primary" role="button" disabled>Start Test</a>
                <?php } ?>


            </div>
        </div>
    <?php } else { ?>
        <div class="readness">
            <p style="font-size: 20px; color:#C7CBD6"> Invalid Test!! <br/> Reason : Insufficient Parameters</p>
            <a href="<?php echo $this->webroot; ?>freelancer/mytests"><img src="<?php echo $this->webroot; ?>img/back.png">Back to all tests</a>
            <div style="padding: 100px;">

            </div>
        </div>

    <?php } ?>
</div>
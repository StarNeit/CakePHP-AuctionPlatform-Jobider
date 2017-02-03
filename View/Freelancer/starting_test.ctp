<div class="container">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Form->create('Question', array('url' => array('controller' => 'freelancer', 'action' => 'starting_test', $this->params['pass']['0']))); ?>
    <?php if(!empty($ques)){ ?>
    <div class="col-md-12">
        <div class="col-md-6 col-sm-6 col-xs-12 item">
            <div class="item_left">
                <?php
                if (isset($count) and !empty($count)) {
                    $test1 = $count;
                } else {
                    $test1 = 1;
                }
                ?>
                <p><b>Item No:</b><?php echo $test1; ?> of <?php echo $test; ?> </p>
 <div class="clearfix"></div>
            </div>
 </div>
        
        <div class="col-md-6 col-sm-6 col-xs-12 item">
   <div class="item_right" >
<p><b >Time Remaining: <span id="hms_timer" ><?php echo $minutes. ':'. $seconds;  ?></span></b> </p>
  </div>
 <div class="clearfix"></div>
        </div>
    </div>
  <div class="item_bottom">
        <hr>
 </div>
    
    <div class="col-md-6 col-sm-6 col-xs-6">
        <?php
        foreach ($ques as $val) {
          
            if ($val['Question']['option_type'] == 'radio') {
                ?>
                <div class="options">
                    <p><b>Question</b></p>
                    <p> <?php echo $val['Question']['name']; ?></p>
                    <?php foreach ($val['option_data'] as $va) { ?>
                        <label class="radio">
                            <label>
                                <input type="radio" name="data[Question][myradio]" id="inlineRadio1 opty"  class='radio_cls' value='<?php echo $va; ?>'><?php echo $va; ?>
 </label>
                        </label>
                    <?php } ?>
 </div>
            <?php } ?> 
            <?php if ($val['Question']['option_type'] == 'checkbox') { ?>
                <div class="options">
                    <p><b>Question</b></p>
                    <p> <?php echo $val['Question']['name']; ?></p>
                    <?php  foreach ($val['option_data'] as $va) {  ?>
                    <label class="radio">
                        <label>
                     <input type="checkbox" name="data[Question][myradio]" id="inlineRadio1"  class='radio_cls'  value='<?php echo $va;?>'><?php echo $va;?>
                        </label>
                    </label>
                    <?php } ?>
          </div>
            <?php } ?> 
  <?php } ?>
</div>
    
    <div class="col-md-6 col-sm-6 col-xs-6 col ques hide">
        <div class='question-data'>
            <img alt="Ajax loader image" src="<?php echo $this->webroot; ?>img/ajax-loader.gif" style="margin: 56px auto; text-align: center; float: none; ">
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6  ">
   <div class="item_bottom_left">
            <?php
            if (isset($count) and !empty($count)) {
                $test = $count;
            } else {
                $test = 1;
            }
            ?>
 <input type="hidden" name="data[Question][question_number]"  value="<?php echo $test; ?>" id='questionNum'>
            <input type="hidden" name="data[Question][test_id]" value="<?php echo $val['Question']['id']; ?>">
            <input type="hidden" name="data[Question][spent_time]" value="<?php echo $val['Question']['time_spent']; ?>">
            <input type="hidden" name="data[Question][topic_id]" value="<?php echo $val['Question']['topic_id']; ?>">
            <input type="hidden" name="data[Question][seconds]" value="<?php echo $seconds; ?>" id='second'>
            <input type="hidden" name="data[Question][minutes]" value="<?php echo $minutes; ?>" id='minute'>
            <input type="hidden" name="data[Question][disable]" value="1" id='disable'>
            <input type="hidden" name="data[Question][test]" value="<?php  echo $val['Question']['test_id']?>" id='test_id'>
            <input type="hidden" name="data[Question][total_time]" value="" id='hms_timer1'>
           
            <p class='text-center'>
                <button class="btn btn-primary next" type="button">Next</button>
                
            </p>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
    <?php }  ?>
</div><!--container-->
<script>
    $(document).ready(function() {
        $('#QuestionStartingTestForm input').on('click', function() {
            var optionVal = $('input[name="data[Question][myradio]"]:checked', '#QuestionStartingTestForm').val();
            //alert(optionVal);
        });
  $(document).on('click', '.next', function() {
        var data=$('#hms_timer').html();
        $('#hms_timer1').val(data);
        $('#QuestionStartingTestForm').submit();
         var optionValSelected = $('input[name="data[Question][myradio]"]:checked', '#QuestionStartingTestForm').val();
          if (typeof optionValSelected === 'undefined') {
          
   } else {
        $('.ques').removeClass('hide');
  }
        });
    });

</script>
<script>
    $(document).ready(function() {
        var minute = $('#minute').val();
        var second = $('#second').val();
        var convertedTime = (Number(minute) * 60 + Number(second)) * 1000;
       setTimeout(function() {
            var data_time = $('#hms_timer').text();
 if (data_time == "00:01") {
                $('.radio_cls').attr('disabled', 'disabled');
                $('#disable').val('0');
             
            }
        }, convertedTime);
    })
</script>
<script type="text/javascript">
    var testval=$('#test_id').val();
if (window.history && window.history.pushState) {
  window.history.pushState('forward', null, './'+testval);
 $(window).on('popstate', function() {
      return false;
    });
  }
</script>
<!--<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-2.0.3.js"></script>-->
<script type="text/javascript" src=" <?php echo $this->webroot; ?>js/jquery.countdownTimer.js"></script>
<link rel="stylesheet" type="text/css" href="<?php // echo $this->webroot;   ?>css/jquery.countdownTimer.css" />
<script>
    $(function() {
        $('#hms_timer').countdowntimer({
            //     hours : 2,
            minutes:<?php echo $minutes ?>,
            seconds:<?php echo $seconds ?>,
            //  size : "lg"
        });
        $('#hms_timer1').countdowntimer({
            //     hours : 2,
            minutes:<?php echo $minutes ?>,
            seconds:<?php echo $seconds ?>,
        });
    });
</script>

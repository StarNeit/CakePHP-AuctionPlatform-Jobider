
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-12">
            <p><i><img src="<?php echo $this->webroot; ?>img/back.png" alt="Back to Search icon" class="mrg_r5"/></i><a href="<?php echo $this->webroot; ?>freelancer/myapplication" class="font_18">Back to search result</a></p>
        </div>
        <div class="col-md-8 col-sm-8 job_detail">
            <div class="bg_grey2" style="width: 135%">
                <div class="col-md-2 col-sm-2">
                    <?php if (isset($users['User']['image']) and !empty($users['User']['image'])) { ?>
                        <div class="user_imgbox">
                            <img src="<?php echo $this->webroot; ?>uploads/<?php echo $users['User']['image']; ?>" alt="login user image" width="100" height="100">
                        </div>
                    <?php } else { ?>
                        <img src="<?php echo $this->webroot; ?>img/user_1.png" alt="dummy user image" width="100" height="100">
                    <?php } ?>
                </div>
                <?php if (isset($users) and !empty($users)) { ?>
                    <h3 class="marg_0"><?php echo $users['User']['first_name'] . '  ' . $users['User']['last_name']; ?> </h3>
                <?php } ?>
                <?php if (isset($cntry) and !empty($cntry)) { ?>
                    <h4 class="marg_btm30"><img alt="location icon image" src="<?php echo $this->webroot; ?>img/location1.png"> <?php echo $cntry['Country']['name']; ?> <small class="marg_l20"> </small>   </h4>     <?php } ?>
                <h5 class="marg_0">Skills required</h5>
                <?php
                if (isset($subskills) and !empty($subskills)) {
                    foreach ($subskills as $k => $v) {
                        ?>
                        <button type="button" class="btn btn-danger btn_red3 marg_tb15"><?php echo $v['Subskill']['skill_name']; ?></button>

    <?php }
} ?>
                <div class="clearfix"></div>
            </div>

            <h3>Original Message For Client  </h3>

<!--            <p><?php //echo $send_invitation['Contect']['messages'];  ?></p>-->
            <p><?php echo $ClientMessage; ?></p>

<?php echo $this->Form->create('Message', array('url' => array('controller' => 'freelancer', 'action' => 'send_invitation', $send_invitation['Contect']['job_id']))); ?>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="exampleInputEmail1"><h4>Post a reply</h4></label>
<!--                    <textarea rows="5" class="form-control txtarea" name="data[Message][reply]">
                    </textarea>-->

<?php echo $this->Form->input('reply', array('class' => 'form-control txtarea', 'label' => false, 'rows' => '5')); ?>
                </div>
                <p class="waiting" style="display:none"></p>
                <p class="correct" style="display:none"></p>
                <button class="btn-lg btn-green col-md-3 col-sm-3 col-xs-4 replymsg " type="button">Reply</button>
            </div>
<?php echo $this->Form->end(); ?>


        </div>


    </div>

</div>
<?php echo $this->Html->script('jquery.min'); ?>

<script type="text/javascript">

    $(document).ready(function() {
        var check = 0;
        $('.txtarea').on('keyup', function(e) {
            var reply = $('.txtarea').val();
            if (e.keyCode == 13) {
                if (check == 0) {
                    $('.waiting').html(reply + '<br>');
                    $('.correct').html(reply + '<br>');
                    check = 1;
                } else {
                    var test = $('.waiting').html();
                    $('.waiting').html(test);
                    var test = test.replace('<br>', '');
                    var newString = reply.replace(test, '');
                    var te = $('.waiting').append(newString);
                    $('.correct').append(newString + '<br>');
                }
            }
        });
        $('.replymsg').on('click', function() {
            var select = $('.correct').html();
            var job_id = "<?php echo $send_invitation['Contect']['job_id']; ?>";
            var sender_id = "<?php echo $sender_id; ?>";
            var receiver_id = "<?php echo $reciever_id; ?>";
            $.ajax({
                type: 'post',
                url: '<?php echo $this->base; ?>/freelancer/send_mesg',
                dataType: 'json',
                data: {select: select, job_id: job_id, sender_id: sender_id, receiver_id: receiver_id},
                success: function(msg) {
                    if (msg.status == 'true') {
                        //$('.select').html(msg.select);
                        window.location.href = '<?php echo $this->webroot; ?>freelancer/invinterview/status';
                    }
                }
            });

        });
    });
</script>

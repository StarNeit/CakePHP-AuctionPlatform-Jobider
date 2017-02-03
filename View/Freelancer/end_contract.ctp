<script src="<?php echo $this->webroot; ?>stars/vendor/jquery.js"></script>
<script src="<?php echo $this->webroot; ?>stars/lib/jquery.raty.js"></script>
<script src="<?php echo $this->webroot; ?>stars/demo/javascripts/labs.js" type="text/javascript"></script>

<style>
    .functions .demo {
        margin-bottom: 10px;
    }
    .functions .item {
        background-color: #FEFEFE;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 5px;
        padding: 5px 10px;
    }
    .functions .item a {
        border: 1px solid #CCC;
        margin-left: 10px;
        padding: 5px;
        text-decoration: none;
    }
    .functions .item input {
        display: inline-block;
        margin-left: 2px;
        padding: 5px 6px;
        width: 120px;
    }
    .functions .item label {
        display: inline-block;
        font-size: 1.1em;
        font-weight: bold;
    }
    .hint {
        text-align: center;
        width: 160px
    }
    div.hint {
        font-size: 1.4em;
        height: 46px;
        margin-top: 15px;
        padding: 7px
    }
</style>
<?php  if(!empty($hire)){?>
<div class="container">
    <div class="col-md-12">

        <div class="row">

            <?php echo $this->Form->create('Projectfeedback', array('url' => array('controller' => 'freelancer', 'action' => 'end_contract/' . $job['Job']['id']))); ?>


            <div class="col-md-9 col-sm-9">
                <div class="contract_end">

                    <h1><?php echo $job['Job']['job_title']; ?></h1>
                </div> 
                <div class="contract_end_inner">

                    <?php
                    if (isset($error)) {
                        echo ' <div class="alert alert-danger alert-dismissible error-message" role="alert"> <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                        foreach ($error as $key => $value) {
                            echo $value . '<br>';
                        }
                        echo '</div> ';
                    }

                    echo $this->Session->flash();
                    ?>

                    <div class="contract_end_lay">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="row">
                                        <div class="contract_mid_left">Rating</div></div>

                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                        <div id="default" style="width:100%;float:left;"> 

                                            <input type="hidden" id="skills1" name="data[Projectfeedback][score]" /> </div>



                                    </div>
                                </div>
                            </div>
                        </div><!--col-md-12-->
                    </div>


                    <div class="contract_end_lay">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="row"><div class="contract_mid_left">Feedback to Client</div></div></div>

                                <div class="col-md-8">
                                    <div class="row"><div class="contract_mid_right">
                                            <textarea name="data[Projectfeedback][feedback]" rows="6" class="form-control"></textarea></div></div></div>
                            </div>
                        </div><!--col-md-12-->

                        <?php if(empty($feedback)){
                            ?>
                         <div class="contract_end_freelancer_butt"><button class="btn-sm btn-danger btn_red11">Send Feedback</button></div>
                        <?php
                        }else{
                            echo ' <div class="contract_end_freelancer_butt"><button type="button" class="btn-sm btn-danger btn_red11">Already Sent</button></div>';
                        } ?>
                       <!--contract_end_freelancer-->
                    </div>

                  <?php echo $this->Form->end(); ?>

           </div>
  </div><!--col-md-6-->






            <div class="col-md-3  col-sm-3 col-xs-12">
                <div class="result_right3">

                    <div class="result_right3_inner">

                        <h3>Contractor</h3>

                        <div class="col-md-4 col-xs-6">
                            <div class="result_right1_inner1">
                                <?php if(!empty($hire['Contractor']['image'])) { ?>
                                <img class="responsive" src="<?php echo $this->webroot; ?>uploads/<?php echo $hire['Contractor']['image']; ?>">
<?php  } else { ?>
                     <img class="responsive" src="<?php echo $this->webroot; ?>img/user_1.png">            
<?php } ?>
                            </div><!--result_right1_innerl-->
                        </div><!--col-md-6-->
                        <div class="col-md-8 col-sm-12 col-xs-6">
                            <div class="result_right1_innerr">
                                <h4><b><?php echo ucfirst($hire['Contractor']['first_name']) . ' ' . ucfirst($hire['Contractor']['last_name']); ?></b></h4>
                                <p>It's <?php echo date('D. h:i A', strtotime($hire['Hire']['created'])); ?></p>
                            </div><!--result_right1_innerr-->
                        </div><!--col-md-6-->
                        <div class="clearfix"></div>
                    </div><!--result_right3_inner-->



                    <div class="result_right3_inner">

                        <h3>Client</h3>

                        <div class="col-md-4 col-xs-6">
                            <div class="result_right1_inner1">
                                <?php if(!empty($hire['Hiring']['image'])){ ?>
                                <img class="responsive" src="<?php echo $this->webroot; ?>uploads/<?php echo $hire['Hiring']['image']; ?>">
                                <?php } else { ?>
                                 <img class="responsive" src="<?php echo $this->webroot; ?>img/user_1.png">
                                <?php } ?>
                            </div><!--result_right1_innerl-->
                        </div><!--col-md-6-->
                        <div class="col-md-8 col-sm-12 col-xs-6">
                            <div class="result_right1_innerr">
                                <h4><b><?php echo ucfirst($hire['Hiring']['first_name']) . ' ' . ucfirst($hire['Hiring']['last_name']) ?></b></h4>
                                <p>It's <?php echo date('D. h:i A', strtotime($hire['Hire']['created'])); ?></p>


                            </div><!--result_right1_innerr-->
                        </div><!--col-md-6-->

                        <div class="contract_butt">
                            <button class="btn-sm btn-danger btn_red11 send_msg">Send Message</button>
                            <a href="<?php echo $this->webroot; ?>freelancer/mymessage"><button class="btn-sm btn-danger btn_red11">all Message</button></a>


                        </div><!--result3_bottom-->

                        <div class="clearfix"></div>
                    </div><!--result_right3_inner-->




                    <div class="result_right3_inner">

                        <h3>Contract detalils</h3>


                        <div class="result_right1_bottom">
                            <div class="contract_right_bottom">
                                <p><?php echo $hire['Hire']['hire_status']; ?></p>
                            </div>
                            <p><a href="#">View Original job post</a></p>
                            <p><a href="#"></a></p>

                        </div>

                        <div class="contract_butt">
                            <button class="btn-sm btn-danger btn_red11">Give a Refund</button>
                            <a href="<?php echo $this->webroot; ?>freelancer/end_contract/<?php echo $hire['Job']['id']; ?>"><button class="btn-sm btn-danger btn_red11">End Contract</button></a>


                        </div><!--result3_bottom-->

                        <div class="clearfix"></div>
                    </div><!--result_right3_inner-->

                </div><!--result_right3-->


            </div>

        </div>















































    </div> <!--col-md-12-->


</div>
<?php } else { ?>
<div class="container">
    <div class="col-md-12">
                <p style="text-align: center; color: rgb(137, 137, 137); padding: 175px; font-size: 27px;">Sorry,No Contract Found</p> </div>
<div class="col-md-12">

<div class="row">
<div class="col-md-3  pad_l0 col-sm-3">

	</div>
	
	
	
	
<div class="col-md-6 col-sm-6">

<!--result_t-->
 
 
 
   
   </div><!--col-md-8-->
   
   
   <!--col-md-4-->

   </div>
</div> <!--col-md-12-->


 </div>
<?php } ?>
<script>
    $.fn.raty.defaults.path = '<?php echo $this->webroot; ?>stars/lib/images';

    $(function () {
        $('#default').raty();
        $('#default1').raty();
        $('#default2').raty();
        $('#default3').raty();
        $('#default4').raty();
        $('#default5').raty();
    });
    $(document).on('click', '#default img', function () {
        var valv = $(this).attr('alt');
        $('#skills1').val(valv);
        $('#skills').html(valv);

    });
</script>
<script>
    $(document).ready(function(){
        $('.send_msg').click(function(){
            var user_id=$('.send_msg').attr('id');
            var job_id=$(this).prev().val();
            $.ajax({
                type:'post',
                url:'<?php echo $this->webroot; ?>freelancer/ajax_send',
                data:{user_id:user_id,job_id:job_id},
                success:function(msg){
                    
                }
            });
        });
    });
</script>
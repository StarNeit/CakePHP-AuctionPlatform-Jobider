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

    <div class="row marg_tb15">
        <?php echo $this->element('reports_sidebar'); ?>

        <div class="col-md-9 col-sm-9 pad_r0">
            <div class="bg_white">
                <div class="green">
                    End Contract <i class="pull-right"> Contract Title (<?php echo $hire['Job']['job_title']; ?>) </i>
                </div>
                <div class="end_contract">
                    <?php
                    if (isset($success)) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php echo $success; ?>
                        </div>
                    
                    <script>
                        setInterval(function(){
                            window.location="<?php echo $this->webroot.'client/ActiveContract';?>";
                        },1000);
                        </script>
                    
                        <?php }
                    ?> 
                    <?php if (isset($error)) { ?> 
                        <div class="alert alert-danger alert-dismissible error-message" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <?php foreach ($error as $key => $value) { ?>


        <?php echo $value . '</br>'; ?>


                            <?php } ?>
                        </div>  
                            <?php }
                        ?>





<?php echo $this->Form->create('Projectfeedback', array('url' => array('controller' => 'client', 'action' => 'end_contract/' . $this->params['pass'][0]))); ?>
                    <div class="radio">
                        <label>
                            <input  class="no" name="data[Projectfeedback][additional_payment]" type="radio" checked="checked" value="no" id="optionsRadios1">
                            No additional payments </label>
                    </div>

                    <div style="float:left;" class="radio">
                        <label>
                            <input class="chhh" type="radio" name="data[Projectfeedback][additional_payment]" value="yes" id="optionsRadios1" > Additional payments $ </label>
                    </div>

                    <div class="form-group col-md-4">
                        <input style="display:none" type="text" id="exampleInputEmail2" name="data[Projectfeedback][additional_amount]" class="form-control em">
                    </div>
                    <div class="clearfix"> </div>


                    <h6> Share your experience ! Your honest feedback provides helpful information  to both tha freelancer and the Jobider community. </h6>
                </div>

                <!--               --> 
                <div class="green"> Private Feedback </div>
                <div class="end_contract">
                    <h6> This feedback will be kept anonymous and never shared directly with the freelancer .Learn More. </h6>

                    <div class="form-group col-md-4">
                        <label class="reason" for="exampleInputEmail1"> Reason for editing contract : </label>
                        <select name="data[Projectfeedback][reason]" class="form-control">
                            <option>Please select</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>   <div class="clearfix"> </div>

                    <p> Would you hire this freelancer again. If you had a similar project. </p>

                    <label class="radio-inline">
                        <input type="radio" value="Definitely Not" id="inlineRadio1" name="data[Projectfeedback][hire_status]" >Definitely Not
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="Probably Not" id="inlineRadio2" name="data[Projectfeedback][hire_status]"> Probably Not
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="Probably Yes" id="inlineRadio3" name="data[Projectfeedback][hire_status]"> Probably Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" value="Definitely Yes" id="inlineRadio3" name="data[Projectfeedback][hire_status]"> Definitely Yes
                    </label>

                </div>
                <!--             -->

                <!--          -->
                <div class="green"> Public Feedback </div>
                <div class="end_contract">
                    <h6> This feedback will be shared on your freelancer's profile only after they've left feedback for you.Learn More. </h6>
                    <p> Feedback to Freelancer </p>
                    <p> <div id="default" style="width:100%;float:left;"> 
                        <span> <span id="skills"></span> Stars( Skills ) </span>
                        <input type="hidden" id="skills1" name="data[Projectfeedback][skills]" /> </div> </p>
                    <p> <div id="default1" style="width:100%;float:left;">  <span> <span id="quality_of_work"></span>Stars(  Quality of work ) </span><input type="hidden" id="quality_of_work1"  name="data[Projectfeedback][quality_of_work]" /> </div> </p>
                    <p> <div id="default2" style="width:100%;float:left;">  
                        <span><span id="availability"></span> Stars( Availability ) </span>
                        <input id="availability1" type="hidden" name="data[Projectfeedback][availability]" />
                    </div> </p>
                    <p> <div id="default3" style="width:100%;float:left;">
                        <span><span id="adherence_of_work"></span> Stars( Adherence of work ) </span>
                        <input id="adherence_of_work1" type="hidden" name="data[Projectfeedback][adherence_of_work]" /> </div> </p>
                    <p> <div id="default4" style="width:100%;float:left;">  <span>
                            <span id="communication"></span> Stars( Communication ) </span> 
                        <input id="communication1" type="hidden" name="data[Projectfeedback][communication]" />
                    </div> </p>
                    <p> <div id="default5" style="width:100%;float:left;"> 
                        <span><span id="cooperation"></span> Stars( Cooperation ) </span>
                        <input id="cooperation1" type="hidden" name="data[Projectfeedback][cooperation]" />
                    </div> </p>

                    <h5> Total Score :<span class="total_score"> 0.00</span> </h5>

                    <div class="form-group row col-md-7">
                        <label for="exampleInputEmail1" class="reason">
                            Share your experience with this freelancer to the Jobider community.
                        </label>
                        <textarea name="data[Projectfeedback][feedback]" rows="3" class="form-control"></textarea>
                       
                        
                    </div> <div class="clearfix"> </div>


                    <h6> See an example of appropriate feedback. </h6>

                    <div class="col-md-12 marg_tb50 text-center">
                         <input type="hidden" name="data[Projectfeedback][score]" class="scre form-control" />
                        <button type="submit" class="btn-lg btn-green col-md-3 col-sm-6 col-xs-12 pull-left "> End Contract </button>
                        <button class="btn-lg btn-green col-md-2 col-sm-6 col-md-offset-1 col-xs-12"> Cancel </button>
                    </div>
                    <div class="clearfix"> </div></div>
                <!--          -->

            </div>
        </div>

<?php echo $this->Form->end(); ?>
    </div>

</div>
<?php } else { ?>
    <div class="container">
    <div class="col-md-12">
                <p style="text-align: center; color: rgb(137, 137, 137); padding: 175px; font-size: 27px;">Sorry No  Contract Found</p> </div>
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
<?php }?>
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
    $(document).on('click', '#default1 img', function () {
        var valv = $(this).attr('alt');
        $('#quality_of_work1').val(valv);
        $('#quality_of_work').html(valv);
    });
    $(document).on('click', '#default2 img', function () {
        var valv = $(this).attr('alt');
        $('#availability1').val(valv);
        $('#availability').html(valv);
    });
    $(document).on('click', '#default3 img', function () {
        var valv = $(this).attr('alt');
        $('#adherence_of_work1').val(valv);
        $('#adherence_of_work').html(valv);
    });
    $(document).on('click', '#default4 img', function () {
        var valv = $(this).attr('alt');
        $('#communication1').val(valv);
        $('#communication').html(valv);
    });
    $(document).on('click', '#default5 img', function () {
        var valv = $(this).attr('alt');
        $('#cooperation1').val(valv);
        $('#cooperation').html(valv);
        var skll = $('#skills1').val();
        var quality = $('#quality_of_work1').val();
        var availablility = $('#availability1').val();
        var work = $('#adherence_of_work1').val();
        var comm = $('#communication1').val();
        var cooperation = $('#cooperation1').val();
        var test = parseInt(skll)+parseInt(quality)+parseInt(availablility)+parseInt(work)+parseInt(comm)+parseInt(cooperation);
        var test=test/6;
        $('.total_score').html(test.toFixed(2));
        $('.scre').val(test.toFixed(2));
        
        
    });
    $(document).on('click','.chhh',function(){
        $('.em').show();
    });
    
    $(document).on('click','.no',function(){
        $('.em').hide();
    });


</script>
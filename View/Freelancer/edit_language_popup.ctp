<div class="modal-dialog">
    <div class="modal-content" id="edit_lang">
        <!--            <form accept-charset="utf-8" method="post" id="skill_data" role="form" action="/freelancer/edit_language">-->
        <?php echo $this->Form->create('Userlanguage', array('id' => 'skill_data', 'role' => 'form')); ?>
        <div class="modal-header green">
            <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 id="myModalLabel" class="modal-title">Change language</h4>
        </div>
        <div class="modal-body apply_jobform language_form">
            <!--        <form role="form">-->
            <div class="row">

                <label class="col-sm-3">Languages</label>
                <div class="col-sm-4">
                    <p ><?php echo $Language_result['Userlanguage']['language']; ?></p>
              
                </div>                    </div>
            <div class="row">
                <label class="col-sm-3">Proficiency</label>
                <div class="col-sm-9">

                    <?php if ($Language_result['Userlanguage']['proficiency'] == 'Basic') { ?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Basic" checked="">
                                Basic</label>
                            <p> I am only able to communicate in this language using written communication.</p>
                        </div>
                    <?php } else { ?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Basic" >
                                Basic</label>
                            <p>I am only able to communicate in this language using written communication. </p>
                        </div>
                    <?php } ?>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 col-md-offset-3">
                    <?php if ($Language_result['Userlanguage']['proficiency'] == 'Conversational') { ?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Conversational" checked="">
                                Conversational</label>
                            <p> I know this language well enough to verbally discuss project details with the client. </p>
                        </div>
                    <?php } else { ?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Conversational" >
                                Conversational</label>
                            <p> I know this language well enough to verbally discuss project details with the client. </p>
                        </div>

                    <?php } ?>

                </div>
            </div>

            <div class="row">

                <div class="col-sm-9 col-md-offset-3">
<?php  if($Language_result['Userlanguage']['proficiency']=='Fluent'){ ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Fluent" checked="" >
                            Fluent</label>
                        <p>I have complete command of this language with perfect grammar.</p>
                    </div>  

<?php  } else {?>
                   <div class="radio">
                        <label>
                            <input type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Fluent" >
                            Fluent</label>
                        <p>I have complete command of this language with perfect grammar.</p>
                    </div>     
                    
<?php } ?>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-9 col-md-offset-3">
<?php  if($Language_result['Userlanguage']['proficiency']=='Native') {?>

                    <div class="radio">
                        <label>
                            <input type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Native" checked="">
                            Native</label>
                        <p> I have complete command of this language with no discernible accent.  </p>
                    </div>
<?php } else { ?>
              <div class="radio">
                        <label>
                            <input type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Native">
                            Native</label>
                        <p> I have complete command of this language with no discernible accent.  </p>
                    </div>       
<?php } ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <p class=" text-center">
                <input type="hidden" value="<?php echo $Language_result['Userlanguage']['id']; ?>" id="lang_id" name="data[Userlanguage][id]" />
                <button class="btn btn_red font_18 col-md-3 col-md-offset-3" type="button" id="savedata" >Edit Language</button>
                <!--                <button  class="btn btn_red font_18  col-md-3 marg_l20 col-md-offset-1 btn-language" type="button" name="edit" value="edit">Save and Add more</button>-->
                <button data-dismiss="modal" class="btn btn_red font_18  col-md-1 marg_l20  " type="button">Cancel</button>
            </p><div class="clearfix"></div>
            <p></p>
        </div>
        <?php echo $this->Form->end(); ?>
        <!--            </form>-->
    </div>
</div>
<script>
    var data=$('#skill_data');
    $('#savedata').click(function(){
     var val=$('#lang_id').val()
    //alert(val);
        $.ajax({
           type:'post',
           dataType:'json',
           data:data.serialize(),
           url:'<?php echo $this->base;?>/freelancer/edit_languages',
           success:function(msg){
              if(msg.suc=='yes'){
                  test = msg.language+'-'+ msg.proficiency;
              $('#lng'+val).html(test);
              $('#edit_lang').hide();
                      $('.fade').removeClass('in');
                      //$('#myModal5').css('display','none');
              } 
           }
        });
    })
</script>
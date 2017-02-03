
<div class="modal-dialog">
    <div class="modal-content" style="display: none;" id='lang_popup'>
        <!--            <form accept-charset="utf-8" method="post" id="skill_data" role="form" action="/freelancer/edit_language">-->
        <?php echo $this->Form->create('Userlanguage', array('id' => 'skill_data', 'role' => 'form')); ?>
        <div class="modal-header green">
            <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 id="myModalLabel" class="modal-title">Add Language</h4>
        </div>
        <div class="modal-body apply_jobform language_form">
            <!--        <form role="form">-->
            <div class="row">

                <label class="col-sm-3">Languages</label>
                <div class="col-sm-4">

                    <input type="text" id='language' name="data[Userlanguage][language]" >


                </div>                    </div>
            <div class="row">
                <label class="col-sm-3">Proficiency</label>
                <div class="col-sm-9">


                    <div class="radio">
                        <label>
                            <input class="radio_val" type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Basic" >
                            <input type="hidden" id="prof">
                            Basic</label>
                        <p> I am only able to communicate in this language using written communication. </p>
                    </div>




                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 col-md-offset-3">

                    <div class="radio">
                        <label>
                            <input  class="radio_val" type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Conversational">
                            Conversational</label>
                        <p> I know this language well enough to verbally discuss project details with the client. </p>
                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col-sm-9 col-md-offset-3">

                    <div class="radio">
                        <label>
                            <input class="radio_val" type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Fluent" >
                            Fluent</label>
                        <p>I have complete command of this language with perfect grammar.</p>
                    </div>  



                </div>
            </div>

            <div class="row">

                <div class="col-sm-9 col-md-offset-3">


                    <div class="radio">
                        <label>
                            <input class="radio_val" type="radio" name="data[Userlanguage][proficiency]" id="inlineRadio1" value="Native">
                            Native</label>
                        <p> I have complete command of this language with no discernible accent. </p>
                    </div>
               </div>
            </div>
        </div>
        <div class="modal-footer">
            <p class=" text-center">
                <button class="btn btn_red font_18 col-md-3 col-md-offset-3" type="button" id='saveLanguage'>Add Language</button>
                <button data-dismiss="modal" class="btn btn_red font_18  col-md-1 marg_l20" type="button">Cancel</button>
            </p><div class="clearfix"></div>
            <p></p>
        </div>
        <?php echo $this->Form->end(); ?>
        <!--            </form>-->
    </div>
</div>
<script>
    $('body').on('click', '.radio_val', function() {
           var radio =  $( "input:checked" ).val();
            $('#prof').val(radio); //put checked radiobutton value into hidden field. 
        });
    $('#saveLanguage').on('click', function() {
        $('#lang_popup').show();
        var language = $('#language').val();
        var radio_val =  $('#prof').val(); // fetch value from hidden field.
        $.ajax({
            type: "POST",
            url: '/freelancer/language_popup_save',
            dataType:'json',
            data: {'language': language, 'radio_val': radio_val},
            success: function(data) {
              //  checkConfirm='return confirm(Are you Sure to delete this Notification)';
                if(data.suc == 'y'){
                    $('.testLanguage').show();
                    $('.setLanguage').append(language+' -'+radio_val+' <a id="'+data.id+'" data-target="#myModal5" class="edittlang" data-toggle="modal" href="#"><img src="/img/edt1.png"></a>&nbsp;&nbsp;<a onClick="return confirm(\'Are you Sure to delete this Notification\')" href="<?php echo BASE_URL; ?>/freelancer/delete_language/'+data.id+'"> <img src="<?php echo $this->webroot; ?>img/lngdel.png"></a>');
                          $('#lang_popup').hide();
                $('.fade').removeClass('in'); 
                }
//                alert(data);
              
//                $('#language_value').html(data);
            },
        });
    });
</script>
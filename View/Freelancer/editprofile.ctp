<style type="text/css">
    .error-message {
        color: #ff0f14;
    }
</style>


<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('freelancer_dashboard'); ?>
        <div class="col-md-6 col-sm-6">
            <div class="bg_white">
                <?php echo $this->Session->flash(); ?>
                <div class="green">
                    Basic details

                </div>
                <div class="sucessMessage alert alert-success " style="display:none;">
                    <button data-dismiss="alert" class="close">x</button>
                    <strong>Basic Details Saved Successfully..!!</strong> 
                </div>

                <div class="marg_tb15 paddbtm_30">

                    <?php echo $this->Form->create('User', array('id' => 'BasicInfoForm', 'class' => 'formstyle form_sighn ', 'role' => 'form', 'url' => array('controller' => 'freelancer', 'action' => 'edit_basic_info'))); ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo $this->Form->input('first_name', array('type' => 'text', 'class' => 'form-control firstname', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'First Name', 'required' => FALSE, 'value' => $user_value['User']['first_name'])); ?>
                        </div> </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo $this->Form->input('last_name', array('type' => 'text', 'class' => 'form-control lastname', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Last Name', 'required' => FALSE, 'value' => $user_value['User']['last_name'])); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">

                            <?php echo $this->Form->input('email', array('type' => 'text', 'class' => 'form-control email', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Email', 'name' => 'data[User][email_on_edit]', 'required' => FALSE, 'value' => $user_value['User']['email'])); ?>
                        </div> </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo $this->Form->input('country_id', array('type' => 'select', 'class' => 'form-control country', 'label' => false, 'required' => false, 'options' => array($find), 'default' => $user_value['User']['country_id'], 'empty' => 'Select The Country')); ?>
                        </div> 
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <a href="<?php echo $this->Html->Url(array('controller' => 'freelancer', 'action' => 'settings')); ?>" class="font_18">Change password</a>
                        </div>

                        <div class="col-md-8">
                            <!--             <button type='button' class="savebasicinfo btn-lg btn-green col-md-3 col-sm-3 col-xs-4 "  id="btn-submit" >Save</button>-->
                            <input type="submit" class=" btn-lg btn-green col-md-3 col-sm-3 col-xs-4 "  id=""  value="Save" />

                            <!--             <button class="btn-lg btn-green col-md-3 col-sm-3 col-xs-4 marg_l20" onClick="this.form.reset();">Cancel</button>-->
                            <input  type='reset' class="btn-lg btn-green col-md-4 col-sm-3 col-xs-4 marg_l20" value='Cancel' />
                        </div>

                    </div>
                    <!-- </form>-->
                    <?php echo $this->Form->end(); ?>   
                    <div class="clearfix"></div>
                </div>


            </div>

            <div class="bg_white">

                <div class="green">
                    Your profile details
                </div>

                <div class="marg_tb15 paddbtm_30">
                    <?php echo $this->Form->create('User', array('class' => 'form-horizontal form_sighn profile_form', 'role' => 'form', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'freelancer', 'action' => 'editprofile'))); ?>
                    <div class="col-md-12">

                        <label for="inputEmail3" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-9">

                            <?php echo $this->Form->input('job_title', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Title', 'value' => $user_value['User']['job_title'])); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-3 control-label">Company</label>                        <div class="col-sm-9">
                            <?php echo $this->Form->input('company', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Company', 'value' => $user_value['User']['company'])); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-3 control-label">Phone</label>                        <div class="col-sm-9">
                            <?php echo $this->Form->input('phone', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'label' => false, 'placeholder' => 'Phone number', 'value' => $user_value['User']['phone'])); ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control', 'id' => 'exampleInputEmail1', 'rows' => '4', 'cols' => '44', 'label' => false, 'placeholder' => 'Enter Description', 'value' => $user_value['User']['description'])); ?>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <label for="inputEmail3" class="col-sm-3 control-label">Profile Photo</label>
                        <div class="col-sm-9">
                            <div class="form-control upload_box">
                                <?php if (!empty($user_value['User']['image'])) { ?>
                                <img src="<?php echo $this->webroot; ?>uploads/<?php echo $user_value['User']['image']; ?>" alt="login user image" height="56" width="56" class="img-thumbnail">
                                <?php } else { ?>
                                <img src="<?php echo $this->webroot; ?>img/user_2.png" alt="dummy user image">
                                <?php } ?>
                            </div> 
                            <div class="fileUpload btn btn-danger pull-right">
                                <span>Browse</span>
                                <?php echo $this->Form->input('pro_img', array('type' => 'file', 'class' => 'upload', 'label' => FALSE, 'id' => 'exampleInputEmail1')); ?>
                            <!--    <input type="file" class="upload" />-->
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-3 control-label">Rate</label>
                        <div class="col-sm-9">
                            <p class="marg_0">
                                <?php
                                if (empty($budget['Userbudget']['budget'])) {?>
                                <span class="marg_0" id="rates"> </span><a href="#" class="marg_l20 font_14 editPrice" data-toggle="modal" data-target="#myModal3">Add budget</a>
                               <?php  } else { ?>
                                <span class="marg_0" id="rates"><?php echo $budget['Userbudget']['budget']; ?> </span><a href="#" class="marg_l20 font_14 editprice" data-toggle="modal" data-target="#myModal8">Add more</a>
                               <?php  }
                                ?>
                            </p>
                        </div>

                    </div>
                    <div class="col-md-12">
                    <?php  if(!empty($user_language)) {?>

                        <label for="inputEmail3" class="col-sm-3 control-label">Languages</label>
                        <div class="col-sm-9">
                            <p class="marg_0 setLanguage">
                                <?php
                                  foreach ($user_language as $key => $value) {
                                        echo '<span id="lng'.$value['Userlanguage']['id'].'">'.$value['Userlanguage']['language'] . ' -' . $value['Userlanguage']['proficiency'] . '&nbsp;&nbsp;</span>';
                                        ?>
                                <a href="#" data-toggle="modal" class="edittlang" data-target="#myModal5" id="<?php echo $value['Userlanguage']['id'] ; ?>"><img src="<?php echo  $this->webroot . 'img/edt1.png'; ?>" alt="edit icon image"></a> &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn_del" id="<?php  echo $value['Userlanguage']['id'];?>"> <img src="<?php echo $this->webroot.'img/lngdel.png'; ?>" alt="language delete image"></a><br>
                                        <?php 
                                    } ?>
                            </p>
                        </div>

                    <?php }else{ 
                        ?>
                        <label  style="display:none"  for="inputEmail3" class="testLanguage col-sm-3 control-label">Languages</label>
                        <div class="col-sm-9 testLanguage" style="display:none" >
                            <p class="marg_0 setLanguage">
                            </p>
                        </div>

                    <?php
                        
                    } ?>  
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-3 control-label">Add More Language</label>
                        <div class="col-sm-9">
                            <p class="marg_0">
                                <?php
                                echo '<a class="editlang" id="' . $user_value['User']['id'] . '" href="#" data-toggle="modal" data-target="#myModal4"><img src="' . $this->webroot . 'img/addlang.png" alt="add language image"></a>';
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-3 control-label"> Skills</label>
                        <div class="col-sm-9">

<?php if (!empty($user_skills)) { ?>
                            <p class="marg_0" id="skills"><?php echo $user_skills; ?> </p><a href="#" class="marg_l20 font_14 btn_skills" data-toggle="modal" data-target="#myModal6" id="<?php echo $user_value['User']['id']; ?>">Add more</a>

                                    <?php }else{ ?>
                            <p class="marg_0" id="skills"></p><a href="#" class="marg_l20 font_14 btn_skill" data-toggle="modal" data-target="#myModal" id="<?php echo $user_value['User']['id']; ?>">Add Your Skills</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <label for="inputEmail3" class="col-sm-3 control-label"> Categories</label>
                        <div class="col-sm-9">
<?php if (!empty($users_categories)) { ?>
                            <p class="edit_basic_infomarg_0" id="category"><?php echo $users_categories; ?> </p><a href="#" class="marg_l20 font_14 btn_category" data-toggle="modal" data-target="#myModal7">Add more</a><?php } else { ?>
                            <p class="marg_0" id="category"> </p><a href="#" class="marg_l20 font_14 btn_categories" data-toggle="modal" data-target="#myModal1">Add category</a><?php } ?>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <!--  <button class="btn-lg btn-green col-md-3 col-sm-3 col-xs-4 " type="submit">Save</button>-->
                        <button type="submit" class="btn-lg btn-green col-md-4 col-sm-3 col-xs-4">SAVE</button>      

                        <button  type='button' class="btn-lg btn-green col-md-4 col-sm-3 col-xs-4 marg_l20" onClick='this.form.reset();'>Cancel</button>
                    </div>
<?php echo $this->Form->end(); ?> 
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>

        <div class="col-md-3 col-sm-3 pad_r0">
            <!--    <form class="search_box" role="search">-->
<?php echo $this->Form->create('Category', array('class' => 'search_box', 'role' => 'search', 'url' => array('controller' => 'freelancer', 'action' => 'editprofile'))); ?>
            <div class="form-group">
                <div class="input-group col-md-12">
                    <label>Search Jobs</label>
                    <div class="input-group">
                        <input  id="searchbar"type="text" placeholder="Enter job title" class="form-control" name="data[Category][search]"><div class="input-group-addon padd_0"><button type="button" class="search_job">Search</button></div>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>

<?php if (!empty($category_data)) { ?>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Categories</div>
                <div class="panel-body bg_grey1 padd_0">
    <?php foreach ($category_data as $value) { ?>
                    <ul class="nav showpopup">

                        <li><a href="<?php echo $this->webroot; ?>freelancer/category_job/<?php echo $value['Subcategory']['id']; ?>"><?php echo $value['Subcategory']['category_name']; ?></a></li>
    <?php } ?>


                    </ul>
                </div>
            </div>
<?php } ?>

        </div> 
    </div>

</div>


<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


</div>

<div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


</div>
<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>


<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal4" class="modal fade in">

</div>
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal7" class="modal fade in">

</div>
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal5" class="modal fade in">

</div>

<!--<script type="text/javascript"  src="http://tramaze.pnf-sites.info/developer/app/webroot/front/js/jquery.form.min.js">
</script>-->
<script type="text/javascript"  src="<?php echo $this->webroot; ?>js/jquery.form.min.js">
</script>
<script>
    $(document).ready(function () {
        //  submitting the basic details of the freelancer
        var options = {
            beforeSubmit: showRequest,
            success: showResponse
        };
//        $('#BasicInfoForm').submit(function() {
//            $(this).ajaxSubmit(options);
//            return false;
//        });
        function showRequest(formData, jqForm, options) {
            //$('.popupbx').show();
        }
        function showResponse(responseText, statusText, xhr, $form) {
            data = $.parseJSON(responseText);
            console.log(data);
            $('div.error-message').remove();
            if (data.first_name) {
                errorDiv = '<div class="error-message">' + data.first_name[0] + '</div>';
                $('input[name="data[User][first_name]"]').after(errorDiv);
            }
            if (data.last_name) {
                errorDiv = '<div class="error-message">' + data.last_name[0] + '</div>';
                $('input[name="data[User][last_name]"]').after(errorDiv);
            }
            if (data.email_on_edit) {
                errorDiv = '<div class="error-message">' + data.email_on_edit[0] + '</div>';
                $('input[name="data[User][email_on_edit]"]').after(errorDiv);
            }
            if (data.country) {
                errorDiv = '<div class="error-message">' + data.country[0] + '</div>';
                $('select[name="data[User][country]"]').after(errorDiv);
            }
            if (data.status == 'success') {
                $('.sucessMessage').show().delay();
                window.location.href = data.url;
            }
            else {
                return false;
            }
        }
    });
</script>

<!--  for popups   ---->
<script>
    $(document).on('click', '.showpopup li', function () {
        var category_id = (this.id);
        $.ajax({
            type: "POST",
            url: "<?php echo $this->base; ?>/home/subategory_popup",
            data: {category_id: category_id},
            success: function (response) {
                $('#myModal2').html(response);
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.search_job', function () {
            var search = $('#searchbar').val();
            if (search == '') {
                alert('Please Enter the Search keyword !');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.subskl', function () {
            $(this).prev().removeAttr('disabled');
        });

        $(document).on('click', '.editPrice', function () {
            var paid = $('.paid').val();
            var ten = paid / 10;

            var tens = parseInt(paid) - ten;
            $('.ten').html('0' + ten + '.00/hr')
            $('.tens').val('0' + tens + '.00')
            $('.tens1').val(' ' + tens);
        });
        $(document).on('click', '.subcate', function () {
            $(this).prev().removeAttr('disabled');
        });
    });
</script>

<!----------------- Language Modal  Jquery--------------------->
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-language', function (event) {
            event.preventDefault();
            $('.lang_data').removeClass('hide');
            $('.radio_data').removeClass('hide');
            $('.radio').addClass('hide');
            $('.lang').addClass('hide');
            var language = $('.lang').val();
            var prof = $('input[type="radio"]:checked').val();
            $.ajax({
                type: "POST",
                url: "<?php echo $this->base; ?>/freelancer/ajax_editlanguage",
                data: {language: language, prof: prof},
                success: function (response) {
                    $('.lang1').hide();
                    $('.lang').removeClass('hide');
                    $('.lang').attr('type', 'text');
                    $('.lang').attr('value', '');

                }
            });
        });
    });

    $(document).ready(function () {
        $(document).on('click', '.editlang', function () {
//$('#lang_popup').show();
            var user_id = $('.editlang').attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo $this->base; ?>/freelancer/language_popup",
                data: {user_id: user_id},
                success: function (response) {
                    $('#myModal4').html(response);
                    $('#lang_popup').show();
                }
            });
        });
    });
    $(document).ready(function () {
        $(document).on('click', '.edittlang', function () {
            var lang_id = $(this).attr('id');
            //alert(lang_id);
            $.ajax({
                type: "POST",
                url: "<?php echo $this->base; ?>/freelancer/edit_language_popup",
                data: {lang_id: lang_id},
                success: function (response) {
                    $('#myModal5').html(response);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.btn_skill', function () {
            var user_id = $('.btn_skill').attr('id');
            $.ajax({
                type: 'post',
                url: '<?php echo $this->base;?>/freelancer/add_skills',
                data: {user_id: user_id},
                success: function (response) {
                    // alert(response);
                    $('#myModal').html(response);
                    //$('skill_popup').show();
                }
            });
        });
        $(document).on('click', '.btn_skills', function () {
            var usr_id = $('.btn_skills').attr('id');
            $.ajax({
                type: 'post',
                'url': '<?php echo $this->base; ?>/freelancer/edit_skills',
                data: {usr_id: usr_id},
                success: function (response) {
                    $('#myModal6').html(response);
                }
            });
        });

        $(document).on('click', '.btn_categories', function () {
            $.ajax({
                type: 'post',
                url: '<?php echo $this->base; ?>/freelancer/add_category',
                success: function (response) {
                    $('#myModal1').html(response);
                }
            });
        });

        $('.btn_category').click(function () {
            $.ajax({
                type: 'post',
                url: '<?php echo $this->base; ?>/freelancer/edit_category',
                success: function (response) {
                    $('#myModal7').html(response);
                }
            });
        });
        $(document).on('click', '.editPrice', function () {
            $.ajax({
                type: 'post',
                url: '<?php  echo $this->base;?>/freelancer/edit_rate',
                success: function (response) {
                    $('#myModal3').html(response);
                }
            });
        });
        $(document).on('click', '.editprice', function () {
            $.ajax({
                type: 'post',
                url: '<?php echo $this->base;?>/freelancer/add_rate',
                success: function (response) {
                    $('#myModal8').html(response);
                }
            });
        });


        $('.btn_del').click(function () {
            var language = $(this).attr('id');
            $this = $(this);
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->base;?>/freelancer/delete_language',
                data: {language: language},
                success: function (msg) {
                    if (msg.suc == 'yes') {
                        $this.prev().remove();
                        $this.prev().remove();
                        $this.remove();

                    }

                }
            });
        });
    });
</script>




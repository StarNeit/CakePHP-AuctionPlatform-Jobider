<?php  
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'view_ended_contract')) {
    $cont = 'active';
}
else 
{
    $cont = '';
}
?>

<div class="container">

    <div class="row marg_tb15">

        <div class="col-md-3 pad_l0 col-sm-3">

            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li><a href="<?php echo $this->webroot; ?>client/manageMyTeam"> Freelancers i have hired </a></li>
                        <li class="active"><a href="<?php echo $this->webroot; ?>client/ActiveContract">Contracts </a></li>
                        <li><a href="<?php echo $this->webroot; ?>client/SentMessageToApplicant"> Sent Messages to applicants </a></li>
                               <li class="<?php echo $cont; ?>"><a href="<?php echo $this->webroot; ?>client/view_ended_contract"> View Ended Contracts </a></li>
                    </ul>
                </div>
            </div>

            <?php echo $this->element('client_notification'); ?>



        </div>

        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green">
                    <span class="pull-left"> Team </span>

                    <div class="col-md-3 col-xs-10">
                        <form>
                            <select class="form-control" disabled='disabled'>
                                <option value="<?php echo $user['User']['id']; ?>"><?php echo ucfirst($user['User']['first_name']) . ' ' . ucfirst($user['User']['last_name']); ?></option>
                                <!--  <option value="">1</option>
                                  <option value="">2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>-->
                            </select>
                        </form>
                    </div>

                    <div class="ended">
                        <div class="col-md-6 col-md-offset-2">
                            <!--      <form>-->
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="chek" checked="checked" value="" > Ended Contracts
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <?php echo $this->Form->create('Hire', array('url' => array('controller' => 'client', 'action' => 'ActiveContract'))); ?>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="input-group">
                                    <input type="text" aria-describedby="basic-addon2" name="data[Hire][search_contractor]" placeholder="" class="form-control" id="searchbar">
                                    <span id="basic-addon2" class="input-group-addon"><button class="nodisp search_job" type="submit" ><img src="<?php echo $this->webroot; ?>img/search.png" alt="searchImage"></button></span>
                                </div>
                            </div> 
                            <?php echo $this->Form->end(); ?>
                            <!--      </form>-->
                        </div>
                    </div> 
                    <div class="clearfix"> </div>
                </div> 

                <div class="table-responsive">
                    <table class="table cust_table11">
                        <thead>
                            <tr>
                                <th>Freelancer </th>
                                <th>Time Period </th>
                                <th>Terms</th>
                            </tr>
                        </thead>
                        <?php if (empty($hire_data)) { ?>
                            <tbody>
                                <tr>
                                    <td class="text-center contract cont" colspan="4">  No Contracts- <a href="<?php echo $this->webroot; ?>client/postajob">Post a job and hire someone</a> </td>

                                    <td class="text-center contract end_con hide" colspan="4">  No Active Contracts- <a href="<?php echo $this->webroot; ?>client/view_ended_contract">View ended contracts</a> </td>
                                </tr>

                            </tbody>
                        <?php } else { ?>
                            <tbody>
                                <?php foreach ($hire_data as $k => $v) { ?>
                                    <tr>
                                        <td >
                                            <input type="hidden" value="<?php echo $v['Hire']['contractor_id']; ?>">
                                            <input type="hidden" value="<?php echo $v['Job']['id']; ?>">
                                            <a href="JavaScript:void(0);" style="text-decoration: none; color: rgb(138, 137, 137);" id="" class="cont_data"><?php echo ucwords($v['Hire']['contractor_name']); ?></a></td>
                                        <td ><?php echo $v['Hire']['duration']; ?></td>
                                        <td >$<?php echo $v['Job']['budget'] . ' (Fixed) '; ?></td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        <?php } ?>
                    </table>
                </div>

            </div>

        </div>


    </div>

</div>

<style>
    .nodisp {
        background: none repeat scroll 0 0 #fff;
        border: 0 none;
        box-shadow: none;
    }

</style>


<script>
    $(document).ready(function() {
        $(document).on('click', '.search_job', function() {
            var search = $('#searchbar').val();
            if (search == '') {
                alert('Please Enter the Search keyword !');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });
        $('.chek').click(function() {
            if ($('input[type=checkbox]').is(':checked')) {
                var value = $('input[type=checkbox]').val('yes');
            } else {
                var value = $('input[type=checkbox]').val('no');
            }
            var valdata = $('input[type=checkbox]').val();
            if (valdata == 'yes') {
                $('.cont').removeClass('hide');
                $('.end_con').addClass('hide');
            }
            if (valdata == 'no') {
                $('.cont').addClass('hide');
                $('.end_con').removeClass('hide');
            }

        });
        $('.cont_data').click(function() {
            var job_id = $(this).prev().val();
            var user_id = $(this).prev().prev().val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>client/ajax_datas',
                data: {job_id: job_id, user_id: user_id},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        window.location = '<?php echo $this->webroot; ?>client/contracts/' + msg.job_id;
                    }
                }
            });
        });
    });

</script>
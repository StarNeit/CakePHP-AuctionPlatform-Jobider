<?php 
if($this->params['controller']=='freelancer' && $this->params['action']=='view_ended_contract'){
    $end = 'active';
}else{
    $end='';
}
?>
<div class="container">

    <div class="row marg_tb15">

        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">My Jobs</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li class="active"><a href="<?php  echo $this->webroot; ?>freelancer/myjobs"> Contracts </a>
                        </li>
                        <li class="<?php echo $end; ?>"><a href="<?php  echo $this->webroot; ?>freelancer/view_ended_contract"> View Ended Contracts </a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Earning </div>
                <div class="panel-body bg_grey1 padd_tb15">
                    <p>Available now :<?php if(!empty($Payment_earning)){ echo '$'.$Payment_earning.'.00';}else{ echo '$0.00';}  ?></p>
<!--                    <p class="text-center">
  <button type="submit" class="btn btn-danger">Withdraw</button>
                                            </p>    -->
                    <p><i><img alt="view earning image" class="mrg_r5" src="<?php echo $this->webroot; ?>img/view.png"></i><a href="<?php echo $this->webroot; ?>freelancer/reporting">View pending earnings &gt;&gt;</a></p>

                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">
            <div class="bg_white">
                <div class="green">
                    <span class="pull-left"> Team </span>

                    <div class="col-md-3">
                        <form>
                            <select class="form-control" disabled='disabled'>
                                <option value="<?php echo $user['User']['id']; ?>"><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?></option>
                            </select>
                        </form>
                    </div>
                    <div class="ended">
                        <div class="col-md-6 col-md-offset-2">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="chek" checked="checked" value="" > Ended Contracts
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                      <?php echo $this->Form->create('Job',array('url'=>array('controller'=>'freelancer','action'=>'myjobs'))); ?>
     <div class="col-md-6 col-xs-12"> 
      <div class="input-group">
       <input type="text" aria-describedby="basic-addon2" name="data[Job][search_contractor]" placeholder="" class="form-control" id="searchbar">
       <span id="basic-addon2" class="input-group-addon"><button class="nodisp search_job" type="submit" ><img src="<?php echo $this->webroot; ?>img/search.png" alt="Search image icon"></button></span>
      </div>
     </div> 
<?php echo $this->Form->end(); ?>
                            
                        </div>
                    </div> 
                    <div class="clearfix"> </div>
                </div> 
                <div class="table-responsive">
                    <table class="table cust_table11">
                        <thead>
                            <tr>
                                <th> Contract </th>
                                <th> Time Period </th>
                                <th> Terms </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($hire)) { ?>
                                <?php foreach ($hire as $k => $v) { ?>
                                    <tr>
                                        <td><a href="<?php echo $this->webroot; ?>freelancer/contracts/<?php echo $v['Job']['id']; ?>" style="text-decoration: none; color: rgb(138, 137, 137);"><?php echo $v['Job']['job_title']; ?></a></td>
                                        <td><?php echo $v['Hire']['duration']; ?></td>
                                        <td><?php echo '$' . $v['Job']['budget'] . ' (Fixed)'; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td class="text-center contract cont" colspan="4">  No Contracts- <a href="<?php echo $this->webroot; ?>freelancer">Search jobs and apply to get hired</a> </td>
                                    <td class="text-center contract end_con hide" colspan="4">  No Active Contracts- <a href="<?php echo $this->webroot; ?>freelancer/view_ended_contract">View ended contracts</a> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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
    });
</script>

<style>
    .nodisp {
    background: none repeat scroll 0 0 #fff;
    border: 0 none;
    box-shadow: none;
}
    
</style>
<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-3 pad_l0 col-sm-3">
            <div class="panel panel-default green_bg1">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body bg_grey1 padd_0">
                    <ul class="nav ">
                        <li><a href="<?php echo $this->webroot; ?>client/dashboardHelp"> Help </a></li>
<!--                        <li><a href="<?php echo $this->webroot; ?>client/client_Dispute">  Dispute </a></li>-->
                    </ul>
                </div>
            </div> 

            <?php echo $this->element('client_notification'); ?>

        </div>
        <div class="col-md-9 col-sm-9  pad_r0 ">

            <div class=" serch_btn ssp ">
                <div class="col-xs-12 col-sm-6  col-md-6">
<!--                    <p>Use Seach box below to view our knowledge base article</p>-->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 ssp">
                    <?php echo $this->Form->create('Faq', array('url' => array('controller' => 'client', 'action' => 'dashboardHelp'))); ?>
                    <div class="input-group">
                        <input type="text" placeholder="Search for..." id="searchbar"class="form-control" name="data[Faq][search]">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default search_job">Search</button>
                        </span>
                    </div> 
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="bg_white marg_tb15">
                <div class="green">
                    Most frequent questions from user like you
                </div>
                <?php
                if (isset($faq) and !empty($faq)) {
                    foreach ($faq as $key => $val) {
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-12  ">
                            <div class="help_quest">
                                <a href="<?php echo $this->webroot; ?>client/view_help/<?php echo $val['Faq']['id']; ?>" style="text-decoration: none"> <h4><?php echo $val['Faq']['question']; ?></h4></a>
                                <p><?php echo $val['Faq']['keyword']; ?></p>
                            </div>
                        </div> <?php }
        } else { ?>
                    <p class="p_res">
                        <strong>Sorry,&nbsp; No Result(s) Found !</strong></p> 
                    <div class="clearfix"></div>
<?php } ?>
                <div class="col-md-12 pgentn">
                    <nav>
                        <ul class="pagination pull-right">
                            <li><?php echo $this->Paginator->prev('<<Previous', null, null, array('class' => 'disabled')); ?></li>
                            <?php
                            echo $this->Paginator->numbers(array(
                                'before' => '',
                                'after' => '',
                                'separator' => '',
                                'tag' => 'li',
                                'spanClass' => 'sr-only',
                                'currentClass' => 'active',
                                'currentTag' => 'a',
                            ));
                            ?> 
                            <li><?php echo $this->Paginator->next('Next>>', null, null, array('class' => 'disabled')); ?></a></li>
                        </ul> </nav>
                </div> 
                <div class="clearfix"></div>
            </div>
            <div class="bg_white marg_tb15 b_quest">
                <div class="green">
                    Browse questions by category
                </div>
                <?php
                if (isset($helpTitle) and !empty($helpTitle)) {
                    foreach ($helpTitle as $key => $val) {
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-12  ">
                            <div class="brws_quest">
                                <h3><a href="<?php echo $this->webroot . 'client/singleHelpTopic/' . $val['Help']['id']; ?>" style="text-decoration: none"><?php echo $val['Help']['title']; ?></a> </h3>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?> 
                    <p style="color: red; text-align: center;  margin-top: 33px; margin-bottom: 33px;"> <strong>Sorry, &nbsp;</strong> No Help Content(s) Found!
                    </p> 
                    <div class="clearfix"></div>
<?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '.search_job', function() {
            var search = $('#searchbar').val();
            if (search == '') {
                alert('Please enter search keyword !');
                return false;
            } else {
                $('.search_job').attr('type', 'submit');
                return true;
            }
        });
    });
</script>


<style>
.p_res {
    color: #1E9BD4;
    margin-bottom: 0;
    margin-top: 30px;
    text-align: center !important;
}
</style>

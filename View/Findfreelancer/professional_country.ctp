<div class="container">
    <div class="title">
        <h2><span class=" text-left">Browse freelancer by category</span>
            <a href="<?php echo $this->webroot; ?>login"><button type="button" class="btn btn-sm  btn_red btn_red12 pull-right fnone mar10">Post a job</button></a>
        </h2>
    </div>
    <hr class="brder_btm">

    <div class="row">

        <div class="col-md-8 col-sm-8 marg_btm30">

            <div class="header_bg">

                <h4 class="marg_0"><span class="pull-left marg_t5 fnone">Select Country to choose freelancer</span> 
                    <?php //echo $this->Form->create('Country',array('url'=>array('controller'=>'findfreelancer','action'=>'professional_country'))); ?>
                    <!--     <div class="col-md-4 pull-right float_none ">
                             <select class="form-control" placeholder="Email">
                              <option>Country</option>
                               <option>option1</option>
                               <option>option1</option>
                               <option>option1</option>
                               
                             </select>
                    <?php //echo $this->Form->input('select', array('class' => 'form-control  doselect', 'type' => 'select', 'label' => false, 'options' => array('' => 'All Country', $country))) ?>
                            </div>-->
                    <?php // echo $this->Form->end(); ?>
                    <div class="clearfix"></div></h4>
            </div>
            <div class="list_freelancer marg_tb15 uservalue">
                <?php foreach ($countryy as $kk => $vv) { ?>
                    <ul class="nav col-md-4 col-sm-4">
                        <li><a href="<?php echo $this->Html->Url(array('controller' => 'findfreelancer', 'action' => 'country_data', $vv['Country']['id'])); ?>"><?php echo $vv['Country']['name']; ?></a></li>


                    </ul>
                <?php } ?> 

            </div>

        </div>

        <div class="col-md-4 col-sm-4">
            <div class="green_bg panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"> <h3 class="marg_0">Freelancer By Country</h3></div>
                <div class="panel-body">
                    <p class="marg_0">
<!--                        <a href="#">View all</a>-->
                    </p>
                </div>

                <!-- List group -->

                <ul class="list-group padd_tb15">
                    <?php foreach ($freelancer_result as $kk => $vv) { ?>
                        <li class="list-group-item">
<!--                            <a href="#">-->
                                <?php echo $vv['User']['username']; ?>
<!--                            </a>-->
                        </li>
                    <?php } ?>
                </ul>

            </div>  
            

            <div class="green_bg panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"> <h3 class="marg_0">Freelancer By Category</h3></div>
                <div class="panel-body">
                    <p class="marg_0">
<!--                        <a href="#">View all</a>-->
                    </p>
                </div>

                <!-- List group -->
                <ul class="list-group padd_tb15">
                    <?php foreach ($category as $key => $val) { ?>
                        <li class="list-group-item"> <a href="<?php echo $this->Html->Url(array('controller' => 'findfreelancer', 'action' => 'FreelancerByCategory', $val['Category']['id'])); ?>" style="text-decoration: none;"><?php echo $val['Category']['name']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="pagi col-md-7 col-md-offset-4">
            <?php ?>

            <ul class="pagination pull-right">

                <li><?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?></li>
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
                <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
            </ul>

        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        //alert('kdfkdjf');
        $(document).on('change', '.doselect', function() {
            var country_id = $(this).val();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '<?php echo $this->webroot; ?>findfreelancer/countrydata',
                data: {country_id: country_id},
                success: function(msg) {
                    if (msg.suc == 'yes') {
                        alert('yes');
                        $(".uservalue").html(msg.user_data);
                        //$('.uservalue').htmlReplace(msg.user_data);
                    }
                    else if (msg.suc == 'no')
                    {
                        //alert('no');
                        $(".list_freelancer").html(msg.user_data);
                    }

                }
            });
        });
    });

</script>
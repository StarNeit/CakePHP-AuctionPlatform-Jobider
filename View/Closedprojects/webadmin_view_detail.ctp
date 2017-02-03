<section class="" id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading name">
                        <h4>Closed Project Name:- <b><u><i>"<?php echo $hire['Job']['job_title']; ?>"</i></u><b></h4>
                                    </header>
                                    <div class="panel-body">
                                        <div class="position-center">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Job Budget:</label>
                                                <div class="col-lg-6">
                                        <p class="form-control-static">$<?php echo $hire['Job']['budget']; ?></p>
                                                </div>
                                            </div> 
                                            <div class="clearfix"></div><br>
                                            <div class="form-group">
                                                <label class=" col-sm-4 control-label">Start Date:</label>
                                                <div class="col-lg-6">
                                                    <p class="form-control-static"><?php echo date('d-M-Y', strtotime($hire['Hire']['created'])); ?></p>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div><br>
                                            <?php
                                            $i = 1;
                                            foreach($record as $record) {
                                                if (($i == 1) && ($record['Projectfeedback']['user_type'] == 'client')) {
                                                    ?> 
                                                    <div class="form-group">
                                                        <label class=" col-sm-4 control-label">End Date:</label>
                                                        <div class="col-lg-6">
                                                            <p class="form-control-static"><?php echo date('d-M-Y', strtotime($record['Projectfeedback']['created'])); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div><br>
                                                    <?php
                                                }
                                                // feedback by client to freelancer
                                                if (($record['Projectfeedback']['user_type'] == 'client')) {
                                                    ?>
 <div class="form-group">
                                                        <label class=" col-sm-4 control-label">Feedback to Freelancer:</label>
                                                        <div class="col-lg-6">
                                                            <p class="form-control-static"> <?php
                                                                $star = round($record['Projectfeedback']['score']);
                                                                for ($s = 1; $s <= $star; $s++) {
                                                                    ?>
                                                                    <img src='<?php echo $this->webroot; ?>img/star.png'>
                                                                <?php } echo'<br>' . $record['Projectfeedback']['feedback'];
                                                                ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div><br>
                                                    <?php
                                                }
                                                //feedback by freelancer to client
                                                if (($record['Projectfeedback']['user_type'] == 'freelancer')) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class=" col-sm-4 control-label">Feedback to Client:</label>
                                                        <div class="col-lg-6">
                                                            <p class="form-control-static"> <?php
                                                                $stars = round($record['Projectfeedback']['score']);
                                                                for ($j = 1; $j <= $stars; $j++) {
                                                                    ?>
                                                                    <img src='<?php echo $this->webroot; ?>img/star.png'>
        <?php } echo '<br>' . $record['Projectfeedback']['feedback'];
        ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div><br>
                                                    <?php
                                                }
                                                $i++;
                                            }
                                            ?>

                                            <a href="<?php echo $this->Html->url(array('controller' => 'Closedprojects', 'action' => 'index', 'prefix' => 'webadmin')); ?>"><button class="btn btn-primary" type="button">Back</button></a>
                                        </div>
                                    </div>
                                    </section>
                                    </div>
                                    </div>
                                    <!-- page end-->
                                    </section>
                                    </section>
                                    <style>
                                        .current{
                                            background: none repeat scroll 0 0 #DA423D !important;
                                            float: left;
                                            height: 34px !important;
                                            margin-top: 2px;
                                            width: 36px;
                                            padding-top: 6px;
                                            padding-left: 12px;
                                            color: white;
                                        }
                                        .next{
                                            color:white !important;
                                        }
                                        .prev{
                                            color:white !important;
                                        }

                                        .input-group-addon.grrenbtn {
                                            background: #1fb5ad;
                                            color: #fff;
                                            font-size: 14px;
                                        }

                                        .name h4{
                                            text-transform: none;
                                        }
                                    </style>
<div class="container">
    <?php if (!empty($users)) { ?>
        <div class="row marg_tb15">
            <?php echo $this->element('client_sidebar'); ?>

            <div class="col-md-9 col-sm-9  pad_r0 ">
                <div class="bg_white marg_btm30">

                    <div class="green">

                        <?php echo $jobs['Job']['job_title']; ?>
                        <br/>
                        <br/>

                        <span class="pull-right">Total Applicants : <?php echo $jobs_count; ?></span>
                        <div class="clearfix"></div>


                    </div>
                    <div class="table-responsive">

                        <table class="table cust_table11 table-striped">
                            <thead>
                                <tr>
                                    <th>Freelancer   </th>
                                    <th> Profile Title  </th>
                                    <th>
                                    </th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($users as $k => $va) {
                                    ?>
                                    <tr>
                                        <td>

                                            <div class="active col-md-5 pad_l0">
                                                <div class="user_imgbox">

                                                    <img src="<?php echo $this->webroot; ?>uploads/<?php echo $va['User']['image']; ?>" alt="login user" height="100" width="100">

                                                </div>

                                            </div>
                                            <div class="col-md-7 pad_l0">
                                                <h4 class="marg_0 text-danger"><?php echo $va['User']['first_name'] . ' ' . $va['User']['last_name']; ?></h4><ul class="list-inline marg_0 star_pad">
                                                  
                                                 <?php
                                                 if(!empty($va['feedback']['Projectfeedback']['score'])){
                                                    $number = number_format($va['feedback']['Projectfeedback']['score'], 0);
                                                    for ($i = 1; $i <= $number; $i++) {
                                                        ?>   
                                                 <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star image"/></li> <?php } }?>
                                                </ul>
                                                <small class="text_1">
                                                    <?php
                                                    if (!empty($va['User_Country']['Country']['name'])) {
                                                        echo $va['User_Country']['Country']['name'];
                                                    } else {
                                                        echo 'No Country added Yet !';
                                                    }
                                                    ?>
                                                </small>

                                            </div>
                                        </td>
                                        <td>

                                            <?php echo $va['Job']['job_title']; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo $this->Html->Url(array('controller' => 'client', 'action' => 'freelancer_profile', $va['User']['id'])); ?>"><button class="btn-sm btn-danger btn_red11">View Detail</button></a>
                                            <br/>                                          
                                            
<!--                                            <a href="#" class="font_14">Shortlist</a>-->
                                        
                                        </td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>



                        </table>


                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>


        </div>
    <?php } else { ?>
        <h2 class="header_style"><span class="large_font text-left"> </span> <span class="text_green marg_l20 font_18"> 
            </span>
            <!--            <button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button>-->
        </h2>
        <div class="row">
            <div class="col-md-12 col-sm-8 marg_btm30">
                <div class="clearfix"></div>
                <div class="bg_white freelaners marg_btm30">
                    <div class="green">
                        Search Results<span class="date pull-right"><i class="mrg_r5"><img src="img/deatil.png" alt="image"></i></span>
                        <div class="clearfix"></div>   </div>
                    <div class="col-md-10 colsm-10 marg_tb15">

                        <p style="color: #C7CBD6; text-align: center; font-size: 20px;"> <strong>Sorry ,</strong> No freelancer(s) found for  related <strong><?php
                                if (!empty($sub_text)) {
                                    echo $sub_text;
                                }
                                ?></strong> job.</p>      
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
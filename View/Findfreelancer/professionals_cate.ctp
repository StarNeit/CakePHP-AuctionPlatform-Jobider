<div class="container">
    <div class="title">
        <?php if (isset($Category) and !empty($Category)) { ?>
            <h2><span class=" text-left"><?php echo $Category['Category']['name'] . '     Developers & Programmers'; ?></span>
                <a href="<?php echo $this->webroot; ?>login">
                    <button type="submit" class="btn btn-sm  btn_red btn_red12 pull-right fnone">Post a job</button>
                </a>
            </h2>
        <?php } ?>
    </div>
    <div class="col-md-7 col-md-offset-3">
        <?php echo $this->Form->create('User', array('url' => array('controller' => 'findfreelancer', 'action' => 'professionals_cate/' . $cat_id))); ?>
        <div class="input-group">
            <input type="text" placeholder="Search for..." id="searchbox"name="data[User][search_content]" class="form-control">
            <span class="input-group-btn btn_img">
                <button type="button" class="btn btn-default searchbtn"><img alt="Search image icon" src="<?php echo $this->webroot; ?>img/search.png"></button>
            </span>
        </div><!-- /input-group -->
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="col-md-12 mbtm">
        <br>
        <?php
        if (isset($Freelancer_user) and !empty($Freelancer_user)) {
            foreach ($Freelancer_user as $key => $val) {
                ?>
                <div class="col-md-12 skill_sec">
                    <div class="col-sm-3 col-md-2 text-center immg_sec">
                        <?php if (!empty($val['User']['image'])) { ?>
                            <img class="img-thumbnail" alt="login user image" src="<?php echo $this->webroot; ?>uploads/<?php echo $val['User']['image']; ?>"/>
                        <?php } else { ?>
                            <img alt="dummy user image" class="img-thumbnail" src="<?php  echo $this->webroot; ?>img/freelancer.png"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-6 col-md-8 middle_dv">
                        <h5><?php echo ucfirst($val['User']['first_name']) . '  ' . ucfirst($val['User']['last_name']); ?></h5>
                        <h4><?php echo $val['User']['job_title']; ?></h4>
                        <div class="lesval" >
                            <p><?php echo substr($val['User']['description'],0,150).'......'; ?>  <a href="JavaScript:void(0);" class="more" style="font-size: 15px; text-decoration: none;">More</a></p>
                      
                        </div>
                        <div class="moreval hide">
                        <p> <?php  echo $val['User']['description'].'.   '; ?> <a href="JavaScript:void(0);" class="less" style="font-size: 15px; text-decoration: none;" >Less</a> </p>
                        </div>
                        <h3><img alt="location image icon" src="<?php echo $this->webroot; ?>img/location1.png"><b><?php echo $val['User']['country']['Country']['name']; ?></b>&nbsp; -&nbsp; Last days&nbsp;:&nbsp; <?php
                            if (!empty($val['User']['timeduration'])) {
                                echo $val['User']['timeduration'];
                            } else {
                                echo "0 day ago";
                            }
                            ?>&nbsp;-&nbsp;Tests:<span><?php echo $val['User']['tests'] ?></span></h3>
                        <ul>
                            <div class="less_skills">
                            <?php
                            if (!empty($val['User']['skills'])) {
                                $total=count($val['User']['skills']);
                                $i=0;
                                foreach ($val['User']['skills'] as $kk => $vv) {
                                    ?>
                                    <li><?php echo $vv['Subskill']['skill_name']; ?></li>
                                    <?php
                                if($i=='3'){break;}$i++;}
                            }
                           ?> 
                                    <?php  if($total>4){?>
                                 <li style="background-color: rgb(1, 193, 249);"><a class="more_skill" href="JavaScript:void(0);" style="color:#fff; text-decoration: none;">More</a></li>
                                    <?php }?>
                            </div>
                            
                                <div class="more_skills hide">
                            <?php
                            if (!empty($val['User']['skills'])) {
                                $total=count($val['User']['skills']);
                                $i=0;
                                foreach ($val['User']['skills'] as $kk => $vv) {
                                    ?>
                                    <li><?php echo $vv['Subskill']['skill_name']; ?></li>
                                    <?php
                                }
                            }
                           ?> 
                                    
                                    <li style="background-color: rgb(1, 193, 249);"><a class="less_skill" href="JavaScript:void(0);" style="color:#fff; text-decoration: none;">Less</a></li>
                                    
                            </div>
                            
                            <div class="clearfix"></div>
                            
                        </ul>


                        <div class="col-md-12 grp">
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-3 col-md-2 right_dv">

                        <p>
                            <?php if (!empty($val['User']['budget'])) { ?>
                                <b><?php echo '$' . $val['User']['budget'] . '.00/hr'; ?></b>
                            <?php } else { ?>
                                <b><?php echo '$0.00/hr'; ?></b>
                            <?php } ?>
                            <!--                            &nbsp;/&nbsp;hr-->
                            <br>
                            <?php
                            $score = 0;
                            $ik = 0;
                            if (!empty($val['User']['feedback'])) {
          $score += $val['User']['feedback']['Projectfeedback']['score'];
                  $ik++;
                            }
                            if ($ik != 0) {
                                $AvgScore = $score / $ik;
                            } else {
                                $AvgScore = 0;
                            }
                            ?>
                            <b><?php echo number_format($AvgScore, 0); ?></b>
                            <?php
                            $AvgScore = number_format($AvgScore, 0);
                            for ($j = 1; $j <= $AvgScore; $j++) {
                                ?>      
                                <img alt="Star icon image" src="<?php echo $this->webroot; ?>img/star.png">
                            <?php } ?>  
                        </p>
                        <br>


                        <div class="clearfix"></div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
            }
        } else {
            ?>
            <p class="Noresult">No Record(s) Found !</p>
            <div class="clearfix"></div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <div class="col-md-12 ">
        <nav>
            <ul class="pagination pull-right pagi">
                <li>
                    <?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?>
                </li>
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
        </nav>
    </div>
</div>

<style>
    .Noresult {
        color: #1e9bd4;
        font-size: 22px;
        padding: 60px;
        text-align: center;
    }
</style>

<script>
    $(document).ready(function() {
        $(document).on('click', '.searchbtn', function() {
            var search_value = $('#searchbox').val();
            if (search_value == '') {
                alert('Please enter Search keyword !');
                return false;
            } else {
                $('.searchbtn').attr('type', 'submit');
                return true;
            }

        });
    });

</script>
<script>
            $(document).ready(function() {
                $(document).on('click', '.more_skill', function() {
                   $(this).parent().parent().next().removeClass('hide');
                    $(this).parent().parent().addClass('hide');
                });

            });
            $(document).ready(function() {
                $(document).on('click', '.less_skill', function() {
                   $(this).parent().parent().prev().removeClass('hide');
                 //$('.less_skills').removeClass('hide');
                    $(this).parent().parent().addClass('hide');

                });
            });
        </script>
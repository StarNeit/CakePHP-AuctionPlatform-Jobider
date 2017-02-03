<div class="container">
    <h2><span class=" text-left">Browse freelancer by Skills</span>
        <a href="<?php echo $this->webroot; ?>login"> 
            <button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button>
        </a>
    </h2>
    <hr class="brder_btm"/>
    <div class="row">
        <div class="col-md-8 col-sm-8 marg_btm30">
            <div class="header_bg">
                <h4 class="marg_0">
                    <span class="pull-left">Skill Directory > # <span>A</span></span>
                    <div class="col-md-8 pull-right text-right skill_list"> <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/a" style="text-decoration: none;"># A</a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/b" style="text-decoration: none;"> B </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/c" style="text-decoration: none;">C </a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/d" style="text-decoration: none;">D </a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/e" style="text-decoration: none;">E </a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/f" style="text-decoration: none;">F </a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/g" style="text-decoration: none;">G </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/h" style="text-decoration: none;">H</a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/i" style="text-decoration: none;"> I </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/j" style="text-decoration: none;">J </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/k" style="text-decoration: none;">K </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/l" style="text-decoration: none;">L </a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/m" style="text-decoration: none;">M </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/n" style="text-decoration: none;">N </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/o"style="text-decoration: none;">O</a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/p" style="text-decoration: none;"> P</a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/q" style="text-decoration: none;"> Q </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/r" style="text-decoration: none;">R</a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/s" style="text-decoration: none;"> S</a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/t" style="text-decoration: none;"> T</a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/u" style="text-decoration: none;">U</a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/v" style="text-decoration: none;"> V </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/w" style="text-decoration: none;">W</a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/x" style="text-decoration: none;"> X </a>
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/y" style="text-decoration: none;">Y </a> 
                        <a href="<?php echo $this->webroot; ?>findfreelancer/professional_skills/z" style="text-decoration: none;">Z</a> </div>
                    <div class="clearfix"></div>
                </h4>
            </div>
            <?php if (!empty($find_professional) and isset($find_professional)) { ?>
                <div class="list_freelancer marg_tb15">
                    <?php foreach ($find_professional as $value) { ?>
                        <ul class="nav col-md-4 col-sm-4">
                            <li><a href="<?php echo $this->Html->Url(array('controller' => 'findfreelancer', 'action' => 'Skill_Freelancer', $value['Subskill']['id'])); ?>"><?php echo $value['Subskill']['skill_name']; ?></a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <span class="skill_name"> No Skill(s) Found </span>
            <?php } ?>
        </div>

        <div class="col-md-4 col-sm-4">
            <div class="green_bg panel panel-default"> 
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="marg_0">Top Skills</h3>
                </div>
                <div class="panel-body">
<!--                    <p class="marg_0">
                        <a href="#">
                            View all
                            l</a>
                    </p>-->
                </div>

                <!-- List group -->
                <ul class="list-group padd_tb15">
                    <?php foreach ($skills as $val) { ?>
                    <li class="list-group-item"> <a href="<?php echo $this->webroot; ?>findfreelancer/TopSkillFreelancers/<?php echo $val['Skill']['id']; ?>"><?php echo $val['Skill']['name']; ?></a></li>
                    <?php } ?>

                </ul>

            </div>
            <div class="green_bg panel panel-default"> 
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="marg_0">Freelancer By Category</h3>
                </div>
                <div class="panel-body">
<!--                    <p class="marg_0">
                        <a href="#">
                            View all
                        </a>
                        
                    </p>-->
                </div>

                <!-- List group -->
                <ul class="list-group padd_tb15">
                    <?php foreach ($category as $value) { ?>
                        <li class="list-group-item"> <a href="<?php echo $this->webroot; ?>findfreelancer/FreelancerByCategory/<?php echo $value['Category']['id'];?>" class="categ" style="text-decoration:none;"><?php echo $value['Category']['name']; ?></a></li>
                    <?php } ?>

                </ul>

            </div>
        </div>
    </div>
</div>
<style>

    .skill_name {
        color: red;
        font-size: 21px;
        padding: 55px 288px 50px;
        text-align: center !important;
    }</style>
<script>
    $(document).ready(function() {
        $(document).on('click', '.category', function() {
            $('.category').addClass('hide');
            $('.subcate').removeClass('hide');
        });
    });
</script>
<div class=" careeer client_resource">

    <div class="container">
        <div class="text_contact text_client text-center marg_btm30 col-md-8 col-md-offset-2">

            <h3> Grow Your Freelancer Career Here</h3>
            <h4 class="marg_btm30">
                If you’ve got the skills, we’ve got the jobs. With 1.5+ million clients, Jobider has opportunities for everyone&mdash;from app developers to virtual assistants. </h4>

            <div class="craeer_img client_manual">
                <img class="img-responsive" src="<?php echo $this->webroot; ?>uploads/<?php echo $manual['Page']['image']; ?>">
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="question_top">
        <?php echo $manual['Page']['description']; ?>
    </div>
    <div class="question">
        <div class="container">
            <h1 class="text-center"> FAQs </h1>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php
                $i = 0;
                foreach ($Result_manuals as $kk => $vv) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                                    <?php echo $vv['Clientmanual']['question']; ?>
                                </a>  
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                                    <i><img src="<?php echo $this->webroot; ?>img/plus.png" class="pull-right"></i></a>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <?php echo $vv['Clientmanual']['answer']; ?>
                            </div>
                        </div>
                    </div>
                    <?php $i++;
                } ?>
            </div>
        </div>
    </div>
</div>
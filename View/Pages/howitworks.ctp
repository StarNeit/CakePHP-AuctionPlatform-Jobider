<!--howitwork start -->
<div class="howitwork">
    <div class="container">
        <h1 class="text-center"> Get your job done - <i> on demand </i> </h1>
        <p class="text-center"> Done project on your timeline </p>
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo $this->webroot; ?>img/steps_image.png" class="img-responsive" alt="steps Image" />
            </div>
        </div>
        <div class="postbtn">
            <p class="text-center"> <a href="<?php echo $this->webroot; ?>client/postajob"><button> Post a job </button></a> </p>
        </div>

    </div> 
</div>
<!--howitwork closed -->

<div class="container">
    <div class="question_top">
    <p><?php echo $faqs['Page']['description']; ?></p>

    </div>
</div>

<div class="question">
    <div class="container">
        <h2 class="text-center"> Questions </h2>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php 
            $i=0;  
            foreach ($question as $val) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                <?php echo $val['Faqcontent']['question']; ?>
                            </a> 
                            <a aria-controls="collapse<?php echo $i; ?>" aria-expanded="true" href="#collapse<?php echo $i; ?>" data-parent="#accordion" data-toggle="collapse">
                                <i> <img src="<?php echo $this->webroot; ?>img/plus.png" class="pull-right" alt="plus image" />  </i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="height:0px">
                        <div class="panel-body">
                            <h3 class="panel_questions_title"><?php echo $val['Faqcontent']['question']; ?></h3>
                            <?php echo $val['Faqcontent']['answer']; ?>
                        </div>
                    </div>
                </div>
            <?php $i++; } ?>
        </div>  
    </div>
</div>



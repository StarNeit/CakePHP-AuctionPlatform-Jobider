<!--howitwork start -->
<div class="howitwork">
    <div class="container">
        <h1 class="text-center"> Get your job done - <i> on demand </i> </h1>
        <p class="text-center"> Done project on your timeline </p>
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo $this->webroot; ?>img/steps_image.png" class="img-responsive" />
            </div>
        </div>
        <div class="postbtn">
            <p class="text-center"> <a href="<?php echo $this->webroot; ?>login"><button> Post a job </button></a> </p>
        </div>

    </div> 
</div>
<!--howitwork closed -->

<!--question start --->
<div class="container">
<div class="question_top">
<p><?php echo $faqs['Page']['description']; ?></p>

</div><!--question_top-->

</div>
<div class="question">
  <div class="container">
   <h1 class="text-center"> FAQs </h1>
   
   <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
       <?php $i=0; 
       foreach($question as $key=>$val){ ?>
  <div class="panel panel-default">
    <div id="headingOne" role="tab" class="panel-heading">
      <h4 class="panel-title">
        <a aria-controls="collapse<?php echo $i; ?>" aria-expanded="true" href="#collapse<?php echo $i; ?>" data-parent="#accordion" data-toggle="collapse">
         <?php echo $val['Faqcontent']['question']; ?>
        </a> 
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                <i> <img class="pull-right" src="<?php  echo $this->webroot;?>img/plus.png">  </i>
                </a>
      </h4>
    </div>
    <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="collapse<?php echo $i; ?>">
      <div class="panel-body">
<?php echo $val['Faqcontent']['answer']; ?>
 
      </div>
    </div>
  </div>
       <?php $i++;} ?>
 
</div>
  </div>
 </div>

<!--
--------------Add plus imag------------------
howitwork start 
<div class="howitwork">
    <div class="container">
        <h1 class="text-center"> Get your job done - <i> on demand </i> </h1>
        <p class="text-center"> Done project on your timeline </p>
        <div class="row">
            <div class="col-md-12">
                <img src="<?php //echo $this->webroot; ?>img/steps_image.png" class="img-responsive" />
            </div>
        </div>
        <div class="postbtn">
            <p class="text-center"> <a href="<?php //echo $this->webroot; ?>login"><button> Post a job </button></a> </p>
        </div>

    </div> 
</div>
howitwork closed 

question start -

<div class="question">
    <div class="container">
        <h1 class="text-center"> Questions </h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php 
           // $i=0;
           // foreach ($faqs as $val) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php //echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php // $i; ?>">
                                <?php //echo $val['Faq']['question']; ?>
                            </a> 
                            <a aria-controls="collapse<?php //echo $i; ?>" aria-expanded="true" href="#collapse<?php //echo $i; ?>" data-parent="#accordion" data-toggle="collapse">
                                <i> <img src="<?php //echo $this->webroot; ?>img/plus.png" class="pull-right" />  </i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?php //echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="height:0px">
                        <div class="panel-body">
                            <?php //echo $val['Faq']['answer']; ?>
                        </div>
                    </div>
                </div>
            <?php //$i++; } ?>
        </div>
    </div>
</div>-->

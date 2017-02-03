 
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 banner_content">
                <h1 class="text-right"><?php  echo $home_content['Homecontent']['name']?></h1>
                <p class="text-right"><?php echo $home_content['Homecontent']['title']; ?></p>
                <a href="<?php echo $this->webroot; ?>howitworks"><button type="button" class="btn btn-primary pull-right btn_cust btn-lg marg_l20">How it works</button></a>
                <a href="<?php echo $this->webroot; ?>login"><button type="button" class="btn btn-primary btn_cust btn-lg pull-right">Post a Job</button></a>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="video">
                    <?php
if (strpos($home_content['Homecontent']['url'],'embed') !== false) {
   $url=$home_content['Homecontent']['url'];
}else{
    $img=explode('=', $home_content['Homecontent']['url']); 
 $url='https://www.youtube.com/embed/'.$img[1];
}
?>
                    
                    
                    <iframe width="100%" height="312" frameborder="0" allowfullscreen="" src="<?php echo $url; ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="bg_grey online col-md-12 col-sm-8 col-md-offset-2 col-sm-offset-2 marg_tb50" style="margin-left: 9px;">
        <div class="row">
            <div class="col-md-4 col-sm-5">
                <div class="online_image text-center"> <img alt="image" src="<?php echo $this->webroot; ?>uploads/<?php echo $Result['Banner']['image']; ?>" style="margin-left: 406px;"> </div>
            </div>
            <div class="col-md-12 col-sm-7 online_image_content">
                <h2 style="margin-left: 363px;"><?php echo $Result['Banner']['title']; ?> </h2>
               <div class=" content_page pad_20">
                    <p>
                        <?php echo $Result['Banner']['description']; ?>
                        
                    </p>
              
               </div>
            </div>
        </div>
    </div>
</div>

<style>
    .content_page{
        color: #9b9b9b;
    font-size: 18px;
    text-align: justify;
    }
    
</style>
<div class="careeer client_resource">
    <div class="container">
        <div class="text_contact text-center marg_btm30 col-md-8 col-md-offset-2">
            <h1 style="color:#fff;"><?php echo $Result['Clientrecource']['name']; ?> </h1>
            <h2 class="marg_btm30"  style="color:#fff;"><?php echo $Result['Clientrecource']['title']; ?></h2>            <div class="craeer_img">
                <img class="img-responsive" src="<?php echo $this->webroot; ?>img/resource.png" alt="ResourceImages">
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h3 class="text-center marg_btm30"><?php echo $Result['Clientrecource']['sub_title']; ?></h3>
    <?php
    if (strpos($Result['Clientrecource']['url'], 'embed') !== false) {
        $url = $Result['Clientrecource']['url'];
    } else {
        $img = explode('=', $Result['Clientrecource']['url']);
        $url = 'https://www.youtube.com/embed/' . $img[1];
    }
    ?>
    <div class="video_container">
        <iframe width="100%" height="450" src="<?php echo $url;  ?>" frameborder="0" allowfullscreen></iframe>
<!--        <div  id="ClientResourcesVideo" class="video_container" style="width:100%;height: 450;" ></div>
        <script>
            jwplayer("ClientResourcesVideo").setup({
                file: "<?php // echo $Result['Clientrecource']['url']; ?>",
                image: "<?php ?>"
            });
        </script>-->
    </div> 
    <div class="clientresources_content">
        <h2><?php echo $Result['Clientrecource']['meta_title']; ?></h2>
        <div class="question_top">
            <!--<h1> Step 1</h1>-->
            <p><?php echo $Result['Clientrecource']['description']; ?></p>
        </div>
    </div>
</div>
<style>
    .clientresources_content h2 {
        font-size: 36px;
        text-align: center;
    }
    #ClientResourcesVideo_logo{
        display: none !important;
    }   
</style>
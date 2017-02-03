<style>
	.tags {
    background: none repeat scroll 0 0 rgb(236, 236, 236);
    margin-left: 5px;
}
</style>
<div class="container">

  <h2><span class=" text-left">Top Jobider Freelancers</span> <span class="text_green marg_l20 font_18"> (Showing <?php echo $count_user; ?> freelancers)</span>
 <button class="btn btn-sm  btn_red btn_red12 pull-right" type="button">Post a job</button>
  </h2>
  <hr class="brder_btm"/>
  
  <div class="row">
  <div class="col-md-4 col-sm-4">
             
   
               
              
               <div class="green_bg panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"> <h3 class="marg_0">Narrow results by:</h3></div>

<form class="cust_form sider_bar_form">
          <div class="panel1">
    <h4 class="marg_0">Category</h4>
    
</div>
    <div class=" col-md-12">
        <select class="form-control  category">
           
        
           
           <option value="">Select The Category</option>
											<?php foreach($category as $ki=>$vs){ ?>
           <option value="<?php echo $vs['Category']['id']; ?>"><?php echo $vs['Category']['name']; ?></option>
											<?php } ?>
          
           
         </select>
         
       </div>
    
  
  <div class="sub_content subdata hide" >
  
       
       <div class="clearfix"></div>
       <div class="brder_tb">
    
       <h4 class="marg_0">Subcategory</h4>
       </div><div class=" col-md-12">
        <select class="form-control subcategory" >
           
        
           
           <option value="">All Subcategories</option>
           <option>option1</option>
           <option>option1</option>
           <option>option1</option>
           
         </select>
         
       </div>
   </div>
   
   <div class="sub_content">
  
       
       <div class="clearfix"></div>
       <div class="brder_tb">
    
       <h4 class="marg_0">Country</h4>
       </div><div class=" col-md-12">
        <select class="form-control country">
           
        
           
           <option value="">Select The Country</option>
											<?php  foreach($country_data as $ks=>$vc){?>
           <option value="<?php echo $vc['Country']['id'] ?>"><?php echo $vc['Country']['name']; ?></option>
											<?php  } ?>
          
           
         </select>
         
       </div>
   </div>
   
   <div class="sub_content">
  
       
       <div class="clearfix"></div>
       <div class="brder_tb">
    
       <h4 class="marg_0">Feedback Score</h4>
       </div>
       
       
       <div class=" col-md-12">
       
       <h4 class="text_green">Any Feedback Score (80,016) </h4>
           
           
            <div class="checkbox">
    <label>
      <input type="checkbox"> 4.5 & above (36,254)
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox">4.0 & above (41,459)
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox">3.0 & above (44,946)
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox"> 2.0 & above (46,231)
    </label>
  </div>
  
  <div class="checkbox">
    <label>
      <input type="checkbox">1.0 & above (47,301) 
    </label>
  </div>
         
       </div>
   </div>
     
    </form>
    <div class="clearfix"></div>
  <!-- List group -->
  

           </div>
           
           
          
        </div>
        
        <div class="col-md-8 col-sm-8 marg_btm30">
          
       <ul class="pagination pull-right">
    <li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
  </ul>
  <div class="clearfix"></div>
		<?php pr($user_data); ?>
  <?php foreach($user_data as $k=>$v){
	?>
  <div class="bg_white freelaners marg_btm30 search_datas">
      
      <div class="green">
      <?php  echo $v['User']['first_name'].' '.$v['User']['last_name'];?><span class="date pull-right"><i class="mrg_r5"><img alt="detail icon image" src="<?php echo $this->webroot; ?>img/deatil.png"></i><?php echo $v['User']['job_title']; ?> (Scala, Java, Hadoop)</span>
               </div>
               
        
               <div class="col-md-2 col-sm-2 marg_tb15">
                    
                    <img src="<?php echo $this->webroot; ?>uploads/<?php echo $v['User']['image']; ?>" alt="login user image" class="img-thumbnail">
                    
               </div>
               
               <div class="col-md-10 colsm-10 marg_tb15 lesval">
                
                <p><?php echo substr($v['User']['description'],0,200).'.....'; ?> 
                <a href="JavaScript:void(0);" class="more">more</a>
                </p>
                
               </div>
			
			   <div class="col-md-10 colsm-10 marg_tb15 moreval hide">
                
                <p><?php  echo $v['User']['description'].'........'?>
                <a href="JavaScript:void(0);" class="less">less</a>
                </p>
                
               </div>
       
               <div class="clearfix"></div>
               <hr class="brder_btm1 marg_tb15">
               
               <div class="tabs_1 col-md-12">
               <?php  foreach( $v['User']['skill_name'] as $kk=>$va){
																//pr($va);?>
                <span class="tags"><?php echo  $va['Subskill']['skill_name'];?></span>
															<?php } ?>
               
               </div>
                        <div class="clearfix"></div>
               <div class="bg_grey1 pull-left marg_t5">
                 
                 <div class="rating pull-left">
                 <span class="text_green pull-left">4.8 Star</span>
                  
                  <ul class=" list-inline pull-left ">
                  <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
                  <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
                  <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
                  <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
                  <li><img src="<?php echo $this->webroot; ?>img/star.png" alt="Star icon image"/></li>
            
                  </ul>
                
                 </div>  
                 
                 <div class="location pull-left">
                   <?php foreach($v['User']['country_name'] as $ke=>$vv){ ?>
                   <i><img src="<?php echo $this->webroot; ?>img/location.png" alt="location icon image"/></i><span class=" text_green"><?php echo $vv['Country']['name']; ?></span>
																			<?php } ?>
                   
                 </div>
                 
                 <div class="location pull-left">
                   
                   <i><img src="<?php echo $this->webroot; ?>img/check.png" alt="Check icon image"/></i><span class=" text_green">LAST ACTIVE <?php echo $date=date('M. d Y',strtotime($v['User']['created'])); ?></span>
                   
                 </div>
                 
                 <div class="location pull-left">
                   
                   <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="Project icon image"/></i><span class=" text_green">12 Completed projects</span>
                   
                 </div>
                 
                 <div class="location pull-left">
                   
                   <i><img src="<?php echo $this->webroot; ?>img/project_img.png" alt="project icon image"/></i><span class=" text_green">2 in process</span>
                   
                 </div>
               </div>
               
              
              <div class="clearfix"></div>
  
  </div>
		<?php } ?>
		
  
        
        </div>
        
        
    
  </div>
</div>

<script>
$(document).ready(function(){
	$(document).on('change','.category',function(){
		var category_id=$('.category').val();
$.ajax({
	type:'post',
	dataType:'json',
	url:'<?php echo $this->webroot;?>home/ajax_data',
	data:{category_id:category_id},
	success:function(msg){
		if(msg.suc=='yes'){
			$('.subdata').removeClass('hide');
			$('.subcategory').html(msg.subcategory);
		}
	}
});
	});
});
</script>

<script>
	$(document).ready(function(){
		$(document).on('change','.category',function(){
			var category_id=$('.category').val();
			var subcategory_id=$('.subcategory').val();
			var country_id=$('.country').val();
			$.ajax({
				type:'post',
				dataType:'json',
				url:'<?php  echo $this->webroot;?>home/search_data',
				data:{category_id:category_id,subcategory_id:subcategory_id,country_id:country_id},
				success:function(mesg){
					if(mesg.suc=='yes'){
						$('.search_datas').html(mesg.dataDiv);
					$('.pagi').html(mesg.dataPagi);
				}else{
						$('.search_datas').html(mesg.dataDivs);
					$('.pagi').html(mesg.dataPagi);
				}
				}
			});
		})

		$(document).on('change','.subcategory',function(){
			var category_id=$('.category').val();
			var subcategory_id=$('.subcategory').val();
			var country_id=$('.country').val();
			$.ajax({
				type:'post',
				dataType:'json',
				url:'<?php  echo $this->webroot;?>home/search_data',
				data:{category_id:category_id,subcategory_id:subcategory_id,country_id:country_id},
				success:function(mesg){
					if(mesg.suc=='yes'){
						$('.search_datas').html(mesg.dataDiv);
					$('.pagi').html(mesg.dataPagi);
				}else{
						$('.search_datas').html(mesg.dataDivs);
					$('.pagi').html(mesg.dataPagi);
				}
				}
			});
		})
$(document).on('change','.country',function(){
			var category_id=$('.category').val();
			var subcategory_id=$('.subcategory').val();
			var country_id=$('.country').val();
			$.ajax({
				type:'post',
				dataType:'json',
				url:'<?php  echo $this->webroot;?>home/search_data',
				data:{category_id:category_id,subcategory_id:subcategory_id,country_id:country_id},
				success:function(mesg){
					if(mesg.suc=='yes'){
						alert(mesg.dataDiv);
						$('.search_datas').html(mesg.dataDiv);
					$('.pagi').html(mesg.dataPagi);
				}else{
						$('.search_datas').html(mesg.dataDivs);
					$('.pagi').html(mesg.dataPagi);
				}
				}
			});
		});
	});
</script>
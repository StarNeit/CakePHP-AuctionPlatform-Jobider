<!--plans start-->
<div class="container">
    <?php if(!empty($test) && !empty($result) && !empty($user)){ ?>
  <div class="col-md-12 space">
 <div class="marks_full">
 <div class="col-md-2">
 <div class="marks1">
 <p>Test </p>
 </div>
 </div>
 <div class="col-md-10">
     <?php if(!empty($test) && !empty($user) && !empty($result)){?>
 <div class="marks_right">
<h3><?php echo $test['Test']['title']; ?> <a href="<?php  echo $this->webroot;?>freelancer/TakeTestOnClick/<?php echo $test['Test']['slug'] ?>">view test details</a></h3>
Taken by <a href="<?php  echo $this->webroot;?>freelancer/myprofile"><?php echo $user['User']['username']; ?> </a>on <?php echo $date=date('M dS, Y',strtotime($result['Finalresult']['last_date'])); ?>
</div>
     <?php } else { ?>
     <div class="marks_right">
<h3>MS Word 2003 Test <a href="#">view test details</a></h3>
Taken by <a href="#">Sapna Kalra </a>on Mar 19th, 2015
</div>
     <?php } ?>
</div>
</div>
      <?php if(!empty($result)){ 
//          pr($result);
//                    die('dgs');
          ?>
 <div class="marks_full">
<div class="col-md-2">
 <div class="marks1">
 <p>Score (out of <?php echo $result['Finalresult']['rating']; ?>)</p>
 </div>
 </div>
  <div class="col-md-10">
   <div class="marks_right">
       <?php  if($result['Finalresult']['percentile']=='Passed'){?>
<p><?php  echo number_format($result['Finalresult']['score'],1)?> <h4 style="color: green;"><?php echo $result['Finalresult']['percentile']; ?></h4></p>
       <?php } ?>
   <?php  if($result['Finalresult']['percentile']=='Failed'){?>
<p><?php  echo number_format($result['Finalresult']['score'],1)?> <h4><?php echo $result['Finalresult']['percentile']; ?></h4></p>
       <?php } ?>
</div>
</div>
</div>
<div class="marks_full">
<div class="col-md-2">
<div class="marks1">
 <p>Time to complete</p>
 </div>
 </div>
  <div class="col-md-10">
 <div class="marks_right">
     <?php if(($result['Finalresult']['total_time']<10) and ($sum<10) ){?>
<p><?php if($result['Finalresult']['total_time'] >=1){ echo '0'.$result['Finalresult']['total_time'] ;?> minutes <?php }else{ echo '0'.$result['Finalresult']['total_time'] ; ?> seconds <?php } ?> (<?php if($sum>="01:00"){ echo '0'.$sum; ?> minutes <?php }else{ echo '0'.$sum; ?>seconds <?php } ?> allowed)</p>
<?php } else { ?>
<p><?php if($result['Finalresult']['total_time'] >=1){ echo $result['Finalresult']['total_time'] ;?> minutes <?php }else{ echo $result['Finalresult']['total_time'] ; ?> seconds <?php } ?> (<?php if($sum>="01:00"){ echo $sum; ?> minutes <?php }else{ echo $sum; ?>seconds <?php } ?> allowed)</p>
<?php } ?>
 </div>
 </div>
 </div>
      <?php }  else { ?>
      <div class="marks_full">
<div class="col-md-2"> 
 <div class="marks1">
 <p>Score (out of 5)</p>
 </div>
 </div>
 
 <div class="col-md-10">
 
 <div class="marks_right">
<p>1,60 </p><h4>failed</h4><p></p>
</div>
</div>
</div>
      <div class="marks_full">
<div class="col-md-2">
<div class="marks1">
 
 
<p>Time to complete</p>
 </div>
 </div>
 
 <div class="col-md-10">
 <div class="marks_right">
 
 
<p>8 minutes (40 minutes allowed)</p>
 </div>
 </div>
 </div>
      <?php } ?>
 <div class="col-md-2">
 <div class="marks1">
<p>Result by topic</p>
 </div>
 </div>
  <div class="col-md-10">
<div class="result_right">
    <?php if(!empty($testdata)){ ?>
 <div class="table-responsive">
<table class="table cust_table11 table-striped">
 <thead>
 <tr><th>Topic</th><th class="result_right1">Correct Answers</th></tr>
 </thead>
 <tbody>
     <?php foreach($testdata as $val){ ?>
<tr>
    <td><?php echo $val['Testcontent']['test_content']; ?></td>
    <td class="result_right1"><?php  echo $val['total'].'%';?></td>
</tr>
     <?php } ?>
</tbody>
</table>
 </div>
    <?php } else { ?>
    <?php }?>
 </div>
 </div>
 </div>
    <?php }  else { ?>
    <div class="col-md-12 space"><p style="color: rgb(199, 196, 200); text-align: center; font-size: 20px; padding: 100px;"><strong>Sorry</strong> , No result found for this <strong><?php echo $test_id; ?></strong> test id </p></div>
    <?php } ?>
 </div>
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
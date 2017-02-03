<div class="container">
    <div class="row marg_tb15">
        <div class="col-md-12 col-sm-9">
              <h3 class="marg_0 text_1">Skill Test 
            </h3>
            <p class="marg_tb15 font_18 text_1">
               Demonstrate your abilities to prospective clients by completing skills tests in your areas of expertise.
            </p>
            <a href="<?php echo $this->webroot; ?>freelancer/takeatest">
                <button class="btn btn-sm  btn_red btn_red12 pull-right" type="submit">                        View More Test
                </button>
                </a>
            <div class="clearfix"></div>
          
            <div class="table-responsive mt10">
                <table class="table cust_table11 table-striped opensans teststable">
                    <thead>
                        <tr class="font_18">           
                            <th>Test</th>
                            <th>Score</th>
                            <th>Percentile</th>
                            <th>Display on Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($result) and isset($result)){ foreach($result as $val){ ?>
                        <tr>
                            <td>
                                <?php foreach($val['test'] as $va){ ?>
            <a class="font_14" href="<?php echo $this->webroot; ?>freelancer/finalresult/<?php echo $va['Test']['id']; ?>"><?php echo $va['Test']['title']; ?></a>
                                <?php } ?>
                                <p class="font_12 grayclr">Taken on <?php echo $date=date('d/m/Y',strtotime($val['Finalresult']['last_date'])); ?></p></td>
                            <td class="font_14">
                            <?php echo $val['score']; ?>/<?php echo $val['Finalresult']['rating']; ?></td>
                            <?php if($val['Finalresult']['percentile']=='Failed'){ ?>
                            <td class="font_14" style="color: #dd5428;"><?php  echo $val['Finalresult']['percentile'];?></td>
                            <?php } ?>
                            <?php if($val['Finalresult']['percentile']=='Passed'){ ?>
                            <td class="font_14" style="color: green;"><?php  echo $val['Finalresult']['percentile'];?></td>
                            <?php } ?>
                            <td>
                                <div class="toggle-btn-grp joint-toggle">
                                
                                    <?php 
                                   // if($val['Finalresult']['status']=='1'){ 
                                        if($val['Finalresult']['status']=='1'){
                                        $status='success';       
                                        }else{
                                            $status='';
                                        }
                                        if($val['Finalresult']['status']=='0'){
                                        $Instatus='success';       
                                        }else{
                                            $Instatus='';
                                        }
                                                                          
                                        ?>
                                      <input type="hidden" value="<?php echo $val['Finalresult']['status']; ?>" />
                                      <input type="hidden" value="<?php echo $val['Finalresult']['id']; ?>" />
                                    <label class="toggle-btn <?php echo $status; ?>" onclick="">  <input type="radio" name="group3" class="visuallyhidden btnders">Yes</label>
                                    
                                     <input type="hidden" value="<?php echo $val['Finalresult']['status']; ?>" />
                                       <input type="hidden" value="<?php echo $val['Finalresult']['id']; ?>" />
                                    <label class="toggle-btn <?php echo $Instatus; ?>" onclick=""> <input type="radio" name="group3" class="visuallyhidden btnders">NO</label>
                                 
                                </div>
                            </td>
                        </tr>
                        <?php } }else{?>
                        <tr><td colspan="4" style="text-align: center; padding: 52px; font-size: 20px;""> <strong><?php echo ucfirst($_SESSION['Auth']['User']['first_name']).',';?>You have  taken  no Test(s).</strong></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(".toggle-btn:not('.noscript') input[type=radio]").addClass("visuallyhidden");
    $(".toggle-btn:not('.noscript') input[type=radio]").change(function() {
        if ($(this).attr("name")) {
            $(this).parent().addClass("success").siblings().removeClass("success")
        } else {
            $(this).parent().toggleClass("success");
        }
    });
    $(document).ready(function(){
        $(document).on('click','.btnders',function(){
          var id=$(this).parent().prev().val();
          var status=$(this).prev().prev().val();
           $.ajax({
                type: 'POST',
                url: '<?php echo $this->webroot.'freelancer/ajax_changeStatus' ?>',
                dataType: 'json',
                data: {
                    id:id,
                },
                success: function(msg) {
                    if (msg.status == 'true') {
//                        setInterval(function(){
//                            location.reload();
//                        },2000);
                     }
                }
            });
        });
    });
</script>


<?php
//pr('kjdhfjds');
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'Reports')) {
    $report = 'active';
} else {
    $report = '';
}
if ($this->params['controller'] == 'client' && ($this->params['action'] == 'transactionHistory')) {
    $TransHistory = 'active';
} else {
    $TransHistory = '';
}

?>
<div class="container">
  <div class="row marg_tb15">
      <?php echo $this->element('reports_sidebar'); ?>
    <div class="col-md-9 col-sm-9  pad_r0 ">
      <div class="bg_white">
        <div class="green"> Weekly Summary<span class="pull-right"> TOTAL PAYMENTS : $150</span> </div>
        <div class="table-responsive">
          <table class="table cust_table11 table-striped">
            <thead>
              <tr>
                <th>Freelancer </th>
                <th> Date</th>
                <th> Description </th>
                <th> Charge </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
                <td> 10-4-2013</td>
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="clearfix"></div>
      </div>
      
      
            
            <ul class="pagination pull-right">
    <li><a href="#"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
  </ul>
 
    </div>
  </div>
</div>
<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('reports_sidebar'); ?>
        <div class="col-md-9 col-sm-9  pad_r0 ">
  <div class="bg_white">
        <div class="green">Work Summary  </div>
        <form role="form" class="transaction_form">
          <div class="date_box marg_tb15">
            <div class="col-md-2"> From </div>
            <div class="input-group datepicker col-md-4 pull-left">
              <input type="text" id="datepicker1" class="col-md-11">
            </div>
            <div class="col-md-1 text-center"> To </div>
            <div class="input-group datepicker col-md-4">
              <input type="text" id="datepicker2" class="col-md-11">
            </div>
          </div>
          
          <div class="clearfix"></div>
        </form>
        
        <div class="table-responsive">
          <table class="table cust_table11 table-striped marg_0">
            <thead>
              <tr>
              <th style="background: none repeat scroll 0% 0% rgb(209, 207, 208);">Freelancer </th>
              <th> Description </th>
                <th> Total </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
           
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
           
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
           
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
           
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              <tr>
                <td> <font class="text-danger">Michel Smith </font></td>
           
                <td>Lorem ipsum Lorem ipsum </td>
                <td> $10 </td>
              </tr>
              
           
            </tbody>
          </table>

        </div>
       
        <div class="clearfix"></div>
      </div>
    </div>
</div>
</div>
    <?php echo $this->Html->script('jquery-ui'); ?>
    <script>
$(function() {
$( "#datepicker1" ).datepicker({
showOn: "button",
buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
buttonImageOnly: true,
buttonText: "Select date"
});
$( "#datepicker2" ).datepicker({
showOn: "button",
buttonImage: "<?php echo $this->webroot; ?>img/date11.png",
buttonImageOnly: true,
buttonText: "Select date"
});
});
</script> 
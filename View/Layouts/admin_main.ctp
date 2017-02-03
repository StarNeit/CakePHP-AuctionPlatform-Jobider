<?php echo $this->element('admin_header');?>
<?php echo $this->element('backend_sidebar');?>
<?php  echo $this->fetch('content'); ?>
</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->		
<script src="<?php  echo $this->webroot;?>js/jquery.js"></script>
<script src="<?php  echo $this->webroot;?>bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php  echo $this->webroot;?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php  echo $this->webroot;?>js/jquery.scrollTo.min.js"></script>
<script src="<?php  echo $this->webroot;?>js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="<?php  echo $this->webroot;?>js/jquery.nicescroll.js"></script>
<!--Easy Pie Chart-->
<script src="<?php  echo $this->webroot;?>js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="<?php  echo $this->webroot;?>js/sparkline/jquery.sparkline.js"></script>

<script type="text/javascript" src="<?php echo $this->webroot; ?>js/ckeditor/ckeditor.js"></script>
<!--common script init for all pages-->
<script type="text/javascript" language="javascript" src="<?php echo $this->webroot; ?>js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/data-tables/DT_bootstrap.js"></script>

<!--<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.validate.min.js"></script>-->
<script src="<?php  echo $this->webroot;?>js/scripts.js"></script>
<script src="<?php  echo $this->webroot;?>js/dynamic_table_init.js"></script>
<script src="<?php  echo $this->webroot; ?>js/jquery.tagsinput.js"></script>
<!--<script src="<?php //echo $this->webroot; ?>js/validation-init.js"></script>-->
</body>
</html>
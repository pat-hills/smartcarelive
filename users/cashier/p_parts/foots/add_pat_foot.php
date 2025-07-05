 <script src="../../assets/js/jquery.js"></script>
  <script src="../../assets/js/jquery.select2/select2.min.js" type="text/javascript"></script>
  <script src="../../assets/js/jquery.parsley/dist/parsley.js" type="text/javascript"></script>
  <script src="../../assets/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/fuelux/loader.min.js"></script>	
  <script src="../../assets/js/modernizr.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="../../assets/js/bootstrap.switch/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="../../assets/js/jquery.nestable/jquery.nestable.js"></script>
	<script type="text/javascript" src="../../assets/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="../../assets/js/behaviour/general.js"></script>
  <script src="../../assets/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
  <script type="text/javascript">
    $("#credit_slider").slider().on("slide",function(e){
      $("#credits").html("$" + e.value);
    });
    $("#rate_slider").slider().on("slide",function(e){
      $("#rate").html(e.value + "%");
    });
  </script>
  
  <script type="text/javascript">
    $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.wizard();
    });


    $(function() {
      
      $("#getReportPendingInvestigationList").dataTable();
   
  });

  </script>

  

<?php
        include "p_parts/foots/datatables.php";
    ?>
    <script src="../../assets/js/behaviour/voice-commands.js"></script>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
</body>

</html>

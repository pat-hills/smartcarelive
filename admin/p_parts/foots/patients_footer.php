
<script src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/jquery.datatables/dataTables.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
<script type="text/javascript" src="../assets/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
<script type="text/javascript" src="../assets/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="../assets/js/behaviour/general.js"></script>
<script type="text/javascript" src="../assets/js/jquery.ui/jquery-ui.js" ></script>
<script type="text/javascript" src="../assets/js/bootstrap.switch/bootstrap-switch.js"></script>
<script type="text/javascript" src="../assets/js/boostrap.fileinput/fileinput.min.js"></script>	
	
	
	
<script type="text/javascript" language="javascript" class="init">


$(document).ready(function() {
	
	$('#patients_list').dataTable( {
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "tasks/patients.php",
			"type": "POST"
		},
		"columns": [
			{ "data": "patient_id" },
			{ "data": "surname" },
			{ "data": "other_names" },
			{ "data": "occupation" },
			{ "data": "phone" },
			{ "data": "address" }
		]
	} );
	
	$('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
  	$('.dataTables_length select').addClass('form-control');    

        //Horizontal Icons dataTable
	$('#datatable-icons').dataTable();
	
	App.init();
} );

</script>


<!-- DATA TABES SCRIPT -->
<!--    <script src="../datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../datatables/dataTables.bootstrap.min.js" type="text/javascript"></script> 
      
        <script type="text/javascript">
      $(function () {
        $("#patient_list").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>-->
    
    <!--end of datatables-->
 <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../assets/js/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../assets/js/jquery.gritter/js/jquery.gritter.js"></script>
</body>
</html>
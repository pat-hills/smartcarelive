  <script src="../../assets/js/jquery.js"></script>
  <script src="../../assets/js/jquery.select2/select2.min.js" type="text/javascript"></script>
  <script src="../../assets/js/jquery.parsley/dist/parsley.js" type="text/javascript"></script>
  <script src="../../assets/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
  <script type="text/javascript" src="../../assets/js/jquery.nestable/jquery.nestable.js"></script>
  <script type="text/javascript" src="../../assets/js/behaviour/general.js"></script>
  <script src="../../assets/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.switch/bootstrap-switch.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="../../assets/js/jquery.icheck/icheck.min.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../../assets/js/jquery.datatables/jquery.datatables.min.js"></script>
 <script type="text/javascript" src="../../assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
<script type="text/javascript" src="../../assets/js/custom.js"></script>
  <script type="text/javascript">
  alert();
   //Add dataTable Icons
      var functions = $('<a class="btn btn-default btn-xs" href="#" data-original-title="Open" data-toggle="tooltip"><i class="fa fa-file"></i></a> <a class="btn btn-primary btn-xs" href="#" data-original-title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger btn-xs" href="#" data-original-title="Remove" data-toggle="tooltip"><i class="fa fa-times"></i></a>');
      $("#datatable-icons tbody tr td:last-child").each(function(){
        $(this).html("");
        functions.clone().appendTo(this);
      });
      
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dataTables();
        
       /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
            sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
            sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
            sOut += '</table>';
             
            return sOut;
        }
       
        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<img class="toggle-details" src="images/plus.png" />';
        nCloneTd.className = "center";
         
        $('#datatable2 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#datatable2 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#datatable2').dataTable( {
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
        });
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#datatable2').delegate('tbody td img','click', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                this.src = "images/plus.png";
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                this.src = "images/minus.png";
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        } );
        
      $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
      $('.dataTables_length select').addClass('form-control');    

        //Horizontal Icons dataTable
        $('#datatable-icons').dataTable();
	
});//end of jquery
    </script>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/behaviour/voice-commands.js"></script>
  <script src="../../assets/js/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../../assets/js/jquery.gritter/js/jquery.gritter.js"></script>
</body>

<!-- Mirrored from foxypixel.net/cleanzone/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Jul 2014 16:21:16 GMT -->
</html>
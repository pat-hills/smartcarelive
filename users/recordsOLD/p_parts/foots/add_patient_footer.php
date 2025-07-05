 <script src="../../assets/js/jquery.js"></script>
  <script src="../../assets/js/jquery.select2/select2.min.js" type="text/javascript"></script>
  <script src="../../assets/js/jquery.parsley/dist/parsley.js" type="text/javascript"></script>
  <script src="../../assets/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
    <script src="../../assets/js/jquery.maskedinput/jquery.maskedinput.js" type="text/javascript"></script>
  <script src="../../assets/js/modernizr.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.switch/bootstrap-switch.min.js"></script>
  <script type="text/javascript" src="../../assets/js/jquery.nestable/jquery.nestable.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="../../assets/js/behaviour/general.js"></script>
  <script src="../../assets/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/fuelux/loader.min.js"></script> 
  
  <script type="text/javascript">
    $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.wizard();
	  App.masks();
      
    });
  </script>
  <script src="../../assets/js/behaviour/voice-commands.js"></script>
  <script src="../../assets/js/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->




  <script type="text/javascript">

$(function() {

  if ($('#insuranceinfo').is(":checked"))
{
  alert("is checked");
}

//  $('#insuranceinfo').change(function(){
//    var e = $('#insuranceinfo').val();
//    if(e.value == "YES"){
//        $('.insurancetypeinfo').show(); 
//    } 
//    }else if(e.value == ""){
//     $('.insurancetypeinfo').hide(); 
//    }
   
 
//   // $('#' + $(this).val()).show();
//  });


});

$(function() {
 $('#patientsscheme').change(function(){
   var e = document.getElementById("patientsscheme"); 
   if(e.value == "Private"){
       $('.privatescheme').show();
       $('.schememembershipid').show();
       $('.schemembershipnumber').show();
       $('.publicscheme').hide();
   }else if(e.value == "nhis"){
    $('.publicscheme').show();
       $('.privatescheme').hide();
       $('.schememembershipid').show();
       $('.schemembershipnumber').show();
   }else if(e.value == ""){
    $('.privatescheme').hide();
       $('.schememembershipid').hide();
       $('.schemembershipnumber').hide();
       $('.publicscheme').hide();
   }else{
    $('.privatescheme').hide();
       $('.schememembershipid').hide();
       $('.schemembershipnumber').hide();
       $('.publicscheme').hide();

   }
   
  
 });
});




           </script>



</body>

</html>

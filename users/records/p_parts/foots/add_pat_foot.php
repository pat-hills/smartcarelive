<script src="../../assets/js/jquery.js"></script>
 
 <script src="../../assets/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
 <script src="../../assets/js/typeahead/js/typeahead.jquery.min.js" type="text/javascript"></script>

 <script   src="../../users/consulting/p_parts/foots/Chart.min.js"></script>

 <script type="text/javascript" src="../../assets/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
 <script type="text/javascript" src="../../assets/js/jquery.nestable/jquery.nestable.js"></script>
 <script type="text/javascript" src="../../assets/js/behaviour/general.js"></script>
 <script src="../../assets/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
 <script type="text/javascript" src="../../assets/js/bootstrap.switch/bootstrap-switch.js"></script>
 <script src="../../assets/js/jquery.select2/select2.min.js" type="text/javascript"></script>
 <script src="../../assets/js/s/jquery.icheck/icheck.min.js" type="text/javascript"></script>
 <script src="../../assets/js/jquery.parsley/dist/parsley.js" type="text/javascript"></script>
 <script src="../../assets/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script> 
 <script src="../../assets/js/modernizr.js" type="text/javascript"></script> 
 <script type="text/javascript" src="../../assets/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
 <script type="text/javascript" src="../../assets/js/behaviour/general.js"></script>
<!--  
 <script type="text/javascript" src="../../assets/js/jquery.datatables/jquery.datatables.min.js"></script>

<script type="text/javascript" src="../../assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script> -->
 <script type="text/javascript" src="../../assets/js/jquery.niftymodals/js/jquery.modalEffects.js"></script>   
 
 <script type="text/javascript" src="../../assets/summernote/js/summernote-bs4.js"></script>   

  <script type="text/javascript">


$(document).ready(function(){
          //initialize the javascript
          App.init();
         
          //alert('yes');

          $('#prefetch').typeahead({

            name: 'patients',

            prefetch: 'countries.json',

            limit: 10

          });

          
        });//end of jquery


 

$('#select_patient').keyup(function(e) {

    var formData = {
        'patient_name' : $('input[name=get_details]').val()
    };

    if(formData['patient_name'].length >= 1){

      // process the form
      $.ajax({
          type        : 'POST',
          url         : 'ajax.php',
          data        : formData,
          dataType    : 'json',
          encode      : true
      })
          .done(function(data) {
              console.log(data);
              $('#result').html(data).fadeIn();
              $('#result li').click(function() {

                $('#select_patient').val($(this).text());
                $('#result').fadeOut(500);

              });

              $("#select_patient").blur(function(){
                $("#result").fadeOut(500);
              });

          });

    } else {

      $("#result").hide();

    };

    e.preventDefault();
});




$('#select_patient_reassign').keyup(function(e) {

var formData = {
    'patient_name' : $('input[name=get_details_reassign]').val()
};

if(formData['patient_name'].length >= 1){

  // process the form
  $.ajax({
      type        : 'POST',
      url         : 'ajaxreassign.php',
      data        : formData,
      dataType    : 'json',
      encode      : true
  })
      .done(function(data) {
          console.log(data);
          $('#result').html(data).fadeIn();
          $('#result li').click(function() {

            $('#select_patient_reassign').val($(this).text());
            $('#result').fadeOut(500);

          });

          $("#select_patient_reassign").blur(function(){
            $("#result").fadeOut(500);
          });

      });

} else {

  $("#result").hide();

};

e.preventDefault();
});



 

  
  </script>

<script>
        $(document).ready(function () {
            showGraphTemperature();
        });


        function showGraphTemperature()
        {
            {
                $.post("../../users/opd/db_tasks/admission_vitals_temp.php",
                function (data)
                {
                    console.log(data);
                     var date_time_taken = [];
                    var temp = [];

                    for (var i in data) {
                      date_time_taken.push(data[i].date_time_taken);
                        temp.push(data[i].temperature);
                    }

                    var chartdata = {
                        labels: date_time_taken,
                        datasets: [
                            {
                                label: 'Patient Temperature (°C )',
                               // backgroundColor: '#fff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: temp
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvasTemperature");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
        </script>





<script>
        $(document).ready(function () {
            showGraphWeight();
        });


        function showGraphWeight()
        {
            {
              $.post("../../users/opd/db_tasks/admission_vitals_temp.php",
                function (data)
                {
                    console.log(data);
                     var date_time_taken = [];
                    var weight = [];

                    for (var i in data) {
                      date_time_taken.push(data[i].date_time_taken);
                        weight.push(data[i].weight);
                    }

                    var chartdata = {
                        labels: date_time_taken,
                        datasets: [
                            {
                                label: 'Patient Weight ( Kg )',
                               // backgroundColor: '#fff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: weight
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvasWeight");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
        </script>
 
 



 <script>
        $(document).ready(function () {
            showGraphPulse();
        });


        function showGraphPulse()
        {
            {
              $.post("../../users/opd/db_tasks/admission_vitals_temp.php",
                function (data)
                {
                    console.log(data);
                     var date_time_taken = [];
                    var pulse = [];

                    for (var i in data) {
                      date_time_taken.push(data[i].date_time_taken);
                        pulse.push(data[i].pulse);
                    }

                    var chartdata = {
                        labels: date_time_taken,
                        datasets: [
                            {
                                label: 'Patient Pulse ( % )',
                               // backgroundColor: '#fff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: pulse
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvasPulse");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
        </script>



 
 
 
  
   


<script type="text/javascript">
    
    $(function() {
      
        $("#get_all_patients_opd").dataTable();
     
    });




    $(function() {
  $('#vitals').change(function(){
    var e = document.getElementById("vitals"); 
    if(e.value == "ALL"){
        $('.Temperature').show();
        $('.Weight').show();
        $('.Pulse').show();
    }else if(e.value == "WEIGHT"){
        $('.Weight').show();
        $('.Temperature').hide();
        $('.Pulse').hide();
    }else if(e.value == "TEMPERATURE"){
        $('.Temperature').show();
        $('.Weight').hide();
        $('.Pulse').hide();
    }else{
        $('.Temperature').hide();
        $('.Weight').hide();
        $('.Pulse').show(); 
    }
    
  });
});

    

    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150,
            width:655

        });
    });

    $(function() {
    function toggleSchemeDiv() {
        var e = document.getElementById("patientsscheme");
        if(e.value === "Yes" || e.value === "Add"){
            $('.schemeDiv').show(); 
        } else {
            $('.schemeDiv').hide(); 
        }
    }

    // Run the function on page load to set the initial visibility
    toggleSchemeDiv();

    // Run the function whenever the select value changes
    $('#patientsscheme').change(toggleSchemeDiv);
});
    
</script>

<?php
        include "p_parts/foots/datatables.php";
    ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/behaviour/voice-commands.js"></script>
    <script src="../../assets/js/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.gritter/js/jquery.gritter.js"></script>
    <script src="../../assets/js/behaviour/voice-commands.js"></script>


    
 
</body>

</html>

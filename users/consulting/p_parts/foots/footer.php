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
  
  <script type="text/javascript" src="../../assets/js/jquery.datatables/jquery.datatables.min.js"></script>

<script type="text/javascript" src="../../assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
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

          $('#AddPrescription').click(function(){
           var time_interval = $('#time_interval').val();
          // alert(time_interval);

          if(time_interval == "STAT"){

            $('#duration').prop('required',false);
            $('#time_span').prop('required',false);

          }

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
    
    </script>

<script type="text/javascript">
    $(function() {
      
        $("#audit_trail_tbl").dataTable();
     
    });
    

    $(function() {
  $(".customers").dataTable({
    "order": [[0, "asc"]],
     
  });
});


  $(function() {
      
      $("#drug_table_records").dataTable();
   
  });

  $(function() {
      
      $("#get_all_patients_opd").dataTable();
   
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

    <script>
        $(document).ready(function () {
            showGraphTemperature();
        });


        function showGraphTemperature()
        {
            {
                $.post("../../users/consulting/db_tasks/vitals_temp.php",
                function (data)
                {
                    console.log(data);
                     var date_taken = [];
                    var temp = [];

                    for (var i in data) {
                        date_taken.push(data[i].date_taken);
                        temp.push(data[i].temperature);
                    }

                    var chartdata = {
                        labels: date_taken,
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
                $.post("../../users/consulting/db_tasks/vitals_temp.php",
                function (data)
                {
                    console.log(data);
                     var date_taken = [];
                    var weight = [];

                    for (var i in data) {
                        date_taken.push(data[i].date_taken);
                        weight.push(data[i].weight);
                    }

                    var chartdata = {
                        labels: date_taken,
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
                $.post("../../users/consulting/db_tasks/vitals_temp.php",
                function (data)
                {
                    console.log(data);
                     var date_taken = [];
                    var pulse = [];

                    for (var i in data) {
                        date_taken.push(data[i].date_taken);
                        pulse.push(data[i].pulse);
                    }

                    var chartdata = {
                        labels: date_taken,
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



<script>
        $(document).ready(function () {
            showGraphLast30DaysConsultation();
        });


        function showGraphLast30DaysConsultation()
        {
            {
                $.post("../../users/consulting/db_tasks/consultation_charts.php",
                function (data)
                {
                    console.log(data);
                     var date_sent = [];
                    var totalPatients = [];

                    for (var i in data) {
                        date_sent.push(data[i].date_sent);
                        totalPatients.push(data[i].totalPatients);
                    }

                    var chartdata = {
                        labels: date_sent,
                        datasets: [
                            {
                                label: 'Date(s) against no. patients seen',
                               // backgroundColor: '#fff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: totalPatients,
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvasConsultations");

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
            showGraphTemperatureAdmission();
        });


        function showGraphTemperatureAdmission()
        {
            {
                $.post("../../users/consulting/db_tasks/admission_vitals_temp.php",
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

                    var graphTarget = $("#graphCanvasTemperatureAdmission");

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
            showGraphWeightAdmission();
        });


        function showGraphWeightAdmission()
        {
            {
                $.post("../../users/consulting/db_tasks/admission_vitals_temp.php",
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

                    var graphTarget = $("#graphCanvasWeightAdmission");

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
            showGraphPulseAdmission();
        });


        function showGraphPulseAdmission()
        {
            {
                $.post("../../users/consulting/db_tasks/admission_vitals_temp.php",
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

                    var graphTarget = $("#graphCanvasPulseAdmission");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
        </script>



 <script>

$(function() {
  $('#vitalsAdmission').change(function(){
    var e = document.getElementById("vitalsAdmission"); 
    if(e.value == "ALL"){
        $('.TemperatureAdmission').show();
        $('.WeightAdmission').show();
        $('.PulseAdmission').show();
    }else if(e.value == "WEIGHT"){
        $('.WeightAdmission').show();
        $('.TemperatureAdmission').hide();
        $('.PulseAdmission').hide();
    }else if(e.value == "TEMPERATURE"){
        $('.TemperatureAdmission').show();
        $('.WeightAdmission').hide();
        $('.PulseAdmission').hide();
    }else{
        $('.TemperatureAdmission').hide();
        $('.WeightAdmission').hide();
        $('.PulseAdmission').show(); 
    }
    
  });
});




$(document).ready(function() {
        $('.summernote').summernote({
            height: 150,
            width:655

        });
    });


</script>



</body>


</html>
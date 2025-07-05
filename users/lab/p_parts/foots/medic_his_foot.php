  <script src="../../assets/js/jquery.js"></script>
  <script src="../../assets/js/jquery.form.min.js"></script>
  <script src="../../assets/js/jquery.select2/select2.min.js" type="text/javascript"></script>
  <script src="../../assets/js/jquery.parsley/dist/parsley.js" type="text/javascript"></script>
  <script src="../../assets/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
  <script type="text/javascript" src="../../assets/js/jquery.nestable/jquery.nestable.js"></script>
  <script type="text/javascript" src="../../assets/js/behaviour/general.js"></script>
  <script src="../../assets/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.switch/bootstrap-switch.js"></script>
  <script type="text/javascript" src="../../assets/js/boostrap.fileinput/fileinput.min.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="../../assets/js/jquery.icheck/icheck.min.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="../../assets/js/bootstrap.daterangepicker/daterangepicker.js"></script>

  
 <script type="text/javascript" src="../../assets/js/jquery.datatables/jquery.datatables.min.js"></script>

<script type="text/javascript" src="../../assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>

  <script type="text/javascript">

window.onbeforeunload = function() {
  if (isDirty) {
    return 'There is unsaved data.';
  }
  return undefined;
}


$(function() {
  $('#source_lab_test').change(function(){
    //alert("youuu");
    var e = document.getElementById("source_lab_test"); 
    if(e.value == "NON-SELF-TEST"){
        $('.source_name').show();
        $('.Weight').show();
        $('.Pulse').show();
    } else{
        $('.source_name').hide(); 
    }
    
  });
});

//ajaxpatientlabhistory



$('#select_patient_medical_history').keyup(function(e) {

var formData = {
    'patient_name' : $('input[name=get_details_medical_history]').val()
};

if(formData['patient_name'].length >= 1){

  // process the form
  $.ajax({
      type        : 'POST',
      url         : 'ajaxpatientlabhistory.php',
      data        : formData,
      dataType    : 'json',
      encode      : true
  })
      .done(function(data) {
          console.log(data);
          $('#result').html(data).fadeIn();
          $('#result li').click(function() {

            $('#select_patient_medical_history').val($(this).text());
            $('#result').fadeOut(500);

          });

          $("#select_patient_medical_history").blur(function(){
            $("#result").fadeOut(500);
          });

      });

} else {

  $("#result").hide();

};

e.preventDefault();
});



//ajaxpatientlabhistory
   
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


//ajax_edit_walk_in


$('#select_patient_edit_walk_in').keyup(function(e) {

var formData = {
    'patient_name' : $('input[name=get_details_edit_walk_in]').val()
};

if(formData['patient_name'].length >= 1){

  // process the form
  $.ajax({
      type        : 'POST',
      url         : 'ajaxeditwalkIn.php',
      data        : formData,
      dataType    : 'json',
      encode      : true
  })
      .done(function(data) {
          console.log(data);
          $('#result').html(data).fadeIn();
          $('#result li').click(function() {

            $('#select_patient_edit_walk_in').val($(this).text());
            $('#result').fadeOut(500);

          });

          $("#select_patient_edit_walk_in").blur(function(){
            $("#result").fadeOut(500);
          });

      });

} else {

  $("#result").hide();

};

e.preventDefault();
});



//ajax_edit_walk_in


    $(document).ready(function(){

      
      //initialize the javascript
      App.init();
      
      $('#reservation').daterangepicker();
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
      });
      var cb = function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract('days', 29),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2014',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
           'Last 7 Days': [moment().subtract('days', 6), moment()],
           'Last 30 Days': [moment().subtract('days', 29), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
      };

      var optionSet2 = {
        startDate: moment().subtract('days', 7),
        endDate: moment(),
        opens: 'left',
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
           'Last 7 Days': [moment().subtract('days', 6), moment()],
           'Last 30 Days': [moment().subtract('days', 29), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        }
      };

      $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

      $('#reportrange').daterangepicker(optionSet1, cb);
 
	$('.add_stool_re').click(function(){
	    
	    var action = $("#stool_re").attr('action');
	    var macroscopy = $("#macroscopy").val();
	    var microscopy = $("#microscopy").val();
	    
	    var dataString = "macroscopy=" + macroscopy + "&microscopy=" + microscopy;	    
	    //console.log(action);
	    $.ajax({
	        type: "POST",
	        url: action,
	        data: dataString,
	        cache: false,
	        success: function(data){ 
	                $.gritter.removeAll({
                    after_close: function(){
                      $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                  });  
				  clearInputs('stool_re');  
	        }	        
	    }); 
        return false;
	});//Scripts for inserting stool_re ends
	
	
	
	//Scripts for inserting hvs_wetprep
	$('.add_hvs_wetprep').click( function(){
	    
	    var action = $('#hvs_wet_prep').attr('action');
	    var hvs_pus_cells = $('#hvs_pus_cells').val();
	    var hvs_ec = $('#hvs_ec').val();
	    var hvs_rbc = $('#hvs_rbc').val();
	    var hvs_organism_one = $('#hvs_organism_one').val();
	    var hvs_organism_two = $('#hvs_organism_two').val();
	    
	    var dataString = "hvs_pus_cells=" + hvs_pus_cells + "&hvs_ec=" + hvs_ec + "&hvs_rbc=" + hvs_rbc + "&hvs_organism_one=" + hvs_organism_one + "&hvs_organism_two=" + hvs_organism_two;	    
	    //console.log(dataString);	    
	    $.ajax({
	        type : "POST",
	        url : action,
	        data : dataString,
	        cache : false,
	        success : function(data){
	            $.gritter.removeAll({
                        after_close: function(){
                        $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                });                
                clearInputs('hvs_wet_prep');
	        }
	    });    
	    return false;	    
	});	 
	//Scripts for inserting hvs_wetprep ends
	
	//Scripts for inserting gram_strain
    $('.add_gram_stain').click( function(){
        
        var action = $('#gram_stain').attr('action');
        var gs_pus_cells = $('#gs_pus_cells').val();
        var gs_ec = $('#gs_ec').val();
        var gs_rbc = $('#gs_rbc').val();
        var gs_organism_one = $('#gs_organism_one').val();
        var gs_organism_two = $('#gs_organism_two').val();
        
        var dataString = "gs_pus_cells=" + gs_pus_cells + "&gs_ec=" + gs_ec + "&gs_rbc=" + gs_rbc + "&gs_organism_one=" + gs_organism_one + "&gs_organism_two=" + gs_organism_two;        
        //console.log(dataString);      
        $.ajax({
            type : "POST",
            url : action,
            data : dataString,
            cache : false,
            success : function(data){
                $.gritter.removeAll({
                        after_close: function(){
                        $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                });                
                clearInputs('gram_strain');
            }
        });  
        return false;       
    });  
    //Scripts for inserting gram_strain ends
    
    //Scripts for inserting haematology
    $('.add_haematology').click( function(){
        
        var action = $('#haematology_form').attr('action');
        var hb = $('#hb').val();
        var sickling = $('#sickling').val();
        var pcv = $('#pcv').val();
        var retics = $('#retics').val();
        var t_wbc_count = $('#t_wbc_count').val();
        var hb_electrophoresis = $('#hb_electrophoresis').val();
        var neutrophils = $('#neutrophils').val();
        var esr = $('#esr').val();
        var lymphocytes = $('#lymphocytes').val();
        var g6pd = $('#g6pd').val();
        var monocytes = $('#monocytes').val();
        var blood_group = $('#blood_group').val();
        var eosinophils = $('#eosinophils').val();
        var fbs = $('#fbs').val();
        var mid_hash = $('#mid_hash').val();
        var mid_percent = $('#mid_percent').val();
        var malaria_parasites = $('#malaria_parasites').val();
        var basophils = $('#basophils').val();
        var rbs = $('#rbs').val();


 
        var dataString = "hb=" + hb + "&sickling=" + sickling + "&pcv=" + pcv + "&retics=" + retics + "&t_wbc_count=" + t_wbc_count + "&hb_electrophoresis=" + hb_electrophoresis + "&neutrophils=" + neutrophils + "&esr=" + esr + "&lymphocytes=" + lymphocytes
                        + "&g6pd=" + g6pd + "&monocytes=" + monocytes + "&blood_group=" + blood_group + "&eosinophils=" + eosinophils + "&fbs=" + fbs + "&mid_hash=" + mid_hash + "&mid_percent=" + mid_percent + "&malaria_parasites=" + malaria_parasites + "&basophils=" + basophils + "&rbs=" + rbs;        
        //console.log(dataString);      
        $.ajax({
            type : "POST",
            url : action,
            data : dataString,
            cache : false,
            success : function(data){
                $.gritter.removeAll({
                        after_close: function(){
                        $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                });                
                clearInputs('haematology_form');
            }
        });  
        return false;       
    });  
    //Scripts for inserting haematology ends
    
    //Scripts for inserting urine_re
    $('.add_urine_re').click( function(){
        
        var action = $('#urine_re').attr('action');
        var appearance = $('#appearance').val();
        var ketones = $('#ketones').val();
        var colour = $('#colour').val();
        var blood = $('#blood').val();
        var specific_gravity = $('#specific_gravity').val();
        var nitrite = $('#nitrite').val();
        var ph = $('#ph').val();
        var bilirubin = $('#bilirubin').val();
        var protein = $('#protein').val();
        var urobilinogen = $('#urobilinogen').val();
        var glucose = $('#glucose').val();
        
        var dataString = "appearance=" + appearance + "&ketones=" + ketones + "&colour=" + colour + "&blood=" + blood + "&specific_gravity=" + specific_gravity + "&nitrite=" + nitrite + "&ph=" + ph + "&bilirubin=" + bilirubin + "&protein=" + protein
                        + "&urobilinogen=" + urobilinogen + "&glucose=" + glucose ;        
        //console.log(dataString);         
        $.ajax({
            type : "POST",
            url : action,
            data : dataString,
            cache : false,
            success : function(data){
                $.gritter.removeAll({
                        after_close: function(){
                        $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                });                
                clearInputs('urine_re');
            }
        });  
        return false;       
    });  
    //Scripts for inserting urine_re ends
    
    //Scripts for inserting gm
    $('.add_general_biology').click( function(){
        
        var action = $('#gm').attr('action');
        var pus_cells = $('#pus_cells').val();
        var rbcs = $('#rbcs').val();
        var epith_cells = $('#epith_cells').val();
        var t_vaginalis = $('#t_vaginalis').val();
        var bacteriodes = $('#bacteriodes').val();
        var yeast_cells = $('#yeast_cells').val();
        var s_h_masoni = $('#s_h_masoni').val();
        var crystals = $('#crystals').val();
        var casts = $('#casts').val();
        var blood_filming = $('#blood_filming').val();
        var hbsag = $('#hbsag').val();
        var vdrl_kahn = $('#vdrl_kahn').val();
        var urine_preg_test = $('#urine_preg_test').val();
        
        var dataString = "pus_cells=" + pus_cells + "&rbcs=" + rbcs + "&epith_cells=" + epith_cells + "&t_vaginalis=" + t_vaginalis + "&bacteriodes=" + bacteriodes + "&yeast_cells=" + yeast_cells + "&s_h_masoni=" + s_h_masoni + "&crystals=" + crystals + "&casts=" + casts
                        + "&blood_filming=" + blood_filming + "&hbsag=" + hbsag + "&vdrl_kahn=" + vdrl_kahn + "&urine_preg_test=" + urine_preg_test;        
        //console.log(dataString);         
        $.ajax({
            type : "POST",
            url : action,
            data : dataString,
            cache : false,
            success : function(data){
                $.gritter.removeAll({
                        after_close: function(){
                        $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                });                
                clearInputs('gm');
            }
        });  
        return false;       
    });  
    //Scripts for inserting gm ends
    
    //Scripts for inserting widal_test
	$('.add_widal_test').click(function(){
	    
	    var action = $("#widal_test").attr('action');
	    var s_typhi_o = $("#s_typhi_o").val();
	    var s_typhi_h = $("#s_typhi_h").val();
            var comment = $("#comment").val();
	    
	    var dataString = "s_typhi_o=" + s_typhi_o + "&s_typhi_h=" + s_typhi_h + "&comment=" + comment;	    
	    //console.log(action);
	    $.ajax({
	        type: "POST",
	        url: action,
	        data: dataString,
	        cache: false,
	        success: function(data){
	                $.gritter.removeAll({
                    after_close: function(){
                      $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                  });  
				  clearInputs('widal_test');  
	        }	        
	    }); 
        return false;
	});//Scripts for inserting widal_test ends
        
        //Scripts for inserting widal_test
	$('.add_skin_snip').click(function(){
	    
	    var action = $("#skin_snip").attr('action');
	    var remarks = $("#remarks").val();
	    
	    var dataString = "remarks=" + remarks;	    
	    //console.log(action);
	    $.ajax({
	        type: "POST",
	        url: action,
	        data: dataString,
	        cache: false,
	        success: function(data){
	                $.gritter.removeAll({
                    after_close: function(){
                      $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                  });  
				  clearInputs('skin_snip');  
	        }	        
	    }); 
        return false;
	});//Scripts for inserting skin_snip ends
    
    function clearInputs(form_name){
        $("#" + form_name + " :input").each( function(){
            
            $(this).val('');
        });
    }
    
     //Scripts for submitting results
    $('#submit_results').click(function(){
      
      var action = 'tasks/submit_lab_results.php';
      var status = $('#status').val();
      
      var dataString = "status=" + status;        
        //console.log(action);
        $.ajax({
            type: "POST",
            url: action,
            data: dataString,
            cache: false,
            success: function(data){
                    $.gritter.removeAll({
                    after_close: function(){
                      $.gritter.add({
                        position: 'top-right',
                        title: 'Success Message',
                        text: data,
                        class_name: 'clean'
                      });
                    }
                  });  
            }           
        }); 
        return false;
       //alert('Sent to Doctor' + status);
    });//Scripts for submitting results ends
    
    //Scripts for slip upload widget 
    $("#pink_slip_image").fileinput({
            showCaption: false,
            browseClass: "btn btn-primary",
            fileType: "any"
    }); //Scripts for slip upload widget ends
        
    $("#upload_slip").submit(function(){
        
        if( !$('#pink_slip').val()){
                $('#output').html("Please choose an image first");        
                return false;
        }
      
        var submitted = $(this).ajaxSubmit(options);
        
        if(submitted){
            $.gritter.removeAll({
                after_close: function(){
                $.gritter.add({
                position: 'top-right',
                title: 'Success Message',
                text: 'Slip uploaded',
                class_name: 'clean'
              });
            }
        });
        
        $("#output").html('File has been upload, You can now submit Lab Results');
        
        }
        return false;
    });    
    
    //Scripts for uploading file with progress bar 
    var options = {
        target: '#output',
        beforeSubmit: beforeSubmit,
        success: afterSuccess,
        uploadProgress: OnProgress,
        resetForm:true
    };
    
    
    
    //function after successfull file upload(when server response)
    function afterSuccess(){
        $('#upload-btn').show(); //hide submit button
        $('#loading-img').hide(); //hide submit button
        $('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar
           
    }
    
    //function to check file size before uploading
    function beforeSubmit(){
        //check if browser supports HTML5 File API
        if(window.File && window.FileReader && window.FileList && window.Blob){
            if( !$('#pink_slip').val()){
                $('#output').html("Please select an image first");
                return false;
            }
            
            var file_size = $('#pink_slip')[0].files[0].size;
            var file_type = $('#pink_slip')[0].files[0].type;
            
            //allow file types 
            switch(ftype)
            {
                case 'image/png': 
                case 'image/gif': 
                case 'image/jpeg': 
                case 'image/pjpeg':
                case 'application/pdf':              
                break;
                default:
                $("#output").html("<b>"+file_type+"</b> Unsupported file type!");
                return false
            }
            
            //Allowed file size is less than 5 MB (1048576)
            if(file_size>5242880) 
            {
                $("#output").html("<b>"+bytesToSize(file_size) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
                return false
            }
        }
        else
        {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
            return false;
        }
        
        //progress bar function
        function OnProgress(event, position, total, percentComplete)
        {
            //Progress bar
            $('#progressbox').show();
            $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
            $('#statustxt').html(percentComplete + '%'); //update status text
            if(percentComplete>50)
                {
                    $('#statustxt').css('color','#000'); //change status text to white after 50%
                }
        }
        
        //function to format bites bit.ly/19yoIPO
        function bytesToSize(bytes) {
           var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
           if (bytes == 0) return '0 Bytes';
           var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
           return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }
        
        
    }//function to check file size before uploading ends
         
    //Scripts for uploading file with progress bar  
    
   
	
});//end of jquery




$(function() {
      
      $("#get_all_patients_walk_in").dataTable();
   
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




  


</body>


</html>
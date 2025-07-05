<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/jquery.form.min.js"></script>
<script src="../assets/js/jquery.select2/select2.min.js" type="text/javascript"></script>
<script src="../assets/js/jquery.parsley/dist/parsley.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
<script type="text/javascript" src="../assets/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="../assets/js/behaviour/general.js"></script>
<script src="../assets/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript" src="../assets/js/bootstrap.switch/bootstrap-switch.js"></script>
<script type="text/javascript" src="../assets/js/boostrap.fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.icheck/icheck.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../assets/js/jquery.datatables/jquery.datatables.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
<script type="text/javascript" src="../assets/js/jquery.datatables/dataTables.min.js"></script>   
<script type="text/javascript" src="../assets/js/jquery.ui/jquery-ui.js" ></script>  

<!-- DATA TABES SCRIPT -->
<script src="../datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../datatables/dataTables.bootstrap.min.js" type="text/javascript"></script> 

<script type="text/javascript">
    $(function() {
        $("#investigations").dataTable();
        $("#addroom").dataTable();
        $("#assignconsulting").dataTable();
               $("#diagnosis").dataTable();
  $("#complains").dataTable();
$("#procedure").dataTable();
    });
    
</script>

<!--end of datatables-->

<script type="text/javascript">

    /* Formating function for row details */
    $(document).ready(function() {
        //initialize the javascript
        App.init();
        App.dataTables();
        //$('#datatable');	

        //Scripts for inserting hvs_wetprep
        $('.add_hvs_wetprep').click(function() {

            var action = $('#hvs_wet_prep').attr('action');
            var hvs_pus_cells = $('#hvs_pus_cells').val();
            var hvs_ec = $('#hvs_ec').val();
            var hvs_rbc = $('#hvs_rbc').val();
            var hvs_organism_one = $('#hvs_organism_one').val();
            var hvs_organism_two = $('#hvs_organism_two').val();

            var dataString = "hvs_pus_cells=" + hvs_pus_cells + "&hvs_ec=" + hvs_ec + "&hvs_rbc=" + hvs_rbc + "&hvs_organism_one=" + hvs_organism_one + "&hvs_organism_two=" + hvs_organism_two;
            //console.log(dataString);	    
            $.ajax({
                type: "POST",
                url: action,
                data: dataString,
                cache: false,
                success: function(data) {
                    $.gritter.removeAll({
                        after_close: function() {
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

        //ajax script here
        function get_ajax(method, action, dataString, msg_type, class_name, form_name) {
            $.ajax({
                type: method,
                url: action,
                data: dataString,
                cache: false,
                success: function(data) {
                    $.gritter.removeAll({
                        after_close: function() {
                            $.gritter.add({
                                position: 'top-right',
                                title: msg_type,
                                text: data,
                                class_name: class_name
                            });
                        }
                    });
                    clearInputs(form_name);
                }
            });

        }

        function clearInputs(form_name) {
            $("#" + form_name + " :input").each(function() {

                $(this).val('');
            });
        }

        //Scripts for submitting results
        $('#submit_results').click(function() {

            alert('yes');
        });

        //Scripts for slip upload widget 
        $("#pink_slip_image").fileinput({
            showCaption: false,
            browseClass: "btn btn-primary",
            fileType: "any"
        }); //Scripts for slip upload widget ends

        $("#upload_slip").submit(function() {

            if (!$('#pink_slip').val()) {
                $('#output').html("Please choose an image first");
                return false;
            }

            var submitted = $(this).ajaxSubmit(options);

            if (submitted) {
                $.gritter.removeAll({
                    after_close: function() {
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
            resetForm: true
        };



        //function after successfull file upload(when server response)
        function afterSuccess() {
            $('#upload-btn').show(); //hide submit button
            $('#loading-img').hide(); //hide submit button
            $('#progressbox').delay(1000).fadeOut(); //hide progress bar

        }

        //function to check file size before uploading
        function beforeSubmit() {
            //check if browser supports HTML5 File API
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                if (!$('#pink_slip').val()) {
                    $('#output').html("Please select an image first");
                    return false;
                }

                var file_size = $('#pink_slip')[0].files[0].size;
                var file_type = $('#pink_slip')[0].files[0].type;

                //allow file types 
                switch (ftype)
                {
                    case 'image/png':
                    case 'image/gif':
                    case 'image/jpeg':
                    case 'image/pjpeg':
                    case 'application/pdf':
                        break;
                    default:
                        $("#output").html("<b>" + file_type + "</b> Unsupported file type!");
                        return false
                }

                //Allowed file size is less than 5 MB (1048576)
                if (file_size > 5242880)
                {
                    $("#output").html("<b>" + bytesToSize(file_size) + "</b> Too big file! <br />File is too big, it should be less than 5 MB.");
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
                if (percentComplete > 50)
                {
                    $('#statustxt').css('color', '#000'); //change status text to white after 50%
                }
            }

            //function to format bites bit.ly/19yoIPO
            function bytesToSize(bytes) {
                var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes == 0)
                    return '0 Bytes';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
            }


        }//function to check file size before uploading ends

        //Scripts for uploading file with progress bar  

    });//end of jquery

</script>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../assets/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.gritter/js/jquery.gritter.js"></script>
</body>


</html>
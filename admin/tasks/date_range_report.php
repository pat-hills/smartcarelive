<body>

<div class="container-fluid" id="pcont">
<div class="page-head">
      <h2>Date Range Selection For Report</h2>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
       
        <li class="active">Date Range Selection Report</li>
      </ol>
    </div>

   <?php
        if( isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg'])?>!</strong> 
                </div>     
            </div>
      <?php  }  else if( isset($_SESSION['errorMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['errorMsg']; unset($_SESSION['successMsg'])?>!</strong> 
                </div>     
            </div>
      <?php } ?>
    <div class="cl-mcont"> 
        <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Generate Report</h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  style="border-radius: 0px;" method="post">
             <p>Please select the type of report duration</p>
            

 


                      <div id="dateSelection" style="">
                                  <div class="form-group">
                                        <label class="col-sm-3 control-label">(Start) From : </label>
                                        <div class="col-sm-3">

                                            <div class="input-group date datetime" data-min-view="2" data-date-format="yyyy-mm-dd">
                                                <input type="text" name="startDate" id="startDate" class="form-control" size="16" required  readonly="" >
                                                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>    
                                        </div>
                                    </div>
              
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">(End) To : </label>
                                        <div class="col-sm-3">

                                            <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                                                <input type="text" name="endDate" id="endDate" class="form-control" size="16"  readonly="" >
                                                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>    
                                        </div>
                                    </div>

                      </div>

                      <div id="ClientType" style="">
                 <div class="form-group">
                <label class="col-sm-3 control-label">CLIENT TYPE: </label>
                <div class="col-sm-3">
                    <select name="ClientType" id="ClientType" required  class="form-control">
                    <option></option>
                        <option>INSURANCE-CLIENT</option>
                        <option>CASH-CLIENT</option>
                        
                       
                   
                    </select>
                </div>
              </div> </div>

                     <div id="revenueType" style="">
                 <div class="form-group">
                <label class="col-sm-3 control-label">REPORT TYPE: </label>
                <div class="col-sm-3">
                    <select name="reportType" id="revenueSelect" required  class="form-control">
                    <option></option>
                        <option>Consultation</option>
                        <option>Investigation</option>
                        <option>Medication</option>
                       
                   
                    </select>
                </div>
              </div> </div>
                                 

              <div id="showButton" style="margin-left: 414px;"><button class="btn btn-primary"  name="load_records">Load Records</button></div>
            </form>	

            <?php

          
        if( isset($_POST['load_records'])) {
          
          $startDate = "";
          $endDate = "";
          $today = date('Y-m-d'); 
       
          $startDate = $_POST['startDate'];

          if(empty($startDate)){
            $startDate = $today;
          }

          $endDate = $_POST['endDate'];
          $ClientType = $_POST['ClientType'];
          $_SESSION['startDate'] = $startDate;
          $_SESSION['endDate'] = $endDate; 
          $_SESSION['ClientType'] = $ClientType; 
          $_SESSION['reportType'] = $_POST['reportType'];

 
          ?>
						 

            <?php  } ?>

          </div>
     <?php

          if(isset($_POST['load_records']) && $_POST['reportType']=="Medication" ) {
            
           
            
            ?>
         <div><a class="btn btn-primary" href="../admin/reporting/date_range_drug" target="_blank">Generate medication report

         
         </a></div>      
      <?php } ?>


      <?php

if(isset($_POST['load_records']) && $_POST['reportType']=="Consultation" ) { ?>
<div><a class="btn btn-primary" href="../admin/reporting/date_range_consulting" target="_blank">Generate consultation report


</a></div>      
<?php } ?>



<?php

if(isset($_POST['load_records']) && $_POST['reportType']=="Investigation" ) { ?>
<div><a class="btn btn-primary" href="../admin/reporting/date_range_lab" target="_blank">Generate investigation report


</a></div>      
<?php } ?>
      
       
        </div>
        
    </div>

    <script>

        document.getElementById('Frequency').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('periodSelection').style.display = 'block';
                document.getElementById('dateSelection').style.display = 'none';
                document.getElementById('showButton').style.display = 'block';
                document.getElementById('revenueType').style.display = 'block';

                //

                const selectElement = document.getElementById('startDate');
                selectElement.required = false;
                selectElement.value = ''; // Set the value to empty

                const selectElement1 = document.getElementById('endDate');
                selectElement1.required = false;
                selectElement1.value = ''; // Set the value to empty

            }
        });

        document.getElementById('Selection').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('dateSelection').style.display = 'block';
                document.getElementById('periodSelection').style.display = 'none';
                document.getElementById('showButton').style.display = 'block';
                document.getElementById('revenueType').style.display = 'block';
                // Modify the select element when Selection is selected
                const selectElemente = document.getElementById('periodSelect');
                selectElemente.required = false;
                selectElemente.value = ''; // Set the value to empty
            }
        });

      
    </script>
<body>

<div class="container-fluid" id="pcont">
<div class="page-head">
      <h2>Patients Report</h2>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
       
        <li class="active">Report</li>
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
            <h3>All Patient List</h3>
          </div>


          <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  style="border-radius: 0px;" method="post">
		  <p>Please select the type of report duration</p>
  <div class="row">
    <div id="dateSelection" style="">
                                 
              
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">SELECT PATIENT TYPE : </label>
                                        <div class="col-sm-3">

                                        <select name="patientType" id="patientType" required  class="form-control">
                    <option></option>
                        <option>ALL-CLIENTS</option>
                        <option>CASH-CLIENTS</option>
                        <option>INSURANCE-CLIENTS</option>
                       
                   
                    </select> 
                                        </div>
                                    </div>

                      </div>
  </div>

       
		 <div id="showButton" style="margin-left: 414px;"><button class="btn btn-primary"  name="load_records">Load Records</button></div>       
		 </form>		 
		 

          <div class="content">
      
				<div class="table-responsive">

         

        <table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
										<th>Patient ID</th>
											<th>Patient Name</th>
                      <th>Scheme</th>
                      <th>Membership ID</th>
                      <th>Date Registered</th>
                      
											
											 
											
										</tr>
									</thead>
									<tbody>


										<?php

if( isset($_POST['load_records'])) {

  //$load_records = $_POST['load_records'];
    $patientType = $_POST['patientType'];
    $_SESSION['patientType'] = $patientType;
                    
                    $all = all_patients($patientType); 

}else{

  $all = all_patients(""); 

}

                   
                    
                    ?>
										
										
										
									</tbody>
								</table>	
        
        
        

				</div>
			</div>

           
			
			
          </div>
 
          <?php

          if(isset($_POST['load_records']) && $_SESSION['patientType'] ) {
            
           
            
            ?>
         <div><a class="btn btn-primary" href="../admin/reporting/clientType" target="_blank">Generate report

         
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
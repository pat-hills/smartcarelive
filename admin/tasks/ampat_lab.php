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
            <h3>Lab Monthly</h3>
          </div>
          <div class="content">
      
				<div class="table-responsive">

         

        <table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
                    <th>Patient ID</th>
											<th>Patient Name</th>
                      <th>Lab Request</th>
                      <th>By</th>
                      <th>Processed Date</th>
											
											 
											
										</tr>
									</thead>
									<tbody>
										<?php $all = getLabsMonthly(FALSE); ?>
										
										
										
									</tbody>
								</table>	
        
        
        

				</div>
			</div>

           
			
			
          </div>
 
         <div><a class="btn btn-primary" href="../admin/reporting/ampat_lab" target="_blank">Generate report

         
         </a></div>      
      
       
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
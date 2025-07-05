<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Drugs Prescriptions Today 
              
            <?php if (isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Success!</strong> <?php echo $_SESSION['successMsg'] ?>
                </div>     
            </div>
            <?php
            unset($_SESSION['successMsg']);
        } else if (isset($_SESSION['errorMsg'])) {
            ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Error!</strong>  <?php echo $_SESSION['errorMsg'] ?>
                </div>     
            </div>
            <?php
            unset($_SESSION['errorMsg']);
        }
        ?>

            </h2>
            <ol class="breadcrumb">
                <li><a href="#">All Patients Drugs Today</a></li>

                <li class="active">View</li>
            </ol>
 
        </div>
        <div class="cl-mcont">

        <div class="row">
      <div class="col-md-12">
   
      
        <div class="block-flat">
          <div class="header">                          
            <h3>List of patients drugs prescribed today</h3>
          </div>
    <div class="content">
            
			<div class="content">
				<div class="table-responsive">
                
				<table id='get_all_patients_opd' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
                        <th style=""><strong>Patient ID</strong></th>							
							<th style=""><strong>Fullname</strong></th>
							<th style=""><strong>Prescribed Dr.</strong></th>
           <th style=""><strong>Drug name</strong></th>
           <th style=""><strong>Dosage</strong></th>
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php
								patient_drugs_details_view("");
							?>					
					</tbody>  
				</table>	
     
				</div>
			</div>
			
			
    </div>
        </div>
        
    </div>

</div>





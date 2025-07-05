<body>

    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Patients Seen Today 
              
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
                <li><a href="#">Patients Seen Today</a></li>

                <li class="active">View</li>
            </ol>
 
        </div>
        <div class="cl-mcont">

        <div class="row">
      <div class="col-md-12">
   
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Patients Seen Today</h3>
          </div>
    <div class="content">

   	
            
			<div class="content">
				<div class="table-responsive">
                
				<table id='get_all_patients_opd' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
							<th style="width:10%;"><strong>Patient ID</strong></th>							
							<th style="width:10%;"><strong> Name</strong></th>
                            <th style="width:20%;"><strong>Vitats</strong></th>
							<th style="width:15%;"><strong>Date</strong></th>
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php
                            $startDate = "";
                            $endDate = "";
								getMyPatientHistory($startDate,$endDate);
							?>					
					</tbody>  
				</table>	
     
				</div>
			</div>
			
			
    </div>
        </div>
        
    </div>

</div>





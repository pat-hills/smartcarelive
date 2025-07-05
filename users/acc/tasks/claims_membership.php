<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Claims</h2>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
       
        <li class="active">Claims Track List</li>
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
            <h3>Patients claims membership</h3>
          </div>
          <div class="content">
            
			<div class="content">
				<div class="table-responsive">
                
				<table id='claims_membership' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
							<th style="width:30%;"><strong>Patient ID</strong></th>							
							<th style="width:30%;"><strong>Claim ID</strong></th>
							<th style="width:15%;"><strong>Date Recorded</strong></th>
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php
								echo claims_membership();
							?>					
					</tbody>  
				</table>	
     
				</div>
			</div>
			
			
          </div>
        </div>
        
    </div>
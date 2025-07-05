<body>

<div class="container-fluid" id="pcont">
<div class="page-head">
      <h2>Claims</h2>
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
            <h3>Generate Report</h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  style="border-radius: 0px;" method="post">
              
              <div class="form-group">
                <label class="col-sm-3 control-label">SELECT CLAIM : </label>
                <div class="col-sm-6">
                    <select name="claim_code" required class="form-control">
                        <option>--------------------</option>
                        <?php
							echo list_claims_code_();
							?>	
                    </select>
                    <!-- <input type="text" name="room_name" required="" placeholder="eg: Room 1" class="form-control"> -->
                </div>
              </div>

              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="load_records">Load records</button></div>
            </form>
			
			<div class="content">
				<div class="table-responsive">
				<table id='claims_membership_report' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
						<th style="width:30%;"><strong>Patient ID</strong></th>							
							<th style="width:30%;"><strong>Claim ID</strong></th>
							<th style="width:15%;"><strong>Date Recorded</strong></th>				 
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php
                            if(isset($_POST['load_records'])){

                                $claim_code = $_POST['claim_code'];

                                $_SESSION['claim_code'] = $claim_code;

                                if($claim_code != null && $claim_code != "--------------------"){

                                    load_claims_membership($claim_code);

                                }
                            }
							
							?>					
					</tbody>  
				</table>		
				</div>
			</div>

           
			
			
          </div>
<?php

          if(isset($_POST['load_records']) && $_POST['claim_code'] && $_POST['claim_code'] !="--------------------") { ?>
         <div><a class="btn btn-primary" href="../../users/NHIS/reporting/claims_report" target="_blank">Generate report</a></div>      
      <?php } ?>
       
        </div>
        
    </div>
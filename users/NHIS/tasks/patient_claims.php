<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Patients Claim</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">View Patient Claims</li>
      </ol>
    </div>

  
    <div class="cl-mcont"> 
        <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          
          <div class="content">
             <!-- <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/addroom.php" style="border-radius: 0px;" method="post">
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Room Name : </label>
                <div class="col-sm-6">
                    <input type="text" name="room_name" required="" placeholder="eg: Room 1" class="form-control">
                </div>
              </div>

              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_room">Add Room</button></div>
            </form> -->
			
			<div class="content">
				<div class="table-responsive">
				<table id='addroom' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
							<th style=""><strong>Pic</strong></th>							
							<th style=""><strong>Fullname</strong></th>
                            <th style=""><strong>Membership ID</strong></th>
                            <th style=""><strong>Claims Provider</strong></th>
                            <th style=""><strong>Consultation Date</strong></th>
                            <th style=""><strong>Consultation Amount</strong></th>
                            <th style=""><strong>Drugs Amount</strong></th>
                            <th style=""><strong>Lab Amount</strong></th>
                           
                            <th style=""><strong>Status</strong></th>
                            <th style=""><strong>Total(GH&cent;)</strong></th>
                            <th style=""><strong>View More</strong></th>
							 
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php
								 getAllpatientstoClaim();
							?>					
					</tbody>  
				</table>		
				</div>
			</div>
			
			
          </div>
        </div>
        
    </div>
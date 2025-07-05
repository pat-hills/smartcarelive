<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Admin</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Admin - Add Room</li>
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
            <h3>Add Room</h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/addroom.php" style="border-radius: 0px;" method="post">
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Room Name : </label>
                <div class="col-sm-6">
                    <input type="text" name="room_name" required="" placeholder="eg: Room 1" class="form-control">
                </div>
              </div>

              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_room">Add Room</button></div>
            </form>
			
			<div class="content">
				<div class="table-responsive">
				<table id='addroom' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
							<th style="width:30%;"><strong>Room ID</strong></th>							
							<th style="width:30%;"><strong>Room Name</strong></th>
							<th style="width:15%;" class="text-center"><strong>Remove</strong></th>
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php
								echo list_consulting_rooms();
							?>					
					</tbody>  
				</table>		
				</div>
			</div>
			
			
          </div>
        </div>
        
    </div>
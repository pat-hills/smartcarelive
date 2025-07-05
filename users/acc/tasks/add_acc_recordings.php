<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Expense Recordings</h2>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
       
        <li class="active">Add Recordings</li>
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
            <h3>Add recordings</h3>
          </div>
          <div class="content">

          <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/addrecordings.php" style="border-radius: 0px;" method="post">
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Select Expense Item : </label>
                <div class="col-sm-6">
                <select id="room" name="item" required="" class="form-control">
                                                <option value=""> -- Select Room -- </option>
                                                <?php
                                                select_expense_items();
                                                ?>

                                            </select>    
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Add Amount(GHC) : </label>
                <div class="col-sm-6">
                    <input type="text" name="amt" required autocomplete="off" placeholder="eg: 500" class="form-control">
                </div>
              </div>

              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_acc">Add </button></div>
            </form>
            
			<div class="content">
				<div class="table-responsive">
                
				<table id='claimTracker' class="table no-border hover">
					<thead class="no-border">
						<tr>
            <th style="width:15%;"><strong>Date Created</strong></th>
							<th style="width:30%;"><strong>Expense Item</strong></th>	
              <th style="width:30%;"><strong>Expense Amount (GHC)</strong></th>	
							
              <th style="width:15%;"><strong>Action</strong></th>
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php
								echo list_expense_recordings();
							?>					
					</tbody>  
				</table>	
     
				</div>
			</div>
			
			
          </div>
        </div>
        
    </div>
<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Expense Items</h2>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
       
        <li class="active">Add Expense Items</li>
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
            <h3>Add entries</h3>
          </div>
          <div class="content">

          <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/addaccitem.php" style="border-radius: 0px;" method="post">
              
              <div class="form-group">
                <label class="col-sm-3 control-label">Expense Item : </label>
                <div class="col-sm-6">
                    <input type="text" name="item_name" required autocomplete="off" placeholder="eg: Light Bill" class="form-control">
                </div>
              </div>

              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_acc">Add </button></div>
            </form>
            
			<div class="content">
				<div class="table-responsive">
                
				<table id='claimTracker' class="table no-border hover">
					<thead class="no-border">
						<tr>
							
							<th style="width:30%;"><strong>Expense Item</strong></th>	
							<th style="width:15%;"><strong>Date Created</strong></th>
              <th style="width:15%;"><strong>Action</strong></th>
						</tr>
					</thead>
					<tbody class="no-border-y">					
							<?php
								echo list_expense_items();
							?>					
					</tbody>  
				</table>	
     
				</div>
			</div>
			
			
          </div>
        </div>
        
    </div>
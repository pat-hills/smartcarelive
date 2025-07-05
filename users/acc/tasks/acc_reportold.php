<body>

<div class="container-fluid" id="pcont">
<div class="page-head">
      <h2>Income Statement</h2>
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
                <label class="col-sm-3 control-label">SELECT PERIOD: </label>
                <div class="col-sm-6">
                    <select name="period" required class="form-control">
                    <option>-----SELECT-----</option>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option>Yearly</option>
                   
                    </select>
                    <!-- <input type="text" name="room_name" required="" placeholder="eg: Room 1" class="form-control"> -->
                </div>
              </div>

              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="load_records">Load records</button></div>
            </form>
			
			<div class="content">
				<div class="table-responsive">

				<table id='' class="table no-border hover">
					<thead class="no-border">

          <?php
        if( isset($_POST['load_records'])) {
          
          $period = $_POST['period'];
         
         ?>
						<tr>
              <strong><?php echo $period; ?> Expenses</strong>
							
						<th style="width:30%;"><strong>Date</strong></th>							
							<th style="width:30%;"><strong>Item</strong></th>
							<th style="width:15%;"><strong>Amount (GHC)</strong></th>				 
						</tr>

            <?php  } ?>
					</thead>
					<tbody class="no-border-y">					
          <?php
        if(isset($_POST['load_records'])) {
          
          $period = $_POST['period'];
        

          $sub_total = "Sub Total";

          $consulation_rows = load_expense_report("Daily");
          
          
         $period_amount = number_format(load_sum_expense_report("Daily"),2);
         while($row = mysqli_fetch_array($consulation_rows)){
          ?>
            
                   <tr>  
                  
                           <td> <?php echo date("F jS, Y", strtotime($row['date_reg'])); ?> </td>
                           <td> <?php echo $row['acc_name'] ?> </td>
                           <td> <?php echo $row['total_amount'] ?> </td>

                   <tr>



                   <?php } } ?>			
					</tbody> 
          <thead class="no-border">
						<tr>
							
						<th style="width:30%;"><strong></strong></th>							
							<th style="width:30%;"><strong><?php echo $sub_total ?></strong></th>
							<th style="width:15%;"><strong><?php echo $period_amount;  ?></strong></th>				 
						</tr>
					</thead> 
				</table>	<br/>
        

        <table id='' class="table no-border hover">
					<thead class="no-border">

          <?php
        if( isset($_POST['load_records'])) {
          
          $period = $_POST['period'];
          ?>
						<tr>
              <strong><?php echo $period; ?> Consultation Payments Received</strong>
							
						<th style="width:30%;"><strong>Date</strong></th>							
							<th style="width:30%;"><strong>Item</strong></th>
							<th style="width:15%;"><strong>Amount (GHC)</strong></th>				 
						</tr>

            <?php  } ?>
					</thead>
					<tbody class="no-border-y">

         
					 				
					</tbody> 
          <thead class="no-border">
						<tr>
							
						<th style="width:30%;"><strong></strong></th>							
							<th style="width:30%;"><strong><?php echo $sub_total ?></strong></th>
							<th style="width:15%;"><strong><?php echo $period_amount;  ?></strong></th>				 
						</tr>
					</thead> 
				</table>


        
        <table id='' class="table no-border hover">
					<thead class="no-border">

          <?php
        if( isset($_POST['load_records'])) {
          
          $period = $_POST['period'];
          ?>
						<tr>
              <strong><?php echo $period; ?> Investigation Payments Received</strong>
							
						<th style="width:30%;"><strong>Date</strong></th>							
							<th style="width:30%;"><strong>Item</strong></th>
							<th style="width:15%;"><strong>Amount (GHC)</strong></th>				 
						</tr>

            <?php  } ?>
					</thead>
					<tbody class="no-border-y">		
            
       
						 	
					</tbody> 
          <thead class="no-border">
						<tr>
							
						<th style="width:30%;"><strong></strong></th>							
							<th style="width:30%;"><strong><?php echo $sub_total ?></strong></th>
							<th style="width:15%;"><strong><?php echo $period_amount;  ?></strong></th>				 
						</tr>
					</thead> 
				</table>



        <table id='' class="table no-border hover">
					<thead class="no-border">

          <?php
        if( isset($_POST['load_records'])) {
          
          $period = $_POST['period'];
          ?>
						<tr>
              <strong><?php echo $period; ?> Drug Payments Received</strong>
							
						<th style="width:30%;"><strong>Date</strong></th>							
							<th style="width:30%;"><strong>Item</strong></th>
							<th style="width:15%;"><strong>Amount (GHC)</strong></th>				 
						</tr>

            <?php  } ?>
					</thead>

					<tbody class="no-border-y">		

                 
      
						 

					</tbody> 
          <thead class="no-border">
						<tr>
							
						<th style="width:30%;"><strong></strong></th>							
							<th style="width:30%;"><strong><?php echo $sub_total ?></strong></th>
							<th style="width:15%;"><strong><?php echo $period_amount;  ?></strong></th>				 
						</tr>
					</thead> 
				</table>



      
        

				</div>
			</div>

           
			
			
          </div>
<?php

          if(isset($_POST['load_records']) && $_POST['period'] && $_POST['period'] !="-----SELECT-----") { ?>
         <div><a class="btn btn-primary" href="../../users/NHIS/reporting/claims_report" target="_blank">Generate report</a></div>      
      <?php } ?>
       
        </div>
        
    </div>
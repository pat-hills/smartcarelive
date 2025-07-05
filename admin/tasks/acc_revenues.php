<body>

<div class="container-fluid" id="pcont">
<div class="page-head">
      <h2>Revenues Report</h2>
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
             <p>Please select the type of report duration</p>
             <div class="reportType">
               <input type="radio" id="Frequency" name="fav_report" value="HTML">
  <label for="html">Frequency (Dropdrop Of Period)</label><br>
  <input type="radio" id="Selection" name="fav_report" value="CSS">
  <label for="css">Date Selection (Start Date - End Date)</label>
   


             </div>


                 <div id="periodSelection" style="display:none">
                 <div class="form-group">
                <label class="col-sm-3 control-label">SELECT PERIOD: </label>
                <div class="col-sm-3">
                    <select name="period" id="periodSelect" required  class="form-control">
                    <option></option>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option>Yearly</option>
                   
                    </select>
                </div>
              </div> </div>


                      <div id="dateSelection" style="display:none">
                      <div class="form-group">
                                        <label class="col-sm-3 control-label">(Start) From : </label>
                                        <div class="col-sm-3">

                                            <div class="input-group date datetime" data-min-view="2" data-date-format="yyyy-mm-dd">
                                                <input type="text" name="startDate" id="startDate" class="form-control" size="16" required  readonly="" >
                                                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>    
                                        </div>
                                    </div>
              
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">(End) To : </label>
                                        <div class="col-sm-3">

                                            <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                                                <input type="text" name="endDate" id="endDate" class="form-control" size="16" required  readonly="" >
                                                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>    
                                        </div>
                                    </div>

                      </div>

                      <div id="revenueType" style="display:none">
                 <div class="form-group">
                <label class="col-sm-3 control-label">REVENUE TYPE: </label>
                <div class="col-sm-3">
                    <select name="revenueType" id="revenueSelect" required  class="form-control">
                    <option></option>
                        <option>Consultation</option>
                        <option>Investigation</option>
                        <option>Medication</option>
                       
                   
                    </select>
                </div>
              </div> </div>
                                 

              <div id="showButton" style="margin-left: 310px; display:none"><button class="btn btn-primary"  name="load_records">Load records</button></div>
            </form>
			
			<div class="content">
				<div class="table-responsive">

        <table id='' class="table no-border hover">
					<thead class="no-border">

          <?php
        if( isset($_POST['load_records']) && $_POST['revenueType']=="Consultation") {
          
          $period = $_POST['period'];
          $startDate = $_POST['startDate'];
          $endDate = $_POST['endDate'];
          $_SESSION['startDate'] = $startDate;
          $_SESSION['endDate'] = $endDate;
          $_SESSION['period'] = $period;
          $_SESSION['revenueType'] = $_POST['revenueType'];
          $period_amountConsultation = number_format(load_sum_consultation_report($period,$startDate,$endDate),2);
          $sub_totalConsultation = "Sub Total";

          $consulation_rows = load_consultation_report($period,$startDate,$endDate);
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

          <?php
    
    if($consulation_rows != null){
         while($row = mysqli_fetch_array($consulation_rows)){
 
          ?>
            
                   <tr>  
                  
                           <td> <?php echo date("F jS, Y", strtotime($row['date_added'])); ?> </td>
                           <td> <?php echo $row['item'] ?> </td>
                           <td> <?php echo $row['total_amount'] ?> </td>

                   <tr>



                   <?php } } ?>
					 				
					</tbody> 
          <thead class="no-border">
						<tr>
							
						<th style="width:30%;"><strong></strong></th>							
							<th style="width:30%;"><strong><?php echo $sub_totalConsultation ?></strong></th>
							<th style="width:15%;"><strong><?php 
              
             

               

               echo $period_amountConsultation;

              
              
              ?></strong></th>				 
						</tr>
					</thead> 
				</table>


        
        <table id='' class="table no-border hover">
					<thead class="no-border">

          <?php
         if( isset($_POST['load_records']) && $_POST['revenueType']=="Investigation") {
          
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
            
          
          <?php
        if( isset($_POST['load_records']) && $_POST['revenueType']=="Investigation") {
          
          $period = $_POST['period'];
          $startDate = $_POST['startDate'];
          $endDate = $_POST['endDate'];
          $_SESSION['startDate'] = $startDate;
          $_SESSION['endDate'] = $endDate;
          $_SESSION['period'] = $period;
          $_SESSION['revenueType'] = $_POST['revenueType'];
          $period_amountInvestigation = number_format(load_sum_laboratory_report($period,$startDate,$endDate),2);

          $sub_totalInvestigation = "Sub Total";

          $consulation_rows = load_laboratory_report($period,$startDate,$endDate);

         while($row = mysqli_fetch_array($consulation_rows)){

          $i = 0;
          ?>
            
                   <tr>  
                  
                           <td> <?php echo date("F jS, Y", strtotime($row['date_added'])); ?> </td>
                           <td> <?php echo $row['item'] ?> </td>
                           <td> <?php echo $row['total_amount'] ?> </td>

                   <tr>



                   <?php } } ?>
						 	
					</tbody> 
          <thead class="no-border">
						<tr>
							
						<th style="width:30%;"><strong></strong></th>							
							<th style="width:30%;"><strong><?php echo $sub_totalInvestigation ?></strong></th>
							<th style="width:15%;"><strong><?php echo $period_amountInvestigation;  ?></strong></th>				 
						</tr>
					</thead> 
				</table>



        <table id='' class="table no-border hover">
					<thead class="no-border">

          <?php
       if( isset($_POST['load_records']) && $_POST['revenueType']=="Medication") {
          
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

                 
          <?php
        if( isset($_POST['load_records']) && $_POST['revenueType']=="Medication") {
          
          $period = $_POST['period'];
          $startDate = $_POST['startDate'];
          $endDate = $_POST['endDate'];
          $_SESSION['startDate'] = $startDate;
          $_SESSION['endDate'] = $endDate;
          $_SESSION['period'] = $period;
          $_SESSION['revenueType'] = $_POST['revenueType'];
          $period_amount_Medication = number_format(load_sum_drugs_report($period,$startDate,$endDate),2);

          $sub_total_Medication = "Sub Total";

          $consulation_rows = load_drugs_report($period,$startDate,$endDate);

         while($row = mysqli_fetch_array($consulation_rows)){

          $i = 0;
          ?>
            
                   <tr>  
                  
                           <td> <?php echo date("F jS, Y", strtotime($row['date_added'])); ?> </td>
                           <td> <?php echo $row['item'] ?> </td>
                           <td> <?php echo $row['total_amount'] ?> </td>

                   <tr>



                   <?php } } ?>
						 

					</tbody> 
          <thead class="no-border">
						<tr>
							
						<th style="width:30%;"><strong></strong></th>							
							<th style="width:30%;"><strong><?php
              
             
              echo $sub_total_Medication; 
              
              ?></strong></th>
							<th style="width:15%;"><strong><?php
              
              echo $period_amount_Medication;  ?></strong></th>				 
						</tr>
					</thead> 
				</table>


 
        

				</div>
			</div>

           
			
			
          </div>
<?php

          if(isset($_POST['load_records'])) { ?>
         <div><a class="btn btn-primary" href="../admin/reporting/acc_revenues" target="_blank">Generate report

         
         </a></div>      
      <?php } ?>
       
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
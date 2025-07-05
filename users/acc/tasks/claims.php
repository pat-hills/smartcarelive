<body>
	
	
	</script>  
		<?php
		
		global $connection;
		//include "../../functions/func_nhis.php";
	
		$patients_consulting_code = $_GET['code']; 
				if(!empty($patients_consulting_code)){
				
				//get patients id with consulting code
				$thePatientid = get_patients_id_and_dateseen($patients_consulting_code);
			 $_SESSION['patient_id'] = $thePatientid['patient_id'];
				 $_SESSION['dateSeen'] = $thePatientid['date_seen'];

				
				$theUsersdata  = getPatiensPersonalInfo4Claims($thePatientid['patient_id']);
				if(empty($theUsersdata)){header('location:patients.php');die();}
				$nhisdata  	   = getNHISinfo($thePatientid['patient_id']);
				if(empty($nhisdata)){header('location:patients.php');die();}
			 				
				}else{
				//no patient code available so redirect them from here
				header('location:patients.php');die();
				}
				
				global $totalMed,$TotalInvestAmount,$Selected_service_type,$TotalDiagnosisAmount,$Totalsum4Diagonisis,$afterQtyPlusPrice;
				$totalMed = 0;
				$TotalInvestAmount=0;
				$Selected_service_type=0;
				$TotalDiagnosisAmount=0;
				$Totalsum4Diagonisis = 0;
				$afterQtyPlusPrice = 0;
		?>	 
			 
			 
      <div class="col-sm-12 col-md-12" style="margin-top:50px;">
        <div class="block-flat">
          <div class="header">							
            <h5>Client Information</h5>
          </div>
          <div class="content">
            <div class="form-horizontal" role="form">
			
			
<div class="col-sm-12 col-md-12">
			<div class="col-sm-9 col-md-9">
              <div class="form-group">
			   <div class="col-sm-1 col-md-1" style="margin-right:-90px;"><span class="label label-primary pull-right">4</span></div>
              <label for="inputEmail3" class="col-sm-2 control-label">Surname</label>
              <div class="col-sm-9">
                <input type="text" disabled value="<?php if(!empty($theUsersdata['surname'])){echo strtoupper($theUsersdata['surname']);}  ?>"  class="form-control" id="" placeholder="">
              </div>
              </div>
              <div class="form-group">
			  <div class="col-sm-1 col-md-1" style="margin-right:-50px;"><span class="label label-primary pull-right">5</span></div>
             
              <label for="inputPassword3" class="col-sm-2 control-label">Other Names</label>
              <div class="col-sm-9" style="margin-left:2px;">
                <input disabled type="text" value="<?php if(!empty($theUsersdata['othernames'])){echo strtoupper($theUsersdata['othernames']);}  ?>" class="form-control" id="" placeholder="">
              </div>
              </div>
			  
			</div>
			
	<div class="col-sm-1 col-md-1"><span class="label label-primary pull-right">9</span>Gender</div>
	<?php if(!empty($theUsersdata['sex']) and $theUsersdata['sex'] == 'Male'){
	echo '<button type="button" class="btn btn-success"><i class="fa fa-male"></i>Male</button>
			';
	}elseif(!empty($theUsersdata['sex']) and $theUsersdata['sex'] == 'Female'){
	echo '<button type="button" class="btn btn-success"><i class="fa fa-female"></i>Female</button>';
	}  ?>
							 
</div>			
			  

<div class="col-sm-11 col-md-11">

		<div class="col-sm-7 col-md-7">	  
			   <div class="form-group">
			  <div class="col-sm-1 col-md-1" style="margin-right:-35px;"><span class="label label-primary pull-right">6</span></div>
             
              <label for="inputPassword3" class="col-sm-4 ontrol-label">Date of Birth</label>
              <div class="col-sm-6" style="margin-left:-25px;">
                <input disabled type="text" value="<?php if(!empty($theUsersdata['dob'])){echo date('d M Y',strtotime($theUsersdata['dob']));}  ?>" class="form-control" id="" placeholder="">
              </div>
              </div>
		</div>

<div class="col-sm-4 col-md-4" style="margin-left:-100px;margin-top:10px;">		

             		<label class="col-sm-1 control-label"><span class="label label-primary pull-right">7</span>Age</label>
           <div class="col-sm-5">
                <input disabled type="text" value="<?php if(!empty($theUsersdata['dob'])){echo calPatientAge(date('d-M-Y',strtotime($theUsersdata['dob'])));}  ?>"  class="form-control" id="" placeholder="">
              </div>      		
</div>		
<div class="col-sm-6 col-md-6" style="float:right;margin-right:-100px; margin-top:-30px;">		
<div class="col-sm-1 col-md-1" style="margin-right:-100px;"><span class="label label-primary pull-right">8</span></div>
             		<label class="col-sm-4 control-label">Member number</label>
           <div class="col-sm-6">
                <input disabled value="<?php if(!empty($nhisdata['membership_id'])){echo $nhisdata['membership_id'];} ?>" type="text" class="form-control" id="" placeholder="">
              </div>      		
</div>		  
			  
</div>		


<div class="col-sm-12 col-md-12" style="margin-bottom:50px;">

<div class="col-sm-7 col-md-7">		
<div class="col-sm-1 col-md-1" style="margin-right:-100px;"><span class="label label-primary pull-right">10</span></div>
             		<label class="col-sm-2 control-label">Hospital Record No</label>
           <div class="col-sm-7" style="margin-left:40px;">
                <input type="text" disabled value="<?php echo $_SESSION['patient_id'];  ?>" class="form-control" id="inputPassword3" placeholder="">
              </div>      		
</div>	

<div class="col-sm-7 col-md-7" style="float:right;margin-right:-70px;margin-top:-40px;">		
<div class="col-sm-1 col-md-1" style="margin-right:-20px;"><span class="label label-primary pull-right">11</span></div>
             		<label class="col-sm-2 control-label">Card Serial No</label>
           <div class="col-sm-7">
                <input type="text" disabled value="<?php if(!empty($nhisdata['serial_number'])){echo $nhisdata['serial_number'];} ?>" class="form-control" id="inputPassword3" placeholder="">
              </div>      		
</div>	


</div>
</div>
</div>

<hr>

<div class="row">
      <div class="col-sm-6 col-md-6">
        
		
		<?php  //$getAvaliableServices = getPatientsNHISservicedata($_SESSION["patient_id"]); 
               //new functions from new logic		
						$getAvaliableServices = 	getPatientsServicesInfo($_SESSION["patient_id"],$_SESSION['dateSeen']);
						//print_r($getAvaliableServices);die();
		if(!empty($getAvaliableServices)){ ?>
		
		<div class="header">	
<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">12</span></div>
			<h4>Type of Services </h4>
          </div>
          <div class="content">

		  
<form action="tasks/add_services.php" id='getBaseUrl' method="post">		  
           <div class="form-group">
               <h5>(a) Select only one</h5>
                <div class="col-sm-5">
				
		<?php if($getAvaliableServices['service_type'] == 'Outpatients'){ 
		$Selected_service_type = 1;
		?>
		 <label class="radio-inline"> <input   value="Outpatients" checked="true" type="radio"  name="servicea" class="icheck">&nbsp; Outpatients</label> 
                  <label class="radio-inline"> <input disabled value="in-patient" type="radio"  name="servicea" class="icheck">&nbsp;&nbsp;in-patient</label> 
                  <label class="radio-inline" id="servicea" style="margin-top:20px;margin-left:-4px;"> <input disabled type="radio" name="servicea" value="Diagnostic" class="icheck">&nbsp;&nbsp;Diagnostic</label> 
				
		<?php }elseif($getAvaliableServices['service_type'] == 'in-patient'){
	$Selected_service_type = 2;
		?>
		
				 <label class="radio-inline"> <input  disabled value="Outpatients" type="radio"  name="servicea" class="icheck">&nbsp; Outpatients</label> 
                  <label class="radio-inline"> <input  checked="true" value="in-patient" type="radio"  name="servicea" class="icheck">&nbsp;&nbsp;in-patient</label> 
                  <label class="radio-inline" id="servicea" style="margin-top:20px;margin-left:-4px;"> <input disabled type="radio" name="servicea" value="Diagnostic" class="icheck">&nbsp;&nbsp;Diagnostic</label> 
					
		<?php }elseif($getAvaliableServices['service_type'] == 'Diagnostic'){ 
		$Selected_service_type = 3;
		?>
		<label class="radio-inline"> <input value="Outpatients" disabled type="radio"  name="servicea" class="icheck">&nbsp; Outpatients</label> 
                  <label class="radio-inline"> <input  value="in-patient" type="radio"  name="servicea" class="icheck">&nbsp;&nbsp;in-patient</label> 
                  <label class="radio-inline" id="servicea" checked="true" style="margin-top:20px;margin-left:-4px;">
				  <input disabled  type="radio" name="servicea" value="Diagnostic" class="icheck">&nbsp;&nbsp;Diagnostic</label> 
				
		<?php }  ?>		 
                  
				
				
				  <div class="col-sm-7" style="float:right;margin-right:-180px;margin-top:-20;">
				  <?php if($getAvaliableServices['pharmacy'] ==1){ ?>
				  <label class="radio-inline"> 
				  <input type="checkbox" checked="true" value="1" name="rad1" id="pharm" class="icheck">&nbsp;Pharmacy</label> 
				  <?php }elseif($getAvaliableServices['pharmacy'] ==0){ ?>
				   <label class="radio-inline"> 
				  <input type="checkbox" disabled value="0" name="rad1" id="pharm" class="icheck">&nbsp;Pharmacy</label> 
				  
				 <?php } ?>
                 </div>
				   
                </div>
            </div>
		
        </div>
	
	
<div class="content" style="margin-top:100px;">
	 
	  <div class="form-group">
	  <div class="header"></div>
<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">13</span></div>
	  
               <h5>(b)</h5>
			    <?php if($getAvaliableServices['service_package'] == 'all-inclusive'){ ?>
			 <div class="col-sm-10">
			 
	<label class="radio-inline col-sm-8"> <input checked="true" value="All Inclusive" type="radio" id="serviceb" name="serviceb" class="icheck">&nbsp; All Inclusive</label>
	
	<label class="radio-inline col-sm-8" style="float:right;margin-right:-50px;margin-top:-20px;"> <input disabled type="radio"  name="serviceb" class="icheck" value="Unbundled">&nbsp;Unbundled</label>			 
		   </div>
		   <?php }elseif($getAvaliableServices['service_package'] == 'Unbundled'){ ?>
		   <div class="col-sm-10">
			 
	<label class="radio-inline col-sm-8"> <input value="All Inclusive" type="radio" id="serviceb" name="serviceb" class="icheck">&nbsp; All Inclusive</label>
	
	<label class="radio-inline col-sm-8" style="float:right;margin-right:-50px;margin-top:-20px;"> <input type="radio" disabled name="serviceb" class="icheck" checked="true" value="Unbundled">&nbsp;Unbundled</label>			 
		   </div>
		   
		   <?php } ?>
		   
			</div>	
			
	<input type="hidden" id="service_code" value="<?php echo $getAvaliableServices['service_code']; ?>">		
		<!--<button type="button" class="btn btn-info" id="EditServices" style="margin-top:60px;float:right;display:;"><i class="fa fa-pencil-square-o"></i>Edit</button> --->
		
		
		
		
		
		
	<?php }else{ ?>
		
		
          <div class="header">	
<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">12</span></div>
			<h4>Type of Services </h4>
          </div>
          <div class="content">

		  
<form action="tasks/add_services.php" id='getBaseUrl' method="post">		  
           <div class="form-group">
               <h5>(a) Select only one</h5>
                <div class="col-sm-6">
				 
                  <label style="float:right;margin-right:-40px;" class="radio-inline"> <input value="Outpatients" type="radio"  name="servicea" class="icheck">&nbsp; Outpatients</label> 
                  <label style="float:left;margin-left:-40px;" class="radio-inline"> <input value="in-patient" type="radio"  name="servicea" class="icheck">&nbsp;&nbsp;in-patient</label> 
                  <label class="radio-inline" id="servicea" style="margin-top:10px;margin-left:-4px;"> 
				  <input type="radio" name="servicea" value="Diagnostic" class="icheck">&nbsp;&nbsp;Diagnostic</label> 
				
				  <div class="col-sm-7" style="float:right;margin-right:-100px;margin-top:-30px;">
				  <label class="radio-inline"> 
				  <input  type="checkbox" value="1" name="rad1" id="pharm" class="icheck">&nbsp;Pharmacy</label> 
                 </div>
				   
                </div>
            </div>
		
        </div>
	
	
<div class="content" style="margin-top:100px;">
	 
	  <div class="form-group">
	  <div class="header"></div>
<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">13</span></div>
	  
               <h5>(b)</h5>
			 <div class="col-sm-10">
	<label class="radio-inline col-sm-8"> <input value="All Inclusive" type="radio" id="serviceb" name="serviceb" class="icheck">&nbsp; All Inclusive</label>
	
	<label class="radio-inline col-sm-8" style="float:right;margin-right:-50px;margin-top:-20px;"> <input type="radio"  name="serviceb" class="icheck" value="Unbundled">&nbsp;Unbundled</label>			 
		   </div>
			</div>	
			
			
			
			
			
			
<div class="serviceBTN">
<button type="button" class="btn btn-success" id="saveServices" style="margin-top:60px;float:right;"><i class="fa fa-floppy-o">&nbsp;Save</i></button>
<button type="button" class="btn btn-info" id="EditServices" style="margin-top:60px;float:right;display:none;"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>
	</div>	
	<?php } ?>
				

		
</div>
</form>




<?php
		//$dataOnOutcome = get_NHIS_outcome($_SESSION['patient_id']);
		if(empty($getAvaliableServices)){
?>

<div class="header" style="margin-top:150px;">	
<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">14</span></div>
			<h4>Outcome </h4>
          </div>
          <div class="content">

           <div class="form-group">
               
                <div class="col-sm-8">
				 
                  <label class="radio-inline"> <input value="Discharged" type="radio"  name="outcome" class="icheck">&nbsp; Discharged</label> 
                  <label class="radio-inline"> <input value="Died" type="radio" name="outcome" class="icheck">&nbsp;&nbsp;Died</label> 
                  <label class="radio-inline" style="margin-top:20px;margin-left:-4px;font-size:10px;"> 
				  <input type="radio" name="outcome" value="Absconded/Discharged" class="icheck">&nbsp;Absconded/Discharged against medical advice</label> 
				
				  <div class="col-sm-10" style="float:right;margin-right:-170px;margin-top:-65px;">
				  <label class="radio-inline"> 
				  <input type="radio" name="outcome" value="Transferred out" class="icheck">&nbsp;Transferred out</label> 
                 </div>
				   
                </div>
            </div>
			
<!--<div class="OutcomeBTN">
<button type="button" class="btn btn-success" id="saveoutcome" style="margin-top:60px;float:right;"><i class="fa fa-floppy-o">&nbsp;Save</i></button>
<button type="button" class="btn btn-info Editoutcome"  style="margin-top:60px;float:right;display:none;"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>
	</div>	---->		
			
        </div>

<?php }else{ ?>



<div class="header" style="margin-top:150px;">	
<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">14</span></div>
			<h4>Outcome </h4>
          </div>
          <div class="content">

           <div class="form-group">
               
                <div class="col-sm-8">
				 <?php  if($getAvaliableServices['outcome'] =="Discharged"){ ?>
                  <label class="radio-inline"> <input value="Discharged" type="radio"  checked="true" name="outcome" class="icheck">&nbsp; Discharged</label> 
                  <label class="radio-inline"> <input value="Died" type="radio" name="outcome" class="icheck">&nbsp;&nbsp;Died</label> 
                  <label class="radio-inline" style="margin-top:20px;margin-left:-4px;font-size:10px;"> 
				  <input disabled type="radio" name="outcome" value="Absconded/Discharged" class="icheck">&nbsp;Absconded/Discharged against medical advice</label> 
				
				  <div class="col-sm-10" style="float:right;margin-right:-170px;margin-top:-65px;">
				  <label class="radio-inline"> 
				  <input disabled type="radio" name="outcome" value="Transferred out" class="icheck">&nbsp;Transferred out</label> 
                 </div>
				 <?php }elseif($getAvaliableServices['outcome'] =="Died"){ ?>
				 <label class="radio-inline"> <input disabled value="Discharged" type="radio"  name="outcome" class="icheck">&nbsp; Discharged</label> 
                  <label class="radio-inline"> <input checked="true"  value="Died" type="radio" name="outcome" class="icheck">&nbsp;&nbsp;Died</label> 
                  <label class="radio-inline" style="margin-top:20px;margin-left:-4px;font-size:10px;"> 
				  <input type="radio" name="outcome" disabled value="Absconded/Discharged" class="icheck">&nbsp;Absconded/Discharged against medical advice</label> 
				
				  <div class="col-sm-10" style="float:right;margin-right:-170px;margin-top:-65px;">
				  <label class="radio-inline"> 
				  <input type="radio" name="outcome" value="Transferred out" class="icheck">&nbsp;Transferred out</label> 
                 </div>
				 
				 
			
				
				<?php }elseif($getAvaliableServices['outcome'] =="Absconded/Discharged"){ ?>
				<label class="radio-inline"> <input value="Discharged" type="radio"  name="outcome" class="icheck">&nbsp; Discharged</label> 
                  <label class="radio-inline"> <input  value="Died" type="radio" name="outcome" class="icheck">&nbsp;&nbsp;Died</label> 
                  <label class="radio-inline" style="margin-top:20px;margin-left:-4px;font-size:10px;"> <input disabled type="radio" name="outcome" checked="true" value="Absconded/Discharged" class="icheck">&nbsp;Absconded/Discharged against medical advice</label> 
				
				  <div class="col-sm-10" style="float:right;margin-right:-170px;margin-top:-65px;">
				  <label class="radio-inline"> 
				  <input type="radio" name="outcome" value="Transferred out" class="icheck">&nbsp;Transferred out</label> 
                 </div>
				
<?php }elseif($getAvaliableServices['outcome'] =="Transferred out"){ ?>
<label class="radio-inline"> <input value="Discharged" type="radio" disabled  name="outcome" class="icheck">&nbsp; Discharged</label> 
                  <label class="radio-inline"> <input  disabled value="Died" type="radio" name="outcome" class="icheck">&nbsp;&nbsp;Died</label> 
                  <label class="radio-inline" style="margin-top:20px;margin-left:-4px;font-size:10px;"> 
				  <input type="radio" name="outcome" disabled  value="Absconded/Discharged" class="icheck">&nbsp;Absconded/Discharged against medical advice</label> 
				
				  <div class="col-sm-10" style="float:right;margin-right:-170px;margin-top:-65px;">
				  <label class="radio-inline"> 
				  <input type="radio" checked="true" disabled name="outcome" value="Transferred out" class="icheck">&nbsp;Transferred out</label> 
                 </div>
			<?php } ?> 	 
                </div>
            </div>
			
<!--<div class="OutcomeBTN">
<input type="hidden" id="outcome_code" value="<?php //echo $getAvaliableServices['outcome_code']; ?>">
<button type="button" class="btn btn-info Editoutcome" style="margin-top:60px;float:right;display:;"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>
	</div>	----->		
			
        </div>





<?php } ?>




	</div>
      
	  
	   <div class="col-sm-6 col-md-6" style="margin-top:20px;border-left:solid #000000 1px;">
       
          <div class="header">
<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">17</span></div>
			  
            <h5>Date of Services Provision</h5>
          </div>
          <div class="content">
		  
		  <?php //$getProvisionDate = get_nhis_dateProvision($_SESSION['patient_id']);
	
			if(empty($getAvaliableServices)){ ?>
			
			   <div class="form-horizontal" role="form">
              
			
			  
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label">1st Visit/Admission</label>
			  <div class="col-sm-8">
              <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" id="v1" size="16" type="text" value="" readonly>
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
			  </div> 
            </div>
			
			
			
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label">2nd Visit/Discharge</label>
              <div class="col-sm-8">
                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="16" id="v2" type="text" value="" readonly>
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
				
				</div>
            </div>
			
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label">3rd Visit</label>
              <div class="col-sm-8">
                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="16" id="v3" type="text" value="" readonly>
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
				</div>
            </div>
			
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label  ">4th Visit</label>
              <div class="col-sm-8">
                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="16" id="v4" type="text" value="" readonly>
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div> </div>
            </div>
			
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label">Duration of Spell (days)</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="duOfsp" placeholder="">
              </div>
            </div>
              
            
              
			  
			  
            </div>
						
<!---<div class="serviceBTN">
<button type="button" class="btn btn-success" id="saveDateProvision" style="margin-top:60px;float:right;"><i class="fa fa-floppy-o">&nbsp;Save</i></button>
<button type="button" class="btn btn-info" id="editDateProvision" style="margin-top:60px;float:right;display:none;"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>
</div> ------>
			
			
			
			
			<?php }else{ ?>
			
			
			   <div class="form-horizontal" role="form">
              
			
			  
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label">1st Visit/Admission</label>
			  <div class="col-sm-8">
              <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" id="v1" size="16" type="text" value="<?php //echo $getAvaliableServices['visit1']; ?>" >
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
			  </div> 
            </div>
			
			
			
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label">2nd Visit/Discharge</label>
              <div class="col-sm-8">
                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="16" id="v2" type="text" value="<?php //echo $getAvaliableServices['visit2']; ?> ">
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
				
				</div>
            </div>
			
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label">3rd Visit</label>
              <div class="col-sm-8">
                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="16" id="v3" type="text" value="<?php //echo $getAvaliableServices['visit3']; ?>">
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>
				</div>
            </div>
			
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label  ">4th Visit</label>
              <div class="col-sm-8">
                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input class="form-control" size="16" id="v4" type="text" value="<?php //echo $getAvaliableServices['visit4']; ?>">
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div> </div>
            </div>
			
			<div class="form-group">
			  <label for="inputEmail3" class="col-sm-4 control-label">Duration of Spell (days)</label>
              <div class="col-sm-4">
          <input type="text" class="form-control" id="duOfsp" placeholder="" value="<?php //echo $getProvisionDate['durationOfSpell']; ?>" >
              </div>
            </div>
              
            <input type="hidden" id="visitcode" value="<?php //echo $getProvisionDate['visit_code']; ?>">
              
			  
			  
            </div>
			
<!---<button type="button" class="btn btn-info" id="editDateProvision" style="margin-top:60px;float:right;"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button> ----->
			
			<?php } ?> 
		  
         

			
			
          </div>
        				
      </div>
    </div>

	<div class="header" style="margin-top:60px;">
	<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">15</span></div>
			  
    <h5>Type of Attendance</h5>
 
	</div>
	<?php  //$getPatientsAttendance = get_Patients_nhis_attendance($_SESSION['patient_id']); 
	if(empty($getAvaliableServices['attendance_type'])){ ?>
	
		 <div class="content" style="margin-bottom:40px;margin-bottom:150px;">
	
	
	<label class="radio-inline"> <input type="radio" value="Chronic" name="Attendance" class="icheck">&nbsp; Chronic Follow-up</label> 
    <label class="radio-inline"> <input type="radio" value="Emergency" name="Attendance" class="icheck">&nbsp;&nbsp;Emergency/Acute episode</label> 
                   
				
	<div class="col-sm-7" style="float:right;margin-right:-130px;margin-top:-20px;">
		<div class="form-group">
		<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">16</span></div>
		
			  <label for="inputEmail3" class="col-sm-3 control-label">Speciality Code</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="" id="Specialitycode">
              </div>
        </div>		
				
   </div>
	
	
<!--<div class="serviceBTN">
<button type="button" class="btn btn-success" id="saveAttendance" style="margin-top:60px;float:left;"><i class="fa fa-floppy-o">&nbsp;Save</i></button>
<button type="button" class="btn btn-info" id="EditAttendance" style="margin-top:60px;float:left;display:none;"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>
</div>	----->
	
	
	
	 </div>
	
	
	
	
	<?php }else{ ?>
	
	
	
	
	 <div class="content" style="margin-bottom:40px;margin-bottom:150px;">
	<?php if($getAvaliableServices['attendance_type'] == 'chronic-follow-up' ){ ?>
	
	<label class="radio-inline"> <input type="radio" checked="true" value="Chronic" name="Attendance" class="icheck">&nbsp; Chronic Follow-up</label> 
	
	
    <label class="radio-inline"> <input disabled type="radio" value="Emergency" name="Attendance" class="icheck">&nbsp;&nbsp;Emergency/Acute episode</label> 
                   
				
	<div class="col-sm-7" style="float:right;margin-right:-130px;margin-top:-20px;">
		<div class="form-group">
		<div class="col-sm-1 col-md-1" style="margin-right:-10px;">
<span class="label label-primary pull-right">16</span></div>
		
			  <label for="inputEmail3" class="col-sm-3 control-label">Speciality Code</label>
              <div class="col-sm-4">
                <input disabled type="text" value="<?php echo $getAvaliableServices['Speciality_Code']; ?>" class="form-control" placeholder="" id="Specialitycode">
              </div>
        </div>		
				
   </div>
   <?php }elseif($getAvaliableServices['attendance_type'] == 'Emergency/Acute-episode' ){ ?>
   <label class="radio-inline"> <input type="radio" disabled  value="Chronic" name="Attendance" class="icheck">&nbsp; Chronic Follow-up</label> 
	
	
    <label class="radio-inline"> <input type="radio" checked="true" value="Emergency" name="Attendance" class="icheck">&nbsp;&nbsp;Emergency/Acute episode</label> 
                   
				
	<div class="col-sm-7" style="float:right;margin-right:-130px;margin-top:-20px;">
		<div class="form-group">
		<div class="col-sm-1 col-md-1" style="margin-right:-10px;">
<span class="label label-primary pull-right">16</span></div>
		
			  <label for="inputEmail3" class="col-sm-3 control-label">Speciality Code</label>
              <div class="col-sm-4">
                <input type="text" disabled value="<?php echo $getAvaliableServices['Speciality_Code']; ?>" class="form-control" placeholder="" id="Specialitycode">
              </div>
        </div>		
				
   </div>
   
   <?php } ?>
	
	
<!---<div class="serviceBTN">
<input type="hidden" id="attendance_code" value="<?php //echo $getPatientsAttendance['attendance_code']; ?>" >
<button type="button" class="btn btn-info" id="EditAttendance" style="margin-top:60px;float:left;"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>
</div>	----->
	
	
	
	 </div>
	 <?php } ?>
		<div class="header"></div>
	
	
	<div class="" style="margin-top:50px;">
	<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">20</span></div>
			  
    <h6><strong>PROCEDURE(S)(to be filled-in by health care providers who have provided out or in-patient services)</strong></h5>
 
	</div>
	 <div class="content" >
	 
	 <div class="form-group" style="margin-top:-10px;">
			   <div class="col-sm-1 col-md-1" style="margin-top:0px;"><span class="label label-primary pull-right">18</span></div>
              <label for="inputEmail3" class="col-sm-2 control-label">Physician/Clinician Name</label>
              <div class="col-sm-3" style="float:left;margin-left:0px;">
                <input id="PaulAutoAjustMike" type="text" class="form-control" id="inputEmail5" placeholder="">
              </div>
    </div>
	
	<div class="form-group" style="float:right;margin-right:-50px;margin-top:-5px;">
			   <div class="col-sm-1 col-md-1" style="margin-right:0px;"><span class="label label-primary pull-right">19</span></div>
              <label for="inputEmail3" class="col-sm-4 control-label">Physician/Clinician ID</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail5" placeholder="">
              </div>
    </div>
	
	</div>
	 
	<div class="row">
      <div class="col-sm-7 col-md-7">
      
          
          <div class="content">

         <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td></td>
		<td>
		Description
		</td>
	</tr>
	<tr>
		<td>1</td>
		<td><div class="col-sm-10">
               
              </div>
		</td>
	</tr>
	
	
</table>

		  
		  
		  
		  
		  
		  
          
          </div>
        				
      </div>
      
      <div class="col-sm-5 col-md-5">
      
          
          <div class="content">
          
		 <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Date</td>
		<td>G-DRG</td>
	</tr>
	<tr>
		<td>
     
        </td>
		<td>
		
       </td>
	</tr>
	
</table>


		  
		  
		  
		  
		  
          </div>
        </div>				
      </div>
 
	 
	 <div class="header" style="margin-top:50px;">
	<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">21</span></div>
			  
    <h5>DIAGNOSIS(ES)(to be filled-in by health care providers who have provided out or in-patient services)</h5>
 
	</div>
	
<div class="row">
      <div class="col-sm-7 col-md-7">
      
          
          <div class="content">

         <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td></td>
		<td>
		Description
		</td>
	</tr>

	
	<?php
$nhisState = 1;
$diagNumbering = 1;
$vavaava = "SELECT diagnosis FROM tbl_diagnosis WHERE patient_id='".$_SESSION['patient_id']."'
AND date_added='".$_SESSION['dateSeen']."'

";
$theDiag  = mysqli_query($connection,$vavaava);
				
if(mysqli_affected_rows($connection) >0){
while( $getTheDiag = mysqli_fetch_array($theDiag))
{

						$getThediaCodes = explode(',',$getTheDiag['diagnosis']);
								foreach ($getThediaCodes as $diagonisisCode) {

			$aaaaa ="SELECT name FROM tbl_diagnosis_list WHERE diagnosis_code='".$diagonisisCode."' 
			AND nhis='".$nhisState."'	
			";

$theName = mysqli_query($connection,$aaaaa);
	   
	   if(mysqli_affected_rows($connection) >0){
	   while($getName = mysqli_fetch_array($theName)){
	  ?>
	  	<tr>
	<td><?php echo $diagNumbering; ?></td>
		<td><div class="col-sm-10">
		    <?php echo $getName['name']; ?>
            </div>
	</td>
		</tr>
<?php $diagNumbering++; } } } } } ?>		
	
	
	
	
	
</table>

		  
		  
		  
		  
		  
		  
          
          </div>
        				
      </div>
      
      <div class="col-sm-5 col-md-5">
      
          
          <div class="content">
          
		 <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>ICD-10</td>
		<td>G-DRG</td>
		
	</tr>
	
	
		<?php
$nhisState = 1;
$diagNumbering = 1;
$va ="SELECT diagnosis FROM tbl_diagnosis WHERE patient_id='".$_SESSION['patient_id']."'
AND date_added='".$_SESSION['dateSeen']."'

";
$theDiag  = mysqli_query($connection,$va);
				
if(mysqli_affected_rows($connection) >0){
while( $getTheDiag = mysqli_fetch_array($theDiag))
{


						$getThediaCodes = explode(',',$getTheDiag['diagnosis']);
								foreach ($getThediaCodes as $diagonisisCode) {
						$vava = "SELECT gdrg,icd10,tarrifs FROM tbl_diagnosis_list WHERE diagnosis_code='".$diagonisisCode."' 
						AND nhis='".$nhisState."'	
						";
								
$theName = mysqli_query($connection,$vava) ;
	 
	   if(mysqli_affected_rows($connection) >0){
	   while($getOtherInfo = mysqli_fetch_array($theName)){
	
	   $Totalsum4Diagonisis += $getOtherInfo['tarrifs'];
	  ?>
	  <tr>
	<td><?php echo $getOtherInfo['gdrg']; ?></td>
	<td><?php echo $getOtherInfo['icd10']; ?></td>
	  </tr> 
	<?php $diagNumbering++; }}}} }
	$TotalDiagnosisAmount = $Totalsum4Diagonisis;
	?>
	
	
	
	
</table>
	  
		  
          </div>
        </div>				
      </div>	
	


	
	
	
	
	
	 <div class="header" style="margin-top:50px;">
	<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">22</span></div>
			  
    <h5>INVESTIGATIONS(to be filled-in by health care providers providing diagnostics services only)</h5>
 
	</div>
	
<div class="row">
      <div class="col-sm-5 col-md-5">
      
          
          <div class="content">

         <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td></td>
		<td>
		Description
		</td>
	</tr>
	
	
	<?php 
	$invNumbering = 1;
   $nhis = 1;
   $aaa = "SELECT requested_date,requested_test 
   FROM tbl_req_investigation
   WHERE patient_id='".$_SESSION['patient_id']."'
   AND requested_date='".$_SESSION['dateSeen']."'
  ";
	$patientsInvestData =  mysqli_query($connection,$aaa);
									 
			if(mysqli_affected_rows($connection) >0){ 
			while( $thedata = mysqli_fetch_array($patientsInvestData) ){
			//remove the comma from the requested_test
			
			        //$investigationcode = removeTheCommasFromTheCode($thedata['requested_test']);
					
								$getTheArrayOfCodes = explode(',', $thedata['requested_test']);
								foreach ($getTheArrayOfCodes as $thecode) {

									$two = "SELECT Investigations,Tarriffs,gdrgcode 
									FROM tbl_investigations 
									WHERE investigation_code='".$thecode."'
									AND nhis='".$nhis."' 												 
								   
								   ";
								
					$theInfoOfInvs = mysqli_query($connection,$two);
								if(mysqli_affected_rows($connection) > 0){
								while($investigation_info = mysqli_fetch_array($theInfoOfInvs))
								{ ?>
		<tr>						
				<td><?php echo $invNumbering; ?></td>
		<td><div class="col-sm-10" id="PaulAutoAjustMike">
                <?php echo $investigation_info['Investigations']; ?>
				</div>
		</td>
		</tr>
		<?php  $invNumbering ++; } }	} } } ?>
	
		
	

	
</table>

		 
          </div>
        				
      </div>
      
      <div class="col-sm-7 col-md-7">
      
          
          <div class="content">
          
		 <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Unit Price</td>
		<td>Date</td>
		<td>G-DRG</td>
	</tr>
	
	<?php 
	$invNumbering = 1;
	$nhis = 1;
	$getTotalofInvestigation = 0;
	$aa_query = "SELECT tbl_req_investigation.requested_date,tbl_req_investigation.requested_test,
	investigation_payemnt2_cashier.request_code
	FROM tbl_req_investigation
	JOIN investigation_payemnt2_cashier
	ON investigation_payemnt2_cashier.request_code = tbl_req_investigation.request_code
	WHERE investigation_payemnt2_cashier.patient_id='".$_SESSION['patient_id']."'
	AND tbl_req_investigation.requested_date='".$_SESSION['dateSeen']."'
   ";
	$patientsInvestData =  mysqli_query($connection,$aa_query);
								 
			if(mysqli_affected_rows($connection) >0){ 
			while( $thedata = mysqli_fetch_array($patientsInvestData) ){
			//remove the comma from the requested_test
			        //$investigationcode = removeTheCommasFromTheCode($thedata['requested_test']);
				
				
								$getTheArrayOfCodes = explode(',', $thedata['requested_test']);
								foreach ($getTheArrayOfCodes as $thecode) {
				
					$semi_query = "SELECT Investigations,Tarriffs,gdrgcode
					FROM tbl_investigations 
					WHERE investigation_code='".$thecode."' 
					AND nhis='".$nhis."' 
				   
				   ";
					$theInfoOfInvs = mysqli_query($connection,$semi_query);
								if(mysqli_affected_rows($connection) > 0){
								while($investigation_info = mysqli_fetch_array($theInfoOfInvs))
								{ ?>
		
<tr> 
		<td>
		<?php  echo $investigation_info['Tarriffs']; ?>	
       </td>
		<td>
		<?php  echo $thedata['requested_date'];  $getTotalofInvestigation += $investigation_info['Tarriffs']; ?>
        </td>
		<td>
				<?php  echo $investigation_info['gdrgcode']; ?>		
		</td>
	   		   
</tr>
	<?php $invNumbering++; } }	} } }
		 $TotalInvestAmount = $getTotalofInvestigation;
		?>
	  
</table>

          </div>
        </div>				
      </div>	
	

	 <div class="header" style="margin-top:50px;">
	<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">23</span></div>
			  
    <h5>MEDICINES(to be filled-in by health care providers who have dispensed medicines)</h5>
 
	</div>
	
<div class="row">
      <div class="col-sm-5 col-md-5">
     <div class="content">

         <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	 <tr>
		<td></td>
		<td>
		Description
		</td>
	</tr>
	
	
	<?php //product_code,price,gdrg
$nhis_state = 1;
$numbering = 1;
$a_query = "SELECT * FROM  despensed_drugs
WHERE patient_id='".$_SESSION['patient_id']."' 
AND date_added='".$_SESSION['dateSeen']."'
";
$theDrugCodes  = mysqli_query($connection,$a_query);
						
if(mysqli_affected_rows($connection) >0){

	while($theDrugsdata = mysqli_fetch_array($theDrugCodes)){

		$b_query ="SELECT Name
		FROM tbl_drug_list WHERE drug_code='".$theDrugsdata['drug_code']."' 
		AND NHIS='".$nhis_state."' ";
	
 $theNames  =  mysqli_query($connection,$b_query);
			 if(mysql_affected_rows($connection) >0){
			 while($getName = mysqli_fetch_array($theNames)){
	?>
	       
  <tr>    
	
	
		<td><?php echo $numbering; ?></td>
		<td><div class="col-sm-10" id="PaulAutoAjustMike">
                <?php  echo $getName['Name']; ?>
			</div>
		</td>
		
</tr>		
		
<?php $numbering++; } } }} ?>		
	
	
</table>

		 </div>
        				
      </div>
	  
      
      <div class="col-sm-7 col-md-7">
      
          
          <div class="content">
          
		 <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Price</td>
		<td>QTY</td>
		<td>Total cost</td>
		<td>Code</td>
	</tr>
	
	
	
	<?php //product_code,price,
	

$nhis_state = 1;
$numbering = 1;
$the_query = "SELECT * FROM  despensed_drugs
WHERE patient_id='".$_SESSION['patient_id']."' 
AND date_added='".$_SESSION['dateSeen']."'
";
$theDrugCodes  = mysqli_query($connection,$the_query);
						
if(mysqli_affected_rows($connection) >0){

	while($theDrugsdata = mysqli_fetch_array($theDrugCodes)){

		$second_query = "SELECT Name,price,gdrg
		FROM tbl_drug_list WHERE drug_code='".$theDrugsdata['drug_code']."' 
		AND NHIS='".$nhis_state."' ";
	
 $theNames  =  mysqli_query($connection,$second_query);
			 if(mysqli_affected_rows($connection) >0){
			 while($getName = mysqli_fetch_array($theNames)){
	?>	
<tr>
		<td>
      <?php echo $getName['price']; ?>
        </td>
		<td>
      <?php  echo $theDrugsdata['quantity'] ?>
        </td>
		<td><?php echo $qty_plu_price  = $theDrugsdata['quantity'] * $getName['price']; ?></td>
		<?php  $afterQtyPlusPrice += $qty_plu_price ?>
		<td>
       <?php  echo $getName['gdrg'] ?>
        </td>
</tr>		
		 <?php }} }} ?>
	
	<?php  $totalForMEDICINE = $afterQtyPlusPrice  ?>

</table>

          </div>
		 
        </div>				
      </div>	
	

	
	
	<div class="header" style="margin-top:50px;">
	<div class="col-sm-1 col-md-1" style="margin-right:-10px;"><span class="label label-primary pull-right">24</span></div>
			  
    <h5>CLIENT CLAIM SUMMARY</h5>
 
	</div>
	
<div class="row">
      	
	<div class="col-sm-7 col-md-7">
      
          
          <div class="content">
          
		 <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Types of services</td>
		<td>G-DRG/code</td>
		<td>Tariff Amount</td>
	
	</tr>
	<tr>
		
		<?php  
		
if($Selected_service_type == 1){
	$InpatientTarrif ="";
	$InpatientDgrgcode ='';//not yet known
	$Outpatienttarrif = $TotalDiagnosisAmount;//for only diagnosis
	$OutpatientDgrgcode ='';//not yet known
	
	}elseif($Selected_service_type = 2){
	 $InpatientTarrif =$TotalDiagnosisAmount;//for only diagnosis
	
	$InpatientDgrgcode ='';//not yet known
	$Outpatienttarrif = "";
	$OutpatientDgrgcode ='';//not yet known
	
	}elseif($Selected_service_type = 3){
	}		
		
		
		?>
		
		
		
		
		<td>
In-Patient      
	  </td>
		<td>
     
        </td>
		<td>
		<strong class="badge badge-primary" style="color:#f8f8f8;"><?php echo $InpatientTarrif; ?></strong>
       </td>
	</tr>
	<tr>
	
<td>Out-Patient</td>
	<td>
    </td>
			<strong class="badge badge-primary" style="color:#f8f8f8;"><?php echo $Outpatienttarrif; ?></strong>
    </td>
	</tr>
	<tr>
	
<td>Investigations  </td>
	<td></td>
		<td><strong class="badge badge-primary" style="color:#f8f8f8;"><?php echo $TotalInvestAmount; ?></strong> </td>
	</tr>
	
	<tr>
	
		<td>Pharmacy</td>
		<td> </td>
	<td><strong class="badge badge-primary" style="color:#f8f8f8;"><?php echo $totalForMEDICINE; ?></strong></td>
	</tr>
	<tr>
	<td>TOTAL  </td>
	<td>  </td>
		
		<td><strong class="badge badge-success" style="color:#f8f8f8;"><?php 
		echo $sumTotal  = $totalForMEDICINE + $InpatientTarrif + $Outpatienttarrif + $TotalInvestAmount; ?></strong></td>
	
	</tr>
</table>

          </div>
        </div>	

		
		
		
<div class="col-sm-4 col-md-4">
      <div class="content">
	  
	  <div class="form-group">
			   
               <div class="col-sm-9">
			   <p style="margin-top:10px;">Name</p>
                <input type="text" class="form-control " disabled value="<?php echo getHealthInsuranceOfficersName($_SESSION['uid']); ?>"  id="PaulAutoAjustMike" placeholder="">
              </div>
			  
      </div>
	<div class="form-group">
			  
              <div class="col-sm-9">
			  <p style="margin-top:10px;">Signature</p>
                <input type="text" class="form-control" id="inputEmail5" placeholder="">
				(Health Facility Insurance Officer)
              </div>
    </div>
	  
	  
	  
		  </div>
</div>		  
</div>


	
	 
	 <div class="col-sm-6 col-md-6" style="float:right;margin-top:40px;">		
	<a href="patients.php" class="btn btn-success"><i class="fa fa-arrow-circle-left"></i>Back</a>
	
	<?php //if(!empty($sumTotal)){ ?>
	
<button data-toggle="modal" data-target="#mod-warning" type="button" class="btn btn-warning"><i class="fa fa-print"></i> Print</button>
						<?php //} ?>
	 </div>		

    </div>
</div>


<div class="modal fade" id="mod-warning" tabindex="-1" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<div class="text-center">
											<div class="i-circle danger"><i class="fa fa-warning"></i></div>
											<h3>Warning!</h3>
							<p><h4>Make sure you are done working on this claim form before
							clicking the print button.</h4></p>
										</div>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<a target="_blank" href="print_claim.php?code=<?php echo $_GET['code']; ?>" class="btn btn-success"><i class="fa fa-print"></i>Print</a></div>
								  </div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
 </div><!-- /.modal -->



  
     
<body>
<?php 

//require '../../functions/func_cashier.php';
global $theamount,$drugTranscode;
$theamount  =0;
$drugTranscode = 0;
 ?>
<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Cashier</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Cashier</li>
      </ol>
    </div>
	
	<?php if(!empty($_GET['message'])){?>
	<div class="alert alert-danger alert-white rounded" style="width:70%;margin-top:20px;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="icon"><i class="fa fa-info-circle"></i></div>
								<strong>Info!</strong>&nbsp;<?php echo $_GET['message'];?>
	</div>
	<?php } ?>
	
	
	
    <div class="cl-mcont"> 
	<div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          
          <div class="content">
              <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details.php" style="border-radius: 0px;">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <label class="col-sm-3 control-label">Patient (ID)</label>

                    <div class="col-sm-3">
                      <!--<select class="select2" name="get_details">
                         <option value="">-- Type ID here --</option>
                         <optgroup label="ID">
                        <?php
                        //getting all patients ID in option field labelled ID
                        //get_all_id();
                        ?>
                         </optgroup>
                        <!<optgroup label="NATIONAL ID">
                        <?php
                        //getting all national ID in option field labelled National ID
                        //get_all_nid();
                        ?>
                         </optgroup>
                         <optgroup label="NHIS ID">
                        <?php
                        //getting all national health insurance ID in option field labelled NHIS
                        //get_all_NHIS();
                        ?>
                         </optgroup>
                         
                      </select> 
    
                      <input type="hidden" name="patient_id" id="select_patient" data-placeholder="Enter Patient ID">-->
                        <input autocomplete="off" class="form-control col-sm-3" type="text" id="select_patient" name="get_details" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button>
                </div>

            </form>
          </div>
        </div>
       
		
			<div class="row dash-cols">
				<div class="col-sm-6 col-md-6">
					
		
	<div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-4">
              <div class="avatar">
                <img src="<?php 
                              if( isset($_SESSION['patient_id']) ){
                                  echo patient_profile_picture($_SESSION['patient_id']); 
                              } else {
                                   echo @no_image(); 
                              }
                          ?>" 
                      class="profile-avatar">
              </div>
            </div>
            <div class="col-sm-7">
            	
              <div class="personal">
                <h5 style="color:red;" class="name"><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></h5>
               <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p><p>

			   <?php if (isset($_SESSION['scheme']) && !empty($_SESSION['scheme'])) { ?>
                                            <p class="description">Insurance Scheme: <?php echo @strtoupper($_SESSION['scheme']); ?></p>
                                        <?php } else { ?>
                                            <p class="description">Insurance Scheme: CASH CLIENT</p>
                                        <?php } ?>


                <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                <p class="description">Age : <?php get_age(@$_SESSION['dob']);echo" years";?></p><p>
               <p class="description">Sex: <?php echo @$_SESSION['sex']; ?></p><p>
			 
               </p></div>
            </div>
            <div class="col-sm-3">
              <?php
				//setting login error messages
			
				echo @$_SESSION['err_msg'];
				unset($_SESSION['err_msg']);
				?>
            </div>
		
          </div>
        </div>
					
					<?php 
					global $investAmount,$thePatientscode,$btnOndrg,$btnOninv;
					//set to hide print and paid button when user had no payment data
		            $hidebuttons[] = array();
					if(!empty($_SESSION['patient_id'])){
					$thePatientscode = $_SESSION['patient_id'];
					
					}else{
					$thePatientscode = '';
					} ?>
					
				</div>	
				<div class="col-sm-6 col-md-6">
					
					<div class="block">
						<div class="header">
							<h5>Services <span class="pull-right">Amount</span></h5>
							
						</div>
						<div class="content no-padding ">
							<ul class="items">
								<li>
									<i class="fa fa-user-md"></i>Consulting<span class="pull-right value">&#x20B5&nbsp;
									
					<?php $consult_amount = getConsultingPayment($thePatientscode);
						   if(isset($_SESSION['consult_transcode'])){
						   $consult_transcode = $_SESSION['consult_transcode'];}
						   if(empty($consult_transcode)){$consult_transcode = '';}
						   if(checkIfthePatHasPaid4Service($consult_transcode) == true){
						echo '<strike style="color:red;">'.$consult_amount.'</strike>';
							$consult_amount = 0;	
							}
						else{	
								if(!empty($consult_amount)||$consult_amount==0){
									echo $consult_amount;
									}else{
									echo '0.00';
								$btnOnConst = 1;
									}
				          }													   
						   
					?>
				
									</span>
									
								</li>
								<li>
									<i class="fa fa-flask"></i>Investigation<span class="pull-right value">&#x20B5&nbsp; <?php
					$investAmountinfo = get_investigation_payment($thePatientscode);
					 if( isset($investAmountinfo['amount'])){
						$investAmount = $investAmountinfo['amount'];
					}
					 if(isset($investAmountinfo['transaction_code'])){
					 $inveTranscode = $investAmountinfo['transaction_code']; } 
					 if(empty($inveTranscode)){$inveTranscode = '';}
				if(checkIfthePatHasPaid4Service($inveTranscode) == true){
						echo '<strike style="color:red;">'.$investAmount.'</strike>';
							$investAmount  = 0;	
					}else{	
								if(!empty($investAmountinfo['amount'])){
									echo $investAmountinfo['amount'];
									}else{
									echo '0.00';
								$btnOnInv = 1;
									}
				          }		
									?></span>
									
								</li>
<!-- 
								<li>
									<i class="fa fa-stethoscope"></i>Procedure<span class="pull-right value">&#x20B5&nbsp;0.00</span>
									
								</li>

								 -->
								<li>
									<i class="fa fa-medkit"></i>Drugs<span class="pull-right value">&#x20B5&nbsp;
						<?php    
							$drugsPaymentdata  = get_drug_payment($thePatientscode);
						
						if(isset($drugsPaymentdata['amount']))
								 { 
									$theamount = $drugsPaymentdata['amount']; 
							
							}
					//	$drugTranscode = $drugsPaymentdata['transcode'];
						   if(isset($drugsPaymentdata['transcode']))
								 { 
							 $drugTranscode = $drugsPaymentdata['transcode']; 
							
							}
						 if(empty($drugTranscode)){$drugTranscode = '';}
						 
						if(checkIfthePatHasPaid4Service($drugTranscode) == true){
		echo '<strike style="color:red;">'.$theamount.'</strike>';	
									$theamount = 0;
						}elseif(!empty($theamount))
						{ echo $theamount;
						}else
						{ echo'0.00';
						$btnOndrg = 1;
						}  ?></span>
									
								</li>
							</ul>
						</div>
							<div class="total-data bg-blue" >
								<a href="#">
									<h2>Total <b class=""></b> <span class="pull-right">&#x20B5 &nbsp;<?php echo calculateTotalToPay($investAmount,$consult_amount,$theamount,0); ?></span></h2>
								</a>
								
							</div>
					</div>
					
					
					
				</div>		
			</div>
		
		<form action="tasks/procPayment.php" method="post">
		<!-- <input type="hidden" name="paymentstate" value="1">	 -->
		<?php if(isset($_SESSION['patient_id'])){ ?>
	<input name="patient_id" value="<?php echo @$_SESSION['patient_id']; ?>" type="hidden"/>
	<?php } ?>
		<?php if(isset($drugTranscode) and !empty($drugTranscode)){ ?>
	<input name="transcode[]" value="<?php if(!empty($drugTranscode)){echo $drugTranscode; } ?>" type="hidden" />
	<?php } ?>
		<?php if(isset($investAmountinfo['transaction_code']) and !empty($investAmountinfo['transaction_code'])){ ?>
	<input type="hidden" name="paymentstate" value="1">	
	<input name="transcode[]" value="<?php if(!empty($investAmountinfo['transaction_code'])){echo $investAmountinfo['transaction_code']; } ?>" type="hidden" />
		<?php } ?>
	<?php if(isset($_SESSION['consult_transcode']) and !empty($_SESSION['consult_transcode'])){ ?>
	<input name="transcode[]" value="<?php if(!empty($_SESSION['consult_transcode'])){echo @$_SESSION['consult_transcode']; } ?>" type="hidden" />
	<?php } ?>


	<?php   
 	
	if(!empty($btnOnInv) and !empty($btnOndrg) and !empty($btnOnConst)){
	
	}else
	if(empty($investAmount) and empty($consult_amount)){
	//echo '<a href="tasks/printReciept.php" style="margin-top:-100px;" target="_blank" class="btn btn-success btn-rad"><i class="fa fa-print"></i>Print </a>';
	}else{
	echo '<button style="margin-top:-65px; height: 80px;" type="submit" class="btn btn-success btn-rad"><i class="fa fa-money"></i>Add Patient Payments </button>';
	} ?>		

            </form>
	
					</div> 
	</div> 
</div>
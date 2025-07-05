<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Search Patient</h2>
      <ol class="breadcrumb">
        <li><a href="#">Tasks</a></li>
       
        <li class="active">dispense drugs</li>
      </ol>
       <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details.php" style="border-radius: 0px;">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <label class="col-sm-3 control-label">Patient (ID/NHIS ID)</label>

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
    
                      <<input type="hidden" name="patient_id" id="select_patient" data-placeholder="Enter Patient ID">-->
                        <input autocomplete="off" class="form-control col-sm-3" type="text" id="select_patient" name="get_details" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button>
                </div>

            </form>
    </div>
    <div class="cl-mcont">
       
    <div class="row">
      <div class="col-md-12">
      
       

   <div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-2">
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
                <h1 class="name"><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></h1>
               <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p><p>
               <?php if (isset($_SESSION['scheme']) && !empty($_SESSION['scheme'])) { ?>
                                            <p class="description">Insurance Scheme: <?php echo @strtoupper($_SESSION['scheme']); ?></p>
                                        <?php } else { ?>
                                            <p class="description">Insurance Scheme: CASH CLIENT</p>
                                        <?php } ?>
                                        <?php if (isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])) { ?>
                                            <p class="description">MembershipID: <?php echo @strtoupper($_SESSION['membership_id']); ?></p>
                                        <?php }  ?>
                <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                <p class="description">Age : <?php get_age(@$_SESSION['dob']);echo" years";?></p><p>
               <p class="description">Sex: <?php echo @$_SESSION['sex']; ?></p><p>



               <p class="description">Weight (Kg): <?php 
               $bio_vital = get_bio(@$_SESSION['patient_id']);

               if(isset($bio_vital)){
                     echo $bio_vital['weight'];
               }else{
                 echo "N/A";
               }

               

              
               
               
               ?></p><p>



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
        
        	<!--Fields to be updated here-->
  
  
    <form class="form-horizontal group-border-dashed prescDrug" method="post" 
	action="tasks/sendDrugToCashier.php" style="border-radius: 0px;">
           
      <div class="row">
				<div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3>Prescribed Drugs</h3>
						</div><strong style="display:hidden;" class="showMsg"></strong>
						<div class="content tablfocontent">
						
			<?php //if(isset($_SESSION['emptyTableIndicator']) and $_SESSION['emptyTableIndicator'] ==1){
			
			//echo '<h3 style="color:red;">No drug to dispense</h3>';
			//}else{ ?>			
							<div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										
									

                    <?php if (isset($_SESSION['hideButton']) && ($_SESSION['hideButton']) ==1) { 

                      ?>

<th style="width:25%;"><strong>Drug</strong></th>
<th style="width:75%;"><strong>Action</strong></th>

   

                   <?php }

                   
else if (isset($_SESSION['hideButton']) && ($_SESSION['hideButton']) ==0) {

  ?>

<th style="width:15%;"><strong>Drug</strong></th>

<th style="width:15%;"><strong>Dosage</strong></th>

  <th style="width:10%; text-align:center;"><strong style="width:10%; text-align:center;">Quantity</strong</></th>

	
  <th style="width:10%; text-align:center;"><strong style="width:20%" class="text-center">Unit Price(GHS)</strong></th>

  
<th style="width:10%;text-align:center;"><strong class="text-center" >Total(GHS)</strong></th>

  
<th style="width:40%;text-align:center;"><strong class="text-center" >Comments</strong></th>
 

  <?php }


                      
                      
                      ?>  

	
 
								
</tr>
								</thead>
								<tbody class="no-border-y">
								
										<?php
										//calling the prescribed drugs
										
										
										
										get_requesting_doctor(@$_SESSION['doc_name']);
										?>
                    <?php
										get_prescribtion(@$_SESSION['patient_id']);
									
                      ?>
									
									
								</tbody>
								</table>	
		<!---<input type="hidden" id="totalPrice" value="<?php //echo $totalHolder; ?>" name="totalcost" /> -->
<input type="hidden" value="<?php if(isset($_SESSION['patient_id'])){echo @$_SESSION['patient_id'];} ?>" name="patient_id" /><!--<input type="hidden" value="<?php //echo $get_drugcodes;  ?>" name="seldrugcodes" />	-->	
<input type="hidden" value="<?php if(isset($_SESSION['uid'])){ echo @$_SESSION['uid']; }  ?>" name="uid" />		
<!--<input type="hidden" value="<?php //if(!empty($qty)){ echo $qty; }  ?>" name="qty" /> -->
<?php if($hideButton !=1){	?>	
<strong style="font-size:20px;margin-left:69%;" class="badge badge-danger" id="pricescreen">&#x20B5; <?php echo $totalHolder; ?></strong>
<input id="priceScreen"  name="totalcost" style="color:red;font-size:30px;margin-left:76%;display:none" class="" value="<?php echo $totalHolder; ?>">

<!-- <input target="_blank" name="print" type="submit" value="Print" style="float:right;" class="btn btn-primary"> -->

 <?php  //} ?>

<?php 
if($hideButton !=1){
if(!empty($_SESSION['patient_id'])){
pharmActionButton($_SESSION['patient_id']); 
}

}


?>

<input type='hidden' id="errorIndicator" value="<?php if(!empty($_SESSION['hidethetbl'])){ echo $_SESSION['hidethetbl']; } ?>">

							
	</form>						</div>
						</div>
						<?php  } ?>
					</div>				
				</div>
			</div>
    
    			
      
      </div>
    </div></div>
      </div>
     </div>

	


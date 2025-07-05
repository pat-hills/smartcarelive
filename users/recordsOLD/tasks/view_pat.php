<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>View Patient Info</h2>
      <ol class="breadcrumb">
        <li><a href="#">Tasks</a></li>
       
        <li class="active">View Patient</li>
      </ol>
    </div>
    <div class="cl-mcont">
       
    <div class="row">
      <div class="col-md-12">
      
       

        	<!--Fields to be updated here-->

        	<div class="cl-mcont">
  
  
   <div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-2">
              <div class="avatar">
                <img src="
                <?php 
                    if( isset($_SESSION['patient_id']) ){
                        echo @patient_profile_picture($_SESSION['patient_id']); 
                    } else {
                         echo @no_image(); 
                    }
                ?>
                " class="profile-avatar">
              </div>
            </div>
            <div class="col-sm-7">
            	<?php
				//setting login error messages
			
				echo @$_SESSION['err_msg'];
				unset($_SESSION['err_msg']);
				
				require_once "../../functions/conndb.php";
				require_once "../../functions/func_search.php";
				
				$patient_id = $_SESSION['new_pat_id'];
				get_pat_details($patient_id);
				
				?>			
              
               <div class="personal">
                    <h1 class="name"><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></h1>
                   <p class="description">Patient ID: <span class="label label-danger"><?php echo @$_SESSION['patient_id']; ?></span></p>
                   
                    <!-- -->
                   <?php if(isset($_SESSION['scheme']) && !empty($_SESSION['scheme'])){ ?>
                        <p class="description">Insurance Scheme: <?php echo @strtoupper($_SESSION['scheme']); ?></p>
                   <?php } else { ?>
                        <p class="description">Insurance Scheme: None</p>
                   <?php } ?>

                   <!-- -->
                   <?php if(isset($_SESSION['sub_metro']) && !empty($_SESSION['sub_metro'])){ ?>
                        <p class="description">Sub Metro: <?php echo @$_SESSION['sub_metro']; ?></p>
                   <?php } ?>

                   <!-- -->
                   <?php if(isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])){ ?>
                        <p class="description">Membership ID: <?php echo @ucfirst($_SESSION['membership_id']); ?></p>
                   <?php }  //else { ?>
                        <!--<p class="description">Membership ID: </p>-->
                   <?php //} ?>
                  

                    <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                    <p class="description">Age : <?php get_age(@$_SESSION['dob']);echo" years";?></p><p>
                   <p class="description">Gender: <?php echo @$_SESSION['sex']; ?></p><p>
                   </p>
               </div>
               <?php
               //session_destroy();
//               unset($_SESSION['surname']);
//               unset($_SESSION['other_names']);
//               unset($_SESSION['patient_id']);
//               unset($_SESSION['dob']);
//               unset($_SESSION['scheme']);
//               unset($_SESSION['membership_id']);
//               unset($_SESSION['sub_metro']);
//               unset($_SESSION['occupation']);
//               unset($_SESSION['sex']);
              
               ?>
            </div>
            <div class="col-sm-3">
              <form>
                <div class="form-group">
                  <div class="col-sm-12">
                    
                                       <a href="add_patient.php" class="btn btn-primary" >Add New Patient</a>
                                       <!-- <a href="patient_photo.php" class="btn badge-success" style="color: white" >Take Patient's Photo</a> -->

                  </div>
                </div>  
              </div>
              </form>
            </div>
          </div>
        </div>
      
       
     
      </div></div>
</div></div></div>
     
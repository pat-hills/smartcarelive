<?php 

session_start();
require_once '../../functions/conndb.php';
 require_once '../../functions/func_records.php';
 require_once "../../functions/func_search.php";
 require_once "../../functions/func_pharmacy.php";

//require_once '../../functions/func_constant.php'; 
//require_once '../../functions/func_common.php';


$staff_id = $_SESSION['uid'];
$staff_info = get_staff_info($staff_id);
   
   if(!isset($_SESSION['uid'])){
       header("Location: ../../index");
   }

?>
<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="fa fa-gear"></span>
        </button>
        <a class="navbar-brand" href="#"><span>SmartCareAid</span></a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
         
          
        </ul>



    <ul class="nav navbar-nav navbar-right user-nav">
      
    <li class="dropdown profile_menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <div class="avatar profile-image">


             
             <?php

             $notifications = 0;

            $notifications = total_notification_waiting_from_Doctor() + total_notification_waiting_patients_drug2depenseinfoFRMCASHIER();

             if($notifications != 0){
              echo  '<b style="background:red;padding:10px;border-radius:5px;">'.$notifications.'</b>';
             }else{
              echo  '<b style="">'.$notifications.'</b>';
             }
           
             
             ?>
           
            

                <img  alt="Avatar" src="../../assets/images/bell.png" />
            </div> 


        </a>
        <ul style="width:350px; color:black;padding:5px;" class="dropdown-menu">
        <li class="divider"></li>
        <b><i>Pending Payments Patients:</i></b>
        <li class="divider"></li>
        <?php 
        
        list_total_notification_waiting_from_Doctor();
        
        ?>
         
          <li class="divider"></li>

          <b><i>Paid Patients:</i></b>
        <li class="divider"></li>
        <?php 
        
        list_total_notification_waiting_patients_drug2depenseinfoFRMCASHIER();
        
        ?>

          <li>
            <a style="float:left;" href="dispense"> <img style="height: 15px; height: 15px;"  alt="Avatar" src="../../assets/images/workflow.png" /> Click Here To Refresh Incoming Notification</a>
          </li>
          
        </ul>
      </li>










      <li class="dropdown profile_menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <div class="avatar profile-image">
                <img  alt="Avatar" src="<?php echo staff_profile_picture($staff_id);?>" />
            </div>
        
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Update Password</a></li>
          <li><a href="#">Profile</a></li>
         
          <li class="divider"></li>
          <li><a href="logout">Sign Out</a></li>
        </ul>
      </li>
    </ul>			
    <ul class="nav navbar-nav navbar-right not-nav" >
      	
    </ul>

      </div><!--/.nav-collapse animate-collapse -->
    </div>
  </div>
<?php

/* Call all functions here in the navbar.php because it applies to the pages
 * Use the func_common.php to get all staff information
 * */

    require '../../functions/conndb.php';
   // require '../../functions/func_common.php';
    require '../../functions/func_search.php';
    require_once '../../functions/func_records.php';
    require_once '../../functions/func_consulting.php';
    require_once '../../functions/func_constant.php'; 
    //require_once '../../functions/func_pharmacy.php'; 
    
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
             $total_notifications = 0;

             $total_notifications = total_notification_processed_lab_to_doctor() + total_notification_waiting_patients();

             if($total_notifications != 0  ){
              echo  '<b style="background:red;padding:10px;border-radius:5px;">'.$total_notifications.'</b>';
             }else{
              echo  '<b style="">'.$total_notifications.'</b>';
             }
           
             
             ?>
           
            

                <img  alt="Avatar" src="../../assets/images/bell.png" />
            </div> 


        </a>

        
        <ul style="width:350px; color:black;padding:5px;" class="dropdown-menu">
        <li class="divider"></li>
        <b><i>Incoming Patients From OPD:</i></b>
        <li class="divider"></li>
        <?php 
        
        
       list_total_notification_waiting_patients();
        
        ?>
         
          <li class="divider"></li>

         
            
            </br>


          <b><i>Incoming Patients From LAB:</i></b>
              <li class="divider"></li>
              <?php 
              
              
              list_total_notification_processed_lab_to_doctor();
              
              ?>




                <li>

         
 
            
            </br>

            <a style="float:left;" href="treat_patient"> <img style="height: 15px; height: 15px;"  alt="Avatar" src="../../assets/images/workflow.png" /> Click Here To Refresh Or Check Any Incoming Patient</a>
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
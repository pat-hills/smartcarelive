<?php

/* Call all functions here in the navbar.php because it applies to the pages
 * Use the func_common.php to get all staff information
 * */

    require '../../functions/conndb.php';
    require '../../functions/func_common.php';
    require '../../functions/func_search.php';
    require '../../functions/func_opd.php'; 
    require '../../functions/func_constant.php';
    
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
            //  if(total_notification_waiting_consulting_patients_from_cashier() != 0){
            //   echo  '<b style="background:red;padding:10px;border-radius:5px;">'.total_notification_waiting_consulting_patients_from_cashier().'</b>';
            //  }else{
            //   echo  '<b style="">'.total_notification_waiting_consulting_patients_from_cashier().'</b>';
            //  }
           
             
             ?>
           
            

                <!-- <img  alt="Avatar" src="../../assets/images/bell.png" /> -->
            </div> 


        </a>
        <ul style="width:350px; color:black;padding:5px;" class="dropdown-menu">
        <li class="divider"></li>
        <b><i>Incoming Patients:</i></b>
        <li class="divider"></li>
        <?php 
        
        
       // list_total_notification_waiting_consulting_patients_from_cashier();
        
        ?>
         
          <li class="divider"></li>


          <li>

         

            
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
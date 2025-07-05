<div id="cl-wrapper">
		<div class="cl-sidebar">
			<div class="cl-toggle"><i class="fa fa-bars"></i></div>
			<div class="cl-navblock">
        <div class="menu-space">
          <div class="content">
            <div class="side-user">
            <div class="profile-image"><img src="<?php echo staff_profile_picture($staff_id);?>" alt="Avatar" /></div>
              <div class="info">
              <a href="#"><?php echo "Hello, ". $staff_info['firstName'] . ' ' .$staff_info['otherNames']; ?></a>
                <!-- <img src="../../assets/images/state_online.png" alt="Status" /> <span>Online</span> -->
              </div>
            </div>
			  
            <ul class="cl-vnavigation">
               <li><a href="#"><i class="fa fa-home"></i><span>Home</span></a>
                <ul class="sub-menu">
                <li><a href="index"><i class="fa fa-home"></i><span>Home</span></a></li>
                <li><a href="dispense"><i class="fa fa-medkit"></i><span>Dispense</span></a></li>
            <li><a href="add_drug"><i class="fa fa-plus"></i><span>Populate Drugs</span></a></li>
            <li><a href="update_drug"><i class="fa fa-bars"></i><span>Manage Drugs</span></a></li>
            <li><a href="myReport"><i class="fa fa-bar-chart-o"></i><span>Daily Report</span></a></li>
            <li><a href="myReportDateRange"><i class="fa fa-bar-chart-o"></i><span>Date Range Report</span></a></li>
            <li><a href="insuranceVisits"><i class="fa fa-bell"></i><span>Consulted & Investigated – No Prescription


            <?php

$total_notifications = 0;

 $total_notifications = countPatientsWithNoPrescription();

if($total_notifications != 0  ){
 echo  '<b style="background:orange;padding:10px;border-radius:5px;">'.$total_notifications.'</b>';
}else{
 echo  '<b style="">'.$total_notifications.'</b>';
}


?>
            </span></a></li>

            <li><a href="insuranceScanVisits"><i class="fa fa-bell"></i><span>Consulted & Scanned – No Prescription


            <?php

$total_notificationscan = 0;

 $total_notificationscan = countScanPatientsWithNoPrescription();

if($total_notificationscan != 0  ){
 echo  '<b style="background:orange;padding:10px;border-radius:5px;">'.$total_notificationscan.'</b>';
}else{
 echo  '<b style="">'.$total_notificationscan.'</b>';
}


?>
            </span></a></li>
                    
          </ul> 
              </li>
           
            
            
            </ul>
          </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
          
          <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
			</div>
		</div>
		
		
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
             <li><a href="index"><i class="fa fa-home"></i><span>Dashboard</span></a>  </li>
               
			<li><a href="add_payment"><i class="fa fa-plus"></i><span> Receive Payment</span></a></li>
             <li><a href="my_report"><i class="fa fa-money"></i><span>Daily Collections</span></a></li></li>

             <li><a href="pendingPayment"><i class="fa fa-bell"></i>
             
             <span>Pending Payment 
             <?php

$total_notifications = 0;

 $total_notifications = countPendingInvestigations();

if($total_notifications != 0  ){
 echo  '<b style="background:orange;padding:10px;border-radius:5px;">'.$total_notifications.'</b>';
}else{
 echo  '<b style="">'.$total_notifications.'</b>';
}


?>

              </span>
            
            </a>
            
            
            </li>
            
            
            
            </li>
             <!-- <li><a href="cashier_report"><i class="fa fa-bar-chart-o"></i><span>Reports</span></a></li></li> -->

             <!-- <li><a href="acc_report"><i class="fa fa-bar-chart-o"></i><span>Income Statement Report</span></a></li></li> -->

             <!-- <li><a href="acc_revenues"><i class="fa fa-bar-chart-o"></i><span>Revenue Report</span></a></li></li> -->
             
            </ul>
          </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
          <input type="text" class="form-control search" placeholder="Search..." />
          <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
			</div>
		</div>
		
		
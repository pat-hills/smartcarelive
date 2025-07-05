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
              <!-- <li><a href="#"><i class="fa fa-home"></i><span>Tasks</span></a> -->
      
              <li><a href="index"><i class="fa fa-home"></i><span>Home</span></a></li>
               
			 <li><a href="add_acc_items"><i class="fa fa-file-text-o"></i><span>Add Expense Items</span></a></li>
    <li><a href="add_acc_recordings"><i class="fa fa-bar-chart-o"></i><span>Add Recordings</span></a></li>  
             
             <li><a href="acc_report"><i class="fa fa-bar-chart-o"></i><span>Income Statement Reports</span></a></li> 
          <li><a href="acc_revenues"><i class="fa fa-gear"></i><span>Revenues Report</span></a></li>  
             
            </ul>
          </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
          <input type="text" class="form-control search" placeholder="Search..." />
          <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
			</div>
		</div>
		
		
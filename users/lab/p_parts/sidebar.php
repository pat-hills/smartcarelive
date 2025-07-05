<div id="cl-wrapper">
		<div class="cl-sidebar">
			<div class="cl-toggle"><i class="fa fa-bars"></i></div>
			<div class="cl-navblock">
        <div class="menu-space">
          <div class="content">
            <div class="side-user">
              <div class="profile-image"><img src="<?php echo staff_profile_picture($staff_id);?>" alt="Avatar" /></div>
              <div class="info">
                <a href="#"><?php echo $staff_info['firstName'] . ' ' .$staff_info['otherNames']; ?></a>
                <!-- <img src="../../assets/images/state_online.png" alt="Status" /> <span>Online</span> -->
              </div>
            </div>
            <ul class="cl-vnavigation">
             <li><a href="index"><i class="fa fa-home"></i><span>Home</span></a></li> 
             
			  <li><a href="#"><i class="fa fa-clock-o"></i><span>Lab Schedules</span></a>
            <ul class="sub-menu">
                <li><a href="view_lab_list">View Incoming Labs</a></li> 
                <li><a href="patient_results_search">Patient Results Historical Search</a></li> 
            </ul>

            
      
        </li>

			  <li><a href="#"><i class="fa fa-stethoscope"></i><span>Walk In Labs</span></a>
        <ul class="sub-menu">
                <li><a href="walk_in_labs">Add New Walk In Lab</a></li> 
                <li><a href="walk_in_exist">Search For Existing Walk In</a></li> 
                <li><a href="all_walk_patients">Edit / Delete Walk In Patient</a></li> 
            </ul>
      
      </li>

      <?php if(IS_ADMIN_AVAILABE == false) { ?>

      <li><a href="#"><i class="fa fa-money"></i><span>Investigations Prices</span></a>
        <ul class="sub-menu">
                <li><a href="add_investigations">Edit Investigations Prices</a></li> 
                <!-- <li><a href="walk_in_exist">Search For Existing Walk In</a></li> 
                <li><a href="all_walk_patients">Edit / Delete Walk In Patient</a></li>  -->
            </ul>
      
      </li>

      <?php } ?>

            </ul>
          </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
          <input type="text" class="form-control search" placeholder="Search..." />
          <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
			</div>
		</div>
		
		
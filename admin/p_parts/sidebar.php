<div id="cl-wrapper">
		<div class="cl-sidebar">
			<div class="cl-toggle"><i class="fa fa-bars"></i></div>
			<div class="cl-navblock">
        <div class="menu-space">
          <div class="content">
            <div class="side-user">
              <div class="profile-image"><img src="<?php echo admin_profile_picture($staff_id);?>" alt="Avatar" /></div>
              <div class="info">
                <a href="#"><?php echo $staff_info['firstName'] . ' ' .$staff_info['otherNames']; ?></a>
                <!-- <img src="../assets/images/state_online.png" alt="Status" /> <span>Online</span> -->
              </div>
            </div>
            <ul class="cl-vnavigation">
              <li><a href="#"><i class="fa fa-user"></i><span>Manage Patients</span></a>
                <ul class="sub-menu">				
                  <!--<li><a href="view_patients_page.php">View Patients</a></li>-->
				   <li><a href="add_patients_page">Add Patients</a></li>
					<!-- <li><a href="list_patients_page">List Patients</a></li> -->
          <li><a href="all_patients">All Patients</a></li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-users"></i><span>Staffs</span></a>
                <ul class="sub-menu">
                  <li><a href="create_account_page">Add Staffs</a></li>  
                  <li><a href="view_staff_page">View Staffs</a></li>
                  <!-- <li><a href="online_users">Online Staffs</a></li> -->
                  <!--<li><a href="change_staff_password.php">Reset Staff password</a></li>-->
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-plus-square"></i><span>Setup Hospital</span></a>
                <ul class="sub-menu">
                  <li><a href="add_room">Rooms</a></li>

                  <?php if(IS_ADMISSION == true) { ?>


                  <li><a href="add_ward">Wards</a></li>

                  <?php } ?>

                  <li><a href="assign_room">Assignments</a></li>
                  <li><a href="add_investigations"> Investigations</a></li>
                  <li><a href="add_diagnosis">Diagnosis</a></li>
                  <li><a href="add_complains">Complains</a></li>
                  <li><a href="add_consulting">Fees</a></li>
                   <!-- <li><a href="procedure">Procedures</a></li> -->
                  
                </ul>
              </li>

              <li><a href="#"><i class="fa fa-plus-square"></i><span> Consultations Reports</span></a>
                <ul class="sub-menu">
                  <li><a href="apat_report">Today Consultations</a></li>
                  <li><a href="awpat_report">Weekly Consultations</a></li>
                  <li><a href="ampat_report">Monthly Consultations</a></li>
                  <li><a href="aypat_report">Yearly Consultations</a></li>
                </ul>
              </li>

              <li><a href="#"><i class="fa fa-plus-square"></i><span> Medications Reports</span></a>
                <ul class="sub-menu">
                  <li><a href="apat_drug">Drugs Dispensed Today</a></li>
                  <li><a href="awpat_drug">Drugs Dispensed Weekly</a></li>
                  <li><a href="ampat_drug">Drugs Dispensed Monthly</a></li>
                  <li><a href="aypat_drug">Drugs Dispensed Yearly</a></li>
                   
                </ul>
              </li>


              <li><a href="#"><i class="fa fa-plus-square"></i><span> Lab Reports</span></a>
                <ul class="sub-menu">
                  <li><a href="apat_lab">Today Labs</a></li>
                  <li><a href="awpat_lab">Weekly Labs</a></li>
                  <li><a href="ampat_lab">Monthly Labs</a></li>
                  <li><a href="aypat_lab">Yearly Labs</a></li>
                </ul>
              </li>

              <li><a href="#"><i class="fa fa-plus-square"></i><span> Date Range Reports</span></a>
                <ul class="sub-menu">
                  <li><a href="date_range_report">Select Date</a></li>
                   
                </ul>
              </li>


              <li><a href="#"><i class="fa fa-plus-square"></i><span>Financials</span></a>
                <ul class="sub-menu">
                  <li><a href="acc_report">Income Statement</a></li>
                  <li><a href="acc_revenues">Revenue Report</a></li>
                </ul>
              </li>
            
            </ul>
          </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
          <input type="text" class="form-control search" placeholder="Search..." />
          <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
			</div>
		</div>
		
		
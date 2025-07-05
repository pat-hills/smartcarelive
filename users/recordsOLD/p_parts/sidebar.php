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
             
              <li><a href="#"><i class="fa fa-home"></i><span>Tasks</span></a>
                <ul class="sub-menu">
                <li><a href="index">Home</a></li>
                  <li><a href="add_patient">Add Patient</a></li>
                   <li><a href="update_patient">Update Patient</a></li>
				          <li><a href="list_patients_page"><span>List Patients</span></a></li>
				  
                </ul>
              </li>
              <!-- <li><a href="take_picture.php"><i class="fa fa-search"></i><span>Take Picture</span></a> -->
                
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

        <?php
            echo "
              <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
              <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
              <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
              <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
              <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            ";
        ?>
		
		
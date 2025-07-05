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
              <!--<li><a href="add_biovitals.php"><i class="fa fa-home"></i><span>Add bio-vitals</span></a>-->
                
              </li>
               <li><a href="index"><i class="fa fa-home"></i><span>Home</span></a>
                <!--<ul class="sub-menu">
                  <li><a href="consult.php"><span>Send to Consulting</span></a></li>
                   
                </ul>-->
              </li>

              <li><a href="#"><i class="fa fa-user"></i><span>My Report</span></a>
                <ul class="sub-menu">
                  <li><a href="my_patients"><span>My Patients Today</span></a></li>
                  <li><a href="my_patient_date_range"><span>My Patients Date Selection</span></a></li>
                   
                </ul>
              </li>

              <li><a href="#"><i class="fa fa-user"></i><span>Patient Drugs</span></a>
                <ul class="sub-menu">
                  <li><a href="view_all_patients_drugs"><span>View Patients Prescription</span></a></li>
                   
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-user"></i><span>Re-assignment</span></a>
                <ul class="sub-menu">
                  <li><a href="patient_reassignment"><span>Re-assign Patient To Doctor</span></a></li>
                   
                </ul>
              </li>


              <?php if(IS_ADMISSION == true) { ?>

                <li><a href="#"><i class="fa fa-file"></i><span>Admission</span></a>
                <ul class="sub-menu">
                  <li><a href="view_all_admission_patient"><span>Patients On Admission</span></a></li>
                   
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
        
        

		
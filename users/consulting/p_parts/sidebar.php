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
              

              <li><a href="index"><i class="fa fa-user"></i><span>Home</span></a>
                
              </li>


              <li><a href="treat_patient"><i class="fa fa-stethoscope"></i><span>Treat Patient</span></a>
                
              </li>

              <li><a href="#"><i class="fa fa-book"></i><span>My Consultations</span></a>
        <ul class="sub-menu">
                <li><a href="view_consultations">View Consultations</a></li>  
            </ul>
      
      </li>
              <li><a href="medical_history"><i class="fa fa-h-square"></i><span>Medical History</span></a>


              <!-- <li><a href="medical_reporting"><i class="fa fa-h-square"></i><span>Medical Reporting</span></a> -->
                
              </li>



              <?php if(IS_ADMISSION == true) { ?>

<li><a href="#"><i class="fa fa-file"></i><span>Admission</span></a>
<ul class="sub-menu">
  <li><a href="view_all_admission_patient"><span>Patients On Admission</span></a></li>
   
</ul>
</li>


<?php } ?>



<li><a href="#"><i class="fa fa-file"></i><span>Clinic Drugs</span></a>
<ul class="sub-menu">
  <li><a href="view_drugs"><span>View/Add Drugs</span></a></li>
   
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
        
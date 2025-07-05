 <div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-2">
              <div class="avatar">
                <img src="<?php 
                              if( isset($_SESSION['patient_id']) ){
                                  echo patient_profile_picture($_SESSION['patient_id']); 
                              } else {
                                   echo @no_image(); 
                              }
                          ?>" 
                      class="profile-avatar">
              </div>
            </div>
            <div class="col-sm-7">
            
              <div class="personal">
                <h1 class="name"><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></h1>
               <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p>
               
                <!-- -->
               <?php if(isset($_SESSION['scheme']) && !empty($_SESSION['scheme'])){ ?>
                    <p class="description">Insurance Scheme: <?php echo @strtoupper($_SESSION['scheme']); ?></p>
               <?php } else { ?>
                    <p class="description">Insurance Scheme: None</p>
               <?php } ?>

               <!-- -->
               <?php if(isset($_SESSION['sub_metro']) && !empty($_SESSION['sub_metro'])){ ?>
                    <p class="description">Sub Metro: <?php echo @$_SESSION['sub_metro']; ?></p>
               <?php } ?>

               <!-- -->
               <?php if(isset($_SESSION['membership_id']) && !empty($_SESSION['membership_id'])){ ?>
                    <p class="description">Membership ID: <?php echo @ucfirst($_SESSION['membership_id']); ?></p>
               <?php } else { ?>
                    <p class="description">Membership ID: </p>
               <?php } ?>
              

                <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                <p class="description">Age : <?php get_age(@$_SESSION['dob']);echo" years";?></p><p>
               <p class="description">Sex: <?php echo @$_SESSION['sex']; ?></p><p>
               </p></div>
            </div>
            
             
          </div>
        </div>
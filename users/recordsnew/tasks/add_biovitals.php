<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Patient's Bio Vitals</h2>
      <ol class="breadcrumb">
        <li><a href="#">Tasks</a></li>
       
        <li class="active">patient attendance</li>
      </ol>
        <form class="form-horizontal group-border-dashed" method="post" action="tasks/set_patient_details.php" style="border-radius: 0px;" autocomplete="off">
              <div class="form-group">
                <div class="col-sm-2"></div>
                <label class="col-sm-3 control-label">Patient (ID/SURNAME/NATIONAL ID/NHIS)</label>
               
                <div class="col-sm-3">
                  <select class="select2" name="get_details">
                    <option value="">.. search here ..</option>
                     <optgroup label="ID">
                       <?php
                       //getting all patients ID in option field labelled ID
                       //get_all_id();
                       ?>
                     </optgroup>
                     <optgroup label="NATIONAL ID">
                       <?php
                       //getting all national ID in option field labelled National ID
                      // get_all_nid();
                       ?>
                     </optgroup>
                     <optgroup label="NHIS ID">
                      <?php
                       //getting all national health insurance ID in option field labelled NHIS
                     // get_all_NHIS();
                       ?>
                     </optgroup>
                     
                  </select>

                </div>
                 <button type="submit" class="btn btn-primary btn-rad"><i class="fa fa-search"></i> Get Details</button>
              </div>
            
            </form>
    </div>
    <div class="cl-mcont">
       
    <div class="row">
      <div class="col-md-12">
      
       

   <div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-2">
              <div class="avatar">
                <img src="
                <?php 
                    if( isset($_SESSION['patient_id']) ){
                        echo @patient_profile_picture($_SESSION['patient_id']); 
                    } else {
                         echo @no_image(); 
                    }
                ?>
                " class="profile-avatar">
              </div>
            </div>
            <div class="col-sm-7">
             <div class="personal">
                <h1 class="name"><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></h1>
               <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p><p>
                <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                <p class="description">Age : <?php  if(isset($_SESSION['dob'])){ echo @get_age($_SESSION['dob']); }?></p><p>
               <p class="description">Sex: <?php echo @$_SESSION['sex']; ?></p><p>
               </p></div>
            </div>
            <div class="col-sm-3">
              
            </div>
          </div>
        </div>
        
            <!--Fields to be updated here-->

            <div class="cl-mcont">
  
                 <!-- <div class="col-md-12">
                    <div class="block-flat">
                      <div class="header">                          
                        <h3>Insert Patient's Bio Vitals</h3>
                      </div>
                      <div class="content">
            
                     <form role="form"> 
                        <div class="form-group">
                          <label>Weight (kg)</label> <input  type="weight" placeholder="" class="form-control">
                        </div>
                        
                        <div class="form-group">
                          <label>Height</label> <input  type="email" placeholder="" class="form-control">
                        </div>
                        
                        <div class="form-group">
                          <label>Blood Pressure</label> <input  type="email" placeholder="" class="form-control">
                        </div>
                        
                        <div class="form-group">
                          <label>Tempature</label> <input  type="email" placeholder="" class="form-control">
                        </div>
                        
                       
                          
                          <button class="btn btn-primary pull-right" type="submit">Add Vitals</button>
                          <div></div><br>
                        </form>
                      
                      </div>
                    </div>              
                  </div>-->
                  
                  <div class="col-sm-6 col-md-6">
        <div class="block-flat">
          <div class="header">                          
            <h3>Insert Patient's Bio Vitals</h3>
          </div>
          <div class="content">
            
           <form role="form" action="tasks/insert_vitals.php" method="post" autocomplete="off"> 
                <div class="form-group">
                  <label>Weight (kg)</label> <input  type="text" name="weight" placeholder="" class="form-control">
                </div>
                
                <div class="form-group">
                  <label>Height</label> <input  type="text" name="height" placeholder="" class="form-control">
                </div>
                
                <div class="form-group">
                  <label>Blood Pressure</label> <input  type="text" name="blood_pressure" placeholder="" class="form-control">
                </div>
                
                <div class="form-group">
                  <label>Tempature</label> <input  type="text" name="temperature" placeholder="" class="form-control">
                </div>
                
                  <button class="btn btn-primary pull-right test" type="submit" name="add">Add Vitals</button>
                  <div></div><br>
            </form>
                      
          
          </div>
        </div>              
      </div>
    
 
    
      <div class="col-sm-6 col-md-6">
        <div class="block-flat">
          <div class="header">                          
            <h3>View Bio Vitals</h3>
          </div>
          <div class="content">
           
          <form role="form">
            <div class="form-group">
                  <label>Weight : </label> <?php echo @$_SESSION['weight']; ?>
                </div>
                
                <div class="form-group">
                  <label>Height</label> <?php echo @$_SESSION['height']; ?>
                </div>
                
                <div class="form-group">
                  <label>Body Mass Index (BMI) </label> <?php echo @$_SESSION['bmi']; ?>
                </div>
                
                <div class="form-group">
                  <label>Blood Pressure</label> <?php echo @$_SESSION['blood_pressure']; ?>
                </div>
                
                <div class="form-group">
                  <label>Tempature</label> <?php echo @$_SESSION['temperature']; ?>
                </div>
                
                  
           </form>
            
          </div>
        </div>  
                  
    
            </div>
      
      </div>
     

    


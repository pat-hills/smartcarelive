<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
    <h2><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?> Vital Monitoring Charts</h2>
        <ol class="breadcrumb">
          <li><a href="index">Home </a></li>
          <li class="active"><a href="#"> Vital Charts</a></li>
          <li class="active"><a href="#"><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?></a></li>
        </ol>
    </div>
    <?php
        if( isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Success!</strong> <?php echo $_SESSION['successMsg']?>
                </div>     
            </div>
      <?php unset($_SESSION['successMsg']);  }  else if( isset($_SESSION['errorMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Error!</strong>  <?php echo $_SESSION['errorMsg']?>
                </div>     
            </div>
      <?php unset($_SESSION['errorMsg']);   } ?>
    
    <div class="cl-mcont">
       
    <div class="row">
      <div class="col-md-12">
      
          <!--Fields to be updated here-->

          <div class="cl-mcont">
  
      <div class="block-flat profile-info">
          <div class="row">
            <div class="col-sm-2">
              <div class="avatar">
                <img src="<?php 
                              if(isset($_SESSION['patient_id']) ){
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
               <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p><p>
                <p class="description">Occupation: <?php echo @$_SESSION['occupation']; ?></p><p>
                <p class="description">Age : <?php get_age(@$_SESSION['dob']);echo" years";?></p><p>
               <p class="description">Sex: <?php echo @$_SESSION['sex']; ?></p><p>
               </p>

               
               <p>
                 <a href="admission_monitoring" class="btn btn-success"> Monitoring Page </a> 

                 </p>

               </div>
               
            </div>
            <div class="col-sm-3">
            
            <p>
 
            <select id="vitals" name="vitals" required="" class="form-control">
                                                <option value="ALL"> SHOW ALL CHARTS </option>
                                                <option value="WEIGHT"> SHOW WEIGHT </option>
                                                <option value="PULSE"> SHOW PULSE </option>
                                                <option value="TEMPERATURE"> SHOW TEMPERATURE </option> 
                                            </select> 

                 </p>
            </div>
          </div>
        </div>
      

          <?php if(isset($_SESSION['patient_id'])) { ?>

        <div class="row Temperature">
				  <div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3 style="text-align: center">
                 <?php echo @$_SESSION['surname']?>'s Temperature  ( °C ) Charts
                
              </h3>
						</div>

						<div class="content">
							 <!-- <div class="tab-container tab-left"> -->
            
             
               <div id="chart-container" >
                 <canvas id="graphCanvasTemperature" ></canvas>
               </div>

             </div>


 


						</div>
					</div>				
				</div>
		
			
     
       <div class="row Weight">
				 <div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3 style="text-align: center">
              <?php echo @$_SESSION['surname']?>'s Weight ( Kg ) Charts
                
              </h3>
						</div>

						<div class="content">
							 <!-- <div class="tab-container tab-left"> -->
            
             
               <div id="chart-container" >
                 <canvas id="graphCanvasWeight" ></canvas>
               </div>

             </div>


 


						</div>
					</div>				
				</div>




        <div class="row Pulse">
          <div class="col-md-12">
					<div class="block-flat">
						<div class="header">							
							<h3 style="text-align: center">
              <?php echo @$_SESSION['surname']?>'s Pulse ( % ) Charts
                
              </h3>
						</div>

						<div class="content">
							 <!-- <div class="tab-container tab-left"> -->
            
             
               <div id="chart-container" >
                 <canvas id="graphCanvasPulse" ></canvas>
               </div>

             </div>


 


						</div>
					</div>				
			   	</div>

           <?php } ?>

			</div>
  

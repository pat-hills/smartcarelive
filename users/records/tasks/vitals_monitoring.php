<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?> Vitals Monitoring</h2>
        <ol class="breadcrumb">
          <li><a href="index">Home </a></li>
          <li class="active"><a href="#">Vitals Monitoring</a></li>

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
  
          
      
    
                

     <!-- Nifty Modal -->



     <div style="" class="md-modal colored-header md-effect-10" id="take_vitals" >
                        <div class="md-content" style="border: 1px dashed #3078EF">
                            <div class="modal-header">
                                <h3>Take <?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?>  Bio Vitals</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body form">
                                <form role="form" action="tasks/insert_vitals_on_admission.php" method="post" autocomplete="off"> 
                                    <div class="form-group">
                                        <label>Weight (Kg)</label> <input  type="text" name="weight" value="" placeholder="Eg. 64" class="form-control">
                                    </div>

                                    <?php if(IS_BMI == true) { ?>

                                    <div class="form-group">
                                        <label>Height (m)</label> <input  type="text" name="height" value="" placeholder="Eg. 1.69" class="form-control">
                                    </div>

                                    <?php } ?>

                                    <div class="form-group">
                                        <label>Pressure First,On The Top (Eg. 120) (mmHg)</label> <input  type="text" name="pressure_first" value="" placeholder="Pressure First,On The Top (Eg. 120)" class="form-control">
                                    </div>

                                    
                                    <div class="form-group">
                                        <label>Pressure Second, Below (Eg. 80) (mmHg)</label> <input  type="text" name="pressure_second" value="" placeholder="Pressure Second, Below (Eg. 80)" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Tempature (°C)</label> <input  type="text" name="temperature" value="" placeholder="Eg. 36.4" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Pulse (bpm) </label> <input  type="text" name="pulse" value="" placeholder="Eg. 95" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>SpO2 (%) </label> <input  type="text" name="s_p_0_2" value="" placeholder="Eg. 95" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Respiration </label> <input  type="text" name="respiration" value="" placeholder="Eg. 20" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Fbs </label> <input  type="text" name="fbs" value="" placeholder="Record Fbs" class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <label>Rbs </label> <input  type="text" name="rbs" value="" placeholder="Record Rbs" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Comments on taking vitals </label> <textarea class="summernote" name="comments"  class="form-control">  </textarea>
                                    </div>


                                   

                                    <input  type="hidden" name="on_admission_status" value="ON-ADMISSION" placeholder=""  class="form-control">

                                    <div style="">
                                        <button class="btn btn-primary" style="" type="submit" name="add">Add Vitals</button>

                                        

                                        <a href="admission_monitoring" class="btn btn-default btn-flat md-close" > <<< Cancel >>></a>
                                    </div>

                                    <div></div><br>
                                </form>

                            </div>
                            <div class="modal-footer">
                                

                                <a href="admission_monitoring" class="btn btn-success" > <<< Back</a>
                  
                            </div>
                        </div>
                    </div>
                    <!-- Nifty Modal -->
                            





    

</div>
</div>
</div>

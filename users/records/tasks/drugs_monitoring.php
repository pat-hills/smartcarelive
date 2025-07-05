<body>

  <div class="container-fluid" id="pcont">
    <div class="page-head">
     <h2><?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?> Medications Monitoring</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home </a></li>
          <li class="active"><a href="#">Medications Monitoring</a></li>

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
                                <h3>Give <?php echo @$_SESSION['surname']." ".@$_SESSION['other_names']; ?>  Medications</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body form">
                                <form role="form" action="tasks/insert_drugs_on_admission.php" method="post" autocomplete="off"> 
                                    <div class="form-group">
                                        <label>Patient's Medications</label> 
                                        
                                        
                                         
                                        <select name="drug" class="form-control">

                                        <option>---SELECT DRUG---</option>

                                        <?php
                                                        //getting all doctors ID in option field labelled ID
                                                        patient_on_admission_medications();
                                                        ?>

      </select>

                                    </div>

                                    <div class="form-group">
                                        <label>Quantity</label> <input  type="text" name="quantity" value="" placeholder="" class="form-control">
                                    </div>

                                  

                                   

                                    <div class="form-group">
                                        <label>Comments on given drugs </label> <textarea class="summernote" name="comments"  class="form-control">  </textarea>
                                    </div>


                                   

                                   

                                    <div style="">
                                        <button class="btn btn-primary" style="" type="submit" name="add">Add Medication Give</button>

                                        

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

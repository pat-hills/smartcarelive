<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Edit Patient Walk In</h2>
      <ol class="breadcrumb">
        <li><a href="index">Home</a></li>
       
        <li class="active">Edit Patient Walk In</li>
      </ol>
    </div>
    <div class="cl-mcont"> 
	<div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
          <?php
                                                echo @$_SESSION['inves_err_exist'];
                                                unset($_SESSION['inves_err_exist']);
                                                ?>
                                                
          </div>
          <div class="content">
          <div class="row">
          <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">							
                                    <h3>Edit Walk In Lab Request</h3>
                                </div>
                                <div class="content">

                                
                                <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/edit_walk_in_lab.php" method="post"> 


                                        <!-- <div class="form-group">
                                            <label class="col-sm-3 control-label">Search Fullname : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" type="text"  id="select_patient" name="get_details" class="form-control" placeholder="Search Fullname" value="">
                                            </div>
                                        </div>   -->


                                        <!-- <div id="result" class="list-group"></div> -->
 
                                       

                                       

 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fullname : </label>
                                            <div class="col-sm-6">
                                            <input  autocomplete="off" readonly type="text" value="<?php
                                            if(isset($_SESSION['patient_name']) && !empty($_SESSION['patient_name'])){
                                                echo $_SESSION['patient_name'];
                                            }
                                            
                                          
                                            
                                            
                                            ?>" name="fullname" class="form-control" placeholder="Phone / Contact">
                                            </div>
                                        </div> 

                                        <input required autocomplete="off" readonly type="hidden" value="<?php
                                            if(isset($_SESSION['walk_in_code']) && !empty($_SESSION['walk_in_code'])){
                                                echo $_SESSION['walk_in_code'];
                                            }
                                            
                                          
                                            
                                            
                                            ?>" name="walk_in_code" class="form-control" placeholder="Phone / Contact">

                                             


                                       

                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Select Test: </label>
                                            <div class="col-sm-6">
                                            <select class="select2" multiple name="edit_investigations[]" >

                                            <?php

                                            
$investigations_ = $_SESSION['requested_test'];

 $investigations = explode(',', $investigations_);

 foreach ($investigations as $investigation) {

     echo "<option selected='selected' value=" . $investigation . ">" . investigation_name($investigation) . "</option>";
}
?>




                                                <optgroup label="Investigation">

                                                        <?php
                                                        list_investigations();
                                                        ?>
                                                </optgroup>
                                                


                                            </select>
                                        </div>
                                        </div> 

                                        
                                        <!-- <div class="form-group">
                                            <label class="col-sm-3 control-label">Source : </label>
                                            <div class="col-sm-6">
                                                <select id="source_lab_test" required class="form-control" name="source_test">
 
                                                <option selected="true" disabled="disabled" value=""> SELECT SOURCE </option>
                                                    <option value="SELF-TEST">SELF TEST</option>
                                                    <option value="NON-SELF-TEST">NON SELF TEST</option>
                                                </select>
                                            </div>
                                        </div>  -->


                                     
                                      




                                       


                                        

                                         <div style="text-align: center; margin-top: 10px;"><button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" type="submit" name="update_personal_info">Edit Lab Details</button></div>
                                   

                                </div>

                            </div>


                        </div>

</div>


          </div>
        </div>

       
        
       
     
	
	
    
	</div> 
</div>
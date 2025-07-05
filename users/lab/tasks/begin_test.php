<body>
<?php
 
//$patient_id = $_SESSION['patient_id'];
//$lab_code = $_SESSION['request_code'];

$a = 2;
if(isset($_GET['a'])){
   $a = $_GET['a'];
 } 
     
?>
    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Medical Lab Examination</h2>
            <ol class="breadcrumb">
                <li><a href="#">Tasks</a></li>

                <li class="active">Perform Patient Lab Request</li>
            </ol>
        </div>
                <?php if ($a == 1) { ?>

        <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Search Found</strong>  
                </div>     
            </div>
                <?php } ?>
        <?php if ($a == 0) { ?>

        <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>No Search Found</strong>  
                </div>     
            </div>
                <?php } ?>
        <?php if (isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Success!</strong> <?php echo $_SESSION['successMsg'] ?>
                </div>     
            </div>
            <?php
            unset($_SESSION['successMsg']);
        }
        
        else if (isset($_SESSION['errorMsg'])) {
            ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Error!</strong>  <?php echo $_SESSION['errorMsg'] ?>
                </div>     
            </div>
            <?php
            unset($_SESSION['errorMsg']);
        }
        ?>

        <div class="cl-mcont">

            <div class="row">
                <div class="  col-md-12">

                   
                        <div class=" row block-flat  "  >
                            <div class=" col-sm-12">
                                <div class="header">							
                                    <h3></h3>
                                </div>
                                
                            </div>

                            <div class="   col-sm-12">
                                <h3>Summary Details</h3>
                                <div class=" profile-info">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="avatar">
                                                <img src="<?php
                                                if (isset($_SESSION['patient_id'])) {
                                                    echo patient_profile_picture($_SESSION['patient_id']);
                                                } else {
                                                    echo @no_image();
                                                }
                                                ?>" 
                                                     class="profile-avatar">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">


                                            <?php
                                            //	   //Initialize all sessions here and set database info	
                                            // if (isset($_SESSION['patient_id'])) {
                                            //     $patient_info = get_patient_info($_SESSION['patient_id']);
                                            // }

                                            //
                                             
                                            ?>    
                                            <div class="personal">

                                                <h3 class="name"><?php echo @$_SESSION['patient_name'] . " "; ?></h3>
                                                <p class="description">Patient ID: <?php echo @$_SESSION['patient_id']; ?></p>

                                                <!-- -->
                                                    <?php if (isset($_SESSION['test_names']) && !empty($_SESSION['test_names'])) { ?>
                                                    <p class="description">Requested Lab Test(s): 

                                                        <?php
                                                        
                                                              echo $_SESSION['test_names'];

                                                        ?>

                                                    </p>
                                                <?php }   ?>



                                                <?php if (isset($_SESSION['dob']) && !empty($_SESSION['dob'])) { ?>
                                                    <p class="description">Year(s) Of Patient: 

                                                        <?php
                                                        
                                                              get_age($_SESSION['dob']);

                                                        ?>

                                                    </p>
                                                <?php }   ?>




            
                                            </div>
                                        </div>  
                                       


                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Fields to be updated here-->



                    <div class="row">

                    <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/add_lab_request" method="post"> 
                
                    <div style="text-align: center; margin-top: 10px; float:left;margin-left:17px;"><button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" name="cancel_lab_request">Cancel To Return Back Page</button></div>
                    

                    <?php
                        
                        $get_labs_inferences_by_code = get_labs_inferences_by_code($_SESSION['request_code'],$_SESSION['edit']);

                        $get_lab_requests_to_run = $get_labs_inferences_by_code['requested_test'];

                        $get_lab_requests_to_run = explode(',', $get_lab_requests_to_run);


                            
                        ?>

                    <div class="form-group">
                                            <label class="col-sm-3 control-label">LAB NO. : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" required type="text" name="lab_no" class="form-control" placeholder="Lab No." value="<?php 
                                                if(isset($_SESSION['lab_no']) && !empty($_SESSION['lab_no'])){ echo $_SESSION['lab_no'];}else{

                                                    echo $get_labs_inferences_by_code['lab_no'];
                                                }
                                                
                                                ?>
                                                ">
                                            </div>
                                        </div> 

                       

<?php foreach ($get_lab_requests_to_run as $lab_requests_codes) { ?>


       <!-- //BEGINING OF PROCESSING -->


    <?php if (investigation_name($lab_requests_codes) == "Urine RE") { ?>
                        <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">							
                                <h3><?php echo investigation_name($lab_requests_codes)." Test";
                                 $urine_re = urine_re($_SESSION['patient_id'],$_SESSION['request_code']);
                                
                                ?></h3>
                                </div>
                                <div class="content">

                                  
                                        
                                     <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Appearance:</label><input autocomplete="off"    style="width: 180px" id="appearance"  name="appearance" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $appearance = $urine_re['appearance'];

                                                                    echo $appearance;
                                                                }

                                                                ?>"

                                                                ></td>
                                                                <td> <label>Ketones:</label><input autocomplete="off"    style="width: 180px" id="ketones"  name="ketones" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $ketones = $urine_re['ketones'];

                                                                    echo $ketones;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>  
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Colour:</label><input autocomplete="off"    style="width: 180px" id="colour"  name="colour" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $colour = $urine_re['colour'];

                                                                    echo $colour;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td> <label>Blood:</label><input autocomplete="off"    style="width: 180px" id="blood" name="blood" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $blood = $urine_re['blood'];

                                                                    echo $blood;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Specific Gravity:</label><input autocomplete="off"  style="width: 180px" id="specific_gravity" name="specific_gravity" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $specific_gravity = $urine_re['specific_gravity'];

                                                                    echo $specific_gravity;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td> <label>Nitrite:</label><input autocomplete="off"  style="width: 180px" id="nitrite" name="nitrite" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $nitrite = $urine_re['nitrite'];

                                                                    echo $nitrite;
                                                                }

                                                                ?>"

                                                                ></td>   
                                                            </tr>
                                                             <tr>
                                                                <td> <label>pH:</label><input autocomplete="off"    style="width: 180px" id="ph" name="ph" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $ph = $urine_re['ph'];

                                                                    echo $ph;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td> <label>Bilirubin:</label><input autocomplete="off"  style="width: 180px" id="bilirubin" name="bilirubin" placeholder="" class="form-control"
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $bilirubin = $urine_re['bilirubin'];

                                                                    echo $bilirubin;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>      
                                                            </tr>
                                                             <tr>
                                                                <td> <label>Protein:</label><input autocomplete="off"    style="width: 180px" id="protein" name="protein" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $protein = $urine_re['protein'];

                                                                    echo $protein;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td> <label>Urobilinogen:</label><input autocomplete="off"  style="width: 180px" id="urobilinogen"  name="urobilinogen" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $urobilinogen = $urine_re['urobilinogen'];

                                                                    echo $urobilinogen;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>         
                                                            </tr>


                                                            <tr>
                                                             
                                                                <td> <label>Leukocytes:</label><input autocomplete="off"  style="width: 180px" id="leukocytes"  name="leukocytes" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $leukocytes = $urine_re['leukocytes'];

                                                                    echo $leukocytes;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>         
                                                            </tr>


                                                             <tr>
                                                                <td> <label>Glucose:</label><input autocomplete="off"    style="width: 180px" id="glucose" name="glucose" placeholder="" class="form-control"
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $glucose = $urine_re['glucose'];

                                                                    echo $glucose;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>         
                                                            </tr>

                                                            <tr>
                                                                <td> <label>Epithelial cell:</label><input autocomplete="off"    style="width: 180px" id="epithelial_cell" name="epithelial_cell" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $epithelial_cell = $urine_re['epithelial_cell'];

                                                                    echo $epithelial_cell;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td> <label>pus cell:</label><input autocomplete="off"  style="width: 180px" id="pus_cell"  name="pus_cell" placeholder="" class="form-control"
                                                                
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $pus_cell = $urine_re['pus_cell'];

                                                                    echo $pus_cell;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>         
                                                            </tr>

                                                            <tr>
                                                                <td> <label>Rbc's:</label><input autocomplete="off"    style="width: 180px" id="rbcs" name="rbcs" placeholder="" class="form-control"
                                                                
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $rbcs = $urine_re['rbcs'];

                                                                    echo $rbcs;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td> <label>Casts:</label><input autocomplete="off"  style="width: 180px" id="wbc_cast"  name="wbc_cast" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $wbc_cast = $urine_re['wbc_cast'];

                                                                    echo $wbc_cast;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>         
                                                            </tr>

                                                            <tr>
                                                                <td> <label>Crystals:</label><input autocomplete="off"    style="width: 180px" id="crystals" name="crystals" placeholder="" class="form-control"
                                                                
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $crystals = $urine_re['crystals'];

                                                                    echo $crystals;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td style="display:none"> <label>Ova:</label><input autocomplete="off"  style="width: 180px" id="ova"  name="ova" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $ova = $urine_re['ova'];

                                                                    echo $ova;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>         
                                                            </tr>

                                                            <tr>
                                                                <td> <label>T vaginals:</label><input autocomplete="off"    style="width: 180px" id="t_vaginals" name="t_vaginals" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $t_vaginals = $urine_re['t_vaginals'];

                                                                    echo $t_vaginals;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td> <label>Bacteria:</label><input autocomplete="off"  style="width: 180px" id="bacteria"  name="bacteria" placeholder="" class="form-control"
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $bacteria = $urine_re['bacteria'];

                                                                    echo $bacteria;
                                                                }

                                                                ?>"
                                                                
                                                                
                                                                ></td>         
                                                            </tr>

                                                            <tr>
                                                                <td> <label>Yeast Like Cells:</label><input autocomplete="off"  style="width: 180px" id="yeast_like_cells" name="yeast_like_cells" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $yeast_like_cells = $urine_re['yeast_like_cells'];

                                                                    echo $yeast_like_cells;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                <td> <label>S haematobium:</label><input autocomplete="off"  style="width: 180px" id="s_haemoglobin"  name="s_haemoglobin" placeholder="" class="form-control"
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $s_haemoglobin = $urine_re['s_haemoglobin'];

                                                                    echo $s_haemoglobin;
                                                                }

                                                                ?>"

                                                                
                                                                ></td>         
                                                            </tr>

                                                            <tr>
                                                                <td> <label>Spermatozoa:</label><input autocomplete="off"  style="width: 180px" id="Spermatozoa" name="Spermatozoa" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $Spermatozoa = $urine_re['spermatozoa'];

                                                                    echo $Spermatozoa;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                
                                                                <td> <label>Comments:</label>
                                                                
                                                                <textarea autocomplete="off" id="commentsurine"  name="commentsurine" placeholder="" class="form-control">
                                                                <?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $commentsurine = $urine_re['comments'];

                                                                    echo $commentsurine;
                                                                }

                                                                ?>

                                                                
                                                            </textarea>
                                                            
                                                            </td>         
                                                            </tr>


                                                            <tr>
                                                                <td> <label>Others(Parameter/Name):</label><input autocomplete="off"  style="width: 180px" id="others" name="others" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $others = $urine_re['others'];

                                                                    echo $others;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                                
                                                                <td> <label>Others(Results/Value):</label>
                                                                
                                                                <input autocomplete="off"  style="width: 180px" id="others_value" name="others_value" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$urine_re == null){
                                                                    $others_value = $urine_re['others_value'];

                                                                    echo $others_value;
                                                                }

                                                                ?>"
                                                                
                                                                >
                                                            
                                                            </td>         
                                                            </tr>


                                                            
                                                        </tbody>
                                                    </table>
                                         

                                                    <input type="hidden" value="<?php echo "Urine RE" ?>"  style="width: 180px" id="urine_re" name="urine_re" placeholder="" class="form-control">
                                         
                                  
                                </div>

                            </div>


                        </div>

                        <?php }

                        
                        
                        
                        
                        else if (investigation_name($lab_requests_codes) == "Stool RE") {
                            ?>


                        <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">              
                                <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
                                
                                $stool_re = stool_re($_SESSION['patient_id'],$_SESSION['request_code']);
                                
                                ?></h3>
                                </div>
                                <div class="content">
 
                                         
                                               <table>
                                                        <tbody>
                                                            
                                                            <tr>
                                                                <td> <label>Macroscopy:</label><input autocomplete="off"    style="width: 180px" id="macroscopy" name="macroscopy" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$stool_re == null){
                                                                    $macroscopy = $stool_re['macroscopy'];

                                                                    echo $macroscopy;
                                                                }

                                                                ?>"
                                                                
                                                                
                                                                ></td>  
                                                            </tr>
                                                             <tr>
                                                                <td> <label>Microscopy:</label><input autocomplete="off"    style="width: 180px" id="microscopy" name="microscopy" placeholder="" class="form-control"
                                                                
                                                                value="<?php 
                                                                
                                                                if(!$stool_re == null){
                                                                    $microscopy = $stool_re['microscopy'];

                                                                    echo $microscopy;
                                                                }

                                                                ?>"
                                                                
                                                                ></td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>  
                                                    
                                                    <input type="hidden" value="<?php echo "Stool RE" ?>"   style="width: 180px" id="stool_re" name="stool_re" placeholder="" class="form-control">
                                         
                                      
                                </div>

                            </div>

                            <?php }
                            
                            
                            else if (investigation_name($lab_requests_codes) == "Widal") {
                                ?>
    
    
                            <div class="col-sm-12 col-md-12">
                                <div class="block-flat">
                                    <div class="header">              
                                    <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
                                     $Widal_test = Widal_test($_SESSION['patient_id'],$_SESSION['request_code']);

                                    // var_dump ( $Widal_test);
                                    
                                    
                                    ?></h3>
                                    </div>
                                    <div class="content">


                                    <table>
										<tbody>
										    <tr>
                                                <td> <label>S typhi 'O':</label><input autocomplete="off"
                                                
                                                value="<?php

                                                $s_typhi_o = "";
                                               // $s_typhi_h = "";
                                                
                                                if(!$Widal_test == null){

                                                    $s_typhi_o = $Widal_test['s_typhi_o'];

                                                    echo $s_typhi_o;

                                                }
                                                
                                                ?>"
                                                
                                                  style="width: 220px" id="s_typhi_o" name="s_typhi_o" placeholder="" class="form-control"></td>                                
                                            </tr>  
											<tr>
												<td> <label>S typhi 'H':</label><input autocomplete="off"  
                                                
                                                value="<?php

                                              //  $s_typhi_o = "";
                                                $s_typhi_h = "";
                                                
                                                if(!$Widal_test == null){

                                                    $s_typhi_h = $Widal_test['s_typhi_h'];

                                                    echo $s_typhi_h;

                                                }
                                                
                                                ?>"
                                                
                                                style="width: 220px" id="s_typhi_h" name="s_typhi_h" placeholder="" class="form-control"></td>								
											</tr>
											<td> <label>Comment:</label>    
                                                <div>
                                                    <textarea  id="comment" name="commentw" class="form-control" height="60px"><?php 
                                                   if(isset($Widal_test['comment'])){
                                                    echo $Widal_test['comment']; 
                                                   }
                                                   
                                                    
                                                    ?></textarea>
                                                </div>
                                            </td>
										</tbody>
									</table>

 
                                    <input type="hidden" value="<?php echo "Widal" ?>" required style="width: 180px" id="Widal" name="Widal" placeholder="" class="form-control">
                                            
                                          
                                    </div>
    
                                </div>
    
                                <?php }

else if (investigation_name($lab_requests_codes) == "GLYCATED HAEMOGLOBIN") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $glycated_haemoglobin = glycated_haemoglobin($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td> <label>GLYCATED HAEMOGLOBIN:</label><input  style="width: 220px" id="GLYCATED_HAEMOGLOBIN_value" name="GLYCATED_HAEMOGLOBIN_value" placeholder="" class="form-control"
                    
                    value="<?php 
                    
                    if(!$glycated_haemoglobin == null){

                        $GLYCATED_HAEMOGLOBIN = $glycated_haemoglobin['GLYCATED_HAEMOGLOBIN'];

                        echo $GLYCATED_HAEMOGLOBIN;

                    }
  
                    ?>"
                    
                    
                    
                    ></td>
                    
                    <td>
                        
                        <label>Evaluation:</label>
                        
                        <select   style="width: 220px" id="GLYCATED_HAEMOGLOBIN_EVALUATION" name="GLYCATED_HAEMOGLOBIN_EVALUATION" class="form-control">
    
                        <?php if (!$glycated_haemoglobin == null) { ?>
    
    <option value="<?php echo $glycated_haemoglobin['evaluation'] ?>"> <?php echo $glycated_haemoglobin['evaluation'] ?></option>
                    <option value="H"> HIGH</option>
                    <option value="L"> LOW </option>
    
    
                <?php } else { ?>
                    <option selected="true" disabled="disabled" value=""> SELECT EVALUATION </option>
    <option value="H"> HIGH</option>
    <option value="L"> LOW </option>
                    
                <?php } ?>
    
                       </select>
                    
                    
                    </td>  
                    

                </tr>  
                
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "GLYCATED HAEMOGLOBIN" ?>"   style="width: 180px" id="WiGLYCATED_HAEMOGLOBINdal" name="GLYCATED_HAEMOGLOBIN" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    

}

else if (investigation_name($lab_requests_codes) == "HAEMOGLOBIN LEVEL") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $level_haemoglobin = level_haemoglobin($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td> <label>HAEMOGLOBIN LEVEL:</label><input type="number" step="any"   style="width: 220px" id="HAEMOGLOBIN_LEVEL_value" name="HAEMOGLOBIN_LEVEL_value" placeholder="" class="form-control"
                    value="<?php 
                    
                    if(!$level_haemoglobin == null){

                        $hae_lev = $level_haemoglobin['hae_lev'];

                        echo $hae_lev;

                    }
  
                    ?>"
                    
                    ></td>                                
                </tr>  
                
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "HAEMOGLOBIN LEVEL" ?>"   style="width: 180px" id="HAEMOGLOBIN_LEVEL" name="HAEMOGLOBIN_LEVEL" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php }





else if (investigation_name($lab_requests_codes) == "FBC") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $get_FBC_results = get_FBC_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
                                        <tbody>
                                            <tr>
                                                <td> <label>WHITE BLOOD CELLS ( WBC ):</label><input autocomplete="off"  style="width: 180px" id="wbc" name="wbc" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $WBC = $get_FBC_results['WBC'];

                                                                    echo $WBC;
                                                                }

                                                                ?>"
                                                
                                                ></td>
                                                <td> <label>Lymphocytes #:</label><input autocomplete="off"  style="width: 180px" id="Lymphocytes_hash" name="Lymphocytes_hash" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $Lymphocytes_hash = $get_FBC_results['Lymphocytes_hash'];

                                                                    echo $Lymphocytes_hash;
                                                                }

                                                                ?>"
                                                
                                                ></td>   
                                            </tr>
                                            
                                            <tr>
                                                <td> <label>Mid #:</label><input  autocomplete="off"  style="width: 180px" id="Mid_hash" name="Mid_hash" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $mid_hash = $get_FBC_results['mid_hash'];

                                                                    echo $mid_hash;
                                                                }

                                                                ?>"
                                                
                                                ></td>
                                                <td> <label>Gran #:</label><input autocomplete="off"  style="width: 180px" id="Gran_hash" name="Gran_hash" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $gran_hash = $get_FBC_results['gran_hash'];

                                                                    echo $gran_hash;
                                                                }

                                                                ?>"
                                                
                                                ></td>
                                            </tr>
                                            
                                            <tr>
                                                <td> <label>% Lymphocytes :</label><input autocomplete="off"  style="width: 180px" id="Lymphocytes_percent" name="Lymphocytes_percent" placeholder="" class="form-control"
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $Lymphocytes_percent = $get_FBC_results['Lymphocytes_percent'];

                                                                    echo $Lymphocytes_percent;
                                                                }

                                                                ?>"
                                                
                                                ></td>
                                                <td> <label>% Mid:</label><input autocomplete="off"  style="width: 180px" id="Mid_percent"  name="Mid_percent" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $mid_percent = $get_FBC_results['mid_percent'];

                                                                    echo $mid_percent;
                                                                }

                                                                ?>"
                                                
                                                ></td>   
                                            </tr>
                                            <tr>
                                                <td> <label>% Gran:</label><input autocomplete="off"  style="width: 180px" id="Gran_percent" name="Gran_percent" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $gran_percent = $get_FBC_results['gran_percent'];

                                                                    echo $gran_percent;
                                                                }

                                                                ?>"
                                                
                                                ></td>
                                                <td> <label>RBC</label><input autocomplete="off"  style="width: 180px" id="RBC" name="RBC" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $RBC = $get_FBC_results['RBC'];

                                                                    echo $RBC;
                                                                }

                                                                ?>"
                                                
                                                ></td>      
                                            </tr>
                                             <tr>
                                                <td> <label>HGB:</label><input autocomplete="off"  style="width: 180px" id="HGB" name="HGB" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $HGB = $get_FBC_results['HGB'];

                                                                    echo $HGB;
                                                                }

                                                        ?>"
                                                
                                                ></td>
                                                <td> <label>HCT:</label><input autocomplete="off"  style="width: 180px" id="HCT" name="HCT" placeholder="" class="form-control"
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $HCT = $get_FBC_results['HCT'];

                                                                    echo $HCT;
                                                                }

                                                        ?>"
                                                
                                                ></td>         
                                            </tr>
                                            <tr> 
                                                <td> <label>MCV:</label><input autocomplete="off"  style="width: 180px" id="MCV" name="MCV" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $MCV = $get_FBC_results['MCV'];

                                                                    echo $MCV;
                                                                }

                                                        ?>"
                                                
                                                ></td>
                                                <td> <label>MCH:</label><input autocomplete="off"  style="width: 180px" id="hcm_lab" name="hcm_lab" placeholder="" class="form-control"
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $MCH = $get_FBC_results['MCH'];

                                                                    echo $MCH;
                                                                }

                                                        ?>"
                                                
                                                ></td>
                                                
                                            </tr>
                                            <tr>  
                                                <td> <label>MCHC:</label><input autocomplete="off"  style="width: 180px" id="MCHC" name="MCHC" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $MCHC = $get_FBC_results['MCHC'];

                                                                    echo $MCHC;
                                                                }

                                                        ?>"
                                                
                                                ></td>
                                                
                                            </tr>
                                            <tr>

                                                <td> <label>RDW-CV:</label><input autocomplete="off"  style="width: 180px" id="RDW_CV" name="RDW_CV" placeholder="" class="form-control"
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $RDW_CV = $get_FBC_results['RDW_CV'];

                                                                    echo $RDW_CV;
                                                                }

                                                        ?>"
                                                
                                                ></td>
                                               
                                                <td> <label>RDW-SD:</label><input autocomplete="off"  style="width: 180px" id="RDW_SD"  name="RDW_SD" placeholder="" class="form-control"
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $RDW_SD = $get_FBC_results['RDW_SD'];

                                                                    echo $RDW_SD;
                                                                }

                                                        ?>"
                                                
                                                ></td>         
                                          
                                            </tr>
                                            <tr>
                                                <td> <label>PLT:</label><input autocomplete="off"  style="width: 180px" id="PLT" name="PLT" placeholder="" class="form-control"
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $PLT = $get_FBC_results['PLT'];

                                                                    echo $PLT;
                                                                }

                                                        ?>"
                                                
                                                ></td>
                                                <td> <label>MPV:</label><input autocomplete="off"  style="width: 180px" id="MPV"  name="MPV" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $PLT = $get_FBC_results['PLT'];

                                                                    echo $PLT;
                                                                }

                                                        ?>"
                                                
                                                
                                                ></td>         
                                            </tr>
                                            <tr>
                                                <td> <label>PDW:</label><input autocomplete="off"  style="width: 180px" id="PDW" name="PDW" placeholder="" class="form-control"
                                                
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $PDW = $get_FBC_results['PDW'];

                                                                    echo $PDW;
                                                                }

                                                        ?>"

                                                
                                                ></td>

                                           


                                                <td> <label>PCT:</label><input  autocomplete="off"  style="width: 180px" id="PCT"  name="PCT" placeholder="" class="form-control"
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $PCT = $get_FBC_results['PCT'];

                                                                    echo $PCT;
                                                                }

                                                        ?>"
                                                
                                                ></td> 
                                                
                                                

                                            </tr>

                                            <?php
                                    
                                    
                                    if(PROJECT_MDNA == TRUE) { ?>


                                            <tr>


                                            
                                            <td> <label>P-LCR:</label><input  autocomplete="off"  style="width: 180px" id="P_LCR"  name="P_LCR" placeholder="" class="form-control"
                                                value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $P_LCR = $get_FBC_results['P_LCR'];

                                                                    echo $P_LCR;
                                                                }

                                                        ?>"
                                                
                                                ></td> 

                                            </tr>

                                            <?php } ?>

                                            
                                    <?php
                                    
                                    
                                    if(IS_LAB_TYPE_OTHER_PARTY_MACHINE == false) { ?>

 




											
                                            <tr>
                                            <td> <label>Basophils:</label><input style="width: 180px" id="basophils" name="basophils" placeholder="" class="form-control"
                                            
                                            value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $basophils = $get_FBC_results['basophils'];

                                                                    echo $basophils;
                                                                }

                                                        ?>"
                                            
                                            
                                            ></td>           
												
                                            <td> <label>Eosinophils:</label><input style="width: 180px" id="eosinophils" name="eosinophils" placeholder="" class="form-control"
                                            
                                            value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $basophils = $get_FBC_results['basophils'];

                                                                    echo $basophils;
                                                                }

                                                        ?>"
                                            
                                            
                                            ></td>
                                                                                  
                                            </tr>

                                            <tr>
                                            <td> <label>Monocytes:</label><input style="width: 180px" id="Monocytes" name="Monocytes" placeholder="" class="form-control"
                                            
                                            value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $monocytes = $get_FBC_results['monocytes'];

                                                                    echo $monocytes;
                                                                }

                                                        ?>"
                                            
                                            
                                            ></td>           
												
                                            <td> <label>Neutrophils:</label><input style="width: 180px" id="Neutrophils" name="Neutrophils" placeholder="" class="form-control"
                                            
                                            value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $neutrophils = $get_FBC_results['neutrophils'];

                                                                    echo $neutrophils;
                                                                }

                                                        ?>"
                                            
                                            
                                            ></td>
                                                                                  
                                            </tr>

                                            <tr>
                                            <td> <label>Retics:</label><input style="width: 180px" id="retics" name="retics" placeholder="" class="form-control"
                                            
                                            value="<?php 
                                                                
                                                                if(!$get_FBC_results == null){
                                                                    $retics = $get_FBC_results['retics'];

                                                                    echo $retics;
                                                                }

                                                        ?>"
                                            
                                            ></td>           
												
                                                                                    
                                            </tr>



                                            <tr> 
												                                                        
                                            </tr>


                                            <?php } ?>
                                            
                                        </tbody>
                                    </table>


                                    <input type="hidden" value="<?php echo "FBC" ?>"   style="width: 180px" id="FBC" name="FBC" placeholder="" class="form-control">
                                         
              
        </div>

    </div>

    <?php }

else if (investigation_name($lab_requests_codes) == "Microbiology") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; ?></h3>
        </div>
        <div class="content">


        <table>
                                                        <tbody>
                                                            <tr>
                                                                <td> <label>Pus Cells:</label><input style="width: 180px" id="pus_cells" name="pus_cells" placeholder="" class="form-control"></td>
                                                                <td> <label>RBC's:</label><input style="width: 180px" id="rbcs" name="rbcs" placeholder="" class="form-control"></td>                                                                      
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td> <label>Epith Cells:</label><input style="width: 180px" id="epith_cells" name="epith_cells" placeholder="" class="form-control"></td>
                                                                <td> <label>T. Vaginalis:</label><input style="width: 180px" id="t_vaginalis" name="t_vaginalis" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Bacteriodes:</label><input style="width: 180px" id="bacteriodes" name="bacteriodes" placeholder="" class="form-control"></td>
                                                                <td> <label>Yeast Cells:</label><input style="width: 180px" id="yeast_cells"  name="yeast_cells" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> <label>S.H/masoni:</label><input style="width: 180px" id="s_h_masoni"  name="s_h_masoni" placeholder="" class="form-control"></td>
                                                                <td> <label>Crystals:</label><input style="width: 180px" id="crystals" name="crystals" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> <label>Casts:</label><input style="width: 180px" id="casts" name="casts" placeholder="" class="form-control"></td>
                                                                <td> <label>Blood Filming:</label><input style="width: 180px" id="blood_filming" name="blood_filming" placeholder="" class="form-control"></td>                                     
                                                            </tr>
                                                            <tr>
                                                                <td> </td>
                                                                <td> </td>                                     
                                                            </tr>
                                                            <tr>
                                                                <!-- <td> <label>HBsAg:</label><input style="width: 180px" id="hbsag" name="hbsag" placeholder="" class="form-control"></td>
                                                               -->
                                                                <td> <label>VDRL/KAHN:</label><input style="width: 180px" id="vdrl_kahn" name="vdrl_kahn" placeholder="" class="form-control"></td>                                     
                                                           
                                                            </tr>
                                                            <!-- <tr>
                                                                <td> <label>Urine Preg Test:</label><input style="width: 180px" id="urine_preg_test" name="urine_preg_test" placeholder="" class="form-control"></td>                                             
                                                           
                                                            </tr> -->
                                                        </tbody>
                                                    </table>


                                                    <input type="hidden" value="<?php echo "Microbiology" ?>" required style="width: 180px" id="glucose" name="glucose" placeholder="" class="form-control">
                                 
              
        </div>

    </div>

    <?php }

else if (investigation_name($lab_requests_codes) == "LFT") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test";
        
        $get_lft_results = get_lft_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td> <label>S-BILIRUBIN (Total):</label><input autocomplete="off"    style="width: 220px" id="S_BILIRUBIN_Total" name="S_BILIRUBIN_Total" placeholder="" class="form-control"
                    
                                                     value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_BILIRUBIN_Total = $get_lft_results['S_BILIRUBIN_Total'];

                                                                    echo $S_BILIRUBIN_Total;
                                                                }

                                                        ?>"
                    
                    ></td>                                
                   <?php
                    if(IS_LFT_DIRECT == false) { ?>

                    <td> <label>S-BILIRUBIN conjugated:</label><input autocomplete="off"    style="width: 220px" id="S_BILIRUBIN_conjugated" name="S_BILIRUBIN_conjugated" placeholder="" class="form-control"
                    
                                                       value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_BILIRUBIN_conjugated = $get_lft_results['S_BILIRUBIN_conjugated'];

                                                                    echo $S_BILIRUBIN_conjugated;
                                                                }

                                                        ?>"
                    
                    
                    ></td>								
                    <?php }
                    
                    ?>

                    <?php
                    if(IS_LFT_DIRECT == true) { ?>

                    <td> <label>S-BILIRUBIN DIRECT:</label><input autocomplete="off"    style="width: 220px" id="S_BILIRUBIN_DIRECT" name="S_BILIRUBIN_DIRECT" placeholder="" class="form-control"
                    
                                                          value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_BILIRUBIN_DIRECT = $get_lft_results['S_BILIRUBIN_DIRECT'];

                                                                    echo $S_BILIRUBIN_DIRECT;
                                                                }

                                                        ?>"
                    
                    ></td>								
                    <?php }
                    
                    ?>
                
               
                </tr>  
                <tr>
                <td> <label>S-ALKALINE PHOSPHATASE:</label><input autocomplete="off" style="width: 220px" id="S_ALKALINE_PHOSPHATASE" name="S_ALKALINE_PHOSPHATASE" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_ALKALINE_PHOSPHATASE = $get_lft_results['S_ALKALINE_PHOSPHATASE'];

                                                                    echo $S_ALKALINE_PHOSPHATASE;
                                                                }

                                                        ?>"
                
                ></td>								
                 
                <td> <label>S-g-GLUTAMYL TRANSFERASE:</label><input autocomplete="off" style="width: 220px" id="S_g_GLUTAMYL_TRANSFERASE" name="S_g_GLUTAMYL_TRANSFERASE" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_g_GLUTAMYL_TRANSFERASE = $get_lft_results['S_g_GLUTAMYL_TRANSFERASE'];

                                                                    echo $S_g_GLUTAMYL_TRANSFERASE;
                                                                }

                                                        ?>"
                
                ></td>								
               
                </tr>
               
                <tr>
                    <td> <label>S-ALT (GPT):</label><input autocomplete="off" style="width: 220px" id="S_ALT_GPT" name="S_ALT_GPT" placeholder="" class="form-control"
                    value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_ALT_GPT = $get_lft_results['S_ALT_GPT'];

                                                                    echo $S_ALT_GPT;
                                                                }

                                                        ?>"
                    ></td>								
               
                    <td> <label>S-AST (GOT):</label><input autocomplete="off" style="width: 220px" id="S_AST_GOT" name="S_AST_GOT" placeholder="" class="form-control"
                    value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_AST_GOT = $get_lft_results['S_AST_GOT'];

                                                                    echo $S_AST_GOT;
                                                                }

                                                        ?>"
                    
                    ></td>								
               
                </tr>
                

                <tr>
                    <td> <label>S-TOTAL PROTEIN:</label><input autocomplete="off" style="width: 220px" id="S_TOTAL_PROTEIN" name="S_TOTAL_PROTEIN" placeholder="" class="form-control"
                    value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_TOTAL_PROTEIN = $get_lft_results['S_TOTAL_PROTEIN'];

                                                                    echo $S_TOTAL_PROTEIN;
                                                                }

                                                        ?>"
                    
                    ></td>								
               
                    <td> <label>S-ALBUMIN:</label><input autocomplete="off" style="width: 220px" id="S_ALBUMIN" name="S_ALBUMIN" placeholder="" class="form-control"
                    
                    value="<?php 
                                                                
                                                                if(!$get_lft_results == null){
                                                                    $S_ALBUMIN = $get_lft_results['S_ALBUMIN'];

                                                                    echo $S_ALBUMIN;
                                                                }

                                                        ?>"
                    
                    ></td>								
               
                </tr>

               
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "LFT" ?>" style="width: 180px" id="lft" name="lft" placeholder="" class="form-control">
                                     
              
        </div>

    </div>

    <?php }

else if (investigation_name($lab_requests_codes) == "HVSRE") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test";
        
        $get_HVSRE_results = get_HVSRE_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td> <label>EP Cell:</label><input autocomplete="off"    style="width: 220px" id="ep_cell" name="ep_cell" placeholder="" class="form-control"
                    
                                                     value="<?php 
                                                                
                                                                if(!$get_HVSRE_results == null){
                                                                    $ep_cell = $get_HVSRE_results['ep_cell'];

                                                                    echo $ep_cell;
                                                                }

                                                        ?>"
                    
                    ></td>                                

                
               
                </tr>  
                <tr>
                <td> <label>Pus Cell:</label><input autocomplete="off" style="width: 220px" id="pus_cell" name="pus_cell" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_HVSRE_results == null){
                                                                    $pus_cell = $get_HVSRE_results['pus_cell'];

                                                                    echo $pus_cell;
                                                                }

                                                        ?>"
                
                ></td>								
                 
                <td> <label>Rbcs:</label><input autocomplete="off" style="width: 220px" id="rbcs" name="rbcs" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_HVSRE_results == null){
                                                                    $rbcs = $get_HVSRE_results['rbcs'];

                                                                    echo $rbcs;
                                                                }

                                                        ?>"
                
                ></td>								
               
                </tr>
               
                <tr>
                    <td> <label>T Vaginalis:</label><input autocomplete="off" style="width: 220px" id="t_vaginalis" name="t_vaginalis" placeholder="" class="form-control"
                    value="<?php 
                                                                
                                                                if(!$get_HVSRE_results == null){
                                                                    $t_vaginalis = $get_HVSRE_results['t_vaginalis'];

                                                                    echo $t_vaginalis;
                                                                }

                                                        ?>"
                    ></td>								
               
                    <td> <label>Bacteria:</label><input autocomplete="off" style="width: 220px" id="bacteria" name="bacteria" placeholder="" class="form-control"
                    value="<?php 
                                                                
                                                                if(!$get_HVSRE_results == null){
                                                                    $bacteria = $get_HVSRE_results['bacteria'];

                                                                    echo $bacteria;
                                                                }

                                                        ?>"
                    
                    ></td>								
               
                </tr>
                

                <tr>
                    <td> <label>Yeast Like Cells:</label><input autocomplete="off" style="width: 220px" id="yeast_like_cells" name="yeast_like_cells" placeholder="" class="form-control"
                    value="<?php 
                                                                
                                                                if(!$get_HVSRE_results == null){
                                                                    $yeast_like_cells = $get_HVSRE_results['yeast_like_cells'];

                                                                    echo $yeast_like_cells;
                                                                }

                                                        ?>"
                    
                    ></td>								
               
                    							
               
                </tr>

               
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "HVSRE" ?>" style="width: 180px" id="HVSRE" name="HVSRE" placeholder="" class="form-control">
                                     
              
        </div>

    </div>

    <?php }

    
    else if (investigation_name($lab_requests_codes) == "Malaria") {
        ?>


      <div class="col-sm-12 col-md-12">
        <div class="block-flat">
            <div class="header">              
            <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
              $get_MALARIA_test= MALARIA_test($_SESSION['patient_id'],$_SESSION['request_code']);
            
            
            ?></h3>
            </div>
            <div class="content">


            <table>
                <tbody>
                    <tr>
                        <td>
                            
                        <label>Test Status:</label>
                        
                        <select  style="width: 220px" id="malaria" name="malaria_status" class="form-control">

                        <?php if (!$get_MALARIA_test == null) { ?>

                            <option value="<?php echo $get_MALARIA_test['test_status'] ?>"> <?php echo $get_MALARIA_test['test_status'] ?></option>
                                            <option value="Negative"> Negative</option>
                                            <option value="Positive"> Positive </option>

                    
                                        <?php } else { ?>
                                            <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                    <option value="Negative"> Negative</option>
                    <option value="Positive"> Positive </option>
                                            
                                        <?php } ?>

                       </select>
                    
                    
                    </td>                                
                  
                  
                    </tr>  
                     
                    <td> <label>Comment:</label>    
                        <div>
                            <textarea  id="comment" name="comment_malaria" class="form-control" height="60px"><?php 

                            if(isset($get_MALARIA_test)){
                                echo $get_MALARIA_test['remarks'];
                            }
                            
                            
                            ?></textarea>
                        </div>
                    </td>
                </tbody>
            </table>


            <input type="hidden" value="<?php echo "Malaria" ?>" required style="width: 180px" id="Malaria" name="Malaria" placeholder="" class="form-control">
                    
                  
            </div>

        </div>

        <?php }



    
else if (investigation_name($lab_requests_codes) == "HEPATITIS B PROFILE") {
    ?>


  <div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $hepatitis_B_profile= hepatitis_B_profile($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>

                <tr>
                    <td>
                    <label>HBsAg:</label>
                    
                    <select style="width: 220px" id="HBsAg" name="HBsAg" class="form-control">

                    <?php if (!$hepatitis_B_profile == null) { ?>

                        <option value="<?php echo $hepatitis_B_profile['HBsAg'] ?>"> <?php echo $hepatitis_B_profile['HBsAg'] ?></option>
                    <option value="Non-Reactive"> Non-Reactive </option>
                    <option value="Reactive"> Reactive </option>
                    <?php } else { ?>

                        <option value=""> SELECT STATUS </option>
                    <option value="Non-Reactive"> Non-Reactive </option>
                    <option value="Reactive"> Reactive </option>

                        <?php } ?>

                   </select>
                </td>            
                </tr> 
                
                
                <tr>
                    <td>
                    <label>HBsAb:</label>
                    
                    <select style="width: 220px" id="HBsAb" name="HBsAb" class="form-control">

                    <?php if (!$hepatitis_B_profile == null) { ?>

                    <option value="<?php echo $hepatitis_B_profile['HBsAb'] ?>"> <?php echo $hepatitis_B_profile['HBsAb'] ?></option>
                    <option value="Non-Reactive"> Non-Reactive </option>
                    <option value="Reactive"> Reactive </option>
                    <?php } else { ?>

                    <option value=""> SELECT STATUS </option>
                    <option value="Non-Reactive"> Non-Reactive </option>
                    <option value="Reactive"> Reactive </option>

                    <?php } ?>

                   </select>
                </td>            
                </tr>  


                <tr>
                    <td>
                    <label>HBeAg:</label>
                    
                    <select style="width: 220px" id="HBeAg" name="HBeAg" class="form-control">

                                        <?php if (!$hepatitis_B_profile == null) { ?>

                    <option value="<?php echo $hepatitis_B_profile['HBeAg'] ?>"> <?php echo $hepatitis_B_profile['HBeAg'] ?></option>
                    <option value="Non-Reactive"> Non-Reactive </option>
                    <option value="Reactive"> Reactive </option>
                    <?php } else { ?>

                    <option value=""> SELECT STATUS </option>
                    <option value="Non-Reactive"> Non-Reactive </option>
                    <option value="Reactive"> Reactive </option>

                    <?php } ?>

                   </select>
                </td>            
                </tr>  


                <tr>
                    <td>
                    <label>HBeAb:</label>
                    
                    <select style="width: 220px" id="HBeAb" name="HBeAb" class="form-control">

                                            <?php if (!$hepatitis_B_profile == null) { ?>

                        <option value="<?php echo $hepatitis_B_profile['HBeAb'] ?>"> <?php echo $hepatitis_B_profile['HBeAb'] ?></option>
                        <option value="Non-Reactive"> Non-Reactive </option>
                        <option value="Reactive"> Reactive </option>
                        <?php } else { ?>

                        <option value=""> SELECT STATUS </option>
                        <option value="Non-Reactive"> Non-Reactive </option>
                        <option value="Reactive"> Reactive </option>

                        <?php } ?>

                   </select>
                </td>            
                </tr>
                
                
                <tr>
                    <td>
                    <label>HBcAb:</label>
                    
                    <select style="width: 220px" id="HBcAb" name="HBcAb" class="form-control">

 
                                        <?php if (!$hepatitis_B_profile == null) { ?>

                    <option value="<?php echo $hepatitis_B_profile['HBcAb'] ?>"> <?php echo $hepatitis_B_profile['HBcAb'] ?></option>
                    <option value="Non-Reactive"> Non-Reactive </option>
                    <option value="Reactive"> Reactive </option>
                    <?php } else { ?>

                    <option value=""> SELECT STATUS </option>
                    <option value="Non-Reactive"> Non-Reactive </option>
                    <option value="Reactive"> Reactive </option>

                    <?php } ?>
                   </select>
                </td>            
                </tr>
                
                <td> <label>Comment:</label>    
                        <div>
                            <textarea  id="comment" name="comment_hepatitisB_profile" class="form-control" height="60px"><?php 
                            if(isset($hepatitis_B_profile['comments'])){
                                echo $hepatitis_B_profile['comments'];
                            }
                           
                            
                            ?></textarea>
                        </div>
                    </td>
                 
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "HEPATITIS B PROFILE" ?>" required style="width: 180px" id="HEPATITIS_B_PROFILE" name="HEPATITIS_B_PROFILE" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php }




else if (investigation_name($lab_requests_codes) == "G6PD") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $get_gpd = get_gpd($_SESSION['patient_id'],$_SESSION['request_code']);
        
       // var_dump($get_gpd);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select  style="width: 220px" id="G6PD" name="g6pd_status" class="form-control">

                    <?php if ($get_gpd != null) { ?>
                        <option value="<?php echo $get_gpd['test_status'] ?>"> <?php echo $get_gpd['test_status'] ?></option>
                       
                                            <option value="PARTIAL DEFECT">PARTIAL DEFECT</option>
                                            <option value="FULL DEFECT"> FULL DEFECT </option>
                                            <option value="NO DEFECT"> NO DEFECT </option>
                                        <?php } else { ?>

                                            <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                                            <option value="PARTIAL DEFECT">PARTIAL DEFECT</option>
                                            <option value="FULL DEFECT"> FULL DEFECT </option>
                                            <option value="NO DEFECT"> NO DEFECT </option>
                                        <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "G6PD" ?>" required style="width: 180px" id="G6PD" name="G6PD" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php }




else if (investigation_name($lab_requests_codes) == "Hepatitis B") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $get_hepatitis_B = hepatitis_B($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select  style="width: 220px" id="HepatitisB" name="HepatitisB_Status" class="form-control">

                    <?php if ($get_hepatitis_B != null) { ?>
                        <option value="<?php echo $get_hepatitis_B['test_status'] ?>"> <?php echo $get_hepatitis_B['test_status'] ?></option>

                    <option value="Negative"> Negative</option>
                    <option value="Positive"> Positive </option>
                                        <?php } else { ?>

                                            <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                                            <option value="Negative"> Negative</option>
                                            <option value="Positive"> Positive </option>
                                        <?php } ?>

                    
                  

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="commentb" class="form-control" height="60px"><?php 
                          
                          if(isset($get_hepatitis_B['remarks'])){
                            echo $get_hepatitis_B['remarks']; 
                          }

                       
                        
                        ?></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "Hepatitis B" ?>" required style="width: 180px" id="Hepatitis B" name="HepatitisB" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}






else if (investigation_name($lab_requests_codes) == "H.PYLORI(SERUM)") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $H_PYLORI_SERUM__TEST = H_PYLORI_SERUM__TEST($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select style="width: 220px" id="H_PYLORI_SERUM_STATUS" name="H_PYLORI_SERUM_STATUS" class="form-control">

                    <?php if ($H_PYLORI_SERUM__TEST != null) { ?>
                        <option value="<?php echo $H_PYLORI_SERUM__TEST['test_status'] ?>"> <?php echo $H_PYLORI_SERUM__TEST['test_status'] ?></option>

                    <option value="Negative"> Negative</option>
                    <option value="Positive"> Positive </option>
                                        <?php } else { ?>

                                            <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                                            <option value="Negative"> Negative</option>
                                            <option value="Positive"> Positive </option>
                                        <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "H.PYLORI(SERUM)" ?>" required style="width: 180px" id="H_PYLORI_SERUM" name="H_PYLORI_SERUM"
         placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}



else if (investigation_name($lab_requests_codes) == "H.PYLORI(STOOL)") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $H_PYLORI_STOOL__TEST = H_PYLORI_STOOL__TEST($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select style="width: 220px" id="H_PYLORI_STOOL_STATUS" name="H_PYLORI_STOOL_STATUS" class="form-control">

                    <?php if ($H_PYLORI_STOOL__TEST != null) { ?>
                        <option value="<?php echo $H_PYLORI_STOOL__TEST['test_status'] ?>"> <?php echo $H_PYLORI_STOOL__TEST['test_status'] ?></option>

                    <option value="Negative"> Negative</option>
                    <option value="Positive"> Positive </option>
                                        <?php } else { ?>

                                            <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                                            <option value="Negative"> Negative</option>
                                            <option value="Positive"> Positive </option>
                                        <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "H.PYLORI(STOOL)" ?>" required style="width: 180px" id="H_PYLORI_STOOL" name="H_PYLORI_STOOL"
         placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}


  

  
else if (investigation_name($lab_requests_codes) == "LIPID PROFILE") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
           $get_lipid_profile_results = get_lipid_profile_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>TOTAL_CHOLESTEROL:</label><input autocomplete="off"   style="width: 220px" id="TOTAL_CHOLESTEROL" name="TOTAL_CHOLESTEROL" placeholder="" class="form-control"
                
                                                          value="<?php 
                                                                
                                                                if(!$get_lipid_profile_results == null){
                                                                    $TOTAL_CHOLESTEROL = $get_lipid_profile_results['TOTAL_CHOLESTEROL'];

                                                                    echo $TOTAL_CHOLESTEROL;
                                                                }

                                                        ?>"
                
                ></td>								
               
               <td> <label>TRIGLYCERIDES:</label><input autocomplete="off"    style="width: 220px" id="TRIGLYCERIDES" name="TRIGLYCERIDES" placeholder="" class="form-control"
                                                        value="<?php 
                                                                
                                                                if(!$get_lipid_profile_results == null){
                                                                    $TRIGLYCERIDES = $get_lipid_profile_results['TRIGLYCERIDES'];

                                                                    echo $TRIGLYCERIDES;
                                                                }

                                                        ?>"
               
               
               ></td>								
                                       
                </tr>  


                <tr>
                <td> <label>HDL CHOLESTEROL:</label><input autocomplete="off"    style="width: 220px" id="HDL_CHOLESTEROL" name="HDL_CHOLESTEROL" placeholder="" class="form-control"
                
                value="<?php 
                                                                
                                                                if(!$get_lipid_profile_results == null){
                                                                    $HDL_CHOLESTEROL = $get_lipid_profile_results['HDL_CHOLESTEROL'];

                                                                    echo $HDL_CHOLESTEROL;
                                                                }

                                                        ?>"
                
                ></td>								
               
               <td> <label>LDL_CHOLESTEROL:</label><input autocomplete="off"    style="width: 220px" id="LDL_CHOLESTEROL" name="LDL_CHOLESTEROL" placeholder="" class="form-control"
               
               value="<?php 
                                                                
                                                                if(!$get_lipid_profile_results == null){
                                                                    $LDL_CHOLESTEROL = $get_lipid_profile_results['LDL_CHOLESTEROL'];

                                                                    echo $LDL_CHOLESTEROL;
                                                                }

                                                        ?>"
               
               ></td>
               
               <td> <label>CORONARY RISK:</label><input autocomplete="off"    style="width: 220px" id="CORONARY_RISK" name="CORONARY_RISK" placeholder="" class="form-control"
               
               value="<?php 
                                                                
                                                                if(!$get_lipid_profile_results == null){
                                                                    $CORONARY_RISK = $get_lipid_profile_results['coronary_risk'];

                                                                    echo $CORONARY_RISK;
                                                                }

                                                        ?>"
               
               ></td>	
                                       
                </tr>  
                 
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "lipid_profile" ?>"   style="width: 180px"  name="lipid_profile" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}



 
else if (investigation_name($lab_requests_codes) == "UREA&CREATINE") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
          $get_urea_creatine_results = get_urea_creatine_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
               

                <tr> 							
               
               <td> <label>S-UREA:</label><input autocomplete="off"    style="width: 220px" id="S_UREA" name="S_UREA" placeholder="" class="form-control"
               value="<?php 
                                                                
                                                                if(!$get_urea_creatine_results == null){
                                                                    $S_UREA = $get_urea_creatine_results['S_UREA'];

                                                                    echo $S_UREA;
                                                                }

                                                        ?>"
               
               ></td>								
                                       
                </tr>
                
                <tr>
                <td> <label>S-CREATININE:</label><input autocomplete="off"    style="width: 220px" id="S_CREATININE" name="S_CREATININE" placeholder="" class="form-control"
                
                value="<?php 
                                                                
                                                                if(!$get_urea_creatine_results == null){
                                                                    $S_CREATININE = $get_urea_creatine_results['S_CREATININE'];

                                                                    echo $S_CREATININE;
                                                                }

                                                        ?>"
                
                ></td>								
               
                                       
                </tr>  

                 
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "UREA&CREATINE" ?>"   style="width: 180px"  name="UREA&CREATINE" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}


 
else if (investigation_name($lab_requests_codes) == "BUE&CR") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        $get_bue_cr_results = get_bue_cr_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>SODIUM:</label><input autocomplete="off"    style="width: 220px" id="SODIUM" name="SODIUM" placeholder="" class="form-control"
                
                value="<?php 
                                                                
                                                                if(!$get_bue_cr_results == null){
                                                                    $SODIUM = $get_bue_cr_results['SODIUM'];

                                                                    echo $SODIUM;
                                                                }

                                                        ?>"
                
                ></td>								
               
               <td> <label>POTASSIUM:</label><input autocomplete="off"    style="width: 220px" id="POTASSIUM" name="POTASSIUM" placeholder="" class="form-control"
               value="<?php 
                                                                
                                                                if(!$get_bue_cr_results == null){
                                                                    $POTASSIUM = $get_bue_cr_results['POTASSIUM'];

                                                                    echo $POTASSIUM;
                                                                }

                                                        ?>"
               
               ></td>								
                                       
                </tr>  


                <tr>
                <td> <label>CHLORIDE:</label><input autocomplete="off"    style="width: 220px" id="CHLORIDE" name="CHLORIDE" placeholder="" class="form-control"
                
                value="<?php 
                                                                
                                                                if(!$get_bue_cr_results == null){
                                                                    $CHLORIDE = $get_bue_cr_results['CHLORIDE'];

                                                                    echo $CHLORIDE;
                                                                }

                                                        ?>"
                
                ></td>								
               
               <td> <label>S-UREA:</label><input autocomplete="off"    style="width: 220px" id="S_UREA" name="S_UREA" placeholder="" class="form-control"
               
               value="<?php 
                                                                
                                                                if(!$get_bue_cr_results == null){
                                                                    $S_UREA = $get_bue_cr_results['S_UREA'];

                                                                    echo $S_UREA;
                                                                }

                                                        ?>"
               
               ></td>								
                                       
                </tr>
                
                <tr>
                <td> <label>S-CREATININE:</label><input autocomplete="off"    style="width: 220px" id="S_CREATININE" name="S_CREATININE" placeholder="" class="form-control"
                
                value="<?php 
                                                                
                                                                if(!$get_bue_cr_results == null){
                                                                    $S_CREATININE = $get_bue_cr_results['S_CREATININE'];

                                                                    echo $S_CREATININE;
                                                                }

                                                        ?>"
                
                ></td>								
               
                                       
                </tr>  

                 
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "BUE&CR" ?>"   style="width: 180px"  name="BUE&CR" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}


else if (investigation_name($lab_requests_codes) == "ELECTROLYTES") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $get_elec_tro_lytes_results = get_elec_tro_lytes_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>SODIUM:</label><input autocomplete="off"    style="width: 220px" id="SODIUM" name="SODIUM_electrolytes" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_elec_tro_lytes_results == null){
                                                                    $SODIUM = $get_elec_tro_lytes_results['SODIUM'];

                                                                    echo $SODIUM;
                                                                }

                                                        ?>"
                
                ></td>								
               
               <td> <label>POTASSIUM:</label><input autocomplete="off"    style="width: 220px" id="POTASSIUM" name="POTASSIUM_electrolytes" placeholder="" class="form-control"
               value="<?php 
                                                                
                                                                if(!$get_elec_tro_lytes_results == null){
                                                                    $POTASSIUM = $get_elec_tro_lytes_results['POTASSIUM'];

                                                                    echo $POTASSIUM;
                                                                }

                                                        ?>"
               
               ></td>								
                                       
                </tr>  


                <tr>
                <td> <label>CHLORIDE:</label><input autocomplete="off"    style="width: 220px" id="CHLORIDE" name="CHLORIDE_electrolytes" placeholder="" class="form-control"
                
                value="<?php 
                                                                
                                                                if(!$get_elec_tro_lytes_results == null){
                                                                    $CHLORIDE = $get_elec_tro_lytes_results['CHLORIDE'];

                                                                    echo $CHLORIDE;
                                                                }

                                                        ?>"
                
                ></td>								
                						
                                       
                </tr>
                
                

                 
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "ELECTROLYTES" ?>"   style="width: 180px"  name="ELECTROLYTES" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}



else if (investigation_name($lab_requests_codes) == "HB ELECTROPHORESIS") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $get_hb_electrophoresis = get_hb_electrophoresis($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>

                <td>
                        
                        <label>Sickling Status:</label>
                        
                        <select  style="width: 220px" id="SICKLING_STATUS" name="SICKLING_STATUS" class="form-control">
    
                                                    <?php if (!$get_hb_electrophoresis == null) { ?>
                                
                                <option value="<?php echo $get_hb_electrophoresis['SICKLING'] ?>"> <?php echo $get_hb_electrophoresis['SICKLING'] ?></option>
                                                <option value="Negative"> Negative</option>
                                                <option value="Positive"> Positive </option>
                                
                                
                                            <?php } else { ?>
                                                <option selected="true" disabled="disabled" value=""> SELECT STATUS </option>
                                <option value="Negative"> Negative</option>
                                <option value="Positive"> Positive </option>
                                                
                                            <?php } ?>
    
                       </select>
                    
                    
                </td>      								
               
                    <td>
                        
                        <label>Genotype Status:</label>
                        
                        <select  style="width: 220px" id="GENOTYPE_STATUS" name="GENOTYPE_STATUS" class="form-control">
    
                        <?php if (!$get_hb_electrophoresis == null) { ?>
    
    <option value="<?php echo $get_hb_electrophoresis['GENOTYPE'] ?>"> <?php echo $get_hb_electrophoresis['GENOTYPE'] ?></option>
                    <option value="AA"> AA</option>
                    <option value="AS"> AS </option>
                    <option value="AC"> AC </option>
                    <option value="SS"> SS </option>
                    <option value="SC"> SC </option>
                    <option value="C"> C </option>
    
    
                <?php } else { ?>
                    <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                    <option value="AA"> AA</option>
                    <option value="AS"> AS </option>
                    <option value="AC"> AC </option>
                    <option value="SS"> SS </option>
                    <option value="SC"> SC </option>
                    <option value="C"> C </option>
                    
                <?php } ?>
    
                       </select>
                    
                    
                    </td>      							
                                       
                </tr>  


 
                 
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "HB ELECTROPHORESIS" ?>"   style="width: 180px"  name="HB_ELECTROPHORESIS" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}


else if (investigation_name($lab_requests_codes) == "BLOOD FILM FOR MALARIA") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $get_blood_film_for_malaria = get_blood_film_for_malaria($_SESSION['patient_id'],$_SESSION['request_code']);
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td>
                        
                        <label> Status:</label>
                        
                        <select  style="width: 220px" id="BLOOD_FILMS_STATUS" name="BLOOD_FILMS_STATUS" class="form-control">
    
                        <?php if (!$get_blood_film_for_malaria == null) { ?>
    
    <option value="<?php echo $get_blood_film_for_malaria['film_status'] ?>"> <?php echo $get_blood_film_for_malaria['film_status'] ?></option>
                    <option value="No MPS SEEN"> No MPS SEEN</option>
                    <option value="MPS PRESENT (+)"> MPS PRESENT (+) </option>
                    <option value="MPS PRESENT (++)"> MPS PRESENT (++) </option>
                    <option value="MPS PRESENT (+++)"> MPS PRESENT (+++) </option>
    
    
                <?php } else { ?>
                    <option selected="true" disabled="disabled" value=""> SELECT STATUS </option>
                    <option value="No MPS SEEN"> No MPS SEEN</option>
                    <option value="MPS PRESENT (+)"> MPS PRESENT (+) </option>
                    <option value="MPS PRESENT (++)"> MPS PRESENT (++) </option>
                    <option value="MPS PRESENT (+++)"> MPS PRESENT (+++) </option>
                    
                <?php } ?>
    
                       </select>
                    
                    
                    </td>      								
               
                  					
                                       
                </tr>  


 
                 
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "BLOOD FILM FOR MALARIA" ?>"   style="width: 180px"  name="BLOOD_FILM_FOR_MALARIA" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}


else if (investigation_name($lab_requests_codes) == "FBS") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $get_fbs_results = get_fbs_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>BLOOD FBS:</label><input autocomplete="off" style="width: 220px" id="BLOOD_FBS" name="BLOOD_FBS" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_fbs_results == null){
                                                                    $BLOOD_FBS = $get_fbs_results['blood_fbs'];

                                                                    echo $BLOOD_FBS;
                                                                }

                                                        ?>"
                ></td>								
               
               <!-- <td> <label>BLOOD RBS:</label><input autocomplete="off" style="width: 220px" id="BLOOD_RBS" name="BLOOD_RBS" placeholder="" class="form-control"
               
               value="<?php // if(!$get_fbs_results == null){// $BLOOD_RBS = $get_fbs_results['blood_rbs'];/// echo $BLOOD_RBS;//   }?>"></td>								 -->
                                       
                </tr>  
               
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "FBS" ?>" required style="width: 180px"  name="FBS" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}

else if (investigation_name($lab_requests_codes) == "OGTT_OLD") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $get_ogtt_results = get_ogtt_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>GLUCOSE LEVEL:</label><input autocomplete="off" style="width: 220px" id="GLUCOSE_LEVEL" name="GLUCOSE_LEVEL" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_ogtt_results == null){
                                                                    $GLUCOSE_LEVEL = $get_ogtt_results['GLUCOSE_LEVEL'];

                                                                    echo $GLUCOSE_LEVEL;
                                                                }

                                                        ?>"
                ></td>								
               
                                       
                </tr>  
               
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "OGTT" ?>" required style="width: 180px"  name="OGTT" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}

else if (investigation_name($lab_requests_codes) == "RBS") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $get_rbs_results = get_rbs_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>BLOOD RBS:</label><input autocomplete="off" style="width: 220px" id="RBS_LEVEL" name="RBS_LEVEL" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_rbs_results == null){
                                                                    $RBS_LEVEL = $get_rbs_results['RBS_LEVEL'];

                                                                    echo $RBS_LEVEL;
                                                                }

                                                        ?>"
                ></td>								
               
               <!-- <td> <label>BLOOD RBS:</label><input autocomplete="off" style="width: 220px" id="BLOOD_RBS" name="BLOOD_RBS" placeholder="" class="form-control"
               
               value="<?php // if(!$get_fbs_results == null){// $BLOOD_RBS = $get_fbs_results['blood_rbs'];/// echo $BLOOD_RBS;//   }?>"></td>								 -->
                                       
                </tr>  
               
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "RBS" ?>" required style="width: 180px"  name="RBS" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}
else if (investigation_name($lab_requests_codes) == "OGTT") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test(Enter values/figures only)"; 
         $get_2HPP_results = get_2HPP_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>FASTING:</label><input type="number" step="0.1" autocomplete="off" style="width: 220px" id="fasting" name="fasting" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_2HPP_results == null){
                                                                    $fasting = $get_2HPP_results['fasting'];

                                                                    echo $fasting;
                                                                }

                                                        ?>"
                ></td>
                
                <td> <label>1ST HOUR:</label><input type="number" step="0.1" autocomplete="off" style="width: 220px" id="1st_hour" name="1st_hour" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_2HPP_results == null){
                                                                    $first_hour = $get_2HPP_results['1st_hour'];

                                                                    echo $first_hour;
                                                                }

                                                        ?>"
                ></td>	


                <td> <label>2ND HOUR:</label><input type="number" step="0.1" autocomplete="off" style="width: 220px" id="2nd_hour" name="2nd_hour" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_2HPP_results == null){
                                                                    $second_hour = $get_2HPP_results['2nd_hour'];

                                                                    echo $second_hour;
                                                                }

                                                        ?>"
                ></td>	
               
                                     
                </tr>  
               
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "2HPP" ?>" required style="width: 180px"  name="2HPP" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}

else if (investigation_name($lab_requests_codes) == "EGFR") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $get_efgr_results = get_efgr_results($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>EGFR VALUE((mL/min/1.73m²)):</label><input type="number" step="0.1" autocomplete="off" style="width: 220px" id="egfrvalue" name="egfrvalue" placeholder="" class="form-control"
                value="<?php 
                                                                 
                                                                if(!$get_efgr_results == null){
                                                                    $egfrvalue = $get_efgr_results['egfr_value'];

                                                                    echo $egfrvalue;
                                                                }

                                                        ?>"
                ></td>
                
                <td> <label>COMMENT:</label><textarea autocomplete="off" style="width: 220px" id="egfrvalueComment" name="egfrvalueComment" placeholder="" class="form-control">
                
                
                <?php 
                                                                
                                                                if(!$get_efgr_results == null){
                                                                    $egfrvalueComment = $get_efgr_results['comment'];

                                                                    echo $egfrvalueComment;
                                                                }

                                                        ?>
                                                        </textarea>


                </td>	


                
               
                                     
                </tr>  
               
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "EFGR" ?>" required style="width: 180px"  name="EFGR" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}


else if (investigation_name($lab_requests_codes) == "PROSTATE SPECIFIC ANTIGEN") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $psa_results = psa_results($_SESSION['patient_id'],$_SESSION['request_code']);
        //psa_results
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>PSA LEVEL:</label> <br/>
                <small style="color:red">NB:If an operator sign(<>) would be used,kindly bring a space after operator sign. Example: > 0.2) <br/>
                For report to see values.
            </small>
                <input autocomplete="off" style="width: 220px" id="PROSTATE_SPECIFIC_ANTIGEN_LEVEL" name="PROSTATE_SPECIFIC_ANTIGEN_LEVEL"
                 placeholder="" class="form-control"    value="<?php 
                                                                
                                                                if(!$psa_results == null){
                                                                    $psa_lev = $psa_results['psa_lev'];

                                                                    echo $psa_lev;
                                                                }

                                                        ?>">
                
                </td>	
                
                <td>
                        
                        <label>Evaluation:</label>
                        
                        <select   style="width: 220px" id="PSA_EVALUATION" name="PSA_EVALUATION" class="form-control">
    
                        <?php if (!$psa_results == null) { ?>
    
    <option value="<?php echo $psa_results['evaluation'] ?>"> <?php echo $psa_results['evaluation'] ?></option>
                    <option value="H"> HIGH</option>
                    <option value="L"> LOW </option>
    
    
                <?php } else { ?>
                    <option selected="true" disabled="disabled" value=""> SELECT EVALUATION </option>
    <option value="H"> HIGH</option>
    <option value="L"> LOW </option>
                    
                <?php } ?>
    
                       </select>
                    
                    
                    </td>  
               
                                        
                </tr>  
               
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "PROSTATE SPECIFIC ANTIGEN" ?>" required style="width: 180px"  name="PROSTATE_SPECIFIC_ANTIGEN" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php 
    
}

else if (investigation_name($lab_requests_codes) == "HCV") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $HCV_test= HCV_test($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select  style="width: 220px" id="HCV_STATUS" name="HCV_STATUS" class="form-control">

                    <?php if (!$HCV_test == null) { ?>

<option value="<?php echo $HCV_test['test_status'] ?>"> <?php echo $HCV_test['test_status'] ?></option>
                <option value="Reactive"> Reactive</option>
                <option value="Non Reactive"> Non Reactive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                <option value="Reactive"> Reactive</option>
                <option value="Non Reactive"> Non Reactive </option>
                
            <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment_HCV" class="form-control" height="60px"><?php 
                        
                        if(isset($HCV_test['remarks'])){
                            echo $HCV_test['remarks'];
                        }
                        ?>
                        
                    </textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "HCV" ?>" required style="width: 180px" id="HCV" name="HCV" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    
}



else if (investigation_name($lab_requests_codes) == "SICKLING") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $SICKLING_TEST= SICKLING_TEST($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select   style="width: 220px" id="SICKLING_STATUS" name="SICKLING_STATUS" class="form-control">

                    <?php if (!$SICKLING_TEST == null) { ?>

<option value="<?php echo $SICKLING_TEST['test_status'] ?>"> <?php echo $SICKLING_TEST['test_status'] ?></option>
                <option value="Negative"> Negative</option>
                <option value="Positive"> Positive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
<option value="Negative"> Negative</option>
<option value="Positive"> Positive </option>
                
            <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment_SICKLING" class="form-control" height="60px"><?php 
                        if(isset($SICKLING_TEST['remarks'] )){
                            echo $SICKLING_TEST['remarks']; 
                        }
                        
                        
                        ?></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "SICKLING" ?>" required style="width: 180px" id="SICKLING" name="SICKLING" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    
}


else if (investigation_name($lab_requests_codes) == "SYPHILLIS") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test";
 $SYPHILLIS_TEST= SYPHILLIS_TEST($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select   style="width: 220px" id="SYPHILLIS_STATUS" name="SYPHILLIS_STATUS" class="form-control">

                    <?php if (!$SYPHILLIS_TEST == null) { ?>

                <option value="<?php echo $SYPHILLIS_TEST['test_status'] ?>"> <?php echo $SYPHILLIS_TEST['test_status'] ?></option>
                 <option value="Reactive"> Reactive</option>
                <option value="Non Reactive"> Non Reactive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                <option value="Reactive"> Reactive</option>
                <option value="Non Reactive"> Non Reactive </option>
                
            <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment_SYPHILLIS" class="form-control" height="60px"><?php 
                        
                        if(isset($SYPHILLIS_TEST['remarks'])){
                            echo $SYPHILLIS_TEST['remarks'];
                        }
                        
                        
                        ?></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "SYPHILLIS" ?>" required style="width: 180px" id="SYPHILLIS" name="SYPHILLIS" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    
}
else if (investigation_name($lab_requests_codes) == "GONORRHEA") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test";
 $GONORRHEA_TEST= GONORRHEA_TEST($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select   style="width: 220px" id="GONORRHEA_STATUS" name="GONORRHEA_STATUS" class="form-control">

                    <?php if (!$GONORRHEA_TEST == null) { ?>

                <option value="<?php echo $GONORRHEA_TEST['test_status'] ?>"> <?php echo $GONORRHEA_TEST['test_status'] ?></option>
                 <option value="Reactive"> Reactive</option>
                <option value="Non Reactive"> Non Reactive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                <option value="Reactive"> Reactive</option>
                <option value="Non Reactive"> Non Reactive </option>
                
            <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment_GONORRHEA" class="form-control" height="60px"><?php 
                        if(isset($GONORRHEA_TEST['remarks'])){
                            echo $GONORRHEA_TEST['remarks']; 
                        }
                     
                        
                        ?></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "GONORRHEA" ?>" required style="width: 180px" id="GONORRHEA" name="GONORRHEA" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    
}


else if (investigation_name($lab_requests_codes) == "GENOTYPE") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
 $GENOTYPE_TEST= GENOTYPE_TEST($_SESSION['patient_id'],$_SESSION['request_code']);
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <!-- AA, AO, BB, BO, AB, and OO -->
                    
                    <select   style="width: 220px" id="GENOTYPE_STATUS" name="GENOTYPE_STATUS" class="form-control">

                 


                    
                    <?php if (!$GENOTYPE_TEST == null) { ?>

<option value="<?php echo $GENOTYPE_TEST['test_status'] ?>"> <?php echo $GENOTYPE_TEST['test_status'] ?></option>
                
<option value="AA"> AA</option>
                    <option value="AO"> AO </option>
                    <option value="BB"> BB </option>
                    <option value="BO"> BO </option>
                    <option value="AB"> AB </option>
                    <option value="OO"> OO </option>


            <?php } else { ?>
                <option value=""> SELECT TEST STATUS </option>
                    <option value="AA"> AA</option>
                    <option value="AO"> AO </option>
                    <option value="BB"> BB </option>
                    <option value="BO"> BO </option>
                    <option value="AB"> AB </option>
                    <option value="OO"> OO </option>
                
            <?php } ?>



                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment_GENOTYPE" class="form-control" height="60px"><?php 
                        
                        if(isset($GENOTYPE_TEST['remarks'] )){
                            echo $GENOTYPE_TEST['remarks']; 
                        }
                       
                        
                        ?></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "GENOTYPE" ?>" required style="width: 180px" id="GENOTYPE" name="GENOTYPE" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    
}
else if (investigation_name($lab_requests_codes) == "RETRO SCREEN") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select  style="width: 220px" id="RETRO_SCREEN_STATUS" name="RETRO_SCREEN_STATUS" class="form-control">

                    <option value=""> SELECT TEST STATUS </option>
                    <option value="Non reactive"> Non reactive</option>
                    <option value="Reactive"> Reactive </option>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment" class="form-control" height="60px"></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "RETRO SCREEN" ?>" required style="width: 180px" id="RETRO_SCREEN" name="RETRO_SCREEN" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    
}


else if (investigation_name($lab_requests_codes) == "SPT") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select required style="width: 220px" id="SPT_STATUS" name="SPT_STATUS" class="form-control">

                    <option value=""> SELECT TEST STATUS </option>
                    <option value="Negative"> Negative</option>
                    <option value="Positive"> Positive </option>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment" class="form-control" height="60px"></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "SPT" ?>" required style="width: 180px" id="SPT" name="SPT" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    
}



else if (investigation_name($lab_requests_codes) == "Typhoid") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
       $Typhoid_test= Typhoid_test($_SESSION['patient_id'],$_SESSION['request_code']); 
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>IgG Status:</label>
                    
                    <select   style="width: 220px" id="IgG" name="IgG" class="form-control">

                   
                    <?php if (!$Typhoid_test['IgG'] == null) { ?>

<option value="<?php echo $Typhoid_test['IgG'] ?>"> <?php echo $Typhoid_test['IgG'] ?></option>
                <option value="Negative"> Negative</option>
                <option value="Positive"> Positive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
<option value="Negative"> Negative</option>
<option value="Positive"> Positive </option>
                
            <?php } ?>

                   </select>

                   <label>IgM Status:</label>
                   <select   style="width: 220px" id="IgM" name="IgM" class="form-control">

   
                   <?php if (!$Typhoid_test['IgM'] == null) { ?>

<option value="<?php echo $Typhoid_test['IgM'] ?>"> <?php echo $Typhoid_test['IgM'] ?></option>
                <option value="Negative"> Negative</option>
                <option value="Positive"> Positive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
<option value="Negative"> Negative</option>
<option value="Positive"> Positive </option>
                
            <?php } ?>

</select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment_TYPHOID" class="form-control" height="60px"><?php 
                        if(isset($Typhoid_test['comment'])){
                            echo $Typhoid_test['comment'];
                        }

                        
                        ?>
                        </textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "Typhoid" ?>" required style="width: 180px" id="Typhoid" name="Typhoid" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php
    
}


else if (investigation_name($lab_requests_codes) == "ESR") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test";
        
        $get_level_esr= get_level_esr($_SESSION['patient_id'],$_SESSION['request_code']); 
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td> <label>ESR LEVEL:</label><input type="number" step="any" autocomplete="off"  style="width: 220px" id="ESR_LEVEL_value" name="ESR_LEVEL_value" placeholder="" class="form-control"
                    value="<?php 
                                                                
                                                                if(!$get_level_esr == null){
                                                                    $ESR_LEVEL = $get_level_esr['ESR_LEVEL'];

                                                                    echo $ESR_LEVEL;
                                                                }

                                                        ?>">
                    
                    </td>                                
                </tr>  
                
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "ESR LEVEL" ?>" required style="width: 180px" id="ESR_LEVEL" name="ESR_LEVEL" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php }



else if (investigation_name($lab_requests_codes) == "CRP") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test";
        
        $get_level_crp= get_level_crp($_SESSION['patient_id'],$_SESSION['request_code']); 

        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td> <label>CRP LEVEL:</label><input type="text"  autocomplete="off"  style="width: 220px" id="CRP_LEVEL_value" name="CRP_LEVEL_value" placeholder="" class="form-control"
                    
                    value="<?php 
                                                                
                                                                if(!$get_level_crp == null){
                                                                    $CRP_LEVEL = $get_level_crp['CRP_LEVEL'];

                                                                    echo $CRP_LEVEL;
                                                                }

                                                        ?>">
                    
                    </td>                                
                
                

                    <td>
                        
                        <label>Evaluation:</label>
                        
                        <select   style="width: 220px" id="CRP_EVALUATION" name="CRP_EVALUATION" class="form-control">
    
                        <?php if (!$get_level_crp == null) { ?>
    
    <option value="<?php echo $get_level_crp['evaluation'] ?>"> <?php echo $get_level_crp['evaluation'] ?></option>
                    <option value="H"> HIGH</option>
                    <option value="L"> LOW </option>
    
    
                <?php } else { ?>
                    <option selected="true" disabled="disabled" value=""> SELECT EVALUATION </option>
    <option value="H"> HIGH</option>
    <option value="L"> LOW </option>
                    
                <?php } ?>
    
                       </select>
                    
                    
                    </td>  
                
                </tr>  
                
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "CRP LEVEL" ?>" required style="width: 180px" id="CRP_LEVEL" name="CRP_LEVEL" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php }






else if (investigation_name($lab_requests_codes) == "URIC ACID") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $get_level_URIC_ACID= get_level_URIC_ACID($_SESSION['patient_id'],$_SESSION['request_code']); 
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td> <label>URIC ACID LEVEL:</label><input type="number" step="any" autocomplete="off" required style="width: 220px" id="URIC_ACID_LEVEL_value" name="URIC_ACID_LEVEL_value" placeholder="" class="form-control"
                    value="<?php 
                                                                
                                                                if(!$get_level_URIC_ACID == null){
                                                                    $URIC_ACID_LEVEL = $get_level_URIC_ACID['URIC_ACID_LEVEL'];

                                                                    echo $URIC_ACID_LEVEL;
                                                                }

                                                        ?>">
                    
                    </td>                                
                </tr>  
                
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "URIC ACID LEVEL" ?>" required style="width: 180px" id="URIC_ACID_LEVEL" name="URIC_ACID_LEVEL" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php }






else if (investigation_name($lab_requests_codes) == "BLOOD GROUP") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
         $get_blood= get_blood($_SESSION['patient_id'],$_SESSION['request_code']); 
        //get_blood
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr> 
                    <td>
                        
                        <label>BLOOD GROUP:</label>
                        
                          <select  style="width: 220px" id="BLOOD_GROUP_value" name="BLOOD_GROUP_value" class="form-control">
    
                                                    <?php if (!$get_blood == null) { ?>
                                
                                <option value="<?php echo $get_blood['BLOOD_TYPE'] ?>"> <?php echo $get_blood['BLOOD_TYPE'] ?></option>
                                                <option value="A Rh D Positive">A Rh D Positive</option>
                                                <option value="A Rh D Negative">A Rh D Negative </option>
                                                <option value="B Rh D Positive">B Rh D Positive</option>
                                                <option value="B Rh D Negative">B Rh D Negative</option>
                                                <option value="O Rh D Positive">O Rh D Positive</option>
                                                <option value="O Rh D Negative">O Rh D Negative</option>
                                                <option value="AB Rh D Positive">AB Rh D Positive</option>
                                                <option value="AB Rh D Negative">AB Rh D Negative</option>
                                
                                
                                            <?php } else { ?>
                                                <option selected="true" disabled="disabled" value=""> SELECT STATUS </option>
                                                <option value="A Rh D Positive">A Rh D Positive</option>
                                                <option value="A Rh D Negative">A Rh D Negative </option>
                                                <option value="B Rh D Positive">B Rh D Positive</option>
                                                <option value="B Rh D Negative">B Rh D Negative</option>
                                                <option value="O Rh D Positive">O Rh D Positive</option>
                                                <option value="O Rh D Negative">O Rh D Negative</option>
                                                <option value="AB Rh D Positive">AB Rh D Positive</option>
                                                <option value="AB Rh D Negative">AB Rh D Negative</option>
                                
                                                
                                            <?php } ?>
    
                          </select>
                    
                    
                </td>      		

                </tr>  
                
                
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "BLOOD GROUP" ?>" required style="width: 180px" id="BLOOD_GROUP" name="BLOOD_GROUP" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php }







else if (investigation_name($lab_requests_codes) == "HIV I") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select required style="width: 220px" id="HIVI" name="HIV_I_STATUS" class="form-control">

                    <option value=""> SELECT TEST STATUS </option>
                    <option value="Non reactive"> Non reactive</option>
                    <option value="Reactive"> Reactive </option>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment" class="form-control" height="60px"></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "HIV I" ?>" required style="width: 180px" id="HIV_I" name="HIV_I" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}




else if (investigation_name($lab_requests_codes) == "HIV II") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select required style="width: 220px" id="HIVII" name="HIV_II_STATUS" class="form-control">

                    <option value=""> SELECT TEST STATUS </option>
                    <option value="Non reactive"> Non reactive</option>
                    <option value="Reactive"> Reactive </option>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment" class="form-control" height="60px"></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "HIV II" ?>" required style="width: 180px" id="HIV_II" name="HIV_II" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}




else if (investigation_name($lab_requests_codes) == "HIV I&II") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
        
        $hiv_i_ii_get= hiv_i_ii_get($_SESSION['patient_id'],$_SESSION['request_code']); 
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select  style="width: 220px" id="HIVII" name="HIV_III_STATUS" class="form-control">
                    <?php if (!$hiv_i_ii_get == null) { ?>

<option value="<?php echo $hiv_i_ii_get['test_status'] ?>"> <?php echo $hiv_i_ii_get['test_status'] ?></option>
                    <option value="Non reactive"> Non reactive</option>
                    <option value="Reactive"> Reactive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
                <option value="Non reactive"> Non reactive</option>
                    <option value="Reactive"> Reactive </option>
                
            <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment_HIV_III_STATUS" class="form-control" height="60px">
                            <?php 
                            if(isset($hiv_i_ii_get['remarks'])){
                                echo $hiv_i_ii_get['remarks'];
                            }
                           
                            
                            ?>
                        </textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "HIV I&II" ?>" required style="width: 180px" id="HIV_II" name="HIV_III" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}



else if (investigation_name($lab_requests_codes) == "SERUM PREGNANCY TEST(SPT)") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
           $get_serum_preg= get_serum_preg($_SESSION['patient_id'],$_SESSION['request_code']); 
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select   style="width: 220px" id="SERUM_PREGNANCY_TEST" name="SERUM_PREGNANCY_TEST_STATUS" class="form-control">

                    <?php if (!$get_serum_preg == null) { ?>

<option value="<?php echo $get_serum_preg['test_status'] ?>"> <?php echo $get_serum_preg['test_status'] ?></option>
                <option value="Negative"> Negative</option>
                <option value="Positive"> Positive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
<option value="Negative"> Negative</option>
<option value="Positive"> Positive </option>
                
            <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="comment_SERUM_PREGNANCY_TEST" class="form-control" height="60px"><?php 
                       if(isset($get_serum_preg['remarks'] )){
                        echo $get_serum_preg['remarks'];
                       }
                      
                        
                        ?></textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "SERUM PREGNANCY TEST(SPT)" ?>" required style="width: 180px" id="SERUM_PREGNANCY_TEST(SPT)" name="SERUM_PREGNANCY_TEST" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}




else if (investigation_name($lab_requests_codes) == "URINE PREGNANCY TEST(UPT)") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
       $get_urine_preg= get_urine_preg($_SESSION['patient_id'],$_SESSION['request_code']);     
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select style="width: 220px" id="URINE_PREGNANCY_TEST" name="URINE_PREGNANCY_TEST_STATUS" class="form-control">

                    <?php if (!$get_urine_preg == null) { ?>

<option value="<?php echo $get_urine_preg['test_status'] ?>"> <?php echo $get_urine_preg['test_status'] ?></option>
                <option value="Negative"> Negative</option>
                <option value="Positive"> Positive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
<option value="Negative"> Negative</option>
<option value="Positive"> Positive </option>
                
            <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="URINE_PREGNANCY_TESTcomment" class="form-control" height="60px">
                            <?php 
                            if(isset($get_urine_preg['remarks'])){
                                echo $get_urine_preg['remarks'];
                            }
                         
                            
                            ?>
                        </textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "URINE PREGNANCY TEST(UPT)" ?>" required style="width: 180px" id="URINE_PREGNANCY_TEST" name="URINE_PREGNANCY_TEST" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}

else if (investigation_name($lab_requests_codes) == "TYROID FUNCTION TEST") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes); 
       $get_tyroid_func= get_tyroid_func($_SESSION['patient_id'],$_SESSION['request_code']);     
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                <td> <label>TRIO-IODO THYRONINE (FT3):</label><input autocomplete="off"    style="width: 220px" id="F_T_3" name="F_T_3" placeholder="" class="form-control"
                value="<?php 
                                                                
                                                                if(!$get_tyroid_func == null){
                                                                    $F_T_3 = $get_tyroid_func['F_T_3'];

                                                                    echo $F_T_3;
                                                                }

                                                        ?>"
                
                ></td>								
               
               <td> <label>THYROXINE (FT4):</label><input autocomplete="off"    style="width: 220px" id="F_T_4" name="F_T_4" placeholder="" class="form-control"
               value="<?php 
                                                                
                                                                if(!$get_tyroid_func == null){
                                                                    $F_T_4 = $get_tyroid_func['F_T_4'];

                                                                    echo $F_T_4;
                                                                }

                                                        ?>"
               
               ></td>								
                                       
                </tr>  


                <tr>
                <td> <label>THYROID STIMULATING HORMONE (TSH):</label> <br/>
                <small style="color:red">NB:If an operator sign(<>) would be used,kindly bring a space after operator sign. Example: > 0.2) <br/>
                For report to see values.
                <input autocomplete="off"    style="width: 220px" id="T_S_H" name="T_S_H" placeholder="" class="form-control"
                
                value="<?php 
                                                                
                                                                if(!$get_tyroid_func == null){
                                                                    $T_S_H = $get_tyroid_func['T_S_H'];

                                                                    echo $T_S_H;
                                                                }

                                                        ?>"
                
                ></td>								
                						
                                       
                </tr>
                
                

                 
                
            </tbody>
        </table>


             <input type="hidden" value="<?php echo "TYROID FUNCTION TEST" ?>" required style="width: 180px" id="TYROID_FUNCTION_TEST" name="TYROID_FUNCTION_TEST" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}

else if (investigation_name($lab_requests_codes) == "COVID-19 ANTIGEN") {
    ?>


<div class="col-sm-12 col-md-12">
    <div class="block-flat">
        <div class="header">              
        <h3><?php echo investigation_name($lab_requests_codes)." Test"; 
       $get_covid_19= get_covid_19($_SESSION['patient_id'],$_SESSION['request_code']);     
        
        
        ?></h3>
        </div>
        <div class="content">


        <table>
            <tbody>
                <tr>
                    <td>
                        
                    <label>Test Status:</label>
                    
                    <select style="width: 220px" id="COVID_9_ANTIGEN_select" name="COVID_9_ANTIGEN_STATUS" class="form-control">

                    <?php if (!$get_covid_19 == null) { ?>

<option value="<?php echo $get_covid_19['test_status'] ?>"> <?php echo $get_covid_19['test_status'] ?></option>
                <option value="Negative"> Negative</option>
                <option value="Positive"> Positive </option>


            <?php } else { ?>
                <option selected="true" disabled="disabled" value=""> SELECT TEST STATUS </option>
<option value="Negative"> Negative</option>
<option value="Positive"> Positive </option>
                
            <?php } ?>

                   </select>
                
                
                </td>                                
              
              
                </tr>  
                 
                <td> <label>Comment:</label>    
                    <div>
                        <textarea id="comment" name="get_covid_19Tcomment" class="form-control" height="60px">
                            <?php 

                            if(isset($get_covid_19['remarks'])){
                                echo $get_covid_19['remarks'];
                            }
                            
                           
                            
                            
                            ?>
                        </textarea>
                    </div>
                </td>
            </tbody>
        </table>


        <input type="hidden" value="<?php echo "COVID-19 ANTIGEN" ?>" required style="width: 180px" id="COVID_9_ANTIGEN" name="COVID_9_ANTIGEN_test" placeholder="" class="form-control">
                
              
        </div>

    </div>

    <?php

    
}




    ?>  




<!-- END OF PROCESSING -->


      <?php }


      
      
      
      
      
      
      
      ?>


                            <div style="text-align: center; margin-top: 10px;"><button onclick='return confirm("Are you sure you want to contitnue with action?")' class="btn btn-primary _update_account" name="submit_lab_request">Submit Lab Request</button></div>
                      
                        </form>

                        </div>

                       
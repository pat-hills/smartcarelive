<body>
<?php
$a = 2;
if(isset($_GET['a'])){
   $a = $_GET['a'];
 } 
     
?>
    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>New Patient Entry</h2>
            <ol class="breadcrumb">
                <li><a href="#">Tasks</a></li>

                <li class="active">New Patient</li>
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
        } else if (isset($_SESSION['errorMsg'])) {
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
                             

                            <div class="   col-sm-12">
                                
                                
                            </div>
                        </div>
               </div>

                    <!--Fields to be updated here-->



                    <div class="row">



                        <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">							
                                    <h3>Personal Info</h3>
                                </div>
                                <div class="content">

                                
                                <form role="form" class="form-horizontal group-border-dashed" action="db_tasks/add_pat.php" method="post"> 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">First name : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" required type="text" name="sname" class="form-control" placeholder="First name" value="">
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Other Names : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off"  required type="text" name="onames" class="form-control"  placeholder="Other Names (Middle Name, Family Name)" value="">
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Gender : </label>
                                            <div class="col-sm-6">
                                                <select required class="form-control" name="sex">
 
                                                <option selected="true" disabled="disabled"> SELECT GENDER </option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>    
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Marital Status : </label>
                                            <div class="col-sm-6">
                                                <select required class="form-control" name="mstats">
                                                    
                                                <option selected="true" disabled="disabled"> SELECT STATUS </option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>

                                                </select>
                                            </div>
                                        </div>    
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Occupation : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off"  required type="text" class="form-control" name="occu"  value="" placeholder="Occupation" >
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phone : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off"  required type="tel" name="phone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" value="" >
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Address : </label>
                                            <div class="col-sm-6">
                                                <textarea required name="add" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                           <label class="col-sm-3 control-label">Picture : </label>
                                           <div class="col-sm-6">
                                              <input type="file" name="ppic" class="form-control"  >
                                           
                                           </div>
                                         </div> -->

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Date of Birth : </label>
                                            <div class="col-sm-6">

                                                <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                                                    <input required type="text" name="dob" class="form-control" size="16"  value="" >
                                                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">National ID : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" type="text" name="nid" class="form-control" value=""  placeholder="National ID">
                                            </div>
                                        </div>

                                        <!-- <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary _update_account" name="update_personal_info">Update Patient Info</button></div>
                                   -->

                                </div>

                            </div>


                        </div>

                        <!-- MEDICAL FORMATION -->
                       
                        <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">              
                                    <h3>Medical Info</h3>
                                </div>
                                <div class="content">

                                    <div role="form" class="form-horizontal group-border-dashed" > 

                                       

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Blood Group : </label>
                                            <div class="col-sm-6">
                                                <select   class="form-control" name="blood_group"><option selected="true" disabled="disabled" value=""> SELECT  </option>
                                                    <option value="A Rh D Positive">A Rh D Positive</option>
                                                <option value="A Rh D Negative">A Rh D Negative </option>
                                                <option value="B Rh D Positive">B Rh D Positive</option>
                                                <option value="B Rh D Negative">B Rh D Negative</option>
                                                <option value="O Rh D Positive">O Rh D Positive</option>
                                                <option value="O Rh D Negative">O Rh D Negative</option>
                                                <option value="AB Rh D Positive">AB Rh D Positive</option>
                                                <option value="AB Rh D Negative">AB Rh D Negative</option>
 
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Rh : </label>
                                            <div class="col-sm-6">
                                                <select   class="form-control" name="r_h">
                                                    <option selected="true" disabled="disabled" value=""> SELECT  </option>
                                                    <option value="Rh positive">Rh positive</option>
                                                
                                                    <option value="Rh negative">Rh negative</option>
 
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Sickling : </label>
                                            <div class="col-sm-6">
                                                <select   class="form-control" name="sickling">
                                                    <option selected="true" disabled="disabled" value=""> SELECT  </option>
                                                    <option value="Negative">Negative</option>
                                                
                                                    <option value="Positive">Positive</option>
 
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">G6PD : </label>
                                            <div class="col-sm-6">
                                                <select   class="form-control" name="g6pd">
                                              <option selected="true" disabled="disabled" value=""> SELECT  </option>
                                                <option value="PARTIAL DEFECT">PARTIAL DEFECT</option>
                                            <option value="FULL DEFECT"> FULL DEFECT </option>
                                            <option value="NO DEFECT"> NO DEFECT </option>
 
                                                </select>
                                            </div>

                                        </div>
                         
                                     
                                         
                                      
                                    
                                    </div>

                                </div>

                            </div>
                        </div>

                        <!-- END OF MEDICAL INFORMATION -->

                        <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">              
                                    <h3>Family / Emergency Info</h3>
                                </div>
                                <div class="content">

                                    <div role="form" class="form-horizontal group-border-dashed" > 

                                    <div class="form-group">
                                            <label class="col-sm-3 control-label">Fullname : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off" required   type="text" name="famname"  class="form-control" placeholder="Name" value="">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Relationship : </label>
                                            <div class="col-sm-6">
                                                <select   class="form-control" name="relationship">
                                                    

                                                    

                                                    <option selected="true" disabled="disabled" value=""> SELECT  </option>
                                                        <option value="Wife">Wife</option>
                                                        <option value="Husband">Husband</option>
                                                        <option value="Mother">Mother</option>
                                                        <option value="Father">Father</option>
                                                        <option value="Aunt">Aunt</option> 
                                                        <option value="Uncle">Uncle</option>
                                                        <option value="Child">Child</option>
                                                        <option value="Dependant">Dependant</option>
                                                        <option value="Parent">Parent</option>
                                                        <option value="Brother">Brother</option>
                                                        <option value="Sister">Sister</option>
                                                        <option value="Cousin">Cousin</option>
                                                        <option value="Relative">Relative</option>
                                                        <option value="Neighbour">Neighbour</option>
                                                        <option value="Friend">Friend</option>
 
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phone Number: </label>
                                            <div class="col-sm-6">  

                                                <input autocomplete="off"   type="text" name="famphone" class="form-control"  placeholder="Phone" value="">
                                            </div>
                                        </div>
                                     
                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Gender : </label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="famgen">
                                                <option selected="true" disabled="disabled" value=""> SELECT  </option>

                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                         

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Address : </label>
                                            <div class="col-sm-6">
                                                <textarea  name="famaddress" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    
                                    </div>

                                </div>

                            </div>
                        </div>


                        <?php if(IS_INSUARANCE_PACKAGE == true) { ?>

                            <div class="col-sm-12 col-md-12">
                            <div class="block-flat">
                                <div class="header">              
                                    <h3>Patient Insurance Information</h3>
                                </div>

                                <div class="content">

                                    <div role="form" class="form-horizontal group-border-dashed"> 
                                       <div class="form-group">
                                            <label class="col-sm-3 control-label">Is Patient On Insurance? </label>
                                            <div class="col-sm-6">
                                                <select required class="form-control" name="patientsscheme" id="patientsscheme">
                                                <option selected="true" disabled="disabled" value=""> SELECT  </option>
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                     <div class="schemeDiv" style="display:none">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">SELECT PACKAGE : </label>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="insurance_companies">
                                                <option selected="true" disabled="disabled" value=""> SELECT  </option>
                                                   <?php echo insurance_companies() ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">MEMBERSHIP ID : </label>
                                            <div class="col-sm-6">
                                                <input autocomplete="off"   type="text" name="MembershipID"  class="form-control" placeholder="MEMBERSHIP ID" value="">
                                            </div>
                                        </div>
                        </div>
                                       
                                    
                                    </div>

                                </div>



                            </div>
                        </div>
                      

                        <?php } ?>
                        <div style="text-align: center; margin-top: 5px;"><button onclick='return confirm("Are you sure you want to contitnue with action?")'  class="btn btn-primary" name="update_scheme_info">Register New Patient</button></div>

</form>
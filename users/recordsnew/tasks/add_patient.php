<?php
//session_destroy();
               unset($_SESSION['surname']);
               unset($_SESSION['other_names']);
               unset($_SESSION['patient_id']);
               unset($_SESSION['dob']);
               unset($_SESSION['scheme']);
               unset($_SESSION['membership_id']);
               unset($_SESSION['sub_metro']);
               unset($_SESSION['occupation']);
               unset($_SESSION['sex']);
?>
<div class="container-fluid" id="pcont">
    <div class="page-head">
        <h2>New Patient Registration</h2>
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>

            <li class="active">Add Patient</li>
        </ol>
    </div>

    <div class="cl-mcont">  
        <div class="row wizard-row">
            <div class="col-md-12 fuelux">	
                <?php
                //setting  error messages
                echo @$_SESSION['err_msg'];
                unset($_SESSION['err_msg']);
                ?>
                <div class="block-wizard">

                    <form class="   form-horizontal group-border-dashed" method="post" action="db_tasks/add_pat.php" autocomplete="off" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate> 

                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-4"  >
                                <div class="form-group no-padding">
                                    <div class="col-sm-12">
                                        <h3 class="hthin">Personal Info</h3>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Surname : </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="sname" class="form-control" placeholder="Surname" value="" required="">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Other Names : </label>
                                    <div class="col-sm-8">
                                        <input type="text" required="" name="onames" class="form-control"  placeholder="Other Names">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gender : </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" required="" name="sex">
                                            <option value="">-- Select Gender --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Marital Status : </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="mstats">
                                            <option value="">-- Select Status --</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>

                                        </select>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Occupation : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="occu"   placeholder="Occupation" >
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Phone : </label>
                                    <div class="col-sm-8">
                                      <!--<input type="tel" name="phone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" maxlength="15" >-->
                                        <input type="tel" name="phone" class="form-control" placeholder="(999) 999-9999" maxlength="15" >

                                    </div>
                                </div> 


                                <!-- <div class="form-group">
                                   <label class="col-sm-3 control-label">Picture : </label>
                                   <div class="col-sm-6">
                                      <input type="file" name="ppic" class="form-control"  >
                                   
                                   </div>
                                 </div> -->

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Date of Birth : </label>
                                    <div class="col-sm-8">

                                        <div class="input-group date datetime "  data-min-view="2" data-date-format="yyyy-mm-dd">
                                            <input type="text" name="dob" readonly="" class="form-control" size="16"   >
                                            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                        </div>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">National ID : </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nid" class="form-control"  placeholder="National ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address : </label>
                                    <div class="col-sm-8">
                                        <textarea name="add" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4 col-sm-4 col-lg-4"  >
                                <div class="form-group no-padding">
                                    <div class="col-sm-12">
                                        <h3 class="hthin">Family Member Information</h3>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Relationship : </label>
                                    <div class="col-sm-8">
                                        <select class="select2 select2-offscreen" name="relationship">
                                            <option value="">-- Select Relationship --</option>
                                            <optgroup label="Relationship to Patient">
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
                                            </optgroup>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Name : </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="famname"  class="form-control" placeholder="Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Phone Number: </label>
                                    <div class="col-sm-8"> 	


                                        <input type="tel" name="famphone"  class="form-control" placeholder="(999) 999-9999" maxlength="15" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gender : </label>
                                    <div class="col-sm-8">
                                        <select class="select2 select2-offscreen" name="famgen">
                                            <option value="">-- Select Gender --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Address : </label>
                                    <div class="col-sm-8">
                                        <textarea name="famaddress" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>



                            </div> 
                            <div class="col-md-4 col-sm-4 col-lg-4"  >
                                <div class="form-group no-padding">
                                    <div class="col-sm-12">
                                        <h3 class="hthin">Scheme Info </h3>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-sm-4">
                                        <label class="control-label">SCHEME TYPE: </label>
                                    </div>


                                    <div class="col-lg-8">

                                        <select required="" class="select2" name="scheme">
                                            <option value="">-- Select Scheme --</option>

                                            <optgroup label="Private">
                                                <!--<option value="p1">Momentum</option>-->
                                                <option value="none">Non-NHIS</option>
                                                <!--
                                                <option value="p2">None</option>
                                                <option value="p3">Cash & Carry</option>
                                                -->
                                            </optgroup>
                                            <optgroup label="Public">
                                                <option value="nhis">NHIS</option>
                                            </optgroup>

                                        </select>

                                    </div>


                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4"> 	
                                        <label class="control-label">NHIS - Sub Metro : </label>
                                    </div>
                                    <div class="col-sm-8"> 	
                                        <select class="select2" name="sub_metro">
                                            <option value="">-- Select Sub Metro --</option>

                                            <optgroup label="National">
                                                <?php
                                                get_submetro_list();
                                                ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4"> 	
                                        <label class="control-label">Membership ID : </label>
                                    </div>
                                    <div class="col-sm-8"> 	

                                        <input type="text" name="membership_id" class="form-control"  placeholder="Membership ID">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4"> 	
                                        <label class="control-label">Serial Number : </label>
                                    </div>
                                    <div class="col-sm-8"> 	

                                        <input type="text" name="serial_number" class="form-control"  placeholder="Card Serial Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button  class="btn btn-default wizard-previous"> Cancel Registration</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary" >Save Patient Details</button>
                                    </div>
                                </div> 




                            </div>

                        </div>

                    </form>

                </div>      
            </div>
        </div>
    </div>
</div>
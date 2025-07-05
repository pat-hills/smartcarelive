<body>

<div class="block-wizard">

<?php

echo @$_SESSION['err_msg'];
unset($_SESSION['err_msg']);



?>

<form class="   form-horizontal group-border-dashed" method="post" action="db_tasks/add_pat.php" autocomplete="off" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate> 

    <div class="row">
        <div class="col-md-4 col-sm-4 col-lg-4"  >
            <div class="form-group no-padding">
                <div class="col-sm-12">
                    <h3 class="hthin">Personal Info</h3>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">First Name : </label>
                <div class="col-sm-8">
                    <input type="text" name="sname" class="form-control" placeholder="Surname" value="" required="">
                </div>
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label">Other Names (Middle / Family): </label>
                <div class="col-sm-8">
                    <input type="text" required="" name="onames" class="form-control"  placeholder="Other Names">
                </div>
            </div> 
            <div class="form-group">
                <label class="col-sm-4 control-label">Gender : </label>
                <div class="col-sm-8">
                    <select class="form-control" required name="sex">
                        <option value="">-- Select Gender --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>    
            <div class="form-group">
                <label class="col-sm-4 control-label">Marital Status : </label>
                <div class="col-sm-8">
                    <select required class="form-control" name="mstats">
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
                    <input required type="text" class="form-control" name="occu"   placeholder="Occupation" >
                </div>
            </div>  
            <div class="form-group">
                <label class="col-sm-4 control-label">Phone : </label>
                <div class="col-sm-8">
                  <!--<input type="tel" name="phone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" maxlength="15" >-->
                    <input required type="tel" name="phone" class="form-control" placeholder="026 1111 000" maxlength="10" >

                </div>
            </div> 


            <div class="form-group">
                <label class="col-sm-4 control-label">Email : </label>
                <div class="col-sm-8">
                  <!--<input type="tel" name="phone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" maxlength="15" >-->
                    <input type="text" name="pat_email" class="form-control" placeholder="someone@SmartCareAid.com" >

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
                        <input required type="text" name="dob" readonly="" class="form-control" size="16"   >
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
                    <textarea required name="add" rows="5" class="form-control"></textarea>
                </div>
            </div>

        </div>

        <div class="col-md-4 col-sm-4 col-lg-4"  >
            <div class="form-group no-padding">
                <div class="col-sm-12">
                    <h3 class="hthin"> Emergency Information</h3>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Fullname : </label>
                <div class="col-sm-8">
                    <input required type="text" name="famname"  class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Relationship : </label>
                <div class="col-sm-8">
                    <select required class="select2 select2-offscreen" name="relationship">
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
                            <option value="Other">Other</option>
                        </optgroup>
                    </select>
                </div>

            </div>


            <div class="form-group">
                <label class="col-sm-4 control-label">Phone Number: </label>
                <div class="col-sm-8"> 	


                    <input required type="tel" name="famphone"  class="form-control" placeholder="026 1111 000" maxlength="10" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label">Gender : </label>
                <div class="col-sm-8">
                    <select required class="select2 select2-offscreen" name="famgen">
                        <option value="">-- Select Gender --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-4 control-label">Address : </label>
                <div class="col-sm-8">
                    <textarea required name="famaddress" rows="5" class="form-control"></textarea>
                </div>
            </div>



        </div> 

        <?php if(IS_INSUARANCE_PACKAGE == true) { ?>

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

                    <select required id="patientsscheme" class="select2" name="scheme">
                        <option value="" >------------------------</option>

                        <optgroup label="Private">
                           
                            <option value="Private">Private Insurance</option>
                            
                        </optgroup>
                        <optgroup label="Public">
                            <option value="nhis">National Health</option>
                        </optgroup>

                        <optgroup label="None">
                            <option value="none">None</option>
                        </optgroup>

                       

                    </select>

                </div>

            </div>


<?php } ?>

      


            <div style="display:none" class="form-group publicscheme">
                <div class="col-sm-4"> 	
                    <label class="control-label">NHIS - Sub Metro : </label>
                </div>
                <div class="col-sm-8"> 	
                    <select class="select2" name="sub_metro">
                        <option value="">-- Select Sub Metro --</option>

                        <optgroup label="National">
                            <?php
                         //   get_submetro_list();
                            ?>
                        </optgroup>
                    </select>
                </div>
            </div>


            <div style="display:none" class="form-group privatescheme">
                <div class="col-sm-4"> 	
                    <label class="control-label">If Private Enter Name : </label>
                </div>
                <div class="col-sm-8"> 	

                    <input type="text" name="name_private" class="form-control"  placeholder="Name Of Private Insurance">

                </div>
            </div>


            <div  style="display:none" class="form-group schememembershipid">
                <div class="col-sm-4"> 	
                    <label class="control-label">Membership ID : </label>
                </div>
                <div class="col-sm-8"> 	

                    <input type="text" name="membership_id" class="form-control"  placeholder="Membership ID">

                </div>
            </div>
            <div   style="display:none" class="form-group schemembershipnumber">
                <div class="col-sm-4"> 	
                    <label class="control-label">Serial Number : </label>
                </div>
                <div class="col-sm-8"> 	

                    <input type="text" name="serial_number" class="form-control"  placeholder="Card Serial Number">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <a href=""  class="btn btn-default "> Cancel Registration</a>&nbsp;&nbsp;&nbsp;&nbsp;
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


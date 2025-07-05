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
        //setting login error messages
       
        echo @$_SESSION['err_msg'];
        
        unset($_SESSION['err_msg']);
        
        
        
        ?>      
        <div class="block-wizard">
          <div id="wizard1" class="wizard wizard-ux">
            <ul class="steps">
              <li data-target="#step1" class="active">Personal Info<span class="chevron"></span></li>
              <li data-target="#step2">Medical Info<span class="chevron"></span></li>
              <li data-target="#step3">Scheme Info<span class="chevron"></span></li>
              <li data-target="#step4">Family Info<span class="chevron"></span></li>
            </ul>
           
          </div>
          <div class="step-content">
            <form class="form-horizontal group-border-dashed" method="post" enctype="multipart/form-data" action="db_tasks/add_pat.php" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate> 
              <div class="step-pane active" id="step1">
                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">Personal Info</h3>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Surname</label>
                  <div class="col-sm-6">
                    <input type="text" name="sname" class="form-control" placeholder="Surname" value="" required="">
                  </div>
                </div>  
                <div class="form-group">
                  <label class="col-sm-3 control-label">Other Names</label>
                  <div class="col-sm-6">
                    <input type="text" name="onames" class="form-control"  placeholder="Other Names">
                  </div>
                </div> 
                <div class="form-group">
                  <label class="col-sm-3 control-label">Sex</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="sex">
                    <option>Male</option>
                    <option>Female</option>
                    </select>
                  </div>
                </div>    
                <div class="form-group">
                  <label class="col-sm-3 control-label">Marital Status</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="mstats">
                    <option>Single</option>
                    <option>Married</option>
                    <option>Divorced</option>
                    <option>Widowed</option>
                   
                  </select>
                  </div>
                </div>    
                <div class="form-group">
                  <label class="col-sm-3 control-label">Occupation</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="occu"   placeholder="Occupation" >
                  </div>
                </div>  
                <div class="form-group">
                  <label class="col-sm-3 control-label">Phone</label>
                  <div class="col-sm-6">
                    <input type="tel" name="phone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" maxlength="10" >
                  </div>
                 </div> 
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Address</label>
                  <div class="col-sm-6">
                    <textarea cols="80" name="add" rows="5" required="">
                      
                    </textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Picture</label>
                  <div class="col-sm-6">
                     <input type="file" name="ppic" class="form-control"  >
                  
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Date of Birth</label>
                  <div class="col-sm-6">
                     <input type="date" name="dob" class="form-control"  >
                  
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Date of Birth</label>
                  <div class="col-sm-6">
                    <input type="text" name="nid" class="form-control"  placeholder="National ID">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-default" type="reset">Cancel</button>
                    <button type="submit" data-wizard="#wizard1" class="btn btn-primary wizard-next">Next Step <i class="fa fa-caret-right"></i></button>
                  </div>
                </div>                  
              </div>
             
              <div class="step-pane" id="step2">
                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">Medical Info</h3>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Epilepsy</label>
                  <div class="col-sm-6">
                    Yes <input type="radio" name="epilepsy" value="1">
                    No <input checked="" type="radio" name="epilepsy" value="0">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Sickle Cell</label>
                  <div class="col-sm-6">
                    Yes <input type="radio" name="sicklecell" value="1">
                    No <input checked=""  type="radio" name="sicklecell" value="0">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Diabetes</label>
                  <div class="col-sm-6">
                    Yes <input type="radio" name="diabetes" value="1">
                    No <input  checked=""  type="radio" name="diabetes" value="0">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Allergies</label>
                  <div class="col-sm-6">
                    Yes <input type="radio" name="allergies" value="1">
                    No  <input checked=""  type="radio" name="allergies" value="0">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Hypertension</label>
                  <div class="col-sm-6">
                    Yes <input type="radio" name="hypertension" value="1">
                    No <input checked=""  type="radio" name="hypertension" value="0">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Other Diagnosis</label>
                  <div class="col-sm-6">
                    <input type="text" checked=""  name="o_dia" class="form-control" placeholder="Other Diagnosis">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Blood Group</label>
                    
                    <select class="select2" name="bg">
                       <optgroup label="type">
                       		<option value="Not Tested"></option>
                           <option value="O+">O positive</option>
                           <option value="O-">O negative</option>
                           <option value="A+">A+</option>
                           <option value="A-">A-</option>       
                           <option value="B+">B+</option>
                           <option value="B-">B-</option>
                           <option value="AB+">AB+</option>
                           <option value="AB-">AB-</option>
                        
                       </optgroup>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                   <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Previous</button>
                    <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Next Step <i class="fa fa-caret-right"></i></button>
                  </div>
                </div>  
              </div>
              <div class="step-pane" id="step3">
                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">Scheme Info </h3>
                  </div>
                </div>
                <div class="form-group">
                  
                  <div class="col-sm-6">
                    <label class="control-label">NATIONAL HEALTH INSURANCE SCHEME</label>
                    <p>Select Patient subscribed scheme below</p>
                    <select class="select2" name="sch_info">
                       <optgroup label="Private">
                         <option value="p1">Momentum</option>
                         <option value="p2">other</option>
                       </optgroup>
                       <optgroup label="National">
                         <?php
						 get_scheme_list();
						 ?>
                       </optgroup>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-12">
                   <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Previous</button>
                    <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Next Step <i class="fa fa-caret-right"></i></button>
                  </div>
                </div>  
              </div>
              <div class="step-pane" id="step4">
                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">Family Info</h3>
                  </div>
                </div>
                
                 <div class="form-group">
                  
                  <div class="col-sm-6">
                    <label class="control-label">Relationship</label>
                    
                    <select class="select2" name="relationship">
                       <optgroup label="type">
                         <option value="Wife">Wife</option>
                         <option value="Husband">Husband</option>
                                 
                         <option value="Child">Child</option>
                         <option value="Dependant">Dependant</option>
                         <option value="Parent">Parent</option>
                          <option value="Brother">Brother</option>
                           <option value="Sister">Sister</option>
                            <option value="Relative">Relative</option>
                       </optgroup>
                    </select>
                  </div>
                </div>
                  
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Phone</label>
                  <div class="col-sm-6">
                    <input type="tel" name="famphone" class="form-control"  placeholder="Phone">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Blood Group</label>
                    
                    <select class="select2" name="fambg">
                       <optgroup label="type">
                          <option value="null"></option>
                           <option value="O+">O+</option>
                           <option value="O-">O-</option>
                           <option value="A+">A+</option>
                           <option value="A-">A-</option>       
                           <option value="B+">B+</option>
                           <option value="B-">B-</option>
                           <option value="AB+">AB+</option>
                           <option value="AB-">AB-</option>
                        
                       </optgroup>
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-6">
                    <input type="text" name="famname"  class="form-control" placeholder="Name">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Sex</label>
                  <div class="col-sm-6">
                   <select class="form-control" name="famgen">
                    <option>Male</option>
                    <option>Female</option>
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Date of Birth</label>
                  <div class="col-sm-6">
                    <input type="date" class="form-control" name="fdob" placeholder="mm/dd/yyyy">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Address</label>
                  <div class="col-sm-6">
                    <textarea cols="80" rows="6" name="famaddress" ></textarea>
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <div class="col-sm-12">
                    <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Previous</button>
                    <button type="submit" class="btn btn-primary" >Complete</button>
                  </div>
                </div>  
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div> 

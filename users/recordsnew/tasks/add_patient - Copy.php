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
		        	<div id="wizard1" class="wizard wizard-ux">
			            <ul class="steps">
			              <li data-target="#step1" class="active">Personal Info<span class="chevron"></span></li>
			              <li data-target="#step2">Scheme Info<span class="chevron"></span></li>
			              <li data-target="#step3">Family Info<span class="chevron"></span></li>
			            </ul>
		          	</div>
		          	<div class="step-content">
	          			<form class="form-horizontal group-border-dashed" method="post" action="db_tasks/add_pat.php" autocomplete="off" data-parsley-namespace="data-parsley-" data-parsley-validate novalidate> 
			              <div class="step-pane active" id="step1">
			                <div class="form-group no-padding">
			                  <div class="col-sm-7">
			                    <h3 class="hthin">Personal Info</h3>
			                  </div>
			                </div>
			                <div class="form-group">
			                  <label class="col-sm-3 control-label">Surname : </label>
			                  <div class="col-sm-6">
			                    <input type="text" name="sname" class="form-control" placeholder="Surname" value="" required="">
			                  </div>
			                </div>  
			                <div class="form-group">
			                  <label class="col-sm-3 control-label">Other Names : </label>
			                  <div class="col-sm-6">
			                    <input type="text" name="onames" class="form-control"  placeholder="Other Names">
			                  </div>
			                </div> 
			                <div class="form-group">
			                  <label class="col-sm-3 control-label">Gender : </label>
			                  <div class="col-sm-6">
			                   <select class="form-control" name="sex">
			                   <option value="">-- Select Gender --</option>
			                    <option value="Male">Male</option>
			                    <option value="Female">Female</option>
			                    </select>
			                  </div>
			                </div>    
			                <div class="form-group">
			                  <label class="col-sm-3 control-label">Marital Status : </label>
			                  <div class="col-sm-6">
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
			                  <label class="col-sm-3 control-label">Occupation : </label>
			                  <div class="col-sm-6">
			                    <input type="text" class="form-control" name="occu"   placeholder="Occupation" >
			                  </div>
			                </div>  
			                <div class="form-group">
			                  <label class="col-sm-3 control-label">Phone : </label>
			                  <div class="col-sm-6">
			                    <!--<input type="tel" name="phone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" maxlength="15" >-->
								<input type="tel" name="phone" class="form-control" placeholder="(999) 999-9999" maxlength="15" >
								
			                  </div>
			                 </div> 
			                 
			                <div class="form-group">
			                <label class="col-sm-3 control-label">Address : </label>
			                <div class="col-sm-6">
			                  <textarea name="add" rows="5" class="form-control"></textarea>
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
			                    <input type="text" name="dob" class="form-control" size="16"   >
			                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
			                  </div>    
			                </div>
			              </div>
			                <div class="form-group">
			                  <label class="col-sm-3 control-label">National ID : </label>
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
			                    <h3 class="hthin">Scheme Info </h3>
			                  </div>
			                </div>
			                <div class="form-group">
			                  
			                  <div class="col-sm-6">
			                    <label class="control-label">HEALTH INSURANCE SCHEME : </label>
			                    <p>Select Patient's subscribed scheme below</p>
			                    <select class="select2" name="scheme">
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
			                   <div class="col-sm-6"> 	
			                  <label class="control-label">NHIS - Sub Metro : </label>
			                  
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
			                   <div class="col-sm-6"> 	
			                  <label class="control-label">Membership ID : </label>
			                  
			                    <input type="text" name="membership_id" class="form-control"  placeholder="Membership ID">

			                  </div>
			                </div>
			                <div class="form-group">
			                   <div class="col-sm-6"> 	
			                  <label class="control-label">Serial Number : </label>
			                  
			                    <input type="text" name="serial_number" class="form-control"  placeholder="Card Serial Number">
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
			                    <h3 class="hthin">Family Member Information</h3>
			                  </div>
			                </div>
			                
		                 	<div class="form-group">
			                    <label class="col-sm-3 control-label">Relationship : </label>
			                    <div class="col-sm-6">
			                    <select class="select2 select2-offscreen" name="relationship">
			                       <option value="">-- Select Relationship --</option>
			                       <optgroup label="type">
										<option value="Wife">Wife</option>
										<option value="Husband">Husband</option>
										<option value="Aunt">Aunt</option> 
										<option value="Uncle">Uncle</option>
										<option value="Child">Child</option>
										<option value="Dependant">Dependant</option>
										<option value="Parent">Parent</option>
										<option value="Brother">Brother</option>
										<option value="Sister">Sister</option>
										<option value="Relative">Relative</option>
										<option value="Neighbour">Neighbour</option>
										<option value="Friend">Friend</option>
			                       </optgroup>
			                    </select>
			                    </div>
			                  
			                </div>
			                <div class="form-group">
		                   		<label class="col-sm-3 control-label">Phone Number: </label>
		                   		<div class="col-sm-6"> 	
			                  		
			                   
									<!--<input type="tel" name="famphone" data-mask="phone" class="form-control" placeholder="(999) 999-9999" maxlength="10" >-->
									<input type="tel" name="famphone"  class="form-control" placeholder="(999) 999-9999" maxlength="15" >
			                  	</div>
			                </div>
			               <!--<div class="form-group">
			                  
			                  
			                    <label class="col-sm-3 control-label">Blood Group : </label>
			                    <div class="col-sm-6">
			                    <select class="select2 select2-offscreen" name="fambg">
		                       		<option value="">-- Select Blood Group --</option>
		                           <option value="O+">O+</option>
		                           <option value="O-">O-</option>
		                           <option value="A+">A+</option>
		                           <option value="A-">A-</option>       
		                           <option value="B+">B+</option>
		                           <option value="B-">B-</option>
		                           <option value="AB+">AB+</option>
		                           <option value="AB-">AB-</option>
			                    </select>
			                    </div>
			                  
			                </div>-->
			                <div class="form-group">
			                  <label class="col-sm-3 control-label">Name : </label>
			                  <div class="col-sm-6">
			                    <input type="text" name="famname"  class="form-control" placeholder="Name">
			                  </div>
			                </div>
			                 <div class="form-group">
			                  <label class="col-sm-3 control-label">Gender : </label>
			                  <div class="col-sm-6">
			                   <select class="select2 select2-offscreen" name="famgen">
			                   	<option value="">-- Select Gender --</option>
			                    <option value="Male">Male</option>
			                    <option value="Female">Female</option>
			                    </select>
			                  </div>
			                </div>
			                 <div class="form-group">
			                <label class="col-sm-3 control-label"> Date of Birth : </label>
			                <div class="col-sm-6">
			                  
			                  <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
			                    <input type="text" name="fdob" class="form-control" size="16"  >
			                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
			                  </div>  					
			                </div>
			              </div>
			                 
			                <div class="form-group">
			                <label class="col-sm-3 control-label">Address : </label>
			                <div class="col-sm-6">
			                  <textarea name="famaddress" rows="5" class="form-control"></textarea>
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
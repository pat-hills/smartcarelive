<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Admin</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Admin - Change Staff Password</li>
      </ol>
    </div>
    <div class="cl-mcont"> 
        <div class="row">
      <div class="col-md-12">
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Change Staff Password</h3>
          </div>
          <div class="content">
             <form class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate="" id="create_account"  action="#" style="border-radius: 0px;" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label">User Type : </label>
                <div class="col-sm-6">
                  
                  <select id="user_type" name="user_type" required="" class="form-control">
                    <option value=""> -- Select User Type -- </option>
                    
                    <option value="1">Admin</option>
                    <option value="2">Doctor or Consulting</option>
                    <option value="3">OPD / Records</option>
                    <option value="4">Cashier</option>
                    <option value="5">Records</option>
                    <option value="6">Pharmacy</option>
                    <option value="7">Lab</option>
                    <option value="8">NHIS</option>
                    
                  </select>         
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Username : </label>
                <div class="col-sm-6">
                  <input type="text" name="username" required="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Password : </label>
                <div class="col-sm-6">
                  <input type="password" name="password" required="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Confirm Password : </label>
                <div class="col-sm-6">
                  <input type="password" name="confirm_password" required="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">First Name : </label>
                <div class="col-sm-6">
                  <input type="text" name="firstname" required="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Othernames : </label>
                <div class="col-sm-6">
                  <input type="text" name="othernames" required="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender : </label>
                <div class="col-sm-6">
                  <select id="gender" name="gender" required="" class="form-control">
                    <option value=""> -- Select Gender -- </option>
                    
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                    
                  </select>        
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Birth : </label>
                <div class="col-sm-6">
                  
                  <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                    <input type="text" name="dob" class="form-control" size="16"  readonly="" >
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                  </div>    
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Department : </label>
                
				<div class="col-sm-6">
                  
                  <select id="occupation" name="occupation" required="" class="form-control">
                    <option value=""> -- Select Department -- </option>
                    
                    <option value="Admin">Admin</option>
                    <option value="Doctor or Consulting">Doctor or Consulting</option>
                    <option value="OPD / Records">OPD / Records</option>
                    <option value="Cashier">Cashier</option>
                    <option value="Records">Records</option>
                    <option value="Pharmacy">Pharmacy</option>
                    <option value="Lab">Lab</option>
                    <option value="NHIS">NHIS</option>
                    
                  </select>         
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Phone Number : </label>
                <div class="col-sm-6">
                  <input type="text" name="phone_number" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Email : </label>
                <div class="col-sm-6">
                  <input type="text" name="email" class="form-control">
                </div>
              </div>
             
              <div class="form-group">
                <label class="col-sm-3 control-label">Address : </label>
                <div class="col-sm-6">
                  <textarea name="address" class="form-control"></textarea>
                </div>
              </div>
              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary _create_account" name="create_account">Create Account</button></div>
            </form>
          </div>
        </div>
        
    </div>
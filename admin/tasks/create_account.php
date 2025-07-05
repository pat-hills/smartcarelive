<body>
    <script language="javascript">
     function checkForm() {
                  
                  
                    var password = document.forms["form1"]["password"].value;
                    var confirm_password = document.forms["form1"]["confirm_password"].value;
                  
                     var phone = document.getElementById("phone_number");
                    if(phone.value.length != 10){
                       alert("You have entered an invalid Phone number");
                        return false;  
                    }
                    if (confirm_password != password)
                    {
                        alert("Password and Confirm Password Do not Match");
                        return false;
                    }
                }
   
    </script>
    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <!--<h2>Admin</h2>-->
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Admin - Create Staff Account</li>
            </ol>
        </div>
        <?php if (isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['successMsg'];
        unset($_SESSION['successMsg']) ?>!</strong> 
                </div>     
            </div>
        <?php } else if (isset($_SESSION['errorMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['errorMsg'];
        unset($_SESSION['errorMsg']) ?>!</strong> 
                </div>     
            </div>
<?php } ?>
        <div class="cl-mcont"> 
            <div class="row">
                <div class="col-md-12" style="font-size: 12px">

                    <div class="block-flat">
                        <div class="header">                          
                            <h4>Create Account</h4>
                        </div>
                        <div class="content">
                            <form onsubmit="return checkForm()" class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate="" id="create_account" 
                            name="form1"  action="tasks/create_staff_account.php" style="border-radius: 0px;" method="post">
                                <div class="col-sm-6 col-md-6 col-lg-6">



                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">User Type : </label>
                                        <div class="col-sm-9">

                                            <select id="user_type" name="user_type" required="" class="form-control">
                                                <option value=""> -- Select User Type -- </option>

                                                <option value="1">Admin</option>
                                                <option value="2">Doctor or Consulting</option>
                                                <option value="3">OPD / Nurses</option>
                                                <option value="4">Cashier/Revenue</option>
                                                <option value="5">Records</option> 
                                                <option value="6">Pharmacy</option>
                                                <option value="7">Lab</option>
                                               

                                                <?php if(IS_INSUARANCE_PACKAGE == true) { ?>

                                                <option value="8">NHIS</option>
                                                <?php } ?>

                                                <option value="9">Accounts</option>
                                            </select>         
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Surname : </label>
                                        <div class="col-sm-9">
                                            <input autocomplete="off" type="text" name="firstname" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Othernames : </label>
                                        <div class="col-sm-9">
                                            <input autocomplete="off" type="text" name="othernames" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Date of Birth : </label>
                                        <div class="col-sm-9">

                                            <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                                                <input type="text" name="dob" class="form-control" size="16"  readonly="" >
                                                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Gender : </label>
                                        <div class="col-sm-9">
                                            <select id="gender" name="gender" required="" class="form-control">
                                                <option value=""> -- Select Gender -- </option>

                                                <option value="female">Female</option>
                                                <option value="male">Male</option>

                                            </select>        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Phone Number : </label>
                                        <div class="col-sm-9">
                                            <input autocomplete="off" type="text" required="" name="phone_number" id="phone_number" class="form-control">
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-6 col-md-6 col-lg-6">

                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Username : </label>
                                        <div class="col-sm-9">
                                            <input autocomplete="off" type="text" name="username" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Password : </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Confirm Password : </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="confirm_password" required="" class="form-control">
                                        </div>
                                    </div>


                                   


                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Email : </label>
                                        <div class="col-sm-9">
                                            <input autocomplete="off" type="text" name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Address : </label>
                                        <div class="col-sm-9">
                                            <textarea name="address" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary _create_account" name="create_account">Create Account</button></div>
                            </form>
                        </div>
                    </div>

                </div>
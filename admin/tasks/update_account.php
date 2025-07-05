<?php
@$get_staff_id = $_GET['staff_id'];

$_SESSION['get_staff_id'] = $get_staff_id;

$staff = staff_info($get_staff_id);


$url = "";
if (isset($_SERVER['HTTP_REFERER'])) {

    $url = $_SERVER['HTTP_REFERER'];
}
?>
<body>
    <script language="javascript">
        function checkForm() {



            var phone = document.getElementById("phone_number");
            if (phone.value.length != 10) {
                alert("You have entered an invalid Phone number");
                return false;
            }

        }

    </script>
    <div class="container-fluid" id="pcont">
        <div class="page-head">
            <h2>Admin</h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>

                <li class="active">Admin - Update Staff Account - <?php echo $url; ?></li>
            </ol>
        </div>
        <?php if (isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php
                        echo $_SESSION['successMsg'];
                        unset($_SESSION['successMsg'])
                        ?>!</strong> 
                </div>     
            </div>
        <?php } else if (isset($_SESSION['errorMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php
                        echo $_SESSION['errorMsg'];
                        unset($_SESSION['errorMsg'])
                        ?>!</strong> 
                </div>     
            </div>
        <?php } ?>

        <div class="cl-mcont"> 
            <div class="row">

                <div class="col-md-12">

                    <div class="block-flat">
                        <div class="header">                          
                            <h3>Update <?php echo ucfirst($staff['firstName']); ?>'s  Account</h3>
                        </div>
                        <div class="content">
                            <form onsubmit="return checkForm()" class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate="" id="update_account"  action="tasks/update_staff_account.php" style="border-radius: 0px;" method="post">
                                <div class="col-sm-12 col-lg-12 col-md-12">

                                    <input type="hidden" name="url" value="<?php echo $url ?>">
                                </div>

                                <div class="col-sm-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">User Type : </label>
                                        <div class="col-sm-9">

                                            <select id="user_type" name="user_type" required="" class="form-control">
                                                <option  value=""> -- Select User Type -- </option>

                                                <option selected="selected"  value="<?php echo $staff['acc_lvl'] ?>">


                                                    <?php
                                                    if ($staff['acc_lvl'] == 1) {
                                                        echo "Admin";
                                                    } else if ($staff['acc_lvl'] == 2) {
                                                        echo "Doctor or Consulting";
                                                    } else if ($staff['acc_lvl'] == 3) {
                                                        echo "OPD / Records";
                                                    } else if ($staff['acc_lvl'] == 4) {
                                                        echo "Cashier";
                                                    } else if ($staff['acc_lvl'] == 5) {
                                                        echo "Records";
                                                    } else if ($staff['acc_lvl'] == 6) {
                                                        echo "Pharmacy";
                                                    } else if ($staff['acc_lvl'] == 7) {
                                                        echo "Lab";
                                                    } else if ($staff['acc_lvl'] == 8) {
                                                        echo "NHIS";
                                                    }else if ($staff['acc_lvl'] == 9) {
                                                        echo "Accounts";
                                                    }
                                                    ?>

                                                </option>

                                                <option value="1">Admin</option>
                                                <option value="2">Doctor or Consulting</option>
                                                <option value="3">OPD / Records</option>
                                                <option value="4">Cashier</option>
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
                                        <label class="col-sm-3 control-label">Username : </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="username" required="" value="<?php echo ucfirst($staff['uname']) ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Password : </label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" required="" value="#######" class="form-control">
                                            <input type="hidden" name="ifnotpassword" required="" value="<?php echo $staff['pass'] ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Date of Birth : </label>
                                        <div class="col-sm-9">

                                            <div class="input-group date datetime " data-min-view="2" data-date-format="yyyy-mm-dd">
                                                <input type="text" name="dob" class="form-control" size="16" value="<?php echo $staff['dob']; ?>">
                                                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Surname : </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="firstname" required="" value="<?php echo ucfirst($staff['firstName']) ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Othernames : </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="othernames" required="" value="<?php echo ucfirst($staff['otherNames']) ?>" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Gender : </label>
                                        <div class="col-sm-9">
                                            <select id="gender" name="gender" required="" class="form-control">
                                                <option selected="selected" value="<?php echo $staff['sex'] ?>"><?php echo ucfirst($staff['sex']) ?></option>
                                                <option value=""> -- Select Gender -- </option>
                                                <option value="female">Female</option>
                                                <option value="male">Male</option>

                                            </select>        
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Department : </label>

                                        <div class="col-sm-9">

                                            <select id="occupation" name="occupation" required="" class="form-control">
                                                <option selected="selected"  value="<?php echo ucfirst($staff['occupation']) ?>"><?php echo ucfirst($staff['occupation']) ?></option>
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
                                        <div class="col-sm-9">
                                            <input type="text" name="phone_number" id="phone_number"   value="<?php echo ucfirst($staff['phone']) ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Email : </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="email" value="<?php echo ucfirst($staff['email']) ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Address : </label>
                                        <div class="col-sm-9">
                                            <textarea name="address"  class="form-control"><?php echo ucfirst($staff['address']) ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">   
                                        <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary _update_account" name="update_account">Update Account</button></div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div style="text-align: center; margin-top: 10px;"><a href="<?php echo $url; ?>" class="btn btn-warning _update_account" name="cancel">Cancel Update</a></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
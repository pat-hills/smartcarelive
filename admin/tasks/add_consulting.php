<body>

<div class="container-fluid" id="pcont">
    <div class="page-head">
      <h2>Admin</h2>
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
       
        <li class="active">Admin - Set Consulting Fee</li>
      </ol>
    </div>

   <?php
        if( isset($_SESSION['successMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['successMsg']; unset($_SESSION['successMsg'])?>!</strong> 
                </div>     
            </div>
      <?php  }  else if( isset($_SESSION['errorMsg'])) { ?>
            <div  style="margin-top: 10px; margin-bottom: -30px; text-align: center;">
                <div class="alert alert-success alert-white rounded">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong><?php echo $_SESSION['errorMsg']; unset($_SESSION['successMsg'])?>!</strong> 
                </div>     
            </div>
      <?php } ?>
	  
	  

	   
<?php
echo @$_SESSION['err_msg'];
unset($_SESSION['err_msg']);
?>


<?php $all_fees = get_consulting_fee();  
	if(!empty($all_fees)){ ?>
<div class="cl-mcont"> 
        <div class="row">
      <div class="col-md-8">
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Set Consulting Fee</h3>
          </div>
          <div class="content">
             <form autocomplete="off" class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/create_consulting.php" style="border-radius: 0px;" method="post">
              
             <!--- <div class="form-group">
                <label class="col-sm-4 control-label">NHIS Members:&#x20B5; </label>
                <div class="col-sm-4">
                  <input type="number" value="<?php //echo $all_fees['NHIS']; ?>" name="nhis_members" required="" class="form-control">
                </div>
              </div> --->
			  <div class="form-group">
                <label class="col-sm-4 control-label">Fee: GH&#x20B5; </label>
                <div class="col-sm-4">
                  <input type="number" value="<?php echo $all_fees['nonNHIS']; ?>" name="nonNhis_members" class="form-control">
                </div>
              </div>
			  

              <div style="text-align: center; margin-top: 10px;"><input type="submit" name="update" class="btn btn-primary" value="Update Consulting Fee"></div>
            </form>
          </div>
        </div>
        
    </div>
</div>
</div>	
	
	
	
	
	<?php } else{ ?>
	
<div class="cl-mcont"> 
        <div class="row">
      <div class="col-md-8">
      
        <div class="block-flat">
          <div class="header">                          
            <h3>Add Consulting</h3>
          </div>
          <div class="content">
             <form autocomplete="off" class="form-horizontal group-border-dashed" data-parsley-validate="" novalidate=""  action="tasks/create_consulting.php" style="border-radius: 0px;" method="post">
              
              <!---<div class="form-group">
                <label class="col-sm-4 control-label">NHIS Members:&#x20B5; </label>
                <div class="col-sm-4">
                  <input type="number" name="nhis_members" required="" class="form-control">
                </div>
              </div> --->
			  <div class="form-group">
                <label class="col-sm-4 control-label">Fee:&#x20B5; </label>
                <div class="col-sm-4">
                  <input type="number" name="nonNhis_members" class="form-control">
                </div>
              </div>
			  

              <div style="text-align: center; margin-top: 10px;"><button class="btn btn-primary" name="add_diagnosis">Add Consulting</button></div>
            </form>
          </div>
        </div>
        
    </div>
</div>
</div>
<?php	} ?>